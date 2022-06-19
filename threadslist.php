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
        $cat_id=$_GET['cat_id'];
        $sql = "SELECT* FROM categories WHERE category_id =$cat_id";
        $result = mysqli_query($conn,$sql);
        while($row = mysqli_fetch_assoc($result)){
            $catname = $row['category_name'] ;
            $catdesc = $row['category_description'] ;
        }
        
    ?>
    <?php
        $showAlert=false;
        $method =$_SERVER['REQUEST_METHOD'];
        if($method=="POST"){
            // insert thread into db
            $th_title=$_POST['ques_title'];
            $th_title=str_replace("<","&lt",$th_title);
            $th_title=str_replace(">","&gt",$th_title);
            $th_desc=$_POST['ques_desc'];
            $th_desc=str_replace("<","&lt",$th_desc);
            $th_desc=str_replace(">","&gt",$th_desc);
            $thread_user_id=$_POST['thread_user_id'];
           
            $sql="INSERT INTO `threads` ( `thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `posting_date`) VALUES ( '$th_title', '$th_desc', '$cat_id', '$thread_user_id', current_timestamp());
            ";
            $result=mysqli_query($conn,$sql);
            $showAlert=true;
            if($showAlert){
                echo'
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                       <strong> Success! </strong>Your thread has been added successfully.Please wait for community to respond.
                       <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    ';
            }

        }
    ?>

    <!-- category container starts here  -->
    <div class="container">
        <div class="jumbotron ">
            <h1 class="display-4">Welcome to <?php echo $catname ?> Forum</h1>
            <p class="lead"><?php echo $catdesc ?></p>
            <hr class="my-4">
            <p>
            <ul>
                <li>No Spam / Advertising / Self-promote in the forums. ...</li>
                <li> Do not post copyright-infringing material. ...</li>
                <li>Do not post “offensive” posts, links or images. ...</li>
                <li>Do not cross post questions. ...</li>
                <li>Do not PM users asking for help. ...</li>
                <li>Remain respectful of other members at all times.</li>
            </ul>
            </p>
            <p class="lead">
                <a class="btn btn-success btn-lg" href="#" role="button">Learn more</a>
            </p>
        </div>
    </div>
    <!-- media object strt  -->
    <?php
        
        
        if(isset($_SESSION['loggedin'])&& $_SESSION['loggedin']==true){ 

            echo '<div class="container">
            <form action="'. $_SERVER['REQUEST_URI'] .'" method="POST">
                <div class="mb-3">
                    <label for="ques_title" class="form-label">Question Title.</label>
                    <input type="text" class="form-control" id="ques_title" name="ques_title" placeholder="question ?">
                    <input type="hidden" name="thread_user_id" value="'.$_SESSION['user_sn'].'" >
                </div>
                <div class="mb-3">
                    <label for="ques_desc" class="form-label">Question description in shorthand.</label>
                    <textarea class="form-control" id="ques_desc" name="ques_desc" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-success">Ask</button>
            </form>
        </div>';

        }else{
            echo '<div class="container">
                
                
                <div class="alert alert-danger alert-dismissible fade show mb-0" role="alert ">
                <strong>Sorry ! </strong> You are not login . So for asking question please login.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div></div>
                ';
        }
        
        ?>
    <div class="container " style="min-height: 170px;">
        <h2>Browse Questions:</h2>

        <?php 
                $sql="SELECT * FROM `threads` WHERE thread_cat_id=$cat_id";
                $result=mysqli_query($conn,$sql);
                $noResult=true;
                while($row=mysqli_fetch_assoc($result)){
                        $noResult=false;

                        $thread_date=$row['posting_date'];
                        $thread_id=$row['thread_id'];
                        $title = $row['thread_title'];
                        $desc = $row['thread_desc'];
                        $user_id=$row['thread_user_id'];
                        $sql2 = "SELECT user_email FROM `users` WHERE sn=$user_id";
                        
                        $result2= mysqli_query($conn,$sql2);
                        $row2= mysqli_fetch_assoc($result2);
                      

                        
                     
                echo '<div class="d-flex my-3 ">
                <div class="flex-shrink-0">
                <img src="img/userdefault.png" width="40px" class="border border-secondary rounded-circle" alt="...">
            </div>
            <div class="flex-grow-1 ms-3">
               <h5 ><a class="text-dark"  href="thread.php?thread_id='.$thread_id.' ">'.$title.'</a></h5>
                <p>'.$desc.'</p> <strong>Posted By:</strong>
                <span>'.$row2['user_email']. '</span> At
                <span>'.$thread_date.'</span>
            </div>
            </div>';
         }
        
         if($noResult){
            echo'<div class="container">
            <div class="h-100 p-5 text-white bg-secondary rounded-3">
              <h2>No question Yet.</h2>
              <p>Be the first to Ask question in this category.</p>
             
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
