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
function clientspace_search($queryarray, $andor, $limit, $offset, $userid)
{
    global $xoopsDB , $xoopsUser;

    if (is_object($xoopsUser)) {
        $uid = $xoopsUser->getVar('uid');
    } else {
        $ret = [];

        return $ret;
    }

    $sql = 'SELECT suivi_id,suivi_title,suivi_desc,suivi_content,suivi_date FROM ' . $xoopsDB->prefix('clientspace_suivi') . ' WHERE (uid = ' . $uid;

    if (is_array($queryarray) && $count = count($queryarray)) {
        for ($i = 0; $i < $count; $i++) {
            $sql .= " $andor ";

            $sql .= "(suivi_title LIKE '%$queryarray[$i]%' OR suivi_content LIKE '%$queryarray[$i]%' OR suivi_desc LIKE '%$queryarray[$i]%' OR suivi_id LIKE
                                '%$queryarray[$i]%')";
        }

        $sql .= ') ';
    }

    $sql .= 'ORDER BY suivi_date DESC';

    $sql2 = 'SELECT item_id,item_title,item_desc,item_date,item_ext FROM ' . $xoopsDB->prefix('clientspace_items') . ' WHERE (uid = ' . $uid;

    if (is_array($queryarray) && $count = count($queryarray)) {
        for ($i = 0; $i < $count; $i++) {
            $sql2 .= " $andor ";

            $sql2 .= "(item_title LIKE '%$queryarray[$i]%'  OR item_desc LIKE '%$queryarray[$i]%')";
        }

        $sql2 .= ') ';
    }

    $sql2 .= 'ORDER BY item_date DESC';

    $result = $xoopsDB->query($sql);

    $ret = [];

    $i = 0;

    while ($myrow = $xoopsDB->fetchArray($result)) {
        $ret[$i]['image'] = 'images/minisuivi.gif';

        $ret[$i]['link'] = 'suivi.php?&id=' . $myrow['suivi_id'];

        $ret[$i]['title'] = $myrow['suivi_title'];

        $ret[$i]['time'] = strtotime($myrow['suivi_date']);

        $ret[$i]['uid'] = '';

        $i++;
    }

    $result2 = $xoopsDB->query($sql2);

    while ($myrow2 = $xoopsDB->fetchArray($result2)) {
        $ret[$i]['image'] = 'images/minidocuments.gif';

        $ret[$i]['link'] = 'view.php?&id=' . $myrow2['item_id'] . '&amp;fichier=' . $myrow2['item_title'] . $myrow2['item_ext'];

        $ret[$i]['title'] = $myrow2['item_title'] . $myrow2['item_ext'];

        $ret[$i]['time'] = strtotime($myrow2['item_date']);

        $ret[$i]['uid'] = '';

        $i++;
    }

    $ret = array_slice($ret, $offset, $limit);

    return $ret;
}
