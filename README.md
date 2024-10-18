# PraktikumWeb2-Tugas2
### Implementasi CRUD menggunakan PHP OOP
**Studi Kasus : izin_ketidakhadiran_pegawai**
![IzinKetidakhadiran](https://github.com/user-attachments/assets/08c0c2ca-ea43-4ed4-b577-14209407b046)

### Tugas:
**1. Create an OOP-based View, by retrieving data from the MySQL database**<br>
- **Membuat database perizinan sesuai dengan studi kasus izin_ketidakhadiran_pegawai**<br>
![Screenshot 2024-10-18 075511](https://github.com/user-attachments/assets/d3ef3893-7b4b-45d3-9174-63d8e8529ed2)

![Screenshot 2024-10-18 075549](https://github.com/user-attachments/assets/422df39a-daae-4408-bba5-d0647ffb88c1)

![Screenshot 2024-10-18 075608](https://github.com/user-attachments/assets/55de308e-2ad1-4eed-8640-8ca32830501f)

- **Membuat class database**<br>
  >Mendeklarasikan class baru bernama database yang akan digunakan untuk koneksi ke database MySQL. Membuat properti `host` untuk menyimpan nama host atau server database, `username` untuk menyimpan nama pengguna database yang digunakan saat login ke database yaitu root, `password` untuk menyimpan password pengguna, `database` untuk menyimpan nama database yang digunakan, dan `koneksi` akan menyimpan objek koneksi yang dibuat setelah tersambung ke database.
  ```
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
  ```
**2. Use the _construct as a link to the database**<br>
**3. Apply encapsulation according to the logic of the case study**<br>
**4. Create a derived class using the concept of inheritance**<br>
**5. Apply polymorphism for at least 2 roles according to the case study**<br>
