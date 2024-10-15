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

    if (isset($_POST["addItem"])) {
        $item_desc = $_POST["item_desc"];
        $item_img = $_FILES["item_img"]["name"];
        $item_total = $_POST["item_total"];

        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["item_img"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $check = getimagesize($_FILES["item_img"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        if ($_FILES["item_img"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        if ($uploadOk == 1) {
            if (move_uploaded_file($_FILES["item_img"]["tmp_name"], $target_file)) {
                $query = "INSERT INTO `items` (`item_description`, `item_image`, `item_total_number`) VALUES (:item_description, :item_image, :item_total_number)";
                $statement = $conn->prepare($query);
                $statement->bindParam(':item_description', $item_desc);
                $statement->bindParam(':item_image', $item_img);
                $statement->bindParam(':item_total_number', $item_total);

                if ($statement->execute()) {
                    echo '<div class="alert alert-success" role="alert">Item added successfully</div>';
                } else {
                    echo '<div class="alert alert-danger" role="alert">Item not added</div>';
                }
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }
    ?>

    <div class="container">
        <h1>Add Items</h1>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="item_name">Item name</label>
                <input type="text" class="form-control" name="item_name" id="item_name" placeholder="Enter Item name">
            </div>

            <div class="form-group">
                <label for="item_desc">Item Description</label>
                <textarea class="form-control" name="item_desc" id="item_desc" placeholder="Enter Description"></textarea>
            </div>

            <div class="form-group">
                <label for="item_img">Item Image</label>
                <input type="file" class="form-control" name="item_img" id="item_img">
            </div>

            <div class="form-group">
                <label for="item_total">Item Total Number</label>
                <input type="number" class="form-control" name="item_total" id="item_total" placeholder="Enter Total Number">
            </div>

            <button type="submit" class="btn btn-primary" name="addItem">Submit</button>
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
