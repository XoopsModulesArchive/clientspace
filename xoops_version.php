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

$modversion['name'] = _MI_CLIENTSPACE_NAME;
$modversion['version'] = 2.00;
$modversion['description'] = _MI_CLIENTSPACE_DESC;
$modversion['credits'] = 'Santiago Martinez';
$modversion['author'] = 'Santiago Martinez';
$modversion['help'] = '';
$modversion['license'] = 'GPL see LICENSE';
$modversion['official'] = 0;
$modversion['image'] = 'clientspace_slogo.png';
$modversion['dirname'] = 'clientspace';

//Admin things
$modversion['hasAdmin'] = 1;
$modversion['adminindex'] = 'admin/index.php';

//SQL
$modversion['sqlfile']['mysql'] = 'sql/mysql.sql';
$modversion['tables'][0] = 'clientspace_suivi';
$modversion['tables'][1] = 'clientspace_cat';
$modversion['tables'][2] = 'clientspace_items';

// Menu
$modversion['hasMain'] = 1;

//Templates
$modversion['templates'][1]['file'] = 'clientspace_main.html';
$modversion['templates'][1]['description'] = '';
$modversion['templates'][2]['file'] = 'clientspace_suivi.html';
$modversion['templates'][2]['description'] = '';

// Blocks
$modversion['blocks'][1]['file'] = 'clientspace_recent_items_block.php';
$modversion['blocks'][1]['name'] = _MI_CLIENTSPACE_LAST_ITEMS_BLOCK_TITLE;
$modversion['blocks'][1]['description'] = 'Shows recently added follows up ';
$modversion['blocks'][1]['show_func'] = 'b_clientspace_recent_items_block_show'; // fonction affichage du bloc
//$modversion['blocks'][1]['edit_func'] = "b_ mymodule _edit"; // fonction édition options du bloc
$modversion['blocks'][1]['options'] = '0'; // options (séparation par | si plusieurs)
$modversion['blocks'][1]['template'] = 'clientspace_recent_items_block.html';

/* Config categories */
// $modversion['configcat'][1]['nameid'] = 'clientspace_settings';
// $modversion['configcat'][1]['name'] = 'clientspace_settings';
// $modversion['configcat'][1]['description'] = 'clientspace_settings';

//Config
$modversion['config'][1]['name'] = '_MI_CLIENTSPACE_EDITOR';
$modversion['config'][1]['title'] = '_MI_CLIENTSPACE_EDITOR';
$modversion['config'][1]['description'] = '_MI_CLIENTSPACE_CHOOSE';
$modversion['config'][1]['formtype'] = 'select';
$modversion['config'][1]['valuetype'] = 'text';
$modversion['config'][1]['default'] = 'dhtml';
$modversion['config'][1]['options'] = ['dhtml' => 'dhtml', 'tiny' => 'tiny'];
$modversion['config'][1]['category'] = 'clientspace_settings';

$modversion['config'][2]['name'] = '_MI_CLIENTSPACE_SUIVI';
$modversion['config'][2]['title'] = '_MI_CLIENTSPACE_SUIVI';
$modversion['config'][2]['description'] = '_MI_CLIENTSPACE_SUIVI_DESC';
$modversion['config'][2]['formtype'] = 'yesno';
$modversion['config'][2]['valuetype'] = 'int';
$modversion['config'][2]['default'] = 1;
$modversion['config'][2]['category'] = 'clientspace_settings';

//search
$modversion['hasSearch'] = 1;
$modversion['search']['file'] = 'include/search.inc.php';
$modversion['search']['func'] = 'clientspace_search';

//notification
$modversion['hasNotification'] = 1;

$modversion['notification']['lookup_file'] = 'include/notification.inc.php';
$modversion['notification']['lookup_func'] = 'clientspace_notify_iteminfo';

$modversion['notification']['category'][1]['name'] = 'follow_item';
$modversion['notification']['category'][1]['title'] = _MI_CLIENTSPACE_FOLLOW;
$modversion['notification']['category'][1]['description'] = _MI_CLIENTSPACE_FOLLOW_DESC;
$modversion['notification']['category'][1]['subscribe_from'] = ['index.php', 'suivi.php'];

$modversion['notification']['category'][2]['name'] = 'doc_item';
$modversion['notification']['category'][2]['title'] = _MI_CLIENTSPACE_DOC;
$modversion['notification']['category'][2]['description'] = _MI_CLIENTSPACE_DOC_DESC;
$modversion['notification']['category'][2]['subscribe_from'] = ['index.php'];

$modversion['notification']['event'][1]['name'] = 'new_follow';
$modversion['notification']['event'][1]['category'] = 'follow_item';
$modversion['notification']['event'][1]['title'] = _MI_CLIENTSPACE_NEW_FOLLOW;
$modversion['notification']['event'][1]['caption'] = _MI_CLIENTSPACE_FOLLOW_EVENT_NEW_CAPTION;
$modversion['notification']['event'][1]['description'] = _MI_CLIENTSPACE_FOLLOW_EVENT_NEW_CAPTION;
$modversion['notification']['event'][1]['mail_template'] = 'new_follow_notify';
$modversion['notification']['event'][1]['mail_subject'] = _MI_CLIENTSPACE_FOLLOW_EVENT_NEW_MAIL_SUBJECT;

$modversion['notification']['event'][2]['name'] = 'follow_modified';
$modversion['notification']['event'][2]['category'] = 'follow_item';
$modversion['notification']['event'][2]['title'] = _MI_CLIENTSPACE_FOLLOW_MODIFIED;
$modversion['notification']['event'][2]['caption'] = _MI_CLIENTSPACE_FOLLOW_EVENT_MODIFIED_CAPTION;
$modversion['notification']['event'][2]['description'] = _MI_CLIENTSPACE_FOLLOW_EVENT_MODIFIED_CAPTION;
$modversion['notification']['event'][2]['mail_template'] = 'modified_follow_notify';
$modversion['notification']['event'][2]['mail_subject'] = _MI_CLIENTSPACE_FOLLOW_EVENT_MODIFIED_MAIL_SUBJECT;

$modversion['notification']['event'][3]['name'] = 'new_doc';
$modversion['notification']['event'][3]['category'] = 'doc_item';
$modversion['notification']['event'][3]['title'] = _MI_CLIENTSPACE_NEW_DOC;
$modversion['notification']['event'][3]['caption'] = _MI_CLIENTSPACE_DOC_EVENT_NEW_CAPTION;
$modversion['notification']['event'][3]['description'] = _MI_CLIENTSPACE_DOC_EVENT_NEW_CAPTION;
$modversion['notification']['event'][3]['mail_template'] = 'new_doc_notify';
$modversion['notification']['event'][3]['mail_subject'] = _MI_CLIENTSPACE_DOC_EVENT_NEW_MAIL_SUBJECT;
