<?php if(!empty($reviews) > 0){ ?>
<div id="REVIEWS">
    <div class="panel panel-default">
        <div class="panel-heading go-text-right"><?php echo trans('0396');?></div>
        <div class="panel-body">
            <div class="tab-pane active" id="tab-newtopic">
                <div class="table-responsive">
                    <div class="fixedtopic">
                        <table class="table-hover table table-striped">
                            <?php if(!empty($reviews) && pt_is_module_enabled('reviews')){ foreach($reviews as $rev){ ?>
                            <tr class="RTL">
                                <td class="customer <?php echo $rev->review_id;?>" style="width: 100px;vertical-align: middle;">
                                    
                                    <div class="c100 p<?php echo $rev->review_overall * 10;?>" style="margin-top:10px;margin-left: 20%;">
          <span><strong><?php echo $rev->review_overall;?> </strong>/<small>10</small></span>
          <div class="slice">
            <div class="bar"></div>
            <div class="fill"></div>
          </div>
        </div>
        <div class="clearfix"></div>
        
                                    <!--<div class="ratetd badge badge-warning">
                                    <div class="rate-point"><?php echo round($rev->review_overall,1);?></div>
                                    <div><?php echo trans('0721');?></div>
                                    </div>-->
                                </td>
                                <td style="width: 200px;vertical-align: middle;">
                                    <span class="dark"><strong class="go-right"><?php echo $rev->review_name;?> &nbsp;</strong></span><br><span class="text-muted"><small><?php echo pt_show_date_php($rev->review_date);?></small></span> <br/>
                                    
                                </td>
                                <td><?php echo character_limiter($rev->review_comment,1000);?></td>
                            </tr>
                            <?php } ?>
                        </table>
                        <div class="line3"></div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>


