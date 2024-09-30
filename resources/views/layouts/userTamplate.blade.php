<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        rel="stylesheet" />
    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        rel="stylesheet" />
    <style>
        body {
            font-family: "Arial", sans-serif;
            background-color: #fff;
            color: #333;
        }

        .sidebar {
            height: 100vh;
            background-color: #f8f9fa;
            padding: 20px;
            border-right: 1px solid #ddd;
        }

        .sidebar .nav-link {
            font-size: 0.9rem;
            font-weight: 400;
            color: #555;
            margin-bottom: 10px;
            padding-left: 0;
            padding-top: 10px;
            padding-bottom: 10px;
            text-decoration: none;
            position: relative;
            display: block;
        }

        .sidebar .nav-link.active {
            font-weight: bold;
            color: #000;
        }

        .sidebar .nav-link.active::before {
            content: "\003E\0020";
            font-weight: bold;
            color: #000;
            margin-right: 10px;
        }

        .sidebar .nav-link:hover {
            text-decoration: underline;
        }

        .card {
            border: 0.5px solid #EEE;
            border-radius: 4px;
            padding: 30px;
            text-align: center;
            margin-bottom: 20px;
            height: 150px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            transition: border 0.3s ease;
        }

        .card:hover {
            border: 0.5px solid black;
        }

        .card-title {
            font-size: 1rem;
            font-weight: bold;
            margin-top: 10px;
            color: #333;
        }

        h2 {
            font-size: 2.5rem;
            font-weight: 400;
            margin-bottom: 30px;
            color: #333;
        }

        .card a {
            color: inherit;
            text-decoration: none;
        }

        .card a:hover {
            text-decoration: none;
        }
    </style>

</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-4 col-lg-3 d-md-block sidebar">
                <div class="position-sticky">
                    <ul class="nav flex-column ">
                        <li class="nav-item">
                            <a class="nav-link active" href="#"> MY ACCOUNT </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">My Orders</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Wishlist</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">My Tickets</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Compare Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Address Book</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Account Information</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Privacy Settings</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Gift Card</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Newsletter Subscriptions</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Logout</a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main content -->
            <main class="col-md-8 col-lg-9 ms-sm-auto px-md-4">
                <h2 class="mt-4">Welcome Sakib</h2>

                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <a href="#">
                                <i class="fas fa-box"></i>
                                <h3 class="card-title">My Orders</h3>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <a href="#">
                                <i class="fas fa-heart"></i>
                                <h3 class="card-title">Wishlist</h3>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <a href="#">
                                <i class="fas fa-address-book"></i>
                                <h3 class="card-title">Address Book</h3>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <a href="#">
                                <i class="fas fa-user"></i>
                                <h3 class="card-title">Account Information</h3>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <a href="#">
                                <i class="fas fa-credit-card"></i>
                                <h3 class="card-title">Payment Methods</h3>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <a href="#">
                                <i class="fas fa-sliders-h"></i>
                                <h3 class="card-title">Compare Products</h3>
                            </a>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js">
            </script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
</body>

</html>