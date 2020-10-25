<?php

//  ------------------------------------------------------------------------ //
//                      CLIENTSPACE - MODULE FOR XOOPS 2                      //
//                  Copyright (c) 2006-2007 Santiago Martinez                //
// ------------------------------------------------------------------------- //
//  This program is free software; you can redistribute it and/or modify     //
//  it under the terms of the GNU General Public License as published by     //
//  the Free Software Foundation; either version 2 of the License, or        //
//  (at your option) any later version.                                      //
//                                                                           //
//  You may not change or alter any portion of this comment or credits       //
//  of supporting developers from this source code or any supporting         //
//  source code which is considered copyrighted (c) material of the          //
//  original comment or credit authors.                                      //
//                                                                           //
//  This program is distributed in the hope that it will be useful,          //
//  but WITHOUT ANY WARRANTY; without even the implied warranty of           //
//  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the            //
//  GNU General Public License for more details.                             //
//                                                                           //
//  You should have received a copy of the GNU General Public License        //
//  along with this program; if not, write to the Free Software              //
//  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307 USA //
//  ------------------------------------------------------------------------ //
require_once '../../mainfile.php';
require_once XOOPS_ROOT_PATH . '/header.php';
$GLOBALS['xoopsOption']['template_main'] = 'clientspace_suivi.html';

$uid = 0;
if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
}

if (is_object($xoopsUser)) {
    $uid = $xoopsUser->getVar('uid');
} else {
    redirect_header('/', 4, _MD_CLIENTSPACE_THANKTOCONNECT);
}
    $uname = $xoopsUser->getVar('uname');
    $xoopsTpl->assign('uname', $uname);

    $sql = 'UPDATE ' . $xoopsDB->prefix('clientspace_suivi') . ' SET  suivi_lect=1 WHERE suivi_id=' . $id . ' AND uid=' . $uid;
    $xoopsDB->queryF($sql);
    $sql = 'SELECT suivi_title,suivi_content FROM ' . $xoopsDB->prefix('clientspace_suivi') . ' WHERE suivi_id = ' . $id . ' AND uid=' . $uid;
    $result = $xoopsDB->query($sql);
    $resultat = $xoopsDB->fetchRow($result);
    if ('' != $resultat) {
        $xoopsTpl->assign('clientspace_suivi_content', $resultat);
    } else {
        redirect_header('/', 4, _MD_CLIENTSPACE_DONTEXIST);
    }

require_once XOOPS_ROOT_PATH . '/footer.php';
