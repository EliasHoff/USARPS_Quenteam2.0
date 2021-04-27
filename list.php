<?php
require_once 'vendor/autoload.php';
session_start();

$connectionParams = array(
    'url' => 'mysql://root:@localhost/va',
);
$conn = \Doctrine\DBAL\DriverManager::getConnection($connectionParams);


$selectAll = $conn->createQueryBuilder();
$selectAll
    ->select('*')
    ->from('shirts');

$delete = $conn->createQueryBuilder();


$stmt = $conn->query($selectAll);
if (isset($_GET['delete'])) {
    $delete
        ->delete('shirts')
        ->where('name = ?')
        ->setParameter(1, $_GET['name'])
        ->execute();

    $del = $conn->query($delete);
    header('location:list.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List</title>
    <style>
        td {
            border: 2px solid black;
        }
    </style>
</head>

<body>
    <table style="border: 2px solid black;">
        <thead>
            <th>Number</th>
            <th>Name</th>
            <th>Delete</th>
        </thead>
        <?php
        while (($row = $stmt->fetchAssociative()) !== false) {
            echo "<tr><td>";
            echo $row['size'] . "</td><td>" . $row['name'];
            echo "</td><td> <form action=\"" . $_SERVER['PHP_SELF'] . "\" method=\"get\">
            <input type=\"hidden\" name=\"name\" value=\"" . $row['name'] . "\" />
            <input type=\"submit\" name=\"delete\" value=\"X\">
        </form>
            </td></tr>";
        } ?>
    </table>
    <a href="insert.php">INSERT</a>
</body>

</html>