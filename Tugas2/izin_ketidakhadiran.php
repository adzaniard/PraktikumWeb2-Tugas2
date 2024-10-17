<?php
// Mengimpor file database.php untuk mengakses kelas database
require_once('database.php');

// Kelas IzinKetidakhadiran yang mewarisi kelas database
class IzinKetidakhadiran extends database {
    // Fungsi untuk menampilkan seluruh data dari tabel izin_ketidakhadiran_pegawai
    function tampilData()
    {
        // Menyusun query untuk mengambil seluruh data dari tabel
        $sql = "SELECT * FROM izin_ketidakhadiran_pegawai";
        
        // Menjalankan query menggunakan koneksi dari kelas induk ($this->koneksi)
        $data = $this->koneksi->query($sql);  
        
        // Array untuk menyimpan hasil dari query
        $hasil = [];
        
        // Mengecek apakah ada data yang ditemukan
        if ($data && mysqli_num_rows($data) > 0) {
            // Menyimpan setiap baris hasil query ke dalam array
            while ($row = mysqli_fetch_array($data)) {
                $hasil[] = $row;
            }
        }
        // Mengembalikan array hasil
        return $hasil;  
    }
}

// Kelas Disetujui yang mewarisi IzinKetidakhadiran, digunakan untuk mengambil data yang disetujui
class Disetujui extends IzinKetidakhadiran {
    // Fungsi untuk menampilkan data yang hanya memiliki status 'Disetujui'
    function tampilData()
    {
        // Menyusun query untuk mengambil data yang statusnya 'Disetujui'
        $sql = "SELECT * FROM izin_ketidakhadiran_pegawai where putusan = 'Disetujui'";
        
        // Menjalankan query menggunakan koneksi dari kelas induk ($this->koneksi)
        $data = $this->koneksi->query($sql);  
        
        // Array untuk menyimpan hasil dari query
        $hasil = [];
        
        // Mengecek apakah ada data yang ditemukan
        if ($data && mysqli_num_rows($data) > 0) {
            // Menyimpan setiap baris hasil query ke dalam array
            while ($row = mysqli_fetch_array($data)) {
                $hasil[] = $row;
            }
        }
        // Mengembalikan array hasil
        return $hasil;  
    }
}

// Kelas Ditunda yang mewarisi IzinKetidakhadiran, digunakan untuk mengambil data yang ditunda
class Ditunda extends IzinKetidakhadiran {
    // Fungsi untuk menampilkan data yang hanya memiliki status 'Ditunda'
    function tampilData()
    {
        // Menyusun query untuk mengambil data yang statusnya 'Ditunda'
        $sql = "SELECT * FROM izin_ketidakhadiran_pegawai where putusan = 'Ditunda'";
        
        // Menjalankan query menggunakan koneksi dari kelas induk ($this->koneksi)
        $data = $this->koneksi->query($sql);  
        
        // Array untuk menyimpan hasil dari query
        $hasil = [];
        
        // Mengecek apakah ada data yang ditemukan
        if ($data && mysqli_num_rows($data) > 0) {
            // Menyimpan setiap baris hasil query ke dalam array
            while ($row = mysqli_fetch_array($data)) {
                $hasil[] = $row;
            }
        }
        // Mengembalikan array hasil
        return $hasil;  
    }
}

// Kelas Ditolak yang mewarisi IzinKetidakhadiran, digunakan untuk mengambil data yang ditolak
class Ditolak extends IzinKetidakhadiran {
    // Fungsi untuk menampilkan data yang hanya memiliki status 'Ditolak'
    function tampilData()
    {
        // Menyusun query untuk mengambil data yang statusnya 'Ditolak'
        $sql = "SELECT * FROM izin_ketidakhadiran_pegawai where putusan = 'Ditolak'";
        
        // Menjalankan query menggunakan koneksi dari kelas induk ($this->koneksi)
        $data = $this->koneksi->query($sql);  
        
        // Array untuk menyimpan hasil dari query
        $hasil = [];
        
        // Mengecek apakah ada data yang ditemukan
        if ($data && mysqli_num_rows($data) > 0) {
            // Menyimpan setiap baris hasil query ke dalam array
            while ($row = mysqli_fetch_array($data)) {
                $hasil[] = $row;
            }
        }
        // Mengembalikan array hasil
        return $hasil;  
    }
}
?>
