<?php
// Deklarasi kelas database
class database
{
    // Deklarasi Atribut atau Properties untuk menyimpan informasi koneksi ke database
    private $host = 'localhost'; // Nama host database
    private $username = 'root'; // Username untuk login ke database
    private $password = ''; // Password untuk login ke database, kosong untuk default
    private $database = 'perizinan'; // Nama database yang akan digunakan

    // Properti untuk menyimpan koneksi database
    protected $koneksi;

    // Membuat koneksi ke database menggunakan fungsi mysqli_connect
    function __construct()
    {
        // Pengecekan koneksi
        $this->koneksi = mysqli_connect($this->host, $this->username, $this->password, $this->database);
        if (mysqli_connect_errno()) {
            // Jika koneksi gagal akan menampilkan pesan 
            echo "Koneksi database gagal : " . mysqli_connect_error();
        }
    }
    
    // Metode untuk mengembalikan nilai properti koneksi
    function getKoneksi() {
        return $this->koneksi;
    }

    // Metode untuk menampilkan data yang kosong karena akan di override
    function tampilData() {
    }
}
?>
