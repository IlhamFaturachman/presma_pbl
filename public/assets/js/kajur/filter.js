<script>
    $(document).ready(function() {
        // Tangani pengiriman form
        $('form').on('submit', function(event) {
            event.preventDefault(); // Mencegah pengiriman form default

            // Ambil nilai dari form
            var programStudi = $('#program-studi').val();
            var tahunPrestasi = $('#tahun-prestasi').val();
            var tingkat = $('#tingkat').val();

            // Kirim data ke server menggunakan AJAX
            $.ajax({
                url: '/presma_pbl/api/getPrestasi', // Ganti dengan URL endpoint yang sesuai
                type: 'POST',
                data: {
                    program_studi: programStudi,
                    tahun_prestasi: tahunPrestasi,
                    tingkat: tingkat
                },
                success: function(response) {
                    // Bersihkan tabel sebelum menampilkan data baru
                    $('tbody').empty();

                    // Cek apakah ada data yang diterima
                    if (response.length > 0) {
                        // Loop melalui data dan tambahkan ke tabel
                        response.forEach(function(item, index) {
                            $('tbody').append(
                                `<tr>
                                    <td>${index + 1}</td>
                                    <td>${item.nama_mahasiswa}</td>
                                    <td>${item.program_studi}</td>
                                    <td>${item.nama_prestasi}</td>
                                    <td>${item.tingkat_prestasi}</td>
                                    <td>${item.peringkat}</td>
                                </tr>`
                            );
                        });
                    } else {
                        // Jika tidak ada data, tampilkan pesan
                        $('tbody').append(
                            `<tr>
                                <td class="no-data text-center" colspan="6">
                                    <em>Data tidak tersedia saat ini.</em>
                                </td>
                            </tr>`
                        );
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching data:', error);
                    // Tampilkan pesan error jika diperlukan
                }
            });
        });
    });
</script>