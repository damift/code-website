<?php


$servername = "rdbms.strato.de";
$username = "dbu3645296";
$password = "Imad12345@";
$dbname = "dbs12312128";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_GET['bewerk_patient_id'])) {
        $bewerk_patient_id = $_GET['bewerk_patient_id'];

        // Haal de patiëntgegevens op basis van ID
        $bewerk_stmt = $conn->prepare("SELECT * FROM mock_data WHERE Patient_id = :patient_id");
        $bewerk_stmt->bindParam(':patient_id', $bewerk_patient_id);
        $bewerk_stmt->execute();
        $patient_data = $bewerk_stmt->fetch(PDO::FETCH_ASSOC);

        // Toon een formulier met de patiëntgegevens om te bewerken
        if ($patient_data) {
            // Toon een formulier met de patiëntgegevens om te bewerken
            ?>
            <form method="POST" action="update_patient.php">
                <input type="hidden" name="patient_id" value="<?php echo $patient_data['Patient_id']; ?>">
                Voornaam: <input type="text" name="voornaam" value="<?php echo $patient_data['Voornaam']; ?>"><br>
                Achternaam: <input type="text" name="achternaam" value="<?php echo $patient_data['Achternaam']; ?>"><br>
                Adres: <input type="text" name="adres" value="<?php echo $patient_data['adres']; ?>"><br>
                Plaats: <input type="text" name="plaats" value="<?php echo $patient_data['plaats']; ?>"><br>
                Telefoonnummer: <input type="text" name="telefoonnummer" value="<?php echo $patient_data['telefoonnummer']; ?>"><br>
                <input type="submit" value="Opslaan">
            </form>
            <?php
        } else {
            echo "Geen patiëntgegevens gevonden.";
        }
    }
} catch(PDOException $e) {
    echo "Databaseverbinding mislukt: " . $e->getMessage();
}
?>