<?php

include('config/db_connect.php');

if(isset($_POST['delete'])){

  $_id_to_delete = mysqli_real_escape_string($_conn, $_POST['id_to_delete']);

  $_sql = "DELETE FROM storys WHERE id = $_id_to_delete";

  if(mysqli_query($_conn, $_sql)){
    header('Location: index.php');
  } else {
    echo "ERROR!!! ERROR!!!";
  }

}

if(isset($_GET['id'])){

  $_id = mysqli_real_escape_string($_conn, $_GET['id']);

  $_sql = "SELECT * FROM storys WHERE id = $_id";

  $_result = mysqli_query($_conn, $_sql);

  $_story = mysqli_fetch_assoc($_result);

  // free the $_result from memory (good practise)
	mysqli_free_result($_result);

  // close connection
	mysqli_close($_conn);

}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>details</title>
  </head>
  <body>

    <?php include('template/_header.php'); ?>

    <div class="container">

    <?php if($_story): ?>

      <h1><?php echo htmlspecialchars($_story['title']) ?></h1>
      <p><?php echo htmlspecialchars($_story['created_at']) ?></p>
      <h3>story:</h3>

      <ul>
        <?php foreach (explode(',', $_story['story']) as $_ing): ?>
          <li><?php echo $_ing; ?></li>
        <?php endforeach; ?>
      </ul>

      <!-- DELETE FORM -->
			<form action="details.php" method="POST">
				<input type="hidden" name="id_to_delete" value="<?php echo $_story['id']; ?>">
				<input type="submit" name="delete" value="Delete" class="btn brand z-depth-0">
			</form>

    <?php endif; ?>

    </div>

    <?php include('template/_footer.php'); ?>

  </body>
</html>
