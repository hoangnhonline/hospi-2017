<script type="text/javascript" src="<?php echo $theme_url; ?>plugins/jslider/js/jshashtable-2.1_src.js"></script>
<script type="text/javascript" src="<?php echo $theme_url; ?>plugins/jslider/js/jquery.numberformatter-1.2.3.js"></script>
<script type="text/javascript" src="<?php echo $theme_url; ?>plugins/jslider/js/tmpl.js"></script>
<script type="text/javascript" src="<?php echo $theme_url; ?>plugins/jslider/js/jquery.dependClass-0.1.js"></script>
<script type="text/javascript" src="<?php echo $theme_url; ?>plugins/jslider/js/draggable-0.1.js"></script>
<script type="text/javascript" src="<?php echo $theme_url; ?>plugins/jslider/js/jquery.slider.js"></script>
<link rel="stylesheet" href="<?php echo $theme_url; ?>plugins/jslider/css/jslider.css" type="text/css">
<link rel="stylesheet" href="<?php echo $theme_url; ?>plugins/jslider/css/jslider.round.css" type="text/css">
<link rel="stylesheet" href="<?php echo $theme_url; ?>assets/css/listing.css" type="text/css">
<!-- CONTENT -->
<div class="container pagecontainer offset-0">
    <form class="panel-body" action="<?php echo base_url();?>offers/search" method="GET">
        <div class="col-md-3 col-lg-4 col-sm-12 go-right">
            <div class="form-group">
                <div class="clearfix"></div>
                <label class="control-label go-right size13"><i class="icon-location-6"></i> <?php echo trans('0350');?></label>
                <div class="clearfix"></div>
                <input id="" name="searching" type="text" class="RTL form-control form searching" placeholder=" <?php echo trans('0350');?>" value="<?php if(!empty($_GET['searching'])){ echo $_GET['searching']; } ?>">
            </div>
        </div>
        <div class="col-md-2 col-sm-6 col-xs-6 go-right">
            <div class="form-group">
                <div class="clearfix"></div>
                <label class="control-label go-right size13"><i class="icon-calendar-7"></i> <?php echo trans('0273');?></label>
                <input type="text" placeholder=" <?php echo trans('0273');?> " name="dfrom" class="RTL form-control  dpd1" value="<?php echo $dfrom; ?>" >
            </div>
        </div>
        <div class="col-md-2 col-sm-6 col-xs-6 go-right">
            <div class="form-group">
                <div class="clearfix"></div>
                <label class="control-label go-right size13"><i class="icon-calendar-7"></i> <?php echo trans('0274');?></label>
                <input type="text" placeholder=" <?php echo trans('0274');?> " name="dto" class="RTL form-control dpd2" value="<?php echo $dto; ?>" >
            </div>
        </div>
        <div class="visible-sm visible-xs">
            <div class="clearfix"></div>
        </div>
        <div class="col-md-5 col-lg-4 col-xs-12 col-sm-12 go-right">
            <div class="form-group">
                <div class="clearfix"></div>
                <label class="control-label">&nbsp;</label>
                <button type="submit" class="btn btn-block btn-primary"><?php echo trans('012');?></button>
            </div>
        </div>
        <div class="clearfix"></div>
    </form>
    <div class="col-md-12">
        <hr style="margin-top: 0px;">
    </div>
    <div class="clearfix"></div>
    <div class="col-md-3 go-right">
        <?php echo run_widget(82); ?>
    </div>
    <div class="visible-xs"><br><br></div>
    <!-- LIST CONTENT-->
    <div class="rightcontent col-md-9 col-sm-12 col-xs-12 offset-0">
        <div class="itemscontainer offset-1">
            <?php
                if(!empty($offers)){
                foreach($offers as $item){ ?>
            <div class="offset-2">
                <div class="col-lg-4 col-md-4 col-sm-4 offset-0 go-right">
                    <div class="img_list">
                        <a href="<?php echo $item->slug;?>">
                            <img src="<?php echo $item->thumbnail;?>" alt="<?php echo character_limiter($item->title,20);?>">
                            <div class="short_info"></div>
                        </a>
                    </div>
                </div>
                <div class="col-md-8 offset-0">
                    <div class="itemlabel3">
                        <div class="labelright go-left" style="min-width:105px;margin-left:5px">
                            <br/>
                            <span class="green size18">
                            <?php  if($item->price > 0){ ?>
                            <b>
                            <small><?php echo $item->currCode;?></small> <?php echo $item->currSymbol; ?><?php echo $item->price;?>
                            </b></span><br/>
                            <span class="size11 grey"><?php echo trans('0299');?></span>
                            <br/>
                            <div class="clearfix"></div>
                            <hr>
                            <?php } ?>
                            <a href="<?php echo $item->slug;?>">
                            <button type="submit" class="bookbtn mt1"><?php echo trans('0177');?></button>
                            </a>
                        </div>
                        <div class="labelleft2 rtl_title_home">
                            <h4 class="mtb0 RTL go-text-right"><a href="<?php echo $item->slug;?>"><b><?php echo character_limiter($item->title,20);?></b></a></h4>
                            <br><br>
                            <p class="grey RTL"><?php echo character_limiter($item->desc,300);?></p>
                            <br/>
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
            <div class="col-md-12 pull-right go-right"><?php echo createPagination($info);?></div>
            <div class="pull-right">
                <?php }else{  echo '<h1 class="text-center">' . trans("066") . '</h1>'; } ?>
            </div>
            <!-- End of offset1-->
        </div>
        <!-- END OF LIST CONTENT-->
    </div>
    <!-- END OF container-->
</div>
<!-- END OF CONTENT -->
<br><br><br>
<!-- End container -->