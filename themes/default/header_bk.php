<!DOCTYPE html>
<?php $CI = &get_instance(); $ishome = $CI->uri->segment(1); $currenturl = uri_string(); $app_settings = $CI->settings_model->get_settings_data(); $allowreg = $app_settings[0]->allow_registration; $allowsupplierreg = $app_settings[0]->allow_supplier_registration; if(!empty($metadesc)){ $metadescription = $metadesc; }else{ if( empty($ishome)){ $metadescription = $app_settings[0]->meta_description; } } if(!empty($metakey)){ $metakeywords = $metakey; }else{ if(empty($ishome)){ $metakeywords =  $app_settings[0]->keywords; } } $lang_set = $CI->theme->_data['lang_set']; $langname = $CI->session->userdata('lang_name'); $isRTL = isRTL($lang_set); if(empty($langname)){ $langname = languageName($lang_set); }else{ $langname = $langname; } ?>
<html ng-app="phptravelsApp">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php echo @$metadescription; ?>">
    <meta name="keywords" content="<?php echo @$metakeywords; ?>">
    <meta name="author" content="HOSPI">
    <meta property="fb:app_id" content="159189514584032" />
    <title><?php if(empty($ishome)){ echo $app_settings[0]->home_title; }else{ echo $CI->theme->_data['page_title']; } ?></title>
    <link rel="shortcut icon" href="<?php echo PT_GLOBAL_IMAGES_FOLDER.'favicon.png';?>">
    <!--<link href="<?php echo $theme_url; ?>assets/css/bootstrap-modal.css" rel="stylesheet" media="screen">-->
    <link href="<?php echo $theme_url; ?>assets/css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="<?php echo $theme_url; ?>assets/css/bootstrap-slider.css" rel="stylesheet" media="screen">
    <link href="<?php echo $theme_url; ?>assets/css/custom.css" rel="stylesheet" media="screen">
    <!-- facebook --------> 
    <meta property="og:title" content="<?php if(empty($ishome)){ echo $app_settings[0]->home_title; }else{ echo $CI->theme->_data['page_title']; } ?>"/>
    <meta property="og:site_name" content="<?php echo $app_settings[0]->site_title;?>"/>
    <meta property="og:description" content="<?php if($app_settings[0]->seo_status == "1"){echo $metadescription;}?>"/>
    <meta property="og:publisher" content="https://www.facebook.com/<?php echo $app_settings[0]->site_title;?>"/>
    <script type="application/ld+json">{"@context":"http://schema.org/","@type":"Organization","name":"<?php echo $app_settings[0]->site_title;?>","url":"<?php echo $app_settings[0]->site_url;?>/","logo":"<?php echo base_url(); ?>uploads/global/favicon.png","sameAs":"https://www.facebook.com/<?php echo $app_settings[0]->site_title;?>","sameAs":"https://twitter.com/<?php echo $app_settings[0]->site_title;?>","sameAs":"https://www.pinterest.com/<?php echo $app_settings[0]->site_title;?>/","sameAs":"https://plus.google.com/u/0/<?php echo $app_settings[0]->site_title;?>/posts","contactPoint":{"@type":"ContactPoint","telephone":"<?php echo $phone; ?>","contactType":"Customer Service"}}{"@context":"http://schema.org","@type":"WebSite","name":"<?php echo $app_settings[0]->site_title;?>","url":"<?php echo $app_settings[0]->site_url;?>"}  </script>
    <!--[if lt IE 9]>        <script src="<?php echo $theme_url; ?>assets/js/html5shiv.js"></script> <script src="<?php echo $theme_url; ?>assets/js/respond.min.js"></script><![endif]-->
    <!-- BASE CSS ---------> 
    <link href="<?php echo $theme_url; ?>style.css" rel="stylesheet">
    <style> @import "<?php echo $theme_url; ?>childtheme/childstyle.css"; </style>
    <!-- Google Maps ------> <script type="text/javascript" src="//maps.googleapis.com/maps/api/js?key=<?php echo $app_settings[0]->mapApi; ?>&libraries=places"></script>
    <!-- jQuery -----------> <script src="<?php echo $theme_url; ?>assets/js/jquery-1.11.2.min.js"></script> <script src="<?php echo $theme_url; ?>assets/js/wow.min.js"></script>
    <!-- RTL CSS ----------> <?php if($isRTL == "RTL"){ ?>
    <link href="<?php echo $theme_url; ?>RTL.css" rel="stylesheet">
    <?php } ?>
    <!-- Mobile Redirect --> <?php if($app_settings[0]->mobile_redirect_status == "Yes"){ if($ishome != "invoice"){ ?> <script>if(/Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent)){ window.location ="<?php echo $app_settings[0]->mobile_redirect_url ?>";}</script> <?php } } ?>
    <!--[if lt IE 7]>        
    <link rel="stylesheet" type="text/css" href="<?php echo $theme_url; ?>assets/css/font-awesome-ie7.css" media="screen" />
    <![endif]-->
    <link rel="stylesheet" href="<?php echo $theme_url; ?>assets/css/jquery-ui.css" />
  </head>
  <body id="top">
    <div id="wait">
      <div class="lds-css ng-scope">
        <div style="width:100%;height:100%" class="lds-flickr">
          <!-- <div class="rotatingwait"></div> -->
          <div class="spinner">
            <div class="dot1"></div>
            <div class="dot2"></div>
            <div class="dot3"></div>
          </div>
        </div>
      </div>
    </div>
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.8&appId=159189514584032";
      fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));
    </script>
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <script type='text/javascript'>window._sbzq||function(e){e._sbzq=[];var t=e._sbzq;t.push(["_setAccount",59360]);var n=e.location.protocol=="https:"?"https:":"http:";var r=document.createElement("script");r.type="text/javascript";r.async=true;r.src=n+"//static.subiz.com/public/js/loader.js";var i=document.getElementsByTagName("script")[0];i.parentNode.insertBefore(r,i)}(window);</script>
    <?php $currenturl = base_url(uri_string());?>
    <div class="navbar navbar-static-top navbar-default <?php echo @$hidden; ?>">
      <div class="container">
        <div class="navbar">
          <!-- Navigation-->
          <?php if (strpos($currenturl, 'blog') !== false) { ?>
          <div class="col-md-3">
            <?php } else { ?>
            <div class="col-md-2">
              <?php } ?>
              <div class="navbar-header go-right">
                <button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                </button>
                <?php if (strpos($currenturl, 'blog') !== false) { ?>
                <a href="<?php echo base_url(); ?>blog" class="navbar-brand"><img src="<?php echo PT_GLOBAL_IMAGES_FOLDER.$app_settings[0]->footer_logo_img;?>" alt="<?php echo $app_settings[0]->site_title;?>" class="logo"/></a>
                <?php } else { ?>
                <a href="<?php echo base_url(); ?>" class="navbar-brand"><img src="<?php echo PT_GLOBAL_IMAGES_FOLDER.$app_settings[0]->header_logo_img;?>" alt="<?php echo $app_settings[0]->site_title;?>" class="logo"/></a>
                <?php } ?>
              </div>
            </div>
            <?php if (strpos($currenturl, 'blog') !== false) { echo '<div class="col-md-9">'; } else { echo '<div class="col-md-6">'; }?>
            <div class="navbar-collapse collapse">
              <ul class="nav navbar-nav navbar-right go-left top-menu">
                <?php if (strpos($currenturl, 'blog') !== false) { ?>
                <li class="blog dropdown <?php if($current=='') echo 'active';?> go-right">
                  <a class="dropdown-toggle" href="<?php echo base_url(); ?>blog"> <?php echo trans('01');?> </a>
                  <div class="current-page"></div>
                </li>
                <li class="blog dropdown <?php if($current=='diem-den') echo 'active';?> go-right">
                  <a class="dropdown-toggle" href="<?php echo base_url(); ?>blog/category/diem-den"> <?php echo trans('0759');?> </a>
                  <div class="current-page"></div>
                </li>
                <li class="blog dropdown <?php if($current=='am-thuc') echo 'active';?> go-right">
                  <a class="dropdown-toggle" href="<?php echo base_url(); ?>blog/category/am-thuc"> <?php echo trans('0760');?> </a>
                  <div class="current-page"></div>
                </li>
                <li class="blog dropdown <?php if($current=='kinh-nghiem') echo 'active';?> go-right">
                  <a class="dropdown-toggle" href="<?php echo base_url(); ?>blog/category/kinh-nghiem"> <?php echo trans('0824');?> </a>
                  <div class="current-page"></div>
                </li>
                <li class="blog dropdown <?php if($current=='khach-san-va-resort') echo 'active';?> go-right">
                  <a class="dropdown-toggle" href="<?php echo base_url(); ?>blog/category/khach-san-va-resort"> <?php echo trans('0825');?> </a>
                  <div class="current-page"></div>
                </li>
                <li class="blog dropdown <?php if($current=='khuyen-mai') echo 'active';?> go-right">
                  <a class="dropdown-toggle" href="<?php echo base_url(); ?>blog/category/khuyen-mai"> <?php echo trans('0558');?> </a>
                  <div class="current-page"></div>
                </li>
                <li class="blog dropdown <?php if($current=='anh-video') echo 'active';?> go-right">
                  <a class="dropdown-toggle" href="<?php echo base_url(); ?>blog/category/anh-video"> <?php echo trans('0763');?> </a>
                  <div class="current-page"></div>
                </li>
                <?php } else { ?>
                <!--<li class="dropdown <?php pt_active_link();?> go-right">
                  <a class="dropdown-toggle" href="<?php echo base_url(); ?>"> <?php echo trans('01');?> </a>
                  </li>-->
                <?php  $hmenu = get_header_menu();
                  if(!empty($hmenu)){
                  $menuitems = json_decode($hmenu[0]->menu_items);
                  if(!empty($menuitems)){
                  $icons = TRUE;
                  foreach($menuitems as $hm){
                  $pinfo =  get_page_details($hm->id);
                  foreach($pinfo as $pagesinfo){
                  $parent = parent_info($pagesinfo,$icons,$lang_set);
                  /*$ischildactive = child_page_active($hm->children);
                  if(!empty($hm->children) && $ischildactive){
                  $dropdownmenu = "dropdown-menu";
                  $dropdown = "dropdown";
                  $dropdowntoggle = "dropdown-toggle";
                  $datatoggle = "data-toggle='dropdown'";
                  $caret = "<span class='caret'></span>";
                  }else{*/
                   $dropdownmenu = "";
                  $dropdown = "";
                  $dropdowntoggle = "";
                  $datatoggle = "";
                  $caret = "";
                  //}
                  ?>
                <li class="main-menu go-right <?php echo $dropdown." ".pt_active_link($pagesinfo->page_slug);?>">
                  <?php if($pagesinfo->page_slug=="honeymoon") { ?>
                  <a href="<?php echo base_url();?>hotels/honeymoon" class="<?php pt_active_link($pagesinfo->page_slug).' '.$dropdowntoggle;?>" <?php echo $datatoggle;?>  target="<?php echo $parent['target'];?>" >
                  <?php } else { ?>
                  <a href="<?php echo $parent['hreflink'];?>" class="<?php pt_active_link($pagesinfo->page_slug).' '.$dropdowntoggle;?>" <?php echo $datatoggle;?>  target="<?php echo $parent['target'];?>" >
                    <?php } ?><!--<i class='<?php  echo $parent['icons'];?>'></i>--> <?php echo  $parent['pagetitle'];?>  <?php echo $caret;?>
                    <div class="current-page"></div>
                  </a>
                  <?php if(!empty($hm->children)){  ?>
                  <ul class="<?php echo $dropdownmenu;?>">
                    <?php foreach($hm->children as $ch){
                      $children =  get_page_details($ch->id);
                      foreach($children as $childinfo){
                      $child = child_info($childinfo,$icons,$lang_set);
                      ?>
                    <li>
                      <a href="<?php  echo $child['hrefchild'];?>" target="<?php echo $child['childtarget'];?>" ><i class='<?php echo $child['icons'];?>'></i> <?php echo $child['childtitle'];?> </a>
                    </li>
                    <?php } } ?>
                  </ul>
                  <?php } ?>
                  <?php if(!$ishome) { ?>
                  <!-- Hotels menu hover -->
                  <?php if($pagesinfo->page_slug=="hotels") { ?>
                  <span class="<?php echo $pagesinfo->page_slug;?>">
                    <div class="col-md-4 blog-items header-quantam">
                      <div class="form-group">
                        <h3 class="main-title go-right andes-bold"><?php echo trans('0583'); ?></h3>
                        <div class="clearfix"></div>
                      </div>
                      <div class="row col-md-12">
                        <a href="<?php echo base_url();?>offers/sales">
                          <div class="header-khuyenmai-gray"><?php echo trans('0558'); ?></div>
                        </a>
                        <a href="<?php echo base_url();?>offers/bestchoice">
                          <div class="header-bestchoice-gray"><?php echo trans('0559'); ?></div>
                        </a>
                        <a href="<?php echo base_url();?>offers">
                          <div class="header-deals-gray"><?php echo trans('0580'); ?></div>
                        </a>
                      </div>
                      <div class="col-md-12 header-quantam-contact">
                        <div class="col-md-6">
                          <?php echo trans('0585'); ?>
                          <div class="header-bold">09 6868 0106</div>
                        </div>
                        <div class="col-md-6">
                          <?php echo trans('094'); ?><br>
                          <div class="header-bold"><?php echo $contactemail; ?></div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-1"></div>
                    <div class="col-md-7 blog-items">
                      <div class="form-group">
                        <h3 class="main-title go-right andes-bold"><?php echo trans('0582'); ?></h3>
                        <div class="clearfix"></div>
                      </div>
                      <div class="row col-md-12 col-sm-12 col-xs-12 header-where">
                        <div class="row">
                          <?php foreach($hotelslocationsList as $toploc){
                            $city_slug = create_slug($toploc->name);
                            $country_slug = create_slug($toploc->country);
                            echo '<div class="col-md-6 col-sm-6 col-xs-12">';
                            echo '<div class="where-location"><p class="hotel-location link-color"><a href="'.base_url().'hotels/search/'.$country_slug.'/'.$city_slug.'/'.$toploc->id.'?txtSearch='.$toploc->name.'&searching='.$toploc->id.'&modType=location&checkin=&checkout=&adults=&child=">'.$toploc->name.'</a></p>';
                            echo '<p class="pricetxt-location">'.trans('0566').' '.$toploc->currSymbol.'</p>';
                            echo '</div><div class="headprice"><p class="count-location">'.$toploc->total.' ';echo trans('Hotels').'</p>';
                            echo '<p class="price-location link-color">'.$toploc->bestprices.'</p>';
                            echo '</div></div>';
                            } ?>
                        </div>
                      </div>
                      <div class="clearfix"></div>
                      <div align="center">
                        <a class="noikhac" href="<?php echo base_url()?>hotels/"><?php echo trans('0584'); ?><i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                      </div>
                    </div>
                  </span>
                  <?php } ?>
                  <!-- End Hotels menu hover -->
                  <!-- Tours menu hover -->
                  <?php if($pagesinfo->page_slug=="tours") { ?>
                  <?php if(pt_main_module_available('tours')){ ?>
                  <span class="<?php echo $pagesinfo->page_slug;?>">
                    <div class="col-md-5 blog-items header-quantam">
                      <div class="form-group">
                        <h3 class="main-title go-right andes-bold"><?php echo trans('0587'); ?></h3>
                        <div class="clearfix"></div>
                      </div>
                      <div class='header_tour_img img_list'>
                        <?php $randomTours = randomTours();
                          foreach($randomTours->locations as $randtour){
                              $tour_city_slug = create_slug($randtour->name);
                              $tour_country_slug = create_slug($randtour->country);?>
                        <a href="<?php echo base_url()."tours/".$tour_country_slug."/".$tour_city_slug."/".$randtour->slug;?>">
                          <img class='absolute-img' src="<?php echo PT_TOURS_SLIDER_THUMB.$randtour->thumbnail_image;?>">
                          <div class="absolute-icon"><?php echo $randtour->title;?>
                            <i class='fa fa-chevron-right' aria-hidden='true'></i>
                          </div>
                        </a>
                        <?php }  ?>
                      </div>
                      <div class="col-md-12 header-quantam-contact">
                        <div class="col-md-6">
                          <?php echo trans('0585'); ?>
                          <div class="header-bold">09 6868 0106</div>
                        </div>
                        <div class="col-md-6">
                          <?php echo trans('094'); ?><br>
                          <div class="header-bold"><?php echo $contactemail; ?></div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-7 blog-items">
                      <div class="form-group">
                        <h3 class="main-title go-right andes-bold">&nbsp;</h3>
                        <div class="clearfix"></div>
                      </div>
                      <div class="row col-md-12 col-sm-12 col-xs-12 header-where">
                        <div class="row">
                          <?php $toursLocation = toursWithLocations();
                            foreach($toursLocation->locations as $local){
                                $city_slug = create_slug($local->name);
                                $country_slug = create_slug($local->country);?>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <a href="<?php echo base_url();?>tours/search/<?php echo $country_slug."/".$city_slug."/".$local->id."?txtSearch=".$local->name."&searching=".$local->id."&modType=location";?>">
                              <div class="header-tours-gray">
                                <?php echo $local->name; ?>
                              </div>
                            </a>
                          </div>
                          <?php }  ?>
                        </div>
                      </div>
                      <div align="center">
                        <a class="noikhac" href="<?php echo base_url()?>tours/"><?php echo trans('0586'); ?><i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                      </div>
                    </div>
                  </span>
                  <?php } } ?>
                  <!-- End Tours menu hover -->
                  <!-- Honeymoon menu hover -->
                  <?php if($pagesinfo->page_slug=="honeymoon") { ?>
                  <?php if(pt_main_module_available('hotels')){ ?>
                  <span class="<?php echo $pagesinfo->page_slug;?>">
                    <div class="col-md-12">
                      <div class="row">
                        <?php $honeymoonLocation = honeymoonWithLocations(6); $i=1;
                          foreach($honeymoonLocation->locations as $honey){
                              $city_slug = create_slug($honey->name);
                              $country_slug = create_slug($honey->country);
                              if($i==4) {
                                  echo "<div class='col-md-4'>";
                                  echo "<div class='top_img_list' style='margin-bottom:10px;'>";
                                  echo "<a href='".base_url()."hotels/search/".$country_slug."/".$city_slug."/".$honey->id."?txtSearch=".$honey->name."&searching=".$honey->id."&modType=location&checkin=&checkout=&adults=&child=&honeymoon=yes'><img class='absolute-img' src='".PT_ROOMS_IMAGES.$honey->thumbnail_image."'></a>";
                                  echo "<div class='absolute-txt'>".$honey->name."</div>";
                                  echo "<i class='fa fa-chevron-right absolute-icon' aria-hidden='true'></i>";
                                  echo "</a></div>";
                              }
                              elseif($i==5) {
                                  echo "<div class='top_img_list honeyleft'>";
                                  echo "<a href='".base_url()."hotels/search/".$country_slug."/".$city_slug."/".$honey->id."?txtSearch=".$honey->name."&searching=".$honey->id."&modType=location&checkin=&checkout=&adults=&child=&honeymoon=yes'><img class='absolute-img' src='".PT_ROOMS_IMAGES.$honey->thumbnail_image."'></a>";
                                  echo "<div class='absolute-txt'>".$honey->name."<div class='chevon'><i class='fa fa-chevron-right absolute-icon' aria-hidden='true'></i></div></div>";
                                  //echo "<i class='fa fa-chevron-right absolute-icon' aria-hidden='true'></i>";
                                  echo "</a></div></div>";
                              } else {
                                  echo "<div class='col-md-2'>";
                                  echo "<div class='img_list'>";
                                  echo "<a href='".base_url()."hotels/search/".$country_slug."/".$city_slug."/".$honey->id."?txtSearch=".$honey->name."&searching=".$honey->id."&modType=location&checkin=&checkout=&adults=&child=&honeymoon=yes'><img class='absolute-img' src='".PT_ROOMS_IMAGES.$honey->thumbnail_image."'></a>";
                                  echo "<div class='absolute-txt'>".$honey->name."</div>";
                                  echo "<i class='fa fa-chevron-right absolute-icon' aria-hidden='true'></i>";
                                  echo "</a></div></div>";
                              }
                              $i++;
                          }
                          
                          ?>
                      </div>
                    </div>
                    <div class="clearfix" style="margin-bottom:40px;"></div>
                    <div class="col-md-6 header-quantam-contact">
                      <div class="col-md-6">
                        <?php echo trans('0585'); ?>
                        <div class="header-bold">09 6868 0106</div>
                      </div>
                      <div class="col-md-6">
                        <?php echo trans('094'); ?><br>
                        <div class="header-bold"><?php echo $contactemail; ?></div>
                      </div>
                    </div>
                    <div class="col-md-6 header-quantam-contact">
                      <div align="center">
                        <a class="noikhac" href="<?php echo base_url()?>hotels/honeymoon/"><?php echo trans('0672'); ?><i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                      </div>
                    </div>
                    <!--<div class="col-md-5 blog-items header-quantam">
                      <div class="form-group"> <h3 class="main-title go-right andes-bold"><?php echo trans('0587'); ?></h3><div class="clearfix"></div></div>
                      <div class='header_tour_img img_list'>
                          <?php $randomTours = randomTours();
                        foreach($randomTours->locations as $randtour){
                            $tour_city_slug = create_slug($randtour->name);
                            $tour_country_slug = create_slug($randtour->country);?>
                          <a href="<?php echo base_url()."tours/".$tour_country_slug."/".$tour_city_slug."/".$randtour->slug;?>">
                          <img class='absolute-img' src="<?php echo PT_TOURS_SLIDER_THUMB.$randtour->thumbnail_image;?>">
                          <div class="absolute-icon"><?php echo $randtour->title;?>
                          <i class='fa fa-chevron-right' aria-hidden='true'></i></div></a>
                          <?php }  ?>
                      </div>
                      <div class="col-md-12 header-quantam-contact">
                          <div class="col-md-6">
                      <?php echo trans('0585'); ?>
                      <div class="header-bold">09 6868 0106</div>
                              </div>
                          <div class="col-md-6">
                      <?php echo trans('094'); ?><br>
                      <div class="header-bold"><?php echo $contactemail; ?></div>
                      </div>
                          </div>
                      </div>
                      <div class="col-md-7 blog-items">
                      <div class="form-group"> <h3 class="main-title go-right andes-bold">&nbsp;</h3><div class="clearfix"></div></div>
                      <div class="row col-md-12 col-sm-12 col-xs-12 header-where">
                      <div class="row">
                      
                              <?php $toursLocation = toursWithLocations();
                        foreach($toursLocation->locations as $local){
                            $city_slug = create_slug($local->name);
                            $country_slug = create_slug($local->country);?>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                      
                                  <a href="<?php echo base_url();?>tours/search/<?php echo $country_slug."/".$city_slug."/".$local->id."?txtSearch=".$local->name."&searching=".$local->id."&modType=location&type=&date=&adults=";?>/">
                                  <div class="header-tours-gray">
                                          <?php echo $local->name; ?>
                                      </div>
                                  </a>
                      
                          </div>
                          <?php }  ?>
                          </div>
                      </div>
                      
                      <div align="center">
                      <a class="noikhac" href="<?php echo base_url()?>tours/"><?php echo trans('0586'); ?><i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                      </div>
                      </div>-->
                  </span>
                  <?php } } ?>
                  <!-- End Honeymoon menu hover -->
                  <!-- Deals menu hover -->
                  <?php if($pagesinfo->page_slug=="offers") { ?>
                  <span class="<?php echo $pagesinfo->page_slug;?>">
                    <div class="col-md-4 blog-items header-quantam">
                      <div class="header-offer-content">
                        <div class="form-group">
                          <h2 class="main-title go-right andes-bold"><?php echo trans('0558'); ?></h2>
                          <div class="clearfix"></div>
                        </div>
                        <?php echo trans('0588'); ?>
                      </div>
                      <div class="clearfix"></div>
                      <div align="center">
                        <a class="noikhac" href="<?php echo base_url()?>offers/sales"><?php echo trans('0564'); ?><i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                      </div>
                    </div>
                    <div class="col-md-8 blog-items">
                      <div class="view-table">
                        <div class="place-row">
                          <div class="place-cell">
                            <h3 class="main-title go-right andes-bold">
                            <?php echo trans('0589'); ?></h2>
                          </div>
                          <div class="place-cell">
                            <h3 class="main-title go-right andes-bold">
                            <?php echo trans('0590'); ?></h2>
                          </div>
                          <div class="place-cell">
                            <h3 class="main-title go-right andes-bold">
                            <?php echo trans('0591'); ?></h2>
                          </div>
                        </div>
                        <?php $i=0; foreach ($salesoffHotels as $topsale) { ?>
                        <div class="place-row childrow">
                          <div class="place-cell">
                            <a href="<?php echo $topsale->slug;?>" style="text-transform: none;"><?php echo $topsale->title; ?></a><?php echo $topsale->stars; ?>
                            <div class="header-featured-hotel-address"><a href="<?php echo $topsale->slug;?>" style="text-transform: none;"><?php echo $topsale->mapAddress; ?></a></div>
                          </div>
                          <div class="place-cell sale-percent">- <?php echo $topsale->salepercent; ?>%</div>
                          <div class="place-cell sale-price"><?php echo $topsale->price; ?></div>
                        </div>
                        <?php $i++;
                          if($i==4) break;
                          } ?>
                      </div>
                      <div class="clearfix"></div>
                      <div class="col-md-12 header-quantam-contact">
                        <div class="col-md-6">
                          <?php echo trans('0585'); ?>
                          <div class="header-bold">09 6868 0106</div>
                        </div>
                        <div class="col-md-6">
                          <?php echo trans('094'); ?><br>
                          <div class="header-bold"><?php echo $contactemail; ?></div>
                        </div>
                      </div>
                    </div>
                  </span>
                  <?php  } ?>
                  <!-- End Deals menu hover -->
                  <!-- Blog menu hover -->
                  <?php if($pagesinfo->page_slug=="blog") { ?>
                  <?php if(pt_main_module_available('blog')){ ?>
                  <span class="<?php echo $pagesinfo->page_slug;?>">
                    <div class="row col-md-6 blog-items header-quantam">
                      <?php $i=0; foreach($posts as $post){
                        if($i<2) { ?>
                      <div class="col-md-12">
                        <a href="/blog/<?php echo $post->post_slug;?>">
                          <div class="col-md-8">
                            <div class="form-group">
                              <h3 class="main-title go-right andes-bold"><?php echo $post->post_title;?></h3>
                              <div class="clearfix"></div>
                            </div>
                            <p><?php echo date('d/m/Y', $post->post_created_at);?></p>
                            <p><?php $desc = preg_replace('/(<)([img])(\w+)([^>]*>)/', '', $post->post_desc); echo st_substr($desc, 100, 3);?></p>
                          </div>
                          <div class="col-md-4">
                            <div class='header_blog_img img_list' style='min-height: 100px;'>
                              <?php if($post->post_img=='') { ?>
                              <img class='absolute-img' src="<?php echo PT_BLOG_IMAGES. 'blank.jpg';?>">
                              <?php } else { ?>
                              <img class='absolute-img' src="<?php echo PT_BLOG_THUMBS.$post->post_img;?>">
                              <?php } ?>
                            </div>
                          </div>
                        </a>
                      </div>
                      <div class="clearfix"></div>
                      <?php if($i==0) { echo "<div style='border-bottom: 1px solid #e2e2e2;margin-bottom: 15px;'></div>";}?>
                      <?php } elseif ($i==2) { ?>
                    </div>
                    <div class="row col-md-6 header-quantam">
                      <div class="col-md-6">
                        <a href="/blog/<?php echo $post->post_slug;?>">
                          <div class='header_secondblog_img img_list' style='min-height: 115px;margin-bottom: 10px;'>
                            <?php if($post->post_img=='') { ?>
                            <img class='absolute-img' src="<?php echo PT_BLOG_IMAGES. 'blank.jpg';?>">
                            <?php } else { ?>
                            <img class='absolute-img' src="<?php echo PT_BLOG_THUMBS.$post->post_img;?>">
                            <?php } ?>
                          </div>
                          <div class="form-group">
                            <h3 class="main-title go-right andes-bold"><?php echo $post->post_title;?></h3>
                            <div class="clearfix"></div>
                          </div>
                          <p><?php echo st_substr($post->post_desc, 120, 3);?></p>
                        </a>
                      </div>
                      <?php } else { ?>
                      <div class="col-md-6">
                        <a href="/blog/<?php echo $post->post_slug;?>">
                          <div class='header_secondblog_img img_list' style='min-height: 115px;margin-bottom: 10px;'>
                            <img class='absolute-img' src="<?php echo PT_BLOG_IMAGES.$post->post_img;?>">
                          </div>
                          <div class="form-group">
                            <h3 class="main-title go-right andes-bold"><?php echo $post->post_title;?></h3>
                            <div class="clearfix"></div>
                          </div>
                          <p><?php echo st_substr($post->post_desc, 120, 3);?></p>
                        </a>
                      </div>
                      <?php } $i++; } ?>
                      <div class="clearfix" style="margin-bottom:30px;"></div>
                      <div align="center">
                        <a class="noikhac" href="<?php echo base_url()?>blog/"><?php echo trans('0564'); ?><i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                      </div>
                      <div class="clearfix" style="margin-bottom:30px;"></div>
                    </div>
                  </span>
                  <?php } } ?>
                  <!-- End Blog menu hover -->
                  <?php } ?>
                </li>
                <?php } } } } ?>
                <?php } ?>
                <?php if(strpos($currenturl,'book') == false && $app_settings[0]->multi_curr == 1 && empty($hideCurr)){ $currencies = ptCurrencies(); ?>
                <form class="dropdown pull-right">
                  <div class="styled-select">
                    <select onchange="change_currency(this.value)" class="selectz" style="margin-top:16px;font-weight: 100;height: 2.3em;" name="currency" id="currency">
                      <?php foreach($currencies as $c){ ?>
                      <option value="<?php echo $c->id;?>" <?php makeSelected($currency,$c->code); ?>><?php echo $c->name;?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="clearfix"></div>
                </form>
                <?php } ?>
                <?php if (strpos($currenturl,'book') !== false || !empty($hideLang)) { }else{
                  if($app_settings[0]->multi_lang == '1') { $default_lang = $app_settings[0]->default_lang; if(!empty($lang_set)){ $default_lang = $lang_set; } ?>
                <li class="dropdown pull-right">
                  <a style="border-bottom: 0px;" href="javascript: void();" class="dropdown-toggle" data-toggle="dropdown"><img src="<?php echo PT_LANGUAGE_IMAGES.$default_lang.".png";?>" width="21" height="14" alt="<?php echo $langname;?>"> <?php echo $langname;?> </a>
                  <ul class="dropdown-menu">
                    <?php $language_list = pt_get_languages();?>
                    <?php foreach($language_list as $ldir => $lname){ $selectedlang = '';
                      if(!empty($lang_set) && $lang_set == $ldir){
                      $selectedlang = 'selected';
                      }elseif(empty($lang_set) && $default_lang == $ldir){ $selectedlang = 'selected'; } ?>
                    <li><a href="<?php echo pt_set_langurl($langurl,$ldir);?>" data-langname="<?php echo $lname['name'];?>" id="<?php echo $ldir; ?>" class="changelang" ><img src="<?php echo PT_LANGUAGE_IMAGES.$ldir.".png";?>" width="21" height="14" alt="">  <?php echo $lname['name'];?></a></li>
                    <?php } ?>
                  </ul>
                </li>
                <?php } ?>
                <?php  } ?>
              </ul>
            </div>
          </div>
          <?php if (strpos($currenturl, 'blog') == false) { ?>
          <div class="quick-menu">
            <div id="checkbooking" class="dropdown">
              <a class="go-right dropdown-toggle" data-toggle="dropdown" href="#" ><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
              <div class="check-booking dropdown-menu">
                <ul class="sub-quick-menu">
                  <li><i class="fa fa-chevron-right" aria-hidden="true"></i>
                    <a href="#checkbookingform" data-toggle="modal" data-content="<?php echo trans('0800'); ?>" rel="popover" data-placement="top" data-original-title="<?php echo $item->title; ?>" data-trigger="hover">Check booking</a>
                  </li>
                  <?php  if(!empty($customerloggedin)){ ?>
                  <?php echo trans('0579');?><?php echo $firstname; ?> |
                  <li>
                    <i class="fa fa-chevron-right" aria-hidden="true"></i><a href="<?php echo base_url()?>account/">  <?php echo trans('02');?></a>
                  </li>
                  <li>
                    <i class="fa fa-chevron-right" aria-hidden="true"></i><a href="<?php echo base_url()?>account/logout/">  <?php echo trans('03');?></a>
                  </li>
                  <?php }else{ if (strpos($currenturl,'book') !== false) { }else{ if($allowreg == "1"){ ?>
                  <li>
                    <i class="fa fa-chevron-right" aria-hidden="true"></i>
                    <a href="<?php echo base_url(); ?>login"><?php echo trans('04');?></a>
                  </li>
                  <li>
                    <i class="fa fa-chevron-right" aria-hidden="true"></i>
                    <a href="<?php echo base_url(); ?>register">  <?php echo trans('0115');?></a>
                  </li>
                  <?php } } } ?>
                </ul>
              </div>
            </div>
          </div>
          <div class="phone-menu">
            <div class="phone-cell">
              <i class="fa fa-phone" aria-hidden="true"></i> <?php echo $phone; ?>
            </div>
          </div>
          <div class="col-md-2 dat-ks-tour">
            <div class="hotline-cell">
              <div class="phone-item">
                <!--<span class="icon-phone-top"><i class="fa fa-phone" aria-hidden="true"></i></span>-->
                Hotline: 09 6868 0106<br>Zalo: 090 345 5152
              </div>
            </div>
          </div>
          <?php } ?>
        </div>
      </div>
    </div>
    <div class="visible-xs">
      <div style="margin-top:60px"></div>
    </div>
    <div id="checkbookingform" class="modal fade checkbooking-modal" tabindex="-1" data-focus-on="input:first" style="display: none;">
      <div class="modal-dialog click-2email">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <div class="hotel-name">
              Check booking
            </div>
          </div>
          <div class="modal-body">
            <div class="panel-body">
              <form class="checkbooking-form" action="<?php echo base_url(); ?>invoice/" method="GET">
                <div class="type-select">
                  <input type="radio" id="ck-hotel" class="booking-type" name="booking-type"><label for="ck-hotel" class="lb-hotel"><?php echo trans('0739');?></label>
                </div>
                <div class="type-select">
                  <input type="radio" id="ck-tour" class="booking-type" name="booking-type"><label for="ck-tour" class="lb-hotel"><?php echo trans('0740');?></label>
                </div>
                <div class="white-line"></div>
                <input type="text" class="form-control" name="sessid" placeholder="<?php echo trans('0741');?>">
                <button type="submit" class="btn-ck purple" name="do" value="check-booking"><?php echo trans('0738');?></button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>