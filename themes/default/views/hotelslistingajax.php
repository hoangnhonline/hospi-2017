
    <div class="itemscontainer offset-1 hotels">
        <div class="offset-2">
            <div class="bg-form-arrangement">
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
                    <input type="hidden" name="checkin" value="<?php if (!empty($_GET['checkin'])) {
                        echo $_GET['checkin'];
                        } ?>">
                    <input type="hidden" name="checkout" value="<?php if (!empty($_GET['checkout'])) {
                        echo $_GET['checkout'];
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
                    <div class="col-md-3"><input type="radio" id="thap-cao" name="sortby" class="hospi-checkbox sortajax" value="p_lh" <?php if ($_GET['sortby'] == "p_lh") {
                        echo 'checked="checked"';
                        } ?>>  <label for="thap-cao" class="hospi-label">&nbsp;</label>
                        <span class="txt-label"><?php echo trans('0723'); ?></span>
                    </div>
                    <div class="col-md-3"><input type="radio" id="cao-thap" name="sortby" class="hospi-checkbox sortajax" value="p_hl" <?php if ($_GET['sortby'] == "p_hl") {
                        echo 'checked="checked"';
                        } ?>>  <label for="cao-thap" class="hospi-label">&nbsp;</label>
                        <span class="txt-label"><?php echo trans('0724'); ?></span>
                    </div>
                    <div class="col-md-3"><input type="radio" id="feature" name="sortby" class="hospi-checkbox sortajax" value="featured" <?php if ($_GET['sortby'] == "featured") {
                        echo 'checked="checked"';
                        } ?>>  <label for="feature" class="hospi-label">&nbsp;</label>
                        <span class="txt-label"><?php echo trans('0725'); ?></span>
                    </div>
                    <div class="clearfix"></div>
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
        </div>
        <?php
            if (!empty($module)) {
                $i = 1;
                 $moduleForeach = isset($resultSort) ? $resultSort : $module;              
                    foreach ($moduleForeach as $htl_id => $item) {
                    if(isset($resultSort)){
                        $item = $module[$htl_id];
                    }
                    ?>
        <div class="offset-2">
            <div class="searching-item row-eq-height">
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
                    <div class="itemlabel3 itemlabel3-cus">
                        <div class="labelright go-left" style="min-width:105px;margin-left:5px">
                            <br/>
                            <div class="purple size18 text-center">
                                <?php if ($item->price > 0) {
                                    if ($item->price_status == 'Yes') {
                                        ?>
                                <b>
                                    <?php echo $item->price; ?>
                                    <div class="smalltext">(VNĐ)</div>
                                </b>
                                <div class="clearfix"></div>
                                <hr>
                                <?php } else { ?>
                                <div class='click-2get-price'>
                                    <a id="popoverData" href="#emailme<?php echo $item->id; ?>" data-toggle="modal" data-content="<?php echo trans('0800'); ?>" rel="popover" data-placement="top" data-original-title="<?php echo $item->title; ?>" data-trigger="hover">
                                        <div class="click-a"><?php echo trans('0799'); ?></div>
                                        <i class="fa fa-check-circle-o" aria-hidden="true"></i>
                                    </a>
                                </div>
                                <div class="clearfix"></div>
                                <hr>
                                <?php } ?>
                                <?php } ?>
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
                        <div class="labelleft2 rtl_title_home description">
                            <h4 class="mtb0 RTL go-text-right hotel-name">
                                <a href="<?php echo $item->slug; ?>"><b><?php echo $item->title; ?></b></a>
                                <!-- Cars airport pickup -->  <?php if ($appModule == "cars") {
                                    if ($item->airportPickup == "yes") { ?> <button class="btn btn-success btn-xs"><i class="icon-paper-plane-2"></i> <?php echo trans('0207'); ?></button> <?php }
                                    } ?> <!-- Cars airport pickup -->
                            </h4>
                            <?php if ($appModule != "offers") { ?> <a class="go-right" href="javascript:void(0);" onclick="showMap('<?php echo base_url(); ?>home/maps/<?php echo $item->latitude; ?>/<?php echo $item->longitude; ?>/<?php echo $appModule; ?>/<?php echo $item->id; ?>', 'modal');" title="<?php echo $item->location; ?>"><i style="margin-left: -3px;" class="icon-location-6 go-right"></i><?php echo character_limiter($item->location, 10); ?></a> <span class="go-right"><?php echo $item->stars; ?></span> <?php } ?>
                            <br>
                            <ul class="itemlabel-info">
                                <li><a href="#" title="Combo"><span>Combo</span></a></li>
                                <li><a href="#" title="Deals - Giảm giá"><span>Deals - Giảm giá</span></a></li>
                                <li><a href="#" title="Gói honeymoon"><span>Gói honeymoon</span></a></li>
                                <li><a href="#" title="Đang khuyễn mãi"><span>Đang khuyễn mãi</span></a></li>
                            </ul>
                            <?php if (is_sales_off_hotel($item->id)) { ?>
                            <div class="purple sale-off-now-icon"><?php echo trans('0709'); ?>
                                <span class="sale-percent-star"><?php echo "-" . is_sales_off_hotel($item->id) . "%"; ?></span>
                            </div>
                            <?php } ?>
                            <p class="grey RTL des"><?php echo character_limiter($item->desc, 100); ?></p>
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
        <div class="col-md-12 go-right">

            <div class="block-pagination">
                <?php echo createPagination($info); ?></div>
            </div>
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
<script type="text/javascript">
    $('ul.pagination li a').each(function() {
        var url = $(this).attr('href');

        $(this)
            .attr('href', 'javascript:;')
            .attr('data-url', url)
            .data('url', url)
            .on('click', function(evt) {
                evt.preventDefault();

                ajaxSearchPagination($(this).data('url'));
            });
    });

    function ajaxSearchPagination(url){ // hoangnh
        url = url.replace('/search', '/searchajax');

        $.ajax({
            url : url,
            type : "get",
            beforeSend : function(){
                $('#right-content').html('<p style="text-align:center;margin-top:100px"><img src="<?php echo $theme_url ?>images/loading.gif"></p>');
                $('html, body').animate({
                    scrollTop: $("#right-content").offset().top
                }, 500);
            },
            success : function(data){
                $('#right-content').html(data);
            }
        });
    }
</script>