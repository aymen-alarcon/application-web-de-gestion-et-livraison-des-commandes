if (window.location.href.includes("index.php")) {
    document.addEventListener('DOMContentLoaded', function () {
        let loginTab = document.getElementById('loginTab');
        let registerTab = document.getElementById('registerTab');
        let loginForm = document.getElementById('loginForm');
        let registerForm = document.getElementById('registerForm');
        let switchToRegister = document.getElementById('switchToRegister');
        let selectedRoleInput = document.getElementById('selectedRole');

        let savedTab = localStorage.getItem('selectedTab') || 'register';
        let savedRole = localStorage.getItem('selectedRole') || 'client';

        if (savedTab === 'login') {
            showLoginForm();
        } else {
            showRegisterForm();
        }

        loginTab.addEventListener('click', function (e) {
            e.preventDefault();
            showLoginForm();
            saveTabState('login');
        });

        registerTab.addEventListener('click', function (e) {
            e.preventDefault();
            showRegisterForm();
            saveTabState('register');
        });

        switchToRegister.addEventListener('click', function (e) {
            e.preventDefault();
            showRegisterForm();
            saveTabState('register');
        });

        document.querySelectorAll('.input-group button').forEach(button => {
            button.addEventListener('click', function () {
                let input = this.parentElement.querySelector('input');
                let icon = this.querySelector('.bi-eye-slash');

                if (input.type === 'password') {
                    input.type = 'text';
                    icon.innerHtml = '<i class="bi bi-eye"></i>';
                } else {
                    input.type = 'password';
                    icon.innerHtml = '<i class="bi bi-eye-slash"></i>';
                }
            });
        });

        document.querySelectorAll('.chip-select').forEach(chip => {
            chip.addEventListener('click', function () {

                document.querySelectorAll('.chip-select').forEach(c => {
                    c.classList.remove('active');
                });

                this.classList.add('active');

                let radioInput = this.querySelector('input[type="radio"]');
                if (radioInput) {
                    radioInput.checked = true;
                }
            });
        });

        function showLoginForm() {
            loginForm.classList.remove('hidden');
            registerForm.classList.add('hidden');
            loginTab.classList.add('active');
            registerTab.classList.remove('active');
        }

        function showRegisterForm() {
            registerForm.classList.remove('hidden');
            loginForm.classList.add('hidden');
            registerTab.classList.add('active');
            loginTab.classList.remove('active');
        }
    }
)}

if (window.location.href.includes("client_add_package.php")) {
    document.querySelector(".add-product").addEventListener("click", () => {
        let container = document.getElementById("itemsContainer");
        container.innerHTML += `
              <div class="row g-3">
                <div class="col-md-6">
                  <label class="form-label text-white">What do you want?</label>
                  <input type="text" class="form-control bg-black text-white" name="product[]" placeholder="e.g. Apples">
                </div>
                <div class="col-md-6">
                  <label class="form-label text-white">Quantity</label>
                  <input type="number" class="form-control bg-black text-white" name="quantity[]" placeholder="e.g. 2">
                </div>
                <div class="col-md-6">
                  <label class="form-label text-white">Price</label>
                  <input type="number" class="form-control bg-black text-white" name="price[]" placeholder="e.g. 2">
                </div>
              </div>
        `;
    })
}

if (window.location.href.includes("client_order_dashboard.php")) {
    let buttons = document.querySelectorAll(".btn.btn-outline-secondary.rounded-pill");
    let badges = document.querySelectorAll(".badge");

    buttons.forEach(btn => {
        btn.addEventListener('click', () => {
            buttons.forEach(btns => {
                btns.classList.remove("btn-primary");
                btns.classList.remove("text-white");
            })

            badges.forEach(badge => {
                if (btn.innerHTML === "All Orders") {
                    badge.parentElement.parentElement.classList.remove("d-none");
                } else if (badge.innerHTML === btn.innerHTML) {
                    badge.parentElement.parentElement.classList.remove("d-none");
                } else {
                    badge.parentElement.parentElement.classList.add("d-none");
                }
            })

            btn.classList.add("btn-primary");
            btn.classList.add("text-white");
        })
    })

    document.querySelectorAll(".edit-btn").forEach(btn => {
        btn.addEventListener("click", () => {
            document.getElementById("edit-id").value = btn.dataset.id;
            document.getElementById("edit-title").value = btn.dataset.title;
            document.getElementById("edit-address").value = btn.dataset.address;
            document.getElementById("edit-phone").value = btn.dataset.phone;
        });
    });
}

if (window.location.href.includes("client_order.php")) {
    document.addEventListener('DOMContentLoaded', function () {
        let price = 0;
        let productsPrice = document.querySelectorAll(".totalPrice")
        productsPrice.forEach(productPrice => {
            price += Number(productPrice.textContent);
        });
        document.querySelector(".Subtotal").textContent = "$" + price;

        let totalPrice = price + 5
        document.querySelector(".finalPrice").textContent = "$" + totalPrice
    })
}

if (window.location.href.includes("client_update_commande.php")) {
    function format(num) {
        return "$" + num.toFixed(2);
    }

    function recalcRow(row) {
        var price = parseFloat(row.querySelector(".unit-price").value) || 0;
        var qty = parseInt(row.querySelector(".qty").value) || 0;
        var subtotal = price * qty;

        row.querySelector(".subtotal").textContent = format(subtotal);
        recalcTotal();
    }

    function recalcTotal() {
        var totals = document.querySelectorAll(".subtotal");
        var sum = 0;

        for (var i = 0; i < totals.length; i++) {
            var value = totals[i].textContent.replace("$", "");
            sum += parseFloat(value) || 0;
        }

        document.getElementById("orderTotal").textContent = format(sum);
    }

    document.getElementById("productsTable").onclick = function (e) {
        var row = e.target.closest("tr");
        if (!row) return;

        if (e.target.classList.contains("qty-plus")) {
            var input = row.querySelector(".qty");
            var value = parseInt(input.value) || 0;
            input.value = value + 1;
            recalcRow(row);
        }

        if (e.target.classList.contains("qty-minus")) {
            var input = row.querySelector(".qty");
            var value = parseInt(input.value) || 0;
            if (value > 1) input.value = value - 1;
            recalcRow(row);
        }

        if (e.target.classList.contains("delete-row")) {
            row.parentNode.removeChild(row);
            recalcTotal();
        }
    };

    document.getElementById("productsTable").oninput = function (e) {
        var row = e.target.closest("tr");

        if (!row) return;

        if (
            e.target.classList.contains("unit-price") ||
            e.target.classList.contains("qty")
        ) {
            recalcRow(row);
        }
    };

    recalcTotal();
}

if (window.location.href.includes("deliverer_order_interaction.php")) {
    document.querySelectorAll('.vehicle-option').forEach(option => {
        option.addEventListener('click', () => {
            document.querySelectorAll('.vehicle-option').forEach(o => o.classList.remove('checked'));
            option.classList.add('checked');
            option.querySelector('input').checked = true;
        });
    });
}

if (window.location.href.includes("admin_orders_management.php")) {
    document.querySelectorAll('.edit-commande-btn').forEach(button => {
        button.addEventListener('click', function () {
            document.getElementById('commande_ref').value = this.dataset.id;
            document.getElementById('address').value = this.dataset.addresses;
            document.getElementById('commande_status').value = this.dataset.status;
            document.getElementById('title').value = this.dataset.titles;
            document.getElementById('phone').value = this.dataset.phones;
        });
    });
}

if (window.location.href.includes("admin_offers_management.php")) {
    document.querySelectorAll('.edit-btn').forEach(button => {
        button.addEventListener('click', function () {
            document.getElementById('offer_id').value = this.dataset.offerId;
            document.getElementById('commande_id').value = this.dataset.commandeId;
            document.getElementById('deliverer').value = this.dataset.deliverer;
            document.getElementById('status').value = this.dataset.status;
            document.getElementById('vehicle').value = this.dataset.vehicle;
            document.getElementById('price').value = this.dataset.price;
        });
    });
}

if (window.location.href.includes("admin_admins_management.php" || "admin_client_management.php" || "admin_deliverer_management.php")) {
    document.querySelectorAll('.edit-user-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            document.getElementById('user_id').value = this.dataset.id;
            document.getElementById('username').value = this.dataset.username;
            document.getElementById('first_name').value = this.dataset.firstName;
            document.getElementById('last_name').value = this.dataset.lastName;
            document.getElementById('email').value = this.dataset.email;
        });
    });
}