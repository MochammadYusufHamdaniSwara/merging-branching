<?php
require './config/db.php';

// Periksa apakah parameter id ada
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "ID produk tidak valid.";
    exit();
}

$id = intval($_GET['id']);

// Mendapatkan data produk berdasarkan ID
$product_result = mysqli_query($db_connect, "SELECT * FROM products WHERE id = $id");
$product = mysqli_fetch_assoc($product_result);

if (!$product) {
    echo "Produk tidak ditemukan.";
    exit();
}

// Jika metode adalah POST, lakukan penghapusan
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    mysqli_query($db_connect, "DELETE FROM products WHERE id = $id");
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hapus Produk</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow p-4">
                    <h1 class="text-center text-danger">Hapus Produk</h1>
                    <p class="text-center">Apakah Anda yakin ingin menghapus produk berikut?</p>
                    <div class="mb-3">
                        <strong>Nama Produk:</strong> <?= htmlspecialchars($product['name']); ?>
                    </div>
                    <div class="mb-3">
                        <strong>Harga Produk:</strong> <?= htmlspecialchars($product['price']); ?>
                    </div>
                    <form method="post">
                        <div class="d-flex justify-content-between">
                            <a href="index.php" class="btn btn-secondary">Batal</a>
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
