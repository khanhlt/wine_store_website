<?php 
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>CUA HANG DO UONG H2KSHOP</title>
	<link rel="stylesheet" type="text/css" href="preview.css"/>
	<link rel="stylesheet" type="text/css" href="h2kshop_guest_k2.css"/>
	<link rel="stylesheet" type="text/css" href="h2kshop.css"/>
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

</head>
<body bgcolor="white">

	<div class="header">
		<div class="searchDiv">
			<form>
				<input class="search1" type="text" name="search" placeholder="Tìm Kiếm">
				<input type="submit" value="search">
			</form>
		</div>
		<div class="login">
			<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

				<?php
                include('me_config.php');
                    session_start();
                    echo "<a style=\"color: white;\"><img src=\"images/face.png\"></img>".$_SESSION["name"]."</a>";
                    
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
				<div id="myDIV">
					<a href="private_info.php" class="a2">
						<img src="images/register.png">  Thông tin cá nhân</a>
						<a href="file:///D:/btl_csdl/btl2/home_admin.html" class="a2">  
							<img src="images/store.png">about H2Kshop</a>
							<a href="file:///D:/btl_csdl/btl2/home_admin.html" class="a2">  
								<img src="images/seat.png">Đặt chỗ</a>
								<a href="file:///D:/btl_csdl/btl2/home_admin.html" class="a2">  
									<img src="images/shopping.png">Lịch sử mua hàng </a>
									<a href="file:///D:/btl_csdl/btl2/home_admin.html" class="a2">  
										<img src="images/out.png">  
										Đăng xuất </a>  
									</div>
									<div id="smsDIV">
										<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
											<input class="search_msg" type="text" id="sms_msg" placeholder="Viết tin nhắn">
											<input type="submit" value="send" onclick="send()">
											<textarea class ="msgTa" id="msgTa" ></textarea>
										</form>
									</div>
									<div id="phDIV">
										<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

											<center><font color="white" size="4px">Phản hồi của cửa hàng</font></center>
											<textarea class ="msgTa" id="msgTaph" ></textarea>
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
								<a href="home_guest.php" class="a1"> <img src="images/home.png"></> Home</a>
								<a href="http://localhost/btl_Hai/wine.php" class="a1"> Wine</a>
								<a href="http://localhost/btl_Hai/beer.php"" class="a1">Beer</a>
								<a href="http://localhost/btl_Hai/cocktail.php" class="a1">Cocktail</a>
								<a href="http://localhost/btl_Hai/detox.php" class="a1">Detox</a>
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
								<?php
								include('me_config.php');

								$acc_name=$_SESSION["sacc_name"];
								$dname=$_SESSION["d_detail"];
								$query = "SELECT * FROM drink WHERE d_name='$dname'";
								$id = pg_query("SELECT max(comment_id) FROM comment_msg");
								$row1=pg_fetch_row($id);
								$result = pg_query($query);
								if(!$result) {
									echo "Problem with query". $query . "<br>";
									echo pg_last_error();
									exit();
								}
								$row = pg_fetch_array($result); 

								echo "<div id='left'>";
								echo "<table style='width:80%'>";
								echo "<caption><img src='drinks/$row[7].jpg' style='width:150px;height:150px'><h2>$dname</h2><br><br></caption>";
								echo "<tr>";
								echo "<th>Giá(vnđ)</th>";
								echo "<td>$row[1]</td>";
								echo "</tr>";
								echo "<tr>";
								echo "<th>Mô tả</th>";
								echo "<td>$row[3]</td>";
								echo "</tr>";
								echo "<tr>";
								echo "<th>Xuất xứ</th>";
								echo "<td>$row[2]</td>";
								echo "</tr>";
								echo "<tr>";
								echo "<th>Số lượng còn</th>";
								echo "<td>$row[4]</td>";
								echo "</tr>";
								echo "</table>";

								echo "<br><br><form class='form' method='POST' action='drink_detail.php'>";
								echo "Đánh giá của bạn: ";
								echo "<textarea name='cmt_content' rows = 5 cols = 40></textarea><br><br>";
								echo "<button class = 'btn-primary' type='submit' name='react'>Phản hồi</button>";
								echo "</form>";

								if(isset($_POST['react'])) {
									$cmt_content = $_POST['cmt_content'];
                                    $x = $row1[0]+1;
									$qr = pg_query("insert into comment_msg values ('$x','$acc_name','$dname','$cmt_content',FALSE,NULL,FALSE)");
									echo "<br>Phản hồi của bạn đã được lưu lại. Cảm ơn bạn đã ghé thăm :D<br>";
								}
								echo "</div>";
								echo "<div id='right' align='center'>";
								$query2 = "SELECT * FROM comment_msg NATURAL JOIN account_detail WHERE d_name='$dname' ORDER BY comment_id ASC";
                                $rs2 = pg_query($query2);
								echo "<br><center><strong>Bình luận của khách hàng về sản phẩm: </strong></center>"."<br><br>";
								while($row2=pg_fetch_assoc($rs2)) {
									echo "<strong>$row2[full_name]: ";
									echo "$row2[cmt_content]"."<br><br>";
									echo "<hr><br>";
								}
								echo "</div>";
                               
								?>
							
							<?php //include('footer.html');?>
						</body>
						</html>