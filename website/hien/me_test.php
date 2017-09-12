
<!DOCTYPE html>
<html>
<head>
	<title>Thông tin khách hàng</title>
	
<script type="text/javascript">

    function checkAll(ele){
        var checkboxes = document.getElementsByTagName('input');
        for(var i=0; i<checkboxes.length; i++){
            if(checkboxes[i].type =='checkbox')
                checkboxes[i].checked=ele.checked;
        }
    }
    function confirmation(){
        return confirm("Dữ liệu người dùng sẽ bị xoá! Bạn có muốn tiếp tục?");
    }
</script>
</head>


<body bgcolor="#CCD1D4">
   
<?php
    include('me_config.php');
    if(isset($_POST['check'])){
        //print_r($_POST['check']);
        foreach($_POST['check'] as $value){
            $result=pg_query($conn,"DELETE FROM account_detail WHERE acc_name='".$value."'");
            if(!$result) echo"error delete";
            //else echo"delete success";
        }
    }
?>
   
<?php  
	$result=pg_query($conn,"select * from account_detail order by(full_name)");
	$arr=pg_fetch_all($result);
	$soLuong=count($arr);
?>    
    <h2 align="center"> THÔNG TIN KHÁCH HÀNG</h2>
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" onsubmit="return confirmation()" >
      
    <table align="center" width="70%" border=1>
        <tr height="50" align="center" bgcolor="#A2D680">
            <!-- checkbox all-->
            <td width="50">
                <input type="submit" name="submit" value="Xoá"  /><br>
                <input type="checkbox" name="all" onclick="checkAll(this)" />
            </td>
            <td>Họ và tên</td>
            <td width="150">Tên đăng nhập</td> 
			<td width="150">Mật khẩu</td>
            <td width="150">Địa chỉ</td>
            <td width="100">Số điện thoại</td>
            <td width="100">Điểm tích luỹ</td>          
        </tr>
    <?php
    for($id=0; $id<$soLuong; $id++){
    ?>
		<tr align="center" bgcolor="#A1C4DC">
            <td><input type="checkbox" name="check[]" value="<?php echo($arr[$id]["acc_name"]); ?>" />
            <td><?php echo($arr[$id]["full_name"]); ?></td>
            <td><?php echo($arr[$id]["acc_name"]);?></td>
            <td><?php echo($arr[$id]["acc_password"]);?></td>
            <td><?php echo($arr[$id]["address"]); ?></td>
            <td><?php echo($arr[$id]["phone_number"]); ?></td>
            <td><?php echo($arr[$id]["star"]); ?></td>
        </tr>
	<?php 
    }
    ?>
    </table>
    </form>
	<hr>
	<p bgcolor="#fffff" align="center">
			<b>
			    Thời gian mở cửa: 8h - 22h (tất cả các ngày trong tuần)<br>
			    Địa chỉ: 17 Tạ Quang Bửu<br>
			    Liên hệ: 0969.696.969<br>
			</b>
	</p>
 
    	
</body>
</html>