# Laravel Quiz Application

Sebuah aplikasi quiz berbasis web yang dibangun dengan Laravel 11, Livewire, Filament Admin Panel, dan TailwindCSS. Aplikasi ini memungkinkan pengguna untuk mengikuti quiz, melihat hasil, dan admin dapat mengelola course, quiz, dan pertanyaan melalui panel admin yang modern.


> [!WARNING]
> **User experience untuk role member masih dalam tahap pengembangan dan belum optimal. Namun aplikasi sudah dapat digunakan untuk mengikuti quiz. Harap tunggu update selanjutnya untuk pengalaman yang lebih baik.**

## 🚀 Fitur

### Untuk Pengguna
- **Registrasi & Login**: Sistem autentikasi yang aman dengan Laravel Jetstream
- **Dashboard**: Melihat course dan quiz yang tersedia
- **Mengikuti Quiz**: Interface yang user-friendly untuk mengerjakan quiz
- **Hasil Quiz**: Melihat skor dan hasil jawaban
- **Riwayat Quiz**: Melihat riwayat quiz yang pernah dikerjakan

### Untuk Admin
- **Panel Admin Filament**: Interface admin yang modern dan responsif
- **Manajemen Course**: CRUD operations untuk course
- **Manajemen Quiz**: Membuat dan mengelola quiz
- **Manajemen Pertanyaan**: Menambah, edit, dan hapus pertanyaan beserta opsi jawaban
- **Analitik**: Melihat hasil dan statistik quiz pengguna
- **Manajemen User**: Kelola pengguna dan role

## 🛠 Teknologi yang Digunakan

- **Backend**: Laravel 11
- **Frontend**: Livewire 3, TailwindCSS
- **Admin Panel**: Filament 3
- **Database**: MySQL/PostgreSQL
- **Authentication**: Laravel Jetstream dengan Sanctum
- **Testing**: Pest PHP
- **Build Tools**: Vite
- **AI Integration**: Google Gemini API

## 📋 Prasyarat

Pastikan sistem Anda telah memenuhi requirements berikut:

- PHP >= 8.2
- Composer
- Node.js >= 18.x
- NPM atau Yarn
- MySQL >= 8.0 atau PostgreSQL >= 13
- Git

## 🔧 Instalasi

### 1. Clone Repository

```bash
git clone https://github.com/amarafiif/laravel-quiz.git
cd laravel-quiz
```

### 2. Install Dependencies PHP

```bash
composer install
```

### 3. Install Dependencies JavaScript

```bash
npm install
```

### 4. Environment Configuration

```bash
# Copy file environment
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 5. Konfigurasi Database

Edit file `.env` dan sesuaikan konfigurasi database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_quiz
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 6. Konfigurasi Google Gemini (Opsional)

Jika menggunakan fitur AI, tambahkan API key Google Gemini di `.env`:

```env
GEMINI_API_KEY=your_gemini_api_key
```

### 7. Migrasi Database

```bash
# Jalankan migrasi
php artisan migrate

# Jalankan seeder (opsional)
php artisan db:seed
```

### 8. Link Storage

```bash
php artisan storage:link
```

### 9. Build Assets

```bash
# Untuk development
npm run dev

# Untuk production
npm run build
```

## 🚀 Menjalankan Aplikasi

### Development Server

```bash
# Terminal 1: Laravel development server
php artisan serve

# Terminal 2: Vite development server (untuk hot reload)
npm run dev
```

Aplikasi akan berjalan di `http://localhost:8000`

### Production Deployment

1. **Build assets untuk production:**
```bash
npm run build
```

2. **Optimize Laravel:**
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

3. **Set permissions (untuk server Linux):**
```bash
chmod -R 755 storage bootstrap/cache
```

## 👤 Akun Default

Setelah menjalankan seeder, Anda dapat login dengan:

**Admin:**
- Email: `admin@example.com`
- Password: `password`

**User:**
- Email: `user@example.com`
- Password: `password`

## 📁 Struktur Database

### Tabel Utama

- **users**: Data pengguna dan admin
- **courses**: Mata pelajaran/course
- **quizzes**: Quiz yang terkait dengan course
- **questions**: Pertanyaan dalam quiz
- **options**: Pilihan jawaban untuk setiap pertanyaan
- **quiz_attempts**: Record percobaan quiz oleh user
- **user_answers**: Jawaban spesifik user untuk setiap pertanyaan

### Relasi

```
Course -> Quiz (1:n)
Quiz -> Question (1:n)
Question -> Option (1:n)
User -> QuizAttempt (1:n)
QuizAttempt -> UserAnswer (1:n)
```

## 🔧 Pengembangan

### Menambah Fitur Baru

1. **Model**: Buat model di `app/Models/`
2. **Migration**: `php artisan make:migration create_table_name`
3. **Controller**: `php artisan make:controller ControllerName`
4. **Livewire Component**: `php artisan make:livewire ComponentName`
5. **Filament Resource**: `php artisan make:filament-resource ResourceName`

### Testing

```bash
# Jalankan semua test
php artisan test

# Jalankan test dengan coverage
php artisan test --coverage

# Jalankan test spesifik
php artisan test --filter TestClassName
```

### Code Style

```bash
# Format code dengan Laravel Pint
./vendor/bin/pint

# Check code style
./vendor/bin/pint --test
```

## 📚 API Documentation

### Authentication

Aplikasi menggunakan Laravel Sanctum untuk API authentication.

### Endpoints Utama

- `GET /api/courses` - Daftar course
- `GET /api/quizzes/{course}` - Quiz dalam course
- `POST /api/quiz-attempts` - Mulai quiz attempt
- `POST /api/user-answers` - Submit jawaban

## 🐛 Troubleshooting

### Error Umum

1. **Class not found**
   ```bash
   composer dump-autoload
   ```

2. **Permission denied**
   ```bash
   chmod -R 755 storage bootstrap/cache
   ```

3. **Asset not found**
   ```bash
   npm run build
   php artisan optimize:clear
   ```

4. **Database connection error**
   - Periksa konfigurasi `.env`
   - Pastikan database server berjalan
   - Verifikasi credentials database

## 🤝 Kontribusi

1. Fork repository
2. Buat feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit perubahan (`git commit -m 'Add some AmazingFeature'`)
4. Push ke branch (`git push origin feature/AmazingFeature`)
5. Buat Pull Request

## 📄 Lisensi

Aplikasi ini dilisensikan di bawah [MIT License](LICENSE).

## 👥 Tim Pengembang

- **Developer**: [amarafiif](https://github.com/amarafiif)

## 📞 Dukungan

Jika Anda mengalami masalah atau memiliki pertanyaan:

1. Buka [Issues](https://github.com/amarafiif/laravel-quiz/issues) di GitHub
2. Periksa dokumentasi Laravel: [https://laravel.com/docs](https://laravel.com/docs)
3. Periksa dokumentasi Filament: [https://filamentphp.com/docs](https://filamentphp.com/docs)

## 🔄 Changelog

### v1.0.0 (2025-01-12)
- ✨ Rilis awal aplikasi
- 🚀 Implementasi autentikasi dengan Jetstream
- 📊 Panel admin dengan Filament
- 🎯 Sistem quiz dan course
- 🤖 Integrasi Google Gemini AI

---

**Happy Coding! 🚀**