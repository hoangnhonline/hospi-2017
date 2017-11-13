<div class="panel panel-default">
    <div class="panel-heading">
      <span class="panel-title pull-left">Tạo Booking</span>
      <input type="hidden" id="currenturl" value="<?php echo current_url();?>" />
      <input type="hidden" id="baseurl" value="<?php echo base_url().$this->uri->segment(1);?>" />
      <div class="clearfix"></div>
    </div>
    <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data" >
    <div class="panel-body">     
      <div class="col-md-8">
        
          <div class="panel panel-default">
            <div class="panel-heading"><strong>Thông tin booking</strong></div>
            <div class="panel-body">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="hotel_city">Tỉnh/TP<span class="red-star">*</span></label>
                  <select class="form-control chosen-select" name="hotel_city" id="hotel_city">
                    <option value="">-- chọn --</option>
                    <?php foreach( $locations as $location ){ ?>
                    <option value="<?php echo $location->id; ?>" <?php echo isset($params['hotel_city']) && $location->id == $params['hotel_city'] ? "selected" : "";  ?>><?php echo $location->location; ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="booking_item">Ngày nhận phòng<span class="red-star">*</span></label>
                  <select class="form-control chosen-select" name="booking_item" id="booking_item">
                   
                  </select>
                </div>
                <div class="row">
                <div class="col-md-5 form-group">
                  <label for="booking_checkin">Ngày nhận phòng<span class="red-star">*</span></label>
                  <input type="text" name="booking_checkin" id="booking_checkin"  class="form-control dpd1 fdate">
                </div>
                <div class="col-md-5">
                  <label for="booking_checkout">Ngày trả phòng<span class="red-star">*</span></label>
                  <input type="text" name="booking_checkout" id="booking_checkout" class="form-control dpd2 fdate">
                </div>
                <div class="col-md-2">
                  <strong>Số đêm</strong> : <br><span id="number_night" style="font-weight:bold;margin-top:13px;display:block" >00</span>
                </div>
                </div>  
                <div class="row">
                  <div class="col-md-9 form-group">
                    <label for="booking_checkin">Loại phòng<span class="red-star">*</span></label>
                    <select class="form-control booked_room_id" name="booked_room_id[]" >
                   
                    </select>
                  </div>
                  <div class="col-md-3">
                    <label for="booking_checkout">Số phòng<span class="red-star">*</span></label>
                    <select class="form-control booked_room_count" name="booked_room_count[]" >
                      <?php for($i = 1; $i <= 100; $i ++ ){ ?>
                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                        <?php } ?>
                    </select>
                  </div>                 
                </div> 

                <div class="row">
                  <div class="col-md-9 form-group">
                    <label for="booking_checkin">Giường phụ</label>
                    <input type="text" name="booking_extra_beds" class="form-control" id="booking_extra_beds">
                  </div>
                  <div class="col-md-3">
                    <label for="booking_checkout">Số lượng</label>
                    <select class="form-control booked_room_count" name="booked_room_count[]" >
                      <?php for($i = 1; $i <= 5; $i ++ ){ ?>
                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                        <?php } ?>
                    </select>
                  </div>                 
                </div> 

                <div class="row">
                  <div class="col-md-9 form-group">
                    <label for="booking_checkin">Chi phí khác</label>
                    <input type="text" name="booking_extras_total_fee" class="form-control" id="booking_extras_total_fee">
                  </div>
                  <div class="col-md-3">
                    <label for="booking_checkout">Số lượng</label>
                    <select class="form-control" name="booking_extras_total" >
                      <?php for($i = 1; $i <= 5; $i ++ ){ ?>
                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                        <?php } ?>
                    </select>
                  </div>                 
                </div>    
                <div class="form-group">            
                <textarea class="form-control" placeholder="Ghi chú" rows="5"></textarea>
                </div>
              </div><!-- col-md-12-->
            </div>
          </div>
   	    
      </div>
      <div class="col-md-4 pull-right">
          <div class="panel panel-default">
            <div class="panel-heading"><strong>Thông tin đơn phòng</strong></div>
            <div class="panel-body">
              
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