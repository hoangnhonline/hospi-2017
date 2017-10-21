<!-- End row -->
  <div id="ADDREVIEW" class="panel-collapse collapse">
    <div class="panel panel-default">
      <div class="panel-heading"><?php echo trans('083');?> <a href="#ADDREVIEW" data-toggle="collapse" data-parent="#accordion"><span class="badge badge-default pull-right">x</span></a></div>
      <div class="panel-body">
          <span class="RTL">
              <p><?php echo trans('0753');?></p>
              <p><?php echo trans('0754');?></p>
        </span>
        <form class="form-horizontal row" method="POST" id="reviews-form-<?php echo $module->id;?>" action="" onsubmit="return false;">
          <div id="review_result<?php echo $module->id;?>" >
          </div>
          <div class="alert resp" style="display:none"></div>
          <?php $mdCol = 12; if($appModule == "hotels"){ $mdCol = 8; ?>
          <div class="col-md-4 go-right">
            <div class="well well-sm">
              <h3 class="text-center"><strong><?php echo trans('0389');?> </strong>&nbsp;<span id="avgall">1</span> / 10</h3>
              <div class="row">
                <div class="col-md-6 form-horizontal">
                  <div class="form-group">
                    <div class="col-md-12">
                      <label class="control-label"><?php echo trans('030');?></label>
                      <input id="reviews_clean" data-slider-id='reviews' type="text" name="reviews_clean" data-slider-handle="custom" data-slider-min="1" data-slider-max="10" data-slider-step="1" data-slider-value="1" />
                    </div>
                  </div>
                    <div class="form-group">
                    <div class="col-md-12">
                      <label class="control-label"><?php echo trans('0722');?></label>
                        <input id="reviews_comfort" type="text" name="reviews_comfort" data-slider-handle="custom" data-slider-min="1" data-slider-max="10" data-slider-step="1" data-slider-value="1" />
                    </div>
                  </div>
                    <div class="form-group">
                    <div class="col-md-12">
                      <label class="control-label"><?php echo trans('032');?></label>
                        <input id="reviews_location" type="text" name="reviews_location" data-slider-handle="custom" data-slider-min="1" data-slider-max="10" data-slider-step="1" data-slider-value="1" />
                    </div>
                  </div>
                    <div class="form-group">
                    <div class="col-md-12">
                      <label class="control-label"><?php echo trans('033');?></label>
                        <input id="reviews_facilities" type="text" name="reviews_facilities" data-slider-handle="custom" data-slider-min="1" data-slider-max="10" data-slider-step="1" data-slider-value="1" />
                    </div>
                  </div>
                    <div class="form-group">
                    <div class="col-md-12">
                      <label class="control-label"><?php echo trans('034');?></label>
                        <input id="reviews_staff" type="text" name="reviews_staff" data-slider-handle="custom" data-slider-min="1" data-slider-max="10" data-slider-step="1" data-slider-value="1" />
                    </div>
                  </div>
                    <div class="form-group">
                    <div class="col-md-12">
                      <label class="control-label"><?php echo trans('0720');?></label>
                        <input id="reviews_anuong" type="text" name="reviews_anuong" data-slider-handle="custom" data-slider-min="1" data-slider-max="10" data-slider-step="1" data-slider-value="1" />
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>
          <?php } ?>
          <div class="col-md-<?php echo $mdCol;?>">
            <div class="row">
              <div class="col-md-8">
                <input class="form-control" type="text" id="bookingcode" name="bookingcode" placeholder="<?php echo trans('0755');?>">
                <input class="form-control" id="fullname" type="hidden" name="fullname">
                <input class="form-control" id="email" type="hidden" name="email">
              </div>
              <div class="col-md-4">
                <input type="button" id="write" value="<?php echo trans('0756');?>" name="Review" class="write btn-lg btn btn-success btn-block btn-lgs andes">
              </div>
                <div class="clearfix"></div>
                <div id="info" class="col-md-12"></div>
            </div>
            <div class="form-group"></div>
            <div id="reviewform">
            <textarea class="form-control" type="text" placeholder="<?php echo trans('0391');?>" name="reviews_comments" id="" cols="30" rows="10"></textarea>
            <div class="form-group"></div>
            <p class="text-danger"><strong><?php echo trans('0371');?></strong> : <?php echo trans('085');?></p>
            <input type="hidden" name="addreview" value="1" />
            <input type="hidden" name="overall" id="overall" />
            <input type="hidden" name="reviewmodule" value="<?php echo $appModule; ?>" />
            <input type="hidden" name="reviewfor" value="<?php echo $module->id; ?>" />
            <div class="form-group">
              <div class="col-md-12">
                <label class="control-label">&nbsp;</label>
                <button type="button" class="btn btn-primary btn-block btn-lg addreview" id="<?php echo $module->id; ?>" ><?php echo trans('086');?></button>
              </div>
            </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
<br><br>
<script type='text/javascript'>//<![CDATA[
$(window).load(function(){
    
    var ScoreChange = function() {
        var score = (r1.getValue()+r2.getValue()+r3.getValue()+r4.getValue()+r5.getValue()+r6.getValue())/6;
	$('#avgall').html(score.toFixed(1));
        $('#overall').val(score.toFixed(1));
        
        
};

var r1 = $('#reviews_clean').slider()
		.on('slide', ScoreChange)
		.data('slider');
var r2 = $('#reviews_comfort').slider()
		.on('slide', ScoreChange)
		.data('slider');
var r3 = $('#reviews_location').slider()
		.on('slide', ScoreChange)
		.data('slider');
var r4 = $('#reviews_facilities').slider()
        .on('slide', ScoreChange)
        .data('slider');
var r5 = $('#reviews_staff').slider()
        .on('slide', ScoreChange)
        .data('slider');
var r6 = $('#reviews_anuong').slider()
        .on('slide', ScoreChange)
        .data('slider');

$("#reviewform").hide();      
          $("#write").click(function(){
              var input = $("#bookingcode").val();
              $("#info").html("<div id='rotatingDiv'></div>");
              $.post("<?php echo base_url();?>home/ajax_getCustominfo",
              {bookingcode:input},
              function(response){
               if ( response.length == 0 ) {
                    console.log("NO DATA!")
                } else {  
                  console.log(response);
	    var json_obj = $.parseJSON(response);//parse JSON
            //var json_obj = JSON.parse(JSON.stringify(response));
            
            var output="<div class='custom-info'>";
            for (var i in json_obj)
            {   
                if (json_obj.hasOwnProperty(i)) {
                    output+="<p>Họ tên: " + json_obj[i].ai_first_name + " " + json_obj[i].ai_last_name;
                    output+="<br>Đã ở " + json_obj[i].booking_nights + " đêm vào ngày " + json_obj[i].booking_checkin +"</p>";
                    $('#fullname').val(json_obj[i].ai_first_name + " " + json_obj[i].ai_last_name);
                    $('#email').val(json_obj[i].accounts_email);
                    $("#reviewform").show(500); 
                    
                }
            }
            output+="</div>";
            
            $('#info').html(output);
            
            
            
            
            }
            }
            
            
    )}); 
});//]]> 
    </script> 

