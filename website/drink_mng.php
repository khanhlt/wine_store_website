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

		echo "<form action='drink_add.php'><button class='button' style='float:right'>Thêm sản phẩm</button></form>";
		echo "<div class='info'>";
   //echo "<section>";
   //echo "<font size='6' color='blue'><br>----------WINE----------</font><br><br>";

		$name="admin";
		$query = "SELECT * FROM drink WHERE category='Rượu'";
		$result = pg_query($query);
		if(!$result) {
			echo "Problem with query". $query . "<br>";
			echo pg_last_error();
			exit();
		}

		echo "<form method='GET'>";
		while($row = pg_fetch_row($result)) {
			echo "<div id='box'>";
			echo "<img name = 'change' src='drinks/$row[7].jpg' style='width:100px;height:100px'>";
			echo "<div id='box1'>";
			echo "<p><strong>Rượu $row[0]</strong></p>";
			echo "Giá: "."$row[1]".".000 vnđ"."<br>";
			echo "Xuất xứ: "."$row[2]"."<br>";
			echo "$row[3]<br>";
			echo "Còn hàng: "."$row[4]"."<br><br>";
			echo "</div>";
			echo "<br><br><br><br><br><br>";   
			echo "<button class='button1' name='change[]' value='$row[7]'>Thay đổi</button>"."   ";
			echo "<button class='button1' name='del[]' value='$row[0]'>Xóa</button>"."<br><br>";
			echo "</div>";
		}
		echo "<br>";
   //echo "</section>";

		$query1 = "SELECT * FROM drink WHERE category='Bia'";
		$result1 = pg_query($query1);
		if(!$result1) {
			echo "Problem with query". $query1 . "<br>";
			echo pg_last_error();
			exit();
		}

   //echo "<section>";
   //echo "<br><font size='6' color='blue'><br>----------BEER----------</font>";

		while($row1 = pg_fetch_row($result1)) {
			echo "<div id='box'>";
			echo "<img src='drinks/$row1[7].jpg' style='width:100px;height:100px'>";
			echo "<div id='box1'>";
			echo "<p><strong>Bia $row1[0]</strong></p>";
			echo "Giá: "."$row1[1]".".000 vnđ"."<br>";
			echo "Xuất xứ: "."$row1[2]"."<br>";
			echo "$row1[3]<br>";
			echo "Còn hàng: "."$row1[4]<br><br>";
			echo "</div>";
			echo "<br><br><br><br><br><br>";   
			echo "<button class='button1' name='change[]' value='$row1[7]'>Thay đổi</button>"."   ";
			echo "<button class='button1' name='del[]' value='$row1[0]'>Xóa</button>";
			echo "</div>";
		}
 //echo "</section>";

		$query2 = "SELECT * FROM drink WHERE category='Cocktail'";
		$result2 = pg_query($query2);
		if(!$result2) {
			echo "Problem with query". $query2 . "<br>";
			echo pg_last_error();
			exit();
		}

   //echo "<br><font size='6' color='blue'><br>----------COCKTAIL----------</font>";

		while($row2 = pg_fetch_row($result2)) {
			echo "<div id='box'>";
			echo "<img src='drinks/$row2[7].jpg' style='width:100px;height:100px'>";
			echo "<div id='box1'>";
			echo "<p><strong>Cocktail $row2[0]</strong></p>";
			echo "Giá: "."$row2[1]".".000 vnđ"."<br>";
			echo "Xuất xứ: "."$row2[2]"."<br>";
			echo "$row2[3]<br>";
			echo "Còn hàng: "."$row2[4]<br><br>";
			echo "</div>";
			echo "<br><br><br><br><br><br>";
			echo "<button class='button1' name='change[]' value='$row2[7]'>Thay đổi</button>"."   ";
			echo "<button class='button1' name='del[]' value='$row2[0]'>Xóa</button>";
			echo "</div>";
		}
		$query3 = "SELECT * FROM drink WHERE category='Nước Detox'";
		$result3 = pg_query($query3);
		if(!$result3) {
			echo "Problem with query". $query3 . "<br>";
			echo pg_last_error();
			exit();
		}
   //echo "<br><font size='6' color='blue'><br>----------DETOX----------</font>";
		while($row3 = pg_fetch_row($result3)) {
			echo "<div id='box'>";
			echo "<img src='drinks/$row3[7].jpg' style='width:100px;height:100px'>";
			echo "<div id='box1'";
			echo "<p><strong>$row3[0]</strong></p>";
			echo "Giá: "."$row3[1]".".000 vnđ"."<br>";
			echo "Xuất xứ: "."$row3[2]"."<br>";
			echo "$row3[3]<br>";
			echo "Còn hàng: "."$row3[4]<br><br>";
			echo "</div>";
			echo "<br><br><br><br><br><br>";
			echo "<button class='button1' name='change[]' value='$row3[7]'>Thay đổi</button>"." ";
			echo "<button class='button1' name='del[]' value='$row3[0]'>Xóa</button>";
			echo "</div>";
		}
		echo "</form>";
		if(isset($_GET['change'])) 
		{
			foreach($_GET['change'] as $key=>$value) 
			{
				header("location: http://localhost/btl_Hai/drink_edit.php");
				$_SESSION[image] = $value;
			}
		}
		if(isset($_GET['del'])) 
		{
			foreach($_GET['del'] as $key=>$value)
			{
				header("location: http://localhost/btl_Hai/drink_mng.php");
				$qr = pg_query("DELETE FROM drink WHERE d_name='".$value."'");
				if(!$qr) 
				{
					echo pg_last_error();
				}
			}
		}
		echo "</div>";

		?>
	</body>    
	</html>
