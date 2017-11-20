<script type="text/javascript">
  $(function(){
     var slug = $("#slug").val();
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
       url = "<?php echo base_url();?>admin/hotels/add" ;

       }else{
       url = "<?php echo base_url();?>admin/hotels/manage/"+slug;

       }

       $.post(url,$(".hotel-form").serialize() , function(response){
          if($.trim(response) != "done"){
          $(".output").html(response);
          }else{
             window.location.href = "<?php echo base_url().$adminsegment."/hotels/"?>";
          }

          });

     })



  })
</script>
<h3 class="margin-top-0"><?php echo $headingText;?></h3>
<div class="output"></div>
<form action="" method="POST" class="hotel-form" enctype="multipart/form-data" onsubmit="return false;" >
  <div class="panel panel-default">
    <ul class="nav nav-tabs nav-justified" role="tablist">
      <li class="active"><a href="#GENERAL" data-toggle="tab">Thông tin chung</a></li>
      <li class=""><a href="#FACILITIES" data-toggle="tab">Tiện nghi</a></li>
      <li class=""><a href="#META_INFO" data-toggle="tab">Thông tin meta</a></li>
      <li class=""><a href="#POLICY" data-toggle="tab">Chính sách</a></li>
      <li class=""><a href="#CONTACT" data-toggle="tab">Thông tin liên hệ</a></li>
      <li class=""><a href="#TRANSLATE" data-toggle="tab">Dịch</a></li>
    </ul>
    <div class="panel-body">
      <br>
      <div class="tab-content form-horizontal">
        <div class="tab-pane wow fadeIn animated active in" id="GENERAL">
          <div class="clearfix"></div>
          <div class="row form-group">
            <label class="col-md-2 control-label text-left">Trạng thái</label>
            <div class="col-md-2">
              <select data-placeholder="Select" class="form-control" name="hotelstatus">
                <option value="Yes" <?php if(@$hdata[0]->price_status == "Yes"){ echo "selected"; }?> >Hiển thị</option>
                <option value="No" <?php if(@$hdata[0]->hotel_status == "No"){ echo "selected"; }?> >Ẩn</option>
              </select>
            </div>
          </div>
          <div class="row form-group">
            <label class="col-md-2 control-label text-left">Giá phòng</label>
            <div class="col-md-2">
              <select data-placeholder="Select" class="form-control" name="pricestatus">
                <option value="Yes" <?php if(@$hdata[0]->price_status == "Yes"){ echo "selected"; }?> >Hiển thị</option>
                <option value="No" <?php if(@$hdata[0]->price_status == "No"){ echo "selected"; }?> >Ẩn</option>
              </select>
            </div>
          </div>
          <div class="row form-group">
            <label class="col-md-2 control-label text-left">Tên khách sạn</label>
            <div class="col-md-4">
              <input name="hotelname" type="text" placeholder="Hotel Name" class="form-control" value="<?php echo @$hdata[0]->hotel_title;?>" />
            </div>
          </div>
          <div class="row form-group">
            <label class="col-md-2 control-label text-left">Mô tả khách sạn</label>
            <div class="col-md-10">
              <?php $this->ckeditor->editor('hoteldesc', @$hdata[0]->hotel_desc, $ckconfig,'hoteldesc'); ?>
            </div>
          </div>
          <div class="row form-group">
           <?php if($isadmin){ ?>
            <label class="col-md-2 control-label text-left">Số sao</label>
            <div class="col-md-2">
              <select data-placeholder="Select" class="form-control" name="hotelstars">
                <?php for($stars = 1; $stars <= 7;$stars++){ ?>
                <option value="<?php echo $stars;?>" <?php if(@$hdata[0]->hotel_stars == $stars){ echo 'selected'; } ?> > <?php echo $stars; ?></option>
                <?php } ?>
              </select>
            </div>
            <?php }else{ ?> 
            <input type="hidden" name="hotelstars" value="<?php echo @$hdata[0]->hotel_stars;?>">
            <?php } ?>
          </div>
          <div class="row form-group">
            <label class="col-md-2 control-label text-left">Loại hình</label>
            <div class="col-md-2">
              <select data-placeholder="Select" class="form-control" name="hoteltype">
                <?php foreach($htypes as $ht){ ?>
                <option value="<?php echo $ht->sett_id;?>" <?php if(@$hdata[0]->hotel_type == $ht->sett_id){ echo 'selected'; } ?>  ><?php echo $ht->sett_name;?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          
          <div class="row form-group">
            <label class="col-md-2 control-label text-left">Đón tiễn sân bay</label>
            <div class="col-md-2">
              <select data-placeholder="Select" class="form-control" name="pickup">
                <option value="No" <?php if(@$hdata[0]->hotel_pickup == "No"){ echo 'selected'; } ?>>Có</option>
                <option value="Yes" <?php if(@$hdata[0]->hotel_pickup == "Yes"){ echo 'selected'; } ?>>Không</option>
              </select>
            </div>
          </div>
          
          <div class="row form-group">
           
          <input type="hidden" name="issale" value="<?php echo @$hdata[0]->hotel_is_sale; ?>">
          <input type="hidden" name="percent" value="<?php echo @$percent; ?>">
          <input type="hidden" name="sfrom" value="<?php echo @$salefrom; ?>">
          <input type="hidden" name="sto" value="<?php echo @$saleto; ?>">          
          
          </div>
          
          <div class="row form-group">
          
          <input type="hidden" name="isfeatured" value="<?php echo @$hdata[0]->hotel_is_featured; ?>">
          <input type="hidden" name="ffrom" value="<?php echo @$featuredfrom; ?>">
          <input type="hidden" name="fto" value="<?php echo @$featuredto; ?>">
    

          </div>
          <div class="row form-group">
            <label class="col-md-2 control-label text-left">Thành phố</label>
            <div class="col-md-4">
              <select name="hotelcity" class="chosen-select" required>
                <option value="">--chọn--</option>
                <?php foreach($locations as $loc){ ?>
                <option value="<?php echo $loc->id; ?>" <?php makeSelected(@$loc->id, @$hdata[0]->hotel_city); ?> ><?php echo $loc->location;?></option>
                <?php } ?>
              
              </select>
            </div>
 
          </div>
          
          
          <div class="row form-group">
            <label class="col-md-2 control-label text-left">Gần địa điểm</label>
            <div class="col-md-8">
              <select multiple class="chosen-multi-select" name="near[]">
                <?php foreach($nears as $near){ 
                    
                    $eachnear = explode(',', $near->near); 
                    foreach($eachnear as $item){ ?>
                <option value="<?php echo trim($item);?>" <?php  if(in_array(trim($item),@$hnear)){ echo 'selected'; } ?> >
                  <?php echo $item;?>
                </option>
                <?php }
                
                } ?>
              </select>
            </div>
          </div>
          <!--<div class="row form-group">
            <label class="col-md-2 control-label text-left">Near</label>
            <div class="col-md-4">
                <ul id="example_get_tags" class="methodExample"></ul>
		<input type="hidden" name="near" value="" class="" id="mytag" aria-required="true">
            </div>
 
          </div>-->
          <?php if($tripadvisor){ ?>
          <div class="row form-group">
            <label class="col-md-2 control-label text-left">Đánh giá TripAdvisor</label>
            <div class="col-md-4">
              <input type="text" name="tripadvisor" class="form-control" placeholder="TripAdvisor ID" value="<?php echo @$hdata[0]->tripadvisor_id;?>" />
            </div>
          </div>
          <?php } ?>
         <!-- <div class="row form-group">
            <label class="col-md-2 control-label text-left text-success">Deposit / Commission</label>
            <div class="col-md-2">
            <?php  if($isadmin){ ?>
              <select name="deposittype" class="form-control">
                <option value="fixed" <?php if(@$hoteldeposittype == "fixed"){ echo 'selected'; } ?> >Fixed</option>
                <option value="percentage" <?php if(@$hoteldeposittype == "percentage"){ echo 'selected'; } ?>>Percentage</option>
              </select>
            <?php }else{ ?><input type="text" class="form-control" name="deposittype" value="<?php echo $hoteldeposittype; ?>" readonly="readonly"><?php } ?>
            </div>
            <div class="col-md-2">
              <input type="text" class="form-control" id="" placeholder="Value" name="depositvalue" value="<?php echo @$hoteldepositval;?>" <?php if(!$isadmin){ echo "readonly"; } ?> >
            </div>
          </div>-->
          <div class="row form-group">
            <label class="col-md-2 control-label text-left text-danger">Thuế VAT</label>
            <div class="col-md-2">
              <select name="taxtype" class="form-control">
                <option value="fixed" <?php if(@$hoteltaxtype == "fixed"){ echo 'selected'; } ?> >Phí thành tiền</option>
                <option value="percentage" <?php if(@$hoteltaxtype == "percentage"){ echo 'selected'; } ?> >Phí %</option>
              </select>
            </div>
            <div class="col-md-2">
              <input class="form-control" id="" Placeholder="Value" type="text" name="taxvalue" value="<?php echo @$hoteltaxval;?>" />
            </div>
            <span class="help-block">Vui lòng để trống nếu giá đã bao gồm thuế VAT</span>
          </div>
            <div class="row form-group">
            <label class="col-md-2 control-label text-left text-danger">Phí dịch vụ</label>
            <div class="col-md-2">
              <select name="servicetype" class="form-control">
                <option value="fixed" <?php if(@$hotelservicetype == "fixed"){ echo 'selected'; } ?> >Phí thành tiền</option>
                <option value="percentage" <?php if(@$hotelservicetype == "percentage"){ echo 'selected'; } ?> >Phí %</option>
              </select>
            </div>
            <div class="col-md-2">
              <input class="form-control" id="" Placeholder="Value" type="text" name="servicevalue" value="<?php echo @$hotelserviceval;?>" />
            </div>
            <span class="help-block">Vui lòng để trống nếu giá đã bao gồm phí dịch vụ</span>
          </div>
          <div class="row form-group">
            <label class="col-md-2 control-label text-left">Khách sạn tương đương</label>
            <div class="col-md-8">
              <select multiple class="chosen-multi-select" name="relatedhotels[]">
                <?php foreach($all_hotels as $hotel){ if($hdata[0]->hotel_id != $hotel->hotel_id){ ?>
                <option value="<?php echo $hotel->hotel_id;?>" <?php  if(in_array($hotel->hotel_id,@$hrelated)){ echo 'selected'; } ?>  >
                  <?php echo $hotel->hotel_title;?>
                </option>
                <?php } } ?>
              </select>
            </div>
          </div>

      <!-- Address and Map -->

        <div class="panel panel-default">
        <div class="panel-heading"><strong>Bản đồ</strong></div>
        <div class="well well-sm" style="margin-bottom: 0px;">
        <div class="col-md-6 form-horizontal">
        <table class="table">
        <tr>
        <td>Địa chỉ trên bản đồ</td>
        <td>
       <input type="text" class="form-control Places" id="mapaddress" name="hotelmapaddress" value="<?php echo $hdata[0]->hotel_map_city;?>">
        </td>
        </tr>
        <tr>
        <td></td>
        </tr>
        <tr>
        <td>Vĩ độ</td>
        <td><input type="text" class="form-control" id="latitude" value="<?php echo $hdata[0]->hotel_latitude;?>"  name="latitude" /></td>
        </tr>
        <tr>
        <td>Kinh độ</td>
        <td><input type="text" class="form-control" id="longitude" value="<?php echo $hdata[0]->hotel_longitude;?>"  name="longitude" /></td>
        </tr>
        </table>

        </div>
        <div class="col-md-6">
        <div class="thumbnail">
        <div id="map-canvas" style="height: 200px; width:400"></div>
        </div>
        </div>
        <div class="clearfix"></div>
        </div>
        </div>
          <!-- Address and Map -->

        </div>
        <div class="tab-pane wow fadeIn animated in" id="FACILITIES">
          <div class="row form-group">
            <div class="col-md-12">
              <div class="col-md-4">
                <label class="pointer"><input class="all" type="checkbox" name="" value="" id="select_all" > Chọn tất cả</label>
              </div>
              <div class="clearfix"></div>
              <hr>
              <div class="clearfix"></div>
              <?php $hamenity = explode(",",@$hdata[0]->hotel_amenities);
                foreach($hamts as $hamt){ ?>
              <div class="col-md-4">
                <label class="pointer"><input class="checkboxcls" <?php if($submittype == "add"){ if( $hamt->sett_selected == "1"){echo "checked";} }else{ if(in_array($hamt->sett_id,$hamenity)){ echo "checked"; } } ?> type="checkbox" name="hotelamenities[]" value="<?php echo $hamt->sett_id;?>"  > <?php echo $hamt->sett_name;?></label>
              </div>
              <?php } ?>
            </div>
          </div>
        </div>
        <div class="tab-pane wow fadeIn animated in" id="META_INFO">
          <div class="row form-group">
            <label class="col-md-2 control-label text-left">Meta Title</label>
            <div class="col-md-6">
              <input name="hotelmetatitle" type="text" placeholder="Title" class="form-control" value="<?php echo @$hdata[0]->hotel_meta_title;?>" />
            </div>
          </div>
          <div class="row form-group">
            <label class="col-md-2 control-label text-left">Meta Keywords</label>
            <div class="col-md-6">
              <textarea name="hotelkeywords" placeholder="Keywords" class="form-control" id="" cols="30" rows="5"><?php echo @$hdata[0]->hotel_meta_keywords;?></textarea>
            </div>
          </div>
          <div class="row form-group">
            <label class="col-md-2 control-label text-left">Meta Description</label>
            <div class="col-md-6">
              <textarea name="hotelmetadesc" placeholder="Description" class="form-control" id="" cols="30" rows="5"><?php echo @$hdata[0]->hotel_meta_desc;?></textarea>
            </div>
          </div>
        </div>
        <div class="tab-pane wow fadeIn animated in" id="POLICY">
          <div class="row form-group">
            <label class="col-md-2 control-label text-left">Giờ nhận phòng</label>
            <div class="col-md-2">
              <input name="checkintime" type="text" placeholder="Check In" class="form-control timepicker" data-format="hh:mm A" value="<?php echo $checkin;?>" />
            </div>
            <label class="col-md-2 control-label text-left">Giờ trả phòng</label>
            <div class="col-md-2">
              <input name="checkouttime" type="text" placeholder="Check Out" class="form-control timepicker" data-format="hh:mm A" value="<?php echo $checkout;?>" />
            </div>
          </div>
          <div class="row form-group">
            <label class="col-md-2 control-label text-left">Phương thức thanh toán</label>
            <div class="col-md-6">
              <select multiple class="chosen-multi-select" name="hotelpayments[]">
                <?php foreach($hpayments as $hpayment){ ?>
                <option value="<?php echo $hpayment->sett_id;?>" <?php if($submittype == "add"){ if( $hpayment->sett_selected == "1"){echo "selected";} }else{ if(in_array($hpayment->sett_id,$hotelpaytypes)){ echo "selected"; } } ?> >
                  <?php echo $hpayment->sett_name;?>
                </option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="row form-group">
            <label class="col-md-2 control-label text-left">Chính sách hủy đổi</label>
            <div class="col-md-8">
              <textarea name="hotelpolicy" placeholder="" class="form-control" id="" cols="30" rows="7"><?php echo @$hdata[0]->hotel_policy;?></textarea>
            </div>
          </div>
          <div class="row form-group">
            <label class="col-md-2 control-label text-left">Chính sách phụ thu</label>
            <div class="col-md-8">
              <textarea name="hotelsurcharge" placeholder="" class="form-control" id="" cols="30" rows="7"><?php echo @$hdata[0]->hotel_surcharge;?></textarea>
            </div>
          </div>
        </div>
        <div class="tab-pane wow fadeIn animated in" id="CONTACT">
          <div class="row form-group">
            <label class="col-md-2 control-label text-left">Email khách sạn</label>
            <div class="col-md-4">
              <input name="hotelemail" type="text" placeholder="Email" class="form-control " value="<?php echo @$hdata[0]->hotel_email;?>" />
            </div>
          </div>
          <div class="row form-group">
            <label class="col-md-2 control-label text-left">Website khách sạn</label>
            <div class="col-md-4">
              <input name="hotelwebsite" type="text" placeholder="Website" class="form-control " value="<?php echo @$hdata[0]->hotel_website;?>" />
            </div>
          </div>
          <div class="row form-group">
            <label class="col-md-2 control-label text-left">Số điện thoại</label>
            <div class="col-md-4">
              <input name="hotelphone" type="text" placeholder="Số điện thoại" class="form-control" value="<?php echo @$hdata[0]->hotel_phone;?>" />
            </div>
          </div>
         <!--  <div class="row form-group">
           <label class="col-md-2 control-label text-left">Full Address</label>
           <div class="col-md-6">
             <input name="hoteladdress" type="text" placeholder="Address" class="form-control" value="<?php echo @$hdata[0]->hotel_address;?>" />
           </div>
         </div> -->
        </div>
        <div class="tab-pane wow fadeIn animated in" id="TRANSLATE">
          <?php foreach($languages as $lang => $val){ if($lang != "vi"){ @$trans = getBackHotelTranslation($lang,$hotelid); ?>
          <div class="panel panel-default">
            <div class="panel-heading"><img src="<?php echo PT_LANGUAGE_IMAGES.$lang.".png"?>" height="20" alt="" /> <?php echo $val['name']; ?></div>
            <div class="panel-body">
              <div class="row form-group">
                <label class="col-md-2 control-label text-left">Hotel Name</label>
                <div class="col-md-4">
                  <input name='<?php echo "translated[$lang][title]"; ?>' type="text" placeholder="Hotel Name" class="form-control" value="<?php echo @$trans[0]->trans_title;?>" />
                </div>
              </div>
              <div class="row form-group">
                <label class="col-md-2 control-label text-left">Hotel Description</label>
                <div class="col-md-10">
                  <?php $this->ckeditor->editor("translated[$lang][desc]", @$trans[0]->trans_desc, $ckconfig,"translated[$lang][desc]"); ?>
                  <!--    <textarea name='<?php echo "translated[$lang][desc]"; ?>' placeholder="Description..." class="form-control" id="" cols="30" rows="4"><?php echo @$trans[0]->trans_desc;?></textarea>   -->
                </div>
              </div>
              <hr>
              <div class="row form-group">
                <label class="col-md-2 control-label text-left">Meta Title</label>
                <div class="col-md-6">
                  <input name='<?php echo "translated[$lang][metatitle]"; ?>' type="text" placeholder="Title" class="form-control" value="<?php echo @$trans[0]->metatitle;?>" />
                </div>
              </div>
              <div class="row form-group">
                <label class="col-md-2 control-label text-left">Meta Keywords</label>
                <div class="col-md-6">
                  <textarea name='<?php echo "translated[$lang][keywords]"; ?>' placeholder="Keywords" class="form-control" id="" cols="30" rows="2"><?php echo @$trans[0]->metakeywords;?></textarea>
                </div>
              </div>
              <div class="row form-group">
                <label class="col-md-2 control-label text-left">Meta Description</label>
                <div class="col-md-6">
                  <textarea name='<?php echo "translated[$lang][metadesc]"; ?>' placeholder="Description" class="form-control" id="" cols="30" rows="4"><?php echo @$trans[0]->metadesc;?></textarea>
                </div>
              </div>
              <hr>
              <div class="row form-group">
                <label class="col-md-2 control-label text-left">Policy And Terms</label>
                <div class="col-md-8">
                  <textarea name='<?php echo "translated[$lang][policy]"; ?>' placeholder="Policy..." class="form-control" id="" cols="15" rows="4"><?php echo @$trans[0]->trans_policy;?></textarea>
                </div>
              </div>
            </div>
          </div>
          <?php } } ?>
        </div>
      </div>

 



    </div>
    <div class="panel-footer">
      <input type="hidden" id="slug" value="<?php echo @$hdata[0]->hotel_slug;?>" />
      <input type="hidden" name="submittype" value="<?php echo $submittype;?>" />
      <input type="hidden" name="hotelid" value="<?php echo @$hotelid;?>" />
      <button class="btn btn-primary submitfrm" id="<?php echo $submittype; ?>">Lưu</button>
    </div>
  </div>
</form>

<!-- google places -->

    <script>

      function initAutocomplete() {
        
        var markers = [];

        var ex_latitude = $('#latitude').val();

        var ex_longitude = $('#longitude').val();

          if (ex_latitude != '' && ex_longitude != ''){

            var map = new google.maps.Map(document.getElementById('map-canvas'), {
          center: {lat: parseFloat(ex_latitude), lng: parseFloat(ex_longitude)},
          zoom: 16,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        });

         
             var marker = new google.maps.Marker(

                {

                    map: map,

                    draggable:true,
                    icon: "<?php echo PT_DEFAULT_IMAGE . 'marker.png'; ?>",

                    animation: google.maps.Animation.DROP,

                    position: new google.maps.LatLng(ex_latitude, ex_longitude)

                });



            markers.push(marker);

            google.maps.event.addListener(marker, 'dragend', function()

            {

                var marker_positions = marker.getPosition();

                $('#latitude').val(marker_positions.lat());

                $('#longitude').val(marker_positions.lng());



            });


          }else{

            var map = new google.maps.Map(document.getElementById('map-canvas'), {
          center: {lat: -33.8688, lng: 151.2195},
          zoom: 16,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        });

          }

        

        // Create the search box and link it to the UI element.
        var input = document.getElementById('mapaddress');
        var searchBox = new google.maps.places.SearchBox(input);
       // map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        // Bias the SearchBox results towards current map's viewport.
        map.addListener('bounds_changed', function() {
          searchBox.setBounds(map.getBounds());
          
        });

        // Listen for the event fired when the user selects a prediction and retrieve
        // more details for that place.
        searchBox.addListener('places_changed', function() {
          var places = searchBox.getPlaces();
          if (places.length == 0) {
            return;
          }

         
map.setZoom(16);

          // Clear out the old markers.
          markers.forEach(function(marker) {
            marker.setMap(null);


          });
          markers = [];

          // For each place, get the icon, name and location.
          var bounds = new google.maps.LatLngBounds();
          places.forEach(function(place) {
            var icon = {
              url: place.icon,
              size: new google.maps.Size(71, 71),
              origin: new google.maps.Point(0, 0),
              anchor: new google.maps.Point(17, 34),
              scaledSize: new google.maps.Size(25, 25)
            };

            var marker = new google.maps.Marker({
              map: map,
              icon: "<?php echo PT_DEFAULT_IMAGE . 'marker.png'; ?>",
              title: place.name,
              position: place.geometry.location,
              draggable: true,
              animation: google.maps.Animation.DROP,
            });
            // Create a marker for each place.
            markers.push(marker);

            if (place.geometry.viewport) {
              // Only geocodes have viewport.
              bounds.union(place.geometry.viewport);
            } else {
              bounds.extend(place.geometry.location);
            }

          google.maps.event.addListener(marker, 'dragend', function()

            {

                var marker_positions = marker.getPosition();

                $('#latitude').val(marker_positions.lat());

                $('#longitude').val(marker_positions.lng());



            });



      $('#latitude').val(place.geometry.location.lat());
      $('#longitude').val(place.geometry.location.lng());
    

          });



          map.fitBounds(bounds);
          map.setZoom(16);
       
        });


    

      }


    </script>
<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo $appSettings->mapApi; ?>&libraries=places&callback=initAutocomplete" async defer></script>
 <!-- Google Places -->
 

<script>
  $(document).ready(function() {
      if (window.location.hash != "") {
          $('a[href="' + window.location.hash + '"]').click()
      }
  });
</script>