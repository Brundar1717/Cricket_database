<?php
include("db.php");
$team_id = (int)($_GET['team_id'] ?? 0);

$teamResult = $conn->query("SELECT team_name, matches_played, wins, nrr FROM teams WHERE team_id = $team_id");
$team = $teamResult->fetch_assoc();
// 1. Define default players for all teams (example, expand as needed)

$team_players['Royal Challengers Bengaluru'] = [
    ['player_name' => 'Virat Kohli', 'role' => 'Batsman', 'runs' => 505, 'wickets' => 0],
    ['player_name' => 'Rajat Patidar', 'role' => 'Batsman', 'runs' => 239, 'wickets' => 0],
    ['player_name' => 'Phil Salt', 'role' => 'Wicket-keeper', 'runs' => 239, 'wickets' => 0],
    ['player_name' => 'Tim David', 'role' => 'Batsman', 'runs' => 186, 'wickets' => 0],
    ['player_name' => 'Devdutt Padikkal', 'role' => 'Batsman', 'runs' => 247, 'wickets' => 0],
    ['player_name' => 'Krunal Pandya', 'role' => 'All-rounder', 'runs' => 97, 'wickets' => 12],
    ['player_name' => 'Josh Hazlewood', 'role' => 'Bowler', 'runs' => 0, 'wickets' => 16],
    ['player_name' => 'Bhuvneshwar Kumar', 'role' => 'Bowler', 'runs' => 10, 'wickets' => 9],
    ['player_name' => 'Yash Dayal', 'role' => 'Bowler', 'runs' => 0, 'wickets' => 8],
    ['player_name' => 'Liam Livingstone', 'role' => 'All-rounder', 'runs' => 87, 'wickets' => 2],
];
$team_players['Mumbai Indians'] = [
    ['player_name' => 'Suryakumar Yadav', 'role' => 'Batsman', 'runs' => 510, 'wickets' => 0],
    ['player_name' => 'Ryan Rickelton', 'role' => 'Wicket-keeper', 'runs' => 336, 'wickets' => 0],
    ['player_name' => 'Rohit Sharma', 'role' => 'Batsman', 'runs' => 300, 'wickets' => 0],
    ['player_name' => 'Tilak Varma', 'role' => 'Batsman', 'runs' => 246, 'wickets' => 0],
    ['player_name' => 'Will Jacks', 'role' => 'All-rounder', 'runs' => 195, 'wickets' => 5],
    ['player_name' => 'Hardik Pandya', 'role' => 'All-rounder', 'runs' => 187, 'wickets' => 13],
    ['player_name' => 'Trent Boult', 'role' => 'Bowler', 'runs' => 0, 'wickets' => 18],
    ['player_name' => 'Jasprit Bumrah', 'role' => 'Bowler', 'runs' => 0, 'wickets' => 13],
    ['player_name' => 'Deepak Chahar', 'role' => 'Bowler', 'runs' => 0, 'wickets' => 10],
    ['player_name' => 'Ashwani Kumar', 'role' => 'Bowler', 'runs' => 0, 'wickets' => 8],
];
$team_players['Delhi Capitals'] = [
    ['player_name' => 'KL Rahul', 'role' => 'Wicket-keeper', 'runs' => 493, 'wickets' => 0],
    ['player_name' => 'Abishek Porel', 'role' => 'Wicket-keeper', 'runs' => 295, 'wickets' => 0],
    ['player_name' => 'Tristan Stubbs', 'role' => 'Batsman', 'runs' => 280, 'wickets' => 0],
    ['player_name' => 'Axar Patel', 'role' => 'All-rounder', 'runs' => 263, 'wickets' => 5],
    ['player_name' => 'Ashutosh Sharma', 'role' => 'All-rounder', 'runs' => 186, 'wickets' => 0],
    ['player_name' => 'Faf du Plessis', 'role' => 'Batsman', 'runs' => 173, 'wickets' => 0],
    ['player_name' => 'Karun Nair', 'role' => 'Batsman', 'runs' => 154, 'wickets' => 0],
    ['player_name' => 'Vipraj Nigam', 'role' => 'All-rounder', 'runs' => 122, 'wickets' => 0],
    ['player_name' => 'Kuldeep Yadav', 'role' => 'Bowler', 'runs' => 11, 'wickets' => 12],
    ['player_name' => 'Mitchell Starc', 'role' => 'Bowler', 'runs' => 6, 'wickets' => 14],
];
$team_players['Gujarat Titans'] = [
    ['player_name' => 'B Sai Sudharsan', 'role' => 'Batsman', 'runs' => 617, 'wickets' => 0],
    ['player_name' => 'Shubman Gill', 'role' => 'Batsman', 'runs' => 601, 'wickets' => 0],
    ['player_name' => 'Jos Buttler', 'role' => 'Batsman', 'runs' => 500, 'wickets' => 0],
    ['player_name' => 'Shahrukh Khan', 'role' => 'All-rounder', 'runs' => 90, 'wickets' => 0],
    ['player_name' => 'Rahul Tewatia', 'role' => 'All-rounder', 'runs' => 67, 'wickets' => 0],
    ['player_name' => 'Washington Sundar', 'role' => 'All-rounder', 'runs' => 85, 'wickets' => 0],
    ['player_name' => 'Ravisrinivasan Sai Kishore', 'role' => 'Bowler', 'runs' => 1, 'wickets' => 15],
    ['player_name' => 'Mohammed Siraj', 'role' => 'Bowler', 'runs' => 0, 'wickets' => 15],
    ['player_name' => 'Prasidh Krishna', 'role' => 'Bowler', 'runs' => 0, 'wickets' => 21],
    ['player_name' => 'Rashid Khan', 'role' => 'Bowler', 'runs' => 12, 'wickets' => 8],
];
$team_players['Sunrisers Hyderabad'] = [
    ['player_name' => 'Pat Cummins', 'role' => 'All-rounder', 'runs' => 85, 'wickets' => 12],
    ['player_name' => 'Heinrich Klaasen', 'role' => 'Wicket-keeper', 'runs' => 312, 'wickets' => 0],
    ['player_name' => 'Ishan Kishan', 'role' => 'Wicket-keeper', 'runs' => 231, 'wickets' => 0],
    ['player_name' => 'Travis Head', 'role' => 'Batsman', 'runs' => 402, 'wickets' => 0],
    ['player_name' => 'Abhishek Sharma', 'role' => 'All-rounder', 'runs' => 373, 'wickets' => 3],
    ['player_name' => 'Nitish Kumar Reddy', 'role' => 'All-rounder', 'runs' => 198, 'wickets' => 5],
    ['player_name' => 'Harshal Patel', 'role' => 'All-rounder', 'runs' => 95, 'wickets' => 14],
    ['player_name' => 'Kamindu Mendis', 'role' => 'All-rounder', 'runs' => 112, 'wickets' => 7],
    ['player_name' => 'Mohammed Shami', 'role' => 'Bowler', 'runs' => 15, 'wickets' => 18],
    ['player_name' => 'Jaydev Unadkat', 'role' => 'Bowler', 'runs' => 8, 'wickets' => 9],
    ['player_name' => 'Rahul Chahar', 'role' => 'Bowler', 'runs' => 12, 'wickets' => 11],
];
$team_players['Punjab Kings'] = [
    ['player_name' => 'Shreyas Iyer', 'role' => 'Batsman', 'runs' => 435, 'wickets' => 0],
    ['player_name' => 'Glenn Maxwell', 'role' => 'All-rounder', 'runs' => 320, 'wickets' => 6],
    ['player_name' => 'Marcus Stoinis', 'role' => 'All-rounder', 'runs' => 290, 'wickets' => 8],
    ['player_name' => 'Harpreet Brar', 'role' => 'All-rounder', 'runs' => 150, 'wickets' => 12],
    ['player_name' => 'Arshdeep Singh', 'role' => 'Bowler', 'runs' => 40, 'wickets' => 18],
    ['player_name' => 'Yuzvendra Chahal', 'role' => 'Bowler', 'runs' => 20, 'wickets' => 22],
    ['player_name' => 'Marco Jansen', 'role' => 'All-rounder', 'runs' => 100, 'wickets' => 15],
    ['player_name' => 'Azmatullah Omarzai', 'role' => 'All-rounder', 'runs' => 80, 'wickets' => 10],
    ['player_name' => 'Josh Inglis', 'role' => 'Wicket-keeper', 'runs' => 210, 'wickets' => 0],
    ['player_name' => 'Prabhsimran Singh', 'role' => 'Wicket-keeper', 'runs' => 180, 'wickets' => 0],
];
$team_players['Rajasthan Royals'] = [
    ['player_name' => 'Yashasvi Jaiswal', 'role' => 'Batsman', 'runs' => 523, 'wickets' => 0],
    ['player_name' => 'Riyan Parag', 'role' => 'All-rounder', 'runs' => 390, 'wickets' => 3],
    ['player_name' => 'Sanju Samson', 'role' => 'Wicket-keeper', 'runs' => 244, 'wickets' => 0],
    ['player_name' => 'Dhruv Jurel', 'role' => 'Wicket-keeper', 'runs' => 302, 'wickets' => 0],
    ['player_name' => 'Shimron Hetmyer', 'role' => 'Batsman', 'runs' => 227, 'wickets' => 0],
    ['player_name' => 'Vaibhav Suryavanshi', 'role' => 'All-rounder', 'runs' => 195, 'wickets' => 0],
    ['player_name' => 'Shubham Dubey', 'role' => 'Batsman', 'runs' => 106, 'wickets' => 0],
    ['player_name' => 'Wanindu Hasaranga', 'role' => 'Bowler', 'runs' => 9, 'wickets' => 10],
    ['player_name' => 'Maheesh Theekshana', 'role' => 'Bowler', 'runs' => 10, 'wickets' => 11],
    ['player_name' => 'Jofra Archer', 'role' => 'Bowler', 'runs' => 63, 'wickets' => 11],
];
$team_players['Kolkata Knight Riders'] = [
    ['player_name' => 'Ajinkya Rahane', 'role' => 'Batsman', 'runs' => 375, 'wickets' => 0],
    ['player_name' => 'Venkatesh Iyer', 'role' => 'All-rounder', 'runs' => 167, 'wickets' => 3],
    ['player_name' => 'Rinku Singh', 'role' => 'Batsman', 'runs' => 197, 'wickets' => 0],
    ['player_name' => 'Andre Russell', 'role' => 'All-rounder', 'runs' => 167, 'wickets' => 9],
    ['player_name' => 'Sunil Narine', 'role' => 'All-rounder', 'runs' => 215, 'wickets' => 10],
    ['player_name' => 'Harshit Rana', 'role' => 'Bowler', 'runs' => 15, 'wickets' => 15],
    ['player_name' => 'Ramandeep Singh', 'role' => 'All-rounder', 'runs' => 65, 'wickets' => 4],
    ['player_name' => 'Vaibhav Arora', 'role' => 'Bowler', 'runs' => 8, 'wickets' => 16],
    ['player_name' => 'Anrich Nortje', 'role' => 'Bowler', 'runs' => 5, 'wickets' => 8],
    ['player_name' => 'Varun Chakravarthy', 'role' => 'Bowler', 'runs' => 12, 'wickets' => 17],
    ['player_name' => 'Quinton de Kock', 'role' => 'Wicket-keeper', 'runs' => 465, 'wickets' => 0],
];
$team_players['Chennai Super Kings'] = [
    ['player_name' => 'Shivam Dube', 'role' => 'All-rounder', 'runs' => 301, 'wickets' => 0],
    ['player_name' => 'Ravindra Jadeja', 'role' => 'All-rounder', 'runs' => 279, 'wickets' => 8],
    ['player_name' => 'Rachin Ravindra', 'role' => 'All-rounder', 'runs' => 191, 'wickets' => 0],
    ['player_name' => 'MS Dhoni', 'role' => 'Wicket-keeper', 'runs' => 180, 'wickets' => 0],
    ['player_name' => 'Ruturaj Gaikwad', 'role' => 'Batsman', 'runs' => 122, 'wickets' => 0],
    ['player_name' => 'Devon Conway', 'role' => 'Batsman', 'runs' => 94, 'wickets' => 0],
    ['player_name' => 'Vijay Shankar', 'role' => 'All-rounder', 'runs' => 118, 'wickets' => 0],
    ['player_name' => 'Dewald Brevis', 'role' => 'Batsman', 'runs' => 126, 'wickets' => 0],
    ['player_name' => 'Noor Ahmad', 'role' => 'Bowler', 'runs' => 5, 'wickets' => 20],
    ['player_name' => 'Khaleel Ahmed', 'role' => 'Bowler', 'runs' => 1, 'wickets' => 14],
];
$team_players['Lucknow Super Giants'] = [
    ['player_name' => 'Rishabh Pant', 'role' => 'Wicket-keeper Batsman', 'runs' => 420, 'wickets' => 0],
    ['player_name' => 'Aiden Markram', 'role' => 'Batsman', 'runs' => 409, 'wickets' => 0],
    ['player_name' => 'Mitchell Marsh', 'role' => 'All-rounder', 'runs' => 315, 'wickets' => 10],
    ['player_name' => 'Nicholas Pooran', 'role' => 'Wicket-keeper Batsman', 'runs' => 377, 'wickets' => 0],
    ['player_name' => 'Ayush Badoni', 'role' => 'Batsman', 'runs' => 329, 'wickets' => 0],
    ['player_name' => 'David Miller', 'role' => 'Batsman', 'runs' => 153, 'wickets' => 0],
    ['player_name' => 'Abdul Samad', 'role' => 'All-rounder', 'runs' => 210, 'wickets' => 6],
    ['player_name' => 'Ravi Bishnoi', 'role' => 'Bowler', 'runs' => 15, 'wickets' => 18],
    ['player_name' => 'Avesh Khan', 'role' => 'Bowler', 'runs' => 30, 'wickets' => 14],
    ['player_name' => 'Akash Deep', 'role' => 'Bowler', 'runs' => 25, 'wickets' => 12],
    ['player_name' => 'Mayank Yadav', 'role' => 'Bowler', 'runs' => 20, 'wickets' => 10],
];

// 2. Check if players exist for this team
$teamName = trim($team['team_name']);  // Move this up here
$teamNameLower = strtolower($teamName);
// 2. Check if players exist for this team
$playersCheck = $conn->query("SELECT COUNT(*) as count FROM players WHERE team_id = $team_id");
$countRow = $playersCheck->fetch_assoc();

if ((int)$countRow['count'] === 0 && isset($team_players[$teamName])) {
    // 3. Insert default players for the team
   foreach ($team_players[$teamName] as $player) {
    $pname = $conn->real_escape_string($player['player_name']);
    $prole = $conn->real_escape_string($player['role']);

    // Use default to 0 if not set
    $runs = isset($player['runs']) ? (int)$player['runs'] : 0;
    $wickets = isset($player['wickets']) ? (int)$player['wickets'] : 0;


    $insertQuery = "INSERT INTO players (team_id, player_name, role, runs, wickets)
                    VALUES ($team_id, '$pname', '$prole', $runs, $wickets)";
    if (!$conn->query($insertQuery)) {
        echo "Insert Error: " . $conn->error . "<br>";
    }
}

}
  $playersCheck = $conn->query("SELECT COUNT(*) as count FROM players WHERE team_id = $team_id");
   $countRow = $playersCheck->fetch_assoc();
   
// 4. Now fetch players (your existing code)
$playersResult = $conn->query("SELECT player_name, role, runs, wickets FROM players WHERE team_id = $team_id");

if (!$team) {
    echo "Team not found.";
    exit;
}

// Define colors for multiple teams (add your teams here)
    $teamColors = [
    'Royal Challengers Bengaluru' => ['primary' => '#000000', 'secondary' => '#ec2424', 'tertiary' => '#D9BE1E'], // Black + Red + Gold
    'Gujarat Titans' => ['primary' => '#031d38', 'secondary' => '#D9E6F2', 'tertiary' => '#E0AA3E'], // Dark Blue + Light Blue + Gold
    'Mumbai Indians' => ['primary' => '#004C97', 'secondary' => '#CCE0F5', 'tertiary' =>' #FF9933'], // Navy Blue + Pale Blue + Orange
    'Chennai Super Kings' => ['primary' => '#F7B500', 'secondary' => '#FFF4CC', 'tertiary' => '#005A9C'], // Yellow + Light Yellow + Blue
    'Kolkata Knight Riders' => ['primary' => '#4B0082', 'secondary' => '#D6C6E0', 'tertiary' => '#B8860B'], // Indigo + Light Purple + Gold
    'Rajasthan Royals' => ['primary' => '#254AA5', 'secondary' =>'rgb(234, 66, 124)', 'tertiary' => '#F2C75C'], // Blue + Pink + Gold
    'Sunrisers Hyderabad' => ['primary' => '#FF822A', 'secondary' => '#FFE0C1', 'tertiary' => '#000000'], // Orange + Beige + Black
    'Lucknow Super Giants' => ['primary' => '#004C8C', 'secondary' => '#DFF2FF', 'tertiary' =>'rgba(47, 151, 31, 0.99)'], // Blue + Light Blue + Saffron
    'Delhi Capitals' => ['primary' => '#17449B', 'secondary' => '#DCE6F1', 'tertiary' => '#EF4136'], // Blue + Light Blue + Red
    'Punjab Kings' => ['primary' => '#D71920', 'secondary' => '#FDE8E9', 'tertiary' => '#C0C0C0'], // Red + Light Pink + Silver
];
$teamName = trim($team['team_name']);

if (isset($teamColors[$teamName])) {
    $primaryColor = $teamColors[$teamName]['primary'];
    $secondaryColor = $teamColors[$teamName]['secondary'];
    $tertiaryColor=$teamColors[$teamName]['tertiary'];
} 
else {
    $primaryColor = '#3498db';   // Default primary color (blue)
    $secondaryColor = '#D6EAF8'; // Default secondary color (light blue)
}

// Darken function for hover states
function darken_color($hex, $percent = 20) {
    $hex = str_replace('#', '', $hex);
    $r = max(0, min(255, hexdec(substr($hex, 0, 2)) - round(255 * $percent / 100)));
    $g = max(0, min(255, hexdec(substr($hex, 2, 2)) - round(255 * $percent / 100)));
    $b = max(0, min(255, hexdec(substr($hex, 4, 2)) - round(255 * $percent / 100)));
    return sprintf("#%02x%02x%02x", $r, $g, $b);
}

$playersResult = $conn->query("SELECT player_name, role, runs, wickets FROM players WHERE team_id = $team_id");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title><?php echo htmlspecialchars($team['team_name']); ?> - Team Details</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: <?php echo $secondaryColor; ?>;
      margin: 0;
      padding: 20px;
    }

    .team-details-container {
      max-width: 960px;
      margin: auto;
      background: #fff;
      padding: 30px 40px;
      border-radius: 12px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.1);
      border: 3px solid <?php echo $tertiaryColor; ?>;
    }

    h1, h2 {
      text-align: center;
      color: <?php echo $primaryColor; ?>;
    }

    .team-stats {
      display: flex;
      justify-content: center;
      flex-wrap: wrap;
      gap: 30px;
      margin: 30px 0;
    }

    .team-stats p {
      background: <?php echo $secondaryColor; ?>;
      padding: 20px 30px;
      font-size: 18px;
      font-weight: 600;
      border-radius: 10px;
      box-shadow: inset 0 0 6px rgba(0,0,0,0.05);
      text-align: center;
      min-width: 150px;
      border: 2px solid <?php echo $tertiaryColor; ?>;
      color: <?php echo $primaryColor; ?>;
    }

    .back-button, .edit-button {
      display: inline-block;
      background-color: <?php echo $primaryColor; ?>;
      border: 2px solid <?php echo $tertiaryColor; ?>; /* Adding tertiary color */
      color: white;
      padding: 10px 20px;
      border-radius: 6px;
      text-decoration: none;
      font-weight: 600;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
      transition: background-color 0.3s ease;
      margin: 20px 10px;
    }

    .back-button:hover, .edit-button:hover {
      background-color: <?php echo darken_color($primaryColor); ?>;
    }

    .btn-container {
      text-align: center;
    }

    .players-table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 25px;
      background-color: #fff;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 4px 8px rgba(0,0,0,0.08);
    }

    .players-table th, .players-table td {
      padding: 15px 12px;
      text-align: center;
      border-bottom: 1px solid #ddd;
    }

    .players-table th {
      background-color: <?php echo $primaryColor; ?>;
      color: white;
      font-weight: 600;
      text-transform: uppercase;
    }

    .players-table tr:hover {
      background-color: <?php echo $secondaryColor; ?>;
    }

    @media (max-width: 600px) {
      .team-stats {
        flex-direction: column;
        align-items: center;
      }
      .team-stats p {
        width: 80%;
      }
    }
  </style>
</head>
<body>

<div class="btn-container">
  <a href="teams.php" class="back-button">← Back</a>
  <a href="edit_team.php?team_id=<?php echo $team_id; ?>" class="edit-button">✏ Edit Team & Players</a>
  
</div>

<div class="team-details-container">
  <h1><?php echo htmlspecialchars($team['team_name']); ?></h1>

  <div class="team-stats">
    <p>Matches Played<br><?php echo $team['matches_played']; ?></p>
    <p>Wins<br><?php echo $team['wins']; ?></p>
    <p>Net Run Rate<br><?php echo $team['nrr']; ?></p>
  </div>

  <h2>Players</h2>

  <table class="players-table">
    <thead>
      <tr>
        <th>Player Name</th>
        <th>Role</th>
        <th>Runs</th>
        <th>Wickets</th>
      </tr>
    </thead>
    <tbody>
    <?php
    while($row = $playersResult->fetch_assoc()): ?>
<tr>
  <td><?php echo htmlspecialchars($row['player_name']); ?></td>
  <td><?php echo htmlspecialchars($row['role']); ?></td>
  <td><?php echo htmlspecialchars($row['runs']); ?></td>
  <td><?php echo htmlspecialchars($row['wickets']); ?></td>
</tr>
<?php endwhile; ?>

    </tbody>
  </table>
</div>

</body>
</html>
