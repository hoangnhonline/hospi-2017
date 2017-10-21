<div class="container">
  <div class="col-md-12 pagecontainer2 offset-0">
    <div class="hcontainer">
      <h2><?php echo @$page_contents[0]->content_page_title; ?></h2>
      <hr>
        <?php if(@$page_contents[0]->page_menu>0) {?>
            <div class="secondary col-md-3 add_bottom_30 go-left">
                <?php get_footer_menu_items(@$page_contents[0]->page_menu,"page-menu","ftitle go-text-right","footerlist go-right go-text-right" );?>
            </div>
            <div class="primary col-md-9 col-sm-12 col-xs-12"> 
        <?php } else echo "<div>";?>
      
      <div class="panel-body go-right RTL page-content">
        <?php echo @$page_contents[0]->content_body; ?>
      </div>
    </div>
    <div class="clearfix"></div>
    </div>
  </div>
</div>
<br><br><br>