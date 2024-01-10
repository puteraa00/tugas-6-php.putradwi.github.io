<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi Belanja</title>
</head>
<body>
    <h2>Form Input Transaksi Belanja</h2>
    <form method="post" action="">
        <label for="kode_barang">Kode Barang:</label>
        <input type="text" name="kode_barang" required><br>
        
        <label for="jumlah_beli">Jumlah Beli:</label>
        <input type="number" name="jumlah_beli" required><br>
        
        <input type="submit" value="Hitung">
    </form>

    <?php
    // Fungsi untuk mendapatkan detail barang berdasarkan kode
    function getBarangDetails($kode_barang) {
        $barang = array(
            "BRG001" => array("topi", 15000),
            "BRG002" => array("tshirt", 96000),
            "BRG003" => array("jeans", 320000),
            // Tambahkan barang lain sesuai kebutuhan
        );

        return isset($barang[$kode_barang]) ? $barang[$kode_barang] : null;
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $kode_barang = $_POST['kode_barang'];
        $jumlah_beli = $_POST['jumlah_beli'];

        // Mendapatkan detail barang berdasarkan kode
        $barang_details = getBarangDetails($kode_barang);

        if ($barang_details) {
            $nama_barang = $barang_details[0];
            $harga_satuan = $barang_details[1];

            // Menghitung total per barang
            $total_per_barang = $jumlah_beli * $harga_satuan;

            // Diskon 5% jika total pembelian di atas Rp 500.000
            $diskon = ($total_per_barang > 500000) ? 0.05 * $total_per_barang : 0;

            // Total semua per barang dikurangi diskon
            $total_semua = $total_per_barang - $diskon;

            // Menampilkan hasil transaksi
            echo "<h2>Hasil Transaksi Belanja</h2>";
            echo "Kode Barang: $kode_barang<br>";
            echo "Nama Barang: $nama_barang<br>";
            echo "Jumlah Beli: $jumlah_beli<br>";
            echo "Harga Satuan: Rp " . number_format($harga_satuan, 0, ',', '.') . "<br>";
            echo "Total per Barang: Rp " . number_format($total_per_barang, 0, ',', '.') . "<br>";
            echo "Diskon: Rp " . number_format($diskon, 0, ',', '.') . "<br>";
            echo "Total Semua: Rp " . number_format($total_semua, 0, ',', '.');
        } else {
            echo "Kode Barang tidak valid!";
        }
    }
    ?>
</body>
</html>
