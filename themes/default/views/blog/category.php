<style>
  .item { max-height: 55px !important; }
  .parallax-window { min-height: 220px; position: relative; }
</style>

<link rel="stylesheet" href="<?php echo $theme_url; ?>assets/css/blog.css" />
<section style="max-height:200px !important" class="parallax-window" data-parallax="scroll" data-image-src="<?php echo $theme_url; ?>assets/img/login.jpg" data-natural-width="150" data-natural-height="100">
  <div class="parallax-content-1">
    <div class="animated fadeInDown">
      <h1 style="margin-top: -216px;"><?php echo trans('Blog');?></h1>
      <p><?php echo trans('0481');?></p>
    </div>
  </div>
</section>
<!-- End section -->
<?php //print_r($allposts); ?>
<div class="container margin_60">
    <div class="col-md-12 go-right">
        <div class="lastest-news"><?php  if($ptype == "search"){
          echo trans('0291');
          }elseif($ptype == "category"){
          echo $categoryname;
          }else{
           echo trans('0285');
          }  ?></div>
        <div class="row">
          <?php if(!empty($allposts['all'])){
              $i=1;
            foreach($allposts['all'] as $post):
             $bloglib->set_id($post->post_id);
            $bloglib->post_short_details();
            if($i<3){ ?>
            <div class="col-md-6 blog-cat-archive item<?php echo $i;?>">
              <div class="main-blog img_list">
              <a href="<?php echo base_url().'blog/'.$post->post_slug;?>"><img src="<?php echo pt_post_full($post->post_id); ?>" alt="<?php echo $bloglib->title;?>" class="img-responsive"></a>
              </div><a href="<?php echo base_url().'blog/'.$post->post_slug;?>">
              <h2 class="top-news go-right RTL mtb0 purple"><?php echo $bloglib->title;?></h2>
            </a>
            <div class="clearfix"></div>
            <div class="post_info clearfix">
              <div class="post-left go-right">
                <ul class="go-right">
                  <li><span class=""><?php echo $bloglib->date; ?></span></li>
                  <li><span class="fb-like" data-href="<?php echo base_url().'blog/'.$post->post_slug;?>" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></span></li>
                </ul>
              </div>
            </div>
            <p class="RTL"> <?php echo character_limiter(strip_tags($bloglib->desc), 320);?></p>
            <div class="clearfix"></div>
            <!--<a class="btn btn-success go-right" href="<?php echo base_url().'blog/'.$post->post_slug;?>"> <?php echo trans('0286');?> </a>-->
            
          </div>
                
           
            <?php } else {
                if($i==3) echo "<div class='clearfix'></div><div class='col-md-12'><hr></div><div class='col-md-9 blog-cat-archive'><div class='row'>";
                if($i%3==0&&$i>3) echo "<div class='clearfix'></div><div class='col-md-12'><hr></div>";
             ?>
          <div class="col-md-4"><div class="row">
          <div class="col-md-12 go-right">
            <div class="cat-archive img_list">
              <a href="<?php echo base_url().'blog/'.$post->post_slug;?>"><img src="<?php echo pt_post_thumbnail($post->post_id); ?>" alt="<?php echo $bloglib->title;?>" class="img-responsive"></a>
            </div>
          </div>
          <div class="col-md-12 category-post-title">
            <a href="<?php echo base_url().'blog/'.$post->post_slug;?>">
              <h3 class="go-right RTL mtb0 purple"><?php echo $bloglib->title;?></h3>
            </a>
            <div class="clearfix"></div>
            
            <p class="RTL"> <?php echo character_limiter(strip_tags($bloglib->desc), 120);?></p>
            <div class="post_info clearfix">
              <div class="post-left go-right">
                <ul class="go-right">
                  <li><span class="date"><?php echo $bloglib->date; ?></span></li>
                  <li class="view"><span class=""><?php echo $post->post_visits; ?> View</span></li>
                  <li><span class="fb-like" data-href="<?php echo base_url().'blog/'.$post->post_slug;?>" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></span></li>
                </ul>
              </div>
            </div>
            <div class="clearfix"></div>
            
          </div>
              </div></div>
          <?php } $i++; endforeach;  } else { echo '<h1 class="text-center">' . trans("066") . '</h1>'; } ?>
            <div class="clearfix"></div><hr>
            <center>
            <?php echo createPagination($info);?>
          </center>
        </div>
        </div>
        <!-- End col-md-9-->
    <?php include('catsidebar.php'); ?>
        </div>
        </div>
    
  <!-- End row-->
</div>
<!-- End container -->