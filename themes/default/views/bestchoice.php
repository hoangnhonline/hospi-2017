<script type="text/javascript" src="<?php echo $theme_url; ?>plugins/jslider/js/jshashtable-2.1_src.js"></script>
<script type="text/javascript" src="<?php echo $theme_url; ?>plugins/jslider/js/jquery.numberformatter-1.2.3.js"></script>
<script type="text/javascript" src="<?php echo $theme_url; ?>plugins/jslider/js/tmpl.js"></script>
<script type="text/javascript" src="<?php echo $theme_url; ?>plugins/jslider/js/jquery.dependClass-0.1.js"></script>
<script type="text/javascript" src="<?php echo $theme_url; ?>plugins/jslider/js/draggable-0.1.js"></script>
<script type="text/javascript" src="<?php echo $theme_url; ?>plugins/jslider/js/jquery.slider.js"></script>
<link rel="stylesheet" href="<?php echo $theme_url; ?>plugins/jslider/css/jslider.css" type="text/css">
<link rel="stylesheet" href="<?php echo $theme_url; ?>plugins/jslider/css/jslider.round.css" type="text/css">
<?php if($appModule == "offers"){ ?>
<div class="container offer-banners">
<div id="carousel-banner" class="carousel slide" data-ride="carousel">
 
 
  <!-- Wrapper for slides -->
 <div class="carousel-inner">
<?php //$str = run_widget(82);
//preg_match('~{p}([^{]*){/p}~i', $str, $match);
//var_dump($match[1]); 
$input = get_widget_content(82);
preg_match_all('/<img[^>]+>/i',$input, $result); 
//print_r($result);
$i=0;
foreach($result[0] as $img) 
  { 
    if($i==0) {
    echo "<div class='item active'>";
    } else {
    echo "<div class='item'>";
    }
      echo $img;
    echo "</div>";
    $i++;
}

?>
     </div>
      <!-- Indicators -->
  <ol class="carousel-indicators">
      <?php $total = count($result[0]);?>
      <?php for($j=0;$j<$total;$j++) {
          if($j==0) {
              echo "<li data-target='#carousel-banner' data-slide-to='".$j."' class='active'></li>";
          }
          else {
              echo "<li data-target='#carousel-banner' data-slide-to='".$j."'></li>";
          }
      }
   ?>
  </ol>
 </div><!-- Carousel -->

<?php } ?>
<div class="clearfix"></div>
<div class="offer-banner-bottom">
    <div class="col-xs-12 col-sm-3 col-lg-3"></div>
    <div class="col-xs-12 col-sm-3 col-lg-3"><span class="khuyen-mai"><a href="<?php echo base_url();?>offers/sales"><?php echo trans('0558'); ?></a></span></div>
    <div class="col-xs-12 col-sm-3 col-lg-3"><span class="bestchoice"><a class="active" class="" href=""><?php echo trans('0559'); ?></a></span></div>
    <div class="col-xs-12 col-sm-3 col-lg-3"><span class="deals"><a href="<?php echo base_url();?>offers"><?php echo trans('0580'); ?></span></a></div>
</div>
</div>

<!-- CONTENT -->
<div class="collapse" id="collapseMap">
  <div id="map" class="map"></div>
  <br>
</div>
<div class="container pagecontainer offset-0">
  <div class="clearfix"></div>
  <?php if($appModule == "offers"){ ?>
    <!-- Widgets for offers list page -->
       <div class="clearfix"></div>
      <div class="col-md-3 go-right">
      <?php //echo run_widget(63); ?>
      <?php echo hospi_widget();?>
       </div>
    <!-- End Widgets for offers list page -->

   <?php } ?>
  
  <div class="visible-xs"><br><br></div>
  <!-- LIST CONTENT-->
  <div class="offer-page rightcontent col-md-9 offset-0">
    <div class="itemscontainer offset-1">
        <div class="offset-2">
            <h1 class="h1-offers"><?php echo trans('0594'); ?></h1>
            <hr style="margin-top: 10px; margin-bottom: 10px;">
            <div class="gray-txt opensans"><?php echo trans('0595'); ?></div>
            <div style="margin-top:30px"></div>
            <?php echo trans('0596'); ?>
            <form name="itemlist" id="itemlist" action="" method="post">
                <i class="fa fa-check" aria-hidden="true"></i>
            <select id="location" name="location" onchange="submitform();">
                <option value=""><?php echo trans('0690'); ?></option>
                <?php $location = getLocations();
                $selected = "";
                foreach($location as $loc){
                    if($_GET['location']==$loc->id) $selected = "selected"; else $selected = "";
                    echo "<option value='".$loc->id."' ".$selected.">".$loc->location."</option>";
                }?>
            </select>
            </form>
            <div style="margin-top:30px"></div>
        </div>
      <?php if(!empty($featuredfHotels)){ foreach($featuredfHotels as $item){ ?>

          <div class="offset-2 featured-item">
        <div class="wow fadeInUp col-lg-3 col-md-3 col-sm-3 offset-0 go-right">

          <div class="hospi_img_list">
            <a href="<?php echo $item->slug;?>">
              <img src="<?php echo $item->thumbnail;?>" alt="<?php echo character_limiter($item->title,20);?>">
              <div class="short_info"></div>
            </a>
          </div>
        </div>
        <div class="wow fadeInUp col-md-9 offset-0">
          <div class="itemlabel_hospi">
            <div class="col-lg-8 col-md-8 col-sm-8 rtl_title_home" style="border-right: 1px solid #e2e2e2;min-height: 128px;">
               <h4 class="mtb0 RTL go-text-right">
                <a href="<?php echo $item->slug;?>"><b><?php echo $item->title;?></b></a>
              </h4>
              <?php echo $item->stars; ?>
              <br/>
              <span class="opensans"><?php echo $item->mapAddress; ?></span>
              <br/><br/><br/>
              <div class="opensans"><?php echo trans('0566'); ?>: <span class="big-price"><?php echo $item->price; ?></span> <span class="med-price"><?php echo $item->currSymbol; ?></span></div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 rtl_title_home content-bestchoice">
              
                <img src="<?php echo $theme_url; ?>/assets/img/hospichoice.png" width="107" height="64" data-retina="true" class="bestchoi img-responsive">

            </div>
          </div>
        </div>
      </div>
     <div class="clearfix" style="padding-top: 20px;"></div>
      <?php } ?>    
      
      
      <div class="clearfix"></div>
      <div class="col-md-12 pull-right go-right"><?php echo createPagination($info);?></div>
      <div class="pull-right">
        <?php }else{  echo '<h1 class="text-center">' . trans("066") . '</h1>'; } ?>
      </div>
      <!-- End of offset1-->

    <!-- start EAN multiple locations found and load more hotels -->
    <?php if($appModule == "ean"){ if($multipleLocations > 0){ foreach($locationInfo as $loc){ ?> 
      <p><?php echo $loc->link; ?></p>
     <?php } } ?>
        <!--This is for display cache Parameter-->
      <div id="latest_record_para">
        <input type="hidden" name="moreResultsAvailable" id="moreResultsAvailable" value="<?php echo $moreResultsAvailable; ?>" />
        <input type="hidden" name="cacheKey" id="cacheKey" value="<?php echo $cacheKey; ?>" />
        <input type="hidden" name="cacheLocation" id="cacheLocation" value="<?php echo $cacheLocation; ?>" />
        <input type="hidden" name="" id="agesappendurl" value="<?php echo $agesApendUrl; ?>" />
        <input type="hidden" name="" id="adultsCount" value="<?php echo $adults;?>" />
      </div>
      <!--This is for display content-->
      <div id="New_data_load"></div>
      <!--This is for display Loader Image-->
      <div id="loader_new"></div>
      <div id="message_noResult"></div>
      <!-- END OF LIST CONTENT-->  
    <?php } ?>
      <!-- End EAN multiple locations found and load more hotels  -->




    </div>
    <!-- END OF LIST CONTENT-->
  </div>
  <!-- END OF container-->
</div>
<!-- END OF CONTENT -->
<br><br><br>
<!-- End container -->
<!-- Map -->
<!-- Map Modal -->
<div class="modal fade" id="mapModal" tabindex="1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div  class="modal-content">
      <div class="mapContent">
      </div>
    </div>
  </div>
</div>
<div class="clearfix"></div>
<script>


  $('#collapseMap').on('shown.bs.collapse', function(e){
  (function(A) {

  if (!Array.prototype.forEach)
   A.forEach = A.forEach || function(action, that) {
     for (var i = 0, l = this.length; i < l; i++)
       if (i in this)
         action.call(that, this[i], i, this);
     };

   })(Array.prototype);

   var
   mapObject,
   markers = [],
   markersData = {

     'map-red': [
      <?php foreach($module as $item): ?>
     {
       name: 'hotel name',
       location_latitude: "<?php echo $item->latitude;?>",
       location_longitude: "<?php echo $item->longitude;?>",
       map_image_url: "<?php echo $item->thumbnail;?>",
       name_point: "<?php echo $item->title;?>",
       description_point: "<?php echo character_limiter(strip_tags(trim($item->desc)),75);?>",
       url_point: "<?php echo $item->slug;?>"
     },
      <?php endforeach; ?>

     ],

   };
     var mapOptions = {
        <?php if(empty($_GET)){ ?>
       zoom: 10,
        <?php }else{ ?>
         zoom: 12,
        <?php } ?>
       center: new google.maps.LatLng(<?php echo $item->latitude;?>, <?php echo $item->longitude;?>),
       mapTypeId: google.maps.MapTypeId.ROADMAP,

       mapTypeControl: false,
       mapTypeControlOptions: {
         style: google.maps.MapTypeControlStyle.DROPDOWN_MENU,
         position: google.maps.ControlPosition.LEFT_CENTER
       },
       panControl: false,
       panControlOptions: {
         position: google.maps.ControlPosition.TOP_RIGHT
       },
       zoomControl: true,
       zoomControlOptions: {
         style: google.maps.ZoomControlStyle.LARGE,
         position: google.maps.ControlPosition.TOP_RIGHT
       },
       scrollwheel: false,
       scaleControl: false,
       scaleControlOptions: {
         position: google.maps.ControlPosition.TOP_LEFT
       },
       streetViewControl: true,
       streetViewControlOptions: {
         position: google.maps.ControlPosition.LEFT_TOP
       },
       styles: [/*map styles*/]
     };
     var
     marker;
     mapObject = new google.maps.Map(document.getElementById('map'), mapOptions);
     for (var key in markersData)
       markersData[key].forEach(function (item) {
         marker = new google.maps.Marker({
           position: new google.maps.LatLng(item.location_latitude, item.location_longitude),
           map: mapObject,
           icon: '<?php echo base_url(); ?>assets/img/' + key + '.png',
         });

         if ('undefined' === typeof markers[key])
           markers[key] = [];
         markers[key].push(marker);
         google.maps.event.addListener(marker, 'click', (function () {
       closeInfoBox();
       getInfoBox(item).open(mapObject, this);
       mapObject.setCenter(new google.maps.LatLng(item.location_latitude, item.location_longitude));
      }));

  });

   function hideAllMarkers () {
     for (var key in markers)
       markers[key].forEach(function (marker) {
         marker.setMap(null);
       });
   };

   function closeInfoBox() {
     $('div.infoBox').remove();
   };

   function getInfoBox(item) {
     return new InfoBox({
       content:
       '<div class="marker_info" id="marker_info">' +
       '<img style="width:280px;height:140px" src="' + item.map_image_url + '" alt=""/>' +
       '<h3>'+ item.name_point +'</h3>' +
       '<span>'+ item.description_point +'</span>' +
       '<a href="'+ item.url_point + '" class="btn btn-primary"><?php echo trans('0177');?></a>' +
       '</div>',
       disableAutoPan: true,
       maxWidth: 0,
       pixelOffset: new google.maps.Size(40, -190),
       closeBoxMargin: '0px -20px 2px 2px',
       closeBoxURL: "<?php echo $theme_url; ?>assets/img/close.png",
       isHidden: false,
       pane: 'floatPane',
       enableEventPropagation: true
     }); };  });
</script>
<script src="<?php echo $theme_url; ?>assets/js/infobox.js"></script>
<script src="<?php echo $theme_url; ?>assets/include/icheck/icheck.min.js"></script>
<link href="<?php echo $theme_url; ?>assets/include/icheck/square/grey.css" rel="stylesheet">
<script>
  var cb, optionSet1;
      $(".checkbox").iCheck({
        checkboxClass: "icheckbox_square-grey",
        radioClass: "iradio_square-grey"
      });

      $(".radio").iCheck({
        checkboxClass: "icheckbox_square-grey",
        radioClass: "iradio_square-grey"
      });
</script>
<script type="text/javascript">
    function submitform() {
        var url = document.location.href;
        formAction = document.itemlist.location[document.itemlist.location.selectedIndex].value;
        var currentUrl = url.indexOf("location") == -1 ? true : false;
        if (currentUrl) {
            var searchString = '?location=';
            searchString = url.indexOf("?") == -1 ? searchString : '&location=';
        } else {
            url = url.split('location')[0];
            var searchString = 'location=';
        }
        document.itemlist.action = url + searchString + formAction;
        document.getElementById('itemlist').submit();
    }
</script>