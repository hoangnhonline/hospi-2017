<div class="container margin_60 main-blog">
    <div class="block-adv-blog">
        <a href="#" title="">
            <img src="<?php echo $theme_url; ?>assets/img/bg-adv.jpg" style="width: 100%;" alt="">
        </a>
    </div>
    <div class="row">
        <div class="col-md-7 go-right categories-news categories-blog">
            <?php
            foreach ($category_post as $item) {
                $posts = $item['posts'];
                ?>
                <div class="block-news-<?php echo $item['category']->slug; ?> clearfix">
                    <div class="cat-line <?php echo $item['category']->class; ?>">
                        <div class="cate-news"><?php echo $item['category']->name; ?></div>
                        <ul class="catslug">
                            <?php
                            if (!empty($item['child'])) {
                                foreach ($item['child'] as $child) {
                                    ?>
                                    <li><a href="<?php echo base_url('blog/category/' . $child->slug); ?>" title="<?php echo $child->name; ?>"><?php echo $child->name; ?></a></li>
                                    <?php
                                }
                            }
                            ?>
                            <li class="icon"><a href="<?php echo base_url('blog/category/' . $item->slug); ?>" title=""><img src="<?php echo $theme_url; ?>assets/img/view-double.png" alt=""></a></li>
                        </ul>
                    </div>
                    <?php
                    if (!empty($posts)) {
                        include('layout_' . $item['category']->layout . '.php');
                    }
                    ?>
                </div>
                <?php
            }
            ?>
        </div>
        <?php include('sidebar.php'); ?>
    </div>
    <!-- End row-->
</div>
<!-- End container margin_60 -->
