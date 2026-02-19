<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Notification')</title>

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('adminend/bower_components/bootstrap/css/bootstrap.min.css') }}">

    {{-- Google Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">


    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #f3f4f6;
            font-family: Georgia, 'Times New Roman', Times, serif;
            color: #1f2937;
        }

        table {
            border-collapse: collapse;
        }

        .wrapper {
            width: 100%;
            background-color: #f3f4f6;
            padding: 30px 0;
        }

        .container {
            width: 600px;
            /* border: 1px solid #e5e7eb; */
            background-color: #ffffff;
        }

        /* Header */
        .header {
            background-color: #f3f4f6;
            padding: 18px 30px;
            /* border-bottom: 1px solid #e5e7eb; */
            font-size: 24px;
            font-weight: bold;
            text-align: center;
        }

        /* Body */
        .content {
            background-color: #ffffff;
            padding: 30px;
            font-size: 16px;
            line-height: 1.6;
        }

        .content p {
            margin: 0 0 16px 0;
        }

        .sub-content {
            border-top: 1px solid #e4e4e7;
            padding: 30px;
        }

        .sub-content p {
            margin: 0 0 16px 0;
            text-align: center;
        }

        
        /* Button */
        .btn-wrapper {
            text-align: center;
            margin: 24px 0;
        }

        .btn {
            display: inline-block;
            padding: 12px 22px;
            background-color: #007bff;
            color: #ffffff !important;
            text-decoration: none;
            font-size: 14px;
            font-weight: bold;
            border-radius: 4px;
        }

        /* Footer */
        .footer {
            background-color: #f3f4f6;
            padding: 20px 30px;
            /* border-top: 1px solid #e5e7eb; */
            font-size: 12px;
            color: #6b7280;
            text-align: center;
        }

        .footer a {
            color: #1f2937;
            text-decoration: none;
            word-break: break-all;
        }
    </style>
</head>

<body>

    <table class="wrapper" width="100%">
        <tr>
            <td align="center">

                <table class="container" width="600">
                    <!-- Header -->
                    <tr>
                        <td class="header">
                            {{ config('app.name') }}
                        </td>
                    </tr>

                    <!-- Content -->
                    <tr>
                        <td class="content">
                            @yield('content')
                        </td>
                    </tr>

                    <tr>
                        <td class="sub-content">
                            @yield('sub-content')
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td class="footer">
                            <p>
                                © {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
                            </p>
                        </td>
                    </tr>
                </table>

            </td>
        </tr>
    </table>

</body>

</html>
