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