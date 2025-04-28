<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Question;
use App\Models\QuestionOption;

class QuestionSeeder extends Seeder
{
    public function run()
    {
        // 🧠 Pertanyaan Umum (ya/tidak) dengan major_id dinamis sesuai konteks
        $generalQuestions = [
            // Pertanyaan yang lebih mengarah ke Teknik Informatika
            [
                'text' => 'Saya lebih suka bekerja dengan data daripada dengan orang.',
                'major_id' => 1,
            ],
            [
                'text' => 'Saya cenderung tertarik dengan bagaimana suatu mesin bekerja.',
                'major_id' => 1,
            ],
            [
                'text' => 'Saya senang mencoba memecahkan masalah logika.',
                'major_id' => 1,
            ],
            [
                'text' => 'Saya suka merancang sesuatu di komputer.',
                'major_id' => 1,
            ],
            [
                'text' => 'Saya menikmati pekerjaan yang melibatkan teknologi dan inovasi.',
                'major_id' => 1,
            ],

            // Pertanyaan yang lebih mengarah ke Manajemen Keuangan Perbankan
            [
                'text' => 'Saya lebih suka membuat laporan keuangan daripada menggambar.',
                'major_id' => 4,
            ],
            [
                'text' => 'Saya tertarik mengatur keuangan dan mencatat pengeluaran.',
                'major_id' => 4,
            ],
            [
                'text' => 'Saya merasa nyaman membuat keputusan finansial.',
                'major_id' => 4,
            ],
            [
                'text' => 'Saya cenderung senang berurusan dengan masalah perbankan.',
                'major_id' => 4,
            ],
            [
                'text' => 'Saya lebih suka mengelola uang daripada membuat laporan kreatif.',
                'major_id' => 4,
            ],

            // Pertanyaan yang lebih mengarah ke Teknik Otomotif
            [
                'text' => 'Saya lebih suka memperbaiki sesuatu yang rusak.',
                'major_id' => 2,
            ],
            [
                'text' => 'Saya menikmati bekerja dengan alat-alat mekanik.',
                'major_id' => 2,
            ],
            [
                'text' => 'Saya lebih suka berurusan dengan mesin daripada berinteraksi dengan orang.',
                'major_id' => 2,
            ],
            [
                'text' => 'Saya tertarik untuk mempelajari teknik otomotif.',
                'major_id' => 2,
            ],
            [
                'text' => 'Saya lebih suka bekerja dengan mesin daripada dengan perangkat lunak.',
                'major_id' => 2,
            ],

            // Pertanyaan yang lebih mengarah ke Manajemen Pemasaran
            [
                'text' => 'Saya senang mempengaruhi orang lain untuk membeli sesuatu.',
                'major_id' => 3,
            ],
            [
                'text' => 'Saya lebih suka berinteraksi dengan orang lain di berbagai event.',
                'major_id' => 3,
            ],
            [
                'text' => 'Saya tertarik untuk mendalami dunia pemasaran produk.',
                'major_id' => 3,
            ],
            [
                'text' => 'Saya lebih suka berbicara di depan banyak orang.',
                'major_id' => 3,
            ],
            [
                'text' => 'Saya menikmati bekerja dengan ide kreatif dan inovatif.',
                'major_id' => 3,
            ]
        ];

        foreach ($generalQuestions as $item) {
            Question::create([
                'text' => $item['text'],
                'category' => 'umum',
                'answer_type' => 'boolean', // untuk ya/tidak
                'major_id' => $item['major_id'],
            ]);
        }

        // 🎯 Pertanyaan Mini Khusus Jurusan (pilihan ganda + jawaban benar)
        $miniQuestions = [
             // Teknik Informatika - ID 1
    [
        'text' => 'Apa itu algoritma dalam pemrograman?',
        'major_id' => 1,
        'options' => [
            ['Prosedur langkah demi langkah untuk menyelesaikan masalah', true],
            ['Bahasa pemrograman', false],
            ['Jenis perangkat keras', false],
            ['Sistem operasi', false],
        ],
    ],
    [
        'text' => 'Apa fungsi utama dari database?',
        'major_id' => 1,
        'options' => [
            ['Menyimpan dan mengelola data', true],
            ['Mengolah gambar', false],
            ['Menjalankan aplikasi', false],
            ['Menghubungkan ke internet', false],
        ],
    ],
    [
        'text' => 'Bahasa pemrograman manakah yang populer untuk web development?',
        'major_id' => 1,
        'options' => [
            ['Python', false],
            ['PHP', true],
            ['C++', false],
            ['Assembly', false],
        ],
    ],
    [
        'text' => 'Apa itu HTML?',
        'major_id' => 1,
        'options' => [
            ['Bahasa untuk membuat struktur halaman web', true],
            ['Bahasa untuk mengelola database', false],
            ['Aplikasi komputer', false],
            ['Sistem operasi', false],
        ],
    ],
    [
        'text' => 'Apa kepanjangan dari CPU?',
        'major_id' => 1,
        'options' => [
            ['Central Processing Unit', true],
            ['Computer Primary Unit', false],
            ['Central Programming Unit', false],
            ['Control Program Unit', false],
        ],
    ],
    [
        'text' => 'Di bawah ini manakah yang merupakan sistem operasi?',
        'major_id' => 1,
        'options' => [
            ['Microsoft Word', false],
            ['Windows', true],
            ['Google Chrome', false],
            ['Photoshop', false],
        ],
    ],
    [
        'text' => 'Apa fungsi dari RAM pada komputer?',
        'major_id' => 1,
        'options' => [
            ['Menyimpan data secara sementara', true],
            ['Meningkatkan suara', false],
            ['Menyimpan data permanen', false],
            ['Menghubungkan ke internet', false],
        ],
    ],
    [
        'text' => 'Di bawah ini manakah yang merupakan contoh perangkat lunak?',
        'major_id' => 1,
        'options' => [
            ['Harddisk', false],
            ['Mouse', false],
            ['Microsoft Excel', true],
            ['Keyboard', false],
        ],
    ],
    [
        'text' => 'Framework Laravel digunakan untuk?',
        'major_id' => 1,
        'options' => [
            ['Membuat aplikasi web', true],
            ['Mendesain grafis', false],
            ['Mengelola jaringan', false],
            ['Membuat animasi', false],
        ],
    ],
    [
        'text' => 'Apa itu IP address?',
        'major_id' => 1,
        'options' => [
            ['Alamat identifikasi perangkat dalam jaringan', true],
            ['Alamat email', false],
            ['Nama domain', false],
            ['Jenis database', false],
        ],
    ],

    // Teknik Otomotif - ID 2
    [
        'text' => 'Apa fungsi dari oli mesin pada kendaraan bermotor?',
        'major_id' => 2,
        'options' => [
            ['Membersihkan kaca mobil', false],
            ['Melumasi komponen mesin', true],
            ['Mengisi bahan bakar', false],
            ['Mengatur tekanan ban', false],
        ],
    ],
    [
        'text' => 'Apa fungsi dari busi pada kendaraan bermotor?',
        'major_id' => 2,
        'options' => [
            ['Mendinginkan mesin', false],
            ['Menyuplai bahan bakar', false],
            ['Menyulut campuran udara dan bahan bakar', true],
            ['Menghidupkan aki', false],
        ],
    ],
    [
        'text' => 'Apa nama komponen yang berfungsi untuk mengisi ulang aki kendaraan?',
        'major_id' => 2,
        'options' => [
            ['Alternator', true],
            ['Radiator', false],
            ['Karburator', false],
            ['Saringan udara', false],
        ],
    ],
    [
        'text' => 'Apa fungsi dari radiator?',
        'major_id' => 2,
        'options' => [
            ['Mendinginkan mesin', true],
            ['Meningkatkan kecepatan', false],
            ['Mengatur kemudi', false],
            ['Menyuplai bahan bakar', false],
        ],
    ],
    [
        'text' => 'Apa nama cairan yang digunakan untuk sistem pendingin mobil?',
        'major_id' => 2,
        'options' => [
            ['Oli', false],
            ['Coolant', true],
            ['Bensin', false],
            ['Minyak rem', false],
        ],
    ],
    [
        'text' => 'Apa itu karburator?',
        'major_id' => 2,
        'options' => [
            ['Alat untuk mencampur udara dan bahan bakar', true],
            ['Sistem pengereman', false],
            ['Sistem transmisi', false],
            ['Bagian pendingin mesin', false],
        ],
    ],
    [
        'text' => 'Bagian mobil yang berfungsi untuk meredam getaran disebut?',
        'major_id' => 2,
        'options' => [
            ['Shock absorber', true],
            ['Radiator', false],
            ['Busi', false],
            ['Alternator', false],
        ],
    ],
    [
        'text' => 'Transmisi otomatis dikenal dengan istilah?',
        'major_id' => 2,
        'options' => [
            ['Manual', false],
            ['CVT', true],
            ['Kopling', false],
            ['Rem tangan', false],
        ],
    ],
    [
        'text' => 'Kapan waktu yang tepat mengganti oli mesin?',
        'major_id' => 2,
        'options' => [
            ['Setiap 10.000 km atau 6 bulan', true],
            ['Setiap tahun', false],
            ['Setiap 5 tahun', false],
            ['Saat mesin mati', false],
        ],
    ],
    [
        'text' => 'Komponen yang mengatur arah putaran mesin disebut?',
        'major_id' => 2,
        'options' => [
            ['Kemudi', false],
            ['Diferensial', true],
            ['Rem cakram', false],
            ['Tangki bahan bakar', false],
        ],
    ],
[
        'text' => 'Apa tujuan utama dari pemasaran?',
        'major_id' => 3,
        'options' => [
            ['Meningkatkan produksi', false],
            ['Mempromosikan dan menjual produk', true],
            ['Mengelola keuangan perusahaan', false],
            ['Membuat laporan tahunan', false],
        ],
    ],
    [
        'text' => 'Apa yang dimaksud dengan "target pasar"?',
        'major_id' => 3,
        'options' => [
            ['Semua orang', false],
            ['Sekelompok konsumen yang menjadi sasaran pemasaran', true],
            ['Semua perusahaan', false],
            ['Pasar tradisional', false],
        ],
    ],
    [
        'text' => '4P dalam bauran pemasaran meliputi product, price, place, dan...?',
        'major_id' => 3,
        'options' => [
            ['Promotion', true],
            ['Packaging', false],
            ['Profit', false],
            ['Planning', false],
        ],
    ],
    [
        'text' => 'Apa fungsi utama dari riset pasar?',
        'major_id' => 3,
        'options' => [
            ['Mengembangkan produk baru', false],
            ['Mengetahui kebutuhan dan keinginan konsumen', true],
            ['Meningkatkan produksi', false],
            ['Membuat laporan keuangan', false],
        ],
    ],
    [
        'text' => 'Apa yang dimaksud dengan "branding"?',
        'major_id' => 3,
        'options' => [
            ['Penetapan harga produk', false],
            ['Proses membangun identitas produk atau perusahaan', true],
            ['Meningkatkan penjualan', false],
            ['Membuat iklan', false],
        ],
    ],
    [
        'text' => 'Saluran distribusi berfungsi untuk...?',
        'major_id' => 3,
        'options' => [
            ['Mengantar produk dari produsen ke konsumen', true],
            ['Meningkatkan modal', false],
            ['Mengelola persediaan bahan baku', false],
            ['Mengurus dokumen perusahaan', false],
        ],
    ],
    [
        'text' => 'Promosi yang menggunakan media sosial termasuk jenis promosi apa?',
        'major_id' => 3,
        'options' => [
            ['Promosi tradisional', false],
            ['Promosi digital', true],
            ['Promosi cetak', false],
            ['Promosi langsung', false],
        ],
    ],
    [
        'text' => 'Apa arti "segmentasi pasar"?',
        'major_id' => 3,
        'options' => [
            ['Menyusun anggaran pemasaran', false],
            ['Membagi pasar ke dalam kelompok-kelompok kecil', true],
            ['Mengatur persediaan barang', false],
            ['Meningkatkan profit', false],
        ],
    ],
    [
        'text' => 'Salah satu contoh kegiatan promosi adalah...',
        'major_id' => 3,
        'options' => [
            ['Membuat produk', false],
            ['Mengiklankan produk di media', true],
            ['Membuat laporan keuangan', false],
            ['Menghitung laba', false],
        ],
    ],
    [
        'text' => 'Iklan televisi termasuk dalam jenis promosi apa?',
        'major_id' => 3,
        'options' => [
            ['Promosi digital', false],
            ['Promosi media massa', true],
            ['Promosi individu', false],
            ['Promosi daring', false],
        ],
    ],

    // Manajemen Keuangan Perbankan - ID 4
    [
        'text' => 'Apa fungsi utama bank?',
        'major_id' => 4,
        'options' => [
            ['Menjual barang', false],
            ['Mengelola dan menyalurkan dana', true],
            ['Mengatur hukum', false],
            ['Menyiapkan iklan', false],
        ],
    ],
    [
        'text' => 'Apa yang dimaksud dengan tabungan?',
        'major_id' => 4,
        'options' => [
            ['Pinjaman dari bank', false],
            ['Dana yang disimpan di bank', true],
            ['Investasi saham', false],
            ['Pembayaran kredit', false],
        ],
    ],
    [
        'text' => 'Bunga bank adalah...?',
        'major_id' => 4,
        'options' => [
            ['Biaya administrasi', false],
            ['Imbalan jasa atas simpanan atau pinjaman', true],
            ['Pajak pemerintah', false],
            ['Denda keterlambatan', false],
        ],
    ],
    [
        'text' => 'Apa itu deposito?',
        'major_id' => 4,
        'options' => [
            ['Pinjaman jangka pendek', false],
            ['Tabungan berjangka dengan bunga lebih tinggi', true],
            ['Pembayaran cicilan', false],
            ['Investasi saham', false],
        ],
    ],
    [
        'text' => 'Salah satu produk bank untuk transaksi harian adalah...',
        'major_id' => 4,
        'options' => [
            ['Kredit usaha', false],
            ['Rekening tabungan', true],
            ['Obligasi', false],
            ['Saham', false],
        ],
    ],
    [
        'text' => 'Apa itu kredit?',
        'major_id' => 4,
        'options' => [
            ['Pinjaman uang dari bank', true],
            ['Simpanan uang', false],
            ['Pembelian saham', false],
            ['Pembayaran premi asuransi', false],
        ],
    ],
    [
        'text' => 'Kartu ATM digunakan untuk...?',
        'major_id' => 4,
        'options' => [
            ['Mencetak laporan keuangan', false],
            ['Melakukan transaksi di mesin ATM', true],
            ['Meningkatkan saldo rekening', false],
            ['Mendaftarkan rekening baru', false],
        ],
    ],
    [
        'text' => 'Apa yang dimaksud dengan bunga simpanan?',
        'major_id' => 4,
        'options' => [
            ['Biaya administrasi bulanan', false],
            ['Imbalan dari bank kepada nasabah atas tabungan', true],
            ['Kredit macet', false],
            ['Dana asuransi', false],
        ],
    ],
    [
        'text' => 'Lembaga yang mengawasi kegiatan perbankan di Indonesia adalah?',
        'major_id' => 4,
        'options' => [
            ['KPK', false],
            ['OJK (Otoritas Jasa Keuangan)', true],
            ['BI Checking', false],
            ['Kemenkeu', false],
        ],
    ],
    [
        'text' => 'Apa tujuan dari investasi?',
        'major_id' => 4,
        'options' => [
            ['Mengurangi pengeluaran', false],
            ['Meningkatkan nilai aset di masa depan', true],
            ['Membayar hutang', false],
            ['Membuat rekening baru', false],
        ],
    ],


        ];

        foreach ($miniQuestions as $item) {
            $question = Question::create([
                'text' => $item['text'],
                'category' => 'spesifik',
                'answer_type' => 'choice',
                'major_id' => $item['major_id'],
            ]);

            foreach ($item['options'] as [$text, $isCorrect]) {
                QuestionOption::create([
                    'question_id' => $question->id,
                    'option_text' => $text,
                    'is_correct' => $isCorrect,
                ]);
            }
        }
    }
}