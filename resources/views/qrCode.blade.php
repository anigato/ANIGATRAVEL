<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
    <div class="visible-print text-center">
        {!! QrCode::size(250)->generate('www.youtube.com/c/anigato'); !!}
    </div>
</body>
</html>