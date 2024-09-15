<!DOCTYPE html>
<html lang="fa">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="/css/invoice.css">

    <style>
        body {
            @font-face {
                font-family: 'Vazir';
                src: url('{{ public_path('fonts/Vazir-Regular.ttf') }}') format('truetype');
                font-weight: normal;
                font-style: normal;
            }

            body {
                font-family: 'Vazir', 'DejaVu Sans', sans-serif;
                direction: rtl;
                text-align: right;
            }

            body {
                font-family: "DejaVu Sans", sans-serif;
                direction: rtl;
                text-align: center;
                background-color: #fdf7e6;
                margin: 0;
                padding: 0;
            }

            .container {
                width: 80%;
                margin: 0 auto;
                background-color: #fff5e1;
                border: 2px solid #f9c69d;
                border-radius: 10px;
                padding: 20px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }

            .header {
                display: flex;
                justify-content: space-around;
                align-items: center;
                margin-bottom: 20px;
            }

            .header h2 {
                margin: 0;
                color: #4a4a4a;
            }

            .logo {
                font-size: 20px;
                background-color: #d4b5f8;
                padding: 10px 20px;
                border-radius: 50%;
            }

            .title {
                margin-bottom: 20px;
                color: #4a4a4a;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 20px;
            }

            thead th {
                background-color: #f9c69d;
                padding: 10px;
                color: #4a4a4a;
                border: 3px solid #f9c69d;
            }

            tbody td {
                padding: 10px;
                border: 3px solid #f9c69d;
            }

            .footer {
                font-weight: bold;
                color: #4a4a4a;
            }

        }
    </style>
</head>

<body dir="rtl">
    <div class="container" style="margin-top: 15%;">
        <div class="header">
            <h2>د افغانستان اسلامي امارت</h2>
            <h2>شاروالی هلمند</h2>
            <div class="logo">لوگو شاروالی</div>
            <h2>د افغانستان اسلامي امارت</h2>
            <h2>د هلمند ولایت شاروالی</h2>
        </div>
        <h3 class="title">تعرفه عواید</h3>
        <table>
            <thead>
                <tr>
                    <th>نوم</th>
                    <th>د پلار نوم</th>
                    <th>د تذکري شمېره</th>
                    <th>د تعرفی قیمت</th>
                    <th>تاریخ</th>
                    <th>د ځمکی آی ډی</th>
                    <th>د مشتری آی ډی</th>
                    <th>د بانک حساب </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $customer }}</td>
                    <td>{{ $father_name }}</td>
                    <td>{{$tazkira}}</td>
                    <td>{{$sharwali_tarifa_price}}</td>
                    <td>{{ $date }}</td>
                    <td>{{ $numeraha_id }}</td>
                    <td>{{ $customer_id }}</td>
                    <td>########</td>
                </tr>
            </tbody>
        </table>
        <div class="footer">د هلال پارک هلمند ساختماني شرکت</div>
    </div>
</body>


</html>