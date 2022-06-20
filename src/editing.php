<?php
// memanggil file koneksi.php untuk melakukan koneksi database
include 'conn.php';

	// membuat variabel untuk menampung data dari form
  $id               = $_POST['id'];
  $book_name        = $_POST['book_name'];
  $book_description = $_POST['book_description'];
  $book_author      = $_POST['book_author'];
  $book_price       = $_POST['book_price'];
  $book_picture     = $_FILES['book_picture']['name'];
  //cek dulu jika merubah gambar produk jalankan coding ini
  if($book_picture != "") {
    $file_extension = array('png','jpg'); //ekstensi file gambar yang bisa diupload 
    $x = explode('.', $book_picture); //memisahkan nama file dengan ekstensi yang diupload
    $extension = strtolower(end($x));
    $file_tmp = $_FILES['book_picture']['tmp_name'];   
    $random_number   = rand(1,999);
    $new_image_name = $random_number.'-'.$book_picture; //menggabungkan angka acak dengan nama file sebenarnya
    if(in_array($extension, $file_extension) === true)  {
                  move_uploaded_file($file_tmp, 'img/'.$new_image_name); //memindah file gambar ke folder gambar
                      
                    // jalankan query UPDATE berdasarkan ID yang produknya kita edit
                   $query  = "UPDATE books SET book_name = '$book_name', book_description = '$book_description', book_author = '$book_author', book_price = '$book_price', book_picture = '$new_image_name'";
                    $query .= "WHERE id = '$id'";
                    $result = mysqli_query($conn, $query);
                    // periska query apakah ada error
                    if(!$result){
                        die ("Query gagal dijalankan: ".mysqli_errno($conn).
                             " - ".mysqli_error($conn));
                    } else {
                      //tampil alert dan akan redirect ke halaman index.php
                      //silahkan ganti index.php sesuai halaman yang akan dituju
                      echo "<script>alert('Data berhasil diubah.');window.location='index.php';</script>";
                    }
              } else {     
               //jika file ekstensi tidak jpg dan png maka alert ini yang tampil
                  echo "<script>alert('Ekstensi gambar yang boleh hanya jpg atau png.');window.location='tambah_produk.php';</script>";
              }
    } else {
      // jalankan query UPDATE berdasarkan ID yang produknya kita edit
      $query  = "UPDATE books SET book_name = '$book_name', book_description = '$book_description', book_author = '$book_author', book_price = '$book_price'";
      $query .= "WHERE id = '$id'";
      $result = mysqli_query($conn, $query);
      // periska query apakah ada error
      if(!$result){
            die ("Query gagal dijalankan: ".mysqli_errno($conn).
                             " - ".mysqli_error($conn));
      } else {
        //tampil alert dan akan redirect ke halaman index.php
        //silahkan ganti index.php sesuai halaman yang akan dituju
          echo "<script>alert('Data berhasil diubah.');window.location='index.php';</script>";
      }
    }
