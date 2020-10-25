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

function b_clientspace_recent_items_block_show($options)
{
    global $xoopsDB , $xoopsUser;

    $block = [];

    $myts = MyTextSanitizer::getInstance();

    if (is_object($xoopsUser)) {
        $uid = $xoopsUser->getVar('uid');
    } else {
        return $block;
        print 'Non connecté';
    }

    // requête sql

    $sql = 'SELECT suivi_id, suivi_title, suivi_date FROM ' . $xoopsDB->prefix('clientspace_suivi') . ' WHERE uid=' . $uid . ' ORDER BY suivi_date DESC LIMIT 5';

    $result = $xoopsDB->query($sql);

    // construction du tableau pour le passage des données au template

    while ($myrow = $xoopsDB->fetchArray($result)) {
        $message = [];

        $message['suivi_id'] = $myrow['suivi_id'];

        $title = htmlspecialchars($myrow['suivi_title'], ENT_QUOTES | ENT_HTML5);

        $message['suivi_title'] = $title;

        $message['suivi_date'] = date('d/m/y', strtotime($myrow['suivi_date']));

        $block['clientspace_recent_items_block']['follow'][] = $message;
    }

    // requête sql

    $sql2 = 'SELECT item_id,item_title,item_ext,item_date,cat_title FROM ' . $xoopsDB->prefix('clientspace_items') . ',' . $xoopsDB->prefix('clientspace_cat') . ' WHERE ' . $xoopsDB->prefix('clientspace_cat') . '.cat_id = ' . $xoopsDB->prefix('clientspace_items') . '.cat_id AND uid=' . $uid . ' ORDER BY item_date DESC LIMIT 5';

    $result2 = $xoopsDB->query($sql2);

    // construction du tableau pour le passage des données au template

    while ($myrow2 = $xoopsDB->fetchArray($result2)) {
        $message2 = [];

        $message2['item_id'] = $myrow2['item_id'];

        $title2 = htmlspecialchars($myrow2['item_title'], ENT_QUOTES | ENT_HTML5);

        $message2['item_title'] = $title2;

        $message2['cat_name'] = $myrow2['cat_title'];

        $message2['item_ext'] = $myrow2['item_ext'];

        $message2['item_date'] = date('d/m/y', strtotime($myrow2['item_date']));

        $block['clientspace_recent_items_block']['items'][] = $message2;
    }

    return $block;
}
