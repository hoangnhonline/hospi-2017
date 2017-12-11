<div class="block-breadcrumb">
    <div class="container">
        <?php echo $breadcrumb; ?>
    </div>
</div>
<div class="container pagecontainer offset-0">
    <div class="offer-page rightcontent col-md-12 offset-0">
        <div class="itemscontainer offset-1">
            <div class="result"></div>
            <div class="page-info-user">
                <form class="row block-panel-info" id="bookingdetails">
                    <div class="col-sm-7 col-xs-12">
                        <div class="panel panel-default">
                            <div class="panel-heading text-center">
                                Thông tin cá nhân
                                <a href="#" title="" class="pull-left text-link2">Đăng nhập</a>
                            </div>
                            <div class="panel-body">
                                <div class="form-group col-md-6">
                                    <label class="title" for="">Họ tên khách <span class="requirement">*</span></label>
                                    <input type="text" class="form-control" id="lastname" name="lastname">
                                </div>
                                <div class="form-group col-md-6">
                                    <br>
                                    <div class="">

                                        <label class="checkbox-inline checkbox-style2" for="nguoikhac">
                                            <input type="checkbox" value="Yes" id="nguoikhac" name="nguoikhac">
                                            <span></span>
                                            Đặt cho người khác
                                        </label>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="form-group col-md-6">
                                    <label class="title" for="">Số điện thoại</label>
                                    <input type="text" class="form-control" id="phone" name="phone" placeholder="">
                                </div>
                                <div class="form-group  col-md-6">
                                    <label class="title" for="">Email*</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="">
                                </div>

                                <div class="form-group col-md-12">
                                    <p class="label-style">
                                        <label class="checkbox-inline checkbox-style2" for="sent_invoice">

                                            <input type="checkbox" name="sent_invoice" id="sent_invoice" value="Yes"
                                                   class="check_ShowInput">
                                            <span></span>
                                            Bạn cần xuất hóa đơn
                                        </label>
                                        <div class="showInput">
                                            <div style="border: 1px solid #ccc; padding: 10px 15px; margin: 10px 0;">
                                                <div class="row form-group">
                                                    <div class="col-sm-8">
                                                        <input type="text" name="company" class="form-control"
                                                               placeholder="Nhập tên công ty của bạn">
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <input type="text" name="mst" class="form-control"
                                                               placeholder="Mã số thuế">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" name="companyadd" class="form-control"
                                                           placeholder="Địa chỉ">
                                                </div>
                                                <div class="clearfix">
                                    <p>Bạn muốn gửi về địa chỉ khác [+]</p>
                                    <input type="text" name="sentto" class="form-control" placeholder="Địa chỉ">
                                </div>
                            </div>
                        </div>
                        </p>
                        <p class="label-style">
                            <label class="checkbox-inline checkbox-style2">
                                <input type="checkbox" name="" checked="checked">
                                <span></span>
                                Bạn có yêu cầu khác
                            </label>
                        </p>
                    </div>
                    <div class="form-group col-md-12">
                        <textarea name="additionalnotes" value="" class="form-control" rowspan="10" placeholder="Nhập yêu cầu của bạn"></textarea>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading text-center">
                    Thông tin chuyển khoản
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        Để thuận tiện cho việc thanh toán khách vui lòng chọn 1 trong những hình thức thanh toán dưới đây
                    </div>
                    <ul class="list-inline form-group">
                        <li class="label-style" style="padding-left: 0px">
                            <label class="radio-inline raido-style1">
                                <input type="radio" value="banktransfer" name="checkout-type" class="payment_method">
                                <span></span>
                                <strong>Chuyển khoản ngân hàng</strong>
                            </label>
                        </li>
                        <li class="label-style" style="padding-left: 0px">
                            <label class="radio-inline raido-style1">
                                <input type="radio" value="payatoffice" name="checkout-type" class="payment_method">
                                <span></span>
                                <strong>Thanh toán tại Vp HOSPI</strong>
                            </label>
                        </li>
                        <li class="label-style" style="padding-left: 0px">
                            <label class="radio-inline raido-style1">
                                <input type="radio" value="cod" name="checkout-type" class="payment_method">
                                <span></span>
                                <strong>Thanh toán tại nhà</strong>
                            </label>
                        </li>
                    </ul>
                    <div id="response"></div>
                </div>
            </div>
        </div>
        <?php if ($appModule != "offers") { ?>
            <div class="col-sm-5 col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">
                        Thông tin đơn phòng
                    </div>
                    <div class="panel-body">
                        <dl class="cb-img-name">
                            <dt>
                                <img src="<?php echo '../../' . PT_HOTELS_SLIDER_THUMBS_UPLOAD . $module->thumbnail_image; ?>"
                                     alt="<?php echo $module->hotel_title; ?>" width="98">
                            </dt>
                            <dd>
                                <h1><?php echo $module->hotel_title; ?></h1>
                                <div class="clearfix">
                                    <span class="go-right RTL"><i style="margin-left:-5px" class="icon-location-6"></i> <small
                                                class="adddress"><?php echo $module->hotel_map_city; ?></small></span>
                                </div>
                                <div class="clearfix">
                                    <small class="go-right"><?php
                                        $res = "";
                                        for ($stars = 1; $stars <= 5; $stars++) {

                                            if ($stars <= $module->hotel_stars) {
                                                $res .= PT_STARS_ICON;
                                            } else {
                                                $res .= PT_EMPTY_STARS_ICON;
                                            }
                                        }

                                        echo $res;
                                        ?>
                                    </small>
                                </div>
                            </dd>
                        </dl>
                        <div class="row">
                            <div class="col-sm-7 col-xs-12">
                                <div class="table table-responsive">
                                    <table class="table table-no-border mb0">
                                        <tr>
                                            <td>
                                                Ngày nhận phòng:
                                            </td>
                                            <td>
                                                <strong class="purple"><?php echo $checkin; ?></strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Ngày trả phòng:
                                            </td>
                                            <td><strong class="purple"><?php echo $checkout; ?></strong></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Số đêm:
                                            </td>
                                            <td><strong><?php echo $stay; ?></strong></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="col-sm-5 col-xs-12">
                                <div class="table table-responsive row">
                                    <table class="table table-no-border mb0">
                                        <tr>
                                            <td>
                                                Người lớn:
                                            </td>
                                            <td>
                                                <strong><?php echo $adults; ?></strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Trẻ em:
                                            </td>
                                            <td>
                                                <strong><?php echo $child; ?></strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Số lượng phòng:
                                            </td>
                                            <td>
                                                <strong><?php echo $totalRooms; ?></strong>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div><!-- row -->
                        <!--<p class="row" style="padding: 15px 15px 0; border-top: 1px solid #cccccc">Loại phòng: <strong class="purple">01 giường lớn, 02 giường nhỏ</strong></p>-->
                    </div>
                </div>
                <div class="box">
                    <div class="box_body">
                        <!-- <div class="order-items">
                            <div><strong>Giá trọn gói:</strong> 6,449,000 x 01 = 6,449,000 VND</div>
                            <div><strong>Trẻ em</strong> (6-8 tuổi): 300,000 x 01 = 1,010,000 VND</div>
                        </div> -->
                        <ul class="order-summary">
                            <?php
                            $room_quantity = json_decode($room_quantity, true);
                            $extra_beds = json_decode($extra_beds, true);

                            $priceTotal = $so_giuong_phu = 0;
                            if (!empty($room)) {

                                $priceExtraBedTotal = 0;
                                foreach ($room as $roomId => $rDetail) {
                                    $priceOne = 0;
                                    $priceExtraBed = 0;
                                    foreach ($rDetail->Info['detail'] as $tmp) {
                                        $priceOne += $tmp->total;
                                        $priceExtraBed += $tmp->bed_total;
                                    }
                                    $priceOne = $priceOne / count($rDetail->Info['detail']);
                                    $priceExtraBedTotal += $priceExtraBed * $extra_beds[$roomId];
                                    $so_giuong_phu += $extra_beds[$roomId];


                                    $quantity = $room_quantity[$roomId];
                                    ?>
                                    <li>
                                        <div class="k">
                                            <p><strong><?php echo $rDetail->title; ?></strong></p>
                                            <?php echo number_format($priceOne); ?> x <?php echo $stay; ?> (đêm)
                                            x <?php echo $quantity; ?> (phòng)
                                            = <?php echo number_format($rDetail->Info['total'] * $quantity); ?> VND
                                        </div>
                                    </li>
                                    <?php
                                    $priceTotal += $rDetail->Info['total'] * $quantity;
                                }
                            } ?>

                            <li>
                                <span class="k">Thành tiền:</span>
                                <strong class="v"><?php echo number_format($priceTotal); ?> VND</strong>
                            </li>
                            <li>
                                <span class="k">Giường phụ:</span>
                                <span class="v"><?php echo number_format($priceExtraBedTotal); ?></span>
                                <input type="hidden" name="so_giuong_phu" value="<?php echo $so_giuong_phu; ?>">
                                <input type="hidden" name="phi_giuong_phu" value="<?php echo $priceExtraBedTotal; ?>">
                            </li>
                            <li>
                                <span class="k">Chi phí khác:</span>
                                <span class="v">0 VND</span>
                            </li>
                            <li>
                                <?php
                                $phi_vat = $phi_dich_vu = 0;
                                if ($module->hotel_tax_fixed > 0) {
                                    $phi_vat = $module->hotel_tax_fixed;
                                } elseif ($module->hotel_tax_percentage > 0) {
                                    $phi_vat = $priceTotal * ($module->hotel_tax_percentage / 100);
                                }
                                if ($module->hotel_service_fixed > 0) {
                                    $phi_dich_vu = $module->hotel_service_fixed;
                                } elseif ($module->hotel_service_percentage > 0) {
                                    $phi_dich_vu = $priceTotal * ($module->hotel_service_percentage / 100);
                                }
                                ?>
                                <span class="k">Phí VAT:</span>
                                <span class="v"><?php echo number_format($phi_vat); ?> VND</span>
                                <input type="hidden" name="phi_vat" value="<?php echo $phi_vat; ?>">
                            </li>
                            <li>
                                <span class="k">Phí dịch vụ:</span>
                                <span class="v"><?php echo number_format($phi_dich_vu); ?> VND</span>
                                <input type="hidden" name="phi_dich_vu" value="<?php echo $phi_dich_vu; ?>">
                            </li>
                            <li>
                                <strong class="k">Thanh toán</strong>
                                <strong class="v"><?php echo number_format($priceTotal + $priceExtraBedTotal + $phi_vat + $phi_dich_vu); ?>
                                    VND</strong>
                                <input type="hidden" name="tong_chua_giam" id="tong_chua_giam"
                                       value="<?php echo $priceTotal + $priceExtraBedTotal + $phi_vat + $phi_dich_vu; ?>">
                            </li>
                            <li style="border: none;">
                                <strong class="clearfix" style="margin-bottom: 3px; display: block;">Nhập mã giảm
                                    giá</strong>
                                <div class="k">
                                    <input type="input" name="coupon_code" class="form-control coupon" placeholder="">
                                    <i id="result_copoun"
                                       style="color: #999999; display:block; font-size: 12px; margin-top: 3px;"></i>
                                </div>
                                <div class="v">
                                    <button style="margin-left:0; margin-bottom: 0; padding: 5px 16px;" type="button"
                                            class="btn btn-action btn-block chk applycoupon">ÁP DỤNG
                                    </button>
                                </div>
                                <div class="clearfix">
                                </div>
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
                                <strong class="v"
                                        id="tong_thanh_toan_span"><?php echo number_format($priceTotal + $priceExtraBedTotal); ?>
                                    VND</strong>
                                <input type="hidden" name="tong_thanh_toan" id="tong_thanh_toan"
                                       value="<?php echo($priceTotal + $priceExtraBedTotal); ?>">
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="box">
                    <div class="box_body">
                        <div style="padding: 10px;">
                            Điều kiện hủy
                            <div class="block-question-info" style="display: inline-block;">
                                <i class="fa fa-question-circle"></i>
                                <div class="block-info">
                                    <p>Nếu bạn chưa xác định được ngày đi. Bạn có thể mua trước đi sau ....</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <p class="text-center" style="margin-bottom:10px">
                    Tôi đã đọc và chấp nhận điều kiện, chính sách khách sạn,<br><a class="text-link" href="#"
                                                                                   title="chính sách bảo mật"
                                                                                   target="_blank">Điều khoản sử dụng</a> và
                    <a class="text-link" href="#" title="chính sách bảo mật" target="_blank">chính sách bảo mật</a> của
                    HOSPI
                </p>
                <p class="text-center">
                    <button type="submit" class="btn btn-action2 completebook" name="<?php if (empty($usersession)) {
                        echo "guest";
                    } else {
                        echo "logged";
                    } ?>" onclick="return completebook('<?php echo base_url(); ?>','<?php echo trans('0159') ?>');">Hoàn
                        Thành
                    </button>
                </p>
            </div>
            <input type="hidden" name="country" value="VN" id="country"/>
            <input type="hidden" id="itemid" name="itemid" value="<?php echo $module->hotel_id; ?>"/>
            <input type="hidden" name="checkout" value="<?php echo $checkout; ?>"/>
            <input type="hidden" name="adults" value="<?php echo $adults; ?>"/>
            <input type="hidden" name="child" value="<?php echo $child; ?>"/>
            <input type="hidden" name="nights" value="<?php echo $stay; ?>"/>
            <input type="hidden" id="couponid" name="couponid" value=""/>
            <input type="hidden" id="btype" name="btype" value="<?php echo $appModule; ?>"/>
            <?php if ($appModule == "hotels") { ?>
                <input type="hidden" name="subitemid" value="<?php echo $room_id; ?>"/>
                <input type="hidden" name="roomscount" value='<?php echo json_encode($room_quantity); ?>'/>
                <input type="hidden" name="bedscount" value='<?php echo json_encode($extra_beds); ?>'/>
                <input type="hidden" name="checkin" value="<?php echo $checkin; ?>"/>
            <?php } ?>
        <?php } else { ?>
            <div class="col-sm-5 col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">
                        Thông tin combo
                    </div>
                    <div class="panel-body">
                        <dl class="cb-img-name">
                            <dt>
                                <img src="<?php echo $module->thumbnail; ?>" alt="<?php echo $module->title; ?>" width="98">
                            </dt>
                            <dd>
                                <h1><?php echo $module->title; ?></h1>
                            </dd>
                        </dl>
                        <div class="row">
                            <div class="col-sm-7 col-xs-12">
                                <div class="table table-responsive">
                                    <table class="table table-no-border mb0">
                                        <tbody>
                                        <tr>
                                            <td>
                                                Ngày đi:
                                            </td>
                                            <td>
                                                <strong class="purple"><?php echo $checkin; ?></strong>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-sm-5 col-xs-12">
                                <div class="table table-responsive row">
                                    <table class="table table-no-border mb0">
                                        <tbody>
                                        <tr>
                                            <td>
                                                Số lượng:
                                            </td>
                                            <td>
                                                <strong><?php echo $quantity; ?></strong>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box">
                    <div class="box_body">
                        <ul class="order-summary">
                            <?php
                            $price = (int)str_replace(',', '', $module->price);
                            $priceTotal = $quantity * $price;
                            $priceSurchargeTotal = 0;
                            ?>
                            <li>
                                <div class="k">
                                    <p><strong><?php echo $module->title; ?></strong></p>
                                    <?php echo number_format($price); ?> x <?php echo $quantity; ?>
                                    = <?php echo number_format($priceTotal); ?> <?php echo $module->currSymbol; ?>
                                </div>
                            </li>
                            <li>
                                <span class="k">Thành tiền:</span>
                                <strong class="v"><?php echo number_format($priceTotal); ?><?php echo $module->currSymbol; ?></strong>
                            </li>
                            <?php if (!empty($module->surchargeInfo)) {
                                foreach ($module->surchargeInfo as $item) {
                                    $price_surcharge = (int)str_replace(',', '', $item->price);
                                    $price_surcharge = $surcharge[$item->id] * $price_surcharge;
                                    $priceSurchargeTotal += $price_surcharge;
                                    ?>
                                    <li>
                                        <span class="k"><?php echo $item->name; ?></span>
                                        <span class="v"><?php echo number_format($price_surcharge); ?> <?php echo $module->currSymbol; ?></span>
                                    </li>
                                    <?php
                                }
                            }
                            ?>
                            <li>
                                <strong class="k">Thanh toán</strong>
                                <strong class="v"><?php echo number_format($priceTotal + $priceSurchargeTotal); ?>
                                    VND</strong>
                                <input type="hidden" name="tong_chua_giam" id="tong_chua_giam"
                                       value="<?php echo $priceTotal + $priceSurchargeTotal; ?>">
                            </li>
                            <li style="border: none;">
                                <strong class="clearfix" style="margin-bottom: 3px; display: block;">Nhập mã giảm
                                    giá</strong>
                                <div class="k">
                                    <input type="input" name="coupon_code" class="form-control coupon">
                                    <i id="result_copoun"
                                       style="color: #999999; display:block; font-size: 12px; margin-top: 3px;"></i>
                                </div>
                                <div class="v">
                                    <button style="margin-left:0; margin-bottom: 0; padding: 5px 16px;" type="button"
                                            class="btn btn-action btn-block chk applycoupon">ÁP DỤNG
                                    </button>
                                </div>
                                <div class="clearfix">
                                </div>
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
                                <strong class="v purple"
                                        id="tong_thanh_toan_span"><?php echo number_format($priceTotal + $priceSurchargeTotal); ?>
                                    VND</strong>
                                <input type="hidden" name="tong_thanh_toan" id="tong_thanh_toan"
                                       value="<?php echo($priceTotal + $priceSurchargeTotal); ?>">
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="box">
                    <div class="box_body">
                        <div style="padding: 10px;">
                            Điều kiện hủy
                            <div class="block-question-info" style="display: inline-block;">
                                <i class="fa fa-question-circle"></i>
                                <div class="block-info">
                                    <p>Nếu bạn chưa xác định được ngày đi. Bạn có thể mua trước đi sau ....</p>
                                </div>
                            </div>
                            <p><?php echo nl2br($module->cancel_condition); ?></p>
                        </div>
                    </div>
                </div>
                <p class="text-center" style="margin-bottom:10px">
                    Tôi đã đọc và chấp nhận điều kiện, chính sách khách sạn,<br><a class="text-link" href="#" title="Điều khoản sử dụng" target="_blank">Điều khoản sử dụng</a> và
                    <a class="text-link" href="#" title="chính sách bảo mật" target="_blank">chính sách bảo mật</a> của
                    HOSPI
                </p>
                <p class="text-center">
                    <button type="submit" class="btn btn-action2 completebook" name="<?php if (empty($usersession)) {
                        echo "guest";
                    } else {
                        echo "logged";
                    } ?>" onclick="return completebook('<?php echo base_url(); ?>','<?php echo trans('0159') ?>');">Hoàn
                        Thành
                    </button>
                </p>
            </div>
            <input type="hidden" name="country" value="VN" id="country"/>
            <input type="hidden" id="itemid" name="itemid" value="<?php echo $module->id; ?>"/>
            <input type="hidden" name="quantity" value="<?php echo $quantity; ?>"/>
            <input type="hidden" name="checkin" value="<?php echo $checkin; ?>"/>
            <input type="hidden" name="nights" value="<?php echo $module->min_nights; ?>"/>
            <input type="hidden" id="couponid" name="couponid" value=""/>
            <input type="hidden" id="btype" name="btype" value="<?php echo $appModule; ?>"/>
            <input type="hidden" name="surcharge" value='<?php echo json_encode($surcharge); ?>'/>
        <?php } ?>
    </form>
</div>
</div>
</div>
</div>

<!-- END OF CONTENT -->

<div id="waiting"></div>
<?php if ($appModule == "ean") { ?>
    <!-- Start JS for Expedia -->
    <script type="text/javascript">
        $(function () {

            $(".submitresult").hide();

        })

        function expcheck() {

            $(".submitresult").html("").fadeOut("fast");

            var cardno = $("#card-number").val();
            var cardtype = $("#cardtype").val();

            var email = $("#card-holder-email").val();

            var country = $("#country").val();

            var cvv = $("#cvv").val();

            var city = $("#card-holder-city").val();

            var state = $("#card-holder-state").val();

            var postalcode = $("#card-holder-postalcode").val();

            var firstname = $("#card-holder-firstname").val();

            var lastname = $("#card-holder-lastname").val();
            var policy = $("#policy").val();
            var minMonth = new Date().getMonth() + 1;

            var minYear = new Date().getFullYear();

            var month = parseInt($("#expiry-month").val(), 10);

            var year = parseInt($("#expiry-year").val(), 10);

            var txtAddrress = $("#txtAddrress").val();
            var textbank = $(".textbank").val();


            if (country == "US") {

                if ($.trim(postalcode) == "") {

                    $(".submitresult").html("Enter Postal Code").fadeIn("slow");

                    return false;

                } else if ($.trim(state) == "") {

                    $(".submitresult").html("Enter State").fadeIn("slow");

                    return false;

                }

            }

            if ($.trim(firstname) == "") {

                $(".submitresult").html("Enter First Name").fadeIn("slow");

                return false;

            } else if ($.trim(lastname) == "") {

                $(".submitresult").html("Enter Last Name").fadeIn("slow");

                return false;

            } else if ($.trim(cardno) == "") {

                $(".submitresult").html("Enter Card number").fadeIn("slow");

                return false;

            } else if ($.trim(cardtype) == "") {

                $(".submitresult").html("Select Card Type").fadeIn("slow");

                return false;

            } else if (month <= minMonth && year <= minYear) {

                $(".submitresult").html("Invalid Expiration Date").fadeIn("slow");

                return false;


            } else if ($.trim(cvv) == "") {

                $(".submitresult").html("Enter Security Code").fadeIn("slow");

                return false;


            } else if ($.trim(country) == "") {

                $(".submitresult").html("Select Country").fadeIn("slow");

                return false;


            } else if ($.trim(city) == "") {

                $(".submitresult").html("Enter City").fadeIn("slow");

                return false;


            } else if ($.trim(email) == "") {

                $(".submitresult").html("Enter Email").fadeIn("slow");

                return false;


            } else if (!$('#policy').is(':checked')) {

                $(".submitresult").html("Please Accept Cancellation Policy").fadeIn("slow");

                return false;


            } else if (($.('#banktransfer').is(':checked')) && ($.trim(textbank) == "")) {

                $(".submitresult").html("Please Select Payment Method").fadeIn("slow");


                return false;
            } else if (($.('#cod').is(':checked')) && ($.trim(txtAddrress) == "")) {

                $(".submitresult").html("Please Enter Address").fadeIn("slow");


                return false;
            } else {

                $(".paynowbtn").hide();

                $(".submitresult").removeClass("alert-danger");

                $(".submitresult").html("<div id='rotatingDiv'></div>").fadeIn("slow");

            }


        }

        function isNumeric(evt) {

            var e = evt || window.event; // for trans-browser compatibility

            var charCode = e.which || e.keyCode;

            if (charCode > 31 && (charCode < 47 || charCode > 57))

                return false;

            if (e.shiftKey) return false;

            return true;

        }


    </script>
    <!-- End JS for Expedia -->
<?php } ?>
<style>
    #rotatingImg {
        display: none;
    }

    .booking-bg {
        padding: 10px 0 5px 0;
        width: 100%;
        background-image: url('<?php echo $theme_url; ?>assets/images/step-bg.png');
        background-color: #222;
        text-align: center;
    }

    .bookingFlow__message {
        color: white;
        font-size: 18px;
        margin-top: 5px;
        margin-bottom: 15px;
        letter-spacing: 1px;
    }

    .select2-choice {
        font-size: 13px !important;
        padding: 0 0 0 10px !important;
    }
</style>
<?php if ($appModule != "ean") { ?>
    <script src="<?php echo base_url(); ?>assets/js/booking.js"></script>
<?php } ?>
<div class="clearfix"></div>
<script type='text/javascript'>
    $(window).load(function () {
        $('.showInput').css('display', 'none');
        $('.check_ShowInput').change(function () {
            if ($(this).prop("checked")) {
                $('.showInput').css('display', 'none');
            } else {
                $('.showInput').css('display', 'block');
            }
            $('.showInput').fadeToggle();
        });
        $(".payment_method").click(function () {

            $('.completebook').show();
            var gateway = $(this).val();
            $("#response").html("<div id='rotatingDiv'></div>");
            $.ajax({
                url: "<?php echo base_url();?>invoice/getGatewaylink/<?php echo $invoice->id?>/<?php echo $invoice->code;?>",
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
                            $("#divBankDetails").children().hide();
                            $('#span' + name).show();

                        });

                    }
                }
            });


        });

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


        $(".applycoupon").on("click", function () {
            var module = $("#btype").val();
            var itemid = $("#itemid").val();
            var coupon = $(".coupon").val();
            $.ajax({
                url: "<?php echo base_url();?>admin/ajaxcalls/checkCoupon",
                type: 'POST',
                data: {
                    coupon: coupon,
                    module: module,
                    itemid: itemid
                },
                //dataType : 'json',
                success: function (response) {
                    console.log(response);
                    var resp = $.parseJSON(response);
                    if (resp.status == "success") {
                        $("#couponid").val(resp.couponid);
                        $(".couponmsg").html(" <div class='alert alert-success'><?php echo trans('0512'); ?><strong> " + coupon + " </strong><?php echo trans('0821'); ?> <strong> " + resp.value + resp.type + " </strong><?php echo trans('0822'); ?></div>");
                        $(".coupon").prop("readonly", "readonly");
                        $(".applycoupon").hide();
                        if (resp.type == '%') {
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
                        if (resp.status == "irrelevant") {

                            alert("<?php echo trans('0520'); ?>");

                        } else {

                            alert("<?php echo trans('0513'); ?>");
                        }

                    }
                    console.log(resp);
                }
            });
        });


    });

</script>