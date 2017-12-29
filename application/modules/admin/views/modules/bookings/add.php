<div class="panel panel-default">
    <div class="panel-heading">
        <span class="panel-title pull-left">Tạo Booking</span>
        <input type="hidden" id="currenturl" value="<?php echo current_url(); ?>" />
        <input type="hidden" id="baseurl" value="<?php echo base_url() . $this->uri->segment(1); ?>" />
        <div class="clearfix"></div>
    </div>
    <div class="panel-body">
        <form id="bookingdetails">
            <div class="result"></div>
            <div class="col-md-8 col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading text-center"><strong>Thông tin booking</strong></div><!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="hotel_id">Tên Khách Sạn <span class="red-star">*</span></label>
                                <select class="form-control chosen-select" id="hotel_id" name="hotel_id">
                                    <option value="">Khách sạn</option>
                                    <?php foreach($hotels as $h){ ?>
                                        <option value="<?php echo $h->hotel_id;?>"> <?php echo $h->hotel_title;?> </option>
                                    <?php } ?>
                                </select>
                            </div><!-- /.form-group -->
                            <div class="row">
                                <div class="col-md-5 form-group">
                                    <label for="checkin">Ngày nhận phòng <span class="red-star">*</span></label>
                                    <input type="text" id="checkin" name="checkin" class="form-control dpd1 fdate">
                                </div>
                                <div class="col-md-5 form-group">
                                    <label for="checkout">Ngày trả phòng <span class="red-star">*</span></label>
                                    <input type="text" id="checkout" name="checkout" class="form-control dpd2 fdate">
                                </div>
                                <div class="col-md-2 form-group">
                                    <strong>Số đêm</strong> : <br><span id="number_night" style="font-weight:bold;margin-top:13px;display:block" ></span>
                                </div>
                            </div><!-- /.row -->
                            <div id="rooms_info"></div>
                            <div class="form-group">            
                                <textarea class="form-control" placeholder="Ghi chú" rows="5" id="additionalnotes" name="additionalnotes"></textarea>
                            </div><!-- /.form-group -->
                        </div>
                        <!-- col-md-12-->
                    </div><!-- /.panel-body -->
                </div><!-- /.panel panel-default -->
                <div class="panel panel-default">
                    <div class="panel-heading text-center"><strong>Thông tin cá nhân</strong></div><!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="lsatname">Họ tên khách <span class="red-star">*</span></label>
                                <input type="text" id="lastname" name="lastname" class="form-control">
                            </div><!-- /.form-group -->
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="phone">Số điện thoại <span class="red-star">*</span></label>
                                    <input type="text" id="phone" name="phone" class="form-control">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="email">Email <span class="red-star">*</span></label>
                                    <input type="text" id="email" name="email" class="form-control">
                                </div>
                            </div><!-- /.row -->
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="adults">Người lớn <span class="red-star">*</span></label>
                                    <select class="form-control" id="adults" name="adults">
                                        <?php for ($i = 1; $i <= 10; $i ++) { ?>
                                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="child">Trẻ em</label>
                                    <select class="form-control" id="child" name="child">
                                        <?php for ($i = 0; $i <= 10; $i ++) { ?>
                                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div><!-- /.row -->
                            <div class="form-group">
                                <label for="address">Địa Chỉ</label>
                                <input type="text" id="address" name="address" class="form-control">
                            </div><!-- /.form-group -->
                        </div>
                    </div><!-- /.panel-body -->
                </div><!-- /.panel panel-default -->
                <div class="panel panel-default">
                    <div class="panel-heading text-center"><strong>Hình thức thanh toán <span class="red-star">*</span></strong></div><!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-3 form-group">
                                    <label class="radio-inline">
                                        <input type="radio" value="banktransfer" name="checkout-type" class="payment_method">
                                        <strong>Chuyển khoản ngân hàng</strong>
                                    </label>
                                </div><!-- /.col-md-4 form-group -->
                                <div class="col-md-3 form-group">
                                    <label class="radio-inline">
                                        <input type="radio" value="payatoffice" name="checkout-type" class="payment_method">
                                        <strong>Thanh toán tại Vp HOSPI</strong>
                                    </label>
                                </div><!-- /.col-md-4 form-group -->
                                <div class="col-md-3 form-group">
                                    <label class="radio-inline">
                                        <input type="radio" value="cod" name="checkout-type" class="payment_method">
                                        <strong>Thanh toán tại nhà</strong>
                                    </label>
                                </div><!-- /.col-md-4 form-group -->
                            </div><!-- /.row -->
                            <div id="response"></div>
                        </div><!-- /.col-md-12 -->
                    </div><!-- /.panel-body -->
                </div><!-- /.panel panel-default -->
                <div class="form-group">
                    <button type="button" class="btn btn-primary btn-block btn-action" id="createbooking" data-url="<?php echo base_url('admin/bookings/getInfo'); ?>">Tạo Booking</button>
                </div>
            </div>
            <div class="col-md-4 col-xs-12 pull-right" id="payment_info" style="display: none;"></div>
        </div>
    </form>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/adminbooking.js"></script>
<script type="text/javascript">
    function parseDate(str) {
        var mdy = str.split('/')
        return new Date(mdy[2], mdy[1], mdy[0] - 1);
    }

    function daydiff(first, second) {
        return (second - first) / (1000 * 60 * 60 * 24);
    }
    
    function Padder(len, pad) {
        if (len === undefined) {
            len = 1;
        } else if (pad === undefined) {
            pad = '0';
        }

        var pads = '';
        while (pads.length < len) {
            pads += pad;
        }

        this.pad = function (what) {
            var s = what.toString();
            return pads.substring(0, pads.length - s.length) + s;
        };
    }
            
    function addCommas(nStr) {
        nStr += '';
        x = nStr.split('.');
        x1 = x[0];
        x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + ',' + '$2');
        }
        return x1 + x2;
    }
        
    $(document).ready(function () {
        var nowTemp = new Date();
        var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
        var checkin = $('.dpd1').datepicker({
            format: fmt,
            language: 'vi',
            onRender: function (date) {
                return date.valueOf() < now.valueOf() ? 'disabled' : '';
            }
        }).on('changeDate', function (ev) {
            if (ev.date.valueOf() > checkout.date.valueOf()) {
                var newDate = new Date(ev.date)
                newDate.setDate(newDate.getDate() + 1);
                checkout.setValue(newDate);
            }
            checkin.hide();
            $('.dpd2')[0].focus();
            if ($('.dpd2').val() != '' && $('.dpd1').val() != '') {
                var number_night = parseInt(daydiff(parseDate($('.dpd1').val()), parseDate($('.dpd2').val())));
                var zero2 = new Padder(2);
                $('#number_night').html(zero2.pad(number_night));
            }
        }).data('datepicker');
        var checkout = $('.dpd2').datepicker({
            format: fmt,
            onRender: function (date) {
                return date.valueOf() <= checkin.date.valueOf() ? 'disabled' : '';
            }
        }).on('changeDate', function (ev) {
            checkout.hide();
            if ($('.dpd2').val() != '' && $('.dpd1').val() != '') {
                var number_night = parseInt(daydiff(parseDate($('.dpd1').val()), parseDate($('.dpd2').val())));
                var zero2 = new Padder(2);
                $('#number_night').html(zero2.pad(number_night));
            }
            $('#hotel_id').trigger('change');
        }).data('datepicker');
        
        $('.payment_method').click(function () {
            var gateway = $(this).val();
            $('.completebook').show();
            $('#response').html("<div id='rotatingDiv'></div>");
            
            $.ajax({
                url: "<?php echo base_url('invoice/getGatewaylink/') . $invoice->id . '/' . $invoice->code; ?>",
                type: "GET",
                data: {
                    gateway: gateway
                },
                success: function (resp) {
                    var response = $.parseJSON(resp);
                    if (response.iscreditcard == "1") {
                        $(".creditcardform").fadeIn("slow");
                        $("#creditcardgateway").val(response.gateway);
                        $("#response").html("");
                    } else {
                        $(".creditcardform").hide();
                        $("#response").html(response.htmldata);

                        $('#response input').on('change', function () {
                            //alert($('input[name=bank]:checked', '#response').val());
                            var name = $('input[name=bank]:checked', '#response').val();
                            $("#divBankDetails .bank-account").css({'display':'none'});
                            $('#span' + name).css({'display':'block'});
                        });
                    }
                }
            });
        });
        
        $('#hotel_id').change(function () {
            $('#payment_info').hide().html('');
            
            $.ajax({
                url: '<?php echo base_url() . "admin/hotelajaxcalls/rooms_by_hotel"; ?>',
                type: 'GET',
                data: {
                    hotel_id: $(this).val(),
                    checkin: $('#checkin').val(),
                    checkout: $('#checkout').val()
                },
                dataType: 'html',
                beforeSend: function() {
                    $('.result').html('<div id="rotatingDiv"></div>');
                },
                success: function (data) {
                    $('.result').html('');
                    $('#rooms_info').html(data);
                }
            });
        });
        
        $('#createbooking').on('click', function() {
            var isValid = true;
            
            if ($('#hotel_id').val() === '') {
                isValid = false;
            }
            
            if ($('#checkout').val() === '') {
                isValid = false;
            }
            
            if ($('#checkin').val() === '') {
                isValid = false;
            }
            
            if ($('#lastname').val() === '') {
                isValid = false;
            }
            
            if ($('#phone').val() === '') {
                isValid = false;
            }
            
            if ($('#email').val() === '') {
                isValid = false;
            }
            
            if (isValid) {
                //call ajax get information
                var form = $('#bookingdetails');
                var url = $(this).data('url');
                $('#payment_info').html('<div id="rotatingDiv"></div>').show();
                
                $('html, body').animate({
                    scrollTop: $('body').offset().top - 100
                }, 'slow');
                
                $.ajax({
                    url: url,
                    method: 'post',
                    data: $(form).serialize(),
                    dataType: 'html',
                    beforeSend: function() {
                        $('.result').html('<div id="rotatingDiv"></div>');
                    },
                    success: function(response) {
                        $('#payment_info').html(response).show();
                        if ($('input[name="checkout-type"]:checked').size() > 0) {
                            $('.completebook').show();
                        } else {
                            $('.completebook').hide();
                        }
                    }
                });
            } else {
                alert('Vui lòng điền đầy đủ các thông tin bắt buộc!');
            }
        });

        $(document).on("click", ".applycoupon", function () {
            var module = 'hotels';
            var itemid = $("#hotel_id").val();
            var coupon = $(".coupon").val();
            
            $.ajax({
                url: "<?php echo base_url('admin/ajaxcalls/checkCoupon'); ?>",
                type: 'POST',
                data: {
                    coupon: coupon,
                    module: module,
                    itemid: itemid
                },
                //dataType : 'json',
                success: function (response) {
                    var resp = $.parseJSON(response);
                    
                    if (resp.status === "success") {
                        $("#couponid").val(resp.couponid);
                        $(".couponmsg").html(" <div class='alert alert-success'><?php echo trans('0512'); ?><strong> " + coupon + " </strong><?php echo trans('0821'); ?> <strong> " + resp.value + resp.type + " </strong><?php echo trans('0822'); ?></div>");
                        $(".coupon").prop("readonly", "readonly");
                        $(".applycoupon").hide();
                        
                        if (resp.type === '%') {
                            var tong_chua_giam = $('#tong_chua_giam').val();
                            var giam_gia = tong_chua_giam * resp.value / 100;
                            $('#giam_gia').val(giam_gia);
                            $('#giam_gia_span').html(addCommas(giam_gia) + ' VND');
                            $('#tong_thanh_toan').val(tong_chua_giam - giam_gia);

                            $('#tong_thanh_toan_span').html(addCommas(tong_chua_giam - giam_gia) + ' VND');
                        }
                    } else {
                        $("#couponid").val("");
                        $(".couponmsg").html("");
                        
                        if (resp.status === "irrelevant") {
                            alert("<?php echo trans('0520'); ?>");
                        } else {
                            alert("<?php echo trans('0513'); ?>");
                        }
                    }
                }
            });
        });
    });
</script>
<style type="text/css">
    .datepicker{
        left: 20px !important;
        margin-top: 70px !important;
    }
</style>