<?php 
    require "session.php";
    require "connect.php";

    $id = $_GET["q"];
    $query = mysqli_query($con, "SELECT * FROM kategori WHERE id = '$id'");
    $data = mysqli_fetch_array($query);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
    <?php require "navbar.php" ?>
    <div class="container">
        <h2>Detail Kategori</h2>
        <form action="" method="post">
            <div>
                <label for="Kategori"></label>
                <input type="text" name="kategori" id="kategori" class="form-control" placeholder="Masukan Nama kategori" value="<?php echo $data['nama'] ?>">
            </div>
            <div class="pd-3 d-fle justify-content-between">
                <button type="submit" class="btn btn-primary mt-3" name="simpan_Kategori">Simpan</button>
                <button type="submit" class="btn btn-danger mt-3" name="delete_Kategori">Hapus</button>
        </form>    
        <?php 
            if(isset($_POST['simpan_Kategori'])){
                $kategori = $_POST['kategori'];

                if($data['nama']==$kategori){
                    ?>
                    <meta http-equiv="refresh" content="0;url=kategori.php" />
                    <?php
                }
                else{
                    $query = mysqli_query($con, "SELECT * FROM kategori WHERE nama='$kategori'");
                    $jumlahKategoriBaru = mysqli_num_rows($query);
                    if($jumlahKategoriBaru> 0){
                    ?>
                        <div class="alert alert-danger mt-3" role="alert">
                            Kategori sudah ada
                        </div>
                    <?php
                }
                else{
                    $querySimpan = mysqli_query($con, "Update kategori SET nama='$kategori' WHERE id='$id'");
                    if ($querySimpan) {
                    ?>
                        <div class="alert alert-success mt-3" role="alert">
                            Kategori berhasil diupdate
                        </div>
                        <meta http-equiv="refresh" content="1;url=kategori.php">
                    <?php
                    }
                }
            }
        }
        ?>
        <?php 
        if(isset($_POST['delete_Kategori'])){
            $queryDelete = mysqli_query($con, "DELETE FROM kategori WHERE id='$id'");
            
            if ($queryDelete) {
                ?>
                    <div class="alert alert-success mt-3" role="alert">
                        Kategori berhasil dihapus
                    </div>
                    <meta http-equiv="refresh" content="1;url=kategori.php">
                <?php
            }
        }
        ?>
            </div>
    </div>
</body>
</html>