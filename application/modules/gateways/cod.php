<?php

function cod_config() {
	$configarray = array( "instructions" => array( "Type" => "textarea", "Rows" => "15", "Value" => "Cash on Delivery" ));
	return $configarray;
}


function cod_link($params) {
	
	//$code = "<p>" . nl2br( $params['instructions'] ). "</p>";
        $code = $params['instructions'];
	return $code;
}