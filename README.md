# E-Report - Sistem Informasi Pengaduan Masyarakat

Aplikasi layanan pengaduan warga berbasis web untuk melaporkan permasalahan fasilitas publik dan memantau status penanganannya secara transparan.

---

## 🛠️ Tech Stack
- **Framework:** Laravel 13
- **Komponen Interaktif:** Livewire
- **Database:** MySQL
- **Frontend / Styling:** Tailwind CSS & Lucide Icons

---

## 👥 Hak Akses & Fitur
1. **Warga**
   - Registrasi dan login akun mandiri (dilengkapi *rate limiter* anti brute-force).
   - Mengirim pengaduan dilengkapi tanggal kejadian dan unggah foto bukti (maks. 2 MB).
   - Melihat riwayat, status penanganan (*Menunggu*, *Sedang Diproses*, *Selesai*), dan detail laporan.
   - Mengedit atau menghapus laporan selama status masih *Menunggu*.
   - Manajemen profil dan ubah kata sandi.
2. **Administrator**
   - Meninjau seluruh pengaduan warga yang masuk.
   - Pencarian berdasarkan judul pengaduan dan nama pelapor.
   - Filter status dan pengurutan data (*Terbaru / Terlama*).
   - Memperbarui status pengaduan secara sekuensial: *Menunggu* ➔ *Sedang Diproses* ➔ *Selesai*.

---

## 🔑 Akun Demo Pengujian
- **Administrator:**
  - Email: `admin@ereport.test`
  - Password: `AdminPassword123!`
- **Warga:**
  - Silakan lakukan registrasi langsung melalui halaman `/register`.

---

## 🚀 Panduan Instalasi Lokal

### 1. Clone Repositori
```bash
git clone [https://github.com/Ekuivalen07/NAMA_REPO_BARU_KAMU.git](https://github.com/Ekuivalen07/NAMA_REPO_BARU_KAMU.git)
cd NAMA_REPO_BARU_KAMU
