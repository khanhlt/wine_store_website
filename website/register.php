<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>CUA HANG DO UONG H2KSHOP</title>
    <link rel="stylesheet" type="text/css" href="preview.css"/>
    <link rel="stylesheet" type="text/css" href="h2kshop_guest2.css"/>
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

</head>
<body bgcolor="white">
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

    <?php
// define variables and set to empty values
$name = $rpass = $rfullname = $raddress = $rphonenumber= $rquest = $rans = "";

if (isset($_POST['regis'])) {
  include('me_config.php');
  //$db2 = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=Milubamhanc");  
  $query2="select * from account_detail where acc_name = '".$_POST["accname"]."';";
  $result2 = pg_query($query2); 
  $row3 = pg_fetch_assoc($result2);

  if($row3["acc_name"]==NULL)
  {
    $name = $_POST["accname"];
  $rpass = $_POST["pass"];
  $rfullname = $_POST["fullname"];
  $raddress = $_POST["address"];
  $rphonenumber = $_POST["phonenumber"];
  $rquest = $_POST["question"];
  $rans = $_POST["answer"];
  
    $query2 = "insert into account_detail values ('".$name."','".$rpass."','".$rfullname."','".$raddress."','".$rphonenumber."', 0,'".$rquest."','".$rans."');";  
            $result2 = pg_query($query2);  
            echo "<script type='text/javascript'>alert('Đăng kí thành công');</script>"; 
  }
  else
  {
    echo "<script type='text/javascript'>alert('Trùng tên tài khoản ! hãy đổi lại');</script>"; 
    echo $row["acc_name"]."-".$row["acc_fullname"];
  }
}


?>

   <center>
    <div class="content_regi">

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
    <h2>Biểu mẫu đăng kí tài khoản mới </h2>

  Tên tài khoản:<br> <input class="regi_text" type="text" name="accname" required/>
  <br><br>
  Mật khẩu:<br>  <input class="regi_text" type="password" name="pass" required/>
  <br><br>
  Tên đầy đủ: <br> <input class="regi_text" type="text" name="fullname" required/>
  <br><br>
  Địa chỉ: <br> <input class="regi_text" type="text" name="address" required/>
  <br><br>
  Số điện thoại:<br> <input class="regi_text" type="text" name="phonenumber" required/>
  <br><br>
  Câu hỏi bí mật (dùng khi quên mật khẩu):<br> <input class="regi_text" type="text" name="question" required/>
  <br><br>
 Câu trả lời của bạn:<br> <input class="regi_text" type="text" name="answer" required/>

  <br><br>
  <input type="submit" name="regis" value="Đăng kí">  

</form>
    </div>
    </center>
    
</body>    
</html>
