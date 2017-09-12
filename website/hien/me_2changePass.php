<!DOCTYPE html>
<html>
<head>
    <title>Đổi mật khẩu</title>
	<style>
		.table1{
			text-align: center; 
			border-width: 15px ;
			padding: 5px;
		}
		.left{
			padding-left: 15px;
		}
		.tron{
			border-radius: 5%;
		}
	</style>
</head>
<body style="font-size: 20px;">
<?php
    include('hien/me_config.php');
    session_start();
    $_SESSION["name"]="user1";   // lưu ý sửa lại $_SESSION["name"] cho phù hợp  
    $query="select secret_question from account_detail 
                    where acc_name='".$_SESSION["name"]."'";
    $result=pg_query($conn,$query);
    if(!$result){
        echo"error query"; exit();
    }
    $arr=pg_fetch_array($result);
    $_SESSION["ques"]=$arr[0]; 
?>
<form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">
<div style="padding: 100px 50px 100px 50px;">
<table align="center" border="0" width="40%" bgcolor="#CCD1D4" class="table1" cellspacing="0">
    <tr height="100" align="center" bgcolor="white">
        <td colspan=2><h2>Quên mật khẩu</h1></td>
    </tr>
    <tr height="60" align="left">
        <td width="40%"  class="left">Tên đăng nhập:</td>
        <td><input class="tron" type="text" name="accname" size="30" value="<?php echo$_SESSION["name"];?>" /></td>
    </tr>
    <tr height="60" align="left">
        <td  class="left">Câu hỏi xác nhận:</td>
        <td><input class="tron" type="text" name="question" size="30" value="<?php echo $_SESSION["ques"]; ?>" /></td>
    </tr>
    <tr height="60" align="left">
        <td class="left">Câu trả lời:</td>
        <td><input class="tron" type="text" name="answer" size="30"/></td>
    </tr>
    <tr height="60" align="left">
        <td  class="left">Mật khẩu mới:</td>
        <td><input class="tron" type="text" name="repass" size="30"/></td>
    </tr height="60" align="left">
    <tr align="center"  height="50">
        <td colspan=2> <input type="submit" name="sub" value="OK"/></td>
    </tr>
</table>
</div>
</form>

<?php
    
    //echo$_SESSION["ques"];
    $result2=pg_query($conn,"select secret_answer from account_detail where acc_name='".$_SESSION["name"]."' ");
    $arr2=pg_fetch_array($result2);
    if(isset($_POST["answer"])){
        if($_POST["answer"]==$arr2[0]){
            //echo"correct answer!  -> ";
            if(isset($_POST["repass"])){
                $query="update account_detail set acc_password='".$_POST["repass"]."' 
                        where acc_name='".$_SESSION["name"]."' ";
                $result=pg_query($conn,$query);
                if(!$result) echo"error query";
                else echo"<p align=center>thanh cong!</p>";
            }
            else echo '<p align="center">xay ra loi!</p>';
         }
        else{
            echo"<p align=center>cau tra loi sai</p>";
        }
    }    
?>
	
</body>
</html>