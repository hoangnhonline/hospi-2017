<script type="text/javascript">
  $(function(){
     var room = $("#roomid").val();
     $(".submitfrm").click(function(){
       var submitType = $(this).prop('id');

        for ( instance in CKEDITOR.instances )

      {

          CKEDITOR.instances[instance].updateElement();

      }
               $(".output").html("");
                $('html, body').animate({

                scrollTop: $('body').offset().top

                }, 'slow');
       if(submitType == "add"){
       url = "<?php echo base_url();?>admin/hotels/rooms/add" ;

       }else{
       url = "<?php echo base_url();?>admin/hotels/rooms/manage/"+room;

       }

       $.post(url,$(".room-form").serialize() , function(response){
          if($.trim(response) != "done"){
          $(".output").html(response);
          }else{
             window.location.href = "<?php echo base_url().$adminsegment.'/hotels/rooms/'?>" + '?room_hotel=' + $('#hotelid').val();
          }

          });

     })



  })
</script>
<a href="<?php echo base_url(); ?>admin/hotels/rooms?room_hotel=<?php if(isset($room_hotel)){ echo $room_hotel;}else{ echo @$rdata[0]->room_hotel; } ?>" class="btn btn-default btn-sm">Quay lại</a>
<h3 class="margin-top-0"><?php echo $headingText;?></h3>
<div class="output"></div>
<form class="form-horizontal room-form" method="POST" action="" onsubmit="return false;" >
  <div class="panel panel-default">
    <ul class="nav nav-tabs nav-justified" role="tablist">
      <li class="active"><a href="#GENERAL" data-toggle="tab">Thông tin chung</a></li>
      <li class=""><a href="#AMENITIES" data-toggle="tab">Tiện nghi</a></li>
      <li class=""><a href="#TRANSLATE" data-toggle="tab">Dịch</a></li>
    </ul>
    <div class="panel-body">
      <br>
      <div class="tab-content form-horizontal">
        <div class="tab-pane wow fadeIn animated active in" id="GENERAL">
          <div class="clearfix"></div>
          <div class="row form-group">
            <label class="col-md-2 control-label text-left">Loại phòng</label>
            <div class="col-md-6">
              <input class="form-control" Placeholder="Nhập tên loại phòng" type="text" name="title" value="<?php echo @$rdata[0]->room_title;?>" />
            </div>
          </div>
           <div class="row form-group">
            <label class="col-md-2 control-label text-left">Tên khách sạn</label>
            <div class="col-md-6">             
              <select data-placeholder="Hotel Name" class="chosen-select" name="hotelid" id="hotelid" >
                <option value="">--</option>
                <?php foreach($hotels as $h){ ?>
                <option value="<?php echo $h->hotel_id;?>" <?php if($h->hotel_id == @$rdata[0]->room_hotel || (isset($room_hotel) && $room_hotel == $h->hotel_id)) { echo "selected"; } ?>> <?php echo $h->hotel_title;?> </option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="row form-group">
            <label class="col-md-2 control-label text-left">Trạng thái</label>
            <div class="col-md-2">
              <select class="form-control" name="roomstatus">
                <option value="Yes" <?php if(@$rdata[0]->room_status == 'Yes'){echo "selected";}?> >Hiển thị</option>
                <option value="No" <?php if(@$rdata[0]->room_status == 'No'){echo "selected";}?> >Ẩn</option>
              </select>
            </div>
          </div>
          <input type="hidden" name="roomtype">
         
          <div class="row form-group">
            <label class="col-md-2 control-label text-left">Mô tả loại phòng</label>
            <div class="col-md-10">
              <?php $this->ckeditor->editor('roomdesc', @$rdata[0]->room_desc, $ckconfig,'roomdesc'); ?>
            </div>
          </div>
          <input type="hidden" name="basicprice">
          
          <div class="row form-group">
            <label class="col-md-2 control-label text-left">Ăn sáng ?</label>
            <div class="col-md-2">
              <select class="form-control" name="breakfast">
                <option value="Yes" <?php if(@$rdata[0]->breakfast == 'Yes'){echo "selected";}?> >Có</option>
                <option value="No" <?php if(@$rdata[0]->breakfast == 'No'){echo "selected";}?> >Không</option>
              </select>
            </div>
          </div>
          <div class="row form-group">
            <label class="col-md-2 control-label text-left">Số phòng</label>
            <div class="col-md-2">
              <input class="form-control" Placeholder="" type="number" name="quantity" value="<?php echo @$rdata[0]->room_quantity;?>" />
            </div>
          </div>
          <div class="row form-group">
            <label class="col-md-2 control-label text-left">Số đêm nhỏ nhất</label>
            <div class="col-md-2">
              <input class="form-control" Placeholder="" type="number" min=1 name="minstay" value="<?php echo $rdata[0]->room_min_stay ? $rdata[0]->room_min_stay : 1;?>" />
            </div>
          </div>
          <div class="row form-group">
            <label class="col-md-2 control-label text-left">Người lớn tối đa</label>
            <div class="col-md-2">
              <input class="form-control" type="number" placeholder="" name="adults"  value="<?php echo @$rdata[0]->room_adults;?>">
            </div>
          </div>
          <div class="row form-group">
            <label class="col-md-2 control-label text-left">Trẻ em tối đa</label>
            <div class="col-md-2">
              <input class="form-control" type="number" placeholder="" name="children"  value="<?php echo @$rdata[0]->room_children;?>">
            </div>
          </div>
          <div class="row form-group">
            <label class="col-md-2 control-label text-left">Số giường phụ</label>
            <div class="col-md-2">
              <input class="form-control" type="number" placeholder="" name="extrabeds"  value="<?php echo @$rdata[0]->extra_bed;?>">
            </div>
          </div>
          <div class="row form-group">
            <label class="col-md-2 control-label text-left">Phí giường phụ</label>
            <div class="col-md-2">
              <input class="form-control number" placeholder="" name="bedcharges"  value="<?php echo @$rdata[0]->extra_bed_charges;?>">
            </div>
          </div>
        </div>
        <div class="tab-pane wow fadeIn animated in" id="AMENITIES">
          <div class="row form-group">
            <div class="col-md-12">
              <div class="col-md-4">
                <label class="pointer"><input class="all" type="checkbox" name="" value="" id="select_all" > Chọn tất cả</label>
              </div>
              <div class="clearfix"></div>
              <hr>
              <div class="clearfix"></div>
              <?php $roomamenity = explode(",",@$rdata[0]->room_amenities);
                $ramenities = pt_get_hsettings_data("ramenities");
                foreach($ramenities as $ramenity){ ?>
              <div class="col-md-4">
                <label class="pointer"><input class="checkboxcls" <?php if($submittype == "add"){ if( $ramenity->sett_selected == "1"){echo "checked";} }else{ if(in_array($ramenity->sett_id,$roomamenity)){ echo "checked"; } } ?> type="checkbox" name="roomamenities[]" value="<?php echo $ramenity->sett_id;?>"  > <?php echo $ramenity->sett_name;?></label>
              </div>
              <?php } ?>
            </div>
          </div>
        </div>
        <div class="tab-pane wow fadeIn animated in" id="TRANSLATE">
          <?php foreach($languages as $lang => $val){ if($lang != "vi"){ @$trans = getBackRoomTranslation($lang,@$rdata[0]->room_id); ?>
          <div class="panel panel-default">
            <div class="panel-heading"><img src="<?php echo PT_LANGUAGE_IMAGES.$lang.".png"?>" height="20" alt="" /> <?php echo $val['name']; ?></div>
            <div class="panel-body">
              <!--<div class="row form-group">
                <label class="col-md-2 control-label text-left">Room Name</label>
                <div class="col-md-4">
                    <input name='<?php echo "translated[$lang][title]"; ?>' type="text" placeholder="Room Name" class="form-control" value="<?php echo @$trans[0]->trans_title;?>" />
                </div>
                </div>-->
              <div class="row form-group">
                <label class="col-md-2 control-label text-left">Room Description</label>
                <div class="col-md-10">
                  <?php $this->ckeditor->editor("translated[$lang][desc]", @$trans[0]->trans_desc, $ckconfig,"translated[$lang][desc]"); ?>
                </div>
              </div>
            </div>
          </div>
          <?php } } ?>
        </div>
      </div>
    </div>
    <div class="panel-footer">
      <input type="hidden" id="roomid" name="roomid" value="<?php echo @$rdata[0]->room_id;?>" />
      <input type="hidden" name="oldquantity" value="<?php echo @$rdata[0]->room_quantity;?>" />
      <input type="hidden" name="submittype" value="<?php echo $submittype;?>" />
      <button class="btn btn-primary submitfrm" id="<?php echo $submittype; ?>">Lưu</button>
    </div>
  </div>
</form>