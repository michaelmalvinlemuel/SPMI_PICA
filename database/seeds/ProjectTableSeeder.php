<?php

use Illuminate\Database\Seeder;

use App\Project;
use App\ProjectNode;
use App\ProjectForm;


class ProjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        include('spmi.php');
        
        $nextMonth = new DateTime;
        $nextMonth->add(new DateInterval('P1M'));
        
        DB::table('projects')->delete();
        Project::insert([
            [
                'name'          => 'Akreditasi Akademik Program Studi',
                'description'   => 'Akreditasi Akademik Program Studi',
                'date_start'    => new DateTime,
                'date_ended'    => $nextMonth,
                'user_id'       => '1',
                'status'        => '0',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ]
        ]);
        
        DB::table('project_nodes')->delete();
        ProjectNode::insert([
            //1     1
            [
                'name'          => 'STANDAR 1: VISI, MISI, TUJUAN DAN SASARAN, SERTA STRATEGI PENCAPAIAN',
                'description'   => 'STANDAR 1: VISI, MISI, TUJUAN DAN SASARAN, SERTA STRATEGI PENCAPAIAN',
                'project_id'    => '1',
                'project_type'  => 'App\Project',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //1.1   2
            [
                'name'          => 'Kejelasan,  kerealistikan, dan keterkaitan antar visi, misi, tujuan dan sasaran perguruan tinggi, dan pemangku kepentingan yang terlibat.',
                'description'   => '1.1. Kejelasan,  kerealistikan, dan keterkaitan antar visi, misi, tujuan dan sasaran perguruan tinggi, dan pemangku kepentingan yang terlibat.',
                'project_id'    => '1',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //1.1.1   3
            [
                'name'          => 'Kejelasan dan kerealistikan visi, misi, tujuan, dan sasaran Program Studi',
                'description'   => '1.1.a. Kejelasan dan kerealistikan visi, misi, tujuan, dan sasaran Program Studi',
                'project_id'    => '2',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //1.1.2   4
            [
                'name'          => 'Strategi pencapaian sasaran dengan rentang waktu yang jelas dan didukung oleh dokumen.',
                'description'   => '1.1.b. Strategi pencapaian sasaran dengan rentang waktu yang jelas dan didukung oleh dokumen.',
                'project_id'    => '2',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //1.2   5
            [
                'name'          => 'Sosialisasi yang efektif tercermin dari tingkat pemahaman pihak terkait.',
                'description'   => '1.2. Sosialisasi yang efektif tercermin dari tingkat pemahaman pihak terkait.',
                'project_id'    => '1',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //2     6
            [
                'name'          => 'STANDAR 2: TATA PAMONG, KEPEMIMPINAN, SISTEM PENGELOLAAN, DAN PENJAMINAN MUTU',
                'description'   => 'STANDAR 2: TATA PAMONG, KEPEMIMPINAN, SISTEM PENGELOLAAN, DAN PENJAMINAN MUTU',
                'project_id'    => '1',
                'project_type'  => 'App\Project',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //2.1   7
            [
                'name'          => 'Tatapamong menjamin terwujudnya visi, terlaksanakannya misi, tercapainya tujuan, berhasilnya strategi yang digunakan secara kredibel, transparan, akuntabel, bertanggung jawab, dan adil.',
                'description'   => '2.1. Tatapamong menjamin terwujudnya visi, terlaksanakannya misi, tercapainya tujuan, berhasilnya strategi yang digunakan secara kredibel, transparan, akuntabel, bertanggung jawab, dan adil.',
                'project_id'    => '6',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //2.2   8
            [
                'name'          => 'Karakteristik kepemimpinan yang efektif.',
                'description'   => '2.2. Karakteristik kepemimpinan yang efektif.',
                'project_id'    => '6',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //2.3   9
            [
                'name'          => 'Sistem pengelolaan fungsional dan operasional program studi mencakup: planning, organizing, staffing, leading, controlling yang efektif dilaksanakan.',
                'description'   => '2.3. Sistem pengelolaan fungsional dan operasional program studi mencakup: planning, organizing, staffing, leading, controlling yang efektif dilaksanakan.',
                'project_id'    => '6',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //2.4   10
            [
                'name'          => 'Pelaksanaan penjaminan mutu di program studi.',
                'description'   => '2.4. Pelaksanaan penjaminan mutu di program studi
Pelaksanaannya antara lain dengan adanya: kelompok dosen bidang ilmu yang menilai mutu soal ujian, silabus, dan tugas akhir, serta penguji luar (external examiner)',
                'project_id'    => '6',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //2.5   11
            [
                'name'          => 'Penjaringan umpan balik  dan tindak lanjutnya.',
                'description'   => '2.5. Penjaringan umpan balik  dan tindak lanjutnya. Sumber umpan balik antara lain dari: (1) dosen, (2) mahasiswa, (3) alumni, (4) pengguna lulusan.',
                'project_id'    => '6',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //2.6   12
            [
                'name'          => 'Upaya-upaya yang telah dilakukan penyelenggara program studi untuk menjamin keberlanjutan.',
                'description'   => '2.6. Upaya-upaya yang telah dilakukan penyelenggara program studi untuk menjamin keberlanjutan (sustainability) program studi ini antara lain mencakup:
a. Upaya untuk peningkatan animo calon mahasiswa
b. Upaya peningkatan mutu manajemen
c. Upaya untuk peningkatan mutu lulusan
d. Upaya untuk pelaksanaan dan hasil kerjasama kemitraan',
                'project_id'    => '6',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //3     13
            [
                'name'          => 'STANDAR 3: MAHASISWA DAN LULUSAN',
                'description'   => 'STANDAR 3: MAHASISWA DAN LULUSAN',
                'project_id'    => '1',
                'project_type'  => 'App\Project',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //3.1   14
            [
                'name'          => '[tidak tahu]',
                'description'   => '3.1. [tidak tahu]',
                'project_id'    => '13',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //3.1.1   15
            [
                'name'          => 'Efektivitas implementasi sistem rekrutmen dan seleksi calon mahasiswa untuk menghasilkan calon mahasiswa yang bermutu yang diukur dari jumlah peminat, proporsi pendaftar terhadap daya tampung dan proporsi yang diterima dan yang registrasi',
                'description'   => '3.1.1. Efektivitas implementasi sistem rekrutmen dan seleksi calon mahasiswa untuk menghasilkan calon mahasiswa yang bermutu yang diukur dari jumlah peminat, proporsi pendaftar terhadap daya tampung dan proporsi yang diterima dan yang registrasi',
                'project_id'    => '14',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //3.1.2   16
            [
                'name'          => 'Penerimaan mahasiswa non-reguler selayaknya tidak membuat beban dosen sangat berat, jauh melebihi beban ideal  (sekitar 12 sks).',
                'description'   => '3.1.2. Penerimaan mahasiswa non-reguler selayaknya tidak membuat beban dosen sangat berat, jauh melebihi beban ideal  (sekitar 12 sks).',
                'project_id'    => '14',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //3.1.3   17
            [
                'name'          => 'Penghargaan atas prestasi mahasiswa di bidang nalar, bakat dan minat',
                'description'   => '3.1.3. Penghargaan atas prestasi mahasiswa di bidang nalar, bakat dan minat',
                'project_id'    => '14',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //3.1.4   18
            [
                'name'          => 'Profil lulusan: ketepatan waktu penyelesaian studi, proporsi mahasiswa yang menyelesaikan studi dalam batas masa studi',
                'description'   => '3.1.4. Profil lulusan: ketepatan waktu penyelesaian studi, proporsi mahasiswa yang menyelesaikan studi dalam batas masa studi',
                'project_id'    => '14',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //3.2   19
            [
                'name'          => '[tidak tahu]',
                'description'   => '3.2. [tidak tahu]',
                'project_id'    => '13',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //3.2.1   20
            [
                'name'          => 'Mahasiswa memiliki akses untuk mendapatkan pelayanan mahasiswa yang dapat dimanfaatkan untuk membina dan mengembangkan penalaran, minat, bakat, seni, dan kesejahteraan.',
                'description'   => '3.2.1. Mahasiswa memiliki akses untuk mendapatkan pelayanan mahasiswa yang dapat dimanfaatkan untuk membina dan mengembangkan penalaran, minat, bakat, seni, dan kesejahteraan. 

Jenis pelayanan kepada mahasiswa antara lain:
1. Bimbingan dan konseling
2. Minat dan bakat (ekstra kurikuler)
3. Pembinaan soft skill
4. Layanan beasiswa
5. Layanan kesehatan',
                'project_id'    => '19',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //3.2.2   21
            [
                'name'          => 'Kualitas layanan kepada mahasiswa',
                'description'   => '3.2.2. Kualitas layanan kepada mahasiswa',
                'project_id'    => '19',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //3.3   22
            [
                'name'          => '[tidak tahu]',
                'description'   => '3.3. [tidak tahu]',
                'project_id'    => '13',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //3.3.1   23
            [
                'name'          => '[tidak tahu]',
                'description'   => '3.3.1. [tidak tahu]',
                'project_id'    => '22',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //3.3.1.1   24
            [
                'name'          => 'Upaya pelacakan dan perekaman data lulusan',
                'description'   => '3.3.1.a. Upaya pelacakan dan perekaman data lulusan',
                'project_id'    => '23',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //3.3.1.2   25
            [
                'name'          => 'Penggunaan hasil pelacakan untuk perbaikan',
                'description'   => '3.3.1.b. Penggunaan hasil pelacakan untuk perbaikan: 
(1) proses pembelajaran, 
(2) penggalangan dana, 
(3) informasi pekerjaan, 
(4) membangun jejaring.',
                'project_id'    => '23',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //3.3.1.3   26
            [
                'name'          => 'Pendapat pengguna (employer) lulusan terhadap kualitas alumni.',
                'description'   => '3.3.1.c. Pendapat pengguna (employer) lulusan terhadap kualitas alumni.
Ada 7 jenis kompetensi.',
                'project_id'    => '23',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //3.3.2   27
            [
                'name'          => 'Profil masa tunggu kerja pertama',
                'description'   => '3.3.2. Profil masa tunggu kerja pertama',
                'project_id'    => '22',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //3.3.3   28
            [
                'name'          => ' Profil kesesuaian bidang kerja dengan bidang studi',
                'description'   => '3.3.3.  Profil kesesuaian bidang kerja dengan bidang studi',
                'project_id'    => '22',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //3.4   29
            [
                'name'          => '[tidak tahu]',
                'description'   => '3.4. [tidak tahu]',
                'project_id'    => '13',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //3.4.1   30
            [
                'name'          => 'Partisipasi alumni dalam mendukung pengembangan akademik program studi.',
                'description'   => '3.4.1. Partisipasi alumni dalam mendukung pengembangan akademik program studi dalam bentuk: 
(1) Sumbangan dana
(2) Sumbangan fasilitas
(3) Keterlibatan dalam kegiatan akademik
(4) Pengembangan jejaring
(5) Penyediaan fasilitas untuk kegiatan akademik',
                'project_id'    => '29',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //3.4.2   31
            [
                'name'          => 'Partisipasi lulusan dan alumni dalam mendukung pengembangan non-akademik program studi.',
                'description'   => '3.4.2. Partisipasi lulusan dan alumni dalam mendukung pengembangan non-akademik program studi dalam bentuk: 
(1) Sumbangan dana
(2) Sumbangan fasilitas
(3) Keterlibatan dalam kegiatan akademik
(4) Pengembangan jejaring 
(5) Penyediaan fasilitas untuk kegiatan akademik.',
                'project_id'    => '29',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //4     32
            [
                'name'          => 'STANDAR 4: SUMBER DAYA MANUSIA',
                'description'   => 'STANDAR 4: SUMBER DAYA MANUSIA',
                'project_id'    => '1',
                'project_type'  => 'App\Project',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //4.1   33
            [
                'name'          => 'Efektivitas sistem seleksi, perekrutan, penempatan, pengembangan, retensi, dan pemberhentian dosen dan tenaga kependidikan untuk menjamin mutu penyelenggaraan program akademik.',
                'description'   => '4.1. Efektivitas sistem seleksi, perekrutan, penempatan, pengembangan, retensi, dan pemberhentian dosen dan tenaga kependidikan untuk menjamin mutu penyelenggaraan program akademik.',
                'project_id'    => '32',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //4.1.1   34
            [
                'name'          => 'Pedoman tertulis tentang sistem seleksi, perekrutan, penempatan, pengembangan, retensi, dan pemberhentian dosen dan tenaga kependidikan.',
                'description'   => '4.1.1. Pedoman tertulis tentang sistem seleksi, perekrutan, penempatan, pengembangan, retensi, dan pemberhentian dosen dan tenaga kependidikan.',
                'project_id'    => '33',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //4.2   35
            [
                'name'          => 'Sistem monitoring dan evaluasi, serta rekam jejak kinerja dosen dan tenaga kependidikan.',
                'description'   => '4.2. Sistem monitoring dan evaluasi, serta rekam jejak kinerja dosen dan tenaga kependidikan.',
                'project_id'    => '32',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //4.2.1   36
            [
                'name'          => 'Pedoman tertulis tentang sistem monitoring dan evaluasi, serta rekam jejak kinerja dosen dan tenaga kependidikan.',
                'description'   => '4.2.1. Pedoman tertulis tentang sistem monitoring dan evaluasi, serta rekam jejak kinerja dosen dan tenaga kependidikan.',
                'project_id'    => '35',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //4.2.2   37
            [
                'name'          => 'Pedoman tertulis tentang sistem monitoring dan evaluasi, serta rekam jejak kinerja dosen dan tenaga kependidikan.',
                'description'   => '4.2.1. Pedoman tertulis tentang sistem monitoring dan evaluasi, serta rekam jejak kinerja dosen dan tenaga kependidikan.',
                'project_id'    => '35',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //4.3   38
            [
                'name'          => '[Tidak Tahu]',
                'description'   => '4.3. [Tidak Tahu]',
                'project_id'    => '32',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //4.3.1   39
            [
                'name'          => '[Tidak Tahu]',
                'description'   => '4.3.1. [Tidak Tahu]',
                'project_id'    => '38',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //4.3.1.1   40
            [
                'name'          => 'Dosen tetap berpendidikan (terakhir) S2 dan S3 yang bidang keahliannya sesuai dengan kompetensi PS',
                'description'   => '4.3.1.a. Dosen tetap berpendidikan (terakhir) S2 dan S3 yang bidang keahliannya sesuai dengan kompetensi PS',
                'project_id'    => '39',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //4.3.1.2   41
            [
                'name'          => 'Dosen tetap yang berpendidikan S3 yang bidang keahliannya sesuai dengan kompetensi PS',
                'description'   => '4.3.1.b. Dosen tetap yang berpendidikan S3 yang bidang keahliannya sesuai dengan kompetensi PS',
                'project_id'    => '39',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //4.3.1.3   42
            [
                'name'          => 'Dosen tetap yang memiliki jabatan lektor kepala dan guru besar yang bidang keahliannya sesuai dengan kompetensi PS',
                'description'   => '4.3.1.c. Dosen tetap yang memiliki jabatan lektor kepala dan guru besar yang bidang keahliannya sesuai dengan kompetensi PS',
                'project_id'    => '39',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //4.3.1.4   43
            [
                'name'          => 'Dosen yang memiliki Sertifikat Pendidik Profesional',
                'description'   => '4.3.1.d. Dosen yang memiliki Sertifikat Pendidik Profesional',
                'project_id'    => '39',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //4.3.2   44
            [
                'name'          => 'Rasio mahasiswa terhadap dosen tetap yang bidang keahliannya sesuai dengan bidang PS (RMD)',
                'description'   => '4.3.2. Rasio mahasiswa terhadap dosen tetap yang bidang keahliannya sesuai dengan bidang PS (RMD)',
                'project_id'    => '38',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
             //4.3.3   45
            [
                'name'          => 'Rata-rata beban dosen per semester, atau rata-rata FTE (Fulltime Teaching Equivalent)',
                'description'   => '4.3.3. Rata-rata beban dosen per semester, atau rata-rata FTE (Fulltime Teaching Equivalent)',
                'project_id'    => '38',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //4.3.4   46
            [
                'name'          => 'Kesesuaian keahlian (pendidikan terakhir) dosen dengan mata kuliah yang diajarkannya',
                'description'   => '4.3.4. Kesesuaian keahlian (pendidikan terakhir) dosen dengan mata kuliah yang diajarkannya',
                'project_id'    => '38',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //4.3.5   47
            [
                'name'          => 'Tingkat kehadiran dosen tetap dalam mengajar',
                'description'   => '4.3.5. Tingkat kehadiran dosen tetap dalam mengajar',
                'project_id'    => '38',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //4.4   48
            [
                'name'          => 'Jumlah, kualifikasi, dan pelaksanaan tugas Dosen Tidak Tetap',
                'description'   => '4.4. Jumlah, kualifikasi, dan pelaksanaan tugas Dosen Tidak Tetap',
                'project_id'    => '32',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //4.4.1   49
            [
                'name'          => 'Persentase jumlah dosen tidak tetap, terhadap jumlah seluruh dosen (= PDTT)',
                'description'   => '4.4.1. Persentase jumlah dosen tidak tetap, terhadap jumlah seluruh dosen (= PDTT)',
                'project_id'    => '48',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
             //4.4.2   50
            [
                'name'          => '[Tidak Tahu]',
                'description'   => '4.4.2. [Tidak Tahu]',
                'project_id'    => '48',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //4.4.2.1   51
            [
                'name'          => 'Kesesuaian keahlian dosen tidak tetap dengan mata kuliah yang diampu.',
                'description'   => '4.4.2.a. Kesesuaian keahlian dosen tidak tetap dengan mata kuliah yang diampu.',
                'project_id'    => '50',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
             //4.4.2.b   52
            [
                'name'          => 'Pelaksanaan tugas/ tingkat kehadiran dosen tidak tetap dalam mengajar',
                'description'   => '4.4.2.b. Pelaksanaan tugas/ tingkat kehadiran dosen tidak tetap dalam mengajar',
                'project_id'    => '50',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //4.5   53
            [
                'name'          => 'Upaya Peningkatan Sumber Daya Manusia (SDM) dalam tiga tahun terakhir',
                'description'   => '4.5. Upaya Peningkatan Sumber Daya Manusia (SDM) dalam tiga tahun terakhir',
                'project_id'    => '32',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //4.5.1   54
            [
                'name'          => 'Kegiatan tenaga ahli/pakar sebagai pembicara dalam seminar/pelatihan, pembicara tamu, dsb, dari luar PT sendiri (tidak termasuk dosen tidak tetap).',
                'description'   => '4.5.1. Kegiatan tenaga ahli/pakar sebagai pembicara dalam seminar/pelatihan, pembicara tamu, dsb, dari luar PT sendiri (tidak termasuk dosen tidak tetap).',
                'project_id'    => '53',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //4.5.2   55
            [
                'name'          => 'Peningkatan kemampuan dosen tetap melalui program tugas belajar dalam bidang yang sesuai dengan bidang PS.',
                'description'   => '4.5.2.  Peningkatan kemampuan dosen tetap melalui program tugas belajar dalam bidang yang sesuai dengan bidang PS.',
                'project_id'    => '53',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //4.5.3   56
            [
                'name'          => 'Kegiatan dosen tetap yang bidang keahliannya sesuai dengan PS dalam seminar ilmiah/ lokakarya/ penataran/ workshop/ pagelaran/ pameran/peragaan yang tidak hanya melibatkan dosen PT sendiri.',
                'description'   => '4.5.3. Kegiatan dosen tetap yang bidang keahliannya sesuai dengan PS dalam seminar ilmiah/ lokakarya/ penataran/ workshop/ pagelaran/ pameran/peragaan yang tidak hanya melibatkan dosen PT sendiri.',
                'project_id'    => '53',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //4.5.4   57
            [
                'name'          => 'Prestasi dalam mendapatkan penghargaan hibah, pendanaan program dan kegiatan akademik dari tingkat nasional dan internasional; besaran dan proporsi dana penelitian dari sumber institusi sendiri dan luar institusi.',
                'description'   => '4.5.4. Prestasi dalam mendapatkan penghargaan hibah, pendanaan program dan kegiatan akademik dari tingkat nasional dan internasional; besaran dan proporsi dana penelitian dari sumber institusi sendiri dan luar institusi.',
                'project_id'    => '53',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //4.5.5   58
            [
                'name'          => 'Reputasi dan keluasan jejaring dosen dalam bidang akademik dan profesi',
                'description'   => '4.5.5. Reputasi dan keluasan jejaring dosen dalam bidang akademik dan profesi',
                'project_id'    => '53',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //4.6   59
            [
                'name'          => 'Jumlah, rasio, kualifikasi akademik dan kompetensi tenaga kependidikan (pustakawan, laboran, analis, teknisi, operator, programer, staf administrasi, dan/atau staf pendukung lainnya) untuk menjamin mutu penyelenggaraan program studi.',
                'description'   => '4.6. Jumlah, rasio, kualifikasi akademik dan kompetensi tenaga kependidikan (pustakawan, laboran, analis, teknisi, operator, programer, staf administrasi, dan/atau staf pendukung lainnya) untuk menjamin mutu penyelenggaraan program studi.',
                'project_id'    => '32',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //4.6.1   60
            [
                'name'          => '[Tidak Tahu]',
                'description'   => '4.6.1. [Tidak Tahu]',
                'project_id'    => '59',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //4.6.1.1   61
            [
                'name'          => 'Pustakawan dan kualifikasinya',
                'description'   => '4.6.1.a. Pustakawan dan kualifikasinya',
                'project_id'    => '60',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //4.6.1.2   62
            [
                'name'          => 'Laboran, teknisi, operator, programer',
                'description'   => '4.6.1.b. Laboran, teknisi, operator, programer',
                'project_id'    => '60',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //4.6.1.3   63
            [
                'name'          => 'Tenaga administrasi',
                'description'   => '4.6.1.c. Tenaga administrasi',
                'project_id'    => '60',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //4.6.2   64
            [
                'name'          => 'Upaya yang telah dilakukan PS dalam meningkatkan kualifikasi dan kompetensi tenaga kependidikan.',
                'description'   => '4.6.1. Upaya yang telah dilakukan PS dalam meningkatkan kualifikasi dan kompetensi tenaga kependidikan.',
                'project_id'    => '59',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //5     65
            [
                'name'          => 'STANDAR 5: KURIKULUM, PEMBELAJARAN, DAN SUASANA AKADEMIK',
                'description'   => 'STANDAR 5: KURIKULUM, PEMBELAJARAN, DAN SUASANA AKADEMIK',
                'project_id'    => '1',
                'project_type'  => 'App\Project',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //5.1     66
            [
                'name'          => 'Kurikulum harus memuat standar kompetensi lulusan yang terstruktur dalam kompetensi utama, pendukung dan lainnya yang mendukung  tercapainya tujuan, terlaksananya misi, dan terwujudnya visi program studi.',
                'description'   => '5.1. Kurikulum harus memuat standar kompetensi lulusan yang terstruktur dalam kompetensi utama, pendukung dan lainnya yang mendukung  tercapainya tujuan, terlaksananya misi, dan terwujudnya visi program studi.',
                'project_id'    => '65',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //5.1.1     67
            [
                'name'          => 'Kompetensi lulusan.',
                'description'   => '5.1.1. Kompetensi lulusan.',
                'project_id'    => '66',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //5.1.1.1     68
            [
                'name'          => 'Kelengkapan dan perumusan kompetensi.',
                'description'   => '5.1.1.a. Kelengkapan dan perumusan kompetensi.',
                'project_id'    => '67',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //5.1.1.2     69
            [
                'name'          => 'Orientasi dan kesesuaian dengan visi dan misi.',
                'description'   => '5.1.1.a. Orientasi dan kesesuaian dengan visi dan misi.',
                'project_id'    => '67',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //5.1.2     70
            [
                'name'          => 'Struktur Kurikulum.',
                'description'   => '5.1.2. Struktur Kurikulum.',
                'project_id'    => '66',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //5.1.2.1     71
            [
                'name'          => 'Kesesuaian matakuliah dan urutannya dengan standar kompetensi.',
                'description'   => '5.1.2.a. Kesesuaian matakuliah dan urutannya dengan standar kompetensi.',
                'project_id'    => '70',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //5.1.2.2     72
            [
                'name'          => 'Persentase mata kuliah  yang dalam penentuan nilai akhirnya memberikan bobot pada tugas-tugas (PR atau makalah) ≥ 20%',
                'description'   => '5.1.2.b. Persentase mata kuliah  yang dalam penentuan nilai akhirnya memberikan bobot pada tugas-tugas (PR atau makalah) ≥ 20% .',
                'project_id'    => '70',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //5.1.2.3     73
            [
                'name'          => 'Persentase mata kuliah  yang dalam penentuan nilai akhirnya memberikan bobot pada tugas-tugas (PR atau makalah) ≥ 20%',
                'description'   => '5.1.2.b. Persentase mata kuliah  yang dalam penentuan nilai akhirnya memberikan bobot pada tugas-tugas (PR atau makalah) ≥ 20% .',
                'project_id'    => '70',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //5.1.3     74
            [
                'name'          => 'Fleksibilitas mata kuliah pilihan.',
                'description'   => '5.1.3. Fleksibilitas mata kuliah pilihan.',
                'project_id'    => '66',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //5.1.4     75
            [
                'name'          => 'Substansi praktikum dan pelaksanaan praktikum.',
                'description'   => '5.1.4. Substansi praktikum dan pelaksanaan praktikum.',
                'project_id'    => '66',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //5.2     76
            [
                'name'          => 'Kurikulum dan seluruh kelengkapannya harus ditinjau ulang dalam kurun waktu tertentu oleh program studi bersama fihak-fihak terkait (relevansi sosial dan relevansi epistemologis) untuk menyesuaikannya dengan perkembangan Ipteks dan kebutuhan pemangku kepentingan (stakeholders)',
                'description'   => '5.2. Kurikulum dan seluruh kelengkapannya harus ditinjau ulang dalam kurun waktu tertentu oleh program studi bersama fihak-fihak terkait (relevansi sosial dan relevansi epistemologis) untuk menyesuaikannya dengan perkembangan Ipteks dan kebutuhan pemangku kepentingan (stakeholders)',
                'project_id'    => '65',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //5.2.1     77
            [
                'name'          => 'Pelaksanaan peninjauan kurikulum selama 5 tahun terakhir',
                'description'   => '5.2.a. Pelaksanaan peninjauan kurikulum selama 5 tahun terakhir',
                'project_id'    => '76',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //5.2.2     78
            [
                'name'          => 'Penyesuaian kurikulum dengan perkembangan Ipteks dan kebutuhan',
                'description'   => '5.2.a. Penyesuaian kurikulum dengan perkembangan Ipteks dan kebutuhan',
                'project_id'    => '76',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //5.3     79
            [
                'name'          => ' Pelaksanaan proses pembelajaran',
                'description'   => '5.3.  Pelaksanaan proses pembelajaran',
                'project_id'    => '65',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //5.3.1     80
            [
                'name'          => '[Tidak Tahu]',
                'description'   => '5.3.1. [Tidak Tahu]',
                'project_id'    => '79',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //5.3.1.1     81
            [
                'name'          => 'Pelaksanaan pembelajaran memiliki mekanisme untuk memonitor, mengkaji, dan memperbaiki setiap semester.',
                'description'   => '5.3.1.a. Pelaksanaan pembelajaran memiliki mekanisme untuk memonitor, mengkaji, dan memperbaiki setiap semester tentang:
(a) kehadiran mahasiswa
(b) kehadiran dosen
(c) materi kuliah',
                'project_id'    => '80',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //5.3.1.2     82
            [
                'name'          => 'Mekanisme penyusunan materi perkuliahan.',
                'description'   => '5.3.1.b. Mekanisme penyusunan materi perkuliahan.',
                'project_id'    => '80',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //5.3.2     83
            [
                'name'          => 'Mutu soal ujian bermutu baik, dan sesuai dengan GBPP/SAP',
                'description'   => '5.3.2. Mutu soal ujian bermutu baik, dan sesuai dengan GBPP/SAP',
                'project_id'    => '79',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //5.4     84
            [
                'name'          => 'Sistem pembimbingan akademik: banyaknya mahasiswa per dosen PA, pelaksanaan kegiatan, rata-rata pertemuan per semester, efektivitas kegiatan perwalian.',
                'description'   => '5.4. Sistem pembimbingan akademik: banyaknya mahasiswa per dosen PA, pelaksanaan kegiatan, rata-rata pertemuan per semester, efektivitas kegiatan perwalian',
                'project_id'    => '65',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //5.4.1     85
            [
                'name'          => 'Rata-rata banyaknya mahasiswa per dosen Pembimbing Akademik (PA) per semester.',
                'description'   => '5.4.1. Rata-rata banyaknya mahasiswa per dosen Pembimbing Akademik (PA) per semester.',
                'project_id'    => '84',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //5.4.2     86
            [
                'name'          => '[Tidak Tahu]',
                'description'   => '5.4.1. [Tidak Tahu]',
                'project_id'    => '84',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //5.4.2.a     87
            [
                'name'          => 'Pelaksanaan kegiatan pembimbingan akademik.',
                'description'   => '5.4.1.a Pelaksanaan kegiatan pembimbingan akademik.',
                'project_id'    => '86',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //5.4.2.b     88
            [
                'name'          => 'Jumlah rata-rata pertemuan pembimbingan per mahasiswa per semester (= PP).',
                'description'   => '5.4.1.b Jumlah rata-rata pertemuan pembimbingan per mahasiswa per semester (= PP).',
                'project_id'    => '86',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //5.4.2.c     89
            [
                'name'          => 'Efektivitas kegiatan perwalian',
                'description'   => '5.4.1.c Efektivitas kegiatan perwalian',
                'project_id'    => '86',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //5.5     90
            [
                'name'          => 'Sistem pembimbingan tugas akhir (skripsi): ketersediaan panduan, rata-rata mahasiswa per dosen pembimbing tugas akhir, rata-rata jumlah pertemuan/ pembimbingan, kualifikasi akademik dosen pembimbing tugas akhir, dan waktu penyelesaian penulisan.',
                'description'   => '5.5.  Sistem pembimbingan tugas akhir (skripsi): ketersediaan panduan, rata-rata mahasiswa per dosen pembimbing tugas akhir, rata-rata jumlah pertemuan/ pembimbingan, kualifikasi akademik dosen pembimbing tugas akhir, dan waktu penyelesaian penulisan.',
                'project_id'    => '65',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //5.5.1     91
            [
                'name'          => '[Tidak Tahu]',
                'description'   => '5.5.1. [Tidak Tahu]',
                'project_id'    => '90',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //5.5.1.a     92
            [
                'name'          => 'Ketersediaan panduan, sosialisasi,  dan penggunaan.',
                'description'   => '5.5.1.a. Ketersediaan panduan, sosialisasi,  dan penggunaan.',
                'project_id'    => '91',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //5.5.1.b     93
            [
                'name'          => 'Rata-rata mahasiswa per dosen pembimbing tugas akhir.',
                'description'   => '5.5.1.b. Rata-rata mahasiswa per dosen pembimbing tugas akhir.',
                'project_id'    => '91',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //5.5.1.c     94
            [
                'name'          => 'Rata-rata jumlah pertemuan/pembimbingan selama penyelesaian TA.',
                'description'   => '5.5.1.c. Rata-rata jumlah pertemuan/pembimbingan selama penyelesaian TA.',
                'project_id'    => '91',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //5.5.1.d     95
            [
                'name'          => 'Kualifikasi akademik dosen pembimbing tugas akhir.',
                'description'   => '5.5.1.d. Kualifikasi akademik dosen pembimbing tugas akhir.',
                'project_id'    => '91',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //5.5.2     96
            [
                'name'          => 'Rata-rata waktu penyelesaian penulisan tugas akhir.',
                'description'   => '5.5.2. Rata-rata waktu penyelesaian penulisan tugas akhir.',
                'project_id'    => '90',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //5.6     97
            [
                'name'          => 'Upaya perbaikan sistem pembelajaran yang telah dilakukan selama tiga tahun terakhir.',
                'description'   => '5.6. Upaya perbaikan sistem pembelajaran yang telah dilakukan selama tiga tahun terakhir berkaitan dengan: 
a. Materi
b. Metode pembelajaran
c. Penggunaan teknologi pembelajaran
d. Cara-cara evaluasi',
                'project_id'    => '65',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //5.7     98
            [
                'name'          => 'Upaya peningkatan suasana akademik: Kebijakan tentang suasana akademik, Ketersediaan dan jenis prasarana, sarana dan dana, Program dan kegiatan akademik untuk menciptakan suasana akademik, Interaksi akademik antara dosen-mahasiswa, serta pengembangan perilaku kecendekiawanan.',
                'description'   => '5.7. Upaya peningkatan suasana akademik: Kebijakan tentang suasana akademik, Ketersediaan dan jenis prasarana, sarana dan dana, Program dan kegiatan akademik untuk menciptakan suasana akademik, Interaksi akademik antara dosen-mahasiswa, serta pengembangan perilaku kecendekiawanan.',
                'project_id'    => '65',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //5.7.1     99
            [
                'name'          => 'Kebijakan tentang suasana akademik (otonomi keilmuan, kebebasan akademik, kebebasan mimbar akademik).',
                'description'   => '5.7.1. Kebijakan tentang suasana akademik (otonomi keilmuan, kebebasan akademik, kebebasan mimbar akademik).',
                'project_id'    => '98',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //5.7.2     100
            [
                'name'          => 'Ketersediaan dan jenis prasarana, sarana dan dana yang memungkinkan terciptanya interaksi akademik antara sivitas akademika.',
                'description'   => '5.7.2. Ketersediaan dan jenis prasarana, sarana dan dana yang memungkinkan terciptanya interaksi akademik antara sivitas akademika.',
                'project_id'    => '98',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //5.7.3     101
            [
                'name'          => 'Program dan kegiatan akademik untuk menciptakan suasana akademik (seminar, simposium, lokakarya, bedah buku, penelitian bersama dll).',
                'description'   => '5.7.3. Program dan kegiatan akademik untuk menciptakan suasana akademik (seminar, simposium, lokakarya, bedah buku, penelitian bersama dll).',
                'project_id'    => '98',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //5.7.4     102
            [
                'name'          => 'Interaksi akademik antara dosen-mahasiswa.',
                'description'   => '5.7.4. Interaksi akademik antara dosen-mahasiswa.',
                'project_id'    => '98',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //5.7.5     103
            [
                'name'          => 'Pengembangan perilaku kecendekiawanan.',
                'description'   => '5.7.5. Pengembangan perilaku kecendekiawanan.',
                'project_id'    => '98',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            
            //6         104     
            [
                'name'          => 'STANDAR 6: PEMBIAYAAN, SARANA DAN PRASARANA, SERTA SISTEM INFORMASI',
                'description'   => 'STANDAR 6: PEMBIAYAAN, SARANA DAN PRASARANA, SERTA SISTEM INFORMASI',
                'project_id'    => '1',
                'project_type'  => 'App\Project',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //6.1     105
            [
                'name'          => 'Keterlibatan program studi dalam perencanaan target kinerja, perencanaan kegiatan/ kerja dan perencanaan/alokasi dan pengelolaan dana. Keterlibatan aktif program studi harus tercerminkan dengan bukti tertulis tentang proses perencanaan, pengelolaan dan pelaporan serta pertanggungjawaban penggunaan dana kepada pemangku kepentingan melalui mekanisme yang transparan dan akuntabel.',
                'description'   => '6.1. Keterlibatan program studi dalam perencanaan target kinerja, perencanaan kegiatan/ kerja dan perencanaan/alokasi dan pengelolaan dana. Keterlibatan aktif program studi harus tercerminkan dengan bukti tertulis tentang proses perencanaan, pengelolaan dan pelaporan serta pertanggungjawaban penggunaan dana kepada pemangku kepentingan melalui mekanisme yang transparan dan akuntabel. ',
                'project_id'    => '104',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //6.2     106
            [
                'name'          => 'Dana operasional dan pengembangan (termasuk hibah) dalam lima tahun terakhir untuk mendukung kegiatan program akademik (pendidikan, penelitian, dan pengabdian kepada masyarakat) program studi harus memenuhi syarat kelayakan jumlah dan tepat waktu.',
                'description'   => '6.2. Dana operasional dan pengembangan (termasuk hibah) dalam lima tahun terakhir untuk mendukung kegiatan program akademik (pendidikan, penelitian, dan pengabdian kepada masyarakat) program studi harus memenuhi syarat kelayakan jumlah dan tepat waktu.',
                'project_id'    => '104',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //6.2.1     107
            [
                'name'          => 'Penggunaan dana untuk operasional (pendidikan, penelitian, pengabdian pada masyarakat).',
                'description'   => '6.2.1. Penggunaan dana untuk operasional (pendidikan, penelitian, pengabdian pada masyarakat).',
                'project_id'    => '106',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //6.2.2     108
            [
                'name'          => 'Dana penelitian dalam tiga tahun terakhir.',
                'description'   => '6.2.2. Dana penelitian dalam tiga tahun terakhir.',
                'project_id'    => '106',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //6.2.3     109
            [
                'name'          => 'Dana yang diperoleh dalam rangka pelayanan/pengabdian kepada masyarakat dalam tiga  tahun terakhir.',
                'description'   => '6.2.3. Dana yang diperoleh dalam rangka pelayanan/pengabdian kepada masyarakat dalam tiga  tahun terakhir.',
                'project_id'    => '106',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //6.3     110
            [
                'name'          => 'Prasarana',
                'description'   => '6.3. Ruang kerja dosen yang memenuhi kelayakan dan mutu untuk melakukan aktivitas kerja, pengembangan diri, dan pelayanan akademik.',
                'project_id'    => '104',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //6.3.1     111
            [
                'name'          => 'Luas ruang kerja dosen',
                'description'   => '6.3.1. Luas ruang kerja dosen.',
                'project_id'    => '110',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //6.3.2     112
            [
                'name'          => 'Prasarana (kantor, ruang kelas, ruang laboratorium, studio, ruang perpustakaan, kebun percobaan, dsb. kecuali  ruang dosen) yang dipergunakan PS dalam proses pembelajaran.',
                'description'   => '6.3.2. Prasarana (kantor, ruang kelas, ruang laboratorium, studio, ruang perpustakaan, kebun percobaan, dsb. kecuali  ruang dosen) yang dipergunakan PS dalam proses pembelajaran.',
                'project_id'    => '110',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //6.3.3     113
            [
                'name'          => 'Prasarana lain yang menunjang (misalnya tempat olah raga, ruang bersama, ruang himpunan mahasiswa, poliklinik).',
                'description'   => '6.3.3. Prasarana lain yang menunjang (misalnya tempat olah raga, ruang bersama, ruang himpunan mahasiswa, poliklinik).',
                'project_id'    => '110',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //6.4     114
            [
                'name'          => 'Akses dan pendayagunaan sarana yang dipergunakan dalam proses administrasi dan pembelajaran serta penyeleng-garaan kegiatan Tridharma PT secara efektif.',
                'description'   => '6.4. Akses dan pendayagunaan sarana yang dipergunakan dalam proses administrasi dan pembelajaran serta penyeleng-garaan kegiatan Tridharma PT secara efektif.',
                'project_id'    => '104',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //6.4.1     115
            [
                'name'          => '[Tidak Tahu]',
                'description'   => '6.4.1. [Tidak Tahu]',
                'project_id'    => '114',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //6.4.1.a     116
            [
                'name'          => 'Bahan pustaka berupa buku teks.',
                'description'   => '6.4.1.a. Bahan pustaka berupa buku teks.',
                'project_id'    => '115',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //6.4.1.b     117
            [
                'name'          => 'Bahan pustaka berupa disertasi/tesis/ skripsi/ tugas akhir.',
                'description'   => '6.4.1.b. Bahan pustaka berupa disertasi/tesis/ skripsi/ tugas akhir.',
                'project_id'    => '115',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //6.4.1.c     118
            [
                'name'          => 'Bahan pustaka berupa jurnal ilmiah terakreditasi Dikti.',
                'description'   => '6.4.1.c. Bahan pustaka berupa jurnal ilmiah terakreditasi Dikti.',
                'project_id'    => '115',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //6.4.1.d     119
            [
                'name'          => 'Bahan pustaka  berupa jurnal ilmiah internasional .',
                'description'   => '6.4.1.d. Bahan pustaka  berupa jurnal ilmiah internasional.',
                'project_id'    => '115',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //6.4.1.e     120
            [
                'name'          => 'Bahan pustaka berupa prosiding seminar dalam tiga tahun terakhir.',
                'description'   => '6.4.1.e. Bahan pustaka berupa prosiding seminar dalam tiga tahun terakhir.',
                'project_id'    => '115',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //6.4.2     121
            [
                'name'          => 'Akses ke perpustakaan di luar PT atau sumber pustaka lainnya.',
                'description'   => '6.4.2. Akses ke perpustakaan di luar PT atau sumber pustaka lainnya.',
                'project_id'    => '114',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //6.4.3     122
            [
                'name'          => 'Ketersediaan, akses dan pendayagunaan sarana utama di lab (tempat praktikum, bengkel, studio, ruang simulasi, rumah sakit, puskesmas/balai kesehatan, green house, lahan untuk pertanian, dan sejenisnya).',
                'description'   => '6.4.3. Ketersediaan, akses dan pendayagunaan sarana utama di lab (tempat praktikum, bengkel, studio, ruang simulasi, rumah sakit, puskesmas/balai kesehatan, green house, lahan untuk pertanian, dan sejenisnya).',
                'project_id'    => '114',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //6.5     123
            [
                'name'          => 'Akses dan pendayagunaan sistem informasi dalam pengelolaan data dan informasi tentang penyelenggaraan program akademik di program studi.',
                'description'   => '6.5. Akses dan pendayagunaan sistem informasi dalam pengelolaan data dan informasi tentang penyelenggaraan program akademik di program studi.',
                'project_id'    => '104',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //6.5.1     124
            [
                'name'          => 'Sistem informasi dan fasilitas yang digunakan PS dalam proses pembelajaran (hardware, software, e-learning, perpustakaan, dll.).',
                'description'   => '6.5.1. Sistem informasi dan fasilitas yang digunakan PS dalam proses pembelajaran (hardware, software, e-learning, perpustakaan, dll.).',
                'project_id'    => '123',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //6.5.2     125
            [
                'name'          => 'Aksesibilitas data dalam sistem informasi',
                'description'   => '6.5.2. Aksesibilitas data dalam sistem informasi',
                'project_id'    => '123',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //7         126     
            [
                'name'          => 'STANDAR 7: PENELITIAN, PELAYANAN/PENGABDIAN KEPADA MASYARAKAT, DAN KERJASAMA',
                'description'   => 'STANDAR 7: PENELITIAN, PELAYANAN/PENGABDIAN KEPADA MASYARAKAT, DAN KERJASAMA',
                'project_id'    => '1',
                'project_type'  => 'App\Project',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //7.1     127
            [
                'name'          => 'Produktivitas dan mutu hasil penelitian dosen dalam kegiatan penelitian, pelayanan/pengabdian kepada masyarakat, dan kerjasama, dan keterlibatan mahasiswa dalam kegiatan tersebut.',
                'description'   => '7.1. Produktivitas dan mutu hasil penelitian dosen dalam kegiatan penelitian, pelayanan/pengabdian kepada masyarakat, dan kerjasama, dan keterlibatan mahasiswa dalam kegiatan tersebut.',
                'project_id'    => '126',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //7.1.1     128
            [
                'name'          => 'Jumlah penelitian yang sesuai dengan bidang keilmuan PS, yang dilakukan oleh dosen tetap yang bidang keahliannya sama dengan PS per tahun, selama 3 tahun.',
                'description'   => '7.1.1. Jumlah penelitian yang sesuai dengan bidang keilmuan PS, yang dilakukan oleh dosen tetap yang bidang keahliannya sama dengan PS per tahun, selama 3 tahun.',
                'project_id'    => '127',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //7.1.2     129
            [
                'name'          => 'Keterlibatan mahasiswa yang melakukan tugas akhir dalam penelitian dosen.',
                'description'   => '7.1.2. Keterlibatan mahasiswa yang melakukan tugas akhir dalam penelitian dosen',
                'project_id'    => '127',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //7.1.3     130
            [
                'name'          => 'Jumlah artikel ilmiah yang dihasilkan oleh dosen tetap yang bidang keahliannya sama dengan PS per tahun, selama 3 tahun',
                'description'   => '7.1.3. Jumlah artikel ilmiah yang dihasilkan oleh dosen tetap yang bidang keahliannya sama dengan PS per tahun, selama 3 tahun',
                'project_id'    => '127',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //7.1.4     131
            [
                'name'          => 'Karya-karya PS/institusi yang telah memperoleh perlindungan Hak atas Kekayaan Intelektual (HaKI) dalam tiga tahun terakhir.',
                'description'   => '7.1.4. Karya-karya PS/institusi yang telah memperoleh perlindungan Hak atas Kekayaan Intelektual (HaKI) dalam tiga tahun terakhir',
                'project_id'    => '127',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //7.2     132
            [
                'name'          => 'Kegiatan pelayanan/pengabdian kepada masyarakat dosen dan mahasiswa program studi yang bermanfaat bagi pemangku kepentingan (kerjasama, karya, penelitian, dan pemanfaatan jasa/produk kepakaran).',
                'description'   => '7.2. Kegiatan pelayanan/pengabdian kepada masyarakat dosen dan mahasiswa program studi yang bermanfaat bagi pemangku kepentingan (kerjasama, karya, penelitian, dan pemanfaatan jasa/produk kepakaran).',
                'project_id'    => '126',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //7.2.1     133
            [
                'name'          => 'Jumlah kegiatan pelayanan/pengabdian kepada masyarakat (PkM) yang dilakukan oleh dosen tetap yang bidang keahliannya sama dengan PS selama tiga tahun.',
                'description'   => '7.2.1. Jumlah kegiatan pelayanan/pengabdian kepada masyarakat (PkM) yang dilakukan oleh dosen tetap yang bidang keahliannya sama dengan PS selama tiga tahun.',
                'project_id'    => '132',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //7.2.2     134
            [
                'name'          => 'Keterlibatan mahasiswa dalam kegiatan pelayanan/pengabdian kepada masyarakat.',
                'description'   => '7.2.2. Keterlibatan mahasiswa dalam kegiatan pelayanan/pengabdian kepada masyarakat.',
                'project_id'    => '132',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //7.3     135
            [
                'name'          => 'Jumlah dan mutu kerjasama yang efektif yang mendukung pelaksanaan misi program studi dan institusi dan dampak kerjasama untuk penyelenggaraan dan pengembangan program studi.',
                'description'   => '7.3. Jumlah dan mutu kerjasama yang efektif yang mendukung pelaksanaan misi program studi dan institusi dan dampak kerjasama untuk penyelenggaraan dan pengembangan program studi.',
                'project_id'    => '126',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //7.3.1     136
            [
                'name'          => 'Kegiatan kerjasama dengan instansi di dalam negeri dalam tiga tahun terakhir.',
                'description'   => '7.3.1. Kegiatan kerjasama dengan instansi di dalam negeri dalam tiga tahun terakhir.',
                'project_id'    => '135',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
            //7.3.2     137
            [
                'name'          => 'Kegiatan kerjasama dengan instansi di luar negeri dalam tiga tahun terakhir.',
                'description'   => '7.3.1. Kegiatan kerjasama dengan instansi di luar negeri dalam tiga tahun terakhir.',
                'project_id'    => '135',
                'project_type'  => 'App\ProjectNode',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            
        ]);
    }
}
