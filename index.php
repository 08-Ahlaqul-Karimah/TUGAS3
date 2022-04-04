<?php
//koneksi database
$server = "localhost";
$user ="root";	
$pass = ""	;									
$database = "imaa";
$koneksi= mysqli_connect($server,$user,$pass,$database) or die(mysqli_error($koneksi));


	//jika tombol submit diklik
if (isset($_POST['submit']))
{
if($_GET['hal']=='edit')
{
	$edit = mysqli_query($koneksi , "UPDATE tbl_008 SET 
									 Nama= '$_POST[nama_mhs]',
									 Nim= '$_POST[NIM_mhs]',
									 Alamat= '$_POST[alamat_mhs]',
									 ProgramStudi= '$_POST[prodi_mhs]'
									 WHERE No = '$_GET[id]'
											");
if($edit)//jika sukses
{
	echo "<script>
		alert('edit data sukses');
		document.location='index.php';
		</script>";
}
//jika gagal
else{
	echo "<script>
		alert('edit data gagal');
		document.location='index.php';
		</script>";
}   
}else
{
	$submit = mysqli_query($koneksi , "INSERT INTO tbl_008 (nama_mhs,NIM_mhs,alamat_mhs,prodi_mhs)
	Values ('$_POST[nama]',
			'$_POST[nim]',
			'$_POST[alamat]',
			'$_POST[prodi]')
		");
if($submit)
{
	echo "<script>
		alert('simpan data sukses');
		document.location='index.php';
		</script>";
}
else{
	echo "<script>
		alert('simpan data gagal');
		document.location='index.php';
		</script>";
}
}

}
if (isset($_GET['hal']))
{
if($_GET['hal']=='edit')
{
//pengujian data yang akan diedit
$tampil=mysqli_query($koneksi," SELECT *FROM tbl_008 WHERE No = '$_GET[id]'");
$data=mysqli_fetch_array($tampil);
if($data){
	$vnama = $data['nama'];
	$vnim = $data['nim'];
	$valamat = $data['alamat'];
	$vprodi = $data['Prodi'];
}
}
}
//pengujian edit
if (isset($_GET['hal']))
{
	if($_GET['hal']=='edit')
	{
	//pengujian data yang akan diedit
	$tampil=mysqli_query($koneksi," SELECT *FROM tbl_008 WHERE No = '$_GET[id]'");
	$data=mysqli_fetch_array($tampil);
	if($data){
		$vnama = $data['nama'];
		$vnim = $data['nim'];
		$valamat = $data['alamat'];
		$vprodi = $data['prodi'];
	}
	}else if ($_GET['hal']=='hapus'){
		$hapus= mysqli_query($koneksi, "DELETE from tbl_008 where id_mhs = '$_GET[id]'");
		if($hapus){
			echo "<script>
			alert('Hapus data sukses');
			document.location='index.php';
			</script>";
		}
	}
}
?>




<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>tugas 3 CRUD</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="fontawesome/css/all.min.css">
</head>
<body>
        <div class="container">
        <h1> TABLE INPUT MAHASISWA</h1>
	<!-- awal card-->
	<div class="card margin-left">
		<div class="card-header bg-dark text-white">
		 form input data mahasiswa
		</div>
		<div class="card-body">
			<form method="post" action="">
			<div class="form-group mb-3">
				<label>NAMA</label>
				<input type="text" name="nama" class="form-control" placeholder="masukkan nama anda" required>
			</div>
			<div class="form-group mb-3">
				<label>NIM</label>
				<input type="text" name="nim" class="form-control" placeholder="masukkan nim anda" required>
			</div>
			<div class="form-group mb-3">
				<label>ALAMAT</label>
				<textarea name ="alamat" class="form-control" placeholder="masukkan alamat anda" required></textarea>
			</div>
			<div class="form-group mb-3" ></div>
			<label>PROGRAM STUDY</label>
			<select class="form-control mb-3" name="prodi" required>
				<option></option>
				<option value="S1 Teknik Informatika">Teknik Informatika</option>
				<option value="S1 Sistem Informasi">Sistem Informasi</option>
                <option value="S2 Sistem Informasi">Sistem Informasi</option>
                <option value="S2 Sistem Informasi">Sistem Informasi</option>
			</select>
			<button type="submit" class="btn btn-dark" name="submit">submit</button>
			<button type="reset" class="btn btn-secondary" name="reset">reset</button>
			</div>
			</form>
		</div>
	  </div>
    </div>
    <div class="container">
	  <!--akhir card-->

	  <!--awal tabel-->
	  <div class="card">
		<div class="card-header bg-dark text-white">
		  Data mahasiswa
		</div>
		<div class="card-body" >
		 <table class="table table-bordered table-striped">
			 <tr>
				 <th>No</th>
				 <th>Nama</th>
				 <th>NIM</th>
				 <th>Alamat</th>
				 <th>Program Studi</th>
				 <th>Aksi</th>
			 </tr>
			 <?php
			 $No = 1;
			 $tampil = mysqli_query($koneksi, "SELECT * from tbl_008 order by id_mhs desc");
			 while($data = mysqli_fetch_array($tampil)):
			 ?>
			 <tr>
				 <td><?=$No++;?></td>
				 <td><?=$data['nama_mhs']?></td>
				 <td><?=$data['NIM_mhs']?></td>
				 <td><?=$data['alamat_mhs']?></td>
				 <td><?=$data['prodi_mhs']?></td>
				 <td>
					 <a href="index.php?hal=edit&id=<?=$data['No']?>" class="btn btn-dark" >tambah data</a>&nbsp;&nbsp;
					 <a href="index.php?hal=hapus&id=<?=$data['No']?>" class="btn btn-secondary" >hapus data</a>
					 
				 </td>
				 </td>
				 
			 </tr>
			 <?php // penutup perulangan while
			 endwhile;

			 ?>
			 </table>
		</div>
	  </div>
      </div>
	  <!--akhir tabel-->
<script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>
</html>