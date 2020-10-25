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
require_once('../../../kernel/notification.php');
require_once XOOPS_ROOT_PATH . '/class/xoopsformloader.php';
require_once XOOPS_ROOT_PATH . '/class/uploader.php';
require_once __DIR__ . '/function.php';

xoops_cp_header();
$op = 'none';
$action = 'none';
$section = 'none';
$id = 0;
adminMenu(1);

if (isset($_GET['uid'])) {
    $uid = $_GET['uid'];
}
if (isset($_GET['fichier'])) {
    $fichier = $_GET['fichier'];
}
if (isset($_GET['catname'])) {
    $catname = $_GET['catname'];
}

if (isset($_GET['action'])) {
    $action = $_GET['action'];
}

if (isset($_GET['op'])) {
    $op = $_GET['op'];
}

if (isset($_GET['section'])) {
    $section = $_GET['section'];
}
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
if (isset($_GET['catid'])) {
    $catid = $_GET['catid'];
}
if (isset($_POST['title'])) {
    $title = $_POST['title'];
}
if (isset($_POST['uid'])) {
    $uid = $_POST['uid'];
}

if (isset($_POST['catname'])) {
    $catname = $_POST['catname'];
}

if (isset($_POST['action'])) {
    $action = $_POST['action'];
}
if (isset($_POST['op'])) {
    $op = $_POST['op'];
}
if (isset($_POST['section'])) {
    $section = $_POST['section'];
}

if (isset($_POST['id'])) {
    $id = $_POST['id'];
}

if (isset($_POST['catid'])) {
    $catid = $_POST['catid'];
}

if (isset($_POST['title'])) {
    $title = $_POST['title'];
}

if (isset($_POST['text'])) {
    $text = $_POST['text'];
}

if (isset($_POST['description'])) {
    $description = $_POST['description'];
}

//choix editeur et verification suivi activé
$module_id = $xoopsModule->getVar('mid');
$sql = 'SELECT conf_value FROM ' . $xoopsDB->prefix('config') . ' WHERE conf_modid =' . $module_id;
$result = $xoopsDB->query($sql);

//récupération de la configuration
$i = 0;
while ($resultat = $xoopsDB->fetchRow($result)) {
    $config[$i] = $resultat[0];

    $i++;
}

$editor = $config[0];
$suiviact = $config[1];
if ('tiny' == $editor) {
    require_once XOOPS_ROOT_PATH . '/class/xoopseditor/tinyeditor/formtinyeditortextarea.php';
}
switch ($action) {
case 'none':
    echo '<br><br><b>' . _AM_CLIENTSPACE_SELECTCLIENTSPACETOEDIT . '</b><br><br>';
    selectUser();
break;
case 'edit':

    $uname = uidtouname($uid);
    $date = date('Y-m-d');

    switch ($section) {
    case 'none':
    echo '<h3>' . _AM_CLIENTSPACE_CLIENTSPACEOF . $uname . '</h3>';
    if (1 == $suiviact) {
        echo '<a href="index.php?action=edit&section=suivi&op=new&uid=' . $uid . '"><img src="../images/plus.gif"> ' . _AM_CLIENTSPACE_CREATENEWFOLLOW . '</a>';

        echo '<br><br>';

        $sql = 'SELECT suivi_title,suivi_date,suivi_id,suivi_lect,suivi_desc FROM ' . $xoopsDB->prefix('clientspace_suivi') . ' WHERE uid = ' . $uid . ' ORDER BY suivi_date DESC';

        $result = $xoopsDB->query($sql);

        echo '<table class=\'outer\' width=\'100%\'>';

        echo '<tr><th colspan="5">' . _AM_CLIENTSPACE_FOLLOWLISTOF . ' ' . $uname . '</th></td>';

        echo '<tr> <td class=\'head\' width=\'30%\'> ' . _AM_CLIENTSPACE_TITLE . ' </td> <td align=\'right\' class=\'head\' width=\'30%\'> ' . _AM_CLIENTSPACE_DESCRIPTION . ' </td> <td align=\'right\' class=\'head\' width=\'15%\'>' . _AM_CLIENTSPACE_DATE . '</td> <td align=\'right\' class=\'head\' width=\'15%\'> ' . _AM_CLIENTSPACE_OPERATION . ' </td> <td align=\'right\' class=\'head\' width=\'10%\'> ' . _AM_CLIENTSPACE_ISREAD . ' </td> </tr>';

        while ($resultat = $xoopsDB->fetchRow($result)) {
            $read = 'Lu';

            if (0 == $resultat[3]) {
                $read = 'Non lu';
            }

            echo '<tr> <td class=\'even\'>' . $resultat[0] . '</td> <td align=\'right\' class=\'odd\'>' . $resultat[4] . '</td> <td class=\'even\' align=\'right\'>' . $resultat[1] . '</td> <td class=\'odd\' align=\'right\'><a title=" ' . _AM_CLIENTSPACE_EDIT . ' " href="index.php?uid=' . $uid . '&action=edit&section=suivi&op=edit&id=' . $resultat[2] . '"><img src="../images/edit.gif"></a> &nbsp;
    <a title=" ' . _AM_CLIENTSPACE_VIEW . ' " href="index.php?action=edit&uid=' . $uid . '&section=suivi&op=view&id=' . $resultat[2] . '"><img src="../images/view.gif"></a> &nbsp;
    <a title=" ' . _AM_CLIENTSPACE_DELETE . ' " href="index.php?action=edit&section=suivi&uid=' . $uid . '&op=delete&id=' . $resultat[2] . '"><img src="../images/delete.gif"></a>
    </td> <td class=\'even\' align=\'right\'>' . $read . '</td> </tr>';
        }

        echo '</table>';
    }

    $sql2 = 'SELECT cat_id,cat_title,cat_desc FROM ' . $xoopsDB->prefix('clientspace_cat') . ' ORDER BY cat_weight';
    $result2 = $xoopsDB->query($sql2);

    while ($resultat2 = $xoopsDB->fetchRow($result2)) {
        echo '<br>';

        echo '<br>';

        echo '<a href="index.php?action=edit&section=section&catname=' . $resultat2[1] . '&op=new&uid=' . $uid . '&catid=' . $resultat2[0] . '"><img src="../images/plus.gif"> ' . _AM_CLIENTSPACE_ADDDOC . $resultat2[2] . '</a>';

        echo '<br>';

        echo '<br>';

        echo '<table class=\'outer\' width=\'100%\'>';

        echo '<tr><th colspan="8">' . _AM_CLIENTSPACE_CONTENTDOC . ' ' . $resultat2[1] . ' de ' . $uname . '</th></td>';

        echo '<tr> <td class=\'head\' width=\'20%\'> ' . _AM_CLIENTSPACE_TITLE . ' </td> <td align=\'right\' class=\'head\' width=\'20%\'> ' . _AM_CLIENTSPACE_DESCRIPTION . ' </td> <td align=\'right\' class=\'head\' width=\'10%\'>' . _AM_CLIENTSPACE_EXT . '</td> <td align=\'right\' class=\'head\' width=\'10%\'> ' . _AM_CLIENTSPACE_SIZE . ' </td><td align=\'right\' class=\'head\' width=\'10%\'> ' . _AM_CLIENTSPACE_TYPE . ' </td> <td align=\'right\' class=\'head\' width=\'10%\'> ' . _AM_CLIENTSPACE_DATE . ' </td> <td align=\'right\' class=\'head\' width=\'10%\'> ' . _AM_CLIENTSPACE_ISREAD . ' </td><td align=\'right\' class=\'head\'> ' . _AM_CLIENTSPACE_OPERATION . ' </td> </tr>';

        $sql3 = 'SELECT item_title,item_desc,item_ext,item_type,item_date,item_lect,item_id,item_size FROM ' . $xoopsDB->prefix('clientspace_items') . ' WHERE cat_id =' . $resultat2[0] . ' AND uid=' . $uid;

        $result3 = $xoopsDB->query($sql3);

        while (false !== ($resultat3 = $xoopsDB->fetchRow($result3))) {
            {
            $read = 'Lu';
            if (0 == $resultat3[5]) {
                $read = 'Non lu';
            }
            echo '<tr> <td class=\'even\'>' . $resultat3[0] . '</td> <td align=\'right\' class=\'odd\'>' . $resultat3[1] . '</td> <td class=\'even\' align=\'right\'>' . $resultat3[2] . '</td> <td align=\'right\' class=\'odd\'>' . $resultat3[7] . '</td><td align=\'right\' class=\'even\'>' . $resultat3[3] . '</td> <td align=\'right\' class=\'odd\'>' . $resultat3[4] . '</td> <td class=\'even\' align=\'right\'>' . $read . '</td><td class=\'odd\' align=\'right\'>
    <a title=" ' . _AM_CLIENTSPACE_DOWNLOAD . ' " href="view.php?id=' . $resultat3[6] . '&uname=' . $uname . '&catname=' . $resultat2[1] . '&fichier=' . $resultat3[0] . $resultat3[2] . '"><img src="../images/download.gif"></a> &nbsp;
    <a title=" ' . _AM_CLIENTSPACE_DELETE . ' " href="index.php?action=edit&uid=' . $uid . '&section=section&op=delete&id=' . $resultat3[6] . '&fichier=' . $resultat3[0] . $resultat3[2] . '&catname=' . $resultat2[1] . '"><img src="../images/delete.gif"></a>
    </td>  </tr>';
            }
        }

        echo '</table>';
    }

    echo '<br><a href="index.php"><img src="../images/arrow-left.gif">' . _AM_CLIENTSPACE_BACK . '</a>';
    break;
    case 'suivi':

        switch ($op) {
        case 'new':

        switch ($editor) {
            case 'tiny':

            $page = new XoopsThemeForm(_AM_CLIENTSPACE_FOLLOWADDFOR . $uname, 'client', 'index.php');
            $page->addElement(new xoopsFormHidden('uid', $uid));
            $page->addElement(new xoopsFormHidden('op', 'save'));
            $page->addElement(new xoopsFormHidden('action', 'edit'));
            $page->addElement(new xoopsFormHidden('section', 'suivi'));
            $page->addElement(new XoopsFormText(_AM_CLIENTSPACE_TITLE, 'title', 52, 100, ''));
            $page->addElement(new XoopsFormTextArea(_AM_CLIENTSPACE_DESCRIPTION, 'description', '', 10, ''));
            $page->addElement(new XoopsFormTinyeditorTextArea(['caption' => _AM_CLIENTSPACE_TEXT, 'name' => 'text', 'value' => '', 'width' => '100%', 'height' => '400px'], true));
            $page->addElement(new XoopsFormButton(_AM_CLIENTSPACE_SAVE, 'button', 'Enregistrer', 'submit'));
            $page->display();
            break;
            case 'dhtml':
            $page = new XoopsThemeForm(_AM_CLIENTSPACE_FOLLOWADDFOR . $uname, 'client', 'index.php');
            $page->addElement(new xoopsFormHidden('uid', $uid));
            $page->addElement(new xoopsFormHidden('op', 'save'));
            $page->addElement(new xoopsFormHidden('action', 'edit'));
            $page->addElement(new xoopsFormHidden('section', 'suivi'));
            $page->addElement(new XoopsFormText(_AM_CLIENTSPACE_TITLE, 'title', 52, 100, ''));
            $page->addElement(new XoopsFormTextArea(_AM_CLIENTSPACE_DESCRIPTION, 'description', '', 10, ''));
            $page->addElement(new xoopsFormDhtmlTextArea(_AM_CLIENTSPACE_TEXT, 'text', '', 20, 50), true);
            $page->addElement(new XoopsFormButton(_AM_CLIENTSPACE_SAVE, 'button', _AM_CLIENTSPACE_SAVE, 'submit'));
            $page->display();
            break;
            }
        echo '<br><a href="javascript:history.go(-1)"><img src="../images/arrow-left.gif">' . _AM_CLIENTSPACE_BACK . '</a>';
        break;
        case 'edit':

        $sql = 'SELECT suivi_title,suivi_desc,suivi_content FROM ' . $xoopsDB->prefix('clientspace_suivi') . ' WHERE suivi_id = ' . $id;
        $result = $xoopsDB->query($sql);
        $resultat = $xoopsDB->fetchRow($result);
        $content = $resultat[2];
        $desc = $resultat[1];
        $title = $resultat[0];

        switch ($editor) {
            case 'tiny':

            $page = new XoopsThemeForm(_AM_CLIENTSPACE_FOLLOWADDFOR . $uname, 'client', 'index.php');
            $page->addElement(new xoopsFormHidden('uid', $uid));
            $page->addElement(new xoopsFormHidden('id', $id));
            $page->addElement(new xoopsFormHidden('op', 'save'));
            $page->addElement(new xoopsFormHidden('action', 'edit'));
            $page->addElement(new xoopsFormHidden('section', 'suivi'));
            $page->addElement(new XoopsFormText(_AM_CLIENTSPACE_TITLE, 'title', 52, 100, $title));
            $page->addElement(new XoopsFormTextArea(_AM_CLIENTSPACE_DESCRIPTION, 'description', $desc, 10, ''));
            $page->addElement(new XoopsFormTinyeditorTextArea(['caption' => _AM_CLIENTSPACE_TEXT, 'name' => 'text', 'value' => $content, 'width' => '100%', 'height' => '400px'], true));
            $page->addElement(new XoopsFormButton(_AM_CLIENTSPACE_SAVE, 'button', 'Enregistrer', 'submit'));
            $page->display();
            break;
            case 'dhtml':
            $page = new XoopsThemeForm(_AM_CLIENTSPACE_FOLLOWADDFOR . $uname, 'client', 'index.php');
            $page->addElement(new xoopsFormHidden('uid', $uid));
            $page->addElement(new xoopsFormHidden('id', $id));
            $page->addElement(new xoopsFormHidden('op', 'save'));
            $page->addElement(new xoopsFormHidden('action', 'edit'));
            $page->addElement(new xoopsFormHidden('section', 'suivi'));
            $page->addElement(new XoopsFormText(_AM_CLIENTSPACE_TITLE, 'title', 52, 100, $title));
            $page->addElement(new XoopsFormTextArea(_AM_CLIENTSPACE_DESCRIPTION, 'description', $desc, 10, ''));
            $page->addElement(new xoopsFormDhtmlTextArea(_AM_CLIENTSPACE_TEXT, 'text', $content, 20, 50), true);
            $page->addElement(new XoopsFormButton(_AM_CLIENTSPACE_SAVE, 'button', _AM_CLIENTSPACE_SAVE, 'submit'));
            $page->display();
            break;
            }
        echo '<br><a href="javascript:history.go(-1)"><img src="../images/arrow-left.gif">' . _AM_CLIENTSPACE_BACK . '</a>';
        break;
        case 'view':
        $sql = 'SELECT suivi_title,suivi_content FROM ' . $xoopsDB->prefix('clientspace_suivi') . ' WHERE suivi_id = ' . $id;
        $result = $xoopsDB->query($sql);
        $resultat = $xoopsDB->fetchRow($result);
        echo '<table class=\'outer\' width=\'100%\'> <tr> <th>' . $resultat[0] . '</th> </tr>';
        echo '<tr> <td>' . $resultat[1] . '</td> </tr>';
        echo '</table>';
        echo '<br><a href="javascript:history.go(-1)"><img src="../images/arrow-left.gif">' . _AM_CLIENTSPACE_BACK . '</a>';
        break;
        case 'save':
        if (0 == $id) {
            $notificationHandler = xoops_getHandler('notification');

            $notificationHandler->triggerEvent('follow_item', 0, 'new_follow', [], [$uid]);

            $sql = 'INSERT INTO ' . $xoopsDB->prefix('clientspace_suivi') . '(suivi_id,uid,suivi_title,suivi_desc,suivi_date,suivi_content,suivi_lect) VALUES (\'\',\'' . $uid . '\',\'' . $title . '\',\'' . $description . '\',\'' . $date . '\',\'' . $text . '\',\'0\')';

            $xoopsDB->query($sql);

            //notification of new follow

            redirect_header("index.php?action=edit&uid=$uid", 2, _AM_CLIENTSPACE_FOLLOWADDED);
        } else {
            $notificationHandler = xoops_getHandler('notification');

            $notificationHandler->triggerEvent('follow_item', 0, 'follow_modified', [], [$uid]);

            $sql = 'UPDATE ' . $xoopsDB->prefix('clientspace_suivi') . ' set suivi_title=\'' . $title . '\',suivi_desc=\'' . $description . '\', suivi_content=\'' . $text . '\', suivi_lect=3 WHERE suivi_id=' . $id;

            $xoopsDB->query($sql);

            redirect_header("index.php?action=edit&uid=$uid", 2, _AM_CLIENTSPACE_FOLLOWMODIFIED);
        }
        break;
        case 'delete':
        $sql = 'DELETE FROM ' . $xoopsDB->prefix('clientspace_suivi') . ' WHERE suivi_id = ' . $id;
        $xoopsDB->queryF($sql);
        redirect_header("index.php?action=edit&uid=$uid", 2, _AM_CLIENTSPACE_FOLLOWDELETED);
        break;
        }

    break;
    case 'section':
    switch ($op) {
        case 'new':
       $page = new XoopsThemeForm(_AM_CLIENTSPACE_ADDDOCFOR . $uname, 'client', 'index.php');
       $page->setExtra("enctype='multipart/form-data'");
        $page->addElement(new xoopsFormHidden('action', 'edit'));
        $page->addElement(new xoopsFormHidden('catname', $catname));
        $page->addElement(new xoopsFormHidden('catid', $catid));
       $page->addElement(new xoopsFormHidden('uid', $uid));
       $page->addElement(new xoopsFormHidden('op', 'save'));
       $page->addElement(new xoopsFormHidden('section', 'section'));
       $page->addElement(new XoopsFormText(_AM_CLIENTSPACE_TITLE, 'title', 52, 100, ''));
        $page->addElement(new XoopsFormTextArea(_AM_CLIENTSPACE_DESCRIPTION, 'description', '', 3, 100));
       $page->addElement(new XoopsFormFile(_AM_CLIENTSPACE_FILE, 'document', 8000000));
       $page->addElement(new XoopsFormButton(_AM_CLIENTSPACE_SAVE, 'button', _AM_CLIENTSPACE_SAVE, 'submit'));
       $page->display();
        break;
        case 'save':
        $tempfile = $_FILES['document']['tmp_name'];
        $taille = $_FILES['document']['size'];
        $type = $_FILES['document']['type'];
        $extention = mb_strrchr($_FILES['document']['name'], '.');
        $nom = $_FILES['document']['name'];
        $oldumask = umask(0000);
        if (!file_exists(XOOPS_ROOT_PATH . '/uploads/clientspace')) {
            mkdir(XOOPS_ROOT_PATH . '/uploads/clientspace');

            mkdir(XOOPS_ROOT_PATH . '/uploads/clientspace/documents');

            touch(XOOPS_ROOT_PATH . '/uploads/clientspace/documents/.htaccess');

            $fp = fopen(XOOPS_ROOT_PATH . '/uploads/clientspace/documents/.htaccess', 'wb');

            fwrite($fp, 'deny from all');
        }
        if (!file_exists(XOOPS_ROOT_PATH . '/uploads/clientspace/documents/' . $uname)) {
            mkdir(XOOPS_ROOT_PATH . '/uploads/clientspace/documents/' . $uname);
        }
        if (!file_exists(XOOPS_ROOT_PATH . '/uploads/clientspace/documents/' . $uname . '/' . $catname)) {
            mkdir(XOOPS_ROOT_PATH . '/uploads/clientspace/documents/' . $uname . '/' . $catname);
        }
        if (file_exists(XOOPS_ROOT_PATH . '/uploads/clientspace/documents/' . $uname . '/' . $catname . '/' . $title . $extention)) {
            redirect_header("index.php?action=edit&uid=$uid", 2, _AM_CLIENTSPACE_FILEEXISTS);
        } else {
            $sql = 'INSERT INTO ' . $xoopsDB->prefix('clientspace_items') . '(item_id,cat_id,item_desc,item_date,item_ext,item_title,item_type,uid,item_lect,item_size) VALUES (\'\',\'' . $catid . '\',\'' . $description . '\',\'' . $date . '\',\'' . $extention . '\',\'' . $title . '\',\'' . $type . '\',\'' . $uid . '\',\'0\',\'' . $taille . '\')';

            $xoopsDB->query($sql);

            $fichier = XOOPS_ROOT_PATH . '/uploads/clientspace/documents/' . $uname . '/' . $catname . '/' . $title . $extention;

            move_uploaded_file($tempfile, $fichier);

            $notificationHandler = xoops_getHandler('notification');

            $notificationHandler->triggerEvent('doc_item', 0, 'new_doc', [], [$uid]);

            redirect_header("index.php?action=edit&uid=$uid", 2, _AM_CLIENTSPACE_DOCADDED);
        }
        umask($oldumask);
        break;
        case 'view':
        $fichier = XOOPS_ROOT_PATH . '/uploads/clientspace/documents/' . $uname . '/' . $catname . '/' . $fichier;
        echo readfile($fichier);
        break;
        case 'delete':
        $sql = 'DELETE FROM ' . $xoopsDB->prefix('clientspace_items') . ' WHERE item_id = ' . $id;
        $xoopsDB->queryF($sql);
        $fichier = XOOPS_ROOT_PATH . '/uploads/clientspace/documents/' . $uname . '/' . $catname . '/' . $fichier;
        unlink($fichier);
        redirect_header("index.php?action=edit&uid=$uid", 2, _AM_CLIENTSPACE_DOCDELETED);
        break;
        }
    break;
    }
break;
}

xoops_cp_footer();
