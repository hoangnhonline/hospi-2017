<section id="ROOMS" style="background-color:#FFFFFF" style="position: relative;">
  <div style="background-color:#fff">
    <div class="block-package hidden-xs">
      <ul>
        <li class="package-info clearfix">
          <div class="row">
            <div class="col-sm-7">
              <h4 class="package-name purple andes-bold">Gói honeymoon</h4>
              <span class="package-des">Áp dụng từ ngày: 20/06/2016 đến hết ngày: 30/10/2016</span>
            </div>
            <div class="col-sm-5">
              <div class="row">
                <div class="col-md-8">
                  <p class="package-price">Giá: <span class="package-price">14.990.000 VND</span></p>
                </div>
                <div class="col-md-4">
                  <a href="#" title="Xem chi tiết" class="package-view">Xem chi tiết</a>
                </div>
              </div>
            </div>
          </div>
        </li>
        <li class="package-info clearfix">
          <div class="row">
            <div class="col-sm-7">
              <h4 class="package-name purple andes-bold">Deals - Giảm giá</h4>
              <span class="package-des">Áp dụng từ ngày: 20/06/2016 đến hết ngày: 30/10/2016</span>
            </div>
            <div class="col-sm-5">
              <div class="row">
                <div class="col-md-8">
                  <p class="package-price">Giá: <span class="package-price">14.990.000 VND</span></p>
                </div>
                <div class="col-md-4">
                  <a href="#" title="Xem chi tiết" class="package-view">Xem chi tiết</a>
                </div>
              </div>
            </div>
          </div>
        </li>
        <li class="package-info clearfix">
          <div class="row">
            <div class="col-sm-7">
              <h4 class="package-name purple andes-bold">Combo</h4>
              <span class="package-des">Áp dụng từ ngày: 20/06/2016 đến hết ngày: 30/10/2016</span>
            </div>
            <div class="col-sm-5">
              <div class="row">
                <div class="col-md-8">
                  <p class="package-price">Giá: <span class="package-price">14.990.000 VND</span></p>
                </div>
                <div class="col-md-4">
                  <a href="#" title="Xem chi tiết" class="package-view">Xem chi tiết</a>
                </div>
              </div>
            </div>
          </div>
        </li>
      </ul>
    </div><!-- block-package -->

    <div class="rooms-update rooms-update-bg">
        <form action="" method="GET">
            <div class="row">
                <div class="col-sm-3 col-xs-12 go-right">
                    <label class="size12 RTL go-right" style="white-space: nowrap;"><?php echo trans('07'); ?></label>
                    <input type="text" placeholder="<?php echo trans('07'); ?>" name="checkin" class="form-control mySelectCalendar dpd1" value="<?php echo $modulelib->checkin; ?>" required>
                </div>
                <div class="col-sm-3 col-xs-12 go-right">
                    <label class="size12 RTL go-right"><?php echo trans('09'); ?></label>
                    <input type="text" placeholder="<?php echo trans('09'); ?>" name="checkout" class="form-control mySelectCalendar dpd2" value="<?php echo $modulelib->checkout; ?>" required>
                </div>
                <div class="col-xs-12 col-sm-2" style="margin-top: 10px;">
                    <label>&nbsp;</label>
                    <?php if (!empty($rooms)) { ?>
                    <h5 class="text-left size16"><strong><i class="icon_set_1_icon-83"></i> <?php echo $modulelib->stay; ?> <?php echo trans('0122'); ?></strong> </h5>
                    <?php } ?>
                </div>
                <div class="col-sm-4 col-xs-12 go-right">
                    <label>&nbsp;</label>
                    <button class="btn btn-block btn-success pull-right"><?php echo trans('0106'); ?></button>
                    <input type="hidden" id="loggedin" value="<?php echo $usersession; ?>" />
                    <input type="hidden" id="itemid" value="<?php echo $module->id; ?>" />
                    <input type="hidden" id="module" value="<?php echo $appModule; ?>" />
                    <input type="hidden" id="addtxt" value="<?php echo trans('029'); ?>" />
                    <input type="hidden" id="removetxt" value="<?php echo trans('028'); ?>" />
                </div>
            </div>
        </form>
        <div class="clearfix"></div>
    </div><!-- update rooms-update-bg -->

    <div class="clearfix"></div>
    <?php if (!empty($modulelib->stayerror)) { ?>
    <div class="panel-body">
        <div class="alert alert-danger go-text-right">
            <?php echo trans("0420"); ?>
        </div>
    </div><!-- panel-body -->

    <?php } ?>

    <div class="clearfix block-rooms">
      <div class="tabble-responsive">
        <table class="table table-customize">
          <thead>
            <tr>
              <th style="width: 345px;">Loại phòng</th>
              <th style="width: 167px;">Số phòng</th>
              <th style="width: 167px;">Giá phòng</th>
              <th>Đặt phòng</th>
            </tr>
          </thead>

          <tbody>
            <tr>
              <td>
                <div class="zoom-gallery">
                  <div title="" data-toggle="tooltip" data-placement="left" id="131" data-module="hotels" class="wishlist wishlistcheck hotelswishtext131" data-original-title="Add to wishlist">
                    <a class="tooltip_flip tooltip-effect-1" href="javascript:void(0);"><span class="hotelswishsign131">+</span></a>
                  </div>
                  <a href="#" data-source="" title="Honeymoon">
                  <img class="img-responsive" src="assets/img/335887_honeymoon_at_the_beach--hospi.jpg">
                  </a>
                </div>
                <div class="info">
                  <h4 class="RTL go-text-right"><b class="purple">Ocean Villa 2 phòng ngủ</b></h4>
                  <div class="block-people">
                    <h5>Người lớn: <span>02</span> </h5>
                    <h5>Trẻ em: <span>01</span></h5>
                  </div>
                  <div class="block-view-detail">
                    <div class="visible-lg visible-md go-right" id="accordion" style="margin-top: 0px;">
                      <a data-toggle="modal" href="#details4997">Xem chi tiết</a>
                    </div>
                  </div>
              </td>
              <td>
                <div class="item-countroom">
                  <h5 class="size12"><?php echo trans('0374'); ?></h5>
                  <select class="form-control" name="roomscount" >
                    <option value="rooms1">01</option>
                    <option value="rooms2">02</option>
                    <option value="rooms3">03</option>
                    <option value="rooms4">04</option>
                    <option value="rooms5">05</option>
                    <option value="rooms6">06</option>
                    <option value="rooms7">07</option>
                    <option value="rooms8">08</option>
                    <option value="rooms9">09</option>
                    <option value="rooms10">10</option>
                  </select>
                </div>
                <div class="item-countroom">
                  <h5 class="size12"><?php echo trans('0428'); ?></h5>
                  <select name="extrabeds" class="form-control">
                    <option value="beds1">01</option>
                    <option value="beds2">02</option>
                    <option value="beds3">03</option>
                    <option value="beds4">04</option>
                    <option value="beds5">05</option>
                    <option value="beds6">06</option>
                    <option value="beds7">07</option>
                    <option value="beds8">08</option>
                    <option value="beds9">09</option>
                    <option value="beds10">10</option>
                  </select>
                </div>
              </td>
              <td>
                <div class="block-price">
                  <p class="purple size18"><b>8,822,000</b></p>
                  <p class="size13 grey">Giá VND/2 đêm
                    <span class="tooltip-info"><i class="fa fa-question-circle"></i></span>
                  </p>
                  <p class="block-price-info">
                    <span>Bao gồm: Ăn sáng.</span>
                    <span>Phí dịch vụ 5%, VAT 10%</span>
                  </p>
                </div>
              </td>
              <td rowspan="4">
                <p><button style="margin-bottom:5px" type="submit" class="btn btn-action btn-block chk">Đặt phòng</button></p>
                <p class="size13">Bạn vui lòng chọn số lượng phòng, Bạn có thể đặt một lúc nhiều loại phòng </p>
                <hr>
                <p class="purple andes-bold size13 text-center">Yêu cầu giường</p>
                <p class="size13 text-center"><label class="radio-inline"><input type="radio" name="radiobeds" value="1">1 giường</label></p>
                <p class="size13 text-center"><label class="radio-inline"><input type="radio" name="radiobeds" value="2">2 giường</label></p>
              </td>
            </tr>

            <tr>
              <td rowspan="2">
                <div class="zoom-gallery">
                  <a href="#" data-source="" title="Honeymoon">
                  <img class="img-responsive" src="assets/img/335887_honeymoon_at_the_beach--hospi.jpg">
                  </a>
                </div>
                <div class="info">
                  <h4 class="RTL go-text-right"><b class="purple">Bungalow Ocean View</b></h4>
                  <div class="block-people">
                    <h5>Người lớn: <span>02</span> </h5>
                    <h5>Trẻ em: <span>01</span></h5>
                  </div>
                  <div class="block-view-detail">
                    <div class="visible-lg visible-md go-right" id="accordion" style="margin-top: 0px;">
                      <a data-toggle="modal" href="#details4997">Xem chi tiết</a>
                    </div>
                  </div>
              </td>
              <td>
                <div class="item-countroom">
                  <h5 class="size12"><?php echo trans('0374'); ?></h5>
                  <select class="form-control" name="roomscount" >
                    <option value="rooms1">01</option>
                    <option value="rooms2">02</option>
                    <option value="rooms3">03</option>
                    <option value="rooms4">04</option>
                    <option value="rooms5">05</option>
                    <option value="rooms6">06</option>
                    <option value="rooms7">07</option>
                    <option value="rooms8">08</option>
                    <option value="rooms9">09</option>
                    <option value="rooms10">10</option>
                  </select>
                </div>
                <div class="item-countroom">
                  <h5 class="size12"><?php echo trans('0428'); ?></h5>
                  <select name="extrabeds" class="form-control">
                    <option value="beds1">01</option>
                    <option value="beds2">02</option>
                    <option value="beds3">03</option>
                    <option value="beds4">04</option>
                    <option value="beds5">05</option>
                    <option value="beds6">06</option>
                    <option value="beds7">07</option>
                    <option value="beds8">08</option>
                    <option value="beds9">09</option>
                    <option value="beds10">10</option>
                  </select>
                </div>
              </td>
              <td>
                <div class="block-price">
                  <div class="sale">
                    <img src="assets/img/star.png" alt="">
                    <div class="hover">
                      <p>Đang khuyến mãi</p>
                      <p>Từ ngày: 31/05/2017</p>
                      <p>Đến hết ngày: 30/09/2017</p>
                    </div>
                  </div>
                  <p class="purple size18"><b>8,822,000</b></p>
                  <p class="size13 grey">Giá VND/2 đêm</p>
                  <p class="block-price-info">
                    <span>Bao gồm: Ăn sáng.</span>
                    <span>Phí dịch vụ 5%, VAT 10%</span>
                  </p>
                </div>
              </td>
            </tr>

            <tr>
              <td>
                <div class="item-countroom">
                  <h5 class="size12"><?php echo trans('0374'); ?></h5>
                  <select class="form-control" name="roomscount" >
                    <option value="rooms1">01</option>
                    <option value="rooms2">02</option>
                    <option value="rooms3">03</option>
                    <option value="rooms4">04</option>
                    <option value="rooms5">05</option>
                    <option value="rooms6">06</option>
                    <option value="rooms7">07</option>
                    <option value="rooms8">08</option>
                    <option value="rooms9">09</option>
                    <option value="rooms10">10</option>
                  </select>
                </div>
                <div class="item-countroom">
                  <h5 class="size12"><?php echo trans('0428'); ?></h5>
                  <select name="extrabeds" class="form-control">
                    <option value="beds1">01</option>
                    <option value="beds2">02</option>
                    <option value="beds3">03</option>
                    <option value="beds4">04</option>
                    <option value="beds5">05</option>
                    <option value="beds6">06</option>
                    <option value="beds7">07</option>
                    <option value="beds8">08</option>
                    <option value="beds9">09</option>
                    <option value="beds10">10</option>
                  </select>
                </div>
              </td>
              <td>
                <div class="block-price">
                  <p class="purple size18"><b>8,822,000</b></p>
                  <p class="size13 grey">Giá VND/2 đêm</p>
                  <p class="block-price-info">
                    <span>Bao gồm: Ăn sáng.</span>
                    <span>Phí dịch vụ 5%, VAT 10%</span>
                  </p>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
</section>

<?php if(isset($_GET['details'])) { ?>
<script type="text/javascript">
    $(window).load(function(){
        $('#details<?php echo $_GET['details'];?>').modal('show');
    });
</script>
<?php } ?>

<script type="text/javascript">
    $(window).load(function(){
    
    $(".successemail<?php echo $item->id; ?>").on('click', function(){ 
    var youremail = $(".youremail").val();
    var yourphone = $(".yourphone").val();
    var itemid = <?php echo $module->id; ?>;
    var duration = "từ " + $(".dpd1").val() + " đến " + $(".dpd2").val();
    $('#getresponse<?php echo $module->id; ?>').html('<div id="rotatingDiv"></div>');
    $.post("<?php echo base_url(); ?>admin/ajaxcalls/laygiaEmail", {email: youremail, phone: yourphone, id: itemid, hotel: duration}, function(resp){
    //alert(resp);
    if (resp === "done") {
    console.log(resp);
    $("#getresponse<?php echo $module->id; ?>").html("");
    $('.email-me-modal<?php echo $module->id; ?>').modal('hide');
    $('#openModal<?php echo $module->id; ?>').modal('show');
    var myModal = $('#openModal<?php echo $module->id; ?>');
    clearTimeout(myModal.data('hideInterval'));
    myModal.data('hideInterval', setTimeout(function(){
    myModal.modal('hide');
    }, 4000));
    } else {alert(resp); $("#getresponse<?php echo $module->id; ?>").html("<span class='error'>Đã có lỗi xảy ra, chúng tôi đang xem xét.<span>");}
    });
    });
    });
</script>

<div id="emailme<?php echo $module->id; ?>" class="modal fade email-me-modal<?php echo $module->id; ?>" tabindex="-1" data-focus-on="input:first" style="display: none;">
    <div class="modal-dialog click-2email">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <div class="hotel-name">
                    <?php echo trans('0801'); ?>
                </div>
            </div>
            <div class="modal-body">
                <div class="panel-body">
                    <div class="col-md-12 col-sm-12 col-xs-12 go-right">
                        <div class="form-group">
                            <div class="clearfix"></div>
                            <input type="text" placeholder="<?php echo trans('0804'); ?> " name="youremail" id="youremail<?php echo $module->id; ?>" class="form-control youremail" required >
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12 go-right">
                        <div class="form-group">
                            <div class="clearfix"></div>
                            <input type="text" placeholder="<?php echo trans('0805'); ?> " name="yourphone" id="yourphone<?php echo $module->id; ?>" class="form-control yourphone" required >
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <br>
                    <div class="hotel-modal-title"><?php echo trans('0802'); ?></div>
                    <br>
                    <!--<a id="successemail" style="margin-bottom:5px;float:none;" href="#openModal" type="submit" class="btn btn-action chk successemail" data-toggle="modal" data-content="<?php echo trans('0800'); ?>" rel="popover" data-placement="top" data-original-title="<?php echo $item->title; ?>" data-trigger="hover"><?php echo trans('0806'); ?></a>-->
                    <button id="successemail<?php echo $module->id; ?>" style="margin-bottom:5px;float:none;" type="submit" class="btn btn-action chk successemail<?php echo $item->id; ?>"><?php echo trans('0806'); ?></button>
                    <div id="getresponse<?php echo $module->id; ?>"></div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
</div><!-- modal -->

<div id="openModal<?php echo $module->id; ?>" class="modal fade" tabindex="-1" data-focus-on="input:first" style="display: none;">
    <div class="modal-dialog email-confirm">
        <div class="modal-content">
            <div class="modal-body">
                <div class="panel-body">
                    <div class='purple'><strong><i class='fa fa-check-square-o' aria-hidden='true'></i> <?php echo trans('0807'); ?></strong></div>
                    <div><?php echo trans('0808'); ?></div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
</div><!-- modal -->

<script>
$(document).ready(function(){
  $('.tooltip-info').tooltip({title: '<div class="block-tooltip-info-price-rooms"><div class="tooltip-inner"><p>Giá phòng/đêm</p><p class="purple size14">Ocean Villa 2 phòng ngủ</p><p>Đêm 20/11: 760,000 VND</p><p>Đêm 21/11: 1,230,000 VND</p><p>Tổng 2 đêm: 1.990,000 VND</p></div></div>', html: true, placement: 'bottom', customClass: 'tooltip-custom'}); 
});
</script>