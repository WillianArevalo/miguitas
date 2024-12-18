import { showToast } from "./toast";

$(document).ready(function () {
    const stripeKey = key;
    var stripe = Stripe(stripeKey); // Tu clave pública de Stripe
    var elements = stripe.elements();

    var style = {
        base: {
            color: "#32325d",
            fontFamily: "",
            fontSmoothing: "antialiased",
            border: "1px solid #ccc",
            fontSize: "16px",
            "::placeholder": {
                color: "#aab7c4",
                fontFamily: "dinc-r",
            },
        },
        invalid: {
            color: "#fa755a",
            iconColor: "#fa755a",
        },
    };

    var card = elements.create("card", {
        style: style,
        hidePostalCode: true,
    });

    card.mount("#card-element");

    var form = document.getElementById("payment-form");
    var errorMessage = document.getElementById("error-message");

    form.addEventListener("submit", async function (event) {
        event.preventDefault();

        const name = $("#name");
        if (name.val() === "") {
            var errorMessageName = $("#error-message-name");
            name.addClass("is-invalid");
            errorMessageName.text(
                "El nombre del titular de la tarjeta es requerido"
            );
        }

        const { paymentMethod, error } = await stripe.createPaymentMethod({
            type: "card",
            card: card,
            billing_details: {
                name: name.val(),
            },
        });

        if (error) {
            errorMessage.textContent = error.message;
            $("#card-element").addClass("is-invalid");
        } else {
            // Agregar el token CSRF en la cabecera de la solicitud AJAX
            const response = await fetch("/payment/charge", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute("content"), // Incluir el token CSRF
                },
                body: JSON.stringify({
                    payment_method: paymentMethod.id,
                }),
            });

            const result = await response.json();

            if (result.error) {
                errorMessage.textContent = result.error;
            } else {
                showToast("Pago exitoso", "success");
                setTimeout(() => {
                    window.location.href = "/";
                }, 2000);
            }
        }
    });
});
