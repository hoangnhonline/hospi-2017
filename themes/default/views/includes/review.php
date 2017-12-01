<!-- End row -->
<div id="ADDREVIEW" class="panel-collapse collapse">
    <div class="panel panel-default">
        <div class="panel-heading"><?php echo trans('083'); ?> <a href="#ADDREVIEW" data-toggle="collapse"
                                                                  data-parent="#accordion"><span
                        class="badge badge-default pull-right">x</span></a></div>
        <div class="panel-body">
            <span class="RTL">
                <p>Chào bạn!</p>
                <p>Cảm ơn bạn đã dành một chút thời gian để đánh giá về khách sạn Novotel Phú Quốc. Đánh giá của bạn là thước đo để khách sạn chúng tôi có thể cải thiện chất lượng hàng ngày  nhằm mang đến cho khách hàng sự trải nghiệm tốt nhất.</p>
                <br>
                <p>Và để đánh giá một khách sạn chân thực hơn. Quý khách vui lòng nhập email hoặc mã đặt phòng để đánh giá. Quý khách chỉ có thể đánh giá khi đã sử dụng dịch vụ của khách sạn thông qua hệ thống đặt phòng của www.hospi.vn</p>
            </span>
            <form class="form-horizontal row" method="POST" id="reviews-form-<?php echo $module->id; ?>" action=""
                  onsubmit="return false;">
                <div id="review_result<?php echo $module->id; ?>"></div>
                <div class="alert resp" style="display:none"></div>
                <div class="col-md-12">
                    <div class="row">
                        <div style="margin-bottom: 15px;">
                            <div class="col-md-7">
                                <input class="form-control" type="text" id="bookingcode" name="bookingcode"
                                       placeholder="<?php echo trans('0755'); ?>">
                            </div>
                            <div class="col-md-2 row">
                                <input type="button" id="write" value="<?php echo trans('0756'); ?>" name="Review"
                                       class="write btn btn-success btn-block andes">
                            </div>
                            <div class="clearfix"></div>
                            <div id="info" class="col-md-12"></div>
                        </div>
                    </div><!-- row -->
                    <div id="reviewform" style="display: none;">
                        <div class="customer_info"></div>
                        <textarea class="form-control" type="text" placeholder="<?php echo trans('0391'); ?>"
                                  name="reviews_comments" id="reviews_comments" cols="30" rows="10"
                                  style="border-radius: 10px; margin-bottom: 10px;"></textarea>
                        <div class="form-group"></div>
                        <input type="hidden" name="addreview" value="1"/>
                        <input type="hidden" name="overall" id="overall"/>
                        <input type="hidden" name="reviewmodule" value="<?php echo $appModule; ?>"/>
                        <input type="hidden" name="reviewfor" value="<?php echo $module->id; ?>"/>
                        <input type="hidden" id="fullname" name="fullname">
                        <input type="hidden" id="email" name="email">
                    </div><!-- reviewform -->
                    <div class="block-review">
                        <p>Qua việc sử dụng dịch vụ tại khách sạn, Cảm nhận của bạn thế nào hãy cho chúng tôi biết thông
                            quan điểm đánh giá. Bằng chác đưa chuột vào khung màu tím và kéo ra</p>
                        <div class="form-horizontal row">
                            <div class="col-sm-4 col-sm-push-4 col-xs-12">
                                <div class="block-process-evaluate block-process-evaluate2">
                                    <div class="clearfix">
                                        <div class="circle-evaluate c100 p10">
                                            <span>
                                                <small id="avgall">1.0</small>
                                                <hr>
                                                <small>10</small>
                                            </span>
                                            <div class="slice">
                                                <div class="bar"></div>
                                                <div class="fill"></div>
                                            </div>
                                        </div><!-- circle-evaluate -->
                                        <div class="clearfix"></div>
                                        <p class="andes purple size25 text-center" style="margin-top: 10px;" id="overall_text"></p>
                                        <p class="text-center">(Điểm đánh giá của bạn)</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-md-pull-4 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label"><?php echo trans('030'); ?></label>
                                    <input id="reviews_clean" data-slider-id='reviews' type="text" name="reviews_clean"
                                           data-slider-handle="custom" data-slider-min="1" data-slider-max="10"
                                           data-slider-step="1" data-slider-value="1"/>
                                    <!--<span class="txt txt2">7.9</span>-->
                                </div>
                                <div class="form-group">
                                    <label class="control-label"><?php echo trans('0722'); ?></label>
                                    <input id="reviews_comfort" type="text" name="reviews_comfort"
                                           data-slider-handle="custom" data-slider-min="1" data-slider-max="10"
                                           data-slider-step="1" data-slider-value="1"/>
                                    <!--<span class="txt txt2">7.9</span>-->
                                </div>
                                <div class="form-group">
                                    <label class="control-label"><?php echo trans('032'); ?></label>
                                    <input id="reviews_location" type="text" name="reviews_location"
                                           data-slider-handle="custom" data-slider-min="1" data-slider-max="10"
                                           data-slider-step="1" data-slider-value="1"/>
                                    <!--<span class="txt txt2">7.9</span>-->
                                </div>
                            </div>
                            <div class="col-sm-4 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label"><?php echo trans('033'); ?></label>
                                    <input id="reviews_facilities" type="text" name="reviews_facilities"
                                           data-slider-handle="custom" data-slider-min="1" data-slider-max="10"
                                           data-slider-step="1" data-slider-value="1"/>
                                    <!--<span class="txt txt2">7.9</span>-->
                                </div>
                                <div class="form-group">
                                    <label class="control-label"><?php echo trans('034'); ?></label>
                                    <input id="reviews_staff" type="text" name="reviews_staff"
                                           data-slider-handle="custom" data-slider-min="1" data-slider-max="10"
                                           data-slider-step="1" data-slider-value="1"/>
                                    <!--<span class="txt txt2">7.9</span>-->
                                </div>
                                <div class="form-group">
                                    <label class="control-label"><?php echo trans('0720'); ?></label>
                                    <input id="reviews_anuong" type="text" name="reviews_anuong"
                                           data-slider-handle="custom" data-slider-min="1" data-slider-max="10"
                                           data-slider-step="1" data-slider-value="1"/>
                                    <!--<span class="txt txt2">7.9</span>-->
                                </div>
                            </div>
                        </div>
                    </div><!-- well -->
                    <div class="row">
                        <div class="col-md-12">
                            <hr>
                            <p><strong><?php echo trans('0371'); ?></strong> : <?php echo trans('085'); ?></p>
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
                            <button type="button" class="btn btn-primary addreview" id="<?php echo $module->id; ?>"
                                    style="display: none; width: 300px; border-radius: 5px; font-weight: bold;"><?php echo trans('086'); ?></button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script type='text/javascript'>
    $(window).load(function () {
        var overallText = function (overall) {
            var arrPoint = [
                [9.1, 10, 'Tuyệt vời'],
                [8.1, 9, 'Rất tốt'],
                [6.1, 8, 'Tốt'],
                [5.1, 6, 'Tạm được'],
                [3.1, 5, 'Kém'],
                [1, 3, 'Rất tệ']
            ];

            var level = '';
            $.each(arrPoint, function(i, point) {
                if (point[0] <= overall && overall <= point[1]) {
                    level = point[2];
                    return false;
                }
            });

            return level;
        };

        var ScoreChange = function () {
            var score = (r1.getValue() + r2.getValue() + r3.getValue() + r4.getValue() + r5.getValue() + r6.getValue()) / 6;
            $('#avgall').html(score.toFixed(1));
            $('#overall').val(score.toFixed(1));
            $('#overall_text').html(overallText(score.toFixed(1)));
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
        
        $("#write").click(function () {
            var input = $("#bookingcode").val();
            $("#info").html("<div id='rotatingDiv'></div>");
            $.post("<?php echo base_url();?>home/ajax_getCustominfo", {
                    bookingcode: input
                },
                function (response) {
                    if (response.length == 0) {
                        $('#info').html('<p style="margin: 10px 0;">Mã đặt phòng hoặc email này chưa được sử dụng để đặt phòng tại <?php echo $module->title;?>.<br>Quý khách vui lòng nhập lại</p>');
                    } else {
                        var json_obj = $.parseJSON(response);
                        var output = "<p><strong class='purple'>" + json_obj.ai_first_name + " " + json_obj.ai_last_name + '</strong></p>';
                        output += "<p>Đã ở " + json_obj.booking_nights + " đêm vào ngày " + json_obj.booking_checkin + "</p>";
                        
                        $('#fullname').val(json_obj.ai_first_name + " " + json_obj.ai_last_name);
                        $('#email').val(json_obj.accounts_email);
                        
                        $('#reviewform .customer_info').html(output);
                        $("#reviewform, .addreview").show(500);
                    }
                }
            )
        });
    });
</script>