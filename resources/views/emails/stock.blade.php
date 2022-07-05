<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        body{
            margin: 0;
            background-color: #cccccc;
        }
        img{
            border:0;
        }
        .centrado{
            width: 100%;
            table-layout: fixed;
            background-color: #cccccc;
            padding-bottom: 60px;
        }
        .main{
            background-color: #ffffff;
            margin: 0 auto;
            width: 100%;
            max-width: 600px;
            border-spacing: 0;
            font-family: sans-serif, Verdana, Tahoma;
            color: #171a1b;
        }
    </style>
    <title>insufficient stock</title>
</head>
<body>

        <center class="centrado">

            <table class="main" width= "100%">

                <tr>
                    <td height= "8" style="background: #171a1b"></td>
                </tr>

                <tr>
                    <td>
                            <img src='https://i.postimg.cc/SQMp89NK/Logo.png'
                             width='180' alt='Konecta Logo'/>
                    </td>
                </tr>

                <tr>
                    <td>
                        <h2 style="text-align:center">Insufficient Inventory ({{$product['name_product']}} product)</h2>
                    </td>
                </tr>

                <tr>
                    <td>
                        <p style="text-align: left">  The inventory of  {{$product['name_product']}} is {{$product['stock']}}</p>
                        <p style="text-align: left">  It is necessary to increase the inventory of the indicated products.</p>
                    </td>
                </tr>
                <tr>
                    <td><h3 style="color: crimson; text-align:center">  Almost finished!</h3></td>
                </tr>
                <tr>
                    <td><table width = "100%">
                        <tr>
                            <td style="text-align: center; paffing: 45px 20px; color: honeydew;background: #171a1b;">
                                   <br>
                                <a href='https://www.instagram.com/konectacolombia/' target='_blank'>
                                    <img src='https://i.postimg.cc/1XndVBfs/instagram.png'
                                    width='30'/></a>

                                    <a href='https://www.linkedin.com/company/konecta-colombia/' target='_blank'>
                                        <img src='https://i.postimg.cc/qRSTFzKB/linkedin.png' .
                                    width='40'/></a>

                                    <h5 style="padding: 10px"> Grupo Konecta © 2022</h5>
                            </td>
                        </tr>
                    </table></td>
                </tr>
            </table>
        </center>
</body>
</html>

