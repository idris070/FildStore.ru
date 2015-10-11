<?php
  if($_GET[action]==del_img){
    include 'bd.php';
    $id = $_GET[id];
    $img = $_GET[img];
    $name = mysql_query ("SELECT * FROM tovar WHERE id=$id ");
    $name = mysql_fetch_array($name);
    mysql_query ("UPDATE `tovar` SET $img='' WHERE id=$id");
    unlink("img_tovar/$name[$img]");
  }

  if($_GET[action]==buy){
    echo $id[name];
  }

  if($_GET[action]==buy_2){
    include "buy_2.php";
  }

  if($_GET[action]==buy_3){
    include 'buy_3.php';
  }


?>
