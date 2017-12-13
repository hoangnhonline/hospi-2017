
<div class="panel panel-default">
  <div class="panel-heading"><?php echo $header_title; ?></div>
  <div class="clearfix"></div>
  <?php if(@$addpermission && !empty($add_link)){ ?>
   <a style="margin-left:15px;margin-top:10px;" href="<?php echo $add_link; ?>" class="btn btn-success"><i class="glyphicon glyphicon-plus-sign"></i> Thêm mới</a>
  <?php } ?>
  <div style="clear:both"></div>
   <div class="panel-body" style="padding-top:5px;">
   	<div class="panel panel-default" style="margin-bottom:5px !important">
       
        <div class="panel-body">
          <form class="form-inline" id="searchForm" role="form" method="GET" action="<?php echo base_url() .'admin/hotels'; ?>">
            <div class="form-group" style="width:200px;">              
              <select class="form-control chosen-select" name="hotel_city" id="hotel_city">
                <option value="">Tỉnh/TP</option>
                <?php foreach( $locations as $location ){ ?>
                <option value="<?php echo $location->id; ?>" <?php echo isset($params['hotel_city']) && $location->id == $params['hotel_city'] ? "selected" : "";  ?>><?php echo $location->location; ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group" style="width:100px;">              
              <select class="form-control" name="hotel_stars" id="hotel_stars">
                <option value="">Số sao</option>
                <option value="1" <?php echo isset($params['hotel_stars']) && 1 == $params['hotel_stars'] ? "selected" : "";  ?>>1</option>
                <option value="2" <?php echo isset($params['hotel_stars']) && 2 == $params['hotel_stars'] ? "selected" : "";  ?>>2</option>
                <option value="3" <?php echo isset($params['hotel_stars']) && 3 == $params['hotel_stars'] ? "selected" : "";  ?>>3</option>
                <option value="4" <?php echo isset($params['hotel_stars']) && 4 == $params['hotel_stars'] ? "selected" : "";  ?>>4</option>
                <option value="5" <?php echo isset($params['hotel_stars']) && 5 == $params['hotel_stars'] ? "selected" : "";  ?>>5</option>
                <option value="6" <?php echo isset($params['hotel_stars']) && 6 == $params['hotel_stars'] ? "selected" : "";  ?>>6</option>
                <option value="7" <?php echo isset($params['hotel_stars']) && 7 == $params['hotel_stars'] ? "selected" : "";  ?>>7</option>
                
              </select>
            </div>
            <div class="form-group">              
              <select class="form-control" name="hotel_status" id="hotel_status">
                <option value="">Trạng thái</option>
                <option value="Yes" <?php echo isset($params['hotel_status']) && 'Yes' == $params['hotel_status'] ? "selected" : "";  ?>>Hiển thị</option>
                <option value="No" <?php echo isset($params['hotel_status']) && 'No' == $params['hotel_status'] ? "selected" : "";  ?>>Ẩn</option>                
              </select>
            </div>             
            <div class="form-group">              
              <input type="text" class="form-control" placeholder="Tên khách sạn" name="hotel_title" value="<?php echo isset($params['hotel_title']) ? $params['hotel_title'] : ""; ?>">
            </div> 
            <div class="form-group">            
              <label><input type="checkbox" name="hotel_is_featured" id="hotel_is_featured" value="Yes" <?php echo isset($params['hotel_is_featured']) && $params['hotel_is_featured'] == 'Yes' ? "checked=checked" : ""; ?>> Nổi bật</label>              
            </div>                        
            <button type="submit" class="btn btn-primary btn-sm">Lọc</button>
          </form>         
        </div>
      </div>
     <div class="box">       
     <div class="btn-group pull-right">
                <a style="margin-bottom: 5px;" href="javascript: multiDelfunc('<?php echo  base_url(); ?>admin/hotelajaxcalls/delMultipleHotels', 'checkboxcls')" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i> Xóa mục đã chọn</a> 
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
              <th style="width: 1%">
                
              </th>            
              <th width="80px">Hình ảnh</th>
              <th>Tên khách sạn</th>      
              <th width="80px">Số sao</th>                              
              <th>Người tạo</th>
              <th>Tỉnh/TP</th>
              <th>Hình ảnh</th>              
              <th width="7%">Thứ tự</th>
              <th style="white-space: nowrap">Trạng thái</th>
              <th width="1%"></th>
            </tr>
            <tbody>
            <?php if( !empty($content)) {
               $i = 0;
              foreach($content as $item ) {
                $i ++;   
                ?>
              <tr id="row-<?php echo $item->hotel_id; ?>">
              	<td>
              		<input type="checkbox" name="" class="checkboxcls" value="<?php echo $item->hotel_id; ?>">
              	</td>
                <td><span class="order"><?php echo $i; ?></span></td>      
                <td>
                  <?php 
                   $url = base_url()."admin/hotelajaxcalls/update_featured";
                  if($item->hotel_is_featured == "yes"){
                    echo '<span class="star fa fa-star fstar"  data-url='.$url.' style="cursor: pointer;" data-featured="no" id="'.$item->hotel_id.'"></span>';
                  }else{
                    echo '<span class="fa fa-star-o fstar"  data-url='.$url.' style="cursor: pointer;" data-featured="yes" id="'.$item->hotel_id.'" ></span>';
                  }
                  ?>
                </td>          
                <td class="zoom_img">
                  <img class="img-thumbnail" width="120" src="<?php echo '../../'.PT_HOTELS_SLIDER_THUMBS_UPLOAD.$item->thumbnail_image; ?>" alt="<?php echo $item->hotel_title; ?>" title="<?php echo $item->hotel_title; ?>" />
                </td>
                <td>                  
                  <a href="<?php echo base_url() . 'admin/hotels/manage/'.$item->hotel_slug; ?>" target="_self"><?php echo $item->hotel_title; ?></a>
                
                </td>
                <td>
                  <?php 
                  $res = "";

              for($stars = 1; $stars <= 5; $stars++){

                if($stars <= $item->hotel_stars){
                  $res .= PT_STARS_ICON;
                }else{
                  $res .= PT_EMPTY_STARS_ICON;
                }

              }
              

            echo  $res;
                  ?>
                </td>
                <td style="white-space: nowrap">
                  <?php 
                  echo $item->ai_first_name. " ".$item->ai_last_name; 
                  ?>
                </td>
                <td  style="white-space: nowrap">
                  <?php 
                  echo isset($locationArr[$item->hotel_city]) ? $locationArr[$item->hotel_city] : "";
                  ?>
                </td>
                <td  style="white-space: nowrap">
                  <?php 
                  $CI = get_instance();
                  $role = $CI->session->userdata('pt_role');
                  if($role != "supplier"){
                    $role = "admin";
                  }

                  $photocounts =  isset($photoArr[$item->hotel_id]) ? $photoArr[$item->hotel_id] : 0;
                  echo "<a href=".base_url().$role."/hotels/gallery/".$item->hotel_slug.">Tải hình ảnh (".$photocounts.")</a>";
                  ?>
                </td>                
                <td>
                  <?php 
                    $url = base_url()."admin/hotelajaxcalls/update_hotel_order";

echo '<input class="form-control input-sm" data-url='.$url.' type="number" id="order_'.$item->hotel_id.'" value='.$item->hotel_order.' min="1"  onblur="updateOrder($(this).val(),'.$item->hotel_id.','.$item->hotel_order.')" />';
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
                  <a href="<?php echo base_url() . 'admin/hotels/manage/'.$item->hotel_slug; ?>" class="btn btn-warning btn-sm" target="_self"><i class="fa fa-edit"></i></a>
                  <?php
                  if($deletepermission){
                    $delurl = base_url().'admin/hotelajaxcalls/delHotel';                
                
                  ?>
                  <a onclick="javascript: delfunc('<?php echo $item->hotel_id; ?>','<?php echo $delurl; ?>')" class="btn btn-danger btn-sm"><i class="fa fa-remove"></i></a>
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
        </div>        
      </div>
   </div>
 </div>
 <script type="text/javascript">
   $(document).ready(function(){
    $('#hotel_city, #hotel_stars, #hotel_status').change(function(){
      $(this).parents('form').submit();
    });
    $('#hotel_is_featured').on('ifChanged', function(){
      $(this).parents('form').submit();
    });
   });
 </script>