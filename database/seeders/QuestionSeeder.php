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
            [
                'text' => 'Dalam konsep OOP di PHP, apa yang terjadi jika sebuah class mengimplementasikan interface namun tidak meng-override semua metodenya?',
                'major_id' => 1,
                'options' => [
                    ['Class akan tetap berjalan tanpa masalah', false],
                    ['Akan terjadi error saat runtime', false],
                    ['Akan terjadi fatal error saat kompilasi', true],
                    ['PHP akan mengisi metode yang hilang secara otomatis', false],
                ],
            ],
            [
                'text' => 'Manakah pernyataan yang **benar** tentang “Closure” dalam konteks PHP?',
                'major_id' => 1,
                'options' => [
                    ['Closure adalah class abstrak', false],
                    ['Closure adalah fungsi anonim yang bisa menyimpan state', true],
                    ['Closure hanya bisa digunakan di dalam loop', false],
                    ['Closure adalah bentuk lain dari interface', false],
                ],
            ],
            [
                'text' => 'Apa kegunaan dari perintah `use` pada closure di PHP?',
                'major_id' => 1,
                'options' => [
                    ['Untuk mengimpor file lain', false],
                    ['Untuk mengakses variabel luar dari dalam closure', true],
                    ['Untuk mendeklarasikan namespace', false],
                    ['Untuk membuat alias fungsi', false],
                ],
            ],
            [
                'text' => 'Dalam arsitektur MVC, bagian "Model" bertanggung jawab untuk?',
                'major_id' => 1,
                'options' => [
                    ['Menampilkan data ke user', false],
                    ['Menangani request dan response', false],
                    ['Berinteraksi dengan database dan logika bisnis', true],
                    ['Membuat routing aplikasi', false],
                ],
            ],
            [
                'text' => 'Apa perbedaan mendasar antara metode GET dan POST dalam HTTP request?',
                'major_id' => 1,
                'options' => [
                    ['GET lebih aman dari POST', false],
                    ['GET menyimpan data di body, POST di URL', false],
                    ['POST menyimpan data di body, GET di URL', true],
                    ['GET hanya untuk login, POST untuk logout', false],
                ],
            ],
            [
                'text' => 'Apa yang dimaksud dengan “race condition” dalam pemrograman paralel?',
                'major_id' => 1,
                'options' => [
                    ['Sebuah kondisi saat dua proses bergantian berjalan dengan sempurna', false],
                    ['Kesalahan ketika dua thread mencoba mengakses resource yang sama secara bersamaan', true],
                    ['Salah satu proses gagal mengakses database', false],
                    ['Kondisi saat proses gagal di compile karena error syntax', false],
                ],
            ],
            [
                'text' => 'Apa perbedaan utama antara algoritma BFS dan DFS dalam pencarian graf?',
                'major_id' => 1,
                'options' => [
                    ['BFS menggunakan stack, DFS menggunakan queue', false],
                    ['BFS menjelajah simpul lebih dalam dulu, DFS menyamping', false],
                    ['BFS menggunakan queue dan cocok untuk pencarian jalur terpendek, DFS menggunakan stack dan lebih cepat dalam pencarian kedalaman', true],
                    ['Tidak ada perbedaan yang signifikan', false],
                ],
            ],
            [
                'text' => 'Apa kegunaan utama dari konsep "closure" dalam JavaScript?',
                'major_id' => 1,
                'options' => [
                    ['Untuk menyimpan data dalam class OOP', false],
                    ['Untuk mengatur skoping variabel dalam perulangan', false],
                    ['Untuk mengakses variabel dari lingkungan luar fungsi meskipun sudah selesai dieksekusi', true],
                    ['Untuk menghapus memory secara otomatis', false],
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
            [
                'text' => 'Apa fungsi dari katup EGR (Exhaust Gas Recirculation) pada sistem emisi kendaraan?',
                'major_id' => 2,
                'options' => [
                    ['Menambah performa mesin saat akselerasi', false],
                    ['Mengurangi emisi NOx dengan mengalirkan kembali gas buang ke ruang bakar', true],
                    ['Mengontrol tekanan bahan bakar', false],
                    ['Meningkatkan putaran idle mesin', false],
                ],
            ],
            [
                'text' => 'Apa efek jika celah katup (valve clearance) terlalu rapat pada mesin 4 tak?',
                'major_id' => 2,
                'options' => [
                    ['Mesin menjadi lebih irit bahan bakar', false],
                    ['Katup bisa terbuka terlalu cepat dan rusak akibat overheat', true],
                    ['Kompressi mesin meningkat', false],
                    ['Torsi mesin akan meningkat', false],
                ],
            ],
            [
                'text' => 'Pada sistem pengapian konvensional, apa fungsi kondensor (capacitor) di distributor?',
                'major_id' => 2,
                'options' => [
                    ['Memperkuat percikan busi', false],
                    ['Mengurangi loncatan api pada platina dan mempercepat pemutusan arus primer', true],
                    ['Menurunkan suhu coil', false],
                    ['Menyimpan energi untuk starter', false],
                ],
            ],
            [
                'text' => 'Apa yang terjadi jika rasio campuran udara-bahan bakar terlalu kaya (rich)?',
                'major_id' => 2,
                'options' => [
                    ['Pembakaran menjadi sempurna dan bersih', false],
                    ['Emisi CO meningkat dan efisiensi menurun', true],
                    ['Mesin akan overheat', false],
                    ['Mesin tidak dapat menyala', false],
                ],
            ],
            [
                'text' => 'Komponen manakah yang **tidak** termasuk dalam sistem pelumasan mesin?',
                'major_id' => 2,
                'options' => [
                    ['Oil pump', false],
                    ['Oil filter', false],
                    ['Timing chain', true],
                    ['Crankcase', false],
                ],
            ],
            [
                'text' => 'Apa tujuan dari melakukan “run-out test” pada piringan rem (disc brake)?',
                'major_id' => 2,
                'options' => [
                    ['Mengukur ketebalan kampas rem', false],
                    ['Memastikan tidak ada kebocoran pada sistem rem hidrolik', false],
                    ['Mengukur penyimpangan rotasi piringan dari titik pusatnya', true],
                    ['Mengukur kecepatan kendaraan saat pengereman', false],
                ],
            ],
            [
                'text' => 'Mengapa timing belt yang aus harus segera diganti dalam mesin DOHC?',
                'major_id' => 2,
                'options' => [
                    ['Agar meningkatkan akselerasi mesin', false],
                    ['Untuk menjaga sistem pendinginan', false],
                    ['Karena kerusakan timing belt dapat menyebabkan piston dan katup bertabrakan, merusak mesin', true],
                    ['Untuk meningkatkan kompresi ruang bakar', false],
                ],
            ],
            [
                'text' => 'Apa fungsi VVT (Variable Valve Timing) dalam mesin modern?',
                'major_id' => 2,
                'options' => [
                    ['Mengatur jumlah bahan bakar yang disemprotkan ke injektor', false],
                    ['Mengubah waktu buka-tutup katup untuk efisiensi dan performa optimal', true],
                    ['Mengatur sistem transmisi otomatis', false],
                    ['Mengganti rasio kompresi mesin saat idle', false],
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
            [
                'text' => 'Apa perbedaan utama antara strategi **push** dan **pull** dalam pemasaran?',
                'major_id' => 3,
                'options' => [
                    ['Push fokus pada membangun loyalitas pelanggan, pull untuk distribusi', false],
                    ['Push menggunakan promosi langsung ke konsumen, pull menggunakan distribusi massal', false],
                    ['Push mendorong produk melalui channel distribusi, pull menarik konsumen agar mencari produk', true],
                    ['Keduanya merupakan strategi penentuan harga', false],
                ],
            ],
            [
                'text' => 'Mengapa analisis SWOT penting dalam perencanaan pemasaran strategis?',
                'major_id' => 3,
                'options' => [
                    ['Untuk mengukur keberhasilan promosi sebelumnya', false],
                    ['Untuk mengevaluasi kekuatan internal dan peluang eksternal bisnis', true],
                    ['Untuk menghitung biaya promosi digital', false],
                    ['Untuk merancang logo dan citra merek', false],
                ],
            ],
            [
                'text' => 'Apa yang dimaksud dengan “Customer Lifetime Value (CLV)” dalam konteks pemasaran?',
                'major_id' => 3,
                'options' => [
                    ['Nilai produk yang dibeli oleh pelanggan dalam satu transaksi', false],
                    ['Total pengeluaran pelanggan di semua kompetitor', false],
                    ['Perkiraan total keuntungan dari seorang pelanggan selama hubungan bisnis berlangsung', true],
                    ['Jumlah uang yang dihabiskan untuk kampanye iklan', false],
                ],
            ],
            [
                'text' => 'Dalam pemasaran digital, **bounce rate** yang tinggi biasanya mengindikasikan apa?',
                'major_id' => 3,
                'options' => [
                    ['Trafik situs sangat baik', false],
                    ['Pengguna sering melakukan pembelian ulang', false],
                    ['Pengunjung meninggalkan situs tanpa interaksi lebih lanjut', true],
                    ['Kinerja iklan yang sangat efektif', false],
                ],
            ],
            [
                'text' => 'Apa tujuan dari segmentasi psikografis dalam pemasaran?',
                'major_id' => 3,
                'options' => [
                    ['Membagi pasar berdasarkan tingkat penghasilan', false],
                    ['Membagi pasar berdasarkan lokasi geografis', false],
                    ['Membagi pasar berdasarkan gaya hidup, kepribadian, dan nilai konsumen', true],
                    ['Membagi pasar berdasarkan riwayat pembelian', false],
                ],
            ],
            [
                'text' => 'Apa peran **value proposition** dalam strategi pemasaran?',
                'major_id' => 3,
                'options' => [
                    ['Sebagai bentuk insentif diskon bulanan', false],
                    ['Untuk menyatakan keunggulan produk dalam memenuhi kebutuhan konsumen', true],
                    ['Untuk menjelaskan cara kerja sistem distribusi', false],
                    ['Sebagai nama lain dari fitur produk', false],
                ],
            ],
            [
                'text' => 'Apa perbedaan antara pemasaran transaksional dan pemasaran relasional?',
                'major_id' => 3,
                'options' => [
                    ['Transaksional berfokus pada hubungan jangka panjang, relasional hanya pada penjualan satu kali', false],
                    ['Transaksional berfokus pada penjualan satu kali, relasional menekankan hubungan jangka panjang dengan pelanggan', true],
                    ['Keduanya sama, hanya berbeda istilah', false],
                    ['Relasional hanya digunakan dalam e-commerce', false],
                ],
            ],
            [
                'text' => 'Apa fungsi utama dari analisis **Customer Journey Mapping**?',
                'major_id' => 3,
                'options' => [
                    ['Menentukan harga jual', false],
                    ['Menyusun struktur organisasi pemasaran', false],
                    ['Memahami tahapan interaksi pelanggan dengan brand untuk mengoptimalkan pengalaman mereka', true],
                    ['Mengetahui demografi pelanggan', false],
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
            [
                'text' => 'Apa tujuan dari analisis rasio **CAR (Capital Adequacy Ratio)** dalam dunia perbankan?',
                'major_id' => 4,
                'options' => [
                    ['Mengukur efisiensi biaya operasional bank', false],
                    ['Menentukan tingkat bunga pinjaman', false],
                    ['Menilai kecukupan modal bank untuk menanggung risiko kerugian', true],
                    ['Menghitung margin keuntungan bank', false],
                ],
            ],
            [
                'text' => 'Apa yang dimaksud dengan **duration** dalam manajemen portofolio obligasi?',
                'major_id' => 4,
                'options' => [
                    ['Lama jatuh tempo obligasi', false],
                    ['Ukuran sensitivitas harga obligasi terhadap perubahan suku bunga', true],
                    ['Jumlah bunga yang diterima per tahun', false],
                    ['Rasio antara kupon dan harga pasar', false],
                ],
            ],
            [
                'text' => 'Mengapa bank harus melakukan **stress testing** secara berkala?',
                'major_id' => 4,
                'options' => [
                    ['Untuk mempersiapkan audit internal', false],
                    ['Untuk menguji ketahanan terhadap kondisi ekonomi ekstrem', true],
                    ['Agar dapat menaikkan suku bunga kredit', false],
                    ['Sebagai syarat promosi produk baru', false],
                ],
            ],
            [
                'text' => 'Apa perbedaan utama antara **bank umum** dan **bank perkreditan rakyat (BPR)?**',
                'major_id' => 4,
                'options' => [
                    ['Bank umum hanya menerima deposito, BPR menerima giro dan tabungan', false],
                    ['BPR dilarang melakukan kegiatan valas dan kliring antarbank', true],
                    ['Bank umum tidak diawasi oleh OJK, BPR diawasi oleh BI', false],
                    ['Bank umum lebih kecil dibandingkan BPR', false],
                ],
            ],
            [
                'text' => 'Apa arti dari istilah **Net Interest Margin (NIM)**?',
                'major_id' => 4,
                'options' => [
                    ['Pendapatan bersih bank setelah dikurangi biaya operasional', false],
                    ['Selisih antara bunga yang diterima dan bunga yang dibayarkan dibandingkan aset produktif', true],
                    ['Jumlah pinjaman macet dalam satu periode', false],
                    ['Rasio laba bersih terhadap modal', false],
                ],
            ],
            [
                'text' => 'Apa risiko utama dari **mismatch maturity** dalam pengelolaan aset dan liabilitas bank?',
                'major_id' => 4,
                'options' => [
                    ['Kehilangan data nasabah', false],
                    ['Kehilangan lisensi perbankan', false],
                    ['Ketidakmampuan bank memenuhi kewajiban jangka pendek', true],
                    ['Peningkatan laba bersih', false],
                ],
            ],
            [
                'text' => 'Apa arti dari istilah **hedging** dalam manajemen risiko keuangan?',
                'major_id' => 4,
                'options' => [
                    ['Menimbun aset dalam bentuk fisik', false],
                    ['Membatasi akses terhadap data keuangan', false],
                    ['Strategi untuk mengurangi atau mengalihkan risiko fluktuasi harga atau nilai tukar', true],
                    ['Meningkatkan risiko untuk keuntungan maksimal', false],
                ],
            ],
            [
                'text' => 'Mengapa penting bagi bank untuk menjaga rasio Loan to Deposit Ratio (LDR) tetap seimbang?',
                'major_id' => 4,
                'options' => [
                    ['Agar dapat menghindari audit dari pemerintah', false],
                    ['Untuk menjamin bahwa semua pinjaman bersifat likuid', false],
                    ['Untuk menjaga likuiditas bank dan kemampuan membayar kewajiban jangka pendek', true],
                    ['Supaya bunga tabungan tetap tinggi', false],
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