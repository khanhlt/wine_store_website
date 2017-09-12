<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>CUA HANG DO UONG H2KSHOP</title>
    <link rel="stylesheet" type="text/css" href="preview.css"/>
    <link rel="stylesheet" type="text/css" href="seat_css.css"/>
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
<div class="panel">
	
 	<div class="container">
        <div class="wt-rotator">
            <a href="#"></a>            
            <div class="desc"></div>
            <div class="preloader"></div>
            <div class="c-panel">
                <div class="buttons">
                    <div class="prev-btn"></div>
                    <div class="play-btn"></div>    
                    <div class="next-btn"></div>               
                </div>
                <div class="thumbnails">
                    <ul>
                        <li>
                            <a href="images/madness_arch2.jpg" title="nhatnghe.com"></a>
                            <!--<a href="http://" target="_blank"></a> -->
                                                  
                        </li>
                        <li>
                            <a href="images/triworks_abstract17.jpg" title="chua dat ten"></a>                    
                        </li>
                        <li>
                            <a href="images/krazy-kartoons-robot-dj02.jpg" title="chua dat ten"></a>                                                        
                        </li>
                        <li>
                            <a href="images/sf.jpg" title="nhatnghe.com"></a>                                                                           	
                        </li>
                        <li>
                            <a href="images/triworks_abstract26.jpg" title="chua dat ten"></a>                                                                                       	                   
                        </li>
                        <li>
                            <a href="images/tokyo.jpg" title="nhatnghe.com"></a>                                                                       	                          
                        </li>
                        <li>
                            <a href="images/scottwills_building2.jpg" title="chua dat ten"></a>                                                                                                  
                        </li>     
                        <li>
                            <a href="images/highway.jpg" title="nhatnghe.com"></a>                    
                            <div style="left:495px; top:34px; width:306px;">                                                              	                           
                        </li>     
                    </ul>
                </div>     
            </div>
        </div>	
  </div>
    </div>

<div class="content">

<div class="s_left">
<div class="s_title">
	<center><font color="white"><br>Vị trí còn trống	</font></center>
	<br>
	
	<form method="post" action="seat_manager.php">
		Thay đổi trạng thái - 
        <input type="submit" value="Xác nhận"  name="s_subm"><br>
        <?php
        	include('me_config.php');
            //$db = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=Milubamhanc");
        	if (isset($_POST['s_subm']))
            {
            	//$query ="update seat set is_free = FALSE, acc_name = NULL where s_name = '".."';";
            	if(!empty($_POST['check_list'])) {
    				foreach($_POST['check_list'] as $check) {
            			
            			$query ="update seat set is_free = FALSE, acc_name = NULL where s_name = '".$check."';";
            			$result = pg_query($query); 
    				}
				}
            }
            
            //$db = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=Milubamhanc");
            $query = "select * from seat where is_free = 'TRUE';";  
            $result = pg_query($query);  
            for($kk=0;$kk<20;$kk++)
            {
                $row = pg_fetch_assoc($result);
                if($row==NULL) break;
                echo "<br><input type=\"checkbox\" name=\"check_list[]\" value=\"".$row[s_name]."\">Vị trí: ".$row[s_name]."
                      <br>";
            }
            
    	?>

    </form>
</div>
	
</div>

<div class="s_right">
<div class="s_title">
	<center><font color="white"><br>Vị trí đã ngồi	</font></center>
	<br>
	
	<form method="post" action="seat_manager.php">
		Thay đổi trạng thái - 
        <input type="submit" value="Xác nhận"  name="s_subm2"><br>
        <?php
        	//$db = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=Milubamhanc");
        	if (isset($_POST['s_subm2']))
            {
            	//$query ="update seat set is_free = FALSE, acc_name = NULL where s_name = '".."';";
            	if(!empty($_POST['check_list2'])) {
    				foreach($_POST['check_list2'] as $check) {
            			
            			$query ="update seat set is_free = TRUE, acc_name = NULL where s_name = '".$check."'";
            			$result = pg_query($query); 
    				}
				}
            }
            
            //$db = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=Milubamhanc");
            $query = "select * from seat where is_free = 'FALSE';";  
            $result = pg_query($query);  
            for($kk=0;$kk<20;$kk++)
            {
                $row = pg_fetch_assoc($result);
                if($row==NULL) break;
                echo "<br><input type=\"checkbox\" name=\"check_list2[]\" value=\"".$row[s_name]."\">Vị trí: ".$row[s_name]." - ID khách : ".$row[acc_name]."
                      <br>";
            }
            
    	?>

    </form>
</div>
</div>
    
</div>
</body>    
</html>
