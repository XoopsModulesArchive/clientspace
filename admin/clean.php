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
require_once('../../../include/cp_header.php');
require_once __DIR__ . '/function.php';

xoops_cp_header();
adminMenu(3);
$op = 'none';

function deldead()
{
    global $xoopsDB;

    $dead = get_dead_uid();

    $ok = isset($_POST['ok']) ? (int)$_POST['ok'] : 0;

    // on a confirmé, donc on supprime

    if (1 == $ok) {
        $compteur = count($dead);

        if ($compteur > 0) {
            for ($i = 0; $i < $compteur; $i++) {
                $uid = $dead[$i];

                $sql = 'DELETE  FROM ' . $xoopsDB->prefix('clientspace_suivi') . ' WHERE uid = ' . $uid;

                $xoopsDB->queryF($sql);

                $sql = 'DELETE  FROM ' . $xoopsDB->prefix('clientspace_items') . ' WHERE uid = ' . $uid;

                $xoopsDB->queryF($sql);
            }

            redirect_header('clean.php', 2, _AM_CLIENTSPACE_CLEAN_TABLE_CLEANED);
        } else {
            redirect_header('clean.php', 2, _AM_CLIENTSPACE_CLEAN_NOTHING);
        }
    } else {
        xoops_confirm(['ok' => 1, 'op' => 'clean'], 'clean.php', _AM_CLIENTSPACE_CLEAN_CONFIRM);
    }
}

if (isset($_GET['op'])) {
    $op = $_GET['op'];
}
if (isset($_POST['op'])) {
    $op = $_POST['op'];
}

switch ($op) {
case 'none':
   echo '<h2>' . _AM_CLIENTSPACE_CLEAN_TITLE . '</h2>';
   echo '<a href="clean.php?op=clean">' . _AM_CLIENTSPACE_CLEAN_LINK . '</a>';
break;
case 'clean':
    deldead();
break;
}
xoops_cp_footer();
