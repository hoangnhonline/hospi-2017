
<div class="panel panel-default">
  <div class="panel-heading"><?php echo $header_title; ?></div>
  <div class="clearfix"></div>
  
   <a style="margin-left:15px;margin-top:10px;" href="<?php echo $add_link; ?>" class="btn btn-success"><i class="glyphicon glyphicon-plus-sign"></i> Thêm mới</a>
  
  <div style="clear:both"></div>
   <div class="panel-body" style="padding-top:5px;">
   	<div class="panel panel-default" style="margin-bottom:5px !important">
       
        <div class="panel-body">
          <form class="form-inline" id="searchForm" role="form" method="GET" action="<?php echo base_url() .'admin/honeymoon'; ?>">
            <div class="form-group" style="width:200px;">              
              <select class="form-control chosen-select" name="offer_city" id="offer_city">
                <option value="">Tỉnh/TP</option>
                <?php foreach( $locations as $location ){ ?>
                <option value="<?php echo $location->id; ?>" <?php echo isset($params['offer_city']) && $location->id == $params['offer_city'] ? "selected" : "";  ?>><?php echo $location->location; ?></option>
                <?php } ?>
              </select>
            </div>
            
            <div class="form-group">              
              <select class="form-control" name="offer_status" id="offer_status">
                <option value="">Trạng thái</option>
                <option value="Yes" <?php echo isset($params['offer_status']) && 'Yes' == $params['offer_status'] ? "selected" : "";  ?>>Hiển thị</option>
                <option value="No" <?php echo isset($params['offer_status']) && 'No' == $params['offer_status'] ? "selected" : "";  ?>>Ẩn</option>                
              </select>
            </div>             
            <div class="form-group">              
              <input type="text" class="form-control" placeholder="Tên honeymoon" name="offer_title" value="<?php echo isset($params['offer_title']) ? $params['offer_title'] : ""; ?>">
            </div>                                     
            <button type="submit" class="btn btn-primary btn-sm">Lọc</button>
          </form>         
        </div>
      </div>
     <div class="box">       
     <div class="btn-group pull-right">
                <a style="margin-bottom: 5px;" href="javascript: multiDelfunc('<?php echo  base_url(); ?>admin/hotelajaxcalls/delMultipleOffer', 'checkboxcls')" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i> Xóa mục đã chọn</a> 
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
              <th width="80px">Ảnh đại diện</th>
              <th>Tên honeymoon</th>                                                                              
              <th>Hình ảnh</th>
              <th>Áp dụng</th>              
              <th width="7%">Thứ tự</th>
              <th width="7%">Giá</th>
              <th style="white-space: nowrap">Trạng thái</th>
              <th width="1%"></th>
            </tr>
            <tbody>
            <?php if( !empty($content)) {
               $i = 0;
              foreach($content as $item ) {
                $i ++;   
                ?>
              <tr id="row-<?php echo $item->offer_id; ?>">
              	<td>
              		<input type="checkbox" name="" class="checkboxcls" value="<?php echo $item->offer_id; ?>">
              	</td>
                <td><span class="order"><?php echo $i; ?></span></td>                               
                <td class="zoom_img">
                  <img class="img-thumbnail" width="120" src="<?php echo '../../'.PT_OFFERS_THUMBS_UPLOAD.$item->offer_thumb; ?>" alt="<?php echo $item->offer_title; ?>" title="<?php echo $item->offer_title; ?>" />
                </td>
                <td>                  
                  <a href="<?php echo base_url() . 'admin/hotels/manage/'.$item->offer_slug; ?>" target="_self"><?php echo $item->offer_title; ?></a>
                
                </td>                
                <td  style="white-space: nowrap">
                  <?php 
                  $CI = get_instance();
                  $role = $CI->session->userdata('pt_role');
                  if($role != "supplier"){
                    $role = "admin";
                  }

                  $photocounts =  isset($photoArr[$item->offer_id]) ? $photoArr[$item->offer_id] : 0;
                  echo "<a href=".base_url().$role."/offers/gallery/".$item->offer_id.">Tải hình ảnh (".$photocounts.")</a>";
                  ?>
                </td>  
                <td><?php echo date('d/m/Y', $item->offer_from)." - ". date('d/m/Y', $item->offer_to); ?></td>              
                <td><?php echo number_format($item->offer_price); ?></td>
                <td>
                  <?php 
                    $url = base_url()."admin/ajaxcalls/update_offers_order";

echo '<input class="form-control input-sm" data-url='.$url.' type="number" id="order_'.$item->offer_id.'" value='.$item->offer_order.' min="1"  onblur="updateOrder($(this).val(),'.$item->offer_id.','.$item->offer_order.')" />';
                  ?>
                </td>
                <td class="text-center">
                  <?php 
                  if($item->offer_status == "Yes" || $item->offer_status == "yes"){
                    echo '<i class="fa fa-check text-success"></i>';
                  }else{
                   echo '<i class="fa fa-times text-danger"></i>';
                  }
                  ?>
                </td> 
                <td style="white-space:nowrap; text-align:right">                                 
                  <a href="<?php echo base_url() . 'admin/honeymoon/manage/'.$item->offer_slug; ?>" class="btn btn-warning btn-sm" target="_self"><i class="fa fa-edit"></i></a>                  
                  <a onclick="javascript: delfunc('<?php echo $item->offer_id; ?>','<?php echo $delurl; ?>')" class="btn btn-danger btn-sm"><i class="fa fa-remove"></i></a>                  
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
 <script type="text/javascript">
   $(document).ready(function(){
    $('#offer_city, #offer_status').change(function(){
      $(this).parents('form').submit();
    });    
   });
 </script>