<!DOCTYPE html>
<html>
    <head>
        <title>Đặt chỗ ngồi</title>
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
                height: 150px;
                float: left;
                margin-top: 50px;
                margin-left: 0px;
                background-color: #CCD1D4;
            }
            .ban_do{
                float: right;
                margin-top: 50px;
                margin-right: 0px;
                height: 285px;
                width:600px;
                background-color: #CCD1D4;
            }
        </style>
    </head>
    
    <body style="font-size: 20px;" >
    <?php
        include('hien/me_config.php');
        session_start();
        $_SESSION["user"]="user1";
        $query="select * from seat";
        $result=pg_query($conn,$query);
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
                    <p>Chọn vị trí: <input type="text" name="name" placeholder="vd: a01"/>
                    <input type="submit" name="submit" value="OK"/>
                </form>
                <?php 
                    if(isset($_POST["name"])){
                        $name = $_POST["name"]; 
                        $user=$_SESSION["user"];
                        $count_1='0';
                        for($i=0; $i < $soLuong; $i++){
                            if($arr[$i]["s_name"] == $name){
                                if($arr[$i]["is_free"]== 't'){
                                    $count_1='1';
                                }
                            }
                        }
                        if($count_1=='1'){
                            $query2=" update seat set is_free=false, acc_name='".$user."' 
                            where s_name='".$name."' ";
                            $result2=pg_query($conn,$query2);
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
                    <div style="margin-top: 50px">
                        <input type="checkbox" checked>Đã có người đặt<br>
                    </div>
                </div>
            </div>
        </div>
        <?php
            $result3=pg_query($conn,$query);
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