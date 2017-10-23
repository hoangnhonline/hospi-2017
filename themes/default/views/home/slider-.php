<!--<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>-->
<!--<script type="text/javascript" src="//code.jquery.com/ui/1.8.18/jquery-ui.min.js"></script>-->
<!--<link rel="stylesheet" type="text/css" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.17/themes/base/jquery-ui.css">
 <style type="text/css">
    .ui-autocomplete-category {
        font-weight: bold;
        padding: .2em .4em;
        margin: .8em 0 .2em;
        line-height: 1.5;
    }
  </style>-->
<!-- WRAP -->
<div class="wrap ctup">
<div class="slideup">
  <div class="z-index100" style="background-color:#fff">
       <div class="col-md-12 scolright go-left visible-lg visible-md">
          <div class="row">
            <div id="Carousel" class="carousel slide carousel-fade">
              <div class="carousel-inner fadeIn animated">
                <?php $mulcur = ""; $mainslides = pt_get_main_slides(); $scount = 0; foreach($mainslides as $ms){ $sliderlib->set_id($ms->slide_id); $sliderlib->slide_details(); $scount++; $sactive = ""; if($scount == 1){ $sactive = "active"; }else{ $sactive = ""; } ?>
                <div class="item <?php echo $sactive; ?>">
                  <div class="slider">
                    <a href="<?php echo $ms->slide_link;?>" title="<?php echo $ms->slide_link_title;?>">
                      <img style="width:100%" src="<?php echo PT_SLIDER_IMAGES.$ms->slide_image;?>">
                    </a>
                  </div>
                  <div class="container">
                    <div class="carousel-caption">
                      <h5 style="font-size:30px;font-family: "OpenSansLight", sans-serif;" class="fadeInUp animated text-right go-left"><?php echo $sliderlib->title;?></h5><div class="clearfix"></div>
                      <h1 style="font-size:40px;" class="bounceIn animated text-right  go-left"><strong style="/*background-color: rgba(0, 0, 0, 0.35);*/padding: 18px 0 0;border-top:2px solid #fff"><?php echo $sliderlib->desc;?></strong></h1><div class="clearfix"></div>
                      <p style="font-size:26px;/*color:yellow;margin-top:10px*/" class="slim uppercase fadeInDown animated text-right go-left" style="text-shadow: 0 5px 7px rgba(9, 9, 15, 0.6); color:#FFFF00"><?php echo $sliderlib->optionalText;?></p><div class="clearfix"></div>
                      <br/>
                      <p></p>
                    </div>
                  </div>
                </div>
                <?php } ?>
              </div>
              <a class="left carousel-control" href="#Carousel" data-slide="prev">
              <span class="glyphicon-chevron-left fa fa-angle-left"></span>
              </a>
              <a class="right carousel-control" href="#Carousel" data-slide="next">
              <span class="glyphicon-chevron-right fa fa-angle-right"></span>
              </a>
            </div>
          </div>
        </div>
      <div  style="position:absolute;width:100%;z-index: 100;top:0">
      <div class="container">
      <div class="col-md-12 col-xs-12 go-right RTL_Bar" style="padding-right:0px;padding-left:0px;margin-top:25px">

          <div class="tab-content row" ng-controller="autoSuggest">

            <!-- Hotels  -->
            <div role="tabpanel" class="tab-pane fade active in <?php pt_searchbox('hotels'); ?>" id="HOTELS" aria-labelledby="home-tab">
            <?php if(pt_main_module_available('hotels')){ ?> <form action="<?php echo base_url();?>hotels/search" method="GET" role="search">
            <div class="col-xs-12 col-md-3 col-lg-4 col-sm-12 go-right"> <div class="form-group">
            <div class="form-group">

            <!--<div angucomplete-alt id="hotelsSearch" input-name="txtSearch" placeholder="<?php echo trans('026');?>" pause="500" selected-object="selectedItem" remote-url="<?php echo base_url();?>home/suggestions/hotels" remote-url-request-formatter="remoteUrlRequestFn" remote-url-data-field="items" title-field="name" description-field="" minlength="2" input-class="form-control form-control-small wow fadeIn" match-class="highlight"></div>-->
                <input id="search" name="txtSearch" class="form-control form-control-small" placeholder="<?php echo trans('026');?>"/>
            <div id="autocomlete-container"></div>

            </div>
            </div> </div>
            <div class="home row col-md-2 col-sm-6 col-xs-6 go-right"> <div class="form-group"> <div class="clearfix"></div>  <input type="text" placeholder=" <?php echo trans('07');?> " name="checkin" class="form-control mySelectCalendar dpd1 go-text-left" value="<?php echo $checkin; ?>" required > </div> </div>
            <div class="col-md-2 col-sm-6 col-xs-6 go-right"> <div class="form-group"> <div class="clearfix"></div>  <input type="text" placeholder=" <?php echo trans('09');?> " name="checkout" class="form-control mySelectCalendar dpd2 go-text-left" value="<?php echo $checkout; ?>" required > </div> </div>
            <div class="home row col-md-2 col-lg-1 col-sm-6 col-xs-6 go-right">
              <select class="form-control selectx" name="adults"><option selected><?php echo trans('010');?></option>
                <?php for($i=1;$i<=20;$i++) {

                  echo '<option value="'.$i.'">';
                  echo $i .'</option>';}?>
              </select>
          </div>
            <div class="hidden-md col-lg-1 col-sm-6 col-xs-6 go-right">
                <select class="form-control selectx" name="child"><option selected><?php echo trans('011');?></option>
                <?php for($j=0;$j<=10;$j++) {

                  echo '<option value="'.$j.'">';
                  echo $j.'</option>';}?>
                </select>
            </div>
            <div class="home row hidden-md col-lg-1 col-sm-6 col-xs-6 go-right plus panel-heading" data-toggle="collapse" data-target="#collapseOne">
                <a class="go-right" href="#" ><i class="fa fa-plus" aria-hidden="true"></i></a>
                </div>
            <div class="home row col-md-3 col-lg-2 col-xs-12 col-sm-12 go-right"> <div class="form-group"> <div class="clearfix"></div>  <div class="clearfix"></div><input id="searching" type="hidden" name="searching" value="{{searching}}"> <input id="modType" type="hidden" name="modType" value="{{modType}}"> <button type="submit"  class="btn-action btn btn-lg btn-block"><i class="icon_set_1_icon-78"></i> <?php echo trans('012');?></button> </div> </div>
            <div class="container"><div class="col-md-12 col-xs-12 go-right" style="padding-right:0px;padding-left:0px;">
            <div id="collapseOne" class="collapse">
                        <div class="space-content">&nbsp;</div>
                        <div class="white-line"></div>
                        <div class="col-md-3 ask-group">
          <div class="ask-item">
              <i class="fa fa-users" aria-hidden="true"></i> <a id="doan" href="#datphongdoan" data-toggle="modal" data-content="<?php echo trans('0742');?>" rel="popover" data-placement="top" data-original-title="<?php echo trans('0742');?>" data-trigger="hover"><?php echo trans('0742');?></a>

          </div>
          <div class="ask-item">
              <i class="fa fa-clock-o" aria-hidden="true"></i> <a id="nhanh" href="#datphongnhanh" data-toggle="modal" data-content="<?php echo trans('0743');?>" rel="popover" data-placement="top" data-original-title="<?php echo trans('0743');?>" data-trigger="hover"><?php echo trans('0743');?></a>
          </div>
          </div>
          <div class="col-md-1"></div>
          <div class="col-md-3 div-coupon">
              <div class="ask-coupon"><?php echo trans('0516');?></div>
              <input type="text" class="form-control inputcoupon" name="inputcoupon" placeholder="<?php echo trans('0745');?>">
              <div class="now-coupon"><?php echo trans('0746');?>&nbsp;<a href="#" class="lblue"><?php echo trans('0747');?></a></div>
          </div>
          <div class="col-md-3 div-issale">
             <span class="txt-label-issale"><?php echo trans('0744');?></span><input type="checkbox" id="issale" name="issale" class="hospi-checkbox" value="yes">  <label for="issale" class="hospi-label">&nbsp;</label>
          </div>
                        <div class="clearfix" style="margin-bottom:10px;"></div>
            </div>
            </div></div>
            </form> <?php } ?>






                <div class="clearfix"></div>
            </div>
            <!-- Hotels  -->





    </div>







            </div>
        </div>
        </div>
        <div class="clearfix"></div>
        </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    $('.carousel').carousel({
      interval: 9000
    })
  });
</script>
<script type='text/javascript'>//<![CDATA[
$(window).load(function(){
var tally = new Object();
var idx;

$.widget("custom.catcomplete", $.ui.autocomplete, {
    _renderMenu: function(ul, items) {
        var self = this,currentCategory = "";
        $.each(items, function(index, item) {
            if (item.category != currentCategory) {
                /*ul.append("<li class='ui-autocomplete-category'>" + item.category + "(<span id='autocomplete_"+item.category+"'></span>)</li>");*/
                ul.append("<li class='ui-autocomplete-category'>" + item.category + "</li>");
                currentCategory = item.category;
            }
            if(currentCategory!=''){
                tally[currentCategory] = (tally[currentCategory]==undefined) ? 1 : tally[currentCategory]+1;}
            self._renderItem(ul, item);
            $(ul).append("<span title='" + item.address + "' class='desc'>" + item.desc + " <i class='fa fa-map-marker' aria-hidden='true'></i></span><div style='clearfix'></div>");

        });
        for(category in tally){
            $('#autocomplete_'+category).html(tally[category]);
        };
    }

});


var data = [

            <?php $locationlistings = getLocations();
                        foreach($locationlistings as $list){
                            echo '{ label: "'.$list->location.'", category: "Bạn muốn đặt khách sạn ở đâu", modType: "location", id: "'.$list->id.'", desc: "Tỉnh thành", address: ""},';
                        } ?>
            <?php $hotellistings = getHotels();
                foreach($hotellistings->locations as $hotel){
                echo '{ label: "'.$hotel->hotel_title.'", category: "Khách sạn", modType: "hotel", id: "'.$hotel->hotel_id.'", desc: "'.$hotel->city.'", address: "'.$hotel->address.' - '.$hotel->near.'"},';
            } ?>
];

$( "#search" ).catcomplete({
    source: data,
    appendTo: "#autocomlete-container",
    select: function(event, ui) {
            $('#search').val(ui.item.label);
            // and place the item.id into the hidden textfield called 'searching'.
            $('#searching').val(ui.item.id);
            $('#modType').val(ui.item.modType);
                return false;
        }
});

$(".successemail").on('click',function(){
    var metadesc = $(".metadesc").val();
    var yourname = $(".yourname").val();
    var yourphone = $(".yourphone").val();
    var youremail = $(".youremail").val();
    $("#mailresponse").html("<div id='rotatingDiv'></div>");
    $.post("<?php echo base_url();?>admin/ajaxcalls/datphongnhanhEmail", {email: youremail,name: yourname, phone: yourphone, msg: metadesc}, function(resp){
    //alert(resp);
    if(resp==="done") {
    console.log(resp);

    $("#mailresponse").html("");
    $('.datphongnhanh').modal('hide');
                $('#openModal').modal('show');
                var myModal = $('#openModal');
                    clearTimeout(myModal.data('hideInterval'));
                    myModal.data('hideInterval', setTimeout(function(){
                        myModal.modal('hide');
                    }, 4000));
                } else {alert(resp);$("#mailresponse<?php echo $item->id; ?>").html("<span class='error'>Đã có lỗi xảy ra, chúng tôi đang xem xét.<span>");}
    });
  })


});//]]>

</script>

<div id="datphongnhanh" class="modal fade datphongnhanh" tabindex="-1" data-focus-on="input:first" style="display: none;">
    <div class="modal-dialog modal-dat-phong-nhanh">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <div class="hotel-name">
                    <?php echo trans('0811');?>
                </div>
            </div>
            <div class="modal-body">
                <div class="panel-body">
                    <div class="col-md-12 col-sm-12 col-xs-12 go-right">
                        <ul class="dat-phong">
                            <li><?php echo trans('0812');?></li>
                            <li><?php echo trans('0813');?></li>
                            <li><?php echo trans('0814');?></li>
                        </ul>
                    </div>
                    <p><strong><?php echo trans('0815');?></strong></p>
                    <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 go-right">
                            <div class="form-group">
                              <div class="clearfix"></div>
                              <textarea name="metadesc" placeholder="<?php echo trans('0816');?>" class="form-control metadesc" id="" cols="30" rows="4" required></textarea>
                            </div>
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12 go-right">
                            <div class="form-group">
                              <div class="clearfix"></div>
                              <label><?php echo trans('0803');?></label>
                              <input type="text" name="yourname" id="yourname" class="form-control yourname" required >
                            </div>

                            <div class="form-group">
                              <div class="clearfix"></div>
                              <label><?php echo trans('0805');?></label>
                              <input type="text" name="yourphone" id="yourphone" class="form-control yourphone" required >
                            </div>

                            <div class="form-group">
                              <div class="clearfix"></div>
                              <label><?php echo trans('0804');?></label>
                              <input type="text" name="youremail" id="youremail" class="form-control youremail" required >
                            </div>
                    </div>
                        <div class="col-md-6 col-sm-12 col-xs-12 go-right" style="text-align: center;">

                                <button id="successemail" style="margin-bottom:5px;float:none;margin-top:50px;" type="submit" class="btn btn-action chk successemail"><?php echo trans('0811'); ?></button>
                            <div id="mailresponse"></div>
                        </div>
                    </div>

                    <div class="clearfix"></div>
                </div>
            </div>

        </div>
    </div>
</div>

<div id="datphongdoan" class="modal fade datphongnhanh" tabindex="-1" data-focus-on="input:first" style="display: none;">
    <div class="modal-dialog modal-dat-phong-nhanh">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <div class="hotel-name">
                    <?php echo trans('0823');?>
                </div>
            </div>
            <div class="modal-body">
                <div class="panel-body">
                    <div class="col-md-12 col-sm-12 col-xs-12 go-right">
                        <ul class="dat-phong">
                            <li><?php echo trans('0812');?></li>
                            <li><?php echo trans('0813');?></li>
                            <li><?php echo trans('0814');?></li>
                        </ul>
                    </div>
                    <p><strong><?php echo trans('0815');?></strong></p>
                    <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 go-right">
                            <div class="form-group">
                              <div class="clearfix"></div>
                              <textarea name="metadesc" placeholder="<?php echo trans('0816');?>" class="form-control metadesc" id="" cols="30" rows="4" required></textarea>
                            </div>
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12 go-right">
                            <div class="form-group">
                              <div class="clearfix"></div>
                              <label><?php echo trans('0803');?></label>
                              <input type="text" name="yourname" id="yourname" class="form-control yourname" required >
                            </div>

                            <div class="form-group">
                              <div class="clearfix"></div>
                              <label><?php echo trans('0805');?></label>
                              <input type="text" name="yourphone" id="yourphone" class="form-control yourphone" required >
                            </div>

                            <div class="form-group">
                              <div class="clearfix"></div>
                              <label><?php echo trans('0804');?></label>
                              <input type="text" name="youremail" id="youremail" class="form-control youremail" required >
                            </div>
                    </div>
                        <div class="col-md-6 col-sm-12 col-xs-12 go-right" style="text-align: center;">

                                <button id="successemail" style="margin-bottom:5px;float:none;margin-top:50px;" type="submit" class="btn btn-action chk successemail"><?php echo trans('0823'); ?></button>
                            <div id="mailresponse"></div>
                        </div>
                    </div>

                    <div class="clearfix"></div>
                </div>
            </div>

        </div>
    </div>
</div>

<div id="openModal" class="modal fade" tabindex="-1" data-focus-on="input:first" style="display: none;">
    <div class="modal-dialog email-confirm">
        <div class="modal-content">

            <div class="modal-body">
                <div class="panel-body">
                        <div class='purple'><strong><i class='fa fa-check-square-o' aria-hidden='true'></i> <?php echo trans('0817');?></strong></div>
                        <div><?php echo trans('0818');?></div>
                        <div class="clearfix"></div>
                </div>
            </div>

        </div>
    </div>
</div>
