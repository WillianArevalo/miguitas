$(document).ready(function () {
    const $dateInput = $("#date-input");
    const $calendar = $("#calendar");

    const weekendSelected = $("#date-input").data("weekend") ?? true;
    let allowWeekendSelection = weekendSelected === true;

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
        const inputValue = $dateInput.val();
        if (inputValue) {
            const selectedDate = new Date(inputValue);
            if (!isNaN(selectedDate)) {
                currentDate = selectedDate;
            }
        }
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

        const selectedDateValue = $dateInput.val();
        const selectedDate = selectedDateValue
            ? new Date(selectedDateValue)
            : null;

        const calendarHeader = $(
            `<div class="flex justify-between gap-x-2 items-center mb-4">
            <button class="prev-month text-blue-store p-2 rounded-xl bg-blue-100 hover:bg-blue-200">
                <!-- Left arrow -->
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="currentColor" d="M11.596 8.303L8.165 11.63a.5.5 0 0 0 0 .74l6.63 6.43c.414.401 1.205.158 1.205-.37v-5.723z"/><path fill="currentColor" d="M16 11.293V5.57c0-.528-.791-.771-1.205-.37l-2.482 2.406z" opacity="0.5"/></svg>
            </button>
            <div class="flex items-center space-x-2">
                <select id="month-select" class="text-zinc-800 p-2 rounded-xl border border-zinc-400 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-200 text-xs sm:text-sm font-dine-r">
                    ${months
                        .map(
                            (m, i) =>
                                `<option value="${i}" ${
                                    i === month ? "selected" : ""
                                } class="hover:bg-zinc-100">${m}</option>`
                        )
                        .join("")}
                </select>
                <input type="number" id="year-input" class="text-xs sm:text-sm border border-zinc-400 text-zinc-800 p-2 w-20 rounded-xl focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-200 font-dine-r" value="${year}">
            </div>
            <button class="next-month text-blue-store p-2 rounded-xl bg-blue-100 hover:bg-blue-200">
                <!-- Right arrow -->
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="currentColor" d="m12.404 8.303l3.431 3.327c.22.213.22.527 0 .74l-6.63 6.43C8.79 19.201 8 18.958 8 18.43v-5.723z"/><path fill="currentColor" d="M8 11.293V5.57c0-.528.79-.771 1.205-.37l2.481 2.406z" opacity="0.5"/></svg>
            </button>
        </div>`
        );

        $calendar.append(calendarHeader);

        const calendarTable = $(
            `<table class="table-auto w-full text-center">
            <thead>
                <tr class="text-secondary text-sm">
                    <th class="p-2 font-dine-r">Dom</th>
                    <th class="p-2 font-dine-r">Lun</th>
                    <th class="p-2 font-dine-r">Mar</th>
                    <th class="p-2 font-dine-r">Mié</th>
                    <th class="p-2 font-dine-r">Jue</th>
                    <th class="p-2 font-dine-r">Vie</th>
                    <th class="p-2 font-dine-r">Sáb</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>`
        );
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

            const currentDay = new Date(year, month, day).getDay();
            const isWeekend = currentDay === 0 || currentDay === 6; // Domingo o Sábado
            const isRestrictedDay = currentDay === 0 || currentDay === 1; // Domingo o Lunes

            const isToday =
                day === today.getDate() &&
                month === today.getMonth() &&
                year === today.getFullYear();

            const isSelected =
                selectedDate &&
                day === selectedDate.getDate() + 1 &&
                month === selectedDate.getMonth() &&
                year === selectedDate.getFullYear();

            const cellClass = isToday
                ? "text-gray-400 cursor-not-allowed" // Siempre deshabilitar el día actual
                : isSelected
                ? "bg-green-500 text-white hover:bg-green-600"
                : isRestrictedDay
                ? "text-gray-400 cursor-not-allowed" // Deshabilitar Domingo y Lunes
                : "hover:bg-gray-200 text-zinc-800";

            const cell = $(
                `<td class="p-2 text-xs sm:text-sm rounded-xl ${cellClass}" data-day="${day}" data-month="${
                    month + 1
                }" data-year="${year}">${day}</td>`
            );

            if (!isRestrictedDay && !isToday) {
                cell.click(function () {
                    $calendar
                        .find("td.bg-green-500")
                        .removeClass(
                            "bg-green-500 text-white hover:bg-green-600"
                        );
                    $(this).addClass(
                        "bg-green-500 text-white hover:bg-green-600"
                    );
                    $dateInput.val(`${year}-${month + 1}-${day}`);
                    $calendar.hide();
                    $dateInput.trigger("change");
                });
            }

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

        $("#weekend-switch").change(function () {
            allowWeekendSelection = $(this).is(":checked");
            buildCalendar(currentDate);
        });
    }
});
