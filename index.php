<?php // http://localhost/Lab1-Todolist
$page_title = "Lab 1: To Do List";

// Create connection
require_once __DIR__ . "/database.php";

$sql = "SELECT * FROM tasks";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title><?= $page_title ?></title>
</head>

<body>
    <header>
        <h1><?= $page_title ?></h1>
        <nav>
            <button class="nav nav1"><a href="/Lab1-Todolist/new-task.php"> Create Task </a></button>
        </nav>
    </header>
    <main>
        <table class="table">
            <tr>
                <th> Title </th>
                <th> Description </th>
                <th> Status</th>
            </tr>

            <?php
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>{$row["title"]}</td>
                    <td>{$row["description"]}</td>
                    <td>{$row["status"]}</td>
                    <td><a href='edit-task.php?id={$row["id"]}' type='button'>Edit</a></td>
                </tr>";
            } ?>
        </table>
    </main>

</body>

</html>