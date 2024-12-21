<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>Create Bid</title>
</head>
<body>
    <div class="container my-5">
        <header class="d-flex justify-content-between my-4">
            <h1>Create Bid</h1>
            <div>
                <a href="agent_bid_index.php" class="btn btn-primary">Back</a>
            </div>
        </header>
        
        <form action="agent_bid_process.php" method="post">
            <div class="form-element my-4">
                <input type="text" class="form-control" name="bid_id" placeholder="Bid ID:" required>
            </div>

            <div class="form-element my-4">
                <input type="text" class="form-control" name="crop_id" placeholder="Crop ID:" required>
            </div>

            <div class="form-element my-4">
                <input type="text" class="form-control" name="farmer_id" placeholder="Farmer ID:" required>
            </div>
            
            <div class="form-element my-4">
                <input type="text" class="form-control" name="min_bid_price" placeholder="Minimum Bid Price:" required>
            </div>

            <div class="form-element my-4">
                <input type="number" class="form-control" name="quantity" placeholder="Quantity:" required>
            </div>

            <div class="form-element my-4">
                <input type="text" class="form-control" name="location" placeholder="Location:" required>
            </div>
            
            <div class="form-element my-4">
                <input type="date" class="form-control" name="bid_end_date" placeholder="Bid End Date:" required>
            </div>
            
            <div class="form-element my-4">
                <input type="submit" name="create_bid" value="Create Bid" class="btn btn-primary">
            </div>
        </form>
    </div>
</body>
</html>
