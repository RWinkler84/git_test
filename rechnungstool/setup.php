<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InvoiceTool Setup</title>
    <style>
        body {
            width: 50%;
            min-width: 800px;
            margin: 0 auto;
            padding-bottom: 50px;
        }

        .block {
            display: block;
        }

        .marginTop {
            margin-top: 0.5em;
        }
    </style>
</head>

<body>
    <h1>Setup</h1>
    <p>Bitte lösche diese Seite nach der Einrichtung von InvoiceTool</p>
    <h2>Datenbankverbindung</h2>
    <p>Die Information zu deiner Datenbank findest du üblicherweise in deinen Hosting-Informationen
        oder kannst sie direkt bei deinem Hoster erfahren.</p>
    <p>Hostest du lokal mit XAMPP oder LAMPP, ist der Hostname "localhost". Beim Namen der Datenbank hast du freie Wahl. Solltest du nichts
        geändert haben, ist der Username "root" und das Passwort-Feld kann leer bleiben.</p>
    <form method="post" action="setup.php">
        <fieldset>
            <legend>Verbindungsinformationen</legend>
            <div>
                <label for="hostname" class="inline">Hostname:</label>
                <input type="text" class="marginTop" id="hostname" name="hostname" placeholder="Hostname" value="<?php if (isset($_POST['hostname'])) {
                                                                                                                        echo $_POST['hostname'];
                                                                                                                    } ?>" required>
            </div>
            <div>
                <label for="hostname" class="inline">Datenbankname:</label>
                <input type="text" class="marginTop" id="databaseName" name="databaseName" placeholder="Datenbankname" value="<?php if (isset($_POST['databaseName'])) {
                                                                                                                                    echo $_POST['databaseName'];
                                                                                                                                } ?>" required>
            </div>
            <label for="hostname" class="inline">Nutzername:</label>
            <input type="text" class="marginTop" id="userName" name="userName" placeholder="Nutzername" value="<?php if (isset($_POST['userName'])) {
                                                                                                                    echo $_POST['userName'];
                                                                                                                } ?>" required>
            <div>
                <label for="hostname" class="inline">Passwort:</label>
                <input type="text" class="marginTop" id="userPassword" name="userPassword" placeholder="Passwort" value="<?php if (isset($_POST['userPassword'])) {
                                                                                                                                echo $_POST['userPassword'];
                                                                                                                            } ?>">
            </div>
        </fieldset>
        <button type="submit" class=" marginTop">Setup starten</button>
    </form>

    <?php

    //bestimmt Programmablauf

        if (isset($_POST['action']) && $_POST['action'] == 'createDb') {

            connectToServer();

            createDatabase();

            createTables();

            createDatabaseConnector();
        } else if (isset($_POST['hostname'])){

            connectToServer();

            connectToDatabase();

            createTables();

            createDatabaseConnector();
        } else {
            die();
        }

    function replacePlaceholders()
    {

        if (isset($_POST['databaseName']) && isset($_POST['userName']) && isset($_POST['hostname'])) {

            $template = file_get_contents('core/db.php');
            $placeholders = [
                'hostname' => $_POST['hostname'],
                'databaseName' => $_POST['databaseName'],
                'userName' => $_POST['userName'],
                'userPassword' => $_POST['userPassword'] ?? ''
            ];

            foreach ($placeholders as $placeholder => $value) {
                $template = str_replace('{' . $placeholder . '}', $value, $template);
            }
        }

        return $template;
    }





    function connectToServer()
    {
        echo "<h3>Schritt 1/4: Verbindung zum Server herstellen</h3>";

        try {
            $conn = new mysqli($_POST['hostname'], $_POST['userName'], $_POST['userPassword']);
            if ($conn->connect_error) {;
                throw new Exception("<p><strong style='color: red'>Fehler:</strong> Die Verbindung zum Server ist fehlgeschlagen und der Setup kann nicht fortgesetzt werden. Bitte überprüfe die von dir eingegebenen Verbindungsdaten.</p>");
            } else {
                $conn->set_charset('UTF8');
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            die();
        }

        echo "<p><strong style='color: green;'>Erfolg:</strong> Die Verbindung zum Server wurde erfolgreich hergestellt.</p>";
        $conn->close();
    }


    function connectToDatabase()
    {
        echo "<h3>Schritt 2/4: Datenbankverbindung aufbauen</h3>";

        if (isset($_POST['databaseName'])) {
            try {

                $databaseName = $_POST['databaseName'];
                $conn = new mysqli($_POST['hostname'], $_POST['userName'], $_POST['userPassword']);
                $conn->set_charset('UTF8');

                if ($conn->connect_error) {
                    throw new Exception("Die Datenbankverbindung konnte nicht aufgebaut werden." . $conn->connect_error);
                }
            } catch (Exception $e) {
                echo $e;
                $conn->close();
            }

            try {
                $result = $conn->query("SHOW DATABASES LIKE '$databaseName'");
                if (!$conn->query("SHOW DATABASES LIKE '$databaseName'")) {
                    throw new Exception("<p><strong style='color: red'>Fehler:</strong>Bei der Datenbankabfrage ist ein Fehler aufgetreten!</p>" . $conn->error);
                }
            } catch (mysqli_sql_exception $e) {
                echo ($e);
                $conn->close();
                die();
            }
        }

        if ($result->num_rows == 0) {
            echo "<p><strong style='color: red'>Fehler:</strong> Es konnte keine Datenbank mit dem angegegeben Namen gefunden werden. Prüfe, ob der Name der Datenbank korrekt ist.</p>";
            echo "<p>Möchtest du eine neue Datenbank mit dem angegeben Namen zu erstellen, klicke auf Weiter.</p>";
            echo <<<START
                    <form method="post" onsubmit="setup.php">
                        <input type="hidden" class="marginTop" id="hostname" name="hostname" placeholder="Hostname" value="{$_POST['hostname']}" required>
                        <input type="hidden" class="marginTop" id="databaseName" name="databaseName" placeholder="Datenbankname" value="{$_POST['databaseName']}" required>
                        <input type="hidden" class="marginTop" id="userName" name="userName" placeholder="Nutzername" value="{$_POST['userName']}" required>
                        <input type="hidden" class="marginTop" id="userPassword" name="userPassword" placeholder="Passwort" value="{$_POST['userPassword']}">
                        <input type="hidden" name="action" value="createDb">
                        <button type="submit">Weiter</button>
                    </form>
                START;

            die();
        } else {
            echo "<p><strong style='color: green;'>Erfolg:</strong> Die Verbindung zur Datenbank wurde erfolgreich hergestellt.</p>";
        }
    }

    function createDatabase()
    {
        echo "<h3>Schritt 3/4 Datenbank erstellen</h3>";
        try {
            $databaseName = $_POST['databaseName'];
            $conn = new mysqli($_POST['hostname'], $_POST['userName'], $_POST['userPassword']);
            $conn->set_charset('UTF8');
            $conn->query("CREATE DATABASE IF NOT EXISTS $databaseName DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;");
        } catch (Exception $e) {
            echo "<p><strong style='color: red'>Fehler:</strong> Die Datenbank konnte nicht erstellt werden. Prüfe, ob deine Nutzerdaten (Nutzername und Passwort) korrekt sind. Folgender Fehler ist aufgetreten:</p>";
            echo $conn->error;
            $conn->close();
            die();
        }

        echo "<p><strong style='color: green;'>Erfolg:</strong> Die Datenbank wurde erfolgreich erstellt.";
        $conn->close();
    }

    function createTables()
    {
        echo "<h3>Schritt 3/4: Tabellen erstellen</h3>";

        try {
            $conn = new mysqli($_POST['hostname'], $_POST['userName'], $_POST['userPassword'], $_POST['databaseName']);
            $conn->set_charset('UTF8');
        } catch (Exception $e) {
            echo "<p><strong style='color: red'>Fehler:</strong> Die Verbindung zur Datenbank konnte nicht hergestellt werden. Folgender Fehler ist aufgetreten:</p>" . $e;
            die();
        }

        try {
            $conn->query('CREATE TABLE IF NOT EXISTS `baseInterestRate` (`id` int(11) NOT NULL AUTO_INCREMENT,`date` date NOT NULL,`baseInterestRate` double NOT NULL,PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;');
            $conn->query("INSERT INTO `baseInterestRate` (`date`, `baseInterestRate`) VALUES ('2023-01-01', 1.62), ('2023-07-01', 3.12), ('2025-01-01', 3.62), ('2025-07-01', 3.37);");
        } catch (Exception $e) {
            echo "<p><strong style='color: red'>Fehler:</strong> Die Basiszins-Tabelle konnte nicht erstellt werden. Folgender Fehler ist aufgetreten:</p>" . $e;
            die();
        }

        echo "<p><strong style='color: green'>Erfolg:</strong> Die Basiszins-Tabelle wurde erfolgreich erstellt.</p>";

        try {
            $conn->query('CREATE TABLE IF NOT EXISTS `businessInfo` (`id` int(11) NOT NULL AUTO_INCREMENT,`name` text NOT NULL, `address` text NOT NULL, `taxId` text NOT NULL,  `salesTaxId` text NOT NULL,  `bankAccountNumber` int(11) NOT NULL, `IBAN` text NOT NULL,  `BIC` text NOT NULL,  `bankName` text NOT NULL,  `phoneNumber` text NOT NULL,  `mail` text NOT NULL,  PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;');
        } catch (Exception $e) {
            echo "<p><strong style='color: red'>Fehler:</strong> Die Tabelle für Unternehmensinformationen konnte nicht erstellt werden. Folgender Fehler ist aufgetreten:</p>" . $e;
            die();
        }

        echo "<p><strong style='color: green'>Erfolg:</strong> Die Tabelle für Unternehmensinformationen wurde erfolgreich erstellt.</p>";

        try {
            $conn->query('CREATE TABLE IF NOT EXISTS `costumer` (  `id` int(11) NOT NULL AUTO_INCREMENT,  `name` text NOT NULL,  `address` text NOT NULL,  `taxId` text NOT NULL,  `salesTaxId` text NOT NULL,  `lastEdited` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),  PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;');
        } catch (Exception $e) {
            echo "<p><strong style='color: red'>Fehler:</strong> Die Kunden-Tabelle konnte nicht erstellt werden. Folgender Fehler ist aufgetreten:</p>" . $e;
            die();
        }

        echo "<p><strong style='color: green'>Erfolg:</strong> Die Kunden-Tabelle wurde erfolgreich erstellt.</p>";

        try {
            $conn->query('CREATE TABLE IF NOT EXISTS `invoices` (  `id` int(11) NOT NULL AUTO_INCREMENT,  `date` timestamp NOT NULL DEFAULT current_timestamp(),  `selfName` text NOT NULL,  `selfAddress` text NOT NULL,  `selfTaxId` text NOT NULL,  `selfSalesTaxId` text NOT NULL,  `selfBankAccountNumber` text NOT NULL,  `selfIBAN` text NOT NULL,  `selfBIC` text NOT NULL,  `selfBankName` text NOT NULL,  `selfMail` text NOT NULL,  `selfPhoneNumber` text NOT NULL,  `costumerName` text NOT NULL,  `costumerAddress` text NOT NULL,  `costumerTaxId` text NOT NULL,  `costumerSalesTaxId` text NOT NULL,  `products0` text NOT NULL,  `products7` text NOT NULL,  `products19` text NOT NULL,  `totalTax7` decimal(10,2) NOT NULL,  `totalTax19` decimal(10,2) NOT NULL,  `invoiceNetAmount` decimal(10,2) NOT NULL,  `invoiceGrossAmount` decimal(10,2) NOT NULL, `paymentTerms` decimal(10,0) NOT NULL,  `smallBusinessTax` tinyint(1) NOT NULL,  `reverseCharge` tinyint(1) NOT NULL,  `invoiceComment` text NOT NULL,  `fullfillmentDateStart` text NOT NULL,  `fullfillmentDateEnd` text NOT NULL,  `paymentStatus` tinyint(1) NOT NULL,  `receivedPayments` text NOT NULL,  `amountToPay` decimal(10,2) NOT NULL,  PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;');
        } catch (Exception $e) {
            echo "<p><strong style='color: red'>Fehler:</strong> Die Rechnungstabelle konnte nicht erstellt werden. Folgender Fehler ist aufgetreten:</p>" . $e;
            die();
        }

        echo "<p><strong style='color: green'>Erfolg:</strong> Die Rechnungstabelle wurde erfolgreich erstellt.</p>";

        try {
            $conn->query('CREATE TABLE IF NOT EXISTS `paymentReminder` (  `id` int(11) NOT NULL AUTO_INCREMENT,  `invoiceId` int(11) NOT NULL,  `reminderDueDate` text NOT NULL,  `reminderTitle` text NOT NULL,  `reminderContent` text NOT NULL,  `reminderInterest` int(11) NOT NULL,  `reminderFee` int(11) NOT NULL,  PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;');
        } catch (Exception $e) {
            echo "<p><strong style='color: red'>Fehler:</strong> Die Mahnungstabelle konnte nicht erstellt werden. Folgender Fehler ist aufgetreten:</p>" . $e;
            die();
        }

        echo "<p><strong style='color: green'>Erfolg:</strong> Die Mahnungstabelle wurde erfolgreich erstellt.</p>";

        try {
            $conn->query('CREATE TABLE IF NOT EXISTS `products` (  `id` int(11) NOT NULL AUTO_INCREMENT,  `productTitle` text NOT NULL,  `productPrice` decimal(10,2) NOT NULL,  `taxRate` int(11) NOT NULL,  `productDescription` text NOT NULL,  `lastEdited` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),  PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci');
        } catch (Exception $e) {
            echo "<p><strong style='color: red'>Fehler:</strong> Produkt-Tabelle konnte nicht erstellt werden. Folgender Fehler ist aufgetreten:</p>" . $e;
            die();
        }

        echo "<p><strong style='color: green'>Erfolg:</strong> Die Produkt-Tabelle wurde erfolgreich erstellt.</p>";
    }

    function createDatabaseConnector()
    {
        $template = replacePlaceholders();

        echo "<h3>Schritt 4/4: Verbindungsdaten speichern</h3>";
        if (is_writeable("core/")) {
            fopen('core/db.php', 'w') or die('Konnte db.php nicht öffnen');

            if (fwrite('core/db.php', $template)) {
                echo "<p><strong style='color: green;'>Erfolg:</strong> Datenbankinformationen gespeichert.</p>";
            }
            fclose('core/db.php');
        } else {
            echo "<p><p><strong style='color: red'>Fehler:</strong> Leider scheint InvoiceTool keine Schreibrechte für den core-Ordner zu haben. Die Verbindungsdaten konnten deshalb nicht gespeichert werden.</p>
        <p>Um sicherzustellen, dass InvoiceTool wie erwartet funktioniert, öffne bitte die Datei db.php im core-Unterordner des invoiceTool-Ordners und ersetze den Inhalt mit folgendem Code:</p>";
            echo '<code><p style="background-color: lightgrey; border-radius: 5px; padding: 10px;">' . nl2br(htmlspecialchars($template)) . '</p></code>';
        }
    }
    ?>
</body>

</html>