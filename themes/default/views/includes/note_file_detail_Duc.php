<div class="col-md-3 col-sm-3 offset-0 go-right">
    <div class="zoom-gallery<?php echo $r->id; ?>">
        <a href="<?php echo $r->fullimage; ?>" data-source="<?php echo $r->fullimage; ?>" title="<?php echo $r->title; ?>">
        <img class="img-responsive" src="<?php echo $r->thumbnail; ?>">
        </a>
    </div>
</div>
<div class="col-md-9 offset-0">
    <div class="row-eq-height">
        <div class="col-md-3 go-left">
            <!-- <?php if ($r->price > 0) { ?>
            <button style="margin-bottom:5px" type="submit" class="btn btn-action btn-block chk"><?php echo trans('0142'); ?></button>
            <?php } ?> -->
            <div class="clearfix"></div>
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
        </div>
        <div class="col-md-5 rtl_title_home go-text-right RTL">
            <?php if($r->issale>0 && $r->onsale==true) { ?>
            <div class="row col-md-6">
                <?php } else { ?>
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
                            <!--<button data-toggle="collapse" data-parent="#accordion" class="hidden-xs btn btn-danger btn-sm"  href="#details<?php echo $r->id; ?>"><?php echo trans('052'); ?></button>
                                <button data-toggle="collapse" data-parent="#accordion" href="#availability<?php echo $r->id; ?>" class="hidden-xs btn btn-info btn-sm"><?php echo trans('0251'); ?></button>-->
                        </div>
                    </div>
                </div>
                <?php if($r->issale>0 && $r->onsale==true) { ?>
               <!--  <div class="col-md-4">
                    <div class="five-star">
                        <h5 class="red"><?php echo trans('0709');?></h5>
                        <div class="from-date"><?php echo trans('0712');?><?php echo gmdate('d/m/Y',$r->salefrom); ?></div>
                        <div class="to-date"><?php echo trans('0713');?><?php echo gmdate('d/m/Y',$r->saleto); ?></div>
                    </div>
                </div> -->
                <?php } ?>
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
        <div class="col-md-4">
            <div class="ipull-right block-price">
                <?php if ($r->price > 0) { ?>
                <p class="purple size18">
                    <?php if ($module->price_status == 'Yes') { if($r->issale>0 && $r->onsale==true) echo "<b>". $r->saleprice ."</b>"; else echo "<b>". $r->price ."</b>"; ?>
                    <!--<small><?php echo $r->currCode; ?>  </small> <?php echo $r->currSymbol; ?><?php echo $r->price; ?>-->
                </p>
                <p class="size13 grey" style="white-space: nowrap;"><?php echo trans('070'); ?> <?php echo $modulelib->stay; ?> <?php echo trans('0122'); ?></strong> </p>
                <?php } else { ?>
                <p class="size13" style="white-space: nowrap;text-align: center;"><a href="#emailme<?php echo $module->id; ?>" data-toggle="modal" data-content="<?php echo trans('0800'); ?>" rel="popover" data-placement="top" data-original-title="<?php echo $item->title; ?>" data-trigger="hover"><?php echo trans('0799'); ?></a></p>
                <?php } ?>
                <p class="block-price-info">
                    <span>Bao gồm: Ăn sáng;</span>
                    <span>Phí dịch vụ 5%, VAT 10%</span>
                </p>
                <div class="clearfix"></div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<div class="clearfix"></div>