<?php
// Memasukkan file izin_ketidakhadiran.php yang berisi kelas untuk data izin
require_once('izin_ketidakhadiran.php');

// Membuat objek dari kelas Ditolak dan mengambil data izin yang ditolak
$ditolak = new Ditolak();
$dataDitolak = $ditolak->tampilData();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Menambahkan Bootstrap untuk desain -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Data Izin Ditolak</title>
</head>

<body>
    <!-- Membuat navigasi sederhana menggunakan Bootstrap -->
    <nav class="navbar navbar-expand-lg bg-primary-subtle">
        <div class="container-fluid">
            <a class="navbar-brand fw-semibold">Sistem Izin Ketidakhadiran Pegawai</a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active fw-semibold" href="tampilALl.php">Data Izin</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle fw-semibold" href="#" role="button" data-bs-toggle="dropdown">Putusan</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="tampil_disetujui.php">Disetujui</a></li>
                            <li><a class="dropdown-item" href="tampil_ditunda.php">Ditunda</a></li>
                            <li><a class="dropdown-item" href="tampil_ditolak.php">Ditolak</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <!-- Menampilkan tabel data izin yang ditolak -->
    <div class="m-5">
        <h1 class="text-center">Data Izin Ketidakhadiran Pegawai</h1>
        <table class="table table-bordered border-secondary mt-4">
            <tr class="text-center align-middle table-primary border-secondary">
                <!-- Kolom tabel untuk setiap data izin -->
                <th>No</th>
                <th>ID Izin</th>
                <th>Keperluan</th>
                <th>ID Finger Print</th>
                <th>Tanggal Mulai Izin</th>
                <th>Durasi Izin Hari</th>
                <th>Durasi Izin Jam</th>
                <th>Durasi Izin Menit</th>
                <th>Nama Pengusul</th>
                <th>Tanggal Usul</th>
                <th>Tanda Tangan Pengusul</th>
                <th>Putusan</th>
                <th>Tanggal Ditolak</th>
                <th>Tanda Tangan Atasan</th>
                <th>Catatan</th>
                <th>Nama Dosen</th>
            </tr>

            <?php
            // Mengecek apakah data izin yang ditolak tersedia
            if (!empty($dataDitolak)) {
                $no = 1;
                foreach ($dataDitolak as $row) {
            ?>
                    <!-- Menampilkan setiap data izin dalam baris tabel -->
                    <tr class="align-middle">
                        <td class="text-center"><?php echo $no++; ?></td>
                        <td class="text-center"><?php echo $row['izin_id']; ?></td>
                        <td><?php echo $row['keperluan']; ?></td>
                        <td><?php echo $row['finger_print_id']; ?></td>
                        <td><?php echo $row['tgl_mulai_izin']; ?></td>
                        <td class="text-center"><?php echo $row['durasi_izin_hari']; ?></td>
                        <td class="text-center"><?php echo $row['durasi_izin_jam']; ?></td>
                        <td class="text-center"><?php echo $row['durasi_izin_menit']; ?></td>
                        <td><?php echo $row['nama_pengusul']; ?></td>
                        <td><?php echo $row['tgl_usul']; ?></td>
                        <td><?php echo $row['ttd_pengusul']; ?></td>
                        <td><?php echo $row['putusan']; ?></td>
                        <td><?php echo $row['tgl_disetujui']; ?></td>
                        <td><?php echo $row['ttd_atasan']; ?></td>
                        <td><?php echo $row['catatan']; ?></td>
                        <td><?php echo $row['nama_dosen']; ?></td>
                    </tr>
            <?php
                }
            } else {
                // Menampilkan pesan jika data kosong
                echo "<tr><td colspan='16' class='text-center'>Data kosong</td></tr>";
            }
            ?>
        </table>
    </div>
    
    <!-- Menambahkan JavaScript Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
