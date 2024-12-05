<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pengguna</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/presma_pbl/public/assets/css/header.css">
    <link rel="stylesheet" href="/presma_pbl/public/assets/css/sidebar.css">
    <link rel="stylesheet" href="/presma_pbl/public/assets/css/admin/tambahPengguna.css">
</head>

<body>

    <!-- Header -->
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/presma_pbl/resources/views/layouts/header.php'; ?>

    <div class="d-flex">
        <!-- Sidebar -->
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/presma_pbl/resources/views/layouts/sidebar.php'; ?>

        <!-- Main Content -->
        <div id="content" class="p-4 w-100">
            <div class="card shadow">
                <div class="card-body">
                    <h2 class="mb-4">Daftar Pengguna</h2>
                    <div class="row mb-3">
                        <div class="col-md-6 offset-md-6 d-flex justify-content-end">
                            <input type="text" class="form-control w-50 mr-3" placeholder="Cari pengguna...">
                            <button class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#tambahPenggunaModal">
                                <i class="bi bi-plus-lg"></i> Tambah Pengguna
                            </button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead class="table-primary">
                                <tr>
                                    <th>Nama Pengguna</th>
                                    <th>Role</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($users)): ?>
                                <?php foreach ($users as $user): ?>
                                <tr>
                                    <td class="name-col">
                                        <?= htmlspecialchars($user['username'], ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td class="role-col">
                                        <?php
                                                // Peta role berdasarkan role_id
                                                $roles = [
                                                    1 => ['label' => 'Mahasiswa', 'badge' => 'info'],
                                                    2 => ['label' => 'Dosen', 'badge' => 'secondary'],
                                                    3 => ['label' => 'Admin', 'badge' => 'primary'],
                                                    4 => ['label' => 'Kajur', 'badge' => 'warning']
                                                ];

                                                // Dapatkan role berdasarkan role_id
                                                $role = $roles[$user['role_id']] ?? ['label' => 'Unknown', 'badge' => 'dark'];
                                                ?>
                                        <span class="badge bg-<?= $role['badge']; ?>">
                                            <?= htmlspecialchars($role['label'], ENT_QUOTES, 'UTF-8'); ?>
                                        </span>
                                    </td>
                                    <td class="action-col">
                                        <button id="edit-<?= $user['user_id']; ?>" class="btn btn-sm btn-warning"
                                            data-user-id="<?= $user['user_id']; ?>" data-bs-toggle="modal"
                                            data-bs-target="#editPenggunaModal">
                                            <i class="bi bi-pencil"></i> Edit
                                        </button>
                                        <button id="edit-<?= $user['user_id']; ?>"
                                            class="btn btn-sm btn-danger deleteUser"
                                            data-user-id="<?= $user['user_id']; ?>" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal">
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                                <?php else: ?>
                                <tr>
                                    <td colspan="4" class="text-center">Tidak ada pengguna yang ditemukan.</td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/presma_pbl/resources/views/component/admin/modalEditUser.php'; ?>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/presma_pbl/resources/views/component/admin/modalTambahUser.php'; ?>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/presma_pbl/resources/views/component/admin/modalDeleteUser.php'; ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/presma_pbl/public/assets/js/sidebar.js"></script>
</body>

</html>