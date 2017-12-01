<!-- End row -->
<div id="ADDREVIEW" class="panel-collapse collapse">
    <div class="panel panel-default">
        <div class="panel-heading"><?php echo trans('083');?> <a href="#ADDREVIEW" data-toggle="collapse" data-parent="#accordion"><span class="badge badge-default pull-right">x</span></a></div>
        <div class="panel-body">
            <span class="RTL">
                <p>Chào bạn!</p>
                <p>Cảm ơn bạn đã dành một chút thời gian để đánh giá về khách sạn Novotel Phú Quốc. Đánh giá của bạn là thước đo để khách sạn chúng tôi có thể cải thiện chất lượng hàng ngày  nhằm mang đến cho khách hàng sự trải nghiệm tốt nhất.</p>
                <br>
                <p>Và để đánh giá một khách sạn chân thực hơn. Quý khách vui lòng nhập email hoặc mã đặt phòng để đánh giá. Quý khách chỉ có thể đánh giá khi đã sử dụng dịch vụ của khách sạn thông qua hệ thống đặt phòng của www.hospi.vn</p>
                <!-- <p><?php echo trans('0753');?></p>
                <p><?php echo trans('0754');?></p> -->
            </span>
            <form class="form-horizontal row" method="POST" id="reviews-form-<?php echo $module->id;?>" action="" onsubmit="return false;">
                <div id="review_result<?php echo $module->id;?>" >
                </div>
                <div class="alert resp" style="display:none"></div>
                <div class="col-md-12">
                    <div class="row">
                        <div style="margin-bottom: 15px;">
                            <div class="col-md-7">
                                <input class="form-control" type="text" id="bookingcode" name="bookingcode" placeholder="<?php echo trans('0755');?>">
                                <input class="form-control" id="fullname" type="hidden" name="fullname">
                                <input class="form-control" id="email" type="hidden" name="email">
                                <p>Mã đặt phòng hoặc email này chưa được sử dụng để đặt phòng tại Novotel Phú Quôc. Quý khách vui lòng nhập lại</p>
                            </div>
                            <div class="col-md-2 row">
                                <input type="button" id="write" value="<?php echo trans('0756');?>" name="Review" class="write btn btn-success btn-block andes">
                            </div>
                            <div class="clearfix"></div>
                            <div id="info" class="col-md-12"></div>
                            </div>
                    </div><!-- row -->
                    <div id="reviewform">
                        <p><strong class="purple">Võ Đình Chí</strong></p>
                        <p>Đã ở 2 đêm ngày 20/10/2017</p>
                        <br>
                        <textarea class="form-control" type="text" placeholder="<?php echo trans('0391');?>" name="reviews_comments" id="" cols="30" rows="10" style="border-radius: 10px;"></textarea>
                        <div class="form-group"></div>
                        <input type="hidden" name="addreview" value="1" />
                        <input type="hidden" name="overall" id="overall" />
                        <input type="hidden" name="reviewmodule" value="<?php echo $appModule; ?>" />
                        <input type="hidden" name="reviewfor" value="<?php echo $module->id; ?>" />
                    </div><!-- reviewform -->
                    <div class="block-review">
                        <p>Qua việc sử dụng dịch vụ tại khách sạn, Cảm nhận của bạn thế nào hãy cho chúng tôi  biết thông quan điểm đánh giá. Bằng chác đưa chuột vào khung màu tím  và kéo ra</p>
                        <!-- <h3 class="text-center"><strong><?php echo trans('0389');?> </strong>&nbsp;<span id="avgall">1</span> / 10</h3> -->
                        <div class="form-horizontal row">
                            <div class="col-sm-4 col-sm-push-4 col-xs-12">
                                <div class="block-process-evaluate block-process-evaluate2">
                                    <div class="clearfix">
                                        <div class="circle-evaluate c100 p<?php echo $avgReviews->overall * 10;?>">
                                            <span>
                                                <small><?php echo $avgReviews->overall;?></small>
                                                <hr>
                                                <small>10</small>
                                            </span>
                                            <div class="slice">
                                                <div class="bar"></div>
                                                <div class="fill"></div>
                                            </div>
                                        </div><!-- circle-evaluate -->
                                        <div class="clearfix"></div>
                                        <p class="andes purple size25 text-center" style="margin-top: 10px;">&ldquo;<?php echo $avgOverall[review_overall_level($avgReviews->overall)][0]; ?>&rdquo;</p>
                                        <p class="text-center">(Điểm đánh giá của bạn)</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-md-pull-4 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label"><?php echo trans('030');?></label>
                                    <input id="reviews_clean" data-slider-id='reviews' type="text" name="reviews_clean" data-slider-handle="custom" data-slider-min="1" data-slider-max="10" data-slider-step="1" data-slider-value="1" />
                                    <span class="txt txt2">7.9</span>
                                </div>
                                <div class="form-group">
                                    <label class="control-label"><?php echo trans('0722');?></label>
                                    <input id="reviews_comfort" type="text" name="reviews_comfort" data-slider-handle="custom" data-slider-min="1" data-slider-max="10" data-slider-step="1" data-slider-value="1" />
                                    <span class="txt txt2">7.9</span>
                                </div>
                                <div class="form-group">
                                    <label class="control-label"><?php echo trans('032');?></label>
                                    <input id="reviews_location" type="text" name="reviews_location" data-slider-handle="custom" data-slider-min="1" data-slider-max="10" data-slider-step="1" data-slider-value="1" />
                                    <span class="txt txt2">7.9</span>
                                </div>
                            </div>
                            <div class="col-sm-4 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label"><?php echo trans('033');?></label>
                                    <input id="reviews_facilities" type="text" name="reviews_facilities" data-slider-handle="custom" data-slider-min="1" data-slider-max="10" data-slider-step="1" data-slider-value="1" />
                                    <span class="txt txt2">7.9</span>
                                </div>
                                <div class="form-group">
                                    <label class="control-label"><?php echo trans('034');?></label>
                                    <input id="reviews_staff" type="text" name="reviews_staff" data-slider-handle="custom" data-slider-min="1" data-slider-max="10" data-slider-step="1" data-slider-value="1" />
                                    <span class="txt txt2">7.9</span>
                                </div>
                                <div class="form-group">
                                    <label class="control-label"><?php echo trans('0720');?></label>
                                    <input id="reviews_anuong" type="text" name="reviews_anuong" data-slider-handle="custom" data-slider-min="1" data-slider-max="10" data-slider-step="1" data-slider-value="1" />
                                    <span class="txt txt2">7.9</span>
                                </div>
                            </div>
                        </div>
                    </div><!-- well -->
                    <div class="row">
                        <div class="col-md-12">
                            <hr>
                            <p><strong><?php echo trans('0371');?></strong> : <?php echo trans('085');?></p>
                            <div class="row" style="margin-top: 15px; margin-bottom: 15px;">
                                <div class="col-sm-3">
                                    <p>Tuyệt vời: <span class="purple">9+</span></p>
                                    <p>Rất tốt:: <span class="purple">8 - 9</span></p>
                                    <p>Tốt: <span class="purple">6 - 8</span></p>
                                </div>
                                <div class="col-sm-3">
                                    <p>Tạm được: <span class="purple">5 - 6</span></p>
                                    <p>Kém: <span class="purple">3 - 5</span></p>
                                    <p>Rất tệ: <span class="purple">1 - 3</span></p>
                                </div>
                            </div>
                            <button type="button" class="btn btn-primary addreview" id="<?php echo $module->id; ?>" style="width: 300px; border-radius: 5px; font-weight: bold;"><?php echo trans('086');?></button>
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
    $("#write").click(function() {
    var input = $("#bookingcode").val();
    $("#info").html("<div id='rotatingDiv'></div>");
    $.post("<?php echo base_url();?>home/ajax_getCustominfo", {
        bookingcode: input
    },
         function(response) {
            if (response.length == 0) {
                console.log("NO DATA!")
            } else {
                console.log(response);
                var json_obj = $.parseJSON(response); //parse JSON
                //var json_obj = JSON.parse(JSON.stringify(response));
                var output = "<div class='custom-info'>";
                for (var i in json_obj) {
                    if (json_obj.hasOwnProperty(i)) {
                        output += "<p>Họ tên: " + json_obj[i].ai_first_name + " " + json_obj[i].ai_last_name;
                        output += "<br>Đã ở " + json_obj[i].booking_nights + " đêm vào ngày " + json_obj[i].booking_checkin + "</p>";
                        $('#fullname').val(json_obj[i].ai_first_name + " " + json_obj[i].ai_last_name);
                        $('#email').val(json_obj[i].accounts_email);
                        $("#reviewform").show(500);
                    }
                }
                output += "</div>";
                $('#info').html(output);
            }
        }

     )
     });
     }); //]]>
        
</script>