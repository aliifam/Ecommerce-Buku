<?php
  include('conn.php'); //agar index terhubung dengan database, maka koneksi sebagai penghubung harus di include
  
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Katalog Toko Buku</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
  </head>
  <body>


  <div class="container my-12 mx-auto px-4 md:px-12">
    <div class="bg-gradient-to-tr from-sky-400 via-purple-600 to-purple-700 shadow-2xl rounded-lg mx-auto text-center py-12 mt-4">
          <h2 class="text-3xl leading-9 font-bold tracking-tight text-white sm:text-4xl sm:leading-10">
              Katalog Toko Buku TRPL
          </h2>
          <div class="mt-8 flex justify-center">
              <div class="inline-flex rounded-md bg-white shadow">
                  <a href="add_book.php" class="text-gray-700 font-bold py-2 px-6">
                      Add Book +
                  </a>
              </div>
          </div>
      </div>
    <div class="flex flex-wrap -mx-1 lg:-mx-4">
      <?php
        // jalankan query untuk menampilkan semua data diurutkan berdasarkan nim
        $query = "SELECT * FROM books ORDER BY id ASC";
        $result = mysqli_query($conn, $query);
        //mengecek apakah ada error ketika menjalankan query
        if(!$result){
          die ("Query Error: ".mysqli_errno($conn).
            " - ".mysqli_error($conn));
        }

        //buat perulangan untuk element tabel dari data mahasiswa
        $no = 1; //variabel untuk membuat nomor urut
        // hasil query akan disimpan dalam variabel $data dalam bentuk array
        // kemudian dicetak dengan perulangan while
        while($row = mysqli_fetch_assoc($result))
        {
        ?>

        <!-- Column -->
        <div class="my-1 px-1 w-full md:w-1/2 lg:my-4 lg:px-4 lg:w-1/3">

            <!-- Article -->
            <article class="overflow-hidden rounded-lg shadow-lg">

                
                <img src="img/<?php echo $row['book_picture']; ?>" alt="<?php echo $row['book_name']; ?>" class="block h-auto w-full">
                
                <div class="p-2 md:p-4">
                  <p class="text-xl text-blue-700 font-semibold">Rp <?php echo number_format($row['book_price'],0,',','.'); ?></p>
                  
                  <p class="text-2xl font-bold"><?php echo $row['book_name']; ?></p>
                  <p class="italic font-semibold">Penulis : <?php echo $row['book_author']; ?></p>
                  <p><?php echo substr($row['book_description'], 0, 200); ?>.</p>
                </div>
                

                <footer class="flex items-center justify-between leading-none p-2 md:p-4">
                    <a href="edit_book.php?id=<?php echo $row['id']; ?>" class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
                        Edit
                    </a>
                    <a href="delete_book.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Anda yakin akan menghapus buku ini?')" class="inline-block px-6 py-2.5 bg-red-600 text-white font-medium text-xs leading-tight rounded shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-red-800 active:shadow-lg transition duration-150 ease-in-out">
                        Delete
                    </a>
                </footer>

            </article>
            <!-- END Article -->

        </div>
        <!-- END Column -->
        <?php
        $no++; //untuk nomor urut terus bertambah 1
      }
      ?>

      </div>
    </div>
  </body>
</html>