$(document).ready(function () {
    const $dateInput = $("#date-input");
    const $calendar = $("#calendar");
    const months = [
        "Enero",
        "Febrero",
        "Marzo",
        "Abril",
        "Mayo",
        "Junio",
        "Julio",
        "Agosto",
        "Septiembre",
        "Octubre",
        "Noviembre",
        "Diciembre",
    ];

    let currentDate = new Date();
    const today = new Date();

    $dateInput.click(function () {
        $calendar.toggle();
        buildCalendar(currentDate);
    });

    $(document).click(function (e) {
        if (
            !$(e.target).closest(
                "#calendar, #date-input, .prev-month, .next-month"
            ).length
        ) {
            $calendar.hide();
        }
    });

    function buildCalendar(date) {
        $calendar.empty();
        const month = date.getMonth();
        const year = date.getFullYear();
        const firstDay = new Date(year, month, 1).getDay();
        const lastDate = new Date(year, month + 1, 0).getDate();

        const calendarHeader = $(`
            <div class="flex justify-between items-center mb-4">
                <button class="prev-month text-blue-store p-2 rounded-xl bg-blue-100 hover:bg-blue-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 fill-current" viewBox="0 0 320 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l192 192c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L77.3 256 246.6 86.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-192 192z"/></svg>
                </button>
                <div class="flex items-center space-x-2">
                    <select id="month-select" class="text-zinc-800 p-2 rounded-xl border border-zinc-400 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-200 text-xs sm:text-sm">
                        ${months
                            .map(
                                (m, i) =>
                                    `<option value="${i}" ${
                                        i === month ? "selected" : ""
                                    } class="hover:bg-zinc-100">${m}</option>`
                            )
                            .join("")}
                    </select>
                    <input type="number" id="year-input" class="text-xs sm:text-sm border border-zinc-400 text-zinc-800 p-2 w-20 rounded-xl focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-200" value="${year}">
                </div>
                <button class="next-month text-blue-store p-2 rounded-xl bg-blue-100 hover:bg-blue-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 fill-current" viewBox="0 0 320 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M310.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L242.7 256 73.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z"/></svg>
                </button>
            </div>
        `);
        $calendar.append(calendarHeader);

        const calendarTable = $(`
            <table class="table-auto w-full text-center">
                <thead>
                    <tr class="text-secondary text-sm">
                        <th class="p-2">Dom</th>
                        <th class="p-2">Lun</th>
                        <th class="p-2">Mar</th>
                        <th class="p-2">Mié</th>
                        <th class="p-2">Jue</th>
                        <th class="p-2">Vie</th>
                        <th class="p-2">Sáb</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        `);
        $calendar.append(calendarTable);

        const $calendarBody = calendarTable.find("tbody");
        let row = $("<tr></tr>");

        for (let i = 0; i < firstDay; i++) {
            row.append('<td class="p-2"></td>');
        }

        for (let day = 1; day <= lastDate; day++) {
            if ((firstDay + day - 1) % 7 === 0 && day !== 1) {
                $calendarBody.append(row);
                row = $("<tr></tr>");
            }

            const isToday =
                day === today.getDate() &&
                month === today.getMonth() &&
                year === today.getFullYear();

            const cellClass = isToday
                ? "bg-blue-store text-white hover:bg-blue-900"
                : "hover:bg-gray-200 text-zinc-800";

            const cell = $(
                `<td class="p-2 text-xs sm:text-sm cursor-pointer rounded-xl ${cellClass}" data-day="${day}" data-month="${
                    month + 1
                }" data-year="${year}">${day}</td>`
            );
            cell.click(function () {
                $dateInput.val(`${year}-${month + 1}-${day}`);
                $calendar.hide();
            });
            row.append(cell);
        }

        $calendarBody.append(row);

        $(".prev-month").click(function () {
            currentDate.setMonth(currentDate.getMonth() - 1);
            buildCalendar(currentDate);
        });

        $(".next-month").click(function () {
            currentDate.setMonth(currentDate.getMonth() + 1);
            buildCalendar(currentDate);
        });

        $("#month-select").change(function () {
            currentDate.setMonth(parseInt(this.value));
            buildCalendar(currentDate);
        });

        $("#year-input").change(function () {
            currentDate.setFullYear(parseInt(this.value));
            buildCalendar(currentDate);
        });
    }
});
