<script type="text/javascript">
$(document).ready(function(){
    $("#position").change(function(){
        $(this).find("option:selected").each(function(){
            var optionValue = $(this).attr("value");
            if(optionValue=="Advert"){
                $("#city").show();
            } else{
                $("#city").hide();
            }
        });
    }).change();
});
</script>
<div class="panel panel-default">
  <div class="panel-body">
    <form action="" method="POST">
      <label>Widget Name</label> <input type="text" class="form-control" name="title" value="<?php echo $details[0]->widget_name;?>" />
      <br>
      
      <label>Show on page</label>
      <select id="position" name="position" class="chosen-select">
                <option value="">Select...</option>
                <option value="Homepage" <?php makeSelected("Homepage", @$details[0]->widget_location); ?> >Home page</option>
                <option value="Tourpage" <?php makeSelected("Tourpage", @$details[0]->widget_location); ?> >Tour page</option>
                <option value="Honeymoon" <?php makeSelected("Honeymoon", @$details[0]->widget_location); ?> >Honeymoon page</option>
                <option value="Offer" <?php makeSelected("Offer", @$details[0]->widget_location); ?> >Offer page</option>
                <option value="Blog" <?php makeSelected("Blog", @$details[0]->widget_location); ?> >Blog page</option>
                <option value="Advert" <?php makeSelected("Advert", @$details[0]->widget_location); ?> >Hotel Search result</option>
            </select>
      <br><br>
      <div class="clearfix"></div>
      <div id="city" class="panel panel-default" style="display:none">
            <div class="panel-heading">Used with 'Hotel Search result' option</div>
            <div class="panel-body">
                
      <label>Show on specific city</label>
            <select name="widtitle" class="chosen-select">
                <option value="">Select...</option>
                <?php foreach($locations as $loc){ ?>
                <option value="<?php echo $loc->id; ?>" <?php makeSelected(@$loc->id, @$details[0]->widget_title); ?> ><?php echo $loc->location;?></option>
                <?php } ?>
              
            </select>
      <span class="help-block">Select city to show</span>
      
      </div>
      </div><br>
      <label>Widget Status</label>  

                      <select data-placeholder="Select" name="status" class="form-control" tabindex="2">
                        <option value="Yes" <?php if($details[0]->widget_status == "Yes"){ echo "selected";} ?> >Enable</option>
                        <option value="No" <?php if($details[0]->widget_status == "No"){ echo "selected";} ?>>Disable</option>
                      </select>
            
      <br>
      <div class="panel panel-default">
        <div class="panel-heading"><strong>Widget Content</strong></div>
        <?php $this->ckeditor->editor('widgetbody', $details[0]->widget_content, $ckconfig,'widgetbody'); ?>
      </div>
      <input type="hidden" id="pageid" name="widgetid" value="<?php echo $widgetid;?>" />
      <input type="hidden" name="action" value="<?php echo $action; ?>" />
      <button type="submit" class="btn btn-primary" > <?php echo ucfirst($action);?> </button>
    </form>
  </div>
</div>