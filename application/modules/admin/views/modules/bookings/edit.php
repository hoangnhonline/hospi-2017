<div class="panel panel-default">
    <div class="panel-heading">
        <span class="panel-title pull-left">Chỉnh sửa Booking</span>
        <input type="hidden" id="currenturl" value="<?php echo current_url(); ?>" />
        <input type="hidden" id="baseurl" value="<?php echo base_url() . $this->uri->segment(1); ?>" />
        <div class="clearfix"></div>
    </div>
    <div class="panel-body">
        <form id="bookingdetails" action="<?php echo base_url('admin/bookings/update'); ?>" method="post">
            <div class="result"></div>
            <div class="col-md-8 col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading text-center"><strong>Thông tin booking</strong></div><!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="hotel_id">Tên Khách Sạn <span class="red-star">*</span></label>
                                <select class="form-control chosen-select" disabled="disabled">
                                    <?php foreach($hotels as $h){ ?>
                                        <option value="<?php echo $h->hotel_id; ?>"<?php echo $booking->booking_item == $h->hotel_id ? ' selected="selected"' : ''; ?>><?php echo $h->hotel_title; ?></option>
                                    <?php } ?>
                                </select>
                            </div><!-- /.form-group -->
                            <div class="row">
                                <div class="col-md-5 form-group">
                                    <label for="checkin">Ngày nhận phòng <span class="red-star">*</span></label>
                                    <input type="text" class="form-control dpd1 fdate" value="<?php echo date('d/m/Y', strtotime($booking->booking_checkin)); ?>" disabled="disabled">
                                </div>
                                <div class="col-md-5 form-group">
                                    <label for="checkout">Ngày trả phòng <span class="red-star">*</span></label>
                                    <input type="text" class="form-control dpd2 fdate" value="<?php echo date('d/m/Y', strtotime($booking->booking_checkout)); ?>" disabled="disabled">
                                </div>
                                <div class="col-md-2 form-group">
                                    <strong>Số đêm</strong> : <br><span style="font-weight:bold;margin-top:13px;display:block"><?php echo $booking->booking_nights; ?></span>
                                </div>
                            </div><!-- /.row -->
                            <div>
                                <table class="table table-customize">
                                    <thead>
                                        <tr>
                                            <th>Loại phòng</th>
                                            <th>Số phòng</th>
                                            <th>Giá phòng</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($rooms as $r) { ?>
                                        <tr>
                                            <td>
                                                <div class="zoom-gallery">
                                                    <div class="zoom-gallery55">
                                                        <img class="img-responsive" src="<?php echo $r->thumbnail; ?>">
                                                    </div>
                                                </div>
                                                <div class="info">
                                                    <h4 class="RTL go-text-right"><b class="purple"><?php echo $r->title; ?> - <?php echo $r->id; ?></b></h4>
                                                    <div class="block-people">
                                                        <h5>Người lớn: <span><?php echo $r->room_adults; ?></span></h5>
                                                        <h5>Trẻ em: <span><?php echo $r->room_children; ?></span></h5>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="item-countroom">
                                                    <h5 class="size12">Số phòng</h5>
                                                    <select class="form-control" disabled="disabled">
                                                        <option value="<?php echo $r->room_count; ?>"><?php echo $r->room_count; ?></option>
                                                    </select>
                                                </div>
                                                <div class="item-countroom">
                                                    <h5 class="size12">Giường phụ</h5>
                                                    <select class="form-control" disabled="disabled">
                                                        <option value="<?php echo $r->extra_bed; ?>"><?php echo $r->extra_bed; ?></option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="block-price">
                                                    <p class="purple size18"><b><?php echo number_format($r->price['total']); ?></b></p>
                                                    <div class="size13 grey">
                                                        Giá VND/<?php echo $booking->booking_nights; ?> đêm
                                                    </div>
                                                    <p class="block-price-info">
                                                        <span>Bao gồm: Ăn sáng.</span>
                                                        <span>Phí dịch vụ 5%, VAT 10%.</span>
                                                    </p>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="form-group">            
                                <textarea class="form-control" placeholder="Ghi chú" rows="5" disabled="disabled"><?php echo $booking->booking_additional_notes; ?></textarea>
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
                                <input type="text" class="form-control" value="<?php echo $booking->ai_last_name; ?>" disabled="disabled">
                            </div><!-- /.form-group -->
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="phone">Số điện thoại <span class="red-star">*</span></label>
                                    <input type="text" class="form-control" value="<?php echo $booking->ai_mobile; ?>" disabled="disabled">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="email">Email <span class="red-star">*</span></label>
                                    <input type="text" class="form-control" value="<?php echo $booking->accounts_email; ?>" disabled="disabled">
                                </div>
                            </div><!-- /.row -->
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="adults">Người lớn <span class="red-star">*</span></label>
                                    <select class="form-control" disabled="disabled">
                                        <?php for ($i = 1; $i <= 10; $i ++) { ?>
                                            <option value="<?php echo $i; ?>"<?php echo $booking->booking_adults == $i ? ' selected="selected"' : ''; ?>><?php echo $i; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="child">Trẻ em</label>
                                    <select class="form-control" disabled="disabled">
                                        <?php for ($i = 0; $i <= 10; $i ++) { ?>
                                            <option value="<?php echo $i; ?>"<?php echo $booking->booking_child == $i ? ' selected="selected"' : ''; ?>><?php echo $i; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div><!-- /.row -->
                            <div class="form-group">
                                <label for="address">Địa Chỉ</label>
                                <input type="text" class="form-control" value="<?php echo $booking->ai_address_1; ?>" disabled="disabled">
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
                                        <input type="radio" value="banktransfer" class="payment_method"<?php echo $booking->booking_payment_type == 'banktransfer' ? ' checked="checked"' : ''; ?> disabled="disabled">
                                        <strong>Chuyển khoản ngân hàng</strong>
                                    </label>
                                </div><!-- /.col-md-4 form-group -->
                                <div class="col-md-3 form-group">
                                    <label class="radio-inline">
                                        <input type="radio" value="payatoffice" class="payment_method"<?php echo $booking->booking_payment_type == 'payatoffice' ? ' checked="checked"' : ''; ?> disabled="disabled">
                                        <strong>Thanh toán tại Vp HOSPI</strong>
                                    </label>
                                </div><!-- /.col-md-4 form-group -->
                                <div class="col-md-3 form-group">
                                    <label class="radio-inline">
                                        <input type="radio" value="cod" class="payment_method"<?php echo $booking->booking_payment_type == 'cod' ? ' checked="checked"' : ''; ?> disabled="disabled">
                                        <strong>Thanh toán tại nhà</strong>
                                    </label>
                                </div><!-- /.col-md-4 form-group -->
                            </div><!-- /.row -->
                            <div id="response"></div>
                        </div><!-- /.col-md-12 -->
                    </div><!-- /.panel-body -->
                </div><!-- /.panel panel-default -->
            </div>
            <div class="col-md-4 col-xs-12 pull-right">
                <div class="panel panel-default">
                    <div class="panel-heading text-center"><strong>Thông tin phòng</strong></div><!-- /.panel-heading -->
                    <div class="panel-body">
                        <dl class="cb-img-name">
                            <dt>
                                <img src="<?php echo base_url(PT_HOTELS_SLIDER_THUMBS_UPLOAD . $hotel->thumbnail_image); ?>" alt="<?php echo $hotel->hotel_title; ?>" width="98">
                            </dt>
                            <dd>
                                <h1><?php echo $hotel->hotel_title; ?></h1>
                                <div class="clearfix">
                                    <small class="go-right">
                                        <?php
                                        $res = "";
                                        for ($stars = 1; $stars <= 5; $stars++) {
                                            if ($stars <= $hotel->hotel_stars) {
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
                                                <strong class="purple"><?php echo date('d/m/Y', strtotime($booking->booking_checkin)); ?></strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Ngày trả phòng:
                                            </td>
                                            <td><strong class="purple"><?php echo date('d/m/Y', strtotime($booking->booking_checkout)); ?></strong></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Số đêm:
                                            </td>
                                            <td><strong><?php echo $booking->booking_nights; ?></strong></td>
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
                                                <strong><?php echo $booking->booking_adults; ?></strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Trẻ em:
                                            </td>
                                            <td>
                                                <strong><?php echo $booking->booking_child; ?></strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Số lượng phòng:
                                            </td>
                                            <td>
                                                <strong></strong>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div><!-- row -->
                    </div>
                    <div class="box">
                        <ul class="order-summary">
                            <?php
                            $priceTotal = 0;
                            foreach ($rooms as $r) {
                                $priceOne = 0;
                                $priceExtraBed = 0;
                                foreach ($r->Info['detail'] as $tmp) {
                                    $priceOne += $tmp->total;
                                }
                                $priceOne = $priceOne / count($r->Info['detail']);
                                ?>
                                <li>
                                    <div class="k">
                                        <p><strong><?php echo $r->title; ?></strong></p>
                                        <?php echo number_format($priceOne); ?>
                                        x <?php echo $booking->booking_nights; ?> (đêm)
                                        x <?php echo $r->room_count; ?> (phòng)
                                        = <?php echo number_format($r->Info['total'] * $r->room_count); ?> VND
                                    </div>
                                </li>
                                <?php
                                $priceTotal += $r->Info['total'] * $r->room_count;
                            }
                            ?>
                            <li>
                                <span class="k">Thành tiền:</span>
                                <strong class="v"><?php echo number_format($priceTotal); ?> VND</strong>
                            </li>
                            <li>
                                <span class="k">Giường phụ:</span>
                                <span class="v"><?php echo number_format($booking->booking_extra_beds_charges); ?> VND</span>
                            </li>
                            <li>
                                <span class="k">Chi phí khác:</span>
                                <span class="v">0 VND</span>
                            </li>
                            <li>
                                <span class="k">Phí VAT:</span>
                                <span class="v"><?php echo number_format($booking->booking_tax); ?> VND</span>
                            </li>
                            <li>
                                <span class="k">Phí dịch vụ:</span>
                                <span class="v"><?php echo number_format($booking->booking_paymethod_tax); ?> VND</span>
                            </li>
                            <li>
                                <strong class="k">Thanh toán</strong>
                                <strong class="v"><?php echo number_format($booking->booking_paymethod_tax); ?> VND</strong>
                            </li>
                            <li style="border: none;">
                                <strong class="clearfix" style="margin-bottom: 3px; display: block;">Mã giảm giá</strong>
                                <div class="k">
                                    <input type="input" class="form-control coupon" value="<?php echo $booking->booking_coupon; ?>" disabled="disabled">
                                </div>
                            </li>
                            <li style="border: none;">
                                <span class="k">Giảm giá: </span>
                                <span class="v purple"><?php echo number_format($booking->booking_coupon_rate); ?> VND</span>
                            </li>
                            <li style="border: none;">
                                <strong class="k">
                                    Tổng thanh toán
                                    <span style="color: #999999; display:block; font-size: 12px;">(Giá đã bao gồm VAT và phí dịch vụ)</span>
                                </strong>
                                <strong class="v"><?php echo number_format($booking->booking_total); ?> VND</strong>
                            </li>
                        </ul>
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
                                            <option value="unpaid"<?php echo $booking->booking_status == 'unpaid' ? ' selected="selected"' : ''; ?>><span class="purple">Chưa thanh toán</span></option>
                                            <option value="paid"<?php echo $booking->booking_status == 'paid' ? ' selected="selected"' : ''; ?>><span class="purple">Đã thanh toán</span></option>
                                            <option value="reserved"<?php echo $booking->booking_status == 'reservedvv' ? ' selected="selected"' : ''; ?>><span class="purple">Đã cọc</span></option>
                                            <option value="cancelled"<?php echo $booking->booking_status == 'cancelled' ? ' selected="selected"' : ''; ?>><span class="purple">Đã hủy</span></option>
                                        </select>
                                    </div>
                                </li>
                                <li style="border: none;">
                                    <span class="k">Số tiền</span>
                                    <div class="v">
                                        <input type="text" class="form-control" name="amount_paid" value="<?php echo $booking->booking_amount_paid; ?>">
                                    </div>
                                </li>
                                <li style="border: none;">
                                    <span class="k">Ngày thanh toán</span>
                                    <div class="v">
                                        <input type="text" class="form-control dpd1 fdate" name="payment_date"value="<?php echo !empty($booking->booking_payment_date) ? date('d/m/Y', $booking->booking_payment_date) : ''; ?>">
                                    </div>
                                </li>
                                <li style="border: none;">
                                    <div>Ghi chú</div>
                                    <div>
                                        <textarea class="form-control" rows="5" name="payment_info"><?php echo $booking->booking_payment_info; ?></textarea>
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
                            <p>Giai đoạn 12.01.2017 - 31.10.2017:</p>
                            <p>+ Hủy phòng trước 24 ngày trước ngày khách đến (trừ thứ 7, chủ nhật và Lễ, Tết): không tính phí.</p>
                            <p>+ Hủy phòng trong vòng 23 ngày đến 13 ngày trước ngày khách đến (trừ thứ 7, chủ nhật và Lễ, Tết): tính 50% tổng tiền phòng.</p>
                            <p>+ Hủy phòng trong vòng 12 ngày trước ngày khách đến (trừ thứ 7, chủ nhật và Lễ Tết): tính 100% tổng tiền phòng.</p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <input type="hidden" name="btype" value="<?php echo $booking->booking_type; ?>"/>
                    <input type="hidden" name="booking_id" value="<?php echo $booking->booking_id; ?>"/>
                    <input type="hidden" name="refcode" value="<?php echo $booking->booking_ref_no; ?>"/>
                    <input type="hidden" name="refcode" value="<?php echo $booking->booking_total; ?>"/>
                    <button type="submit" name="guest" class="btn btn-block btn btn-action completebook">Cập nhật Booking</button>
                </div>
            </div>
        </div>
    </form>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        
    });
</script>