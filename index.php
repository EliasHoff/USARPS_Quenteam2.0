<?php
require_once 'vendor/autoload.php';
session_start();

$connectionParams = array(
    'url' => 'mysql://root:@localhost/usarps',
);
$conn = \Doctrine\DBAL\DriverManager::getConnection($connectionParams);

$selectAll = $conn->createQueryBuilder();
$selectAll
    ->select('*')
    ->from('game');
$stmt = $conn->query($selectAll);
function getWinner($sym1, $sym2)
{
    if ($sym1 == $sym2) {
        return 0;
    } else if ($sym1 == "rock" && $sym2 == "scissors") {
        return 1;
    } else if ($sym1 == "paper" && $sym2 == "rock") {
        return 1;
    } else if ($sym1 == "scissors" && $sym2 == "paper") {
        return 1;
    } else {
        return 2;
    }
}

if (isset($_GET['sub_game'])) {
    echo $_GET['player1'];
    $insertGame = $conn->createQueryBuilder();
    $insertGame
        ->insert('game')
        ->values(
            array(
                'player1' => "'" . $_GET['player1'] . "'",
                'player2' => "'" . $_GET['player2'] . "'",
                'date' => "'" . $_GET['date'] . "'"
            )
        );
    $conn->query($insertGame);
}

if (isset($_GET['sub_round'])) {
    $insertRound = $conn->createQueryBuilder();
    $insertRound
        ->insert('round')
        ->values(
            array(
                'fk_pk_game_id' => $_GET['fk_pk_game_id'],
                'symbol1' => "'" . $_GET['symbol1'] . "'",
                'symbol2' => "'" . $_GET['symbol2'] . "'",
                'winner' => getWinner($_GET['symbol1'], $_GET['symbol2']),
                'time' => "'" . $_GET['time'] . "'"
            )
        );
    $conn->query($insertRound);
    header('Location: index.php');
}

if (isset($_GET['delete'])) {
    $deleteRound = $conn->createQueryBuilder();
    $deleteRound
        ->delete('round')
        ->where("pk_round_id = " . $_GET['rId']);

    $conn->query($deleteRound);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RPS - Championship </title>
    <style>
        .w {
            background-color: green;
            color: white;
        }

        th {
            border: solid black 1px;
        }

        td {
            border: solid black 1px;
            border-radius: 2px;
            padding: 5px;
        }

        .p {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <h1>
        USA RPS - Championship
    </h1>

    <?php
    $gameCount = $stmt->rowCount();
    while (($row = $stmt->fetchAssociative()) !== false) {
        echo "<table>
                <thead>
                    <th colspan='7'>
                        <h2>{$row['pk_game_id']}. Game - {$row['player1']} vs. {$row['player2']}</h2>
                    </th>
                </thead>";


        $selectRounds = $conn->createQueryBuilder();
        $gamenr = $row['pk_game_id'];
        $selectRounds
            ->select('*')
            ->from('round')
            ->where('fk_pk_game_id = ' . $gamenr); // SETPARAM EVTL NACHMACHEN
        $stmntRounds = $conn->query($selectRounds);

        $i = 1;
        while (($rowR = $stmntRounds->fetchAssociative()) !== false) {
            echo "<tr>
                <td>Runde {$i}</td>
                <td class='p'>{$row['player1']}</td>
                <td ";
            echo ($rowR['winner'] == 1) ? 'class=\'w\'' : '';
            echo ">{$rowR['symbol1']}</td>
                <td ";
            echo ($rowR['winner'] == 2) ? 'class=\'w\'' : '';
            echo ">{$rowR['symbol2']}</td>
                <td class='p'>{$row['player2']}</td>
                <td>{$row['date']} {$rowR['time']}</td>
                <td>";
            echo "<form action=\"{$_SERVER['PHP_SELF']}\" method=\"get\">
                    <input type=\"hidden\" name=\"rId\" value=\"{$rowR['pk_round_id']}\">
                    <input type=\"submit\" name=\"delete\" value=\"X\">
                </form>";
            echo "</td>
            </tr>";
            $i++;
        }
        echo "</table><br>";
    }
    echo "<hr />";
    ?>
    <h3>Create a new Game:</h3>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="get">
        <input type="text" name='player1' placeholder="Player 1" required>
        <input type="text" name='player2' placeholder="Player 2" required>
        <input type="date" name='date' value="<?php echo date('Y-m-d'); ?>" required>
        <input type="submit" name="sub_game" value="Submit">
    </form>
    <hr>
    <h3>Create a new Round:</h3>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="get">
        <label for="gameID">Game</label>
        <select name="fk_pk_game_id" id="gameID" required>
            <?php
            for ($i = 1; $i <= $gameCount; $i++) {
                if ($i == $gameCount) {
                    echo "<option value=\"$i\" selected>$i</option>";
                } else {
                    echo "<option value=\"$i\">$i</option>";
                }
            }
            ?>

        </select>
        <label for="symbol1">Player 1:</label>
        <select name="symbol1" id="symbol1" required>
            <option value="" selected disabled>Select a Symbol</option>
            <option value="rock">Rock</option>
            <option value="paper">Paper</option>
            <option value="scissors">Scissors</option>
        </select>
        <label for="symbol2">Player 2:</label>
        <select name="symbol2" id="symbol2" required>
            <option value="" selected disabled>Select a Symbol</option>
            <option value="rock">Rock</option>
            <option value="paper">Paper</option>
            <option value="scissors">Scissors</option>
        </select>
        <label for="time">Time of Round:</label>
        <input type="time" name='time' id="time" value="<?php echo date('H:i'); ?>" required>
        <input type="submit" name="sub_round" value="Submit">
    </form>
</body>

</html>