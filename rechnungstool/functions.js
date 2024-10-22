let productCount = 0; //nummeriert zur Rechnung hinzugefügte Produkte

const forms = {
    createCostumer: {
        id: "newCostumerFormWrapper",
        content: `
                <form method="post" id="newCostumerForm">
                    <h2>Neuen Kunden anlegen</h2>

                    <label for="name">Kundenname</label>
                    <input type="text" name="name" id="name" placeholder="Kundennamen eingeben" autocomplete="off" required>
                        
                    <label for="adress">Kundenadresse</label>
                    <textarea id="adress" name="address" placeholder="Adresse eingeben" rows="6" cols="30" required></textarea>
                        
                    <label for="taxId">Steuernummer</label>
                    <input type="text" id="taxId" name="taxId" placeholder="Die Steuernummer eingeben" autocomplete="off">
                        
                    <label for="salesTaxId">Umsatzsteuer-ID</label>
                    <input type="text" id="salesTaxId" name="salesTaxId" placeholder="Die Umsatzsteuer-ID eingeben" autocomplete="off">
                    <div class="marginTop">
                        <button type="submit" id="sendNewCostumer" onclick="createCostumer">Kunden anlegen</button>
                        <button type="button" id="cancelNewCostumer" onclick="hideSubForm()">Abbrechen</button>
                    </div>    
                    </form>
        `
    },
    createProduct: {
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
                        <button type="submit" id="sendNewProduct" onclick="createProduct">Produkt anlegen</button>
                        <button type="button" id="cancelNewProduct" onclick="hideSubForm()">Abbrechen</button>
                    </div>
                </form>
        `
    }
};

function addProduct() {

    let options = ``;
    data = {action: 'addProduct'};
    let items = makeAjaxRequest(data);
    items.then(function (result) {

        for (let i = 0; i < result.data.length; i++) {
            newOption = `<option name='productSelect' value='${result.data[i]['id']}'>${result.data[i]['productTitle']}  -  ${result.data[i]['productPrice']}€</option>`;
            options += newOption;
        }

        productCount++;
        const productSelectorNew = `
        <div class="flex marginTop">
            <div>
                <select id="productSelect_${productCount}" name="productSelect_${productCount}">
                    <option value="">-- Bitte ein Produkt auswählen --</option>
                    ${options}                     
                </select>
            </div>
                <input type="number" id="productAmount_${productCount}" name="productAmount_${productCount}" min="0" placeholder="0" required>
            </div>
        </div>
    `
        $('#productContainer').append(productSelectorNew);

    });
}


function makeAjaxRequest(data) {

    return new Promise((resolve, reject) => {
        $.ajax({
            type: 'POST',
            url: 'ajax.php',
            data: data
        })
            .done(function (data, jqXHR) {
                resolve({ 'statusCode': jqXHR.status, 'data': data });
            })
            .fail(function (jqXHR) {
                reject({ 'statusCode': jqXHR.status });
            })
    });
}

function createCostumer(event) { }


function createProduct(event) {
    event.preventDefault();
    data = {
        formData,
        action: 'createProduct'
    };
    makeAjaxRequest(data);


}

// validiert Costumer-Form on submit - muss ersetzt und in eine createCostumer-Funktion eingebaut werden
$(document).on("submit", "#newCostumerForm", function (event) {
    
    if (!$("#taxId").val() && !$("#salesTaxId").val()) {
        alert("Umsatzsteuernummer oder Steuernummer eingeben!");
        return false;
    } else {
        event.target.submit();
    }
});

//Öffnen und Schließen der newCostumer und newProduct-Formulare

function showSubForm(requestedForm) {

    switch (requestedForm) {
        case 'createCostumer':
            $('#subFormWrapper').html(forms.createCostumer.content).removeClass("hidden");
            break;
        case 'createProduct':
            $('#subFormWrapper').html(forms.createProduct.content).removeClass("hidden");
            break;
    }
}


function hideSubForm() {
    $('#subFormWrapper').html("").addClass("hidden");
}