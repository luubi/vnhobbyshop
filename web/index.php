<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Order Product</title>
<link rel="stylesheet" type="text/css" href="../css/index.css"/>
<script type="text/javascript" src="../js/index.js"></script>
<script type="text/javascript" src="../js/jquery-1.8.2.js"></script>
<style>
	
</style>
</head>

<body>

<div style="width:600px;margin:auto;">
<img src="logo.png" alt="VN Hobby" width="350" height="100" style="margin:auto">
<div style="margin-top:50px; height:100px">
<font size="5" color="red">Hỗ trợ đặt hàng</font>
<a href="Skype:roik.diti?chat"> <img src="http://mystatus.skype.com/bigclassic/roik.diti" title="Support Order" width="120" height="30" alt=""> </a>
<div class="fb-like" data-href="https://www.facebook.com/vnhobbyshop" data-width="200" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>
</div>
<?php
include("../library/function.php");
set_time_limit(0);

date_default_timezone_set('Asia/Saigon');

$date = date('Y/m/d h:i:s', time());
if(isset($_POST['txt_url0'])){
	
	$i=0;
	while(isset($_POST['txt_url'.$i])){
		$i++;
	}
	@$url='';
	for($j=0;$j<$i;$j++){
		@$url=$url.' '.$_POST['txt_url'.$j];
		}
	@$quantity='';
	for($j=0;$j<$i;$j++){
		@$quantity=$quantity.' '.$_POST['txt_quantity'.$j];
		}
	@$name=$_POST['txt_name'];
	@$phone=$_POST['txt_phone'];
	$t = new ham();
	$t->insert_data_ship($name,$phone,$url,$quantity,$date);
	$id=$t->idinsert();
	$kq=$t->get_data_ship($id);
while($row=mysqli_fetch_array($kq))
{
	
	
	$tok = strtok($row['link'], " \n\t");
	$quantitys=explode(" ",$row['quantity']);
	$sumcost="";
	$sumwei="";
	$j=1;
	while ($tok !== false) {
		$url=$tok;
		$content = file_get_contents($url);
		$first_step = explode( '<span id="pweight" style="margin:0;font-size: 16px;width:50%; padding-top:15px">' , $content);
		$wei = explode("</span>" , $first_step[1] );
		$first_step1 = explode( '<span style="font-size: 38px;font-weight:bold; color:#ff6600;" itemprop="price" id="price_lb">' , $content);
		$cos = explode("</span>" , $first_step1[1] );
		$sumcost+=substr($cos[0], 1)*$quantitys[$j];
		$sumwei+=$wei[0]*$quantitys[$j];
		$j++;
		$tok = strtok(" \n\t");
		}
		?>
    
        <form>
        	Tổng Khối Lượng đơn hàng<br />
            <input style="width:400px; height:25px; padding:5px; border:solid 2px #484848" type="text" value="<?php if(isset($sumwei)) echo $sumwei.' g'?>"/>
            <br />
			<br />
            Tổng Giá Tiền Hàng<br />
			<input style="width:400px; height:25px; padding:5px; border:solid 2px #484848" type="text" value="<?php if(isset($sumcost)) echo '$ '.$sumcost?>"/>
            <input style="width:400px; height:25px; padding:5px; border:solid 2px #484848;margin-top: 20px;" type="text" value="<?php if(isset($sumcost)) echo $sumcost*22500 .' vnđ (1$ → 22.500vnđ)'?>"/>
            <br />
			<br />
            Tiền mới chỉ bao gồm tiền hàng - liên hệ shop để biết tiền ship
            <br />
			<br />
			<a href="index.php"><input style="height:40px; padding:5px; background-color:#2d7faa; color:#fff;border:solid 2px #484848; margin-right:20px" type="button" value="Trở lại" /></a>
            <a href="report.php?id=<?=$id?>"><input style="height:40px; padding:5px; background-color:#2d7faa; color:#fff;border:solid 2px #484848; " type="button" value="Đặt hàng" /></a>
        </form>
        <?php

	}
}
else{

?>
	<script type="text/javascript">
        $(document).ready(function(){
            var i=1;
            $("#themurl").click(function(){
                $("#nn").append("<input style=\"width:400px; height:25px; padding:5px; border:solid 2px #484848; margin-bottom:20px\" type=\"text\" name=\"txt_url"+i+"\"/><input style=\"width:50px; height:25px; padding:5px; border:solid 2px #484848; margin:0 0 20px 15px\" type=\"text\" name=\"txt_quantity"+i+"\" value=\"1\"/> <br/>");	
                i++;
            });
        });
    </script>
<form method="POST">
	Họ Tên<br />

	<input style="width:400px; height:25px; padding:5px; border:solid 2px #484848" type="text" name="txt_name" value="<?php if(isset($_POST['txt_name'])) echo $_POST['txt_name']?>" /><br />
    <br />
    <br />
    Số Điện Thoại<br />

    <input style="width:400px; height:25px; padding:5px; border:solid 2px #484848" type="text" name="txt_phone" value="<?php if(isset($_POST['txt_phone'])) echo $_POST['txt_phone']?>" /><br />
    <br />
    <br />
    Đường link hobbyking &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Số lượng<br />
	<input style="width:400px; height:25px; padding:5px; border:solid 2px #484848; margin-bottom:20px" type="text" name="txt_url0"/>
    <input style="width:50px; height:25px; padding:5px; border:solid 2px #484848; margin:0 0 20px 10px" type="text" name="txt_quantity0" value="1"/>
    <div id="nn"></div>
    <input style="height:40px; width:150px;padding:5px; background-color:#2d7faa; color:#fff;border:solid 2px #484848; margin-right:20px" type="button" id="themurl" value="Thêm Link Sản Phẩm"/>
            
    <input style="height:40px; padding:5px; background-color:#2d7faa; color:#fff;border:solid 2px #484848" type="submit" value="Tính Tiền" name="btn_submit"/>
</form>
<?php
}
?>
<div style="margin-top:20px;">
	<img src="http://vnhobbyshop.com/hinh/giaohanh.jpg"  style="margin-right:20px;"/>
    <img src="http://vnhobbyshop.com/hinh/bank.png" />
</div>
</div>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&appId=266586253526658&version=v2.3";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
</body>
</html>