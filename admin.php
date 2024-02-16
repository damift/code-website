<?php
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("Location: admin.php");
    exit;
	
	
}




?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
</head>
<body>

<!DOCTYPE html>
<html>
<head>
    <title>Gebruikersgegevens</title>
    <style>
      
        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
		ul {
		  list-style-type: none;
		  margin: 0;
		  padding: 0;
		  width: 200px;
		  background-color: #f1f1f1;
			}

		li a {
		  display: block;
		  color: #000;
		  padding: 8px 16px;
		  text-decoration: none;
				}

		
		li a:hover {
		  background-color: #555;
		  color: white;
					}
					
		a {
			text-decoration: none;
			color: black;
			background-color: grey; 
		}
		
    </style>
</head>
<body>






    <h2>Patienten</h2>

    <table>
        <tr>
            <th>voornaam</th>
            <th>achternaam</th>
            <th>adres</th>
			<th>plaats</th>
            <th>telefoonnummer</th>
			<th>verwijder patient</th>
			<th>bewerk patient</th>
			

            
        </tr>
<?php
$servername = "rdbms.strato.de";
$username = "dbu3645296";
$password = "Imad12345@";
$dbname = "dbs12312128";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check of er een specifieke patiënt moet worden verwijderd
    if (isset($_GET['verwijder_patient_id'])) {
        $verwijder_patient_id = $_GET['verwijder_patient_id'];

        // Voorbereid statement om de patiënt te verwijderen op basis van ID
        $verwijder_stmt = $conn->prepare("DELETE FROM mock_data WHERE Patient_id = :patient_id");
        $verwijder_stmt->bindParam(':patient_id', $verwijder_patient_id);
        $verwijder_stmt->execute();

        echo "Patiënt met ID $verwijder_patient_id is succesvol verwijderd.";
    }

    // Rest van me code voor het weergeven van patiëntgegevens
    $stmt = $conn->prepare("SELECT * FROM mock_data");
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($result as $row) {
        echo "<tr>";

        echo "<td>" . $row['Voornaam'] . "</td>";
        echo "<td>" . $row['Achternaam'] . "</td>";
        echo "<td>" . $row['adres'] . "</td>";
        echo "<td>" . $row['plaats'] . "</td>";
        echo "<td>" . $row['telefoonnummer'] . "</td>";

        // Verwijder knop voor elke patiënt
        echo "<td><a href='?verwijder_patient_id=" . $row['Patient_id'] . "'>Verwijder</a></td>";
		echo "<td><a href='bewerk_patient.php?bewerk_patient_id=" . $row['Patient_id'] . "'>Bewerk</a></td>";


        echo "</tr>";
    }
} catch(PDOException $e) {
    echo "Databaseverbinding mislukt: " . $e->getMessage();
}
?>

	
    
   </table>
   
   <ul>
  <li><a href="logout.php">uitloggen</a></li>
</ul>

</body>
</html>