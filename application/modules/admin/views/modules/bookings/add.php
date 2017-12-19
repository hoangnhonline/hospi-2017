<div class="panel panel-default">
  <div class="panel-heading">
    <span class="panel-title pull-left">Tạo Booking</span>
    <input type="hidden" id="currenturl" value="<?php echo current_url();?>" />
    <input type="hidden" id="baseurl" value="<?php echo base_url().$this->uri->segment(1);?>" />
    <div class="clearfix"></div>
  </div>
  <form action="" method="POST" enctype="multipart/form-data" >
    <div class="panel-body">
      <div class="col-md-8">

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
                <select class="form-control chosen-select" name="" id="">
                  <option value="ks1"><strong>SIX SENSES CÔN ĐẢO RESORT</strong></option>
                </select>
              </div><!-- /.form-group -->
              <div class="row">
                <div class="col-md-5 form-group">
                  <label for="booking_checkin">Ngày nhận phòng<span class="red-star">*</span></label>
                  <input type="text" name="booking_checkin" id="booking_checkin"  class="form-control dpd1 fdate">
                </div>
                <div class="col-md-5 form-group">
                  <label for="booking_checkout">Ngày trả phòng<span class="red-star">*</span></label>
                  <input type="text" name="booking_checkout" id="booking_checkout" class="form-control dpd2 fdate">
                </div>
                <div class="col-md-2 form-group">
                  <strong>Số đêm</strong> : <br><span id="number_night" style="font-weight:bold;margin-top:13px;display:block" >00</span>
                </div>
              </div><!-- /.row -->
              <div class="row">
                <div class="col-md-9 form-group">
                  <label for="booking_checkin">Loại phòng<span class="red-star">*</span></label>
                  <select class="form-control booked_room_id chosen-select" name="booked_room_id[]" >
                    <option value="room1"><strong>Ocean View Dupxle  Pool Villa</strong></option>
                  </select>
                </div>
                <div class="col-md-3 form-group">
                  <label for="booking_checkout">Số lượng phòng<span class="red-star">*</span></label>
                  <select class="form-control booked_room_count" name="booked_room_count[]" >
                    <?php for($i = 1; $i <= 100; $i ++ ){ ?>
                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div><!-- /.row -->
              <div class="form-group">
                <a href="#" title="">
                  <i class="fa fa-plus-square-o"></i> Thêm loại phòng
                </a>
              </div><!-- /.form-group -->
              <div class="row">
                <div class="col-md-9 form-group">
                  <label for="booking_checkin">Giường phụ</label>
                  <input type="text" name="booking_extra_beds" class="form-control" id="booking_extra_beds">
                </div>
                <div class="col-md-3 form-group">
                  <label for="booking_checkout">Số lượng</label>
                  <select class="form-control booked_room_count" name="booked_room_count[]" >
                    <?php for($i = 1; $i <= 5; $i ++ ){ ?>
                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div><!-- /.row -->
              <div class="row">
                <div class="col-md-9 form-group">
                  <label for="booking_checkin">Chi phí khác</label>
                  <input type="text" name="booking_extras_total_fee" class="form-control" id="booking_extras_total_fee">
                </div>
                <div class="col-md-3 form-group">
                  <label for="booking_checkout">Số lượng</label>
                  <select class="form-control" name="booking_extras_total" >
                    <?php for($i = 1; $i <= 5; $i ++ ){ ?>
                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div><!-- /.row -->
              <div class="form-group">            
                <textarea class="form-control" placeholder="Ghi chú" rows="5"></textarea>
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
                  <input type="text" name="" value="" class="form-control" placeholder="">
                  <a href="#" title="">
                    <i class="fa fa-plus-square-o"></i> Thêm tên khách
                  </a>
                </div>
              </div><!-- /.form-group -->
              <div class="row">
                <div class="col-md-6 form-group">
                  <label for="booking_checkin">Số điện thoại<span class="red-star">*</span></label>
                  <input type="text" name="" value="" class="form-control" placeholder="">
                </div>
                <div class="col-md-6 form-group">
                  <label for="booking_checkout">Email<span class="red-star">*</span></label>
                  <input type="text" name="" value="" class="form-control" placeholder="">
                </div>
              </div><!-- /.row -->
              <div class="row">
                <div class="col-md-6 form-group">
                  <label for="booking_checkin">Người lớn<span class="red-star">*</span></label>
                  <input type="text" name="" value="" class="form-control" placeholder="">
                </div>
                <div class="col-md-6 form-group">
                  <label for="booking_checkout">Trẻ em<span class="red-star">*</span></label>
                  <input type="text" name="" value="" class="form-control" placeholder="">
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
                    <input type="radio" name="radio" value="1">
                    <strong>Chuyển khoản ngân hàng</strong>
                  </label>
                </div><!-- /.col-md-4 form-group -->
                <div class="col-md-3 form-group">
                  <label class="radio-inline">
                    <input type="radio" name="radio" value="2">
                    <strong>Thanh toán tại Vp HOSPI</strong>
                  </label>
                </div><!-- /.col-md-4 form-group -->
                <div class="col-md-3 form-group">
                  <label class="radio-inline">
                    <input type="radio" name="radio" value="3">
                    <strong>Thanh toán tại nhà</strong>
                  </label>
                </div><!-- /.col-md-4 form-group -->
              </div><!-- /.row -->
              <span>Quý khách vui lòng chọn ngân hàng</span>
              <div class="form-group">
                <div class="row">
                  <div class="col-sm-3 col-xs-12">
                    <div>
                      <label class="radio-inline">
                        <input type="radio" name="bank" value="1"> Ngân hàng Quân Đội
                      </label>
                    </div>
                    <div>
                      <label class="radio-inline">
                        <input type="radio" name="bank" value="2"> Ngân hàng Đông Á
                      </label>
                    </div>
                    <div>
                      <label class="radio-inline">
                        <input type="radio" name="bank" value="3"> Ngân hàng Vietin Bank
                      </label>
                    </div>
                    <div>
                      <label class="radio-inline">
                        <input type="radio" name="bank" value="4"> Agribank
                      </label>
                    </div>
                    <div>
                      <label class="radio-inline">
                        <input type="radio" name="bank" value="5"> Ngân hàng VCB
                      </label>
                    </div>
                    <div>
                      <label class="radio-inline">
                        <input type="radio" name="bank" value="5"> Ngân hàng HSBC
                      </label>
                    </div>
                  </div>

                  <div class="col-sm-3 col-xs-12">
                    <div>
                      <label class="radio-inline">
                        <input type="radio" name="bank" value="6"> Ngân hàng Quân Đội
                      </label>
                    </div>
                    <div>
                      <label class="radio-inline">
                        <input type="radio" name="bank" value="7"> Ngân hàng Đông Á
                      </label>
                    </div>
                    <div>
                      <label class="radio-inline">
                        <input type="radio" name="bank" value="8"> Ngân hàng Vietin Bank
                      </label>
                    </div>
                    <div>
                      <label class="radio-inline">
                        <input type="radio" name="bank" value="10"> Agribank
                      </label>
                    </div>
                    <div>
                      <label class="radio-inline">
                        <input type="radio" name="bank" value="11"> Ngân hàng VCB
                      </label>
                    </div>
                    <div>
                      <label class="radio-inline">
                        <input type="radio" name="bank" value="12"> Ngân hàng HSBC
                      </label>
                    </div>
                  </div>
                </div>
              </div><!-- /.form-group -->
              <div class="form-group">
                <ul class="no-style bank-account">
                  <li>
                    <strong>Ngân Hàng:</strong>
                    <span>Ngân Hàng Quân Đội (MBBank)</span>
                  </li>
                  <li>
                    <strong>Chi Nhánh:</strong>
                    <span>Bến Thành, Tp. Hồ Chí Minh</span>
                  </li>
                  <li>
                    <strong>Tên Tài Khoản:</strong>
                    <span>VÕ ĐÌNH CHÍ</span>
                  </li>
                  <li>
                    <strong>Số Tài Khoản:</strong>
                    <span>1460103608001</span>
                  </li>
                </ul>
              </div><!-- /.form-group -->
            </div><!-- /.col-md-12 -->
          </div><!-- /.panel-body -->
        </div><!-- /.panel panel-default -->

      </div>

      <div class="col-md-4 col-xs-12 pull-right">
        <div class="panel panel-default">
          <div class="panel-heading"><strong>Thông tin đơn phòng</strong></div><!-- /.panel-heading -->
          <div class="box">
            <div class="box_body">
              <ul class="order-summary">
                <li>
                  SIX SENSES CÔN ĐẢO RESORT
                </li>
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
                    <input type="input" name="" class="form-control" placeholder="HP2017">
                    <i style="color: #999999; display:block; font-size: 12px; margin-top: 3px;">Mã: HP2017 được giảm giá: 360,000đ </i>
                  </div>
                  <div class="v">
                    <button style="margin-left:0; margin-bottom: 0; padding: 5px 16px;" type="submit" class="btn btn-action btn-block chk">ÁP DỤNG</button>
                  </div>
                  <div class="clearfix">
                  </div>
                </li>
                <li style="border: none;">
                  <strong class="k">
                  Tổng thanh toán
                  </strong>
                  <strong class="v purple">360,000 VND</strong>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/adminbooking.js"></script>
<script type="text/javascript">
  function parseDate(str) {
      var mdy = str.split('/')
      return new Date(mdy[2],  mdy[1], mdy[0]-1);
  }
  
  function daydiff(first, second) {
      return (second-first)/(1000*60*60*24);
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
    $(document).ready(function(){
        var nowTemp = new Date();
        var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
        var checkin = $('.dpd1').datepicker({
            format: fmt,
            language: 'vi',
            onRender: function(date) {
                return date.valueOf() < now.valueOf() ? 'disabled' : '';
            }
        }).on('changeDate', function(ev) {
            if (ev.date.valueOf() > checkout.date.valueOf()) {
                var newDate = new Date(ev.date)
                newDate.setDate(newDate.getDate() + 1);
                checkout.setValue(newDate);              
            }
            checkin.hide();
            $('.dpd2')[0].focus();
            if($('.dpd2').val() != '' && $('.dpd1').val() != '' ){
              var number_night = parseInt(daydiff(parseDate($('.dpd1').val()), parseDate($('.dpd2').val())));
              var zero2 = new Padder(2);            
              $('#number_night').html(zero2.pad(number_night));
            }
        }).data('datepicker');
        var checkout = $('.dpd2').datepicker({
            format: fmt,
            onRender: function(date) {
                return date.valueOf() <= checkin.date.valueOf() ? 'disabled' : '';
            }
        }).on('changeDate', function(ev) {
            checkout.hide();
            if($('.dpd2').val() != '' && $('.dpd1').val() != '' ){
              var number_night = parseInt(daydiff(parseDate($('.dpd1').val()), parseDate($('.dpd2').val())));
              var zero2 = new Padder(2);            
              $('#number_night').html(zero2.pad(number_night));
            }
  
        }).data('datepicker');
      $('#hotel_city').change(function(){
        $.ajax({
          url : '<?php echo base_url()."admin/hotelajaxcalls/hotel_by_city"; ?>?hotel_city=' + $(this).val(),
          type : "GET",
          dataType : 'html',
          success : function(data){
            $('#booking_item').html(data).trigger("chosen:updated");
          }        
  
        })
      });
    });
</script>
<style type="text/css">
  .datepicker{
  left: 20px !important;
  margin-top: 70px !important;
  }
</style>