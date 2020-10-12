<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <title>CRUD Mahasiswa</title>
  </head>
  <body style=" margin: 10px;">
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container">
            <a href="tampil_data.php" class="navbar-brand">
            Rayhan
            </a>
            <button class="navbar-toggler"
            type="button"
            data-toggle="collapse"
            data-target="#navb">
            <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navb">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item mx-md-2">
                        <a href="tampil_data.php" class="nav-link active">Home</a>
                    </li>
                    <li class="nav-item mx-md-2">
                        <a href="tambah.php" class="nav-link">Tambah</a>
                    </li>
                </ul>
            </div>
      </div>
  </nav>

  <h2 class="text-center">Daftar Data Mahasiswa</h2>
  <hr >
<table class="table table-striped table-bordered" >
  <thead class="thead-dark">
    <tr class="text-center">
      <th scope="col">ID</th>
      <th scope="col">NIM</th>
      <th scope="col">Nama</th>
      <th scope="col">Jenis Kelamin</th>
      <th scope="col">Agama</th>
      <th scope="col">Olahraga Favorit</th>
      <th scope="col">Foto Profil</th>
      <th scope="col" colspan="2">Aksi</th>
    </tr>
  </thead>
  <tbody>
  <?php
  include "koneksi.php";
  $r=mysqli_query($kon,"SELECT * FROM mahasiswa");
  $i=1;
  while($brs=mysqli_fetch_assoc($r)) {
      echo '<tr>
              <td>'.$i++.'</td>
              <td>'.$brs["nim"].'</td>
              <td>'.$brs["nama"].'</td>
              <td>'.$brs["jenis_kelamin"].'</td>
              <td>'.$brs["agama"].'</td>
              <td>'.$brs["olahraga"].'</td>
              <td><img src="file/'.$brs["nama_file"].'" width="70px"></td>
              <td>
              <a href="edit.php?id='.$brs["id"].'" class="badge badge-warning">Edit</a>
              <a href="delete.php?id='.$brs["id"].'" class="badge badge-danger" onclick="return confirm(\'Yakin ingin menghapus data ini?\')">Delete</a>
              </td>
          </tr>';
  }
?>
  </tbody>  
</table>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  </body>
</html>