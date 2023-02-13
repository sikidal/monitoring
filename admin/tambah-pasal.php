<?php
session_start();
if ($_SESSION['peran'] == "USER") {
    header("Location: logout.php");
    exit;
}
if (!isset($_SESSION['login'])) {
    header("Location: ../index.php");
    exit;
}

include '../koneksi.php';

date_default_timezone_set('Asia/Singapore');
if (isset($_POST["submit"])) {
    $id_bab = htmlspecialchars($_POST["id_bab"]);
    $pasal = htmlspecialchars($_POST["pasal"]);
    $isi = htmlspecialchars($_POST["isi"]);
    // echo "INSERT INTO pasal VALUES ('','id_bab','$pasal','keterangan')";
    $query = "INSERT INTO pasal VALUES ('','$id_bab','$pasal','$isi')";
    $simpan = mysqli_query($conn, $query);

    if ($simpan) {
        echo "<script type='text/javascript'>
    alert('Data Berhasil Disimpan');
    document.location.href = 'p3sps.php'
    </script>
    ";
    } else {
        echo "<script type='text/javascript'>
    alert('Data gagal disimpan');
    document.location.href = 'tambah-pasal.php'
    </script>
    ";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Pasal P3SPS | KPID Kalsel</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="shortcut icon" href="../dist/img/user.png">
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <?php include "theme-header.php"; ?>
        <?php include "theme-sidebar.php"; ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>TAMBAH PASAL</h1>
                        </div>
                        <div class="col-md-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item"><a href="p3sps.php">P3SPS</a></li>
                                <li class="breadcrumb-item active">Tambah PASAL</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">TAMBAH PASAL</h3>
                                </div>
                                <form action="" method="post">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label>BAB</label>
                                            <select name="id_bab" class="form-control" required="required">
                                                <option value="">- Pilih -</option>
                                                <?php
                                                $bab = mysqli_query($conn, "SELECT * FROM bab ORDER BY bab ASC");
                                                while ($k = mysqli_fetch_array($bab)) {
                                                ?>
                                                    <option value="<?php echo $k['id_bab']; ?>">
                                                        <?php echo $k['bab']; ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-grup">
                                            <label for="pasal">PASAL : </label>
                                            <input type="text" class="form-control" id="pasal" name="pasal" placeholder="Masukkan Pasal" required>
                                        </div>
                                        <div class="form-grup">
                                            <label for="isi">Keterangan : </label>
                                            <input type="text" class="form-control" id="isi" name="isi" placeholder="Masukkan keterangan" required>
                                        </div>

                                        <input type="hidden" id="id" name="id" value="<?php echo $_SESSION["id"]; ?>">
                                    </div>
                                    <div class="footer">
                                        <button class="btn btn-primary mr-1" type="submit" name="submit">Simpan</button>
                                        <a href="p3sps.php" class="btn btn-secondary mr-1">Batal</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <!-- jQuery -->
        <script src=" ../plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- DataTables  & Plugins -->
        <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js">
        </script>
        <script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js">
        </script>
        <script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js">
        </script>
        <script src="../plugins/datatables-buttons/js/dataTables.buttons.min.js">
        </script>
        <script src="../plugins/datatables-buttons/js/buttons.bootstrap4.min.js">
        </script>
        <script src="../plugins/jszip/jszip.min.js"></script>
        <script src="../plugins/pdfmake/pdfmake.min.js"></script>
        <script src="../plugins/pdfmake/vfs_fonts.js"></script>
        <script src="../plugins/datatables-buttons/js/buttons.html5.min.js">
        </script>
        <script src="../plugins/datatables-buttons/js/buttons.print.min.js">
        </script>
        <script src="../plugins/datatables-buttons/js/buttons.colVis.min.js">
        </script>
        <!-- AdminLTE App -->
        <script src="../dist/js/adminlte.min.js"></script>
        <!-- AdminLTE for demo purposes -->

        <!-- Page specific script -->
        <script>
            $(function() {
                $("#example1").DataTable({
                    "responsive": true,
                    "lengthChange": false,
                    "autoWidth": false,
                    "buttons": ["copy", "csv", "excel", "pdf", "print"]
                }).buttons().container().appendTo(
                    '#example1_wrapper .col-md-6:eq(0)');
                $('#example2').DataTable({
                    "paging": true,
                    "lengthChange": false,
                    "searching": false,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                    "responsive": true,
                });
            });
        </script>
    </div>
</body>
<?php include 'theme-footer.php'; ?>