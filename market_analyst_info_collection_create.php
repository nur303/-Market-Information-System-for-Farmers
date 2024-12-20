<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    <title>Create Market Analysis</title>
</head>
<body>
    <div class="container my-5">
        <header class="d-flex justify-content-between my-4">
            <h1>Create Market Analysis</h1>
            <div>
                <a href="market_analyst_info_collection_index.php" class="btn btn-primary">Back</a>
            </div>
        </header>
        
        <form action="market_analyst_info_collection_process.php" method="post">
            <div class="form-element my-4">
                <input type="text" class="form-control" name="collection_id" placeholder="Collection ID">
            </div>

            <div class="form-element my-4">
                <input type="text" class="form-control" name="crop_id" placeholder="Crop ID">
            </div>

            <div class="form-element my-4">
                <input type="number" step="0.01" class="form-control" name="price_perkg" placeholder="Price per KG">
            </div>

            <div class="form-element my-4">
                <input type="text" class="form-control" name="month" placeholder="Month">
            </div>

            <div class="form-element my-4">
                <input type="text" class="form-control" name="location" placeholder="Location">
            </div>
            
            <div class="form-element my-4">
                <input type="submit" name="create_data" value="Create Data" class="btn btn-primary">
            </div>
        </form>
    </div>
</body>
</html>