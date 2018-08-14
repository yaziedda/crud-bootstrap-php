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