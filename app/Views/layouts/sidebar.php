<?php
$roleUser = session()->get('role');
$currentUri = uri_string();

// Deteksi submenu aktif
$isDataMasterOpen = in_array($currentUri, ['master_pendapatan/rekening', 'master_pendapatan/opd']);
$isLaporanOpen = in_array($currentUri, ['laporan/realisasi', 'laporan/buku_besar']);
?>

<!-- Tombol toggle sidebar -->
<button class="sidebar-toggle d-md-none" onclick="toggleSidebar()">&#9776;</button>

<div class="sidebar" id="sidebar">
    <a href="<?= base_url('dashboard'); ?>" <?= ($currentUri == 'dashboard') ? 'class="active"' : ''; ?>>
        <i class="fa-solid fa-home"></i> Dashboard
    </a>

    <?php if ($roleUser == "Administrator"): ?>
        <div class="dropdown">
            <a href="javascript:void(0);" class="dropdown-toggle" onclick="toggleSubmenu('dataMasterSubmenu')">
                <i class="fa-solid fa-database"></i> Data Master
            </a>
            <div class="submenu <?= $isDataMasterOpen ? 'show' : ''; ?>" id="dataMasterSubmenu">
                <div class="submenu-items">
                    <a href="<?= base_url('master_pendapatan/rekening'); ?>" <?= ($currentUri == 'master_pendapatan/rekening') ? 'class="active"' : ''; ?>>
                        <i class="fa-solid fa-money-bill-wave"></i> Data Rekening
                    </a>
                    <a href="<?= base_url('master_pendapatan/opd'); ?>" <?= ($currentUri == 'master_pendapatan/opd') ? 'class="active"' : ''; ?>>
                        <i class="fa-solid fa-building"></i> OPD
                    </a>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php if (in_array($roleUser, ["Administrator", "Bendahara", "BUD"])): ?>
        <a href="<?= base_url('pendapatan'); ?>" <?= ($currentUri == 'pendapatan') ? 'class="active"' : ''; ?>>
            <i class="fa-solid fa-file-invoice-dollar"></i> Pendapatan
        </a>
    <?php endif; ?>

    <div class="dropdown">
        <a href="javascript:void(0);" class="dropdown-toggle" onclick="toggleSubmenu('laporanSubmenu')">
            <i class="fa-solid fa-chart-line"></i> Laporan
        </a>
        <div class="submenu <?= $isLaporanOpen ? 'show' : ''; ?>" id="laporanSubmenu">
            <div class="submenu-items">
                <a href="<?= base_url('laporan/realisasi'); ?>" <?= ($currentUri == 'laporan/realisasi') ? 'class="active"' : ''; ?>>
                    <i class="fa-solid fa-chart-bar"></i> Realisasi
                </a>
                <a href="<?= base_url('laporan/buku_besar'); ?>" <?= ($currentUri == 'laporan/buku_besar') ? 'class="active"' : ''; ?>>
                    <i class="fa-solid fa-book-open"></i> Buku Besar
                </a>
            </div>
        </div>
    </div>

    <?php if (in_array($roleUser, ["Administrator", "Bendahara", "BUD", "PA/KPA"])): ?>
        <a href="<?= base_url('rekonsiliasi'); ?>" <?= ($currentUri == 'rekonsiliasi') ? 'class="active"' : ''; ?>>
            <i class="fa-solid fa-handshake"></i> Rekonsiliasi
        </a>
    <?php endif; ?>
</div>

<!-- CSS Sidebar -->
<style>
    .sidebar-toggle {
        font-size: 24px;
        background: none;
        border: none;
        margin: 10px;
        color: #003366;
        position: fixed;
        top: 10px;
        left: 10px;
        z-index: 1001;
    }

    .sidebar {
        width: 200px; /* Fixed width */
        background: #f0f0f0;
        padding: 15px;
        display: flex;
        flex-direction: column;
        gap: 10px;
        border-right: 1px solid #ddd;
        transition: width 0.3s ease; /* Smooth transition */
        flex-shrink: 0; /* Prevent shrinking */
    }

    @media (max-width: 768px) {
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            transform: translateX(-100%);
            z-index: 1000;
        }

        .sidebar.show {
            transform: translateX(0);
        }
    }

    .sidebar a,
    .dropdown-toggle {
        font-size: 14px;
        color: #003366;
        text-decoration: none;
        display: block;
        padding: 8px 15px;
        border-radius: 5px;
    }

    .sidebar a:hover,
    .dropdown-toggle:hover {
        background: rgba(0, 51, 102, 0.1);
    }

    a.active {
        background-color: #003366;
        color: white;
    }

    .submenu {
        display: none; /* Initially hidden */
        padding-left: 15px;
        margin: 5px 0; /* Add margin for spacing */
    }

    .submenu.show {
        display: block; /* Show submenu on toggle */
    }

    .submenu-items {
        display: flex;
        flex-direction: column;
        gap: 5px;
        font-size: 13px;
    }

    .submenu-items a {
        padding: 5px 10px;
    }
</style>

<!-- Script Sidebar -->
<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        sidebar.classList.toggle('show');
    }

    function toggleSubmenu(id) {
        const submenu = document.getElementById(id);
        submenu.classList.toggle('show');
    }

    document.addEventListener('DOMContentLoaded', function () {
        const sidebarLinks = document.querySelectorAll('#sidebar a');
        sidebarLinks.forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth <= 768) {
                    document.getElementById('sidebar').classList.remove('show');
                }
            });
        });
    });
</script>