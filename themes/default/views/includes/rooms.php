<section id="ROOMS" style="background-color:#FFFFFF" style="position: relative;">
  <div style="background-color:#fff">
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
                    <h5 class="text-left size16"><strong><i class="icon_set_1_icon-83"></i> <?php echo $modulelib->stay; ?> đêm</strong> </h5>
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
        <form action="<?php echo base_url() . $appModule; ?>/book/<?php echo $module->bookingSlug; ?>" method="GET">
        <input type="hidden" name="adults" value="<?php echo $modulelib->adults; ?>" />
        <input type="hidden" name="child" value="<?php echo $modulelib->children; ?>" />
        <input type="hidden" name="checkin" value="<?php echo $modulelib->checkin; ?>" />
        <input type="hidden" name="checkout" value="<?php echo $modulelib->checkout; ?>" />
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
            <?php if (!empty($rooms)) { 
              $i = 0;
              ?>
              <?php foreach ($rooms as $r) { 
                $i++;               
                ?>
                <input type="hidden" name="room_id[]" value="<?php echo $r->id; ?>" />
            <tr>
              <td>
                <div class="zoom-gallery">
                  <div class="zoom-gallery<?php echo $r->id; ?>">
                      <a href="<?php echo $r->fullimage; ?>" data-source="<?php echo $r->fullimage; ?>" title="<?php echo $r->title; ?>">
                          <img class="img-responsive" src="<?php echo $r->thumbnail; ?>">
                      </a>
                  </div>
                </div>
                <div class="info">
                  <h4 class="RTL go-text-right"><b class="purple"><?php echo $r->title; ?>-<?php echo $r->id; ?></b></h4>
                  <div class="block-people">
                    <h5>Người lớn: <span><?php echo $r->room_adults; ?></span> </h5>
                    <h5>Trẻ em: <span><?php echo $r->room_children; ?></span></h5>
                  </div>
                  <div class="block-view-detail">
                    <div class="visible-lg visible-md go-right" id="accordion" style="margin-top: 0px;">
                      <a data-toggle="modal" href="#details<?php echo $r->id; ?>">Xem chi tiết</a>
                    </div>
                  </div>
              </td>
              <td>
                <div class="item-countroom">
                  <h5 class="size12">Số phòng</h5>
                  <select class="form-control" name="room_quantity[<?php echo $r->id; ?>]" >
                    <option value="0">0</option>
                    <?php for($k = 1; $k <= $r->maxQuantity; $k++){ ?>
                      <option value="<?php echo $k; ?>"><?php echo $k; ?></option>
                      <?php } ?>
                    </select>
                  </select>
                </div>
                <div class="item-countroom">
                  <h5 class="size12">Giường phụ</h5>
                  <select name="extra_beds[<?php echo $r->id; ?>]" class="form-control">
                  <option value="0">0</option>
                  <?php for($j = 1; $j <= $r->extraBeds; $j++){ ?>
                    <option value="<?php echo $j; ?>"><?php echo $j; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </td>
              <td>
                <div class="block-price">
                  <p class="purple size18"><b><?php echo number_format($r->price['total']); ?></b></p>
                  <div class="size13 grey">
                    Giá VND/<?php echo $modulelib->stay; ?> đêm
                    <div class="block-price-info" style="display: inline-block;">
                      <i class="fa fa-question-circle"></i>
                      <div class="block-info-price-rooms">
                        <p>Giá phòng/đêm</p>
                        <p class="purple size14"><?php echo $r->title; ?></p>
                        <?php 
                        if(!empty($r->price['detail'])){                          
                            foreach($r->price['detail'] as $priceDetail){
                        ?>
                        <p>Đêm <?php echo date('d/m', strtotime($priceDetail->date_use)); ?>: <?php echo number_format($priceDetail->total); ?> VND</p>
                        <?php } } ?>
                        <p>Tổng <?php echo $modulelib->stay; ?> đêm: <?php echo number_format($r->price['total']); ?> VND</p>
                      </div>
                    </div>
                  </div>
                  <p class="block-price-info">
                    <span>Bao gồm: Ăn sáng.</span>
                    <span>Phí dịch vụ 5%, VAT 10%</span>
                  </p>
                </div>
              </td>
              <?php if($i == 1){ ?>
              <td rowspan="<?php echo count($rooms); ?>">
                <p><button style="margin-bottom:5px" type="submit" class="btn btn-action btn-block chk">Đặt phòng</button></p>
                <p class="size13">Bạn vui lòng chọn số lượng phòng, Bạn có thể đặt một lúc nhiều loại phòng </p>
                <hr>
                <p class="purple andes-bold size13 text-center">Yêu cầu giường</p>
                <p class="size13 text-center"><label class="radio-inline"><input type="radio" name="radiobeds" value="1">1 giường</label></p>
                <p class="size13 text-center"><label class="radio-inline"><input type="radio" name="radiobeds" value="2">2 giường</label></p>
              </td>
              <?php } ?>
            </tr>    
            <?php } ?>
            <?php } ?>        
          </tbody>
        </table>
        </form>
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