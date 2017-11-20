<script type="text/javascript">
    $(function() {
        var slug = $("#slug").val();

        $(".submitfrm").click(function() {
            var submitType = $(this).prop('id');
            for (instance in CKEDITOR.instances)

            {

                CKEDITOR.instances[instance].updateElement();

            }
            $(".output").html("");
            $('html, body').animate({
                scrollTop: $('body').offset().top

            }, 'slow');
            if (submitType == "add") {
                url = "<?php echo base_url(); ?>admin/offers/add";

            } else {
                url = "<?php echo base_url(); ?>admin/offers/manage/" + slug;

            }

            $.post(url, $(".offer-form").serialize(), function(response) {
                if ($.trim(response) != "done") {
                    $(".output").html(response);
                } else {
                    window.location.href = "<?php echo base_url() . $adminsegment . "/offers/" ?>";
                }

            });

        });



    })
</script>
<a href="<?php echo base_url(); ?>admin/offers?offer_city=<?php echo $offerdata[0]->offer_city; ?>" class="btn btn-default btn-sm">Quay lại</a>
<h3 class="margin-top-0">
    <?php echo $headingText; ?>
</h3>

<div class="output"></div>
<form action="" method="POST" class="offer-form" onsubmit="return false;">
    <div class="panel panel-default">

        <ul class="nav nav-tabs nav-justified" role="tablist">
            <li class="active"><a href="#GENERAL" data-toggle="tab">Thông tin chung</a></li>
            <li class=""><a href="#TRANSLATE" data-toggle="tab">Dịch</a></li>
        </ul>

        <div class="panel-body">

            <br>
            <div class="tab-content form-horizontal">
                <div class="tab-pane wow fadeIn animated active in" id="GENERAL">


                    <div class="clearfix"></div>
                    <div class="row form-group">
                        <label class="col-md-2 control-label text-left">Trạng thái</label>
                        <div class="col-md-2">
                            <select data-placeholder="Select" class="form-control" name="offerstatus">
                                <option value="Yes" <?php if (@$offerdata[0]->offer_status == "Yes") {
    echo "selected";
} ?> >Hiển thị</option>
                                <option value="No" <?php if (@$offerdata[0]->offer_status == "No") {
    echo "selected";
} ?> >Ẩn</option>

                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="col-md-2 control-label text-left">Vị trí</label>
                        <div class="col-md-4">
                            <select name="offercity" class="offercity chosen-select" required>
                                <option value="">-Chọn-</option>
<?php foreach ($locations as $loc) { ?>
                                    <option value="<?php echo $loc->id; ?>" <?php makeSelected(@$loc->id, @$offerdata[0]->offer_city); ?> ><?php echo $loc->location; ?></option>
<?php } ?>

                            </select>
                        </div>

                    </div>
                    <div class="row form-group">
                        <label class="col-md-2 control-label text-left">Tên ưu đãi</label>
                        <div class="col-md-4">
                            <input name="offertitle" type="text" placeholder="" class="form-control" value="<?php echo @$offerdata[0]->offer_title; ?>" />
                        </div>
                    </div>
<!--
                    <div class="row form-group">
                        <label class="col-md-2 control-label text-left">Điện thoại</label>
                        <div class="col-md-4">
                            <input name="offerphone" type="numbers" placeholder="" class="form-control" value="<?php echo @$offerdata[0]->offer_phone; ?>" />
                        </div>
                    </div>

                    <div class="row form-group">
                        <label class="col-md-2 control-label text-left">Email</label>
                        <div class="col-md-4">
                            <input name="offeremail" type="numbers" placeholder="" class="form-control" value="<?php echo @$offerdata[0]->offer_email; ?>" />
                        </div>
                    </div>

                    <div class="row form-group">
                        <label class="col-md-2 control-label text-left">Giá ưu đãi</label>
                        <div class="col-md-2">
                            <input name="offerprice" type="text" placeholder="" class="form-control" value="<?php echo @$offerdata[0]->offer_price; ?>" />
                        </div>
                    </div>
-->
                    <div class="row form-group">
                        <label class="col-md-2 control-label text-left">Áp dụng</label>
                        <div class="col-md-2">
                            <input name="ofrom" type="text" placeholder="Từ ngày" class="form-control dpd1" value="<?php echo @$ofrom; ?>" />
                        </div>

                        <div class="col-md-2">
                            <input name="oto" type="text" placeholder="Đến ngày" class="form-control dpd2" value="<?php echo @$oto; ?>" />
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="col-md-2 control-label text-left">Mô tả</label>
                        <div class="col-md-10">
                            <?php $this->ckeditor->editor('offerdesc', @$offerdata[0]->offer_desc, $ckconfig, 'offerdesc'); ?>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="col-md-2 control-label text-left">Khách sạn</label>
                        <div class="col-md-8">
                            <select multiple class="chosen-multi-select" name="relatedhotels[]">
                                <?php foreach ($hotels as $hotel) { ?>
                                    <option value="<?php echo $hotel->hotel_id; ?>" <?php if (in_array($hotel->hotel_id, @$hrelated)) {
                                    echo 'selected';
                                } ?>  >
    <?php echo $hotel->hotel_title; ?>
                                    </option>
<?php } ?>
                            </select>
                        </div>
                    </div>

                </div>


                <div class="tab-pane wow fadeIn animated in" id="TRANSLATE">

                    <?php foreach ($languages as $lang => $val) {
    if ($lang != "vi") {
        @$trans = getBackOffersTranslation($lang, $offerid); ?>
                    <div class="panel panel-default">
                        <div class="panel-heading"><img src="<?php echo PT_LANGUAGE_IMAGES . $lang . " .png " ?>" height="20" alt="" />
                            <?php echo $val['name']; ?>
                        </div>
                        <div class="panel-body">
                            <div class="row form-group">
                                <label class="col-md-2 control-label text-left">Tên ưu đãi</label>
                                <div class="col-md-4">
                                    <input name='<?php echo "translated[$lang][title]"; ?>' type="text" placeholder="Offer Name" class="form-control" value="<?php echo @$trans[0]->trans_title; ?>" />
                                </div>
                            </div>

                            <div class="row form-group">
                                <label class="col-md-2 control-label text-left">Mô tả</label>
                                <div class="col-md-10">
                                    <?php $this->ckeditor->editor("translated[$lang][desc]", @$trans[0]->trans_desc, $ckconfig, "translated[$lang][desc]"); ?>
                                </div>
                            </div>

                        </div>
                    </div>
                    <?php }
} ?>

                </div>
            </div>
        </div>
        <div class="panel-footer">
            <input type="hidden" id="slug" value="<?php echo @$offerdata[0]->offer_slug; ?>" />
            <input type="hidden" name="submittype" value="<?php echo $submittype; ?>" />
            <input type="hidden" name="offerid" value="<?php echo @$offerid; ?>" />
            <input type="hidden" name="offer_type" value="1">
            <button class="btn btn-primary submitfrm" id="<?php echo $submittype; ?>">Lưu</button>
        </div>
    </div>
</form>