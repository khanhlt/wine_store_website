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

    $name="admin";
    $query = "select * from(SELECT DISTINCT ON(d_name) * FROM comment_msg NATURAL JOIN drink WHERE d_name!='znul') as bang2
order by(comment_id) desc";
    
    $result = pg_query($query);
    if(!$result) {
      echo "Problem with query". $query . "<br>";
      echo pg_last_error();
      exit();
    }

    echo "<form method='GET' action='drink_detail_admin.php'>";
    while($row = pg_fetch_assoc($result)) {
      echo "<div id='box'>";
      echo "<img name = 'change' src='drinks/$row[image].jpg' style='width:100px;height:100px'>";
      echo "<div id='box1'>";
      echo "<p><strong>$row[d_name]</strong></p>";
      echo "Giá: "."$row[d_cost]".".000 vnđ"."<br>";
      echo "Xuất xứ: "."$row[producer]"."<br>";
      echo "$row[describe]<br>";
      echo "Còn hàng: "."$row[quantity_remaining]"."<br><br>";
      echo "</div>";
      echo "<br><br><br><br><br><br>";   
      echo "<button class='button1' name='change[]' value='$row[d_name]'>Xem bình luận</button>";
      echo "</div>";
    }
    echo "</form>";
    if(isset($_GET['change'])) 
    {
      foreach($_GET['change'] as $key=>$value) 
      {

        $_SESSION["d_detail1"] = $value;
        $seen = pg_query("UPDATE comment_msg SET seen='t' WHERE comment_id='".$row['comment_id']."'");
        if(!$seen) 
        {
            pg_last_error();
        }
      }
    }

    ?>
  </body>    
  </html>
