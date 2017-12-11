<script type="text/javascript" src="<?php echo $theme_url; ?>plugins/jslider/js/jshashtable-2.1_src.js"></script>
<script type="text/javascript" src="<?php echo $theme_url; ?>plugins/jslider/js/jquery.numberformatter-1.2.3.js"></script>
<script type="text/javascript" src="<?php echo $theme_url; ?>plugins/jslider/js/tmpl.js"></script>
<script type="text/javascript" src="<?php echo $theme_url; ?>plugins/jslider/js/jquery.dependClass-0.1.js"></script>
<script type="text/javascript" src="<?php echo $theme_url; ?>plugins/jslider/js/draggable-0.1.js"></script>
<script type="text/javascript" src="<?php echo $theme_url; ?>plugins/jslider/js/jquery.slider.js"></script>
<link rel="stylesheet" href="<?php echo $theme_url; ?>plugins/jslider/css/jslider.css" type="text/css">
<link rel="stylesheet" href="<?php echo $theme_url; ?>plugins/jslider/css/jslider.round.css" type="text/css">
<?php if($appModule == "offers"){ ?>
<div class="container offer-banners">
    <div id="carousel-banner" class="carousel slide" data-ride="carousel">
        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            <?php
            $input = get_widget_content(82);
            preg_match_all('/<img[^>]+>/i',$input, $result);
            $i=0;
            foreach($result[0] as $img)
            {
                if($i==0) {
                    echo "<div class='item active'>";
                } else {
                    echo "<div class='item'>";
                }
                echo $img;
                echo "</div>";
                $i++;
            }

            ?>
        </div>
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <?php $total = count($result[0]);?>
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
    </div>
    <!-- Carousel -->
    <?php } ?>
    <div class="clearfix"></div>
    <ul class="offer-banner-bottom">
        <li class="active"><a href="<?php echo base_url();?>offers"><?php echo trans('0580'); ?></a></li>
        <li><a href=""><?php echo trans('0558'); ?></a></li>
        <li><a href="<?php echo base_url();?>offers/bestchoice"><?php echo trans('0559'); ?></a></li>
    </ul>
</div>
<!-- CONTENT -->
<div class="collapse" id="collapseMap">
    <div id="map" class="map"></div>
    <br>
</div>
<div class="container pagecontainer offset-0">
    <!-- LIST CONTENT-->
    <div class="offer-page rightcontent col-md-12 offset-0">
        <div class="itemscontainer offset-1">
            <div class="offset-2">
                <h1 class="h1-offers"><?php echo trans('0580'); ?></h1>
                <div style="color: #666666; font-size: 15px;"><?php echo trans('0592'); ?></div>
                <div style="margin-top:30px">
                    <span style="color: #666666; font-size: 16px;"><?php echo trans('0593'); ?></span>
                    <form name="itemlist" id="itemlist" class="itemlist-cus" action="" method="post">
                        <select id="location" name="location" onchange="submitform();">
                            <option value=""><?php echo trans('0690'); ?></option>
                            <?php
                            $location = getLocations();
                            $selected = "";
                            foreach($location as $loc){
                                if($_GET['location']==$loc->id) $selected = "selected"; else $selected = "";
                                echo "<option value='".$loc->id."' ".$selected.">".$loc->location."</option>";
                            }
                            ?>
                        </select>
                    </form>
                </div>
                <div style="margin-top:30px"></div>
            </div>
            <?php
            if (!empty($module)) {
                $line = 0;
                foreach ($module as $item) {
                    if ($line == 8) echo "<div class='block-news-addon clearfix'><div class='row'><div class='col-sm-6 col-xs-6'><ul class='offset-2 offer-page'>";
                    if ($line == 11) { echo "</ul></div><div class='col-sm-6 col-xs-6'>"; echo run_widget(83);echo "</div>";echo "</div></div>";}
                    if ($line < 8 || $line > 10) {
                        ?>
                        <div class="col-sm-3 col-xs-6">
                            <div class="wow fadeInUp offset-0 go-right">
                                <div class="img_list">
                                    <a href="<?php echo $item->slug;?>">
                                        <img src="<?php echo $item->thumbnail;?>" alt="<?php echo character_limiter($item->title,20);?>">
                                        <div class="short_info"></div>
                                    </a>
                                </div>
                                <span class="offer-location"><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo $item->city;?></span>
                            </div>
                            <div class="wow fadeInUp offset-0 offer-content">
                                <div class="itemlabel3">
                                    <div class="labelleft2 rtl_title_home">
                                        <h4 class="mtb0 RTL go-text-right offer-title-listing">
                                            <a href="<?php echo $item->slug;?>"><b><?php echo $item->title;?></b></a>
                                        </h4>
                                        <div class="offer-created-at"><?php echo date('d/m/Y', $item->offers_created_at);?></div>
                                        <p class="grey RTL"><?php echo character_limiter($item->desc,120);?></p>
                                        <div class="offer-xemthem"><a href="<?php echo $item->slug;?>">
                                                <i class='fa fa-angle-double-right' aria-hidden='true'></i> <?php echo trans('0177');?>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    } else {
                        ?>
                        <!-- News -->
                        <li>
                            <a class="sub-menu-link" href="<?php echo $item->slug; ?>" target="_blank">
                                <h4 class="offer-3title offer-title-listing"><b><?php echo $item->title; ?></b></h4>
                                <p class="offer-3content grey RTL"><?php echo character_limiter($item->desc,120);?></p>
                                <div class="offer-xemthem">
                                    <i class='fa fa-angle-double-right' aria-hidden='true'></i> <?php echo trans('0177');?>
                                </div>
                            </a>
                        </li>
                        <!-- End New -->
                        <?php
                    }
                    $line++;
                    if($line%4==0) echo "<div style='margin-bottom:10px;'></div>";
                }
                ?>
                <div class="clearfix"></div>
                <div class="col-md-12 text-center go-right"><?php echo createPagination($info);?></div>
                <?php
            } else {  echo '<div class="pull-right"><h1 class="text-center">' . trans("066") . '</h1></div>'; }
            ?>
            <!-- End of offset1-->
            <!-- start EAN multiple locations found and load more hotels -->
            <?php
            if ($appModule == "ean") {
                if ($multipleLocations > 0) {
                    foreach ($locationInfo as $loc) {
                        ?>
                        <p><?php echo $loc->link; ?></p>
                        <?php
                    }
                }
                ?>
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
                <?php
            }
            ?>
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
<script type="text/javascript">
    function submitform() {
        var url = document.location.href;
        formAction = document.itemlist.location[document.itemlist.location.selectedIndex].value;
        var currentUrl = url.indexOf("location") == -1 ? true : false;
        if (currentUrl) {
            var searchString = '?location=';
            searchString = url.indexOf("?") == -1 ? searchString : '&location=';
        } else {
            url = url.split('location')[0];
            var searchString = 'location=';
        }
        document.itemlist.action = url + searchString + formAction;
        document.getElementById('itemlist').submit();
    }
</script>