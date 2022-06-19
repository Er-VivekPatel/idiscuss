<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome iDiscuss-Coding Forum</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="css/custom.css">
</head>
<body>
    <?php include "partials/_header.php" ;?>
    <?php include "partials/_dbconnect.php" ;?>
    <?php 
        $thread_id=$_GET['thread_id'];
        $sql = "SELECT* FROM threads WHERE thread_id =$thread_id";
        $result = mysqli_query($conn,$sql);
        while($row = mysqli_fetch_assoc($result)){
            $thread_title = $row['thread_title'] ;
            $thread_desc = $row['thread_desc'] ;
            $thread_user_id = $row['thread_user_id'] ;

        }

    ?>
    <?php
        $showAlert=false;
        $method =$_SERVER['REQUEST_METHOD'];
        if($method=="POST"){
            // insert thread into comment db
            $comment=$_POST['comment'];
            $comment=str_replace("<","&lt",$comment);
            $comment=str_replace(">","&gt",$comment);
            $comment_by=$_POST['comment_by'];
            
            $sql="INSERT INTO `comments` ( `comment_content`, `thread_id`, `comment_by`,`comment_date`) VALUES ( '$comment', '$thread_id','$comment_by', current_timestamp());";
            $result=mysqli_query($conn,$sql);
            $showAlert=true;
            if($showAlert){
                echo'
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                       <strong> Success! </strong>Your comment has been added successfully.
                       <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    ';
            }

        }
    ?>
    <!-- category container starts here  -->
    <div class="container">
        <div class="jumbotron my-3">
            <h2 class="display-4"> <?php echo $thread_title ?></h2>
            <p class="lead"><?php echo $thread_desc ?></p>
            <?php 
            
            $sql2 = "SELECT user_email FROM `users` WHERE sn=$thread_user_id";
            
            $result2= mysqli_query($conn,$sql2);
            $row2= mysqli_fetch_assoc($result2);
            echo "<strong> Posted By: <em>".$row2['user_email']."</em> </strong>";
            ?>
            <hr class="my-4">
            <p>
            <ul>
                <li>No Spam / Advertising / Self-promote in the forums. ...</li>
                <li> Do not post copyright-infringing material. ...</li>
                <li>Do not post “offensive” posts, links or images. ...</li>
                <li>Do not cross post questions. ...</li>
                <li>Do not PM users asking for help. ...</li>
                <li>Remain respectful of other members at all times.</li>
            </ul> </p>
            
        </div>
        </div>
            
               
        <?php
        
        
        if(isset($_SESSION['loggedin'])&& $_SESSION['loggedin']==true){ 

            echo '<div class="container">
        <form action="'. $_SERVER['REQUEST_URI'].'" method="POST">
            <div class="mb-3">
                 <h2>Start a discussion</h2>
                <label for="ques_title" class="form-label">Comment :</label>
                <input type="text" class="form-control" id="comment" name="comment" placeholder="Write comment here">
                <input type="hidden" name="comment_by" value="'.$_SESSION['user_sn'].'" >
            </div>
            
            <button type="submit" class="btn btn-success">Post comment</button>
        </form>
    </div>';

        }else{
            echo '<div class="container">
                
                
                <div class="alert alert-danger alert-dismissible fade show mb-0" role="alert ">
                <strong>Sorry ! </strong> You are not login . So for start discussion please login.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div></div>
                ';
        }
        
        ?>

        <!-- media object strt  -->
        <div class="container " style="min-height: 170px;">
        <h2>Discussion:</h2>
        
         <?php 
                
                $noResult=true;
                $sql="SELECT * FROM `comments` WHERE thread_id=$thread_id";
                $result=mysqli_query($conn,$sql);
                while($row=mysqli_fetch_assoc($result)){
                        $noResult=false;
                        $comment_id=$row['comment_id'];
                        $comment_content = $row['comment_content'];
                        
                        $comment_date = $row['comment_date'];
                        $comment_by = $row['comment_by'];

                        
                        $sql2 = "SELECT user_email FROM `users` WHERE sn=$comment_by";
                        
                        $result2= mysqli_query($conn,$sql2);
                        $row2= mysqli_fetch_assoc($result2);

                echo '<div class="d-flex my-3 ">
                <div class="flex-shrink-0">
                <img src="img/userdefault.png" width="40px" class="border border-secondary rounded-circle" alt="...">
                </div>
                <div class="flex-grow-1 ms-3">
                    <p>'.$comment_content.'</p><strong>Posted By:</strong>
                    <span>'.$row2['user_email']. '</span> At
                    <span>'.$comment_date.'</span>
                </div>
                </div>';
        }
        if($noResult){
            echo'<div class="container">
            <div class="h-100 p-5 text-white bg-secondary rounded-3">
              <h2>No comment Yet.</h2>
              <p>Be the first to comment for this question.</p>
             
            </div>
          </div>';
         };
     ?>    
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
</body>
<footer>
    <?php include "partials/_footer.php" ;?>
</footer>
</html>