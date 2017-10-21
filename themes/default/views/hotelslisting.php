<script type="text/javascript" async src="<?php echo $theme_url; ?>plugins/jslider/js/jshashtable-2.1_src.js"></script>
<script type="text/javascript" async src="<?php echo $theme_url; ?>plugins/jslider/js/jquery.numberformatter-1.2.3.js"></script>
<script type="text/javascript" async src="<?php echo $theme_url; ?>plugins/jslider/js/tmpl.js"></script>
<script type="text/javascript" async src="<?php echo $theme_url; ?>plugins/jslider/js/jquery.dependClass-0.1.js"></script>
<script type="text/javascript" async src="<?php echo $theme_url; ?>plugins/jslider/js/draggable-0.1.js"></script>
<script type="text/javascript" async src="<?php echo $theme_url; ?>plugins/jslider/js/jquery.slider.js"></script>
<link rel="stylesheet" href="<?php echo $theme_url; ?>plugins/jslider/css/jslider.css" type="text/css">
<link rel="stylesheet" href="<?php echo $theme_url; ?>plugins/jslider/css/jslider.round.css" type="text/css">



<?php if (isset($_GET['searching']) && !empty($_GET['searching'])) { ?>
    <div style="margin-top: 20px;"></div>
    <div class="container offer-banners">
        <div id="carousel-banner" class="banner-by-location carousel slide" data-ride="carousel">
            <?php //echo run_widget(get_widget_id($_GET['searching'], "Hotel"));
            $image = PT_LOCATION_IMAGES.get_location_hotel_image($_GET['searching']);
            echo '<img alt="'.$_GET['txtSearch'].'" src="'.$image.'">';
            ?>
            <div class="search-result-location">
                <div class="result-location-title"><?php echo $_GET['txtSearch']; ?></div>
                <a data-toggle="collapse" href="#collapseMap" aria-expanded="false" aria-controls="collapseMap"><i class="icon-location-6"></i> <?php echo trans('067'); ?></a>
            </div>
        </div>
    </div>

<?php } else { ?>
    <div class="listing-search">
        <form class="container" action="<?php echo base_url() . $appModule; ?>/search" method="GET">

            <div class="col-md-3 col-lg-4 col-sm-12 go-right" ng-controller="autoSuggest">
                <div class="form-group">
                    <div class="clearfix"></div>
                    <label class="control-label go-right"><i class="icon-location-6"></i> <?php echo trans('0254'); ?></label>
                    <div class="clearfix"></div>
                    <!--<div angucomplete-alt id="<?php $appModule; ?>Search" input-name="txtSearch" initial-value="txtSearch" placeholder="<?php echo trans('0526'); ?>" pause="500" selected-object="selectedItem" remote-url="<?php echo base_url(); ?>home/suggestions/<?php echo $appModule; ?>" remote-url-request-formatter="remoteUrlRequestFn" remote-url-data-field="items" title-field="name" description-field="" minlength="2" input-class="form-control form-control-small" match-class="highlight">
                    </div>-->
                    <input id="search" name="txtSearch" class="form-control form-control-small" placeholder="<?php echo trans('026');?>"/>
            <div id="autocomlete-container"></div>

                    <input id="searching" type="hidden" name="searching" value="{{searching}}"> <input id="modType" type="hidden" name="modType" value="{{modType}}">
                </div>
            </div>

            <!-- start hotels checkin checkout fields -->
            <?php if ($appModule == "hotels") { ?>
                <div class="col-md-2 col-sm-6 col-xs-6 go-right">
                    <div class="form-group">
                        <div class="clearfix"></div>
                        <label class="control-label go-right size13"><i class="icon-calendar-7"></i> <?php echo trans('07'); ?></label>
                        <input type="text" placeholder="<?php echo trans('07'); ?> " name="checkin" class="form-control mySelectCalendar dpd1" value="<?php echo @$checkin; ?>" required >
                    </div>
                </div>
                <div class="col-md-2 col-sm-6 col-xs-6 go-right">
                    <div class="form-group">
                        <div class="clearfix"></div>
                        <label class="control-label go-right size13"><i class="icon-calendar-7"></i> <?php echo trans('09'); ?></label>
                        <input type="text" placeholder="<?php echo trans('09'); ?> " name="checkout" class="form-control mySelectCalendar dpd2" value="<?php echo @$checkout; ?>" required >
                    </div>
                </div>
            <?php } ?>
            <!-- end hotels checkin checkout fields -->

            <div class="col-md-2 col-lg-1 col-sm-6 col-xs-6 go-right">
                <div class="form-group">
                    <div class="clearfix"></div>
                    <label class="control-label go-right size13" style="white-space:nowrap;"><i class="icon-user-7"></i> <?php if ($appModule == "hotels") {
            echo trans('010');
        } else if ($appModule == "tours") {
            echo trans('0446');
        } ?></label>
                    <select  required class="form-control" placeholder=" <?php echo trans(''); ?> " name="adults" id="adults">
    <?php for ($Selectadults = 1; $Selectadults < 11; $Selectadults++) { ?>
                            <option value="<?php echo $Selectadults; ?>" <?php if ($Selectadults == $modulelib->adults) {
            echo "selected";
        } ?> > <?php echo $Selectadults; ?> </option>
    <?php } ?>
                    </select>
                </div>
            </div>
            <!-- start hotels child field -->
                        <?php if ($appModule == "hotels") { ?>
                <div class="hidden-md col-lg-1 col-sm-6 col-xs-6 go-right">
                    <div class="form-group">
                        <div class="clearfix"></div>
                        <label class="control-label go-right size13"><i class="icon-user-7"></i> <?php echo trans('011'); ?></label>
                        <select  class="form-control" placeholder=" <?php echo trans('011'); ?> " name="child" id="child">
                <?php for ($Selectchild = 0; $Selectchild < 6; $Selectchild++) { ?>
                                <option value="<?php echo $Selectchild; ?>" <?php if ($Selectchild == @$modulelib->children) {
                echo "selected";
            } ?> > <?php echo $Selectchild; ?> </option>
                <?php } ?>
                        </select>
                    </div>
                </div>
    <?php } ?>
    <?php
    if (strpos($_GET['txtSearch'], "-khu-vuc-") !== false) {
        $ok = substr($_GET['txtSearch'], strpos($_GET['txtSearch'], "-khu-vuc-") + 9);
        echo '<input type="hidden" name="near" value="' . $ok . '">';
    }
    ?>
            <!-- end hotels child field -->

            <div class="visible-sm visible-xs">
                <div class="clearfix"></div>
            </div>
            <div class="col-md-3 col-lg-2 col-xs-12 col-sm-12 go-right">
                <div class="form-group">
                    <div class="clearfix"></div>
                    <label class="control-label go-right size13">&nbsp;</label>
                    <button style="font-size: 14px;" type="submit" class="btn btn-block btn-action"><?php echo trans('012'); ?></button>
                </div>
            </div>
            <div class="clearfix"></div>
        </form>
    </div>
<?php } ?>


<!-- CONTENT -->
<div class="collapse" id="collapseMap">
    <div id="map" class="map"></div>
    <br>
</div>
<div class="container pagecontainer">
    <div class="clearfix"></div>





    <!-- FILTERS -->
    <div class="col-md-3 filters offset-0 go-right">
<?php if (isset($_GET['searching'])) { ?>
            <form class="" action="<?php echo base_url() . $appModule; ?>/search" method="GET">
                <button type="button" class="collapsebtn go-text-right" data-toggle="collapse" data-target="#txtsearch">
    <?php echo trans('0693'); ?> <span class="collapsearrow"></span>
                </button>
                <div id="txtsearch" class="collapse in">
                    <br>
                    <div class="col-md-12 col-lg-12 col-sm-12 go-right" ng-controller="autoSuggest">
                        <div class="form-group">
                            <div class="clearfix"></div>
                            <label class="control-label go-right"><i class="icon-location-6"></i> <?php echo trans('0254'); ?></label>
                            <div class="clearfix"></div>
                            <input id="search" name="txtSearch" class="form-control form-control-small" placeholder="<?php echo trans('026');?>"/>
                            <div id="autocomlete-container"></div>

                    <input id="searching" type="hidden" name="searching" value="{{searching}}"> <input id="modType" type="hidden" name="modType" value="{{modType}}">
                        </div>
                    </div>

                    <!-- start hotels checkin checkout fields -->
    <?php if ($appModule == "hotels") { ?>
                        <div class="col-md-12 col-sm-12 col-xs-12 go-right">
                            <div class="form-group">
                                <div class="clearfix"></div>
                                <label class="control-label go-right size13"><i class="icon-calendar-7"></i> <?php echo trans('07'); ?></label>
                                <input type="text" placeholder="<?php echo trans('07'); ?> " name="checkin" class="form-control mySelectCalendar dpd1" value="<?php echo @$checkin; ?>" required >
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12 go-right">
                            <div class="form-group">
                                <div class="clearfix"></div>
                                <label class="control-label go-right size13"><i class="icon-calendar-7"></i> <?php echo trans('09'); ?></label>
                                <input type="text" placeholder="<?php echo trans('09'); ?> " name="checkout" class="form-control mySelectCalendar dpd2" value="<?php echo @$checkout; ?>" required >
                            </div>
                        </div>
                                <?php } ?>
                    <!-- end hotels checkin checkout fields -->

                    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 go-right">
                        <div class="form-group">
                            <div class="clearfix"></div>
                            <label class="control-label go-right size13" style="white-space:nowrap;"><i class="icon-user-7"></i> <?php if ($appModule == "hotels") {
                                echo trans('010');
                            } else if ($appModule == "tours") {
                                echo trans('0446');
                            } ?></label>
                            <select  required class="form-control" placeholder=" <?php echo trans(''); ?> " name="adults" id="adults">
                                <?php for ($Selectadults = 1; $Selectadults < 11; $Selectadults++) { ?>
                                    <option value="<?php echo $Selectadults; ?>" <?php if ($Selectadults == $modulelib->adults) {
                                echo "selected";
                            } ?> > <?php echo $Selectadults; ?> </option>
    <?php } ?>
                            </select>
                        </div>
                    </div>
                    <!-- start hotels child field -->
                    <?php if ($appModule == "hotels") { ?>
                        <div class="hidden-md col-lg-12 col-sm-12 col-xs-12 go-right">
                            <div class="form-group">
                                <div class="clearfix"></div>
                                <label class="control-label go-right size13"><i class="icon-user-7"></i> <?php echo trans('011'); ?></label>
                                <select  class="form-control" placeholder=" <?php echo trans('011'); ?> " name="child" id="child">
        <?php for ($Selectchild = 0; $Selectchild < 6; $Selectchild++) { ?>
                                        <option value="<?php echo $Selectchild; ?>" <?php if ($Selectchild == @$modulelib->children) {
                echo "selected";
            } ?> > <?php echo $Selectchild; ?> </option>
        <?php } ?>
                                </select>
                            </div>
                        </div>
    <?php } ?>
    <?php
    if (strpos($_GET['txtSearch'], "-khu-vuc-") !== false) {
        $ok = substr($_GET['txtSearch'], strpos($_GET['txtSearch'], "-khu-vuc-") + 9);
        echo '<input type="hidden" name="near" value="' . $ok . '">';
    }
    ?>
                    <!-- end hotels child field -->

                    <div class="visible-sm visible-xs">
                        <div class="clearfix"></div>
                    </div>
                    <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12 go-right">
                        <div class="form-group">
                            <div class="clearfix"></div>
                            <button style="font-size: 14px;margin-top: 6px;" type="submit" class="btn btn-block btn-action"><?php echo trans('012'); ?></button>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </form>
                    <?php } ?>

        <form  class="hospifilter" action="<?php echo base_url() . $appModule; ?>/search" method="GET" role="search">
      <!--<a class="btn btn-block btn-default" data-toggle="collapse" href="#collapseMap" aria-expanded="false" aria-controls="collapseMap"><i class="icon_set_1_icon-41"></i> <?php echo trans('067'); ?></a>-->
            <!-- TOP TIP
            <div class="filtertip">
              <div class="padding20">
                <h4 class="size24 text-center"><i class="icon_set_1_icon-95 go-right"></i><span><?php echo trans('0191'); ?></span> <span class="countprice"></span></h4>
              </div>
              <div class="clearfix"></div>
            </div>-->

            <!-- Star ratings -->
            <button type="button" class="collapsebtn go-text-right" data-toggle="collapse" data-target="#collapse1">
<?php //echo trans('0137'); ?> <?php echo trans('069'); ?> <span class="collapsearrow"></span>
            </button>
            <div id="collapse1" class="collapse in">
                <div class="hpadding20">
                    <br>
<?php $star = '<i class="star text-warning fa fa-star voted"></i>'; ?>
<?php $stars = '<i class="fa fa-star-o"></i>'; ?>
                    <div  class="rating" style="font-size: 14px;">
                        <div class="go-right"><input id="1" type="radio" name="stars" class="go-right radio" value="1" <?php if (@$_GET['stars'] == "1") {
    echo "checked";
} ?>>&nbsp;&nbsp;<label class="go-left" for="1"><?php echo $star; ?><?php for ($i = 1; $i <= 4; $i++) { ?> <?php echo $stars; ?> <?php } ?></label></div>
                        <div class="clearfix"></div>
                        <div class="go-right"><input id="2" type="radio" name="stars" class="radio go-right" value="2" <?php if (@$_GET['stars'] == "2") {
    echo "checked";
} ?>>&nbsp;&nbsp;<label class="go-left" for="2"><?php for ($i = 1; $i <= 2; $i++) { ?> <?php echo $star; ?> <?php } ?><?php for ($i = 1; $i <= 3; $i++) { ?> <?php echo $stars; ?> <?php } ?></label></div>
                        <div class="clearfix"></div>
                        <div class="go-right"><input id="3" type="radio" name="stars" class="radio" value="3" <?php if (@$_GET['stars'] == "3") {
                    echo "checked";
                } ?>>&nbsp;&nbsp;<label class="go-left" for="3"><?php for ($i = 1; $i <= 3; $i++) { ?> <?php echo $star; ?> <?php } ?><?php for ($i = 1; $i <= 2; $i++) { ?> <?php echo $stars; ?> <?php } ?></label></div>
                        <div class="clearfix"></div>
                        <div class="go-right"><input id="4" type="radio" name="stars" class="radio" value="4" <?php if (@$_GET['stars'] == "4") {
                    echo "checked";
                } ?>>&nbsp;&nbsp;<label class="go-left" for="4"><?php for ($i = 1; $i <= 4; $i++) { ?> <?php echo $star; ?> <?php } ?><?php for ($i = 1; $i <= 1; $i++) { ?> <?php echo $stars; ?> <?php } ?></label></div>
                        <div class="clearfix"></div>
                        <div class="go-right"><input id="5" type="radio" name="stars" class="radio" value="5" <?php if (@$_GET['stars'] == "5") {
                    echo "checked";
                } ?>>&nbsp;&nbsp;<label class="go-left" for="5"><?php for ($i = 1; $i <= 5; $i++) { ?> <?php echo $star; ?> <?php } ?></label></div>
                        <!--<div class="clearfix"></div>
                        <div class="go-right"><input id="7" type="radio" name="stars" class="radio" value="7" <?php if (@$_GET['stars'] == "7") {
                    echo "checked";
                } ?>>&nbsp;&nbsp;<label class="go-left" for="7"><?php for ($i = 1; $i <= 7; $i++) { ?> <?php echo $star; ?> <?php } ?></label></div>-->
                    </div>
                </div>
                <div class="clearfix"></div>
                <br>
            </div>
            <!-- End of Star ratings -->
            <!-- Price range -->
            <button type="button" class="collapsebtn go-text-right" data-toggle="collapse" data-target="#collapse2">
<?php echo trans('0301'); ?> <span class="collapsearrow"></span>
            </button>
            <div id="collapse2" class="collapse in">
<?php
if (!empty($_GET['price'])) {
    $selectedprice = $_GET['price'];
} else {
    $selectedprice = "0,0"; // $minprice.",".$maxprice;
}
?>
                <div class="padding20">
                    <div class="layout-slider wh100percent">
                        <span class="cstyle09">
                            <input id="Slider1" type="slider" value="<?php echo $selectedprice; ?>" />
                            <input id="getvar" type="hidden" name="price" value="<?php echo $selectedprice; ?>"/>
                        </span>
                    </div>
                    <script type="text/javascript" >
                        jQuery("#Slider1").slider({ from: <?php echo @$minprice; ?>, to: <?php echo @$maxprice; ?>, step: 5, smooth: true, round: 0, dimension: "&nbsp;<?php echo $currSign; ?>", skin: "round", onstatechange: function(value){

                        if (value != $("#getvar").val()){
                        $("#getvar").val(value);
                        } else{
                        $("#getvar").val("");
                        }   } });
                    </script>
                </div>
            </div>
            <!-- End of Price range -->
            <!-- Module types -->
            <button type="button" class="collapsebtn go-text-right" data-toggle="collapse" data-target="#collapse3">
<?php if ($appModule == "hotels") {
    echo trans('0478');
} else if ($appModule == "tours") {
    echo trans('0366');
} else if ($appModule == "cars") {
    echo trans('0214');
} ?> <span class="collapsearrow"></span>
            </button>
            <div id="collapse3" class="collapse in">
                <div class="hpadding20">
                    <br>
                    <div class="clearfix"></div>
                    <?php
                    @$vartype = $_GET['type'];
                    if (empty($vartype)) {
                        $vartype = array();
                    }
                    foreach ($moduleTypes as $mtype) {
                        if (!empty($mtype->name)) {
                            if ($appModule == "hotels") {
                                ?>
                                <div class="go-right"> <input type="checkbox" value="<?php echo $mtype->id; ?>" <?php if (in_array($mtype->id, $vartype)) {
                                    echo "checked";
                                } ?> name="type[]" id="<?php echo $mtype->name; ?>" class="checkbox" /> <label for="<?php echo $mtype->name; ?>" class="css-label go-left">&nbsp;&nbsp;<?php echo $mtype->name; ?></label></div>
                                <div class="clearfix"></div>
        <?php } else if ($appModule == "tours" || $appModule == "cars") { ?>
                                <div class="go-right"><input class="radio" type="radio" value="<?php echo $mtype->id; ?>" name="type" id="<?php echo $mtype->name; ?>" class="checkbox go-right" <?php if ($mtype->id == $vartype) {
                echo "checked";
            } ?> /><label for="<?php echo $mtype->name; ?>" class="css-label go-left"> &nbsp;&nbsp; <?php echo $mtype->name; ?> &nbsp;&nbsp;</label></div>
                                <div class="clearfix"></div>
                    <?php }
                }
            } ?>
                    <br>
                </div>
                <div class="clearfix"></div>
            </div>
            <!-- End of Module Types -->

            <!-- Advance types -->
<?php if ($appModule == "hotels") { ?>
                <button type="button" class="collapsebtn go-text-right" data-toggle="collapse" data-target="#collapseadvance">
    <?php echo trans('0708'); ?> <span class="collapsearrow"></span>
                </button>
                <div id="collapseadvance" class="collapse in">
                    <div class="hpadding20">
                        <br>
                        <div class="clearfix"></div>
                        <?php
                        @$varsaleoff = $_GET['issale'];
                        if (empty($varsaleoff)) {
                            $varsaleoff = "";
                        }
                        @$varuudai = $_GET['uudai'];
                        if (empty($varuudai)) {
                            $varuudai = "";
                        }
                        @$honeymoon = $_GET['honeymoon'];
                        if (empty($honeymoon)) {
                            $honeymoon = "";
                        }
                        @$varpickup = $_GET['pickup'];
                        if (empty($varpickup)) {
                            $varpickup = "";
                        }
                        ?>
                        <div class="go-right"> <input type="checkbox" value="yes" <?php if ($varsaleoff == "yes") {
                            echo "checked";
                        } ?> name="issale" id="issale" class="checkbox" /> <label for="issale" class="css-label go-left">&nbsp;&nbsp;<?php echo trans('0709'); ?></label></div>
                        <div class="clearfix"></div>
                        <div class="go-right"> <input type="checkbox" value="yes" <?php if ($uudai == "yes") {
                            echo "checked";
                        } ?> name="uudai" id="uudai" class="checkbox" /> <label for="uudai" class="css-label go-left">&nbsp;&nbsp;<?php echo trans('0710'); ?></label></div>
                        <div class="clearfix"></div>
                        <div class="go-right"> <input type="checkbox" value="yes" <?php if ($honeymoon == "yes") {
                echo "checked";
            } ?> name="honeymoon" id="honeymoon" class="checkbox" /> <label for="honeymoon" class="css-label go-left">&nbsp;&nbsp;<?php echo trans('0567'); ?></label></div>
                        <div class="clearfix"></div>
                        <div class="go-right"> <input type="checkbox" value="yes" <?php if ($varpickup == "yes") {
                echo "checked";
            } ?> name="pickup" id="pickup" class="checkbox" /> <label for="pickup" class="css-label go-left">&nbsp;&nbsp;<?php echo trans('0711'); ?></label></div>
                        <div class="clearfix"></div>
                        <br>
                    </div>
                    <div class="clearfix"></div>
                </div>
                    <?php } ?>
            <!-- End of Advance Types -->


            <!-- Hotel Amenities -->
                    <?php if (!empty($amenities)) { ?>
                <button type="button" class="collapsebtn last go-text-right" data-toggle="collapse" data-target="#collapse4">
    <?php echo trans('0249'); ?> <span class="collapsearrow"></span>
                </button>
                <div id="collapse4" class="collapse in">
                    <div class="hpadding20">
                        <br>
                        <div class="clearfix"></div>
    <?php
    @$varAmt = $_GET['amenities'];
    if (empty($varAmt)) {
        $varAmt = array();
    }
    foreach ($amenities as $hamt) {
        ?>
                            <div class="go-right"><input type="checkbox" value="<?php echo $hamt->id; ?>" <?php if (in_array($hamt->id, $varAmt)) {
            echo "checked";
        } ?> name="amenities[]" id="<?php echo $hamt->name; ?>" class="checkbox" /><label for="<?php echo $hamt->name; ?>" class="css-label go-left"> <img class="go-right" style="height: 22px;margin-right:5px;margin-left:5px" src="<?php echo $hamt->icon; ?>">  <?php echo $hamt->name; ?></label></div>
                            <div class="clearfix"></div>
    <?php } ?>
                    </div>
                    <div class="clearfix"></div>
                </div>
<?php } ?>
<?php if ($appModule == "cars") { ?>
                <button type="button" class="collapsebtn go-text-right" data-toggle="collapse" data-target="#collapse5">
    <?php echo trans('0207'); ?> <span class="collapsearrow"></span>
                </button>
                <div id="collapse5" class="collapse in">
                    <div class="hpadding20">
                        <br>
                        <div class="clearfix"></div>
                        <select class="selectx" name="pickup">
                            <option value=""> <?php echo trans('0158'); ?></option>
                            <option value="yes" <?php echo makeSelected($selectedPickup, "yes"); ?>  ><?php echo trans('0363'); ?></option>
                            <option value="no" <?php echo makeSelected($selectedPickup, "no"); ?> ><?php echo trans('0364'); ?></option>
                        </select>
                    </div>
                </div>
<?php } ?>
            <!-- End of Hotel Amenities -->
            <!-- Hotel Nearby -->
            <div class="clearfix"></div>
<?php if (!empty($nears) && $_GET['modType'] != "") { ?>
                <button type="button" class="collapsebtn last go-text-right" data-toggle="collapse" data-target="#collapse5">
    <?php echo trans('0601'); ?> <span class="collapsearrow"></span>
                </button>
                <div id="collapse5" class="collapse in">
                    <div class="hpadding20">
                        <br>
    <?php
    @$varNear = $_GET['near'];
    if (empty($varNear)) {
        $varNear = array();
    }
    foreach ($nears as $near) {
        $eachnear = explode(',', $near->near);
        foreach ($eachnear as $item) {
            ?>
                                <div class="go-right"><input type="radio" value="<?php echo trim($item); ?>" <?php if (trim($item) == str_replace("+", ' ', $varNear)) {
                echo "checked";
            } ?> name="near" id="<?php echo trim($item); ?>" class="checkbox" /><label for="<?php echo trim($item); ?>" class="css-label go-left">&nbsp;<?php echo trim($item); ?></label></div>
        <?php }
    } ?>
                    </div>
                </div>
                <?php } ?>

            <!-- End Hotel Nearby -->
            <div class="clearfix"></div>
            <br/>



            <input type="hidden" name="sortby" value="<?php if (!empty($_GET['sortby'])) {
                    echo $_GET['sortby'];
                } ?>">
            <input type="hidden" name="txtSearch" value="<?php if (!empty($_GET['txtSearch'])) {
                    echo $_GET['txtSearch'];
                } ?>">
            <input type="hidden" name="modType" value="<?php if (!empty($_GET['modType'])) {
                echo $_GET['modType'];
            } ?>">
            <input type="hidden" name="city" value="<?php if (!empty($_GET['city'])) {
                echo $_GET['city'];
            } else {
                echo $selectedCity;
            } ?>">
            <input type="hidden" name="checkIn" value="<?php echo $checkin; ?>">
            <input type="hidden" name="checkOut" value="<?php echo $checkout; ?>">
            <input type="hidden" name="childages" value="<?php echo $childAges; ?>">
            <input type="hidden" name="adults" value="<?php echo $adults; ?>">
            <input type="hidden" name="searching" value="<?php echo $selectedLocation; ?>">
            <input name="sortby" type="hidden" class="sortby" value="<?php if (!empty($_GET['sortby'])) {
                        echo $_GET['sortby'];
                    } ?>">
            <button style="border-radius:0px" type="submit" class="btn btn-action btn-lg btn-block" id="searchform"><?php echo trans('0694'); ?></button>
        </form><br>
         <div class="list-group">
    <div class="panel panel-default">
      <div class="panel-heading go-text-right"><?php echo trans('0565');?></div>
      <div class="hotel-zippack">
        <?php foreach($hotelslocationsList as $loc){
            $city_slug = create_slug($loc->name);
            $country_slug = create_slug($loc->country);
            echo '<div class="col-md-12 col-sm-12 col-xs-12">';
            echo '<p class="where-location"><span class="hotel-location link-color"><a href="'.base_url().'hotels/search/'.$country_slug.'/'.$city_slug.'/'.$loc->id.'?txtSearch='.$loc->name.'&searching='.$loc->id.'&modType=location&checkin=&checkout=&adults=&child=">'.$loc->name.'</a></span>';
            echo '<span class="pricetxt-location">'.trans('0566').' VND</span>';
            echo '</p><p><span class="count-location">'.$loc->total.' ';echo trans('Hotels').'</span>';
            echo '<span class="price-location link-color">'.$loc->bestprices.'</span>';
            echo '</p></div>';
        } ?>
        </div>
      </div>
  </div>
    </div>
    <!-- END OF FILTERS -->




    <div class="visible-xs"><br><br></div>
    <!-- LIST CONTENT-->
    <div class="rightcontent col-md-9 offset-0">
        <div class="itemscontainer offset-1 hotels">
            <div class="offset-2">
                <form name="orderbylist" id="orderbylist" action="" method="GET">
                    <input type="hidden" name="price" value="<?php if (!empty($_GET['price'])) {
                        echo $_GET['price'];
                    } ?>">
                    <input type="hidden" name="stars" value="<?php if (!empty($_GET['stars'])) {
                        echo $_GET['stars'];
                    } ?>">
                    <input type="hidden" name="type" value="<?php if (!empty($_GET['type'])) {
                                    echo $_GET['type'];
                                } ?>">
                    <input type="hidden" name="issale" value="<?php if (!empty($_GET['issale'])) {
                                    echo $_GET['issale'];
                                } ?>">
                    <input type="hidden" name="uudai" value="<?php if (!empty($_GET['uudai'])) {
                                    echo $_GET['uudai'];
                                } ?>">
                    <input type="hidden" name="pickup" value="<?php if (!empty($_GET['pickup'])) {
                                    echo $_GET['pickup'];
                                } ?>">
                    <input type="hidden" name="amenities" value="<?php if (!empty($_GET['amenities'])) {
                                    echo $_GET['amenities'];
                                } ?>">
                    <input type="hidden" name="near" value="<?php if (!empty($_GET['near'])) {
                                    echo $_GET['near'];
                                } ?>">
                    <input type="hidden" name="txtSearch" value="<?php if (!empty($_GET['txtSearch'])) {
                                    echo $_GET['txtSearch'];
                                } ?>">
                    <input type="hidden" name="modType" value="<?php if (!empty($_GET['modType'])) {
                                    echo $_GET['modType'];
                                } ?>">
                    <input type="hidden" name="city" value="<?php if (!empty($_GET['city'])) {
                                    echo $_GET['city'];
                                } else {
                                    echo $selectedCity;
                                } ?>">
                    <input type="hidden" name="checkIn" value="<?php if (!empty($_GET['checkIn'])) {
                                    echo $_GET['checkIn'];
                                } ?>">
                    <input type="hidden" name="checkOut" value="<?php if (!empty($_GET['checkOut'])) {
                                    echo $_GET['checkOut'];
                                } ?>">
                    <input type="hidden" name="childages" value="<?php if (!empty($_GET['childages'])) {
                                    echo $_GET['childages'];
                                } ?>">
                    <input type="hidden" name="adults" value="<?php if (!empty($_GET['adults'])) {
                                    echo $_GET['adults'];
                                } ?>">
                    <input type="hidden" name="searching" value="<?php if (!empty($_GET['searching'])) {
                                    echo $_GET['searching'];
                                } ?>">

                    <div class="col-md-3"><span class="sap-xep-theo andes-bold lblue"><?php echo trans('0736'); ?></span></div>

                    <div class="col-md-3"><input type="radio" id="thap-cao" name="sortby" class="hospi-checkbox" value="p_lh" <?php if ($_GET['sortby'] == "p_lh") {
                                echo 'checked="checked"';
                            } ?>>  <label for="thap-cao" class="hospi-label">&nbsp;</label>
                        <span class="txt-label"><?php echo trans('0723'); ?></span></div>

                    <div class="col-md-3"><input type="radio" id="cao-thap" name="sortby" class="hospi-checkbox" value="p_hl" <?php if ($_GET['sortby'] == "p_hl") {
                                echo 'checked="checked"';
                            } ?>>  <label for="cao-thap" class="hospi-label">&nbsp;</label>
                        <span class="txt-label"><?php echo trans('0724'); ?></span></div>

                    <div class="col-md-3"><input type="radio" id="feature" name="sortby" class="hospi-checkbox" value="featured" <?php if ($_GET['sortby'] == "featured") {
                                echo 'checked="checked"';
                            } ?>>  <label for="feature" class="hospi-label">&nbsp;</label>
                        <span class="txt-label"><?php echo trans('0725'); ?></span></div>

                    <div class="clearfix"></div>
                    <hr>
                </form>
<?php if (isset($_GET['searching']) && !empty($_GET['searching'])) { ?>
    <?php
    $widget_ids = get_widget_ids($_GET['searching'], "Advert");
    $list = array();
    foreach ($widget_ids as $id) {
        array_push($list, $id->widget_id);
    }
    ?>
<?php } ?>
            </div>

<?php
if (!empty($module)) {
    $i = 1;
    foreach ($module as $item) {
        ?>
                    <div class="offset-2">
                        <div class="wow fadeInUp col-lg-3 col-md-3 col-sm-3 offset-0 go-right tour-image">
                            <!-- Add to whishlist -->
        <?php if ($appModule != "ean" && $appModule != "offers") { ?>
                                <span  ><?php echo wishListInfo($appModule, $item->id); ?></span>
        <?php } ?>
                            <!-- Add to whishlist -->
        <?php if (is_sales_off_hotel($item->id)) $khuyenmai = "khuyenmai";
        else $khuyenmai = ""; ?>
                            <div class="img_list <?php echo $khuyenmai; ?>">
                              <?php if (isset($_GET['honeymoon']) && !empty($_GET['honeymoon'])) { ?>
                                  <a href="<?php echo $item->slug;?>/?details=<?php echo $item->roomid;?>">
                              <?php } else { ?>
                                <a href="<?php echo $item->slug; ?>">
                              <?php } ?>
                                    <img src="<?php echo $item->thumbnail; ?>" alt="<?php echo character_limiter($item->title, 20); ?>">
                                    <div class="short_info"></div>
                                </a>
                            </div>
                        </div>
                        <div class="wow fadeInUp col-md-9 offset-0">
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
        <?php if (isset($_GET['honeymoon']) && !empty($_GET['honeymoon'])) { ?>
            <a href="<?php echo $item->slug;?>/?details=<?php echo $item->roomid;?>">
        <?php } else { ?>
          <a href="<?php echo $item->slug; ?>">
        <?php } ?>
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
        <?php
        if ($i % 6 == 0) {
            $random_key = array_rand($list);
            echo '<div class="offset-2">' . run_widget($list[$random_key]) . '</div>';
            unset($list[$random_key]);
        }
        $i++;
        $random_key = "";
    }
    ?>
                <div class="clearfix"></div>
                <div class="col-md-12 pull-right go-right"><?php echo createPagination($info); ?></div>
                <div class="pull-right">
<?php } else {
    echo '<h1 class="text-center">' . trans("066") . '</h1>';
} ?>
            </div>
            <!-- End of offset1-->

            <!-- start EAN multiple locations found and load more hotels -->
<?php if ($appModule == "ean") {
    if ($multipleLocations > 0) {
        foreach ($locationInfo as $loc) { ?>
                        <p><?php echo $loc->link; ?></p>
        <?php }
    } ?>
                <!--This is for display cache Parameter-->
                <div id="latest_record_para">
                    <input type="hidden" name="moreResultsAvailable" id="moreResultsAvailable" value="<?php echo $moreResultsAvailable; ?>" />
                    <input type="hidden" name="cacheKey" id="cacheKey" value="<?php echo $cacheKey; ?>" />
                    <input type="hidden" name="cacheLocation" id="cacheLocation" value="<?php echo $cacheLocation; ?>" />
                    <input type="hidden" name="" id="agesappendurl" value="<?php echo $agesApendUrl; ?>" />
                    <input type="hidden" name="" id="adultsCount" value="<?php echo $adults; ?>" />
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
<script type="text/javascript">
<?php if ($appModule == "cars") { ?>
        $(function(){
        $(".saveDates").on("click", function(){
        var pickup = $("#departcar").val();
        var drop = $("#returncar").val();
        var htmlvar = pickup + ' - ' + drop;
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
<?php foreach ($module as $item): ?>
                {
                name: 'hotel name',
                        location_latitude: "<?php echo $item->latitude; ?>",
                        location_longitude: "<?php echo $item->longitude; ?>",
                        map_image_url: "<?php echo $item->thumbnail; ?>",
                        name_point: "<?php echo $item->title; ?>",
                        description_point: "<?php echo character_limiter(strip_tags(trim($item->desc)), 75); ?>",
                        url_point: "<?php echo $item->slug; ?>"
                },
<?php endforeach; ?>

            ],
            };
    var mapOptions = {
<?php if (empty($_GET)) { ?>
        zoom: 10,
<?php } else { ?>
        zoom: 12,
<?php } ?>
    center: new google.maps.LatLng(<?php echo $item->latitude; ?>, <?php echo $item->longitude; ?>),
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
            '<h3>' + item.name_point + '</h3>' +
            '<span>' + item.description_point + '</span>' +
            '<a href="' + item.url_point + '" class="btn btn-primary"><?php echo trans('0177'); ?></a>' +
            '</div>',
            disableAutoPan: true,
            maxWidth: 0,
            pixelOffset: new google.maps.Size(40, - 190),
            closeBoxMargin: '0px -20px 2px 2px',
            closeBoxURL: "<?php echo $theme_url; ?>assets/img/close.png",
            isHidden: false,
            pane: 'floatPane',
            enableEventPropagation: true
    }); }; });</script>
<script src="<?php echo $theme_url; ?>assets/js/infobox.js"></script>
<script src="<?php echo $theme_url; ?>assets/include/icheck/icheck.min.js"></script>
<link href="<?php echo $theme_url; ?>assets/include/icheck/square/grey.css" rel="stylesheet">
<script type="text/javascript">
    var cb, optionSet1;
    $(".checkbox").iCheck({
    checkboxClass: "icheckbox_square-grey",
            radioClass: "iradio_square-grey"
    });
    $(".radio").iCheck({
    checkboxClass: "icheckbox_square-grey",
            radioClass: "iradio_square-grey"
    });</script>
<script type="text/javascript">
    $(document).ready(function() {
    $('input[type=radio][name=sortby]').change(function() {
    $('form').submit();
    });
    });</script>

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
                            echo '{ label: "'.$list->location.'", category: "Bạn muốn đặt khách sạn ở đâu", modType: "location", id: "'.$list->id.'", desc: "Tỉnh thành", address: ""},';
                        } ?>
            <?php $hotellistings = getHotels();
                foreach($hotellistings->locations as $hotel){
                echo '{ label: "'.$hotel->hotel_title.'", category: "Khách sạn", modType: "hotel", id: "'.$hotel->hotel_id.'", desc: "'.$hotel->city.'", address: "'.$hotel->address.' - '.$hotel->near.'"},';
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
