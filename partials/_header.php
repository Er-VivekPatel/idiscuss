<?php 
session_start();
include_once("partials/_dbconnect.php");
echo '
<nav class="navbar navbar-expand-lg bg-dark navbar-dark">
<div class="container-fluid">
  <a class="navbar-brand" href="/Forum">iDiscuss</a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="/Forum">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="about.php">About</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          TopCategories
        </a>
                
                    
                   
        
        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">';
        $sql = "SELECT category_name , category_id FROM categories";
                $result = mysqli_query($conn,$sql);
                
                while($row = mysqli_fetch_assoc($result)){
                  echo '<li><a class="dropdown-item" href="threadslist.php?cat_id='.$row['category_id'].'">'.$row['category_name'].'</a></li>';
                }   
        echo '</ul>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="contact.php">Contact</a>
              </li>
            </ul>';
   
    if(isset($_SESSION['loggedin'])&& $_SESSION['loggedin']==true){

    
    echo '
      <form class="d-flex" role="search" action="search.php" method="GET">
        <input class="form-control me-2" type="search" placeholder="Search" name="search" aria-label="Search">
        <button class="btn btn-success mx-1" type="submit">Search</button>
        <span class="badge bg-secondary align-middle" >Welcome </br>'.$_SESSION['useremail'].'</span>
    <a href=""></a>
         <a href="partials/_logout.php"><button type="button" class="btn btn-outline-success mx-1"> Logout</button>  </a> 
        </form>';
      }else{
       
        echo '
        <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-success mx-1" type="submit">Search</button></form>
        <button class="btn btn-outline-success mx-2 " data-bs-toggle="modal" data-bs-target="#loginModal"  >Login</button>
        <button class="btn btn-outline-success " data-bs-toggle="modal" data-bs-target="#signupModal">Sign Up</button>';
      }
    echo '   </div>
            </div>
            </nav>    
            ';
include 'partials/_login.php';
include 'partials/_signup.php';
if(isset($_GET['signupsuccess']) && $_GET['signupsuccess']=='true'){
  echo'<div class="alert alert-success alert-dismissible fade show mb-0" role="alert ">
          <strong>Success ! </strong> You register succesfully now you can Login.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
}
 if(isset($_GET['signupsuccess']) && $_GET['signupsuccess']=='false'){
    echo'<div class="alert alert-danger alert-dismissible fade show mb-0" role="alert ">
            <strong>Sorry ! </strong> Password do not match.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
  };