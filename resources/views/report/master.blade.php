<!DOCTYPE html>
<html lang="en">

<head>
    <title> ANIGATRAVEL - Invoce </title> 
    <link rel="icon" href="/storage/images/anigato.png">
    <link href="{{ asset('tema/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('tema/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <style>
        body{
            background-color: #f0eded;
        }
        #invoice{
            padding: 30px;
        }

        .invoice {
            position: relative;
            background-color: #f0eded;
            min-height: 680px;
            padding: 15px
        }

        .invoice header {
            padding: 10px 0;
            margin-bottom: 20px;
            border-bottom: 1px solid #007bff
        }

        .invoice .company-details {
            text-align: right
        }

        .invoice .company-details .name {
            margin-top: 0;
            margin-bottom: 0
        }

        .invoice .contacts {
            margin-bottom: 20px
        }

        .invoice .invoice-to {
            text-align: left
        }

        .invoice .invoice-to .to {
            margin-top: 0;
            margin-bottom: 0
        }

        .invoice .invoice-details {
            text-align: right
        }

        .invoice .invoice-details .invoice-id {
            margin-top: 0;
            color: #007bff
        }

        .invoice main {
            padding-bottom: 50px
        }

        .invoice main .thanks {
            margin-top: -100px;
            font-size: 2em;
            margin-bottom: 50px
        }

        .invoice main .notices {
            padding-left: 6px;
            border-left: 6px solid #007bff
        }

        .invoice main .notices .notice {
            font-size: 1.2em
        }

        .invoice table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 20px
        }

        .invoice table td,.invoice table th {
            padding: 15px;
            background: #eee;
            border-bottom: 1px solid #fff
        }

        .invoice table th {
            white-space: nowrap;
            font-weight: 400;
            font-size: 16px
        }

        .invoice table td h3 {
            margin: 0;
            font-weight: 400;
            color: #007bff;
            font-size: 2em
        }

        .invoice table .qty,.invoice table .total,.invoice table .unit {
            text-align: right;
            font-size: 1.2em
        }

        .invoice table .no {
            color: #fff;
            font-size: 1.6em;
            background: #007bff
        }

        .invoice table .unit {
            background: #ddd
        }

        .invoice table .total {
            background: #007bff;
            color: #fff
        }

        .invoice table tbody tr:last-child td {
            border: none
        }

        .invoice table tfoot td {
            background: 0 0;
            border-bottom: none;
            white-space: nowrap;
            text-align: right;
            padding: 10px 20px;
            font-size: 1.2em;
            border-top: 1px solid #aaa
        }

        .invoice table tfoot tr:first-child td {
            border-top: none
        }

        .invoice table tfoot tr:last-child td {
            color: #007bff;
            font-size: 1.4em;
            border-top: 1px solid #007bff
        }

        .invoice table tfoot tr td:first-child {
            border: none
        }

        .invoice footer {
            width: 100%;
            text-align: center;
            color: #777;
            border-top: 1px solid #aaa;
            padding: 8px 0
        }
    </style>

</head>

<body>
    @yield('content')
    <script src="{{ asset('tema/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('tema/vendor/chart.js/Chart.min.js') }}"></script>
    <script type="text/javascript">
        // $('#printInvoice').click(function(){
        //         Popup($('#invoice')[0].outerHTML);
        //         function Popup(data) 
        //         {
        //             window.print();
        //             return true;
        //         }
        //     });
        window.addEventListener("load",window.print());
    </script>
    @stack('js')
</body>

</html>
