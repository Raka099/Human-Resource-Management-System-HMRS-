# HRMS Laravel 12 - Starter Implementation

Implementasi berdasarkan SRS HRMS yang diberikan pengguna.

## Stack
- Laravel 12
- PHP 8.2+
- MySQL
- Laragon
- Blade + CSS custom
- Session authentication + role middleware

## Role
- HR
- Manager
- Karyawan

## Fitur
- Login sesuai role
- Dashboard
- CRUD Data Karyawan (HR)
- Kelola Pelamar + upload CV + seleksi + generate karyawan
- Kelola Dokumen
- Kelola Kontrak
- Pengajuan Cuti/Izin/Lembur
- Approval bertahap Manager -> HR
- Laporan Data Karyawan
- Laporan Pengajuan
- Export CSV dan halaman print untuk PDF melalui browser

## Instalasi di Laragon
1. Buat project Laravel 12 baru atau salin source ini ke project Laravel 12.
2. Jalankan `composer install`.
3. Salin `.env.example` menjadi `.env` dan atur MySQL:
   DB_DATABASE=hrms
   DB_USERNAME=root
   DB_PASSWORD=
4. Jalankan `php artisan key:generate`.
5. Jalankan `php artisan migrate --seed`.
6. Jalankan `php artisan storage:link`.
7. Buka `http://hrms.test` jika memakai virtual host Laragon.

## Akun demo
- HR: hr@hrms.test / password
- Manager: manager@hrms.test / password
- Karyawan: employee@hrms.test / password

Catatan: password demo wajib diganti untuk penggunaan nyata.
