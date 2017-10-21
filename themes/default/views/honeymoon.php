<script type="text/javascript" src="<?php echo $theme_url; ?>plugins/jslider/js/jshashtable-2.1_src.js"></script>
<script type="text/javascript" src="<?php echo $theme_url; ?>plugins/jslider/js/jquery.numberformatter-1.2.3.js"></script>
<script type="text/javascript" src="<?php echo $theme_url; ?>plugins/jslider/js/tmpl.js"></script>
<script type="text/javascript" src="<?php echo $theme_url; ?>plugins/jslider/js/jquery.dependClass-0.1.js"></script>
<script type="text/javascript" src="<?php echo $theme_url; ?>plugins/jslider/js/draggable-0.1.js"></script>
<script type="text/javascript" src="<?php echo $theme_url; ?>plugins/jslider/js/jquery.slider.js"></script>
<link rel="stylesheet" href="<?php echo $theme_url; ?>plugins/jslider/css/jslider.css" type="text/css">
<link rel="stylesheet" href="<?php echo $theme_url; ?>plugins/jslider/css/jslider.round.css" type="text/css">
<div class="container offer-banners">
<div id="carousel-banner" class="carousel slide" data-ride="carousel">
 
 
  <!-- Wrapper for slides -->
 <div class="carousel-inner">
<?php  
$input = get_widget_content(87);
preg_match_all('/<img[^>]+>/i',$input, $pics); 
preg_match_all('~href=("|\')(.*?)\1~', $input, $href);
$k=1; foreach($pics[0] as $pic) {
                                    if($k==1) {$class="active";} else $class=""; ?>
    <div class="item <?php echo $class;?>">
        <a href="<?php echo $href[2][$k-1]; ?>"><?php echo $pic; ?></a>
    </div>
      <?php $k++;} ?>
     </div>
      <!-- Indicators -->
  <ol class="carousel-indicators">
      <?php $total = count($pics[0]);?>
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


<div class="clearfix"></div>
<div class="honeymoon-banner-bottom">
    <div class="col-xs-12 col-sm-2 col-lg-2"></div>
    <div class="col-xs-12 col-sm-9 col-lg-9">
        <form action="<?php echo base_url().$appModule;?>/search" method="GET">
    
    <div class="col-md-6 col-lg-6 col-sm-12 go-right" ng-controller="autoSuggest">
        <div class="clearfix"></div>
       <!--<div angucomplete-alt id="<?php $appModule; ?>Search" input-name="txtSearch" initial-value="txtSearch" placeholder="<?php echo trans('0673');?>" pause="500" selected-object="selectedItem" remote-url="<?php echo base_url();?>home/suggestions/<?php echo $appModule; ?>" remote-url-request-formatter="remoteUrlRequestFn" remote-url-data-field="items" title-field="name" description-field="" minlength="2" input-class="form-control form-control-small" match-class="highlight">
        </div>-->
        <input id="search" name="txtSearch" class="form-control form-control-small" placeholder="<?php echo trans('026');?>"/>
            <div id="autocomlete-container"></div>
       
        <input id="searching" type="hidden" name="searching" value="{{searching}}"> <input id="modType" type="hidden" name="modType" value="{{modType}}">
    </div>

    <!-- start hotels checkin checkout fields -->
    <?php if($appModule == "hotels"){ ?>
    <div class="col-md-3 col-sm-6 col-xs-6 go-right">
        <div class="clearfix"></div>
        <input type="text" placeholder="<?php echo trans('0674');?> " name="checkin" class="form-control dpd1" value="<?php echo @$checkin; ?>" required >
    </div>
    <div class="col-md-2 col-sm-6 col-xs-6 go-right" style="display: none">
        <div class="clearfix"></div>
        <label class="control-label go-right size13"><i class="icon-calendar-7"></i> <?php echo trans('09');?></label>
        <input type="hidden" placeholder="<?php echo trans('09');?> " name="checkout" class="form-control dpd2" value="<?php echo @$checkout; ?>" required >
    </div>
    <?php } ?>
    <!-- end hotels checkin checkout fields -->

    <div class="col-md-2 col-lg-1 col-sm-6 col-xs-6 go-right" style="display: none">
        <div class="clearfix"></div>
        <label class="control-label go-right size13" style="white-space:nowrap;"><i class="icon-user-7"></i> <?php if($appModule == "hotels"){ echo trans('010'); }else if($appModule == "tours"){ echo trans('0446'); } ?></label>
        <select  required class="form-control" placeholder=" <?php echo trans('');?> " name="adults" id="adults">
          <option value="">0</option>
          <?php for($Selectadults = 1; $Selectadults < 11;$Selectadults++){ ?>
          <option value="<?php echo $Selectadults;?>" <?php if($Selectadults == $modulelib->adults){ echo "selected"; } ?> > <?php echo $Selectadults;?> </option>
          <?php } ?>
        </select>
    </div>
    <!-- start hotels child field -->
    <?php if($appModule == "hotels"){ ?>
    <div class="hidden-md col-lg-1 col-sm-6 col-xs-6 go-right" style="display: none">
        <div class="clearfix"></div>
        <label class="control-label go-right size13"><i class="icon-user-7"></i> <?php echo trans('011');?></label>
        <select  class="form-control" placeholder=" <?php echo trans('011');?> " name="child" id="child">
          <?php for($Selectchild = 0; $Selectchild < 6;$Selectchild++){ ?>
          <option value="<?php echo $Selectchild;?>" <?php if($Selectchild == @$modulelib->children){ echo "selected"; } ?> > <?php echo $Selectchild;?> </option>
          <?php } ?>
        </select>
    </div>
    <?php } ?>
     <?php if(isset($_GET['txtSearch'])) { if( strpos( $_GET['txtSearch'], "-khu-vuc-" ) !== false ) {
            $ok = substr($_GET['txtSearch'], strpos($_GET['txtSearch'], "-khu-vuc-") + 9); 
            echo '<input type="hidden" name="near" value="'.$ok.'">';
        }
      }
        ?>
    <!-- end hotels child field -->
   
    <div class="visible-sm visible-xs">
      <div class="clearfix"></div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-6 go-right">
        <div class="clearfix"></div>
        <input type="hidden"  name="honeymoon" value="yes" >
        <button style="font-size: 14px;margin-bottom:0; padding:6px 15px;" type="submit" class="btn btn-block btn-action"><?php echo trans('012');?></button>
    </div>
    <div class="clearfix"></div>
  </form>
    </div>
    <div class="col-xs-12 col-sm-1 col-lg-1"></div>
</div>
</div>

<!-- CONTENT -->
<div class="container offset-0">
  <div class="clearfix"></div>
  <div class="col-md-12 go-right">
      
      <h2 class="page-honey-icon purple"><?php echo trans('0567');?></h2>
      <div class="clearfix"></div>
        <hr style="margin-top: 10px; margin-bottom: 10px;">
        <div class="opensans text-justify">
            <?php echo trans('0676');?>
      </div>
  </div>
  <div style="clear:both;margin-bottom:15px;"></div>
  <div class="col-md-12 go-right"><h2 class="purple"><?php echo trans('0688'); ?></h2></div>
</div>
<?php $honeymoonLocation = honeymoonWithLocations(12);
$bests = array();
$normals= array();
foreach($honeymoonLocation->locations as $honeymoon){ 
  if($honeymoon->best == 'Yes') {
    $bests[] = $honeymoon;
  } else {
    $normals[] = $honeymoon;
  }
} ?>
 <div class="lastminute4_1">
     <div class="container">
  <div class="honeymoon">
            <!-- Khuyen mai -->
                
                <div style="clear:both;margin-bottom:15px;"></div>
                <div class="row">
                    
                  <?php foreach ($bests as $best) {
                    $city_slug = create_slug($best->name);
                    $country_slug = create_slug($best->country);
                  
                    echo "<div class='col-md-4 col-sm-6 col-xs-12 absolute-div'><div class='honeymoon-block'>";
                    echo "<span class='bandroll-yeuthich'>".trans('0689')."</span>";
                    echo "<div class='img_list'>";
                    echo "<a href='".base_url()."hotels/search/".$country_slug."/".$city_slug."/".$best->id."?txtSearch=".$best->name."&searching=".$best->id."&modType=location&checkin=&checkout=&adults=&child=&honeymoon=yes'><img class='absolute-img' src='".PT_ROOMS_THUMBS.$best->thumbnail_image."'></a>";
                    
                    echo "</div>";
                    echo "<div class='honeymoon-title'><a href='".base_url()."hotels/search/".$country_slug."/".$city_slug."/".$best->id."?txtSearch=".$best->name."&searching=".$honey->id."&modType=location&checkin=&checkout=&adults=&child=&honeymoon=yes'><span class='honeymoon-txt'>".$best->name."</span>";
                    echo "<div class='home-featured-hotel-right'>
                                                <span class='home-featured-hotel-price'><i class='fa fa-chevron-right' aria-hidden='true'></i></span>    
                                            </div></div></a></div></div>";
                  } ?>                                  
                </div>
                
        </div>
     </div>
     
 </div>
<div style="clear:both;margin-bottom:15px;"></div>
<div class="container offset-0">
  <div class="col-md-12 go-right">
  <div class="honeymoon">
            <!-- Khuyen mai -->
                <h2 class="purple"><?php echo trans('0677'); ?></h2>
                <div style="clear:both;margin-bottom:15px;"></div>
                <div class="row">
                    <?php foreach ($normals as $honey) {
                    $city_slug = create_slug($honey->name);
                    $country_slug = create_slug($honey->country);
                  
                    echo "<div class='col-md-4 col-sm-6 col-xs-12 absolute-div'><div class='honeymoon-block'>";
                    echo "<div class='img_list'>";
                    echo "<a href='".base_url()."hotels/search/".$country_slug."/".$city_slug."/".$honey->id."?txtSearch=".$honey->name."&searching=".$honey->id."&modType=location&checkin=&checkout=&adults=&child=&honeymoon=yes'><img class='absolute-img' src='".PT_ROOMS_THUMBS.$honey->thumbnail_image."'></a>";
                    
                    echo "</div>";
                    echo "<div class='honeymoon-title'><a href='".base_url()."hotels/search/".$country_slug."/".$city_slug."/".$honey->id."?txtSearch=".$honey->name."&searching=".$honey->id."&modType=location&checkin=&checkout=&adults=&child=&honeymoon=yes'><span class='honeymoon-txt'>".$honey->name."</span>";
                    echo "<div class='home-featured-hotel-right'>
                                                <span class='home-featured-hotel-price'><i class='fa fa-chevron-right' aria-hidden='true'></i></span>    
                                            </div></div></a></div></div>";
                  } 
//id, name, country, thumbnail_image, /hotels/search/united-arab-emirates/dubai/6?txtSearch=Dubai&searching=6&modType=location&checkin=&checkout=&adults=&child=
                
                ?>
                </div>
                
        </div>
  </div>
  <div style="clear:both;margin-bottom:30px;"></div>
  <div class="col-md-3 go-right">
    <div id="carousel-widget" class="offer-banners carousel slide" data-ride="carousel">
 
 
  <!-- Wrapper for slides -->
  <div class="carousel-inner">
      <?php 
      $ad2 = get_widget_content(88);
        preg_match_all('~href=("|\')(.*?)\1~', $ad2, $href);
        preg_match_all('/<img[^>]+>/i',$ad2, $pics);
      $k=1; foreach($pics[0] as $pic) {
                                    if($k==1) {$class="active";} else $class=""; ?>
    <div class="item <?php echo $class;?>">
        <a href="<?php echo $href[2][$k-1]; ?>"><?php echo $pic; ?></a>
    </div>
      <?php $k++;} ?>
    
  </div>
  <!-- Indicators -->
  <ol class="carousel-indicators">
      <?php $l=0; foreach($pics[0] as $pi) { if($l==0) {$liclass="active";} else $liclass=""; ?>
    <li data-target="#carousel-widget" data-slide-to="<?php echo $l;?>" class="<?php echo $liclass; ?>"></li>
    
      <?php $l++; } ?>
  </ol>
  
</div> <!-- Carousel -->
       </div>
  
  <div class="visible-xs"><br><br></div>
  <!-- LIST CONTENT-->
  <div class="rightcontent col-md-9 offset-0">
    <div class="itemscontainer offset-1">

      <?php if(!empty($module)) { $i=0; foreach($module as $item){ ?>
      <div class="offset-2">
        <div class="wow fadeInUp col-lg-3 col-md-3 col-sm-3 offset-0 go-right">
          <!-- Add to whishlist -->
          <?php if($appModule != "ean" && $appModule != "offers"){ ?>
          <span  ><?php echo wishListInfo($appModule, $item->id); ?></span>
          <?php } ?>
          <!-- Add to whishlist -->
          <div class="img_list" style="min-height:160px;">
            <a href="<?php echo $item->slug;?>/?details=<?php echo $item->roomid;?>">
              <img src="<?php echo $item->thumbnail;?>" alt="<?php echo $item->title;?>">
              <div class="short_info"></div>
            </a>
          </div>
        </div>
        <div class="wow fadeInUp col-md-9 offset-0">
            <div class="itemlabel3" style="height:160px">
            <div class="honeymoon labelright go-left" style="min-width:105px;margin-left:5px">
              <br/>
              <div class="purple size18 text-center">
              <?php  if($item->price > 0){ ?>
              <b>
              <?php echo $item->price;?><div class="smalltext">(<?php echo $item->currSymbol; ?>)</div>
              </b></div>
              <div class="clearfix"></div>
              <hr>
              <?php } ?>
              

              <?php if($appModule == "ean"){ if($item->tripAdvisorRating > 0){ ?>
              <div class="review text-center size18"><i class="icon-thumbs-up-4"></i><?php echo $item->tripAdvisorRating;?> </div>
              <div class="clearfix"></div>
              <hr>
              <?php } } ?>
              <a href="<?php echo $item->slug;?>/?details=<?php echo $item->roomid;?>">
              <button type="submit" class="btn btn-action"><?php echo trans('0177');?></button>
              </a>
            </div>
            <div class="labelleft2 rtl_title_home">
              <h4 class="mtb0 RTL go-text-right">
                <a href="<?php echo $item->slug;?>/?details=<?php echo $item->roomid;?>"><b><?php echo $item->title;?></b></a> <span class="go-right"><?php echo $item->stars;?></span>
                
                <!-- Cars airport pickup -->  <?php if($appModule == "cars"){ if($item->airportPickup == "yes"){ ?> <button class="btn btn-success btn-xs"><i class="icon-paper-plane-2"></i> <?php echo trans('0207');?></button> <?php } } ?> <!-- Cars airport pickup -->
              </h4>
               <?php echo $item->mapAddress;?>
              <br><br>
              <?php if(pt_is_module_enabled('reviews')){ ?>
              <?php  if($item->avgReviews->overall > 0){ ?>
              <i class="icon-thumbs-up-4"></i><?php echo $item->avgReviews->overall; ?>
              <!--<?php echo $item->avgReviews->totalReviews; ?>-->
              
              <?php } ?>
              <?php } ?>
              <?php if($appModule != "offers"){ ?> &nbsp;(<a class="go-right" href="javascript:void(0);" onclick="showMap('<?php echo base_url();?>home/maps/<?php echo $item->latitude; ?>/<?php echo $item->longitude; ?>/<?php echo $appModule; ?>/<?php echo $item->id;?>','modal');" title="<?php echo $item->mapAddress;?>"><i style="margin-left: -3px;" class="purple icon-location-6 go-right"></i><?php echo trans('067');?></a>  <?php } ?>)
              <br>
              <p class="grey RTL"><span class="purple room-honey-icon <?php echo getRoomsID($item->id);?>">&nbsp;<a href="<?php echo $item->slug;?>/?details=<?php echo $item->roomid;?>"><?php echo trans('0567');?></a></span><?php //echo character_limiter($item->desc,190);?></p>
              
              <?php if($appModule == "hotels"){ ?>
              <ul class="pre-honeymoon hotelpreferences go-right hidden-xs">
                <?php $cnt = 0; foreach($item->amenities as $amt){ $cnt++; if($cnt <= 10){ if(!empty($amt->name)){ ?>
                <img title="<?php echo $amt->name;?>" data-toggle="tooltip" data-placement="top" style="height:25px;" src="<?php echo $amt->icon;?>" alt="<?php echo $amt->name;?>" />
                <?php } } } ?>
              </ul>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
      <div class="clearfix"></div>
      <div class="offset-2">
        <hr style="margin-top: 10px; margin-bottom: 10px;">
      </div>
      <?php $i++; if($i==3) break; } ?>
      <div class="clearfix"></div>
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
<script type='text/javascript'>//<![CDATA[
$(window).load(function(){
var tally = new Object();
var idx;

$.widget("custom.catcomplete", $.ui.autocomplete, {
    _renderMenu: function(ul, items) {
        var self = this,currentCategory = "";
        $.each(items, function(index, item) {
            if (item.category != currentCategory) {
                /*ul.append("<li class='ui-autocomplete-category'>" + item.category + "(<span id='autocomplete_"+item.category+"'></span>)</li>");*/
                ul.append("<li class='ui-autocomplete-category'>" + item.category + "</li>");
                currentCategory = item.category;
            }
            if(currentCategory!=''){
                tally[currentCategory] = (tally[currentCategory]==undefined) ? 1 : tally[currentCategory]+1;}
            self._renderItem(ul, item);
            $(ul).append("<span title='" + item.address + "' class='desc'>" + item.desc + " <i class='fa fa-map-marker' aria-hidden='true'></i></span><div style='clearfix'></div>");

        });
        for(category in tally){
            $('#autocomplete_'+category).html(tally[category]);
        };
    }

});


var data = [
            
            <?php $locationlistings = getLocations();
                        foreach($locationlistings as $list){ 
                            echo '{ label: "'.$list->location.'", category: "Bạn muốn đến đâu cho kỳ nghỉ Honeymoon", modType: "location", id: "'.$list->id.'", desc: "Tỉnh thành", address: ""},';
                        } ?>
            
];
        
$( "#search" ).catcomplete({
    source: data,
    appendTo: "#autocomlete-container",
    select: function(event, ui) {
            $('#search').val(ui.item.label);
            // and place the item.id into the hidden textfield called 'searching'. 
            $('#searching').val(ui.item.id);
            $('#modType').val(ui.item.modType);
                return false;
        }
});

});//]]> 

</script>
<script>
<?php if($appModule == "cars"){ ?>
  $(function(){
    $(".saveDates").on("click",function(){
      var pickup = $("#departcar").val();
      var drop = $("#returncar").val();
      var htmlvar = pickup+' - '+drop; 
      $(".datesModal").html(htmlvar);      
    });    
  })

<?php } ?>

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