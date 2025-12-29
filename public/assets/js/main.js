        document.addEventListener('DOMContentLoaded', function() {
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
            
            setRole(savedRole);
            
            loginTab.addEventListener('click', function(e) {
                e.preventDefault();
                showLoginForm();
                saveTabState('login');
            });
            
            registerTab.addEventListener('click', function(e) {
                e.preventDefault();
                showRegisterForm();
                saveTabState('register');
            });
            
            switchToRegister.addEventListener('click', function(e) {
                e.preventDefault();
                showRegisterForm();
                saveTabState('register');
            });
            
            document.getElementById('registerFormContent').addEventListener('submit', function(e) {
                e.preventDefault();
                
                let formData = {
                    fullName: this.querySelector('input[placeholder="e.g. John Doe"]').value,
                    email: this.querySelector('input[type="email"]').value,
                    password: this.querySelector('input[type="password"]').value,
                    role: selectedRoleInput.value
                };
                
                alert(`Registration submitted!\n\nFull Name: ${formData.fullName}\nEmail: ${formData.email}\nRole: ${formData.role}\n\n(This is a demo)`);
                
                console.log('Registration data:', formData);
            });
            
            document.getElementById('loginFormContent').addEventListener('submit', function(e) {
                e.preventDefault();
                
                let formData = {
                    email: this.querySelector('input[type="email"]').value,
                    password: this.querySelector('input[type="password"]').value,
                    rememberMe: this.querySelector('#rememberMe').checked
                };
                
                alert(`Login submitted!\n\nEmail: ${formData.email}\nRemember me: ${formData.rememberMe ? 'Yes' : 'No'}\n\n(This is a demo)`);
                
                console.log('Login data:', formData);
            });
            
            document.querySelectorAll('.input-group button').forEach(button => {
                button.addEventListener('click', function() {
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
                chip.addEventListener('click', function() {
                    let role = this.getAttribute('data-role');
                    
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
            
            function saveTabState(tab) {
                localStorage.setItem('selectedTab', tab);
            }
            
            function setRole(role) {
                let chip = document.querySelector(`.chip-select[data-role="${role}"]`);
                if (chip) {
                    document.querySelectorAll('.chip-select').forEach(c => {
                        c.classList.remove('active');
                    });
                    
                    chip.classList.add('active');
                    
                    let radioInput = chip.querySelector('input[type="radio"]');
                    if (radioInput) {
                        radioInput.checked = true;
                    }
                    
                    selectedRoleInput.value = role;
                }
            }
            
            console.log(`Current selected role: ${selectedRoleInput.value}`);
        });
