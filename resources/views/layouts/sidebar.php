<div id="sidebar" class="text-white p-3 d-flex flex-column"
    style="min-height: 100vh; width: 250px; transition: all 0.3s;">
    <ul class="list-unstyled">
        <li class="mb-5">
            <a href="#" id="menuItem" class="menu-header text-white text-decoration-none d-flex align-items-center">
                <img src="../../public/assets/icon/menu-icon.png" alt="Menu Icon" class="sidebar-icon me-2">
                <span class="menu-text">Menu</span>
            </a>
        </li>
        <?php
        $role = $_SESSION['user']['role'] ?? null;

        $menuItems = [
            1 => [
                ['url' => '/mahasiswa/dashboard', 'icon' => 'dashboard-icon.png', 'text' => 'Dashboard'],
                ['url' => '/mahasiswa/prestasi', 'icon' => 'prestasi-icon.png', 'text' => 'Prestasi'],
                ['url' => '/mahasiswa/peringkat', 'icon' => 'ranking-icon.png', 'text' => 'Peringkat'],
            ],
            2 => [
                ['url' => '/dosbim/dashboard', 'icon' => 'dashboard-icon.png', 'text' => 'Dashboard'],
                ['url' => '/dosbim/prestasi', 'icon' => 'prestasi-icon.png', 'text' => 'Prestasi'],
                ['url' => '/dosbim/peringkat', 'icon' => 'ranking-icon.png', 'text' => 'Peringkat'],
            ],
            3 => [
                ['url' => '/presma_pbl/public/admin/dashboard', 'icon' => 'dashboard-icon.png', 'text' => 'Dashboard'],
                ['url' => '/presma_pbl/public/admin/users', 'icon' => 'user-icon.png', 'text' => 'Pengguna'],
                ['url' => '/presma_pbl/public/admin/dosen', 'icon' => 'dosen-icon.png', 'text' => 'Dosen'],
                ['url' => '/presma_pbl/public/admin/mahasiswa', 'icon' => 'mahasiswa-icon.png', 'text' => 'Mahasiswa'],
                ['url' => '/presma_pbl/public/admin/prestasi', 'icon' => 'prestasi-icon.png', 'text' => 'Prestasi'],
                ['url' => '/presma_pbl/public/admin/ranking', 'icon' => 'ranking-icon.png', 'text' => 'Peringkat'],
                ['url' => '/presma_pbl/public/admin/laporan', 'icon' => 'laporan-icon.png', 'text' => 'Laporan'],
            ],
            4 => [
                ['url' => '/kajur/dashboard', 'icon' => 'dashboard-icon.png', 'text' => 'Dashboard'],
                ['url' => '/kajur/prestasi', 'icon' => 'prestasi-icon.png', 'text' => 'Prestasi'],
            ],
        ];

        $currentUrl = $_SERVER['REQUEST_URI'];
        $menus = $menuItems[$role] ?? [];
        ?>

        <?php foreach ($menus as $menu): ?>
            <li class="mb-3">
                <a href="<?= htmlspecialchars($menu['url']) ?>"
                    class="text-white text-decoration-none d-flex align-items-center <?= ($_SERVER['REQUEST_URI'] === $menu['url']) ? 'active' : '' ?>">
                    <img src="../../public/assets/icon/<?= htmlspecialchars($menu['icon']) ?>"
                        alt="<?= htmlspecialchars($menu['text']) ?> Icon" class="sidebar-icon me-2">
                    <span class="menu-text"><?= htmlspecialchars($menu['text']) ?></span>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>