<div class="invoice-detail opensans">
    <div class="col-md-4">
    <?php echo trans('0651');?><?php echo trans($invoice->module.'hd');?>: <span class="purple"><?php echo $invoice->code; ?></span>
    </div>
    <div class="col-md-4 align-center red"><i>
        <?php if($invoice->status == "unpaid"){ if(time() < $invoice->expiryUnixtime){ 
    echo "(".trans('082').")";
        }else{ ?>
          <h4 style="margin-top:0px" class="text-center"><?php echo trans('0409');?> <b class="text-danger wow flash animted"><?php echo trans('0519');?></b></h4>
          <?php } }elseif($invoice->status == "reserved"){ ?>

          <!-- reserved -->
          <b class="btn btn-success btn-lg btn-block wow flash animted"><?php echo trans('0445');?></b><br>
          <!-- reserved -->

          <?php if($invoice->paymethod == "payonarrival"){ ?>
          <p style="color:white" class="text-center"> <?php echo trans("0474");?></p>
          <?php } }elseif($invoice->status == "cancelled"){ ?>

          <!-- cancelled -->
          <b class="btn btn-danger btn-lg btn-block wow flash animted"><?php echo trans('0347');?></b>
          <!-- cancelled -->

          <?php  }else{ ?>

          <!-- paid -->
          <b class="btn btn-success btn-lg btn-block wow flash animted"><?php echo trans('081');?></b><br>
          <p style="color:white" class="text-center"><?php echo trans('0410');?> <?php echo $invoice->accountEmail;?></p>
          <!-- paid -->

          <?php } ?>
        </i></div>
    <div class="col-md-4 align-right">
          <i class="fa fa-print" aria-hidden="true"></i> <?php echo trans('0652');?>
          </div>
          <div class="clearfix"></div>
          <div style="border-bottom:1px solid #ddd;"></div>
          <div class="col-md-6 invoice-padding">
          <h5><strong><?php echo trans('0545');?></strong></h5>  
          <div class="invoice-item"><?php echo trans('0653');?><?php echo $invoice->userFullName;?></div>
               <div class="invoice-item"><?php echo trans('0654');?><?php echo $invoice->userMobile;?></div>
               <div class="invoice-item"><?php echo trans('094');?>: <?php echo $invoice->userEmail;?></div>
          <div class="invoice-item"><?php echo trans('0655');?><?php echo $invoice->userAddress; ?></div>
          <?php if($invoice->nguoikhac=="Yes"&& !empty($invoice->guest)){ ?>
                <div class="invoice-item"><?php echo trans('0752');?>: <?php echo $invoice->guest;?></div>
                <?php } ?>
          </div>
          <div class="col-md-6 invoice-padding">
          <h5><strong><?php echo trans('0656');?><?php echo trans($invoice->module.'hd');?></strong></h5>
          <?php if($invoice->module=="hotels") { ?>
          <div class="invoice-item"><?php echo trans('0657');?><?php echo $invoice->title;?></div>
               <div class="invoice-item"><?php echo trans('0655');?><?php echo $invoice->address;?></div>
               <div class="invoice-item"><?php echo trans('07');?>: <?php echo $invoice->checkin; ?></div>
          <div class="invoice-item"><?php echo trans('09');?>: <?php echo $invoice->checkout; ?></div>
          <div class="invoice-item"><div class="row"><div class="col-md-4"><?php echo trans('060');?>: <?php echo $invoice->nights; ?></div><div class="col-md-4"><?php echo trans('0658');?><?php echo $invoice->subItem->quantity;?></div><div class="col-md-4"><?php echo trans('0667');?><?php echo $invoice->extraBeds > 0 ? $invoice->extraBeds : 0 ;  ?></div></div></div>
          
          <?php } else { ?>
          <div class="invoice-item-tour andes"><?php echo $invoice->title;?>
          <div class="purple"><?php echo $invoice->tourDays;?><?php echo trans('0679');?><?php echo $invoice->tourNights;?><?php echo trans('0680');?></div></div>
               <div class="invoice-item-tour"><?php echo trans('0678');?>: <?php echo $invoice->checkin; ?></div>
               <div class="invoice-item-tour"><?php echo trans('0773');?>: <?php echo $invoice->tour_transportation; ?></div>
               <div class="invoice-item-tour"><?php echo trans('0774');?>: <?php echo $invoice->location; ?></div>
          <?php } ?>
          </div>
          <div class="clearfix"></div>
          <div class="col-md-6 invoice-padding">
              <div class="invoice-border">
          <h5><strong><?php echo trans('0659');?><?php echo trans($invoice->module.'hd');?></strong></h5>  
          <div class="content">
              <?php if($invoice->module=="hotels") { ?>
                <!--<div><?php echo trans('0660');?></div>
               <div><?php echo trans('0661');?></div>
               <div><?php echo trans('0662');?></div>
               <div><?php echo trans('0663');?></div>-->
              <?php echo nl2br($invoice->hotel_policy);?>
              
                <?php } else { ?>
               <div><?php echo trans('0681');?></div>
               <div><?php echo trans('0682');?></div>
               <?php } ?>
          </div>
              </div>
              </div>
          <div class="col-md-6 invoice-padding">
              <div class="invoice-border">
          <h5><strong><?php if($invoice->module=="hotels") { ?><?php echo trans('0664');?><?php } else { ?><?php echo trans('0683');?><?php } ?></strong></h5>
          <div class="content">
              <?php if($invoice->module=="hotels") { ?>
          <div class="invoice-in-border"><?php echo trans('0665');?><?php echo $invoice->honeymoon ? trans('0567') : $invoice->subItem->title;?></div>
          <?php } ?>
          <div class="invoice-in-border"><?php echo trans('0666');?><span class="float-right"><?php if(!empty($invoice->subItem->total)){ echo $invoice->honeymoon ? $invoice->subItem->total : $invoice->subItem->total*$invoice->nights; echo " ".$invoice->currCode;}?></span></div>
          <?php if($invoice->module=="hotels") { ?>
          <div class="invoice-in-border"><?php echo trans('0667');?><span class="float-right"><?php echo $invoice->extraBedsCharges; echo " ".$invoice->currCode;?></span></div>
          <?php } ?>
          <div class="invoice-in-border"><?php echo trans('0668');?><span class="float-right"><?php echo $invoice->checkoutAmount; echo " ".$invoice->currCode;?></span></div>
          <div class="invoice-in-border"><?php echo trans('0669');?><span class="float-right"></span></div>
          <div><?php echo trans('0670');?><span class="float-right"><?php echo $invoice->honeymoon ? $invoice->checkoutTotal/2 : $invoice->checkoutTotal ; echo " ".$invoice->currCode;?></span></div>
          </div>
              </div>
    </div>
    <div class="clearfix"></div>
    <!--<div style="display: inline-block;width: 100%;">-->
    <?php if($invoice->sent_invoice=="Yes" || !empty($invoice->additionaNotes)){ ?>
    <div class="col-md-6 invoice-padding10">
        <?php }else {?>
        <div class="col-md-12 invoice-padding">
        <?php } ?>
        <div class="invoice-border">
            <h5><strong><?php echo trans('0602');?></strong></h5>
            <div class="content" style="display: inline-block;width: 100%;">
            <div><i><?php echo trans('0671');?><?php echo getPayment($invoice->paymethod);?></i></div>
            <div><?php echo trans('0685');?></div><div id="thongtinthanhtoan" class="col-xs-12 smalltext"><?php if(getPayment($invoice->paymethod)=="Thanh toán tại nhà") echo nl2br(getBookingPaymentinfo($invoice->id)); else echo getBookingPaymentinfo($invoice->id);?></div>
            </div>
            </div>
    </div>
    <!--</div>-->
        
          
          
<?php if($invoice->sent_invoice=="Yes"){ ?>

    <div class="col-md-6 invoice-padding10">
        <div class="invoice-border">
            <h5><strong><?php echo trans('0748');?></strong></h5>
            <div class="content" style="display: inline-block;width: 100%;">
                <div><span class="label-title"><?php echo trans('0735');?> : </span><?php echo $invoice->company;?></div>
                <div><span class="label-title"><?php echo trans('0730');?> : </span><?php echo $invoice->mst;?></div>
                <div><span class="label-title"><?php echo trans('0731');?> : </span><?php echo $invoice->companyadd;?></div>
                <?php if(!empty($invoice->sentto)){ ?>
                <div><span class="label-title"><?php echo trans('0751');?> : </span><?php echo $invoice->sentto;?></div>
                <?php } ?>
            </div>
            </div>
    </div>
<?php } ?>

    
<?php if(!empty($invoice->additionaNotes)){ ?>
    
    <div class="col-md-6 invoice-padding10">
        <div class="invoice-border">
            <h5><strong><?php echo trans('0178');?></strong></h5>
            <div class="content" style="display: inline-block;width: 100%;">
                <p><?php echo $invoice->additionaNotes;?></p>
            </div>
            </div>
    </div>
    
<?php } ?>

<!-- Guest Info Table -->
<?php $chk = (array)$invoice->guestInfo; $chk1 = reset($chk); ?>
<?php if(!empty($chk1->name)){ ?>
<div class="col-md-12 invoice-padding">
        <div class="invoice-border">
            <h5><strong><?php echo trans('0686');?></strong></h5>
            <div class="content" style="display: inline-block;width: 100%;">
<table class="invoice table table-bordered">
    <thead>
        <tr>
            <th  style="line-height: 1.428571;"><?php echo trans('0350');?></th>
            <th style="line-height: 1.428571;"><?php echo trans('0523');?></th>
            <th  style="line-height: 1.428571;" class="text-center"><?php echo trans('0524');?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($invoice->guestInfo as $guest){ ?>
        <tr>
            <td><?php echo $guest->name;?></td>
            <td><?php echo $guest->passportnumber;?></td>
            <td><?php echo $guest->age;?></td>
        </tr>
        <?php } ?>
    </tbody>
</table>
                </div>
            </div>
    </div>
<?php } ?>
<div class="clearfix"></div>
</div>
<!-- End Guest Info Table -->

<div class="clearfix"></div>
<!-- /.modal-content -->