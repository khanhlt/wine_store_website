<!DOCTYPE html>
<html>
<head>
    <title>Tin nhắn</title>
    
    <style>
        .main {
            width: 800px;
            padding: 0;
            margin-left: auto;
            margin-right: auto;
        }
        .head {
            height: 50px;
            font-size: 30px;
            text-align: center;
            border: 1px solid #CDCDCD;
        }
        .left {
            border-radius: 10%;
            margin-top: 10px;
            width: 200px;
           
            background-color: #CCD1D4;
            float: left;
            border: 2px solid #CDCDCD;
        }
        .right {
            border-radius: 3%;
            width: 580px;
            height: 400px;
            background-color: #CCD1D4;
            margin-top: 10px;
            margin-left: 10px;
            float: right;
            border: 2px solid #CDCDCD;
        }
        .chat_text {
            float: right;
            margin-top: 10px;
            margin-right: 0px;
            
        }
        .send_button {
            float: right;
            margin-top: 5px;
            margin-right:0px;
        }
    </style>
</head>
<body>
    <?php
        include('me_config.php');
            pg_query($conn, "update comment_msg set seen='TRUE' where seen='FALSE'");
            // kiểm tra isset tin nhắn, người đc chọn  -> cập nhật csdl
            session_start();
            if(isset($_POST["chon"])){
                $_SESSION["chon"]=$_POST["chon"];
            }
            if(isset($_POST["text_chat"])){
                if(isset($_SESSION["chon"])){
                    // câu lệnh sql nối thêm tin nhắn của admin vào cột reply
                        $query2="select * from comment_msg where acc_name = '".$_SESSION["chon"]."' order by comment_id DESC limit 1";
                        $result2=pg_query($conn,$query2);
                        $arr2=pg_fetch_all($result2);
                        $reply_p = $arr2[0]["reply"];
                        $id=$arr2[0]["comment_id"];
                        $reply_next = $reply_p.$_POST["text_chat"]."<br/>"; 
                        
                        pg_query($conn," update comment_msg set reply='".$reply_next."' 
                                        where comment_id in (select MAX(comment_id) from comment_msg 
                                        where acc_name = '".$_SESSION["chon"]."')");
                        pg_query($conn," update comment_msg set seen2='FALSE' where comment_id='".$id."'" );
                        
                }else
                    echo"unset chon";
            }
    ?>
        
    <?php   // quét lấy dữ liệu từ cơ sở dữ liệu
        $query="select * from comment_msg where d_name is null order by comment_id ASC";
        $result=pg_query($conn,$query);
        if(!$result){
            echo"error query"; exit();
        }
        $arr=pg_fetch_all($result);
        $soLuong=count($arr);
        
        $n=1; // so luong user nhan tin, theo thu tu user[0] là mới nhắn nhất
        $user[0]=$arr[$soLuong-1]["acc_name"];
        for($i=$soLuong-2; $i >= 0; $i--){
            $test=0;
            for($j=$soLuong-1; $j>$i; $j--){
                if($arr[$j]["acc_name"]==$arr[$i]["acc_name"]){
                    $test=1; break;  
                }
            }
            if($test==0){
                $user[$n]=$arr[$i]["acc_name"];
                $n++;
            }
        }
        // set session cho 1 nguoi tro chuyen
        if(!isset($_SESSION["chon"]))
            $_SESSION["chon"]=$user[$n-1];
        
    ?>
    <div class="main">
        <div class="head">
            Tin nhắn
        </div>
        <form name="form_xem" method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">
            <div style="background-color: white; margin-top: 10px;">
                <input type="submit" name="xemSub" value="Xem"/>
                
            </div>
            <table class="left">  <!-- danh sach nguoi dung -->
                <?php
                for($i=0; $i < $n; $i++){
                ?>
                    <tr>
                        <td width="5px">
                            <input type="radio" name="chon" value="<?php echo$user[$i]; ?>">
                        </td>
                        <td>
                            <span style="color: red;"><?php echo$user[$i]; ?></span>
                        </td>
                    </tr>
                    
                
                <?php
                }
                ?>
            </table>
        </form>
        
        
        
            <div class="right">
            <table width="580px" border="0" cellpadding="0px" cellspacing="0px">
            <?php 
                if(isset($_SESSION["chon"])){
                    
                    for($i=0; $i<$soLuong; $i++){
                        if($arr[$i]["acc_name"]==$_SESSION["chon"]){
                            ?>
                            <tr height="20px">
                                <td width="70px">
                                    <span style="color: red;"><?php echo$arr[$i]["acc_name"];?> : </span>
                                </td>
                                <td>
                                    <?php echo$arr[$i]["cmt_content"];?>
                                </td>
                            </tr>
                            <tr height="20px" bgcolor="#79bdea">
                                <td width="70px">
                                    <span style="color: blue;">Admin : </span>
                                </td>
                                <td>
                                    <?php echo$arr[$i]["reply"]; ?>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                }
            ?>
            </table>
            </div>
        <form name="form_chat" method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">
            <div class="chat_text">
                <textarea rows="3" cols="50" name="text_chat" placeholder="Viết tin nhắn" align="right"
                style="border-radius: 3%;"></textarea><br>
                <input class="send_button" type="submit" name="chatSub" value="Send">
            </div>
        </form>
    </div>
</body>
</html>