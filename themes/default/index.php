<?php
if ($appModule != 'blog') {
    include('header.php');
} else {
    include('header_blog.php');
}

echo $this->content();

include('footer.php');