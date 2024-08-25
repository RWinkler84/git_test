let productCount = 0; //nummeriert zur Rechnung hinzugefügte Produkte

const forms = [
    {
        id: "newCostumerFormWrapper",
        content: `
                <form method="post">
                    <h2>Neuen Kunden anlegen</h2>
                        
                    <label for="adress">Kundenadresse</label>
                    <textarea id="adress" name="adress" placeholder="Adresse eingeben" rows="6" cols="30" required></textarea>
                        
                    <label for="taxId">Steuernummer</label>
                    <input type="text" id="taxId" name="taxId" placeholder="Die Steuernummer eingeben" required>
                        
                    <label for="salesTaxId">Umsatzsteuer-ID</label>
                    <input type="text" id="salesTaxId" name="salesTaxId" placeholder="Die Umsatzsteuer-ID eingeben">
                    <div class="marginTop">
                        <button type="submit" id="sendNewCostumer" formaction="createcostumer.php">Kunden anlegen</button>
                        <button type="button" id="cancelNewCostumer" onclick="hideSubForm()">Abbrechen</button>
                    </div>    
                    </form>
        `,
    },
    {
        id: "newProductFormWrapper",
        content: `
                <form method="post">
                    <h2>Neues Produkt anlegen</h2>

                    <label for="productTitle">Titel</label>
                    <input type="text" id="productTitle" name="productTitle" placeholder="Eine Bezeichnung vergeben" required>
                    
                    <label for="productPrice">Netto-Preis</label>
                    <input type="text" id="productPrice" name="productPrice" placeholder="Format: 10.99" required>
                    
                    <div class="marginTop">
                        <label>Mehrwertsteuer</label>
                        <div>
                            <input type="radio" id="tax0" name="taxRate" value="0" required>
                            <label for="tax0" style="display: inline;">0 %</label>
                        </div>
                        <div>
                            <input type="radio" id="tax7" name="taxRate" value="7">
                            <label for="tax7" style="display: inline;">7 %</label>
                        </div>
                        <div>
                            <input type="radio" id="tax19" name="taxRate" value="19">
                            <label for="tax19" style="display: inline;">19 %</label>
                        </div>
                    </div>

                    <label for="productDescription">Beschreibung (optional)</label>
                    <textarea id="productDescription" name="productDescription" placeholder="Wichtige Infos zum Produkt..."></textarea>
                     <div>                       
                        <button type="submit" id="sendNewProduct" formaction="createproduct.php">Produkt anlegen</button>
                        <button type="button" id="cancelNewProduct" onclick="hideSubForm()">Abbrechen</button>
                    </div>
                </form>
        `,
    }    
];

function addProduct(){
    const productContainer = document.getElementById("productContainer");
    productCount++;
    const productSelectorNew = `
        <div class="flex marginTop">
            <div>
                <select id="productSelect_${productCount}" name="productSelect_${productCount}">
                    <option value="">-- Bitte ein Produkt auswählen --</option>
                    <option value="productId1">Das erste Produkt</option>
                    <option value="productId2">Unerhörter Service</option>
                </select>
            </div>
                <input type="number" id="productAmount_${productCount}" name="productAmount_${productCount}" min="0" placeholder="0" required>
            </div>
        </div>
    `
    console.log(productSelectorNew);
    $(productContainer).append(productSelectorNew);
}

function showSubForm(formId){
    const costumerForm = document.getElementById("subFormWrapper");
    $(costumerForm).html(forms[formId].content).removeClass("hidden");
}

function hideSubForm(){
    const costumerForm = document.getElementById("subFormWrapper");
    $(costumerForm).html("").addClass("hidden");
}