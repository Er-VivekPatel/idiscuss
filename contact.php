
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
<?php 
include "partials/_header.php" ;
include "partials/_dbconnect.php" ;
echo '<div class="container" >
                <form >
                <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address:</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                
                </div>
                <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Message:</label>
                <input type="text" class="form-control" id="exampleInputPassword1">
                </div>

                <button type="submit" class="btn btn-success">Send</button>
                </form>
    </div>';
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
</body>
<footer>
    <?php include "partials/_footer.php" ;?>
</footer>
</html>