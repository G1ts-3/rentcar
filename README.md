# Rentcar - Sistem Manajemen Rental Kendaraan

Sistem informasi berbasis web untuk mengelola penyewaan kendaraan, yang dirancang menggunakan framework Laravel 11. Aplikasi ini mendukung manajemen data kendaraan, pengguna, serta proses peminjaman dan pengembalian yang terintegrasi.

## 🚀 Fitur Utama

- **Sistem Autentikasi**: Login dan Registrasi pengguna.
- **Role-Based Access Control (RBAC)**:
  - **Admin**: Mengelola data kendaraan (CRUD), data pengguna, dan memantau seluruh transaksi.
  - **Member**: Melakukan peminjaman kendaraan yang tersedia dan mengembalikan kendaraan.
- **Manajemen Kendaraan**: Pelacakan status kendaraan secara real-time (Tersedia, Dipinjam, Perbaikan).
- **Sistem Transaksi**: Pencatatan otomatis riwayat pinjam-kembali kendaraan.
- **Tampilan Modern**: Antarmuka responsif menggunakan Tailwind CSS.

## 🛠️ Spesifikasi Teknologi

- **Backend**: Laravel 11 (PHP 8.2+)
- **Database**: MySQL
- **Frontend**: Blade Templates & Tailwind CSS
- **Aset Manager**: Vite
- **Server Lokal**: Apache (XAMPP/Laragon)

## 📋 Prasyarat Sistem

Sebelum menjalankan aplikasi, pastikan perangkat Anda sudah terinstal:
- [PHP >= 8.2](https://www.php.net/downloads)
- [Composer](https://getcomposer.org/)
- [Node.js & NPM](https://nodejs.org/)
- [MySQL (XAMPP/Laragon)](https://www.apachefriends.org/index.html)

## 🔧 Langkah Instalasi

1. **Clone Repository**
   ```bash
   git clone https://github.com/G1ts-3/rentcar.git
   cd rentcar
   ```

2. **Instal Dependencies (PHP & JS)**
   ```bash
   composer install
   npm install
   ```

3. **Konfigurasi Environment**
   Salin file `.env.example` menjadi `.env`:
   ```bash
   cp .env.example .env
   ```
   Buka file `.env` dan sesuaikan konfigurasi database Anda:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=rental
   DB_USERNAME=root
   DB_PASSWORD=
   ```

4. **Generate Application Key**
   ```bash
   php artisan key:generate
   ```

5. **Migrasi Database**
   Pastikan MySQL sudah berjalan dan database bernama `rental` sudah dibuat, lalu jalankan:
   ```bash
   php artisan migrate
   ```

6. **Jalankan Aplikasi**
   Jalankan server Laravel dan Vite (untuk CSS) di dua terminal berbeda:
   ```bash
   # Terminal 1
   php artisan serve
   
   # Terminal 2
   npm run dev
   ```

## 📖 Cara Menggunakan Program

1. **Registrasi**: Buka aplikasi di browser (`http://127.0.0.1:8000`), klik "Daftar di sini" untuk membuat akun baru.
2. **Dashboard Member**:
   - Pilih menu **Peminjaman** untuk melihat daftar kendaraan yang tersedia.
   - Klik tombol pinjam pada kendaraan yang diinginkan.
   - Pilih menu **Pengembalian** untuk mengembalikan kendaraan yang sedang Anda bawa.
3. **Dashboard Admin**:
   - Login sebagai Admin untuk mengakses menu pengelolaan.
   - Tambahkan kendaraan baru melalui menu **Vehicles**.
   - Pantau atau edit status transaksi di menu **Transactions**.

---
Dibuat dengan ❤️ menggunakan Laravel.
