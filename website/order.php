<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>CUA HANG DO UONG H2KSHOP</title>
    <link rel="stylesheet" type="text/css" href="preview.css"/>
    <link rel="stylesheet" type="text/css" href="h2kshop_guest.css"/>
	<link rel="stylesheet" type="text/css" href="wt-rotator.css"/>
	<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
    <script type="text/javascript" src="js/jquery.wt-rotator.min.js"></script>
	<script type="text/javascript" src="js/preview.js"></script>   
    <style>
#myDIV {
   position:fixed;
    width: 200px;
    height: 200px;
    display: none;
    top:50px;
    right: 20px;
    background-color: #555;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);

}
#smsDIV {
   position:fixed;
    width: 300px;
    height: 210px;
    display: none;
    top:50px;
    right: 20px;
    background-color: #555;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);

}
#phDIV {
   position:fixed;
    width: 300px;
    height: 210px;
    display: none;
    top:50px;
    right: 40px;
    background-color: #555;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);

}
/*
<a href="\" style="color: white;"><img src="images/face.png"></img>your name</a>
                
                
                
*/

</style>
    <style>
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
}
</style> 

</head>
<body bgcolor="white">
<?php
session_start();
 if (isset($_POST['view_detail']))
            {
                if(!empty($_POST['check_list'])) {
                    foreach($_POST['check_list'] as $check) {
                        $query="select d_cost from drink where d_name = '".$check."'";
                        
                    $_SESSION["d_detail"]=$check;
                    break;
                        
                    }
                }
                header("location: http://localhost/btl_Hai/drink_detail.php");
            }

?>

<div class="header">
		<div class="searchDiv">
			<form method="post" action="search.php">
				<input class="search1" type="text" name="search11" placeholder="Tìm Kiếm" >
                <input type="submit" value="search" name ="p_search">
			</form>
		</div>
		<div class="login">
            <form method="post" >
            
                <?php
                    session_start();
                    echo "<a style=\"color: white;\"><img src=\"images/face.png\"></img>".$_SESSION["name"]."</a>";
                    //$db = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=Milubamhanc");
                    ////// order successfull
                    include('me_config.php');
                    
                //// notification
                        $query ="select reply from comment_msg where seen2 ='false' and acc_name= '".$_SESSION["sacc_name"]."' and comment_id = (select max(comment_id) from comment_msg where acc_name= '".$_SESSION["sacc_name"]."' and d_name= 'znul'  ) ;";
                        $result = pg_query($query);  
                        $row = pg_fetch_assoc($result);
                        if($row==NULL)
                            echo "<a href=\"javascript:phFunction();\"> <img src=\"images/noti.png\"></a>";
                        else echo "<a href=\"javascript:phFunction();\"> <img src=\"images/newmsg.jpg\"></a>";

                    
                    echo "<a href=\"javascript:smsFunction();\"> <img src=\"images/ph.png\"></a>";
                    echo "<a href=\"javascript:myFunction();\"> <img src=\"images/menu.png\"></a>";

                    /////// gui tin nhan
                    if (isset($_POST['sms'])) 
                    {

                        include('me_config.php');
                        //$db = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=Milubamhanc");
                        $query ="select * from comment_msg where acc_name = '".$_SESSION["sacc_name"]."'order by comment_id desc ;";
                        $result = pg_query($query);  
                        $row = pg_fetch_assoc($result);
                        $id_msg=$row[comment_id];
                        //$ct_msg=$row[cmt_content];
                        if($row[seen]=='f') 
                        {
                            $newsms=$row[cmt_content]."\n".$_POST['sms_msgn'];
                            $query = "update comment_msg set cmt_content = '".$newsms."' where comment_id = ".$id_msg.";";
                            $result = pg_query($query); 
                        }
                        else 
                        {
                            $id_msg+=1;
                            $newsms=$_POST['sms_msgn'];
                        
                            $query = "insert into comment_msg values (".$id_msg.",'".$_SESSION["sacc_name"]."','znul','".$newsms."',false,'chưa trả lời !',true);";
                            $result = pg_query($query); 
                        }
                        echo "<script type='text/javascript'>alert('gui thanh cong');</script>"; 

                    }
                ?>
                <div id="myDIV">
                <a href="file:///D:/btl_csdl/btl2/home_admin.html" class="a2">
                <img src="images/register.png">  Thông tin cá nhân</a>
                <a href="file:///D:/btl_csdl/btl2/home_admin.html" class="a2">  
                <img src="images/store.png">about H2Kshop</a>
                <a href="file:///D:/btl_csdl/btl2/home_admin.html" class="a2">  
                <img src="images/seat.png">Đặt chỗ</a>
                <a href="file:///D:/btl_csdl/btl2/home_admin.html" class="a2">  
                <img src="images/shopping.png">Lịch sử mua hàng</a>
                <a href="http://localhost/btl_Hai/home_stranger2.php" class="a2">  
                <img src="images/out.png">
                Đăng xuất</a>
                </div>

                <div id="smsDIV">
                <form method="post" >
                    <input class="search_msg" type="text" id="sms_msg" placeholder="Viết tin nhắn" name="sms_msgn">
                    <input type="submit" value="send"  name="sms">
                    <textarea class ="msgTa" id="msgTa" >
                        <?php
                        include('me_config.php');
                        //$db = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=Milubamhanc");
                        $query ="select cmt_content from comment_msg where acc_name = '".$_SESSION["sacc_name"]."'order by comment_id desc ;";
                        $result = pg_query($query);  
                        $row = pg_fetch_assoc($result);
                        $ct_msg="\n".$row[cmt_content];
                        echo $ct_msg;
                        ?>
                    </textarea>
                </form>
                
                </div>
                <div id="phDIV">
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    
                    <center><font color="white" size="4px">Phản hồi của cửa hàng</font></center>
                    <textarea class ="msgTa" id="msgTaph" >
                     <?php
                        include('me_config.php');
                        //$db = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=Milubamhanc");
                        $query ="select reply,comment_id from comment_msg where acc_name = '".$_SESSION["sacc_name"]."' and d_name = 'znul' order by comment_id desc ;";
                        $result = pg_query($query);  
                        $row = pg_fetch_assoc($result);
                        $id2=$row[comment_id];
                        $ct_msg="\n".$row[reply];
                        echo $ct_msg;
                        $query ="update comment_msg set seen2 = 'true' where comment_id = ".$id2.";";
                        $result = pg_query($query);  
                        ?>   
                    </textarea>
                </form>
                </div>
                <script>
                
                function myFunction() 
                {
                    var x = document.getElementById('myDIV');
                    var x2 = document.getElementById('smsDIV');
                    if (x2.style.display === 'none') 
                    {
                    } else 
                    {
                        x2.style.display = 'none';
                    }
                    var x3 = document.getElementById('phDIV');
                    if (x3.style.display === 'none') 
                    {
                    } else 
                    {
                        x3.style.display = 'none';
                    }
                    if (x.style.display === 'none') 
                    {
                        x.style.display = 'block';
                    } else 
                    {
                        x.style.display = 'none';
                    }
                }
                function phFunction() 
                {
                    var x = document.getElementById('phDIV');
                    var x2 = document.getElementById('smsDIV');
                    if (x2.style.display === 'none') 
                    {
                    } else 
                    {
                        x2.style.display = 'none';
                    }
                    var x3 = document.getElementById('myDIV');
                    if (x3.style.display === 'none') 
                    {
                    } else 
                    {
                        x3.style.display = 'none';
                    }
                    if (x.style.display === 'none') 
                    {
                        x.style.display = 'block';
                    } else 
                    {
                        x.style.display = 'none';
                    }
                }
                function send()
                {
                    var s=document.getElementById('sms_msg').value;
                    document.getElementById('msgTa').value=s;
                }
                function smsFunction() 
                {
                    var x = document.getElementById('smsDIV');
                    var x2 = document.getElementById('myDIV');
                    if (x2.style.display === 'none') 
                    {
                    } else 
                    {
                        x2.style.display = 'none';
                    }
                    var x3 = document.getElementById('phDIV');
                    if (x3.style.display === 'none') 
                    {
                    } else 
                    {
                        x3.style.display = 'none';
                    }
                    if (x.style.display === 'none') 
                    {
                        x.style.display = 'block';
                    } else 
                    {
                        x.style.display = 'none';
                    }
                }
                </script>
            </form>
        </div>
</div>
<div class="cover">
		<img src="logo3.jpg" width="100px" height="100px" class="logo"> </img>
		<img src="logo2.jpg" height="100px" width="1049px" class="logo2"> </img>
		
</div>
<div class="menu" style="background-color: rgb(128,128,128);">
		<div class="submenu">
			<a href="http://localhost/btl_Hai/home_guest.php" class="a1"> <img src="images/home.png"></img> Home</a>
			<a href="http://localhost/btl_Hai/wine.php" class="a1"> Wine</a>
			<a href="http://localhost/btl_Hai/beer.php" class="a1">Beer</a>
			<a href="http://localhost/btl_Hai/cooktail.php" class="a1">Cocktail</a>
            <a href="http://localhost/btl_Hai/detox.php" class="a1">Detox</a>
		</div>
</div>

 <!-- (bat dau thay doi)  sua dong nay -->   <form method="post" action="purchase_history.php">
 <!-- (ket thuc thay doi) -->
    <center>
    <div class="order_list">
        <?php
            session_start();
            
        ?>
        <br><center><font size="5px">Đơn Đặt Hàng</font></center><hr>
        <br>
        <table style="width:100%">
        <tr><th>TÊN KHÁCH HÀNG:</th><th>ĐỊA CHỈ:</th><th>ĐIỆN THOẠI:</th></tr>
        <tr><th><?php echo $_SESSION["name"] ?></th><th><input class="slu2" type="text" name="addre" 
        value="<?php echo $_SESSION["addr"] ?>"></th><th><?php echo $_SESSION["phone"] ?></th></tr>
        </table>
        <br>
        <hr><center>Danh sách sản phẩm</center><hr>
        <br>
        <?php
            $total=0;
            include('me_config.php');
            //$db = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=Milubamhanc"); 
            

            if (isset($_POST['order_pro']))
            {
                echo "<table style=\"width:100%\">
                <tr><th>Số lượng</th><th>SẢN PHẨM</th><th>ĐƠN GIÁ</th></tr>
                ";
                if(!empty($_POST['check_list'])) {
                    foreach($_POST['check_list'] as $check) {
                        $query="select d_cost from drink where d_name = '".$check."'";
                        $result = pg_query($query); 
                        $row = pg_fetch_assoc($result); 
                        echo "<tr><th><input class=\"slu\" type=\"number\" name=\"sl[]\" > </th><th>
                        <input class=\"slu2\" type=\"text\" name=\"na[]\" 
        value=\"".$check."\"></th><th> 
                        <input class=\"slu\" type=\"number\" name=\"cos[]\" 
        value=\"".$row[d_cost]."\"></th></tr>";
                        /*$query ="update seat set is_free = FALSE, acc_name = NULL where s_name = '".$check."';";
                        $result = pg_query($query); */
                    }
                }
                echo "</table>";
                echo "<br><br><input type=\"submit\" value=\"Xác nhận\"  name=\"xnorder\">";
            }
        ?>

    </div>
    </center>
    </form>
</body>    
</html>
