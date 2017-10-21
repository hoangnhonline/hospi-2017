<?php if(pt_is_module_enabled('coupons')){  ?>
<div class="clearfix"></div>
<div class="panel panel-default">
  <div class="panel-heading go-text-right no-padding"><div class="hospi-heading"><i class="fa fa-asterisk"></i> <?php echo trans('0166');?></div></div>
  <div class="panel-body">
    <div class="col-md-5 go-right">
      <p class="RTL"><?php echo trans('0516');?><br>
        <!--<a id="popoverData" href="javascript:void(0);" data-content="<?php echo trans('0514');?>" rel="popover" data-placement="top" data-original-title="<?php echo trans('0515');?>" data-trigger="hover"><strong><?php echo trans('0515');?></strong></a>-->
      </p>
    </div>
    <div class="col-md-7 go-left">
      <div class="couponresult"></div>
      <div class="col-md-8 go-right">
        <input type="text" class="RTL form-control coupon" placeholder="<?php echo trans('0166');?>">
      </div>
      <div class="col-md-4 go-left">
        <span class="btn btn-action applycoupon"><?php echo trans('0517');?></span>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="couponmsg"></div>
  </div>
</div>
<script type="text/javascript">
  $(function(){
    $(".applycoupon").on("click",function(){
      var module = $("#btype").val();
      var itemid = $("#itemid").val();
      var coupon = $(".coupon").val();
      $.post("<?php echo base_url();?>admin/ajaxcalls/checkCoupon",{coupon: coupon, module: module, itemid: itemid},function(response){
       var resp = $.parseJSON(response);
       if(resp.status == "success"){
        $("#couponid").val(resp.couponid);
        $(".couponmsg").html(" <div class='alert alert-success'><?php echo trans('0512'); ?><strong> "+coupon+" </strong><?php echo trans('0821'); ?> <strong> "+resp.value+resp.type+" </strong><?php echo trans('0822'); ?></div>");
        $(".coupon").prop("readonly","readonly");
        $(".applycoupon").hide();
       }else{
        $("#couponid").val("");
        $(".couponmsg").html("");
        if(resp.status == "irrelevant"){

          alert("<?php echo trans('0520'); ?>");

        }else{

          alert("<?php echo trans('0513'); ?>");
        }

       }
       console.log(resp);
      })
    })
  })
</script>
<?php } ?>
