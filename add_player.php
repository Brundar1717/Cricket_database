<?php
include('db.php');

$team_id = (int)($_POST['team_id'] ?? 0);
$player_name = $conn->real_escape_string($_POST['player_name']);
$role = $conn->real_escape_string($_POST['role']);
$runs = (int)$_POST['runs'];
$wickets = (int)$_POST['wickets'];

$sql = "INSERT INTO players (team_id, player_name, role, runs, wickets)
        VALUES ($team_id, '$player_name', '$role', $runs, $wickets)";

if ($conn->query($sql) === TRUE) {
    header("Location: edit_team.php?team_id=$team_id");
    exit;
} else {
    echo "Error adding player: " . $conn->error;
}
?>
