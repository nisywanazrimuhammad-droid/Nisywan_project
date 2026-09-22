<?php
/**
 * products.php — Data Layer
 * Mini Project 1: Product Information System
 *
 * Tanggung jawab berkas ini HANYA menyimpan data.
 * Tidak boleh ada logika kalkulasi atau HTML di sini.
 *
 * Struktur: associative multidimensional array
 * Array luar bersifat indexed (list produk),
 * setiap elemen di dalamnya adalah associative array (atribut produk).
 */

$dataProduk = [
    [
        "id"        => 1,
        "nama"      => "Keyboard Mechanical RGB",
        "kategori"  => "Peripheral",
        "harga"     => 450000,
        "stok"      => 12,
        "deskripsi" => "Keyboard mechanical dengan lampu RGB dan switch blue."
    ],
    [
        "id"        => 2,
        "nama"      => "Mouse Wireless",
        "kategori"  => "Peripheral",
        "harga"     => 150000,
        "stok"      => 2,
        "deskripsi" => "Mouse wireless ergonomis dengan baterai tahan lama."
    ],
    [
        "id"        => 3,
        "nama"      => "Monitor LED 24 inch",
        "kategori"  => "Display",
        "harga"     => 1750000,
        "stok"      => 5,
        "deskripsi" => "Monitor LED Full HD 24 inch, refresh rate 75Hz."
    ],
    [
        "id"        => 4,
        "nama"      => "SSD NVMe 512GB",
        "kategori"  => "Storage",
        "harga"     => 650000,
        "stok"      => 1,
        "deskripsi" => "SSD NVMe M.2 dengan kecepatan baca hingga 3500MB/s."
    ],
    [
        "id"        => 5,
        "nama"      => "Webcam Full HD",
        "kategori"  => "Peripheral",
        "harga"     => 320000,
        "stok"      => 8,
        "deskripsi" => "Webcam 1080p dengan mikrofon built-in."
    ],
];
