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
				$query ="select seen from comment_msg where seen = 'false' and d_name != 'znul' ;";
				$result = pg_query($query);  
				$row = pg_fetch_assoc($result);
				if($row!=NULL)
					echo "<a href='see_drink_cmt.php'> <img src=\"images/commentnew.jpg\"></a>";
				else 
					echo "<a href='see_drink_cmt.php'> <img src=\"images/order.png\"></a>";
                    //// new order
				$query ="select seen from order_product where seen = 'false' ;";
				$result = pg_query($query);  
				$row = pg_fetch_assoc($result);
				if($row!=NULL)
					echo "<a href='drink_order.php'> <img src=\"images/ordernew.jpg\"></a>";
				else 
					echo "<a href='drink_order.php'> <img src=\"images/shopping.png\"></a>";

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
		
		if(isset($_GET['change'])) {
			foreach ($_GET['change'] as $key => $value) { 
				$_SESSION[image]=$value;
			}
		}
		$query = "SELECT * FROM drink WHERE image='$_SESSION[image]'";
		$result = pg_query($query);
		if(!$result) {
			echo "Problem with query.".$query."<br>";
			echo pg_last_error();
			exit();
		}
		while($row = pg_fetch_row($result)) 
		{

			echo "<div id='left'><img src='drinks/$row[7].jpg' style='width:200px;height:200px'><br><br><button class='button1' name='change'>Change</button></div>";
			echo "<div id='right'>";
			echo "<form class='form' method='get'>";
			echo "Tên đồ uống: <br>";
			echo "<input type = 'text' name='d_name' placeholder='$row[0]' required autofocus>"."<br><br>";
			echo "Giá: <br>";
			echo "<input type = 'text' name='d_cost' placeholder='$row[1]' required autofocus>"."<br><br>";
			echo "Xuất xứ: <br>";
			echo "<input type = 'text' name='producer' placeholder='$row[2]' required autofocus>"."<br><br>";
			echo "Chủng loại: <br>";
			echo "<input type = 'text' name='category' placeholder='$row[6]' required autofocus><br><br>";
			echo "Mô tả: <br>";
			echo "<textarea name='describe' rows = 5 cols = 40 placeholder='$row[3]'></textarea><br><br>";
			echo "<button class = 'button1' name = 'save' >Save </button>";
			echo "</form>";
			if(isset($_GET['save'])) 
			{
				header("location: http://localhost/btl_Hai/drink_edit.php");
				$d_name = $_GET['d_name'];
				$d_cost = $_GET['d_cost'];
				$producer = $_GET['producer'];
				$describe = $_GET['describe'];
				$category = $_GET['category'];

				$qr = pg_query("update drink set d_name='$d_name', d_cost='$d_cost', producer='$producer', describe='$describe', category='$category' where image='$_SESSION[image]'");
			}
			echo "</div>";
		}	

		?>
	</div>
</body>
</html>
