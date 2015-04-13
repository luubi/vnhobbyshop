<?php
class db{
    public $kq = NULL;
    public $host = "localhost";
    public $user = "root";
    public $pass = "";
    public $db ="vnhobbyshop";
	public $dbc = NULL;
     //function __construct
     function __construct() {
        $con = mysqli_connect($this->host, $this->user, $this->pass, $this->db);
        mysqli_set_charset($con,'utf8');
		if(mysqli_errno($con)){
            echo"sum error";
        }
        else{
           $this->dbc = $con; // assign $con to $dbc
        }
    }
     //hàm getdata
     function getdata($lenh)
         {
         $kq = mysqli_query($this->dbc,$lenh);
         return $kq;
         }
    function idinsert(){
		return $this->dbc->insert_id;
		}
    
}
?>
