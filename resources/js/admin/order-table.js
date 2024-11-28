import DataTable from "datatables.net-dt";

$(document).ready(function () {
    let table_products = new DataTable("#tableProduct", {
        paging: false,
        info: false,
    });

    let table_orders = new DataTable("#tableOrders", {
        paging: false,
        info: false,
    });

    // Search products
    $("#inputSearchProducts").on("keyup", function () {
        console.log($(this).val());
        table_products.search($(this).val()).draw();
    });

    $("input[name='filter-status']").on("change", function () {
        let value = $(this).val();
        table_products.search(value).draw();
    });

    $("input[name='filter-category']").on("change", function () {
        let value = $(this).val();
        table_products.search(value).draw();
    });

    // Search orders
    $("#inputSearchOrders").on("keyup", function () {
        console.log($(this).val());
        table_orders.search($(this).val()).draw();
    });

    $("#filter-status-orders").on("Changed", function () {
        let value = $(this).val();
        table_orders.search(value).draw();
    });
});
