<?php

// Load file koneksi.php
include 'connection.php';

if (isset($_POST['daftar'])) {
    // cek apakah semua ada valuesnya
    if (!empty($_POST['nrp']) && !empty($_POST['nama']) && !empty($_POST['jenis_kelamin']) && !empty($_POST['telp']) && !empty($_POST['alamat']) && !empty($_FILES['foto']['name'])) {
        // values are not empty, continue with the code
        $nrp = $_POST['nrp'];
        $nama = $_POST['nama'];
        $jenis_kelamin = $_POST['jenis_kelamin'];
        $telp = $_POST['telp'];
        $alamat = $_POST['alamat'];
        $foto = $_FILES['foto']['name'];
        $tmp = $_FILES['foto']['tmp_name'];

        $fotobaru = date('dmYHis').$foto;

        // Set path folder tempat menyimpan fotonya
        $path = 'images/'.$fotobaru;

        // Proses upload
        if (move_uploaded_file($tmp, $path)) { // Cek apakah gambar berhasil diupload atau tidak
            $query = "INSERT INTO siswa (nrp,nama,jenis_kelamin,telp,alamat,foto) VALUES('".$nrp."', '".$nama."', '".$jenis_kelamin."', '".$telp."', '".$alamat."', '".$fotobaru."')";
            $sql = mysqli_query($connect, $query); // Eksekusi/ Jalankan query dari variabel $query

            if ($sql) {
                header('location: index.php'); // Redirect ke halaman index.php
            } else {
                // Jika Gagal, Lakukan :
                echo 'Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.';
                echo "<br><a href='new_siswa.php'>Kembali Ke Form</a>";
            }
        } else {
            // Jika gambar gagal diupload, Lakukan :
            echo 'Maaf, Gambar gagal untuk diupload.';
            echo "<br><a href='new_siswa.php'>Kembali Ke Form</a>";
        }
    } else {
        // values are empty, display an error message
        echo 'Maaf, Harap isi semua field yang tersedia.';
        echo "<br><a href='new_siswa.php'>Kembali Ke Form</a>";
    }
} else {
    exit('Prohibited Access');
}
