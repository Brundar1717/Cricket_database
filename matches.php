<?php include 'db.php'; ?>
<?php include 'navbar.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Cricket Match Tracker</title>
    <style>
        /* Add this to your existing CSS in matches.php */

/* Responsive design adjustments */
@media screen and (max-width: 768px) {
    body {
        padding: 20px 15px;
    }
    
    .match-box {
        padding: 15px;
    }
    
    .team {
        min-width: 100px;
    }
    
    .team-name {
        font-size: 0.9rem;
    }
    
    .team-score {
        font-size: 0.9rem;
    }
    
    .dropdown-filter {
        flex-direction: column;
        align-items: flex-start;
    }
    
    select {
        width: 100%;
    }
    
    h2 {
        font-size: 1.5rem;
    }
}

/* More visible match-box layout */
.match-box {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
}

.match-teams {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 10px;
    flex: 1;
}

.divider {
    display: flex;
    align-items: center;
    margin: 0 8px;
}

.divider:after {
    content: "vs";
    font-weight: bold;
    color: #777;
}

.match-date {
    font-weight: 600;
    color: #555;
}
.venue{
    font-weight: 600;
    color: #555;
}
       body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: linear-gradient(135deg, #f0f4f8 0%, #d9e2ec 100%);
    padding: 40px 30px;
    color: #2c3e50;
    min-height: 100vh;
}

h2 {
    color: #1f2d3d;
    border-bottom: 3px solid #142d3e;
    padding-bottom: 8px;
    font-weight: 700;
    font-size: 1.8rem;
    margin-bottom: 25px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.match-box {
    background-color: #ffffff;
    margin: 18px 0;
    padding: 20px 25px;
    border-radius: 12px;
    box-shadow: 0 6px 12px rgba(20, 45, 62, 0.1);
    transition: box-shadow 0.3s ease, transform 0.3s ease;
    cursor: default;
}

.match-box:hover {
    box-shadow: 0 12px 24px rgba(20, 45, 62, 0.2);
    transform: translateY(-4px);
}

.dropdown-filter {
    margin-top: 15px;
    margin-bottom: 30px;
    display: flex;
    align-items: center;
    gap: 12px;
}

select {
    padding: 10px 16px;
    border-radius: 8px;
    border: 1.5px solid #142d3e;
    font-size: 15px;
    font-weight: 600;
    background-color: #ffffff;
    color: #142d3e;
    cursor: pointer;
    box-shadow: inset 0 1px 3px rgba(20, 45, 62, 0.1);
    transition: border-color 0.3s ease;
}

select:hover, select:focus {
    border-color: #2c3e50;
    outline: none;
}

label {
    font-weight: 700;
    font-size: 1rem;
    color: #142d3e;
}

p {
    margin: 0;
    color: #34495e;
    font-size: 1.1rem;
    font-weight: 600;
}

strong {
    color: #1f2d3d;
}
.team-logo {
    width: 24px;       /* smaller width */
    height: 24px;      /* smaller height */
    border-radius: 50%; /* keep circular */
    border: 1px solid #ccc;
    object-fit: contain;
    background: #fff;
}
.team {
    display: flex;
    align-items: center;
    gap: 8px;
    min-width: 140px;
}

.team-name {
    font-weight: 700;
    font-size: 1.1rem;
    color: #1f2d3d;
}

.team-score {
    font-weight: 600;
    font-size: 1rem;
    color:rgb(8, 9, 9); /* Google blue */
    text:bold;
    margin-left: 6px;
}


    </style>
</head>
<body>

<?php
// Fetch team data with logos
// Map team IDs or names to logo URLs
$team_logos = [
    1 => 'rcb.png',
    8 => 'srh.png',
    3 => 'rr.png',
    9 => 'csk.png',
    10 =>'lsg.png',
    2 => 'gt.png',
    4=> 'kkr.png',
    5=> 'pbks.png',
    7=> 'dc.png',
    6=> 'mi.png'
    // add all teams here
];

// When fetching teams, get their logo URL from this array
$team_data = [];
$res = $conn->query("SELECT team_id, team_name FROM teams");
while ($row = $res->fetch_assoc()) {
    $team_id = $row['team_id'];
    $team_data[$team_id] = [
        'name' => $row['team_name'],
        'logo' => $team_logos[$team_id] ?? 'logos/default.png' // fallback logo
    ];
}

?>
<br><br>
<h2>🏏 Today’s Matches</h2>
<?php
$today = date('Y-m-d');
$today_matches = $conn->query("SELECT * FROM matches WHERE match_date = '$today'");
if ($today_matches->num_rows > 0) {
    while ($m = $today_matches->fetch_assoc()) {
        $team1 = $team_data[$m['team1_id']]['name'] ?? "Team {$m['team1_id']}";
        $team1_logo = $team_data[$m['team1_id']]['logo'] ?? 'default-logo.png';

        $team2 = $team_data[$m['team2_id']]['name'] ?? "Team {$m['team2_id']}";
        $team2_logo = $team_data[$m['team2_id']]['logo'] ?? 'default-logo.png';

        $score = "{$m['team1_score']} - {$m['team2_score']}";
        $venue="{$m['venue']}";
       echo "<div class='match-box'>
        <div class='match-teams'>
            <div class='team'>
                <img src='$team1_logo' alt='$team1 logo' class='team-logo'>
                <span class='team-name'>$team1</span>
                <span class='team-score'>" . ($m['team1_score'] !== null ? $m['team1_score'] : '-') . "</span>
            </div>
            <div class='divider'></div>
            <div class='team'>
                <img src='$team2_logo' alt='$team2 logo' class='team-logo'>
                <span class='team-name'>$team2</span>
                <span class='team-score'>" . ($m['team2_score'] !== null ? $m['team2_score'] : '-') . "</span>
            </div>
        </div>
        <div>
            <div class='match-date'>" . date('M d, Y', strtotime($m['match_date'])) . "</div>
            <div class='venue'>". ($m['venue']). "</div>
        </div>
      </div>";

    }
} else {
    echo "<p>No matches today.</p>";
}
?>

<h2>📅 Upcoming Matches</h2>

<form method="GET" action="" class="dropdown-filter">
    <label for="team_filter">Filter by team:</label>
    <select name="team_filter" id="team_filter" onchange="this.form.submit()">
        <option value="all">All</option>
        <?php
        $teams = $conn->query("SELECT team_id, team_name FROM teams");
        while ($team = $teams->fetch_assoc()) {
            $selected = (isset($_GET['team_filter']) && $_GET['team_filter'] == $team['team_id']) ? 'selected' : '';
            echo "<option value='{$team['team_id']}' $selected>{$team['team_name']}</option>";
        }
        ?>
    </select>
</form>

<?php
$team_filter = $_GET['team_filter'] ?? 'all';
$query = "SELECT * FROM matches WHERE match_date > '$today'";

if ($team_filter !== 'all') {
    $team_filter = intval($team_filter);
    $query .= " AND (team1_id = $team_filter OR team2_id = $team_filter)";
}
$query .= " ORDER BY match_date ASC";
$upcoming_matches = $conn->query($query);
if ($upcoming_matches->num_rows > 0) {
    while ($m = $upcoming_matches->fetch_assoc()) {
        $team1 = $team_data[$m['team1_id']]['name'] ?? "Team {$m['team1_id']}";
        $team1_logo = $team_data[$m['team1_id']]['logo'] ?? 'default-logo.png';

        $team2 = $team_data[$m['team2_id']]['name'] ?? "Team {$m['team2_id']}";
        $team2_logo = $team_data[$m['team2_id']]['logo'] ?? 'default-logo.png';

        // Scores might not be available yet for upcoming matches
        $score = ($m['team1_score'] !== null && $m['team2_score'] !== null) ? "{$m['team1_score']} - {$m['team2_score']}" : "TBD";
         $venue="{$m['venue']}";
        $match_date = date('M d, Y', strtotime($m['match_date']));

        echo "<div class='match-box'>
        <div class='match-teams'>
            <div class='team'>
                <img src='$team1_logo' alt='$team1 logo' class='team-logo'>
                <span class='team-name'>$team1</span>
                <span class='team-score'>{$m['team1_score']}</span>
            </div>
            <div class='divider'></div>
            <div class='team'>
                <img src='$team2_logo' alt='$team2 logo' class='team-logo'>
                <span class='team-name'>$team2</span>
                <span class='team-score'>{$m['team2_score']}</span>
            </div>
        </div>
        <div>
            <div class='match-date'>" . date('M d, Y', strtotime($m['match_date'])) . "</div>
             <div class='venue'>". ($m['venue']). "</div>
        </div>
      </div>";

    }
} else {
    echo "<p>No upcoming matches.</p>";
}
?>
<h2>✅ Completed Matches</h2>

<?php
$past_matches = $conn->query("SELECT * FROM matches WHERE match_date < '$today' ORDER BY match_date DESC");

if ($past_matches->num_rows > 0) {
    while ($m = $past_matches->fetch_assoc()) {
        $team1 = $team_data[$m['team1_id']]['name'] ?? "Team {$m['team1_id']}";
        $team1_logo = $team_data[$m['team1_id']]['logo'] ?? 'default-logo.png';

        $team2 = $team_data[$m['team2_id']]['name'] ?? "Team {$m['team2_id']}";
        $team2_logo = $team_data[$m['team2_id']]['logo'] ?? 'default-logo.png';
        
        $score1 = $m['team1_score'];
        $score2 = $m['team2_score'];
         $venue="{$m['venue']}";
        // Determine winner
        $winner_id = $m['winner_id']; // Get the winner_id from the database result

if ($winner_id !== null && $winner_id != 0) { // Assuming 0 or null if no winner/draw
    // Use the $team_data array (which maps team_id to team_name)
    $winner = $team_data[$winner_id]['name'] ?? "Unknown Winner";
} elseif ($score1 !== null && $score2 !== null && $score1 == $score2) {
    $winner = "Draw"; // Handle draws if winner_id is 0 or null for a draw
} else {
    $winner = "N/A"; // Or handle cases where match hasn't happened or winner isn't set yet
}

        $match_date = date('M d, Y', strtotime($m['match_date']));

        echo "<div class='match-box'>
                <div class='match-teams'>
                    <div class='team'>
                        <img src='$team1_logo' alt='$team1 logo' class='team-logo'>
                        <span class='team-name'>$team1</span>
                        <span class='team-score'>$score1</span>
                    </div>
                    <div class='divider'></div>
                    <div class='team'>
                        <img src='$team2_logo' alt='$team2 logo' class='team-logo'>
                        <span class='team-name'>$team2</span>
                        <span class='team-score'>$score2</span>
                    </div>
                </div>
                <div>
                    <div class='match-date'>$match_date</div>
                     <div class='venue'>". ($m['venue']). "</div>
                    <div class='match-winner' style='margin-top:6px; font-weight:700; color:#1a73e8; color:black;'>Winner: $winner</div>
                </div>
              </div>";
    }
} else {
    echo "<p>No completed matches found.</p>";
}
?>




</body>
</html>
