<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>addevent</title>
    <link rel="stylesheet" href="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container my-5" >
        <h2>List of Item</h2>
        <a class="btn btn-primary" href="/GSOInvSys/create.php" role="button">New Item</a>
    </div>
    <br>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Item Name</th>
                <th>Office Name</th>
                <th>Property Code</th>
                <th>User</th>
                <th>Discreption</th>
                <th>Date Added</th>
                <th>Action</th>
            </tr>
        </thead>
            <tbody>
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $database = "gsoinventory";

                // connection Database
                $connection =new mysqli($servername,$username,$password,$database);

                // check connection
                if ($connection->connect_error) {
                    die("Connection failed: " . $connection->connect_error);
                }

                // read all row from database table
                $sql = "SELECT * from items";
                $result = $connection->query($sql);

                if (!$result) {
                    die("Invalid query: " . $connection->error);
                }

                // read data of each row

                while($row = $result->fetch_assoc()) {
                    echo "
                    <tr>
                        <td>$row[id]</td>
                        <td>$row[item_name]</td>
                        <td>$row[office_name]</td>
                        <td>$row[property_code]</td>
                        <td>$row[end_user]</td>
                        <td>$row[description]</td>
                        <td>$row[created_at]</td>
                        <td>
                            <a class='btn btn-primary btn-sm' href='/GSOInvSys/editItem.php?id=$row[id]'>Edit</a>
                            <a class='btn btn-danger btn-sm' href='/GSOInvSys/deleteitem.php?id=$row[id]'>Delete</a>
                        </td>
                    </tr>
                    ";
                }
                ?>
            
           
            </tbody>
    </table>
</body>
</html>