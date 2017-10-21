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
       <div angucomplete-alt id="<?php $appModule; ?>Search" input-name="txtSearch" initial-value="txtSearch" placeholder="<?php echo trans('0673');?>" pause="500" selected-object="selectedItem" remote-url="<?php echo base_url();?>home/suggestions/<?php echo $appModule; ?>" remote-url-request-formatter="remoteUrlRequestFn" remote-url-data-field="items" title-field="name" description-field="" minlength="2" input-class="form-control form-control-small" match-class="highlight">
        </div>
       
        <input type="hidden" name="searching" value="{{searching}}"> <input type="hidden" name="modType" value="{{modType}}"> 
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
     <?php if( strpos( $_GET['txtSearch'], "-khu-vuc-" ) !== false ) {
            $ok = substr($_GET['txtSearch'], strpos($_GET['txtSearch'], "-khu-vuc-") + 9); 
            echo '<input type="hidden" name="near" value="'.$ok.'">';
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
  
  <div style="clear:both;margin-bottom:30px;"></div>
  <div class="col-md-3 go-right honeyfilter">
      <?php if($appModule == "ean"){ }else{ ?>
  <form  action="<?php echo base_url().$appModule;?>/search" method="GET" role="search">

    <!-- FILTERS -->
    <div class="filters offset-0 go-right">
      
      <!-- Star ratings -->
      <button type="button" class="collapsebtn go-text-right" data-toggle="collapse" data-target="#collapse1">
      <?php //echo trans('0137');?> <?php echo trans('069');?> <span class="collapsearrow"></span>
      </button>
      <div id="collapse1" class="collapse in">
        <div class="hpadding20">
          <br>
          <?php $star = '<i class="star text-warning fa fa-star voted"></i>'; ?>
          <?php $stars = '<i class="fa fa-star-o"></i>'; ?>
          <div  class="rating" style="font-size: 14px;">
            <div class="go-right"><input id="1" type="radio" name="stars" class="go-right radio" value="1" <?php if(@$_GET['stars'] == "1"){echo "checked";}?>>&nbsp;&nbsp;<label class="go-left" for="1"><?php echo $star; ?><?php for($i=1;$i<=6;$i++){ ?> <?php echo $stars; ?> <?php } ?></label></div>
            <div class="clearfix"></div>
            <div class="go-right"><input id="2" type="radio" name="stars" class="radio go-right" value="2" <?php if(@$_GET['stars'] == "2"){echo "checked";}?>>&nbsp;&nbsp;<label class="go-left" for="2"><?php for($i=1;$i<=2;$i++){ ?> <?php echo $star; ?> <?php } ?><?php for($i=1;$i<=5;$i++){ ?> <?php echo $stars; ?> <?php } ?></label></div>
            <div class="clearfix"></div>
            <div class="go-right"><input id="3" type="radio" name="stars" class="radio" value="3" <?php if(@$_GET['stars'] == "3"){echo "checked";}?>>&nbsp;&nbsp;<label class="go-left" for="3"><?php for($i=1;$i<=3;$i++){ ?> <?php echo $star; ?> <?php } ?><?php for($i=1;$i<=4;$i++){ ?> <?php echo $stars; ?> <?php } ?></label></div>
            <div class="clearfix"></div>
            <div class="go-right"><input id="4" type="radio" name="stars" class="radio" value="4" <?php if(@$_GET['stars'] == "4"){echo "checked";}?>>&nbsp;&nbsp;<label class="go-left" for="4"><?php for($i=1;$i<=4;$i++){ ?> <?php echo $star; ?> <?php } ?><?php for($i=1;$i<=3;$i++){ ?> <?php echo $stars; ?> <?php } ?></label></div>
            <div class="clearfix"></div>
            <div class="go-right"><input id="5" type="radio" name="stars" class="radio" value="5" <?php if(@$_GET['stars'] == "5"){echo "checked";}?>>&nbsp;&nbsp;<label class="go-left" for="5"><?php for($i=1;$i<=5;$i++){ ?> <?php echo $star; ?> <?php } ?><?php for($i=1;$i<=2;$i++){ ?> <?php echo $stars; ?> <?php } ?></label></div>
            <div class="clearfix"></div>
            <div class="go-right"><input id="7" type="radio" name="stars" class="radio" value="7" <?php if(@$_GET['stars'] == "7"){echo "checked";}?>>&nbsp;&nbsp;<label class="go-left" for="7"><?php for($i=1;$i<=7;$i++){ ?> <?php echo $star; ?> <?php } ?></label></div>
          </div>
        </div>
        <div class="clearfix"></div>
        <br>
      </div>
      <!-- End of Star ratings -->
      <!-- Price range -->
      <button type="button" class="collapsebtn go-text-right" data-toggle="collapse" data-target="#collapse2">
      <?php echo trans('0301');?> <span class="collapsearrow"></span>
      </button>
      <div id="collapse2" class="collapse in">
        <?php if(!empty($_GET['price'])){ 
          $selectedprice = $_GET['price'];
          }else{
          $selectedprice = "0,0";// $minprice.",".$maxprice;
          } ?>
        <div class="padding20">
          <div class="layout-slider wh100percent">
            <span class="cstyle09">
            <input id="Slider1" type="slider" value="<?php echo $selectedprice; ?>" />
             <input id="getvar" type="hidden" name="price" value="<?php echo $selectedprice; ?>"/>
            </span>
          </div>
          <script type="text/javascript" >
            jQuery("#Slider1").slider({ from: <?php echo @$minprice;?>, to: <?php echo @$maxprice;?>, step: 5, smooth: true, round: 0, dimension: "&nbsp;<?php echo $currSign; ?>", skin: "round", onstatechange: function( value ){

            if(value != $("#getvar").val()){
             $("#getvar").val(value);  
            }else{
             $("#getvar").val("");    
            }   } });
          </script>
        </div>
      </div>
      <!-- End of Price range -->
      <!-- Module types -->
      <button type="button" class="collapsebtn go-text-right" data-toggle="collapse" data-target="#collapse3">
      <?php if($appModule == "hotels"){ echo trans('0478'); }else if($appModule == "tours"){ echo trans('0366'); }else if($appModule == "cars"){ echo trans('0214'); } ?> <span class="collapsearrow"></span>
      </button>
      <div id="collapse3" class="collapse in">
        <div class="hpadding20">
          <br>
          <div class="clearfix"></div>
          <?php @$vartype = $_GET['type'];
            if(empty($vartype)){
            $vartype = array();
            }
            foreach($moduleTypes as $mtype){
              if(!empty($mtype->name)){
                if($appModule == "hotels"){
            ?>
          <div class="go-right"> <input type="checkbox" value="<?php echo $mtype->id;?>" <?php if(in_array($mtype->id,$vartype)){echo "checked";}?> name="type[]" id="<?php echo $mtype->name;?>" class="checkbox" /> <label for="<?php echo $mtype->name;?>" class="css-label go-left">&nbsp;&nbsp;<?php echo $mtype->name;?></label></div>
          <div class="clearfix"></div>
          <?php }else if($appModule == "tours" || $appModule == "cars"){ ?>
          <div class="go-right"><input class="radio" type="radio" value="<?php echo $mtype->id;?>" name="type" id="<?php echo $mtype->name;?>" class="checkbox go-right" <?php if($mtype->id == $vartype){echo "checked";}?> /><label for="<?php echo $mtype->name;?>" class="css-label go-left"> &nbsp;&nbsp; <?php echo $mtype->name;?> &nbsp;&nbsp;</label></div>
          <div class="clearfix"></div>
          <?php } } } ?>
          <br>
        </div>
        <div class="clearfix"></div>
      </div>
      <!-- End of Module Types -->
      <!-- Hotel Amenities -->
      <?php if(!empty($amenities)){ ?>
      <button type="button" class="collapsebtn last go-text-right" data-toggle="collapse" data-target="#collapse4">
      <?php echo trans('0249');?> <span class="collapsearrow"></span>
      </button>
      <div id="collapse4" class="collapse in">
        <div class="hpadding20">
          <br>
          <div class="clearfix"></div>
          <?php @$varAmt = $_GET['amenities'];
            if(empty($varAmt)){
            $varAmt = array();
            }
            foreach($amenities as $hamt){
            ?>
          <div class="go-right"><input type="checkbox" value="<?php echo $hamt->id;?>" <?php if(in_array($hamt->id,$varAmt)){echo "checked";}?> name="amenities[]" id="<?php echo $hamt->name;?>" class="checkbox" /><label for="<?php echo $hamt->name;?>" class="css-label go-left"> <img class="go-right" style="height: 22px;margin-right:5px;margin-left:5px" src="<?php echo $hamt->icon;?>">  <?php echo $hamt->name;?></label></div>
          <div class="clearfix"></div>
          <?php } ?>
        </div>
        <div class="clearfix"></div>
      </div>
      <?php } ?>
      <?php if($appModule == "cars"){ ?>
      <button type="button" class="collapsebtn go-text-right" data-toggle="collapse" data-target="#collapse5">
      <?php echo trans('0207');?> <span class="collapsearrow"></span>
      </button>
      <div id="collapse5" class="collapse in">
        <div class="hpadding20">
          <br>
          <div class="clearfix"></div>
          <select class="selectx" name="pickup">
            <option value=""> <?php echo trans('0158');?></option>
            <option value="yes" <?php echo makeSelected($selectedPickup, "yes"); ?>  ><?php echo trans('0363');?></option>
            <option value="no" <?php echo makeSelected($selectedPickup, "no"); ?> ><?php echo trans('0364');?></option>
          </select>
        </div>
      </div>
      <?php } ?>
      <!-- End of Hotel Amenities -->
      <!-- Hotel Nearby -->
      <div class="clearfix"></div>
      <?php if(!empty($nears)){ ?>
      <button type="button" class="collapsebtn last go-text-right" data-toggle="collapse" data-target="#collapse5">
      <?php echo trans('0601');?> <span class="collapsearrow"></span>
      </button>
      <div id="collapse5" class="collapse in">
        <div class="hpadding20">
          <br>
          <?php @$varNear = $_GET['near'];
            if(empty($varNear)){
            $varNear = array();
            }
            foreach($nears as $near){
                $eachnear = explode(',', $near->near);
                foreach($eachnear as $item){
            ?>
          <div class="go-right"><input type="radio" value="<?php echo trim($item);?>" <?php if(trim($item)==str_replace("+", ' ', $varNear)) {echo "checked";}?> name="near" id="<?php echo trim($item);?>" class="checkbox" /><label for="<?php echo trim($item);?>" class="css-label go-left">&nbsp;<?php echo trim($item);?></label></div>
            <?php }} ?>
        </div>
      </div>
      <?php } ?>

      <!-- End Hotel Nearby -->
      <div class="clearfix"></div>
      <br/>
      <input type="hidden" name="txtSearch" value="<?php if(!empty($_GET['txtSearch'])){ echo $_GET['txtSearch']; } ?>">
      <input type="hidden" name="modType" value="<?php if(!empty($_GET['modType'])){ echo $_GET['modType']; } ?>">
      <input type="hidden" name="city" value="<?php if(!empty($_GET['city'])){ echo $_GET['city']; }else{ echo $selectedCity; } ?>">
      <input type="hidden" name="checkIn" value="<?php echo $checkin; ?>">
      <input type="hidden" name="checkOut" value="<?php echo $checkout; ?>">
      <input type="hidden" name="childages" value="<?php echo $childAges; ?>">
      <input type="hidden" name="adults" value="<?php echo $adults; ?>">
      <input type="hidden" name="honeymoon" value="<?php if(!empty($_GET['honeymoon'])){ echo $_GET['honeymoon']; } ?>">
      <input type="hidden" name="searching" value="<?php echo $selectedLocation;?>">
      <input name="sortby" type="hidden" class="sortby" value="<?php if(!empty($_GET['sortby'])){ echo $_GET['sortby']; } ?>">
      <button style="border-radius:0px" type="submit" class="btn btn-action btn-lg btn-block" id="searchform"><?php echo trans('012');?></button>
    </div>
    <!-- END OF FILTERS -->
  </form>

  <?php }  ?>
       </div>
  
  <div class="visible-xs"><br><br></div>
  <!-- LIST CONTENT-->
  <div class="rightcontent col-md-9 offset-0">
    <div class="itemscontainer offset-1">

      <?php if(!empty($module)) { foreach($module as $item){ ?>
      <div class="offset-2">
                        <div class="wow fadeInUp col-lg-4 col-md-4 col-sm-4 offset-0 go-right">
                            <!-- Add to whishlist -->
        <?php if ($appModule != "ean" && $appModule != "offers") { ?>
                                <span  ><?php echo wishListInfo($appModule, $item->id); ?></span>
        <?php } ?>
                            <!-- Add to whishlist -->
        <?php if (is_sales_off_hotel($item->id)) $khuyenmai = "khuyenmai";
        else $khuyenmai = ""; ?>
                            <div class="img_list <?php echo $khuyenmai; ?>">
                                <a href="<?php echo $item->slug; ?>">
                                    <img src="<?php echo $item->thumbnail; ?>" alt="<?php echo character_limiter($item->title, 20); ?>">
                                    <div class="short_info"></div>
                                </a>
                            </div>
                        </div>
                        <div class="wow fadeInUp col-md-8 offset-0">
                            <div class="itemlabel3">
                                <div class="labelright go-left" style="min-width:105px;margin-left:5px">
                                    <br/>
                                    <div class="purple size18 text-center">
        <?php if ($item->price > 0) {
            if ($item->price_status == 'Yes') {
                ?>
                                                <b>
                <?php echo $item->price; ?><div class="smalltext">(<?php echo $item->currSymbol; ?>)</div>
                                                </b>
                                                <div class="clearfix"></div>
                                                <hr>
            <?php } else { ?>
                                                <div class='click-2get-price'>
                                                    <a id="popoverData" href="#emailme<?php echo $item->id; ?>" data-toggle="modal" data-content="<?php echo trans('0800'); ?>" rel="popover" data-placement="top" data-original-title="<?php echo $item->title; ?>" data-trigger="hover"><div class="click-a"><?php echo trans('0799'); ?></div><i class="fa fa-check-circle-o" aria-hidden="true"></i></a>
                                                     
                                                </div>
                                                <div class="clearfix"></div>
                                                <hr>
                        <?php
                        }
                    }
                    ?>
        <?php if (pt_is_module_enabled('reviews')) { ?>
            <?php if ($item->avgReviews->overall > 0) { ?>
                                                <div class="review text-center size18"><i class="icon-thumbs-up-4"></i><?php echo $item->avgReviews->overall; ?></div>
                                                <!--<?php echo $item->avgReviews->totalReviews; ?>-->
                                                <div class="clearfix"></div>
                                                <hr>
            <?php } ?>
                    <?php } ?>

                    <?php if ($appModule == "ean") {
                        if ($item->tripAdvisorRating > 0) { ?>
                                                <div class="review text-center size18"><i class="icon-thumbs-up-4"></i><?php echo $item->tripAdvisorRating; ?> </div>
                                                <div class="clearfix"></div>
                                                <hr>
            <?php }
        } ?>
                                        <a href="<?php echo $item->slug; ?>">
                                            <button type="submit" class="btn btn-action"><?php echo trans('0177'); ?></button>
                                        </a>
                                    </div>
                                </div>
                                <div class="labelleft2 rtl_title_home">
                                    <h4 class="mtb0 RTL go-text-right">
                                        <a href="<?php echo $item->slug; ?>"><b><?php echo $item->title; ?></b></a>
                                        <!-- Cars airport pickup -->  <?php if ($appModule == "cars") {
            if ($item->airportPickup == "yes") { ?> <button class="btn btn-success btn-xs"><i class="icon-paper-plane-2"></i> <?php echo trans('0207'); ?></button> <?php }
        } ?> <!-- Cars airport pickup -->
                                    </h4>
        <?php if ($appModule != "offers") { ?> <a class="go-right" href="javascript:void(0);" onclick="showMap('<?php echo base_url(); ?>home/maps/<?php echo $item->latitude; ?>/<?php echo $item->longitude; ?>/<?php echo $appModule; ?>/<?php echo $item->id; ?>', 'modal');" title="<?php echo $item->location; ?>"><i style="margin-left: -3px;" class="icon-location-6 go-right"></i><?php echo character_limiter($item->location, 10); ?></a> <span class="go-right"><?php echo $item->stars; ?></span> <?php } ?>
                                    <br>
        <?php if (is_sales_off_hotel($item->id)) { ?>
                                        <div class="purple sale-off-now-icon"><?php echo trans('0709'); ?>
                                            <span class="sale-percent-star"><?php echo "-" . is_sales_off_hotel($item->id) . "%"; ?></span>
                                        </div>

        <?php } ?>
                                    <br/><br/>
                                    <p class="grey RTL"><?php echo character_limiter($item->desc, 100); ?></p>
                                    <br/>
        <?php if ($appModule == "hotels") { ?>

                                        <ul class="hotelpreferences go-right hidden-xs">
            <?php $cnt = 0;
            foreach ($item->amenities as $amt) {
                $cnt++;
                if ($cnt <= 10) {
                    if (!empty($amt->name)) { ?>
                                                        <img title="<?php echo $amt->name; ?>" data-toggle="tooltip" data-placement="top" style="height:25px;" src="<?php echo $amt->icon; ?>" alt="<?php echo $amt->name; ?>" />
                    <?php }
                }
            } ?>
                                        </ul>
                                        <br>
            <?php
            if ($item->vatvalue == 0 || $item->servicevalue == 0) {
                echo "<div class='price-include'>";
                echo trans('0700');
                echo "- " . trans('0701') . " ";
                if ($item->vatvalue == 0)
                    echo "- " . trans('0702') . " 10% ";
                if ($item->servicevalue == 0)
                    echo "- " . trans('0703') . " 5%";
                echo "</div>";
            }
        }
        ?>
                                </div>

                            </div>
                        </div>





                        <div class="clearfix"></div>
                        <script type="text/javascript">
                            $(window).load(function(){

                            $(".successemail<?php echo $item->id; ?>").on('click', function(){
                            var youremail = $(".youremail<?php echo $item->id; ?>").val();
                            var yourphone = $(".yourphone<?php echo $item->id; ?>").val();
                            var itemid = <?php echo $item->id; ?>;
                            var duration = "từ " + $(".dpd1").val() + " đến " + $(".dpd2").val();
                            $('#getresponse<?php echo $item->id; ?>').html('<div id="rotatingDiv"></div>');
                            $.post("<?php echo base_url(); ?>admin/ajaxcalls/laygiaEmail", {email: youremail, phone: yourphone, id: itemid, hotel: duration}, function(resp){
                            //alert(resp);
                            if (resp === "done") {
                            console.log(resp);
                            $("#getresponse<?php echo $item->id; ?>").html("");
                            $('.email-me-modal<?php echo $item->id; ?>').modal('hide');
                            $('#openModal<?php echo $item->id; ?>').modal('show');
                            var myModal = $('#openModal<?php echo $item->id; ?>');
                            clearTimeout(myModal.data('hideInterval'));
                            myModal.data('hideInterval', setTimeout(function(){
                            myModal.modal('hide');
                            }, 4000));
                            } else {alert(resp); $("#getresponse<?php echo $item->id; ?>").html("<span class='error'>Đã có lỗi xảy ra, chúng tôi đang xem xét.<span>");}
                            });
                            });
                            });
                        </script>
                        <div id="emailme<?php echo $item->id; ?>" class="modal fade email-me-modal<?php echo $item->id; ?>" tabindex="-1" data-focus-on="input:first" style="display: none;">
                            <div class="modal-dialog click-2email">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <div class="hotel-name">
        <?php echo trans('0801'); ?>
                                        </div>
                                    </div>
                                    <div class="modal-body">
                                        <div class="panel-body">

                                            <div class="col-md-12 col-sm-12 col-xs-12 go-right">
                                                <div class="form-group">
                                                    <div class="clearfix"></div>
                                                    <input type="text" placeholder="<?php echo trans('0804'); ?> " name="youremail" id="youremail<?php echo $item->id; ?>" class="form-control youremail<?php echo $item->id; ?>" required >
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-sm-12 col-xs-12 go-right">
                                                <div class="form-group">
                                                    <div class="clearfix"></div>
                                                    <input type="text" placeholder="<?php echo trans('0805'); ?> " name="yourphone" id="yourphone<?php echo $item->id; ?>" class="form-control yourphone<?php echo $item->id; ?>" required >
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <br>
                                            <div class="hotel-modal-title"><?php echo trans('0802'); ?></div>
                                            <br>
                                            <!--<a id="successemail" style="margin-bottom:5px;float:none;" href="#openModal" type="submit" class="btn btn-action chk successemail" data-toggle="modal" data-content="<?php echo trans('0800'); ?>" rel="popover" data-placement="top" data-original-title="<?php echo $item->title; ?>" data-trigger="hover"><?php echo trans('0806'); ?></a>-->

                                            <button id="successemail<?php echo $item->id; ?>" style="margin-bottom:5px;float:none;" type="submit" class="btn btn-action chk successemail<?php echo $item->id; ?>"><?php echo trans('0806'); ?></button>
                                            <div id="getresponse<?php echo $item->id; ?>"></div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div id="openModal<?php echo $item->id; ?>" class="modal fade" tabindex="-1" data-focus-on="input:first" style="display: none;">
    <div class="modal-dialog email-confirm">
        <div class="modal-content">

            <div class="modal-body">
                <div class="panel-body">
                    <div class='purple'><strong><i class='fa fa-check-square-o' aria-hidden='true'></i> <?php echo trans('0807'); ?></strong></div>
                    <div><?php echo trans('0808'); ?></div>
                    <div class="clearfix"></div>
                </div>
            </div>

        </div>
    </div>
</div>





                    </div>
                    <div class="clearfix"></div>
                    <div class="offset-2">
                        <hr style="margin-top: 10px; margin-bottom: 10px;">
                    </div>
      <?php } ?>
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