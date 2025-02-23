<?php
session_start();
if (isset($_SESSION['status'])) {
    header("Location:dashboard/index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Absensi Karyawan</title>
    <style>
        /* Style for the notification pop-up */
        .notif-login {
            display: none;
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #ff4d4d;
            color: white;
            padding: 15px;
            border-radius: 5px;
            font-size: 16px;
            z-index: 9999;
            opacity: 0;
            animation: fadeIn 3s forwards;
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
                top: 10px;
            }

            100% {
                opacity: 1;
                top: 20px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <section class="wrapper">
            <h2 class="title">LOGIN PET'S CAFE</h2>
           
            <!-- Notifikasi Login -->
            <?php
            if (isset($_GET['message'])) {
                $msg = $_GET['message'];
                echo "<div class='notif-login' id='notif'>$msg</div>";
            }
            ?>
           
           <!-- End Notifikasi Login -->
            <div>
                <form action="login.php" method="POST" class="form-login">
                    <label for="email">Email</label>
                    <input type="email" placeholder="contoh@email.com" id="email" name="email" class="input-login" required autocomplete="off">

                    <label for="password">Masukkan Password</label>
                    <input type="password" placeholder="******" id="password" name="password" class="input-login" required>
                    <button class="button-login" name="login">LOGIN</button>
                </form>
            </div>

            <div class="signup-link">
                <p>Belum memiliki akun? <a href="register.php">Daftar</a></p>
            </div>
        </section>
    </div>

    <script>
        // Show notification pop-up if a message exists in the URL
        window.onload = function () {
            const notif = document.getElementById('notif');
            if (notif) {
                notif.style.display = 'block';
                setTimeout(function () {
                    notif.style.display = 'none';
                }, 5000);  // Hide after 5 seconds
            }
        }
    </script>
</body>

</html>
