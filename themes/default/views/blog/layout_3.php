<div class="listinews row">
    <?php
    foreach ($posts as $post) {
        ?>
        <div class="col-md-6 go-right news-style-hi-blue">
            <div class="col-md-12 go-right">
                <div class="row bloggrid img_list">
                    <a href="<?php echo base_url('blog/' . $post->post_slug); ?>" title="<?php echo $post->post_title; ?>"><img src="<?php echo pt_post_full($post->post_id); ?>" alt="<?php echo $post->post_title; ?>" class="img-responsive"></a>
                </div>
            </div>
            <div class="col-md-12 khuyenmai-news info">
                <div class="row">
                    <a href="<?php echo base_url('blog/' . $post->post_slug); ?>" title="<?php echo $post->post_title; ?>">
                        <h3><?php echo $post->post_title; ?></h3>
                    </a>
                    <div class="clearfix"></div>
                    <p class="RTL"><?php echo character_limiter(strip_tags($post->post_desc), 320); ?></p>
                    <div class="post_info clearfix">
                        <div class="post-left go-right">
                            <ul class="go-right">
                                <li><span><?php echo date('d/m/Y', $post->post_created_at); ?></span></li>
                                <li><span class="fb-like fb_iframe_widget" data-href="<?php echo base_url('blog/' . $post->post_slug); ?>" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
    ?>
</div>