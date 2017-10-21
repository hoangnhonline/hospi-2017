<style>
  .item { max-height: 55px !important; }
  .parallax-window { min-height: 220px; position: relative; }
</style>
<div class="breadcrumb">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <?php echo $breadcrumb;?>
      </div>
    </div>
  </div>
</div>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="wow fadeInUp animated title go-right purple"><?php echo $title;?></h1>
          <div class="post_info clearfix">
              <div class="post-left go-right">
                <ul class="go-right">
                  <li><span class="date"><?php echo $date; ?></span></li>
                  <li class="view"><span class=""><?php echo $view; ?> View</span></li>
                  <li><span class="fb-like" data-href="<?php echo $url; ?>" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></span></li>
                </ul>
              </div>
            </div>
            <div class="clearfix"></div>
          
        </div>
      </div>
    </div>

<div class="container sections-wrapper">
  <div class="row">
    <div class="primary col-md-9 col-sm-12 col-xs-12">
      <div class="panel panel-default">
        <div class="panel-body">

        <!--<img src="<?php echo $thumbnail;?>" class="img-responsive" />-->
          <div class="row">
            <!--//desc-->
            <div class="panel-body go-right RTL">
              <?php echo $desc; ?>
                <div class="fb-comments" data-href="<?php echo $url;?>" data-width="100%" data-numposts="5"></div>
            </div>
            <!--//desc-->
          </div>
          <!--//item-->
        </div>
      </div>
      
    </div>
    <?php include('singlesidebar.php'); ?>
  </div>
  <!--//row-->
</div>
<!--//masonry-->

<br><br><br>