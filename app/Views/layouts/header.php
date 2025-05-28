<!-- app/Views/layout/header.php -->
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="http://localhost/catatan_pendapatan/public/images/logojepara.jpg">
    <title>PBP - Header</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .header {
            height: 60px;
            background-color: #003366;
            color: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
        }
        .header-title {
            font-size: 32px;
            font-weight: bold;
        }
        .profile-btn {
            background: white;
            color: #003366;
            border-radius: 6px;
            padding: 8px 12px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            border: none;
        }
        .profile-btn:hover {
            background: #e6e6e6;
        }
        .btn-close {
            filter: invert(1); 
        }
        .button-group {
            display: flex;
            justify-content: flex-start;
            gap: 15px;
        }
        .btn-tambah {
            background-color: #28a745; /* Green */
            color: white;
        }
        .btn-tambah:hover {
            background-color: #28a745; /* Darker green */
        }
        .btn-upload {
            background-color: #007bff; /* Blue */
            color: white;
        }
        .btn-upload:hover {
            background-color: #0056b3; /* Darker blue */
        }
        .hidden {
            display: none;
        }
        .footer {
            background-color: #003366;
            color: white;
            text-align: center;
            padding: 10px 0;
            position: relative;
            bottom: 0;
            width: 100%;
            margin-top: auto;
        }
        .container-dashboard {
            display: flex;
            height: 100vh; /* Full height */
        }
        .sidebar {
            width: 200px;
            background: #f0f0f0;
        }
        .main-content {
            flex-grow: 1;
            padding: 20px;
            overflow-y: auto; /* Scroll if overflow */
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="header-title">PBP</div>
        <div class="nav-menu">
            <div class="dropdown">
                <button class="profile-btn dropdown-toggle" type="button" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-user"></i> <span id="selectedUser"><?= session()->get('username'); ?></span>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#profileModal">
                            <i class="fa-solid fa-user-circle"></i> Lihat Profil
                        </button>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <a class="dropdown-item text-danger" href="<?= base_url('auth/logout'); ?>">
                            <i class="fa-solid fa-sign-out-alt"></i> Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>
