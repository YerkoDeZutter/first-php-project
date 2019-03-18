<?php

$_conn = mysqli_connect('localhost', 'yerko321', 'pizza', 'my_story');

if(!$_conn){
  echo 'Connection error: '. mysqli_connect_error();
}

?>
