<?php
include 'db.php';
?>
<?php include 'navbar.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Points Table</title>
    <link rel="stylesheet" href="style.css">
    <style>
       
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #ffffff; /* pure white for clarity */
    margin: 0;
    padding: 40px 20px;
    color: #333; /* dark gray text for readability */
}

.points-table-container {
    max-width: 900px;
    margin: auto;
    background-color: #fafafa; /* very light gray */
    padding: 30px 40px;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
}

h2 {
    text-align: center;
    color: #222;
    margin-bottom: 30px;
    font-weight: 700;
    font-size: 28px;
    text:bold;
     border-bottom: 2px solid rgb(17, 46, 65);
}

.points-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0 8px; /* space between rows */
}

.points-table th, .points-table td {
    padding: 14px 18px;
    text-align: center;
    font-size: 16px;
    font-weight: 700; /* bold */
}

.points-table thead th {
    background-color:rgb(35, 60, 86); /* bright blue */
    color: white;
    font-weight: 600;
    border-radius: 8px 8px 0 0;
    letter-spacing: 0.05em;
}

.points-table tbody tr {
    background-color: white;
    box-shadow: 0 2px 6px rgba(0,0,0,0.05);
    border-radius: 8px;
    transition: background-color 0.25s ease;
}

.points-table tbody tr:hover {
    background-color: #e6f0ff; /* subtle blue highlight */
}

.points-table td {
    border-bottom: none;
    color: #444;
}

.add-button {
    display: inline-block;
    margin-top: 25px;
    background-color:rgb(35, 60, 86);
    padding: 14px 28px;
    font-weight: 600;
    font-size: 16px;
    border-radius: 8px;
    text-decoration: none;
    box-shadow: 0 4px 10px rgba(0,123,255,0.3);
    transition: background-color 0.3s ease;
    color:white;
}

.add-button:hover {
    background-color: #0056b3;
}

    </style>
</head>
<body>

<div class="points-table-container" id="points-table-section">
    <h2>Points Table</h2>
    <table class="points-table">
       <thead>
    <tr>
        <th>Team</th>
        <th>M</th>
        <th>W</th>
        <th>L</th>
        <th>NRR</th>
        <th>Points</th>
    </tr>
</thead>

        <tbody>
        <?php
        $result = $conn->query("SELECT team_id, team_name, matches_played, wins, losses,nrr, points FROM teams ORDER BY points DESC");

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . htmlspecialchars($row['team_name']) . "</td>
                    <td>{$row['matches_played']}</td>
                    <td>{$row['wins']}</td>
                    <td>{$row['losses']}</td>
                    <td>{$row['nrr']}</td>
                    <td>{$row['points']}</td>
                  </tr>";
        }
        ?>
        </tbody>
    </table>

  
</div>

</body>
</html>
