<div class="clearfix">
        <div class="block-rooms-rela">
            <?php if (!empty($rooms)) { ?>
            <?php foreach ($rooms as $r) {
                if ($r->maxQuantity > 0) { ?>
            <?php
                if (($r->honeymoon == "Yes") && honeymoonAvailable($r->id)) {
            ?>
            <div class="rooms-rela-item">
                <!-- Honeymoon -->
                <div class="rooms-update room-package">
                    <div class="labelleft2 rtl_title_home go-text-right RTL">
                        <h4 class="mtb0 RTL go-text-right">
                            <span class="purple andes-bold name-package"><b><?php echo trans("0567"); ?></b></span>
                            <span class="des-package">Áp dụng từ ngày <strong><?php echo date('d/m/Y', $r->hfrom); ?></strong> đến hết ngày <strong><?php echo date('d/m/Y', $r->hto); ?></strong></span>
                            <span class="price-package">
                                Giá:
                                <strong class="purple andes-bold" style="font-size: 20px;margin-left: 10px;">14.990.000</strong>
                                <strong class="purple andes-bold">vnd</strong>
                            </span>
                            <a class="view-more-package" data-toggle="modal" href="#details<?php echo $r->id; ?>"><?php echo trans("0640"); ?></a>
                        </h4>
                        <ul class="hotelpreferences go-right hidden-xs">
                            <?php $cnt = 0;
                                foreach ($item->amenities as $amt) {
                                    $cnt++;
                                    if ($cnt <= 10) {
                                        if (!empty($amt->name)) { ?>
                            <li><img title="<?php echo $amt->name; ?>" data-toggle="tooltip" data-placement="top" style="height:25px;" src="<?php echo $amt->icon; ?>" alt="<?php echo $amt->name; ?>" /></li>
                            <?php }
                                }
                                } ?>
                        </ul>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="clearfix"></div>
                <div id="details<?php echo $r->id; ?>" class="modal fade" tabindex="-1" data-focus-on="input:first" style="display: none;">
                    <div class="modal-dialog honey">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h3 class="modal-title purple andes-bold"><?php echo trans("0567"); ?></h3>
                                <div class="hotel-name">
                                    <span class="home-best-choice-hotel-title"><?php echo $module->title; ?></span>
                                    <span class="home-best-choice-hotel-rating"><?php echo $module->stars; ?></span>
                                    <span class="home-featured-hotel-address"><?php echo $module->mapAddress; ?></span>
                                </div>
                            </div>
                            <div class="modal-body">
                                <div class="panel-body">
                                    <?php if (!empty($r->desc)) { ?>
                                    <p class="room-title"><strong><?php echo $r->room_title; ?></strong></p>
                                    <p class="duration smalltext"><?php echo trans("0625"); ?><strong><?php echo date('d/m/Y', $r->hfrom); ?></strong> - <strong><?php echo date('d/m/Y', $r->hto); ?></strong></p>
                                    <div class="col-md-8 honey-desc"><?php echo $r->desc; ?>
                                        <?php } ?>
                                    </div>
                                    <div class="col-md-4 labelright go-left">
                                        <?php if ($r->price > 0) { ?>
                                        <div class="honey-price-title andes"><?php echo trans("0627"); ?></div>
                                        <div class="honey-price-amount"><?php echo $r->price; ?></div>
                                        <div align="center">
                                            <form action="<?php echo base_url() . $appModule; ?>/book/<?php echo $module->bookingSlug; ?>" method="GET">
                                                <input type="hidden" name="adults" value="2" />
                                                <input type="hidden" name="child" value="<?php echo $modulelib->children; ?>" />
                                                <div id="openModal" class="modalDialog firsttime">
                                                    <div>
                                                        <div class="honey-price-title andes"><?php echo trans("0636"); ?></div>
                                                        <br>
                                                        <label class="size12 RTL go-right"><i class="icon-calendar-7"></i> <?php echo trans('07'); ?></label>
                                                        <br><input type="text" id="honeycheckin" placeholder="<?php echo trans('07'); ?>" name="checkin" class="form-control dpd2" value="<?php echo $modulelib->checkin; ?>" required onblur="copyText()">
                                                        <br><a href="#close" title="Confirm" class="confirm purple andes-bold"><?php echo trans("0637"); ?></a>
                                                    </div>
                                                </div>
                                                <!--<input type="hidden" name="checkin" value="<?php echo $modulelib->checkin; ?>" />-->
                                                <input type="hidden" id="honeycheckout" name="checkout" />
                                                <input type="hidden" name="roomid" value="<?php echo $r->id; ?>" />
                                                <input type="hidden" name="honeymoon" value="1" />
                                                <div class="checkin_t"></div>
                                                <div class="button_t"><a href="#openModal" style="margin-bottom:5px" type="submit" class="btn btn-action chk"><?php echo trans('0600'); ?></a></div>
                                                <?php } ?>
                                                <input type="hidden" name="roomscount" value="1">
                                                <input type="hidden" name="extrabeds" value="0">
                                            </form>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <br>
                                    <h4 class="purple andes-bold"><?php echo trans("0628"); ?></h4>
                                    <div class=""><?php echo trans("0629"); ?><?php echo date('d/m/Y', $r->hfrom); ?> - <?php echo date('d/m/Y', $r->hto); ?></div>
                                    <div class=""><?php echo trans("0630"); ?></div>
                                    <div class=""><?php echo trans("0631"); ?></div>
                                    <div class=""><?php echo trans("0632"); ?></div>
                                    <div class=""><?php echo trans("0633"); ?></div>
                                    <br>
                                    <div class=""><?php echo trans("0634"); ?><?php echo $phone; ?><?php echo trans("0635"); ?><?php echo $contactemail; ?></div>
                                    <hr>
                                    <div class="carousel magnific-gallery row">
                                        <?php foreach ($r->Images as $Img) { ?>
                                        <div class="col-md-3">
                                            <div class="zoom-gallery<?php echo $r->id; ?>">
                                                <a href="<?php echo $Img['thumbImage']; ?>" data-source="<?php echo $Img['thumbImage']; ?>" title="<?php echo $r->title; ?>">
                                                <img class="img-responsive" src="<?php echo $Img['thumbImage']; ?>">
                                                </a>
                                            </div>
                                        </div>
                                        <script type="text/javascript">
                                            $('.zoom-gallery<?php echo $r->id; ?>').magnificPopup({
                                                delegate: 'a',
                                                type: 'image',
                                                closeOnContentClick: false,
                                                closeBtnInside: false,
                                                mainClass: 'mfp-with-zoom mfp-img-mobile',
                                                image: {
                                                    verticalFit: true,
                                                    titleSrc: function (item) {
                                                        return item.el.attr('title') + ' ';
                                                    }
                                                },
                                                gallery: {
                                                    enabled: true
                                                },
                                                zoom: {
                                                    enabled: true,
                                                    duration: 300, // don't foget to change the duration also in CSS
                                                    opener: function (element) {
                                                        return element.find('img');
                                                    }
                                                }
                                            
                                            });
                                            
                                            $(document).ready(function(){
                                            
                                                function DateFromString(str){ 
                                                    str = str.split(/\D+/);
                                                    str = new Date(str[2],str[1]-1,(parseInt(str[0])+2));
                                                    return DDMMYYYY(str);
                                                }
                                            
                                                function DDMMYYYY(str) {
                                                    var ndateArr = str.toString().split(' ');
                                                    var Months = 'Jan Feb Mar Apr May Jun Jul Aug Sep Oct Nov Dec';
                                                    var month = parseInt(Months.indexOf(ndateArr[1])/4)+1
                                                    if(month <= 9)
                                                        month = '0'+month;
                                                    return ndateArr[2] + '/' + month + '/' + ndateArr[3];
                                                }                                                                    
                                            
                                                function Add2Days() {
                                                    var date = $('#honeycheckin').val();
                                                    var ndate = DateFromString(date);
                                                    return ndate;
                                            
                                                }
                                            
                                                $('.confirm').click(function() {
                                                    $("#honeycheckout").val(Add2Days());
                                                    $("#openModal").removeClass("firsttime");
                                                    $(".checkin_t").html('<span class="date-checkin smalltext"><a href="#openModal"><i class="icon-calendar-7"></i> '+$("#honeycheckin").val()+'</a></span>')
                                                    $(".button_t").html('<button style="margin-bottom:5px" type="submit" class="btn btn-action chk"><?php echo trans('0142'); ?></button>');
                                                });
                                            
                                            });
                                            
                                            
                                            
                                            
                                            
                                        </script>
                                        <?php } ?>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="clearfix"></div>
                                </div>
                                <!--<button class="btn btn-default" data-toggle="modal" href="#stack2">Launch modal</button>-->
                            </div>
                        </div>
                    </div>
                </div>
                <div id="availability<?php echo $r->id; ?>" class="alert alert-info panel-collapse collapse">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <select id="<?php echo $r->id; ?>" class="form-control form showcalendar">
                                        <option value="0"><?php echo trans('0232'); ?></option>
                                        <option value="<?php echo $first; ?>"> <?php echo $from1; ?> - <?php echo $to1; ?></option>
                                        <option value="<?php echo $second; ?>"> <?php echo $from2; ?> - <?php echo $to2; ?></option>
                                        <option value="<?php echo $third; ?>"> <?php echo $from3; ?> - <?php echo $to3; ?></option>
                                        <option value="<?php echo $fourth; ?>"> <?php echo $from4; ?> - <?php echo $to4; ?></option>
                                    </select>
                                </div>
                            </div>
                            <div id="roomcalendar<?php echo $r->id; ?>"></div>
                        </div>
                    </div>
                </div>
                <div id="details<?php echo $r->id; ?>" class="alert alert-danger panel-collapse collapse">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="carousel magnific-gallery row">
                                <?php foreach ($r->Images as $Img) { ?>
                                <div class="col-md-3">
                                    <div class="zoom-gallery<?php echo $r->id; ?>">
                                        <a href="<?php echo $Img['thumbImage']; ?>" data-source="<?php echo $Img['thumbImage']; ?>" title="<?php echo $r->title; ?>">
                                        <img class="img-responsive" src="<?php echo $Img['thumbImage']; ?>">
                                        </a>
                                    </div>
                                </div>
                                <script type="text/javascript">
                                    $('.zoom-gallery<?php echo $r->id; ?>').magnificPopup({
                                        delegate: 'a',
                                        type: 'image',
                                        closeOnContentClick: false,
                                        closeBtnInside: false,
                                        mainClass: 'mfp-with-zoom mfp-img-mobile',
                                        image: {
                                            verticalFit: true,
                                            titleSrc: function (item) {
                                                return item.el.attr('title') + ' ';
                                            }
                                        },
                                        gallery: {
                                            enabled: true
                                        },
                                        zoom: {
                                            enabled: true,
                                            duration: 300, // don't foget to change the duration also in CSS
                                            opener: function (element) {
                                                return element.find('img');
                                            }
                                        }
                                    
                                    });
                                    
                                </script>
                                <?php } ?>
                            </div>
                            <div class="clearfix"></div>
                            <br>
                            <?php if (!empty($r->desc)) { ?>
                            <p class="andes-bold"><strong><?php echo trans('046'); ?> : </strong> <?php echo $r->desc; ?></p>
                            <?php } ?>
                            <form action="<?php echo base_url() . $appModule; ?>/book/<?php echo $module->bookingSlug; ?>" method="GET">
                                <input type="hidden" name="adults" value="<?php echo $modulelib->adults; ?>" />
                                <input type="hidden" name="child" value="<?php echo $modulelib->children; ?>" />
                                <input type="hidden" name="checkin" value="<?php echo $modulelib->checkin; ?>" />
                                <input type="hidden" name="checkout" value="<?php echo $modulelib->checkout; ?>" />
                                <input type="hidden" name="roomid" value="<?php echo $r->id; ?>" />
                                <div class="labelright go-left" style="min-width:180px;margin-left:5px">
                                    <?php if ($r->price > 0) { ?>
                                    <button style="margin-bottom:5px" type="submit" class="btn btn-action btn-block chk"><?php echo trans('0142'); ?></button>
                                    <?php } ?>
                                    <input type="hidden" name="roomscount" value="1">
                                    <input type="hidden" name="extrabeds" value="0">
                                </div>
                            </form>
                            <hr>
                            <?php if (!empty($r->Amenities)) { ?>
                            <p class="andes-bold"><strong><?php echo trans('055'); ?> : </strong></p>
                            <?php foreach ($r->Amenities as $roomAmenity) {
                                if (!empty($roomAmenity->name)) { ?>
                            <div class="col-md-4">
                                <ul class="list_ok">
                                    <li><?php echo $roomAmenity->name; ?></li>
                                </ul>
                            </div>
                            <?php }
                                }
                                } ?>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <!-- <div class="clearfix" style="margin-bottom: 20px;"></div> -->
                <div class="offset-2"></div>
                <!-- End Honeymoon -->
            </div>
            <?php } else { ?>
            <div class="rooms-rela-item">
                <form action="<?php echo base_url() . $appModule; ?>/book/<?php echo $module->bookingSlug; ?>" method="GET">
                    <input type="hidden" name="adults" value="<?php echo $modulelib->adults; ?>" />
                    <input type="hidden" name="child" value="<?php echo $modulelib->children; ?>" />
                    <input type="hidden" name="checkin" value="<?php echo $modulelib->checkin; ?>" />
                    <input type="hidden" name="checkout" value="<?php echo $modulelib->checkout; ?>" />
                    <input type="hidden" name="roomid" value="<?php echo $r->id; ?>" />
                    <div class="rooms-update">
                        <div class="col-md-3 col-sm-3 offset-0 go-right">
                            <div class="zoom-gallery<?php echo $r->id; ?>">
                                <a href="<?php echo $r->fullimage; ?>" data-source="<?php echo $r->fullimage; ?>" title="<?php echo $r->title; ?>">
                                <img class="img-responsive" src="<?php echo $r->thumbnail; ?>">
                                </a>
                            </div>
                        </div><!-- col-md-3 col-sm-3 offset-0 go-right -->
                        <div class="col-md-9 offset-0">
                            <div class="row-eq-height">

                                <div class="col-md-5 rtl_title_home go-text-right RTL">
                                    <?php if($r->issale>0 && $r->onsale==true) { ?>
                                    <div class="col-md-6">
                                    <?php }else { ?>
                                    <div class="row col-md-10">
                                        <?php } ?>
                                        <h4 class="mtb0 RTL go-text-right">
                                            <b class="purple"><?php echo $r->title; ?></b>
                                        </h4>
                                        <div class="block-people">
                                            <h5><?php echo trans('010'); ?>: <span><?php echo $r->Info['maxAdults']; ?></span> </h5>
                                            <h5><?php echo trans('011'); ?>: <span><?php echo $r->Info['maxChild']; ?></span></h5>
                                        </div>
                                        <div class="block-view-detail">
                                            <div class="visible-lg visible-md go-right" id="accordion" style="margin-top: 0px;">
                                                <a data-toggle="modal" href="#details<?php echo $r->id; ?>"><?php echo trans("0640"); ?></a>
                                            </div>
                                        </div>
                                    </div><!-- /row col-md-10 -->

                                    <?php if($r->issale>0 && $r->onsale==true) { ?>
                                    <div class="col-md-4">
                                        <div class="five-star">
                                            <h5 class="red"><?php echo trans('0709');?></h5>
                                            <div class="from-date"><?php echo trans('0712');?><?php echo gmdate('d/m/Y',$r->salefrom); ?></div>
                                            <div class="to-date"><?php echo trans('0713');?><?php echo gmdate('d/m/Y',$r->saleto); ?></div>
                                        </div>
                                    </div><!-- /col-md-4 -->
                                    <?php } ?>
                                        
                                    <ul class="hotelpreferences go-right hidden-xs">
                                        <?php $cnt = 0;
                                            foreach ($item->amenities as $amt) {
                                                $cnt++;
                                                if ($cnt <= 10) {
                                                    if (!empty($amt->name)) { ?>
                                        <li><img title="<?php echo $amt->name; ?>" data-toggle="tooltip" data-placement="top" style="height:25px;" src="<?php echo $amt->icon; ?>" alt="<?php echo $amt->name; ?>" /></li>
                                        <?php }
                                            }
                                            } ?>
                                    </ul><!-- /hotelpreferences -->

                                    <?php if($r->issale>0 && $r->onsale==true) { ?>
                                    <div class="basic-price-line"></div><!-- /basic-price-line -->
                                    <div class="basic-price">
                                        <div class="col-md-3 go-left">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h5 class="size12"><?php echo trans('0374'); ?></h5>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="">
                                                        <select class="form-control mySelectBoxClass input-sm" name="roomscount" >
                                                            <?php for ($q = 1; $q <= $r->maxQuantity; $q++) { ?>
                                                            <option value="<?php echo $q; ?>"><?php echo $q; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <?php if ($r->extraBeds > 0) { ?>
                                                <div class="col-md-6" style="white-space: nowrap;">
                                                    <h5 class="size12"><?php echo trans('0428'); ?></h5>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="">
                                                        <select name="extrabeds" class="form-control mySelectBoxClass input-sm" id="">
                                                            <option value="0">0</option>
                                                            <?php for ($i = 1; $i <= $r->extraBeds; $i++) { ?>
                                                            <option value="<?php echo $i; ?>"> <?php echo $i; ?> <?php echo $r->currCode . " " . $r->currSymbol . $i * $r->extrabedCharges; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <div class="col-md-9 rtl_title_home go-text-right RTL">
                                            <div class="row col-md-10">
                                                &nbsp;
                                            </div>
                                            <div class="col-md-2">
                                                <span class="ipull-right block-price">
                                                    <span class="purple size18">
                                                        <?php if ($r->price > 0) { ?>
                                                        <b>
                                                            <?php echo $r->price; ?>                        
                                                        </b>
                                                    </span>        
                                                    <span class="size11 grey" style="white-space: nowrap;">
                                                        <strong><?php echo trans('070'); ?> <?php echo $modulelib->stay; ?> <?php echo trans('0122'); ?></strong> 
                                                    </span>
                                                    <?php } ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div><!-- /basic-price -->
                                    <?php } ?>
                                    <!-- basic price -->
                                </div><!-- col-md-5 rtl_title_home go-text-right RTL -->

                                <div class="col-md-3 go-left">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h5 class="size12" style="white-space: nowrap;"><?php echo trans('0374'); ?></h5>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="">
                                                <select class="form-control mySelectBoxClass input-sm" name="roomscount" >
                                                    <?php for ($q = 1; $q <= $r->maxQuantity; $q++) { ?>
                                                    <option value="<?php echo $q; ?>"><?php echo $q; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                        <?php if ($r->extraBeds > 0) { ?>
                                        <div class="col-md-6" style="white-space: nowrap;">
                                            <h5 class="size12"><?php echo trans('0428'); ?></h5>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="">
                                                <select name="extrabeds" class="form-control mySelectBoxClass input-sm" id="">
                                                    <option value="0">0</option>
                                                    <?php for ($i = 1; $i <= $r->extraBeds; $i++) { ?>
                                                    <option value="<?php echo $i; ?>"> <?php echo $i; ?> <?php echo $r->currCode . " " . $r->currSymbol . $i * $r->extrabedCharges; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div><!-- col-md-3 go-left -->

                                <div class="col-md-4">
                                    <div class="ipull-right block-price">
                                        <?php if ($r->price > 0) { ?>
                                        <p class="purple size18">
                                            <?php if ($module->price_status == 'Yes') { if($r->issale>0 && $r->onsale==true) echo "<b>". $r->saleprice ."</b>"; else echo "<b>". $r->price ."</b>"; ?>
                                            <!--<small><?php echo $r->currCode; ?>  </small> <?php echo $r->currSymbol; ?><?php echo $r->price; ?>-->
                                        </p>
                                        <p class="size13 grey" style="white-space: nowrap;">
                                            <strong><?php echo trans('070'); ?> <?php echo $modulelib->stay; ?> <?php echo trans('0122'); ?></strong>
                                        </p>
                                        <?php } else { ?>
                                        <p class="size13" style="white-space: nowrap;text-align: center;">
                                            <a href="#emailme<?php echo $module->id; ?>" data-toggle="modal" data-content="<?php echo trans('0800'); ?>" rel="popover" data-placement="top" data-original-title="<?php echo $item->title; ?>" data-trigger="hover"><?php echo trans('0799'); ?></a>
                                        </p>
                                        <?php } ?>
                                        <p class="block-price-info">
                                            <span>Bao gồm: Ăn sáng;</span>
                                            <span>Phí dịch vụ 5%, VAT 10%</span>
                                        </p>
                                        <div class="clearfix"></div>
                                        <?php } ?>
                                    </div>
                                </div><!-- col-md-4 -->
                            </div><!-- row-eq-height -->
                        </div><!-- col-md-9 offset-0 -->
                    </div><!-- rooms-update -->
                </form>
                <div class="clearfix"></div>
                <div id="availability<?php echo $r->id; ?>" class="alert alert-info panel-collapse collapse">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="col-md-6">
                                <div class="form-group">
                                <select id="<?php echo $r->id; ?>" class="form-control form showcalendar">
                                    <option value="0"><?php echo trans('0232'); ?></option>
                                    <option value="<?php echo $first; ?>"> <?php echo $from1; ?> - <?php echo $to1; ?></option>
                                    <option value="<?php echo $second; ?>"> <?php echo $from2; ?> - <?php echo $to2; ?></option>
                                    <option value="<?php echo $third; ?>"> <?php echo $from3; ?> - <?php echo $to3; ?></option>
                                    <option value="<?php echo $fourth; ?>"> <?php echo $from4; ?> - <?php echo $to4; ?></option>
                                    </select>
                                </div>
                            </div>
                            <div id="roomcalendar<?php echo $r->id; ?>"></div>
                        </div>
                    </div>
                </div><!-- alert alert-info panel-collapse collapse -->
                <div id="details<?php echo $r->id; ?>" class="modal fade" tabindex="-1" data-focus-on="input:first" style="display: none;">
                    <div class="modal-dialog normal">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h3 class="modal-title purple andes-bold"><?php echo $r->title; ?></h3>
                            </div>
                            <div class="modal-body">    
                                <div class="panel-body">
                                    <div class="carousel magnific-gallery row">
                                        <?php foreach ($r->Images as $Img) { ?>
                                            <div class="col-md-3">
                                                <div class="zoom-gallery<?php echo $r->id; ?>">
                                                    <a href="<?php echo $Img['thumbImage']; ?>" data-source="<?php echo $Img['thumbImage']; ?>" title="<?php echo $r->title; ?>">
                                                        <img class="img-responsive" src="<?php echo $Img['thumbImage']; ?>">
                                                    </a>
                                                </div>
                                            </div>
                                            <script type="text/javascript">
                                                $('.zoom-gallery<?php echo $r->id; ?>').magnificPopup({
                                                    delegate: 'a',
                                                    type: 'image',
                                                    closeOnContentClick: false,
                                                    closeBtnInside: false,
                                                    mainClass: 'mfp-with-zoom mfp-img-mobile',
                                                    image: {
                                                        verticalFit: true,
                                                        titleSrc: function (item) {
                                                            return item.el.attr('title') + ' ';
                                                        }
                                                    },
                                                    gallery: {
                                                        enabled: true
                                                    },
                                                    zoom: {
                                                        enabled: true,
                                                        duration: 300, // don't foget to change the duration also in CSS
                                                        opener: function (element) {
                                                            return element.find('img');
                                                        }
                                                    }
                                                
                                                });
                                                
                                            </script>
                                        <?php } ?>
                                    </div>
                                    <div class="clearfix"></div>
                                <br>
                                <?php if (!empty($r->desc)) { ?>
                                <p class="andes-bold"><strong><?php echo trans('046'); ?> : </strong> <?php echo $r->desc; ?></p>
                                <?php } ?>
                                <hr>
                                <?php if (!empty($r->Amenities)) { ?>
                                <p class="andes-bold"><strong><?php echo trans('055'); ?> : </strong></p>
                                <?php foreach ($r->Amenities as $roomAmenity) {
                                    if (!empty($roomAmenity->name)) { ?>
                                    <div class="col-md-4">
                                        <ul class="list_ok">
                                            <li><?php echo $roomAmenity->name; ?></li>
                                        </ul>
                                    </div>
                                <?php }
                                    }
                                    } ?>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- room detail -->
                <div class="clearfix"></div>
                <div class="offset-2">
                </div></div>
                <?php } ?>
                <?php } ?>
                <?php }
                    } else {
                        echo trans("066");
                    } ?>
            </div>
            <div class="col-sm-3">
                <biv class="block-content">
                    <div class="block-table">
                        <div class="block-table-cell">
                            <button type="submit" class="btn btn-action btn-block chk"><?php echo trans('0142'); ?></button>
                            <p class="desc">Bạn vui lòng chọn số lượng phòng, giường phụ rồi bấm đặt phòng.</p>
                            <hr>
                            <p>Yêu cầu giường</p>
                            <div class="block-check-sale-sb">
                                <label>
                                    <input type="radio" name="Giuong" value="1">
                                    <span></span>
                                    1 giường
                                </label>
                                <label>
                                    <input type="radio" name="Giuong" value="2">
                                    <span></span>
                                    2 giường
                                </label>
                            </div>
                        </div>
                    </div>
                </biv>
            </div><!-- block-rooms-rela col-sm-3 -->
        </div><!-- block-rooms-rela col-sm-9 -->
    </div>