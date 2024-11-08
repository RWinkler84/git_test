<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <title>Rechungsformular</title>
    <?php require 'initialdata.php'; ?>
</head>

<body>
    <div id="invoiceFormWrapper">
        <div id="toastMain">
            <p></p>
            <div id="toastButtonWrapper" style="display: flex; gap: 1em;">
                <button id="confirmButton"></button>
                <button id="cancelButton" style="display: none">Abbrechen</button>
            </div>
        </div>
        <form id="invoiceForm" method="post" onsubmit="createInvoice(event)">
            <h1>Rechnung erstellen</h1>
            <div class="flex">
                <div>
                    <label for="costumerSelect">Kunden auswählen</label>
                    <select id="costumerSelect" name="costumerSelect" required>
                        <option name="costumerSelect" value="">-- Bitte einen Kunden auswählen --</option>
                        <?php
                        foreach ($costumer as $item) {
                            echo "<option name='costumerSelect' value='" . $item['id'] . "'>" . $item['name'] . "</option>";
                        };
                        ?>
                    </select>
                </div>
                <div>
                    <button type="button" class="noMarginTop" onclick="showSubForm('createCostumer')">Kunden erstellen</button>
                </div>
            </div>

            <!-- Leistungen hinzufügen -->
            <div class="flex">
                <div id="productContainer" class="flex" style="flex-wrap: wrap;">
                    <div class="flex">
                        <div>
                            <label for="productSelect_0">Leistungen hinzufügen</label>
                            <select id="productSelect_0" name="productSelect_0">
                                <option value="">-- Bitte ein Produkt auswählen --</option>
                                <?php
                                foreach ($product as $item) {
                                    echo "<option name='productSelect' value='" . $item['id'] . "' price='" . $item['productPrice'] . "'>" . $item['productTitle'] . "  -  " . $item['productPrice'] . "€</option>";
                                };
                                ?>
                            </select>
                        </div>
                        <div>
                            <label for="productAmount_0">Anzahl</label>
                            <input type="number" id="productAmount_0" name="productAmount_0" min="0" placeholder="0" required>
                        </div>
                    </div>
                </div>
                <div>
                    <button type="button" class="noMarginTop" style="min-width:max-content;" onclick="showSubForm('createProduct')">Produkt erstellen</button>
                </div>
            </div>
            <button type="button" onclick="addProductSelect()">Produkt hinzufügen</button>

            <!-- zusätzliche Felder -->
            <h3>Zusätzlich Informationen</h3>
            <div>
            <div class="marginTop"><label style="display: inline">Leistungsdatum /-zeitraum</label><span class="info" onclick="fullfillmentDateInfo()">?</span></div>
            <input type="date" id="startDate" name="startDate" required>
            <input type="date" id="endDate "name="endDate">
            </div>
            <div>
                <label>Zahlungsziel</label>
                <div>
                    <input type="radio" id="paymentTermsNone" name="paymentTerms" value="0" checked>
                    <label for="paymentTermsNone" style="display: inline;">kein Zahlungsziel angeben</label>
                </div>
                <div>
                    <input type="radio" id="paymentTerms14" name="paymentTerms" value="14" required>
                    <label for="paymentTerms14" style="display: inline;">14 Tage</label>
                </div>
                <div>
                    <input type="radio" id="paymentTerms30" name="paymentTerms" value="30">
                    <label for="paymentTerms30" style="display: inline;">30 Tage</label>
                </div>
            </div>
            <div class="marginTop">
                <input type="checkbox" id="smallBusinessTax" name="smallBusinessTax" value="1">
                <label for="smallBusinessTax" style="display: inline;">umatzsteuerbefreit nach Kleinunternehmerregel</label>
            </div>
            <div class="marginTop">
                <input type="checkbox" id="reverseCharge" name="reverseCharge" value="1">
                <label for="reverseCharge" style="display: inline;">Umkehr der Umsatzsteuerschuld</label>
            </div>
            <div>
                <label for="invoiceComment">Rechnungskommentar (optional)</label>
                <textarea id="invoiceComment" name="invoiceComment" placeholder="zusätzliche Kommentare auf der Rechnung..."></textarea>
            </div>
            <button type="submit">Rechnung erstellen</button>
        </form>
        <div id="subFormWrapper" class="subFormWrapper hidden"></div>
    </div>
    <div id="invoiceData">
    </div>
</body>
    <script src="./functions.js"></script>

</html>

<!--
TODO

Versteckte Felder, um alle nötigen Daten wie Kundenaddresse, Produktbeschreibung, Preis und Co fest in Rechnung zu hinterlegen. Nur das sichern der ID
und spätere laden aus der jeweiligen Tabelle reicht nicht, weil diese geändert werden könnte und sich dann der Rechnungsinhalt rückwirkend ändert

PHP-Script zum Speichern der Rechnungsdaten

-->