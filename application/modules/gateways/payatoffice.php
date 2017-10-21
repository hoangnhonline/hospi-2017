<?php

function payatoffice_config() {
	$configarray = array( "instructions" => array( "Type" => "textarea", "Rows" => "15", "Value" => "Office address" ));

	return $configarray;
}


function payatoffice_link($params) {
	
	//$code = "<p>" . nl2br( $params['instructions'] ). "</p>";
    $code = $params['instructions'];
	return $code;
}