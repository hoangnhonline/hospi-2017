<link href="<?php echo $theme_url; ?>assets/include/slider/slider.min.css" rel="stylesheet" />
<script src="<?php echo $theme_url; ?>assets/js/single.js"></script>
<script src="<?php echo $theme_url; ?>/assets/js/jquery.nicescroll.min.js"></script>
<script src="<?php echo $theme_url; ?>assets/include/slider/slider.js"></script>
<script src="<?php echo $theme_url; ?>assets/js/infobox.js"></script>
<div class="mtslide2 sliderbg2"></div>
<!-- map -->
<div class="block-breadcrumb">
    <div class="container">
        <?php echo $breadcrumb;?>
    </div>
</div>
<div class="container pagecontainer offset-0">
    <div class="offer-page rightcontent col-md-12 offset-0">
        <div class="itemscontainer offset-1">
            <div class="page-dt-cb">
                <div class="row">
                    <div class="col-sm-9 col-xs-12">
                        <h1 class="h1-offers"><?php echo $module->title; ?></h1>
                        <ul class="information">
                            <li>
                                <p class="address">
                                    <i style="margin-left:-5px; display: inline-block;">
                                        <img src="assets/img/location-icon2.png" alt="">
                                    </i>
                                    <?php echo $module->location; ?>
                                </p>
                            </li>
                            <?php if (!$module->offerForever) { ?>
                                <li class="dots">
                                    <?php echo trans('0834'); ?>: <strong><?php echo date('d/m/Y', $module->from) ?></strong>
                                </li>
                                <li class="dots">
                                    <?php echo trans('0835'); ?>: <strong><?php echo date('d/m/Y', $module->to) ?></strong>
                                </li>
                                <li>
                                    <i class="fa fa-clock-o go-right"></i>
                                    <span><?php echo trans('0269'); ?></span>
                                    <span href="#" class="phone"><span class="wow fadeInLeft animated" id="countdown"></span></span>
                                </li>
                            <?php } ?>
                        </ul>
                        <!-- /.infomation -->
                        <div class="block-tabs-2">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#Combo_detail" aria-controls="Combo_detail" role="tab" data-toggle="tab">Combo chi tiết</a></li>
                                <li role="presentation"><a href="#Rule_cancel" aria-controls="Rule_cancel" role="tab" data-toggle="tab">Điều kiện</a></li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="Combo_detail">
                                    <div class="wysiwyg">
                                        <p><strong class="purple"><?php echo trans('0836'); ?></strong></p>
                                        <?php echo $module->desc; ?>
                                        <?php if ($module->type == 2 && !empty($module->phu_thu)) { ?>
                                        <p><?php echo trans('0839'); ?>:</p>
                                        <?php echo $module->phu_thu; ?>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="Rule_cancel">
                                    <div class="wysiwyg">
                                        <?php if ($module->type == 2) { ?>
                                        <div class="block-dk-cancel">
                                            <div class="form-group">
                                                <p><strong class="purple"><?php echo trans('0837'); ?></strong></p>
                                                <p>
                                                    <?php echo nl2br($module->cancel_condition); ?>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="block-dk-cancel">
                                            <div class="form-group">
                                                <p><strong class="purple"><?php echo trans('0838'); ?></strong></p>
                                                <p>
                                                    <?php echo nl2br($module->use_condition); ?>
                                                </p>
                                            </div>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.block-tab-2 -->
                    </div>
                    <?php if ($module->type != 1) { ?>
                        <div class="col-sm-3 col-xs-12">
                            <div class="block-content">
                                <div class="block-cb-detail">
                                    <p class="title">Giá trọn gói</p>
                                    <div class="price">
                                        <img src="assets/img/triangle_cb.png">
                                        <p><?php echo $module->price; ?> <span>(<?php echo $module->currSymbol; ?>/<?php echo $module->so_khach; ?> Khách)</span></p>
                                    </div>
                                    <div class="detail">
                                        <p><strong>Phụ thu</strong></p>
                                        <ul>
                                            <?php if (!empty($module->surchargeInfo)) {
                                                foreach ($module->surchargeInfo as $item) {
                                                ?>
                                                    <li>
                                                        <p><?php echo $item->name; ?></p>
                                                        <?php if ($item->show_price) { ?>
                                                            <p class="price-sm"><strong><?php echo $item->price; ?> <?php echo $module->currSymbol; ?></strong></p>
                                                        <?php } ?>
                                                    </li>
                                                <?php
                                                }
                                            }
                                            ?>
                                        </ul>
                                        <button type="button" class="btn btn-combo2" data-toggle="modal" data-target="#book-combo"><?php echo $module->type == 2 ? 'Đặt combo' : 'Đặt honeymoon'; ?></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php if ($module->type != 1) { ?>
    <!-- Modal -->
    <div class="modal fade" id="book-combo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="  background: #666;text-align: center;color: #fff;">
                    <h4 class="modal-title" id="myModalLabel">Xác nhận thông tin</h4>
                </div>
                <div class="modal-body">
                    <form action="<?php echo base_url() . $appModule;?>/book/<?php echo $module->slug; ?>" method="get" role="search">
                        <div class="form-inline">
                            <div class="form-group">
                                <p class="title">Ngày đi</p>
                                <div class="block-mySelectCalendar">
                                    <input type="text" placeholder="Ngày đi" name="checkin" class="form-control mySelectCalendar dpd1 go-text-left" value="<?php echo date('d/m/Y', $module->to) ?>" required >
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="checkbox-inline checkbox-style2">
                                    <input type="checkbox" name="note" value="Mua trước đi sau">
                                    <span></span>
                                    Bạn mua trước đi sau
                                    <div class="block-question-info" style="display: inline-block;">
                                        <i class="fa fa-question-circle"></i>
                                        <div class="block-info">
                                            <p>Nếu bạn chưa xác định được ngày đi. Bạn có thể mua trước đi sau ....</p>
                                        </div>
                                    </div>
                                </label>
                            </div>
                        </div>
                        <div class="form-inline">
                            <div class="form-group">
                                <p class="title">Giá trọn gói</p>
                                <p class="price-sm"><strong><?php echo $module->price; ?> <?php echo $module->currSymbol; ?></strong></p>
                            </div>
                            <div class="form-group">
                                <p class="title">Số lượng</p>
                                <select class="form-control" name="quantity">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                </select>
                            </div>
                        </div>
                        <?php if (!empty($module->surchargeInfo)) {
                            foreach ($module->surchargeInfo as $item) {
                            ?>
                                <div class="form-inline">
                                    <div class="form-group">
                                        <p class="title"><?php echo $item->name; ?></p>
                                        <p class="price-sm"><strong><?php echo $item->price; ?> <?php echo $module->currSymbol; ?></strong></p>
                                    </div>
                                    <div class="form-group">
                                        <p class="title">Số lượng</p>
                                        <select class="form-control" name="surcharge[<?php echo $item->id; ?>]">
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </div>
                                </div>
                            <?php
                            }
                        }
                        ?>
                        <div class="form-inline text-center">
                            <button type="submit" class="btn btn-combo2 btn-combo22">Xác nhận</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
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