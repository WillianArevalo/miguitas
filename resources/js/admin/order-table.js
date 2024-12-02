import DataTable from "datatables.net-dt";

$(document).ready(function () {
    const defaultTableOptions = {
        paging: false,
        info: false,
        language: {
            emptyTable: "No data available",
        },
    };

    const tables = [
        { id: "#tableProduct", searchInput: "#inputSearchProducts" },
        { id: "#tableOrders", searchInput: "#inputSearchOrders" },
        {
            id: "#tableContactMessages",
            searchInput: "#inputSearchContactMessages",
        },
        { id: "#tablePopups", searchInput: "#inputSearchPopups" },
        { id: "#tableShippingMethods", searchInput: "#inputShippingMethods" },
        { id: "#tablePaymentMethods", searchInput: "#inputPaymentMethods" },
        { id: "#tableCurrencies", searchInput: "#inputCurrencies" },
        { id: "#tableCoupons", searchInput: "#inputCoupons" },
        { id: "#tableUsers", searchInput: "#inputUsers" },
        { id: "#tableCustomers", searchInput: "#inputCustomers" },
        { id: "#tableSupportTickets", searchInput: "#inputSupportTickets" },
        { id: "#tablePolicies", searchInput: "#inputPolicies" },
        { id: "#tableFaq", searchInput: "#inputFaq" },
        { id: "#tableOrdersDashboard", searchInput: "#inputOrdersDashboard" },
    ];

    const initializedTables = {};
    tables.forEach(({ id, searchInput }) => {
        const table = new DataTable(id, defaultTableOptions);
        initializedTables[id] = table;
        if (searchInput) {
            $(searchInput).on("keyup", function () {
                table.search($(this).val()).draw();
            });
        }
    });

    const filters = [
        {
            tableId: "#tableProduct",
            filterInput: "input[name='filter-status']",
        },
        {
            tableId: "#tableProduct",
            filterInput: "input[name='filter-category']",
        },
        {
            tableId: "#tableSupportTickets",
            filterInput: "#filter-status-tickets",
        },
    ];

    filters.forEach(({ tableId, filterInput }) => {
        $(filterInput).on("change", function () {
            const value = $(this).val();
            initializedTables[tableId].search(value).draw();
        });
    });
});
