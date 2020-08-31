<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: index.php");
}

$page = basename($_SERVER['PHP_SELF']);
switch ($page) {
    case 'student.php':
        $s = 'active';
        $b = $r = '';
        break;
    case 'book.php':
        $b = 'active';
        $s = $r = '';
        break;
    case 'rent.php':
        $r = 'active';
        $s = $b = '';
        break;
    default:
        $s = $b = $r = '';
        break;
}

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>CRUD</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <style>
        li>a {
            font-size: 17px;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="index.php">Admin Panel</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item <?= $s ?>">
                    <a class="nav-link" href="./student.php">Student</a>
                </li>
                <li class="nav-item <?= $b ?>">
                    <a class="nav-link" href="./book.php">Book</a>
                </li>
                <li class="nav-item <?= $r ?>">
                    <a class="nav-link" href="./rent.php">Rent</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>