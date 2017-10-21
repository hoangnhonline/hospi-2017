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
          echo trans('0292')." - ".$categoryname;
          }else{
           echo trans('0285');
          }  ?></div>
    </div>
        <?php  if($ptype == "search"){ ?>
    <div class="col-md-7 go-right categories-news">
        <?php if(!empty($allposts['all'])){
            foreach($allposts['all'] as $post):
             $bloglib->set_id($post->post_id);
            $bloglib->post_short_details();
             ?>
          <div class="col-md-4 go-right">
            <div class="row bloglist img_list">
              <a href="<?php echo base_url().'blog/'.$post->post_slug;?>"><img src="<?php echo pt_post_thumbnail($post->post_id); ?>" alt="<?php echo $bloglib->title;?>" class="img-responsive"></a>
            </div>
          </div>
          <div class="col-md-8">
            <a href="<?php echo base_url().'blog/'.$post->post_slug;?>">
              <h3 class="go-right RTL mtb0"><?php echo $bloglib->title;?></h3>
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
            <div class="clearfix">
            </div>
          </div>
          <div class="clearfix"></div>
          <hr>
          <?php endforeach; }else { echo '<h1 class="text-center">' . trans("066") . '</h1>'; } ?>
          <center>
            <?php echo createPagination($info);?>
          </center>
        
    </div>
        
          <?php } else { ?>
        
      <div class="col-md-12 go-right">  
      <div class="row">
        
        <div class="">
            
          <?php if(!empty($allposts['all'])){
              $i=1;
            foreach($allposts['all'] as $post):
             $bloglib->set_id($post->post_id);
            $bloglib->post_short_details();
            if($i==1) { ?>
                <div class=" col-md-6 go-right">
                    <div class="main-blog img_list">
                        <a href="<?php echo base_url().'blog/'.$post->post_slug;?>"><img src="<?php echo pt_post_full($post->post_id); ?>" alt="<?php echo $bloglib->title;?>" class="img-responsive"></a>
                      </div>
                        <a href="<?php echo base_url().'blog/'.$post->post_slug;?>">
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
                        <p class="RTL"> <?php echo character_limiter(strip_tags($bloglib->desc), 260);?></p>
                </div>
            
            <div class="col-md-6 go-right next-news">
            <?php } else { ?>
          
          <div class="col-md-8 go-right">
            <a href="<?php echo base_url().'blog/'.$post->post_slug;?>">
              <h3 class="go-right RTL mtb0 purple"><?php echo $bloglib->title;?></h3>
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
            <p class="RTL"> <?php echo character_limiter(strip_tags($bloglib->desc), 150);?></p>
            <div class="clearfix"></div>
            <!--<a class="btn btn-success go-right" href="<?php echo base_url().'blog/'.$post->post_slug;?>"> <?php echo trans('0286');?> </a>-->
            <div class="clearfix">
            </div>
          </div>
                <div class="col-md-4 go-right">
            <div class="row nextnews img_list">
              <a href="<?php echo base_url().'blog/'.$post->post_slug;?>"><img src="<?php echo pt_post_thumbnail($post->post_id); ?>" alt="<?php echo $bloglib->title;?>" class="img-responsive"></a>
            </div>
          </div>
          <div class="clearfix"></div>
          <hr>
            <?php } $i++; endforeach; }else{ echo '<h1 class="text-center">' . trans("066") . '</h1>'; } ?>
          </div>
          <center>
            <?php //echo createPagination($info);?>
          </center>
            
        </div>
      </div>
        <div class="clearfix">
            </div>
        <div class="hottest-news"></div>
    </div>
    <!-- End col-md-12-->
    <div class="clearfix">
    </div>
    
    <div class="col-md-7 go-right categories-news">
        
        <?php
        if(!empty($diemden['all'])){ ?>
        <div class="cat-line"><div class="cate-news"><?php 
           echo trans('0759');
          ?></div>
            <div class="catslug"><a href="<?php echo base_url().'blog/category/'.$diemden['catslug']; ?>"><?php echo trans('0762');?></a></div>
        </div>
        <div class="clearfix">
            </div>
        <?php
        foreach($diemden['all'] as $dd):
             $bloglib->set_id($diemden->post_id);
            $bloglib->post_short_details(); ?>
            <div class="col-md-4 go-right">
            <div class="row bloglist img_list">
              <a href="<?php echo base_url().'blog/'.$dd->post_slug;?>"><img src="<?php echo pt_post_thumbnail($dd->post_id); ?>" alt="<?php echo $dd->post_title;?>" class="img-responsive"></a>
            </div>
          </div>
          <div class="col-md-8">
            <a href="<?php echo base_url().'blog/'.$dd->post_slug;?>">
              <h3 class="go-right RTL mtb0 purple"><?php echo $dd->post_title;?></h3>
            </a>
            <div class="clearfix"></div>
            
            <p class="RTL"> <?php echo character_limiter(strip_tags($dd->post_desc), 320);?></p>
            <div class="post_info clearfix">
              <div class="post-left go-right">
                <ul class="go-right">
                  <li><span class=""><?php echo date('d/m/Y', $dd->post_created_at);; ?></span></li>
                  <li><span class="fb-like" data-href="<?php echo base_url().'blog/'.$dd->post_slug;?>" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></span></li>
                </ul>
              </div>
            </div>
            <div class="clearfix"></div>
            <!--<a class="btn btn-success go-right" href="<?php echo base_url().'blog/'.$dd->post_slug;?>"> <?php echo trans('0286');?> </a>-->
            <div class="clearfix">
            </div>
          </div>
          <div class="clearfix"></div>
          <hr style="border-top:none;">
        <?php 
        endforeach; 
        }
        ?>
          
          <?php
        if(!empty($amthuc['all'])){ ?>
        <div class="cat-line"><div class="cate-news"><?php 
           echo trans('0760');
          ?></div>
            <div class="catslug"><a href="<?php echo base_url().'blog/category/'.$amthuc['catslug']; ?>"><?php echo trans('0762');?></a></div>
        </div>
        <div class="clearfix">
            </div>
          <div class="oddeven">
        <?php
        $i=1;
        foreach($amthuc['all'] as $at): if($i%2==0) {?>
              <div class="oddevenitem">
            <div class="col-md-7 go-right even img_list">
              <a href="<?php echo base_url().'blog/'.$at->post_slug;?>"><img src="<?php echo pt_post_full($at->post_id); ?>" alt="<?php echo $at->post_title;?>" class="img-responsive"></a>
          </div>
          <div class="col-md-5 even-text">
            <a href="<?php echo base_url().'blog/'.$at->post_slug;?>">
              <h3 class="go-right RTL mtb0 purple"><?php echo $at->post_title;?></h3>
            </a>
            <div class="clearfix"></div>
            
            <p class="RTL"> <?php echo character_limiter(strip_tags($at->post_desc), 350);?></p>
            <div class="post_info clearfix">
              <div class="post-left go-right">
                <ul class="go-right">
                  <li><span class=""><?php echo date('d/m/Y', $at->post_created_at);; ?></span></li>
                  <li><span class="fb-like" data-href="<?php echo base_url().'blog/'.$at->post_slug;?>" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></span></li>
                </ul>
              </div>
            </div>
            <div class="clearfix"></div>
            <!--<a class="btn btn-success go-right" href="<?php echo base_url().'blog/'.$at->post_slug;?>"> <?php echo trans('0286');?> </a>-->
            <div class="clearfix">
            </div>
          </div>
          <div class="clearfix"></div>
          <hr style="border-top:none;">
              </div>
        <?php 
        } else { ?>
            <div class="oddevenitem">
            <div class="col-md-5 go-right odd-text">
            <a href="<?php echo base_url().'blog/'.$at->post_slug;?>">
              <h3 class="go-right RTL mtb0 purple"><?php echo $at->post_title;?></h3>
            </a>
            <div class="clearfix"></div>
            
            <p class="RTL"> <?php echo character_limiter(strip_tags($at->post_desc), 180);?></p>
            <div class="post_info clearfix">
              <div class="post-left go-right">
                <ul class="go-right">
                  <li><span class=""><?php echo date('d/m/Y', $at->post_created_at);; ?></span></li>
                  <li><span class="fb-like" data-href="<?php echo base_url().'blog/'.$at->post_slug;?>" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></span></li>
                </ul>
              </div>
            </div>
            <div class="clearfix"></div>
            <!--<a class="btn btn-success go-right" href="<?php echo base_url().'blog/'.$at->post_slug;?>"> <?php echo trans('0286');?> </a>-->
            <div class="clearfix">
            </div>
                </div>
              
          <div class="col-md-7 odd img_list">
              
              <a href="<?php echo base_url().'blog/'.$at->post_slug;?>"><img src="<?php echo pt_post_full($at->post_id); ?>" alt="<?php echo $at->post_title;?>" class="img-responsive"></a>
            
            
          </div>
          <div class="clearfix"></div>
          <hr style="border-top:none;">
              </div>
            
        <?php }
        $i++;
        endforeach; 
        }
        ?>
              </div> 

        <?php
        if(!empty($kinhnghiem['all'])){ ?>
        <div class="cat-line"><div class="cate-news"><?php 
           echo trans('0824');
          ?></div>
            <div class="catslug"><a href="<?php echo base_url().'blog/category/'.$kinhnghiem['catslug']; ?>"><?php echo trans('0762');?></a></div>
        </div>
        <div class="clearfix">
            </div>
        <?php
        foreach($kinhnghiem['all'] as $dd):
             $bloglib->set_id($kinhnghiem->post_id);
            $bloglib->post_short_details(); ?>
            <div class="col-md-4 go-right">
            <div class="row bloglist img_list">
              <a href="<?php echo base_url().'blog/'.$dd->post_slug;?>"><img src="<?php echo pt_post_thumbnail($dd->post_id); ?>" alt="<?php echo $dd->post_title;?>" class="img-responsive"></a>
            </div>
          </div>
          <div class="col-md-8">
            <a href="<?php echo base_url().'blog/'.$dd->post_slug;?>">
              <h3 class="go-right RTL mtb0 purple"><?php echo $dd->post_title;?></h3>
            </a>
            <div class="clearfix"></div>
            
            <p class="RTL"> <?php echo character_limiter(strip_tags($dd->post_desc), 220);?></p>
            <div class="post_info clearfix">
              <div class="post-left go-right">
                <ul class="go-right">
                  <li><span class=""><?php echo date('d/m/Y', $dd->post_created_at);; ?></span></li>
                  <li><span class="fb-like" data-href="<?php echo base_url().'blog/'.$dd->post_slug;?>" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></span></li>
                </ul>
              </div>
            </div>
            <div class="clearfix"></div>
            <!--<a class="btn btn-success go-right" href="<?php echo base_url().'blog/'.$dd->post_slug;?>"> <?php echo trans('0286');?> </a>-->
            <div class="clearfix">
            </div>
          </div>
          <div class="clearfix"></div>
          <hr style="border-top:none;">
        <?php 
        endforeach; 
        }
        ?>
              
              <?php
        if(!empty($khuyenmai['all'])){ ?>
        <div class="cat-line"><div class="cate-news"><?php 
           echo trans('0761');
          ?></div>
            <div class="catslug"><a href="<?php echo base_url().'blog/category/'.$khuyenmai['catslug']; ?>"><?php echo trans('0762');?></a></div>
        </div>
        <div class="clearfix">
            </div><div class="row">
        <?php
        $i=1;
        foreach($khuyenmai['all'] as $km): ?>
              
            <div class="col-md-6 go-right"> 
                
            <div class="col-md-12 go-right">
            <div class="row bloggrid img_list">
              <a href="<?php echo base_url().'blog/'.$km->post_slug;?>"><img src="<?php echo pt_post_full($km->post_id); ?>" alt="<?php echo $km->post_title;?>" class="img-responsive"></a>
            </div>
          </div>
          <div class="col-md-12 khuyenmai-news">
              <div class="row">
            <a href="<?php echo base_url().'blog/'.$km->post_slug;?>">
              <h3 class="go-right RTL mtb0 purple"><?php echo $km->post_title;?></h3>
            </a>
            <div class="clearfix"></div>
            
            <p class="RTL"> <?php echo character_limiter(strip_tags($km->post_desc), 200);?></p>
            <div class="post_info clearfix">
              <div class="post-left go-right">
                <ul class="go-right">
                  <li><span class=""><?php echo date('d/m/Y', $km->post_created_at);; ?></span></li>
                  <li><span class="fb-like" data-href="<?php echo base_url().'blog/'.$km->post_slug;?>" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></span></li>
                </ul>
              </div>
            </div>
            <div class="clearfix"></div>
            <!--<a class="btn btn-success go-right" href="<?php echo base_url().'blog/'.$km->post_slug;?>"> <?php echo trans('0286');?> </a>-->
            <div class="clearfix">
            </div>
          </div>
              </div>
          <div class="clearfix"></div>
          <hr style="border-top:none;">
            
            </div>
                 
        <?php 
        if($i%2==0) echo "<div class='clearfix'></div>";
        $i++;
        endforeach; 
        }
        ?>

          </div> 

          <?php
        if(!empty($khachsan['all'])){ ?>
        <div class="cat-line"><div class="cate-news"><?php 
           echo trans('0825');
          ?></div>
            <div class="catslug"><a href="<?php echo base_url().'blog/category/'.$khachsan['catslug']; ?>"><?php echo trans('0762');?></a></div>
        </div>
        <div class="clearfix">
            </div>
        <?php
        foreach($khachsan['all'] as $dd):
             $bloglib->set_id($khachsan->post_id);
            $bloglib->post_short_details(); ?>
            <div class="col-md-4 go-right">
            <div class="row bloglist img_list">
              <a href="<?php echo base_url().'blog/'.$dd->post_slug;?>"><img src="<?php echo pt_post_thumbnail($dd->post_id); ?>" alt="<?php echo $dd->post_title;?>" class="img-responsive"></a>
            </div>
          </div>
          <div class="col-md-8">
            <a href="<?php echo base_url().'blog/'.$dd->post_slug;?>">
              <h3 class="go-right RTL mtb0 purple"><?php echo $dd->post_title;?></h3>
            </a>
            <div class="clearfix"></div>
            
            <p class="RTL"> <?php echo character_limiter(strip_tags($dd->post_desc), 220);?></p>
            <div class="post_info clearfix">
              <div class="post-left go-right">
                <ul class="go-right">
                  <li><span class=""><?php echo date('d/m/Y', $dd->post_created_at);; ?></span></li>
                  <li><span class="fb-like" data-href="<?php echo base_url().'blog/'.$dd->post_slug;?>" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></span></li>
                </ul>
              </div>
            </div>
            <div class="clearfix"></div>
            <!--<a class="btn btn-success go-right" href="<?php echo base_url().'blog/'.$dd->post_slug;?>"> <?php echo trans('0286');?> </a>-->
            <div class="clearfix">
            </div>
          </div>
          <div class="clearfix"></div>
          <hr style="border-top:none;">
        <?php 
        endforeach; 
        }
        ?>
          
          <?php
        if(!empty($anhvideo['all'])){ ?>
        <div class="cat-line"><div class="cate-news"><?php 
           echo trans('0763');
          ?></div>
            <div class="catslug"><a href="<?php echo base_url().'blog/category/'.$anhvideo['catslug']; ?>"><?php echo trans('0762');?></a></div>
        </div>
        <div class="clearfix">
            </div>
        <?php
        foreach($anhvideo['all'] as $pic): ?>
  
            <div class="pic-video img_list">
              <a href="<?php echo base_url().'blog/'.$pic->post_slug;?>"><img src="<?php echo pt_post_full($pic->post_id); ?>" alt="<?php echo $pic->post_title;?>" class="img-responsive"></a>
          </div>
          <div class="pic-news">
            <a href="<?php echo base_url().'blog/'.$pic->post_slug;?>">
              <h3 class="go-right RTL mtb0 purple"><?php echo $pic->post_title;?></h3>
            </a>
            <div class="clearfix"></div>
            
            <p class="RTL"> <?php echo character_limiter(strip_tags($pic->post_desc), 320);?></p>
            <div class="post_info clearfix">
              <div class="post-left go-right">
                <ul class="go-right">
                  <li><span class=""><?php echo date('d/m/Y', $pic->post_created_at);; ?></span></li>
                  <li><span class="fb-like" data-href="<?php echo base_url().'blog/'.$pic->post_slug;?>" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></span></li>
                </ul>
              </div>
            </div>
            <div class="clearfix"></div>
            <!--<a class="btn btn-success go-right" href="<?php echo base_url().'blog/'.$pic->post_slug;?>"> <?php echo trans('0286');?> </a>-->
            <div class="clearfix">
            </div>
              </div>
          <div class="clearfix"></div>
          <hr style="border-top:none;">
            
        <?php 
        break;
        endforeach; 
        }
        ?>

          
          
          
    </div>
          <?php } ?>
    <?php include('sidebar.php'); ?>
  <!-- End row-->
</div>
<!-- End container -->