<!DOCTYPE html>
<html lang="en" class="dark">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login / Registration - DeliveryConnect</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;900&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: "Inter", sans-serif;
            background: #101922;
            color: #fff;
            min-height: 100vh;
        }

        .chip-select {
            border: 1px solid #283039;
            border-radius: 1rem;
            background: #0d141c;
            transition: 0.2s;
            cursor: pointer;
            text-align: center;
        }

        .chip-select input {
            display: none;
        }

        .chip-select.active,
        .chip-select:hover {
            border: 2px solid #137fec;
            background: rgba(19, 127, 236, 0.08);
            color: #137fec;
            font-weight: 600;
        }

        .nav-chip-select {
            border: 1px solid #283039;
            border-radius: 0.75rem;
            background: #0d141c;
            transition: 0.2s;
            cursor: pointer;
            text-decoration: none !important;
            color: #6c757d !important;
            padding: 0.75rem 1.5rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-right: 0.5rem;
        }

        .nav-chip-select.active,
        .nav-chip-select:hover {
            border: 2px solid #137fec;
            background: rgba(19, 127, 236, 0.08);
            color: #137fec !important;
            font-weight: 600;
        }

        .form-control,
        .form-select {
            border: 1px solid #283039;
        }

        .form-control:focus {
            border-color: #137fec;
            box-shadow: 0 0 0 0.2rem rgba(19, 127, 236, 0.25);
            background: #0d141c;
            color: #fff;
        }

        .form-control::placeholder{
            color: lightgoldenrodyellow;
        }

        .hidden {
            display: none !important;
        }
    </style>
</head>

<body class="d-flex flex-column">
    <header class="w-100 py-3 px-4 px-lg-5 position-fixed"
        style="background: rgba(26, 34, 45, 0.5);backdrop-filter: blur(6px);border-color: #283039;">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center gap-3">
                <div class="text-primary">
                    <svg width="32" height="32" viewBox="0 0 48 48" fill="currentColor">
                        <path
                            d="M36.7273 44C33.9891 44 31.6043 39.8386 30.3636 33.69C29.123 39.8386 26.7382 44 24 44C21.2618 44 18.877 39.8386 17.6364 33.69C16.3957 39.8386 14.0109 44 11.2727 44C7.25611 44 4 35.0457 4 24C4 12.9543 7.25611 4 11.2727 4C14.0109 4 16.3957 8.16144 17.6364 14.31C18.877 8.16144 21.2618 4 24 4C26.7382 4 29.123 8.16144 30.3636 14.31C31.6043 8.16144 33.9891 4 36.7273 4C40.7439 4 44 12.9543 44 24C44 35.0457 40.7439 44 36.7273 44Z" />
                    </svg>
                </div>
                <h2 class="fw-bold mb-0">DeliveryConnect</h2>
            </div>
        </div>
    </header>

    <main class="flex-grow-1 d-flex align-items-center justify-content-center px-3 py-5 mt-4">
        <div class="row g-0 surface shadow-lg overflow-hidden">
            <div class="col-md-5 d-none d-md-flex flex-column justify-content-end p-4"
                style="background: url('https://lh3.googleusercontent.com/aida-public/AB6AXuDjSLaF-jxBKraNgiZeHnZYWITG_g3aIyU_RE_PLubYRF8hcm_2xItxnxmYV7Vd0oegNntjGDXUtBWBq110GF3FAPKbxoKumtFX30xEawIwws4peem7on3kz-N8L3P-nbFRrFQDNJuWJHKA3q9xOubBQeFwAPaGjfJICoxgKM91NSifEfM0vtt7vlmd6lh2pNdv08Hjb3JEq66BThulLjmZ0j1FgFIlvBZ5lPGkE7dPg01xn2r3Joepk5-YlXSPUP7B1-NckXMogWQ')     center/cover no-repeat; ">
                <div class="bg-dark bg-opacity-75 p-4 rounded-3">
                    <div class="mb-3 d-inline-flex align-items-center justify-content-center rounded-3 p-2 border border-primary text-primary">
                        <i class="bi bi-truck"></i>
                    </div>
                    <h1 class="fw-black fs-3 mb-2">
                        Deliver faster,<br />manage better.
                    </h1>
                    <p class="text-secondary-custom">
                        Join thousands of clients and deliverers managing logistics
                        efficiently on our platform.
                    </p>
                </div>
            </div>

            <div class="col-md-7 p-4 p-lg-5 d-flex flex-column">
                <div class="mb-4">
                    <div class="d-flex">
                        <a href="#" class="nav-chip-select" id="loginTab">
                            Login
                        </a>
                        <a href="#" class="nav-chip-select active" id="registerTab">
                            Register
                        </a>
                    </div>
                </div>

                <div id="registerForm">
                    <h2 class="fw-bold mb-1">Create an account</h2>
                    <p class="text-secondary-custom mb-4">
                        Choose your role and start your journey.
                    </p>

                    <div class="d-flex flex-column flex-sm-row gap-2 mb-3">
                        <label class="chip-select d-flex align-items-center justify-content-center py-2 px-3 flex-fill" data-role="client">
                            <input type="radio" name="role" value="client" checked />
                            <span class="d-flex align-items-center gap-2">
                                <i class="bi bi-person"></i>
                                I am a Client
                            </span>
                        </label>

                        <label class="chip-select d-flex align-items-center justify-content-center py-2 px-3 flex-fill" data-role="deliverer">
                            <input type="radio" name="role" value="deliverer" />
                            <span class="d-flex align-items-center gap-2">
                                <i class="bi bi-truck"></i>
                                I am a Deliverer
                            </span>
                        </label>

                        <label class="chip-select d-flex align-items-center justify-content-center py-2 px-3 flex-fill" data-role="admin">
                            <input type="radio" name="role" value="admin" />
                            <span class="d-flex align-items-center gap-2">
                                <i class="bi bi-shield"></i>
                                I am an Admin
                            </span>
                        </label>
                    </div>

                    <input type="hidden" id="selectedRole" name="selectedRole" value="client">

                    <form class="d-flex flex-column gap-4" id="registerFormContent">
                        <div class="d-flex flex-column gap-3">
                            <label class="small text-secondary-custom fw-bold text-uppercase">first Name</label>
                            <div class="input-group">
                                <input class="form-control border-0 p-3 bg-dark text-white" placeholder="e.g. John Doe" required />
                            </div>
                        </div>

                        <div class="d-flex flex-column gap-3">
                            <label class="small text-secondary-custom fw-bold text-uppercase">first Name</label>
                            <div class="input-group">
                                <input class="form-control border-0 p-3 bg-dark text-white" placeholder="e.g. John Doe" required />
                            </div>
                        </div>

                        <div class="d-flex flex-column gap-3">
                            <label class="small text-secondary-custom fw-bold text-uppercase">Email Address</label>
                            <div class="input-group">
                                <input type="email" class="form-control border-0 p-3 bg-dark text-white" placeholder="name@company.com" required />
                            </div>
                        </div>

                        <div class="d-flex flex-column gap-3">
                            <label class="small text-secondary-custom fw-bold text-uppercase">Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control border-0 p-3 bg-dark text-white" placeholder="Min. 8 characters" required />
                                <button class="btn text-white border-0 d-flex align-items-center" type="button">
                                    <i class="bi bi-eye-slash"></i>
                                </button>
                            </div>
                        </div>
                        <button class="btn btn-primary fw-bold py-2 mt-2" type="submit">
                            Create Account
                        </button>
                    </form>
                </div>

                <div id="loginForm" class="hidden">
                    <h2 class="fw-bold mb-1">Welcome back</h2>
                    <p class="text-secondary-custom mb-4">
                        Sign in to your account to continue.
                    </p>
                    <form class="d-flex flex-column gap-4" id="loginFormContent">
                        <div class="d-flex flex-column gap-3">
                            <label class="small text-secondary-custom fw-bold text-uppercase">Email Address</label>
                            <div class="input-group">
                                <input type="email" class="form-control border-0 p-3 bg-dark text-white" placeholder="name@company.com" required />
                            </div>
                        </div>
                        <div class="d-flex flex-column gap-3">
                            <label class="small text-secondary-custom fw-bold text-uppercase">Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control border-0 p-3 bg-dark text-white" placeholder="Enter your password" required />
                                <button class="btn text-white border-0 d-flex align-items-center" type="button">
                                    <i class="bi bi-eye-slash"></i>
                                </button>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="rememberMe">
                                <label class="form-check-label text-secondary-custom" for="rememberMe">
                                    Remember me
                                </label>
                            </div>
                            <a href="#" class="text-primary text-decoration-none">Forgot password?</a>
                        </div>
                        <button class="btn btn-primary fw-bold py-2 mt-2" type="submit">
                            Sign In
                        </button>
                        <div class="text-center text-secondary-custom">
                            Don't have an account? <a href="#" class="text-primary text-decoration-none" id="switchToRegister">Sign up</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <script src="assets/js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>