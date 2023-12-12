<?php

use Master\Pegawai;
use Master\Jabatan;
use Master\Status;
use Master\Menu;

include ('autoload.php'); 
include('Config/Database.php'); 

$menu = new Menu(); 
$pegawai = new Pegawai($dataKoneksi);
$jabatan = new Jabatan($dataKoneksi);
$status = new Status($dataKoneksi);
// $pegawai->tambah();
$target = @$_GET['target'];
$act = @$_GET['act'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moh Zainuddin</title>
    <link href="assets/bootstrap/css/bootstrap.css" rel="stylesheet">
    <script scr="assets/bootstrap/js/bootstrap.bundle.min.js" ></script>
</head>

<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">SI Kehadiran Pegawai</a>
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
                echo "Hai, Selamat datang di Website";
                // ========== star kontent pegawai ================
            } elseif ($target == "pegawai") {
                if ($act == "tambah_pegawai") {
                    echo $pegawai->tambah();
                } elseif ($act == "simpan_pegawai") {
                    if ($pegawai->simpan()) {
                        echo "<script>
                            alert('data suskess disimpan');
                            window.location.href='?target=pegawai';
                            </script>";
                    } else {
                        echo "<script>
                        alert('data gagal disimpan');
                        window.location.href='?target=pegawai';
                        </script>";
                    }
                } elseif ($act == "edit_pegawai") {
                    $id = $_GET['id'];
                    echo $pegawai->edit($id);
                } elseif ($act == "update_pegawai") {
                    if ($pegawai->update()) {
                        echo "<script>
                            alert('data suksess diubah');
                            window.location.href='?target=pegawai';
                        </script>";
                    } else {
                        echo "<script>
                        alert('data gagal diubah');
                        window.location.href='?target=pegawai';
                        </script>";
                    }
                } elseif ($act == "delete_pegawai") {
                    $id = $_GET['id'];
                    if ($pegawai->delete($id)) {
                        echo "<script>
                        alert('data suksess dihapus');
                        window.location.href='?target=pegawai';
                        </script>";
                    } else {
                        echo "<script>
                        alert('data gagal dihapus');
                        window.location.href='?target=pegawai';
                        </script>";
                    }
                } else {
                    echo $pegawai->index();
                }
                // ======================== end kontent pegawai =====================
                // ======================== Star kontent dosen ========================
            } elseif ($target == "jabatan") {
                if ($act == "tambah_jabatan") {
                    echo $jabatan->tambah();
                } elseif ($act == "simpan_jabatan") {
                    if ($jabatan->simpan()) {
                        echo "<script>
                            alert('data suskess disimpan');
                            window.location.href='?target=jabatan';
                            </script>";
                    } else {
                        echo "<script>
                        alert('data gagal disimpan');
                        window.location.href='?target=jabatan';
                        </script>";
                    }
                } elseif ($act == "edit_jabatan") {
                    $id = $_GET['id'];
                    echo $jabatan->edit($id);
                } elseif ($act == "update_jabatan") {
                    if ($jabatan->update()) {
                        echo "<script>
                            alert('data suksess diubah');
                            window.location.href='?target=jabatan';
                        </script>";
                    } else {
                        echo "<script>
                        alert('data gagal diubah');
                        window.location.href='?target=jabatan';
                        </script>";
                    }
                } elseif ($act == "delete_jabatan") {
                    $id = $_GET['id'];
                    if ($jabatan->delete($id)) {
                        echo "<script>
                        alert('data suksess dihapus');
                        window.location.href='?target=jabatan';
                        </script>";
                    } else {
                        echo "<script>
                        alert('data gagal dihapus');
                        window.location.href='?target=jabatan';
                        </script>";
                    }
                } else {
                    echo $jabatan->index();
                }

                // ======================== Star kontent prodi ========================
            } elseif ($target == "status") {
                if ($act == "tambah_status") {
                    echo $status->tambah();
                } elseif ($act == "simpan_status") {
                    if ($status->simpan()) {
                        echo "<script>
                            alert('data suskess disimpan');
                            window.location.href='?target=status';
                            </script>";
                    } else {
                        echo "<script>
                        alert('data gagal disimpan');
                        window.location.href='?target=status';
                        </script>";
                    }
                } elseif ($act == "edit_status") {
                    $id = $_GET['id'];
                    echo $status->edit($id);
                } elseif ($act == "update_status") {
                    if ($status->update()) {
                        echo "<script>
                            alert('data suksess diubah');
                            window.location.href='?target=status';
                        </script>";
                    } else {
                        echo "<script>
                        alert('data gagal diubah');
                        window.location.href='?target=status';
                        </script>";
                    }
                } elseif ($act == "delete_status") {
                    $id = $_GET['id'];
                    if ($status->delete($id)) {
                        echo "<script>
                        alert('data suksess dihapus');
                        window.location.href='?target=status';
                        </script>";
                    } else {
                        echo "<script>
                        alert('data gagal dihapus');
                        window.location.href='?target=status';
                        </script>";
                    }
                } else {
                    echo $status->index();
                }
            } else {
                echo " Page 404 Not Found";
            }
            ?>
            
            </div>
        </div>

</body>

</html>