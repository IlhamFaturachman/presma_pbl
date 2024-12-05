// Konfigurasi paginasi
const rowsPerPage = 10;
let currentPage = 1;
let allMahasiswa = [];

// Render tabel
function renderTable(data) {
    const startIndex = (currentPage - 1) * rowsPerPage;
    const endIndex = startIndex + rowsPerPage;
    const paginatedData = data.slice(startIndex, endIndex);

    // Kosongkan tbody
    $('#mahasiswaBody').empty();

    if (paginatedData.length === 0) {
        $('#mahasiswaBody').append('<tr><td colspan="3" class="text-center">Tidak ada pengguna yang ditemukan.</td></tr>');
        return;
    }

    // Isi data ke tabel
    paginatedData.forEach(mahasiswa => {
        const roleBadge = {
            1: '<span class="badge bg-info">Mahasiswa</span>',
            2: '<span class="badge bg-secondary">Dosen</span>',
            3: '<span class="badge bg-primary">Admin</span>',
            4: '<span class="badge bg-warning">Kajur</span>',
        };

        $('#mahasiswaBody').append(`
            <tr>
                <td>${mahasiswa.nim}</td>
                <td>${roleBadge[mahasiswa.role_id] || '<span class="badge bg-dark">Unknown</span>'}</td>
                <td>
                    <button class="btn btn-sm btn-warning editUser" data-user-id="${mahasiswa.user_id}">
                        <i class="bi bi-pencil"></i> Edit
                    </button>
                    <button class="btn btn-sm btn-danger deleteUser" data-user-id="${mahasiswa.user_id}">
                        <i class="bi bi-trash"></i> Hapus
                    </button>
                </td>
            </tr>
        `);
    });
}

// Render paginasi
function renderPagination(totalItems) {
    const totalPages = Math.ceil(totalItems / rowsPerPage);
    $('#pagination').empty();

    // Tombol Previous
    $('#pagination').append(`
        <li class="page-item ${currentPage === 1 ? 'disabled' : ''}">
            <a class="page-link" href="#" data-page="${currentPage - 1}">Prev</a>
        </li>
    `);

    // Tombol nomor halaman
    for (let i = 1; i <= totalPages; i++) {
        $('#pagination').append(`
            <li class="page-item ${i === currentPage ? 'active' : ''}">
                <a class="page-link" href="#" data-page="${i}">${i}</a>
            </li>
        `);
    }

    // Tombol Next
    $('#pagination').append(`
        <li class="page-item ${currentPage === totalPages ? 'disabled' : ''}">
            <a class="page-link" href="#" data-page="${currentPage + 1}">Next</a>
        </li>
    `);
}

// Ubah halaman
$(document).on('click', '#pagination .page-link', function (e) {
    e.preventDefault();
    const page = parseInt($(this).data('page'));
    const totalPages = Math.ceil(allMahasiswa.length / rowsPerPage);

    if (page >= 1 && page <= totalPages) {
        currentPage = page;
        renderTable(allMahasiswa);
        renderPagination(allMahasiswa.length);
    }
});

// Fitur pencarian
$('#searchInput').on('keyup', function () {
    const value = $(this).val().toLowerCase();
    const filteredUsers = allMahasiswa.filter(user =>
        user.username.toLowerCase().includes(value)
    );

    currentPage = 1; // Reset ke halaman pertama
    renderTable(filteredUsers);
    renderPagination(filteredUsers.length);
});

// Event delegation untuk tombol Edit
$(document).on('click', '.editUser', async function () {
    const userId = $(this).data('user-id');
    if (!userId) {
        console.error('User ID tidak ditemukan!');
        return;
    }

    // Buka modal edit pengguna
    $('#editPenggunaModal').modal('show');

    try {
        // Ambil data pengguna berdasarkan ID
        const response = await fetch(`/presma_pbl/public/admin/users/${userId}`);
        if (!response.ok) throw new Error('Gagal memuat data pengguna');
        const userData = await response.json();

        // Isi form dengan data pengguna
        $('#edit-user_id').val(userData.user_id);
        $('#edit-username').val(userData.username);

        // Load roles
        const rolesResponse = await fetch('/presma_pbl/public/admin/roles');
        if (!rolesResponse.ok) throw new Error('Gagal memuat roles');
        const roles = await rolesResponse.json();

        const rolesSelect = $('#edit-roles');
        rolesSelect.empty();
        rolesSelect.append('<option value="" disabled>Pilih Role</option>');
        roles.forEach(role => {
            const option = `<option value="${role.role_id}" ${role.role_id === userData.role_id ? 'selected' : ''}>${role.role_name}</option>`;
            rolesSelect.append(option);
        });
    } catch (error) {
        console.error(error);
        alert('Terjadi kesalahan saat memuat data pengguna.');
    }
});

// Event delegation untuk tombol Hapus
$(document).on('click', '.deleteUser', function () {
    const userId = $(this).data('user-id');
    if (!userId) {
        console.error('User ID tidak ditemukan!');
        return;
    }

    // Buka modal konfirmasi hapus
    $('#deleteModal').modal('show');
    $('#confirmDelete').data('user-id', userId);
});

// Konfirmasi Hapus
$(document).on('click', '#confirmDelete', async function () {
    const userId = $(this).data('user-id');
    if (!userId) {
        console.error('User ID tidak ditemukan!');
        return;
    }

    try {
        const response = await fetch(`/presma_pbl/public/admin/users/${userId}`, {
            method: 'DELETE'
        });
        if (!response.ok) throw new Error('Gagal menghapus pengguna');
        alert('Pengguna berhasil dihapus!');
        location.reload();
    } catch (error) {
        console.error(error);
        alert('Terjadi kesalahan saat menghapus pengguna.');
    }
});

// Load data dari PHP saat halaman dimuat
$(document).ready(function () {
    allMahasiswa = window.allMahasiswa || []; // Ambil data dari PHP
    renderTable(allMahasiswa);
    renderPagination(allMahasiswa.length);
});
