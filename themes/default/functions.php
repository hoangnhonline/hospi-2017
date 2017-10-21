<?php
 
 //Wish list global function for all modules
if (!function_exists('wishListInfo')) {

 function wishListInfo($module, $id){
 	$inwishlist = pt_isInWishList($module, $id);
 	if($inwishlist){
 	$html = '<div title="'.trans('028').'" data-toggle="tooltip" data-placement="left" id="'.$id.'" data-module="'.$module.'" class="wishlist wishlistcheck '.$module.'wishtext'.$id.' fav"><a  class="tooltip_flip tooltip-effect-1" href="javascript:void(0);"><span class="'.$module.'wishsign'.$id.' fav">-</span></a></div>';
 	}else{
 	$html = '<div  title="'.trans('029').'" data-toggle="tooltip" data-placement="left" id="'.$id.'" data-module="'.$module.'" class="wishlist wishlistcheck '.$module.'wishtext'.$id.'"><a class="tooltip_flip tooltip-effect-1" href="javascript:void(0);"><span class="'.$module.'wishsign'.$id.'">+</span></a></div>';
 	}

 	return $html;

 }

}

//Tours locations part on home page
if (!function_exists('toursWithLocations')) {

 function toursWithLocations(){
 	$phptravelsObj = phpTravelsObj();
 	$toursLib = $phptravelsObj->load->library('tours/tours_lib');
 	$totalLocations = 8;
 	$locationData = $toursLib->toursByLocations($totalLocations);
 	return $locationData;

 }

}

//Tours locations part on home page
if (!function_exists('honeymoonWithLocations')) {

 function honeymoonWithLocations($totalLocations){
 	$phptravelsObj = phpTravelsObj();
 	$hotelLib = $phptravelsObj->load->library('hotels/hotels_lib');
 	//$totalLocations = 6;
 	$locationData = $hotelLib->honeymoonByLocations($totalLocations);
 	return $locationData;

 }

}

//Tours locations part on home page
if (!function_exists('randomTours')) {

 function randomTours(){
 	$phptravelsObj = phpTravelsObj();
 	$toursLib = $phptravelsObj->load->library('tours/tours_lib');
 	$totalLocations = 1;
 	$locationData = $toursLib->librandomTours($totalLocations);
 	return $locationData;

 }

}

//get list of locations
if (!function_exists('getLocations')) {
        function getLocations(){
            $phptravelsObj = phpTravelsObj();
            $toursLib = $phptravelsObj->load->library('tours/tours_lib');
            $locationData = $toursLib->librandomTours($totalLocations);
 	return $locationData;    
        }
}

if (!function_exists('create_slug')) {

		function create_slug($string) {
				
                                $string = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $string);
                                $string = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $string);
                                $string = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $string);
                                $string = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $string);
                                $string = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $string);
                                $string = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $string);
                                $string = preg_replace("/(đ)/", 'd', $string);
                                $string = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'a', $string);
                                $string = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'e', $string);
                                $string = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $string);
                                $string = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'o', $string);
                                $string = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'u', $string);
                                $string = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'y', $string);
                                $string = preg_replace("/(Đ)/", 'd', $string);
                                $string = preg_replace("/(%|&|#|$|(|)|!)/", '', $string);
                                //$string = str_replace(" ", "-", str_replace("&*#39;","",$string));
                                $slug = preg_replace('/[^A-Za-z0-9]+/', '-', $string);
                                $slug = strtolower($slug);
				return $slug;
		}

}
if (!function_exists('hospi_widget')) {

		function hospi_widget() { ?>

<div class="why-widget"><h2 class="main-title go-right andes-bold" style="text-align: center;line-height: 30px;"><div class="waldisney">Why? </div><?php echo trans('0551'); ?></h2>
                    <ul class="why-hospi" style="margin-top: 0;">
                        <li>
                            <?php echo trans('0552'); ?>
                        </li>
                        <li>
                            <?php echo trans('0553'); ?>
                        </li>
                        <li>
                            <?php echo trans('0554'); ?>
                        </li>
                        <li>
                            <?php echo trans('0553'); ?>
                        </li>
                        <li>
                            <?php echo trans('0555'); ?>
                        </li>
                        <li>
                            <?php echo trans('0556'); ?>
                        </li>
                        <li>
                            <?php echo trans('0557'); ?>
                        </li>
                    </ul></div>
                <?php }
}

if (!function_exists('search_hotel_widget')) {

		function search_hotel_widget() { ?>

<div class="search-hotel-widget"><form  class="" action="<?php echo $baseUrl;?>search" method="GET" role="search">
    <div class="go-right">
      <div class="form-group">
        <div class="clearfix"></div>
        <label class="control-label go-right"><i class="icon-location-6"></i><?php echo trans('012');?></label>
        <input id="HotelsPlacesEan" name="city"  type="text" class="form-control RTL search-location" placeholder="<?php echo trans('026');?>" value="<?php if(!empty($_GET['city'])){ echo $_GET['city']; }else{ echo $selectedCity; } ?>" required >
      </div>
    </div>
    <div class="go-right">
      <div class="form-group">
        <div class="clearfix"></div>
        <label class="control-label go-right size13"><i class="icon-calendar-7"></i> <?php echo trans('07');?></label>
        <input type="text" placeholder=" <?php echo trans('07');?>" name="checkIn" class="dpean1 form-control" value="<?php echo $checkin; ?>" required >
      </div>
    </div>
    <div class="go-right">
      <div class="form-group">
        <div class="clearfix"></div>
        <label class="control-label go-right size13"><i class="icon-calendar-7"></i> <?php echo trans('09');?></label>
        <input type="text" class="form-control dpean2" placeholder=" <?php echo trans('09');?>" name="checkOut" value="<?php echo $checkout; ?>" required >
      </div>
    </div>
    <div class="go-right">
      <div class="form-group">
        <div class="clearfix"></div>
        <label class="control-label go-right size13"><i class="icon-user-7"></i> <?php echo trans('010');?></label>
        <select class="RTL form-control" placeholder=" <?php echo trans('');?>"  name="adults">
          <?php for($i = 1; $i <= 9; $i++){ if(empty($adults)){ $adults = 2; } ?>
          <option value="<?php echo $i; ?>" <?php if($i == $adults){ echo "selected"; } ?> ><?php echo $i; ?></option>
          <?php } ?>
        </select>
      </div>
    </div>
    <div class="hidden-md go-right">
      <div class="form-group">
        <div class="clearfix"></div>
        <label class="control-label go-right size13"><i class="icon-user-7"></i> <?php echo trans('011');?></label>
        <select  class="form-control childcount" placeholder=" <?php echo trans('011');?> " name="child" id="child">
          <option value="">0</option>
          <?php for($j = 1; $j <= 3; $j++ ){ ?>
          <option value="<?php echo $j; ?>" <?php if($j == $child){ echo "selected"; } ?> > <?php echo $j; ?> </option>
          <?php } ?>
        </select>
      </div>
    </div>
    <div class="visible-sm visible-xs">
      <div class="clearfix"></div>
    </div>
    <div class="go-right">
      <div class="form-group">
        <div class="clearfix"></div>
        <input name="search" type="hidden" value="1">
        <input type="hidden" name="childages" id="childages" value="<?php echo $childAges; ?>">
        <button style="font-size: 14px;" type="submit" class="btn btn-block btn-action"><?php echo trans('012');?></button>
      </div>
    </div>
    <div class="clearfix"></div>
  </form>
<?php include 'integrations/ean/ages.php'; ?></div>
                <?php }
} 

//Cat chuoi
if (!function_exists('st_substr')) {
function st_substr($str, $length, $minword = 3)
{
    $sub = '';
    $len = 0;
    foreach (explode(' ', $str) as $word)
    {
        $part = (($sub != '') ? ' ' : '') . $word;
        $sub .= $part;
        $len += mb_strlen($part);
        if (mb_strlen($word) > $minword && mb_strlen($sub) >= $length)
        {
            break;
        }
    }
    return strip_tags($sub . (($len < mb_strlen($str)) ? '...' : ''));
}
}

//Get Honeymoon available at time
if (!function_exists('honeymoonAvailable')) {

 function honeymoonAvailable($id){
 	$phptravelsObj = phpTravelsObj();
 	$hotelLib = $phptravelsObj->load->library('hotels/hotels_lib');
 	$honey = $hotelLib->honeymoonBythisTime($id);
 	return $honey;

 }

}

//Get more hotels
if (!function_exists('getmoreHotels')) {

 function getmoreHotels($id){
 	$phptravelsObj = phpTravelsObj();
 	$moreHotels = $phptravelsObj->load->library('hotels/hotels_lib');
 	$more = $moreHotels->loadmoreHotels($id);
 	return $more;

 }

}

//Get more hotels
if (!function_exists('getLocations')) {

 function getLocations(){
 	$phptravelsObj = phpTravelsObj();
 	$locations = $phptravelsObj->load->library('hotels/hotels_lib');
 	$result = $locations->hotelbyLocations();
 	return $result;

 }

}

//Get more hotels
if (!function_exists('getHotels')) {

 function getHotels(){
 	$phptravelsObj = phpTravelsObj();
 	$hotels = $phptravelsObj->load->library('hotels/hotels_lib');
 	$result = $hotels->hotelListings();
 	return $result;

 }

}

//Get more hotels
if (!function_exists('getRoomsID')) {

 function getRoomsID($hotel_id){
 	$phptravelsObj = phpTravelsObj();
 	$rooms = $phptravelsObj->load->library('hotels/hotels_lib');
 	$result = $rooms->roombyHotel($hotel_id);
 	return $result;

 }

}
//Get more hotels
if (!function_exists('is_sales_off_hotel')) {

 function is_sales_off_hotel($hotel_id){
 	$phptravelsObj = phpTravelsObj();
 	$issale = $phptravelsObj->load->library('hotels/hotels_lib');
 	$result = $issale->sales_off_hotel($hotel_id);
 	return $result;

 }

}

//Get recently viewed hotels
if (!function_exists('recentlyViewed')) {

 function recentlyViewed($hotel_id){
 	$phptravelsObj = phpTravelsObj();
 	$recently = $phptravelsObj->load->library('hotels/hotels_lib');
 	$result = $recently->recentlyViewed($hotel_id);
 	return $result;

 }

}


