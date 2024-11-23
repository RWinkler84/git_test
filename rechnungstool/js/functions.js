let productCount = 0; //nummeriert zur Rechnung hinzugefügte Produkte
let date = new Date();


const forms = {
    createCostumer: {
        id: "newCostumerFormWrapper",
        content: `
                <div id="toast">
                    <p></p>
                    <div id="toastButtonWrapper" style="display: flex; gap: 1em;">
                        <button id="confirmButton"></button>
                        <button id="cancelButton" style="display: none">Abbrechen</button>
                    </div>
                </div>
                <form method="post" onsubmit="createCostumer(event)" id="newCostumerForm">
                    <h2>Neuen Kunden anlegen</h2>

                    <label for="name">Kundenname</label>
                    <input type="text" name="name" id="name" placeholder="Kundennamen eingeben" autocomplete="off" required>
                        
                    <label for="address">Kundenadresse</label>
                    <textarea id="address" name="address" placeholder="Adresse eingeben" rows="6" cols="30" required></textarea>
                        
                    <label for="taxId">Steuernummer</label>
                    <input type="text" id="taxId" name="taxId" placeholder="Die Steuernummer eingeben" autocomplete="off">
                        
                    <label for="salesTaxId">Umsatzsteuer-ID</label>
                    <input type="text" id="salesTaxId" name="salesTaxId" placeholder="Die Umsatzsteuer-ID eingeben" autocomplete="off">
                    <div class="marginTop">
                        <button type="submit" id="sendNewCostumer">Kunden anlegen</button>
                        <button type="button" id="cancelNewCostumer" onclick="hideSubForm()">Abbrechen</button>
                    </div>    
                    </form>
        `
    },
    createProduct: {
        id: "newProductFormWrapper",
        content: `
                <div id="toast">
                    <p></p>
                    <div id="toastButtonWrapper" style="display: flex; gap: 1em;">
                        <button id="confirmButton"></button>
                        <button id="cancelButton" style="display: none">Abbrechen</button>
                    </div>
                </div>
                <form method="post" id="newProductForm" onsubmit="createProduct(event)">
                    <h2>Neues Produkt anlegen</h2>
                    <input type="hidden" name="id">
                    <label for="productTitle">Titel</label>
                    <input type="text" id="productTitle" name="productTitle" placeholder="Eine Bezeichnung vergeben" required>
                    
                    <div class="marginTop"><label for="productPrice" style="display: inline">Netto-Preis</label><span class="info" onclick="netPriceInfo()">?</span></div>
                    <input type="text" id="productPrice" name="productPrice" placeholder="Format: 10.99" required>
                    <button type="button" class="noMarginTop" onclick="netPriceCalculator()">berechnen</button>
                    
                    <div class="marginTop">
                        <label>Mehrwertsteuer</label>
                        <div>
                            <input type="radio" id="tax0" name="taxRate" value="0" required>
                            <label for="tax0" style="display: inline;">0 %</label>
                        </div>
                        <div>
                            <input type="radio" id="tax7" name="taxRate" value="7" required>
                            <label for="tax7" style="display: inline;">7 %</label>
                        </div>
                        <div>
                            <input type="radio" id="tax19" name="taxRate" value="19" required>
                            <label for="tax19" style="display: inline;">19 %</label>
                        </div>
                    </div>

                    <label for="productDescription">Beschreibung (optional)</label>
                    <textarea id="productDescription" name="productDescription" placeholder="Wichtige Infos zum Produkt..."></textarea>
                     <div>                       
                        <button type="submit" id="sendNewProduct">Produkt anlegen</button>
                        <button type="button" id="cancelNewProduct" onclick="hideSubForm()">Abbrechen</button>
                    </div>
                </form>
        `
    }
};

function addProductSelect() {

    let options = ``;
    data = { action: 'addProductSelect' };
    let items = makeAjaxRequest(data);
    items.then(function (result) {

        result.data = JSON.parse(result.data);

        for (let i = 0; i < result.data.length; i++) {
            newOption = `<option name='productSelect' value='${result.data[i]['id']}' price='${result.data[i]['productPrice']}'>${result.data[i]['productTitle']}  -  ${result.data[i]['productPrice']}€</option>`;
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
            url: 'core/dataqueries.php',
            data: data
        })
            .done(function (data) {
                resolve({ 'status': 'success', 'data': data });
            })
            .fail(function () {
                reject({ 'status': 'failed' });
            })
    });
}


//Logik des createCostumer-Fensters
function createCostumer(event) {

    event ? event.preventDefault() : false;
    data = {
        name: $('#newCostumerForm input[name=name]').val(),
        address: $('#newCostumerForm textarea[name=address]').val(),
        taxId: $('#newCostumerForm input[name=taxId]').val(),
        salesTaxId: $('#newCostumerForm input[name=salesTaxId]').val(),
        action: 'createCostumer'
    };

    let response = makeAjaxRequest(data);
    response
        .then(function (result) {

            $('#toast p').text('Kunde erfolgreich angelegt.');
            $('#toast #confirmButton').on('click', hideSubForm).text('Okay');
            $('#toast #cancelButton').css('display', 'none');
            $('#toast').css('display', 'flex');
        })
        .catch(function (result) {
            $('#toast p').text('Da ist etwas schief gelaufen!');
            $('#toast #confirmButton').on('click', createProduct).text('Erneut versuchen');
            $('#toast #cancelButton').css('display', 'block');
            $('#toast').css('display', 'flex');

            $('#toast #cancelButton').on('click', function () {
                $('#toast').css('display', 'none')
            });
        });

}


function updateCostumer(event) {

    event ? event.preventDefault() : false;
    data = {
        id: $('#newCostumerForm input[name=id]').val(),
        name: $('#newCostumerForm input[name=name]').val(),
        address: $('#newCostumerForm textarea[name=address]').val(),
        taxId: $('#newCostumerForm input[name=taxId]').val(),
        salesTaxId: $('#newCostumerForm input[name=salesTaxId]').val(),
        action: 'updateCostumer'
    };

    let response = makeAjaxRequest(data);
    response
        .then(function (result) {
            let modalContent = getModalContent('updateCostumer', 'success');

            $('#modal').removeClass('hidden').html(modalContent);
        })
        .catch(function (result) {
            let modalContent = getModalContent('updateCostumer', 'failed');

            $('#modal').removeClass('hidden').html(modalContent);
        });

}


//Logik des createProduct-Fensters
function createProduct(event) {
    event ? event.preventDefault() : false;
    data = {
        productTitle: $('#newProductForm input[name=productTitle]').val(),
        productPrice: $('#newProductForm input[name=productPrice]').val(),
        taxRate: $('#newProductForm input[type=radio]:checked').val(),
        productDescription: $('#newProductForm textarea').val(),
        action: 'createProduct'
    };

    let response = makeAjaxRequest(data);
    response
        .then(function (result) {
            $('#toast p').text('Produkt erfolgreich angelegt.');
            $('#toast #confirmButton').on('click', hideSubForm).text('Okay');
            $('#toast #cancelButton').css('display', 'none');
            $('#toast').css('display', 'flex');
        })
        .catch(function (result) {
            $('#toast p').text('Da ist etwas schief gelaufen!');
            $('#toast #confirmButton').on('click', createProduct).text('Erneut versuchen');
            $('#toast #cancelButton').css('display', 'block');
            $('#toast').css('display', 'flex');

            $('#toast #cancelButton').on('click', function () {
                $('#toast').css('display', 'none')
            });
        });

}
function updateProduct(event) {
    event ? event.preventDefault() : false;
    data = {
        productId: $('#newProductForm input[name=id]').val(),
        productTitle: $('#newProductForm input[name=productTitle]').val(),
        productPrice: $('#newProductForm input[name=productPrice]').val(),
        taxRate: $('#newProductForm input[type=radio]:checked').val(),
        productDescription: $('#newProductForm textarea').val(),
        action: 'updateProduct'
    };

    let response = makeAjaxRequest(data);
    response
        .then(function (result) {
            $('#toast p').text('Produkt erfolgreich bearbeitet.');
            $('#toast #confirmButton').on('click', hideSubForm).text('Okay');
            $('#toast #cancelButton').css('display', 'none');
            $('#toast').css('display', 'flex');
        })
        .catch(function (result) {
            $('#toast p').text('Da ist etwas schief gelaufen!');
            $('#toast #confirmButton').on('click', createProduct).text('Erneut versuchen');
            $('#toast #cancelButton').css('display', 'block');
            $('#toast').css('display', 'flex');

            $('#toast #cancelButton').on('click', function () {
                $('#toast').css('display', 'none')
            });
        });

}

function netPriceInfo() {
    $('#toast p').text('Ist dir nur der Brutto-Preis bekannst, kannst du diesen eingeben und den Netto-Preis abhängig von der Mehrwertsteuer berechnen lassen. Wähle dafür einen Mehrwertsteuersatz aus und klicke "berechnen".');
    $('#toast #confirmButton').on('click', function () { $('#toast').css('display', 'none') }).text('Okay');
    $('#toast #cancelButton').css('display', 'none');
    $('#toast').css('display', 'flex');
}

function fullfillmentDateInfo() {
    $('#toastMain p').html(
        `<p>In jeder Rechnung muss ein konkretes Lieferdatum oder ein Lieferzeitraum angegeben werden. Wählst du kein Datum aus, wird dieses
        automatisch auf den aktuellen Tag gesetzt.</p>Gibt es ein konkretes Lieferdatum, wähle das Datum im linken Feld aus. 
        Um einen Lieferzeitraum anzugeben, lege links das Start- und rechts das Enddatum fest.<p>Willst du einem Produkt ein Datum zuweisen, 
        ist das über das Kommentarfeld des jeweiligen Produkts möglich.</p>`);
    $('#toastMain #confirmButton').on('click', function () { $('#toastMain').css('display', 'none') }).text('Okay');
    $('#toastMain #cancelButton').css('display', 'none');
    $('#toastMain').css('display', 'flex');
}

function netPriceCalculator() {
    let grossPrice = $('#productPrice').val();
    let taxRate = $('input[name=taxRate]:checked').val()
    switch (taxRate) {
        case '0':
            break;

        case '7':
            $('#productPrice').val((grossPrice / 1.07).toFixed(2));
            break;

        case '19':
            $('#productPrice').val((grossPrice / 1.19).toFixed(2));
            break;
    };

}

//Erzeugt die Rechnung
function createInvoice(event) {
    event.preventDefault();
    let invoiceData = preprocessFormData($('#invoiceForm').serializeArray());
    data = {
        action: 'createInvoice',
        invoiceData
    };

    let response = makeAjaxRequest(data);
    response
        .then(function (result) {
            if (result.data == 'salesTaxId not set') {

                let toastText = `Bei Rechnungen mit Umkehr der Umsatzsteuerschuld (Reverse Charge) muss zwingend die Umsatzsteuernummer
            des Empfängers angegeben werden. Beim gewählten Kunden ist diese nicht hinterlegt.<p>Sobald die Nummer hinterlegt ist, kann
            die Rechnung gespeichert werden. Bearbeite dafür die Information des gewählten Kunden.</p>`;

                $('#toastMain p').html(toastText);
                $('#toastMain #confirmButton').off('click').on('click', function () { $('#toastMain').css('display', 'none') }).text('Okay');
                // TODO: Link für Window.open anpassen, sodass die Kundenübersicht geöffnet wird
                $('#toastMain #cancelButton').off('click').on('click', () => window.open('costumers.php')).css('display', 'block').text('Kunden bearbeiten');
                $('#toastMain').css('display', 'flex');

                return;
            }

            $('#toastMain p').text('Rechnung erfolgreich angelegt.');
            $('#toastMain #confirmButton').off('click').on('click', function () { $('#toastMain').css('display', 'none') }).text('Okay');
            $('#toastMain #cancelButton').css('display', 'none');
            $('#toastMain').css('display', 'flex');
        })
        .catch(function (result) {
            $('#toastMain p').text('Da ist etwas schief gelaufen!');
            $('#toastMain #confirmButton').off('click').on('click', function () { createInvoice(event) }).text('Erneut versuchen');
            $('#toastMain #cancelButton').css('display', 'block');
            $('#toastMain').css('display', 'flex');

            $('#toastMain #cancelButton').on('click', function () { $('#toastMain').css('display', 'none') });
        });

}

function preprocessFormData(formData) {
    let processedData = {};
    for (let i = 0; i < formData.length; i++) {
        let key = formData[i]['name'];
        let value = formData[i]['value'];
        processedData[key] = value;
    }
    return processedData;
}


//Öffnen und Schließen der newCostumer und newProduct-Formulare
function showSubForm(requestedForm) {

    switch (requestedForm) {
        case 'createCostumer':
            $('#subFormWrapper').html(forms.createCostumer.content).removeClass('hidden');
            break;
        case 'createProduct':
            $('#subFormWrapper').html(forms.createProduct.content).removeClass('hidden');
            break;
    }
}


function hideSubForm() {
    $('#subFormWrapper').html('').addClass('hidden');
    $('#editFormWrapper').addClass('hidden');
    $('#toast').css('display', 'none');
}

$('#startDate').ready(() => {
    $('#startDate').val('' + date.getFullYear() + '-' + (date.getMonth() + 1).toString().padStart(2, '0') + '-' + date.getDate().toString().padStart(2, '0'));
});


function getModalContent(action, state, id = '') {
    //die funktion, die den Toast erzeugen soll
    let confirmButtonStyle;
    let cancelButtonStyle;
    let confirmButtonAction;
    let cancelButtonAction;
    let confirmButtonText;
    let cancelButtonText;
    let modalMessage;

    let message = {
        success: {
            createInvoice: 'Die Rechnung wurde erfolgreich erstellt.',
            createCostumer: 'Der Kunde wurde erfolgreich angelegt.',
            createProduct: 'Das Produkt wurde erfolgreich angelegt.',
            updateCostumer: 'Der Kunde wurde erfolgreich aktualisiert.',
            updateProduct: 'Das Produkt wurde erfolgreich aktualisiert.',
            deleteCostumer: 'Der Kunde wurde erfolgreich gelöscht.',
            deleteProduct: 'Das Produkt wurde erfolgreich gelöscht.'
        },
        failed: "Da ist etwas schief gelaufen :-*!",
        requireConfirm: {
            deleteCostumer: `Willst du den Kunden ${id} unwiderruflich löschen?`,
            deleteProduct: `Willst du das Produkt ${id} unwiderruflich löschen?`
        }
    }

    let button = {
        confirmButton: {
            success: {
                text: 'Okay',
                css: 'block',
                onclick: 'closeModal(true)'
            },
            failed: {
                text: 'Erneut versuchen',
                css: 'block',
                onclick: {
                    createInvoice: 'createInvoice()',
                    createCostumer: 'createCostumer()',
                    createProduct: 'createProduct()',
                    prefillCostumerForm: 'prefillCostumerForm()',
                    prefillProductForm: 'prefillProductForm()',
                    updateCostumer: 'updateCostumer()',
                    updateProduct: 'updateProduct()',
                    deleteCostumer: 'deleteCostumer()',
                    deleteProduct: 'deleteProduct()'
                }
            },
            requireConfirm: {
                text: {
                    deleteCostumer: 'Löschen',
                    deleteProduct: 'Löschen'
                },
                css: 'block',
                onclick: {
                    deleteCostumer: `deleteCostumer(${id})`,
                    deleteProduct: `deleteProduct(${id})`
                }
            },
        },
        cancelButton: {
            success: {
                text: '',
                onclick: '',
                css: 'none'
            },
            failed: {
                text: 'Abbrechen',
                css: 'block',
                onclick: 'closeModal(false)'
            },
            requireConfirm: {
                text: 'Abbrechen',
                css: 'block',
                onclick: 'closeModal(false)'
            }
        }
    }


    if (state == 'success') {
        modalMessage = message.success[action];

        confirmButtonText = button.confirmButton.success.text;
        confirmButtonStyle = button.confirmButton.success.css;
        confirmButtonAction = button.confirmButton.success.onclick;

        cancelButtonText = button.cancelButton.success.text;
        cancelButtonStyle = button.cancelButton.success.css;
        cancelButtonAction = button.cancelButton.success.onclick;
    }
    else if (state == 'failed') {
        modalMessage = message.failed;

        confirmButtonText = button.confirmButton.failed.text;
        confirmButtonStyle = button.confirmButton.failed.css;
        confirmButtonAction = button.confirmButton.failed.onclick[action];

        cancelButtonText = button.cancelButton.failed.text;
        cancelButtonStyle = button.cancelButton.failed.css;
        cancelButtonAction = button.cancelButton.failed.onclick;
    }
    else if (state == 'requireConfirm') {
        modalMessage = message.requireConfirm[action];

        confirmButtonText = button.confirmButton.requireConfirm.text[action];
        confirmButtonStyle = button.confirmButton.requireConfirm.css;
        confirmButtonAction = button.confirmButton.requireConfirm.onclick[action];

        cancelButtonText = button.cancelButton.requireConfirm.text;
        cancelButtonStyle = button.cancelButton.requireConfirm.css;
        cancelButtonAction = button.cancelButton.requireConfirm.onclick;
    }

    let modalHTML = `
            <div style="display: flex; flex-direction: column; align-items: center;">
            <p>${modalMessage}</p>
            <div id="toastButtonWrapper" style="display: flex; gap: 1em;">
                <button id="confirmButton" style="display: ${confirmButtonStyle}" onclick="${confirmButtonAction}">${confirmButtonText}</button>
                <button id="cancelButton" style="display: ${cancelButtonStyle}" onclick="${cancelButtonAction}">${cancelButtonText}</button>
            </div>
            </div>
    `;

    return modalHTML;
}


function closeModal(closeAll) {

    if (closeAll) {
        $('#modal').addClass('hidden').html('');
        $('#subFormWrapper').addClass('hidden').html('');
        $('#editFormWrapper').addClass('hidden');

        //resendData speichert die Daten eines Ajax-Calls auf product und costumerOverview, um sie wiederzuverwenden,
        //wenn Ajax fehlschlägt und wiederholt werden soll
        //wird ein Modal über Abbrechen oder Okay geschlossen, weil Ajax erfolgreich, werden die Daten hier geleert.
        resendData = ''; 
    } else {
        $('#modal').addClass('hidden').html('');
        resendData = '';
    }
}