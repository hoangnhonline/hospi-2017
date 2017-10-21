<link href="<?php echo $theme_url; ?>assets/include/slider/slider.min.css" rel="stylesheet" />
<script src="<?php echo $theme_url; ?>assets/js/single.js"></script>
<script src="<?php echo $theme_url; ?>/assets/js/jquery.nicescroll.min.js"></script>
<script src="<?php echo $theme_url; ?>assets/include/slider/slider.js"></script>
<script src="<?php echo $theme_url; ?>assets/js/infobox.js"></script>
<div class="mtslide2 sliderbg2"></div>
<!-- map -->
<div class="collapse" id="collapseMap">
    <?php if ($appModule == "tours") { ?>
        <iframe id="mapframe" width="100%" height="450" style="position: static;" src="" frameborder="0"></iframe>
        <script>
            $('#collapseMap').on('shown.bs.collapse', function (e) {
                $("#mapframe").prop("src", "<?php echo base_url(); ?>tours/tourmap/<?php echo $module->id; ?>");
                    });
        </script>
    <?php } ?>
</div>
<!-- map -->
<div id="OVERVIEW" class="container">
    <!-- aside -->
    <div class="secondary col-md-3 go-right">
        <div class="panel-body panel panel-default">
            <div class="tour-price-detail">
            <div class="andes text-center tour-price-text">
                <?php echo trans('0777'); ?>
            </div>
            <div class="andes size30 text-center">
                <?php echo $module->perAdultPrice; ?>
            </div>
            <div class="text-center">
                <?php echo trans('0781'); ?>
            </div>
            </div>
            <div id="purple-chevron"></div>
            <div class="clearfix"></div>
            <br>
            <!-- Start Tour Form aside -->
            <?php if ($appModule == "tours") { ?>
            <span class="book-tour-title purple"><i class="fa fa-angle-right" aria-hidden="true"></i> <?php echo trans('0795'); ?></span><span class="matour"><?php echo $module->tourcode; ?></span>
            <hr>
                <div class="book-tour-title purple"><i class="fa fa-angle-right" aria-hidden="true"></i> <?php echo trans('0792'); ?></div>        
                <form action="" method="GET" >
                        
                        <div class="date-box" style="position: relative;">
                            <input id="tchkin" name="date" value="<?php echo $module->date; ?>" placeholder="date" type="text" class="form-control form-group mySelectCalendar" placeholder="<?php echo trans('012'); ?>">
                            <button type="submit" class="btn btn-block btn-info pull-right"><?php echo trans('0454'); ?></button>
                        </div>
                </form>
                <div class="clearfix"></div>
                <hr>
                <div class="book-tour-title purple"><i class="fa fa-angle-right" aria-hidden="true"></i> <?php echo trans('0793'); ?></div>
                <form  action="<?php echo base_url() . $appModule; ?>/book/<?php echo $module->bookingSlug; ?>" method="GET" role="search">
                    
                        
                        
                    <input type="hidden" name="date" value="<?php echo $module->date; ?>">
                        <?php if (!empty($modulelib->error)) { ?>
                            <div class="alert alert-danger go-text-right">
                                <?php echo trans($modulelib->errorCode); ?>
                            </div>
                        <?php } ?>
                        
                            <?php if ($module->adultStatus) { ?>
                    <div class="passenger">
                                <?php echo trans('010'); ?>
                                        <select style="min-width:50px;width:auto" name="adults" class="selectx changeInfo input-sm" id="selectedAdults">
                                            <?php for ($adults = 1; $adults <= $module->maxAdults; $adults++) { ?>
                                                <option value="<?php echo $adults; ?>" <?php echo makeSelected($selectedAdults, $adults); ?>><?php echo $adults; ?></option>
                                            <?php } ?>
                                        </select>
                    </div>
                                    
                            <?php } if ($module->childStatus) { ?>
                    <div class="passenger">
                                <?php echo trans('011'); ?> <span style="color:#888;"><?php echo trans('0794'); ?></span>
                                        <br><select style="min-width:50px;width:auto" name="child" class="selectx changeInfo input-sm" id="selectedChild">
                                            <option value="0">0</option>
                                            <?php for ($child = 1; $child <= $module->maxChild; $child++) { ?>
                                                <option value="<?php echo $child; ?>" <?php echo makeSelected($selectedChild, $child); ?> ><?php echo $child; ?></option>
                                            <?php } ?>
                                        </select>
                    </div>                
                            <?php } if ($module->infantStatus) { ?>
                    <div class="passenger">
                                <?php echo trans('011'); ?> <span style="color:#888;text-transform:lowercase"><?php echo trans('0788'); ?></span>
                                        <br><select style="min-width:50px;width:auto" name="infant" class="selectx changeInfo input-sm" id="selectedInfants">
                                            <option value="0">0</option>
                                            <?php for ($infant = 1; $infant <= $module->maxInfant; $infant++) { ?>
                                                <option value="<?php echo $infant; ?>" <?php echo makeSelected($selectedInfants, $infant); ?> ><?php echo $infant; ?></option>
                                            <?php } ?>
                                        </select>
                    </div>                
                            <?php } ?>
                    <hr>    
                    <div class="row">

                        <div class="col-md-12">
                            <button style="height: 64px; margin: 3px;" type="submit" class="btn btn-block btn-action btn-lg"><?php echo trans('0778'); ?></button>
                        </div>
                    </div>
                </form>
            <?php } ?>
            <!-- End Tour Form aside -->

            <input type="hidden" id="loggedin" value="<?php echo $usersession; ?>" />
            <input type="hidden" id="itemid" value="<?php echo $module->id; ?>" />
            <input type="hidden" id="module" value="<?php echo $appModule; ?>" />
            <input type="hidden" id="addtxt" value="<?php echo trans('029'); ?>" />
            <input type="hidden" id="removetxt" value="<?php echo trans('028'); ?>" />

        </div>
        <script>
            $(function () {

                $(".changeInfo").on("change", function () {
                    var tourid = "<?php echo $module->id; ?>";
                    var adults = $("#selectedAdults").val();
                    var child = $("#selectedChild").val();
                    var infants = $("#selectedInfants").val();
                    $.post("<?php echo base_url() ?>tours/tourajaxcalls/changeInfo", {tourid: tourid, adults: adults, child: child, infants: infants}, function (resp) {
                        var result = $.parseJSON(resp);
                        $(".adultPrice").html(result.currSymbol + result.adultPrice);
                        $(".childPrice").html(result.currSymbol + result.childPrice);
                        $(".infantPrice").html(result.currSymbol + result.infantPrice);
                        $(".totalCost").html(result.currCode + " " + result.currSymbol + result.totalCost);
                        $(".totaldeposit").html(result.currCode + " " + result.currSymbol + result.totalDeposit);
                        console.log(result);
                    })
                }); //end of change info
            })// end of document ready
        </script>
        <!-- aside -->


        <!------------------------  Related Listings   ------------------------------>
        <?php if (!empty($module->relatedItems)) { ?>

            <div class="list-group">
                <div class="panel panel-default">
                    <div class="panel-heading go-text-right"><?php echo trans('0453'); ?></div>
                    <?php foreach ($module->relatedItems as $item): ?>
                        <div class="featured">
                            <div class="related-title"><img src="<?php echo base_url(); ?>uploads/images/tours/icons/locicon.png"><a href="<?php echo $item->slug; ?>"><?php echo $item->title; ?></a></div>
                            <div class="related-desc"><?php echo trans('0791'); ?><?php echo $item->departure; ?></div>
                            <div class="related-desc"><?php echo trans('0790'); ?><span class="related-amount purple"><?php echo $item->price; ?></span> <span class="related-symbol purple"><?php echo $item->currSymbol; ?></span></div>
                            <div class="related-desc"><i class="fa fa-angle-double-right purple" aria-hidden="true"></i> <a href="<?php echo $item->slug; ?>"><?php echo trans('0177'); ?></a></div>
                        </div>
                        <!--//item-->
                        <hr style="margin-top:10px;margin-bottom:10px">
                    <?php endforeach; ?>
                </div>
            </div>

        <?php } ?>
        <!------------------------  Related Listings   ------------------------------>

    </div>

    <div class="col-md-9 go-left">
        <div  class="">
            <div class="tour-detail">
                <h2 class="go-right" style="display:inline-block;"><?php echo $module->title; ?></h2> <span class="purple"><?php echo $module->tourDays; ?> <?php echo trans('0275'); ?> <?php echo $module->tourNights; ?> <?php echo trans('0276'); ?></span>
                <div class="clearfix"></div>
                <span class="go-right RTL"><?php echo "<span class='tour-desc'>" . trans("0772") . "</span> <i class='fa fa-angle-double-right' aria-hidden='true'></i> <span class='andes-bold purple'>" . $module->departure . "</span>"; ?> | <?php echo "<span class='tour-desc'>" . trans("0773") . "</span> <i class='fa fa-angle-double-right' aria-hidden='true'></i> <span class='andes-bold purple'>" . $module->transportation . "</span>"; ?> | <?php echo "<span class='tour-desc'>" . trans("0774") . "</span> <i class='fa fa-angle-double-right' aria-hidden='true'></i> <span class='andes-bold purple'>" . $module->location . "</span>"; ?>
            </div>



            <div class="clearfix"></div>

            <div style="margin-top:10px">
                <!-- slider -->
                <div class="fotorama bg-dark" data-allowfullscreen="true" data-nav="thumbs">
                    <?php foreach ($module->sliderImages as $img) { ?>
                        <img src="<?php echo $img['fullImage']; ?>" />
                    <?php } ?>
                </div>
            </div>
            <div class="clearfix"></div>
            <h2 class="tour-amenities"><?php echo trans('0789');?></h2>
            <div class="clearfix"></div>
            <?php foreach($module->inclusions as $inclusion){ if(!empty($inclusion->name)){  ?>
            <ul class="col-md-4 RTL" style="margin: 0 0 5px 0;list-style-type:none;">
              <li class="go-right"><i class="amenities-star text-warning fa fa-star voted"></i> <?php echo $inclusion->name; ?></li>
            </ul>
            <?php } } ?>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
        <ul class="nav nav-tabs">
            <li class="active"><a href="#description" data-toggle="tab"><?php echo trans('0782'); ?></a></li>
            <li><a href="#information" data-toggle="tab"><?php echo trans('0783'); ?></a></li>
            <li><a href="#partner" data-toggle="tab"><?php echo trans('0784'); ?></a></li>
        </ul>
        <div class="list-group tour-details-panel">
            <div class="panel panel-default">

                <div class="tab-content" style="padding:0;"> 
                    <div class="tab-pane active" id="description">
                        <div style="display: inline-block;width: 100%;padding: 20px;">
                            <?php echo $module->desc; ?>
                        </div>
                    </div>

                    <div class="tab-pane" id="information">
                        <div style="display: inline-block;width: 100%;padding: 20px;">
                            <h4 class="main-title go-right tour-info-title"><?php echo trans('0785'); ?> <span style="color:#555;font-size: 14px;text-transform: uppercase;"><?php echo trans('0781'); ?></span></h4>
                            <div class="clearfix"></div>
                            <br>
                            <div class="row">
                        <div class="col-md-3">
                            <div class="price-item">
                            <div class="text-center price-title"><?php echo trans('010'); ?></div>
                            <div class="text-center price-age"><?php echo trans('0786'); ?></div>
                            <div class="text-center price-img"><img src="<?php echo base_url(); ?>uploads/images/tours/icons/adult.png"></div>
                            <div class="text-center price-amount"><?php echo $module->perAdultPrice; ?></div>
                            </div>
                        </div>
                        <?php if ($module->childStatus) { ?>
                        <div class="col-md-3">
                            <div class="price-item">
                            <div class="text-center price-title"><?php echo trans('011'); ?></div>
                            <div class="text-center price-age"><?php echo trans('0787'); ?></div>
                            <div class="text-center price-img"><img src="<?php echo base_url(); ?>uploads/images/tours/icons/children.png"></div>
                            <div class="text-center price-amount"><?php echo $module->perChildPrice; ?></div>
                            </div>
                        </div>
                        <?php } ?>
                        <?php if ($module->infantStatus) { ?>
                        <div class="col-md-3">
                            <div class="price-item">
                            <div class="text-center price-title"><?php echo trans('011'); ?></div>
                            <div class="text-center price-age"><?php echo trans('0788'); ?></div>
                            <div class="text-center price-img"><img src="<?php echo base_url(); ?>uploads/images/tours/icons/children.png"></div>
                            <div class="text-center price-amount"><?php echo $module->perInfantPrice; ?></div>
                            </div>
                        </div>
                        <?php } ?>
                            </div>
                        <div class="clearfix"></div>
                        <div id="INCLUSIONS">
                            <h4 class="main-title go-right tour-info-title"><?php echo trans('0280'); ?></h4>
                            <div class="clearfix"></div>
                            <div class="clearfix"></div>
                            <br>
                            <?php if (!empty($module->include)) { ?>
                                <?php echo nl2br($module->include); ?>
                            <?php } ?>
                            <div class="clearfix"></div>
                        </div>

                        <div id="EXCLUSIONS">
                            <h4 class="main-title go-right tour-info-title"><?php echo trans('0281'); ?></h4>
                            <div class="clearfix"></div>
                            <br>
                            <?php if (!empty($module->exclude)) { ?>
                                <?php echo nl2br($module->exclude); ?>
                            <?php } ?>
                            <div class="clearfix"></div>
                        </div>
                        </div>
                        </div>

                    <div class="tab-pane" id="partner">
                        <div style="display: inline-block;width: 100%;padding: 20px;">
                            HOSPI
                        </div>
                    </div>

                </div>
            </div>
        </div>




    </div>
    <!-- slider -->


</div>

<script>
    //------------------------------
    // Write Reviews
    //------------------------------
    $(function () {
        $('.reviewscore').change(function () {
            var sum = 0;
            var avg = 0;
            var id = $(this).attr("id");
            $('.reviewscore_' + id + ' :selected').each(function () {
                sum += Number($(this).val());
            });
            avg = sum / 5;
            $("#avgall_" + id).html(avg);
            $("#overall_" + id).val(avg);
        });

        //submit review
        $(".addreview").on("click", function () {
            var id = $(this).prop("id");
            $.post("<?php echo base_url(); ?>admin/ajaxcalls/postreview", $("#reviews-form-" + id).serialize(), function (resp) {
                var response = $.parseJSON(resp);
                // alert(response.msg);
                $("#review_result" + id).html("<div class='alert " + response.divclass + "'>" + response.msg + "</div>").fadeIn("slow");
                if (response.divclass == "alert-success") {
                    setTimeout(function () {
                        $("#ADDREVIEW").removeClass('in');
                        $("#ADDREVIEW").slideUp();
                    }, 5000);
                }
            });
            setTimeout(function () {
                $("#review_result" + id).fadeOut("slow");
            }, 3000);
        });
    })

    //------------------------------
    // Add to Wishlist
    //------------------------------
    $(function () {
        // Add/remove wishlist
        $(".wish").on('click', function () {
            var loggedin = $("#loggedin").val();
            var removelisttxt = $("#removetxt").val();
            var addlisttxt = $("#addtxt").val();
            var title = $("#itemid").val();
            var module = $("#module").val();
            if (loggedin > 0) {
                if ($(this).hasClass('addwishlist')) {
                    var confirm1 = confirm("<?php echo trans('0437'); ?>");
                    if (confirm1) {
                        $(".wish").removeClass('addwishlist btn-primary');
                        $(".wish").addClass('removewishlist btn-warning');
                        $(".wishtext").html(removelisttxt);
                        $.post("<?php echo base_url(); ?>account/wishlist/add", {loggedin: loggedin, itemid: title, module: module}, function (theResponse) { });
                    }
                    return false;
                } else if ($(this).hasClass('removewishlist')) {
                    var confirm2 = confirm("<?php echo trans('0436'); ?>");
                    if (confirm2) {
                        $(".wish").addClass('addwishlist btn-primary');
                        $(".wish").removeClass('removewishlist btn-warning');
                        $(".wishtext").html(addlisttxt);
                        $.post("<?php echo base_url(); ?>account/wishlist/remove", {loggedin: loggedin, itemid: title, module: module}, function (theResponse) {
                        });
                    }
                    return false;
                }
            } else {
                alert("<?php echo trans('0482'); ?>");
            }
        });
        // End Add/remove wishlist
    })

    //------------------------------
    // Rooms
    //------------------------------

    $('.collapse').on('show.bs.collapse', function () {
        $('.collapse.in').collapse('hide');
    });
<?php if ($appModule == "hotels") { ?>
        jQuery(document).ready(function ($) {
            $('.showcalendar').on('change', function () {
                var roomid = $(this).prop('id');
                var monthdata = $(this).val();
                $("#roomcalendar" + roomid).html("<br><br><div id='rotatingDiv'></div>");
                $.post("<?php echo base_url(); ?>hotels/roomcalendar", {roomid: roomid, monthyear: monthdata}, function (theResponse) {
                    console.log(theResponse);
                    $("#roomcalendar" + roomid).html(theResponse);
                });
            });
        });
<?php } ?>

</script>