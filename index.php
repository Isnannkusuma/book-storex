<?php 
    require  "session.php";
    require "connect.php";

    $queryKategori = mysqli_query($con, "SELECT * FROM kategori");
    $jumlahKategori = mysqli_num_rows($queryKategori); // Corrected variable name

    $queryProduk = mysqli_query($con, "SELECT * FROM produk");
    $jumlahProduk = mysqli_num_rows($queryProduk); // Corrected variable name
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/all.min.css">
    <title>Document</title>
</head>

<style>
     body {
        background-image: url('pappper.jpg');
        background-size: 130%;
        background-repeat: no-repeat;
        background-position: center;
    }
    .kotak {
        border: solid;
    }
    .summary-kategori {
        background-color:rgb(255, 204, 0);
        border-radius: 10px;
    }
    .summary-produk{
        background-color:rgb(255, 162, 0);
        border-radius: 15px;
    }
    .no-decoration {
        text-decoration: none;
    }
    .greeting {
        color: white;
    }
    .breadcrumb-item {
        color: white;
    }
    
</style>
<body>
    <?php require "navbar.php" ?>
    <div class="container mt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <i class="fas fa-home"></i>Home</li>
            </ol>
        </nav>
        <h2 class="greeting">Halo <?php echo $_SESSION['username']?></h2>
        <div class="containe mt-5">
            <div class="row">
                <div class="col-lg-4 col-md-6 co-12 mb-3">
                    <div class="summary-kategori p-3">
                        <div class="row">
                            <div class="col-6">
                                <i class="fas fa-align-justify fa-7x text-black-50"></i>
                            </div>
                            <div class="col-6 text-white">
                                <h3>Kategori</h3>
                                <p class="fs-4"><?php echo $jumlahKategori; ?></p>
                                <a href="kategori.php" class="text-white no-decoration">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="containe mt-5">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="summary-produk p-3">
                        <div class="row">
                            <div class="col-6">
                                <i class="fas fa-book fa-7x text-black-50"></i>
                            </div>
                            <div class="col-6 text-white">
                                <h3>Buku</h3>
                                <p class="fs-4"><?php echo $jumlahProduk?></p>
                                <a href="produk.php" class="text-white no-decoration">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/b0f61f6459.js" crossorigin="anonymous"></script>
</html>