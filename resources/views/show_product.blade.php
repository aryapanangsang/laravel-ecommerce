<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $product->name }}</title>
</head>
<body>   
    <a href="{{ route('index_product') }}">Back To Home Product</a>
    <br>
    <img src="{{ url('storage/' . $product->image) }}" alt="foto_product" width="200px">
    <p>Nama Product : {{ $product->name }}</p>
    <p>Deskripsi : {{ $product->description }}</p>
    <p>Harga : {{ $product->price }}</p>
    <p>Stok Tersdia : {{ $product->stock }}</p>
    <br>    

    <form action="{{ route('edit_product', $product) }}" method="get">
        <button type="submit">Edit Product</button>
    </form>
    
    <form action="{{ route('add_to_cart', $product) }}" method="post">
        @csrf
        <input type="number" name="amount" value="1" >
        <button type="submit">Add To Cart</button>
    </form>
    @if($errors->any())
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    @endif
</body>
</html>