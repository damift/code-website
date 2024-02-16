<?php
// Controleer of er een patiënt is geselecteerd
if(isset($_GET['patient_id'])) {
    $patient_id = $_GET['patient_id'];
	

    // Verbind met de database en haal notities op voor de geselecteerde patiënt
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare("SELECT * FROM patient_notes WHERE patient_id = :patient_id");
    $stmt->bindParam(':patient_id', $patient_id);
    $stmt->execute();
    $notes = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Notities Patiënt</title>
</head>
<body>
    <!-- Toon notities voor de geselecteerde patiënt -->
    <h2>Notities Patiënt</h2>
    <?php if(isset($notes) && !empty($notes)): ?>
        <ul>
            <?php foreach($notes as $note): ?>
                <li><?php echo $note['note_content']; ?> (<?php echo $note['note_date']; ?>)</li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Geen notities gevonden voor deze patiënt.</p>
    <?php endif; ?>

    <!-- Formulier om een nieuwe notitie toe te voegen -->
    <h3>Nieuwe Notitie Toevoegen</h3>
    <form method="post" action="add_note.php">
        <input type="hidden" name="patient_id" value="<?php echo $patient_id; ?>">
        <textarea name="note_content" rows="4" cols="50"></textarea><br>
        <input type="submit" value="Notitie Toevoegen">
    </form>
</body>
</html>

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
    header("Location: notes.php?patient_id=$patient_id");
    exit;
}
?>