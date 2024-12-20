<?php
include('connect.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_POST["create_sale"])) {
    $sale_id = mysqli_real_escape_string($conn, $_POST["sale_id"]);
    $harvest_date = mysqli_real_escape_string($conn, $_POST["harvest_date"]);
    $date_sold = mysqli_real_escape_string($conn, $_POST["date_sold"]);
    $quantity = mysqli_real_escape_string($conn, $_POST["quantity"]);
    $sold_price = mysqli_real_escape_string($conn, $_POST["sold_price"]);
    $production_expense = mysqli_real_escape_string($conn, $_POST["production_expense"]);
    $farmer_profit = mysqli_real_escape_string($conn, $_POST["farmer_profit"]);

    $sqlInsert = "INSERT INTO agent_sales_db (sale_id, harvest_date, date_sold, quantity, sold_price, production_expense, farmer_profit) 
                  VALUES ('$sale_id', '$harvest_date', '$date_sold', $quantity, $sold_price, $production_expense, $farmer_profit)";

    if (mysqli_query($conn, $sqlInsert)) {
        session_start();
        $_SESSION["create"] = "Sale Record Added Successfully!";
        header("Location:agent_sales_index.php");
        exit();
    } else {
        die("Query failed: " . mysqli_error($conn));
    }
}

if (isset($_POST["edit_sale"])) {
    $sale_id = mysqli_real_escape_string($conn, $_POST["sale_id"]);
    $harvest_date = mysqli_real_escape_string($conn, $_POST["harvest_date"]);
    $date_sold = mysqli_real_escape_string($conn, $_POST["date_sold"]);
    $quantity = mysqli_real_escape_string($conn, $_POST["quantity"]);
    $sold_price = mysqli_real_escape_string($conn, $_POST["sold_price"]);
    $production_expense = mysqli_real_escape_string($conn, $_POST["production_expense"]);
    $farmer_profit = mysqli_real_escape_string($conn, $_POST["farmer_profit"]);

    $sqlUpdate = "UPDATE agent_sales_db 
                  SET harvest_date = '$harvest_date',
                      date_sold = '$date_sold',
                      quantity = $quantity,
                      sold_price = $sold_price,
                      production_expense = $production_expense,
                      farmer_profit = $farmer_profit
                  WHERE sale_id = '$sale_id'";

    if (mysqli_query($conn, $sqlUpdate)) {
        session_start();
        $_SESSION["update"] = "Sale Record Updated Successfully!";
        header("Location: agent_sales_index.php");
        exit();
    } else {
        die("Query failed: " . mysqli_error($conn));
    }
}

die("Invalid request.");
?>
