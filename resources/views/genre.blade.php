<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Halaman Genre Buku</h1>
    <p>Berbagai macam genre buku ada di sini</p>

    @foreach ($genres as $genre)
        <ul>
            <li>Genre : {{ $genre['name'] }}</li>
            <li>Deskripsi : {{ $genre['description'] }}</li>
        </ul>
    
    @endforeach
</body>
</html>