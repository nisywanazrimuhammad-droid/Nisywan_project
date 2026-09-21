# Processing Flowchart

**Mini Project 1: Product Information System (Desain)**
Mata Kuliah: Pemrograman Web — Pertemuan 2

Dokumen ini menggambarkan alur pemrosesan sistem. Diagram memakai sintaks [Mermaid](https://mermaid.js.org/) sehingga otomatis tampil di GitHub, VS Code (ekstensi Markdown Mermaid), dan editor Markdown yang mendukungnya.

> Sesuai ketentuan sesi, dokumen ini hanya berisi rancangan alur (tanpa kode program).

**Simbol yang dipakai**

| Simbol | Arti |
|---|---|
| Kapsul / oval | Mulai atau selesai |
| Persegi | Proses |
| Belah ketupat | Keputusan (kondisi) |

---

## 1. Flowchart Utama (Alur `index.php`)

Menggambarkan seluruh proses dari pengguna membuka halaman hingga tabel tampil.

```mermaid
flowchart TD
    A(["MULAI: Pengguna mengakses index.php"]) --> B["Sertakan products.php<br/>dengan require_once"]
    B --> C["Sertakan functions.php<br/>dengan require_once"]
    C --> D["Data produk tersedia<br/>sebagai array multidimensi"]
    D --> E["Panggil hitungTotalNilaiStok<br/>dengan data produk"]
    E --> F["Simpan hasil<br/>total nilai aset gudang"]
    F --> G["Buat kerangka tabel HTML<br/>dan header kolom"]
    G --> H{"Masih ada produk<br/>yang belum diproses?<br/>(foreach)"}

    H -- "Ya" --> I["Ambil satu produk<br/>ID, Nama, Kategori, Harga, Stok, Deskripsi"]
    I --> J{"Stok kurang dari 3?"}
    J -- "Ya (stok kritis)" --> K["Tentukan warna baris:<br/>WARNA PERINGATAN"]
    J -- "Tidak (stok normal)" --> L["Tentukan warna baris:<br/>WARNA DEFAULT"]
    K --> M["Render satu baris tabel<br/>dengan warna yang dipilih"]
    L --> M
    M --> H

    H -- "Tidak" --> N["Tutup tabel HTML"]
    N --> O["Tampilkan total nilai aset gudang"]
    O --> P(["SELESAI: Halaman HTML dikirim ke browser"])
```

---

## 2. Flowchart Fungsi `hitungTotalNilaiStok()`

Berada di **Processing Layer** (`functions.php`). Fungsi ini mengkalkulasi nilai aset gudang.

```mermaid
flowchart TD
    A(["MULAI: Fungsi dipanggil"]) --> B["Terima input:<br/>array multidimensi data produk"]
    B --> C["Siapkan penampung total<br/>dengan nilai awal 0"]
    C --> D{"Masih ada produk<br/>yang belum dihitung?"}
    D -- "Ya" --> E["Ambil Harga dan Stok<br/>dari satu produk"]
    E --> F["Hitung nilai produk<br/>= Harga x Stok"]
    F --> G["Tambahkan nilai produk<br/>ke penampung total"]
    G --> D
    D -- "Tidak" --> H["Kembalikan total<br/>sebagai output"]
    H --> I(["SELESAI"])
```

**Ringkasan spesifikasi**

| Aspek | Keterangan |
|---|---|
| Input | Array multidimensi produk |
| Rumus per produk | Harga × Stok |
| Rumus akhir | Jumlah seluruh (Harga × Stok) |
| Output | Satu angka total nilai aset |

---

## 3. Flowchart Logika Kondisional Stok Kritis

Berada di **Processing Layer** (`functions.php`). Menyaring warna baris tabel.

```mermaid
flowchart TD
    A(["MULAI: Terima nilai stok satu produk"]) --> B{"Stok kurang dari 3?"}
    B -- "Ya" --> C["Status = KRITIS<br/>Warna baris = peringatan"]
    B -- "Tidak" --> D["Status = NORMAL<br/>Warna baris = default"]
    C --> E(["SELESAI: Kembalikan status / warna"])
    D --> E
```

**Tabel keputusan**

| Stok | Kondisi `stok < 3` | Status | Warna |
|---:|---|---|---|
| 0 | Benar | Kritis | Peringatan |
| 1 | Benar | Kritis | Peringatan |
| 2 | Benar | Kritis | Peringatan |
| 3 | **Salah** | Normal | Default |
| 4 dst. | Salah | Normal | Default |

> ⚠️ Stok bernilai tepat **3** dianggap **normal**, karena syaratnya "kurang dari 3", bukan "kurang dari atau sama dengan 3".

---

## 4. Alur Ketergantungan Berkas

```mermaid
flowchart LR
    IDX["index.php<br/>(Presentation Layer)"]
    PRD["products.php<br/>(Data Layer)"]
    FUN["functions.php<br/>(Processing Layer)"]

    IDX -- "require_once" --> PRD
    IDX -- "require_once" --> FUN
```

Hanya `index.php` yang bergantung pada dua berkas lain. `products.php` dan `functions.php` berdiri sendiri.

---

## 5. Simulasi Alur dengan Data Contoh

Data contoh dan hasil hitung mengacu pada `SAD.md`.

| Iterasi | ID | Harga × Stok | Nilai (Rp) | Stok < 3? | Warna baris | Total berjalan (Rp) |
|---:|---|---|---:|---|---|---:|
| 1 | P001 | 8.500.000 × 5 | 42.500.000 | Tidak | Default | 42.500.000 |
| 2 | P002 | 150.000 × 2 | 300.000 | **Ya** | Peringatan | 42.800.000 |
| 3 | P003 | 650.000 × 10 | 6.500.000 | Tidak | Default | 49.300.000 |
| 4 | P004 | 1.800.000 × 1 | 1.800.000 | **Ya** | Peringatan | 51.100.000 |
| 5 | P005 | 90.000 × 25 | 2.250.000 | Tidak | Default | 53.350.000 |
| 6 | P006 | 450.000 × 3 | 1.350.000 | Tidak (batas) | Default | 54.700.000 |

**Hasil akhir:** total nilai aset gudang = **Rp 54.700.000**, dengan **2 baris** berwarna peringatan (P002 dan P004).

---

## 6. Skenario Khusus (Edge Case)

| Skenario | Perilaku yang diharapkan |
|---|---|
| Array produk kosong | Total = 0, tabel tanpa baris (disarankan menampilkan pesan "data tidak tersedia") |
| Stok = 0 | Dianggap kritis, nilai produk = 0 |
| Stok tepat 3 | Dianggap normal |
| Semua produk kritis | Seluruh baris berwarna peringatan |
| Berkas `products.php` / `functions.php` tidak ditemukan | `require_once` menghentikan proses dengan error |

---

## 7. Pemetaan Flowchart ke Ketentuan Slide

| Bagian flowchart | Ketentuan slide |
|---|---|
| Flowchart 1, langkah 2–3 | Menggunakan `require_once` |
| Flowchart 1, perulangan | Merender data ke tabel HTML via `foreach` |
| Flowchart 2 | Fungsi `hitungTotalNilaiStok()` mengkalkulasi nilai aset gudang |
| Flowchart 3 | Logika kondisional warna baris jika stok kritis (< 3) |
