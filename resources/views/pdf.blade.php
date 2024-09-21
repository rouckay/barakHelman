<!DOCTYPE html>
<html lang="fa">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="/css/invoice.css">

    <style>
        @font-face {
            font-family: 'DejaVuSans';
            src: url('{{ public_path('fonts/DejaVuSans.ttf') }}') format('truetype');
            font-weight: normal;
            font-style: normal;
        }


        body {

            font-family: 'DejaVuSans', sans-serif;
            text-align: right;

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

        .styled-table th,
        .styled-table td {
            border: 1px solid black;
            /* Ensure border is solid and color is specified */
            padding: 10px;
            text-align: center;
        }

        .styled-table {
            width: 100%;
            border-collapse: collapse;
        }


        .styled-table th,
        .styled-table td {
            border: 1px solid black;
            /* Try thicker border to ensure visibility */
            padding: 10px;
            text-align: center;
        }

        th {
            border: 1px solid black;
            text-align: center;
            justify-content: center;
        }
    </style>
</head>

<body dir="rtl" class="styled-table">
    <div class="container" style="margin-top: 15%;">
        <div class="header">

        </div>
        <table>
            <thead>
                <tr>
                    <th rowspan="3"><img src="{{ asset('storage/logo/imarat.png') }}" height="100px" width="auto" />
                    </th>
                    <th colspan="4">
                        <h4>د افغانستان اسلامي امارت</h4>
                        <h4>د هلمند ولایت شاروالی</h4>
                        <h4>د شهرکونو د عوایدو تعرفه</h4>
                        ځمکی
                    </th>
                    <th rowspan="3">
                        <img src="{{ asset('storage/logo/logo.png') }}" height="100px" width="auto" />
                    </th>


                </tr>
                <tr>
                    <th>
                        شرکت نوم
                    </th>
                    <th colspan="3">
                        هلال بارک هلمند ساختمانی شرکت
                    </th>
                </tr>
                <tr>
                    <th>
                        د شهرک نوم
                    </th>
                    <th colspan="3">
                        د نوی غازی محمد ایوب خان مینه
                    </th>
                </tr>
            </thead>
        </table>
        <table>
            <thead>
                <tr>
                    <th>نوم</th>
                    <th>د پلار نوم</th>
                    <th>د تذکري شمیره</th>
                    <th>د تعرفی قیمت</th>
                    <th>تاریخ</th>
                    <th>د نمری ID</th>
                    <th>د مشتری ID</th>
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
        <h3 class="title">د نمری مشخصات</h3>

        <table>
            <thead>
                <tr>
                    <th>د نمری ID</th>
                    <th>د نمری مساحت</th>
                    <th>شرق</th>
                    <th>غرب</th>
                    <th>شمال</th>
                    <th>جنوب</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $numera_id }}</td>
                    <td>{{ $Land_Area }} متر مربع</td>
                    <td>{{$east}}</td>
                    <td>{{$west}}</td>
                    <td>{{ $north }}</td>
                    <td>{{ $south }}</td>
                </tr>
            </tbody>
        </table>
        <br>
        <div class="footer">د تعرفی قیمت {{ $sharwali_tarifa_price }} افغانی</div>
        <div class="footer">د هلال بارک هلمند ساختماني شرکت</div>
    </div>
</body>


</html>