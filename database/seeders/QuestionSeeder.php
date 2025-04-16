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
            // Teknik Informatika (D2)
            [
                'text' => 'Apa output dari kode: `echo 2 + "2";` dalam PHP?',
                'major_id' => 1,
                'options' => [
                    ['2', false],
                    ['22', false],
                    ['4', true],
                    ['Error', false],
                ],
            ],
            [
                'text' => 'Apa itu variabel dalam pemrograman?',
                'major_id' => 1,
                'options' => [
                    ['Fungsi yang dapat dipanggil', false],
                    ['Tempat menyimpan data', true],
                    ['Metode untuk looping', false],
                    ['Instruksi cetak data', false],
                ],
            ],

            // Teknik Otomotif (D2)
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
                'text' => 'Komponen apa yang mengatur suhu mesin agar stabil?',
                'major_id' => 2,
                'options' => [
                    ['Radiator', true],
                    ['Kampas kopling', false],
                    ['Karburator', false],
                    ['Silinder head', false],
                ],
            ],

            // Manajemen Pemasaran (D3)
            [
                'text' => 'Apa yang dimaksud dengan segmentasi pasar?',
                'major_id' => 3,
                'options' => [
                    ['Proses menurunkan harga', false],
                    ['Pemberian diskon besar-besaran', false],
                    ['Pembagian pasar ke dalam kelompok konsumen', true],
                    ['Proses memasarkan barang digital', false],
                ],
            ],
            [
                'text' => 'Apa itu “branding”?',
                'major_id' => 3,
                'options' => [
                    ['Penentuan harga produk', false],
                    ['Proses distribusi barang', false],
                    ['Citra dan identitas produk di mata konsumen', true],
                    ['Proses membuka cabang baru', false],
                ],
            ],

            // Manajemen Keuangan Perbankan (D3)
            [
                'text' => 'Apa arti dari istilah "likuiditas" dalam keuangan?',
                'major_id' => 4,
                'options' => [
                    ['Kemampuan membayar hutang jangka pendek', true],
                    ['Jumlah uang yang dipinjam', false],
                    ['Risiko investasi', false],
                    ['Laju inflasi', false],
                ],
            ],
            [
                'text' => 'Apa fungsi utama bank sentral?',
                'major_id' => 4,
                'options' => [
                    ['Memberi pinjaman langsung ke masyarakat', false],
                    ['Mengatur inflasi dan stabilitas moneter', true],
                    ['Mengelola rekening tabungan', false],
                    ['Menjual produk asuransi', false],
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