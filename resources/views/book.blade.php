<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Book Sales</h1>
    <p>Beli buku di sini aja</p>

    @foreach ($books as $item)
    <ul>
        <li>Judul : {{ $item['title'] }}</li>
        <li>Deskripsi : {{ $item['description'] }}</li>
        <li>Harga : {{ $item['price'] }}</li>
        <li>Stok : {{ $item['stock'] }}</li>
    </ul>
    
    @endforeach
</body>
</html>