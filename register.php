<?php
include "connection.php"; // Pastikan file connection.php berisi koneksi database

session_start();

if (isset($_POST['register'])) {
    // Validasi input email, password, dan nama lengkap
    if (strlen($_POST['email']) <= 2 || strlen($_POST['password']) <= 2 || strlen($_POST['fullname']) <= 2) {
        echo "<script>
            alert('Data inputan tidak valid!');
            window.location.href = 'register.php';
        </script>";
        exit;
    } else {
        // Ambil data form register
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password
        $fullname = $_POST['fullname'];

        // Periksa apakah email sudah terdaftar
        $sql_check = "SELECT * FROM users WHERE email = '$email'";
        $result_check = $db->query($sql_check);

        if ($result_check->num_rows > 0) {
            echo "<script>
                alert('Email sudah terdaftar!');
                window.location.href = 'register.php';
            </script>";
            exit;
        } else {
            // Insert data pengguna baru
            $sql_insert = "INSERT INTO users (email, password, fullname) VALUES ('$email', '$password', '$fullname')";
            if ($db->query($sql_insert) === TRUE) {
                header("Location: index.php?message=Registrasi Berhasil! Silahkan Login");
                exit;
            } else {
                echo "<script>
                    alert('Gagal melakukan registrasi!');
                    window.location.href = 'register.php';
                </script>";
                exit;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Registrasi Pengguna</title>
</head>

<body>
    <div class="container">
        <section class="wrapper">
            <h2 class="title">REGISTRATION PET'S CAFE</h2>

            <div>
                <form action="register.php" method="POST" class="form-login">
                    <label for="fullname">Nama Lengkap</label>
                    <!-- Menambahkan placeholder pada input Nama Lengkap -->
                    <input type="text" id="fullname" name="fullname" class="input-login" required placeholder="Hallo Kamu">

                    <label for="email">Email</label>
                    <!-- Menambahkan placeholder pada input Email -->
                    <input type="email" id="email" name="email" class="input-login" required autocomplete="off" placeholder="contoh@email.com">

                    <label for="password">Masukkan Password</label>
                    <!-- Menambahkan placeholder pada input Password -->
                    <input type="password" id="password" name="password" class="input-login" required placeholder="******">

                    <button class="button-login" name="register">DAFTAR</button>
                </form>
            </div>

            <div class="signup-link">
                <p>Sudah memiliki akun? <a href="index.php">Masuk</a></p>
            </div>
        </section>
    </div>
</body>

</html>
