
<div class="panel panel-default">
  <div class="panel-heading"><?php echo $header_title; ?></div>
  <div class="clearfix"></div>
  <?php if(@$addpermission && !empty($add_link)){ ?>
   <a style="margin-left:15px;margin-top:10px;" href="<?php echo $add_link; ?>?<?php if($params['room_hotel']) echo "room_hotel=".$params['room_hotel']; ?>" class="btn btn-success"><i class="glyphicon glyphicon-plus-sign"></i> Thêm mới</a>
  <?php } ?>
  <div style="clear:both"></div>
   <div class="panel-body" style="padding-top:5px;">
   	<div class="panel panel-default" style="margin-bottom:5px !important">
       
        <div class="panel-body">
          <form class="form-inline" id="searchForm" role="form" method="GET" action="<?php echo base_url() .'admin/hotels/rooms'; ?>">
            <div class="form-group" style="width:400px;">              
              <select class="form-control chosen-select" name="room_hotel" id="room_hotel">
                <option value="">Khách sạn</option>
                <?php foreach($hotels as $h){ ?>
                <option value="<?php echo $h->hotel_id;?>" <?php if($h->hotel_id == $params['room_hotel']){echo "selected";} ?>> <?php echo $h->hotel_title;?> </option>
                <?php } ?>
              </select>
            </div>
            
            <div class="form-group">              
              <select class="form-control" name="room_status" id="room_status">
                <option value="">Trạng thái</option>
                <option value="Yes" <?php echo isset($params['hotel_status']) && 'Yes' == $params['hotel_status'] ? "selected" : "";  ?>>Hiển thị</option>
                <option value="No" <?php echo isset($params['Yes']) && 'No' == $params['Yes'] ? "selected" : "";  ?>>Ẩn</option>                
              </select>
            </div>             
            <div class="form-group">              
              <input type="text" class="form-control" placeholder="Tên loại phòng" name="room_title" value="<?php echo isset($params['room_title']) ? $params['room_title'] : ""; ?>">
            </div>                                     
            <button type="submit" class="btn btn-primary btn-sm">Lọc</button>
          </form>         
        </div>
      </div>
     <div class="box">       
      <form class="form-inline" id="searchForm" role="form" method="POST" action="<?php echo base_url() .'admin/hotels/rooms/updateorder'; ?>">
     <div class="btn-group pull-right">
                <button type="submit" class="btn btn-primary" style="margin-right: 10px;">Cập nhật thứ tự</button><a style="margin-bottom: 5px;" href="javascript: multiDelfunc('<?php echo  base_url(); ?>admin/hotelajaxcalls/delMultipleRooms', 'checkboxcls')" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i> Xóa mục đã chọn</a> 
                </div>
                <div class="clearfix"></div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="text-center"><?php echo createPagination($info);?></div>
          <table class="table table-bordered" id="table-list-data">
            <tr>
              <th style="width: 1%">
              	<input class="all" type="checkbox" value="" id="select_all">
              </th>
              <th style="width: 1%">
              	#
              </th>    
              <?php if($params['room_hotel']){ ?>      
              <input type="hidden" name="room_hotel" value="<?php echo $params['room_hotel']; ?>">         
              <th>Thứ tự</th>
              <?php } ?>
              <th>Loại phòng</th>      
              <th>Khách sạn</th>                              
              <th>Người tạo</th>
              <th>Giá</th>
              <th>Phòng trống</th>
              <th width="7%">Hình ảnh</th>
              <th style="white-space: nowrap">Trạng thái</th>
              <th width="1%"></th>
            </tr>
            <tbody>
            <?php if( !empty($content)) {
               $i = 0;
              foreach($content as $item ) {
                $i ++;   
                ?>
              <tr id="row-<?php echo $item->room_id; ?>">
              	<td>
              		<input type="checkbox" name="" class="checkboxcls" value="<?php echo $item->room_id; ?>">
              	</td>
                
                <td class="text-center"><span class="order"><?php echo $i; ?></span></td> 
                <?php if($params['room_hotel']){ ?>                  
                <td>
                  <input type="text" name="room_order[<?php echo $item->room_id; ?>]" class="order form-control" style="width:50px" value="<?php echo $item->room_order; ?>">
                </td>
                <?php } ?>              
                <td>                  
                  <a href="<?php echo base_url() . 'admin/hotels/rooms/manage/'.$item->room_id; ?>" target="_self"><?php echo $item->room_title; ?></a>
                
                </td>
                <td>
                <?php 
                echo $item->hotel_title;
                ?>                  
                </td>
                <td style="white-space: nowrap">
                  <?php 
                  echo $item->ai_first_name. " ".$item->ai_last_name; 
                  ?>
                </td>
                <td  style="white-space: nowrap">
                  
                  <a href="<?php echo base_url() . 'admin/hotels/rooms/prices/'.$item->room_id; ?>" target="_self">Giá phòng</a>
                  
                </td>
                <td  style="white-space: nowrap">
                  
                  <a href="<?php echo base_url() . 'admin/hotels/rooms/availability/'.$item->room_id; ?>" target="_self">Phòng trống</a>
                  
                </td>
                <td  style="white-space: nowrap">
                  <?php 
                  $CI = get_instance();
                  $role = $CI->session->userdata('pt_role');
                  if($role != "supplier"){
                    $role = "admin";
                  }
                  $photocounts =  isset($photoArr[$item->room_id]) ? $photoArr[$item->room_id] : 0;
                  echo "<a href=".base_url().$role."/hotels/roomgallery/".$item->room_id.">Tải hình ảnh (".$photocounts.")</a>";                                   
                  ?>
                </td>                
                <td class="text-center">
                  <?php 
                  if($item->hotel_status == "Yes" || $item->hotel_status == "yes"){
                    echo '<i class="fa fa-check text-success"></i>';
                  }else{
                   echo '<i class="fa fa-times text-danger"></i>';
                  }
                  ?>
                </td> 
                <td style="white-space:nowrap; text-align:right">                                 
                  <a href="<?php echo base_url() . 'admin/hotels/rooms/manage/'.$item->room_id; ?>" class="btn btn-warning btn-sm" target="_self"><i class="fa fa-edit"></i></a>
                  <?php
                  if($deletepermission){
                    $delurl = base_url().'admin/hotelajaxcalls/delRoom';                
                
                  ?>
                  <a onclick="javascript: delfunc('<?php echo $item->room_id; ?>','<?php echo $delurl; ?>')" class="btn btn-danger btn-sm"><i class="fa fa-remove"></i></a>
                  <?php } ?>
                </td>
              </tr> 
             <?php }} else { ?>
            <tr>
              <td colspan="12">Không có dữ liệu.</td>
            </tr>
            <?php } ?>            
          </tbody>
          </table>
            <div class="text-center"><?php echo createPagination($info);?></div>
        </div>     
        </form>   
      </div>
   </div>
 </div>
 <script type="text/javascript">
   $(document).ready(function(){
    $('#room_hotel, #room_status').change(function(){
      $(this).parents('form').submit();
    });
   });
 </script>