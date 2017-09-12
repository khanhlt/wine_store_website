<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>CUA HANG DO UONG H2KSHOP</title>
    <link rel="stylesheet" type="text/css" href="preview.css"/>
    <link rel="stylesheet" type="text/css" href="h2kshop_guest.css"/>
    <link rel="stylesheet" type="text/css" href="wt-rotator.css"/>
    <script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
    <script type="text/javascript" src="js/jquery.wt-rotator.min.js"></script>
    <script type="text/javascript" src="js/preview.js"></script>  
    <style >
        #phDIV {
   position:fixed;
    width: 300px;
    height: 70px;
    top:50px;
    right: 90px;
    background-color:white;
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
        <?php
    
        // If the submit button has been pressed
         if (isset($_POST['lg']))
        {
            $s="<div id=\"phDIV\"><center>username hoặc password không đúng<br><br><a style=\"color: black;\" href=\"http://localhost/btl_Hai/me_2stranger_changePass.php\">Quên password</a></center></div>";
            //$db = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=Milubamhanc");  
            include('me_config.php');
            $query = "select * from account_detail where acc_name like '".$_POST['acc']."'";  
            $result = pg_query($query);  
            $row = pg_fetch_assoc($result);
            if($row==NULL) echo $s;
            else
            {
                if($row[acc_password]==$_POST['pass']) 
                {
                    if($_POST['acc']=="admin")
                    {
                        header("location: http://localhost/btl_Hai/home_admin.php");
                    }
                    else
                    {
                        session_start();
                    $_SESSION["name"]=$row[full_name];
                    $_SESSION["sacc_name"]=$row[acc_name];
                    $_SESSION["addr"]=$row[address];
                    $_SESSION["phone"]=$row[phone_number];
                    header("location: http://localhost/btl_Hai/home_guest.php");
                    }
                }
                else echo $s;
            }
        /*if($_POST['name']=='ab')
        echo "Hi ".$_POST['name']."!<br />";
        else 
            header("location: http://localhost/form.php");*/
        }
        
        ?>
            <form method="post">
                <input type="text"  class="text_login" name="acc" placeholder="Tài Khoản" required />
                <input type="password" name="pass" class="text_login" placeholder="Mật Khẩu" required />
                <input type="submit" value="ok" name="lg">
                <a href="http://localhost/btl_Hai/register.php" style="color: white;"><img src="images/register.png"></img>Đăng Kí</a>
            </form>
        </div>
</div>
<div class="cover">
		<img src="logo3.jpg" width="100px" height="100px" class="logo"> </img>
		<img src="logo2.jpg" height="100px" width="1049px" class="logo2"> </img>
		
</div>
<div class="menu" style="background-color: rgb(128,128,128);">
		<div class="submenu">
			<a href="http://localhost/btl_Hai/home_stranger2.php" class="a1"> <img src="images/home.png"></img> Home</a>
			<a href="http://localhost/btl_Hai/wine_stranger.php" class="a1"> Wine</a>
			<a href="http://localhost/btl_Hai/beer_stranger.php" class="a1">Beer</a>
			<a href="http://localhost/btl_Hai/cocktail_stranger.php" class="a1">Cocktail</a>
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
    <div class="than">
    <div class="content">
    <?php
    
    

    ?>
    <div class="cont_search">
        <form action="search_stranger.php" method="post">
  <fieldset>
    <legend>Tìm kiếm sản phẩm:</legend>
    <input type="radio" name="items" value="pname" checked> theo tên <br> 
    <input type="radio" name="items" value="pcountry" > Theo quốc gia<br>  
    
        <input class="search1" type="text" name="searchguest" placeholder="Tìm Kiếm">
        <br><br>Sắp xếp theo:
        <input type="radio" name="sapxep" value="ten">
        <select name = "tten">
            <option value="tt">Ten tang dan</option>
            <option value="tg">Ten giam dan</option>
        </select>
        <input type="radio" name="sapxep" value="gia">
        
        <select name="tgia">
            <option value="gt">Gia tang dan</option>
            <option value="gg">Gia giam dan</option>
        </select>
        
        <input type="submit" value="Tìm" width="50px" height="50px" name="ss">
  </fieldset>
</form>
    </div>
    
    
    </div>

    <div class="list_event">
        <div class="event_top">
            <center><font color="white"><br>Sự kiện khuyến mại</font></center>
        </div>
        <?php
            include('me_config.php');
            //$db = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=Milubamhanc");  
            $query = "select * from events order by begin_time asc";  
            $result = pg_query($query);  
            $row = pg_fetch_assoc($result);
            
            {
                
                echo "<div class=\"left_event\"><img width=\"100px\" height= \"100px\" src=\"images/".$row["img_name"]."\"></img> </div><div class=\"right_event\">" .$row["e_title"]."<br>".$row["e_content"]."<br>Giảm: ".$row["sale_percent"]."%<br>Từ ngày: ".$row["begin_time"]."<br>Đến ngày: ".$row["end_time"]."</div>";
            }
            $row = pg_fetch_assoc($result);
            
            {
                
                echo "<div class=\"left_event\"><img width=\"100px\" height= \"100px\" src=\"images/".$row["img_name"]."\"></img> </div><div class=\"right_event\">" .$row["e_title"]."<br>".$row["e_content"]."<br>Giảm: ".$row["sale_percent"]."%<br>Từ ngày: ".$row["begin_time"]."<br>Đến ngày: ".$row["end_time"]."</div>";
            }
            $row = pg_fetch_assoc($result);
            
            {
                
                echo "<div class=\"left_event\"><img width=\"100px\" height= \"100px\" src=\"images/".$row["img_name"]."\"></img> </div><div class=\"right_event\">" .$row["e_title"]."<br>".$row["e_content"]."<br>Giảm: ".$row["sale_percent"]."%<br>Từ ngày: ".$row["begin_time"]."<br>Đến ngày: ".$row["end_time"]."</div>";
            }
            
        ?>
        
        
    </div>

    <div class="list_prod">
        <br> <center>Kết quả tìm kiếm</center> 
        <br><hr>
        <?php 
            include('me_config.php');
            if (isset($_POST['ss']))
            {
            $answer = $_POST['items'];  
            if ($answer == "pname") {          
                $query = "select * from drink where d_name like '".$_POST['searchguest']."%' limit 9";     
            }
            else {
                $query = "select * from drink where producer like '".$_POST['searchguest']."%' limit 9";     
            }  
            if($_POST["sapxep"]=="ten")
            {
                if($_POST['tten']=="tt")
                {
                    $query.=" order by d_name asc";
                }
                else $query.=" order by d_name desc";
            }   
            if($_POST["sapxep"]=="gia")
            {
                if($_POST['tgia']=="gt")
                {
                    $query.=" order by d_cost asc";
                }
                else $query.=" order by d_cost desc";
            }     
            //$db = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=Milubamhanc");  
            include('me_config.php');
            $result = pg_query($query);  
            for($i=0;$i<=10;$i++)
            {
                $row = pg_fetch_assoc($result);
            
                {
                    if($row["d_name"]!=NULL)
                
                    echo "<div class=\"product1\"><br><center><img width=\"100px\" height=\"100px\" src=\"drinks/".$row["image"].".jpg\"></img><br>".$row["d_name"]."<br>".$row["d_cost"].".000VND<center></div>";
                }
            }
            }
            
            /*$db = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=Milubamhanc");
            $query = "select * from drink";  
            $result = pg_query($query);  
            for($i=0;$i<5;$i++)
            {
                //$row = pg_fetch_assoc($result);           
                {
                
                echo "<div class="product"> </div>";
                }
            }*/
            
            
        ?>
    </div>
    
    <div class="list_sell">
        <div class="event_top">
            <center><font color="white"><br>Bán chạy nhất</font></center>
        </div>
        <?php
            //$db = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=Milubamhanc");

            $query = "select * from drink order by bought desc;";  
            $result = pg_query($query);  
            for($k=0;$k<5;$k++)
            {
                $row = pg_fetch_assoc($result);
            
            {
                
                echo "<div class=\"left_event\"><img width=\"100px\" height= \"100px\" src=\"drinks/".$row["image"].".jpg\"></img> </div><div class=\"right_event\">" .$row["d_name"]."<br>".$row["d_cost"].".000VND<br>Đã mua: ".$row["bought"]."</div>";
            }
            }
            
            
            
            
            
        ?>

        
        
    </div>
    </div>
    
</body>    
</html>
