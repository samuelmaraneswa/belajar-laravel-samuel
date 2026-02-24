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
        'content' => <<<HTML
<p style="line-height: 2;"><strong>Progressive overload</strong> adalah prinsip latihan di mana kamu secara bertahap meningkatkan beban atau tantangan latihan agar otot terus beradaptasi dan berkembang.</p>
<p>Tanpa progressive overload = tidak ada perkembangan.</p>
HTML,
        'status' => 'published',
        'created_at' => '2026-02-17 19:57:24',
        'updated_at' => '2026-02-24 08:17:24',
      ],
      [
        'id' => 2,
        'title' => 'Olahraga Menjadi Pelarian',
        'slug' => 'olahraga-menjadi-pelarian',
        'image' => 'articles/QBZsqbrhXVNF2yBsHU7zqXG5mHgV4dep0mNVfF0X.png',
        'thumb' => 'articles/thumb/QBZsqbrhXVNF2yBsHU7zqXG5mHgV4dep0mNVfF0X.webp',
        'video' => null,
        'content' => <<<HTML
<p style="line-height: 2;"><strong>Olahraga</strong> bisa menjadi <strong>pelarian (coping mechanism)</strong> karena ia memberi jalan cepat untuk melepaskan tekanan fisik dan mental.</p>

<p>Singkatnya ada 4 alasan utama:</p>

<p style="line-height: 2;"><strong>1. Melepaskan Stress Secara Biologis</strong></p>
<p style="line-height: 2;">Saat olahraga, tubuh melepaskan:</p>
<ul>
<li style="line-height: 2;">Endorfin → hormon “bahagia”</li>
<li style="line-height: 2;">Dopamin → rasa reward</li>
<li style="line-height: 2;">Serotonin → stabilkan mood</li>
</ul>
<p style="line-height: 2;">Itu membuat pikiran terasa lebih ringan setelah latihan.</p>

<p style="line-height: 2;"><strong>2. Mengalihkan Fokus Pikiran</strong></p>
<p>Ketika latihan:</p>
<ul>
<li><p style="line-height: 2;">Kamu fokus ke napas</p></li>
<li><p>Fokus ke repetisi</p></li>
<li><p style="line-height: 2;">Fokus ke teknik</p></li>
</ul>
<p>Otak berhenti memikirkan masalah sementara waktu.</p>
<p>Itu seperti “mental reset”.</p>

<p style="line-height: 2;"><strong>3. Memberi Rasa Kontrol</strong></p>
<p style="line-height: 2;">Saat hidup terasa tidak terkontrol, olahraga memberi:</p>
<ul>
<li><p style="line-height: 2;">Progress terukur</p></li>
<li><p>Target jelas</p></li>
<li><p style="line-height: 2;">Hasil nyata</p></li>
</ul>

<p style="line-height: 2;">Misalnya:</p>
<ul>
<li><p style="line-height: 2;">Beban naik</p></li>
<li><p>Reps bertambah</p></li>
<li><p style="line-height: 2;">Skill membaik</p></li>
</ul>
<p>Itu memberi rasa stabil.</p>

<p style="line-height: 2;"><strong>4. Penyaluran Emosi</strong></p>
<p style="line-height: 2;">Marah, kecewa, stres → bisa disalurkan lewat:</p>
<ul>
<li><p style="line-height: 2;">Angkat beban</p></li>
<li><p>Sprint</p></li>
<li><p>HIIT</p></li>
<li><p style="line-height: 2;">Calisthenics</p></li>
</ul>
<p>Daripada dipendam, energi negatif dialihkan jadi output fisik.</p>
HTML,
        'status' => 'published',
        'created_at' => '2026-02-18 18:28:12',
        'updated_at' => '2026-02-24 08:17:02',
      ],
      [
        'id' => 3,
        'title' => 'Apa itu Disiplin?',
        'slug' => 'apa-itu-disiplin',
        'image' => 'articles/0dpNYhUyAY3T2mh55pHnReJQUHzf335afpEEUds8.png',
        'thumb' => 'articles/thumb/0dpNYhUyAY3T2mh55pHnReJQUHzf335afpEEUds8.webp',
        'video' => null,
        'content' => <<<HTML
<p style="line-height: 2;"><strong>Disiplin</strong> adalah kemampuan untuk tetap melakukan sesuatu yang perlu dilakukan,<br>meskipun kamu tidak sedang ingin melakukannya.</p>

<p style="line-height: 2;">Sederhananya:</p>

<blockquote>
<p style="line-height: 2;">Disiplin = konsisten melakukan yang benar, walau mood tidak mendukung.</p>
</blockquote>

<p style="line-height: 2;">Contoh sederhana:</p>
<ul>
<li><p style="line-height: 2;">Bangun pagi walau masih ngantuk</p></li>
<li><p style="line-height: 2;">Tetap gym walau lagi malas</p></li>
<li><p style="line-height: 2;">Tetap kerja walau sedang tidak semangat</p></li>
</ul>

<p>Itu disiplin.</p>

<h2 style="line-height: 2;">Disiplin vs Motivasi</h2>
<ul>
<li><p style="line-height: 2;"><strong>Motivasi</strong> → datang dan pergi</p></li>
<li><p style="line-height: 2;"><strong>Disiplin</strong> → tetap jalan walau motivasi hilang</p></li>
</ul>

<p style="line-height: 2;">Makanya orang yang berhasil biasanya bukan yang paling termotivasi,<br>tapi yang paling konsisten.</p>

<h2 style="line-height: 2;">Dalam konteks gym</h2>
<p style="line-height: 2;">Kalau kamu tetap latihan saat:</p>
<ul>
<li><p style="line-height: 2;">Lagi banyak masalah</p></li>
<li><p style="line-height: 2;">Lagi capek</p></li>
<li><p style="line-height: 2;">Lagi tidak mood</p></li>
</ul>

<p style="line-height: 2;">Itu bukan cuma pelarian.<br>Itu disiplin.</p>

<p>🎯 Intinya:</p>
<p style="line-height: 2;">Disiplin bukan soal keras ke diri sendiri.<br>Tapi soal komitmen pada versi diri yang ingin kamu bangun.</p>
HTML,
        'status' => 'published',
        'created_at' => '2026-02-18 18:35:23',
        'updated_at' => '2026-02-24 08:12:28',
      ],
      [
        'id' => 4,
        'title' => 'Split Workout yang Efisien: Cara Cerdas Meningkatkan Massa Otot Tanpa Overtraining',
        'slug' => 'split-workout-yang-efisien-cara-cerdas-meningkatkan-massa-otot-tanpa-overtraining',
        'image' => 'articles/UKKL1Cr7neHVlysKRvM8NxdBOjyhcVbFMlvmNvyT.png',
        'thumb' => 'articles/thumb/UKKL1Cr7neHVlysKRvM8NxdBOjyhcVbFMlvmNvyT.webp',
        'video' => null,
        'content' => <<<HTML
<p>Dalam dunia gym, banyak orang berpikir bahwa semakin lama latihan, semakin baik hasilnya. Padahal kenyataannya, <strong>efisiensi jauh lebih penting daripada durasi</strong>.</p>

<p>Salah satu metode paling efektif untuk membangun otot dan meningkatkan performa adalah <strong>split workout</strong>.</p>

<p><img src="../storage/articles/kKIqx4zDU6LIoVeNNWdcGTIZ7CjNaJIimIvGHD04.png" alt="" width="600" height="600"></p>

<p>Split workout adalah metode latihan yang membagi sesi latihan berdasarkan kelompok otot tertentu dalam hari yang berbeda.</p>

<p>Contohnya:</p>
<ul>
<li><p><strong>Push</strong> (Dada, Bahu, Triceps)</p></li>
<li><p><strong>Pull</strong> (Punggung, Biceps)</p></li>
<li><p><strong>Legs</strong> (Kaki &amp; Glutes)</p></li>
</ul>

<p><strong>Mengapa Split Workout Itu Efisien?</strong></p>

<p><strong>1. Fokus Lebih Dalam pada Otot Tertentu</strong></p>
<p>Dengan membagi otot per hari, kamu bisa:</p>
<ul>
<li><p>Memberikan volume latihan optimal</p></li>
<li><p>Meningkatkan koneksi mind-muscle</p></li>
<li><p>Mengurangi distraksi dari otot lain</p></li>
</ul>
<p>Misalnya, saat hari Pull, seluruh energi difokuskan ke punggung dan biceps. Hasilnya? Stimulus lebih maksimal.</p>

<p><strong>2. Recovery Lebih Optimal</strong></p>
<p>Otot butuh waktu 48–72 jam untuk pulih.</p>
<ul>
<li><p>Otot yang dilatih hari ini bisa istirahat saat kamu melatih otot lain.</p></li>
<li><p>Risiko overtraining menurun.</p></li>
<li><p>Performa tetap stabil setiap sesi.</p></li>
</ul>

<p><strong>3. Volume Terkontrol, Bukan Asal Banyak</strong></p>
<p>Split workout membantu kamu:</p>
<ul>
<li><p>Mengatur total set per otot</p></li>
<li><p>Mengontrol intensitas</p></li>
<li><p>Mengoptimalkan progressive overload</p></li>
</ul>

<p><strong>4. Lebih Mudah Meningkatkan Beban (Progressive Overload)</strong></p>
<ul>
<li><p>Energi lebih terfokus</p></li>
<li><p>Beban bisa lebih berat</p></li>
<li><p>Performa lebih konsisten</p></li>
</ul>

<p><strong>5. Cocok untuk Intermediate &amp; Advanced</strong></p>
<p>Split workout menjadi lebih efisien karena recovery menjadi faktor penting dan total set mingguan meningkat.</p>

<p><strong>Contoh Split Workout 5 Hari yang Efisien</strong></p>

<p><strong>Senin – Push</strong></p>
<ul>
<li><p>Bench Press</p></li>
<li><p>Overhead Press</p></li>
<li><p>Incline Dumbbell Press</p></li>
<li><p>Lateral Raise</p></li>
<li><p>Triceps Pushdown</p></li>
</ul>

<p><strong>Selasa – Pull</strong></p>
<ul>
<li><p>Pull Up / Lat Pulldown</p></li>
<li><p>Barbell Row</p></li>
<li><p>Face Pull</p></li>
<li><p>Dumbbell Curl</p></li>
<li><p>Hammer Curl</p></li>
</ul>

<p><strong>Rabu – Legs</strong></p>
<ul>
<li><p>Squat</p></li>
<li><p>Romanian Deadlift</p></li>
<li><p>Leg Press</p></li>
<li><p>Leg Curl</p></li>
<li><p>Calf Raise</p></li>
</ul>

<p><strong>Kamis – Rest / Cardio ringan</strong></p>

<p><strong>Jumat – Upper (volume ringan)</strong></p>

<p>Latihan bukan tentang siapa paling lama di gym.<br>
Latihan adalah tentang siapa paling konsisten dan terstruktur.</p>

<p>Jika tujuanmu adalah membangun otot dengan progres stabil dan aman, split workout adalah strategi yang sangat layak digunakan.</p>
HTML,
        'status' => 'published',
        'created_at' => '2026-02-19 01:01:04',
        'updated_at' => '2026-02-24 08:09:39',
      ],
    ]);
  }
}
