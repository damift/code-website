<?php
$servername = "rdbms.strato.de";
$username = "dbu3645296";
$password = "Imad12345@";
$dbname = "dbs12312128";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $patient_id = $_POST['patient_id'];
        $voornaam = $_POST['voornaam'];
        $achternaam = $_POST['achternaam'];
        $adres = $_POST['adres'];
        $plaats = $_POST['plaats'];
        $telefoonnummer = $_POST['telefoonnummer'];

        // Update de patiëntgegevens in de database
        $update_stmt = $conn->prepare("UPDATE mock_data SET Voornaam = :voornaam, Achternaam = :achternaam, adres = :adres, plaats = :plaats, telefoonnummer = :telefoonnummer WHERE Patient_id = :patient_id");
        $update_stmt->bindParam(':voornaam', $voornaam);
        $update_stmt->bindParam(':achternaam', $achternaam);
        $update_stmt->bindParam(':adres', $adres);
        $update_stmt->bindParam(':plaats', $plaats);
        $update_stmt->bindParam(':telefoonnummer', $telefoonnummer);
        $update_stmt->bindParam(':patient_id', $patient_id);
        $update_stmt->execute();

        echo "Patiëntgegevens zijn succesvol bijgewerkt.";
    }
} catch(PDOException $e) {
    echo "Databaseverbinding mislukt: " . $e->getMessage();
}
?>
