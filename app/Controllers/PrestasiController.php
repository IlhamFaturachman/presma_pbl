<?php

namespace App\Controllers;

use App\Models\PrestasiModel;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class PrestasiController extends Controller
{
    protected PrestasiModel $prestasiModel;
    public function __construct()
    {
        $this->prestasiModel = new PrestasiModel();
    }

    public function index(Request $request, Response $response)
    {
        // Ambil semua prestasi dari model
        return $prestasi = $this->prestasiModel->getAllPrestasi();
    }

    public function getPrestasiByNIMUser(Request $request, Response $response)
    {
        // Ambil NIM dari session
        $nim = $_SESSION['user']['username'];

        // Debugging: Cek NIM yang digunakan
        error_log("NIM dari session: " . $nim);

        // Pastikan NIM ada di session
        if (!isset($nim) || empty($nim)) {
            $response->getBody()->write(json_encode([
                'success' => false,
                'message' => 'NIM tidak ditemukan di session.',
            ]));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(400);
        }

        // Ambil prestasi dari model berdasarkan NIM
        return $prestasi = $this->prestasiModel->getPrestasiByNim($nim); // Kirim NIM ke model
    }

    public function store(Request $request, Response $response)
    {
        // Ambil data dari form
        $data = $_POST;

        // Validasi input
        $errors = [];

        $requiredFields = [
            'nim',
            'nip',
            'nama_lomba',
            'kategori_lomba',
            'juara_id',
            'tingkatan_id',
            'waktu_mulai_lomba',
            'waktu_selesai_lomba',
            'penyelenggara',
            'tempat_lomba'
        ];

        foreach ($requiredFields as $field) {
            if (empty($data[$field])) {
                $errors[$field] = ucfirst($field) . ' wajib diisi.';
            }
        }

        // Jika ada error validasi, kembalikan respons
        if (!empty($errors)) {
            $response->getBody()->write(json_encode([
                'success' => false,
                'message' => 'Validasi gagal.',
                'errors' => $errors,
            ]));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(422);
        }

        // Proses file upload (sama seperti sebelumnya)
        $baseDir = '/presma_pbl/public/storage/';
        $namaLombaSanitized = preg_replace('/[^a-zA-Z0-9]/', '', $data['nama_lomba']); // Bersihkan nama lomba
        $prestasiFolder = $data['nim'] . '_' . $namaLombaSanitized;
        $uploadDir = $_SERVER['DOCUMENT_ROOT'] . $baseDir . $prestasiFolder . '/';

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $filePaths = [
            'sertifikat' => null,
            'foto_lomba' => null,
            'flyer_lomba' => null,
            'surat_tugas' => null,
            'ide_proposal' => null
        ];

        foreach ($filePaths as $field => &$path) {
            if (isset($_FILES[$field]) && $_FILES[$field]['error'] === UPLOAD_ERR_OK) {
                $file = $_FILES[$field];
                $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);
                $newFileName = $data['nim'] . '_' . $namaLombaSanitized . '_' . $field . '.' . $fileExtension;
                $filePath = $uploadDir . $newFileName;

                if (move_uploaded_file($file['tmp_name'], $filePath)) {
                    $path = $baseDir . $prestasiFolder . '/' . $newFileName; // Simpan path relatif
                }
            }
        }

        // Gabungkan path file dengan data lain
        $data = array_merge($data, $filePaths);

        $data['created_at'] = date('Y-m-d H:i:s');

        try {
            $result = $this->prestasiModel->addPrestasi($data);

            if ($result) {
                $response->getBody()->write(json_encode([
                    'success' => true,
                    'message' => 'Prestasi berhasil ditambahkan.',
                ]));
                return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
            } else {
                $response->getBody()->write(json_encode([
                    'success' => false,
                    'message' => 'Gagal menyimpan prestasi.',
                ]));
                return $response->withHeader('Content-Type', 'application/json')->withStatus(500);
            }
        } catch (\Exception $e) {
            $response->getBody()->write(json_encode([
                'success' => false,
                'message' => 'Terjadi kesalahan server: ' . $e->getMessage(),
            ]));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(500);
        }
    }

    public function show(Request $request, Response $response, array $args)
    {
        $prestasi_id = $args['prestasi_id'];
        $prestasi = $this->prestasiModel->getPrestasiById($prestasi_id,);
        if ($prestasi) {
            $response->getBody()->write(json_encode($prestasi));
        } else {
            $response->getBody()->write(json_encode(["error" => "Prestasi tidak ditemukan."]));
        }
        return $response->withHeader('Content-Type', 'application/json');
    }
}
