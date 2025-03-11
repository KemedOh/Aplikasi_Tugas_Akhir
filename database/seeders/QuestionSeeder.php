<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $questions = [
            // D3 Manajemen Pemasaran
            ['question' => 'Apakah Anda menikmati berkomunikasi dengan orang lain?', 'type' => 'MCQ', 'category' => 'spesifik', 'major_id' => 1],
            ['question' => 'Apakah Anda suka merancang strategi untuk menarik perhatian orang?', 'type' => 'MCQ', 'category' => 'spesifik', 'major_id' => 1],
            ['question' => 'Apakah Anda tertarik untuk memahami perilaku konsumen?', 'type' => 'MCQ', 'category' => 'spesifik', 'major_id' => 1],
            ['question' => 'Apakah Anda suka berbicara di depan umum atau melakukan presentasi?', 'type' => 'MCQ', 'category' => 'spesifik', 'major_id' => 1],
            ['question' => 'Apakah Anda memiliki ketertarikan dalam dunia periklanan dan promosi?', 'type' => 'MCQ', 'category' => 'spesifik', 'major_id' => 1],
            ['question' => 'Apakah Anda senang menganalisis tren pasar dan kebutuhan pelanggan?', 'type' => 'MCQ', 'category' => 'spesifik', 'major_id' => 1],
            ['question' => 'Apakah Anda suka bekerja dalam tim dan berkoordinasi dengan banyak orang?', 'type' => 'MCQ', 'category' => 'spesifik', 'major_id' => 1],
            ['question' => 'Apakah Anda tertarik dalam bidang digital marketing dan media sosial?', 'type' => 'MCQ', 'category' => 'spesifik', 'major_id' => 1],
            ['question' => 'Apakah Anda senang dengan tantangan dalam mencapai target penjualan?', 'type' => 'MCQ', 'category' => 'spesifik', 'major_id' => 1],
            ['question' => 'Apakah Anda merasa percaya diri dalam membangun relasi dengan klien atau pelanggan?', 'type' => 'MCQ', 'category' => 'spesifik', 'major_id' => 1],

            // D3 Manajemen Keuangan Perbankan
            ['question' => 'Apakah Anda merasa nyaman bekerja dengan angka dan perhitungan?', 'type' => 'MCQ', 'category' => 'spesifik', 'major_id' => 2],
            ['question' => 'Apakah Anda tertarik untuk mengelola keuangan dan investasi?', 'type' => 'MCQ', 'category' => 'spesifik', 'major_id' => 2],
            ['question' => 'Apakah Anda memiliki ketelitian dalam mencatat transaksi keuangan?', 'type' => 'MCQ', 'category' => 'spesifik', 'major_id' => 2],
            ['question' => 'Apakah Anda tertarik dengan konsep perbankan dan ekonomi?', 'type' => 'MCQ', 'category' => 'spesifik', 'major_id' => 2],
            ['question' => 'Apakah Anda merasa puas jika berhasil menyusun laporan keuangan yang akurat?', 'type' => 'MCQ', 'category' => 'spesifik', 'major_id' => 2],
            ['question' => 'Apakah Anda senang menganalisis keuntungan dan risiko dalam suatu keputusan keuangan?', 'type' => 'MCQ', 'category' => 'spesifik', 'major_id' => 2],
            ['question' => 'Apakah Anda ingin memahami bagaimana sistem perbankan bekerja?', 'type' => 'MCQ', 'category' => 'spesifik', 'major_id' => 2],
            ['question' => 'Apakah Anda merasa nyaman dalam memberikan layanan kepada nasabah atau klien?', 'type' => 'MCQ', 'category' => 'spesifik', 'major_id' => 2],
            ['question' => 'Apakah Anda memiliki minat dalam perencanaan keuangan pribadi atau bisnis?', 'type' => 'MCQ', 'category' => 'spesifik', 'major_id' => 2],
            ['question' => 'Apakah Anda tertarik dengan investasi seperti saham, obligasi, atau reksa dana?', 'type' => 'MCQ', 'category' => 'spesifik', 'major_id' => 2],

            // D2 Teknik Otomotif
            ['question' => 'Apakah Anda suka membongkar dan merakit mesin atau alat mekanik?', 'type' => 'MCQ', 'category' => 'spesifik', 'major_id' => 3],
            ['question' => 'Apakah Anda tertarik untuk memahami cara kerja kendaraan bermotor?', 'type' => 'MCQ', 'category' => 'spesifik', 'major_id' => 3],
            ['question' => 'Apakah Anda lebih suka belajar secara praktik daripada teori?', 'type' => 'MCQ', 'category' => 'spesifik', 'major_id' => 3],
            ['question' => 'Apakah Anda merasa puas saat berhasil memperbaiki sesuatu yang rusak?', 'type' => 'MCQ', 'category' => 'spesifik', 'major_id' => 3],
            ['question' => 'Apakah Anda tertarik dengan teknologi terbaru dalam dunia otomotif?', 'type' => 'MCQ', 'category' => 'spesifik', 'major_id' => 3],
            ['question' => 'Apakah Anda senang bekerja dengan tangan dan menggunakan alat-alat teknik?', 'type' => 'MCQ', 'category' => 'spesifik', 'major_id' => 3],
            ['question' => 'Apakah Anda ingin memahami cara meningkatkan performa mesin kendaraan?', 'type' => 'MCQ', 'category' => 'spesifik', 'major_id' => 3],
            ['question' => 'Apakah Anda memiliki ketertarikan dalam bidang keselamatan dan efisiensi kendaraan?', 'type' => 'MCQ', 'category' => 'spesifik', 'major_id' => 3],
            ['question' => 'Apakah Anda senang dengan tantangan dalam menyelesaikan masalah teknis?', 'type' => 'MCQ', 'category' => 'spesifik', 'major_id' => 3],
            ['question' => 'Apakah Anda tertarik untuk bekerja di industri otomotif atau bengkel kendaraan?', 'type' => 'MCQ', 'category' => 'spesifik', 'major_id' => 3],

            // D2 Teknik Informatika
            ['question' => 'Apakah Anda menikmati logika dan pemecahan masalah dalam pemrograman?', 'type' => 'MCQ', 'category' => 'spesifik', 'major_id' => 4],
            ['question' => 'Apakah Anda tertarik untuk membuat aplikasi atau website?', 'type' => 'MCQ', 'category' => 'spesifik', 'major_id' => 4],
            ['question' => 'Apakah Anda memiliki keinginan untuk memahami bagaimana sistem komputer bekerja?', 'type' => 'MCQ', 'category' => 'spesifik', 'major_id' => 4],
            ['question' => 'Apakah Anda tertarik dengan keamanan siber dan perlindungan data?', 'type' => 'MCQ', 'category' => 'spesifik', 'major_id' => 4],
            ['question' => 'Apakah Anda suka mencoba memecahkan masalah dengan kode atau algoritma?', 'type' => 'MCQ', 'category' => 'spesifik', 'major_id' => 4],
            ['question' => 'Apakah Anda tertarik dengan kecerdasan buatan dan teknologi terbaru?', 'type' => 'MCQ', 'category' => 'spesifik', 'major_id' => 4],
            ['question' => 'Apakah Anda senang mempelajari bahasa pemrograman seperti Python atau JavaScript?', 'type' => 'MCQ', 'category' => 'spesifik', 'major_id' => 4],
            ['question' => 'Apakah Anda merasa puas saat berhasil memperbaiki bug dalam sebuah program?', 'type' => 'MCQ', 'category' => 'spesifik', 'major_id' => 4],
            ['question' => 'Apakah Anda tertarik dengan jaringan komputer dan cara kerja internet?', 'type' => 'MCQ', 'category' => 'spesifik', 'major_id' => 4],
            ['question' => 'Apakah Anda ingin bekerja sebagai pengembang perangkat lunak atau analis sistem?', 'type' => 'MCQ', 'category' => 'spesifik', 'major_id' => 4],

        ];

        foreach ($questions as $data) {
            Question::create($data);
    }
}
}