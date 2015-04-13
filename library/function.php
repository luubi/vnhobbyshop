
<?php
include_once("data.php");
class ham extends db{
		//insert data
		function insert_data_ship($name,$phone,$url,$quantity,$time)
		{
			$kq="insert into ship values ('','$name','$phone','$url','$quantity','$time')";
			return db::getdata($kq);
		}
		//get data
		function get_data_ship($id)
		{
			$kq="select * from ship where ID='$id' order by ID desc";
			return db::getdata($kq);
		}
}
?>