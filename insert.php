<?php
include('db.php'); // Include your DB connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get team data from form
    $team_name = $conn->real_escape_string($_POST['team_name']);
    $matches_played = (int)$_POST['matches_played'];
    $wins = (int)$_POST['wins'];
    $losses = (int)$_POST['losses'];
    $nrr = $conn->real_escape_string($_POST['nrr']);
    $points = (int)$_POST['points'];

    // Insert team into database
    $sql = "INSERT INTO teams (team_name, matches_played, wins, losses, nrr, points)
            VALUES ('$team_name', $matches_played, $wins, $losses, '$nrr', $points)";

    if ($conn->query($sql)) {
        $team_id = $conn->insert_id; // Get the new team's ID

        // Define team players mapping
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

        // Check if team exists in the mapping
        if (array_key_exists($team_name, $team_players)) {
            foreach ($team_players[$team_name] as $player) {
                $name = $conn->real_escape_string($player['player_name']);
                $role = $conn->real_escape_string($player['role']);
                $conn->query("INSERT INTO players (team_id, player_name, role, runs, wickets)
                              VALUES ($team_id, '$name', '$role', 0, 0)");
            }
        }

        // Redirect to teams list or detail page
        header("Location: teams.php");
        exit;
    } else {
        echo "Error inserting team: " . $conn->error;
    }
}
?>
