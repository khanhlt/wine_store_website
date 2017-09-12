<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Tin nhắn</title>
    <link rel="stylesheet" type="text/css" href="preview.css"/>
    <link rel="stylesheet" type="text/css" href="h2kshop.css"/>
	<link rel="stylesheet" type="text/css" href="wt-rotator.css"/>
	<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
    <script type="text/javascript" src="js/jquery.wt-rotator.min.js"></script>
	<script type="text/javascript" src="js/preview.js"></script> 
    <style>
        .main {
            height: 600px;
            width: 800px;
            padding: 0;
            margin-left: auto;
            margin-right: auto;
            
        }
        .head {
            background-color: #CCD1D4;
            height: 50px;
            font-size: 35px;
            text-align: center;
            border: 1px solid #CDCDCD;
        }
        .left {
            border-radius: 10%;
            margin-top: 10px;
            width: 200px;
           
            background-color: #CCD1D4;
            float: left;
            border: 2px solid #CDCDCD;
        }
        .right {
            border-radius: 3%;
            width: 580px;
            height: 400px;
            background-color: #CCD1D4;
            margin-top: 10px;
            margin-left: 10px;
            float: right;
            border: 2px solid #CDCDCD;
        }
        .chat_text {
            float: right;
            margin-top: 10px;
            margin-right: 0px;
            
        }
        .button1{
            border-radius: 3%;
            height: 20px;
            
        }
    </style>
</head>
<body bgcolor="white" style="font-size: 20px">

    <?php                       // update tình trạng nhắn tin
        include('me_config.php');
            //pg_query($db, "update comment_msg set seen='TRUE' where seen='FALSE'");
            // kiểm tra isset tin nhắn, người đc chọn  -> cập nhật csdl
            session_start();
            if(isset($_POST["chon"])){
                $_SESSION["chon"]=$_POST["chon"];
            }
            if(isset($_POST["text_chat"])){
                if(isset($_SESSION["chon"])){
                    // câu lệnh sql nối thêm tin nhắn của admin vào cột reply
                        $query2="select * from comment_msg where acc_name = '".$_SESSION["chon"]."' order by comment_id DESC limit 1";
                        $result2=pg_query($db,$query2);
                        $arr2=pg_fetch_all($result2);
                        $reply_p = $arr2[0]["reply"];
                        $id=$arr2[0]["comment_id"];
                        $reply_next = $reply_p.$_POST["text_chat"]."<br/>"; 
                        
                        pg_query($db," update comment_msg set reply='".$reply_next."' 
                                        where comment_id in (select MAX(comment_id) from comment_msg 
                                        where acc_name = '".$_SESSION["chon"]."')");
                        pg_query($db," update comment_msg set seen='TRUE',seen2='FALSE' where comment_id='".$id."'" );
                        
                }else
                    echo"unset chon";
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
            <form>
            	<?php
            		//new comment
            		//$db = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=Milubamhanc");
                    include('me_config.php');
            		$query ="select seen from comment_msg where seen = 'false' and d_name != 'znul' ;";
                    $result = pg_query($query);  
                    $row = pg_fetch_assoc($result);
                    if($row!=NULL)
                    	echo "<a href=\"http://localhost/btl_Hai/see_drink_cmt.php\"><img src=\"images/commentnew.jpg\"></a>";
                    else 
                    	echo "<a href=\"http://localhost/btl_Hai/see_drink_cmt.php\"><img src=\"images/order.png\"></a>";
                    //// new order
            		$query ="select seen from order_product where seen = 'false' ;";
                    $result = pg_query($query);  
                    $row = pg_fetch_assoc($result);
                    if($row!=NULL)
                    	echo "<a href=\"http://localhost/btl_Hai/drink_order.php\"> <img src=\"images/ordernew.jpg\"></a>";
                    else 
                    	echo "<a href=\"http://localhost/btl_Hai/drink_order.php\"> <img src=\"images/shopping.png\"></a>";

                    // new sms
                	$query ="select seen from comment_msg where d_name = 'znul' and seen = 'false' ;";
                    $result = pg_query($query);  
                    $row = pg_fetch_assoc($result);
                    if($row!=NULL)
                    	echo "<a href=\"http://localhost/btl_Hai/me_5adminTinNhan.php\"> <img src=\"images/smsnew.jpg\"/></a>";
                    else 
                    	echo "<a href=\"http://localhost/btl_Hai/me_5adminTinNhan.php\"> <img src=\"images/sms.png\"/></a>";

                
                ?>

                <a href="/" style="color: white;"><img src="images/register.png"></img>Admin</a>
                <a href="http://localhost/btl_Hai/home_stranger2.php" >  
                <img src="images/out.png">
            </form>
        </div>
</div>
<div class="cover">
		<img src="logo3.jpg" width="100px" height="100px" class="logo"> </img>
		<img src="logo2.jpg" height="100px" width="1049px" class="logo2"> </img>
		
</div>
<div class="menu" style="background-color: rgb(128,128,128);">
		<div class="submenu">
                <a href="http://localhost/btl_Hai/drink_mng.php" class="a1"> <img src="images/home.png"></img> Quản lý đồ uống</a>
                <a href="http://localhost/btl_Hai/me_4admin_ttkh.php" class="a1"> Thông tin khách hàng</a>
                <a href="http://localhost/btl_Hai/seat_manager.php" class="a1">Cửa hàng offline</a>
                <a href="http://localhost/btl_Hai/event_manager.php" class="a1">Event khuyến mại</a>
                <a href="http://localhost/btl_Hai/me_5adminTinNhan.php" class="a1">Phản hồi khách hàng</a>
                <a href="http://localhost/btl_Hai/drink_order.php" class="a1">Danh sách đặt hàng</a>
            </div>
</div>


    
        
    <?php   // quét lấy dữ liệu từ cơ sở dữ liệu
        $query="select * from comment_msg where d_name='znul' order by comment_id ASC";
        $result=pg_query($db,$query);
        if(!$result){
            echo"error query"; exit();
        }
        $arr=pg_fetch_all($result);
        $soLuong=count($arr);
        
        $n=1; // so luong user nhan tin, theo thu tu user[0] là mới nhắn nhất
        $user[0]=$arr[$soLuong-1]["acc_name"];
        for($i=$soLuong-2; $i >= 0; $i--){
            $test=0;
            for($j=$soLuong-1; $j>$i; $j--){
                if($arr[$j]["acc_name"]==$arr[$i]["acc_name"]){
                    $test=1; break;  
                }
            }
            if($test==0){
                $user[$n]=$arr[$i]["acc_name"];
                $n++;
            }
        }
        // set session cho 1 nguoi tro chuyen
        if(!isset($_SESSION["chon"]))
            $_SESSION["chon"]=$user[0];
        
    ?>
    <div class="main">
        <div class="head">
            Tin nhắn
        </div>
        <form name="form_xem" method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">
            <div style="background-color: white; margin-top: 10px;">
                
                
            </div>
            <table class="left">  <!-- danh sach nguoi dung -->
                <?php
                for($i=0; $i < $n; $i++){
                ?>
                    <tr>
                        <td width="10px">
                            <button class="button1" name="chon" value="<?php echo$user[$i]; ?>">Xem</button>
                        </td>
                        <td>
                            <span style="color: red;"><?php echo$user[$i]; ?></span>
                        </td>
                    </tr>
                    
                
                <?php
                }
                ?>
            </table>
        </form>
        
        
        
            <div class="right">
            <table width="580px" border="0" cellpadding="0px" cellspacing="0px">
            <?php 
                if(isset($_SESSION["chon"])){
                    
                    for($i=0; $i<$soLuong; $i++){
                        if($arr[$i]["acc_name"]==$_SESSION["chon"]){
                            ?>
                            <tr height="20px">
                                <td width="100px">
                                    <span style="color: red;"><?php echo$arr[$i]["acc_name"];?> : </span>
                                </td>
                                <td>
                                    <?php echo$arr[$i]["cmt_content"];?>
                                </td>
                            </tr>
                            <?php
                                if($arr[$i]["seen"]=='t'){
                            ?>
                            <tr height="20px" bgcolor="#79bdea">
                                <td width="70px">
                                    <span style="color: blue;">Admin : </span>
                                </td>
                                <td>
                                    <?php echo$arr[$i]["reply"]; ?>
                                </td>
                            </tr>
                            <?php
                                }
                            ?>
                            <?php
                        }
                    }
                }
            ?>
            </table>
            </div>
        <form name="form_chat" method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">
            <div class="chat_text">
                <input type="text" name="text_chat" size="40" placeholder="Viết tin nhắn" align="right"
                style="border-radius: 3%;"></<br>
                <input  type="submit" name="chatSub" value="Send">
            </div>
        </form>
        
    </div>
    <hr style="margin-top: 100px;">
	<p bgcolor="#fffff" align="center">
			<b>
			    Thời gian mở cửa: 8h - 22h (tất cả các ngày trong tuần)<br>
			    Địa chỉ: 17 Tạ Quang Bửu<br>
			    Liên hệ: 0969.696.969<br>
			</b>
	</p>





</body>    
</html>
