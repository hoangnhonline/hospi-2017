<div class="panel panel-default">
  <div class="panel-heading"><?php echo $header_title; ?></div>
  <?php if(@$addpermission && !empty($add_link)){ ?>
   <form class="add_button" action="<?php echo $add_link; ?>" method="post"><button type="submit" class="btn btn-success"><i class="glyphicon glyphicon-plus-sign"></i> Thêm mới</button></form>
  <?php } ?>
   <div class="panel-body">
   	<div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Bộ lọc</h3>
        </div>
        <div class="panel-body">
          <form class="form-inline" id="searchForm" role="form" method="GET" action="{{ route('product.index') }}">
           
          
            
            <div class="form-group">
              <label for="email">Danh mục cha</label>
              <select class="form-control" name="parent_id" id="parent_id">
                <option value="">--Tất cả--</option>
                @foreach( $cateParentList as $value )
                <option value="{{ $value->id }}" {{ $value->id == $arrSearch['parent_id'] ? "selected" : "" }}>{{ $value->name }}</option>
                @endforeach
              </select>
            </div>
              <div class="form-group">
              <label for="email">Danh mục con</label>

              <select class="form-control" name="cate_id" id="cate_id">
                <option value="">--Tất cả--</option>
                @foreach( $cateList as $value )
                <option value="{{ $value->id }}" {{ $value->id == $arrSearch['cate_id'] ? "selected" : "" }}>{{ $value->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="email">Tên</label>
              <input type="text" class="form-control" name="name" value="{{ $arrSearch['name'] }}">
            </div>            
            <div class="form-group">
              <label><input type="checkbox" name="is_hot" value="1" {{ $arrSearch['is_hot'] == 1 ? "checked" : "" }}> HOT</label>              
            </div>
            <div class="form-group">
              <label><input type="checkbox" name="is_sale" value="1" {{ $arrSearch['is_sale'] == 1 ? "checked" : "" }}> SALE</label>              
            </div>
            <div class="form-group">
              <label><input type="checkbox" name="out_of_stock" value="1" {{ $arrSearch['out_of_stock'] == 1 ? "checked" : "" }}> Hết hàng</label>              
            </div>                       
            <button type="submit" style="margin-top:-5px" class="btn btn-primary btn-sm">Lọc</button>
          </form>         
        </div>
      </div>
     <div class="box">       
        <!-- /.box-header -->
        <div class="box-body">
          <div style="text-align:center">
           <?php if (isset($links)) { ?>
                <?php echo $links ?>
            <?php } ?>
          </div>  
          <table class="table table-bordered" id="table-list-data">
            <tr>
              <th style="width: 1%">
              	<input class="all" type="checkbox" value="" id="select_all">
              </th>
              <th style="width: 1%">
              	#
              </th>            
              <th width="210px">Hình ảnh</th>
              <th>Tên khách sạn</th>      
              <th>Số sao</th>                              
              <th>Người tạo</th>
              <th>Tỉnh/TP</th>
              <th>Gallery</th>
              <th>Thứ tự</th>
              <th>Trạng thái</th>
              <th width="1%;white-space:nowrap"></th>
            </tr>
            <tbody>
            <?php if( !empty($content)) {
               $i = 0;
              foreach($content as $item ) {
                $i ++; 
 
                ?>
              <tr id="row-{{ $item->id }}">
              	<td>
              		<input type="checkbox" name="" class="checkboxcls" value="<?php echo $item->hotel_id; ?>">
              	</td>
                <td><span class="order"><?php echo $i; ?></span></td>                
                <td class="zoom_img">
                  <img class="img-thumbnail" width="120" src="<?php echo '../../'.PT_HOTELS_SLIDER_THUMBS_UPLOAD.$item->thumbnail_image; ?>" alt="<?php echo $item->hotel_title; ?>" title="<?php echo $item->hotel_title; ?>" />
                </td>
                <td>                  
                  <a style="color:#333;font-weight:bold" href="{{ route( 'product.edit', [ 'id' => $item->id ]) }}"><?php echo $item->hotel_title; ?></a> &nbsp; @if( $item->is_hot == 1 )
                  <label class="label label-danger">HOT</label>
                  @endif<br />
                  <strong style="color:#337ab7;font-style:italic"> {{ $item->cate_parent_name }} / {{ $item->cate_name }}</strong>
                 <p style="margin-top:10px">
                    @if( $item->is_sale == 1)
                   <b style="color:red">                  
                    {{ number_format($item->price_sale) }}
                   </b>
                   <span style="text-decoration: line-through">
                    {{ number_format($item->price) }}  
                    </span>
                    @else
                    <b style="color:red">                  
                    {{ number_format($item->price) }}
                   </b>
                    @endif 
                  </p>
                  
                </td>
                <td style="white-space:nowrap; text-align:right">
                  <a class="btn btn-default btn-sm" href="{{ route('product', [ $item->slug, $item->product_id ]) }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i> Xem</a>                 
                  <a href="{{ route( 'product.edit', [ 'id' => $item->id ]) }}" class="btn btn-warning btn-sm">Chỉnh sửa</a>                 

                  <a onclick="return callDelete('{{ $item->name }}','{{ route( 'product.destroy', [ 'id' => $item->id ]) }}');" class="btn btn-danger btn-sm">Xóa</a>

                </td>
              </tr> 
             <?php }} else { ?>
            <tr>
              <td colspan="9">Không có dữ liệu.</td>
            </tr>
            <?php } ?>            
          </tbody>
          </table>
          <div style="text-align:center">
           <?php if (isset($links)) { ?>
                <?php echo $links ?>
            <?php } ?>
          </div>  
        </div>        
      </div>
   </div>
 </div>