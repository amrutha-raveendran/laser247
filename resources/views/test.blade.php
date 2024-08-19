<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bootstrap Sidebar, Header, and Content Layout</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
  <style>
    body {
      font-family: Arial, sans-serif;
    }
    .sidebar {
      min-height: 89vh;
      background-color: #343a40;
      color: white;
      padding-top: 20px;
      margin-top: 6rem;
    }
    .sidebar a {
      color: white;
      text-decoration: none;
      padding: 10px;
      display: block;
    }
    .sidebar a:hover {
      background-color: #495057;
    }
    .content {
      padding: 20px;
      margin-top: 6rem;
    }
    .navbar {
      background-color: #000;
    }
    .navbar .navbar-brand, .navbar .navbar-nav .nav-link {
      color: white;
    }
    .logo img {
    float: left;
    /* margin-right: 15px; */
    max-width: 250px;
}
  </style>
</head>
<body>

  <!-- Header -->
  <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">
        <img src="https://crystawalltech.com/assest/images/logo-final.png" height="70px">
      </a>
  
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link active" href="#">Logout</a>
          </li>
          
        </ul>
      </div>
    </div>
  </nav>

  <!-- Sidebar and Content -->
  <div class="container-fluid">
    <div class="row">
      <!-- Sidebar -->
      <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-dark sidebar collapse">
        <div class="position-sticky">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">
                <i class="bi bi-house-door"></i> Dashboard
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <i class="bi bi-file-earmark-text"></i> Orders
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <i class="bi bi-cart"></i> Products
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <i class="bi bi-people"></i> Customers
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <i class="bi bi-gear"></i> Settings
              </a>
            </li>
          </ul>
        </div>
      </nav>

      <!-- Main Content -->
      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 content">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2">Dashboard</h1>
        </div>
        <p>Welcome to the dashboard! Here you can find all the information you need.</p>

        <!-- Add your additional content here -->
      </main>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
