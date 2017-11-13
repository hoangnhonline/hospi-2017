<?php 
$roomDetail = $room[0];
?>
<a href="<?php echo base_url(); ?>admin/hotels/rooms?room_hotel=<?php echo $roomDetail->hotel_id; ?>" class="btn btn-default btn-sm">Quay lại</a>
<h3 style="margin-top: 5px;color:#0073aa"><?php echo $roomDetail->room_title; ?> - <?php echo $roomDetail->hotel_title; ?></h3>
<?php echo $errormsg;?>
<div class="panel panel-default">
  <div class="panel-heading">Giá phòng</div>
  <div class="panel-body">
  <form action="" method="POST" >
    <div class="col-md-2">
      <div class="form-group">
        <label class="required">Từ ngày</label>
        <input type="text" placeholder="" name="fromdate" class="form-control input-sm dpd1" value="<?php echo set_value('fromdate'); ?>"/>
      </div>
    </div>
    <div class="col-md-2">
      <div class="form-group">
        <label class="required">Đến ngày</label>
        <input type="text" placeholder="" name="todate" class="form-control input-sm dpd2" value="<?php echo set_value('todate'); ?>"/>
      </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
          <label class="required">Giường phụ</label>
          <select name="isExtraBed" class="form-control input-day input-sm" id="isExtraBed" style="width: 100%">            
            <option value="0" >Không áp dụng</option>
            <option value="1" >Áp dụng</option>
          </select>
        </div>
      </div>
      <div class="col-md-1">
        <div class="form-group">
          <label class="required">Phí giường phụ</label>
          <input type="number" placeholder="" name="bedcharges" class="form-control input-day  input-sm" value="<?php echo $roomDetail->extra_bed_charges;?>" <?php if($roomDetail->extra_bed < 1){ echo "readonly"; } ?> />
        </div>
      </div>
      <div class="col-md-1">
        <div class="form-group">
          <label class="required">Người lớn</label>
          <select name="adult" class="form-control input input-day input-sm" id="">
            <?php for($adults = 1; $adults <= $roomDetail->room_adults; $adults++){ ?>
              <option value="<?php echo $adults; ?>" ><?php echo $adults; ?></option>
            <?php } ?>
          </select>
        </div>
      </div>
      <div class="col-md-1">
        <div class="form-group">
          <label class="required">Trẻ em </label>
          <select name="child" class="form-control input  input-day input-sm" id="">
            <?php for($child = 0; $child <= $roomDetail->room_children; $child++){ ?>
              <option value="<?php echo $child; ?>" ><?php echo $child; ?></option>
              <?php } ?>
          </select>
        </div>
      </div>
      
      <div class="clearfix"></div>
    <div class="">
      <div class="col-md-2" style="width:150px;margin-right: 20px">
        <label class="required">Thứ 2</label>
      <div class="input-group" >

      <input type="number" step="any" name="mon" id="new_mon" class="form-control input input-day-mon  input-sm" placeholder="" style="width:120px;" ><span class="input-group-addon pointer"  onclick="copyPrices('new')"><i class="fa fa-angle-double-right"></i></span>

      </div>

      </div>

      <div class="col-md-1">
        <div class="form-group">
          <label class="required">Thứ 3</label>
          <input type="number" step="any" id="new_tue" name="tue" placeholder="" class="form-control input input-day input-sm"/>
        </div>
      </div>
      <div class="col-md-1">
        <div class="form-group">
          <label class="required">Thứ 4</label>
          <input type="number" step="any" id="new_wed" name="wed" placeholder="" class="form-control input input-day input-sm"/>
        </div>
      </div>
      <div class="col-md-1">
        <div class="form-group">
          <label class="required">Thứ 5</label>
          <input type="number" step="any" id="new_thu" name="thu" placeholder="" class="form-control input input-day input-sm"/>
        </div>
      </div>
      <div class="col-md-1">
        <div class="form-group">
          <label class="required">Thứ 6</label>
          <input type="number" step="any" id="new_fri" name="fri" placeholder="" class="form-control input input-day input-sm"/>
        </div>
      </div>
      <div class="col-md-1">
        <div class="form-group">
          <label class="required">Thứ 7</label>
          <input type="number" step="any" id="new_sat" name="sat" placeholder="" class="form-control input input-day input-sm"/>
        </div>
      </div>
      <div class="col-md-1">
        <div class="form-group">
          <label class="required">Chủ nhật</label>
          <input type="number" step="any" id="new_sun" name="sun" placeholder="" class="form-control input input-day input-sm"/>
        </div>
      </div>
      <div class="col-md-1">
        <div class="form-group">
          <div>&nbsp;</div>
          <input type="hidden" name="action" value="add" />
          <input type="hidden" name="roomid" value="<?php echo $roomid;?>" />
          <input type="hidden" name="dateformat" value="<?php echo $appSettings->dateFormat;?>" />
          <button class="btn btn-primary btn-sm" type="submit" style="margin-top:4px">Thêm</button>
        </div>
      </div>
      <div class="clearfix"></div>
    </div>
    </form>
    <div class="clearfix"></div>      
    <table class="table table-bordered form-horizontal">
      <thead>
        <tr>
          <th>Từ ngày - đến ngày</th>         
          <th class="text-right">Giường phụ</th>     
          <th class="text-right">Thứ 2</th>
          <th class="text-right">Thứ 3</th>
          <th class="text-right">Thứ 4</th>
          <th class="text-right">Thứ 5</th>
          <th class="text-right">Thứ 6</th>
          <th class="text-right">Thứ 7</th>
          <th class="text-right">Chủ nhật</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
      <?php foreach($prices as $p): ?>
        <tr id="tr_<?php echo $p->id;?>">
          <th><?php echo date('d/m/Y', strtotime($p->date_from)); ?> - <?php echo date('d/m/Y', strtotime($p->date_to)); ?></th>          
          <td class="text-right"><?php echo number_format($p->extra_bed_charge);?></td>
         
          <td style="width:120px;" class="text-right"><?php echo number_format($p->mon);?></td>
          <td style="width:120px;" class="text-right"><?php echo number_format($p->tue);?></td>
          <td style="width:120px;" class="text-right"><?php echo number_format($p->wed);?></td>
          <td style="width:120px;" class="text-right"><?php echo number_format($p->thu);?></td>
          <td style="width:120px;" class="text-right"><?php echo number_format($p->fri);?></td>
          <td style="width:120px;" class="text-right"><?php echo number_format($p->sat);?></td>
          <td style="width:120px;" class="text-right"><?php echo number_format($p->sun);?></td>
          <td><span class="btn btn-sm btn-danger delete" id="<?php echo $p->id;?>"><i class="fa fa-trash-o fa-lg"></i>&nbsp;Xóa</span></td>
        </tr>
       <?php endforeach; ?>


      </tbody>
    </table>

  </div>
 
 
</div>
<style>
  .input {
  width:60px;
  }
  .input-day{
    width: 120px;
  }
  .input-day-mon{
    width: 170px;
  }
  .datepicker{
    left: 30px !important;
    margin-top: 60px !important;
  }
</style>
<script type="text/javascript">
$(function(){
  $(".delete").click(function(){
      var id =  $(this).attr('id');
      $.alert.open('confirm', 'Are you sure you want to delete', function(answer) {
         if (answer == 'yes'){
            $.post("<?php echo $delurl;?>", { id: id }, function(theResponse){
            $("#tr_"+id).fadeOut('slow');
         });
       }
        });
    });
  });

function copyPrices(id){
  var mainprice = $("#"+id+"_mon").val();
  $("#"+id+"_tue").val(mainprice);
  $("#"+id+"_wed").val(mainprice);
  $("#"+id+"_thu").val(mainprice);
  $("#"+id+"_fri").val(mainprice);
  $("#"+id+"_sat").val(mainprice);
  $("#"+id+"_sun").val(mainprice);
}

</script>