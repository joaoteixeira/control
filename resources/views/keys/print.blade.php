<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print keys</title>

    <link href="https://fonts.googleapis.com/css?family=Lato|Roboto" rel="stylesheet">
    <style>
    @media print {
        * {
            background: transparent !important;
            color: #000 !important;
            text-shadow: none !important;
            filter: none !important;
            -ms-filter: none !important;
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
        }

        @page {
            size: 54mm 85mm;
            margin: 0;
        }

        @page :left {
            margin-left: 0;
        }

        @page :right {
            margin-right: 0;
        }

        .print {
            display: block;
        }

        .no-print {
            display: none;
        }

        .page-break {
            page-break-inside: auto;
        }
    }

    * {
        font-family: Arial;
        font-size: 12pt;
    }

    .page-break {
        page-break-inside: auto;
        margin-bottom: 1mm;
    }

    .cartao {
        position: relative;
        width: 54mm;
        height: 85mm;
        padding: 0;
        margin: 0;
        /* border: 1px solid #000; */
    }
    .key { 
        position: relative;
        height: 25mm;
        margin-bottom: 2mm;
        margin-top: 3mm;
        margin-left: 1mm;
        border-radius: 3mm;
        border: 2px solid #000;
        width: 53mm;
    }

    .logo {
        position: absolute;
        top: 5mm;
        /* left: 1mm; */
        width: 55px;
    }

    .image {
        height: 15mm;
    }

    .info {
        font-family: 'Roboto', sans-serif;
        font-weight: bold;
        position: absolute;
        left: 14mm;
        top: 5mm;
        width: 68px;
        text-transform: uppercase;
    }

    .qrcode {
        position: absolute;
        width: 18mm;
        height: 18mm;
        top: 4mm;
        right: 2mm;
        overflow: hidden;
    }

    .qrcode img {
        position: relative;
        left: 50%;
        top:50%;
        -webkit-transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
    }
    small {
        font-size: .8em
    }
</style>
</head>
<body>
    @if($keys)
    <div class="page-break">
        <div class="cartao">
        @foreach($keys as $key)
            <div class="key">
                <div class="logo">
                    <img src="/images/ifro.png" class="image" alt="">
                </div>
                <div class="info">
                    Sala {{ $key->room->numero }} <br> <small>{{ $key->room->descricao }}  <br> {{ str_pad($key->copia, 2, '0', STR_PAD_LEFT) }} </small>
                </div>
                <div class="qrcode">
                    <img src="{!! $key->qrCodeBase64() !!}">
                </div>
            </div>

            @if($loop->iteration % 3 == 0)
            </div>
            </div>
            <div class="page-break">
            <div class="cartao">
            @endif

        @endforeach
        </div>
    </div>
    @else
        <div>
            Nenhuma informação enviada!
        </div>
    @endif
</body>
</html>