<?php

use Master\Layanan;
use Master\Admin;
use Master\User;
use Master\Menu;

include ('autoload.php'); 
include('Config/Database.php'); 

$menu = new Menu(); 
$admin = new Admin($dataKoneksi);
// $admin->tambah();
$target = @$_GET['target'];
$act = @$_GET['act'];

$menu = new Menu();
$layanan = new Layanan($dataKoneksi);
// $layanan->tambah();
$target = @$_GET['target'];
$act = @$_GET['act'];

$menu = new Menu();
$user = new User($dataKoneksi);
// $user->tambah();
$target = @$_GET['target'];
$act = @$_GET['act'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PA Banyuwangi</title>
    <link href="assets/bootstrap/css/bootstrap.css" rel="stylesheet">
    <script scr="assets/bootstrap/js/bootstrap.bundle.min.js" ></script>
</head>

<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark bg-success">
            <div class="container-fluid">
                <a class="navbar-brand" href="#"><img src="assets/bootstrap/img/logoPA.png" width="45px"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#MyMenu" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse id="MyMenu">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <?php
                foreach ($menu->topMenu() as $r) {
                    ?>
                    <li class="nav-item">
                        <a href="<?php echo $r['Link']; ?>" class="nav-link">
                            <?php echo $r['Text']; ?>
                        </a>
                    </li>
                    <?php
                }
            ?>
            </ul>
            </div>
            </div>
        </nav>
        <br>
        <div class="Content">
            <h5>Content <?php echo strtoupper($target); ?></h5>
            <?php
            if (!isset($target) or $target == "home") {
                echo "Hai, Selamat Datang Di Website Kami";
                // ========== star kontent admin ================
            } elseif ($target == "admin") {
                if ($act == "tambah_admin") {
                    echo $admin->tambah();
                } elseif ($act == "simpan_admin") {
                    if ($admin->simpan()) {
                        echo "<script>
                            alert('data suskess disimpan');
                            window.location.href='?target=admin';
                            </script>";
                    } else {
                        echo "<script>
                        alert('data gagal disimpan');
                        window.location.href='?target=admin';
                        </script>";
                    }
                } elseif ($act == "edit_admin") {
                    $id_admin = $_GET['id_admin'];
                    echo $admin->edit($id_admin);
                } elseif ($act == "update_admin") {
                    if ($admin->update()) {
                        echo "<script>
                            alert('data suksess diubah');
                            window.location.href='?target=admin';
                        </script>";
                    } else {
                        echo "<script>
                        alert('data gagal diubah');
                        window.location.href='?target=admin';
                        </script>";
                    }
                } elseif ($act == "delete_admin") {
                    $id_admin = $_GET['id_admin'];
                    if ($admin->delete($id_admin)) {
                        echo "<script>
                        alert('data suksess dihapus');
                        window.location.href='?target=admin';
                        </script>";
                    } else {
                        echo "<script>
                        alert('data gagal dihapus');
                        window.location.href='?target=admin';
                        </script>";
                    }
                } else {
                    echo $admin->index();
                }
                // ======================== end kontent admin =====================
                // ======================== Star kontent layanan ========================
            } elseif ($target == "layanan") {
                if ($act == "tambah_layanan") {
                    echo $layanan->tambah();
                } elseif ($act == "simpan_layanan") {
                    if ($layanan->simpan()) {
                        echo "<script>
                            alert('data suskess disimpan');
                            window.location.href='?target=layanan';
                            </script>";
                    } else {
                        echo "<script>
                        alert('data gagal disimpan');
                        window.location.href='?target=layanan';
                        </script>";
                    }
                } elseif ($act == "edit_layanan") {
                    $id_layanan = $_GET['id_layanan'];
                    echo $layanan->edit($id_layanan);
                } elseif ($act == "update_layanan") {
                    if ($layanan->update()) {
                        echo "<script>
                            alert('data suksess diubah');
                            window.location.href='?target=layanan';
                        </script>";
                    } else {
                        echo "<script>
                        alert('data gagal diubah');
                        window.location.href='?target=layanan';
                        </script>";
                    }
                } elseif ($act == "delete_layanan") {
                    $id_layanan = $_GET['id_layanan'];
                    if ($layanan->delete($id_layanan)) {
                        echo "<script>
                        alert('data suksess dihapus');
                        window.location.href='?target=layanan';
                        </script>";
                    } else {
                        echo "<script>
                        alert('data gagal dihapus');
                        window.location.href='?target=layanan';
                        </script>";
                    }
                } else {
                    echo $layanan->index();
                }

                // ======================== end kontent layanan =====================
                // ======================== Star kontent user ========================
            } elseif ($target == "user") {
                if ($act == "tambah_user") {
                    echo $user->tambah();
                } elseif ($act == "simpan_user") {
                    if ($user->simpan()) {
                        echo "<script>
                            alert('data suskess disimpan');
                            window.location.href='?target=user';
                            </script>";
                    } else {
                        echo "<script>
                        alert('data gagal disimpan');
                        window.location.href='?target=user';
                        </script>";
                    }
                } elseif ($act == "edit_user") {
                    $id_user = $_GET['id_user'];
                    echo $user->edit($id_user);
                } elseif ($act == "update_user") {
                    if ($user->update()) {
                        echo "<script>
                            alert('data suksess diubah');
                            window.location.href='?target=user';
                        </script>";
                    } else {
                        echo "<script>
                        alert('data gagal diubah');
                        window.location.href='?target=user';
                        </script>";
                    }
                } elseif ($act == "delete_user") {
                    $id_user = $_GET['id_user'];
                    if ($user->delete($id_user)) {
                        echo "<script>
                        alert('data suksess dihapus');
                        window.location.href='?target=user';
                        </script>";
                    } else {
                        echo "<script>
                        alert('data gagal dihapus');
                        window.location.href='?target=user';
                        </script>";
                    }
                } else {
                    echo $user->index();
                }
                // ======================== end kontent user =====================
            }
            ?>
            
            
            </div>
        </div>

</body>

</html>