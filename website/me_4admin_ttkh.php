<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Thông tin khách hàng</title>
    <link rel="stylesheet" type="text/css" href="preview.css"/>
    <link rel="stylesheet" type="text/css" href="h2kshop.css"/>
	<link rel="stylesheet" type="text/css" href="wt-rotator.css"/>
	<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
    <script type="text/javascript" src="js/jquery.wt-rotator.min.js"></script>
	<script type="text/javascript" src="js/preview.js"></script>    
</head>
<body bgcolor="white">
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


<script type="text/javascript">

    function checkAll(ele){
        var checkboxes = document.getElementsByTagName('input');
        for(var i=0; i<checkboxes.length; i++){
            if(checkboxes[i].type =='checkbox')
                checkboxes[i].checked=ele.checked;
        }
    }
    function confirmation(){
        return confirm("Dữ liệu người dùng sẽ bị xoá! Bạn có muốn tiếp tục?");
    }
</script>
   
<?php
    include('me_config.php');
    if(isset($_POST['check'])){
        //print_r($_POST['check']);
        foreach($_POST['check'] as $value){
            $result=pg_query($db,"DELETE FROM account_detail WHERE acc_name='".$value."'");
            if(!$result) echo"error delete";
            //else echo"delete success";
        }
    }
?>
   
<?php  
	$result=pg_query($db,"select * from account_detail order by(full_name)");
	$arr=pg_fetch_all($result);
	$soLuong=count($arr);
?>    
    <h2 align="center"> THÔNG TIN KHÁCH HÀNG</h2>
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" onsubmit="return confirmation()" >
      
    <table align="center" width="70%" border=1>
        <tr height="50" align="center" bgcolor="#A2D680">
            <!-- checkbox all-->
            <td width="50">
                <input type="submit" name="submit" value="Xoá"  /><br>
                <input type="checkbox" name="all" onclick="checkAll(this)" />
            </td>
            <td><b>Họ và tên</b></td>
            <td width="150"><b>Tên đăng nhập</b></td> 
			<td width="150"><b>Mật khẩu</b></td>
            <td width="150"><b>Địa chỉ</b></td>
            <td width="100"><b>Số điện thoại</b></td>
            <td width="100"><b>Điểm tích luỹ</b></td>          
        </tr>
    <?php
    for($id=0; $id<$soLuong; $id++){
    ?>
		<tr align="center" bgcolor="#A1C4DC">
            <td><input type="checkbox" name="check[]" value="<?php echo($arr[$id]["acc_name"]); ?>" />
            <td><?php echo($arr[$id]["full_name"]); ?></td>
            <td><?php echo($arr[$id]["acc_name"]);?></td>
            <td><?php echo($arr[$id]["acc_password"]);?></td>
            <td><?php echo($arr[$id]["address"]); ?></td>
            <td><?php echo($arr[$id]["phone_number"]); ?></td>
            <td><?php echo($arr[$id]["star"]); ?></td>
        </tr>
	<?php 
    }
    ?>
    </table>
    </form>
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
