<?php

$country = $_POST['country'];
$extra = $_POST['extra'];
$group_size = $_POST['group_size'];
$typeofvisa = $_POST['visa_type'];
//if($_POST['visit_purpose']=="For business") $visit_purpose = $_POST['visit_purpose'];
//else $visit_purpose = "For tourist";
$visit_purpose = $_POST['visit_purpose'];
$processing_time = $_POST['processing_time'];
$private = $_POST['private'];
$servicetype = $_POST['servicetype'];
$vip = $_POST['vip'];
$seats = $_POST['seats'];
$stamp = $_POST['stamp'];
$arrivalport = $_POST['arrivalport'];

require_once("../../../../wp-load.php");

global $wpdb;
$service_name = $wpdb->prefix . 'service_fee';
$additional_name = $wpdb->prefix . 'additional_fee';
$airport_name = $wpdb->prefix . 'airport_fee';
$service = $wpdb->get_row( "SELECT * FROM $service_name WHERE group_size = $group_size AND visa_type LIKE '%$typeofvisa%' AND visit_purpose LIKE '%$visit_purpose%'" );
$servicefee = $service->price ? $service->price : 0;
if(trim($typeofvisa)=="" || trim($visit_purpose)=="") $servicefee = 0;
$additional = $wpdb->get_row( "SELECT * FROM $additional_name WHERE id=1" );
$airport = $wpdb->get_row( "SELECT * FROM $airport_name WHERE airport LIKE '%$arrivalport%'" );
$privatefee = $private ? $additional->privateprice : 0 ;
$pakagefee = $additional->packageprice;
$checkinfee = $servicetype ? $airport->checkinprice : 0 ;
$vipfee = $vip ? $airport->vip : 0 ;
if($stamp==1){
if($typeofvisa=="1ms")
    $stampfee = $additional->stamp1ms;
elseif($typeofvisa=="1mm")
    $stampfee = $additional->stamp1mm;
elseif($typeofvisa=="3ms")
    $stampfee = $additional->stamp3ms;
elseif($typeofvisa=="3mm")
    $stampfee = $additional->stamp3mm;
elseif($typeofvisa=="6ms")
    $stampfee = $additional->stamp6ms;
else $stampfee = $additional->stamp1ym;
} else $stampfee = 0;
if($processing_time=="Urgent") $rushfee = $additional->urgent;
elseif($processing_time=="Emergency") $rushfee = $additional->emergency;
elseif($processing_time=="Holiday") $rushfee = $additional->holiday;
else $rushfee = 0;
if($seats==24) $carfee = $airport->twentyfourseats;
elseif($seats==7) $carfee = $airport->sevenseats;
elseif($seats==16) $carfee = $airport->sixteenseats;
else $carfee = $airport->fourseats;
//$stampfee = $additional->stampprice;
if($extra==1) {$servicefee=0;$privatefee=0;$pakagefee=0;$rushfee=0;}
echo "[".$privatefee.",".$pakagefee.",".$checkinfee.",".$carfee.",".$servicefee.",".$rushfee.",".$vipfee.",".$stampfee."]";
