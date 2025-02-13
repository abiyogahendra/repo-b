<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kartu Pelajar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <style>
        @page {
            size: 1615.75px 2561.18px;
            margin: 0;
        }

        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 0;
            padding: 0;
        }

        .card {
            width: 100%;
            height: 100%;
            background-image: url(<?php echo $_SERVER['DOCUMENT_ROOT'] . '/img/BG4.png'; ?>);
            /* Tambahkan background jika perlu */
            background-size: contain;
            /* padding: 20px; */
        }

        .student-photo {
            width: 250px;
            height: 250px;
            background: #ddd;
            border-radius: 50%;
            margin: 20px auto;
        }

        .name {
            font-size: 60px;
            font-weight: bold;
            color: #e74c3c;
        }

        .nis {
            font-size: 50px;
            color: #555;
        }

        .card-number1 {
            font-size: 80px;
            font-weight: bold;
            color: #70b44c;
        }

        .card-number2 {
            font-size: 70px;
            color: #70b44c;
            line-height: 0.2;
        }

        .card-number3 {
            font-size: 70px;
            color: #ffffff;
            line-height: 0.2;
        }

        .card-number4 {
            font-size: 70px;
            color: #ffffff;
            line-height: 0.2;
        }

        .school {
            font-size: 50px;
            font-weight: bold;
            color: #70b44c;
        }

        .footer {
            color: #fff;
            background: #70b44c;
            padding: 10px;
            position: absolute;
            bottom: 0;
            display: flex;
            /* Ganti inline-block ke flex */
            /* justify-content: center; */
            /* Pusatkan elemen secara horizontal */
            align-items: center;
            /* Pusatkan elemen secara vertikal */
            height: 500px;
            width: 100%;
        }

        .footer .card-info {
            display: inline-block;
            text-align: left;
            /* Jarak antara teks dan barcode */
        }

        .footer h2,
        .footer h1 {
            margin: 0;
            font-size: 70px;
            text-align: left;
        }

        .footer .barcode-container {
            display: inline-block;
            padding-left: 300px;
            vertical-align: middle !important;
        }

        .footer img {
            align-content: end;
            border-radius: 10%;
            border: 10px solid #fff;
            /* Ubah jadi putih agar lebih kontras */
            object-fit: contain;
        }


        .container {
            text-align: center;
            /* Agar konten di tengah secara horizontal */
        }

        .logo-container,
        .school-container {
            display: inline-block;
            vertical-align: middle;
            /* Agar elemen sejajar secara vertikal */
        }

        .school1 {
            margin: 0;
            font-size: 50px;
            text-align: left;
            color: #70b44c;
        }

        .school2 {
            margin: 0;
            font-size: 100px;
            text-align: left;
            color: #70b44c;
        }

        .school h2 {
            margin-bottom: 5px;
        }

        .school h1 {
            line-height: 0.4;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="card">

        <div class="container" style="padding-top: 100px">
            <div class="logo-container">
                <img style="width: 300px !important; display: block;" class="logo" src="<?php echo $_SERVER['DOCUMENT_ROOT'] . '/img/logo-pesantren.png'; ?>"
                    alt="Logo">
            </div>
            <div class="school-container">
                <h2 class="school1">MTS</h2>
                <h1 class="school2"><b>Sekolah ABC</b></h1>
            </div>
        </div>
        <div class="container" style="padding-top: 200px">
            <img style="width: 800px !important; height: 800px; display: block;border-radius: 50%; border: 10px solid #70b44c; object-fit: contain;"
                class="logo" src="<?php echo $_SERVER['DOCUMENT_ROOT'] . '/img/logo2.jpg'; ?>" alt="Logo">
        </div>

        <div class="container">
            <h1 class="card-number1" style="line-height: 2">{{$name}}</h1>
            <p class="card-number2">NIS : {{$nis}}</p>
        </div>
        <div class="footer" style="padding-top: 100px !important">
            <div class="card-info">
                <h2 style="font-size: 60px !important; padding-left: 10px !important">Nomor Pintro Card</h2>
                <h1 style="font-size: 80px !important; padding-left: 10px !important">{{$card_number}}</h1>
            </div>
            <div class="barcode-container">
                <img style="width: 400px !important; height: 400px; display: block;border-radius: 10% "
                    src="<?php echo $_SERVER['DOCUMENT_ROOT'] . '/img/barcode.png'; ?>" alt="Barcode">
            </div>
        </div>
    </div>
    <div class="card">




        <div class="footer" style="padding-top: 100px !important">
            <div class="container">
                <h1 class="card-number3" style="line-height: 2; text-align: center;">Sekolah ABC</h1>
                <p class="card-number4">www.sekolahabc.sch.id</p>
            </div>
        </div>
    </div>
</body>

</html>
