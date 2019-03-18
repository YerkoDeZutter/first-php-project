<?php

include('config\db_connect.php');

$_email = $_title = $_story = '';
$_errors = ['email' => '', 'title' => '', 'story' => ''];

if(isset($_POST['submit'])){

  if(empty($_POST['email'])){
    $_errors['email'] = 'fill me in pleas';
  } else {
    $_email = $_POST['email'];
    if(!filter_var($_email, FILTER_VALIDATE_EMAIL)){
      $_errors['email'] = 'Email must be a valid email address';
    }
  }


  if(empty($_POST['title'])){
    $_errors['title'] = 'fill me in pleas';
  } else {
    $_title = $_POST['title'];
    if(!preg_match('/^[a-zA-Z\s]+$/', $_title)){
      $_errors['title'] = 'Email must be a valid email address';
    }
  }


  if(empty($_POST['story'])){
    $_errors['story'] = 'fill me in pleas';
  } else {
    $_story = $_POST['story'];
  }


  if(array_filter($_errors)){
    //echo 'errors in form';
  } else {

    $_email = mysqli_real_escape_string($_conn, $_POST['email']);
    $_title = mysqli_real_escape_string($_conn, $_POST['title']);
    $_story = mysqli_real_escape_string($_conn, $_POST['story']);

    $_sql = "INSERT INTO storys(title,email,story) VALUES('$_title','$_email','$_story')";

    if(mysqli_query($_conn, $_sql)){
      // success
      header('Location: index.php');
    } else {
      echo 'query error: '. mysqli_error($_conn);
    }
  }

}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>my story</title>
  </head>
  <body>

    <?php include('template/_header.php'); ?>

    <section class="container grey-text">
  		<h1>Add My story</h1>
  		<form class="white" action="add.php" method="POST">
  			<label>Your Email</label>
        <div class="red-text"><?php echo $_errors['email'] ?></div>
  			<input type="text" name="email" value="<?php echo htmlspecialchars($_email) ?>">
  			<label>Story Title</label>
				<div class="red-text"><?php echo $_errors['title'] ?></div>
  			<input type="text" name="title" value="<?php echo htmlspecialchars($_title) ?>">
  			<label>Story</label>
				<div class="red-text"><?php echo $_errors['story'] ?></div>
  			<textarea  type="text" name="story" cols="40" rows="5" value="<?php echo htmlspecialchars($_story) ?>"></textarea> 
  			<div class="center">
  				<input type="submit" name="submit" value="Submit" class="btn brand z-depth-0">
  			</div>
  		</form>
  	</section>

    <?php include('template/_footer.php'); ?>

  </body>
</html>
