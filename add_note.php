<?php
// Verkrijg gegevens van het formulier
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $patient_id = $_POST['patient_id'];
    $note_content = $_POST['note_content'];


	$servername = "rdbms.strato.de";
$username = "dbu3645296";
$password = "Imad12345@";
$dbname = "dbs12312128";
    // Voeg nieuwe notitie toe aan de database
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare("INSERT INTO patient_notes (patient_id, note_content) VALUES (:patient_id, :note_content)");
    $stmt->bindParam(':patient_id', $patient_id);
    $stmt->bindParam(':note_content', $note_content);
    $stmt->execute();

    // Stuur terug naar de pagina met notities na toevoegen van notitie
    header("Location: admin.php?patient_id=$patient_id");
    exit;
}
?>