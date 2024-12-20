<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>Create Data Collection</title>
</head>
<body>
    <div class="container my-5">
        <header class="d-flex justify-content-between my-4">
            <h1>Create Data Collection</h1>
            <div>
                <a href="agent_data_collection_index.php" class="btn btn-primary">Back</a>
            </div>
        </header>
        
        <form action="agent_data_collection_process.php" method="post">
            <div class="form-element my-4">
                <input type="text" class="form-control" name="data_collection_id" placeholder="Data Collection ID">
            </div>

            <div class="form-element my-4">
                <input type="text" class="form-control" name="crop_id" placeholder="Crop ID">
            </div>

            <div class="form-element my-4">
                <input type="text" class="form-control" name="farmer_id" placeholder="Farmer ID">
            </div>

            <div class="form-element my-4">
                <input type="text" class="form-control" name="location" placeholder="Location">
            </div>

            <div class="form-element my-4">
                <input type="text" class="form-control" name="expected_price" placeholder="Expected Price">
            </div>
            
            <div class="form-element my-4">
                <input type="submit" name="create_data" value="Create Data" class="btn btn-primary">
            </div>
        </form>
    </div>
</body>
</html>
