<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Index Product</title>
</head>
<body>
    @foreach ($products as $product)
        <p>{{ $product->name }}</p>           
        <img src="{{ url('storage/', $product->image) }}" alt="image_product" width="90px">  
        <br>              
        <a class="btn btn-primary " href="{{ route('show_product', $product) }}">Lihat Product</a>
        <form action="{{ route('delete_product', $product) }}" method="post">
        @method('delete')
        @csrf
        <button type="submit">Delete Product</button>
        </form>
    @endforeach    
</body>
</html>