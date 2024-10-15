<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Items</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="./dashboard.php">Dashboard </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./addItems.php">Add Items</a>
                </li>

            </ul>
        </div>
    </nav>

    <div class="container mt-5">
        <?php
        require('dbConnection.php');
        $query = "SELECT * FROM `items` WHERE is_deleted = 0";
        $result = $conn->query($query);
        $items = $result->fetchAll(PDO::FETCH_ASSOC);

        ?>

        <div class="d-flex justify-content-between mb-3">
            <h1>All Items</h1>
            <a href="./addItems.php" class="btn btn-primary">Add Item</a>
        </div>

        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Item Description</th>
                    <th>Item Image</th>
                    <th>Item Total Number</th>
                    <th colspan="2" style="text-align: center;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($items as $item) {
                    echo "<tr>";
                    echo "<td>" .$item['item_description'] . "</td>";
                    echo "<td><img src='uploads/" . $item['item_image']. "' width='100' height='100'></td>";
                    echo "<td>" . $item['item_total_number'] . "</td>";
                    echo "<td> <a class='btn btn-warning' href='editItem.php?id=".$item['item_id']."'>Edit </a> </td>";
                    echo "<td> <a class='btn btn-danger' href='deleteitem.php?id=".$item['item_id']."'>Delete</a> </td>";

                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

 
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

</body>

</html>