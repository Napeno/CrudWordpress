let arrow = document.querySelectorAll(".arrow");
for (var i = 0; i < arrow.length; i++) {
  arrow[i].addEventListener("click", (e)=>{
 let arrowParent = e.target.parentElement.parentElement;//selecting main parent of arrow
 arrowParent.classList.toggle("showMenu");
  });
}

let sidebar = document.querySelector(".sidebar");
let sidebarBtn = document.querySelector(".bx-menu");
console.log(sidebarBtn);
sidebarBtn.addEventListener("click", ()=>{
  sidebar.classList.toggle("close");
});

// <!-- Ajax add product -->

document.getElementById('addForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent the default form submission

    const formData = new FormData(this);

    fetch('create.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        document.getElementById('response').innerHTML = data;
        document.getElementById("addForm").reset();
        document.getElementById("response").style.display = "block";
        document.getElementById("imgres1").style.display = "block";
    })
    .catch(error => {
        document.getElementById('response').innerHTML = 'Error: ' + error;
    });
});


// <!-- Ajax for Delete Product -->

    document.getElementById('deleteBtn').addEventListener('click', function(event) {
        const form = document.getElementById('deleteForm');
        const formData = new FormData(form);

        fetch('delete.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            document.getElementById('responseDelete').innerHTML = data;
            document.getElementById("deleteForm").reset();
            document.getElementById("responseDelete").style.display = "block";
            document.getElementById("imgres2").style.display = "block";
        })
        .catch(error => {
            document.getElementById('responseDelete').innerHTML = 'Error: ' + error;
        });
    });


//  <!-- Ajax for Update Product -->

    document.getElementById('updateBtn').addEventListener('click', function(event) {
        const form = document.getElementById('updateForm');
        const formData = new FormData(form);
        fetch('update.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            document.getElementById('responseUpdate').innerHTML = data;
            document.getElementById("updateForm").reset();
            document.getElementById("responseUpdate").style.display = "block";
            document.getElementById("imgres3").style.display = "block";
        })
        .catch(error => {
            document.getElementById('responseUpdate').innerHTML = 'Error: ' + error;
        });
    });


// <!-- Ajax for Retrieve Product -->

    document.addEventListener('DOMContentLoaded', function() {
        retrieveProducts();
    });

    function retrieveProducts() {
        fetch('retrive.php', {
            method: 'POST'
        })
        .then(response => response.json())
        .then(data => {
            const productTableBody = document.getElementById('productTableBody');
            productTableBody.innerHTML = ''; // Clear existing rows

            data.forEach(product => {
                const row = `
                    <tr class='table-content'>
                        <td>${product.id}</td>
                        <td>${product.name}</td>
                        <td>${product.price}</td>
                    </tr>
                `;
                productTableBody.innerHTML += row;
            });
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }


// <!-- Ajax add voucher -->

    document.getElementById('addFormvoucher').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent the default form submission

        const formData = new FormData(this);

        fetch('Voucher_create.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            document.getElementById('responseV').innerHTML = data;
            document.getElementById("addFormvoucher").reset();
            document.getElementById("responseV").style.display = "block";
            document.getElementById("imgres4").style.display = "block";
        })
        .catch(error => {
            document.getElementById('responseV').innerHTML = 'Error: ' + error;
        });
    });
   

// <!-- Ajax for Delete Voucher -->

    document.getElementById('deleteBtnV').addEventListener('click', function(event) {
        const form = document.getElementById('deleteFormV');
        const formData = new FormData(form);

        fetch('Voucher_delete.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            document.getElementById('responseDeleteV').innerHTML = data;
            document.getElementById("deleteFormV").reset();
            document.getElementById("responseDeleteV").style.display = "block";
            document.getElementById("imgres5").style.display = "block";
        })
        .catch(error => {
            document.getElementById('responseDeleteV').innerHTML = 'Error: ' + error;
        });
    });


//  <!-- Ajax for Update Voucher -->
 
    document.getElementById('updateBtnV').addEventListener('click', function(event) {
        const form = document.getElementById('updateFormV');
        const formData = new FormData(form);
        fetch('Voucher_update.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            document.getElementById('responseUpdateV').innerHTML = data;
            document.getElementById("updateFormV").reset();
            document.getElementById("responseUpdateV").style.display = "block";
            document.getElementById("imgres6").style.display = "block";
        })
        .catch(error => {
            document.getElementById('responseUpdateV').innerHTML = 'Error: ' + error;
        });
    });


// <!-- Ajax for Retrieve Voucher -->

    document.addEventListener('DOMContentLoaded', function() {
        retrieveVouchers();
    });

    function retrieveVouchers() {
        fetch('Voucher_read.php')
        .then(response => response.json())
        .then(data => {
            const vouchersDiv = document.getElementById('voucherTableBody');
            vouchersDiv.innerHTML = ''; // Clear existing content
            
            data.forEach(voucher => {
                const rows = `
                    <tr>
                        <td>${voucher.id}</td>
                        <td>${voucher.code}</td>
                        <td>${voucher.amount}</td>
                        <td>${voucher.expiry_date}</td>
                    </tr>
                `;
                vouchersDiv.innerHTML += rows;
            });
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }


// <!-- Ajax for Add Variation Products -->

    document.getElementById('num_variations').addEventListener('change', function() {
        const numVariations = this.value;
        const variationsContainer = document.getElementById('variationsContainer');
        variationsContainer.innerHTML = '';
        for (let i = 0; i < numVariations; i++) {
            variationsContainer.innerHTML += `
                <h3>Variation ${i + 1}</h3>
                <div class="form-group">
                    <div class='row'>
                        <label for="regular_price_${i}">Regular Price:</label>
                        <input type="text" id="regular_price_${i}" name="regular_price_${i}" required>
                    </div>                    
                </div>
                <div class="form-group">
                    <div class='row'>
                        <label for="size_${i}">Size:</label>
                    <input type="text" id="size_${i}" name="size_${i}" required>
                    </div>
    
                    
                </div>
                <div class="form-group">
                    <div class='row'>
                        <label for="color_${i}">Color:</label>
                    <input type="text" id="color_${i}" name="color_${i}" required>
                    </div>
    
                    
                </div>
                <div class="form-group">
                    <div class='row'>
                        <label for="stock_quantity_${i}">Stock Quantity:</label>
                    <input type="text" id="stock_quantity_${i}" name="stock_quantity_${i}" required>
                    </div>
    
                    
                </div>
            `;
        }
    });

    document.getElementById('variationForm').addEventListener('submit', function(event) {
        event.preventDefault();

        const formData = new FormData(this);

        fetch('create_pro_w_variation.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            document.getElementById('responseVariation').innerHTML = data;
            document.getElementById("variationForm").reset();
            document.getElementById("responseVariation").style.display = "block";
            document.getElementById("imgres7").style.display = "block";
        })
        .catch(error => {
            document.getElementById('responseVariation').innerHTML = 'Error: ' + error;
        });
    });


// <!-- Ajax for Retrieve Variation Products -->

    document.addEventListener('DOMContentLoaded', function() {
        fetchProducts();
    });

    function fetchProducts() {
        fetch('retrive_variation.php')
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                console.error('Error:', data.error);
                return;
            }

            const tableBody = document.getElementById('productsVTableBody');
            tableBody.innerHTML = '';

            data.forEach(product => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${product.name}</td>
                    <td>${product.id}</td>
                    <td>${product.type}</td>
                    <td>${product.type === 'variable' ? getVariationsHtml(product.variations) : 'N/A'}</td>
                `;
                tableBody.appendChild(row);
            });
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

    function getVariationsHtml(variations) {
        if (!variations.length) return 'No variations available';

        return `<ul>${variations.map(variation => `
            <li>${variation.attributes.join(', ')}, Stock: ${variation.stock_quantity}</li>
        `).join('')}</ul>`;
    }

// <!-- Ajax for Delete Products Automate-->

document.getElementById('deleteAuForm').addEventListener('submit', function(event) {
    event.preventDefault();

    const formData = new FormData(this);

    fetch('DieuKien_delete.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        document.getElementById('deleteResult').innerHTML = data;
        document.getElementById('deleteResult').style.display = 'block';
        document.getElementById('imgres7').style.display = 'block';
    })
    .catch(error => {
        document.getElementById('responseVariation').innerHTML = 'Error: ' + error;
    });
});

document.getElementById('updateAuForm').addEventListener('submit', function(event) {
    event.preventDefault();

    const formData = new FormData(this);

    fetch('DieuKien_update.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        document.getElementById('updateResult').innerHTML = data;
        document.getElementById('updateResult').style.display = 'block';
    })
    .catch(error => {
        document.getElementById('updateResult').innerHTML = 'Error: ' + error;
    });
});
    

    function openCity(evt, cityName) {
      var i, tabcontent, tablinks;
      tabcontent = document.getElementsByClassName("tabcontent");
      for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
      }
      tablinks = document.getElementsByClassName("tablinks");
      for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
      }
      document.getElementById(cityName).style.display = "block";
      evt.currentTarget.className += " active";
    }

