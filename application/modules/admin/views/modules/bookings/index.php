
<div class="panel panel-default">
  <div class="panel-heading"><?php echo $header_title; ?></div>
  <div class="clearfix"></div>
  <?php if(@$addpermission && !empty($add_link)){ ?>
   <a style="margin-left:15px;margin-top:10px;" href="<?php echo $add_link; ?>" class="btn btn-success"><i class="glyphicon glyphicon-plus-sign"></i> Tạo Booking</a>
  <?php } ?>
  <div style="clear:both"></div>
   <div class="panel-body" style="padding-top:5px;">
   	<div class="panel panel-default" style="margin-bottom:5px !important">
       
        <div class="panel-body">
          <form class="form-inline" id="searchForm" role="form" method="GET" action="<?php echo base_url() .'admin/bookings'; ?>">
            <div class="form-group" style="width:200px;">              
              <select class="form-control chosen-select" name="booking_type" id="booking_type">                
                <option value="hotels" <?php echo isset($params['booking_type']) && 'hotels' == $params['booking_type'] ? "selected" : "";  ?>>Khách sạn</option>
                <option value="combo" <?php echo isset($params['booking_type']) && 'combo' == $params['booking_type'] ? "selected" : "";  ?>>Combo</option>
                <option value="honeymoon" <?php echo isset($params['booking_type']) && 'honeymoon' == $params['booking_type'] ? "selected" : "";  ?>>Honeymoon</option>
              </select>
            </div>
            
            <div class="form-group">              
              <select class="form-control" name="booking_status" id="booking_status">
                <option value="">Tình trạng</option>
                <option value="unpaid" <?php echo isset($params['booking_status']) && 'unpaid' == $params['booking_status'] ? "selected" : "";  ?>>Chưa thanh toán</option>
                <option value="paid" <?php echo isset($params['booking_status']) && 'paid' == $params['booking_status'] ? "selected" : "";  ?>>Đã thanh toán</option>
                <option value="reserved" <?php echo isset($params['booking_status']) && 'reserved' == $params['booking_status'] ? "selected" : "";  ?>>Đã cọc</option>
                <option value="cancelled" <?php echo isset($params['booking_status']) && 'cancelled' == $params['booking_status'] ? "selected" : "";  ?>>Đã hủy</option>                
              </select>
            </div>       
            <div class="form-group">              
              <input type="text" class="form-control" placeholder="Mã booking" name="booking_ref_no" value="<?php echo isset($params['booking_ref_no']) ? $params['booking_ref_no'] : ""; ?>">
            </div>            
            <div class="form-group">              
              <input type="text" class="form-control" placeholder="Tên khách hàng" name="ai_last_name" value="<?php echo isset($params['ai_last_name']) ? $params['ai_last_name'] : ""; ?>">
            </div>                                    
            <button type="submit" class="btn btn-primary btn-sm">Lọc</button>
          </form>         
        </div>
      </div>
     <div class="box">       
     <div class="btn-group pull-right">
                <a style="margin-bottom: 5px;" href="javascript: multiDelfunc('<?php echo  base_url(); ?>admin/bookings/delMultipleBookings', 'checkboxcls')" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i> Xóa mục đã chọn</a> 
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
                ID
              </th>                          
              <th>Mã booking</th>      
              <th>Khách hàng</th>                              
              <th>Loại</th>
              <th class="text-center">Ngày</th>                     
              <th class="text-right">Tổng thanh toán</th>
              <th class="text-right">Đã thanh toán</th>
              <th>Tình trạng</th>
              <th width="1%"></th>
            </tr>
            <tbody>
            <?php if( !empty($content)) {
               $i = 0;
              foreach($content as $item ) {
                $i ++;   
                ?>
              <tr id="row-<?php echo $item->booking_id; ?>">
              	<td>
              		<input type="checkbox" name="" class="checkboxcls" value="<?php echo $item->booking_id; ?>">
              	</td>
                <td><span class="order"><?php echo $i; ?></span></td>   
                <td><?php echo $item->booking_id; ?></td>      
                <td>
                  <?php 
                   echo $item->booking_ref_no;
                  ?>
                </td>          
                <td>
                 <?php echo $item->ai_last_name; ?>
                </td>
                <td><?php echo $item->booking_type == "hotels" ? "Khách sạn" : $item->booking_type ; ?></td>
                <td class="text-center">
                  <?php echo date('d/m/Y', $item->booking_date); ?>
                </td>
                <td class="text-right">                  
                  <?php echo number_format($item->booking_total); ?>                
                </td>
                <td class="text-right">                  
                  <?php echo number_format($item->booking_amount_paid); ?>                
                </td>
                <td>
                  <?php 
                  if($item->booking_status == "unpaid")
                    echo "<span style=color:red>Chưa thanh toán</span>";
                  elseif($item->booking_status == "paid")
                    echo "<span style=color:green>Đã thanh toán</span>";
                  elseif($item->booking_status == "reserved")
                    echo "Đã cọc";
                  else
                    echo "Đã hủy";

                  ?>
                </td>               
                <td style="white-space:nowrap; text-align:right">                 
                  <a target="_blank" title="View Invoice" class="btn btn-primary btn-sm" href="<?php echo base_url(); ?>/invoice/?id=<?php echo $item->booking_id; ?>&sessid=<?php echo $item->booking_ref_no; ?>"><i class="fa fa-search-plus"></i></a>                     
                  <a href="<?php echo base_url() . 'admin/bookings/edit/offers/'.$item->booking_id; ?>" class="btn btn-warning btn-sm" target="_self"><i class="fa fa-edit"></i></a>
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
 <script type="text/javascript">
   $(document).ready(function(){
    $('#booking_type, #hotel_stars, #booking_status').change(function(){
      $(this).parents('form').submit();
    });
    $('#hotel_is_featured').on('ifChanged', function(){
      $(this).parents('form').submit();
    });
   });
 </script>