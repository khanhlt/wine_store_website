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
	}

</style>
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
				$query ="update comment_msg set seen='t'";
				$result = pg_query($query); 

				$query ="select seen from comment_msg where seen = 'false' and d_name != 'znul' ;";
				$result = pg_query($query);  
				$row = pg_fetch_assoc($result);
				if($row!=NULL)
					echo "<a href=\"http://localhost/btl_Hai/see_drink_cmt.php\"> <img src=\"images/commentnew.jpg\"></a>";
				else 
					echo "<a href=\"http://localhost/btl_Hai/see_drink_cmt.php\"> <img src=\"images/order.png\"></a>";
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

		<?php
		include('me_config.php');
		if(isset($_GET['change'])) 
		{
			foreach($_GET['change'] as $key=>$value) 
			{

				$_SESSION["d_detail1"] = $value;
				if(!$seen) 
				{
					pg_last_error();
				}
			}
		}
		$acc_name="admin";
		$dname=$_SESSION["d_detail1"];
		$query = "SELECT * FROM drink WHERE d_name='$dname'";
		$id = pg_query("SELECT max(comment_id) FROM comment_msg");
		$row1=pg_fetch_row($id);
		$result = pg_query($query);
		if(!$result) {
			echo "Problem with query". $query . "<br>";
			echo pg_last_error();
			exit();
		}
		$row = pg_fetch_assoc($result);
		echo "<div id='left1'>";
		echo "<table style='width:80%'>";
		echo "<caption><img src='drinks/$row[image].jpg' style='width:150px;height:150px'><h2>$dname</h2><br><br></caption>";
		echo "<tr>";
		echo "<th>Giá(vnđ)</th>";
		echo "<td>$row[d_cost]</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<th>Mô tả</th>";
		echo "<td>$row[describe]</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<th>Xuất xứ</th>";
		echo "<td>$row[producer]</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<th>Số lượng còn</th>";
		echo "<td>$row[quantity_remaining]</td>";
		echo "</tr>";
		echo "</table>";

		echo "<br><br><form class='form' method='POST'>";
		echo "Phản hồi của của cửa hàng: ";
		echo "<textarea name='cmt_content' rows = 5 cols = 40></textarea><br><br>";
		echo "<button class = 'btn-primary' type='submit' name='react'>Phản hồi</button>";
		echo "</form>";

		if(isset($_POST['react'])) {
			$cmt_content = $_POST['cmt_content'];
			$x = $row1[0]+1;
			$qr = pg_query("insert into comment_msg values ('$x','$acc_name','$dname','$cmt_content',FALSE,NULL,FALSE)");
			echo "<br>Đã lưu phản hồi.<br>";
		}
		echo "</div>";
		echo "<div id='right1' align='center'>";
		$query2 = "SELECT * FROM comment_msg NATURAL JOIN account_detail WHERE d_name='$dname' ORDER BY comment_id ASC";
		$rs2 = pg_query($query2);
		echo "<br><center><strong>Bình luận về sản phẩm: </strong></center>"."<br><br>";
		while($row2=pg_fetch_assoc($rs2)) {
			echo "<strong>$row2[full_name]: ";
			echo "$row2[cmt_content]"."<br><br>";
			echo "<hr>";
		}
		echo "</div>";

		?>
	</body>
	</html>