<!DOCTYPE html>
<html>
    <head>
        <title>PHP CRUD</title>
        <script  src="assets/js/jquery-2.1.3.min.js" type="text/javascript"></script>
        <script  src="assets/js/bootstrap.min.js" type="text/javascript"></script>
        <link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
        <link rel="stylesheet" href="assets/css/style.css" type="text/css">
    </head>
    <body>
        <?php require_once './process.php'; ?>
        <?php
        if (isset($_SESSION['message'])):
            ?>

            <div class="alert alert-<?= $_SESSION['msg_type'] ?>">
                <?php
                echo $_SESSION['message'];
                unset($_SESSION['message']);
                ?>

            </div>
        <?php endif ?>    
        <div class="container">
            <?php
            $mysqli = new mysqli('localhost', 'root', '', 'phpcrud') or die(mysqli_error($mysqli));
            $result = $mysqli->query("SELECT * FROM data") or die($mysqli->error);
            //pre_r($result);
            ?>
            <div class="row justify -content-center">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Location</th>
                            <th colspan="2">Action</th>
                        </tr>
                    </thead>
                    <?php while ($row = $result->fetch_assoc()): ?>           

                        <tr>
                            <td><?php echo $row['name'] ?> </td>
                            <td><?php echo $row['location'] ?></td>
                            <td>
                                <a href="index.php?edit=<?php echo $row['id']; ?>"
                                   class="btn btn-info">Edit</a>
                                <a href="index.php?delete=<?php echo $row['id'] ?>"
                                   class="btn btn-danger">Delete</a>
                            </td>
                        </tr>              

                    <?php endwhile; ?>
                </table>
            </div>

            <?php

            function pre_r($array) {
                echo'<pre>';
                print_r($array);
                echo'</pre>';
            }
            ?>
            <div class="row" justify-content-center>
                <form action="process.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control"  value="<?php echo $name; ?>" placeholder="Enter Your Name">
                    </div> 
                    <div class="form-group">
                        <label>Location</label>
                        <input type="text" name="location" class="form-control" value="<?php echo $location; ?>" placeholder="Enter Your Location">
                    </div> 
                    <div class="form-group">
                        <?php
                        if ($update == true):
                            ?>
                            <button type="submit" class="btn btn-info" name="update">Update</button>
                        <?php else: ?>
                            <button type="submit" class="btn btn-primary" name="save">Save</button>
                        <?php endif; ?>
                    </div>
                </form>
            </div>
        </div>
    </body>
