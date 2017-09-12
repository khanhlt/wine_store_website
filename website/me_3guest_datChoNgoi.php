<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Đặt chỗ ngồi</title>
    <link rel="stylesheet" type="text/css" href="preview.css"/>
    <link rel="stylesheet" type="text/css" href="h2kshop_guest.css"/>
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
/*
<a href="\" style="color: white;"><img src="images/face.png"></img>your name</a>
                
                
                
*/

</style>
        <script type="text/javascript">
            function thongbao(ele){
                var check_box=document.getElementById(ele);
                check_box.checked=true;
            }
        </script>
        <style type="text/css">
            .nen{
                margin-left: auto;
                margin-right: auto;
                width: 70%;
                text-align: center;
                background-color: #CCD1D4;
            }
            .select{
                width: 200px;
                height: 200px;
                float: left;
                margin-top: 10px;
                margin-left: 0px;
                background-color: #CCD1D4;
            }
            .ban_do{
                float: right;
                margin-top: 10px;
                margin-right: 0px;
                height: 285px;
                width:600px;
                background-color: #CCD1D4;
            }
        </style>

</head>
<body bgcolor="white" style="font-size: 20px;">

<div class="header">
		<div class="searchDiv">
			<form method="post" action="search.php">
				<input class="search1" type="text" name="search11" placeholder="Tìm Kiếm" >
                <input type="submit" value="search" name ="p_search">
			</form>
		</div>
		<div class="login">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            
                <?php
                    session_start();
                    echo "<a style=\"color: white;\"><img src=\"images/face.png\"></img>".$_SESSION["name"]."</a>";
                    //$db = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=Milubamhanc");
                    include('me_config.php');
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

<?php
        include('me_config.php');
        session_start();
        $_SESSION["user"]=$_SESSION["sacc_name"];
        $query="select * from seat";
        $result=pg_query($db,$query);
        if(!$result){
            echo"error query"; exit();
        }
        $arr=pg_fetch_all($result);
        $soLuong=count($arr);
    ?>
        <div class="nen">
            <div>
                <h2>Đặt chỗ ngồi</h2>
            </div>
            <div class="select">
                <form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>" >
                    <p style="font-size: 20px;">Chọn vị trí ( chỉ với khách có điểm tích luỹ >= 20):<input type="text" name="name" placeholder="vd: a01"/ required />
                    <input type="submit" name="submit" value="Đặt chỗ"/>
                </form>
                <?php 
                    if(isset($_POST["name"])){
                        $name = $_POST["name"]; 
                        $user=$_SESSION["user"];
                        $count_1='0';
                        $result2=pg_query($db," select star from account_detail where acc_name='".$user."' " );
                        $row2=pg_fetch_array($result2);
                        $diem=$row2["star"]; //echo$diem;
                        if($diem < 20){
                            $count_1='0';
                        }else{
                            for($i=0; $i < $soLuong; $i++){
                                if($arr[$i]["s_name"] == $name){
                                    if($arr[$i]["is_free"]== 't'){
                                        $count_1='1'; break;
                                    }
                                }
                            }   
                        }
                        
                        if($count_1=='1'){
                            $query2=" update seat set is_free=false, acc_name='".$user."' 
                            where s_name='".$name."' ";
                            $result2=pg_query($db,$query2);
                            echo"đặt chỗ thành công";
                        }else{
                            echo"đặt chỗ không thành công";
                        }
                    }
                ?>
            </div>
            <div class="ban_do" >
                <table border="1" width="600px" cellspacing="50px" >
                    <tr style="text-align: center; ">
                        <td>a01 <input type="checkbox" name="a1" id="a01"/></td>
                        <td>a02 <input type="checkbox" name="a2" id="a02"/></td>
                        <td>a03 <input type="checkbox" name="a3" id="a03"/></td>
                        <td>a04 <input type="checkbox" name="a4" id="a04"/></td>
                    </tr>
                    <tr style="text-align: center">
                        <td>a05 <input type="checkbox" name="a5" id="a05"/></td>
                        <td>a06 <input type="checkbox" name="a6" id="a06"/></td>
                        <td>a07 <input type="checkbox" name="a7" id="a07"/></td>
                        <td>a08 <input type="checkbox" name="a8" id="a08"/></td>
                    </tr>
                    <tr style="text-align: center">
                        <td>a09 <input type="checkbox" name="a9" id="a09"/></td>
                        <td>a10 <input type="checkbox" name="a10" id="a10"/></td>
                        <td>a11 <input type="checkbox" name="a11" id="a11"/></td>
                        <td>a12 <input type="checkbox" name="a12" id="a12"/></td>
                    </tr>
                </table>
                <div style="flat: bottom; margin-left: 0px ">
                    |Cửa ra vào|<br>
                    <div style="margin-top: 5px">
                        <input type="checkbox" checked>Đã có người đặt<br>
                    </div>
                </div>
            </div>
        </div>
        <?php
            $result3=pg_query($db,$query);
            $arr2=pg_fetch_all($result3);
            $soLuong1=count($arr2);
            for($i=0; $i<$soLuong1; $i++){
                if($arr2[$i]["is_free"]=='f'){
                    $id=$arr2[$i]["s_name"];
                    ?>
                    <script type="text/javascript">
                            var id = <?php echo json_encode($id); ?>;
                            var check_box=document.getElementById(id);
                            check_box.checked=true;
                    </script>
                    <?php
                }
            }
                    
        ?> 
    </body>
</html>







