<?php 
session_start();
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'movie_management';
$conn = mysqli_connect('localhost', 'root', '', 'movie_management') or die('connection failed');


?>

<!DOCTYPE html>
<html lang="en">
<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Bootstrap CSS -->
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" >

<!--	Style CSS	-->
<link href="source/css/movie.css" rel="stylesheet">
	
</head>

<body>	  

<section>
    <div class="container margin-1">
        <?php
        if(isset($_GET['view'])){
            $view_id = $_GET['view'];
            $select_view = "SELECT * FROM movie WHERE id = '$view_id'";
            $view_query = mysqli_query($conn, $select_view);
            if(mysqli_num_rows($view_query) > 0){
                while($fetch_movies = mysqli_fetch_assoc($view_query)){                
            
        ?>
        <div class="shadow-2 margin-4">
            <div class="row">
                <div class="col-md-4">
                    <img class="img-fluid" src="uploarded_img/<?php echo $fetch_movies['image']; ?>" alt="">
                </div>
                <div class="col-md-8">
                    <div class="detail-2"><strong><?php echo $fetch_movies['name']; ?></strong></div>
                    <div class="detail-1"><strong>Genre: </strong><?php echo $fetch_movies['genre']; ?></div>
                    <div class="detail-1"><strong>Release Date: </strong><?php echo $fetch_movies['date']; ?></div>
                    <div class="detail-1"><strong>Lead Actor: </strong><?php echo $fetch_movies['actor']; ?></div>
                    <div class="detail-1"><strong>Director: </strong><?php echo $fetch_movies['director']; ?></div>
                    <a href="index.php" class="btn btn-secondary">Back</a>
                    <a href="update.php?update=<?php echo $fetch_movies['id']; ?>" class="btn btn-success">Update</a>
                </div>
            </div>
        </div>
        
        <?php
                    }
                }
            }
        ?>        
    </div>
</section>
	  
<!-- Bootstrap JS -->
<script src="source/js/popper.min.js"></script>
<script src="source/js/jquery-3.4.1.slim.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js" ></script>
</body>
</html>