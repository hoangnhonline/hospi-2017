<?php
$first = array_shift($posts);
?>
<div class="listinews">
    <div class="newshot news-style news-style-blue">
        <a href="<?php echo base_url('blog/' . $first->post_slug); ?>" title="<?php echo $post->post_title; ?>"><img src="<?php echo pt_post_full($first->post_id); ?>" alt="<?php echo $first->post_title; ?>" class="img-responsive"></a>
        <div class="info">
            <a href="<?php echo base_url('blog/' . $first->post_slug); ?>" title="<?php echo $first->post_title; ?>">
                <h2><?php echo $first->post_title; ?></h2>
            </a>
            <p class="RTL"><?php echo character_limiter(strip_tags($first->post_desc), 320); ?></p>
            <div class="post-left go-right">
                <ul class="go-right">
                    <li><span><?php echo date('d/m/Y', $first->post_created_at); ?></span></li>
                    <li><span class="fb-like" data-href="<?php echo base_url('blog/' . $first->post_slug); ?>" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></span></li>
                </ul>
            </div>
        </div>
    </div>
    <?php
    if (!empty($posts)) {
        ?>
        <div class="list-news">
            <ul>
                <?php
                foreach ($posts as $post) {
                    ?>
                    <li class="news-style news-style-blue news-style-list clearfix">
                        <div class="image">
                            <a href="<?php echo base_url('blog/' . $post->post_slug); ?>" title="<?php echo $post->post_title; ?>"><img src="<?php echo pt_post_full($post->post_id); ?>" alt="<?php echo $post->post_title; ?>" class="img-responsive"></a>
                        </div>
                        <div class="info">
                            <a href="<?php echo base_url('blog/' . $post->post_slug); ?>" title="<?php echo $post->post_title; ?>">
                                <h2><?php echo $post->post_title; ?></h2>
                            </a>
                            <div>
                                <p class="RTL"><?php echo character_limiter(strip_tags($post->post_desc), 320); ?></p>
                                <div class="post-left go-right">
                                    <ul class="go-right">
                                        <li><span><?php echo date('d/m/Y', $post->post_created_at); ?></span></li>
                                        <li><span class="fb-like" data-href="<?php echo base_url('blog/' . $post->post_slug); ?>" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </li>
                    <?php
                }
                ?>
            </ul>
        </div>
        <?php
    }
    ?>
</div>