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

    @foreach ($books as $book)
    <ul>
        <li>Judul : {{ $book['title'] }}</li>
        <li>Deskripsi : {{ $book['description'] }}</li>
        <li>Harga : {{ $book['price'] }}</li>
        <li>Stok : {{ $book['stock'] }}</li>
    </ul>
    
    @endforeach
</body>
</html>