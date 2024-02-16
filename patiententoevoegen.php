<!DOCTYPE html>
<html>
<head>
    <title>Patiëntenbeheer</title>
    <style>
        /* Je bestaande stijlen hier */

        /* Aanvullende stijl voor formulier */
        form {
            margin-bottom: 20px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        input[type="text"], input[type="tel"] {
            width: 100%;
            padding: 8px;
            margin: 6px 0;
            border-radius: 4px;
            border: 1px solid #ccc;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h2>Voeg een nieuwe patiënt toe</h2>

    <form method="post" action="toevoegen.php"> 
        <label for="voornaam">Voornaam:</label>
        <input type="text" id="voornaam" name="voornaam" required>

        <label for="achternaam">Achternaam:</label>
        <input type="text" id="achternaam" name="achternaam" required>

        <label for="adres">Adres:</label>
        <input type="text" id="adres" name="adres" required>

        <label for="plaats">Plaats:</label>
        <input type="text" id="plaats" name="plaats" required>

        <label for="telefoonnummer">Telefoonnummer:</label>
        <input type="tel" id="telefoonnummer" name="telefoonnummer" required>

        <input type="submit" value="Voeg toe">
    </form>

    <!-- Je bestaande tabel met gegevens -->
    <!-- ... -->

    <ul>
        <li><a href="logout.php">Uitloggen</a></li>
    </ul>
</body>
</html>
