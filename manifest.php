<?php
/*
 *  This file is part of 'Football World Cup 2014 Dashlet'.
 *
 *  'Football World Cup 2014 Dashlet' is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation.
 *
 *  'Football World Cup 2014 Dashlet' is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with 'Football World Cup 2014 Dashlet'.  If not, see http://www.gnu.org/licenses/gpl.html.
 *
 * Copyright 2014 Olivier Nepomiachty - All rights reserved.
 */

$manifest = array (

		'acceptable_sugar_versions' => 
			array(
				'regex_matches' => array(
					'7\\.[0-9]\\.[0-9]$'
				),
			),			
			
		  'acceptable_sugar_flavors' =>
		  array(
			  0 => 'PRO',
			  1 => 'CORP',
			  2 => 'ENT',
			  3 => 'ULT',
		  ),
		  'readme'=>'README.txt',
		  'key'=>'WC14',
		  'author' => 'Olivier Nepomiachty',
		  'description' => 'Football World Cup 2014 Dashlet',
		  'icon' => '',
		  'is_uninstallable' => true,
		  'name' => 'Football World Cup 2014',
		  'published_date' => '2014-06-24 08:00',
		  'type' => 'module',
		  'version' => '1.0.0.24',
		  'remove_tables' => false,
		  );  
		  
$installdefs = array (
  'id' => 'FWC2014',

  'copy' => 
  array (
    array (
      'from' => '<basepath>/worldcup14/',
      'to' => 'custom/clients/base/views/worldcup14',
    ),
   ),   

  'language' => 
  array (
    array (
      'from' => '<basepath>/language.worldcup14/en_us.lang.php',
      'to_module' => 'application',
      'language' => 'en_us',
    ),    
    array (
      'from' => '<basepath>/language.worldcup14/fr_FR.lang.php',
      'to_module' => 'application',
      'language' => 'fr_FR',
    ),    
    array (
      'from' => '<basepath>/language.worldcup14/de_DE.lang.php',
      'to_module' => 'application',
      'language' => 'de_DE',
    ),    
    array (
      'from' => '<basepath>/language.worldcup14/ru_RU.lang.php',
      'to_module' => 'application',
      'language' => 'ru_RU',
    ),    
    array (
      'from' => '<basepath>/language.worldcup14/ru_RU.lang.php',
      'to_module' => 'application',
      'language' => 'sv_SE',
    ),    
   )  
 
);
