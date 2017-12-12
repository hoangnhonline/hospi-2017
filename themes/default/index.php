<?php
/*if ($appModule != 'blog') {
    include('header.php');
} else {
    include('header_blog.php');
}*/
include('header.php');

echo $this->content();

include('footer.php');
/*if ($appModule != 'blog') {
    include('footer.php');
} else {
    include('footer_blog.php');
}*/
