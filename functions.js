let productCount = 0;

function addProduct(){
    //event.preventDefault;
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
    
    productContainer.insertAdjacentHTML("beforeend", productSelectorNew);
}