<?php
  $host = "localhost"; 
  $user = "root";
  $pass = "";
  $db_name = "db_buku_uas"; //nama database
  $conn = mysqli_connect($host,$user,$pass,$db_name); //pastikan urutan nya seperti ini, jangan tertukar

  if(!$conn){ //jika tidak terkoneksi maka akan tampil error
    die ("Connection Failed: ".mysql_connect_error());
  }
?>