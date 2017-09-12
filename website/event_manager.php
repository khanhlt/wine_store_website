<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>CUA HANG DO UONG H2KSHOP</title>
    <link rel="stylesheet" type="text/css" href="preview.css"/>
    <link rel="stylesheet" type="text/css" href="event.css"/>
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
    <?php
        $ti=$co="";$sal=0;$be= $en=$im="";

    ?>
    <div class="than">
    <div class="content">
    <div class="cont_search">
        <form  method="post">
            <?php
            //$db = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=Milubamhanc");
            if (isset($_POST['add_e'])) 
            {
            

            $query = "insert into events values ('".$_POST['e_tit']."','".$_POST['e_con']."',".$_POST['e_per'].",'".$_POST['e_b']."','".$_POST['e_e']."','".$_POST['e_i']."');";  
            $result = pg_query($query);
            echo "<script type='text/javascript'>alert('Thêm sự kiện thành công');</script>"; 

            } 
            if (isset($_POST['edit'])) 
            {
                if(!empty($_POST['check_list'])) {
                    foreach($_POST['check_list'] as $check) {

                        //$ti=$co=$sal=$be=$en=$im="";
                        $query ="select * from events where e_title = '".$check."';";
                        $result = pg_query($query); 
                        $row = pg_fetch_assoc($result);
                        $ti=$row["e_title"];
                        $co=$row["e_content"];
                        $sal=$row["sale_percent"];
                        $be=$row["begin_time"];
                        $en=$row["end_time"];
                        $im=$row["img_name"];
                    } 
                }
            } 
            ?>
  <fieldset>
    <legend>Thêm sự kiện mới:</legend>
    
        Tên sự kiên: &nbsp;&nbsp;&nbsp;   <input class="search1" type="text" name="e_tit" placeholder="Tìm Kiếm"><br><br>
        Nội dung : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;     <input class="search1" type="text" name="e_con" placeholder="Tìm Kiếm"><br><br>
        Giảm giá (%): &nbsp;&nbsp;  <input  type="text" placeholder="searchguest" name="e_per"><br><br>
        Ngày bắt đầu : &nbsp; <input  type="text" placeholder="searchguest" name="e_b"><br><br>
        Ngày kết thúc : <input  type="text" placeholder="searchguest" name="e_e"><br><br>
        Chọn hình ảnh:  &nbsp;<input  type="text" placeholder="searchguest" name="e_i"><br><br>

        <input type="submit" value="ok" width="50px" height="50px" name="add_e">
  </fieldset>
</form>
    </div>
    
    
    </div>

    <div class="list_event">
        <div class="event_top">
            <center><font color="white"><br>Sự kiện khuyến mại</font></center>
        </div>
        <?php
            //$db = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=Milubamhanc");

            $query = "select * from events order by begin_time asc";  
            $result = pg_query($query);  
            $row = pg_fetch_assoc($result);
            
            {
                
                echo "<div class=\"left_event\"><img width=\"100px\" height= \"100px\" src=\"images/".$row["img_name"]."\"></img> </div><div class=\"right_event\">" .$row["e_title"]."<br>".$row["e_content"]."<br>".$row["sale_percent"]."<br>".$row["begin_time"]."<br>".$row["end_time"]."</div>";
            }
            $row = pg_fetch_assoc($result);
            
            {
                
                echo "<div class=\"left_event\"><img width=\"100px\" height= \"100px\" src=\"images/".$row["img_name"]."\"></img> </div><div class=\"right_event\">" .$row["e_title"]."<br>".$row["e_content"]."<br>".$row["sale_percent"]."<br>".$row["begin_time"]."<br>".$row["end_time"]."</div>";
            }
            $row = pg_fetch_assoc($result);
            
            {
                
                echo "<div class=\"left_event\"><img width=\"100px\" height= \"100px\" src=\"images/".$row["img_name"]."\"></img> </div><div class=\"right_event\">" .$row["e_title"]."<br>".$row["e_content"]."<br>".$row["sale_percent"]."<br>".$row["begin_time"]."<br>".$row["end_time"]."</div>";
            }
            
            
            
            
        ?>

        
        
    </div>
  <div class="content">
    <div class="cont_search">
        <form  method="post">
            <?php
            if (isset($_POST['add_e2'])) 
            {
            //$db = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=Milubamhanc");

            //$query = "insert into events values ('".$_POST['e_tit']."','".$_POST['e_con']."',".$_POST['e_per'].",'".$_POST['e_b']."','".$_POST['e_e']."','".$_POST['e_i']."');";  
            $query="update events set e_content = '".$_POST['e_con2']."', sale_percent = ".$_POST['e_per2'].",begin_time= '".$_POST['e_b2']."',end_time='".$_POST['e_e2']."',img_name='".$_POST['e_i2']."' where e_title = '".$_POST['e_tit2']."';";
            $result = pg_query($query);
            echo "<script type='text/javascript'>alert('Sửa thành công');</script>"; 

            }  

            ?>
  <fieldset>
    <legend>Sửa thông tin sự kiện:</legend>
    
        Tên sự kiên: &nbsp;&nbsp;&nbsp;   <input class="search1" type="text" name="e_tit2" value="<?php echo $ti ?>" placeholder="Tìm Kiếm"><br><br>
        Nội dung : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;     <input class="search1" type="text" name="e_con2" 
        value="<?php echo $co ?>"><br><br>
        Giảm giá (%): &nbsp;&nbsp;  <input  value="<?php echo $sal ?>" type="text" placeholder="searchguest" name="e_per2"><br><br>
        Ngày bắt đầu : &nbsp; <input  value="<?php echo $be ?>" type="text" placeholder="searchguest" name="e_b2"><br><br>
        Ngày kết thúc : <input  value="<?php echo $en ?>" type="text" placeholder="searchguest" name="e_e2"><br><br>
        Chọn hình ảnh:  &nbsp;<input  value="<?php echo $im ?>" type="text" placeholder="searchguest" name="e_i2"><br><br>

        <input type="submit" value="ok" width="50px" height="50px" name="add_e2">
  </fieldset>
</form>
    </div>
    
    
    </div>

    <div class="list_prod">
    <?php
            //$db = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=Milubamhanc");
            if (isset($_POST['delete']))
            {
                //$query ="update seat set is_free = FALSE, acc_name = NULL where s_name = '".."';";
                if(!empty($_POST['check_list'])) {
                    foreach($_POST['check_list'] as $check) {
                        
                        $query ="delete from events where e_title = '".$check."';";
                        $result = pg_query($query); 
                    }
                }
            }

            
            
            
        ?>
    <form method="post" action="event_manager.php">
    &nbsp;
    <input type="submit" value="Sửa nội dung"  name="edit">&nbsp;&nbsp;
    <input type="submit" value="Xóa bản ghi"  name="delete">
    <center>DANH SÁCH SỰ KIỆN</center><hr>
    <?php
            include('me_config.php');
            //$db = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=Milubamhanc");

            $query = "select * from events order by begin_time desc";  
            $result = pg_query($query);  
            for($s=0;$s<1000;$s++)
            {
                $row = pg_fetch_assoc($result);
                if($row==NULL) break;           
            {   
                /*echo "<div class=\"left_event\">".$row["img_name"]." </div><div class=\"right_event\">" .$row["e_title"]."<br>".$row["e_content"]."<br>".$row["sale_percent"]."<br>".$row["begin_time"]."<br>".$row["end_time"]."</div>";*/
                echo "<br><input type=\"checkbox\" name=\"check_list[]\" value=\"".$row["e_title"]."\"> 
                TIÊU ĐỀ: &nbsp;&nbsp;&nbsp;&nbsp;".$row["e_title"]." <br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NỘI DUNG: &nbsp;".$row["e_content"]." <br><br>&nbsp;&nbsp;&nbsp; &nbsp;GIẢM GIÁ: ".$row["sale_percent"]."% | BẮT ĐẦU: ".$row["begin_time"]." | KẾT THÚC: ".$row["end_time"]." | LINK ẢNH: ".$row["img_name"]."<br><hr>";
            }
            }
    ?>
    </form>
    </div>
    
    
    
    </div>
    
</body>    
</html>
