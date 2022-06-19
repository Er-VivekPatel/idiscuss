<?php 
 if($_SERVER['REQUEST_METHOD']=="POST"){
     
     include '_dbconnect.php';
        $email=$_POST['login_mail'];
        $pass=$_POST['login_pass'];
        
        $sql="SELECT* FROM users WHERE user_email='$email' ";
        $result=mysqli_query($conn,$sql);
        $numRows=mysqli_num_rows($result);
        
        if($numRows==1){
            $row = mysqli_fetch_assoc($result);
            $sn = $row['sn'];
           if(password_verify($pass,$row['user_pass'])){
            session_start();
            $_SESSION['loggedin']=true;
            $_SESSION['useremail']=$email;
            $_SESSION['user_sn']=$sn;
            
            
        }
        header("Location:/Forum/index.php");      
        }
 }

?>