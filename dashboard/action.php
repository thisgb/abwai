<?php
include "../connection.php";
session_start();
date_default_timezone_set("Asia/Jakarta");
$employee_id = $_SESSION['employee_id'];

if (isset($_POST['submit_leave_request'])) {
    $leave_type = $_POST['leave_type'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    // Jika memilih "Lainnya", ambil alasan
    if ($leave_type == "Lainnya") {
        $other_reason = $_POST['other_reason'];
        $leave_type = $other_reason; // Menyimpan alasan sebagai jenis izin
    }

    // Menyimpan data izin
    $sql = "INSERT INTO leave_requests (employee_id, leave_type, start_date, end_date, status) 
            VALUES ('$employee_id', '$leave_type', '$start_date', '$end_date', 'Pending')";

    if ($db->query($sql) === TRUE) {
        header("Location: index.php?message=Pengajuan Izin Berhasil Diajukan");
    } else {
        header("Location: index.php?message=Gagal Mengajukan Izin");
    }
}

// Mengubah redirect untuk Absen Masuk dan Absen Keluar
if (isset($_POST['absen'])) {
    $tgl = date('Y-m-d');
    $clock_in = date('H:i:s');
    $sql = "INSERT INTO attendances (employee_id, tgl, clock_in) VALUES ('$employee_id', '$tgl', '$clock_in')";
    if ($db->query($sql) === TRUE) {
        header("Location: index.php?message=Absen Masuk Berhasil");
    } else {
        header("Location: index.php?message=Gagal Absen Masuk");
    }
}

if (isset($_POST['keluar'])) {
    $clock_out = date('H:i:s');
    $sql = "UPDATE attendances SET clock_out = '$clock_out' WHERE employee_id = '$employee_id' AND clock_out IS NULL";
    if ($db->query($sql) === TRUE) {
        header("Location: index.php?message=Absen Keluar Berhasil");
    } else {
        header("Location: index.php?message=Gagal Absen Keluar");
    }
}
?>
