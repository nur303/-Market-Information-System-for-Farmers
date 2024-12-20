<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    <title>Create Sale Record</title>
</head>
<body>
    <div class="container my-5">
        <header class="d-flex justify-content-between my-4">
            <h1>Create Sale Record</h1>
            <div>
                <a href="agent_sales_index.php" class="btn btn-primary">Back</a>
            </div>
        </header>
        
        <form action="agent_sales_process.php" method="post">
            <div class="form-element my-4">
                <input type="text" class="form-control" name="sale_id" placeholder="Sale ID:" required>
            </div>

            <div class="form-element my-4">
                <input type="date" class="form-control" name="harvest_date" placeholder="Date of Harvest:" required>
            </div>

            <div class="form-element my-4">
                <input type="date" class="form-control" name="date_sold" placeholder="Date Sold:" required>
            </div>
            
            <div class="form-element my-4">
                <input type="number" class="form-control" name="quantity" placeholder="Quantity of Crops:" required>
            </div>

            <div class="form-element my-4">
                <input type="number" step="0.01" class="form-control" name="sold_price" placeholder="Sold Price:" required>
            </div>

            <div class="form-element my-4">
                <input type="number" step="0.01" class="form-control" name="production_expense" placeholder="Total Production Expense:" required>
            </div>

            <div class="form-element my-4">
                <input type="number" step="0.01" class="form-control" name="farmer_profit" placeholder="Farmer Profit:" required>
            </div>
            
            <div class="form-element my-4">
                <input type="submit" name="create_sale" value="Create Sale Record" class="btn btn-primary">
            </div>
        </form>
    </div>
</body>
</html>
