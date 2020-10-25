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
function adminMenu($currentoption = 0, $breadcrumb = '')
{
    global $xoopsConfig;

    global $xoopsModule;

    if (file_exists(XOOPS_ROOT_PATH . '/modules/clientspace/language/' . $xoopsConfig['language'] . '/modinfo.php')) {
        require_once XOOPS_ROOT_PATH . '/modules/clientspace/language/' . $xoopsConfig['language'] . '/modinfo.php';
    } else {
        require_once XOOPS_ROOT_PATH . '/modules/clientspace/language/english/modinfo.php';
    }

    require_once __DIR__ . '/menu.php';

    echo "<style type=\"text/css\">\n";

    echo "#buttontop { float:left; width:100%; background: #e7e7e7; font-size:93%; line-height:normal; border-top: 1px solid black; border-left: 1px solid black; border-right: 1px solid black; margin: 0; }\n";

    echo "#buttonbar { float:left; width:100%; background: #e7e7e7 url('../images/modadminbg.gif') repeat-x left bottom; font-size:93%; line-height:normal; border-left: 1px solid black; border-right: 1px solid black; margin-bottom: 12px; }\n";

    echo "#buttonbar ul { margin:0; margin-top: 15px; padding:10px 10px 0; list-style:none; }\n";

    echo '#buttonbar li { display:inline; margin:0; padding:0; }';

    echo "#buttonbar a { float:left; background:url('../images/left_both.gif') no-repeat left top; margin:0; padding:0 0 0 9px; border-bottom:1px solid #000; text-decoration:none; }\n";

    echo "#buttonbar a span { float:left; display:block; background:url('../images/right_both.gif') no-repeat right top; padding:5px 15px 4px 6px; font-weight:bold; color:#765; }\n";

    echo "/* Commented Backslash Hack hides rule from IE5-Mac \*/\n";

    echo "#buttonbar a span {float:none;}\n";

    echo "/* End IE5-Mac hack */\n";

    echo "#buttonbar a:hover span { color:#333; }\n";

    echo "#buttonbar .current a { background-position:0 -150px; border-width:0; }\n";

    echo "#buttonbar .current a span { background-position:100% -150px; padding-bottom:5px; color:#333; }\n";

    echo "#buttonbar a:hover { background-position:0% -150px; }\n";

    echo "#buttonbar a:hover span { background-position:100% -150px; }\n";

    echo "</style>\n";

    echo "<div id=\"buttontop\">\n";

    echo "<table style=\"width: 100%; padding: 0; \" cellspacing=\"0\">\n";

    echo "<tr>\n";

    echo "<td style=\"width: 70%; font-size: 10px; text-align: left; color: #2F5376; padding: 0 6px; line-height: 18px;\">\n";

    echo '<a href="../index.php">' . _AM_CLIENTSPACE_GO_TO_MODULE . '</a> | <a href="' . XOOPS_URL . '/modules/system/admin.php?fct=preferences&amp;op=showmod&amp;mod=' . $xoopsModule->getVar('mid') . '">' . _AM_CLIENTSPACE_CONFIG . "</a>\n";

    echo "</td>\n";

    echo "<td style=\"width: 30%; font-size: 10px; text-align: right; color: #2F5376; padding: 0 6px; line-height: 18px;\">\n";

    echo '<b>' . $xoopsModule->getVar('name') . '&nbsp;' . _AM_CLIENTSPACE_ADMINISTRATION . '</b>&nbsp;' . $breadcrumb . "\n";

    echo "</td>\n";

    echo "</tr>\n";

    echo "</table>\n";

    echo "</div>\n";

    echo "<div id=\"buttonbar\">\n";

    echo "<ul>\n";

    foreach ($GLOBALS['adminmenu'] as $key => $link) {
        if ($key == $currentoption) {
            echo "<li class=\"current\">\n";
        } else {
            echo "<li>\n";
        }

        echo '<a href="' . XOOPS_URL . '/modules/clientspace/' . $link['link'] . '"><span>' . $link['title'] . "</span></a>\n";

        echo "</li>\n";
    }

    echo "</ul>\n";

    echo "</div>\n";

    echo "<br style=\"clear:both;\">\n";
}

function selectUser()
{
    $client = new XoopsThemeForm(_AM_CLIENTSPACE_FUNCCLIENTSPACETOEDIT, 'client', 'index.php');

    $uid = new XoopsFormSelectUser(_AM_CLIENTSPACE_FUNCCLIENTSELECTCLIENT, 'uid');

    $client->addElement($uid);

    $button = new XoopsFormButton(_AM_CLIENTSPACE_FUNCCLIENTEDITPAGE, 'button', _AM_CLIENTSPACE_FUNCCLIENTEDIT, 'submit');

    $client->addElement($button);

    $client->addElement(new xoopsFormHidden('action', 'edit'));

    $client->display();
}

function uidtouname($uid)
{
    global $xoopsDB;

    $sql = 'SELECT uname FROM ' . $xoopsDB->prefix('users') . ' WHERE uid=' . $uid;

    $result = $xoopsDB->query($sql);

    $resultat = $xoopsDB->fetchRow($result);

    $uname = $resultat[0];

    return $uname;
}

function get_dead_uid()
{
    global $xoopsDB;

    $sql = 'SELECT MAX(uid) FROM ' . $xoopsDB->prefix('users');

    $result = $xoopsDB->query($sql);

    $max_id = $xoopsDB->fetchRow($result);

    $sql2 = 'SELECT uid FROM ' . $xoopsDB->prefix('users');

    $result2 = $xoopsDB->query($sql2);

    while (false !== ($living_uid_array[] = $xoopsDB->fetchRow($result2)));

    array_pop($living_uid_array);

    $compteur = count($living_uid_array);

    for ($i = 0; $i < $compteur; $i++) {
        $living_uid_array[$i] = $living_uid_array[$i][0];
    }

    $sql3 = 'SELECT uid FROM ' . $xoopsDB->prefix('clientspace_items');

    $result3 = $xoopsDB->query($sql3);

    while (false !== ($items_uid_array[] = $xoopsDB->fetchRow($result3)));

    array_pop($items_uid_array);

    $compteur = count($items_uid_array);

    for ($i = 0; $i < $compteur; $i++) {
        $items_uid_array[$i] = $items_uid_array[$i][0];
    }

    $items_uid_array = array_unique($items_uid_array);

    $sql4 = 'SELECT uid FROM ' . $xoopsDB->prefix('clientspace_suivi');

    $result4 = $xoopsDB->query($sql4);

    while (false !== ($suivi_uid_array[] = $xoopsDB->fetchRow($result4)));

    array_pop($suivi_uid_array);

    $compteur = count($suivi_uid_array);

    for ($i = 0; $i < $compteur; $i++) {
        $suivi_uid_array[$i] = $suivi_uid_array[$i][0];
    }

    $suivi_uid_array = array_unique($suivi_uid_array);

    $dead_suivi = array_diff($suivi_uid_array, $living_uid_array);

    $dead_items = array_diff($items_uid_array, $living_uid_array);

    $dead = array_unique(array_merge($dead_suivi, $dead_items));

    return $dead;
}

// function get_dead_uname()
// {
// $sql = 'SELECT uname FROM '.$xoopsDB->prefix('users');
// $result = $xoopsDB->query($sql);
// while (false !== ($living_uname_array[]= $xoopsDB->fetchRow($result)));
// array_pop($living_uname_array);
// $compteur = count($living_uname_array);
// for ($i=0; $i<$compteur; $i++)
// {
// $living_uname[$i]=$living_uname_array[$i][0];
// }
// $dir = XOOPS_ROOT_PATH.'/uploads/clientspace/documents';
// while ($f = readdir($dir)) {
   // if(is_file($rep.$f)) {
      // echo "<li>Nom : ".$f;
      // echo "<li>Taille : ".filesize($rep.$f)." octets";
      // echo "<li>Création : ".dd(filectime($rep.$f));
      // echo "<li>Modification : ".dd(filemtime($rep.$f));
      // echo "<li>Dernier accès : ".dd(fileatime($rep.$f));
      // echo "<br><br>";
   // }
// }
// }
