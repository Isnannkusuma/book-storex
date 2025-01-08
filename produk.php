<?php 
    session_start();
    require "connect.php"; // Ensure this file sets up the $con variable

    $queryProduk = mysqli_query($con, "SELECT * FROM produk");
    $jumlahProduk = mysqli_num_rows($queryProduk); // Corrected variable name

    $queryKategori = mysqli_query($con,"SELECT * FROM kategori");

    if (isset($_POST['simpan_Produk'])) {
        $nama = $_POST['nama'];
        $kategori = $_POST['kategori'];
        $harga = $_POST['harga'];
        $ketersediaan_stok = $_POST['ketersediaan_stok'];

        if ($nama == '' || $kategori == '' || $harga == '') {
            $error = "Nama, kategori, dan harga harus wajib di isi!";
        } else {
            // Check if the kategori_id exists in the kategori table
            $queryCheckKategori = mysqli_query($con, "SELECT * FROM kategori WHERE id='$kategori'");
            if (mysqli_num_rows($queryCheckKategori) > 0) {
                // Process the form data here (e.g., insert into the database)
                $querySimpan = mysqli_query($con, "INSERT INTO produk (kategori_id, nama, harga, ketersediaan_stok) VALUES ('$kategori', '$nama', '$harga', '$ketersediaan_stok')");
                if ($querySimpan) {
                    $success = "Nama, kategori, dan harga berhasil disimpan";
                } else {
                    $error = "Terjadi kesalahan saat menambahkan produk: " . mysqli_error($con);
                }
            } else {
                $error = "Kategori tidak valid!";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk</title>
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/all.min.css">
</head>
<style>
    .no-decoration {
        text-decoration: none;
    }
</style>
<body>
    <?php require "navbar.php" ?>
    <div class="container mt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="index.php" class="no-decoration text-muted">
                        <i class="fas fa-home"></i>Home</a> / Buku
                </li>
            </ol>
        </nav>
        <div class="my-5 col-12 md-6">
            <h3>List Produk</h3>
            <form action="" method="post">
                <div>
                    <label for="nama">Nama :</label>
                    <input type="text" id="nama" name="nama" class="form-control" placeholder="Masukan Nama">
                </div>
                <div>
                    <label for="kategori">Kategori :</label>
                    <select name="kategori" id="kategori" class="form-control">
                        <option value="">Pilih Satu Kategori</option>
                        <?php
                        while ($kategori = mysqli_fetch_assoc($queryKategori)) {
                            echo "<option value='{$kategori['id']}'>{$kategori['nama']}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div>
                    <label for="harga">Harga :</label>
                    <input type="text" id="harga" name="harga" class="form-control" placeholder="Masukan Harga">
                </div>
                <div>
                    <label for="ketersediaan_stok">Stok :</label>
                    <select name="ketersediaan_stok" id="ketersediaan_stok" class="form-control">
                        <option value="tersedia">Tersedia</option>
                        <option value="habis">Habis</option>
                    </select>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary mt-3" name="simpan_Produk">Tambah</button>
                </div>
            </form>
            <?php
            if (isset($error)) {
                ?>
                <div class="alert alert-warning mt-5" role="alert">
                    <?php echo $error; ?>
                </div>
                <?php
            }
            if (isset($success)) {
                ?>
                <div class="alert alert-success mt-5" role="alert">
                    <?php echo $success; ?>
                </div>
                <meta http-equiv="refresh" content="1;url=produk.php">
                <?php
            }
            ?>
        </div>
        <div class="table-responsive mt-5">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Produk</th>
                        <th scope="col">Kategori</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Ketersediaan Stok</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        if($jumlahProduk == 0){
                            ?>
                                <tr>
                                    <td colspan="6" class="text-center">Belum ada Buku</td>
                                </tr>
                            <?php
                        } else {
                            $no = 1;
                            while ($produk = mysqli_fetch_assoc($queryProduk)) {
                                $kategoriId = $produk['kategori_id'];
                                $queryKategoriNama = mysqli_query($con, "SELECT nama FROM kategori WHERE id='$kategoriId'");
                                $kategoriNama = mysqli_fetch_assoc($queryKategoriNama)['nama'];
                                ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $produk['nama']; ?></td>
                                    <td><?php echo $kategoriNama; ?></td>
                                    <td><?php echo $produk['harga']; ?></td>
                                    <td><?php echo $produk['ketersediaan_stok']; ?></td>
                                    <td>
                                        <a href="produkDetail.php?q=<?php echo $produk['id']; ?>" class="btn btn-info">
                                            <i class="fas fa-search"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/b0f61f6459.js" crossorigin="anonymous"></script>
</body>
</html>