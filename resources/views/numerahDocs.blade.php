<!DOCTYPE html>
<html lang="fa">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style>
        body {

            @font-face {
                font-family: 'DejaVu Sans';
                src: url('{{ public_path('fonts/DejaVuSans.ttf') }}') format('truetype');
                font-weight: normal;
                font-style: normal;
            }

            body {
                font-family: 'DejaVu Sans';
                direction: rtl;
                text-align: right;
            }
        }

        .styled-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            border: 1px solid black;
        }

        .styled-table th,
        .styled-table td {
            border: 1px solid black;
            padding: 10px;
            text-align: center;
        }

        .header {
            background-color: #cfe2f3;
            font-weight: bold;
            font-size: 18px;
        }

        .sub-header {
            background-color: #e6f2ff;
            font-size: 16px;
        }

        .date-label {
            background-color: #f0f8ff;
        }

        .logo-cell {
            width: 120px;
            background-color: #ffeb99;
            text-align: center;
            vertical-align: middle;
        }

        .logo {
            width: 80px;
            height: 80px;
            background-color: orange;
            margin: 0 auto;
            border-radius: 8px;
        }

        .section-header {
            background-color: #d9ead3;
            font-weight: bold;
        }

        .footer {
            background-color: #ffe599;
            font-weight: bold;
            padding: 15px;
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

        .empty-cell {
            height: 100px;
        }
    </style>
</head>

<body>
    <table class="styled-table">
        <thead>
            <tr>
                <th colspan="6" class="header">د نمرو د پیرودلو سند</th>
            </tr>
            <tr>
                <th colspan="6" class="sub-header">د نوی غازی محمد ایوب خان مینه</th>
            </tr>
            <tr>
                <th colspan="5" class="date-label" style="text-align:left">تاریخ</th>
                <th>{{ $date }}</th>
            </tr>
            <tr>
                <th>
                    <img src="{{ asset('storage/logo/imarat.png') }}" height="40px" width="auto" />
                </th>
                <th colspan="4">د هلال بارک هلمند ساختمانی شرکت </th>
                <th>
                    <img src="{{ asset('storage/logo/logo.png') }}" height="100px" width="auto" />
                </th>
            </tr>
            <hr />
        </thead>

        <tbody>
            <tr>
                <td rowspan="10" style="text-align:center; vertical-align:middle;">
                    <img src="{{ asset('storage/' . $Customer_image) }}" height="180px" width="180px"
                        style="display: block; margin-left: auto; margin-right: auto;" />
                </td>
                <td colspan="5">د پیرودونکی معلومات</td>
            </tr>
            <tr>
                <td>نوم</td>
                <td colspan="4">{{$customer }}</td>
            </tr>
            <tr>
                <td>د پلار نوم</td>
                <td colspan="4">{{$father_name }}</td>
            </tr>
            <tr>
                <td>د نیکه نوم</td>
                <td colspan="4">{{$grand_father_name }}</td>
            </tr>
            <tr>
                <td>ولایت</td>
                <td colspan="4">{{$province }}</td>
            </tr>
            <tr>
                <td>ولسوالی</td>
                <td colspan="4">{{$village }}</td>
            </tr>
            <tr>
                <td>کلی</td>
                <td colspan="4">{{$tazkira }}</td>
            </tr>
            <tr>
                <td>وظیفه</td>
                <td colspan="4">{{$job }}</td>
            </tr>
            <tr>
                <td>د تذکری شمیره</td>
                <td colspan="4">{{$tazkira }}</td>
            </tr>
            <tr>
                <td>د موبایل شمیره</td>
                <td colspan="4">{{$mobile_number }}</td>
            </tr>
            <tr>
                <td rowspan="10" style="text-align:center; vertical-align:middle;">
                    <img style="display: block; margin-left: auto; margin-right: auto;"
                        src="{{ asset('storage/' . $responsable_image) }}" height="180px" width="180px" />
                </td>
                <td colspan="5">د پیرودونکی د وکیل معلومات</td>
            </tr>
            <tr>
                <td>نوم</td>
                <td colspan="4">{{$responsable_name }}</td>
            </tr>
            <tr>
                <td>د پلار نوم</td>
                <td colspan="4">{{$responsable_father_name }}</td>
            </tr>
            <tr>
                <td>د نیکه نوم</td>
                <td colspan="4">{{$responsable_grand_father_name }}</td>
            </tr>
            <tr>
                <td>ولایت</td>
                <td colspan="4">{{$responsable_province }}</td>
            </tr>
            <tr>
                <td>ولسوالی</td>
                <td colspan="4">{{$responsable_village }}</td>
            </tr>
            <tr>
                <td>کلی</td>
                <td colspan="4">{{$responsable_village }}</td>
            </tr>
            <tr>
                <td>وظیفه</td>
                <td colspan="4">{{$responsable_job }}</td>
            </tr>
            <tr>
                <td>د تذکری شمیره</td>
                <td colspan="4">{{$responsable_tazkira }}</td>
            </tr>
            <tr>
                <td>د موبایل شمیره</td>
                <td colspan="4">{{$responsable_mobile_number }}</td>
            </tr>
            <tr>
                <td rowspan="8">
                    د نمری معلومات
                </td>
                <!-- <td colspan="5" class=""></td> -->
            </tr>
            <tr>
                <td>د نمری ID</td>
                <td colspan="4">{{$numera_id }}</td>
            </tr>
            <tr>
                <td>تفصیل</td>
                <td colspan="4">{{$numera_type }}</td>
            </tr>
            <tr>
                <td>مساحت</td>
                <td colspan="4">{{$Land_Area }}</td>
            </tr>
            <tr>
                <td>شرق</td>
                <td colspan="4">{{$east }}</td>
            </tr>
            <tr>
                <td>غرب</td>
                <td colspan="4">{{$west }}</td>
            </tr>
            <tr>
                <td>شمال</td>
                <td colspan="4">{{$north }}</td>
            </tr>
            <tr>
                <td>جنوب</td>
                <td colspan="4">{{$south }}</td>
            </tr>
            <tr>
                <td rowspan="3">
                    د نمری قیمت
                </td>
            </tr>
            <tr>
                <td>اصلي قیمت (افغانی)</td>
                <td>{{$total_price}}</td>
                <td colspan="4"></td>
            </tr>
            <!-- <tr>
                <td>اضافه قیمت (ډالر)</td>
                <td>250,000.00</td>
                <td colspan="4"></td>
            </tr> -->
        </tbody>
        <tfoot>
            <tr>
                <td colspan="6" class="footer">د شرکت د رییس او مدیر لاسلیک او مهر</td>
            </tr>
            <tr>
                <td>د شرکت د مدیر لاسلیک</td>
                <td colspan="2">د شرکت د ریئس لاسلیک او مهر</td>
                <td colspan="2">د پیرودونکی لاسلیک او د شست</td>
                <td colspan="2">د پیرودونکی د وکیل لاسلیک او د شست</td>
            </tr>
            <tr>
                <td></td>
                <td colspan="2"></td>
                <td colspan="2"></td>
                <td colspan="2" class="empty-cell"></td>
            </tr>
        </tfoot>
    </table>
</body>

</html>