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
require_once dirname(__DIR__, 3) . '/mainfile.php';
require_once __DIR__ . '/function.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
if (isset($_GET['uname'])) {
    $uname = $_GET['uname'];
}
if (isset($_GET['catname'])) {
    $catname = $_GET['catname'];
}

if (isset($_GET['fichier'])) {
    $fichier = $_GET['fichier'];
}

$modulepermHandler = xoops_getHandler('groupperm');
if ($xoopsUser) {
    $url_arr = explode('/', mb_strstr($xoopsRequestUri, '/modules/'));

    $moduleHandler = xoops_getHandler('module');

    $xoopsModule = $moduleHandler->getByDirname($url_arr[2]);

    unset($url_arr);

    if (!$modulepermHandler->checkRight('module_admin', $xoopsModule->getVar('mid'), $xoopsUser->getGroups())) {
        redirect_header(XOOPS_URL . '/user.php', 1, _NOPERM);

        exit();
    }
} else {
    redirect_header(XOOPS_URL . '/user.php', 1, _NOPERM);

    exit();
}

$cheminfichier = XOOPS_ROOT_PATH . '/uploads/clientspace/documents/' . $uname . '/' . $catname . '/' . $fichier;

 header('Content-Description: File Transfer');
           header('Content-Type: application/force-download');
           header('Content-Disposition: attachment; filename="' . basename($cheminfichier) . '";');

           header('Content-Length: ' . filesize($cheminfichier));
@readfile($cheminfichier) || die();
