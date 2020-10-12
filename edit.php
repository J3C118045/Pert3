<?php include('koneksi.php'); ?>

<?php
		//jika sudah mendapatkan parameter GET id dari URL
		if (isset($_GET['id'])) {
			//membuat variabel $id untuk menyimpan id dari GET id di URL
			$id = $_GET['id'];

			//query ke database SELECT tabel mahasiswa berdasarkan id = $id
			$select = mysqli_query($kon, "SELECT * FROM mahasiswa WHERE id='$id'") or die(mysqli_error($koneksi));

			//jika hasil query = 0 maka muncul pesan error
			if (mysqli_num_rows($select) == 0) {
				echo '<div class="alert alert-warning">ID tidak ada dalam database.</div>';
				exit();
				//jika hasil query > 0
			} else {
				//membuat variabel $data dan menyimpan data row dari query
				$data = mysqli_fetch_assoc($select);
            }
            $dataolah=explode(', ', $data['olahraga']);
        }
?>
<!DOCTYPE html>
<html>

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    

	<title>Edit Data Mahasiswa</title>
</head>

<body>
<nav class="row navbar navbar-expand-lg navbar-light bg-light">
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
                        <a href="tampil_data.php" class="nav-link">Home</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

	<div class="container" style="margin-top:20px">
		<h2 class="text-center">Edit Mahasiswa</h2>

		<hr>

		<?php
		//jika tombol simpan di tekan/klik
		if (isset($_POST['submit'])) {
            $nim                        = $_POST['nim'];
			$nama			            = $_POST['nama'];
			$jenis_kelamin	            = $_POST['jenis_kelamin'];
			$agama			            = $_POST['agama'];
            $olahraga		            = implode(", ", $_POST['olahraga']);
            $ekstensi_diperbolehkan     = array('png', 'jpg');
            $file_nama                  = $_FILES['file']['name'];
            $x                          = explode('.', $file_nama);
            $ekstensi                   = strtolower(end($x));
            $ukuran                     = $_FILES['file']['size'];
            $file_tmp                   = $_FILES['file']['tmp_name'];

			if($file_nama != ""){
                if (in_array($ekstensi, $ekstensi_diperbolehkan) == true) {
                    if ($ukuran < 1044070) {
                        move_uploaded_file($file_tmp, 'file/' . $file_nama);
                        $sql = mysqli_query($kon, "UPDATE mahasiswa SET nama='$nama', jenis_kelamin='$jenis_kelamin', agama='$agama', olahraga='$olahraga', nama_file='$file_nama' WHERE id='$id'") or die(mysqli_error($koneksi));
                        if ($sql) {
                            echo '<script>alert("Berhasil mengubah data."); document.location="tampil_data.php";</script>';
                        } else {
                            echo '<div class="alert alert-warning">Gagal melakukan proses ubah data.</div>';
                        }
                    } else {
                        echo '<div class="alert alert-warning">UKURAN FILE TERLALU BESAR</div>';
                    }
                } else {
                    echo '<div class="alert alert-warning">EKSTENSI FILE YANG DI UPLOAD TIDAK DI PERBOLEHKAN</div>';
                }
            }else{
                $sql = mysqli_query($kon, "UPDATE mahasiswa SET nama='$nama', jenis_kelamin='$jenis_kelamin', agama='$agama', olahraga='$olahraga' WHERE id='$id'") or die(mysqli_error($koneksi));
                if ($sql) {
                    echo '<script>alert("Berhasil mengubah data."); document.location="tampil_data.php";</script>';
                } else {
                    echo '<div class="alert alert-warning">Gagal melakukan proses ubah data.</div>';
                }
            }
        }
		?>

<form action="edit.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">NIM</label>
				<div class="col-sm-10">
					<input type="text" name="nim" class="form-control" size="4" value="<?php echo $data['nim']; ?>" readonly required>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Nama Mahasiswa</label>
				<div class="col-sm-10">
					<input type="text" name="nama" class="form-control" value="<?php echo $data['nama']; ?>" required>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Jenis Kelamin</label>
				<div class="col-sm-10">
					<div class="form-check">
						<input type="radio" class="form-check-input" name="jenis_kelamin" value="Laki-laki" <?php if ($data['jenis_kelamin'] == 'Laki-laki') {
																												echo 'checked';
																											} ?> required>
						<label class="form-check-label">Laki-laki</label>
					</div>
					<div class="form-check">
						<input type="radio" class="form-check-input" name="jenis_kelamin" value="Perempuan" <?php if ($data['jenis_kelamin'] == 'Perempuan') {
																												echo 'checked';
																											} ?> required>
						<label class="form-check-label">Perempuan</label>
					</div>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Agama</label>
				<div class="col-sm-10">
					<?php $agama = $data["agama"];?>
					<select class="form-control" name="agama">
						<option value="Islam" <?php echo ($agama == 'Islam') ? "selected": ""?>>Islam</option>
						<option value="Protestan" <?php echo ($agama == 'Protestan') ? "selected": ""?>>Protestan</option>
						<option value="Katolik" <?php echo ($agama == 'Katolik') ? "selected": ""?>>Katolik</option>
						<option value="Hindu" <?php echo ($agama == 'Hindu') ? "selected": ""?>>Hindu</option>
						<option value="Buddha" <?php echo ($agama == 'Buddha') ? "selected": ""?>>Buddha</option>
						<option value="Konghucu" <?php echo ($agama == 'Konghucu') ? "selected": ""?>>Konghucu</option>
					</select>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Olahraga</label>
				<div class="col-sm-10">
					<?php $olahraga = $data["olahraga"];?>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="olahraga[]" value="Badminton"
                        <?php if (in_array("Badminton", $dataolah)) echo "checked";?>>
                        <label class="form-check-label">
                            Badminton
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="olahraga[]" value="Futsal"
                        <?php if (in_array("Futsal", $dataolah)) echo "checked";?>>
                        <label class="form-check-label">
                            Futsal
                        </label>
                    </div>
					<div class="form-check">
                        <input class="form-check-input" type="checkbox" name="olahraga[]" value="Sepak Bola"
                        <?php if (in_array("Sepak Bola", $dataolah)) echo "checked";?>>
                        <label class="form-check-label">
                            Sepeda
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="olahraga[]" value="Basket"
                        <?php if (in_array("Basket", $dataolah)) echo "checked";?>>
                        <label class="form-check-label">
                            Basket
                        </label>
                    </div>
                    
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="olahraga[]" value="Renang"
                        <?php if (in_array("Renang", $dataolah)) echo "checked";?>>
                        <label class="form-check-label">
                            Renang
                        </label>
                    </div>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Foto</label>
				<div class="col-sm-10">
					<input type="file" name="file">
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">&nbsp;</label>
				<div class="col-sm-10">
					<input type="submit" name="submit" class="btn btn-primary" value="SIMPAN">
					<a href="tampil_data.php" class="btn btn-warning">KEMBALI</a>
				</div>
			</div>
		</form>

	</div>

	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

</body>

</html>