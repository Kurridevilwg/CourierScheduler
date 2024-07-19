<?
include_once './layouts/head.php';
?>
<title>Расписание поездок курьеров</title>
</head>

<body class="bg-gray-100 max-w-6xl mx-auto p-8">
    <div class="flex justify-between gap-8">
        <?php
        require './views/addTripForm.php';
        require './views/tableTrips.php';
        ?>
    </div>
</body>

</html>