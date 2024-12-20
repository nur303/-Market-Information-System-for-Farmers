<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>Edit Info</title>
</head>
<body>
    <div class="container my-5">
    <header class="d-flex justify-content-between my-4">
            <h1>Edit Info</h1>
            <div>
            <a href="market_analyst_index.php" class="btn btn-primary">Back</a>
            </div>
        </header>
        <form action="market_analyst_process.php" method="post">
            <?php 
            if (isset($_GET['id'])) 
                include("market_analyst_connect.php");
                $id = $_GET['id'];
                $sql = "SELECT * FROM books WHERE id=$id";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_array($result);
                ?>
                <!-- New Fields for Crop Management -->
                <div class="form-elemnt my-4">
                    <input type="text" class="form-control" name="crop_name" placeholder="Crop Name:" >
                </div>
                <div class="form-elemnt my-4">
                    <input type="text" class="form-control" name="crop_id" placeholder="Crop ID:" >
                </div>
                <div class="form-elemnt my-4">
                    <input type="text" class="form-control" name="area_code" placeholder="Area Code:" >
                </div>
                <div class="form-elemnt my-4">
                    <input type="text" class="form-control" name="area_location" placeholder="Area Location:" >
                </div> 

                <!-- Additional Fields -->
                 <div class="form-element my-4">
                    <textarea name="advice_reason" class="form-control" placeholder="Reason for Advice Rate:"></textarea>
                </div>
                <div class="form-element my-4">
                    <input type="number" class="form-control" name="expected_price" placeholder="Expected Price After Week (Tk per Kg):" >
                </div>
                <div class="form-element my-4">
                    <input type="number" class="form-control" name="highest_price" placeholder="Highest Price:" >
                </div>
                <div class="form-element my-4">
                    <input type="number" class="form-control" name="lowest_price" placeholder="Lowest Price:" >
                </div>
                <div class="form-element my-4">
                    <select name="demand_status" class="form-control">
                        <option value="">Select Demand Status:</option>
                        <option value="High" <?php if($row["demand_status"]=="High"){echo "selected";} ?>>High</option>
                        <option value="Medium" <?php if($row["demand_status"]=="Medium"){echo "selected";} ?>>Medium</option>
                        <option value="Low" <?php if($row["demand_status"]=="Low"){echo "selected";} ?>>Low</option>
                    </select>
                </div>
                <div class="form-element my-4">
                    <select name="supply_status" class="form-control">
                        <option value="">Select Supply Status:</option>
                        <option value="High" <?php if($row["supply_status"]=="High"){echo "selected";} ?>>High</option>
                        <option value="Medium" <?php if($row["supply_status"]=="Medium"){echo "selected";} ?>>Medium</option>
                        <option value="Low" <?php if($row["supply_status"]=="Low"){echo "selected";} ?>>Low</option>
                    </select>
                </div> 

                <input type="hidden" value="<?php echo $id; ?>" name="id">
                <div class="form-element my-4">
                    <input type="submit" name="edit" value="Edit " class="btn btn-primary">
                </div>
                
            
        </form>   
    </div>
</body>
</html>