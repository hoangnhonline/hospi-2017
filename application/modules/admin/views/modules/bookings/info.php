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
        <!--<p class="row" style="padding: 15px 15px 0; border-top: 1px solid #cccccc">Loại phòng: <strong class="purple">01 giường lớn, 02 giường nhỏ</strong></p>-->
    </div>
    <div class="box">
        <div class="box_body">
            <ul class="order-summary">
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
    <button type="button" class="btn btn-block btn btn-action completebook">Lưu Booking</button>
</div>