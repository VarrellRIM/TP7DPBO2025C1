# TP7 - Inventory Management System

Implementasi sistem manajemen inventaris menggunakan PHP dengan fitur CRUD untuk produk, kategori, dan supplier.

## Janji
Saya Varrell Rizky Irvanni Mahkota dengan NIM 2306245 mengerjakan Tugas Praktikum 7 dalam mata kuliah Desain dan Pemrograman Berorientasi Objek untuk keberkahanNya maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. Aamiin.

## Desain Program

### Struktur Database
Database `inventory_db` terdiri dari 3 tabel utama:
1. **Tabel products**
   - `id` (Primary Key)
   - `name` - Nama produk
   - `description` - Deskripsi produk
   - `price` - Harga produk
   - `stock` - Jumlah stok
   - `category_id` (Foreign Key)
   - `supplier_id` (Foreign Key)
   - `created_at` - Timestamp pembuatan

2. **Tabel categories**
   - `id` (Primary Key)
   - `name` - Nama kategori
   - `description` - Deskripsi kategori

3. **Tabel suppliers**
   - `id` (Primary Key)
   - `name` - Nama supplier
   - `contact_person` - Nama kontak person
   - `email` - Email supplier
   - `phone` - Nomor telepon
   - `address` - Alamat supplier

### Struktur Kelas
1. **Kelas Product**
   - Menangani CRUD untuk produk
   - Method:
      - `getAllProducts()` - Mendapatkan semua produk
      - `getProductById()` - Mendapatkan produk berdasarkan ID
      - `searchProducts()` - Mencari produk
      - `addProduct()` - Menambahkan produk baru
      - `updateProduct()` - Memperbarui produk
      - `deleteProduct()` - Menghapus produk
      - `getLowStockCount()` - Mendapatkan jumlah produk dengan stok rendah

2. **Kelas Category**
   - Menangani CRUD untuk kategori
   - Method:
      - `getAllCategories()` - Mendapatkan semua kategori
      - `getCategoryById()` - Mendapatkan kategori berdasarkan ID
      - `searchCategories()` - Mencari kategori
      - `addCategory()` - Menambahkan kategori baru
      - `updateCategory()` - Memperbarui kategori
      - `deleteCategory()` - Menghapus kategori (dengan validasi)

3. **Kelas Supplier**
   - Menangani CRUD untuk supplier
   - Method:
      - `getAllSuppliers()` - Mendapatkan semua supplier
      - `getSupplierById()` - Mendapatkan supplier berdasarkan ID
      - `searchSuppliers()` - Mencari supplier
      - `addSupplier()` - Menambahkan supplier baru
      - `updateSupplier()` - Memperbarui supplier
      - `deleteSupplier()` - Menghapus supplier (dengan validasi)

4. **Kelas Database**
   - Menangani koneksi database
   - Menggunakan PDO untuk keamanan

### Struktur Folder
- **class/** - Berisi file kelas PHP (Product.php, Category.php, Supplier.php)
- **config/** - Berisi file konfigurasi database (db.php)
- **view/** - Berisi tampilan modular untuk setiap halaman
   - dashboard.php - Tampilan dashboard utama
   - products.php - Tampilan daftar produk
   - product_form.php - Form tambah/edit produk
   - categories.php - Tampilan daftar kategori
   - category_form.php - Form tambah/edit kategori
   - suppliers.php - Tampilan daftar supplier
   - supplier_form.php - Form tambah/edit supplier
   - header.php dan footer.php - Template layout umum
- **index.php** - File utama yang mengontrol alur aplikasi

## Alur Program

### 1. Inisialisasi
- Program dimulai dari file `index.php`
- Inisialisasi objek Product, Category, dan Supplier
- Memuat tampilan header

### 2. Routing
- Parameter `page` dalam URL menentukan halaman yang akan ditampilkan
- Parameter tambahan seperti `id` dan `delete` menentukan aksi CRUD
- Setiap aksi CRUD menggunakan method POST untuk keamanan

### 3. Operasi CRUD
- **Create**: Form pengisian data, validasi, penyimpanan ke database
- **Read**: Menampilkan data dari database dengan opsi pencarian
- **Update**: Form edit data dengan nilai pre-populated, validasi, pembaruan database
- **Delete**: Konfirmasi penghapusan, validasi relasi (constraint), penghapusan dari database

### 4. Feedback
- Notifikasi sukses atau error ditampilkan setelah operasi CRUD
- Pesan disimpan dalam session untuk persistent feedback

## Fitur Utama

### 1. Manajemen Produk
- Menambahkan produk dengan detail lengkap
- Mengkategorikan produk dalam kategori
- Menentukan supplier untuk setiap produk
- Melacak stok produk

### 2. Manajemen Kategori
- Mengelompokkan produk dalam kategori
- Melihat semua kategori tersedia
- Mencegah penghapusan kategori yang digunakan produk

### 3. Manajemen Supplier
- Mencatat informasi kontak supplier
- Melihat semua supplier tersedia
- Mencegah penghapusan supplier yang menyediakan produk

### 4. Dashboard
- Menampilkan ringkasan jumlah produk, kategori, dan supplier
- Menampilkan jumlah produk dengan stok rendah
- Akses cepat ke operasi CRUD populer

### 5. Pencarian
- Pencarian produk berdasarkan nama, deskripsi, kategori, atau supplier
- Pencarian kategori berdasarkan nama atau deskripsi
- Pencarian supplier berdasarkan nama, kontak, atau email

## Relasi Database

### 1. Product - Category (Many-to-One)
- Setiap produk dapat memiliki satu kategori
- Satu kategori dapat dimiliki oleh banyak produk
- Foreign key: `category_id` di tabel `products`

### 2. Product - Supplier (Many-to-One)
- Setiap produk dapat memiliki satu supplier
- Satu supplier dapat menyediakan banyak produk
- Foreign key: `supplier_id` di tabel `products`

## Implementasi Keamanan

### 1. Penggunaan PDO
- Menggunakan PDO untuk koneksi database
- Implementasi prepared statement untuk mencegah SQL injection

### 2. Validasi Input
- Validasi input sebelum operasi database
- Escape output HTML untuk mencegah XSS

### 3. Constraint Database
- Foreign key constraint untuk menjaga integritas data
- Validasi sebelum penghapusan untuk mencegah error

## Dokumentasi Program

