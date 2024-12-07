<?php
include('connect.php');


$airlineNameFilter = $_GET['airlineName'] ?? '';
$sortTable = $_GET['sortTable'] ?? '';
$orderTable = $_GET['orderTable'] ?? '';

$flightsQuery = "SELECT * FROM flightlogs";

if ($airlineNameFilter != '') {
    $flightsQuery = $flightsQuery . " WHERE airlineName='$airlineNameFilter'";
}

if ($sortTable != '') {
    $flightsQuery = $flightsQuery . " ORDER BY $sortTable";

    if ($orderTable != '') {
        $flightsQuery = $flightsQuery." $orderTable";
    }
}
$flightResults = executeQuery($flightsQuery);

$airlineQuery = "SELECT DISTINCT(airlineName) FROM flightlogs";
$airlineQueryResults = executeQuery($airlineQuery);

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PUP Airport | Flight Logs </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body data-bs-theme="dark">

    <div class="container mb-5 mt-5">
        <div class="row ">
            <div class="col">
                <div class="card m-3 p-4 shadow-sm text-center">
                    <div class="display-3">
                        PUP Airport
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card mx-3">
                    <form class="d-flex mt-3 mx-4">
                            <label for="airlineSelect" class="m-2">Airline Type</label>
                            <select class="form-control mx-2 p-2" id="airlineSelect" name="airlineName"
                                style="width: auto;">
                                <option value="">Any</option>
                                <?php
                                if (mysqli_num_rows($airlineQueryResults) > 0) {
                                    while ($airline = mysqli_fetch_assoc($airlineQueryResults)) {
                                        ?>
                                        <option <?php if ($airlineNameFilter == $airline['airlineName']) {
                                            echo "selected";
                                        } ?>
                                            value="<?php echo $airline['airlineName'] ?>">
                                            <?php echo $airline['airlineName'] ?>
                                        </option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>

                            <label for="sort" class="m-2">Sort By</label>
                            <select id="sort" name="sortTable" class="ms-2 form-control" style="width: fit-content">
                                <option value="">None</option>
                                <option <?php if ($sortTable == "flightNumber") {
                                    echo "selected";
                                } ?> value="flightNumber">Flight Number
                                </option>
                                <option <?php if ($sortTable == "airlineName") {
                                    echo "selected";
                                } ?> value="airlineName">Airline Name
                                </option>
                                <option <?php if ($sortTable == "departureDatetime") {
                                    echo "selected";
                                } ?> value="departureDatetime">Departure
                                </option>
                                <option <?php if ($sortTable == "arrivalDateTime") {
                                    echo "selected";
                                } ?> value="arrivalDateTime">Arrival
                                </option>
                                <option <?php if ($sortTable == "flightDurationMinutes") {
                                    echo "selected";
                                } ?> value="flightDurationMinutes">Flight Duration
                                </option>
                            </select>

                            <label for="order" class="m-2">Order By</label>
                            <select id="order" name="orderTable" class="ms-2 form-control" style="width: fit-content">
                                <option <?php if ($orderTable == "ASC") {echo "selected";} ?> value="ASC">Ascending</option>
                                <option <?php if ($orderTable == "DESC") {echo "selected";} ?> value="DESC">Descending</option>
                            </select>
                            <button name="btnFilter" class="mx-2 btn btn-primary fit-content">Filter</button>
                    </form>

                    <div class="row">
                    <div class="col">
                        <div class="table">
                            <table class="table table-hover mt-2">
                                <thead>
                                    <tr class>
                                        <th scope="col">Flight Number</th>
                                        <th scope="col">Airline Name</th>
                                        <th scope="col">Departure</th>
                                        <th scope="col">Arrival</th>
                                        <th scope="col">Flight Duration</th>
                                    </tr>
                                </thead>
                                <tbody class="table-primary">
                                    <?php
                                    if (mysqli_num_rows($flightResults) > 0) {
                                        while ($flightResultRows = mysqli_fetch_assoc($flightResults)) {
                                            echo "<tr>
                                                    <td>{$flightResultRows['flightNumber']}</td>
                                                    <td>{$flightResultRows['airlineName']}</td>
                                                    <td>{$flightResultRows['departureDatetime']}</td>
                                                    <td>{$flightResultRows['arrivalDatetime']}</td>
                                                    <td>" . floor($flightResultRows['flightDurationMinutes'] / 60) . "h " . ($flightResultRows['flightDurationMinutes'] % 60) . "m</td>
                                                </tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='6'>No records found</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>