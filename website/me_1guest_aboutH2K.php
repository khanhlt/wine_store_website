<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>About H2K</title>
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

<a href="\" style="color: white;"><img src="images/face.png"></img>your name</a>
                
                
                

</style>

</head>
<body bgcolor="white" style="font-size: 20px;">

<div class="header">
		<div class="searchDiv">
			<form method="post" action="search.php">
				<input class="search1" type="text" name="search11" placeholder="Tìm Kiếm" >
                <input type="submit" value="search" name ="p_search">
			</form>
		</div>
		<div class="login">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            
                <?php
                    session_start();
                    echo "<a style=\"color: white;\"><img src=\"images/face.png\"></img>".$_SESSION["name"]."</a>";
                    //$db = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=Milubamhanc");
                    include('me_config.php');
                    ////// order successfull
                    
if (isset($_POST['xnorder']))
            {
                
                $query="select max(order_id) from order_product;";
                $result = pg_query($db,$query); 
                $row = pg_fetch_assoc($result); 
                $id_detail =$row[max]+1;
                
                $total_cost=0;
                $total_star=0;

                $alsl= $_POST['sl'];
                $allna= $_POST['na'];
                $allcos=$_POST['cos'];
                $N = count($alsl);
                for($i=0; $i < $N; $i++)
                {
                    
                    $total_cost+=$allcos[$i] * $alsl[$i];
                    $total_star+=$alsl[$i];
                    
                }
                $query= "insert into order_product values (".$id_detail.",'".$_SESSION["sacc_name"]."',".$total_cost.",'2011-1-1','12:20:00',false,'".$_POST['addre']."');";
                $result = pg_query($query); 

                $query="select max(detail_id) from order_detail;";
                $result = pg_query($query); 
                $row = pg_fetch_assoc($result); 
                $id_ =$row[max]+1;
                //$total_star=0;

                for($i=0; $i < $N; $i++)
                {
                    //$total_star= $total_star + $allna[$i];
                    $id3=$id_+$i;
                    
                    $query="insert into order_detail values (".$id3.",".$id_detail.",'".$allna[$i]."',".$alsl[$i].");";
                    $result = pg_query($query); 
                    $query="update drink set bought = bought +".$alsl[$i]." where d_name = '".$allna[$i]."';";
                    $result = pg_query($query); 

                }

                $query="update account_detail set star = star + ".$total_star." where acc_name = '".$_SESSION["sacc_name"]."';";
                $result = pg_query($query); 
                echo "<script type='text/javascript'>alert('Đã gửi đơn đặt hàng');</script>"; 
                //header("location: http://localhost/btl_Hai/home_guest.php");
               
            }

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

                        //$db = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=Milubamhanc");
                        include('me_config.php');
                        $query ="select * from comment_msg where acc_name = '".$_SESSION["sacc_name"]."'order by comment_id desc ;";
                        $result = pg_query($query);  
                        $row = pg_fetch_assoc($result);
                        $id_msg=$row[comment_id];
                        //$ct_msg=$row[cmt_content];
                        if($row[seen]=='f') 
                        {
                            $newsms=$row[cmt_content]."<br/>".$_POST['sms_msgn'];
                            $query = "update comment_msg set cmt_content = '".$newsms."' where comment_id = ".$id_msg.";";
                            $result = pg_query($query); 
                        }
                        else 
                        {   
                            $result2=pg_query($db, "select max(comment_id) from comment_msg");
                            $row2=pg_fetch_array($result2);
                            $id_msg=$row2[0]+1;
                            $newsms=$_POST['sms_msgn'];
                        
                            $query2 = "insert into comment_msg values (".$id_msg.",'".$_SESSION["sacc_name"]."','znul','".$newsms."',false,NULL,true);";
                            $result = pg_query($query2); 
                        }
                        echo "<script type='text/javascript'>alert('gui thanh cong');</script>"; 

                    }
                ?>
                <div id="myDIV">
                <a href="http://localhost/btl_Hai/private_info.php" class="a2">
                <img src="images/register.png">  Thông tin cá nhân</a>
                <a href="http://localhost/btl_Hai/me_1guest_aboutH2K.php" class="a2">  
                <img src="images/store.png">about H2Kshop</a>
                <a href="http://localhost/btl_Hai/me_3guest_datChoNgoi.php" class="a2">  
                <img src="images/seat.png">Đặt chỗ</a>
                <a href="http://localhost/btl_Hai/purchase_history.php" class="a2">  
                <img src="images/shopping.png">Lịch sử mua hàng</a>
                <a href="http://localhost/btl_Hai/home_stranger2.php" class="a2">  
                <img src="images/out.png">
                Đăng xuất</a>
                </div>

                <div id="smsDIV">
                <form method="post" >
                    <input class="search_msg" type="text" id="sms_msg" placeholder="Viết tin nhắn" name="sms_msgn">
                    <input type="submit" value="send"  name="sms">
                    <div class ="msgTa" id="msgTa" style="background-color: white;" >
                        <?php
                        //$db = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=Milubamhanc");
                        $query ="select cmt_content from comment_msg where acc_name = '".$_SESSION["sacc_name"]."'order by comment_id desc ;";
                        $result = pg_query($query);  
                        $row = pg_fetch_assoc($result);
                        $ct_msg="<br/>".$row["cmt_content"];
                        echo$ct_msg;
                        ?>
                    </div>
                </form>
                
                </div>
                <div id="phDIV">
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    
                    <center><font color="white" size="4px">Phản hồi của cửa hàng</font></center>
                    <div class ="msgTa" id="msgTaph" style="background-color: white;">
                     <?php
                        //$db = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=Milubamhanc");
                        $query ="select reply,comment_id from comment_msg where acc_name = '".$_SESSION["sacc_name"]."' and d_name = 'znul' order by comment_id desc ;";
                        $result = pg_query($query);  
                        $row = pg_fetch_assoc($result);
                        if($row!=NULL){
                            $id2=$row[comment_id];
                            $ct_msg="<br/>".$row[reply];
                            echo $ct_msg;
                            $query ="update comment_msg set seen2 = 'true' where acc_name ='".$_SESSION["sacc_name"]."' ;";
                            $result = pg_query($query); 
                        }                            
                        ?>   
                    </div>
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

<!-- BẮt đầu code mình -->

	<table align="center" cellspacing="10" border="0" width="100%" bgcolor="#bdc9c1" >
		<tr>

			<td><h1 align="center">GIỚI THIỆU</h1></td>
		</tr>
		<tr>
			<td>
			<table cellspacing="10">
				<tr>
					<td width="50%">
					<table border="1" width="100%" height="300" >
					    <tr height="50" >
					        <td >   
					            <b style="font-size: 20px">Chi tiết cửa hàng</b>
					        </td>
					    </tr>
					    <tr>
					    	<td style="margin-top: 10px;">
					    	    <p>Cửa hàng đồ uống H2K</p>
					            <p>Đây là cửa hàng ảo, được thiết kế bởi nhóm 3 sinh viên HEDSPI K59 BKHN theo yêu cầu bài tập lớn môn thực hành CSDL. Mọi thông tin về cửa hàng đều là giả. Xin cảm ơn ! ^^</p>
					        </td>
					    </tr>
					</table>
					</td>

					<td>
					<table border="1" width="100%" height="300" >
						<tr height="50">
						<td><b style="font-size: 20px">Bản đồ</b></td>
						</tr>
						<tr>
							<td>
							<a href="hien/me_maps.html">
								<img src="./hien/me_citeaFunPic.png" alt="ban_do" width="100%" height="230"/>
							</a>
							</td>
						</tr>
					</table>
					</td>
				</tr>
			</table>
			</td>
		</tr>
		<tr height="20" >
			<td style="padding-bottom: 0px;"><h3 align="center">Nhóm phát triển web</h3></td>
		</tr>
		<tr>
			<td>
				<table border="0" width="100%" cellspacing="20" >
					<tr>
						<td align="center" bgcolor="#ffffff">
							<img src="./hien/me_KhanhPic.jpg" alt="Le Khanh" width="70" height="70"/><br>
							<b><i>Lê Thị Khanh</i></b><br>
							Việt Nhật A K59<br>
							nickname: <i>Khanh sama</i><br>
						</td>
						<td align="center" bgcolor="#ffffff">
							<img src="hien/me_HaiPic.jpg" alt="Dang Hai" width="70" height="70"/><br>
							<b><i>Nguyễn Đăng Hải</i></b><br>
							Việt Nhật B K59<br>
							nickname: <i>Hải zớ</i><br>
						</td>
						<td align="center" bgcolor="#ffffff">
							<img src="hien/me_HienPic.jpg" alt="Hien Pham" width="70" height="70"/><br>
							<b><i>Phạm Đức Hiển</i></b><br>
							Việt Nhật B K59<br>
							nickname: <i>Hiển phế</i><br>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr><td><hr></td></tr>
		<tr>
			<td align="center">
			<b>
			    Thời gian mở cửa: 8h - 22h (tất cả các ngày trong tuần)<br>
			    Địa chỉ: 177 Tạ Quang Bửu<br>
			    Liên hệ: 0969.696.969<br>
			</b>
			</td>
		</tr>
	</table>

