<?php
include 'db.php';
include 'navbar.php';
?>
<?php
// Replace the teams-container section in teams.php with this enhanced version

// Define team colors and logos
$team_styles = [
    'Royal Challengers Bengaluru' => ['bg' => '#000000', 'text' => '#ffffff', 'accent' => '#ec2424', 'logo' => 'rcb.png'],
    'Gujarat Titans' => ['bg' => '#031d38', 'text' => '#ffffff', 'accent' => '#E0AA3E', 'logo' => 'gt.png'],
    'Mumbai Indians' => ['bg' => '#004C97', 'text' => '#ffffff', 'accent' => '#FF9933', 'logo' => 'mi.png'],
    'Chennai Super Kings' => ['bg' => '#F7B500', 'text' => '#000000', 'accent' => '#005A9C', 'logo' => 'csk.png'],
    'Kolkata Knight Riders' => ['bg' => '#4B0082', 'text' => '#ffffff', 'accent' => '#B8860B', 'logo' => 'kkr.png'],
    'Rajasthan Royals' => ['bg' => '#254AA5', 'text' => '#ffffff', 'accent' => '#F2C75C', 'logo' => 'rr.png'],
    'Sunrisers Hyderabad' => ['bg' => '#FF822A', 'text' => '#000000', 'accent' => '#000000', 'logo' => 'srh.png'],
    'Lucknow Super Giants' => ['bg' => '#004C8C', 'text' => '#ffffff', 'accent' => '#2F971F', 'logo' => 'lsg.png'],
    'Delhi Capitals' => ['bg' => '#17449B', 'text' => '#ffffff', 'accent' => '#EF4136', 'logo' => 'dc.png'],
    'Punjab Kings' => ['bg' => '#D71920', 'text' => '#ffffff', 'accent' => '#C0C0C0', 'logo' => 'pbks.png'],
];

// Get team statistics
$result = $conn->query("SELECT t.*, 
                       (SELECT COUNT(*) FROM matches WHERE (team1_id = t.team_id OR team2_id = t.team_id) AND match_date >= CURDATE()) as upcoming_matches
                       FROM teams t
                       ORDER BY t.points DESC");
?>

<style>
    .teams-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 30px;
        padding: 20px;
        max-width: 1200px;
        margin: 0 auto;
    }
    
    .team-card {
        background-color: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 8px 20px rgba(0,0,0,0.12);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        position: relative;
        display: flex;
        flex-direction: column;
    }
    
    .team-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 28px rgba(0,0,0,0.18);
    }
    
    .team-header {
        padding: 20px;
        text-align: center;
        color: white;
        position: relative;
        height: 100px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .team-logo {
        width: 65px;
        height: 65px;
        object-fit: contain;
        background: white;
        border-radius: 50%;
        border: 3px solid;
        padding: 5px;
        position: absolute;
        bottom: -30px;
        left: 50%;
        transform: translateX(-50%);
    }
    
    .team-content {
        padding: 40px 20px 20px;
        text-align: center;
    }
    
    .team-name {
        font-size: 18px;
        font-weight: 700;
        margin: 0 0 15px;
    }
    
    .team-stats {
        display: flex;
        justify-content: space-around;
        margin-bottom: 20px;
    }
    
    .stat-item {
        text-align: center;
    }
    
    .stat-value {
        font-size: 22px;
        font-weight: 700;
        line-height: 1;
    }
    
    .stat-label {
        font-size: 12px;
        color: #666;
        margin-top: 5px;
    }
    
    .team-actions {
        display: flex;
        justify-content: center;
    }
    
    .view-btn {
        background-color: transparent;
        color: inherit;
        border: 2px solid;
        padding: 8px 16px;
        border-radius: 6px;
        text-decoration: none;
        font-weight: 600;
        font-size: 14px;
        transition: all 0.2s ease;
    }
    
    .view-btn:hover {
        background-color: rgba(0,0,0,0.05);
    }
    
    .team-badge {
        position: absolute;
        top: 10px;
        right: 10px;
        background-color: rgba(255,255,255,0.9);
        color: #333;
        font-size: 11px;
        font-weight: 700;
        padding: 3px 8px;
        border-radius: 12px;
    }
    
    /* Responsive adjustments */
    @media screen and (max-width: 600px) {
        .teams-container {
            grid-template-columns: 1fr;
            padding: 15px;
            gap: 20px;
        }
    }
</style>


<div class="teams-container">
<?php
while ($team = $result->fetch_assoc()) {
    $team_name = $team['team_name'];
    $style = $team_styles[$team_name] ?? ['bg' => '#3498db', 'text' => '#ffffff', 'accent' => '#2c3e50', 'logo' => 'default.png'];
    
    // Determine if team is in top 4
    $is_top4 = $team['points'] >= 16; // Adjust this threshold based on your tournament
    
    echo "
    <div class='team-card'>
        <div class='team-header' style='background-color: {$style['bg']}; color: {$style['text']};'>
            <h3>{$team_name}</h3>
            " . ($is_top4 ? "<div class='team-badge'>PLAYOFF CONTENDER</div>" : "") . "
            <img src='{$style['logo']}' alt='{$team_name} logo' class='team-logo' style='border-color: {$style['accent']};'>
        </div>
        
        <div class='team-content'>
            <div class='team-stats'>
                <div class='stat-item'>
                    <div class='stat-value'>{$team['matches_played']}</div>
                    <div class='stat-label'>MATCHES</div>
                </div>
                <div class='stat-item'>
                    <div class='stat-value'>{$team['wins']}</div>
                    <div class='stat-label'>WINS</div>
                </div>
                <div class='stat-item'>
                    <div class='stat-value'>{$team['points']}</div>
                    <div class='stat-label'>POINTS</div>
                </div>
            </div>
            
            <div class='team-actions'>
                <a href='team.php?team_id={$team['team_id']}' class='view-btn' style='color: {$style['bg']}; border-color: {$style['bg']};'>
                    View Team
                </a>
            </div>
        </div>
    </div>
    ";
}
?>
</div>
<!DOCTYPE html>
<html>
<head>
    <title>Teams</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f0f4f8;
            margin: 0;
            padding: 30px;
        }

        h1#allteam {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 30px;
            border-bottom: 2px solid rgb(17, 46, 65);
            display: inline-block;
            padding-bottom: 5px;
        }

        .teams-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 25px;
        }

        .team-card {
            background-color: #ffffff;
            border: 2px solid rgb(21, 54, 77);
            border-radius: 12px;
            width: 250px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .team-card:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
        }

        .team-card h3 {
            margin-bottom: 15px;
            color: #34495e;
        }

        .team-card a {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 18px;
            background-color: #3498db;
            color: #ffffff;
            text-decoration: none;
            font-weight: bold;
            border-radius: 6px;
            transition: background-color 0.2s ease;
            border: 2px solid rgb(21, 54, 77);
        }

        .team-card a:hover {
            background-color: #2980b9;
        }
    </style>
</head>
