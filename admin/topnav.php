<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

   <title>Document</title>
</head>
<body>
    <style>
    /* Custom Top Nav Styling */
     :root{
        --sb-width: 260px;
        --sb-collapsed: 72px;
        --sb-bg: linear-gradient(180deg,#071025,#081232);
        --accent: #7c3aed;
        --muted: #9aa6bd;
        --glass: rgba(255,255,255,0.02);
        --text: #e8f0ff;
      }
    .navbar {
      background:var(--sb-bg);
      color: var(--text);
      box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }

    .navbar-brand img {
      border: 2px solid white;
    }

    .navbar-brand span {
      color: var(--accent);
      font-size: 1.2rem;
    }

    .form-control {
      border-radius: 20px;
    }

    .btn-outline-primary {
      border-radius: 20px;
      color:var(--text);
      border-color: white;
    }

    .btn-outline-primary:hover {
      background-color:var(--accent);
      border-color: var(--accent);
      color: var(--sb-bg);
    }

    .nav-link {
      color: white;
    }

    .nav-link:hover {
      color:var(--accent);
    }

    .dropdown-menu {
      border-radius: 10px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }

    .dropdown-item:hover {
      background-color: var(--accent);
    }

    .badge {
      font-size: 0.6rem;
    }
 i{
   color:var(--accent);
 }
    

  </style>
   <!-- Top Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light px-4 shadow-sm">
  <!-- Logo -->
  <a class="navbar-brand d-flex align-items-center" href="#">
    <img src="../images/room5.jpg" alt="Hotel Logo" width="40" height="40" class="me-2 rounded-circle">
    <span class="fw-bold">AH Afrique Hotel</span>
  </a>

  <!-- Search Bar -->
  <form class="d-none d-md-flex mx-auto" style="width: 40%;">
    <input class="form-control me-2" type="search" placeholder="Search..." aria-label="Search">
    <button class="btn btn-outline-primary" type="submit">Search</button>
  </form>

  <!-- Right Side Icons -->
  <ul class="navbar-nav ms-auto align-items-center">
    <!-- Notification -->
    <li class="nav-item me-3">
      <a class="nav-link position-relative" href="#">
        <i class="bi bi-bell fs-5"></i>
        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
          3
        </span>
      </a>
    </li>

    <!-- User Profile Dropdown -->
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        <img src="../images/event2.jpg" alt="User" width="35" height="35" class="rounded-circle me-2">
        <span class="fw-semibold">Admin</span>
      </a>
      <ul class="dropdown-menu dropdown-menu-end">
        <li><a class="dropdown-item" href="user_profile_page.php"><i class="fa-solid fa-user m-2"></i><span>profile</span></a></li>
        <li><a class="dropdown-item" href="setting.php"><i class="fa-solid fa-gear m-2"></i><span>Settings</span></a></li>
        <li><hr class="dropdown-divider"></li>
        <li> <a class="dropdown-item" href="../logout.php"><i class="fa-solid fa-right-from-bracket m-2"></i><span>Logout</span></a></li>
      </ul>
    </li>
  </ul>
</nav>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>