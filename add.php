<?php 
session_start();
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'movie_management';
$conn = mysqli_connect('localhost', 'root', '', 'movie_management') or die('connection failed');

if(isset($_POST['add_movie'])){
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $genre =  $_POST['genre'];
    $date =  $_POST['date'];
    $actor =  $_POST['actor'];
    $director =  $_POST['director'];

    $image_size =  $_FILES['image']['size'];
    //image
    $v1=rand(1,9);
    $v2=rand(1,9);

    $v3=$v1.$v2;

    $fnm=$_FILES["image"]["name"];
    $dst="uploarded_img/".$v3.$fnm;
    move_uploaded_file($_FILES["image"]["tmp_name"],$dst);
    //end image


    if($name == null || $genre == null || $date == null || $actor == null || $director == null || $fnm == null){
        $message[] = 'Empty Fields!!!';
    }
    else{
        $query = "SELECT name FROM movie WHERE name = '$name'";
        $select_movie_name = mysqli_query($conn, $query);

        if(mysqli_num_rows($select_movie_name) > 0){
            $message[] = 'movie name already added';
        }else{
            $add_movie_query = "INSERT INTO movie(name, genre, image, date, actor, director) VALUES('$name', '$genre', '$dst', '$date', '$actor', '$director')";
            mysqli_query($conn, $add_movie_query); 
        }
    }

    header('location:index.php');
}

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
    <button type="button " class="btn btn-secondary" onclick="window.location.href = 'index.php';">Back</button>
        <div class="shadow-2 margin-4">
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="name" class="form-control" id="title" placeholder="Enter the movie title" required>
                </div>
                <div class="form-group">
                    <label for="genre">Genre</label>
                    <input type="text" name="genre" class="form-control" id="genre" placeholder="Enter the movie genre" required>
                </div>
                <div class="form-group">
                    <label for="date">Release Date</label>
                    <input type="date" name="date" class="form-control" id="date" placeholder="Enter the release date" required>
                </div>
                <div class="form-group">
                    <label for="actor">Leade Actor</label>
                    <input type="text" name="actor" class="form-control" id="actor" placeholder="Enter the leade actor name" required>
                </div> 
                <div class="form-group">
                    <label for="director">Diretor</label>
                    <input type="text" name="director" class="form-control" id="director" placeholder="Enter the director name" required>
                </div>
                <div class="form-group">
                    <label for="image">Select movie image</label>
                    <input type="file" name="image" id="image" accept="image/jpg, image/jpeg, image/png" class="form-control" required>
                </div>   
                <input type="submit" value="Add" name="add_movie" class="btn btn-primary">             
            </form>
        </div>       
    </div>
</section>
	  
<!-- Bootstrap JS -->
<script src="source/js/popper.min.js"></script>
<script src="source/js/jquery-3.4.1.slim.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js" ></script>
</body>
</html>
