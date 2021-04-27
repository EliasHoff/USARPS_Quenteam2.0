<?php
require_once 'vendor/autoload.php';
session_start();

$connectionParams = array(
    'url' => 'mysql://root:@localhost/va',
);
$conn = \Doctrine\DBAL\DriverManager::getConnection($connectionParams);


if (isset($_GET['submit'])) {
    $stmt = $conn->query("INSERT INTO shirts VALUES (' " . $_GET['name'] . "', '" . $_GET['size'] . "','" . date("Y-m-d") . "')");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shirt</title>
</head>

<body>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="get">
        <input type="text" name="name" required>
        <input type="number" name="size" required>
        <input type="submit" name="submit" value="submit">
    </form>
    <a href="list.php">LIST</a>
</body>

</html>