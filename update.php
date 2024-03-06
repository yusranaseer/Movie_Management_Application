<?php 
session_start();
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'movie_management';
$conn = mysqli_connect('localhost', 'root', '', 'movie_management') or die('connection failed');

if(isset($_POST['update_movie'])){
    $update_p_id = $_POST['update_p_id'];
    $update_name = $_POST['update_name'];
    $update_genre = $_POST['update_genre'];
    $update_date = $_POST['update_date'];
    $update_actor = $_POST['update_actor'];
    $update_director = $_POST['update_director'];

    if($update_name == null || $update_genre == null || $update_date == null || $update_actor == null || $update_director == null){
        $message[] = 'Empty Field!!!';
    }
    else{
        mysqli_query($conn, "UPDATE movie SET name ='$update_name', genre ='$update_genre', date ='$update_date', actor ='$update_actor', director ='$update_director' WHERE id = '$update_p_id'");
    }

     //image
     $v1=rand(1,9);
     $v2=rand(1,9);
 
     $v3=$v1.$v2;
 
     $fnm=$_FILES["update_image"]["name"];
     $dst="uploarded_img/".$v3.$fnm;
     //end image

    $update_image = $_FILES['update_image']['name'];
    $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
    $update_image_size = $_FILES['update_image']['size'];
    $update_folder =  $dst;

    if(!empty($update_image)){
        if($update_image_size > 2000000){
            $message[] = 'image size is too large';            
        }else{
            move_uploaded_file($_FILES["update_image"]["tmp_name"],$dst);
            mysqli_query($conn, "UPDATE movie SET image ='$dst' WHERE id = '$update_p_id'");
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
        <div class="shadow-2 margin-4">
            <form action="" method="POST" enctype="multipart/form-data">
            <?php
        if(isset($_GET['update'])){
            $update_id = $_GET['update'];
            $select_update = "SELECT * FROM movie WHERE id = '$update_id'";
            $update_query = mysqli_query($conn, $select_update);
            if(mysqli_num_rows($update_query) > 0){
                while($fetch_update = mysqli_fetch_assoc($update_query)){                
            
    ?>
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="update_p_id" value="<?php echo $fetch_update['id']; ?>">
        <div class="update_img"><img src="uploarded_img/<?php echo $fetch_update['image']; ?>" alt=""></div>
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="update_name" value="<?php echo $fetch_update['name']; ?>" class="form-control" required placeholder="enter the movie title">
        </div>
        <div class="form-group">
            <label for="title">Genre</label>
            <input type="text" name="update_genre" value="<?php echo $fetch_update['genre']; ?>" min="0" class="form-control" required placeholder="enter the genre">
        </div>
        <div class="form-group">
            <label for="date">Release date</label>
            <input type="date" name="update_date" value="<?php echo $fetch_update['date']; ?>" min="0" class="form-control" required placeholder="enter release date">
        </div>
        <div class="form-group">
            <label for="actor">Lead Actor</label>
            <input type="text" name="update_actor" value="<?php echo $fetch_update['actor']; ?>" min="0" class="form-control" required placeholder="ente the actor">
        </div>
        <div class="form-group">
            <label for="director">Director</label>
            <input type="text" name="update_director" value="<?php echo $fetch_update['director']; ?>" min="0" class="form-control" required placeholder="enter the director">
        </div>
        <div class="form-group">
            <input type="file" class="box" name="update_image" accept="image/jpg, image/jpeg, image/png" >
        </div>
        
        <input type="submit" value="update" name="update_movie" class="btn btn-success">
        <input type="reset" value="cancel" id="close-update" class="btn btn-warning" onclick="window.location.href = 'index.php';">
    </form>
    <?php
                }
            }
        }
    ?>
            </form>
        </div>       
    </div>
</section>

<!-- custom admin js file link -->
<script src="source/js/admin_script.js"></script>
	  
<!-- Bootstrap JS -->
<script src="source/js/popper.min.js"></script>
<script src="source/js/jquery-3.4.1.slim.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js" ></script>
</body>
</html>
