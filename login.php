<?php
include "connection.php"; // Pastikan file connection.php berisi koneksi database

session_start();

if (isset($_POST['login'])) {
    // Validasi input email dan password
    if (strlen($_POST['email']) <= 2 || strlen($_POST['password']) <= 2) {
        echo "<script>
            alert('Data inputan tidak valid!');
            window.location.href = 'index.php';
        </script>";
        exit;
    } else {
        // Ambil email dan password dari form
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Query untuk mencari data pengguna berdasarkan email
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = $db->query($sql);

        if ($result->num_rows > 0) {
            // Cek password
            $row = mysqli_fetch_assoc($result);
            if (password_verify($password, $row['password'])) {
                // Data yang akan masuk ke bagian dashboard
                $_SESSION['status'] = "login";
                $_SESSION['fullname'] = $row['fullname'];
                $_SESSION['employee_id'] = $row['employee_id'];
                $_SESSION['role'] = $row['role'];

                // Arahkan sesuai dengan role pengguna
                if ($row['role'] == "admin") {
                    header("Location:dashboard_admin/index.php");
                    exit;
                } else {
                    header("Location:dashboard/index.php");
                    exit;
                }
            } else {
                echo "<script>
                    alert('Email atau Password tidak sesuai!');
                    window.location.href = 'index.php';
                </script>";
                exit;
            }
        } else {
            echo "<script>
                alert('Data tidak ditemukan di database!');
                window.location.href = 'index.php';
            </script>";
            exit;
        }
    }
}
?>
