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
		<link rel="stylesheet" type="text/css" href="h2kshop_guest_k.css"/>
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
                    $re=pg_query($db,"select full_name from account_detail where acc_name='".$_SESSION["sacc_name"]."'");
                    $new=pg_fetch_array($re);
                    $_SESSION["name"]=$new["full_name"];
                    echo "<a style=\"color: white;\"><img src=\"images/face.png\"></img>".$_SESSION["name"]."</a>";
                    include('me_config.php');
                    //$db = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=Milubamhanc");
                    ////// order successfull
                    if (isset($_POST['xnorder']))
            {
                
                $query="select max(order_id) from order_product;";
                $result = pg_query($query); 
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
                            $newsms=$row[cmt_content]."\n".$_POST['sms_msgn'];
                            $query = "update comment_msg set cmt_content = '".$newsms."' where comment_id = ".$id_msg.";";
                            $result = pg_query($query); 
                        }
                        else 
                        {
                            $id_msg+=1;
                            $newsms=$_POST['sms_msgn'];
                        
                            $query = "insert into comment_msg values (".$id_msg.",'".$_SESSION["sacc_name"]."','znul','".$newsms."',false,'chưa trả lời !',true);";
                            $result = pg_query($query); 
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
                    <textarea class ="msgTa" id="msgTa" >
                        <?php
                        //$db = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=Milubamhanc");
                        $query ="select cmt_content from comment_msg where acc_name = '".$_SESSION["sacc_name"]."'order by comment_id desc ;";
                        $result = pg_query($query);  
                        $row = pg_fetch_assoc($result);
                        $ct_msg="\n".$row[cmt_content];
                        echo $ct_msg;
                        ?>
                    </textarea>
                </form>
                
                </div>
                <div id="phDIV">
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    
                    <center><font color="white" size="4px">Phản hồi của cửa hàng</font></center>
                    <textarea class ="msgTa" id="msgTaph" >
                     <?php
                        //$db = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=Milubamhanc");
                        $query ="select reply,comment_id from comment_msg where acc_name = '".$_SESSION["sacc_name"]."' and d_name = 'znul' order by comment_id desc ;";
                        $result = pg_query($query);  
                        $row = pg_fetch_assoc($result);
                        $id2=$row[comment_id];
                        $ct_msg="\n".$row[reply];
                        echo $ct_msg;
                        $query ="update comment_msg set seen2 = 'true' where comment_id = ".$id2.";";
                        $result = pg_query($query);  
                        ?>   
                    </textarea>
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


								<div class="box">
								<center>
									<strong align="center">THÔNG TIN CỦA BẠN</strong><br>
									<?php
									include('me_config.php');

									$name=$_SESSION["sacc_name"];
									$query = "SELECT * FROM account_detail WHERE acc_name='$name'";
									$result = pg_query($query);
									$pass;
									if(!$result) {
										echo "Problem with query". $query . "<br/>";
										echo pg_last_error();
										exit();
									}
									
									while($myrow = pg_fetch_assoc($result)) {
										$pass = $myrow['acc_password'];

										echo "<br><br>"."Tên tài khoản: ".$myrow['acc_name']."<br><br>"."Tên đầy đủ: ".$myrow['full_name']."<br><br>"."Địa chỉ: ".$myrow['address']."<br><br>"."Số điện thoại: ".$myrow['phone_number']."<br><br>"."Star: ".$myrow['star']."<br><br>";
									}

									echo "<form method='post'>";
									echo "<button class = 'btn btn-lg btn-primary btn-block' type = 'submit' name = 'change'>Thay đổi</button>";
									echo "</form>";

									if(isset($_POST['change'])) {
										echo "<br><form class='form' method='get'>";

										echo "Tên đầy đủ: ";
										echo "<input type = 'text' name = 'full_name' placeholder = '' required autofocus>"."<br><br>";
										echo "Mật khẩu cũ: ";
										echo "<input type = 'password' name = 'acc_password_old' required autofocus>"."<br><br>";
										echo "Mật khẩu mới: ";
										echo "<input type = 'password' name = 'acc_password_new1' required autofocus>"."<br><br>";
										echo "Xác nhận lại: ";
										echo "<input type = 'password' name = 'acc_password_new2' required autofocus>"."<br><br>";
										echo "Địa chỉ: ";
										echo "<input type = 'text' name = 'address' placeholder = '' required autofocus>"."<br><br>";
										echo "Số điện thoại: ";
										echo "<input type = 'text' name = 'phone_number' placeholder = '' required autofocus>"."<br><br>";
										echo "<button class = 'btn btn-lg btn-primary btn-block' type = 'submit' name = 'save'>Lưu</button>";

										echo "</form>";}

										if(isset($_GET['save'])) {
											$full_name = $_GET['full_name'];
											$acc_password_old = $_GET['acc_password_old'];
											$acc_password_new1 = $_GET['acc_password_new1'];
											$acc_password_new2 = $_GET['acc_password_new2'];
											$address = $_GET['address'];
											$phone_number = $_GET['phone_number'];
											if($acc_password_old != $pass) {
												echo "Bạn nhập mật khẩu cũ chưa đúng! Xin mời nhập lại";
											}
											else if($acc_password_new1 != $acc_password_new2) {
												echo "Xác nhận mật khẩu không khớp! Xin mời nhập lại"."<br>";
											}
											else {
												header("location: http://localhost/btl_Hai/private_info.php");
												$qr = pg_query("update account_detail set full_name='$full_name', acc_password='$acc_password_new1', address='$address', phone_number='$phone_number' where acc_name='$name'");
												echo "<br>"."Thay đổi thành công :D";
											}
										}


										?>
									</center>
									</div>
									<?php include('footer.html');?>
								</body>    
								</html>
