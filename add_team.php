<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('db.php');

$teamExists = false;
$success = false;
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $team_name = trim($_POST['team_name']);
    $matches_played = (int)$_POST['matches_played'];
    $wins = (int)$_POST['wins'];
    $losses = (int)$_POST['losses'];
    $nrr = floatval($_POST['nrr']);
    $points = (int)$_POST['points'];

    // Check if team already exists
    $check = $conn->prepare("SELECT team_id FROM teams WHERE team_name = ?");
    $check->bind_param("s", $team_name);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        $teamExists = true;
    } else {
        // Insert team
        $stmt = $conn->prepare("INSERT INTO teams (team_name, matches_played, wins, losses, nrr, points) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("siiiid", $team_name, $matches_played, $wins, $losses, $nrr, $points);

        if ($stmt->execute()) {
            $success = true;
            header("Location: points_table.php"); // Redirect after success
            exit;
        } else {
            $error = "Error inserting team: " . $stmt->error;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Team</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f8;
            padding: 30px;
        }

        .form-container {
            background: #fff;
            max-width: 500px;
            margin: auto;
            padding: 25px 30px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        h3 {
            text-align: center;
            color: #2c3e50;
        }

        form label {
            display: block;
            margin-bottom: 10px;
            color: #34495e;
        }

        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 8px;
            margin-top: 4px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 6px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #3498db;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            width: 100%;
        }

        input[type="submit"]:hover {
            background-color: #2980b9;
        }

        .message {
            text-align: center;
            margin-top: 10px;
            font-weight: bold;
        }

        .error {
            color: #e74c3c;
        }

        .success {
            color: #27ae60;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h3>Add New Team</h3>
    <?php if ($teamExists): ?>
        <div class="message error">⚠️ Team already exists!</div>
    <?php elseif ($error): ?>
        <div class="message error">❌ <?php echo htmlspecialchars($error); ?></div>
    <?php elseif ($success): ?>
        <div class="message success">✅ Team added successfully!</div>
    <?php endif; ?>

    <form action="insert.php" method="post">
        <label>Team Name:
            <input type="text" name="team_name" required>
        </label>

        <label>Matches Played:
            <input type="number" name="matches_played" required>
        </label>

        <label>Wins:
            <input type="number" name="wins" required>
        </label>

        <label>Losses:
            <input type="number" name="losses" required>
        </label>

        <label>Net Run Rate (NRR):
            <input type="text" name="nrr" required>
        </label>

        <label>Points:
            <input type="number" name="points" required>
        </label>

        <input type="submit" value="Add Team">
    </form>
</div>

</body>
</html>
