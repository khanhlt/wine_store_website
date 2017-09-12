<?php  
session_start();
ob_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>CUA HANG DO UONG H2KSHOP</title>
	<link rel="stylesheet" type="text/css" href="preview.css"/>
	<link rel="stylesheet" type="text/css" href="h2kshop_k2.css"/>
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
				$query ="update order_product set seen='t'";
				$result = pg_query($query);  
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
		<style>
			table,th,td {
				border: 1px solid black;
				border-collapse: collapse;
			}
			th,td {
				padding: 15px;
			}
			th {
				text-align: left;
			}
			table {
				background-color: #f1f1c1;
				margin-left: auto;
				margin-right: auto;
			}
		</style>
		<div class="info">
			<?php
			include('me_config.php');

			$name="admin";
			$query = "SELECT * FROM order_product ORDER BY order_id desc";
			$result = pg_query($query);
			if(!$result) {
				echo "Problem with query". $query . "<br>";
				echo pg_last_error();
				exit();
			}
			echo "<form method='post'>";
			echo "<table style = 'width:90%'>";
			echo "<caption><h2 align='center'>Danh sách đặt hàng</h2><br></caption>";
			echo "<tr><th>Tên tài khoản</th><th>Sản phẩm</th><th>Tổng tiền</th><th>Ngày mua</th><th>Giờ mua</th><th>Shiped</th></tr>";
			while($row = pg_fetch_assoc($result)) {
				$query2 = "SELECT * from order_detail where order_id=$row[order_id]";
				echo "<tr>";
				echo "<td>$row[acc_name]</td>";
				$rs2 = pg_query($query2);
				echo "<td>";
				while($row1 = pg_fetch_assoc($rs2)) {
					echo $row1[d_name]." (".$row1[quantity].")"."<br>";	
				}
				echo "</td>";
				echo "<td>$row[total_cost]</td><td>$row[o_date]</td><td>$row[o_time]</td>";     
				if($row[shiped] == 't') {
					echo "<td><div class='checkbox checked'></div></td>";
				}
				else {
					echo "<td><input type='checkbox' name='check[]' value=$row[order_id]></td>";
				}
				echo "</tr>";
			}
			echo "</table><br>";
			echo "<center><button type='submit' name='done'>Xong</button></center>";
			echo "</form>";

			if(isset($_POST['done'])) 
			{
				header("location: http://localhost/btl_Hai/drink_order.php");
				if(!empty($_POST['check'])) 
				{
					foreach($_POST['check'] as $value) 
					{
						$qr = pg_query("UPDATE order_product SET shiped='t' WHERE order_id=$value");
					}
				}
			}
			?>
		</div>