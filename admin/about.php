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
adminMenu(4);
echo '<img src="../clientspace_slogo.png"/ align="left">';
echo '&nbsp;<b>Clientspace</b> par <a href="http://www.s-martinez.com" target="_blank">s-martinez.com</a> GNU General Public License (GPL)<br><br><br><br><br>';
echo 'Ce module est fourni en l\'état, sans aucune garantie de quelque nature que ce soit. Cette distribution est utilisable dans un environnement de production ou sur un site web accessible au public, où seule votre responsabilité, et non celle de l\'auteur, sera engagée.<br><br>';
echo ' <b>Changelog:</b><br><br>';
echo 'Clientspace v 2.0 Beta (31_05_2007)<br><br>';
echo '*Affichage géré par templates<br>';
echo '*Ajout de la fonction recherche<br>';
echo '*Ajout des notifications<br>';
echo '*Ajout d\'un bloc éléments récents<br>';
echo '*Ajout d\'un menu pour nettoyer les tables<br>';
echo '*Changement des droits sur les fichiers pour éviter certains problèmes sur les hébergements mutualisés<br>';
echo '*Gestion des droits avec umask() plutôt que chmod()<br>';
echo '*Corrections de quelques bugs d\'affichage<br><br><br>';
echo 'Clientspace v 2.0 Alpha3 (28_03_2007)<br><br>';
echo '*Bug dans l\'édition de suivi<br><br><br>';
echo 'Clientspace v 2.0 Alpha2 (27_02_2007)<br><br>';
echo '*Bug du système de l\'affichage de l\'etat "lu" "non lu"<br>';
echo '*Modification des permission des dossiers d\'upload de 700 à 755 pour éviter problèmes sur certain hébergements<br>';
echo '*Variable non traduite vers l\'anglais ajoutée<br><br><br>';
echo 'Clientspace v 2.0 Alpha (24_02_2007)<br><br>';
echo '*Recodage complet du module<br>';
echo '*Possibilitées de personnalisations, et autres nouveautées<br><br><br>';
echo 'Clientspace v 1.0 Beta 3 (20_01_2007)<br><br>';
echo '* Problèmes de sécurité partie publique<br>';
echo '* Fichier mysql.sql (prob compatibilité easyphp)<br>';
echo '* Problème ouverture nouvelle fenêtre lors du téléchargement d\'un document.';
xoops_cp_footer();
