<?
require_once './controllers/getAllRegion.php';
require_once './controllers/getAllCouriers.php'
?>
<form id="addTripForm" class="bg-white p-6 rounded-lg shadow-md w-1/3">
    <div class="mb-4">
        <label for="region" class="block text-gray-700 font-bold mb-2">Регион:</label>
        <select id="region" name="region" class="w-full px-3 py-2 border rounded-md">
            <?php foreach ($allRegions as $region) : ?>
                <option value="<?= $region['id'] ?>"><?= $region['name'] ?> (туда-обратно <?= $region['travel_time']*2 ?> дней)</option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-4">
        <label for="departureDate" class="block text-gray-700 font-bold mb-2">Дата выезда из Москвы:</label>
        <input type="date" id="departureDate" name="departureDate" required min="<?= date('Y-m-d'); ?>" class="w-full px-3 py-2 border rounded-md">
    </div>

    <div class="mb-4">
        <label for="courier" class="block text-gray-700 font-bold mb-2">ФИО курьера:</label>
        <select id="courier" name="courier" required class="w-full px-3 py-2 border rounded-md">
        </select>
    </div>

    <div class="mb-4">
        <div class="text-gray-700 mb-1">Курьер доставит посылку: <span id="arrivalDate" class="font-semibold"></span></div>
        <div class="text-gray-700">Курьер обратно вернётся: <span id="returnDate" class="font-semibold"></span></div>
    </div>

    <div class="text-right">
        <input type="submit" value="Добавить поездку" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 cursor-pointer">
    </div>
</form>

<script>
    $(document).ready(function() {
        function updateCouriersAndDates() {
            const departureDate = $('#departureDate').val();
            const region = $('#region').val();

            if (departureDate && region) {
                $.ajax({
                    type: 'GET',
                    url: 'controllers/getAvailableCouriers.php',
                    data: {
                        departureDate: departureDate,
                        region: region,
                    },
                    success: function(response) {
                        const data = JSON.parse(response);
                        const couriers = data.availableCouriers;
                        const arrivalDate = data.arrivalDate;
                        const returnDate = data.returnDate;

                        const courierSelect = $('#courier');
                        courierSelect.empty();

                        if (couriers.length > 0) {
                            couriers.forEach(function(courier) {
                                courierSelect.append('<option value="' + courier.id + '">' + courier.name + '</option>');
                            });
                        } else {
                            courierSelect.append('<option value="">Нет доступных курьеров</option>');
                        }

                        $('#arrivalDate').text(arrivalDate);
                        $('#returnDate').text(returnDate);
                    }
                });
            }
        }

        function addTripToTable(trip) {
            const newRow = `
                <tr>
                    <td class="py-2 px-4 border-b">${trip.region_name}</td>
                    <td class="py-2 px-4 border-b">${trip.courier_name}</td>
                    <td class="py-2 px-4 border-b">${trip.departure_date}</td>
                    <td class="py-2 px-4 border-b">${trip.arrival_date}</td>
                    <td class="py-2 px-4 border-b">${trip.return_date}</td>
                </tr>
            `;
            $('#tripsTableBody').prepend(newRow);
        }

        $('#departureDate').change(updateCouriersAndDates);
        $('#region').change(updateCouriersAndDates);

        $('#addTripForm').submit(function(event) {
            event.preventDefault();

            const region = $('#region').val();
            const courier = $('#courier').val();
            const departureDate = $('#departureDate').val();

            $.ajax({
                type: 'POST',
                url: 'controllers/addTrip.php',
                data: {
                    region: region,
                    courier: courier,
                    departureDate: departureDate
                },
                success: function(response) {
                    const result = JSON.parse(response);
                    if (result.status === 'success') {
                        alert('Курьер назначен');
                        addTripToTable(result.trip);

                        // Сброс формы после успешного добавления
                        $('#addTripForm')[0].reset();
                        $('#courier').empty();
                        $('#arrivalDate').text('');
                        $('#returnDate').text('');
                    } else {
                        alert(result.message);
                    }
                }
            });
        });
    });
</script>