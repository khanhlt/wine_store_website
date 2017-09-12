<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Quên mật khẩu</title>
    <link rel="stylesheet" type="text/css" href="preview.css"/>
    <link rel="stylesheet" type="text/css" href="h2kshop_guest.css"/>
	<link rel="stylesheet" type="text/css" href="wt-rotator.css"/>
	<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
    <script type="text/javascript" src="js/jquery.wt-rotator.min.js"></script>
	<script type="text/javascript" src="js/preview.js"></script>  
    <style >
        #phDIV {
   position:fixed;
    width: 300px;
    height: 70px;
    top:50px;
    right: 90px;
    background-color:white;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);

}
    </style>
    <style>
		.table1{
			text-align: center; 
			border-width: 15px ;
			padding: 5px;
		}
		.left{
			padding-left: 15px;
		}
		.tron{
			border-radius: 5%;
		}
	</style>

</head>
<body bgcolor="white" style="font-size: 20px;">
<div class="header">
		<div class="searchDiv">
			<form>
				<input class="search1" type="text" name="search" placeholder="Tìm Kiếm">
                <input type="submit" value="search">
			</form>
		</div>
		<div class="login">
        <?php
    
        // If the submit button has been pressed
         if (isset($_POST['lg']))
        {
            $s="<div id=\"phDIV\"><center>username hoặc password không đúng<br><br><a style=\"color: black;\" href=\"http://localhost/btl_Hai/me_2stranger_changePass.php\">Quên password</a></center></div>";
            //$db = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=Milubamhanc");  
            include('me_config.php');
            $query = "select * from account_detail where acc_name like '".$_POST['acc']."'";  
            $result = pg_query($query);  
            $row = pg_fetch_assoc($result);
            if($row==NULL) echo $s;
            else
            {
                if($row[acc_password]==$_POST['pass']) 
                {
                    if($_POST['acc']=="admin")
                    {
                        header("location: http://localhost/btl_Hai/home_admin.php");
                    }
                    else
                    {
                        session_start();
                    $_SESSION["name"]=$row[full_name];
                    $_SESSION["sacc_name"]=$row[acc_name];
                    $_SESSION["addr"]=$row[address];
                    $_SESSION["phone"]=$row[phone_number];
                    header("location: http://localhost/btl_Hai/home_guest.php");
                    }
                }
                else echo $s;
            }
        /*if($_POST['name']=='ab')
        echo "Hi ".$_POST['name']."!<br />";
        else 
            header("location: http://localhost/form.php");*/
        }
        
        ?>
            <form method="post">
                <input type="text"  class="text_login" name="acc" placeholder="Tài Khoản" required />
                <input type="password" name="pass" class="text_login" placeholder="Mật Khẩu" required />
                <input type="submit" value="ok" name="lg">
                <a href="http://localhost/btl_Hai/register.php" style="color: white;"><img src="images/register.png"></img>Đăng Kí</a>
            </form>
        </div>
</div>
<div class="cover">
		<img src="logo3.jpg" width="100px" height="100px" class="logo"> </img>
		<img src="logo2.jpg" height="100px" width="1049px" class="logo2"> </img>
		
</div>
<div class="menu" style="background-color: rgb(128,128,128);">
		<div class="submenu">
			<a href="http://localhost/btl_Hai/home_stranger2.php" class="a1"> <img src="images/home.png"></img> Home</a>
			<a href="http://localhost/btl_Hai/wine_stranger.php" class="a1"> Wine</a>
			<a href="http://localhost/btl_Hai/beer_stranger.php" class="a1">Beer</a>
			<a href="http://localhost/btl_Hai/cocktail_stranger.php" class="a1">Cocktail</a>
		</div>
</div>


<!-- Hiển's code -->

<?php
    include('me_config.php');
    if(isset($_POST["accname1"])){
        $user_h1=$_POST["accname1"];
    }else { $user_h1='0';  }
?>

<form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">
<div style="padding: 0px 50px 10px 50px;">
<table align="center" border="0" width="40%" bgcolor="#CCD1D4" class="table1" cellspacing="0">
    <tr height="40px" align="center" bgcolor="white">
        <td colspan=2><h2>Quên mật khẩu</h1></td>
    </tr>
    <tr height="40px" align="left">
        <td width="40%"  class="left">Tên đăng nhập:</td>
        <td><input class="tron" type="text" name="accname1" size="30"  required/></td>
    </tr>
    <tr height="40px"  align="center">
        <td colspan=2>
            <input type="submit" name="name_submit" value="Tiếp tục" />
        </td>
    </tr>
<?php
    if($user_h1 != '0'){
        $query="select * from account_detail where acc_name='".$user_h1."'";
        $result=pg_query($db,$query);
        if(!$result){echo "loi query!"; exit();}
        else{
            $arr=pg_fetch_array($result); echo $arr["acc_name"];
            if($arr==NULL){
                echo"
                    <tr height=\"30px\" align=\"center\">
                        <td colspan=2>Tên đăng nhập sai !</td>
                    </tr>
                ";
            }
            else{
                session_start();
                $_SESSION["name1"]=$arr["acc_name"];
                header("location: http://localhost/btl_Hai/me_2stranger_changePass_1.php");
            }
        }
    }
?>    

</table>
</div>
</form>
<div align="center" style="margin-top: 200px;">
            <hr/>
			<b>
			    Thời gian mở cửa: 8h - 22h (tất cả các ngày trong tuần)<br>
			    Địa chỉ: 177 Tạ Quang Bửu<br>
			    Liên hệ: 0969.696.969<br>
			</b>
</div>
</body>
</html>