<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>Add New Info</title>
</head>
<body>
    <div class="container my-5">
    <header class="d-flex justify-content-between my-4">
            <h1>Add New Info</h1>
            <div>
            <a href="market_analyst_index.php" class="btn btn-primary">Back</a>
            </div>
        </header>
        
        <form action="market_analyst_process.php" method="post">
    <!-- Existing form elements -->

    <div class="form-element my-4">
        <input type="text" class="form-control" name="crop_name" placeholder="Crop Name:">
    </div>
    <div class="form-element my-4">
        <input type="text" class="form-control" name="crop_id" placeholder="Crop ID:">
    </div>
    <div class="form-element my-4">
        <input type="text" class="form-control" name="area_code" placeholder="Area Code:">
    </div>
    <div class="form-element my-4">
        <input type="text" class="form-control" name="area_location" placeholder="Area Location:">
    </div>
    
    <!-- Continue with previously mentioned fields and the submit button -->

    <div class="form-element my-4">
        <textarea name="advice_reason" class="form-control" placeholder="Reason for Advice Rate:"></textarea>
    </div>
    <div class="form-element my-4">
        <input type="number" class="form-control" name="expected_price" placeholder="Expected Price After Week (Tk per Kg):">
    </div>
    <div class="form-element my-4">
        <input type="number" class="form-control" name="highest_price" placeholder="Highest Price (Tk per Kg):">
    </div>
    <div class="form-element my-4">
        <input type="number" class="form-control" name="lowest_price" placeholder="Lowest Price (Tk per Kg):">
    </div>
    <div class="form-element my-4">
        <select name="demand_status" class="form-control">
            <option value="">Select Demand Status:</option>
            <option value="High">High</option>
            <option value="Medium">Medium</option>
            <option value="Low">Low</option>
        </select>
    </div>
    <div class="form-element my-4">
        <select name="supply_status" class="form-control">
            <option value="">Select Supply Status:</option>
            <option value="High">High</option>
            <option value="Medium">Medium</option>
            <option value="Low">Low</option>
        </select>
    </div>
    
    <div class="form-element my-4">
        <input type="submit" name="create" value="Add Info" class="btn btn-primary">
    </div>
        </form>
        
        
    </div>
</body>
</html>