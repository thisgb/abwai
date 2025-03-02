<?php
session_start();
include '../connection.php';

$id = $_GET['id'];
$sql = "SELECT * FROM users WHERE id=$id";
$result = $db->query($sql);
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

if (isset($_POST['logout'])) {
    session_destroy();
    header("Location:../index.php?message=Anda telah Logout");
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.108.0">
    <title>Dashboard Template · Bootstrap v5.3</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/dashboard/">





    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .b-example-divider {
            height: 3rem;
            background-color: rgba(0, 0, 0, .1);
            border: solid rgba(0, 0, 0, .15);
            border-width: 1px 0;
            box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }

        .b-example-vr {
            flex-shrink: 0;
            width: 1.5rem;
            height: 100vh;
        }

        .bi {
            vertical-align: -.125em;
            fill: currentColor;
        }

        .nav-scroller {
            position: relative;
            z-index: 2;
            height: 2.75rem;
            overflow-y: hidden;
        }

        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }
    </style>


    <!-- Custom styles for this template -->
    <link href="dashboard.css" rel="stylesheet">
</head>

<body>

    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href="#">PET'S CAFE</a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <input class="form-control form-control-dark w-100 rounded-0 border-0" type="text" placeholder="Search" aria-label="Search">
        <div class="navbar-nav">
            <div class="nav-item text-nowrap">
                <form action="" method="post">
                    <button class="nav-link px-3 btn btn-outline-dark" type="submit" name='logout'>
                        Sign Out
                    </button>
                </form>
            </div>
        </div>
    </header>

    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky pt-3 sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">
                                <span data-feather="home" class="align-text-bottom"></span>
                                Home
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="data_absen.php">
                                <span data-feather="shopping-cart" class="align-text-bottom"></span>
                                Data Absensi Pegawai
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="profile_pegawai.php">
                                <span data-feather="users" class="align-text-bottom"></span>
                                Profile Pegawai
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="tambah_pegawai.php">
                                <span data-feather="file" class="align-text-bottom"></span>
                                Tambah Pegawai
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Data Absensi Pegawai</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group me-2">
                            <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
                            <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
                        </div>
                        <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                            <span data-feather="calendar" class="align-text-bottom"></span>
                            This week
                        </button>
                    </div>
                </div>
                <h2 class="mb-4">Edit Data Pegawai</h2>
                <form action="action_edit.php" method="post">
                    <input type="hidden" name="id" value=<?= $data[0]['id']; ?>>
                    <div class="mb-3">
                        <label for="employee_id" class="form-label">Employee ID</label>
                        <input type="number" class="form-control" placeholder="Employee ID" name="employee_id" id="employee_id" value=<?= $data[0]['employee_id']; ?>>
                    </div>
                    <div class="mb-3">
                        <label for="fullname" class="form-label">Fullname</label>
                        <input type="text" class="form-control" placeholder="Fullname" name="fullname" id="fullname" value="<?= ucfirst($data[0]['fullname']) ?>">
                    </div>
                    <div class="mb-3">
                        <label for="role" class="form-label">Role</label>
                        <select class="form-select" aria-label="Default select example" name="role" id="role">
                            <optgroup label='Role Sekarang'>
                                <option selected value="<?= $data[0]['role']; ?>"><?= ucfirst($data[0]['role']) ?></option>
                            </optgroup>
                            <optgroup label="Edit Role">
                                <option value="admin">Admin</option>
                                <option value="operator">Operator</option>
                                <option value="packaging">Packaging</option>
                            </optgroup>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="text" class="form-control" placeholder="******" name="password" id="password" value="<?= $data[0]['password']; ?>">
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-info mx-1">Edit</button>
                        <button type="reset" class="btn btn-warning">Reset</button>
                        <a class="btn btn-danger" href="profile_pegawai.php">Batal</a>
                    </div>
                </form>
            </main>
        </div>
    </div>
    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
    <script src="dashboard.js"></script>
</body>

</html>