<div class="secondary col-md-3 add_bottom_30 go-left">
    <div class="row">
   
    <div class="col-md-12 go-left">
        
      <form action="<?php echo base_url().'blog/search'; ?>" method="GET">
        <div class="input-group RTL">
          <input type="text" name="s" required placeholder="<?php echo trans('0283');?>" class="form-control sub_email form">
          <span class="input-group-btn">
          <button class="btn btn-action" type="submit"><i class="fa fa-search"></i></button>
          </span>
        </div>
      </form>
        
        
        <?php
        if(!empty($camnang['all'])){ ?>
        <div class="list-group">
    <div class="panel panel-default">
      <div class="panel-heading go-text-right"><a class="purple-link" href="<?php echo base_url().'blog/category?cat='.$camnang['catslug']; ?>"><?php echo trans('0764');?></a></div>

        <?php
        foreach($camnang['all'] as $cn):?>
      <a href="<?php echo base_url().'blog/'.$cn->post_slug;?>" class="list-group-item">
        <strong class="go-right"><?php echo $cn->post_title;?></strong>
        <div class="clearfix"></div>
      </a>
        <?php 
        endforeach; 
        
        ?>
      </div>
  </div>
  <?php 
        
        }
        ?>
        <div class="clearfix">
            </div>
            <div class="list-group">
    <div class="panel panel-default">

      <div class="panel-heading go-text-right"><?php echo trans('0583');?></div>

        <?php
        foreach($feature_posts as $post):
          $bloglib->set_id($post->post_id);
          $bloglib->post_short_details(); ?>
      <a href="<?php echo base_url().'blog/'.$post->post_slug;?>" class="list-group-item">
        <strong class="go-right"><?php echo $bloglib->title;?></strong>
        <div class="clearfix"></div>
      </a>
        <?php 
        endforeach; 
       ?>
      </div>
  </div>
  <div class="clearfix"></div>

            <div class="list-group">
    <div class="panel panel-default">
      <div class="panel-heading go-text-right"><?php echo trans('0826');?></div>




        <form action="<?php echo base_url(); ?>/hotels/search" method="GET">

            <div class="col-md-12 col-lg-12 col-sm-12 go-right" ng-controller="autoSuggest">
                <div class="form-group">
                    
                    <input id="search" name="txtSearch" class="form-control form-control-small" placeholder="<?php echo trans('026');?>"/>
            <div id="autocomlete-container"></div>

                    <input id="searching" type="hidden" name="searching" value="{{searching}}"> <input id="modType" type="hidden" name="modType" value="{{modType}}">
                </div>
            </div>

            <!-- start hotels checkin checkout fields -->
                <div class="col-md-12 col-sm-12 col-xs-12 go-right">
                    <div class="form-group">
                        <input type="text" placeholder="<?php echo trans('07'); ?> " name="checkin" class="form-control mySelectCalendar dpd1" value="<?php echo @$checkin; ?>" required >
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12 go-right">
                    <div class="form-group">
                         <input type="text" placeholder="<?php echo trans('09'); ?> " name="checkout" class="form-control mySelectCalendar dpd2" value="<?php echo @$checkout; ?>" required >
                    </div>
                </div>
            <!-- end hotels checkin checkout fields -->

            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 go-right">
                <div class="form-group">
                    
                    <select class="form-control selectx" name="adults"><option selected><?php echo trans('010');?></option>
                <?php for($i=1;$i<=20;$i++) {
                  
                  echo '<option value="'.$i.'">';
                  echo $i .'</option>';}?>
              </select>
                </div>
            </div>
            <!-- start hotels child field -->
                <div class="hidden-md col-lg-12 col-sm-12 col-xs-12 go-right">
                    <div class="form-group">
                        <select class="form-control selectx" name="child"><option selected><?php echo trans('011');?></option>
                        <?php for($j=0;$j<=10;$j++) {
                        
                          echo '<option value="'.$j.'">';
                          echo $j.'</option>';}?>
                        </select>
                    </div>
                </div>
    
            <!-- end hotels child field -->

            <div class="visible-sm visible-xs">
                <div class="clearfix"></div>
            </div>
            <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12 go-right">
                <div class="form-group">
                    <div class="clearfix"></div>
                    <button type="submit" class="btn btn-block btn-sidebar"><i class="fa fa-angle-double-right" aria-hidden="true"></i>
 <?php echo trans('012'); ?></button>
                </div>
            </div>
            <div class="clearfix"></div>
        </form>


      </div>
  </div>

  <div class="clearfix">
            </div>
        <div class="list-group">
    <div class="panel panel-default">
      <div class="panel-heading go-text-right"><?php echo trans('0765');?></div>
        <?php echo run_widget(106); ?>
      <?php echo run_widget(108); ?>
      </div>
  </div>
        <?php echo run_widget(105); ?>
        
        
        
        <?php if(!empty($related_posts)){ ?>
  <div class="list-group">
    <div class="panel panel-default">
      <div class="panel-heading go-text-right"><?php echo trans('0766');?></div>
        <?php
          foreach($related_posts as $post):
          $bloglib->set_id($post->post_id);
          $bloglib->post_short_details(); ?>
        <div class="featured">
          <a href="<?php echo base_url().'blog/'.$post->post_slug;?>" class="col-md-12 col-sm-12 col-xs-12 go-right" >
          <img class="img-responsive post-img img-fade" src="<?php echo pt_post_thumbnail($post->post_id); ?>" alt="<?php echo $bloglib->title;?>" />
          </a>
          <div class="desc col-md-12 col-sm-12 col-xs-12 go-left">
            <h4 style="margin-top: 0px;" class="go-text-right purple"><a href="<?php echo base_url().'blog/'.$post->post_slug;?>" ><?php echo $bloglib->title;?></a></h4>
            <?php echo character_limiter(strip_tags($bloglib->desc), 100);?>
          </div>
          <!--//desc-->
        </div>
        <!--//item-->
        <hr style="margin-top:10px;margin-bottom:10px">
        <?php endforeach; ?>
      </div>
    </div>
  <?php  } ?>
        
        
        
  
        
    </div>
  
  </div>
</div>
<!--//secondary-->

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

});//]]> 

</script>