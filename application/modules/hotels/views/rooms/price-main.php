<div class="panel panel-default" id="p-main">
  <div class="panel-heading" data-toggle="collapse" href="#collapse1">
  <?php if(empty($priceMainDetail)){ ?>
  Thêm giá phòng
  <?php }else{ ?>
    Cập nhật giá phòng
    <?php }
    ?>
  </div>  
  <div class="panel-body panel-collapse <?php if(empty($priceExtraDetail) && empty($priceKmDetail)){ ?> in <?php }else{ echo "collapse"; } ?>" id="collapse1">
  <form action="" method="POST" >  
    <input type="hidden" name="hotel_id" value="<?php echo $roomDetail->hotel_id; ?>">
    <div class="col-md-3">
      <div class="form-group">
        <label class="required">Từ ngày</label>
        <input type="text" placeholder="" name="fromdate" class="form-control input-sm dpd1" value="<?php echo empty($priceMainDetail) ? set_value('fromdate') : date('d/m/Y', strtotime($priceMainDetail->date_from)); ?>"/>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label class="required">Đến ngày</label>
        <input type="text" placeholder="" name="todate" class="form-control input-sm dpd2" value="<?php echo empty($priceMainDetail) ? set_value('todate')  : date('d/m/Y', strtotime($priceMainDetail->date_to)); ?>"/>
      </div>
    </div>
    
    <div class="col-md-3">
        <div class="form-group">
          <label class="required">Giường phụ</label>
          <select name="isExtraBed" class="form-control input-sm" id="isExtraBed" style="width: 100%">         
          <?php if($roomDetail->extra_bed == 0){ ?>   
            <option value="0" >Không áp dụng</option>            
            <?php }else{ ?>
            <option value="1" >Áp dụng</option>  
              <?php } ?>
          </select>
        </div>
      </div>      
      <div class="col-md-3">
        <div class="form-group">
          <label class="required">Phí giường phụ</label>
          <input  placeholder="" name="bedcharges" <?php if($roomDetail->extra_bed == 0) echo "readonly=readonly"; ?> class="form-control input-sm number" value="<?php echo empty($priceMainDetail) ? $roomDetail->extra_bed_charges : $priceMainDetail->extra_bed_charge;?>" <?php if($roomDetail->extra_bed < 1){ echo "readonly"; } ?> />
        </div>
      </div>      
      
      <div class="clearfix"></div>
    <div class="">
      <div class="col-md-2" style="width:150px;margin-right: 20px">
        <label class="required">Thứ 2</label>
      <div class="input-group" >
      
      <input name="mon" id="new_mon" class="form-control input input-day-mon  input-sm number price-copy" placeholder="" style="width:120px;" value="<?php echo @$priceMainDetail->mon; ?>" ><span class="input-group-addon pointer copyPrice"><i class="fa fa-angle-double-right"></i></span>

      </div>

      </div>

      <div class="col-md-1">
        <div class="form-group">
          <label class="required">Thứ 3</label>
          <input id="new_tue" name="tue" value="<?php echo @$priceMainDetail->tue; ?>" placeholder="" class="form-control input input-day input-sm number week"/>
        </div>
      </div>
      <div class="col-md-1">
        <div class="form-group">
          <label class="required">Thứ 4</label>
          <input id="new_wed" name="wed" value="<?php echo @$priceMainDetail->wed; ?>" placeholder="" class="form-control input input-day input-sm number week"/>
        </div>
      </div>
      <div class="col-md-1">
        <div class="form-group">
          <label class="required">Thứ 5</label>
          <input id="new_thu" name="thu" value="<?php echo @$priceMainDetail->thu; ?>" placeholder="" class="form-control input input-day input-sm number week"/>
        </div>
      </div>
      <div class="col-md-1">
        <div class="form-group">
          <label class="required">Thứ 6</label>
          <input id="new_fri" name="fri" value="<?php echo @$priceMainDetail->fri; ?>" placeholder="" class="form-control input input-day input-sm number week"/>
        </div>
      </div>
      <div class="col-md-1">
        <div class="form-group">
          <label class="required">Thứ 7</label>
          <input id="new_sat" name="sat" value="<?php echo @$priceMainDetail->sat; ?>" placeholder="" class="form-control input input-day input-sm number week"/>
        </div>
      </div>
      <div class="col-md-1">
        <div class="form-group">
          <label class="required">Chủ nhật</label>
          <input id="new_sun" name="sun" value="<?php echo @$priceMainDetail->sun; ?>" placeholder="" class="form-control input input-day input-sm number week"/>
        </div>
      </div>
      <div class="col-md-2">
        <div class="form-group">
          <div>&nbsp;</div>
          <input type="hidden" name="action" value="<?php echo empty($priceMainDetail) ? "add" : "update"; ?>" />
          <?php if(!empty($priceMainDetail)){ ?>
            <input type="hidden" name="price_id" value="<?php echo $priceMainDetail->id; ?>">
            <?php } ?>
          <input type="hidden" name="roomid" value="<?php echo $roomid;?>" />
          <input type="hidden" name="type" value="1" />
          <input type="hidden" name="dateformat" value="<?php echo $appSettings->dateFormat;?>" />
          
          <button class="btn btn-primary btn-sm" type="submit" style="margin-top:4px"><?php  echo empty($priceMainDetail) ? "Thêm" : "Cập nhật" ;?></button>
          <?php if(!empty($priceMainDetail)){ ?>
            <a style="margin-top:5px" class="btn btn-default btn-sm" href="<?php echo base_url() . 'admin/hotels/rooms/prices/'.$roomDetail->room_id; ?>#p_main" onclick="return confirm('Chắc chắn hủy?');">Hủy</a>
          <?php } ?>
        </div>
      </div>
      <div class="clearfix"></div>
    </div>
    </form>
    <div class="clearfix"></div>      
    <table class="table table-bordered form-horizontal">
      <thead>
        <tr>
          <th style="white-space:nowrap">Từ ngày - đến ngày</th>         
          <th class="text-right">Giường phụ</th>     
          <th class="text-right">Thứ 2</th>
          <th class="text-right">Thứ 3</th>
          <th class="text-right">Thứ 4</th>
          <th class="text-right">Thứ 5</th>
          <th class="text-right">Thứ 6</th>
          <th class="text-right">Thứ 7</th>
          <th class="text-right">Chủ nhật</th>
          <th class="text-right">Cập nhật</th>    
          <th ></th>
        </tr>
      </thead>
      <tbody>
      <?php foreach($prices as $p): 
      if($p->type == 1):
      	?>
        <tr id="tr_<?php echo $p->id;?>">
          <th style="white-space:nowrap"><?php echo date('d/m/Y', strtotime($p->date_from)); ?> - <?php echo date('d/m/Y', strtotime($p->date_to)); ?></th>          
          <td class="text-right"><?php echo number_format($p->extra_bed_charge);?></td>
         
          <td style="width:120px;" class="text-right"><?php echo number_format($p->mon);?></td>
          <td style="width:120px;" class="text-right"><?php echo number_format($p->tue);?></td>
          <td style="width:120px;" class="text-right"><?php echo number_format($p->wed);?></td>
          <td style="width:120px;" class="text-right"><?php echo number_format($p->thu);?></td>
          <td style="width:120px;" class="text-right"><?php echo number_format($p->fri);?></td>
          <td style="width:120px;" class="text-right"><?php echo number_format($p->sat);?></td>
          <td style="width:120px;" class="text-right"><?php echo number_format($p->sun);?></td>
          <td style="white-space:nowrap"><?php echo date('d/m/Y H:i', strtotime($p->updated_at)); ?><br>
          <?php echo $p->ai_first_name. " ". $p->ai_last_name; ?></td>  
          <td style="white-space:nowrap">
          <a href="<?php echo base_url() . 'admin/hotels/rooms/prices/'.$roomDetail->room_id; ?>?price_id=<?php echo $p->id; ?>#p_main" class="btn btn-warning btn-sm" ><i class="fa fa-edit"></i></a>
          <span class="btn btn-sm btn-danger delete" id="<?php echo $p->id;?>"><i class="fa fa-trash-o fa-lg"></i></span>
          </td>
        </tr>
       <?php 
       endif;
       endforeach; ?>


      </tbody>
    </table>

  </div>
 
 
</div>