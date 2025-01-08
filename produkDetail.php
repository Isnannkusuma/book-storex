<?php 
    require "session.php";
    require "connect.php";

    $id = $_GET["q"];
    $query = mysqli_query($con, "SELECT * FROM produk WHERE id = '$id'");
    $data = mysqli_fetch_array($query);

    $queryKategori = mysqli_query($con, "SELECT * FROM kategori");

    if (isset($_POST['simpan_Produk'])) {
        $nama = $_POST['nama'];
        $kategori = $_POST['kategori'];
        $harga = $_POST['harga'];
        $ketersediaan_stok = $_POST['ketersediaan_stok'];

        if ($nama == '' || $kategori == '' || $harga == '') {
            $error = "Nama, kategori, dan harga harus wajib di isi!";
        } else {
            $queryCheckKategori = mysqli_query($con, "SELECT * FROM kategori WHERE id='$kategori'");
            if (mysqli_num_rows($queryCheckKategori) > 0) {
                $querySimpan = mysqli_query($con, "UPDATE produk SET kategori_id='$kategori', nama='$nama', harga='$harga', ketersediaan_stok='$ketersediaan_stok' WHERE id='$id'");
                if ($querySimpan) {
                    $success = "Produk berhasil diupdate";
                } else {
                    $error = "Terjadi kesalahan saat mengupdate produk: " . mysqli_error($con);
                }
            } else {
                $error = "Kategori tidak valid!";
            }
        }
    }

    if (isset($_POST['delete_Produk'])) {
        $queryDelete = mysqli_query($con, "DELETE FROM produk WHERE id='$id'");
        if ($queryDelete) {
            $success = "Produk berhasil dihapus";
            header("Location: produk.php");
            exit();
        } else {
            $error = "Terjadi kesalahan saat menghapus produk: " . mysqli_error($con);
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk</title>
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
    <?php require "navbar.php" ?>
    <div class="container">
        <h2>Detail Produk</h2>
        <form action="" method="post">
            <div>
                <label for="nama">Nama :</label>
                <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukan Nama produk" value="<?php echo $data['nama'] ?>">
            </div>
            <div>
                <label for="kategori">Kategori :</label>
                <select name="kategori" id="kategori" class="form-control">
                    <?php
                    while ($kategori = mysqli_fetch_assoc($queryKategori)) {
                        $selected = $kategori['id'] == $data['kategori_id'] ? 'selected' : '';
                        echo "<option value='{$kategori['id']}' $selected>{$kategori['nama']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div>
                <label for="harga">Harga :</label>
                <input type="text" name="harga" id="harga" class="form-control" placeholder="Masukan Harga" value="<?php echo $data['harga'] ?>">
            </div>
            <div>
                <label for="ketersediaan_stok">Stok :</label>
                <select name="ketersediaan_stok" id="ketersediaan_stok" class="form-control">
                    <option value="tersedia" <?php echo $data['ketersediaan_stok'] == 'tersedia' ? 'selected' : ''; ?>>Tersedia</option>
                    <option value="habis" <?php echo $data['ketersediaan_stok'] == 'habis' ? 'selected' : ''; ?>>Habis</option>
                </select>
            </div>
            <div class="pd-3 d-flex justify-content-between">
                <button type="submit" class="btn btn-primary mt-3" name="simpan_Produk">Simpan</button>
                <button type="submit" class="btn btn-danger mt-3" name="delete_Produk">Hapus</button>
            </div>
        </form>    
        <?php 
            if (isset($error)) {
                ?>
                <div class="alert alert-danger mt-3" role="alert">
                    <?php echo $error; ?>
                </div>
                <?php
            }
            if (isset($success)) {
                ?>
                <div class="alert alert-success mt-3" role="alert">
                    <?php echo $success; ?>
                </div>
                <meta http-equiv="refresh" content="1;url=produk.php">
                <?php
            }
        ?>
    </div>
</body>
</html>