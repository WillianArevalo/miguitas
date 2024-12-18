<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Miguitas - Costo de envío de tu pedido</title>
</head>

<body style="font-family: 'Poppins', sans-serif; margin: 0; padding: 0; background-color: #f4f4f4; text-align: center;">
    <div style="background-color: #ffffff; text-align: center; padding: 1rem; border-radius: 0.5rem;">
        <h1 style="text-align: center; font-size: 1.5rem; font-weight: bold; color: #6e83be;">
            Miguitas - Estado {{ $status }} de tu pedido
        </h1>
        <img src="{{ asset('img/logo.png') }}" alt="logo" style="width: 5rem; height: 5rem;">
        @if ($number_order)
            <h2 style="width: 500px; text-align: center; font-size: 1.5rem; font-weight: bold; color: #6e83be;">
                Hola Willian, el estado de tu pedido #{{ $number_order }} ha sido actualizado.
            </h2>
            <a target="_blank" href="{{ route('orders.show', $number_order) }}"
                style="display: inline-block; padding: 0.5rem 1rem; background-color: #6e83be; color: #ffffff; text-decoration: none; border-radius: 0.25rem; font-weight: bold;">
                Ver pedido
            </a>
            <p style="text-align: center; font-family: 'Dine-R', sans-serif; color: #71717a;">
                Si tienes alguna pregunta, no dudes en contactarnos. <br>
                <a href="mailto:contacto@miguitas.com" style="color: #6e83be;">contacto@miguitas.com</a>
            </p>
        @endif
    </div>

</body>

</html>
