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
$GLOBALS['xoopsOption']['template_main'] = 'clientspace_main.html';
$uid = 0;
$i = 0;
if (is_object($xoopsUser)) {
    $uid = $xoopsUser->getVar('uid');
} else {
    redirect_header('/', 4, _MD_CLIENTSPACE_THANKTOCONNECT);
}
$uname = $xoopsUser->getVar('uname');
//récup config module
$module_id = $xoopsModule->getVar('mid');
$sql = 'SELECT conf_value FROM ' . $xoopsDB->prefix('config') . ' WHERE conf_modid =' . $module_id;
$result = $xoopsDB->query($sql);
while ($resultat = $xoopsDB->fetchRow($result)) {
    $config[$i] = $resultat[0];

    $i++;
}
$suiviact = $config[1];

$xoopsTpl->assign('uname', $uname);
$xoopsTpl->assign('clientspace_follow_activated', $suiviact);
if (1 == $suiviact) {
    $sql = 'SELECT suivi_title,suivi_date,suivi_id,suivi_lect,suivi_desc FROM ' . $xoopsDB->prefix('clientspace_suivi') . ' WHERE uid = ' . $uid . ' ORDER BY suivi_date DESC';

    $result = $xoopsDB->query($sql);

    while ($resultat[] = $xoopsDB->fetchArray($result));

    array_pop($resultat);

    $xoopsTpl->assign('clientspace_follow_list', $resultat);
}

$sql2 = 'SELECT cat_id,cat_title,cat_desc FROM ' . $xoopsDB->prefix('clientspace_cat') . ' ORDER BY cat_weight';
$result2 = $xoopsDB->query($sql2);
while ($resultat2[] = $xoopsDB->fetchArray($result2));
array_pop($resultat2);
$compteur = count($resultat2);
for ($i = 0; $i < $compteur; $i++) {
    $sql3 = 'SELECT item_title,item_desc,item_ext,item_date,item_lect,item_id,item_size,cat_id FROM ' . $xoopsDB->prefix('clientspace_items') . ' WHERE cat_id =' . $resultat2[$i]['cat_id'] . ' AND uid=' . $uid;

    $result3 = $xoopsDB->query($sql3);

    if (isset($resultat3)) {
        unset($resultat3);
    }

    while (false !== ($resultat3[] = $xoopsDB->fetchArray($result3)));

    array_pop($resultat3);

    $resultat2[$i]['content'] = $resultat3;
}

$xoopsTpl->assign('clientspace_documents_list', $resultat2);

require_once XOOPS_ROOT_PATH . '/footer.php';
