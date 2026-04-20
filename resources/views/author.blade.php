<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>List Author dari buku-buku di sini</h1>

    @foreach ($authors as $item)

    <ul>
        <li>Nama : {{ $item['name'] }}</li>
        <li>Bio : {{ $item['bio'] }}</li>
    </ul>
    
    @endforeach
    
</body>
</html>