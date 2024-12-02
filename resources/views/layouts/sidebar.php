<div id="sidebar" class="text-white p-3 d-flex flex-column"
    style="min-height: 100vh; width: 250px; transition: all 0.3s;">
    <ul class="list-unstyled">
        <li class="mb-5">
            <a href="#" id="menuItem" class="text-white text-decoration-none d-flex align-items-center">
                <img src="../../public/assets/icon/menu-icon.png" alt="Menu Icon" class="sidebar-icon me-2">
                <span class="menu-text">Menu</span>
            </a>
        </li>
        <?php
        // Ambil role dari sesi
        $role = $_SESSION['user']['role'] ?? null;

        // Menentukan menu berdasarkan role
        $menuItems = [
            1 => [ // Mahasiswa
                ['id' => 'dashboard', 'icon' => 'dashboard-icon.png', 'text' => 'Dashboard'],
                ['id' => 'prestasi', 'icon' => 'prestasi-icon.png', 'text' => 'Prestasi'],
                ['id' => 'peringkat', 'icon' => 'ranking-icon.png', 'text' => 'Peringkat'],
            ],
            2 => [ // Dosen
                ['id' => 'dashboard', 'icon' => 'dashboard-icon.png', 'text' => 'Dashboard'],
                ['id' => 'prestasi', 'icon' => 'prestasi-icon.png', 'text' => 'Prestasi'],
                ['id' => 'peringkat', 'icon' => 'ranking-icon.png', 'text' => 'Peringkat'],
            ],
            3 => [ // Admin
                ['id' => 'dashboard', 'icon' => 'dashboard-icon.png', 'text' => 'Dashboard'],
                ['id' => 'pengguna', 'icon' => 'user-icon.png', 'text' => 'Pengguna'],
                ['id' => 'dosen', 'icon' => 'dosen-icon.png', 'text' => 'Dosen'],
                ['id' => 'mahasiswa', 'icon' => 'mahasiswa-icon.png', 'text' => 'Mahasiswa'],
                ['id' => 'prestasi', 'icon' => 'prestasi-icon.png', 'text' => 'Prestasi'],
                ['id' => 'peringkat', 'icon' => 'ranking-icon.png', 'text' => 'Peringkat'],
            ],
        ];

        // Ambil menu berdasarkan role, jika role tidak ditemukan, kosongkan menu
        $menus = $menuItems[$role] ?? [];
        ?>

        <?php foreach ($menus as $menu): ?>
            <li class="mb-3">
                <a href="#" id="<?= htmlspecialchars($menu['id']) ?>"
                    class="text-white text-decoration-none d-flex align-items-center">
                    <img src="../../public/assets/icon/<?= htmlspecialchars($menu['icon']) ?>"
                        alt="<?= htmlspecialchars($menu['text']) ?> Icon" class="sidebar-icon me-2">
                    <span class="menu-text"><?= htmlspecialchars($menu['text']) ?></span>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>