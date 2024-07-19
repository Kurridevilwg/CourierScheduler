<?
include_once './controllers/allTrips.php';
?>
<div class="w-2/3 bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-xl font-bold mb-4">Расписание поездок курьеров</h2>
    <div class="flex mb-4">
        <input type="date" id="filterDate" class="px-3 py-2 border rounded-md mr-2">
        <button id="resetFilter" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600">Сброс</button>
    </div>
    <table class="min-w-full bg-white">
        <thead>
            <tr>
                <th class="py-2 px-4 border-b">Регион</th>
                <th class="py-2 px-4 border-b">ФИО курьера</th>
                <th class="py-2 px-4 border-b">Дата выезда</th>
                <th class="py-2 px-4 border-b">Доставлен</th>
                <th class="py-2 px-4 border-b">Возвращён</th>
            </tr>
        </thead>
        <tbody id="tripsTableBody">
            <?php foreach ($allTrips as $trip) : ?>
                <tr>
                    <td class="py-2 px-4 border-b"><?= $trip['region_name'] ?></td>
                    <td class="py-2 px-4 border-b"><?= $trip['courier_name'] ?></td>
                    <td class="py-2 px-4 border-b"><?= $trip['departure_date'] ?></td>
                    <td class="py-2 px-4 border-b"><?= $trip['arrival_date'] ?></td>
                    <td class="py-2 px-4 border-b"><?= $trip['return_date'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>
    $(document).ready(function() {
        $('#filterDate').change(function() {
            const filterDate = $(this).val();
            $.ajax({
                type: 'GET',
                url: 'controllers/filterTripsByDate.php',
                data: {
                    departureDate: filterDate
                },
                success: function(response) {
                    const trips = JSON.parse(response);
                    const tableBody = $('#tripsTableBody');
                    tableBody.empty();
                    trips.forEach(trip => {
                        const newRow = `
                            <tr>
                                <td class="py-2 px-4 border-b">${trip.region_name}</td>
                                <td class="py-2 px-4 border-b">${trip.courier_name}</td>
                                <td class="py-2 px-4 border-b">${trip.departure_date}</td>
                                <td class="py-2 px-4 border-b">${trip.arrival_date}</td>
                                <td class="py-2 px-4 border-b">${trip.return_date}</td>
                            </tr>
                        `;
                        tableBody.append(newRow);
                    });
                }
            });
        });

        $('#resetFilter').click(function() {
            $('#filterDate').val('');
            location.reload();
        });
    });
</script>