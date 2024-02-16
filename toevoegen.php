<?php
$servername = "rdbms.strato.de";
$username = "dbu3645296";
$password = "Imad12345@";
$dbname = "dbs12312128";

// Verbinding maken met de database
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Gegevens van het formulier ophalen
    $patient_id = $_POST['patient_id']; 
	$voornaam = $_POST['voornaam'];
    $achternaam = $_POST['achternaam'];
    $adres = $_POST['adres'];
    $plaats = $_POST['plaats'];
    $telefoonnummer = $_POST['telefoonnummer'];

    // Query om gegevens toe te voegen
    $sql = "INSERT INTO mock_data (Patient_id, Voornaam, Achternaam, adres, plaats, telefoonnummer) VALUES ('$patient_id','$voornaam', '$achternaam', '$adres', '$plaats', '$telefoonnummer')";
    
    // Uitvoeren van de query
    $conn->exec($sql);

    // Terugkeren naar de hoofdpagina of een andere gewenste locatie
    header("Location: admin.php");
} catch(PDOException $e) {
    echo "Toevoegen van patiënt mislukt: " . $e->getMessage();
}

$conn = null;
?>
