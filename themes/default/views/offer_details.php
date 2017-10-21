<link href="<?php echo $theme_url; ?>assets/include/slider/slider.min.css" rel="stylesheet" />
<script src="<?php echo $theme_url; ?>assets/js/single.js"></script>
<script src="<?php echo $theme_url; ?>/assets/js/jquery.nicescroll.min.js"></script>
<script src="<?php echo $theme_url; ?>assets/include/slider/slider.js"></script>
<script src="<?php echo $theme_url; ?>assets/js/infobox.js"></script>
<div class="mtslide2 sliderbg2"></div>
<!-- map -->

<!-- map -->
<div id="OVERVIEW" class="container">
    <div class="col-md-9 go-right">
        <div  class="panel panel-default">

            <div class="clearfix"></div>


            <!-- slider -->
            <div class="fotorama bg-dark" data-allowfullscreen="true" data-nav="thumbs">
                <?php foreach ($module->sliderImages as $img) { ?>
                    <img src="<?php echo $img['fullImage']; ?>" />
                <?php } ?>
            </div>
        </div>
        
        <br>
        <h1><?php echo $module->title; ?></h1>
        <span class="go-right RTL"><i style="margin-left:-5px" class="icon-location-6"></i><?php echo $module->location; ?> <?php if (!empty($module->mapAddress)) { ?> <small class="hidden-xs">, <?php echo character_limiter($module->mapAddress, 50); ?></small></span> <?php } ?>
        <?php if (!$module->offerForever) { ?>
                    <!-- Start Offers countdown -->
                    <span class="pull-right"><i class="fa fa-clock-o go-right"></i>
                    <span><?php echo trans('0269'); ?></span>
                    <span href="#" class="phone"><span class="wow fadeInLeft animated" id="countdown"></span></span></span>
                    <!-- End Offers countdown -->
    <?php } ?>
        <div style="margin-top: 20px;border-top: 1px solid #ddd;padding-top: 20px;">
            <div class="content panel-body">

<?php echo $module->desc; ?>

            </div>
        </div>
                

        <div class="clearfix"></div>
    </div>
    <!-- slider -->
    <!-- aside -->
    <div class="col-md-3 go-left">
        <div class="list-offer">
            <!-- Start Offers Contact Form -->
<?php if (!empty($module->relatedItems)) { ?>

                
<?php foreach ($module->relatedItems as $item) { ?>
                                    
                                        <a href="<?php echo $item->slug; ?>"><img style="max-height: 180px;width:100%" class="offers-hover img-responsive" src="<?php echo $item->thumbnail; ?>" alt="<?php echo character_limiter($item->title, 15); ?>"/></a>
                                        <div class="offer-list-text">
                                            <h6 class="dark go-right">
                                                
                                                <div><?php echo $item->title; ?></div>
                                                <?php if ($item->price > 0) { ?>
            <div class="pull-right"><?php echo trans('0561'); ?><?php echo $item->price; ?><?php echo $item->currSymbol; ?></div>
        <?php } ?>
        <div><?php echo $item->location; ?> <?php echo $item->stars; ?></div>                                           
        
   
                                            </h6>
                                        </div>
                                    
    <?php } ?>
<?php } ?>

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
                        countdown.innerHTML = '<span class="days">' + days + ' <b><?php echo trans("0440"); ?></b></span> <span class="hours">' + hours + ' <b><?php echo trans("0441"); ?></b></span> <span class="minutes">'
                                + minutes + ' <b><?php echo trans("0442"); ?></b></span> <span class="seconds">' + seconds + ' <b><?php echo trans("0443"); ?></b></span>';

                    }, 1000);

                    $(function () {
                        setTimeout(function () {
                            $(".successMsg").fadeOut("slow");
                        }, 7000);

                    });

                </script>


            <!-- End Offers Contact Form -->

        </div>
        <!-- End Add/Remove Wish list Review Section -->

    </div>
</div>