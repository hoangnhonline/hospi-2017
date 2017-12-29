<script>
  (function ($) {
    // custom css expression for a case-insensitive contains()
    jQuery.expr[':'].Contains = function(a,i,m){
        return (a.textContent || a.innerText || "").toUpperCase().indexOf(m[3].toUpperCase())>=0;
    };


    function FilterMenu(list) {
        var input = $(".filtertxt");

        $(input).change( function () {
            var filter = $(this).val();
            //console.log(filter);
            //If search text box contains some text then apply filter list
            if(filter){
                //Add open class to parent li item
                $(list).parent().addClass('open');
                //Add class in and expand the ul item which is nested li of main ul
                $(list).addClass('in').prop('aria-expanded', 'true').slideDown();

                //Check if child list items contain the query text. Them make them active
                $(list).find('li:Contains('+filter+')').addClass('active');
                //Check if any child list items doesn't contain query text. Remove the active class
                //So that they are not more highlighted
                $(list).find('li:not(:Contains('+filter+'))').removeClass('active');

                //Show any ul inside main ul which contains the text.
                $(list).find('li:Contains('+filter+')').show();
                //Hide any ul inside main ul which doesn't contains the text.
                $(list).find('li:not(:Contains('+filter+'))').hide();

                //Filter top level list items to show and hide them.
                $('#social-sidebar-menu').find('li:Contains('+filter+')').show();
                $('#social-sidebar-menu').find('li:not(:Contains('+filter+'))').hide();

            }else{
                //On query text = empty reset all classes and styles to default.
                $(list).parent().removeClass('open');
                $(list).removeClass('in').prop('aria-expanded', 'false').slideUp();
                $(list).find('li').removeClass('active');
                $('#social-sidebar-menu').find('li').show();
            }
        })
        .keyup( function () {
            $(this).change();
        });
    }


    //ondomready
    $(function () {
      FilterMenu($("#social-sidebar-menu ul"));
    });
  }(jQuery));


</script>
<!-- BEGIN SIDEBAR-->
<aside class="social-sidebar">
  <div class="social-sidebar-content">
    <div class="search-sidebar">
      <form class="search-sidebar-form has-icon filterform" onsubmit="return false;">
        <label for="sidebar-query" class="fa fa-search"></label>
        <input id="sidebar-query" type="text" placeholder="Search" class="search-query filtertxt">
      </form>
    </div>
    <div class="clearfix"></div>
    <div class="user">
      <i class="fa-1x glyphicon glyphicon-user"></i>
      <span><?php echo $this->session->userdata('fullName');?></span>
    </div>
    <div class="menu">
      <div class="menu-content">
        <ul id="social-sidebar-menu">
          <?php if($isadmin){ ?>
          <li class="active">
            <a href="<?php echo base_url();?>" target="_blank">
              <!-- icon--><i class="fa fa-laptop"></i>
              <span><?php echo trans('02');?></span>
            </a>
          </li>
          <!-- END ELEMENT MENU-->
          <!-- BEGIN ELEMENT MENU-->
          <?php $chkupdates = checkUpdatesCount(); if($chkupdates->showUpdates){ if($isSuperAdmin){ ?>
          <li>
            <a href="<?php echo base_url(); ?>admin/updates/"><i class="fa fa-refresh"></i>
            <span>Cập nhật</span><span class="pull-right label label-danger" id="updatescount"><?php if($chkupdates->count > 0){ echo $chkupdates->count; }; ?></span>
            </a>
          </li>
          <?php } } ?>
          <li>
            <a data-toggle="collapse" data-parent="#social-sidebar-menu" href="#ACCOUNTS"><i class="glyphicon glyphicon-user"></i>
            <span>Tài khoản</span><i class="fa arrow"></i>
            </a>
            <ul id="<?php echo trans('017');?>" class="collapse wow fadeIn animated">
              <?php if($role != "admin"){ ?>
              <li><a href="<?php echo base_url();?>admin/accounts/admins/">Quản trị viên</a></li>
              <?php } ?>
              <li><a href="<?php echo base_url();?>admin/accounts/suppliers/">Đối tác</a></li>
              <li><a href="<?php echo base_url();?>admin/accounts/customers/">Khách hàng</a></li>              
            </ul>
          </li>
          <?php if($isSuperAdmin){ ?>
          <li>
            <a href="#general" data-toggle="collapse" data-parent="#social-sidebar-menu">
              <!-- icon--><i class="fa fa-cogs"></i>
              <span>Thông tin chung</span>
              <!-- arrow--><i class="fa arrow"></i>
            </a>
            <!-- BEGIN SUB-ELEMENT MENU-->
            <ul id="general" class="collapse wow fadeIn animated">
              <li> <a href="<?php echo base_url();?>admin/settings/">Cài đặt</a> </li>             
              <li>
                <a href="<?php echo base_url();?>admin/settings/modules/">Cấu trúc</a>
              </li>
              <li>
                <a href="<?php echo base_url();?>admin/settings/currencies/">Tiền tệ</a>
              </li>
              <li>
                <a href="<?php echo base_url();?>admin/settings/paymentgateways/">Quản lý thanh toán</a>
              </li>
              <li>
                <a href="<?php echo base_url();?>admin/settings/social/">Quản lý mạng xã hội</a>
              </li>
              <li>
                <a href="<?php echo base_url();?>admin/settings/widgets/">Tiện ích giao diện</a>
              </li>
              <li>
                <a href="<?php echo base_url();?>admin/settings/sliders/">Trình chiếu hình ảnh</a>
              </li>
              <li>
                <a href="<?php echo base_url();?>admin/templates/email/">Mẫu gửi email</a>
              </li>
              <li>
                <a href="<?php echo base_url();?>admin/backup/">Sao lưu</a>
              </li>
            </ul>
            <!-- END SUB-ELEMENT MENU-->
          </li>
          <?php } ?>
          <!-- END ELEMENT MENU-->
          <!-- BEGIN ELEMENT MENU-->
          <li>
            <a href="#CMS" data-toggle="collapse" data-parent="#social-sidebar-menu">
              <!-- icon--><i class="fa fa-list-alt"></i>
              <span><?php echo trans('013');?></span>
              <!-- arrow--><i class="fa arrow"></i>
            </a>
            <!-- BEGIN SUB-ELEMENT MENU-->
            <ul id="CMS" class="collapse wow fadeIn animated">
              <li>
                <a href="<?php echo base_url();?>admin/cms"><?php echo trans('015');?></a>
              </li>
              <li>
                <a href="<?php echo base_url();?>admin/cms/menus/manage"><?php echo trans('016');?></a>
              </li>
            </ul>
          </li>
          <?php } if(empty($supplier)){  ?>
          <?php $moduleslist = $this->ptmodules->read_config();
            $baseurl = base_url();
            @$urisegment = $this->uri->segment(1);

            foreach($moduleslist as $modl){
            $isenabled = $this->ptmodules->is_main_module_enabled(strtolower($modl['Name']));
            if($isenabled){
            if($urisegment == "admin"){ $submenu = $modl['AdminMenu'];}else{ $submenu = $modl['SupplierMenu']; }
            if(pt_permissions($modl['Name'],@$userloggedin)){
             if($modl['isIntegration'] != "Yes"){
            ?>
          <li>
            <a href="#<?php echo $modl['DisplayName']; ?>" data-toggle="collapse" data-parent="#social-sidebar-menu">
            <?php echo $modl['Icon']; ?>
            <span><?php echo $modl['DisplayName']; ?></span>
            <i class="fa arrow"></i>
            </a>
            <ul id="<?php echo $modl['DisplayName']; ?>" class="collapse  wow fadeIn animated">
             <?php echo str_replace("%baseurl%","$baseurl",$submenu); ?>
            </ul>
          </li>
          <?php } } } } } ?>
          <?php if($isadmin && $role != "admin"){ if(pt_is_module_enabled('offers')){  ?>
          <li>
            <a data-toggle="collapse" data-parent="#social-sidebar-menu" href="#SPECIAL_OFFERS"><i class="fa fa-gift"></i>
            <span>Ưu đãi</span><i class="fa arrow"></i>
            </a>
            <ul id="SPECIAL_OFFERS" class="collapse  wow fadeIn animated">
              <li><a href="<?php echo base_url();?>admin/offers/">Quản lý ưu đãi</a></li>
              <li><a href="<?php echo base_url();?>admin/offers/settings/">Cài đặt ưu đãi</a></li>
            </ul>
          </li>
          <?php } if(pt_is_module_enabled('coupons')){  ?>
          <li>
            <a href="<?php echo base_url();?>admin/coupons/"><i class="fa fa-asterisk"></i>
            <span>Mã ưu đãi</span>
            </a>
          </li>
          <?php } } ?>
          <li>
            <a data-toggle="collapse" data-parent="#social-sidebar-menu" href="#COMBO">
                <i class="fa fa-gift"></i>
                <span>Combo</span>
                <i class="fa arrow"></i>
            </a>
            <ul id="COMBO" class="collapse  wow fadeIn animated">
              <li><a href="<?php echo base_url();?>admin/combo/">Quản lý Combo</a></li>
              <li><a href="<?php echo base_url();?>admin/combo/add/">Thêm combo</a></li>
            </ul>
          </li>
          <li>
            <a data-toggle="collapse" data-parent="#social-sidebar-menu" href="#HONEYMOON">
                <i class="fa fa-gift"></i>
                <span>Honeymoon</span>
                <i class="fa arrow"></i>
            </a>
            <ul id="HONEYMOON" class="collapse  wow fadeIn animated">
              <li><a href="<?php echo base_url();?>admin/honeymoon/">Quản lý honeymoon</a></li>
              <li><a href="<?php echo base_url();?>admin/honeymoon/add/">Thêm honeymoon</a></li>
            </ul>
          </li>

          <?php if(pt_permissions('locations',@$userloggedin)){ ?>
          <li>
          <a href="<?php echo base_url().$this->uri->segment(1);?>/locations">
              <i class="fa fa-map-marker"></i>
                <span>Vị trí</span>
          </a>
          </li>
          <?php } ?>
          <?php if($isadmin){  if(pt_is_module_enabled('newsletter')){  ?>
           <?php if(pt_permissions('newsletter',@$userloggedin)){ ?>
          <li>
            <a href="<?php echo base_url();?>admin/newsletter/">
                <i class="fa fa-envelope"></i>
                <span>Thư</span>
            </a>
          </li>
          <?php } } } ?>
          <?php if(pt_permissions('booking',@$userloggedin)){ ?>
           <li>
            <a href="<?php echo base_url().$this->uri->segment(1);?>/bookings/">
                <i class="fa fa-list"></i>
                <span><?php echo trans('034');?></span>
            </a>
          </li>
          <?php } ?>
          <?php if(pt_permissions('evoucher',@$userloggedin)){ ?>
           <li>
            <a href="<?php echo base_url().$this->uri->segment(1);?>/evoucher/">
                <i class="fa fa-list"></i>
                <span>Evoucher</span>
            </a>
          </li>
          <?php } ?>
        </ul>
      </div>
    </div>
    <!-- END MENU SECTION-->
  </div>
</aside>
<!-- END SIDEBAR-->