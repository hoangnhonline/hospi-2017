<?php

function banktransfer_config() {
$configarray = array(
"FriendlyName" => array("Type" => "System", "Value"=>"Bank Transfer"),
    "instructions" => array( "Type" => "text", "Value" => "Quý khách vui lòng chọn ngân hàng" ),
     "dongabank" => array("FriendlyName" => "Ngân hàng Đông Á", "Type" => "textarea", "Rows" => "5", "Value" => "<div><span class=\"label-title\">Ngân hàng:</span> Ngân hàng Đông Á</div>
<div><span class=\"label-title\">Địa chỉ:</span> 518 Nguyễn Thị Minh Khai, Phường 2, Quận 3, TP. HCM</div>
<div><span class=\"label-title\">Chi nhánh:</span> PGD Bến Nghé - CN Quận 1</div>
<div><span class=\"label-title\">Tên tài khoản:</span> CÔNG TY TNHH Hospi</div>
<div><span class=\"label-title\">Số tài khoản:</span> 0123456789   </div>", ),
     "viettinbank" => array("FriendlyName" => "Ngân hàng Viettin Bank - TK cá nhân", "Type" => "textarea", "Rows" => "5", "Value" => "<div><span class=\"label-title\">Ngân hàng:</span> Ngân hàng Viettin Bank</div>
<div><span class=\"label-title\">Địa chỉ:</span> 518 Nguyễn Thị Minh Khai, Phường 2, Quận 3, TP. HCM</div>
<div><span class=\"label-title\">Chi nhánh:</span> PGD Bến Nghé - CN Quận 1</div>
<div><span class=\"label-title\">Tên tài khoản:</span> CÔNG TY TNHH Hospi</div>
<div><span class=\"label-title\">Số tài khoản:</span> 0123456789   </div>", ),
    "agribank" => array("FriendlyName" => "Ngân hàng Agribank - TK Công ty", "Type" => "textarea", "Rows" => "5", "Value" => "<div><span class=\"label-title\">Ngân hàng:</span> Ngân hàng Agribank</div>
<div><span class=\"label-title\">Địa chỉ:</span> 518 Nguyễn Thị Minh Khai, Phường 2, Quận 3, TP. HCM</div>
<div><span class=\"label-title\">Chi nhánh:</span> PGD Bến Nghé - CN Quận 1</div>
<div><span class=\"label-title\">Tên tài khoản:</span> CÔNG TY TNHH Hospi</div>
<div><span class=\"label-title\">Số tài khoản:</span> 0123456789   </div>", ),
    "vcb" => array("FriendlyName" => "Ngân hàng VCB (Vietcombank) - TK Công ty", "Type" => "textarea", "Rows" => "5", "Value" => "<div><span class=\"label-title\">Ngân hàng:</span> Ngân hàng VCB (Vietcombank)</div>
<div><span class=\"label-title\">Địa chỉ:</span> 518 Nguyễn Thị Minh Khai, Phường 2, Quận 3, TP. HCM</div>
<div><span class=\"label-title\">Chi nhánh:</span> PGD Bến Nghé - CN Quận 1</div>
<div><span class=\"label-title\">Tên tài khoản:</span> CÔNG TY TNHH Hospi</div>
<div><span class=\"label-title\">Số tài khoản:</span> 0123456789   </div>", ),
    "hsbc" => array("FriendlyName" => "Ngân hàng HSBC - TK cá nhân", "Type" => "textarea", "Rows" => "5", "Value" => "<div><span class=\"label-title\">Ngân hàng:</span> Ngân hàng HSBC</div>
<div><span class=\"label-title\">Địa chỉ:</span> 518 Nguyễn Thị Minh Khai, Phường 2, Quận 3, TP. HCM</div>
<div><span class=\"label-title\">Chi nhánh:</span> PGD Bến Nghé - CN Quận 1</div>
<div><span class=\"label-title\">Tên tài khoản:</span> CÔNG TY TNHH Hospi</div>
<div><span class=\"label-title\">Số tài khoản:</span> 0123456789   </div>", ),
    "mbbank" => array("FriendlyName" => "Ngân hàng Quân Đội (MBBank) - TK cá nhân", "Type" => "textarea", "Rows" => "5", "Value" => "<div><span class=\"label-title\">Ngân hàng:</span> Ngân hàng Quân Đội (MBBank)</div>
<div><span class=\"label-title\">Địa chỉ:</span> 518 Nguyễn Thị Minh Khai, Phường 2, Quận 3, TP. HCM</div>
<div><span class=\"label-title\">Chi nhánh:</span> PGD Bến Nghé - CN Quận 1</div>
<div><span class=\"label-title\">Tên tài khoản:</span> CÔNG TY TNHH Hospi</div>
<div><span class=\"label-title\">Số tài khoản:</span> 0123456789   </div>", ),
    );
return $configarray;
}


function banktransfer_link($params) {
	
	//$code = "<p>" . nl2br( $params['dongabank'] ). "</p>";
        $code = "<p>" . $params['instructions']. "</p>";

        $code .= '<div><label for="mbbank"><input id="mbbank" type="radio" name="bank" value="mbbank" checked> Ngân hàng Quân Đội</label></div>
                <div><label for="dongabank"><input id="dongabank" type="radio" name="bank" value="dongabank"> Ngân hàng Đông Á</label></div>
                <div><label for="viettinbank"><input id="viettinbank" type="radio" name="bank" value="viettinbank"> Ngân hàng Viettin Bank</label></div>
                <div><label for="agribank"><input id="agribank" type="radio" name="bank" value="agribank"> Ngân hàng Agribank</label></div>
                <div><label for="vcb"><input id="vcb" type="radio" name="bank" value="vcb"> Ngân hàng VCB</label></div>
                <div><label for="hsbc"><input id="hsbc" type="radio" name="bank" value="hsbc"> Ngân hàng HSBC</label></div>';
        $code .= '<div id="divBankDetails" class="col-xs-12">';
        
        $code .= '<span id="spanmbbank" class="bank-account" style="display:block;">';
        $code .= $params['mbbank'];
        $code .= '<textarea class="textbank" style="display:none;" name="mbbank" rows="2" cols="20">'.$params['mbbank'].'</textarea>';
        $code .= '</span><span id="spandongabank" class="bank-account" style="display:none;">';
        $code .= $params['dongabank'];
        $code .= '<textarea class="textbank" style="display:none;" name="dongabank" rows="2" cols="20">'.$params['dongabank'].'</textarea>';
        $code .= '</span><span id="spanviettinbank" class="bank-account" style="display:none;">';
        $code .= $params['viettinbank'];
        $code .= '<textarea class="textbank" style="display:none;" name="viettinbank" rows="2" cols="20">'.$params['viettinbank'].'</textarea>';
        $code .= '</span><span id="spanagribank" class="bank-account" style="display:none;">';
        $code .= $params['agribank'];
        $code .= '<textarea class="textbank" style="display:none;" name="agribank" rows="2" cols="20">'.$params['agribank'].'</textarea>';
        $code .= '</span><span id="spanvcb" class="bank-account" style="display:none;">';
        $code .= $params['vcb'];
        $code .= '<textarea class="textbank" style="display:none;" name="vcb" rows="2" cols="20">'.$params['vcb'].'</textarea>';
        $code .= '</span><span id="spanhsbc" class="bank-account" style="display:none;">';
        $code .= $params['hsbc'];
        $code .= '<textarea class="textbank" style="display:none;" name="hsbc" rows="2" cols="20">'.$params['hsbc'].'</textarea>';
        $code .= '</span>';

        $code .= '</div>';

	return $code;
}