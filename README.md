# YAP - Person Management System

Aplikasi web untuk manajemen data person dengan sistem login, search, filter, dan CRUD lengkap. Dibangun dengan Laravel 11, Bootstrap 5, dan MySQL.

## 📋 Fitur Utama

- ✅ **Autentikasi User** - Login/Logout dengan session management
- ✅ **Manajemen Person** - CRUD (Create, Read, Update, Delete) data person
- ✅ **Search** - Cari person berdasarkan NIK atau Nama
- ✅ **Filter** - Filter person berdasarkan Provinsi
- ✅ **Relasi Database** - Person memiliki relasi dengan Provinsi
- ✅ **Pagination** - Daftar person dengan pagination (10 items per halaman)
- ✅ **Form Validation** - Validasi lengkap menggunakan Form Request
- ✅ **Modern UI** - Bootstrap 5 dengan gradient navbar dan smooth animations
- ✅ **Responsive Design** - Mobile-friendly interface

## 🚀 Instalasi & Setup

### Prasyarat
- PHP 8.2+
- MySQL 8.0+
- Composer
- Node.js & npm (opsional, untuk asset compilation)

### Langkah-Langkah Instalasi

#### 1. Clone Repository
```bash
cd d:\yap\yap
# atau direktori lainnya
```

#### 2. Install Dependencies PHP
```powershell
composer install
```

#### 3. Copy Environment File
```powershell
copy .env.example .env
```

#### 4. Generate App Key
```powershell
php artisan key:generate
```

#### 5. Konfigurasi Database
Edit file `.env` dan sesuaikan dengan konfigurasi MySQL Anda:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=yap
DB_USERNAME=root
DB_PASSWORD=
```

#### 6. Jalankan Migrasi Database
```powershell
php artisan migrate
```

#### 7. Jalankan Seeder (Opsional tapi Disarankan)
Seeder akan membuat:
- 1 User default untuk login (email: `admin@example.com`, password: `password`)
- Data Provinsi
- Data Person sample

```powershell
php artisan migrate --seed
```

Atau seeder individual:
```powershell
php artisan db:seed --class=UserSeeder
php artisan db:seed --class=ProvinsiSeeder
php artisan db:seed --class=PersonSeeder
```

#### 8. Jalankan Development Server
```powershell
php artisan serve
```

Server akan running di: `http://127.0.0.1:8000`

## 🔐 Login

Setelah seeder dijalankan, gunakan kredensial berikut untuk login:

- **Email**: `admin@example.com`
- **Password**: `password`

## 📱 Cara Penggunaan

### 1. Login
1. Akses `http://127.0.0.1:8000/`
2. Masukkan email dan password
3. Klik tombol "Login"

### 2. Dashboard
Setelah login, Anda akan melihat:
- Daftar semua person
- Form search dan filter
- Tombol Add Person, Edit, Delete

### 3. Menambah Person
1. Klik tombol "Add Person"
2. Isi form:
   - **NIK**: Nomor identitas (angka, harus unik)
   - **Nama**: Nama lengkap (maksimal 255 karakter)
   - **Provinsi**: Pilih dari dropdown
3. Klik "Save Person"

### 4. Edit Person
1. Klik tombol "Edit" pada row yang ingin diedit
2. Ubah data yang diperlukan
3. Klik "Update Person"

### 5. Hapus Person
1. Klik tombol "Delete" pada row
2. Konfirmasi penghapusan
3. Data akan terhapus

### 6. Search
1. Ketik NIK atau Nama di input search
2. Klik tombol "Search"
3. Hasil akan di-filter sesuai input

### 7. Filter by Provinsi
1. Pilih Provinsi dari dropdown
2. Klik tombol "Search"
3. Hanya person dengan provinsi yang dipilih akan tampil

### 8. Logout
1. Klik tombol "Logout" di navbar
2. Anda akan diarahkan ke halaman login

## 📁 Struktur Folder Penting

```
d:\yap\yap\
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AuthController.php      # Logika login/logout
│   │   │   └── PersonController.php    # CRUD person
│   │   └── Requests/
│   │       ├── StorePersonRequest.php  # Validasi create person
│   │       └── UpdatePersonRequest.php # Validasi update person
│   ├── Models/
│   │   ├── Person.php                  # Model person
│   │   ├── Provinsi.php                # Model provinsi
│   │   └── User.php                    # Model user
│   └── Policies/                       # Authorization policies
├── database/
│   ├── migrations/                     # File migrasi database
│   ├── seeders/                        # File seeder
│   └── factories/                      # Factory untuk testing
├── resources/
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php           # Master layout
│       ├── auth/
│       │   └── login.blade.php         # Halaman login
│       └── persons/
│           ├── index.blade.php         # Daftar person
│           ├── create.blade.php        # Form tambah person
│           └── edit.blade.php          # Form edit person
├── routes/
│   └── web.php                         # Route definisi
├── .env                                # File konfigurasi environment
└── README.md                           # File ini
```

## 🗄️ Database Schema

### Tabel: users
- id (PK)
- name
- email (unique)
- password
- remember_token
- timestamps

### Tabel: provinsis
- id (PK)
- nama_provinsi
- timestamps

### Tabel: people
- id (PK)
- nik (unique, numeric)
- nama (string)
- provinsi_id (FK → provinsis.id)
- timestamps

## 🔑 Route/Endpoint

| Method | Route | Controller | Deskripsi |
|--------|-------|-----------|-----------|
| GET | / | - | Redirect ke login |
| GET | /login | AuthController | Tampil form login |
| POST | /login | AuthController | Proses login |
| POST | /logout | AuthController | Proses logout |
| GET | /dashboard | PersonController | Daftar person |
| GET | /persons/create | PersonController | Form create person |
| POST | /persons | PersonController | Store person baru |
| GET | /persons/{person}/edit | PersonController | Form edit person |
| PUT | /persons/{person} | PersonController | Update person |
| DELETE | /persons/{person} | PersonController | Delete person |

## ✔️ Validasi Form

### Create/Update Person

| Field | Rules | Pesan Error |
|-------|-------|------------|
| NIK | required, numeric, unique | Wajib diisi, harus angka, tidak boleh sama |
| Nama | required, string, max:255 | Wajib diisi, harus text, max 255 karakter |
| Provinsi | required, exists:provinsis,id | Wajib dipilih, harus valid |

## 🎨 Teknologi & Library

- **Framework**: Laravel 11
- **CSS Framework**: Bootstrap 5.3.2 (CDN)
- **Icons**: Bootstrap Icons 1.11.0 (CDN)
- **Database**: MySQL 8.0+
- **Authentication**: Laravel built-in Auth
- **Database ORM**: Eloquent
- **Template Engine**: Blade
- **PHP**: 8.2+

## 🛠️ Troubleshooting

### Error: "SQLSTATE[42000]: Syntax error or access violation"
**Solusi**: Pastikan migrasi sudah dijalankan:
```powershell
php artisan migrate
```

### Error: "Route [login] not defined"
**Solusi**: Pastikan routes sudah ter-load dan server di-restart.

### Error: "Class 'App\Http\Controllers\SomeClass' not found"
**Solusi**: Jalankan autoload composer:
```powershell
composer dump-autoload
```

### Database tidak terkoneksi
**Solusi**: 
1. Periksa file `.env` - pastikan credentials sudah benar
2. Pastikan MySQL server running
3. Coba buat database baru di MySQL

### Bootstrap CSS tidak tampil
**Solusi**: 
- Buka DevTools (F12) → Network
- Pastikan CDN Bootstrap berhasil di-load (status 200)
- Jika CDN terkena blokir, coba offline assets atau Vite bundler

## 📝 Notes

- Default pagination: 10 items per halaman
- Session timeout: Default Laravel (2 jam)
- Password: Di-hash menggunakan bcrypt
- Pesan error: Dalam bahasa Indonesia untuk UX lebih baik

## 📞 Kontak & Support

Untuk pertanyaan atau issues, silakan hubungi tim development.

## 📄 License

Aplikasi ini menggunakan Laravel framework yang dilisensikan di bawah MIT License.

---

**Dibuat dengan ❤️ oleh Development Team**  
**Terakhir diupdate: 9 Desember 2025**
