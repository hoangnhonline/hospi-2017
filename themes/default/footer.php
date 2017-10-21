<?php  $CI = &get_instance(); $app_settings = $CI->settings_model->get_settings_data(); $lang_set = $CI->theme->_data['lang_set']; $allowsupplierreg = $app_settings[0]->allow_supplier_registration; ?>
<?php $currenturl = uri_string(); ?>
<?php $currenturl = base_url(uri_string());?>
<?php if($app_settings[0]->mobile_pic_status == "Yes"){  ?>
<div class="hidden-xs" style="position: fixed;width: 99px;height: 171px;right: 0;z-index: 9999;left: 0;top: 50%;margin-top: -85px;">
  <a href="<?php echo $app_settings[0]->mobile_pic_url; ?>" target="_blank"><img src="<?php echo $theme_url; ?>assets/img/app.png"  alt="phone application" /></a>
</div>
<?php } ?>
<div id="footer" class="<?php echo @$hidden; ?> footerbg" >
  <?php if (strpos($currenturl, 'blog') !== false) { ?>
    <div class="footer-link">
      <div class="container"></div>
      
      <div class="row">
        <div class=" col-md-4 youtube">
          <a href="https://www.youtube.com/channel/UCxfzWdfkaDPWGIVrI2vKchg"><i class="fa fa-play" aria-hidden="true"></i> Youtube</a>
        </div>
        <div class=" col-md-4 facebook">
          <a href="https://www.facebook.com/hospi.vn/"><i class="fa fa-facebook" aria-hidden="true"></i> Facebook</a>
        </div>
        <div class=" col-md-4 google">
          <a href="https://plus.google.com/104246180420952281462"><i class="fa fa-google-plus" aria-hidden="true"></i> Google +</a>
        </div>
      </div>
     
    </div>
     <?php } else { ?>
      <div class="footer-link not-blog">

      </div>
      <?php } ?>
  <div class="container">
      <div class="row">
    <div class="clearfix"></div>

    <!-- Blog -->
    <?php if (strpos($currenturl, 'blog') !== false) { ?>
    <div class="footerblog">
    <div class="row col-md-7">
    <div class="col-md-5">
        <a href="<?php echo base_url(); ?>blog"><img src="<?php echo PT_GLOBAL_IMAGES_FOLDER.$app_settings[0]->footer_logo_img;?>" class="img-responsive logo"/></a>
    </div>
    <div class="col-md-7">
      <div class="ftitle"><?php echo '"'.trans('0829').'"';?></div>
    </div>
  </div>
  <div class="row col-md-5">
    <div class="col-md-7 facebook-like footer-blog-center">
      <div class="facebook-text"><?php echo trans('0830');?></div>
      <div class="fb-like" data-href="https://www.facebook.com/hospi.vn" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="false"></div>
    </div>
    <div class="col-md-5 footer-blog-center nowrap">
    <div><?php echo trans('0831');?></div>
    <div class="phone_footer"><?php echo $phone; ?></div>
    </div>
    </div>
    <div class="clearfix"></div>
    <div class="col-md-12">
    <div class="hottest-news"></div>
    </div>
    <div class="col-md-3">
      <div class="ftitle">&copy; <?php echo $app_settings[0]->copyright;?></div>
    </div>
    <div class="col-md-2 footer-blog-center">
      <div class="ftitle"><?php get_footer_menu_items(23,"chung-toi-la-ai","ftitle go-text-center","go-right go-text-center" );?></div>
    </div>
    <div class="col-md-4">
      <div class="blog-map ftitle go-text-right">
      <?php if(!empty($address)){ echo $address; } else { echo trans('Address'); } ?>
    </div>
    </div>
    <div class="row col-md-3">
      <div class="blog-map go-text-right"><a class="purple" target="_blank" href="https://www.google.com/maps/place/124+Kh%C3%A1nh+H%E1%BB%99i,+ph%C6%B0%E1%BB%9Dng+6,+Qu%E1%BA%ADn+4,+H%E1%BB%93+Ch%C3%AD+Minh,+Vi%E1%BB%87t+Nam/@10.7572978,106.6982959,17z/data=!3m1!4b1!4m5!3m4!1s0x31752f6d4faf461f:0xcf0c2485be1d0fdc!8m2!3d10.7572925!4d106.7004846"><i style="margin-left: -3px;" class="icon-location-6 go-right"></i><?php echo trans('0707');?></a></div>
    </div>
    </div>
    <?php } else { ?>

    <!-- End Blog -->
    <!-- Hotels -->
        <div class="row col-md-8">
        
        <!-- End of column 1-->
        <div class="col-xs-12 col-md-6 go-right"><h2 class="ftitle go-text-right"><strong><?php echo trans('0571');?></strong></h2>
            <?php if(!empty($phone)){ ?><div class="hidden-xs phone_footer go-right"><i class="icon_set_1_icon-55"></i> <?php echo $phone; ?></div><?php } ?>
            <div class="working-time">(8:00AM - 21:00PM)</div>
            <a class="go-right ftitle hidden-xs" href="mailto:<?php echo $contactemail; ?>" id="email_footer"><i style="font-size:18px" class="icon-email"></i> <span ><?php echo $contactemail; ?></span></a>
                <?php get_footer_menu_items(19,"ho-tro","ftitle go-text-right","footerlist go-right go-text-right" );?></div>
        <div class="col-xs-12 col-md-6 go-right"><h2 class="ftitle go-text-right"><strong><?php echo trans('0572');?></strong></h2><?php get_footer_menu_items(3,"about-us","ftitle go-text-right","footerlist go-right go-text-right" );?></div>
        
        <div class="clearfix" style="margin-bottom: 50px;"></div>
        <div class="col-md-1"></div>
        <div class="col-md-5 text-center newsletter_footer"> <?php echo trans('0832');?></div>
        <div class="col-md-5"><div class="relative">
            <input type="email" name="email" class="form-control fccustom2 sub_email" id="exampleInputEmail1" placeholder="<?php echo trans('0403');?>" required>
            <div style="color:white" class="subscriberesponse"></div>
            <button type="submit" class="btn btn-default btncustom sub_newsletter">&nbsp;</button>
            </div>
        </div>
        <div class="col-md-1"></div>
        </div>
        <div class="col-md-4 grey go-right col-xs-12" id="contact">
          <div class="clearfix"></div>
          <div class="clearfix"></div>
          
          <h2 class="ftitle go-text-right"><strong><?php echo trans('0573');?></strong></h2>
          <div class="footer-brand">
          <a href="<?php echo base_url(); ?>"><img src="<?php echo PT_GLOBAL_IMAGES_FOLDER.$app_settings[0]->header_logo_img;?>" class="img-responsive logo"/></a>
          <div><?php echo $app_settings[0]->home_title;?></div>
          <div class="ftitle go-text-right"><?php if(!empty($address)){ echo $address; } else { echo trans('Address'); } ?></div>
          <div class="ftitle go-text-right">Tel: <?php if(!empty($phone)){ echo $phone; } else { echo "08 3826 8797"; } ?><?php //echo $tel; ?> - Fax: <?php if(!empty($fax)){ echo $fax; } else { echo "(08) 3826 8798"; } ?><?php //echo $fax; ?></div>  
          <div class="ftitle go-text-right"><a class="purple" target="_blank" href="https://www.google.com/maps/place/124+Kh%C3%A1nh+H%E1%BB%99i,+ph%C6%B0%E1%BB%9Dng+6,+Qu%E1%BA%ADn+4,+H%E1%BB%93+Ch%C3%AD+Minh,+Vi%E1%BB%87t+Nam/@10.7572978,106.6982959,17z/data=!3m1!4b1!4m5!3m4!1s0x31752f6d4faf461f:0xcf0c2485be1d0fdc!8m2!3d10.7572925!4d106.7004846"><i style="margin-left: -3px;" class="icon-location-6 go-right"></i><?php echo trans('0707');?></a></div>
          <p class="" style="font-size:14px; border-bottom:1px solid #e2e2e2;" >&copy; <?php echo $app_settings[0]->copyright;?></p>
          </div>
          <?php /*if($allowsupplierreg){ ?>
          <form action="<?php echo base_url(); ?>supplier-register" type="POST">
          <button type="submit" style="margin-bottom:6px" class="btn btn-success btn-block"> <?php echo trans('0241');?></button>
          </form>
          <?php } */?>
          <h2 class="ftitle go-text-right"><strong><?php echo trans('0574');?></strong></h2>
          <div class="scont">
            <div class="clearfix"></div>
            <div id="social_footer go-right">
              <?php
                $footersocials = pt_get_footer_socials();
                foreach($footersocials as $fs){
                ?>
                <a href="<?php echo $fs->social_link;?>" target="_blank"><img src="<?php echo PT_SOCIAL_IMAGES; ?><?php echo $fs->social_icon;?>" class="social-icons-footer" /></a>
                <?php } ?>
            </div>
            <img src="<?php echo $theme_url; ?>/assets/img/bocongthuong.png" width="152" height="57" data-retina="true" class="congthuong img-responsive">
            <span class=""><?php echo trans('0575');?></span>
            
          </div>
          <div class="clearfix"></div>
        </div>

    <?php } ?>

    <!-- End Hotels -->
    
    <div class="clearfix"></div>
    </div>
  </div><br><br>
</div>
<div class="footerbg3 hidden-xs">
  <div class="container center grey">
    <a href="#top" class="gotop scroll wow fadeInUp"><img src="<?php echo $theme_url; ?>images/spacer.png" /></a>
  </div>
</div>
<?php include 'scripts.php'; ?>
<?php echo $app_settings[0]->google; ?>
</body>
</html>