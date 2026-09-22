<?php
/**
 * functions.php — Processing Layer
 * Mini Project 1: Product Information System
 *
 * Tanggung jawab berkas ini HANYA logika/aturan bisnis.
 * Tidak boleh ada HTML atau akses data langsung dari products.php di sini —
 * seluruh data harus dikirim lewat parameter agar fungsi tetap reusable
 * (pure function).
 */

const BATAS_STOK_KRITIS = 3;

/**
 * Menghitung total nilai aset gudang (harga x stok, diakumulasi
 * untuk seluruh produk).
 *
 * @param array $dataProduk Array data produk dari Data Layer.
 * @return float|int Total nilai seluruh aset gudang.
 */
function hitungTotalNilaiStok(array $dataProduk)
{
    $total = 0;

    foreach ($dataProduk as $produk) {
        $nilaiProduk = $produk['harga'] * $produk['stok'];
        $total += $nilaiProduk;
    }

    return $total;
}

/**
 * Mengecek apakah stok suatu produk berada pada level kritis.
 * Level kritis didefinisikan sebagai stok < BATAS_STOK_KRITIS.
 *
 * @param int $stok Jumlah stok produk.
 * @return bool true jika kritis, false jika normal.
 */
function cekStokKritis(int $stok): bool
{
    return $stok < BATAS_STOK_KRITIS;
}

/**
 * Memformat angka menjadi format Rupiah untuk tampilan.
 * (Fungsi bantu presentasi angka, tetap tergolong Processing Layer
 * karena tidak menghasilkan tag HTML, hanya mengembalikan string.)
 *
 * @param int|float $angka
 * @return string
 */
function formatRupiah($angka): string
{
    return "Rp " . number_format($angka, 0, ',', '.');
}
