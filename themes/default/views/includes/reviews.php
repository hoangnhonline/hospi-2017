<?php if(!empty($reviews) > 0){ ?>
<div id="REVIEWS">
    <div class="panel panel-default">
        <button type="button" class="collapsebtn last go-text-right" data-toggle="collapse" data-target="#collapse4" aria-expanded="true">
           <?php echo trans('0396');?><span class="collapsearrow"></span>
        </button>
        <div id="collapse4" class="collapse" aria-expanded="true">
            <div class="panel-body">
                <div class="block-process-evaluate block-process-evaluate2">
                    <div class="clearfix">
                        <div class="lft">
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
                            <p class="andes purple size25 text-center" style="margin-top: 10px;">&ldquo;Rất tốt&rdquo;</p>
                        </div>
                        <div class="rgt">
                            <?php if($appModule == "hotels"){ ?>
                            <!-- Start Hotel Reviews bars -->
                            <div class="block-scores row">
                                <div class="col-sm-6 col-sm-12">
                                    <div class="block-progress">
                                        <label class="text-left andes">Tuyệt vời: <span class="purple">9 +</span></label>
                                        <div class="progress-inner">
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-primary go-right" role="progressbar" aria-valuenow="20"
                                                    aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                                                    <span class="sr-only"></span>
                                                </div>
                                            </div><!-- progress -->
                                            <span class="txt">(30 đánh giá)</span>
                                        </div>
                                    </div>
                                    <div class="block-progress">
                                        <label class="text-left andes">Rất tốt: <span class="purple">8 - 9</span></label>
                                        <div class="progress-inner">
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-primary go-right" role="progressbar" aria-valuenow="20"
                                                    aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                                                    <span class="sr-only"></span>
                                                </div>
                                            </div><!-- progress -->
                                            <span class="txt">(30 đánh giá)</span>
                                        </div>
                                    </div>
                                    <div class="block-progress">
                                        <label class="text-left andes">Tốt: <span class="purple">6 - 8</span></label>
                                        <div class="progress-inner">
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-primary go-right" role="progressbar" aria-valuenow="20"
                                                    aria-valuemin="0" aria-valuemax="10" style="width: 80%">
                                                    <span class="sr-only"></span>
                                                </div>
                                            </div><!-- progress -->
                                            <span class="txt">(30 đánh giá)</span>
                                        </div>
                                    </div>
                                </div><!-- col-sm-6 col-sm-12 -->
                                <div class="col-sm-6 col-sm-12">
                                    <div class="block-progress">
                                        <label class="text-left andes">Tạm được: <span class="purple">5 - 6</span></label>
                                        <div class="progress-inner">
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-primary go-right" role="progressbar" aria-valuenow="80"
                                                    aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                                                    <span class="sr-only"></span>
                                                </div>
                                            </div><!-- progress -->
                                            <span class="txt">(30 đánh giá)</span>
                                        </div>
                                    </div>
                                    <div class="block-progress">
                                        <label class="text-left andes">Kém: <span class="purple">3 - 5</span></label>
                                        <div class="progress-inner">
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-primary go-right" role="progressbar" aria-valuenow="20"
                                                    aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                                                    <span class="sr-only"></span>
                                                </div>
                                            </div><!-- progress -->
                                            <span class="txt">(30 đánh giá)</span>
                                        </div>
                                    </div>
                                    <div class="block-progress">
                                        <label class="text-left andes">Rất tệ: <span class="purple">1 - 3</span></label>
                                        <div class="progress-inner">
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-primary go-right" role="progressbar" aria-valuenow="20"
                                                    aria-valuemin="0" aria-valuemax="10" style="width: 80%">
                                                    <span class="sr-only"></span>
                                                </div>
                                            </div><!-- progress -->
                                            <span class="txt">(30 đánh giá)</span>
                                        </div>
                                    </div>
                                </div><!-- col-sm-6 col-sm-12 -->
                            </div>
                            <!-- rows -->
                            <?php } ?>
                            <!-- End Hotel Reviews bars -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane active" id="tab-newtopic">
                <div class="table-responsive">
                    <div class="fixedtopic">
                            <?php if(!empty($reviews) && pt_is_module_enabled('reviews')){ foreach($reviews as $rev){ ?>
                            <div class="RTL">
                                <div class="customer <?php echo $rev->review_id;?>" style="width: 100px;vertical-align: middle;">
                                    <div class="c100 p<?php echo $rev->review_overall * 10;?>" style="margin-top:10px;margin-left: 20%;">
                                        <span><strong><?php echo $rev->review_overall;?> </strong>/<small>10</small></span>
                                        <div class="slice">
                                            <div class="bar"></div>
                                            <div class="fill"></div>
                                        </div>
                                    </div>
                                </div>
                                <div style="width: 200px;vertical-align: middle;">
                                    <span class="dark"><strong class="go-right"><?php echo $rev->review_name;?> &nbsp;</strong></span><br><span class="text-muted"><small><?php echo pt_show_date_php($rev->review_date);?></small></span> <br/>
                                </div>
                                <div><?php echo character_limiter($rev->review_comment,1000);?></div>
                            </div>
                            <?php } ?>
                        <div class="line3"></div>
                        <?php } ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-sm-12">
                        <label class="text-left andes"><?php echo trans('033');?></label>
                        <div class="progress">
                            <div class="progress-bar progress-bar-primary go-right" role="progressbar" aria-valuenow="20"
                                aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $avgReviews->facilities * 10;?>%">
                                <span class="sr-only"></span>
                            </div>
                        </div><!-- progress -->
                        <label class="text-left andes"><?php echo trans('0722');?></label>
                        <div class="progress">
                            <div class="progress-bar progress-bar-primary go-right" role="progressbar" aria-valuenow="20"
                                aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $avgReviews->comfort * 10;?>%">
                                <span class="sr-only"></span>
                            </div>
                        </div><!-- progress -->
                        <label class="text-left andes"><?php echo trans('0720');?></label>
                        <div class="progress">
                            <div class="progress-bar progress-bar-primary go-right" role="progressbar" aria-valuenow="20"
                                aria-valuemin="0" aria-valuemax="10" style="width: <?php echo $avgReviews ->anuong * 10;?>%">
                                <span class="sr-only"></span>
                            </div>
                        </div><!-- progress -->
                    </div><!-- col-sm-6 col-sm-12 -->
                    <div class="col-sm-6 col-sm-12">
                        <label class="text-left andes"><?php echo trans('034');?></label>
                        <div class="progress">
                            <div class="progress-bar progress-bar-primary go-right" role="progressbar" aria-valuenow="80"
                                aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $avgReviews->staff * 10;?>%">
                                <span class="sr-only"></span>
                            </div>
                        </div><!-- progress -->
                        <label class="text-left andes"><?php echo trans('032');?></label>
                        <div class="progress">
                            <div class="progress-bar progress-bar-primary go-right" role="progressbar" aria-valuenow="20"
                                aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $avgReviews->location * 10;?>%">
                                <span class="sr-only"></span>
                            </div>
                        </div><!-- progress -->
                        <label class="text-left andes"><?php echo trans('030');?></label>
                        <div class="progress">
                            <div class="progress-bar progress-bar-primary go-right" role="progressbar" aria-valuenow="20"
                                aria-valuemin="0" aria-valuemax="10" style="width: <?php echo $avgReviews->clean * 10;?>%">
                                <span class="sr-only"></span>
                            </div>
                        </div><!-- progress -->
                    </div><!-- col-sm-6 col-sm-12 -->
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>