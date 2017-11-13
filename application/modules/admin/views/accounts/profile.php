<form action="" method="POST">
<?php echo @$msg; ?>
<div class="panel panel-default">
  <div class="panel-heading">Thông tin</div>
  <div class="panel-body">
    <div class="panel-body">
      <div class="col-md-12">
        <div class="form-group ">
          <label class="required">Loại tài khoản</label>
          <input class="form-control" type="text" disabled="disabled" placeholder="Account Type" name="" value="<?php echo $accType;?>">
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group ">
          <label class="required">Tên</label>
          <input class="form-control" type="text" placeholder="Tên" name="fname" value="<?php echo $profile[0]->ai_first_name;?>">
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group ">
          <label class="required">Họ</label>
          <input class="form-control" type="text" placeholder="Họ" name="lname" value="<?php echo $profile[0]->ai_last_name;?>">
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group ">
          <label class="required">Email</label>
          <input class="form-control" type="email" placeholder="Email address" name="email" value="<?php echo $profile[0]->accounts_email;?>">
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group ">
          <label class="required">Mật khẩu</label>
          <input class="form-control" type="password" placeholder="Mật khẩu" name="password">
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group ">
          <label class="required">Số điện thoại</label>
          <input class="form-control" type="text" placeholder="Số điện thoại" name="mobile" value="<?php echo $profile[0]->ai_mobile;?>">
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group ">
          <label class="required">Quốc gia</label>
          <select class="chosen-select" name="country" id="">
          <option value="">-Chọn-</option>
            <?php foreach($countries as $c){ ?>
            <option value="<?php echo $c->iso2;?>" <?php if($profile[0]->ai_country == $c->iso2){ echo "selected"; }?> ><?php echo $c->short_name;?></option>
            <?php } ?>
          </select>
        </div>
      </div>
      <div class="clearfix"></div>
      <div class="col-md-6">
        <div class="form-group ">
          <label class="required">Địa chỉ 1</label>
          <input class="form-control" type="text" placeholder="Full address" name="address1" value="<?php echo $profile[0]->ai_address_1;?>">
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group ">
          <label class="required">Địa chỉ 2</label>
          <input class="form-control" type="text" placeholder="Full address" name="address2" value="<?php echo $profile[0]->ai_address_2;?>">
        </div>
      </div>
      <?php if(empty($isSuperAdmin)){ ?>
      <div class="col-md-6">
        <div class="col-md-12">
        <div class="row">
        <label>
              <input class="checkbox" type="checkbox" name="newssub" value="1" <?php if($isSubscribed){ echo "checked"; }?> > <strong>Email Newsletter Subscriber</strong>
        </label>
        </div>
        </div>
      </div>
      <?php } ?>
      <div class="clearfix"></div>
    </div>
  </div>
  <div class="panel-footer">
  <input type="hidden" name="update" value="1" />
  <input type="hidden" name="type" value="<?php echo $profile[0]->accounts_type;?>" />
  <input type="hidden" name="status" value="<?php echo $profile[0]->accounts_status;?>" />
  <input type="hidden" name="oldemail" value="<?php echo $profile[0]->accounts_email;?>" />
    <button class="btn btn-primary">Lưu</button>
  </div>
</div>
</form>



