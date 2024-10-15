<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Items</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>

<body>

    <?php
    require('dbConnection.php');

    if (isset($_GET['id'])) {
        $query = "SELECT * FROM `items` WHERE `item_id` = :item_id";
        $statement = $conn->prepare($query);
        $statement->bindParam(':item_id', $_GET['id']);
        $statement->execute();
        $item = $statement->fetch(PDO::FETCH_ASSOC);
    }

    if (isset($_POST["editItem"])) {

        $item_id = $_POST['item_id'];
        $item_desc = $_POST["item_desc"];
        $item_total = $_POST["item_total"];
        $item_img = $_FILES["item_img"]["name"];
    
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["item_img"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    
    
        if ($item_img) {
            $check = getimagesize($_FILES["item_img"]["tmp_name"]);
            if ($check !== false && $_FILES["item_img"]["size"] <= 500000 && in_array($imageFileType, ["jpg", "png", "jpeg", "gif"])) {
                if (move_uploaded_file($_FILES["item_img"]["tmp_name"], $target_file)) {
                
                    $query = "UPDATE `items` SET `item_description` = :item_desc, `item_image` = :item_img, `item_total_number` = :item_total WHERE `item_id` = :item_id";
                } else {
                    echo "Sorry, there was an error uploading your file.";
                    $uploadOk = 0;
                }
            } else {
                echo "Invalid file or file is too large.";
                $uploadOk = 0;
            }
        } else {
           
            $query = "UPDATE `items` SET `item_description` = :item_desc, `item_total_number` = :item_total WHERE `item_id` = :item_id";
        }
    
        if ($uploadOk == 1) {
            $statement = $conn->prepare($query);
            $statement->bindParam(':item_desc', $item_desc);
            $statement->bindParam(':item_total', $item_total);
            $statement->bindParam(':item_id', $item_id);
            if ($item_img) {
                $statement->bindParam(':item_img', $item_img);
            }
    
            if ($statement->execute()) {
                echo '<div class="alert alert-success" role="alert">Item updated successfully</div>';
                header("Location: items.php");
            } else {
                echo '<div class="alert alert-danger" role="alert">Error updating item</div>';
            }
        }
    }
    ?>

    <div class="container">
        <h1>Edit Item</h1>
        <form action="" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="item_id" value="<?php echo $item['item_id']; ?>">

            <div class="form-group">
                <label for="item_desc">Item Description</label>
                <textarea class="form-control" name="item_desc" id="item_desc" placeholder="Enter Description"><?php echo $item['item_description']; ?></textarea>
            </div>

            <div class="form-group">
                <label for="item_img">Item Image</label>
                <input type="file" class="form-control" name="item_img">
                <img src="uploads/<?php echo $item['item_image']; ?>" width="100" height="100" alt="Current Image">
            </div>

            <div class="form-group">
                <label for="item_total">Item Total Number</label>
                <input type="number" class="form-control" name="item_total" value="<?php echo $item['item_total_number']; ?>" placeholder="Enter Total Number">
            </div>

            <button type="submit" class="btn btn-primary" name="editItem">Save Changes</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>

</body>

</html>