<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="print.css" media="print">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo+Play:wght@800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Print Job</title>
</head>
@php
    $setting = $settings[0];
@endphp
<style>
    *{
        margin: 0px;
    }

    .mb{
        padding-bottom: 5px;
    }

    p{
        margin: 0px;
        font-family: "Poppins", sans-serif;
        font-weight: 400;
        font-style: normal;
        line-height: 10px;
        font-size: 12px;
    }

    .body p{
        font-size: {{$setting->body_text_size}}px;
    }
    .inner{
        width: 100%;
        height: 100%;
    }

    .header-text{
        font-size: 8px;
    }

    .label{
        border: 1px solid black;
        border-radius: 5px;
        width: {{$setting->paper_width}}mm;
        height: {{$setting->paper_height}}mm;
        padding: 0px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .header{
        height: {{ $setting->header_height }}mm;
    }
    .header p{
        font-size: {{ $setting->header_text_size }}px;
    }

    .d-flex-between{
        display: flex;
        justify-content: space-between;
    }

    @page {
            size: {{$setting->paper_width}}mm {{ $setting->paper_height }}mm;
        }

    @media all{
        .pageBreak {
            display: none;
        }
    }

    @media print{
        .inner{
            border: none;
        }
        .label{
            border: none;
        }
    }
    
</style>

<body>
<div class="label">
    <div class="inner" style="width: {{ $setting->paper_width - $setting->content_margin }}mm; height: {{ $setting->paper_height - $setting->content_margin }}mm;">
        <div class="header d-flex-between ">
            <p>{{ explode(' ', $job->created_at)[0] }}</p><br>
            <p>{{ $job->worker->name }}</p>
        </div>
        <div class="body d-flex-between">
            <div style="width: {{ $setting->body_text_area_width }}mm;">
                <p ><i class="bi bi-person-fill"></i> : {{ $job->client->name }}</p>
                <p><i class="bi bi-lock-fill"></i> : {{ $job->kodi }}</p>
                <p style="margin-bottom: {{ $setting->body_text_margin }}px;"><i class="bi bi-telephone-fill"></i> : {{ $job->client->phone }}</p>
                <p><i class="bi bi-clock-fill"></i> : {{ explode(' ', $job->created_at)[1] }}</p>
            </div>
            {!! DNS2D::getBarcodeSVG("$job->qrcode", 'QRCODE', $setting->qrcode_size, $setting->qrcode_size) !!}
        </div>
    </div>
</div>

</body>
<script>
    // JavaScript code to trigger printing
    window.onload = function() {
        window.print();
    };
</script>
</html>

