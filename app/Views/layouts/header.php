<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= $title ?? 'Employee Management' ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {

            background: #f4f6f9;

        }

        .sidebar {

            width: 250px;
            min-height: 100vh;
            background: #212529;

        }

        .sidebar a {

            color: #fff;
            text-decoration: none;
            display: block;
            padding: 12px 20px;

        }

        .sidebar a:hover {

            background: #343a40;

        }

        .content {

            padding: 25px;

        }

        .card {

            border: none;
            box-shadow: 0 0 15px rgba(0, 0, 0, .08);

        }
    </style>

</head>

<body>