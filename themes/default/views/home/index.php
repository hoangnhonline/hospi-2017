<?php require $themeurl . 'views/home/slider.php'; ?>
<!--<link href="js/jquery.mCustomScrollbar.css" rel="stylesheet" />-->
<style>

    .scrollcontent{height: 302px;
                   padding: 0 0 10px;
                   overflow: auto;
                   -moz-border-radius: 3px;
                   .scrollcontent p:nth-child(even){color:#999; font-family:Georgia,serif; font-size:17px; font-style:italic;}
                   .scrollcontent p:nth-child(3n+0){color:#c96;}
    </style>
    <div class="container">
        <br><br>
        <div class="destination">
            <div class="form-group col-md-4"> <h2 class="main-title go-right andes-bold">&nbsp;<?php //echo trans('0550'); ?></h2> <div class="clearfix"></div></div>
            <div class="col-md-8"><span class="rounded-icon"><i class="fa fa-gift" aria-hidden="true"></i></span>&nbsp;<span style="color:#660033;"><?php echo trans('0580'); ?>: </span><?php foreach ($randomoffer as $offer) { ?>
                <a class="sub-menu-link" href="<?php echo $offer->slug; ?>" target="_blank"><?php echo $offer->title; ?></a>
            <?php } ?>
                <span class="pull-right hospi-color"><a href="<?php echo base_url()?>offers/"><i class="fa fa-angle-double-right" aria-hidden="true"></i> <?php echo trans('0564'); ?></a></span></div>
            <div class="clearfix"></div>
            <!-- Destination -->
            <!--<div class="row">
                <div class="col-md-4 col-sm-12 col-xs-12 wow zoomIn animated featured-dest"><?php echo run_widget(84);?></div>
                <div class="col-md-4 col-sm-12 col-xs-12 wow zoomIn animated featured-dest"><?php echo run_widget(85);?></div>
                <div class="col-md-4 col-sm-12 col-xs-12 wow zoomIn animated featured-dest"><?php echo run_widget(86);?></div>
            </div>-->
        </div>
        <div class="why">
            <!-- Why hospi -->
            <div class="row">
                <div class="col-md-4 col-sm-12 col-xs-12 why-txt">
                    <h2 class="main-title go-right andes-bold"><span class="waldisney">Why? </span><?php echo trans('0551'); ?></h2>
                    <ul class="why-hospi">
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
                    </ul>
                </div>
                <div class="banner-khuyenmai col-md-8 col-sm-12 col-xs-12 wow fadeInUp animated why-img">
                <div id="carousel-widget" class="carousel slide" data-ride="carousel">


  <!-- Wrapper for slides -->
  <div class="carousel-inner">
      <?php
      $ad2 = get_widget_content(121);

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
                </div>
        </div>
        <!--<div class="khuyenmai">-->
            <!-- Khuyen mai -->
            <!--<div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class=" gray-box">
                        <span class="bandroll"><?php echo trans('0558'); ?></span>
                        <select id="salesoff" name="salesoff">
                            <option value=""><?php echo trans('0687'); ?></option>
                            <?php $salelocation = getLocations();
                            foreach($salelocation as $loc){
                                echo "<option value='".$loc->id."'>".$loc->location."</option>";
                            }?>
                        </select>
                        <div style="clear:both;"></div>
                        <div id="saleresponse">
                            <div id="scrolljob" class="scrollcontent">
                                <ul class="item-khuyenmai">
                                    <?php foreach ($salesoffHotels as $sale) { ?>
                                        <li><div class="row">
                                                <a href="<?php echo $sale->slug; ?>">
                                                    <div class="col-md-8 col-sm-8 col-xs-12 home-featured-hotel-left">
                                                        <span class="home-featured-hotel-title"><?php echo $sale->title; ?></span>
                                                        <span class="home-featured-hotel-rating"><?php echo $sale->stars; ?></span>
                                                        <span class="home-featured-hotel-address"><?php echo $sale->mapAddress; ?></span>
                                                    </div>
                                                    <div class="col-md-4 col-sm-4 col-xs-12 home-featured-hotel-right">
                                                        <span class="home-featured-hotel-price"><?php echo $sale->price." ".$sale->currSymbol; ?></span>
                                                        <span class="home-from-to"><?php echo "(từ " . date('d/m', $sale->salefrom) . "-" . date('d/m/Y', $sale->saleto) . ")"; ?></span>
                                                    </div>
                                                </a>
                                            </div>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class=" gray-box">
                        <span class="bandroll"><div class="best-icon"><?php echo trans('0559'); ?></div></span>
                        <select id="featured" name="featured">
                            <option value=""><?php echo trans('0687'); ?></option>
                            <?php $location = getLocations();
                            foreach($location as $loc){
                                echo "<option value='".$loc->id."'>".$loc->location."</option>";
                            }?>
                        </select>
                        <div style="clear:both;"></div>
                        <div id="response">
                            <ul class="item-bestchoice">
                            <?php foreach ($featuredHotels as $item) { ?>
                                <li>
                                    <a href="<?php echo $item->slug; ?>">
                                        <div class="home-featured-hotel-right">
                                            <span class="home-featured-hotel-price"><i class="fa fa-chevron-right" aria-hidden="true"></i></span>
                                        </div>
                                        <div class="home-featured-hotel-left">
                                            <span class="home-best-choice-img"><img class="dealthumb go-right" src="<?php echo $item->thumbnail; ?>" alt="<?php echo character_limiter($item->title, 35); ?>"></span>
                                            <span class="home-best-choice-hotel-title"><?php echo $item->title; ?></span>
                                            <span class="home-best-choice-hotel-rating"><?php echo $item->stars; ?></span>
                                            <span class="home-featured-hotel-address"><?php echo $item->mapAddress;?></span>
                                            <span class="home-best-choice-hotel-price"><?php echo $item->price." ".$item->currSymbol; ?></span>
                                        </div>
                                    </a>

                                </li>
                                <div style="clear:both;"></div>
                            <?php } ?>
                        </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>-->
        <div class="banner-khuyenmai">
            <!-- Khuyen mai -->
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="row">
                        <div id="carousel-banner" class="carousel slide" data-ride="carousel">


  <!-- Wrapper for slides -->
  <div class="carousel-inner">
      <?php
      $ad2 = get_widget_content(122);
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
    <li data-target="#carousel-banner" data-slide-to="<?php echo $l;?>" class="<?php echo $liclass; ?>"></li>

      <?php $l++; } ?>
  </ol>

</div> <!-- Carousel -->
                    </div>
                </div>
        </div>
    </div>

    <div class="lastminute4 featured-fampaigns">
        <div class="container">
                <div class="featuredCampaigns">
                    <div class="Campaigns">
                        <?php
                        $array = array();
                        foreach ($specialoffers as $offer) {
                            array_push($array, $offer->cityid);
                        }
                        $items = array_count_values($array);
                        $no = 1;
                        ?>
                        <ul class="col-md-3 col-sm-6 col-xs-12 nav-featured">
                            <?php foreach ($items as $key => $value) { ?>
                                    <div class="row">
                                        <li <?php if ($no == 1) echo 'class="active"'; ?>>
                                            <a href="javascript:void(0);" data-href="#hover<?php echo $key; ?>" class="li-link <?php if ($no == 1) echo 'active'; ?>">
                                                <?php echo pt_LocationsInfo($key)->city; ?>
                                            </a>
                                        </li>
                                    </div>
                                <?php $no++;
                            } ?>
                        </ul>
                        <div class="right-featured">
                            <?php $nu = 1;
                            foreach ($items as $key => $value) { ?>
                                                        <div id="hover<?php echo $key; ?>" class="col-md-9 col-sm-6 col-xs-12 sub-featured <?php if ($nu == 1) echo 'displayed'; ?>">
                                                            <div class="mega-menu">
                                                                <div class="mega-content">

                                                                    <ul class="div-sub-menu mh-menu">
                                <?php foreach ($specialoffers as $offer) {
                                    if ($offer->cityid == $key) {
                                        ?>
                                                                                <li>
                                                                                    <a class="col-md-7 col-sm-12 col-xs-12 sub-menu-link opensans" href="<?php echo $offer->slug; ?>" target="_blank"><?php echo $offer->title; ?></a>
                                                                                    <img class="col-md-5 col-sm-12 col-xs-12 offers-hover img-responsive" src="<?php echo $offer->thumbnail; ?>" alt="<?php echo character_limiter($offer->title, 15); ?>"/>
                                                                                </li>
                                    <?php }
                                }
                                ?>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <div class="mega-menu">
                                                            </div>
                                                        </div>
                                <?php $nu++;
                            } ?>
                        </div>
                    </div>
                </div>

        </div>
    </div>
    <div class="container">
        <div class="blog">
            <!-- Khuyen mai -->
            <div class="row">
                <div class="col-md-5 col-sm-5 col-xs-12 blog-items">
                    <div class="form-group"> <h2 class="main-title go-right andes-bold"><?php echo trans('0562'); ?></h2><div class="clearfix"></div></div>
                    <?php
                    $format = trans('0563') . " m";
                    foreach ($posts as $post) {
                        $datepost = date('d', $post->post_created_at);
                        $monthpost = date($format, $post->post_created_at);
                        $yearpost = date('Y', $post->post_created_at);
                        echo "<div class='post-item'><div class='row col-md-3 col-sm-6 col-xs-12'><span class='datepost'>" . $datepost . "</span>";
                        echo "<span class='monthpost'>" . $monthpost . "</span>";
                        echo "<span class='yearpost'>" . $yearpost . "</span></div>";
                        echo "<div class='col-md-9 col-sm-6 col-xs-12'><a href='/blog/" . $post->post_slug . "'>" . $post->post_title . "</a></div>";
                        echo "<span class='readmore link-color'><a href='/blog/" . $post->post_slug . "'><i class='fa fa-angle-double-right' aria-hidden='true'></i>" . trans('0564') . "</a></span><div style='clear:both;'></div></div>";
                    }
                    ?>
                </div>

                <div class="col-md-1 col-sm-1 col-xs-12"></div>

                <div class="col-md-6 col-sm-6 col-xs-12 blog-items">
                    <div class="form-group"> <h2 class="main-title go-right andes-bold"><?php echo trans('0737'); ?></h2><div class="clearfix"></div></div>
                        <div class="row col-md-12 col-sm-12 col-xs-12">
                            <div class="row">
                                <?php foreach($hotelslocationsList as $loc){
                                $city_slug = create_slug($loc->name);
                                $country_slug = create_slug($loc->country);
                                echo '<div class="col-md-6 col-sm-6 col-xs-12">';
                                echo '<p class="where-location"><span class="hotel-location link-color"><a href="'.base_url().'hotels/search/'.$country_slug.'/'.$city_slug.'/'.$loc->id.'?txtSearch='.$loc->name.'&searching='.$loc->id.'&modType=location&checkin=&checkout=&adults=&child=">'.$loc->name.'</a></span>';
                                echo '<span class="pricetxt-location">'.trans('0566').' '.$item->currSymbol.'</span>';
                                echo '</p><p><span class="count-location">'.$loc->total.' ';echo trans('Hotels').'</span>';
                                echo '<span class="price-location link-color">'.$loc->bestprices.'</span>';
                                echo '</p></div>';
                            } ?>
                                </div>
                        </div>
                    </div>
                </div>

        </div>
        <div class="banner-khuyenmai">
            <!-- Khuyen mai -->
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="row">
                        <div id="carousel-banner2" class="carousel slide" data-ride="carousel">


  <!-- Wrapper for slides -->
  <div class="carousel-inner">
      <?php
      $ad2 = get_widget_content(122);
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
    <li data-target="#carousel-banner2" data-slide-to="<?php echo $l;?>" class="<?php echo $liclass; ?>"></li>

      <?php $l++; } ?>
  </ol>

</div> <!-- Carousel -->
                    </div>
                </div>
        </div>

      <!-- <?php $honeymoonLocation = honeymoonWithLocations(3); if(!empty($honeymoonLocation)) { ?>
        <div class="honeymoon">
                <div class="honeymoon-pack"><div class="honey-icon"><?php echo trans('0567'); ?></div></div>
                <div style="clear:both;margin-bottom:15px;"></div>
                <div class="row">
                    <?php foreach($honeymoonLocation->locations as $honey){
                    $city_slug = create_slug($honey->name);
                    $country_slug = create_slug($honey->country);

                echo "<div class='col-md-4 col-sm-6 col-xs-12 absolute-div'>";
                echo "<div class='img_list'>";
                echo "<a href='".base_url()."hotels/search/".$country_slug."/".$city_slug."/".$honey->id."?txtSearch=".$honey->name."&searching=".$honey->id."&modType=location&checkin=&checkout=&adults=&child=&honeymoon=yes'><img class='absolute-img' src='".PT_ROOMS_IMAGES.$honey->thumbnail_image."'></a>";

                //echo "<a href='".base_url()."hotels/".$country_slug."/".$city_slug."/".$honey->hotel_slug."'><img class='absolute-img' src='".PT_ROOMS_IMAGES.$honey->thumbnail_image."'>";
                echo "<span class='absolute-txt'>".$honey->name."</span>";
                echo "<i class='fa fa-chevron-right absolute-icon' aria-hidden='true'></i>";
                echo "</a></div></div>";
//id, name, country, thumbnail_image, /hotels/search/united-arab-emirates/dubai/6?txtSearch=Dubai&searching=6&modType=location&checkin=&checkout=&adults=&child=
                }

                ?>
                </div>

        </div>
        <?php } ?>-->
        <div class="hotels-by-location">
            <!-- Khuyen mai -->

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 loc-items">
                        <div class="form-group">
                        <h2 class="main-title go-right andes-bold"><?php echo trans('0704'); ?></h2>
                        </div>
                        <div class="row">
                        <?php $locationlistings = getLocations('Vietnam');
                        foreach($locationlistings as $list){
                            $city_slug = create_slug($list->location);
                            $country_slug = create_slug($list->country);
                            if($list->feature=="Yes") $feature="purple"; else $feature="";
                            echo '<div class="col-md-2 col-sm-6 col-xs-12 loc-items '.$feature.'">';
                            echo "<a href='".base_url()."hotels/search/".$country_slug."/".$city_slug."/".$list->id."?txtSearch=".$list->location."&searching=".$list->id."&modType=location&checkin=&checkout=&adults=&child='>";
                            echo $list->location;
                            echo '</a></div>';
                            //http://dev4.webico.vn/hospi/hotels/search/vietnam/phu-quoc/37?txtSearch=Ph%C3%BA%20Qu%E1%BB%91c&searching=37&modType=location&checkin=&checkout=&adults=&child=
                        } ?>
                        </div>
                    </div>
                </div>

        </div>


    </div>
    <!--<script src="js/min.js?1239" type="text/javascript"></script>-->
    <script type="text/javascript" src="js/home.js?r=3"></script>
    <!--<script type="text/javascript" src="js/slideshow.js"></script>-->
    <!-- custom scrollbars plugin -->
    <!--<script src="js/jquery.mCustomScrollbar.concat.min.js"></script>-->

    <script>
        /*(function ($) {
            $(window).load(function () {
                $("#scrolljob").mCustomScrollbar({
                    autoHideScrollbar: true,
                    theme: "light-thin"
                });
            });


        })(jQuery);*/

          $("#featured").change(function(){
              var city = $("#featured :selected").val();
              $("#response").html("<div id='rotatingDiv'></div>");
              $.post("<?php echo base_url();?>home/ajax_getFeaturedHotels",
              {loc:city,limit:3},
              function(response){

                  console.log(response);

	    var json_obj = $.parseJSON(response);//parse JSON
            //var json_obj = JSON.parse(JSON.stringify(response));

            var output="<ul class='item-bestchoice'>";
            //for (var i=0 ; i < 3 ; i++)
            for (var i in json_obj)
            {
                if (json_obj.hasOwnProperty(i)) {
                    output+="<li><a href='" + json_obj[i].slug + "'><div class='home-featured-hotel-right'>";
                    output+="<span class='home-featured-hotel-price'><i class='fa fa-chevron-right' aria-hidden='true'></i></span></div>";
                    output+="<div class='home-featured-hotel-left'><span class='home-best-choice-img'>";
                    output+="<img class='dealthumb go-right' src='" + json_obj[i].thumbnail + "' alt='" + json_obj[i].title + "'>";
                    output+="</span><span class='home-best-choice-hotel-title'>" + json_obj[i].title + "</span>";
                    output+="<span class='home-best-choice-hotel-rating'>" + json_obj[i].stars + "</span>";
                    output+="<span class='home-featured-hotel-address'>" + json_obj[i].mapAddress + "</span>";
                    output+="<span class='home-best-choice-hotel-price'>" + json_obj[i].price + " " + json_obj[i].currSymbol + "</span>";
                    output+="</div></a></li>";
                }
            }
            output+="</ul>";

            $('#response').html(output);

            }


    )});

    $("#salesoff").change(function(){
              var loc = $("#salesoff :selected").val();
              $("#saleresponse").html("<div id='rotatingDiv'></div>");
              $.post("<?php echo base_url();?>home/ajax_getSaleoffHotels",
              {loc:loc},
              function(data){

                  console.log(data);
	    var sale_json_obj = $.parseJSON(data);//parse JSON
            var saleoutput="<div id='scrolljob' class='scrollcontent'><ul class='item-khuyenmai'>";

            for (var j in sale_json_obj)
            {
                if (sale_json_obj.hasOwnProperty(j)) {
                    var fromdate = new Date(sale_json_obj[j].salefrom*1000);
                    var todate = new Date(sale_json_obj[j].saleto*1000);


                    var frommonth = fromdate.getMonth();
                    var fromdate = fromdate.getDate();
                    var from = fromdate + "/" + frommonth;

                    var toyear = todate.getFullYear();
                    var tomonth = todate.getMonth();
                    var to_date = todate.getDate();
                    var to = to_date + "/" + tomonth + "/" + toyear;


                    saleoutput+="<li><div class='row'><a href='" + sale_json_obj[j].slug + "'><div class='col-md-8 col-sm-8 col-xs-12 home-featured-hotel-left'>";
                    saleoutput+="<span class='home-featured-hotel-title'>" + sale_json_obj[j].title + "</span>";
                    saleoutput+="<span class='home-featured-hotel-rating'>" + sale_json_obj[j].stars + "</span>";
                    saleoutput+="<span class='home-featured-hotel-address'>" + sale_json_obj[j].mapAddress + "</span></div>";
                    saleoutput+="<div class='col-md-4 col-sm-4 col-xs-12 home-featured-hotel-right'>";
                    saleoutput+="<span class='home-featured-hotel-price'>" + sale_json_obj[j].price + " " +sale_json_obj[j].currSymbol + "</span>";
                    saleoutput+="<span class='home-from-to'>(từ " + from + "-" + to + ")</span>";
                    saleoutput+="</div></a></div></li>";
                }
            }
            saleoutput+="</ul></div>";
            $('#saleresponse').html(saleoutput);

            }

        )});

    </script>
