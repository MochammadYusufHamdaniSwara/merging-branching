<?php
require './config/db.php';

// Mendapatkan ID produk dari parameter URL
$id = $_GET['id'];

// Ambil data produk berdasarkan ID
$product = mysqli_query($db_connect, "SELECT * FROM products WHERE id = $id");
$row = mysqli_fetch_assoc($product);

if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $image = $_POST['image']; // Jika ingin mengubah gambar juga

    // Update data produk
    mysqli_query($db_connect, "UPDATE products SET name='$name', price='$price', image='$image' WHERE id=$id");

    // Redirect ke halaman data produk
    header("Location: show.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow p-4">
                    <h1 class="text-center">Edit Produk</h1>
                    <form method="post">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Produk:</label>
                            <input type="text" id="name" name="name" class="form-control" value="<?= $row['name']; ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="price" class="form-label">Harga:</label>
                            <input type="text" id="price" name="price" class="form-control" value="<?= $row['price']; ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Gambar URL:</label>
                            <input type="text" id="image" name="image" class="form-control" value="<?= $row['image']; ?>">
                        </div>

                        <button type="submit" name="update" class="btn btn-primary w-100">Update</button>
                    </form>
                    <a href="index.php" class="btn btn-secondary w-100 mt-3">Kembali ke Data Produk</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
