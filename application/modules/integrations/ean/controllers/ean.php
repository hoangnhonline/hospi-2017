<?php
if (!defined('BASEPATH'))
		exit ('No direct script access allowed');

class Ean extends MX_Controller {
		private $data = array();
		private $city;
		public $cachekey;
		public $numberofresults;
		public $loggedin;
		public $settings = array();
		private $validlang;

		function __construct() {
// $this->session->sess_destroy();
				parent :: __construct();
				$chk = modules :: run('home/is_main_module_enabled', 'ean');
				if (!$chk) {
						Module_404();
				}
				modules :: load('home');
				$this->settings = $this->settings_model->get_front_settings('ean');
				$citydef = $this->settings[0]->front_search_city;
				$this->numberofresults = $this->settings[0]->front_listings;
				$this->load->library("ean_lib");
				$this->load->model("ean_model");
				$this->load->helper("ean_front");
				$this->data['modulelib'] = $this->ean_lib;
				$this->data['app_settings'] = $this->settings_model->get_settings_data();
				$this->data['lang_set'] = $this->session->userdata('set_lang');
				$this->data['user'] = $this->session->userdata('pt_logged_customer');
				$this->data['appModule'] = "ean";
				$this->data['hideLang'] = "hidden";
				$this->data['hideCurr'] = "hidden";
				$this->city = $citydef;
				$languageid = $this->uri->segment(2);
                $this->validlang = pt_isValid_language($languageid);

				$this->data['phone'] = $this->load->get_var('phone');
				$this->data['contactemail'] = $this->load->get_var('contactemail');
				$this->data['geo'] = $this->load->get_var('geolib');
				$defaultlang = pt_get_default_language();
				if (empty ($this->data['lang_set'])) {
						$this->data['lang_set'] = $defaultlang;
				}
				$this->loggedin = $this->session->userdata('pt_logged_customer');
				$this->data['baseUrl'] = base_url().'properties/';
		}

		public function index() {
				$unsetdata = array('customerSessionId' => '', 'activePropertyCount' => '', 'cachekey' => '', 'cacheloc' => '');
				$this->session->unset_userdata($unsetdata);
				$this->data['minprice'] = $this->settings[0]->front_search_min_price;
				$this->data['maxprice'] = $this->settings[0]->front_search_max_price;

				
				$this->data['resultMap'] = $this->__forMap();
				$this->data['selectedCity'] = $this->city;
			/* for request and response */

              /*  echo "<pre>";
                echo $this->ean_lib->apistr."<br>";
				echo print_r($this->data['result']);
				echo "</pre>";
				exit;*/

				//$this->data['result'] = $this->__firstlist();
				$result = $this->__firstlist();
				$this->data['module'] = $result->hotels;
				$this->data['multipleLocations'] = $result->multipleLocations;
				$this->data['locationInfo'] = $result->locationInfo;
				$this->data['moreResultsAvailable'] = $result->moreResultsAvailable;
				$this->data['cacheKey'] = $result->cacheKey;
				$this->data['cacheLocation'] = $result->cacheLocation;


				$cachekey = array();
				$cacheloc = array();
				$cachekey = $this->data['result']['HotelListResponse']['cacheKey'];
				$cacheloc = $this->data['result']['HotelListResponse']['cacheLocation'];

				$cachedata = array('customerSessionId' => $this->data['result']['HotelListResponse']['customerSessionId'], 'activePropertyCount' => $this->data['result']['HotelListResponse']['HotelList']['@activePropertyCount'], 'cachekey' => $cachekey, 'cacheloc' => $cacheloc);
				$this->session->set_userdata($cachedata);
				$this->lang->load("front", $this->data['lang_set']);

				//$this->data['plinks'] = getPaginationEan(site_url('ean/listings'), $this->data['result']['HotelListResponse']['HotelList']['@activePropertyCount'], $this->numberofresults, 1);
				$this->data['currSign'] = $this->ean_lib->currency;
				$this->data['page_title'] = $this->settings[0]->header_title;
				$this->data['metakey'] = $this->settings[0]->meta_keywords;
				$this->data['metadesc'] = $this->settings[0]->meta_description;
				//$this->theme->view('integrations/ean/index', $this->data);
				$this->theme->view('listing', $this->data);
		}

		function listings($offset) {
				$activepcount = $this->session->userdata("activePropertyCount");
				if ($offset == 1) {
						$this->data['result'] = $this->__firstlist();
						$this->data['plinks'] = getPaginationEan(site_url('ean/listings'), $activepcount, $this->numberofresults, $offset);
				}
				else {
						$key = "page" . $offset;
						$next = $offset + 1;
						$nextkey = "page" . $next;
						$ck = $this->session->userdata("cachekey");
						$cl = $this->session->userdata("cacheloc");
						$pInfo['cacheKey'] = $ck[$key];
						$pInfo['cacheLocation'] = $cl[$key];
						$pInfo['customerSessionId'] = $this->session->userdata("customerSessionId");
						$this->data['result'] = $this->ean_lib->HotelListsMore($pInfo);
						$this->data['plinks'] = getPaginationEan(site_url('ean/listings'), $activepcount, $this->numberofresults, $offset);
						$checkkey = array_key_exists($nextkey, $ck);
						if (!$checkkey) {
/*array_push($ck["$nextkey"],$this->data['result']['HotelListResponse']['cacheKey']);

array_push($cl["$nextkey"],$this->data['result']['HotelListResponse']['cacheLocation']);

*/
								$ck[$nextkey] = $this->data['result']['HotelListResponse']['cacheKey'];
								$cl[$nextkey] = $this->data['result']['HotelListResponse']['cacheLocation'];
								$cachedata = array('cachekey' => $ck, 'cacheloc' => $cl);
								$this->session->set_userdata($cachedata);
						}
				}
				$this->lang->load("front", $this->data['lang_set']);
				$this->data['cachekey'] = $this->session->all_userdata();
				$this->data['currSign'] = $this->ean_lib->currency;
				$this->data['page_title'] = $this->settings[0]->header_title;
				$this->data['metakey'] = $this->settings[0]->meta_keywords;
				$this->data['metadesc'] = $this->settings[0]->meta_description;
				$this->theme->view('integrations/ean/index', $this->data);
		}

		function loadMore() {
				$ck = $this->input->post("cacheKey");
				$cl = $this->input->post("cacheLocation");
				$this->data['checkin'] = $this->input->post("checkin");
				$this->data['checkout'] = $this->input->post("checkout");
				$this->data['agesApendUrl'] = $this->input->post("agesappendurl");
				$this->data['adults'] = $this->input->post("adultsCount");
				$Info['cacheKey'] = $ck;
				$Info['cacheLocation'] = $cl;
				$Info['customerSessionId'] = $this->session->userdata("customerSessionId");
				$this->lang->load("front", $this->data['lang_set']);
				$resultData = $this->ean_lib->HotelListsMore($Info);

				$result = $this->getResultInObjects($resultData,$this->data['checkin'],$this->data['checkout'],$this->data['adults'],$this->data['agesApendUrl']);
				
				$this->data['multipleLocations'] = $result->multipleLocations;
				$this->data['locationInfo'] = $result->locationInfo;
				$this->data['moreResultsAvailable'] = $result->moreResultsAvailable;
				$this->data['cacheKey'] = $result->cacheKey;
				$this->data['cacheLocation'] = $result->cacheLocation;
				$this->data['module'] = $result->hotels;
				//$this->data['result'] = $this->ean_lib->HotelListsMore($Info);  
				
				$this->theme->partial('integrations/ean/morehotels', $this->data);
		}

		function search($offset = null) {
				$search = $this->input->get('search');
				if (!empty ($search)) {
						$this->data['checkin'] = trim($_GET['checkIn']);
						$this->data['checkout'] = trim($_GET['checkOut']);
						$this->data['minprice'] = $this->settings[0]->front_search_min_price;
				        $this->data['maxprice'] = $this->settings[0]->front_search_max_price;


						if (empty ($offset)) {
// print_r($_POST);
								$arrayInfo["city"] = trim(str_replace("-", ",", $_GET['city']));
								//$tempCity[] = strtok($arrayInfo["city"], " ,-");
								$arrayInfo["destinationId"] = trim($_GET['destinationId']);
								//$arrayInfo["city"] = $tempCity[0];
// $arrayInfo['countryCode'] = 'IN';
								$arrayInfo['checkIn'] = trim($_GET['checkIn']);
// $arrayInfo['checkIn'] = "18-08-2014";
								$arrayInfo['checkOut'] = trim($_GET['checkOut']);
								$childAges = $this->input->get('childages');
								//$childCount = 0;
								$childAgesStr = "";
								if(!empty($childAges)){
								//$childCount =  count(explode(",",$childAges));
								$childAgesStr = ",".$childAges;
								}

								$adults = $this->input->get("adults");
								$this->data['propertyCategory'] = $_GET['propertyCategory'];
								$adultString = $adults.$childAgesStr;

								$this->data['adults'] = $adults;
								//$this->data['child'] = $childCount;
								$this->data['child'] = $this->input->get('child');
								$this->data['childAges'] = $childAges;
								if($this->data['child'] > 0){
									$this->data['agesApendUrl'] = '&ages='.$childAges;
								}else{
									$this->data['agesApendUrl'] = '';
								}


								$arrayInfo['rooms'] = "room1=$adultString";
								$arrayInfo['numberOfResult'] = $this->settings[0]->front_search;
								if(!empty($this->data['propertyCategory'])){
									$propertyCat = implode(",",$this->data['propertyCategory']);
									$arrayInfo['propertyCategory'] = $propertyCat;

								}

$arrayInfo['maxStarRating']= $this->input->get('stars');
$arrayInfo['minStarRating']= $this->input->get('stars');
$sprice = $this->input->get('price');
if (!empty ($sprice)) {
						$sprice = str_replace(";", ",", $sprice);
						$sprice = explode(",", $sprice);
						$minp = $sprice[0];
						$maxp = $sprice[1];
						$arrayInfo['minRate'] = $minp;
						$arrayInfo['maxRate'] = $maxp;
				}
								$resultData = $this->ean_lib->HotelLists($arrayInfo);

								$result = $this->getResultInObjects($resultData,$this->data['checkin'],$this->data['checkout'],$adultString,$this->data['agesApendUrl']);
								$this->data['module'] = $result->hotels;
								$this->data['multipleLocations'] = $result->multipleLocations;
								$this->data['locationInfo'] = $result->locationInfo;
								$this->data['moreResultsAvailable'] = $result->moreResultsAvailable;
								$this->data['cacheKey'] = $result->cacheKey;
								$this->data['cacheLocation'] = $result->cacheLocation;

								$cachedata = array('customerSessionId' => $this->data['result']['HotelListResponse']['customerSessionId'], 'activePropertyCount' => $this->data['result']['HotelListResponse']['HotelList']['@activePropertyCount'], 'cachekey' => $cachekey, 'cacheloc' => $cacheloc);
								$this->session->set_userdata($cachedata);
						}

				}
				else {
						$this->data['result'] = array();
				}
				$this->lang->load("front", $this->data['lang_set']);
				$this->data['page_title'] = 'Search';
				$this->data['currSign'] = $this->ean_lib->currency;

				$this->theme->view('listing', $this->data);
		}

		function __firstlist() {
				$checkin = date("m/d/Y", strtotime("+1 days"));
				$checkout = date("m/d/Y", strtotime("+2 days"));
				$this->data['checkin'] = $checkin;
				$this->data['checkout'] = $checkout;
				$adults = 2;
				$this->data['adults'] = $adults;
				$arrayInfo["city"] = $this->city;
				$arrayInfo['checkIn'] = trim($checkin);
				$arrayInfo['checkOut'] = trim($checkout);
				$arrayInfo['rooms'] = "room1=$adults";
				$arrayInfo['numberOfResult'] = $this->numberofresults;
				$result = $this->ean_lib->HotelLists($arrayInfo);
				return $this->getResultInObjects($result,$checkin,$checkout,$adults);
		}

		function __forMap() {

				$checkin = date("m/d/Y", strtotime("+1 days"));
				$checkout = date("m/d/Y", strtotime("+2 days"));
				$this->data['checkin'] = $checkin;
				$this->data['checkout'] = $checkout;
				$adults = 2;
				$this->data['adults'] = $adults;
				$arrayInfo["city"] = $this->city;
				$arrayInfo['checkIn'] = trim($checkin);
				$arrayInfo['checkOut'] = trim($checkout);
				$arrayInfo['rooms'] = "room1=$adults";
				$arrayInfo['numberOfResult'] = 50;
				return $this->ean_lib->HotelLists($arrayInfo);
		}

		public function hotel($hotelId, $customerSessionId) {
			$module = new stdClass;

			$isValidLang = pt_isValid_language($hotelId);
			$surl = http_build_query($_GET);
			if($isValidLang){
				$currLang = $hotelId;
            	$hotelId = $this->uri->segment(4);
            	$customerSessionId = $this->uri->segment(5);
            	redirect($this->data['baseUrl']."hotel/".$hotelId."/".$customerSessionId.'?'.$surl,'refresh');
                }else{
                	$currLang = $this->data['lang_set'];

                }


				$arrayInfo['hotelId'] = $hotelId;
				$arrayInfo['customerSessionId'] = $customerSessionId;
				$result = $this->ean_lib->HotelDetails($arrayInfo);

				$this->data['module'] = $this->getHotelDetailsObject($hotelid, $result);
				$this->data['lowestPrice'] = $this->data['module']->lowRate;
				$this->data['currencySign'] = $this->ean_lib->currency;

				$checkinDate = trim($this->input->get('checkin'));
				$checkoutDate = trim($this->input->get('checkout'));
				if(empty($checkinDate)){
					$checkinDate = date("m/d/Y", strtotime("+1 days"));

				}

				if(empty($checkoutDate)){
					$checkoutDate = date("m/d/Y", strtotime("+2 days"));
				}

				$arrayInfo['checkIn'] = $checkinDate;
				$arrayInfo['checkOut'] = $checkoutDate;
				$childAges = $this->input->get('ages');
				$this->data['childAges'] = $childAges;
				if(!empty($childAges)){
					$ages = ",".$childAges;
				}else{
					$ages = "";
				}

				$adultsCount = $this->input->get('adults');
				if(empty($adultsCount)){
					$adultsCount = 2;
				}

				$this->data['adultsCount'] = $adultsCount;

				if(!empty($childAges)){
				$this->data['childCount'] = count(explode(",",$childAges));

				}
				$adults = $this->input->get('adults');
				$arrayInfo['rooms'] = "room1=$adults";

				$this->data['hotelid'] = $hotelId;
				$this->data['sessionid'] = $customerSessionId;
				$this->data['HotelInfo'] = $result['HotelInformationResponse'];
				//$this->data['HotelSummary'] = $result['HotelInformationResponse']['HotelSummary'];
				//$this->data['HotelDetails'] = $result['HotelInformationResponse']['HotelDetails'];
				//$this->data['HotelImages'] = $result['HotelInformationResponse']['HotelImages'];
				$this->data['thumbnailImage'] = str_replace("_t", "_b", $this->data['module']->sliderImages['0']['thumbnailUrl']);
				$this->session->set_userdata('hotelThumb', $this->data['thumbnailImage']);

				//$this->data['Facilities'] = $result['HotelInformationResponse']['RoomTypes']['RoomType']['0']['roomAmenities']['RoomAmenity'];
				//$this->data['relatedHotels'] = $this->ean_lib->getRelatedHotels($this->data['HotelSummary']['city']);
				$related = $this->ean_lib->getRelatedHotels($this->data['module']->location);
				if(!empty($related->hotels)){
					$this->data['module']->relatedItems = $related->hotels;
				}

				$roomresponse = $this->ean_lib->HotelRoomAvailability($arrayInfo);


				$roomsInfo = $roomresponse['HotelRoomAvailabilityResponse'];
				$roomsData = $this->getRoomsObject($roomsInfo);
				$this->data['hasRooms'] = $roomsData->hasRooms;
				$this->data['checkInInstructions'] = $roomsData->checkInInstructions;
				$this->data['specialCheckInInstructions'] = $roomsData->specialCheckInInstructions;
		

				/* For Room Availability Request and Response */

              /*  echo "<pre>";
                echo $this->ean_lib->apistr."<br>";
                print_r($roomsInfo);
                echo "</pre>";
                exit;*/

				$this->data['loggedin'] = $this->loggedin;

				$this->data['rooms'] = $roomsInfo['HotelRoomResponse'];

				$this->data['maxAdults'] = $roomsInfo['HotelRoomResponse'][0]['rateOccupancyPerRoom'];

				$this->data['checkin'] = $checkinDate; //$roomsInfo['arrivalDate'];
				$this->data['checkout'] = $checkoutDate; //$roomsInfo['departureDate'];


				$this->data['apistr'] = $this->ean_lib->apistr;
				$this->lang->load("front", $currLang);
				$this->data['page_title'] = $this->data['module']->title;

				$this->data['langurl'] = $this->data['baseUrl']."hotel/{langid}/".$hotelId."/".$customerSessionId.'?'.$surl;
				$this->theme->view('details', $this->data);
		}

		public function reservation(){



				$isguest = $this->input->get('user');
				$this->data['affiliateConfirmationId'] = $this->setAffliateConfirmation();



				$user = $this->data['user'];

				if($isguest == "guest"){

				}elseif($isguest == "register"){
					unset($_GET['user']);

					$url = http_build_query($_GET);

					redirect('register?' . $url);

				}else{

				if(empty($this->loggedin)){
					unset($_GET['user']);

					$url = http_build_query($_GET);
						redirect('login?' . $url);
				}

				}

				$this->load->model('admin/countries_model');
				$this->data['allcountries'] = $this->countries_model->get_all_countries();
				$pay = $this->input->post('pay');
				$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
				$this->form_validation->set_rules('firstName', 'Tên', 'trim');
				$this->form_validation->set_rules('lastName', 'Họ', 'trim');
				$this->form_validation->set_rules('policy', 'Cancellation Policy', 'required');
				$this->form_validation->set_rules('address', 'Address', 'trim');
				$this->form_validation->set_rules('cvv', 'CVV', 'trim');
				$this->form_validation->set_rules('cardno', 'Card Number', 'trim');
				$this->form_validation->set_rules('province', 'State', 'trim');
				$this->form_validation->set_rules('postalcode', 'Postal Code', 'trim');
				$this->form_validation->set_rules('phone', 'Phone', 'trim');
				if (!empty ($pay)) {


						$this->form_validation->run();
						$this->data['result'] = $this->ean_lib->HotelRoomReservation();

						/* For Room Reservation Request and Response */

						/*echo "<pre>";
						echo "https://book.api.ean.com/ean-services/rs/hotel/v3/res? <br>";
						print_r($this->data['result']);
						echo "</pre>";
						exit;*/

						$error = $this->data['result']->HotelRoomReservationResponse->EanWsError;
						$bookresponse = $this->data['result']->HotelRoomReservationResponse;

						$bookresponse->affiliateConfirmationId = $this->input->post('affiliateConfirmationId');
						if (!empty ($error)) {
								$itid = $this->data['result']->HotelRoomReservationResponse->EanWsError->itineraryId;
								$confirmation = "";
								$this->data['msg'] = $error->presentationMessage;
								//$this->data['msg'] = print_r($this->data['result']->HotelRoomReservationResponse);
								$this->data['result'] = "fail";
						}
						else {
								$itid = $this->data['result']->HotelRoomReservationResponse->itineraryId;



								$confirmation = $this->data['result']->HotelRoomReservationResponse->confirmationNumbers;
								$this->data['itineraryID'] = $itid;
								$this->data['confirmationNumber'] = $confirmation;
								$this->data['checkInInstructions'] = $this->data['result']->HotelRoomReservationResponse->checkInInstructions;
								$this->data['nonRefundable'] = $this->data['result']->HotelRoomReservationResponse->nonRefundable;
								$this->data['cancellationPolicy'] = $this->data['result']->HotelRoomReservationResponse->cancellationPolicy;
                                $totalCharge = $this->data['result']->HotelRoomReservationResponse->RateInfo->ConvertedRateInfo;
                                if(empty($totalCharge)){
                                $totalCharge = $this->data['result']->HotelRoomReservationResponse->RateInfo->ChargeableRateInfo;
								}

                                $total = (array)$totalCharge;
								$this->data['grandTotal'] = $total['@total'];
								$this->data['currency'] = $this->ean_lib->currency;
								$this->data['surchargeTotal'] = $total['@surchargeTotal'];
								$this->data['nightlyRateTotal'] = $total['@nightlyRateTotal'];



								$this->data['msg'] = trans("0336");
								//$this->data['msg'] = $this->data['msg'] = print_r($this->data['result']->HotelRoomReservationResponse);
								if(!empty($confirmation)){
									$this->data['result'] = "success";

								}else{
									$this->data['result'] = "fail";
								}

						}
						if ($itid > 1 && !empty($confirmation)) {
								$totalamount = $this->input->post('total');
								if($isguest == "guest"){

									$user = $this->ean_model->eanSignup_account($this->input->post());
								}

								$insertdata = array('user' => $user, 'checkin' => $this->input->post('checkin'), 'checkout' => $this->input->post('checkout'), 'hotel' => $this->input->post('hotel'), 'thumbnail' => $this->input->post('thumbnail'), 'location' => $this->input->post('location'),'stars' => $this->input->post('hotelstars'),'hotelname' => $this->input->post('hotelname'), 'roomname' => $this->input->post('roomname'), 'roomtotal' => $this->input->post('roomtotal'), 'tax' => $this->input->post('tax'), 'total' => $totalamount, 'email' => $this->input->post('email'), 'itineraryid' => $itid, 'confirmation' => $confirmation, 'nights' => $this->input->post('nights'),'currency' => $this->input->post('currency'),'bookResponse' => json_encode($bookresponse));
								$this->ean_model->insert_booking($insertdata);

								$this->db->where('book_itineraryid',$itid);
							    $res = $this->db->get('pt_ean_booking')->result();
							    $rrr = json_decode($res[0]->book_response);
								$arrKeys = array();
								$arrVals = array();
                                $surrInfo = $rrr->RateInfo->ConvertedRateInfo;
                                if(empty($surrInfo)){
                                $surrInfo = $rrr->RateInfo->ChargeableRateInfo;
                                }


								$surchargesArray = (array)$surrInfo->Surcharges->Surcharge;

								
								foreach($surchargesArray as $s){

								foreach($s as $key => $val){
								if($key == "@type"){
								$arrKeys[] = $val;
								}elseif($key == "@amount"){
								$arrVals[] = $val;
								}

								}

								}

								$surchargeTypes = array_combine($arrKeys,$arrVals);



								$this->data['SalesTax'] = $surchargeTypes['SalesTax'];
								$this->data['HotelOccupancyTax'] = $surchargeTypes['HotelOccupancyTax'];
								$this->data['TaxAndServiceFee'] = $surchargeTypes['TaxAndServiceFee'];




						}
				}
				$this->data['checkin'] = $this->input->get('checkin');
				$this->data['checkout'] = $this->input->get('checkout');
				$arrayInfo['hotelId'] = $this->input->get('hotel');
				$arrayInfo['customerSessionId'] = $this->input->get('sessionid');
				$arrayInfo['checkIn'] = trim($this->input->get('checkin'));
				$arrayInfo['checkOut'] = trim($this->input->get('checkout'));
				$arrayInfo['roomTypeCode'] = $this->input->get('roomtype');

				$dateRanges = $this->date_range($this->data['checkin'], $this->data['checkout']);

				$arrayInfo['rateKey'] = $this->input->get('ratekey');
				$arrayInfo['rateCode'] = $this->input->get('ratecode');
				$adults = $this->input->get('adults');
				$arrayInfo['rooms'] = "room1=$adults";
				$result = $this->ean_lib->HotelDetails($arrayInfo);
				$roomresponse = $this->ean_lib->HotelRoomAvailability($arrayInfo);

				$paymenttypes = $this->ean_lib->paymentinfo($arrayInfo);

				$hotelFees = $roomresponse['HotelRoomAvailabilityResponse']['HotelRoomResponse']['RateInfos']['RateInfo']['HotelFees'];
				$hotelFeeCount = $hotelFees['@size'];
                $hotelFeesArray = array();
                if($hotelFeeCount > 1){
                  foreach($hotelFees['HotelFee'] as $hfee){
                    $hotelFeesArray[][$hfee['@description']] = $hfee['@amount'];
                  }

                }else{
                 $hotelFeesArray[$hotelFees['HotelFee']['@description']] = $hotelFees['HotelFee']['@amount'];
                }


				$hotelFeeDesc = $hotelFees['HotelFee']['@description'];
			    if($hotelFeeDesc == "MandatoryTax" || $hotelFeeDesc == "MandatoryFee"){
				$this->data['hotelCharges'] = $hotelFees['HotelFee']['@amount'];
				}else{
				$this->data['hotelCharges'] = "";
				}

				$this->data['childCount'] =  $roomresponse['HotelRoomAvailabilityResponse']['HotelRoomResponse']['RateInfos']['RateInfo']['RoomGroup']['Room']['numberOfChildren'];

				$this->data['adultCount'] = $roomresponse['HotelRoomAvailabilityResponse']['HotelRoomResponse']['RateInfos']['RateInfo']['RoomGroup']['Room']['numberOfAdults'];

				$this->data['childAges'] =  $roomresponse['HotelRoomAvailabilityResponse']['HotelRoomResponse']['RateInfos']['RateInfo']['RoomGroup']['Room']['childAges'];
		

		/* For Payment Types Request and Response */

                /*echo "<pre>";
                echo $this->ean_lib->apistr."<br>";
                print_r($paymenttypes);
                echo "</pre>";
                exit;*/
				$this->data['payment'] = $paymenttypes['HotelPaymentResponse']['PaymentType'];
				$this->data['room'] = $roomresponse['HotelRoomAvailabilityResponse'];
				$this->data['roomsCount'] = count($this->data['room']['HotelRoomResponse']['RateInfos']['RateInfo']['RoomGroup']);

				$this->data['nonRefundable'] = $roomresponse['HotelRoomAvailabilityResponse']['HotelRoomResponse']['RateInfos']['RateInfo']['nonRefundable'];
				$this->data['cancelpolicy'] = $roomresponse['HotelRoomAvailabilityResponse']['HotelRoomResponse']['RateInfos']['RateInfo']['cancellationPolicy'];
				$this->data['roomname'] = $this->data['room']['HotelRoomResponse']['rateDescription'];
				$this->data['nights'] = $this->data['room']['HotelRoomResponse']['RateInfos']['RateInfo']['ChargeableRateInfo']['NightlyRatesPerRoom']['@size'];
                
				$ratesBreakDown = $this->data['room']['HotelRoomResponse']['RateInfos']['RateInfo']['ChargeableRateInfo']['NightlyRatesPerRoom']['NightlyRate'];


				$perNightRate = array();
				if($this->data['nights'] > 1){
				foreach($ratesBreakDown as $rate){
				$perNightRate[] = $rate['@rate'];	
				}	
				}else{

				$perNightRate[] = $ratesBreakDown['@rate'];	

				}



				$this->data['pricesNightByNight'] = array_combine($dateRanges, $perNightRate);

                $rateInfo = $this->data['room']['HotelRoomResponse']['RateInfos']['RateInfo']['ConvertedRateInfo'];
                if(empty($rateInfo)){
                $rateInfo = $this->data['room']['HotelRoomResponse']['RateInfos']['RateInfo']['ChargeableRateInfo'];
                }

                $this->data['total'] = round($rateInfo['@total'], 2);
				$surchargesArray = $rateInfo['Surcharges']['Surcharge'];
				$this->data['tax'] = round($rateInfo['@surchargeTotal'], 2);



				$arrKeys = array();
				$arrVals = array();

				foreach($surchargesArray as $s){

				foreach($s as $key => $val){
				if($key == "@type"){
				$arrKeys[] = $val;
				}elseif($key == "@amount"){
				$arrVals[] = $val;
				}

				}

				}

				$surchargeTypes = array_combine($arrKeys,$arrVals);

				$this->data['SalesTax'] = $surchargeTypes['SalesTax'];
				$this->data['HotelOccupancyTax'] = $surchargeTypes['HotelOccupancyTax'];
				$this->data['ExtraPersonFee'] = $surchargeTypes['ExtraPersonFee'];

				$this->data['currency'] = $rateInfo['@currencyCode'];
				$this->data['roomtotal'] = round($rateInfo['@nightlyRateTotal'], 2);
				$this->data['HotelSummary'] = $result['HotelInformationResponse']['HotelSummary'];
				$this->data['HotelImages'] = $result['HotelInformationResponse']['HotelImages'];
				$this->data['checkInInstructions'] =  $this->data['room']['checkInInstructions'];
				$stars = $this->data['HotelSummary']['hotelRating'];
				if($stars < 1){
					$stars = 1;
				}
				$this->data['hotelStars'] = $stars;
				$this->data['module'] = (object)array('title' =>  $this->data['HotelSummary']['name'],'location' => $this->data['HotelSummary']['city'],
											'stars' => pt_create_stars($stars),'thumbnail' => $this->data['HotelImages']['HotelImage'][0]['url']);
				

				/*echo "<pre>";
				print_r($this->data['room']);
				echo "</pre>";*/


				if (!empty ($submit)) {
						$this->data['paid'] = "Payment made";
				}

				/*if($_GET['test'] == 1){
                echo "<pre>";
                print_r($this->data['room']['HotelRoomResponse']);
                echo "</pre>";
                exit;
                }*/

				$this->load->model('admin/accounts_model');
				$loggedin = $this->loggedin;
                $this->data['profile'] = $this->accounts_model->get_profile_details($loggedin);
                $this->lang->load("front", $this->data['lang_set']);
				$this->data['page_title'] = $this->data['HotelSummary']['name'];
				//$this->theme->view('integrations/ean/booking', $this->data);
				$this->theme->view('booking', $this->data);
		}

		function cancel() {
				$id = $this->input->post('id');
				$data = $this->ean_model->get_single_booking($id);
				$bookid = $data[0]->book_id;
				$itenid = $data[0]->book_itineraryid;
				$conf = $data[0]->book_confirmation;
				$email = $data[0]->book_email;
				$currency = $data[0]->book_currency;
				$arrayinfo = array("confirmationnumber" => $conf, "itineraryid" => $itenid, "email" => $email,"currency" => $currency);
				$retdata = $this->ean_lib->HotelRoomCancellation($arrayinfo);

				if (!empty ($retdata['HotelRoomCancellationResponse']['EanWsError'])) {

						echo $retdata['HotelRoomCancellationResponse']['EanWsError']['presentationMessage'];
				}
				else {
					    $cancelnumber = $retdata['HotelRoomCancellationResponse']['cancellationNumber'];
						$this->ean_model->cancel_my_booking($id, $cancelnumber);
						echo "success";
				}

		}


		function maps($lat , $long, $title) {
				if (empty ($lat) || empty ($long)) {
						Error_404();
				}
				else {
					$link = "#";
					$img = $this->session->userdata('hotelThumb');

						pt_show_map($lat, $long, '100%', '100%', $title, $img, 80, 80, $link);
				}
		}

		public function setAffliateConfirmation(){
			$this->db->select('book_id');
			$this->db->order_by('book_id','desc');
			$res = $this->db->get('pt_ean_booking')->result();
			if(!empty($res)){
				$bookid = $res[0]->book_id + 1;
			}else{
				$bookid = 1;
			}

			$rand = rand(1,999);

			return "-".$rand."-".$bookid;

		}

		public function getResultInObjects($result,$checkin = null, $checkout = null,$adults = null,$agesApendUrl = null){
			$response = new stdClass;
			$response->multipleLocations =  $result['HotelListResponse']['LocationInfos']['@size'];
			$response->locations = $result['HotelListResponse']['LocationInfos']['LocationInfo'];
			$response->totalCounts = $result['HotelListResponse']['HotelList']['@size'];
			$response->moreResultsAvailable = $result['HotelListResponse']['moreResultsAvailable'];
			$response->cacheKey = $result['HotelListResponse']['cacheKey'];
			$response->cacheLocation = $result['HotelListResponse']['cacheLocation'];

			if(!empty($response->locations)){
			$getvars = $_GET;
			foreach($response->locations as $loc){
			$getvars['city'] = $loc['city'];
			$getvars['destinationId'] = $loc['destinationId'];

			$link = $this->data['baseUrl'].'search?'.http_build_query($getvars);
			$href = "<a href=$link>".$loc['city']." - ".$loc['countryName']."</a>";

			$response->locationInfo[] = (object)array('city' => $loc['city'],'destinationId' => $loc['destinationId'],'link' => $href);

			}
			}

			if(empty($result['HotelListResponse']['EanWsError'])){
			foreach($result['HotelListResponse']['HotelList']['HotelSummary'] as $rs){
				$thumbnail = str_replace("_t","_b",$rs['thumbNailUrl']);
				$shortDesc = html_entity_decode($rs['shortDescription']);
				$tripAdvisorRating = $rs['tripAdvisorRatingUrl'];
				$stars =  $rs['hotelRating'];
				if($stars < 1){
					$stars = 1;
				}
				
				$slug = $this->data['baseUrl'].'hotel/'.$rs['hotelId'].'/'.$result['HotelListResponse']['customerSessionId'].'?adults='.$adults.'&checkin='.$checkin.'&checkout='.$checkout.$agesApendUrl;
				$response->hotels[] = (object)array('id' => $rs['hotelId'], 'title' => $rs['name'],'thumbnail' => "https://images.travelnow.com".$thumbnail,
					'slug' => $slug,'currCode' => $rs['rateCurrencyCode'],'price' =>$rs['lowRate'],'location' => $rs['city'],'longitude' => $rs['longitude'],
					'latitude' => $rs['latitude'],'desc' => strip_tags($shortDesc), 'stars' => pt_create_stars($stars),'tripAdvisorRatingImg' => $tripAdvisorRating,'tripAdvisorRating' => $stars
					);
			}

			
			}

			return $response;
		}

		public function getHotelDetailsObject($hotelid, $result){
			$response = new stdClass;
			$resultData = $result['HotelInformationResponse'];
			$hotelSummary = $resultData['HotelSummary'];
			$hotelDetails = $resultData['HotelDetails'];
			$amenities = $resultData['RoomTypes']['RoomType']['0']['roomAmenities']['RoomAmenity'];
			$images = $resultData['HotelImages']['HotelImage'];

			if($hotelSummary['hotelRating'] < 1){ $hrating = 1;	}else{ $hrating = $hotelSummary['hotelRating'];    }


			$response->id =  $hotelid;
			$response->title =  $hotelSummary['name'] ;
			$response->desc =  html_entity_decode(strip_tags($hotelDetails['propertyDescription']));
			$response->location =  $hotelSummary['city'] ;
			$response->lowRate =  $hotelSummary['lowRate'] ;
			$response->hotelAddress =  $hotelSummary['locationDescription'] ;
			$response->latitude =  $hotelSummary['latitude'] ;
			$response->longitude =  $hotelSummary['longitude'];
			$response->policy =  html_entity_decode($hotelDetails['hotelPolicy']);
			$response->stars =  pt_create_stars($hrating);
			if(!empty($amenities)){
				foreach($amenities as $amt){
					$response->amenities[] = (object)array('name' => character_limiter(ucwords($amt['amenity']),22));
				}
			}

			if(!empty($images)){
				foreach($images as $img){
					$response->sliderImages[] = array('fullImage' => str_replace("_b", "_z",$img['url']), 'thumbImage' => $img['thumbnailUrl']);
				}
			}
	

			return $response;
		}

		public function getRoomsObject($result){
			$response = new stdClass;

			$response->specialCheckInInstructions =  $result['specialCheckInInstructions'];
			$response->checkInInstructions =  $result['checkInInstructions'];
			$rooms =  $result['HotelRoomResponse'];

			if(!empty($rooms)){
				$response->hasRooms = TRUE;
			}else{
				$response->hasRooms = FALSE;
			}
	

			return $response;
		}

		function date_range($first, $last, $step = '+1 day', $output_format = 'F j, Y' ) {

    $dates = array();
    $current = strtotime($first);
    $last = strtotime($last);

    while( $current < $last ) {

        $dates[] = date($output_format, $current);
        $current = strtotime($step, $current);
    }

    return $dates;
}


function itin(){
  
  $itID = $_GET['itID'];
  $email = $_GET['email'];
  $response = $this->ean_lib->itinRequestResp($itID,$email);
  echo "Request: ".$this->ean_lib->apistr."<br>";
  echo "<pre>";
  print_r($response);
  echo "</pre>";
}


}