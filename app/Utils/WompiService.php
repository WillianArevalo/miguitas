<?php
namespace App\Utils;

use Illuminate\Support\Facades\Http;


class WompiService
{

    protected $app_id;
    protected $app_secret;
    protected $auth_url;
    protected $enlace_pago_url;
    protected $webhook_url;
    protected $urlRedirect;
    protected $urlRetorno;

    public function __construct()
    {
        $this->app_id = env('WOMPI_APP_ID');
        $this->app_secret = env('WOMPI_APP_SECRET');
        $this->auth_url = env('AUTH_URL');
        $this->enlace_pago_url = env('ENLACE_PAGO_URL');
        $this->webhook_url = (env("APP_ENV") == "production") ? route("checkout.wompi") : env("WEBHOOK_URL");
        // Wompi doesn't like 127.0.0.1 as a valid IP, so we need to use localhost in development
        $this->urlRedirect = (env("APP_ENV") == "production") ? route("orders.index") : "http://localhost:8000/pedidos";
        $this->urlRetorno = (env("APP_ENV") == "production") ? route("orders.index") : "http://localhost:8000/pedidos";
    }

    private function get_access_token()
    {
        $payload = [
            "grant_type" => "client_credentials",
            "client_id" => $this->app_id,
            "client_secret" => $this->app_secret,
            "audience" => "wompi_api"
        ];

        $response = Http::asForm()->post($this->auth_url, $payload);
        return match ($response->getStatusCode()) {
            200 => $response->json("access_token"),
            default => null,
        };
    }

    public function get_link($description, $number_order, $ammount)
    {
        $token = $this->get_access_token();
        $body = [
            "idAplicativo" => $this->app_id,
            "identificadorEnlaceComercio" => $number_order,
            "monto" => floatval($ammount),
            "nombreProducto" => $description,
            "formaPago" => [
                "permitirTarjetaCreditoDebido" => true,
                "permitirPagoConPuntoAgricola" => true,
                "permitirPagoEnCuotasAgricola" => false,
                "permitirPagoEnBitcoin" => true,
            ],
            "infoProducto" => [
                "descripcionProducto" => $description,
            ],
            "configuracion" => [
                "urlRedirect" => $this->urlRedirect,
                "esMontoEditable" => false,
                "esCantidadEditable" => false,
                "cantidadPorDefecto" => 1,
                "duracionInterfazIntentoMinutos" => 10,
                "urlRetorno" => $this->urlRetorno,
                "emailsNotificacion" => "informacion@miguitassv.com",
                "urlWebhook" => $this->webhook_url,
                "notificarTransaccionCliente" => true,
            ],
            "limitesDeUso" => [
                "cantidadMaximaPagosExitosos" => 1,
                "cantidadMaximaPagosFallidos" => 3,
            ],
        ];

        $response = Http::withToken($token)->post($this->enlace_pago_url, $body);
        if ($response->getStatusCode() == 200) {
            return $response->json("urlEnlace");
        }
    }
}