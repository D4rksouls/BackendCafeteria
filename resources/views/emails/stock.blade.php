<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>insufficient stock</title>
</head>
<body>
        <h1>insufficient inventory ({{$product['name_product']}} product)</h1>
        <div>


            <h3>The inventory of  {{$product['name_product']}} is {{$product['stock']}}</h3>
            <h4>It is necessary to increase the inventory of the indicated products.</h4>
            <h2>Almost finished!</h2>
        </div>
</body>
</html>
