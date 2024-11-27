$(document).ready(function () {
    // JSON como cadena
    const data = `
    {
        "IdCuenta": "891d27e7-c3b9-496f-8a31-a8d92ee84d39",
        "FechaTransaccion": "2024-11-24T22:38:27.1773846-06:00",
        "Monto": "69.98",
        "ModuloUtilizado": "BotonPago",
        "FormaPagoUtilizada": "PagoNormal",
        "IdTransaccion": "6c111682-19ee-407d-bbab-42e253802d4f",
        "ResultadoTransaccion": "ExitosaAprobada",
        "CodigoAutorizacion": "e54bf938-a4ab-4dcc-b556-6f74ac8d7177",
        "IdIntentoPago": "80742eef-8cbe-4400-b3a1-84af4f220042",
        "CantidadCuotas": null,
        "Cantidad": 1,
        "EsProductiva": false,
        "Aplicativo": {
            "Nombre": "Aplicativo de pruebas",
            "Url": null,
            "Id": "57e16af0-b437-4601-8bc5-529400c216df"
        },
        "EnlacePago": {
            "Id": 1571348,
            "IdentificadorEnlaceComercio": "6030",
            "NombreProducto": "Mantenimiento y seguridad Julio 2024"
        },
        "Cliente": {
            "Nombre": "Marcelo Cerritos",
            "EMail": "test@gmail.com"
        },
        "Tarjeta": "0000 0000 0000 4242",
        "EsInternacional": true
    }`;

    $("#form-paid").submit(function (e) {
        e.preventDefault();
        $("#jsonData").val(data);
        $.ajax({
            url: $(this).attr("action"),
            method: $(this).attr("method"),
            contentType: "application/json",
            data: data,
            success: function (response) {
                console.log("Respuesta del servidor:", response);
            },
            error: function (xhr) {
                console.error("Error:", xhr.responseText);
            },
        });
    });
});
