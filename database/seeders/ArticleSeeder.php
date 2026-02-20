<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;

class ArticleSeeder extends Seeder
{
  public function run(): void
  {
    Article::insert([
      [
        'id' => 1,
        'title' => 'Apa Itu Progressive Overload???',
        'slug' => 'apa-itu-progressive-overload',
        'image' => 'articles/BddCmpWgl9FzyARXnnuLTnX5x2HoI85KTH80RiIa.png',
        'thumb' => 'articles/thumb/BddCmpWgl9FzyARXnnuLTnX5x2HoI85KTH80RiIa.webp',
        'video' => null,
        'content' => '<p><strong>Progressive overload</strong> adalah prinsip latihan di mana kamu secara bertahap meningkatkan beban atau tantangan latihan agar otot terus beradaptasi dan berkembang.</p>
                <p>Tanpa progressive overload = tidak ada perkembangan.</p>',
        'status' => 'published',
        'created_at' => '2026-02-18 02:57:24',
        'updated_at' => '2026-02-19 01:14:52',
      ],
      [
        'id' => 2,
        'title' => 'Olahraga Menjadi Pelarian',
        'slug' => 'olahraga-menjadi-pelarian',
        'image' => 'articles/QBZsqbrhXVNF2yBsHU7zqXG5mHgV4dep0mNVfF0X.png',
        'thumb' => 'articles/thumb/QBZsqbrhXVNF2yBsHU7zqXG5mHgV4dep0mNVfF0X.webp',
        'video' => null,
        'content' => '<p style=\"line-height: 2;\"><strong>Olahraga</strong> bisa menjadi <strong data-start=\"22\" data-end=\"53\">pelarian (coping mechanism)</strong> karena ia memberi jalan cepat untuk melepaskan tekanan fisik dan mental.&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>Singkatnya ada 4 alasan utama:</p>\r\n<p>&nbsp;</p>\r\n<p style=\"line-height: 2;\">&nbsp; &nbsp; 1. Melepaskan Stress Secara Biologis&nbsp;</p>\r\n<p style=\"line-height: 2;\">Saat olahraga, tubuh melepaskan:</p>\r\n<ul>\r\n<li data-start=\"239\" data-end=\"272\">\r\n<p style=\"line-height: 2;\" data-start=\"241\" data-end=\"272\">Endorfin &rarr; hormon &ldquo;bahagia&rdquo;</p>\r\n</li>\r\n<li style=\"line-height: 2;\" data-start=\"273\" data-end=\"296\">\r\n<p data-start=\"275\" data-end=\"296\">Dopamin &rarr; rasa reward</p>\r\n</li>\r\n<li data-start=\"297\" data-end=\"325\">\r\n<p style=\"line-height: 2;\" data-start=\"299\" data-end=\"325\">Serotonin &rarr; stabilkan mood</p>\r\n</li>\r\n</ul>\r\n<p style=\"line-height: 2;\" data-start=\"299\" data-end=\"325\">Itu membuat pikiran terasa lebih ringan setelah latihan.</p>\r\n<p style=\"line-height: 2;\">&nbsp;</p>\r\n<p style=\"line-height: 2;\">&nbsp; &nbsp; 2. Mengalihkan Fokus Pikiran</p>\r\n<p style=\"line-height: 2;\">Ketika latihan:</p>\r\n<ul>\r\n<li><p style=\"line-height: 2;\">Kamu fokus ke napas</p></li>\r\n<li><p>Fokus ke repetisi</p></li>\r\n<li><p style=\"line-height: 2;\">Fokus ke teknik</p></li>\r\n</ul>\r\n<p style=\"line-height: 2;\">Otak berhenti memikirkan masalah sementara waktu.</p>\r\n<p style=\"line-height: 2;\">Itu seperti &ldquo;mental reset&rdquo;.</p>\r\n<p style=\"line-height: 2;\">&nbsp;</p>\r\n<p style=\"line-height: 2;\">&nbsp; &nbsp; 3. Memberi Rasa Kontrol</p>\r\n<p style=\"line-height: 2;\">Saat hidup terasa tidak terkontrol, olahraga memberi:</p>\r\n<ul>\r\n<li><p style=\"line-height: 2;\">Progress terukur</p></li>\r\n<li><p>Target jelas</p></li>\r\n<li><p style=\"line-height: 2;\">Hasil nyata</p></li>\r\n</ul>\r\n<p style=\"line-height: 2;\">Misalnya:</p>\r\n<ul>\r\n<li><p style=\"line-height: 2;\">Beban naik</p></li>\r\n<li><p>Reps bertambah</p></li>\r\n<li><p style=\"line-height: 2;\">Skill membaik</p></li>\r\n</ul>\r\n<p style=\"line-height: 2;\">Itu memberi rasa stabil.</p>\r\n<p style=\"line-height: 2;\">&nbsp;</p>\r\n<p style=\"line-height: 2;\">&nbsp; &nbsp; 4. Penyaluran Emosi</p>\r\n<p style=\"line-height: 2;\">Marah, kecewa, stres &rarr; bisa disalurkan lewat:</p>\r\n<ul>\r\n<li><p style=\"line-height: 2;\">Angkat beban</p></li>\r\n<li><p>Sprint</p></li>\r\n<li><p>HIIT</p></li>\r\n<li><p style=\"line-height: 2;\">Calisthenics</p></li>\r\n</ul>\r\n<p style=\"line-height: 2;\">Daripada dipendam, energi negatif dialihkan jadi output fisik.</p>',
        'status' => 'published',
        'created_at' => '2026-02-19 01:28:12',
        'updated_at' => '2026-02-19 01:29:26',
      ],
      [
        'id' => 3,
        'title' => 'Apa itu Disiplin?',
        'slug' => 'apa-itu-disiplin',
        'image' => 'articles/0dpNYhUyAY3T2mh55pHnReJQUHzf335afpEEUds8.png',
        'thumb' => 'articles/thumb/0dpNYhUyAY3T2mh55pHnReJQUHzf335afpEEUds8.webp',
        'video' => null,
        'content' => '<p style=\"line-height: 2;\"><strong data-start=\"0\" data-end=\"12\">Disiplin</strong> adalah kemampuan untuk tetap melakukan sesuatu yang perlu dilakukan,<br data-start=\"81\" data-end=\"84\">meskipun kamu tidak sedang ingin melakukannya.</p>\r\n<p style=\"line-height: 2;\">&nbsp;</p>\r\n<p style=\"line-height: 2;\" data-start=\"132\" data-end=\"145\">Sederhananya:</p>\r\n<blockquote data-start=\"147\" data-end=\"219\">\r\n<p style=\"line-height: 2;\" data-start=\"149\" data-end=\"219\">Disiplin = konsisten melakukan yang benar, walau mood tidak mendukung.</p>\r\n</blockquote>\r\n<p style=\"line-height: 2;\">&nbsp;</p>\r\n<p style=\"line-height: 2;\">Contoh sederhana</p>\r\n<ul>\r\n<li><p style=\"line-height: 2;\">Bangun pagi walau masih ngantuk</p></li>\r\n<li><p>Tetap gym walau lagi malas</p></li>\r\n<li><p style=\"line-height: 2;\">Tetap kerja walau sedang tidak semangat</p></li>\r\n</ul>\r\n<p>Itu disiplin.</p>\r\n<p>&nbsp;</p>\r\n<h2 style=\"line-height: 2;\"><span style=\"font-size: 14pt;\">Disiplin vs Motivasi</span></h2>\r\n<ul>\r\n<li><p style=\"line-height: 2;\"><strong>Motivasi</strong> &rarr; datang dan pergi</p></li>\r\n<li><p style=\"line-height: 2;\"><strong>Disiplin</strong> &rarr; tetap jalan walau motivasi hilang</p></li>\r\n</ul>\r\n<p style=\"line-height: 2;\">Makanya orang yang berhasil biasanya bukan yang paling termotivasi,<br>tapi yang paling konsisten.</p>\r\n<p>&nbsp;</p>\r\n<h2 style=\"line-height: 2;\"><span style=\"font-size: 14pt;\">Dalam konteks gym</span></h2>\r\n<p style=\"line-height: 2;\">Kalau kamu tetap latihan saat:</p>\r\n<ul>\r\n<li><p style=\"line-height: 2;\">Lagi banyak masalah</p></li>\r\n<li><p>Lagi capek</p></li>\r\n<li><p style=\"line-height: 2;\">Lagi tidak mood</p></li>\r\n</ul>\r\n<p style=\"line-height: 2;\">Itu bukan cuma pelarian.<br>Itu disiplin.</p>\r\n<p>&nbsp;</p>\r\n<p style=\"line-height: 2;\">🎯 Intinya:</p>\r\n<p style=\"line-height: 2;\">Disiplin bukan soal keras ke diri sendiri.<br>Tapi soal komitmen pada versi diri yang ingin kamu bangun.</p>',
        'status' => 'published',
        'created_at' => '2026-02-19 01:35:23',
        'updated_at' => '2026-02-19 01:47:31',
      ],
      [
        'id' => 4,
        'title' => 'Split Workout yang Efisien: Cara Cerdas Meningkatkan Massa Otot Tanpa Overtraining',
        'slug' => 'split-workout-yang-efisien-cara-cerdas-meningkatkan-massa-otot-tanpa-overtraining',
        'image' => 'articles/UKKL1Cr7neHVlysKRvM8NxdBOjyhcVbFMlvmNvyT.png',
        'thumb' => 'articles/thumb/UKKL1Cr7neHVlysKRvM8NxdBOjyhcVbFMlvmNvyT.webp',
        'video' => null,
        'content' => '<p style=\"line-height: 2;\">Dalam dunia gym, banyak orang berpikir bahwa semakin lama latihan, semakin baik hasilnya. Padahal kenyataannya, <strong data-start=\"454\" data-end=\"502\">efisiensi jauh lebih penting daripada durasi</strong>.</p>\r\n<p style=\"line-height: 2;\">&nbsp;</p>\r\n<p style=\"line-height: 2;\">Salah satu metode paling efektif untuk membangun otot dan meningkatkan performa adalah <strong data-start=\"592\" data-end=\"609\">split workout</strong>.</p>\r\n<p style=\"line-height: 2;\">&nbsp;</p>\r\n<p style=\"line-height: 2;\"><img src=\"../storage/articles/GuTTsSxyzwmbE9M3NLVYETLgO0CZHVuGxjJ0u9WM.jpg\" alt=\"\" width=\"613\" height=\"920\"></p>\r\n<p style=\"line-height: 2;\">&nbsp;</p>\r\n<p style=\"line-height: 2;\">Split workout adalah metode latihan yang membagi sesi latihan berdasarkan kelompok otot tertentu dalam hari yang berbeda.</p>\r\n<p style=\"line-height: 2;\">&nbsp;</p>\r\n<p style=\"line-height: 2;\">Contohnya:</p>\r\n<ul>\r\n<li><p style=\"line-height: 2;\"><strong>Push</strong> (Dada, Bahu, Triceps)</p></li>\r\n<li><p><strong>Pull</strong> (Punggung, Biceps)</p></li>\r\n<li><p style=\"line-height: 2;\"><strong>Legs</strong> (Kaki &amp; Glutes)</p></li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<p style=\"line-height: 2;\"><strong><span style=\"font-size: 14pt;\">Mengapa Split Workout Itu Efisien?</span></strong></p>\r\n<p style=\"line-height: 2;\">&nbsp;</p>\r\n<p style=\"line-height: 2;\">&nbsp; &nbsp; 1. Fokus Lebih Dalam pada Otot Tertentu</p>\r\n<p style=\"line-height: 2;\">Dengan membagi otot per hari, kamu bisa:</p>\r\n<ul>\r\n<li><p style=\"line-height: 2;\">Memberikan volume latihan optimal</p></li>\r\n<li><p>Meningkatkan koneksi mind-muscle</p></li>\r\n<li><p style=\"line-height: 2;\">Mengurangi distraksi dari otot lain</p></li>\r\n</ul>\r\n<p style=\"line-height: 2;\">Misalnya, saat hari Pull, seluruh energi difokuskan ke punggung dan biceps.</p>\r\n<p style=\"line-height: 2;\">Hasilnya? Stimulus lebih maksimal.</p>\r\n<p>&nbsp;</p>\r\n<p style=\"line-height: 2;\">&nbsp; &nbsp; 2. Recovery Lebih Optimal</p>\r\n<p style=\"line-height: 2;\">Otot butuh waktu 48&ndash;72 jam untuk pulih.</p>\r\n<p style=\"line-height: 2;\">Dengan split workout:</p>\r\n<ul>\r\n<li><p style=\"line-height: 2;\">Otot yang dilatih hari ini bisa istirahat saat kamu melatih otot lain.</p></li>\r\n<li><p>Risiko overtraining menurun.</p></li>\r\n<li><p style=\"line-height: 2;\">Performa tetap stabil setiap sesi.</p></li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<p style=\"line-height: 2;\">&nbsp; &nbsp; 3. Volume Terkontrol, Bukan Asal Banyak</p>\r\n<p style=\"line-height: 2;\">Split workout membantu kamu:</p>\r\n<ul>\r\n<li><p style=\"line-height: 2;\">Mengatur total set per otot</p></li>\r\n<li><p>Mengontrol intensitas</p></li>\r\n<li><p style=\"line-height: 2;\">Mengoptimalkan progressive overload</p></li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<p style=\"line-height: 2;\">&nbsp; &nbsp; 4. Lebih Mudah Meningkatkan Beban (Progressive Overload)</p>\r\n<ul>\r\n<li><p style=\"line-height: 2;\">Energi lebih terfokus</p></li>\r\n<li><p>Beban bisa lebih berat</p></li>\r\n<li><p style=\"line-height: 2;\">Performa lebih konsisten</p></li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<p style=\"line-height: 2;\">&nbsp; &nbsp; 5. Cocok untuk Intermediate &amp; Advanced</p>\r\n<p style=\"line-height: 2;\">Split workout menjadi lebih efisien karena recovery menjadi faktor penting dan total set mingguan meningkat.</p>\r\n<p>&nbsp;</p>\r\n<p><strong>Contoh Split Workout 5 Hari yang Efisien</strong></p>\r\n<p>&nbsp;</p>\r\n<p><strong>Senin – Push</strong></p>\r\n<ul>\r\n<li><p style=\"line-height: 2;\">Bench Press</p></li>\r\n<li><p style=\"line-height: 2;\">Overhead Press</p></li>\r\n<li><p>Incline Dumbbell Press</p></li>\r\n<li><p>Lateral Raise</p></li>\r\n<li><p style=\"line-height: 2;\">Triceps Pushdown</p></li>\r\n</ul>\r\n<p><strong>Selasa – Pull</strong></p>\r\n<ul>\r\n<li><p style=\"line-height: 2;\">Pull Up / Lat Pulldown</p></li>\r\n<li><p>Barbell Row</p></li>\r\n<li><p>Face Pull</p></li>\r\n<li><p>Dumbbell Curl</p></li>\r\n<li><p style=\"line-height: 2;\">Hammer Curl</p></li>\r\n</ul>\r\n<p><strong>Rabu – Legs</strong></p>\r\n<ul>\r\n<li><p style=\"line-height: 2;\">Squat</p></li>\r\n<li><p>Romanian Deadlift</p></li>\r\n<li><p>Leg Press</p></li>\r\n<li><p>Leg Curl</p></li>\r\n<li><p style=\"line-height: 2;\">Calf Raise</p></li>\r\n</ul>\r\n<p><strong>Kamis – Rest / Cardio ringan</strong></p>\r\n<p><strong>Jumat – Upper (volume ringan)</strong></p>\r\n<p>&nbsp;</p>\r\n<p style=\"line-height: 2;\">Latihan bukan tentang siapa paling lama di gym.<br>Latihan adalah tentang siapa paling konsisten dan terstruktur.</p>\r\n<p style=\"line-height: 2;\">Jika tujuanmu adalah membangun otot dengan progres stabil dan aman, split workout adalah strategi yang sangat layak digunakan.</p>',
        'status' => 'published',
        'created_at' => '2026-02-19 08:01:04',
        'updated_at' => '2026-02-19 08:42:02',
      ],
    ]);
  }
}
