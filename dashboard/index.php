<?php
include "../connection.php";
session_start();

if (isset($_POST['logout'])) {
    session_destroy();
    header("Location:../index.php?message=Anda telah Logout");
}

if ($_SESSION['role'] == "admin") {
    header("Location:../dashboard_admin/index.php");
}

if (!isset($_SESSION['status'])) {
    header("Location:../index.php?message=Anda belum Login");
}

$tgl = date('Y-m-d');
?>

<!doctype html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Absensi">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <title>Halaman Absensi</title>
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .cover-container {
            max-width: 42em;
        }
    </style>
</head>

<body class="d-flex h-100 text-center text-bg-dark">

    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
        <header class="mb-auto">
            <div>
                <h3 class="float-md-start mb-0 absensi">ABSENSI PEGAWAI</h3>
                <nav class="nav nav-masthead justify-content-center float-md-end">
                    <a class="nav-link fw-bold py-2 px-2 active" aria-current="page" href="#">Home</a>
                    <a class="nav-link fw-bold py-1 px-0" href="#">
                        <form action="" method="POST">
                            <button type="submit" name="logout" class="btn btn-outline-light">LOGOUT</button>
                        </form>
                    </a>
                </nav>
            </div>
        </header>

        <main class="px-3">
            <h1>Halo <?php echo $_SESSION['fullname']; ?></h1>
            <p class="lead">ID Employee Anda : <?php echo $_SESSION['employee_id'] ?></p>
            <p class="lead">Status Pegawai Anda: <?php echo ucfirst($_SESSION['role'])  ?></p>

            <?php
            if (isset($_GET['message'])) {
                // Cek apakah pesan berisi "Absen Masuk" atau "Absen Keluar" untuk menampilkan alert
                if ($_GET['message'] == "Absen Masuk Berhasil" || $_GET['message'] == "Absen Keluar Berhasil") {
                    echo "<script>alert('" . $_GET['message'] . "');</script>";
                } elseif ($_GET['message'] == "Pengajuan Izin Berhasil Diajukan") {
                    echo "<script>alert('Pengajuan Izin Berhasil');</script>";
                } else {
                    echo "<div class='toast align-items-center text-bg-success' role='alert' aria-live='assertive' aria-atomic='true'>
                            <div class='d-flex'>
                                <div class='toast-body'>
                                    " . $_GET['message'] . "
                                </div>
                                <button type='button' class='btn-close btn-close-white' data-bs-dismiss='toast' aria-label='Close'></button>
                            </div>
                          </div>";
                }
            }
            ?>

            <!-- Tabel Absensi -->
            <h3>Absensi</h3>
            <?php include 'absensi.php'; ?>

            <!-- Tombol untuk Absen dan Pengajuan Izin -->
            <div class="mt-4 d-flex justify-content-between">
                <form action="action.php" method="POST">
                    <button type="submit" name="absen" class="btn btn-outline-success">ABSEN MASUK</button>
                </form>
                <button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#leaveModal">PENGAJUAN IZIN</button>
            </div>

            <!-- Modal Pengajuan Izin -->
            <div class="modal fade" id="leaveModal" tabindex="-1" aria-labelledby="leaveModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="leaveModalLabel">Form Pengajuan Izin</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="action.php" method="POST">
                                <div class="mb-3">
                                    <label for="leave_type" class="form-label">Jenis Izin</label>
                                    <select class="form-select" name="leave_type" id="leave_type" required>
                                        <option value="Cuti">Cuti</option>
                                        <option value="Sakit">Sakit</option>
                                        <option value="Lainnya">Lainnya</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="start_date" class="form-label">Tanggal Mulai</label>
                                    <input type="date" class="form-control" name="start_date" id="start_date" required>
                                </div>

                                <div class="mb-3">
                                    <label for="end_date" class="form-label">Tanggal Akhir</label>
                                    <input type="date" class="form-control" name="end_date" id="end_date" required>
                                </div>

                                <div class="mb-3" id="other_reason_div" style="display:none;">
                                    <label for="other_reason" class="form-label">Alasan</label>
                                    <textarea class="form-control" name="other_reason" id="other_reason" rows="3" placeholder="Tuliskan alasan izin"></textarea>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                    <button type="submit" name="submit_leave_request" class="btn btn-primary">Ajukan Izin</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Menampilkan kolom alasan jika "Lainnya" dipilih
        document.getElementById('leave_type').addEventListener('change', function() {
            var otherReasonDiv = document.getElementById('other_reason_div');
            if (this.value == 'Lainnya') {
                otherReasonDiv.style.display = 'block';
            } else {
                otherReasonDiv.style.display = 'none';
            }
        });
    </script>

</body>

</html>
