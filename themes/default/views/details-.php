<link href="<?php echo $theme_url; ?>assets/include/slider/slider.min.css" rel="stylesheet" />
<script src="<?php echo $theme_url; ?>assets/js/single.js"></script>
<script src="<?php echo $theme_url; ?>/assets/js/jquery.nicescroll.min.js"></script>
<script src="<?php echo $theme_url; ?>assets/include/slider/slider.js"></script>
<script src="<?php echo $theme_url; ?>assets/js/infobox.js"></script>
<div class="mtslide2 sliderbg2"></div>
<!-- map -->
<div class="collapse" id="collapseMap">
  <?php if($appModule == "tours"){ ?>
  <iframe id="mapframe" width="100%" height="450" style="position: static;" src="" frameborder="0"></iframe>
  <script>
    $('#collapseMap').on('shown.bs.collapse', function(e){
      $("#mapframe").prop("src","<?php echo base_url();?>tours/tourmap/<?php echo $module->id; ?>");
    });
  </script>
  <?php }else{ ?>
  <div id="map" class="map"></div>
  <br>
  <script>$('#collapseMap').on('shown.bs.collapse',function(e){(function(A){if(!Array.prototype.forEach)
    A.forEach=A.forEach||function(action,that){for(var i=0,l=this.length;i<l;i++)
    if(i in this) action.call(that,this[i],i,this);}})(Array.prototype);var mapObject,markers=[],markersData={'marker':[{name:'<?php echo character_limiter($module->title, 80);?>',location_latitude:<?php echo $module->latitude;?>,location_longitude:<?php echo $module->longitude;?>,map_image_url:'<?php echo $module->thumbnail;?>',name_point:'<?php echo character_limiter($module->title, 80);?>',description_point:'<?php echo character_limiter(strip_tags(trim($module->desc)),100);?>',url_point:'<?php echo $module->slug;?>'},<?php foreach($module->relatedItems as $item):?>{name:'hotel name',location_latitude:"<?php echo $item->latitude;?>",location_longitude:"<?php echo $item->longitude;?>",map_image_url:"<?php echo $item->thumbnail;?>",name_point:"<?php echo $item->title;?>",description_point:'<?php echo character_limiter(strip_tags(trim($item->desc)),100);?>',url_point:"<?php echo $item->slug;?>"},<?php endforeach;?>]};var mapOptions={zoom:14,center:new google.maps.LatLng(<?php echo $module->latitude;?>,<?php echo $module->longitude;?>),mapTypeId:google.maps.MapTypeId.ROADMAP,mapTypeControl:!1,mapTypeControlOptions:{style:google.maps.MapTypeControlStyle.DROPDOWN_MENU,position:google.maps.ControlPosition.LEFT_CENTER},panControl:!1,panControlOptions:{position:google.maps.ControlPosition.TOP_RIGHT},zoomControl:!0,zoomControlOptions:{style:google.maps.ZoomControlStyle.LARGE,position:google.maps.ControlPosition.TOP_RIGHT},scrollwheel:!1,scaleControl:!1,scaleControlOptions:{position:google.maps.ControlPosition.TOP_LEFT},streetViewControl:!0,streetViewControlOptions:{position:google.maps.ControlPosition.LEFT_TOP},styles:[]};var marker;mapObject=new google.maps.Map(document.getElementById('map'),mapOptions);for(var key in markersData)
    markersData[key].forEach(function(item){marker=new google.maps.Marker({position:new google.maps.LatLng(item.location_latitude,item.location_longitude),map:mapObject,icon:'<?php echo base_url(); ?>uploads/global/default/'+key+'.png',});if('undefined'===typeof markers[key])
    markers[key]=[];markers[key].push(marker);google.maps.event.addListener(marker,'click',(function(){closeInfoBox();getInfoBox(item).open(mapObject,this);mapObject.setCenter(new google.maps.LatLng(item.location_latitude,item.location_longitude))}))});function hideAllMarkers(){for(var key in markers)
    markers[key].forEach(function(marker){marker.setMap(null)})};function closeInfoBox(){$('div.infoBox').remove()};function getInfoBox(item){return new InfoBox({content:'<div class="marker_info" id="marker_info">'+'<img style="width:280px;height:140px" src="'+item.map_image_url+'" alt="<?php echo character_limiter($module->title, 80);?>"/>'+'<h3>'+item.name_point+'</h3>'+'<span>'+item.description_point+'</span>'+'<a href="'+item.url_point+'" class="btn btn-primary"><?php echo trans('0177');?></a>'+'</div>',disableAutoPan:!0,maxWidth:0,pixelOffset:new google.maps.Size(40,-190),closeBoxMargin:'0px -20px 2px 2px',closeBoxURL:"<?php echo $theme_url; ?>assets/img/close.png",isHidden:!1,pane:'floatPane',enableEventPropagation:!0})}});
  </script>
  <?php } ?>
</div>
<!-- map -->
<div class="breadcrumb">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <?php echo $breadcrumb;?>
      </div>
    </div>
  </div>
</div>
<div id="OVERVIEW" class="container">
  <div class="col-md-9 go-right">
      
    <div  class="panel panel-default">
      <div>
        <div class="col-md-9 go-right">
          <div style="margin-top: 6px">
            <h1 class="go-right" style="font-size: 16px;margin-top: 10px;margin-bottom: 0px;"><?php echo $module->title;?></h1> <small class="go-right"><?php echo $module->stars;?></small> <span class="pull-right go-left"><?php if($hasRooms){ ?><?php //echo trans('0141');?><?php } ?> </span>
            <div class="clearfix"></div>
            <span class="go-right RTL"><i style="margin-left:-5px" class="icon-location-6"></i><?php //echo $module->location; ?> <?php if(!empty($module->mapAddress)){ ?><small class="adddress"><?php echo $module->mapAddress;?></small></span> <?php } ?>
            <span class="viewmap">(<a data-toggle="collapse" href="#collapseMap" aria-expanded="false" aria-controls="collapseMap"><?php echo trans('067');?></a>)</span>
            <?php if($hasRooms || $appModule == "offers"){ ?>
            <strong class="go-left"><span style="font-size:18px" class=" pull right go-text-right"><?php //echo trans('070');?> <?php //echo @$currencySign; ?><?php //echo @$lowestPrice; ?> </span></strong>
            <?php } ?>
            <div class="visible-xs visible-sm"><div class="form-group"></div></div>
          </div>
        </div>
        <?php /*if($appModule == "offers"){ ?>
      <div class="col-md-3 go-left" >
        <a class="btn btn-primary pull-right btn-block" data-toggle="modal" href="#call" ><?php echo trans('0438');?></a>
      </div>
      <!-- Start Offers Call Modal -->
      <div class="modal fade" id="call" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-md">
      <div class="modal-content">
      <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title"><?php echo trans('0438');?></h4>
      </div>
      <div class="modal-body">

      <div class="form-group">
      <div class="col-md-12">
      <h3 class="text-danger text-center"><i class="fa fa-phone"></i> <?php echo $module->phone;?></h3>
      </div>
      </div>
      <div class="clearfix"></div>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo trans('0234');?></button>
      </div>
      </div>
      </div>
      </div>
      <!-- End Offers Call Modal -->

      <?php }else{ ?>
      <div class="col-md-3">
      <a class="btn btn-action pull-right btn-block" data-toggle="collapse" href="#collapseMap" aria-expanded="false" aria-controls="collapseMap"><?php echo trans('067');?></a>
      </div>
      <?php } */ ?>
        

      </div>
      <div class="clearfix"></div>
      <div style="display:none" class="tabsbar">
        <ul  class="RTL visible-lg visible-md nav nav-tabs nav-justified">
          <li class="text-center"><a class="tabsBtn" href="#OVERVIEW" data-toggle="tab"><?php echo trans('0248');?></a></li>
          <?php if(!empty($rooms) > 0){ ?>
          <li class="text-center"><a class="tabsBtn" href="#ROOMS" data-toggle="tab"><?php echo trans('016');?></a></li>
          <?php  } ?>
          <?php if(!empty($module->desc)){ ?>
          <li class="text-center"><a class="tabsBtn" href="#DESCRIPTION" data-toggle="tab"><?php echo trans('046');?></a></li>
          <?php  } ?>
          <?php if(!empty($module->amenities)){ ?>
          <li class="text-center"><a class="tabsBtn" href="#AMENITIES" data-toggle="tab"><?php echo trans('0249');?></a></li>
          <?php  } ?>
          <?php if(!empty($module->inclusions)){ ?>
          <li class="text-center"><a class="tabsBtn" href="#INCLUSIONS" data-toggle="tab"><?php echo trans('0280');?></a></li>
          <?php  } ?>
          <?php if(!empty($module->exclusions)){ ?>
          <li class="text-center"><a class="tabsBtn" href="#EXCLUSIONS" data-toggle="tab"><?php echo trans('0281');?></a></li>
          <?php  } ?>
          <?php if(!empty($reviews) > 0){ ?>
          <li class="text-center"><a class="tabsBtn" href="#REVIEWS" data-toggle="tab"><?php echo trans('0396');?></a></li>
          <?php  } ?>
          <?php if(!empty($module->relatedItems)){ ?>
          <li class="text-center"><a class="tabsBtn" href="#RELATED" data-toggle="tab"><?php if($appModule == "hotels" || $appModule == "ean"){ echo trans('0290'); }else if($appModule == "tours"){ echo trans('0453'); }else if($appModule == "cars"){ echo trans('0493'); } ?></a></li>
          <?php  } ?>
          <?php $currenturl = current_url(); $wishlist = pt_check_wishlist($customerloggedin,$module->id,$appModule); if($allowreg){ if($wishlist){ ?>
          <li style="background-color:#ee5452" class="btn wish btn-danger btn-block removewishlist"><span class="wishtext"><i class=" icon_set_1_icon-82"></i> <?php echo trans('028');?></span></li>
          <?php }else{ ?>
          <li style="background-color:#ee5452" class="btn wish btn-block addwishlist btn-danger"><span class="wishtext"><i class=" icon_set_1_icon-82"></i> <?php echo trans('029');?></span></li>
          <?php } } ?>
        </ul>
      </div>
      <div style="margin-top:10px;padding: 0 12px 12px;">
        <!-- slider -->
        <div class="fotorama bg-dark" data-allowfullscreen="true" data-nav="thumbs">
          <?php foreach($module->sliderImages as $img){ ?>
          <img src="<?php echo $img['fullImage']; ?>" />
          <?php } ?>
        </div>
      </div>
    </div>
    <!-- rooms -->
    <?php if($hasRooms > 0){ if($appModule == "hotels"){ include 'includes/rooms.php'; }else if($appModule == "ean"){ include 'includes/expedia_rooms.php'; include 'integrations/ean/ages.php'; } }  ?>
    <!-- rooms -->
    <br>
    <div class="panel panel-default">
        
        <button type="button" class="collapsebtn last go-text-right" data-toggle="collapse" data-target="#collapse1" aria-expanded="true">
      <?php echo trans('0642');?><?php echo trans('0641'); ?><?php echo $module->title; ?><span class="collapsearrow"></span>
      </button>
        
      <!--<div class="panel-heading go-text-right"><?php echo trans('046');?><?php echo trans('0641'); ?><?php echo $module->title; ?></div>-->
      <div id="collapse1" class="collapse in" aria-expanded="true"><div class="panel-body wrapper-class border-bottom">
              <div class="col-md-2 align-center andes"><?php echo trans('046');?></div><div class="col-md-10  border-left"><?php echo $module->desc; ?></div>
              </div><div class="panel-body wrapper-class border-bottom">
              <div class="col-md-2 align-center andes"><?php echo trans('0249');?></div><div class="col-md-10  border-left"><?php include 'includes/amenities.php';?></div>
      </div></div>
    </div>
    <?php if($appModule != "offers"){ ?>
    <div class="panel panel-default">
        <button type="button" class="collapsebtn last go-text-right" data-toggle="collapse" data-target="#collapse2" aria-expanded="true">
      <?php echo trans('0148');?><?php echo trans('0696');?><?php echo $module->title; ?><span class="collapsearrow"></span>
      </button>
        
      <div id="collapse2" class="collapse in" aria-expanded="true">  
      <div class="panel-body">
        <span class="RTL">
          <p><?php echo nl2br($module->policy); ?></p>
        </span>
        <?php if($appModule != "cars" && $appModule != "ean"){ ?>
        <div class="row">
          <div class="clearfix"></div>
          <hr>
        </div>
        <?php if(!empty($module->paymentOptions)){ ?>
        <div class="col-md-7">
          <div class="row">
            <h4 id="terms" class="main-title  go-right"><?php echo trans('0265');?></h4>
            <div class="clearfix"></div>
            <i class="tiltle-line  go-right"></i>
            <div class="clearfix"></div>
            <span class="RTL">
            <?php foreach($module->paymentOptions as $pay){ if(!empty($pay->name)){ ?>
            <?php echo $pay->name;?> -
            <?php } } ?>
            </span>
            <br><br>
          </div>
        </div>
        <?php } ?>
       
        <!-- Start Tours Inclusions / Exclusions -->
        <?php if($appModule == "tours"){ ?>
        <p class="go-text-left"><i class="fa fa-sun-o text-success"></i> <strong> <?php echo trans('0275');?> </strong> :   <?php echo $module->tourDays;?> | <i class="fa fa-moon-o text-warning"></i>   <strong> <?php echo trans('0276');?> </strong> :  <?php echo $module->tourNights;?> </p>
        <div class="row">
          <div class="clearfix"></div>
          <hr>
          <div id="INCLUSIONS" class="col-md-12">
            <h4 class="main-title go-right"><?php echo trans('0280');?></h4>
            <div class="clearfix"></div>
            <i class="tiltle-line go-right"></i>
            <div class="clearfix"></div>
            <br>
            <?php foreach($module->inclusions as $inclusion){ if(!empty($inclusion->name)){  ?>
            <ul class="list_ok col-md-4 RTL" style="margin: 0 0 5px 0;">
              <li class="go-right"><?php echo $inclusion->name; ?></li>
            </ul>
            <?php } } ?>
            <div class="clearfix"></div>
          </div>
          <div class="clearfix"></div>
          <hr>
          <div id="EXCLUSIONS"class="col-md-12">
            <h4 class="main-title go-right"><?php echo trans('0281');?></h4>
            <div class="clearfix"></div>
            <i class="tiltle-line go-right"></i>
            <div class="clearfix"></div>
            <br>
            <?php foreach($module->exclusions as $exclusion){ if(!empty($exclusion->name)){  ?>
            <ul class="col-md-4" style="margin: 0 0 5px 0;list-style:none;">
              <li class="go-right"><i style="font-size: 13px; color: #E25A70; margin-left: -16px;" class="icon-cancel-5 go-right"></i> &nbsp;&nbsp;&nbsp; <?php echo $exclusion->name; ?> &nbsp;&nbsp;&nbsp;</li>
            </ul>
            <?php } } ?>
            <div class="clearfix"></div>
          </div>
        </div>
        <?php } } ?>
        <!-- End Tours Inclusions / Exclusions -->
      </div>
          </div>
    </div>
    <?php if($appModule == "hotels"){ ?>
    <div class="panel panel-default">
        <button type="button" class="collapsebtn last go-text-right" data-toggle="collapse" data-target="#collapse3" aria-expanded="true">
      <?php echo trans('0758');?><span class="collapsearrow"></span>
      </button>
        
        <div id="collapse3" class="collapse in" aria-expanded="true">
            <div class="panel-body">
             <p class="RTL">
          <i class="fa fa-clock-o text-success"></i> <strong> <?php echo trans('0697');?> </strong> :   <?php echo $module->defcheckin;?>
          <br>
          <i class="fa fa-clock-o text-warning"></i> <strong> <?php echo trans('0698');?> </strong> :  <?php echo $module->defcheckout;?> </p>  
             </div>
        </div>
        </div>
    <?php } ?>
    <?php } ?>
    

    <div class="clearfix"></div>
    <?php include 'includes/reviews.php';?>
    <div class="clearfix"></div>
    <?php if($appModule != "cars" && $appModule != "ean"){ include 'includes/review.php'; } ?>
    <div class="clearfix"></div>
   

    <div class="clearfix"></div>
    <?php if($appModule != "cars" && $appModule != "ean"){ include 'includes/review.php'; } ?>
    <div class="clearfix"></div>
  </div>
  <!-- slider -->
  
  <!-- aside -->
  <div class="secondary col-md-3 go-left">
    <div class="panel-body panel panel-default">
<!-- Start Offers Contact Form -->
<?php if($appModule == "offers"){ ?> 

    <div class="panel-heading"><?php echo trans('0439');?></div>

  <h3 class="inner"></h3>
  <?php if(!empty($module->email)){ ?>
  <form action="" method="POST">
    <fieldset>
      <?php if(!empty($success)){ ?>
      <div class="alert alert-success successMsg"><?php echo trans('0479');?></div>
      <?php } ?>
      <div class="col-md-6 go-right">
        <label class="go-right"><?php echo trans('0350');?></label>
        <input class="form-control" placeholder="<?php echo trans('0350');?>" type="text" name="name" value="" required>
      </div>
      <div class="col-md-6 go-left">
        <label class="go-right"><?php echo trans('092');?></label>
        <input class="form-control" placeholder="<?php echo trans('092');?>" type="text" name="phone" value="" required><br>
      </div>
       <div class="clearfix"></div> 
      <div class="col-md-12">
        <label class="go-right"><?php echo trans('0262');?></label>
        <textarea class="form-control" placeholder="<?php echo trans('0262');?>" name="message" rows="4" cols="25" required></textarea><br>

     </div>
     <div class="clearfix"></div>
      <div class="col-md-12">
        <input type="hidden" name="toemail" value="<?php echo $module->email;?>">
        <input type="hidden" name="sendmsg" value="1">
        <input class="btn btn-success btn-success btn-block btn-lg" type="submit" name="" value="<?php echo trans('0439');?>">
      </div>
      <br>
      <!-- END CONTACT FORM -->
    </fieldset>
  </form>
  <?php } if(!$module->offerForever){ ?>
  <!-- Start Offers countdown -->
  <i class="fa fa-clock-o go-right"></i>
  <h4><?php echo trans('0269');?></h4>
  <p href="#" class="phone"><span class="wow fadeInLeft animated" id="countdown"></span></p>
  <!-- End Offers countdown -->
  <?php } ?>
<div class="clearfix"></div>

<script type="text/javascript">
  // set the date we're counting down to
  var target_date = new Date('<?php echo $module->fullExpiryDate; ?>').getTime();

  // variables for time units
  var days, hours, minutes, seconds;

  // get tag element
  var countdown = document.getElementById('countdown');

  // update the tag with id "countdown" every 1 second
  setInterval(function () {

  // find the amount of "seconds" between now and target
  var current_date = new Date().getTime();
  var seconds_left = (target_date - current_date) / 1000;

  // do some time calculations
  days = parseInt(seconds_left / 86400);
  seconds_left = seconds_left % 86400;

  hours = parseInt(seconds_left / 3600);
  seconds_left = seconds_left % 3600;

  minutes = parseInt(seconds_left / 60);
  seconds = parseInt(seconds_left % 60);

  // format countdown string + set tag value
  countdown.innerHTML = '<span class="days">' + days +  ' <b><?php echo trans("0440");?></b></span> <span class="hours">' + hours + ' <b><?php echo trans("0441");?></b></span> <span class="minutes">'
  + minutes + ' <b><?php echo trans("0442");?></b></span> <span class="seconds">' + seconds + ' <b><?php echo trans("0443");?></b></span>';

  }, 1000);

  $(function(){
      setTimeout(function(){
  $(".successMsg").fadeOut("slow");
  }, 7000);

  });

</script>

<?php } ?>
<!-- End Offers Contact Form -->

      <?php if($appModule != "cars" && $appModule != "offers"){ ?>
      <!-- Start Review Total -->
      <center>
        <h4 class="text-center andes-bold"><strong><?php echo $avgReviews->totalReviews; ?></strong> <?php echo trans('042');?></h4>
        <hr>
        <div class="c100 p<?php echo $avgReviews->overall * 10;?>" style="margin-top:10px;margin-left: 20%;">
          <span><strong><?php echo $avgReviews->overall;?> </strong>/<small>10</small></span>
          <div class="slice">
            <div class="bar"></div>
            <div class="fill"></div>
          </div>
        </div>
        <div class="clearfix"></div>
      </center>
      <br>
     
      <!-- End Review Total -->
       <?php } ?>
      <!-- Start Hotel Reviews bars -->
      <?php if($appModule == "hotels"){ ?>
            <label class="text-left andes"><?php echo trans('033');?></label>
            <div class="progress">
              <div class="progress-bar progress-bar-primary go-right" role="progressbar" aria-valuenow="20"
                aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $avgReviews->facilities * 10;?>%">
                <span class="sr-only"></span>
              </div>
            </div>
          
            <label class="text-left andes"><?php echo trans('034');?></label>
          
            <div class="progress">
              <div class="progress-bar progress-bar-primary go-right" role="progressbar" aria-valuenow="80"
                aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $avgReviews->staff * 10;?>%">
                <span class="sr-only"></span>
              </div>
            </div>
         
            <label class="text-left andes"><?php echo trans('0722');?></label>
          
            <div class="progress">
              <div class="progress-bar progress-bar-primary go-right" role="progressbar" aria-valuenow="20"
                aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $avgReviews->comfort * 10;?>%">
                <span class="sr-only"></span>
              </div>
            </div>
          
            <label class="text-left andes"><?php echo trans('032');?></label>
          
            <div class="progress">
              <div class="progress-bar progress-bar-primary go-right" role="progressbar" aria-valuenow="20"
                aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $avgReviews->location * 10;?>%">
                <span class="sr-only"></span>
              </div>
            </div>
         
            <label class="text-left andes"><?php echo trans('0720');?></label>
          
            <div class="progress">
              <div class="progress-bar progress-bar-primary go-right" role="progressbar" aria-valuenow="20"
                aria-valuemin="0" aria-valuemax="10" style="width: <?php echo $avgReviews ->anuong * 10;?>%">
                <span class="sr-only"></span>
              </div>
            </div>
          
            <label class="text-left andes"><?php echo trans('030');?></label>
         
            <div class="progress">
              <div class="progress-bar progress-bar-primary go-right" role="progressbar" aria-valuenow="20"
                aria-valuemin="0" aria-valuemax="10" style="width: <?php echo $avgReviews->clean * 10;?>%">
                <span class="sr-only"></span>
              </div>
            </div>
      <?php } ?>
      <!-- End Hotel Reviews bars -->
      <?php include 'tripadvisor.php';?>
      <!-- End aside Short Description -->
      <!-- Start Tour Form aside -->
      <?php if($appModule == "tours"){ ?>
      <form action="" method="GET" >
        <div class="panel panel-default">
          <div class="panel-heading"><?php echo trans('0158');?> <?php echo trans('08');?></div>
          <div class="panel-body">
            <input id="tchkin" name="date" value="<?php echo $module->date; ?>" placeholder="date" type="text" class="form-control form-group" placeholder="<?php echo trans('012');?>">
            <button type="submit" class="btn btn-block btn-info pull-right"><?php echo trans('0454');?></button>
          </div>
        </div>
      </form>
      <br>
      <form  action="<?php echo base_url().$appModule;?>/book/<?php echo $module->bookingSlug;?>" method="GET" role="search">
        <input type="hidden" name="date" value="<?php echo $module->date;?>">
        <table style="width:100%" class="table table-bordered">
          <?php if(!empty($modulelib->error)){ ?>
          <div class="alert alert-danger go-text-right">
            <?php echo trans($modulelib->errorCode); ?>
          </div>
          <?php } ?>
          <thead>
            <tr>
              <th  style="line-height: 1.428571;"><?php echo trans('068');?></th>
              <th style="line-height: 1.428571;"><?php echo trans('0450');?></th>
              <th  style="line-height: 1.428571;" class="text-center"><?php echo trans('070');?></th>
            </tr>
          </thead>
          <tbody>
            <?php if($module->adultStatus){ ?>
            <tr>
              <th scope="row"><?php echo trans('010');?> <span class="weak"><?php echo $module->currSymbol;?><?php echo $module->perAdultPrice;?></span></th>
              <td>
                <select style="min-width:50px" name="adults" class="selectx changeInfo input-sm" id="selectedAdults">
                  <?php for($adults = 1; $adults <= $module->maxAdults; $adults++){ ?>
                  <option value="<?php echo $adults;?>" <?php echo makeSelected($selectedAdults, $adults); ?>><?php echo $adults;?></option>
                  <?php } ?>
                </select>
              </td>
              <td class="text-center adultPrice"><?php echo $module->currSymbol;?><?php echo $module->adultPrice;?></td>
            </tr>
            <?php } if($module->childStatus){ ?>
            <tr>
              <th scope="row"><?php echo trans('011');?> <span class="weak"><?php echo $module->currSymbol;?><?php echo $module->perChildPrice;?></span></th>
              <td>
                <select name="child" class="selectx changeInfo input-sm" id="selectedChild">
                  <option value="0">0</option>
                  <?php for($child = 1; $child <= $module->maxChild; $child++){ ?>
                  <option value="<?php echo $child;?>" <?php echo makeSelected($selectedChild, $child); ?> ><?php echo $child;?></option>
                  <?php } ?>
                </select>
              </td>
              <td class="text-center childPrice"><?php echo $module->currSymbol;?><?php echo $module->childPrice;?></td>
            </tr>
            <?php } if($module->infantStatus){  ?>
            <tr>
              <th scope="row"><?php echo trans('0282');?> <span class="weak"><?php echo $module->currSymbol;?><?php echo $module->perInfantPrice;?></span></th>
              <td>
                <select name="infant" class="selectx changeInfo input-sm" id="selectedInfants">
                  <option value="0">0</option>
                  <?php for($infant = 1; $infant <= $module->maxInfant; $infant++){ ?>
                  <option value="<?php echo $infant;?>" <?php echo makeSelected($selectedInfants, $infant); ?> ><?php echo $infant;?></option>
                  <?php } ?>
                </select>
              </td>
              <td class="text-center infantPrice"><?php echo $module->currSymbol;?><?php echo $module->infantPrice;?></td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
        <div class="row">
          <div class="col-md-12">
            <h4 class="well well-sm text-center size20" style="margin-top: 4px; margin-bottom: 14px;"><span style="color:#333333;" class="totalCost"><?php echo $module->currCode;?> <?php echo $module->currSymbol;?><strong><?php echo $module->totalCost;?></strong></span><br>
              <small style="font-size: 12px;"> <?php echo trans('0126');?> <span class="totaldeposit"> <?php echo $module->currCode;?> <?php echo $module->currSymbol;?><?php echo $module->totalDeposit;?></span> </small>
            </h4>
          </div>
          <div class="col-md-12">
            <button style="height: 64px; margin: 3px;" type="submit" class="btn btn-block btn-action btn-lg"><?php echo trans('0142');?></button>
          </div>
        </div>
      </form>
      <?php } ?>
      <!-- End Tour Form aside -->
      <!-- Start Car From aside -->
      <?php if($appModule == "cars"){ ?>
      <form class="form-horizontal" action="<?php echo base_url().$appModule;?>/book/<?php echo $module->bookingSlug;?>" method="GET" role="search">
        <div class="row form-group">
          <div class="col-xs-12">
            <label class="control-label go-right"><i class="icon_set_1_icon-21"></i> <?php echo trans('0210');?></label>
          </div>
          <div class="col-xs-12">
            <select name="pickupLocation" class="chosen-select RTL selectLoc" id="pickuplocation" required>
              <option value=""><?php echo trans('0447');?></option>
              <?php foreach($carspickuplocationsList as $locations): ?>
              <option value="<?php echo $locations->id;?>" <?php echo makeSelected($selectedpickupLocation, $locations->id); ?> ><?php echo $locations->name;?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>
        <div class="row form-group">
          <div class="col-xs-12">
            <label class="control-label go-right"><i class="icon_set_1_icon-21"></i> <?php echo trans('0211');?></label>
          </div>
          <div class="col-xs-12">
            <select name="dropoffLocation" class="chosen-select RTL selectLoc" id="droplocation" required>
              <option value=""><?php echo trans('0447');?></option>
              <?php if(!empty($selecteddropoffLocation)){ foreach($carsdropofflocationsList as $locations): ?>
              <option value="<?php echo $locations->id;?>" <?php echo makeSelected($selecteddropoffLocation, $locations->id); ?> ><?php echo $locations->name;?></option>
              <?php endforeach; } ?>
            </select>
          </div>
        </div>
        <div class="row form-group">
          <div class="col-xs-12">
            <label class="control-label go-right"><i class="icon_set_1_icon-53"></i> <?php echo trans('0210');?> <?php echo trans('08');?></label>
          </div>
          <div class="col-xs-12">
            <input id="departcar" name="pickupDate" value="<?php echo $module->pickupDate;?>" placeholder="date" type="text" class="form-control carDates" required>
          </div>
        </div>
        <div class="row form-group">
          <div class="col-xs-12">
            <label class="control-label go-right"><i class="icon_set_1_icon-52"></i> <?php echo trans('0210');?> <?php echo trans('0259');?></label>
          </div>
          <div class="col-xs-12">
            <select class="form-control input" name="pickupTime">
              <?php foreach($carModTiming as $time){ ?>
              <option value="<?php echo $time; ?>" <?php makeSelected($pickupTime,$time); ?> ><?php echo $time; ?></option>
              <?php } ?>
            </select>
          </div>
        </div>
        <div class="row form-group">
          <div class="col-xs-12">
            <label class="control-label go-right"><i class="icon_set_1_icon-53"></i> <?php echo trans('0211');?> <?php echo trans('08');?></label>
          </div>
          <div class="col-xs-12">
            <input id="returncar" name="dropoffDate" value="<?php echo $module->dropoffDate;?>" placeholder="date" type="text" class="form-control carDates" required>
          </div>
        </div>
        <div class="row form-group">
          <div class="col-xs-12">
            <label class="control-label go-right"><i class="icon_set_1_icon-52"></i> <?php echo trans('0211');?> <?php echo trans('0259');?></label>
          </div>
          <div class="col-xs-12">
            <select class="form-control input" name="dropoffTime">
              <?php foreach($carModTiming as $time){ ?>
              <option value="<?php echo $time; ?>" <?php makeSelected($dropoffTime,$time); ?> ><?php echo $time; ?></option>
              <?php } ?>
            </select>
          </div>
        </div>
        <input type="hidden" id="cartotals" value="<?php echo $module->showTotal; ?>">
        <div class="showTotal">
          <div class="col-xs-12 well well-sm text-center">
            <h4 class="totalCost"><?php echo trans('078');?> <?php echo $module->currCode;?> <?php echo $module->currSymbol;?><strong><span class="grandTotal"><?php echo $module->totalCost;?></span></strong></h4>
          </div>
          <div class="col-xs-12 h4">
            <small> <?php echo trans('0153');?> <?php echo $module->currCode;?> <?php echo $module->currSymbol;?><span class="totalTax"> <?php echo $module->taxAmount;?></span> </small>
            <div class="clearfix"></div>
            <small> <?php echo trans('0126');?> <?php echo $module->currCode;?> <?php echo $module->currSymbol;?><span class="totaldeposit"> <?php echo $module->totalDeposit;?></span> </small>
          </div>
        </div>
        <div class="clearfix"></div>
        <hr style="margin-top: 5px; margin-bottom: 12px;">
        <button type="submit" class="btn btn-block btn-action btn-lg"><?php echo trans('0142');?></button>
      </form>
      <?php } ?>
      <!-- End  Car From aside -->
      <input type="hidden" id="loggedin" value="<?php echo $usersession;?>" />
      <input type="hidden" id="itemid" value="<?php echo $module->id; ?>" />
      <input type="hidden" id="module" value="<?php echo $appModule;?>" />
      <input type="hidden" id="addtxt" value="<?php echo trans('029');?>" />
      <input type="hidden" id="removetxt" value="<?php echo trans('028');?>" />
      <!-- Start Add/Remove Wish list Review Section -->
      <hr>
      <div class="row">
        <?php if($appModule != "cars" && $appModule != "ean" && $appModule != "offers"){ ?>
        <div class="col-md-12 form-group"><button  data-toggle="collapse" data-parent="#accordion" class="writeReview btn-lg btn btn-success btn-block btn-lgs andes" href="#ADDREVIEW"><i class="icon_set_1_icon-68"></i> <?php echo trans('083');?></button></div>
        <?php if(!empty($reviews) > 0){ ?>
        <div class="col-md-12 form-group"><a href="#REVIEWS" class="tabsBtn btn btn-primary btn-lg btn-block btn-lgs andes"><i class="icon_set_1_icon-93"></i> <?php echo trans('0394');?></a></div>
        <?php } } ?>
      </div>
    </div>
    <!-- End Add/Remove Wish list Review Section -->
    <script>
      $(function(){

        $(".changeInfo").on("change",function(){
          var tourid = "<?php echo $module->id; ?>";
          var adults = $("#selectedAdults").val();
          var child = $("#selectedChild").val();
          var infants = $("#selectedInfants").val();
            $.post("<?php echo base_url()?>tours/tourajaxcalls/changeInfo",{tourid: tourid, adults: adults, child: child, infants: infants},function(resp){
            var result = $.parseJSON(resp);
            $(".adultPrice").html(result.currSymbol+result.adultPrice);
            $(".childPrice").html(result.currSymbol+result.childPrice);
            $(".infantPrice").html(result.currSymbol+result.infantPrice);
            $(".totalCost").html(result.currCode+" "+result.currSymbol+result.totalCost);
            $(".totaldeposit").html(result.currCode+" "+result.currSymbol+result.totalDeposit);
            console.log(result);
          })
        }); //end of change info
      })// end of document ready
    </script>
    <!-- aside -->
  

      <form class="single-search" action="<?php echo base_url().$appModule;?>/search" method="GET">
    <div class="collapsebtn go-text-right">
      <?php echo trans('0693');?>
      </div>
      <div id="frmsearch">
          <br>
    <div class="col-md-12 col-lg-12 col-sm-12 go-right" ng-controller="autoSuggest">
      <div class="form-group">
        <div class="clearfix"></div>
            <label class="control-label go-right"><i class="icon-location-6"></i> <?php echo trans('0254');?></label>
        <div class="clearfix"></div>
       <div angucomplete-alt id="<?php $appModule; ?>Search" input-name="txtSearch" initial-value="txtSearch" placeholder="<?php echo trans('0526');?>" pause="500" selected-object="selectedItem" remote-url="<?php echo base_url();?>home/suggestions/<?php echo $appModule; ?>" remote-url-request-formatter="remoteUrlRequestFn" remote-url-data-field="items" title-field="name" description-field="" minlength="2" input-class="form-control form-control-small" match-class="highlight">
        </div>
       
        <input type="hidden" name="searching" value="{{searching}}"> <input type="hidden" name="modType" value="{{modType}}"> 
      </div>
    </div>

    <!-- start hotels checkin checkout fields -->
    <?php if($appModule == "hotels"){ ?>
    <div class="col-md-12 col-sm-12 col-xs-12 go-right">
      <div class="form-group">
        <div class="clearfix"></div>
        <label class="control-label go-right size13"><i class="icon-calendar-7"></i> <?php echo trans('07');?></label>
        <input type="text" placeholder="<?php echo trans('07');?> " name="checkin" class="form-control mySelectCalendar dpd3" value="<?php echo @$checkin; ?>" required >
      </div>
    </div>
    <div class="col-md-12 col-sm-12 col-xs-12 go-right">
      <div class="form-group">
        <div class="clearfix"></div>
        <label class="control-label go-right size13"><i class="icon-calendar-7"></i> <?php echo trans('09');?></label>
        <input type="text" placeholder="<?php echo trans('09');?> " name="checkout" class="form-control mySelectCalendar dpd4" value="<?php echo @$checkout; ?>" required >
      </div>
    </div>
    <?php } ?>
    <!-- end hotels checkin checkout fields -->

    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 go-right">
      <div class="form-group">
        <div class="clearfix"></div>
        <label class="control-label go-right size13" style="white-space:nowrap;"><i class="icon-user-7"></i> <?php if($appModule == "hotels"){ echo trans('010'); }else if($appModule == "tours"){ echo trans('0446'); } ?></label>
        <select  required class="form-control" placeholder=" <?php echo trans('');?> " name="adults" id="adults">
          <option value="">0</option>
          <?php for($Selectadults = 1; $Selectadults < 11;$Selectadults++){ ?>
          <option value="<?php echo $Selectadults;?>" <?php if($Selectadults == $modulelib->adults){ echo "selected"; } ?> > <?php echo $Selectadults;?> </option>
          <?php } ?>
        </select>
      </div>
    </div>
    <!-- start hotels child field -->
    <?php if($appModule == "hotels"){ ?>
    <div class="hidden-md col-lg-12 col-sm-12 col-xs-12 go-right">
      <div class="form-group">
        <div class="clearfix"></div>
        <label class="control-label go-right size13"><i class="icon-user-7"></i> <?php echo trans('011');?></label>
        <select  class="form-control" placeholder=" <?php echo trans('011');?> " name="child" id="child">
          <?php for($Selectchild = 0; $Selectchild < 6;$Selectchild++){ ?>
          <option value="<?php echo $Selectchild;?>" <?php if($Selectchild == @$modulelib->children){ echo "selected"; } ?> > <?php echo $Selectchild;?> </option>
          <?php } ?>
        </select>
      </div>
    </div>
    <?php } ?>
     <?php if( strpos( $_GET['txtSearch'], "-khu-vuc-" ) !== false ) {
            $ok = substr($_GET['txtSearch'], strpos($_GET['txtSearch'], "-khu-vuc-") + 9); 
            echo '<input type="hidden" name="near" value="'.$ok.'">';
        }
        ?>
    <!-- end hotels child field -->
   
    <div class="visible-sm visible-xs">
      <div class="clearfix"></div>
    </div>
    <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12 go-right">
      <div class="form-group">
        <div class="clearfix"></div>
        <button style="font-size: 14px;margin-top: 6px;" type="submit" class="btn btn-block btn-action"><?php echo trans('012');?></button>
      </div>
    </div>
    <div class="clearfix"></div>
    </div>
  </form>
     
    <div class="clearfix"></div>
    <br>    
<!------------------------  Related Listings   ------------------------------>
    
   <?php if(!empty($module->relatedItems)){ ?> 
   <div class="list-group">
    <div class="panel panel-default">
      <div class="panel-heading go-text-right"><?php if($appModule == "hotels" || $appModule == "ean"){ echo trans('0290'); }else if($appModule == "tours"){ echo trans('0453'); }else if($appModule == "cars"){ echo trans('0493'); } ?></div>
        <?php
          foreach($module->relatedItems as $item): ?>
        <div class="featured">
          <a href="<?php echo $item->slug;?>" class="col-md-12 col-sm-12 col-xs-12 go-right" >
          <img class="img-responsive post-img img-fade" src="<?php echo $item->thumbnail;?>" alt="<?php echo character_limiter($item->title,15);?>" />
          </a>
          <div class="desc col-md-12 col-sm-12 col-xs-12 go-left">
            <h4 style="margin-top: 0px;" class="go-text-right purple"><a href="<?php echo $item->slug;?>" ><?php echo character_limiter($item->title,15);?></a></h4>
            <div><?php echo $item->location;?> <?php echo $item->stars;?></div>
            <span class="pull-right">
                        <?php  if($item->price > 0){ ?>
                        <?php echo trans('0561');?><?php echo $item->price;?><?php echo $item->currSymbol; ?>
                        <?php } ?>
                        
                      </span>
          </div>
          <!--//desc-->
        </div>
        <!--//item-->
        <hr style="margin-top:10px;margin-bottom:10px">
        <?php endforeach; ?>
      </div>
    </div> 
    <?php } ?>
<!------------------------  Related Listings   ------------------------------>

<!------------------------  REcntly Viewed Listings   ------------------------------>
<?php if(!empty($recents)){ ?>
<div class="list-group">
    <div class="panel panel-default">
        <div class="panel-heading go-text-right"><?php echo trans('0798');?></div>
    <?php foreach($recents as $recent) { ?>
        <div class="featured"><div class="desc col-md-12 col-sm-12 col-xs-12 go-left">
            <?php
    $results = recentlyViewed($recent);
    foreach ($results as $row) {
        $locationInfoUrl = pt_LocationsInfo($row->hotel_city);

        $countryName = url_title($locationInfoUrl->country, 'dash', true);
        $cityName = url_title($locationInfoUrl->city, 'dash', true);

        $slug = $countryName.'/'.$cityName.'/'.$row->hotel_slug;
        echo "<div><a href='".base_url()."hotels/".$slug."'>" . $row->hotel_title . "</a></div>" .pt_create_stars($row->hotel_stars);
        
    }
    ?>
        </div></div><hr style="margin-top:10px;margin-bottom:10px">
        <?php
}
?>
</div>
    </div> 
    <?php } ?>    
<!------------------------  REcntly Viewed Listings   ------------------------------>


  </div>
</div>

<script>
  //------------------------------
  // Write Reviews
  //------------------------------
    $(function(){
    $('.reviewscore').change(function(){
    var sum = 0;
    var avg = 0;
    var id = $(this).attr("id");
    $('.reviewscore_'+id+' :selected').each(function() {
    sum += Number($(this).val());
    });
    avg = sum/5;
    $("#avgall_"+id).html(avg);
    $("#overall_"+id).val(avg);
    });

    //submit review
    $(".addreview").on("click",function(){
    var id = $(this).prop("id");
    $.post("<?php echo base_url();?>admin/ajaxcalls/postreview", $("#reviews-form-"+id).serialize(), function(resp){
    var response = $.parseJSON(resp);
    // alert(response.msg);
    $("#review_result"+id).html("<div class='alert "+response.divclass+"'>"+response.msg+"</div>").fadeIn("slow");
    if(response.divclass == "alert-success"){
    setTimeout(function(){
    $("#ADDREVIEW").removeClass('in');
    $("#ADDREVIEW").slideUp();
    }, 5000);
    }
    });
    setTimeout(function(){
    $("#review_result"+id).fadeOut("slow");
    }, 3000);
    });
    })

  //------------------------------
  // Add to Wishlist
  //------------------------------
    $(function(){
    // Add/remove wishlist
    $(".wish").on('click',function(){
    var loggedin = $("#loggedin").val();
    var removelisttxt = $("#removetxt").val();
    var addlisttxt = $("#addtxt").val();
    var title = $("#itemid").val();
    var module = $("#module").val();
    if(loggedin > 0){ if($(this).hasClass('addwishlist')){
     var confirm1 = confirm("<?php echo trans('0437');?>");
     if(confirm1){
    $(".wish").removeClass('addwishlist btn-primary');
    $(".wish").addClass('removewishlist btn-warning');
    $(".wishtext").html(removelisttxt);
    $.post("<?php echo base_url();?>account/wishlist/add", { loggedin: loggedin, itemid: title,module: module }, function(theResponse){ });
     }
     return false;
    }else if($(this).hasClass('removewishlist')){
    var confirm2 = confirm("<?php echo trans('0436');?>");
    if(confirm2){
    $(".wish").addClass('addwishlist btn-primary'); $(".wish").removeClass('removewishlist btn-warning');
    $(".wishtext").html(addlisttxt);
    $.post("<?php echo base_url();?>account/wishlist/remove", { loggedin: loggedin, itemid: title,module: module }, function(theResponse){
    });
    }
    return false;
    } }else{ alert("<?php echo trans('0482');?>"); } });
    // End Add/remove wishlist
    })

  //------------------------------
  // Rooms
  //------------------------------

    $('.collapse').on('show.bs.collapse', function () {
    $('.collapse.in').collapse('hide');  });
    <?php if($appModule == "hotels"){ ?>
    jQuery(document).ready(function($) {
    $('.showcalendar').on('change',function(){
    var roomid = $(this).prop('id');
    var monthdata = $(this).val();
    $("#roomcalendar"+roomid).html("<br><br><div id='rotatingDiv'></div>");
    $.post("<?php echo base_url();?>hotels/roomcalendar", { roomid: roomid, monthyear: monthdata}, function(theResponse){ console.log(theResponse);
    $("#roomcalendar"+roomid).html(theResponse);  }); }); });
    <?php } ?>

</script>