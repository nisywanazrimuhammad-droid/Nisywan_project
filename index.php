<?php
/**
 * index.php — Presentation Layer
 * Mini Project 1: Product Information System
 *
 * Tanggung jawab berkas ini HANYA merajut Data Layer + Processing Layer,
 * lalu merender hasilnya sebagai HTML. Tidak ada logika kalkulasi
 * langsung di sini — semua kalkulasi dipanggil dari functions.php.
 */

// 1. Muat Data Layer & Processing Layer.
//    require_once dipakai (bukan include) karena kedua berkas ini esensial:
//    jika gagal dimuat, sistem harus berhenti total (fatal), bukan berjalan
//    diam-diam dengan data/fungsi yang hilang.
require_once __DIR__ . '/products.php';
require_once __DIR__ . '/functions.php';

// 2. Panggil Processing Layer untuk kalkulasi total nilai aset gudang.
$totalNilaiStok = hitungTotalNilaiStok($dataProduk);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Product Information System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 900px;
            margin: 40px auto;
            color: #1f2937;
        }
        h1 {
            font-size: 1.5rem;
            margin-bottom: 4px;
        }
        p.subtitle {
            color: #6b7280;
            margin-top: 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #e5e7eb;
            padding: 10px 12px;
            text-align: left;
            font-size: 0.92rem;
        }
        th {
            background-color: #f3f4f6;
        }
        tr.stok-kritis {
            background-color: #fee2e2;
        }
        tr.stok-kritis td.kolom-stok {
            font-weight: bold;
            color: #b91c1c;
        }
        .badge-kritis {
            display: inline-block;
            font-size: 0.75rem;
            background-color: #b91c1c;
            color: #fff;
            padding: 2px 8px;
            border-radius: 999px;
            margin-left: 6px;
        }
        tfoot td {
            font-weight: bold;
            background-color: #f9fafb;
        }
    </style>
</head>
<body>

    <h1>Product Information System</h1>
    <p class="subtitle">Mini Project 1 — Pemrograman Web</p>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Produk</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Deskripsi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($dataProduk as $produk): ?>
                <?php $isKritis = cekStokKritis($produk['stok']); ?>
                <tr class="<?= $isKritis ? 'stok-kritis' : '' ?>">
                    <td><?= htmlspecialchars($produk['id']) ?></td>
                    <td><?= htmlspecialchars($produk['nama']) ?></td>
                    <td><?= htmlspecialchars($produk['kategori']) ?></td>
                    <td><?= formatRupiah($produk['harga']) ?></td>
                    <td class="kolom-stok">
                        <?= htmlspecialchars($produk['stok']) ?>
                        <?php if ($isKritis): ?>
                            <span class="badge-kritis">Stok Kritis</span>
                        <?php endif; ?>
                    </td>
                    <td><?= htmlspecialchars($produk['deskripsi']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3">Total Nilai Aset Gudang</td>
                <td colspan="3"><?= formatRupiah($totalNilaiStok) ?></td>
            </tr>
        </tfoot>
    </table>

</body>
</html>
