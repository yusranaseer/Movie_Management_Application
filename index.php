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
        <div class="btn-plcce">
            <button type="button" class="btn btn-primary" onclick="window.location.href = 'add.php';">Add Movie</button>
        </div>
        <div class="row text-center">
            <?php
            $query_img = "SELECT * FROM movie";
            $select_movies = mysqli_query($conn, $query_img);
            if(mysqli_num_rows($select_movies) > 0){
                while($fetch_movies = mysqli_fetch_assoc($select_movies)){                      
            ?>
            <div class="col-md-4">
                <div class="shadow-1 margin-4">
                    <img class="img-fluid" src="uploarded_img/<?php echo $fetch_movies['image']; ?>" alt="">
                    <div class="detail"><strong><?php echo $fetch_movies['name']; ?></strong></div>
                    <a href="view.php?view=<?php echo $fetch_movies['id']; ?>" class="btn btn-warning">View Details</a>
                    
                </div>
            </div>
            <?php
            }
                }else{
                    echo '<p class="shadow-1">No movies added yet!</p>';
                }  
        ?>                      
        </div>
    </div>
</section>
	  
<!-- Bootstrap JS -->
<script src="source/js/popper.min.js"></script>
<script src="source/js/jquery-3.4.1.slim.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js" ></script>
</body>
</html>