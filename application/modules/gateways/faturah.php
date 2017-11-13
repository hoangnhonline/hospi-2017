<?php

//Start Faturah Classes

    /*
    * Represents the faturah client 
    *
    * @author Hisham Bin Ateya
    */
    class Faturah{
	   public $merchantCode;
	   public $secureKey;
	   public $token;
	   public $order;
	   public $message;
	   public $hash;
    }
    /*
    * Wapper for Faturah web service
    *
    * @author Hisham Bin Ateya
    */
    class FaturahService{
	   const URL= 'https://Services.faturah.com/TokenGeneratorWS.asmx?wsdl';
	   private static $client;

	   private function __construct(){
		  //self::$client= new SoapClient(self::URL);
	   }
	   
	   public static function call($name,$params)
	   {
		  self::$client= new SoapClient(self::URL);
		  return self::$client->__soapCall($name, $params);
	   }
    }
    /*
    * Utility class that facilitates the communication with other components
    *
    * @author Hisham Bin Ateya
    */
    class FaturahUtility{
	   public static function generateToken($code){
		  $params = array('GenerateNewMerchantToken'=>array('merchantCode'=>$code));
		  return FaturahService::call('GenerateNewMerchantToken', $params)->GenerateNewMerchantTokenResult;
	   }
    
	   public static function isSecureMerchant($code){
		  $params = array('IsSecuredMerchant'=>array("merchantCode"=>$code));
		  return FaturahService::call('IsSecuredMerchant', $params)->IsSecuredMerchantResult;
	   }
    
	   public static function generateSecureHash($message){
		  $params = array('GenerateSecureHash'=>array("message"=>$message));
		  return FaturahService::call('GenerateSecureHash', $params)->GenerateSecureHashResult;
	   }
    
	   public static function constructMessage($key, $code, $token, $order){
		  $productIDs=implode('|', $order->productIDs);
		  $productQuantities=implode('|', $order->productQuantities);
		  $productPrices=implode('|', $order->productPrices);
		  return $key.$code.$token.$order->totalPrice.$order->deliveryCharge.$productIDs.$productQuantities.$productPrices.$order->email.$order->lang;
	   }
	   
	   public static function convertCurrency($from_Currency, $to_Currency='SAR'){
		 	  
		    $amount=1;
		    $amount = urlencode($amount);
			$from_Currency = urlencode($from_Currency);
			$to_Currency = urlencode($to_Currency);

			$url = "http://www.google.com/finance/converter?a=$amount&from=$from_Currency&to=$to_Currency";

			$ch = curl_init();
			$timeout = 0;
			curl_setopt ($ch, CURLOPT_URL, $url);
			curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);

			curl_setopt ($ch, CURLOPT_USERAGENT,
						 "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1)");
			curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
			$rawdata = curl_exec($ch);
			curl_close($ch);
			$data = explode('bld>', $rawdata);
			$data = explode($to_Currency, $data[1]);

			return round($data[0], 2);
		  
		  
	   }
	   
	   public function alert($msg){
		  echo '<script type="text/javascript">alert("'.$msg.'");</script>';
	   }
    }
    /*
    * Represents the customer order 
    *
    * @author Hisham Bin Ateya
    */
    class Order{
	   public $products=array();
	   public $productIDs=array();
	   public $productNames=array();
	   public $productDescriptions=array();
	   public $productQuantities=array();
	   public $productPrices=array();
	   public $deliveryCharge;
	   public $totalPrice;
	   public $customerName;
	   public $date;
	   public $customerEmail;
	   public $customerPhoneNumber;
	   public $lang;
	   
	   function __construct(){
		  $this->date = date('m/d/Y h:i:s A');
		  $this->totalPrice=0;
	   }
	   
	   public function addItem($id, $name, $description, $qunatity, $price){
		  $product=new Product();
		  $product->id=$id;
		  $product->name=$name;
		  $product->description=$description;
		  $product->quantity=$qunatity;
		  $product->price=$price;
		  $this->totalPrice += $product->price*$product->quantity;
		  array_push($this->products, $product);
		  array_push($this->productIDs, $product->id);
		  array_push($this->productNames, $product->name);
		  array_push($this->productDescriptions, $product->description);
		  array_push($this->productQuantities, $product->quantity);
		  array_push($this->productPrices, $product->price);
	   }
    }
    /*
    * Represents the product
    *
    * @author Hisham Bin Ateya
    */
    class Product{
	   public $id;
	   public $name;
	   public $description;
	   public $quantity;
	   public $price;
    }

// End Faturah Classes


function faturah_config() {
	$configarray = array( "FriendlyName" => array( "Type" => "System", "Value" => "Faturah Payment Gateway" ), "merchantCode" => array( "FriendlyName" => "Merchant Code", "Type" => "text", "Size" => "50", "Description" => "" ), "secureKey" => array( "FriendlyName" => "Secure Key", "Type" => "text", "Size" => "50" ), "test" => array( "FriendlyName" => "Test Environment", "Type" => "yesno", "Description" => "Tick to enable test environment" ) );
	return $configarray;
}


function faturah_link($params) {
	

	$faturah = new Faturah();
    $faturah->merchantCode = $params['merchantCode'];//please add merchant code here
    $faturah->secureKey = $params['secureKey'];//please add secure key here
    // Initialize the cutomer orders
    $rate = 1; // Remove the commented line if you are using other than (SAR) FaturahUtility::convertCurrency('USD');
    $order = new Order();
    $order->addItem('1', 'Hotel Name', 'Book Room', '1', 120*$rate);
    $order->deliveryCharge = 0;
    $order->customerName= 'Tên';
    $order->customerEmail= 'test@test.com';
    $order->customerPhoneNumber = '1234567890';
    $order->lang = 'ar';
    $faturah->order=$order;
    $faturah->order->totalPrice+=$order->deliveryCharge;
    $faturah->token = FaturahUtility::generateToken($faturah->merchantCode);   
    // Concatenates the product IDs, names .. etc
    $productIDs = implode('|', $faturah->order->productIDs);
    $productNames = implode('|', $faturah->order->productNames);
    $productDescriptions ='';// implode('|', $faturah->order->productDescriptions);
    $productQuantities = implode('|', $faturah->order->productQuantities);
    $productPrices = implode('|', $faturah->order->productPrices);
    // Constructs the transaction handler url
    $url = sprintf("https://gateway.faturah.com/TransactionRequestHandler.aspx?mc=%s&mt=%s&dt=%s&a=%s&ProductID=%s&ProductName=%s&ProductDescription=%s&ProductQuantity=%s&ProductPrice=%s&DeliveryCharge=%s&CustomerName=%s&EMail=%s&PhoneNumber=%s",$faturah->merchantCode, $faturah->token, $faturah->order->date, $faturah->order->totalPrice, $productIDs, $productNames, $productDescriptions, $productQuantities, $productPrices, $faturah->order->deliveryCharge, $faturah->order->customerName, $faturah->order->customerEmail, $faturah->order->customerPhoneNumber);
    // Checks whether the merchant is secure
    if(FaturahUtility::isSecureMerchant($faturah->merchantCode))
    {
	   $faturah->message = $faturah->secureKey.$faturah->merchantCode.$faturah->token.$faturah->order->totalPrice;
	   $faturah->hash = FaturahUtility::generateSecureHash($faturah->message);
	   //$url .= sprintf("&vpc_SecureHash=%s&securemessage=%s",$faturah->hash,$faturah->message);
	   $url .= "&vpc_SecureHash=".$faturah->hash;
    }
    $target = "";

		$PAY_URL = base_url().'invoice/callGatewayFunc/faturah/payRedirect';
	$code = "<form action=\"" . $PAY_URL . "\" method=\"post\" " . $target . ">
	<input type=\"hidden\" name=\"url\" value=\"".$url."\" />
<input type=\"submit\" class=\"paybtn\" value=\"Pay Now\" />
</form>";

			return $code;



}

function faturah_payRedirect(){
	$url = $_POST['url'];
	header("location: $url");
  // exit($url);
}


function faturah_orderformcheckout($params) {
	$orderid = get_query_val( "tblorders", "id", array( "invoiceid" => $params['invoiceid'] ) );
	update_query( "tblhosting", array( "paymentmethod" => "paypal" ), array( "orderid" => $orderid, "paymentmethod" => "paypalexpress" ) );
	update_query( "tblhostingaddons", array( "paymentmethod" => "paypal" ), array( "orderid" => $orderid, "paymentmethod" => "paypalexpress" ) );
	update_query( "tbldomains", array( "paymentmethod" => "paypal" ), array( "orderid" => $orderid, "paymentmethod" => "paypalexpress" ) );
	$finalPaymentAmount = $_SESSION['Payment_Amount'];
	$postfields = array();
	$postfields['TOKEN'] = $_SESSION['paypalexpress']['token'];
	$postfields['PAYERID'] = $_SESSION['paypalexpress']['payerid'];
	$postfields['PAYMENTREQUEST_0_PAYMENTACTION'] = "SALE";
	$postfields['PAYMENTREQUEST_0_AMT'] = $params['amount'];
	$postfields['PAYMENTREQUEST_0_CURRENCYCODE'] = $params['currency'];
	$postfields['IPADDRESS'] = $_SERVER['SERVER_NAME'];
	$results = faturah_api_call( $params, "DoExpressCheckoutPayment", $postfields );
	$ack = strtoupper( $results['ACK'] );

	if ($ack == "SUCCESS" || $ack == "SUCCESSWITHWARNING") {
		$transactionId = $results['PAYMENTINFO_0_TRANSACTIONID'];
		$transactionType = $results['PAYMENTINFO_0_TRANSACTIONTYPE'];
		$paymentType = $results['PAYMENTINFO_0_PAYMENTTYPE'];
		$orderTime = $results['PAYMENTINFO_0_ORDERTIME'];
		$amt = $results['PAYMENTINFO_0_AMT'];
		$currencyCode = $results['PAYMENTINFO_0_CURRENCYCODE'];
		$feeAmt = $results['PAYMENTINFO_0_FEEAMT'];
		$settleAmt = $results['PAYMENTINFO_0_SETTLEAMT'];
		$taxAmt = $results['PAYMENTINFO_0_TAXAMT'];
		$exchangeRate = $results['PAYMENTINFO_0_EXCHANGERATE'];
		$paymentStatus = $results['PAYMENTINFO_0_PAYMENTSTATUS'];

		if ($paymentStatus == "Completed") {
			return array( "status" => "success", "transid" => $transactionId, "fee" => $feeAmt, "rawdata" => $results );
		}


		if ($paymentStatus == "Pending") {
			return array( "status" => "payment pending", "rawdata" => $results );
		}

		return array( "status" => "invalid status", "rawdata" => $results );
	}

	return array( "status" => "error", "rawdata" => $results );
}


function faturah_api_call($params, $methodName, $postfields) {

	$API_UserName = $params['apiusername'];
	$API_Password = $params['apipassword'];
	$API_Signature = $params['apisignature'];
	$API_Endpoint = ($params['sandbox'] ? "https://api-3t.sandbox.paypal.com/nvp" : "https://api-3t.paypal.com/nvp");
	$postfields['METHOD'] = $methodName;
	$postfields['VERSION'] = 64;//$version;
	$postfields['PWD'] = $API_Password;
	$postfields['USER'] = $API_UserName;
	$postfields['SIGNATURE'] = $API_Signature;
	

	$nvpreq = "";
	foreach ($postfields as $k => $v) {
		$nvpreq .= "" . $k . "=" . urlencode( $v ) . "&";
	}

	
	//setting the curl parameters.
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$API_Endpoint);
		curl_setopt($ch, CURLOPT_VERBOSE, 1);

		//turning off the server and peer verification(TrustManager Concept).
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);

		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_POST, 1);
		

		//setting the nvpreq as POST FIELD to curl
		curl_setopt($ch, CURLOPT_POSTFIELDS, $nvpreq);

		//getting response from server
		$response = curl_exec($ch);

		//convrting NVPResponse to an Associative Array
		$nvpResArray = faturah_deformatNVP($response);
		$nvpReqArray = faturah_deformatNVP($nvpreq);
		//$_SESSION['nvpReqArray'] = $nvpReqArray;

		/*if (curl_errno($ch)) 
		{
			// moving to display page to display curl errors
			  $_SESSION['curl_error_no']=curl_errno($ch) ;
			  $_SESSION['curl_error_msg']=curl_error($ch);

			  //Execute the Error handling module to display errors. 
		} 
		else 
		{
			 //closing the curl
		  	curl_close($ch);
		}*/

		//return $response;
		//return $postfields;
	return faturah_deformatNVP( $response );
	//return $API_UserName;
}


function faturah_deformatNVP($nvpstr) {
	$intial=0;
	 	$nvpArray = array();

		while(strlen($nvpstr))
		{
			//postion of Key
			$keypos= strpos($nvpstr,'=');
			//position of value
			$valuepos = strpos($nvpstr,'&') ? strpos($nvpstr,'&'): strlen($nvpstr);

			/*getting the Key and Value values and storing in a Associative Array*/
			$keyval=substr($nvpstr,$intial,$keypos);
			$valval=substr($nvpstr,$keypos+1,$valuepos-$keypos-1);
			//decoding the respose
			$nvpArray[urldecode($keyval)] =urldecode( $valval);
			$nvpstr=substr($nvpstr,$valuepos+1,strlen($nvpstr));
	     }
		return $nvpArray;
}

//function for verification of payment. It will be used in notify url
function faturah_verifypayment($params, $extraFields = null){

//funciton should return an array of result with status = success/fail, invoiceid, amount paid, transaction id if any 
$result = array("status" => "fail","invoiceid" => "","paid" => 0,"transactionid" => "");

	$postfields = array();
	if(empty($extraFields)){
	$postfields['TOKEN'] = $_SESSION['paypalexpress']['token'];	
}else{
	$postfields['TOKEN'] = $extraFields['token'];
}
	

	

	$results = faturah_api_call( $params, "GetExpressCheckoutDetails", $postfields );
	$ack = strtoupper( $results['ACK'] );

	if ($ack == "SUCCESS" || $ack == "SUCCESSWITHWARNING") {


		$postfields['PAYMENTREQUEST_0_PAYMENTACTION'] = "SALE";
		$postfields['PAYMENTREQUEST_0_AMT'] = $results['PAYMENTREQUEST_0_AMT'];
		$postfields['PAYMENTREQUEST_0_CURRENCYCODE'] = $results['PAYMENTREQUEST_0_CURRENCYCODE'];
		$postfields['IPADDRESS'] = $_SERVER['SERVER_NAME'];

			if(empty($extraFields)){
			$postfields['PAYERID'] = $results['PAYERID'];
			}else{
			$postfields['PAYERID'] = $extraFields['payerid'];
			}

		
		$results2 = faturah_api_call( $params, "DoExpressCheckoutPayment", $postfields );
		$ack2 = strtoupper( $results2['ACK'] );
		
		if($ack2 == "SUCCESS" || $ack2 == "SUCCESSWITHWARNING"){

			$txn_id = $results2['PAYMENTINFO_0_TRANSACTIONID'];
			$transactionType = $results2['PAYMENTINFO_0_TRANSACTIONTYPE'];
			$paymentType = $results2['PAYMENTINFO_0_PAYMENTTYPE'];
			$orderTime = $results2['PAYMENTINFO_0_ORDERTIME'];
			$amt = $results2['PAYMENTINFO_0_AMT'];
			$currencyCode = $results2['PAYMENTINFO_0_CURRENCYCODE'];
			$feeAmt = $results2['PAYMENTINFO_0_FEEAMT'];
			$settleAmt = $results2['PAYMENTINFO_0_SETTLEAMT'];
			$taxAmt = $results2['PAYMENTINFO_0_TAXAMT'];
			$exchangeRate = $results2['PAYMENTINFO_0_EXCHANGERATE'];
			$paymentStatus = $results2['PAYMENTINFO_0_PAYMENTSTATUS'];
			$invoiceid = $params['invoiceid'];

			if ($paymentStatus == "Completed") {

			$result = array("status" => "success","invoiceid" => $invoiceid,"paid" => $amt,"transactionid" => $txn_id);
			return $result;
			}else{

				return $result;
			}

		}else{

			return $results2;

		}
	}else{
			$r = array("Error" => "GetExpressCheckoutDetails", "result" => $results);
			return $results;

		}


}