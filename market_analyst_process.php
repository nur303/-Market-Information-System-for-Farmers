
<?php
include('market_analyst_connect.php');

if (isset($_POST["create"])) {
    // Additional Fields for Crop Management
    $crop_name = mysqli_real_escape_string($conn, $_POST["crop_name"]);
    $crop_id = mysqli_real_escape_string($conn, $_POST["crop_id"]);
    $area_code = mysqli_real_escape_string($conn, $_POST["area_code"]);
    $area_location = mysqli_real_escape_string($conn, $_POST["area_location"]);
    $advice_reason = mysqli_real_escape_string($conn, $_POST["advice_reason"]);
    $expected_price = mysqli_real_escape_string($conn, $_POST["expected_price"]);
    $highest_price = mysqli_real_escape_string($conn, $_POST["highest_price"]);
    $lowest_price = mysqli_real_escape_string($conn, $_POST["lowest_price"]);
    $demand_status = mysqli_real_escape_string($conn, $_POST["demand_status"]);
    $supply_status = mysqli_real_escape_string($conn, $_POST["supply_status"]);

    $sqlInsert = "INSERT INTO books(
        crop_name, crop_id, area_code, area_location, 
        advice_reason, expected_price, highest_price, lowest_price, 
        demand_status, supply_status
    ) VALUES (
        '$crop_name', '$crop_id', '$area_code', '$area_location', 
        '$advice_reason', '$expected_price', '$highest_price', '$lowest_price', 
        '$demand_status', '$supply_status'
    )";

    if (mysqli_query($conn, $sqlInsert)) {
        session_start();
        $_SESSION["create"] = "Record Added Successfully!";
        header("Location:market_analyst_index.php");
    } else {
        die("Something went wrong: " . mysqli_error($conn));
    }
    
}

if (isset($_POST["edit"])) {
    // Additional Fields for Crop Management
    $crop_name = mysqli_real_escape_string($conn, $_POST["crop_name"]);
    $crop_id = mysqli_real_escape_string($conn, $_POST["crop_id"]);
    $area_code = mysqli_real_escape_string($conn, $_POST["area_code"]);
    $area_location = mysqli_real_escape_string($conn, $_POST["area_location"]);
    $advice_reason = mysqli_real_escape_string($conn, $_POST["advice_reason"]);
    $expected_price = mysqli_real_escape_string($conn, $_POST["expected_price"]);
    $highest_price = mysqli_real_escape_string($conn, $_POST["highest_price"]);
    $lowest_price = mysqli_real_escape_string($conn, $_POST["lowest_price"]);
    $demand_status = mysqli_real_escape_string($conn, $_POST["demand_status"]);
    $supply_status = mysqli_real_escape_string($conn, $_POST["supply_status"]);
    $id = mysqli_real_escape_string($conn, $_POST["id"]);

    $sqlUpdate = "UPDATE books SET 
        crop_name = '$crop_name',
        crop_id = '$crop_id',
        area_code = '$area_code',
        area_location = '$area_location',
        advice_reason = '$advice_reason',
        expected_price = '$expected_price',
        highest_price = '$highest_price',
        lowest_price = '$lowest_price',
        demand_status = '$demand_status',
        supply_status = '$supply_status' 
        WHERE id = '$id'";

    if (mysqli_query($conn, $sqlUpdate)) {
        session_start();
        $_SESSION["update"] = "Record Updated Successfully!";
        header("Location:market_analyst_index.php");
    } else {
        die("Something went wrong: " . mysqli_error($conn));
    }
}
?>
