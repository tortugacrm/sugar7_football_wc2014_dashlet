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
 
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');


class WorldCup14Api extends SugarApi
{
    public function registerApiRest()
    {
        return array(
            'GetScoresEndpoint' => array(
                //request type
                'reqType' => 'GET',
                //endpoint path
                'path' => array('wc14', 'GetScores'),
                //endpoint variables
                'pathVars' => array(''),
                //method to call
                'method' => 'GetScores',
                //short help string to be displayed in the help documentation
                'shortHelp' => 'Get today\'s matches live scores',
                //long help to be displayed in the help documentation
                'longHelp' => '',
            ),

            'GetMyTeamScoresEndpoint' => array(
                //request type
                'reqType' => 'GET',
                //endpoint path
                'path' => array('wc14', 'GetMyTeamScores'),
                //endpoint variables
                'pathVars' => array('', '', 'data'),
                //method to call
                'method' => 'GetMyTeamScores',
                //short help string to be displayed in the help documentation
                'shortHelp' => 'See my favorite team\'s scores',
                //long help to be displayed in the help documentation
                'longHelp' => '',
            ),
        );
    }

    /**
     * Method to be used for my MyEndpoint/GetExample endpoint
     */
    public function GetScores($api, $args)
    {
        $service = '/matches/today';
		return self::call_service('http://worldcup.sfg.io/'.$service, '', 'GET','', true, false, true);
    }
    
    public function GetMyTeamScores($api, $args)
    {
		if (!isset($args['fifa_code'])) { 
			return '[]'; 
			exit; 
		}
		$service = '/matches/country';
		return self::call_service('http://worldcup.sfg.io/'.$service, '', 'GET',$args, true, false, true);
    }
    
    /**
	 * Generic function to make cURL request.
	 * @param $url - The URL route to use.
	 * @param string $oauthtoken - The oauth token.
	 * @param string $type - GET, POST, PUT, DELETE. Defaults to GET.
	 * @param array $arguments - Endpoint arguments.
	 * @param array $encodeData - Whether or not to JSON encode the data.
	 * @param array $returnHeaders - Whether or not to return the headers.
	 * @return mixed
	 */
	private function call_service(
		$url,
		$oauthtoken='',
		$type='GET',
		$arguments=array(),
		$encodeData=true,
		$returnHeaders=false,
		$decode=true
	)
	{
		$type = strtoupper($type);

		if ($type == 'GET')
		{
			$url .= "?" . http_build_query($arguments);
		}

		$curl_request = curl_init($url);

		if ($type == 'POST')
		{
			curl_setopt($curl_request, CURLOPT_POST, 1);
		}
		elseif ($type == 'PUT')
		{
			curl_setopt($curl_request, CURLOPT_CUSTOMREQUEST, "PUT");
		}
		elseif ($type == 'DELETE')
		{
			curl_setopt($curl_request, CURLOPT_CUSTOMREQUEST, "DELETE");
		}

		curl_setopt($curl_request, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
		curl_setopt($curl_request, CURLOPT_HEADER, $returnHeaders);
		curl_setopt($curl_request, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($curl_request, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl_request, CURLOPT_FOLLOWLOCATION, 0);

		if (!empty($oauthtoken))
		{
			$token = array("oauth-token: {$oauthtoken}");
			curl_setopt($curl_request, CURLOPT_HTTPHEADER, $token);
		}

		if (!empty($arguments) && $type !== 'GET')
		{
			if ($encodeData)
			{
				//encode the arguments as JSON
				$arguments = json_encode($arguments);
			}
			curl_setopt($curl_request, CURLOPT_POSTFIELDS, $arguments);
		}

		$result = curl_exec($curl_request);

		if ($returnHeaders)
		{
			//set headers from response
			list($headers, $content) = explode("\r\n\r\n", $result ,2);
			foreach (explode("\r\n",$headers) as $header)
			{
				header($header);
			}

			//return the nonheader data
			return trim($content);
		}

		curl_close($curl_request);

		//decode the response from JSON
		$response = $result;
		if ($decode) {
			$response = json_decode($result);
		}
		return $response;
	}

}

?>
