1. BIKIN DATABASE namanya `crud`
2. BIKIN TABLE m_siswa dengan kolom seperti berikut :
	- id ( auto increment )
	- angkatan
	- nama
	- nim
	- jurusan
3. Download file boostrap disini : [Download bootstrap](https://drive.google.com/file/d/1k0-4YSHzYGZWoSxYYzjQ6MP7flTNUxP_/view?usp=sharing)
4. Copy folder bootstrap yang di download tadi ke folder NAMA_PROJECT
- nama folder `NAMA_PROJECT` disesuaikan dengan keingan anda
Struktur Folder:
```
├── htdocs
│   ├── NAMA_PROJECT
│   ├── ├── css
│   ├── ├── fonts
│   ├── ├── img
│   ├── ├── js
└── └── └── index.php
```
5. Buat file `koneksi.php`
```php
<?php
// data server mysql
$db_host = 'localhost'; // --> sever mysql
$db_user = 'root';      // --> username
$db_pass = '';          // --> password
$db_name = 'crud';     // --> nama database
 
// Fungsi untuk koneksi ke mysqli
$koneksi = new mysqli($db_host,$db_user,$db_pass,$db_name);
 
// cok koneksi
if ($koneksi->connect_error) {
   // jika salah. Bisa juga menggunakan exit();
   die('Koneksi Gagal : '. $koneksi->connect_error).'';
}
?>
```
6. Buat file `index.php`
```html
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PROJECT KU</title>
    <!-- TABLE STYLES-->
    <link href="css/dataTables.bootstrap.css" rel="stylesheet" />
    <link href="css/bootstrap.css" rel="stylesheet" />
</head>
<body>
    <div class="col-md-8 col-md-offset-2">
        <br><br>
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="alert alert-warning">
                    <a href="data_add.php" class="btn btn-danger"><i class="glyphicon glyphicon-plus"></i> Tambah Data</a>
                </div>
            </div>
            <div class="panel-body">
                <div class="table">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Angkatan</th>
                                <th>Nama</th>
                                <th>NIP</th>
                                <th>Jurusan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include 'koneksi.php';
                            $no=0;
                            $result = mysqli_query($koneksi, "SELECT * FROM m_siswa ORDER BY nama ASC");
                            while($row = mysqli_fetch_assoc($result)) {
                                $no++
                                ?>
                                <tr class="">
                                    <td><?php echo $row['id'];?></td>
                                    <td><?php echo $row['angkatan'];?></td>
                                    <td><?php echo $row['nama'];?></td>
                                    <td><?php echo $row['nim'];?></td>
                                    <td><?php echo $row['jurusan'];?></td>
                                    <td>
                                        <a href="data_edit.php?id=<?php echo $row['id'];?>" class="btn btn-info btn-sm"><i class="glyphicon glyphicon-check"></i> Edit</a>
                                        <a href="javascript:;" data-id="<?php echo $row['id'] ?>" data-toggle="modal" data-target="#modal-konfirmasi" class="btn btn-warning btn-sm"><i class="glyphicon glyphicon-trash"></i> Hapus</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>  
        </div>
    </div>

    <!-- modal konfirmasi-->
    <div id="modal-konfirmasi" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Konfirmasi</h4>
                </div>
                <div class="modal-body btn-info">
                    Apakah Anda yakin ingin menghapus data ini ?
                </div>
                <div class="modal-footer">
                    <a href="javascript:;" class="btn btn-danger" id="hapus-true-data">Hapus</a>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
                </div>

            </div>
        </div>
    </div>
    <script src="js/jquery-1.10.2.js"></script>
    <!-- Bootstrap Js -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.dataTables.js"></script>
    <script src="js/hapus.js"></script>
    <script src="js/dataTables.bootstrap.js"></script>
    <script>
        $(document).ready(function () {
            $('#dataTables-example').dataTable();
        });
    </script>

</body>
</html>
```
7. Buat file `data_add.php`
```html
<!DOCTYPE html>
<html>
<head>
   <!-- TABLE STYLES-->
   <link href="css/dataTables.bootstrap.css" rel="stylesheet" />
   <link href="css/bootstrap.css" rel="stylesheet" />
</head>
<body>
    <div class="col-md-8 col-md-offset-2">
    <br><br>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <div class="alert alert-warning">
                <a href="index.php" class="btn btn-danger"><i class="glyphicon glyphicon-file"></i> Lihat Data</a>
            </div>
        </div>
        <div class="panel-body">
            <form method="post" action="data_add_s.php" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Angkatan</label>
                    <input class="form-control" name='angkatan' placeholder="Ini contoh input text dengan placeholder" required>
                </div>
                <div class="form-group">
                    <label>Nama</label>
                    <input class="form-control" name='nama' required>
                </div>
                <div class="form-group">
                    <label>NIM</label>
                    <input class="form-control" name='nim' required>
                </div>
                <div class="form-group">
                    <label>Jurusan</label>
                    <input class="form-control" name='jurusan' required>
                </div>
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                <button type="reset" class="btn btn-default"><i class="fa fa-file-text"></i> Bersih</button>
            </form>
        </div>  
    </div>
</div>
<script src="js/jquery-1.10.2.js"></script>
<!-- Bootstrap Js -->
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.dataTables.js"></script>
<script src="js/dataTables.bootstrap.js"></script>
<script>
    $(document).ready(function () {
        $('#dataTables-example').dataTable();
    });
</script>

</body>
</html>
```
8. Buat file `data_add_s.php`
```php
<?php
//meminta jembatan koneksi ke database
include "koneksi.php";
//menerima inputan
$angkatan       = $_POST['angkatan'];
$nama           = $_POST['nama'];
$nim            = $_POST['nim'];
$jurusan        = $_POST['jurusan'];

//pemerikasaan jika ada data inputan kosong
//sesuaikan dengan kebutuhan
if($angkatan=="" || $nama=="" || $nim=="" || $jurusan=="")
{
    ?>
    <script language="javascript">
        alert('Masih ada data yang kosong');
        document.location.href="data_add.php";
    </script>
    <?php
}
//input ke tabel db
else
{ //query simpan ke db
    $sql="INSERT INTO m_siswa VALUES (null, '$angkatan','$nama','$nim','$jurusan')";

    if($koneksi->query($sql) === false) { // Jika gagal meng-insert data tampilkan pesan dibawah 'Perintah SQL Salah'
    trigger_error('Perintah SQL Salah: ' . $sql . ' Error: ' . $koneksi->error, E_USER_ERROR);
    } else { // Jika berhasil alihkan ke halaman tampil.php
        ?>
        <script language="javascript">
            alert('Berhasil Disimpan');
            document.location.href="index.php";
        </script>
        <?php
    }
}?> <!--tutup php--->
```
9. Buat file `data_edit.php`
```html
<!DOCTYPE html>
<html>
<head>
 <!-- TABLE STYLES-->
 <link href="css/dataTables.bootstrap.css" rel="stylesheet" />
 <link href="css/bootstrap.css" rel="stylesheet" />
</head>
<body>
    <div class="col-md-8 col-md-offset-2">
    <br><br>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <div class="alert alert-warning">
                <a href="index.php" class="btn btn-danger"><i class="glyphicon glyphicon-file"></i> Lihat Data</a>
            </div>
        </div>
        <?php
        include 'koneksi.php';
        $id     = $_GET['id'];
        $result = mysqli_query($koneksi, "SELECT * FROM m_siswa WHERE id='$id'");
        $row = mysqli_fetch_assoc($result);
        ?>
        <div class="panel-body">
            <form method="post" action="data_edit_s.php" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Id</label>
                    <input class="form-control" name='id' value="<?php echo $row['id'];?>" readonly>
                </div>
                <div class="form-group">
                    <label>Angkatan</label>
                    <input class="form-control" name='angkatan' value="<?php echo $row['angkatan'];?>"  required>
                </div>
                <div class="form-group">
                    <label>Nama</label>
                    <input class="form-control" name='nama' value="<?php echo $row['nama'];?>"  required>
                </div>
                <div class="form-group">
                    <label>NIM</label>
                    <input class="form-control" name='nim' value="<?php echo $row['nim'];?>"  required>
                </div>
                <div class="form-group">
                    <label>Jurusan</label>
                    <input class="form-control" name='jurusan' value="<?php echo $row['jurusan'];?>"  required>
                </div>
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                <button type="reset" class="btn btn-default"><i class="fa fa-file-text"></i> Bersih</button>
            </form>
        </div>  
    </div>
</div>
<script src="js/jquery-1.10.2.js"></script>
<!-- Bootstrap Js -->
<script src="js/bootstrap.min.js"></script>

</body>
</html>
```
10. Buat file `data_edit_s.php`
```php
<?php
//meminta jembatan koneksi ke database
include "koneksi.php";
//menerima inputan
$id             = $_POST['id'];
$angkatan       = $_POST['angkatan'];
$nama           = $_POST['nama'];
$nim            = $_POST['nim'];
$jurusan        = $_POST['jurusan'];

//pemerikasaan jika ada data inputan kosong
//sesuaikan dengan kebutuhan
if($angkatan=="" || $nama=="" || $nim=="" || $jurusan=="")
{
    ?>
    <script language="javascript">
        alert('Masih ada data yang kosong');
        document.location.href="data_edit.php?id=<?echo $id; ?>";
    </script>
    <?php
}
//input ke tabel db
else
{ //query simpan ke db
    $sql="UPDATE m_siswa SET angkatan='$angkatan', nama='$nama', nim='$nim', jurusan='$jurusan' WHERE id='$id'";
    
    if($koneksi->query($sql) === false) { // Jika gagal meng-insert data tampilkan pesan dibawah 'Perintah SQL Salah'
    trigger_error('Perintah SQL Salah: ' . $sql . ' Error: ' . $koneksi->error, E_USER_ERROR);
    } else { // Jika berhasil alihkan ke halaman tampil.php
        ?>
        <script language="javascript">
            alert('Berhasil Disimpan');
            document.location.href="index.php";
        </script>
        <?php
    }
}?> <!--tutup php--->
```
11. Buat file `data_del.php`
```php
<?php
//HAPUS
include "koneksi.php";
$id     = $_GET['id'];
$result = mysqli_query($koneksi, "DELETE FROM m_siswa WHERE id = '$id'");
if ($result){ ?>
	<script language="javascript">
		alert('Berhasil Dihapus');
		document.location.href="index.php";
	</script>
	<?php
}else {
	trigger_error('Perintah SQL Salah: ' . $sql . ' Error: ' . $koneksi->error, E_USER_ERROR);
}
?>
```
12. FINAL Struktur Folder:
```
├── htdocs
│   ├── NAMA_PROJECT
│   ├── ├── css
│   ├── ├── fonts
│   ├── ├── img
│   ├── ├── js
│   ├── ├── data_add.php
│   ├── ├── data_add_s.php
│   ├── ├── data_del.php
│   ├── ├── data_edit.php
│   ├── ├── data_edit_s.php
│   ├── ├── index.php
└── └── └── koneksi.php
```
