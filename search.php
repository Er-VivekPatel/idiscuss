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
    <?php include "partials/_dbconnect.php" ;?>
    <?php include "partials/_header.php" ;?>

    <div class="container my-2" style=" min-height: 560px;">
        <h1>Search result for <em>"<?php echo $_GET['search'] ?>"</em> </h1>
        <?php 
        $query=$_GET["search"];
        $sql = "SELECT * FROM `threads` WHERE MATCH(thread_title,thread_desc) against ('$query') ";
        $result = mysqli_query($conn,$sql);
        $numRow = mysqli_num_rows($result);
        if($numRow>0){

            while($row = mysqli_fetch_assoc($result)){
            $thread_title = $row['thread_title'] ;
            $thread_desc = $row['thread_desc'] ;
            $thread_id = $row['thread_id'] ;
            $url="thread.php?thread_id=$thread_id";
                // display the search result 
                echo'<div class="result px-2 " >
                        <h3><a href="'.$url.'" class="text-dark">'.$thread_title.'t </a> </h3>
                        <p>'.$thread_desc.'</p>
                     </div>';
             }}else{
                    echo '<div class="container " style="margin-bottom: 370px;">
                    <div class="h-100 p-5 text-white bg-secondary rounded-3">
                        <h2>No thread found .</h2>
                        
                    </div>
                    </div>';
                 }
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