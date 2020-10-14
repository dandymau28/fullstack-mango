<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Verification Email</title>
</head>
<body>
    <span>Hai, ini pengujian email verifikasi</span>
    <a href="{{env('APP_URL').'/api/user/'.$code.'/verifikasi'}}">Link Verifikasi</a>
</body>
</html>