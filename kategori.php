<?php 
    require "session.php";
    require "connect.php";

    $queryKategori = mysqli_query($con, "SELECT * FROM kategori");
    $jumlahKategori = mysqli_num_rows($queryKategori); // Corrected variable name
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori</title>
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
                <li class="breadcrumb-item active" aria-current="page"></li>
                    <a href="index.php" class="no-decoration text-muted">
                        <i class="fas fa-home"></i>Home</li></a>
                <li class="breadcrumb-item active" aria-current="page">
                     / Kategori</li>
            </ol>
            </nav>
        <div class="my-5 col-12 md-6">
            <h3>Tambah Kategori</h3>
            <form action="" method="post">
                <div>
                    <label for="Kategori"></label>
                    <input type="text" name="kategori" id="kategori" class="form-control" placeholder="Masukan Nama kategori">
                </div>
                <div>
                    <button type="submit" class="btn btn-primary mt-3" name="simpan_Kategori">Tambah</button>
                </div>
            </form>
            
            <?php
                if(isset($_POST['simpan_Kategori'])){
                    $kategori = $_POST['kategori'];
                    $queryExist = mysqli_query($con, "SELECT nama FROM kategori WHERE nama='$kategori'");
                    $jumlahKategoriBaru = mysqli_num_rows($queryExist);
                    
                    if($jumlahKategoriBaru > 0){
                        ?>
                            <div class="alert alert-danger mt-3" role="alert">
                                Kategori sudah ada
                            </div>
                        <?php
                    } else {
                        // Add your code for inserting the new category here
                        $queryInsert = mysqli_query($con, "INSERT INTO kategori (nama) VALUES ('$kategori')");
                        if ($queryInsert) {
                            ?>
                                <div class="alert alert-success mt-3" role="alert">
                                    Kategori berhasil ditambahkan
                                </div>
                                <meta http-equiv="refresh" content="1;url=kategori.php">
                            <?php
                        } else {
                            ?>
                                <div class="alert alert-danger mt-3" role="alert">
                                    Gagal menambahkan kategori
                                </div>
                            <?php
                        }
                    }
                }
            ?>
            
        </div>
        <div>
            <h2>Kategori</h2>
            <div class="table-responsive mt-5">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        
                                if($jumlahKategori==0){
                        ?>
                                    <tr>
                                        <td colspan="3" class="text-center">Tidak ada data</td>
                                    </tr>
                        <?php
                                }
                                else{
                                    $jumlah = 1;
                                    while($data= mysqli_fetch_array($queryKategori)){
                        ?>
                                    <tr>
                                        <td><?php echo $jumlah ?></td>
                                        <td><?php echo $data['nama'] ?></td>
                                        <td>
                                            <a href="kategoriDetail.php?q=<?php echo $data['id']; ?>" class="btn btn-info">
                                                <i class="fas fa-search"></i>
                                            </a>
                                        </td>
                                    </tr>
                        <?php
                                $jumlah++;
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