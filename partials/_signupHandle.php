<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
    include '_dbconnect.php';
    $user_email=$_POST['signupEmail'];
    $user_pass=$_POST['signupPassword'];
    $user_cpass=$_POST['csignupPassword'];
    //check email exist or not

    $exitsql = "SELECT* FROM users where user_email = '$user_email'";
    $result = mysqli_query($conn,$exitsql);
    $numRows= mysqli_num_rows($result);
    if($numRows>0){
        $showError = "Email already exists";
    }else{
        if($user_pass==$user_cpass){
            $hash=password_hash($user_pass,PASSWORD_DEFAULT);
            $sql="INSERT INTO `users` ( `user_email`, `user_pass`, `accnt_create_date`) VALUES ( '$user_email', '$hash', current_timestamp());";
            $result=mysqli_query($conn,$sql);
            if($result){
                $showAlert = true;
                header("Location:/Forum/index.php?signupsuccess=true");
                exit();
            }
        }else{
            header("Location:/Forum/index.php?signupsuccess=false");
                exit();
            

        }
    }

}

?>