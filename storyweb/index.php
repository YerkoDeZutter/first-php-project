<?php

include('config\db_connect.php');

$_sql = 'SELECT title, id FROM storys ORDER BY created_at';

$_result = mysqli_query($_conn, $_sql);

$_stories = mysqli_fetch_all($_result, MYSQLI_ASSOC);

// free the $_result from memory (good practise)
mysqli_free_result($_result);

// close connection
mysqli_close($_conn);

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

    <h1>My story</h1>

    <div class="container">
  		<div class="row">

        <?php foreach($_stories as $_story){ ?>

  				<div class="col s6 md3">
  					<div class="card z-depth-0">
  						<div class="card-content center">

  							<h6><?php echo $_story['title'] ?></h6>

  						</div>
  						<div class="card-action right-align">

  							<a class="brand-text" href="details.php?id=<?php echo $_story['id']; ?>">read</a>

  						</div>
  					</div>
  				</div>

        <?php } ?>

  		</div>
  	</div>

    <?php include('template/_footer.php'); ?>

  </body>
</html>
