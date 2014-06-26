<?php
if(!defined('sugarEntry'))define('sugarEntry', true);
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
$viewdefs['base']['view']['worldcup14'] = array(
    'dashlets' => array(
        array(
            'label' => 'LBL_DASHLET_WORLDCUP14',
            'description' => 'LBL_DASHLET_WC14_DESC',
            'config' => array(
                'todayorteam' => '-1',
                'team' => '14',
            ),
            'preview' => array(
                'todayorteam' => '-1',
                'team' => '14',
            ),
            'filter' => array(
                'module' => array(
                    'Home',
                ),
                'view' => 'record'
            ),
            
        ),
    ),
    'config' => array(
        'fields' => array(
            
            array(
                'name' => 'todayorteam',
                'label' => 'LBL_DASHLET_WC14_TODAYTEAM',
                'type' => 'enum',
                'searchBarThreshold' => -1,
                'options' => 'DASHLET_WC14_list',
            ),            

            array(
                'name' => 'team',
                'label' => 'LBL_DASHLET_WC14_FAVTEAM',
                'type' => 'enum',
                'searchBarThreshold' => 14,
                'options' => array(
					'ALG' => 'Algeria',
					'ARG' => 'Argentina',
					'AUS' => 'Australia',
					'BEL' => 'Belgium',
					'BIH' => 'Bosnia and Herzegovina',
					'BRA' => 'Brazil',
					'CMR' => 'Cameroon',
					'CHI' => 'Chile',
					'COL' => 'Colombia',
					'CRC' => 'Costa Rica',
					'CIV' => 'Côte d\'Ivoire (Ivory Coast)',
					'CRO' => 'Croatia',
					'ECU' => 'Ecuador',
					'ENG' => 'England',
					'FRA' => 'France',
					'GER' => 'Germany',
					'GHA' => 'Ghana',
					'GRE' => 'Greece',
					'HON' => 'Honduras',
					'IRN' => 'Iran',
					'ITA' => 'Italy',
					'JPN' => 'Japan',
					'KOR' => 'South Korea',
					'MEX' => 'Mexico',
					'NED' => 'Netherlands',
					'NGA' => 'Nigeria',
					'POR' => 'Portugal',
					'RUS' => 'Russia',
					'ESP' => 'Spain',
					'USA' => 'United States',
					'URU' => 'Uruguay'
				),
            ),            
        ),
    ),
);
