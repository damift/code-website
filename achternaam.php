<!DOCTYPE html>
<html>
<head>
    <title>Zoeken op achternaam</title>
    <style>
        table {
            border-collapse: collapse;
            width: 50%;
            margin: 20px auto;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<h2>Zoeken op achternaam</h2>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <label for="achternaam">Voer achternaam in:</label>
    <input type="text" id="achternaam" name="achternaam">
    <input type="submit" value="Zoeken">
</form>

<?php
// Controleer of het formulier is ingediend
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "rdbms.strato.de";
    $username = "dbu3645296";
    $password = "Imad12345@";
    $dbname = "dbs12312128";
    $achternaam = $_POST['achternaam'];

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connectie mislukt: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM mock_data WHERE Achternaam = '$achternaam'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table>
		<tr>
		
		<th>Patient_id</th>
		<th>Voornaam</th>
		<th>Achternaam</th>
		<th>Woonadres</th>
		<th>Woonplaats</th>
		<th>telefoonnummer</th>
		
		</tr>";
		
        while($row = $result->fetch_assoc()) {
			
            echo "<tr>
			
			<td>".$row["Patient_id"]."</td>
			<td>".$row["Voornaam"]."</td>
			<td>".$row["Achternaam"]."</td>
			<td>".$row["adres"]."</td>
			<td>".$row["plaats"]."</td>
			<td>".$row["telefoonnummer"]."</td>
			
			</tr>";
        }
        echo "</table>";
    } else {
        echo "Geen resultaten gevonden voor achternaam: $achternaam";
    }

    $conn->close();
}
?>

</body>
</html>
