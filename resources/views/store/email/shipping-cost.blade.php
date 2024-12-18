<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Miguitas - Costo de envío de tu pedido</title>
</head>

<body style="font-family: 'Poppins', sans-serif; margin: 0; padding: 0; background-color: #f4f4f4; text-align: center;">
    <div style="width: 80%; margin: 0 auto; background: #ffffff; padding: 20px; border-radius: 10px;">
        <img src="{{ asset('img/logo.png') }}" alt="logo"
            style="width: 100px; height: 100px; object-fit: cover; margin: 20px 0;">
        <h1 style="font-size: 24px; margin: 20px 0; color: #6e83be;">
            Hola {{ $name }}, se ha asignado un costo de envío a tu pedido {{ $number_order }}
        </h1>
        <p style="font-size: 18px; margin: 20px 0; color: #71717a;">
            El costo de envío es de ${{ number_format($shippingCost, 2) }}. Puedes continuar con el pago de tu pedido.
            Si consideras que el costo de envío es incorrecto, por favor contáctanos.
        </p>
        <a href="{{ url('contactanos') }}"
            style="display: inline-block; padding: 10px 20px; background-color: #6e83be; color: #fff; text-decoration: none; border-radius: 15px; margin: 20px 0;">
            Contáctanos
        </a>
    </div>
</body>

</html>
