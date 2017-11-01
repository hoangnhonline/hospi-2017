<section id="ROOMS" style="background-color:#FFFFFF" style="position: relative;">
    <div style="background-color:#fff">
    <div class="rooms-update">
        <form action="" method="GET">
            <div class="col-md-2 col-sm-2 go-right">
                <div class="form-group">
                    <label class="size12 RTL go-right" style="white-space: nowrap;"><i class="icon-calendar-7"></i> <?php echo trans('07'); ?></label>
                    <input type="text" placeholder="<?php echo trans('07'); ?>" name="checkin" class="form-control dpd1" value="<?php echo $modulelib->checkin; ?>" required>
                </div>
            </div>
            <div class="col-md-2 col-sm-2 go-right">
                <div class="form-group">
                    <label class="size12 RTL go-right"><i class="icon-calendar-7"></i> <?php echo trans('09'); ?></label>
                    <input type="text" placeholder="<?php echo trans('09'); ?>" name="checkout" class="form-control dpd2" value="<?php echo $modulelib->checkout; ?>" required>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-1 go-right">
                <div class="form-group">
                    <label class="size12 RTL go-right"><i class="icon-user-7"></i> <?php echo trans('010'); ?></label>
                    <select class="mySelectBoxClass form-control" name="adults" id="adults" value="<?php echo $modulelib->adults; ?>">
                        <?php for ($Selectadults = 1; $Selectadults < 11; $Selectadults++) { ?>
                        <option value="<?php echo $Selectadults; ?>" <?php if ($Selectadults == $modulelib->adults) {
                            echo "selected";
                            } ?> > <?php echo $Selectadults; ?> </option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-1 go-right">
                <div class="form-group">
                    <label class="size12 RTL go-right"><i class="icon-user-7"></i> <?php echo trans('011'); ?></label>
                    <select class="mySelectBoxClass form-control" name="child" id="child" value="<?php echo $modulelib->children; ?>">
                        <?php for ($Selectchild = 0; $Selectchild < 6; $Selectchild++) { ?>
                        <option value="<?php echo $Selectchild; ?>" <?php if ($Selectchild == $modulelib->children) {
                            echo "selected";
                            } ?> > <?php echo $Selectchild; ?> </option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-md-2 col-lg-2 col-sm-2 go-right">
                <label>&nbsp;</label>
                <button class="btn btn-block btn-success textupper"><?php echo trans('0106'); ?></button>
                <input type="hidden" id="loggedin" value="<?php echo $usersession; ?>" />
                <input type="hidden" id="itemid" value="<?php echo $module->id; ?>" />
                <input type="hidden" id="module" value="<?php echo $appModule; ?>" />
                <input type="hidden" id="addtxt" value="<?php echo trans('029'); ?>" />
                <input type="hidden" id="removetxt" value="<?php echo trans('028'); ?>" />
            </div>
            <div class="col-md-2 col-lg-2 col-sm-2 row">
                <?php if (!empty($rooms)) { ?>
                <h5 style="margin-top: 34px;" class="text-center size16 row"><strong><i class="icon_set_1_icon-83"></i> <?php echo $modulelib->stay; ?> <?php echo trans('0122'); ?></strong> </h5>
                <?php } ?>
            </div>
        </form>
        <div class="clearfix"></div>
    </div>
    <?php if (!empty($modulelib->stayerror)) { ?>
    <div class="panel-body">
        <div class="alert alert-danger go-text-right">
            <?php echo trans("0420"); ?>
        </div>
    </div>
    <?php } ?>
    <div class="display-table">
        <?php if (!empty($rooms)) { ?>
        <?php foreach ($rooms as $r) {
            if ($r->maxQuantity > 0) { ?>
        <?php
            if (($r->honeymoon == "Yes") && honeymoonAvailable($r->id)) {
                
                ?>
        <div class="display-table-header">
            <!-- Honeymoon -->
            <div class="rooms-update" style="margin-top:0px;margin-bottom:0px">
                <div class="labelleft2 rtl_title_home go-text-right RTL">
                    <h4 class="mtb0 RTL go-text-right">
                        <span class="purple andes-bold"><b><?php echo trans("0567"); ?></b></span>
                        <span class="opensans smalltext">Áp dụng từ ngày <strong><?php echo date('d/m/Y', $r->hfrom); ?></strong> đến hết ngày <strong><?php echo date('d/m/Y', $r->hto); ?></strong></span>
                        <a style="float:right;" data-toggle="modal" href="#details<?php echo $r->id; ?>"><?php echo trans("0640"); ?></a>
                    </h4>
                    <!--<div class="col-md-6 visible-lg visible-md go-right" id="accordion" style="margin-top: 0px;">
                        <div class="row">
                            <button data-toggle="collapse" data-parent="#accordion" class="hidden-xs btn btn-danger btn-sm"  href="#details<?php echo $r->id; ?>"><?php echo trans('052'); ?></button>
                            <button data-toggle="collapse" data-parent="#accordion" href="#availability<?php echo $r->id; ?>" class="hidden-xs btn btn-info btn-sm"><?php echo trans('0251'); ?></button>
                        </div>
                        </div>-->
                    <!--<p class="grey RTL"><?php echo character_limiter($r->desc, 280); ?></p>-->
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
                        <!--<div class="modal-footer">
                            <button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
                            </div>-->
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
            <div class="clearfix" style="margin-bottom: 20px;"></div>
            <div class="offset-2">
            </div>
            <!-- End Honeymoon -->
        </div>
        <?php } else { ?>
        <div class="display-table-footer">
            <form action="<?php echo base_url() . $appModule; ?>/book/<?php echo $module->bookingSlug; ?>" method="GET">
                <input type="hidden" name="adults" value="<?php echo $modulelib->adults; ?>" />
                <input type="hidden" name="child" value="<?php echo $modulelib->children; ?>" />
                <input type="hidden" name="checkin" value="<?php echo $modulelib->checkin; ?>" />
                <input type="hidden" name="checkout" value="<?php echo $modulelib->checkout; ?>" />
                <input type="hidden" name="roomid" value="<?php echo $r->id; ?>" />
                <div class="rooms-update" style="margin-top:0px;margin-bottom:0px;display: inline-block;width:100%">
                    <div class="col-lg-3 col-md-3 col-sm-3 offset-0 go-right">
                        <div class="zoom-gallery<?php echo $r->id; ?>">
                            <a href="<?php echo $r->fullimage; ?>" data-source="<?php echo $r->fullimage; ?>" title="<?php echo $r->title; ?>">
                            <img class="img-responsive" src="<?php echo $r->thumbnail; ?>">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-9 offset-0">
                        <div class="col-md-3 labelright go-left">
                            <?php if ($r->price > 0) { ?>
                            <button style="margin-bottom:5px" type="submit" class="btn btn-action btn-block chk"><?php echo trans('0142'); ?></button>
                            <?php } ?>
                            <div class="clearfix"></div>
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
                        <div class="col-md-9 labelleft2 rtl_title_home go-text-right RTL">
                            <?php if($r->issale>0 && $r->onsale==true) { ?>
                            <div class="row col-md-6">
                                <?php } else { ?>
                                <div class="row col-md-10">
                                    <?php } ?> 
                                    <h4 class="mtb0 RTL go-text-right">
                                        <b><?php echo $r->title; ?></b>
                                    </h4>
                                    <h5 style="color:#8A8A8A"><?php echo trans('010'); ?> <?php echo $r->Info['maxAdults']; ?> <?php echo trans('011'); ?> <?php echo $r->Info['maxChild']; ?></h5>
                                    <div class="col-md-6 visible-lg visible-md go-right" id="accordion" style="margin-top: 0px;">
                                        <div class="row">
                                            <a data-toggle="modal" href="#details<?php echo $r->id; ?>"><?php echo trans("0640"); ?></a>
                                            <!--<button data-toggle="collapse" data-parent="#accordion" class="hidden-xs btn btn-danger btn-sm"  href="#details<?php echo $r->id; ?>"><?php echo trans('052'); ?></button>
                                                <button data-toggle="collapse" data-parent="#accordion" href="#availability<?php echo $r->id; ?>" class="hidden-xs btn btn-info btn-sm"><?php echo trans('0251'); ?></button>-->
                                        </div>
                                    </div>
                                    <br><br><br>
                                </div>
                                <?php if($r->issale>0 && $r->onsale==true) { ?>
                                <div class="col-md-4">
                                    <div class="five-star">
                                        <h5 class="red"><?php echo trans('0709');?></h5>
                                        <div class="from-date"><?php echo trans('0712');?><?php echo gmdate('d/m/Y',$r->salefrom); ?></div>
                                        <div class="to-date"><?php echo trans('0713');?><?php echo gmdate('d/m/Y',$r->saleto); ?></div>
                                    </div>
                                </div>
                                <?php } ?>
                                <div class="col-md-2">
                                    <span class="ipull-right">
                                        <?php if ($r->price > 0) { ?>
                                        <span class="purple size18">
                                            <?php if ($module->price_status == 'Yes') { if($r->issale>0 && $r->onsale==true) echo "<b>". $r->saleprice ."</b>"; else echo "<b>". $r->price ."</b>"; ?>
                                            <!--<small><?php echo $r->currCode; ?>  </small> <?php echo $r->currSymbol; ?><?php echo $r->price; ?>-->
                                        </span>
                                        <br/>
                                        <span class="size11 grey" style="white-space: nowrap;"><?php echo trans('070'); ?> <?php echo $modulelib->stay; ?> <?php echo trans('0122'); ?></strong> </span>
                                        <?php } else { ?>
                                        <span class="size13" style="white-space: nowrap;text-align: center;"><a href="#emailme<?php echo $module->id; ?>" data-toggle="modal" data-content="<?php echo trans('0800'); ?>" rel="popover" data-placement="top" data-original-title="<?php echo $item->title; ?>" data-trigger="hover"><?php echo trans('0799'); ?></a></span>
                                        <?php } ?>
                                        <div class="clearfix"></div>
                                        <?php } ?>
                                    </span>
                                </div>
                                <?php /*if($module->vatvalue==0||$module->servicevalue==0||$r->breakfast == 'Yes') {
                                    echo trans('0700');
                                    if($r->breakfast == 'Yes') echo trans('0701')." ";
                                    if($module->vatvalu==0) echo trans('0702')." 10%";
                                    if($module->servicevalue==0) echo " ".trans('0703')." 5%";
                                    
                                    }*/?>
                                <!--<p class="grey RTL"><?php echo character_limiter($r->desc, 280); ?></p>-->
                                <br/>
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
                            </div>
                            <div class="clearfix"></div>
                            <!-- issale price -->
                            <?php if($r->issale>0 && $r->onsale==true) { ?>
                            <div class="basic-price-line"></div>
                            <div class="basic-price">
                                <div class="col-md-3 labelright go-left">
                                    <?php if ($r->price > 0) { ?>
                                    <button style="margin-bottom:5px" type="submit" class="btn btn-action btn-block chk"><?php echo trans('0142'); ?></button>
                                    <?php } ?>
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
                                <div class="col-md-9 labelleft2 rtl_title_home go-text-right RTL">
                                    <div class="row col-md-10">
                                        &nbsp;
                                    </div>
                                    <div class="col-md-2">
                                        <span class="ipull-right">
                                            <span class="purple size18">
                                                <?php if ($r->price > 0) { ?>
                                                <b>
                                                    <?php echo $r->price; ?>
                                                    <!--<small><?php echo $r->currCode; ?>  </small> <?php echo $r->currSymbol; ?><?php echo $r->price; ?>-->
                                                </b>
                                            </span>
                                            <br/>
                                            <span class="size11 grey" style="white-space: nowrap;"><?php echo trans('070'); ?> <?php echo $modulelib->stay; ?> <?php echo trans('0122'); ?></strong> </span>
                                            <div class="clearfix"></div>
                                            <?php } ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                            <!-- basic price -->
                        </div>
                    </div>
                    <div class="clearfix"></div>
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
            </div>
            <!-- room detail -->
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
            </div></div></div>
            <!-- room detail -->
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
    </div>
</section>
<?php if(isset($_GET['details'])) { ?>
<script type="text/javascript">
    $(window).load(function(){
        $('#details<?php echo $_GET['details'];?>').modal('show');
    });
</script>
<?php } ?>
<script type="text/javascript">
    $(window).load(function(){
    
    $(".successemail<?php echo $item->id; ?>").on('click', function(){ 
    var youremail = $(".youremail").val();
    var yourphone = $(".yourphone").val();
    var itemid = <?php echo $module->id; ?>;
    var duration = "từ " + $(".dpd1").val() + " đến " + $(".dpd2").val();
    $('#getresponse<?php echo $module->id; ?>').html('<div id="rotatingDiv"></div>');
    $.post("<?php echo base_url(); ?>admin/ajaxcalls/laygiaEmail", {email: youremail, phone: yourphone, id: itemid, hotel: duration}, function(resp){
    //alert(resp);
    if (resp === "done") {
    console.log(resp);
    $("#getresponse<?php echo $module->id; ?>").html("");
    $('.email-me-modal<?php echo $module->id; ?>').modal('hide');
    $('#openModal<?php echo $module->id; ?>').modal('show');
    var myModal = $('#openModal<?php echo $module->id; ?>');
    clearTimeout(myModal.data('hideInterval'));
    myModal.data('hideInterval', setTimeout(function(){
    myModal.modal('hide');
    }, 4000));
    } else {alert(resp); $("#getresponse<?php echo $module->id; ?>").html("<span class='error'>Đã có lỗi xảy ra, chúng tôi đang xem xét.<span>");}
    });
    });
    });
</script>
<div id="emailme<?php echo $module->id; ?>" class="modal fade email-me-modal<?php echo $module->id; ?>" tabindex="-1" data-focus-on="input:first" style="display: none;">
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
                            <input type="text" placeholder="<?php echo trans('0804'); ?> " name="youremail" id="youremail<?php echo $module->id; ?>" class="form-control youremail" required >
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12 go-right">
                        <div class="form-group">
                            <div class="clearfix"></div>
                            <input type="text" placeholder="<?php echo trans('0805'); ?> " name="yourphone" id="yourphone<?php echo $module->id; ?>" class="form-control yourphone" required >
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <br>
                    <div class="hotel-modal-title"><?php echo trans('0802'); ?></div>
                    <br>
                    <!--<a id="successemail" style="margin-bottom:5px;float:none;" href="#openModal" type="submit" class="btn btn-action chk successemail" data-toggle="modal" data-content="<?php echo trans('0800'); ?>" rel="popover" data-placement="top" data-original-title="<?php echo $item->title; ?>" data-trigger="hover"><?php echo trans('0806'); ?></a>-->
                    <button id="successemail<?php echo $module->id; ?>" style="margin-bottom:5px;float:none;" type="submit" class="btn btn-action chk successemail<?php echo $item->id; ?>"><?php echo trans('0806'); ?></button>
                    <div id="getresponse<?php echo $module->id; ?>"></div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="openModal<?php echo $module->id; ?>" class="modal fade" tabindex="-1" data-focus-on="input:first" style="display: none;">
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