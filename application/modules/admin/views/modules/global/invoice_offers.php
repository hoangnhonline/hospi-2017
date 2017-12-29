<!DOCTYPE html>
<?php
$CI = &get_instance(); 
$app_settings = $CI->settings_model->get_settings_data();
$theme_url = base_url('themes/default/');
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Combo Invoice</title>
        <link rel="shortcut icon" href="<?php echo PT_GLOBAL_IMAGES_FOLDER . $app_settings[0]->favicon_img; ?>">
        <link href="<?php echo $theme_url; ?>assets/css/bootstrap.css" rel="stylesheet" media="screen">
        <link href="<?php echo $theme_url; ?>assets/css/custom.css" rel="stylesheet" media="screen">
        <link href="<?php echo $theme_url; ?>assets/css/style.css" rel="stylesheet">
        <script type="text/javascript" src="<?php echo $theme_url; ?>assets/js/jquery-1.11.2.min.js"></script>
    </head>
    <body class="blog">
        <div class="container pagecontainer offset-0">
            <div class="offer-page rightcontent col-md-12 offset-0">
                <div class="itemscontainer offset-1">
                    <div class="box-invoice">
                        <div class="box-invoice-head">
                            <div class="box-invoice-head01">
                                <div class="table-cell">
                                    <div class="cell">
                                        <a href="<?php echo base_url(); ?>" title="Logo">
                                            <img src="<?php echo PT_GLOBAL_IMAGES_FOLDER.$app_settings[0]->header_logo_img;?>" alt="Logo">
                                        </a>
                                    </div>
                                    <div class="cell text-center">
                                        <a href="<?php echo base_url(); ?>" title="Đi tới trang website chúng tôi" class="text-link2">Đi tới trang website chúng tôi</a>
                                    </div>
                                    <div class="cell text-right">
                                        <img src="<?php echo $theme_url; ?>assets/img/hotel-invoice.png" alt="">
                                    </div>
                                </div>
                            </div><!-- box-invoice-head01 -->
                            <div class="box-invoice-head02">
                                <ul class="list-inline">
                                    <li class="purple"><strong>Ngày: <?php echo $invoice->bookingDate; ?></strong></li>
                                    <li>
                                        <a href="#" title="In invoice" class="text-link2">In invoice</a>
                                        <a href="#" title="Tải File PDF" class="text-link2">Tải File PDF</a>
                                    </li>
                                </ul>
                            </div><!-- box-invoice-head02 -->
                            <div class="box-invoice-head01 box-invoice-head03">
                                <div class="table-cell">
                                    <div class="cell">
                                        Mã invoice: <span class="purple"><?php echo $invoice->code; ?></span>
                                    </div>
                                    <div class="cell text-center">
                                        <a href="<?php echo base_url(); ?>" title="hospi.vn">www.hospi.vn</a>
                                    </div>
                                    <div class="cell text-right">
                                        <div class="unpaid">
                                            Tình trạng:
                                            <strong>
                                                <?php
                                                if ($invoice->status == "unpaid") {
                                                    echo trans('082');
                                                } elseif ($invoice->status == "reserved") {
                                                    echo trans('0445'); 
                                                    if ($invoice->paymethod == "payonarrival") { 
                                                        echo trans("0474");
                                                    }
                                                } elseif ($invoice->status == "cancelled") {
                                                    echo trans('0347');
                                                } else {
                                                    echo trans('081') . '<br />'; 
                                                    echo trans('0410') . ': ' . $invoice->userEmail;
                                                }
                                                ?>
                                            </strong>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- box-invoice-head03 -->
                        </div><!-- block-inv-infomation -->
                        <div class="box-invoice-body">
                            <div class="block-inv-infomation">
                                <div class="row row-eq-height">
                                    <div class="col-sm-6">
                                        <div class="panel panel-default panel-infomation">
                                            <div class="panel-heading text-center">
                                                Thông tin khách hàng
                                            </div>
                                            <div class="panel-body">
                                                <ul>
                                                    <li>Họ tên khách: <strong class="purple"><?php echo $invoice->userFullName; ?></strong></li>
                                                    <li>Email: <strong><?php echo $invoice->userEmail; ?></strong></li>
                                                    <li>Điện thoại: <strong> <?php echo $invoice->userMobile; ?></strong></li>
                                                    <li>Địa chỉ: <strong> <?php echo $invoice->userAddress; ?></strong></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-sm-12">
                                        <div class="panel panel-default">
                                            <div class="panel-heading text-center">
                                                Thông tin khách sạn
                                            </div>
                                            <div class="panel-body">
                                                <dl class="cb-img-name">
                                                    <dt>
                                                        <img src="<?php echo $invoice->thumbnail; ?>" alt="<?php echo $invoice->title; ?>">
                                                    </dt>
                                                    <dd>
                                                        <h1><?php echo $invoice->title; ?></h1>
                                                        <div class="clearfix">
                                                            <span class="go-right RTL">
                                                                <i style="margin-left:-5px" class="icon-location-6"></i> 
                                                                <small class="adddress"><?php echo $invoice->address; ?></small>
                                                            </span>
                                                        </div>
                                                        <div class="clearfix">
                                                            <small class="go-right">
                                                                <?php
                                                                $res = "";
                                                                for ($stars = 1; $stars <= 5; $stars++) {
                                                                    if ($stars <= $invoice->stars) {
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
                                                    <div class="col-sm-5 col-xs-12">
                                                        <div class="table table-responsive">
                                                            <table class="table table-no-border mb0">
                                                                <tr>
                                                                    <td>
                                                                        Ngày nhận phòng:
                                                                    </td>
                                                                    <td class="w40">
                                                                        <strong class="purple"><?php echo $invoice->checkin; ?></strong>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        Ngày trả phòng:
                                                                    </td>
                                                                    <td><strong class="purple"><?php echo $invoice->checkout; ?></strong></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        Số đêm:
                                                                    </td>
                                                                    <td><strong><?php echo $invoice->nights; ?></strong></td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-7 col-xs-12">
                                                        <div class="table table-responsive row">
                                                            <table class="table table-no-border mb0">
                                                                <tr>
                                                                    <td class="w40">
                                                                        Người lớn:
                                                                    </td>
                                                                    <td>
                                                                        <strong><?php echo $invoice->adults; ?></strong>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        Trẻ em:
                                                                    </td>
                                                                    <td>
                                                                        <strong><?php echo $invoice->child; ?></strong>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        Số lượng phòng:
                                                                    </td>
                                                                    <td>
                                                                        <strong id="total_room"></strong>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div><!-- row -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- block-inv-infomation -->
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="panel panel-default">
                                        <div class="panel-heading text-center">
                                            Điều kiện hủy
                                        </div>
                                        <div class="panel-body">
                                            <?php echo nl2br($invoice->hotel_policy); ?>
                                        </div>
                                    </div><!-- panel -->
                                    <div class="panel panel-default">
                                        <div class="panel-heading text-center">
                                            Điều kiện sử dụng
                                        </div>
                                        <div class="panel-body">
                                            <p>Giai đoạn 12.01.2017 - 31.10.2017</p>
                                            <p>......</p>
                                        </div>
                                    </div><!-- panel -->
                                    <div class="panel panel-default">
                                        <div class="panel-heading text-center">
                                            Hinh thức thanh toán
                                        </div>
                                        <div class="panel-body">
                                            <div>Hinh thức thanh toán</div>
                                            <p><strong><?php echo getPayment($invoice->paymethod);?></strong></p>
                                            <div class="clearfix">
                                                <?php
                                                if(getPayment($invoice->paymethod) == "Thanh toán tại nhà") {
                                                    echo nl2br(getBookingPaymentinfo($invoice->id)); 
                                                } else {
                                                    echo getBookingPaymentinfo($invoice->id);
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div><!-- panel -->
                                </div><!-- col-sm-6 -->
                                <div class="col-sm-6">
                                    <div class="panel panel-default">
                                        <div class="panel-heading text-center">
                                            Thông tin đơn phòng
                                        </div>
                                        <div class="box">
                                            <div class="box_body">
                                                <ul class="order-summary">
                                                    <?php
                                                    $priceTotal = 0;
                                                    $totalRoom = 0;
                                                    foreach ($invoice->subItem as $r) {
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
                                                                x <?php echo $invoice->nights; ?> (đêm)
                                                                x <?php echo $r->room_count; ?> (phòng)
                                                                = <?php echo number_format($r->Info['total'] * $r->room_count); ?> VND
                                                            </div>
                                                        </li>
                                                        <?php
                                                        $totalRoom += $r->room_count;
                                                        $priceTotal += $r->Info['total'] * $r->room_count;
                                                    }
                                                    ?>
                                                    <script type="text/javascript">
                                                        $('#total_room').html('<?php echo $totalRoom > 9 ? $totalRoom : '0' . $totalRoom; ?>');
                                                    </script>
                                                    <li>
                                                        <span class="k">Thành tiền:</span>
                                                        <strong class="v"><?php echo number_format($priceTotal); ?> VND</strong>
                                                    </li>
                                                    <li>
                                                        <span class="k">Giường phụ:</span>
                                                        <span class="v"><?php echo number_format($invoice->extraBedsCharges); ?> VND</span>
                                                    </li>
                                                    <li>
                                                        <span class="k">Chi phí khác:</span>
                                                        <span class="v">0 VND</span>
                                                    </li>
                                                    <li>
                                                        <span class="k">Phí VAT:</span>
                                                        <span class="v"><?php echo number_format($invoice->tax); ?> VND</span>
                                                    </li>
                                                    <li>
                                                        <span class="k">Phí dịch vụ:</span>
                                                        <span class="v"><?php echo number_format($invoice->paymethodTax); ?> VND</span>
                                                    </li>
                                                    <li>
                                                        <strong class="k">Thanh toán</strong>
                                                        <strong class="v"><?php echo number_format($invoice->checkoutAmount); ?> VND</strong>
                                                    </li>
                                                    <li style="border: none;">
                                                        <span class="k">Giảm giá: </span>
                                                        <span class="v purple"><?php echo number_format($invoice->couponRate); ?> VND</span>
                                                    </li>
                                                    <li style="border: none;">
                                                        <strong class="k">Tổng thanh toán</strong>
                                                        <strong class="v"><?php echo number_format($invoice->checkoutTotal); ?> VND</strong>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div><!-- panel -->
                                </div><!-- col-sm-6 -->
                            </div><!-- row -->
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            Ghi chú
                                        </div>
                                        <div class="panel-body"><?php echo $invoice->additionaNotes; ?></div>
                                    </div><!-- panel -->
                                </div>
                            </div><!-- row -->
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            Lưu ý
                                        </div>
                                        <div class="panel-body">
                                            <p>- Quý khách chỉ thanh toán khi được xác nhận bởi nhân viên HOSPI qua email hoặc điện thoại</p>
                                            <p>- Khi thanh toán chuyển khoản vui lòng nghi rõ, họ tên khách hàng hoặc thanh toán cho mã booking() ở trên phiếu xác nhận.</p>
                                            <p>- Nếu quý khách  chon phương thức thanh toán chuyển khoản, Quý khách chỉ chuyển khoản theo số tài khoản được tạo trên booking này.</p>
                                            <p>- Nếu quý khách các phương thức còn lại thì phải có phiếu thu, giấy giới thiệu thu tiền (nếu có) và các giấy tờ có chữ ký và con dấu của công ty HOSPI thì mới hợp lệ.</p>
                                            <p>- Quý khách có thể từ chối thanh toán nếu nhân viên không cung cấp đủ các thông tin trên hoặc liên hệ hotline: <strong>090 345 5152</strong> để được xác nhận</p>
                                        </div>
                                    </div><!-- panel -->
                                </div>
                            </div><!-- row -->
                        </div><!-- box-invoice-body -->
                        <div class="box-invoice-footer">
                            <div class="table-cell">
                                <div class="cell">
                                    <strong class="purple">HOSPI - Đặt phòng khách sạn</strong>
                                </div>
                                <div class="cell text-center">
                                    <ul class="list-inline no-style">
                                        <li class="purple">(028) 3826 8797</li>
                                        <li class="purple">booking@hospi.vn</li>
                                        <li class="purple">096868 0106</li>
                                    </ul>
                                </div>
                                <div class="cell text-right">
                                    <address>
                                        <strong class="purple">HOSPI TRAVEL CO., LTD</strong><br>
                                        Lầu 1, Số 124 Khánh Hội,<br>
                                        Phường 6, Quận 4, Tp.HCM<br>
                                    </address>
                                </div>
                            </div>
                        </div><!-- box-invoice-footer -->
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>