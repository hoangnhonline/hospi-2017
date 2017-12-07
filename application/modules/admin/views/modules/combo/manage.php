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
                url = "<?php echo base_url(); ?>admin/combo/add";

            } else {
                url = "<?php echo base_url(); ?>admin/combo/manage/" + slug;

            }

            $.post(url, $(".offer-form").serialize(), function(response) {
                window.location.reload();
                if ($.trim(response) != "done") {
                    $(".output").html(response);
                } else {
                    window.location.href = "<?php echo base_url() . $adminsegment . "/combo/" ?>";
                }

            });

        });



    })
</script>
<a href="<?php echo base_url(); ?>admin/combo?offer_city=<?php echo $offerdata[0]->offer_city; ?>" class="btn btn-default btn-sm">Quay lại</a>
<h3 class="margin-top-0">
    <?php echo $headingText; ?>
</h3>

<div class="output"></div>
<form action="" method="POST" class="offer-form" onsubmit="return false;">
    <div class="panel panel-default">

        <ul class="nav nav-tabs nav-justified" role="tablist">
            <li class="active"><a href="#GENERAL" data-toggle="tab">Thông tin chung</a></li>
            <li><a href="#DK" data-toggle="tab">Điều kiện</a></li>
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
                        <label class="col-md-2 control-label text-left">Tên combo</label>
                        <div class="col-md-4">
                            <input name="offertitle" type="text" placeholder="" class="form-control" value="<?php echo @$offerdata[0]->offer_title; ?>" />
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="col-md-2 control-label text-left">Khách sạn</label>
                        <div class="col-md-10">
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
                    <div class="row form-group">
                        <label class="col-md-2 control-label text-left">Số đêm nhỏ nhất</label>
                        <div class="col-md-8">
                            <select class="form-control" name="min_nights">
                                <?php for($i = 1; $i<=10; $i ++){ ?>
                                <option  value="<?php echo $i; ?>" <?php echo @$offerdata[0]->min_nights == $i ? "selected" : ""; ?>><?php echo $i; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    

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
                        <label class="col-md-2 control-label text-left">Giá trọn gói</label>
                        <div class="col-md-2">
                            <input name="offerprice" type="text" placeholder="" class="form-control number" value="<?php echo @$offerdata[0]->offer_price; ?>" />
                        </div>
                        <label class="col-md-1 control-label text-left">Số khách</label>
                        <div class="col-md-2">

                            <input name="so_khach" type="number" placeholder="" class="form-control number" value="<?php echo @$offerdata[0]->so_khach; ?>" />
                        </div>
                        <label style="margin-top: 6px;"><input type="checkbox" name="show_price" value="1" <?php if(!isset($offerdata) || @$offerdata[0]->show_price == 1) { ?> checked="checked" <?php } ?>> Hiển thị giá</label>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-2">
                            
                        </div>
                        <?php 
                        $phuthuArr = $phuthu;
                        //var_dump($phuthuArr);die;
                        ?>
                        <div class="col-md-10">
                            <fieldset class="scheduler-border">
                                <legend class="scheduler-border">PHỤ THU</legend>
                                <?php 
                                for($i = 0; $i <= (count($phuthuArr)-1); $i++){
                                ?>
                                <div class="row form-group">
                                    <input type="hidden" name="phu_thu_id[]" value="<?php echo $phuthuArr[$i]->id; ?>">
                                    <div class="col-md-3">
                                        <label>Loại phụ thu</label>
                                        <input name="phu_thu[]" type="text" placeholder="" class="form-control" value="<?php echo $phuthuArr[$i]->name; ?>" />
                                    </div>
                                    <div class="col-md-3">
                                        <label>Giá</label>
                                        <input name="phu_thu_gia[]" type="text" placeholder="" class="form-control number" value="<?php echo $phuthuArr[$i]->price; ?>" />
                                    </div>                         
                                    <label style="margin-top: 30px;"><input type="checkbox" <?php echo $phuthuArr[$i]->show_price == 1 ? "checked" : ""; ?> value="1" class="phu_thu_show"> Hiển thị giá
                                    <input type="hidden" class="value_show" value="<?php echo $phuthuArr[$i]->show_price == 1 ? "1" : "0"; ?>" name="phu_thu_show[]">
                                    </label>
                                </div>
                                <?php } ?>
                                <?php                                 
                                for($i = 0; $i< (5-count($phuthuArr)); $i++){
                                ?>
                                <div class="row form-group">
                                     <input type="hidden" name="phu_thu_id[]" value="">
                                    <div class="col-md-3">
                                        <label>Loại phụ thu</label>
                                        <input name="phu_thu[]" type="text" placeholder="" class="form-control" value="" />
                                    </div>
                                    <div class="col-md-3">
                                        <label>Giá</label>
                                        <input name="phu_thu_gia[]" type="text" placeholder="" class="form-control number" value="" />
                                    </div>                         
                                    <label style="margin-top: 30px;"><input type="checkbox" class="phu_thu_show" value="1"> Hiển thị giá
                                    <input type="hidden" class="value_show"  value="0" name="phu_thu_show[]">
                                    </label>
                                </div>
                                <?php } ?>                               
                            </fieldset>
                        </div>
                    </div>
                    
                    
                </div>
                <div class="tab-pane wow fadeIn animated in" id="DK">
                    <div class="row form-group">
                        <label class="col-md-2 control-label text-left">Điều kiện sử dụng</label>
                        <div class="col-md-10">
                            <textarea class="form-control" name="use_condition" rows="10"><?php echo @$offerdata[0]->use_condition; ?></textarea>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="col-md-2 control-label text-left">Điều kiện hủy</label>
                        <div class="col-md-10">
                            <textarea class="form-control" name="cancel_condition" rows="10"><?php echo @$offerdata[0]->cancel_condition; ?></textarea>
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
                                <label class="col-md-2 control-label text-left">Tên combo</label>
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
            <input type="hidden" name="offer_type" value="2">
            <button class="btn btn-primary submitfrm" id="<?php echo $submittype; ?>">Lưu</button>
        </div>
    </div>
</form>
<style type="text/css">
    fieldset.scheduler-border {
    border: 1px groove #ddd !important;
    padding: 0 1.4em 1.4em 1.4em !important;
    margin: 0 0 1.5em 0 !important;
    -webkit-box-shadow:  0px 0px 0px 0px #000;
            box-shadow:  0px 0px 0px 0px #000;
}

legend.scheduler-border {
    font-size: 1.2em !important;
    font-weight: bold !important;
    text-align: left !important;

}
</style>
<script type="text/javascript">
    $(document).ready(function(){        
        $('.phu_thu_show').on('ifChecked', function (event){        
             $(this).parents('label').find('.value_show').val(1);   
        });
        $('.phu_thu_show').on('ifUnchecked', function (event) {
           $(this).parents('label').find('.value_show').val(0);   
        });        
    });

</script>