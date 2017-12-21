<div class="panel panel-default">
    <div class="panel-heading text-center"><strong>Thông tin đơn phòng</strong></div><!-- /.panel-heading -->
    <div class="panel-body">
        <dl class="cb-img-name">
            <dt>
                <img src="<?php echo base_url(PT_HOTELS_SLIDER_THUMBS_UPLOAD . $module->thumbnail_image); ?>" alt="<?php echo $module->hotel_title; ?>" width="98">
            </dt>
            <dd>
                <h1><?php echo $module->hotel_title; ?></h1>
                <div class="clearfix">
                    <small class="go-right">
                        <?php
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
    </div>
    <div class="box">
        <div class="box_body">
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
</div>
<div class="panel panel-default">
    <div class="panel-heading text-center"><strong>Thông tin thanh toán</strong></div><!-- /.panel-heading -->
    <div class="box">
        <div class="box_body">
            <ul class="order-summary">
                <li style="border: none;">
                    <span class="k">Tình trạng thanh toán</span>
                    <div class="v">
                        <select class="form-control chosen-select" name="status">
                            <option value="unpaid"><span class="purple">Chưa thanh toán</span></option>
                            <option value="paid"><span class="purple">Đã thanh toán</span></option>
                            <option value="reserved"><span class="purple">Đã cọc</span></option>
                            <option value="cancelled"><span class="purple">Đã hủy</span></option>
                        </select>
                    </div>
                </li>
                <li style="border: none;">
                    <span class="k">Số tiền</span>
                    <div class="v">
                        <input type="text" name="amount_paid" class="form-control">
                    </div>
                </li>
                <li style="border: none;">
                    <span class="k">Ngày thanh toán</span>
                    <div class="v">
                        <input type="text" name="payment_date" class="form-control dpd1 fdate">
                    </div>
                </li>
                <li style="border: none;">
                    <div>Ghi chú</div>
                    <div>
                        <textarea class="form-control" rows="5" name="cancellation_request"></textarea>
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
    <input type="hidden" name="country" value="VN" id="country"/>
    <input type="hidden" id="itemid" name="itemid" value="<?php echo $module->hotel_id; ?>"/>
    <input type="hidden" name="checkout" value="<?php echo $checkout; ?>"/>
    <input type="hidden" name="adults" value="<?php echo $adults; ?>"/>
    <input type="hidden" name="child" value="<?php echo $child; ?>"/>
    <input type="hidden" name="nights" value="<?php echo $stay; ?>"/>
    <input type="hidden" id="couponid" name="couponid" value=""/>
    <input type="hidden" id="btype" name="btype" value="hotels"/>
    <input type="hidden" name="subitemid" value="<?php echo $room_id; ?>"/>
    <input type="hidden" name="roomscount" value='<?php echo json_encode($room_quantity); ?>'/>
    <input type="hidden" name="bedscount" value='<?php echo json_encode($extra_beds); ?>'/>
    <input type="hidden" name="checkin" value="<?php echo $checkin; ?>"/>
    <button type="submit" name="guest" class="btn btn-block btn btn-action completebook" onclick="return completebook('<?php echo base_url(); ?>','Select Payment Method');" style="display: none;">Lưu Booking</button>
</div>
<script type="text/javascript">
$('.dpd1').datepicker({
    format: fmt,
    language: 'vi',
    onRender: function (date) {
        return date.valueOf() < now.valueOf() ? 'disabled' : '';
    }
});
</script>