<div class="panel panel-default">
    <div class="panel-heading">
        <span class="panel-title pull-left">Tạo Booking</span>
        <input type="hidden" id="currenturl" value="<?php echo current_url(); ?>" />
        <input type="hidden" id="baseurl" value="<?php echo base_url() . $this->uri->segment(1); ?>" />
        <div class="clearfix"></div>
    </div>
    <div class="panel-body">
        <div class="col-md-8 col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading text-center"><strong>Thông tin booking</strong></div><!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="form-inline">
                                Tên mã đặt phòng
                                <input type="text" name="" value="" class="form-control" placeholder="">
                                <a href="#" title="" style="text-decoration: underline;">Lấy mã tự động</a>
                            </div>
                        </div><!-- /.form-group -->
                        <div class="form-group">
                            <label for="">Tên Khách Sạn</label>
                            <select class="form-control chosen-select" id="hotel_id" name="hotel_id">
                                <option value="">Khách sạn</option>
                                <?php foreach($hotels as $h){ ?>
                                    <option value="<?php echo $h->hotel_id;?>"> <?php echo $h->hotel_title;?> </option>
                                <?php } ?>
                            </select>
                        </div><!-- /.form-group -->
                        <div class="row">
                            <div class="col-md-5 form-group">
                                <label for="booking_checkin">Ngày nhận phòng</label>
                                <input type="text" name="checkin" id="checkin"  class="form-control dpd1 fdate">
                            </div>
                            <div class="col-md-5 form-group">
                                <label for="booking_checkout">Ngày trả phòng</label>
                                <input type="text" name="checkout" id="checkout" class="form-control dpd2 fdate">
                            </div>
                            <div class="col-md-2 form-group">
                                <strong>Số đêm</strong> : <br><span id="number_night" style="font-weight:bold;margin-top:13px;display:block" ></span>
                            </div>
                        </div><!-- /.row -->
                        <div id="room_info"></div>
                        <div class="form-group">            
                            <textarea class="form-control" placeholder="Ghi chú" rows="5" name="additionalnotes"></textarea>
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
                            <label for="">Họ tên khách</label>
                            <div class="form-inline">
                                <input type="text" name="lastname" class="form-control">
                                <a href="#" title="">
                                    <i class="fa fa-plus-square-o"></i> Thêm tên khách
                                </a>
                            </div>
                        </div><!-- /.form-group -->
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="booking_checkin">Số điện thoại</label>
                                <input type="text" name="phone" class="form-control">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="booking_checkout">Email</label>
                                <input type="text" name="email" class="form-control">
                            </div>
                        </div><!-- /.row -->
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="booking_checkin">Người lớn</label>
                                <select class="form-control" name="adult">
                                    <?php for ($i = 1; $i <= 10; $i ++) { ?>
                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="booking_checkout">Trẻ em</label>
                                <select class="form-control" name="child">
                                    <?php for ($i = 0; $i <= 10; $i ++) { ?>
                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div><!-- /.row -->
                        <div class="form-group">
                            <label for="">Địa Chỉ</label>
                            <input type="text" name="" value="" class="form-control" placeholder="">
                        </div><!-- /.form-group -->
                    </div>
                </div><!-- /.panel-body -->
            </div><!-- /.panel panel-default -->
            <div class="panel panel-default">
                <div class="panel-heading text-center"><strong>Hình thức thanh toán</strong></div><!-- /.panel-heading -->
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
        </div>
        <div class="col-md-4 col-xs-12 pull-right" id="payment_info" style="display: none;">
            <div class="panel panel-default">
                <div class="panel-heading text-center"><strong>Thông tin đơn phòng</strong></div><!-- /.panel-heading -->
                <div class="box">
                    <div class="box_body">
                        <ul class="order-summary">
                            <li id="hotel_name"></li>
                            <li>
                                <div class="k">
                                    <p><strong>Ocean View Dupxle  Pool Villa</strong></p>
                                    9,300,000 x 02 (đêm) x 01 (phòng) = 18,600,000 VND
                                </div>
                            </li>
                            <li>
                                <div class="k">
                                    <p><strong>Front View  Pool Villa Ocean</strong></p>
                                    10,500,000 x 02 (đêm) x 01 (phòng) = 21,000,000 VND
                                </div>
                            </li>
                            <li>
                                <span class="k">Thành tiền:</span>
                                <strong class="v">7,459,000 VND</strong>
                            </li>
                            <li>
                                <span class="k">Giường phụ</span>
                                <span class="v">0 VND</span>
                            </li>
                            <li>
                                <span class="k">Chi phí khác:</span>
                                <span class="v">0 VND</span>
                            </li>
                            <li>
                                <span class="k">Phí VAT:</span>
                                <span class="v">0 VND</span>
                            </li>
                            <li>
                                <span class="k">Phí dịch vụ:</span>
                                <span class="v">0 VND</span>
                            </li>
                            <li>
                                <strong class="k">Thanh toán</strong>
                                <strong class="v">7,459,000 VND</strong>
                            </li>
                            <li style="border: none;">
                                <span class="k">Giảm giá: </span>
                                <span class="v purple">360,000 VND</span>
                            </li>
                            <li style="border: none;">
                                <strong class="clearfix" style="margin-bottom: 3px; display: block;">Nhập mã giảm giá</strong>
                                <div class="k">
                                    <input type="input" name="coupon_code" class="form-control">
                                    <i id="result_copoun" style="color: #999999; display:block; font-size: 12px; margin-top: 3px;"></i>
                                </div>
                                <div class="v">
                                    <button type="submit" class="btn btn-action btn-block chk applycoupon">ÁP DỤNG</button>
                                </div>
                                <div class="clearfix"></div>
                                <div class="couponmsg"></div>
                            </li>
                            <li style="border: none;">
                                <span class="k">Giảm giá: </span>
                                <span class="v purple" id="giam_gia_span">0 VND</span>
                                <input type="hidden" name="giam_gia" value="0" id="giam_gia">
                            </li>
                            <li style="border: none;">
                                <strong class="k">
                                    Tổng thanh toán
                                    <span style="color: #999999; display:block; font-size: 12px;">(Giá đã bao gồm VAT và phí dịch vụ)</span>
                                </strong>
                                <strong class="v purple" id="tong_thanh_toan_span"></strong>
                                <input type="hidden" name="tong_thanh_toan" id="tong_thanh_toan">
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading text-center"><strong>Thông tin thanh toán</strong></div><!-- /.panel-heading -->
                <div class="box">
                    <div class="box_body">
                        <ul class="order-summary">
                            <li style="border: none;">
                                <span class="k">Tình trạng thanh toán</span>
                                <div class="v">
                                    <select class="form-control chosen-select" name="room_id[]">
                                        <option value=""><span class="purple">Chưa thanh toán</span></option>
                                        <option value=""><span class="purple">Đã thanh toán</span></option>
                                        <option value=""><span class="purple">Đã cọc</span></option>
                                        <option value=""><span class="purple">Đã hủy</span></option>
                                    </select>
                                </div>
                            </li>
                            <li style="border: none;">
                                <span class="k">Số tiền</span>
                                <div class="v">
                                    <input type="text" name="email" class="form-control">
                                </div>
                            </li>
                            <li style="border: none;">
                                <span class="k">Ngày thanh toán</span>
                                <div class="v">
                                    <input type="text" name="" id="" class="form-control dpd1 fdate">
                                </div>
                            </li>
                            <li style="border: none;">
                                <div>Ghi chú</div>
                                <div>
                                    <textarea class="form-control" placeholder="" rows="5" id="" name=""></textarea>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading text-center"><strong>Điều kiện hủy phòng</strong></div><!-- /.panel-heading -->
                <div class="box">
                    <div class="box_body2">
                        <p>Giai đoạn 12.01.2017 - 31.10.2017</p>
                        <p>+ Hủy phòng trước 24 ngày trước ngày khách đến (trừ thứ 7, chủ nhật và Lễ, Tết): không tính phí</p>
                        <p>+ Hủy phòng trong vòng 23 ngày đến 13 ngày trước ngày khách đến (trừ thứ 7, chủ nhật và Lễ, Tết): tính 50% tổng tiền phòng</p>
                        <p>+ Hủy phòng trong vòng 12 ngày trước ngày khách đến (trừ thứ 7, chủ nhật và Lễ Tết): tính 100% tổng tiền phòng</p>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <button type="button" class="btn btn-block btn btn-action completebook">Tạo Booking</button>
            </div>
        </div>
    </div>

    <div class="panel-body">
        <div class="col-sm-12 col-xs-12">
            <div class="form-group">
                <div class="form-inline">
                    <input type="text" name="" value="" class="form-control" placeholder="Nhập mã booking">
                    <button type="button" class="btn btn-action">Lấy Thông Tin</button>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row-eq-height">
            <div class="col-sm-6 col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading text-center"><strong>Nhập Thông Tin</strong></div>
                    <div class="panel-body">
                        <div class="form-group">
                            <div class="form-inline">
                                Tên mã e-voucher
                                <input type="text" name="" value="" class="form-control" placeholder="">
                                <a href="#" title="" style="text-decoration: underline;">Lấy mã tự động</a>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Tên Khách Sạn</label>
                            <select class="form-control chosen-select" id="hotel_id" name="hotel_id">
                                <option value="">Khách sạn</option>
                            </select>
                        </div><!-- /.form-group -->
                        <div class="row">
                            <div class="col-md-5 col-xs-12 form-group">
                                <label for="booking_checkin">Ngày nhận phòng</label>
                                <input type="text" name="checkin" id="checkin"  class="form-control dpd1 fdate">
                            </div>
                            <div class="col-md-5 col-xs-12 form-group">
                                <label for="booking_checkout">Ngày trả phòng</label>
                                <input type="text" name="checkout" id="checkout" class="form-control dpd2 fdate">
                            </div>
                            <div class="col-md-2 col-xs-12 form-group">
                                <strong>Số đêm</strong> : <br><span id="number_night" style="font-weight:bold;margin-top:13px;display:block" ></span>
                            </div>
                        </div><!-- /.row -->
                        <div class="form-group">
                            <label for="">Loại phòng</label>
                            <select class="form-control chosen-select" id="hotel_id" name="hotel_id">
                                <option value="">Loại Phòng</option>
                            </select>
                        </div><!-- /.form-group -->
                        <div class="row">
                            <div class="col-md-4 col-xs-12 form-group">
                                <label for="booking_checkin">Số lượng phòng</label>
                                <select class="form-control chosen-select" id="hotel_id" name="hotel_id">
                                    <option value="1">01</option>
                                </select>
                            </div>
                            <div class="col-md-5 col-xs-12 form-group">
                                <label for="booking_checkout">Số lượng giường</label>
                                <select class="form-control chosen-select" id="hotel_id" name="hotel_id">
                                    <option value="1gl">1 Giường lớn</option>
                                </select>
                            </div>
                        </div><!-- /.row -->
                        <div class="form-group">
                            <a href="#" title="">
                                <i class="fa fa-plus-square-o"></i> Thêm loại phòng
                            </a>
                        </div><!-- /.form-group -->
                    </div>
                </div>
            </div><!-- /.col-sm-6 col-xs-12 -->
            <div class="col-sm-6 col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading text-center"><strong>Thông tin cá nhân</strong></div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="">Họ tên khách</label>
                            <div class="form-inline">
                                <input type="text" name="" value="" class="form-control" placeholder="">
                                <a href="#" title="">
                                    <i class="fa fa-plus-square-o"></i> Thêm tên khách
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-xs-12 form-group">
                                <label for="">Só điện thoại</label>
                                <input type="text" name="" id="" class="form-control" placeholder="">
                            </div>
                            <div class="col-md-6 col-xs-12 form-group">
                                <label for="">Email</label>
                                <input type="text" name="" id="" class="form-control" placeholder="">
                            </div>
                        </div><!-- /.row -->
                        <div class="row">
                            <div class="col-md-6 col-xs-12 form-group">
                                <label for="">Người lớn</label>
                                <input type="text" name="" id="" class="form-control" placeholder="">
                            </div>
                            <div class="col-md-6 col-xs-12 form-group">
                                <label for="">Trẻ em</label>
                                <input type="text" name="" id="" class="form-control" placeholder="">
                            </div>
                        </div><!-- /.row -->
                        <div class="form-group">
                            <label for="">Tình Trạng</label>
                            <select class="form-control chosen-select" id="" name="">
                                <option value="dtt">Đã Thanh Toán</option>
                                <option value="ctt">Chưa Thanh Toán</option>
                                <option value="dh">Đã hủy</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div><!-- /.col-sm-6 col-xs-12 -->
        </div>
        <div class="clearfix"></div>
        <div class="row-eq-height">
            <div class="col-sm-6 col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading text-center"><strong>Điều kiện hủy phòng</strong></div>
                    <div class="panel-body">
                        <p>Tự lọc điều kiện khi chọn tên khách sạn</p>
                    </div>
                </div>
            </div><!-- /.col-sm-6 col-xs-12 -->
            <div class="col-sm-6 col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading text-center"><strong>Bao gòm</strong></div>
                    <div class="panel-body">
                        <textarea class="form-control" placeholder="Nhập thông tin" rows="5" name=""></textarea>
                    </div>
                </div>
            </div><!-- /.col-sm-6 col-xs-12 -->
        </div>
        <div class="col-sm-12 col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading"><strong>Khác</strong></div>
                <div class="panel-body">
                    <textarea class="form-control" placeholder="Nhập thông tin" rows="5" name=""></textarea>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>Lưu ý</strong>
                    <span class="pull-right">
                        Thông tin mặc định
                        <a href="#" title="">(Chỉnh sửa thông tin)</a>
                    </span>
                </div>
                <div class="panel-body">
                    <span>- Theo quy định của khách sạn giờ nhận phòng: <strong>14:00 PM</strong> và Giờ trả phòng: <strong>12:00 PM</strong></span><br>
                    <span>- Trong trường hợp đến khách sạn, resort sớm và muốn nhận phòng sớm hơn theo quy định. Vui lòng liên hệ với tiếp tân để được hỗ trợ và việc check-in sớm còn tùy thuộc vào tình trạng phòng trống ngày bạn đến. Không được xác nhận trước. </span><br>
                    <span>- Quý khách vui lòng mang CMND, Hộ chiếu....(Giấy tờ tùy thân theo luật pháp Việt Nam) và Phiếu xác nhận của HOSPI giao cho tiếp tân khi làm thủ tục nhận phòng.</span><br>
                    <span>- Nếu Quý khách cần hỗ trợ thông tin về (Vật nuôi, xe lăn, nôi em bé...) Vui lòng gọi: <strong>(028) 3826 8797</strong> hoặc Hotline: <strong>09 6868 0106</strong> để được nhân viên tư vấn</span>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-xs-12">
            <div class="form-group">
                <button type="button" class="btn btn-block btn-action">Tạo E-Voucher</button>
            </div>
        </div>
    </div>
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
            $('#payment_info').hide();
            
            $.ajax({
                url: '<?php echo base_url() . "admin/hotelajaxcalls/room_by_hotel"; ?>',
                type: 'GET',
                data: {
                    hotel_id: $(this).val(),
                    checkin: $('#checkin').val(),
                    checkout: $('#checkout').val()
                },
                dataType: 'json',
                success: function (data) {
                    $('#room_info').html(data.room_info);
                    $('#hotel_name').html(data.hotel_info.title);
                    $('#payment_info').show();
                }
            });
        });

        $(".applycoupon").on("click", function () {
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