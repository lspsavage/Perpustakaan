# Perpustakaan Web Application

Proyek ini adalah aplikasi web perpustakaan yang dirancang untuk memudahkan manajemen buku, anggota, dan proses peminjaman serta pengembalian buku. Aplikasi ini menawarkan antarmuka pengguna yang intuitif dan berbagai fitur untuk mengelola perpustakaan secara efisien.

## **Fitur Utama**

### 1. **Manajemen Buku**
- **Tambah Buku:** Menambahkan buku baru ke perpustakaan melalui formulir yang mudah digunakan.
- **Edit Buku:** Memungkinkan pengeditan informasi buku yang sudah ada.
- **Hapus Buku:** Menghapus buku yang tidak lagi diperlukan dari sistem.
- **Cari Buku:** Fitur pencarian canggih untuk menemukan buku berdasarkan judul, pengarang, genre, dan lainnya.

### 2. **Manajemen Anggota**
- **Daftar Anggota:** Menampilkan daftar lengkap anggota perpustakaan.
- **Tambah Anggota:** Mendaftarkan anggota baru dengan informasi pribadi melalui formulir pendaftaran.
- **Edit Anggota:** Mengubah informasi anggota yang sudah terdaftar.
- **Hapus Anggota:** Menghapus anggota dari sistem.

### 3. **Manajemen Pinjaman**
- **Pinjam Buku:** Mencatat peminjaman buku oleh anggota, dengan informasi detail tentang tanggal pinjam dan jatuh tempo pengembalian.
- **Kembalikan Buku:** Memproses pengembalian buku dan memperbarui status buku menjadi tersedia.
- **Lihat Pinjaman Aktif:** Menampilkan semua pinjaman yang sedang aktif, memudahkan pengelolaan dan pemantauan status pinjaman.

### 4. **Pencarian dan Filter**
- **Pencarian Buku:** Mencari buku berdasarkan judul, pengarang, atau genre untuk mempermudah pengguna menemukan buku yang diinginkan.
- **Pencarian Anggota:** Fitur pencarian berdasarkan nama atau ID anggota.
- **Filter Pinjaman:** Menyediakan opsi filter untuk melihat pinjaman berdasarkan status (aktif/kembali), tanggal pinjaman, atau tanggal pengembalian.

## **Antarmuka Pengguna (Frontend)**

- **Beranda:** Halaman utama yang memberikan akses cepat ke fitur utama aplikasi.
- **Daftar Buku:** Menampilkan semua buku dengan fitur pencarian dan filter untuk memudahkan navigasi.
- **Detail Buku:** Menyediakan informasi lengkap tentang buku tertentu termasuk sinopsis, pengarang, dan status ketersediaan.
- **Tambah Buku:** Formulir untuk menambah buku baru ke dalam perpustakaan.
- **Formulir Peminjaman:** Untuk mencatat peminjaman buku oleh anggota.
- **Daftar Anggota:** Menampilkan daftar semua anggota perpustakaan dengan opsi pencarian dan filter.
- **Detail Anggota:** Menampilkan informasi lengkap tentang seorang anggota termasuk histori peminjaman.
- **Formulir Pendaftaran Anggota:** Untuk mendaftarkan anggota baru.
- **Daftar Pinjaman:** Menampilkan semua buku yang sedang dipinjam beserta status pengembaliannya.
- **Formulir Pengembalian Buku:** Untuk mengelola pengembalian buku oleh anggota.
- **Daftar Pengembalian Buku:** Memantau buku yang sudah dikembalikan dan memastikan statusnya diperbarui.

## **Cara Menggunakan**

1. **Clone Repository:**
   ```bash
   git clone https://github.com/username/nama-repository.git
2. **Instal Dependensi:**
   ```bash
   composer install
   npm install && npm run dev
   ```
3. **Konfigurasi File Environment:**
   - Duplikat file `.env.example` menjadi `.env` dan sesuaikan konfigurasi database.
4. **Generate Key Aplikasi:**
   ```bash
   php artisan key:generate
   ```
5. **Migrasi dan Seed Database:**
   ```bash
   php artisan migrate --seed
   ```
6. **Jalankan Aplikasi:**
   ```bash
   php artisan serve
   ```


- **Frontend:** HTML, CSS (Tailwind CSS), JavaScript
- **Backend:** Laravel Framework
- **Database:** MySQL
