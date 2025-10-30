<?php
include('db.php'); // Include database connection

$team_id = (int)($_GET['team_id'] ?? 0);

// Fetch team details
$result = $conn->query("SELECT * FROM teams WHERE team_id = $team_id");
$team = $result->fetch_assoc();

if (!$team) {
    echo "Team not found.";
    exit;
}

// Track how many blank fields to show for new players
$extra_player_count = isset($_POST['add_player']) ? ((int)($_POST['extra_player_count'] ?? 0) + 1) : (int)($_POST['extra_player_count'] ?? 0);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $team_name = $conn->real_escape_string($_POST['team_name']);
    $matches_played = (int)$_POST['matches_played'];
    $wins = (int)$_POST['wins'];
    $losses = (int)$_POST['losses'];
    $nrr = $conn->real_escape_string($_POST['nrr']);
    $points = (int)$_POST['points'];

    // Update the team
    $update_sql = "UPDATE teams SET
        team_name='$team_name',
        matches_played=$matches_played,
        wins=$wins,
        losses=$losses,
        nrr='$nrr',
        points=$points
        WHERE team_id=$team_id";
    $conn->query($update_sql);

    // Update players
    $player_names = $_POST['player_name'] ?? [];
    $roles = $_POST['role'] ?? [];
    $runs = $_POST['runs'] ?? [];
    $wickets = $_POST['wickets'] ?? [];
    $delete_flags = $_POST['delete'] ?? [];

    // Delete all existing players for the team
    $conn->query("DELETE FROM players WHERE team_id = $team_id");

    // Re-insert players except those marked for deletion or with empty names
    foreach ($player_names as $index => $player_name) {
        $player_name = trim($player_name);
        if ($player_name === "") continue; // Skip empty names
        if (isset($delete_flags[$index]) && $delete_flags[$index] === 'on') continue; // Skip deleted

        $role = $conn->real_escape_string($roles[$index] ?? '');
        $run = (int)($runs[$index] ?? 0);
        $wicket = (int)($wickets[$index] ?? 0);

        $insert_sql = "INSERT INTO players (team_id, player_name, role, runs, wickets)
                       VALUES ($team_id, '$player_name', '$role', $run, $wicket)";
        $conn->query($insert_sql);
    }

    header("Location: team.php?team_id=$team_id");
    exit;
}

// Fetch existing players
$playersResult = $conn->query("SELECT * FROM players WHERE team_id = $team_id");
$players = [];
while ($player = $playersResult->fetch_assoc()) {
    $players[] = $player;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Team & Add Player</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(to right, #dceefb, #e0f7fa);
      margin: 0;
      padding: 20px;
      color: #333;
    }
    .form-wrapper {
      max-width: 750px;
      margin: auto;
      padding: 30px;
      background: #ffffff;
      border-radius: 16px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }
    h2 {
      text-align: center;
      color: #2c3e50;
      margin-bottom: 20px;
    }
    label {
      display: block;
      margin-bottom: 8px;
      font-weight: 600;
      color: #2c3e50;
    }
    input[type="text"],
    input[type="number"],
    select {
      width: 100%;
      padding: 12px;
      margin-bottom: 18px;
      border: 1px solid #ccc;
      border-radius: 8px;
      box-sizing: border-box;
      font-size: 15px;
      transition: border 0.3s;
    }
    input[type="text"]:focus,
    input[type="number"]:focus,
    select:focus {
      border-color: #3498db;
      outline: none;
    }
    .player-field {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 20px;
      padding: 15px;
      border: 1px solid #ddd;
      border-radius: 8px;
      background-color: #f9f9f9;
    }
    .player-field label {
      margin: 0;
      flex: 1;
      margin-right: 10px;
    }
    .button-group {
      display: flex;
      justify-content: center;
      gap: 20px;
    }
    input[type="submit"] {
      background-color: #3498db;
      color: white;
      border: none;
      padding: 12px 30px;
      border-radius: 8px;
      font-size: 16px;
      font-weight: bold;
      cursor: pointer;
      transition: background-color 0.3s ease, transform 0.2s ease;
    }
    input[type="submit"]:hover {
      background-color: #2980b9;
      transform: translateY(-2px);
    }
    .back-button {
      display: block;
      text-align: center;
      margin-bottom: 25px;
      color: #3498db;
      font-weight: bold;
      text-decoration: none;
      transition: color 0.3s;
    }
    .back-button:hover {
      color: #1d6fa5;
    }
    hr {
      border: 0;
      height: 1px;
      background: #ccc;
      margin: 40px 0;
    }
  </style>
</head>
<body>
<a href="team.php?team_id=<?php echo $team_id; ?>" class="back-button">← Back to Team Details</a>

<div class="form-wrapper">
  <h2>Edit Team: <?php echo htmlspecialchars($team['team_name']); ?></h2>

  <form method="post">
    <input type="hidden" name="extra_player_count" value="<?php echo $extra_player_count; ?>">

    <label>Team Name:
      <input type="text" name="team_name" value="<?php echo htmlspecialchars($team['team_name']); ?>" required>
    </label>
    <label>Matches Played:
      <input type="number" name="matches_played" value="<?php echo $team['matches_played']; ?>" required>
    </label>
    <label>Wins:
      <input type="number" name="wins" value="<?php echo $team['wins']; ?>" required>
    </label>
    <label>Losses:
      <input type="number" name="losses" value="<?php echo $team['losses']; ?>" required>
    </label>
    <label>Net Run Rate (NRR):
      <input type="text" name="nrr" value="<?php echo htmlspecialchars($team['nrr']); ?>" required>
    </label>
    <label>Points:
      <input type="number" name="points" value="<?php echo $team['points']; ?>" required>
    </label>

    <h4>Players</h4>
    <?php foreach ($players as $index => $player): ?>
      <div class="player-field">
        <label>Player Name:
          <input type="text" name="player_name[]" value="<?php echo htmlspecialchars($player['player_name']); ?>" required>
        </label>
        <label>Role:
          <select name="role[]" required>
            <option value="Batsman" <?php echo ($player['role'] == 'Batsman') ? 'selected' : ''; ?>>Batsman</option>
            <option value="Bowler" <?php echo ($player['role'] == 'Bowler') ? 'selected' : ''; ?>>Bowler</option>
          </select>
        </label>
        <label>Runs:
          <input type="number" name="runs[]" value="<?php echo htmlspecialchars($player['runs']); ?>" required>
        </label>
        <label>Wickets:
          <input type="number" name="wickets[]" value="<?php echo htmlspecialchars($player['wickets']); ?>" required>
        </label>
        <label>Delete:
          <input type="checkbox" name="delete[<?php echo $index; ?>]">
        </label>
      </div>
    <?php endforeach; ?>

    <?php for ($i = 0; $i < $extra_player_count; $i++): ?>
      <div class="player-field">
        <label>Player Name:
          <input type="text" name="player_name[]" placeholder="New Player">
        </label>
        <label>Role:
          <select name="role[]">
            <option value="Batsman">Batsman</option>
            <option value="Bowler">Bowler</option>
          </select>
        </label>
        <label>Runs:
          <input type="number" name="runs[]" value="0">
        </label>
        <label>Wickets:
          <input type="number" name="wickets[]" value="0">
        </label>
        <!-- Hidden delete flag to keep array indexes in sync -->
        <input type="hidden" name="delete[<?php echo count($players) + $i; ?>]" value="">
      </div>
    <?php endfor; ?>

    <div class="button-group">
      <input type="submit" name="submit" value="Update Team">
      <input type="submit" name="add_player" value="Add Player">
    </div>
  </form>
</div>
</body>
</html>
