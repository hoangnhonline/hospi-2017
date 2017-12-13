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
    <link href="<?php echo $theme_url; ?>assets/css/bootstrap-modal.css" rel="stylesheet" media="screen">
    <link href="<?php echo $theme_url; ?>assets/css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="<?php echo $theme_url; ?>assets/css/bootstrap-slider.css" rel="stylesheet" media="screen">
    <link href="<?php echo $theme_url; ?>assets/css/custom.css" rel="stylesheet" media="screen">

    <!-- Duc add css file -->
    <link href="<?php echo $theme_url; ?>assets/css/style.css" rel="stylesheet" media="screen">

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
  <body id="top" class="blog">
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
<!--hoangnhonline    <script type='text/javascript'>window._sbzq||function(e){e._sbzq=[];var t=e._sbzq;t.push(["_setAccount",59360]);var n=e.location.protocol=="https:"?"https:":"http:";var r=document.createElement("script");r.type="text/javascript";r.async=true;r.src=n+"//static.subiz.com/public/js/loader.js";var i=document.getElementsByTagName("script")[0];i.parentNode.insertBefore(r,i)}(window);</script>-->

    <?php $currenturl = base_url(uri_string());?>
    <!-- Duc add html header-top -->
    <div class="navbar navbar-static-top navbar-default">
        <div class="container">
            <div class="navbar row">
                <!-- Navigation-->
                <div class="col-md-3">
                    <div class="navbar-header go-right">
                        <button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a href="<?php echo base_url('blog'); ?>" class="navbar-brand"><img src="<?php echo $theme_url; ?>images/blog-logo.png" alt="HOSPI - Đặt phòng khách sạn" class="logo"></a>
                    </div>
                </div>
                <div class="col-md-9 hide">
                    <div class="navbar-collapse collapse">
                        <ul class="nav navbar-nav navbar-right go-left top-menu">
                            <li class="blog dropdown<?php echo $current == '' ? ' active' : '' ;?> go-right">
                                <a class="dropdown-toggle" href="<?php echo base_url('blog'); ?>"> Trang chủ </a>
                                <div class="current-page"></div>
                            </li>
                            <?php
                            if (!empty($categories)) {
                                foreach ($categories as $category) {
                                    echo '<li class="blog dropdown' . ($current == $category->slug ? ' active' : '') . ' go-right">'
                                        . '<a class="dropdown-toggle" href="' . base_url('blog/category/' . $category->slug) . '"> ' . $category->name . ' </a>'
                                        . '<div class="current-page"></div>'
                                    . '</li>';
                                }
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="menu-blog">
            <div class="container">
                <ul class="nav navbar2">
                    <li class="blog<?php echo $current == '' ? ' active' : '' ;?>">
                        <a href="<?php echo base_url('blog'); ?>"> Trang chủ </a>
                    </li>
                    <?php
                    if (!empty($categories)) {
                        foreach ($categories as $category) {
                            echo '<li class="blog dropdown' . ($current == $category->slug ? ' active' : '') . '">'
                                . '<a class="dropdown-toggle" href="' . base_url('blog/category/' . $category->slug) . '"> ' . $category->name . ' </a>'
                            . '</li>';
                        }
                    }
                    ?>
                </ul>
            </div>

        </div>
    </div>
    <!-- End navbar -->
