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
require_once XOOPS_ROOT_PATH . '/class/xoopsformloader.php';
require_once __DIR__ . '/function.php';
xoops_cp_header();
adminMenu(2);

$action = $_GET['action'] ?? 'none';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
if (isset($_POST['action'])) {
    $action = $_POST['action'];
}
if (isset($_POST['title'])) {
    $title = $_POST['title'];
}
if (isset($_POST['description'])) {
    $description = $_POST['description'];
}
if (isset($_POST['weight'])) {
    $weight = $_POST['weight'];
}
if (isset($_POST['id'])) {
    $id = $_POST['id'];
}

switch ($action) {
case 'none':
    echo '<a href="sections.php?action=new"><img src="../images/plus.gif"> ' . _AM_CLIENTSPACE_CREATENEWSECTION . '</a>';
    echo '<br><br>';
    $sql = 'SELECT cat_title,cat_desc,cat_weight,cat_id FROM ' . $xoopsDB->prefix('clientspace_cat') . ' ORDER BY cat_weight ASC';
    $result = $xoopsDB->query($sql);
    echo '<table class=\'outer\' width=\'100%\'>';
    echo '<tr><th colspan="5">' . _AM_CLIENTSPACE_CAREDIT . '</th></td>';
    echo '<tr> <td class=\'head\'> ' . _AM_CLIENTSPACE_TITLE . ' </td> <td class=\'head\' align=\'right\'> ' . _AM_CLIENTSPACE_DESCRIPTION . ' </td> <td align=\'right\' class=\'head\'> ' . _AM_CLIENTSPACE_WEIGHT . ' </td>  <td align=\'right\' class=\'head\'> ' . _AM_CLIENTSPACE_OPERATION . ' </td>  </tr>';
    while ($resultat = $xoopsDB->fetchRow($result)) {
        echo '<tr> <td class=\'even\'>' . $resultat[0] . '</td> <td align=\'right\' class=\'odd\'>' . $resultat[1] . '</td> <td class=\'even\' align=\'right\'>' . $resultat[2] . '</td> <td class=\'odd\' align=\'right\'><a title=" ' . _AM_CLIENTSPACE_EDIT . ' " href="sections.php?action=edit&id=' . $resultat[3] . '"><img src="../images/edit.gif"></a> &nbsp;
    <a title=" ' . _AM_CLIENTSPACE_DELETE . ' " href="sections.php?action=delete&id=' . $resultat[3] . '"><img src="../images/delete.gif"></a>
    </td> </tr>';
    }
    echo '</table>';
break;
case 'new':
    $id = 0;
    $page = new XoopsThemeForm(_AM_CLIENTSPACE_CREATENEWSECTION, 'section', 'sections.php');
    $page->addElement(new xoopsFormHidden('action', 'save'));
    $page->addElement(new xoopsFormHidden('id', 0));
    $page->addElement(new XoopsFormText(_AM_CLIENTSPACE_TITLE, 'title', 70, 256, ''));
    $page->addElement(new XoopsFormTextArea(_AM_CLIENTSPACE_DESCRIPTION, 'description', '', 3, 100));
    $page->addElement(new XoopsFormText(_AM_CLIENTSPACE_WEIGHT, 'weight', 2, 1, ''));
    $page->addElement(new XoopsFormButton(_AM_CLIENTSPACE_SAVE, 'button', _AM_CLIENTSPACE_SAVE, 'submit'));
    $page->display();
break;
case 'edit':
    $sql = 'SELECT cat_title,cat_desc,cat_weight,cat_id FROM ' . $xoopsDB->prefix('clientspace_cat') . ' WHERE cat_id=' . $id;
    $result = $xoopsDB->query($sql);
    $resultat = $xoopsDB->fetchRow($result);
    $page = new XoopsThemeForm(_AM_CLIENTSPACE_CREATENEWSECTION, 'section', 'sections.php');
    $page->addElement(new xoopsFormHidden('action', 'save'));
    $page->addElement(new xoopsFormHidden('id', $resultat[3]));
    $page->addElement(new XoopsFormText(_AM_CLIENTSPACE_TITLE, 'title', 70, 256, $resultat[0]));
    $page->addElement(new XoopsFormTextArea(_AM_CLIENTSPACE_DESCRIPTION, 'description', $resultat[1], 3, 100));
    $page->addElement(new XoopsFormText(_AM_CLIENTSPACE_WEIGHT, 'weight', 2, 1, $resultat[2]));
    $page->addElement(new XoopsFormButton(_AM_CLIENTSPACE_SAVE, 'button', _AM_CLIENTSPACE_SAVE, 'submit'));
    $page->display();

break;
case 'save':
        if (0 == $id) {
            $sql = 'INSERT INTO ' . $xoopsDB->prefix('clientspace_cat') . '(cat_id,cat_title,cat_desc,cat_weight) VALUES (\'\',\'' . $title . '\',\'' . $description . '\',\'' . $weight . '\')';

            $xoopsDB->query($sql);

            redirect_header('sections.php', 2, _AM_CLIENTSPACE_CATADDED);
        } else {
            $sql = 'UPDATE ' . $xoopsDB->prefix('clientspace_cat') . ' set cat_title=\'' . $title . '\', cat_desc=\'' . $description . '\', cat_weight=\'' . $weight . '\' WHERE cat_id=' . $id;

            $xoopsDB->query($sql);

            redirect_header('sections.php', 2, _AM_CLIENTSPACE_CATMODIFIED);
        }
break;
case 'delete':
    $sql = 'DELETE FROM ' . $xoopsDB->prefix('clientspace_cat') . ' WHERE cat_id = ' . $id;
    $xoopsDB->queryF($sql);
    $sql = 'DELETE FROM ' . $xoopsDB->prefix('clientspace_items') . ' WHERE cat_id = ' . $id;
    $xoopsDB->queryF($sql);
    redirect_header('sections.php', 2, _AM_CLIENTSPACE_CATDELETED);
break;
}

xoops_cp_footer();
