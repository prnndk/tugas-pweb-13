<?php

include 'connection.php';

$nrp = $_GET['nrp'];

$query = "SELECT * FROM siswa WHERE nrp='".$nrp."'";
$sql = mysqli_query($connect, $query);
$data = mysqli_fetch_array($sql);

if (is_file('images/'.$data['foto'])) {
    unlink('images/'.$data['foto']);
}

$query2 = "DELETE FROM siswa WHERE nrp='".$nrp."'";
$sql2 = mysqli_query($connect, $query2);

if ($sql2) {
    header('location: index.php');
} else {
    echo "Data gagal dihapus. <a href='index.php'>Kembali</a>";
}
