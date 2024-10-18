# PraktikumWeb2-Tugas2
### Implementasi CRUD menggunakan PHP OOP
**Studi Kasus : izin_ketidakhadiran_pegawai**<br>
![IzinKetidakhadiran](https://github.com/user-attachments/assets/08c0c2ca-ea43-4ed4-b577-14209407b046)

### Tugas:
**1. Create an OOP-based View, by retrieving data from the MySQL database**<br>
- **Membuat database perizinan sesuai dengan studi kasus izin_ketidakhadiran_pegawai**<br>
![Screenshot 2024-10-18 075511](https://github.com/user-attachments/assets/d3ef3893-7b4b-45d3-9174-63d8e8529ed2)

  ![Screenshot 2024-10-18 075549](https://github.com/user-attachments/assets/422df39a-daae-4408-bba5-d0647ffb88c1)

  ![Screenshot 2024-10-18 075608](https://github.com/user-attachments/assets/55de308e-2ad1-4eed-8640-8ca32830501f)

- **Membuat class database**<br>
  Mendeklarasikan class baru bernama database yang akan digunakan untuk koneksi ke database MySQL. Membuat properti `$host` untuk menyimpan nama host atau server database, `$username` untuk menyimpan nama pengguna database yang digunakan saat login ke database yaitu root, `$password` untuk menyimpan password pengguna, `$database` untuk menyimpan nama database yang digunakan, dan `$koneksi` akan menyimpan objek koneksi yang dibuat setelah tersambung ke database.
  Membuat metode `getKoneksi()` untuk mengembalikan nilai properti `$koneksi`, metode ini akan mengembalikan objek koneksi ke database sehingga memudahkan mengakses koneksi yang sudah ada tanpa harus membuat koneksi baru. Membuat metode `tampilData()` yang belum diisi karena akan di-override oleh kelas turunan untuk menampilkan data.
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
    Menggunakan `__construct` di kelas `database` sebagai koneksi ke database dengan fungsi `mysqli_connect()`, dengan parameter seperti `$host`, `$username`, `$password`, dan nama database. Jika terjadi kegagalan saat melakukan koneksi, maka fungsi `mysqli_connect_errno()` akan mengecek error, dan `mysqli_connect_error()` menampilkan pesan kesalahan.
  ```
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
  ```
**3. Apply encapsulation according to the logic of the case study**<br>
    Menerapkan enkapsulasi berdasarkan logika studi kasus menggunakan aksessibilitas private pada properti `$host`, `$username`, `$password`, dan `$database` untuk melindungi dari kelas lain sehingga hanya dapat diakses di kelas `database`, serta aksesibilitas protected pada properti `$koneksi` sehingga dapat diakses dari kelas turunan dan melindungi dari kelas yang bukan turunan kelas `database`.
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
  ```
**4. Create a derived class using the concept of inheritance**<br>
- **Membuat kelas turunan dari kelas `database` untuk menampilkan semua data di tabel `izin_ketidakhadiran_pegawai`**<br>
  Menggunakan `require_once` untuk mengimpor file `database.php`, yang berisi kelas `database`. Kelas ini memungkinkan kita untuk menghubungkan ke database. Semua kelas yang didefinisikan setelah ini akan menggunakan fitur koneksi dari kelas `database`.
  Mendeklarasikan class baru bernama `IzinKetidakhadiran` yang mewarisi class `database` dan akan digunakan untuk menampilkan semua data yang terdapat di dalam database dengan menggunakan metode `tampilData()` dari kelas `database`.
  ```
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
  ```
- **Membuat kelas turunan dari kelas `IzinKetidakhadiran` untuk menampilkan beberapa data di tabel `izin_ketidakhadiran_pegawai`**<br>
    - **Membuat class `Disetujui` yang mewarisi kelas `database`**<br>
      Mendeklarasikan class baru bernama `Disetujui` yang mewarisi class `IzinKetidakhadiran` dan akan digunakan untuk menampilkan beberapa data yang terdapat di dalam database dengan menggunakan metode `tampilData()` dari kelas `database`.
      ```
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
      ```
    - **Membuat class `Ditunda` yang mewarisi kelas `database`**<br>
      Mendeklarasikan class baru bernama `Ditunda` yang mewarisi class `IzinKetidakhadiran` dan akan digunakan untuk menampilkan beberapa data yang terdapat di dalam database dengan menggunakan metode `tampilData()` dari kelas `database`.
      ```
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
      ```
    - **Membuat class `Ditolak` yang mewarisi kelas `database`**<br>
      Mendeklarasikan class baru bernama `Ditolak` yang mewarisi class `IzinKetidakhadiran` dan akan digunakan untuk menampilkan beberapa data yang terdapat di dalam database dengan menggunakan metode `tampilData()` dari kelas `database`.
      ```
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
      ```
       
**5. Apply polymorphism for at least 2 roles according to the case study**<br>
- **Menerapkan polimorfisme di kelas `IzinKetidakhadiran`**<br>
  Menyusun query SQL `select * from izin_ketidakhadiran _pegawai` untuk mengambil semua data dari database, kemudian dijalankan menggunakan koneksi database yang diwariskan dari kelas `database`. Data yang telah diambil akan ditampilkan di dalam array `$hasil` menggunakan perulangan yang telah melalui pengecekan koneksi.
- **Menerapkan polimorfisme di kelas `Disetujui`**<br>
  Menyusun query SQL `select * from Disetujui` untuk mengambil hanya data Disetujui dari kolom putusan dari database, kemudian dijalankan menggunakan koneksi database yang diwariskan dari kelas `database`. Data yang telah diambil akan ditampilkan di dalam array `$hasil` menggunakan perulangan yang telah melalui pengecekan koneksi.
- **Menerapkan polimorfisme di kelas `Ditunda`**<br>
  Menyusun query SQL `select * from Ditunda` untuk mengambil hanya data Ditunda dari kolom putusan dari database, kemudian dijalankan menggunakan koneksi database yang diwariskan dari kelas `database`. Data yang telah diambil akan ditampilkan di dalam array `$hasil` menggunakan perulangan yang telah melalui pengecekan koneksi.
- **Menerapkan polimorfisme di kelas `Ditolak`**<br>
  Menyusun query SQL `select * from Ditolak` untuk mengambil hanya data Disetujui dari kolom putusan dari database, kemudian dijalankan menggunakan koneksi database yang diwariskan dari kelas `database`. Data yang telah diambil akan ditampilkan di dalam array `$hasil` menggunakan perulangan yang telah melalui pengecekan koneksi.
  ```
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
  ```

**6. Membuat dashboard tampil data**<br>
  Membuat tampil data berbasis OOP untuk menampilkan data yang diambil dari database dan menggunakan Bootsrap.
- **Tampil data semua izin ketidakhadiran**<br>
  ```
  <?php
  // Mengimpor file izin_ketidakhadiran.php untuk mengakses kelas database
  require_once('izin_ketidakhadiran.php');
  // Membuat objek dari kelas izin_ketidakhadiran
  $izin = new IzinKetidakhadiran();
  $dataIzin = $izin->tampilData(); // Mengambil data izin ketidakhadiran
  ?>
  
  <!DOCTYPE html>
  <html lang="en">
  
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <!-- Memuat Bootstrap untuk desain -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
      <title>Izin Ketidakhadiran Pegawai</title>
  </head>
  
  <body>
      <!-- Navigasi sederhana dengan Bootstrap -->
      <nav class="navbar navbar-expand-lg bg-primary-subtle">
          <div class="container-fluid">
              <a class="navbar-brand fw-semibold">Sistem Izin Ketidakhadiran Pegawai</a>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav me-auto">
                      <li class="nav-item">
                          <a class="nav-link active fw-semibold" href="tampilAll.php">Data Izin</a>
                      </li>
                      <!-- Dropdown untuk putusan izin -->
                      <li class="nav-item dropdown">
                          <a class="nav-link dropdown-toggle fw-semibold" href="#" data-bs-toggle="dropdown">Putusan</a>
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
  
      <!-- Tabel untuk menampilkan data izin -->
      <div class="m-5">
          <h1 class="text-center">Data Izin Ketidakhadiran Pegawai</h1>
          <table class="table table-bordered mt-4">
              <tr class="text-center align-middle table-primary">
                  <!-- Header tabel -->
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
                  <th>Tanggal Disetujui</th>
                  <th>Tanda Tangan Atasan</th>
                  <th>Catatan</th>
                  <th>Nama Dosen</th>
              </tr>
  
              <?php
              // Menampilkan data jika ada
              if (!empty($dataIzin)) {
                  $no = 1;
                  foreach ($dataIzin as $row) {
              ?>
                      <!-- Menampilkan baris data -->
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
                  // Pesan jika data kosong
                  echo "<tr><td colspan='16' class='text-center'>Data kosong</td></tr>";
              }
              ?>
  
          </table>
      </div>
  
      <!-- Memuat Bootstrap JavaScript -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
  
  </html>
  ```
  **Hasil Output**
  ![Screenshot 2024-10-18 091458](https://github.com/user-attachments/assets/689d6e3b-128a-489d-827e-49f642197d50)

- **Tampil data Disetujui**<br>
  ```
  <?php
  // Mengimpor file izin_ketidakhadiran.php yang berisi kelas untuk data izin
  require_once('izin_ketidakhadiran.php');
  
  // Membuat objek dari kelas Disetujui dan mengambil data izin yang disetujui
  $disetujui = new Disetujui();
  $dataDisetujui = $disetujui->tampilData();
  ?>
  
  <!DOCTYPE html>
  <html lang="en">
  
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <!-- Menambahkan Bootstrap untuk desain -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
      <title>Data Izin Disetujui</title>
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
      
      <!-- Menampilkan tabel data izin yang disetujui -->
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
                  <th>Tanggal Disetujui</th>
                  <th>Tanda Tangan Atasan</th>
                  <th>Catatan</th>
                  <th>Nama Dosen</th>
              </tr>
  
              <?php
              // Mengecek apakah data izin yang disetujui tersedia
              if (!empty($dataDisetujui)) {
                  $no = 1;
                  foreach ($dataDisetujui as $row) {
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
  ```
  **Hasil Output**
![Screenshot 2024-10-18 091525](https://github.com/user-attachments/assets/58b51a26-b60a-42d3-82d0-03b13950842d)
  
- **Tampil data Ditunda**<br>
  ```
  <?php
  // Mengimpor file izin_ketidakhadiran.php yang berisi kelas untuk data izin
  require_once('izin_ketidakhadiran.php');
  
  // Membuat objek dari kelas Ditunda dan mengambil data izin yang ditunda
  $ditunda = new Ditunda();
  $dataDitunda = $ditunda->tampilData();
  ?>
  
  <!DOCTYPE html>
  <html lang="en">
  
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <!-- Menambahkan Bootstrap untuk desain -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
      <title>Data Izin Ditunda</title>
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
      
      <!-- Menampilkan tabel data izin yang ditunda -->
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
                  <th>Tanggal Ditunda</th>
                  <th>Tanda Tangan Atasan</th>
                  <th>Catatan</th>
                  <th>Nama Dosen</th>
              </tr>
  
              <?php
              // Mengecek apakah data izin yang ditunda tersedia
              if (!empty($dataDitunda)) {
                  $no = 1;
                  foreach ($dataDitunda as $row) {
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
  ```
  **Hasil Output**
  ![Screenshot 2024-10-18 091537](https://github.com/user-attachments/assets/02c982f9-72e6-42d9-a355-a9ba2eb51f8a)

- **Tampil data Ditolak**<br>
  ```
  <?php
  // Mengimpor file izin_ketidakhadiran.php yang berisi kelas untuk data izin
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
  ```
  **Hasil Output**
  ![Screenshot 2024-10-18 091649](https://github.com/user-attachments/assets/0a5bd83d-b899-4b8c-9095-f793e409f0f9)

