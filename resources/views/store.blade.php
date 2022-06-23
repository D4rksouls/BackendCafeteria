<!DOCTYPE html>
<html>
    <p>store</p>

    @foreach ($products as $product)
         <h3>Nombre del producto: {{$product->name_product}}   disponible: {{$product->stock}}  valor: {{$product->value}} pesos</h3>
    @endforeach

<form action="save" method="post">
    @csrf
    <input type="text" name='name'>
    <input type="text" name="i">
    <input type="text" name="value">
    <input type="submit">
</form>
</html>

