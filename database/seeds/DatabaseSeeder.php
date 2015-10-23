<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\User;
use App\Standard;
use App\StandardDocument;
use App\Guide;
use App\Instruction;
use App\Form;

use App\UserJob;

use App\Foundation;
use App\University;
use App\Department;
use App\Job;
use App\Period;
use App\GroupJob;
use App\GroupJobDetail;

use App\Work;
class DatabaseSeeder extends Seeder
{
    use SoftDeletes;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        
        $this->call(HierarchyTableSeeder::class);
        $this->call(DocumentTableSeeder::class);
        $this->call(UserTableSeeder::class);


        Model::reguard();
    }
}

class DocumentTableSeeder extends Seeder 
{
    public function run() {
        DB::table('standards')->delete();
        Standard::insert([
            [
                'description'   => 'SPT - Standar Pendidikan Tinggi',
                'no'            => 1,
                'date'          => new DateTime,
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            [
                'description'   => 'SP - Standar Penelitian',
                'no'            => 2,
                'date'          => new DateTime,
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            [
                'description'   => 'SPKM - Standar Pengabdian kepada Masyarakat',
                'no'            => 3,
                'date'          => new DateTime,
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ]
        ]);

        DB::table('standard_documents')->delete();
        StandardDocument::insert([
            [//1
                'standard_id'   => '1',
                'no'            => 1,
                'date'          => new DateTime,
                'description'   => 'Standard Kompetensi Kelulusan',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            [//2
                'standard_id'   => '1',
                'no'            => 2,
                'date'          => new DateTime,
                'description'   => 'Standard Isi Pembelajaran',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            [//3
                'standard_id'   => '1',
                'no'            => 3,
                'date'          => new DateTime,
                'description'   => 'Standard Proses Pembelajaran',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            [//4
                'standard_id'   => '1',
                'no'            => 4,
                'date'          => new DateTime,
                'description'   => 'Standard Penelitian Pembelajaran',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            [//5
                'standard_id'   => '1',
                'no'            => 5,
                'date'          => new DateTime,
                'description'   => 'Standard Dosen dan Tenaga Pendidikan',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            [//6
                'standard_id'   => '1',
                'no'            => 6,
                'date'          => new DateTime,
                'description'   => 'Standard Sarana dan Prasarana',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            [//7
                'standard_id'   => '1',
                'no'            => 7,
                'date'          => new DateTime,
                'description'   => 'Standard Pengelolaan Pembelajaran',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            [//8
                'standard_id'   => '1',
                'no'            => 8,
                'date'          => new DateTime,
                'description'   => 'Standard Pembiayaan',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
        ]);

        DB::table('guides')->delete();
        Guide::insert([
            [
                'standard_document_id'  => '1',
                'no'                    => 1,
                'date'                  => new DateTime,
                'description'           => 'Perumusan RPKPS',
                'created_at'            => new DateTime,
                'updated_at'            => new DateTime
            ],
            [
                'standard_document_id'  => '6',
                'no'                    => 2,
                'date'                  => new DateTime,
                'description'           => 'Prosedur Mutu Pengembangan Karyawan',
                'created_at'            => new DateTime,
                'updated_at'            => new DateTime
            ]
        ]);

        DB::table('instructions')->delete();
        Instruction::insert([
            [
                'guide_id'      => '1',
                'no'            => 1,
                'date'          => new DateTime,
                'description'   => 'Instruksi Kerja Perumusan RPKPS',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            [
                'guide_id'      => '2',
                'no'            => 2,
                'date'          => new DateTime,
                'description'   => 'Pengembangan Karyawan Melalui Training Eksternal',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ]
        ]);

        DB::table('forms')->delete();
        Form::insert([
            [
                'instruction_id'    => '1',
                'no'                => 1,
                'date'              => new DateTime,
                'description'       => 'Form RPKPS', 
                'created_at'        => new DateTime,
                'updated_at'        => new DateTime
            ],
            [
                'instruction_id'    => '1',
                'no'                => 2,
                'date'              => new DateTime,
                'description'       => 'Rekapitulasi Semester', 
                'created_at'        => new DateTime,
                'updated_at'        => new DateTime
            ],
            [
                'instruction_id'    => '2',
                'no'                => 3,
                'date'              => new DateTime,
                'description'       => 'Form Pengembangan Karyawan Melalui Training Eksternal', 
                'created_at'        => new DateTime,
                'updated_at'        => new DateTime
            ]
        ]);
    }
}

class HierarchyTableSeeder extends Seeder 
{
    public function run() {

        DB::table('foundations')->delete();
        Foundation::insert([
            [
                'name'      => 'Yayasan Multimedia Nusantara',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ]
        ]);

        DB::table('universities')->delete();
        University::insert([
            [
                'name'          =>  'Universitas Multimedia Nusantara',
                'foundation_id' => '1',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            [
                'name'          =>  'Universitas Bina Nusantara',
                'foundation_id' => '1',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ]
        ]);

        DB::table('departments')->delete();
        Department::insert([
            [//1
                'university_id' =>  '1',
                'name'          =>  'Rektorat',
                'department_id' =>  null,
                'created_at'    =>  new DateTime,
                'updated_at'    =>  new DateTime
            ],

            [//2
                'university_id' =>  '1',
                'name'          =>  'Akademik',
                'department_id' =>  '1',
                'created_at'    =>  new DateTime,
                'updated_at'    =>  new DateTime
            ],

            [//3
                'university_id' =>  '1',
                'name'          =>  'Administrasi Umum dan Keuangan',
                'department_id' =>  '1',
                'created_at'    =>  new DateTime,
                'updated_at'    =>  new DateTime
            ],

            [//4
                'university_id' =>  '1',
                'name'          =>  'Kemahasiswaan',
                'department_id' =>  '1',
                'created_at'    =>  new DateTime,
                'updated_at'    =>  new DateTime
            ],

            [//5
                'university_id' =>  '1',
                'name'          =>  'Hubungan dan Kerjasama',
                'department_id' =>  '1',
                'created_at'    =>  new DateTime,
                'updated_at'    =>  new DateTime
            ],

            [//6
                'university_id' =>  '1',
                'name'          =>  'Lembaga Penelitian dan Pengabdian Masyarakat',
                'department_id' =>  '1',
                'created_at'    =>  new DateTime,
                'updated_at'    =>  new DateTime
            ],

            [//7
                'university_id' =>  '1',
                'name'          =>  'Fakultas ICT',
                'department_id' =>  '2',
                'created_at'    =>  new DateTime,
                'updated_at'    =>  new DateTime
            ],

            [//8
                'university_id' =>  '1',
                'name'          =>  'Fakultas Seni dan Design',
                'department_id' =>  '2',
                'created_at'    =>  new DateTime,
                'updated_at'    =>  new DateTime
            ],

            [//9
                'university_id' =>  '1',
                'name'          =>  'Fakultas Ekonomi',
                'department_id' =>  '2',
                'created_at'    =>  new DateTime,
                'updated_at'    =>  new DateTime
            ],

            [//10
                'university_id' =>  '1',
                'name'          =>  'Program Studi Ilmu Komunikasi',
                'department_id' =>  '2',
                'created_at'    =>  new DateTime,
                'updated_at'    =>  new DateTime
            ],

            [//11
                'university_id' =>  '1',
                'name'          =>  'Program Studi Sistem Komputer',
                'department_id' =>  '7',
                'created_at'    =>  new DateTime,
                'updated_at'    =>  new DateTime
            ], 

            [//12
                'university_id' =>  '1',
                'name'          =>  'Program Studi Sistem Informasi',
                'department_id' =>  '7',
                'created_at'    =>  new DateTime,
                'updated_at'    =>  new DateTime
            ],  

            [//13
                'university_id' =>  '1',
                'name'          =>  'Program Studi Teknik Informatika',
                'department_id' =>  '7',
                'created_at'    =>  new DateTime,
                'updated_at'    =>  new DateTime
            ], 

            [//14
                'university_id' =>  '1',
                'name'          =>  'Program Studi Design Komunikasi Visual',
                'department_id' =>  '8',
                'created_at'    =>  new DateTime,
                'updated_at'    =>  new DateTime
            ], 

            [//15
                'university_id' =>  '1',
                'name'          =>  'Program Studi Akutansi',
                'department_id' =>  '9',
                'created_at'    =>  new DateTime,
                'updated_at'    =>  new DateTime
            ], 

            [//16
                'university_id' =>  '1',
                'name'          =>  'Program Studi Manajemen',
                'department_id' =>  '9',
                'created_at'    =>  new DateTime,
                'updated_at'    =>  new DateTime
            ],


        ]);

        DB::table('jobs')->delete();
        Job::insert([
            [//1
                'name'          =>  'Rektor',
                'multiple'      => false,
                'job_id'        =>  null,
                'department_id' =>  '1',
                'created_at'    =>  new DateTime,
                'updated_at'    =>  new DateTime
            ],

            [//2
                'name'          =>  'Wakil Bidang Rektor Akademik',
                'multiple'      => false,
                'job_id'        =>  '1',
                'department_id' =>  '2',
                'created_at'    =>  new DateTime,
                'updated_at'    =>  new DateTime
            ],

            [//3
                'name'          =>  'Wakil Bidang Administrasi Umum dan Keuangan',
                'multiple'      => false,
                'job_id'        =>  '1',
                'department_id' =>  '3',
                'created_at'    =>  new DateTime,
                'updated_at'    =>  new DateTime
            ],

            [//4
                'name'          =>  'Wakil Bidang Kemahasiswaan',
                'multiple'      => false,
                'job_id'        =>  '1',
                'department_id' =>  '4',
                'created_at'    =>  new DateTime,
                'updated_at'    =>  new DateTime
            ],

            [//5
                'name'          =>  'Wakil Bidang Hubungan dan Kerjasama',
                'multiple'      => false,
                'job_id'        =>  '1',
                'department_id' =>  '5',
                'created_at'    =>  new DateTime,
                'updated_at'    =>  new DateTime
            ],

            [//6
                'name'          =>  'Dekan Fakultas ICT',
                'multiple'      => false,
                'job_id'        =>  '2',
                'department_id' =>  '7',
                'created_at'    =>  new DateTime,
                'updated_at'    =>  new DateTime
            ],

            [//7
                'name'          =>  'Dekan Fakultas Seni dan Design',
                'multiple'      => false,
                'job_id'        =>  '2',
                'department_id' =>  '8',
                'created_at'    =>  new DateTime,
                'updated_at'    =>  new DateTime
            ],

            [//8
                'name'          =>  'Dekan Fakultas Ekonomi',
                'multiple'      => false,
                'job_id'        =>  '2',
                'department_id' =>  '9',
                'created_at'    =>  new DateTime,
                'updated_at'    =>  new DateTime
            ],

            [//9
                'name'          =>  'Ketua Program Studi Sistem Komputer',
                'multiple'      => false,
                'job_id'        =>  '6',
                'department_id' =>  '11',
                'created_at'    =>  new DateTime,
                'updated_at'    =>  new DateTime
            ],

            [//10
                'name'          =>  'Ketua Program Studi Sistem Informasi',
                'multiple'      => false,
                'job_id'        =>  '6',
                'department_id' =>  '12',
                'created_at'    =>  new DateTime,
                'updated_at'    =>  new DateTime
            ],

            [//11
                'name'          =>  'Ketua Program Studi Teknik Informatika',
                'multiple'      => false,
                'job_id'        =>  '6',
                'department_id' =>  '13',
                'created_at'    =>  new DateTime,
                'updated_at'    =>  new DateTime
            ],

            [//12
                'name'          =>  'Ketua Program Studi Akutansi',
                'multiple'      => false,
                'job_id'        =>  '8',
                'department_id' =>  '15',
                'created_at'    =>  new DateTime,
                'updated_at'    =>  new DateTime
            ],

            [//13
                'name'          =>  'Ketua Program Studi Manajemen',
                'multiple'      => false,
                'job_id'        =>  '8',
                'department_id' =>  '16',
                'created_at'    =>  new DateTime,
                'updated_at'    =>  new DateTime
            ],

            [//14
                'name'          =>  'Ketua Program Studi Design Komunikasi Visual',
                'multiple'      => false,
                'job_id'        =>  '7',
                'department_id' =>  '14',
                'created_at'    =>  new DateTime,
                'updated_at'    =>  new DateTime
            ],

            [//15
                'name'          =>  'Ketua Program Studi Ilmu Komunikasi',
                'multiple'      => false,
                'job_id'        =>  '2',
                'department_id' =>  '10',
                'created_at'    =>  new DateTime,
                'updated_at'    =>  new DateTime
            ],

            [//16
                'name'          =>  'Direktur LPPM',
                'multiple'      => false,
                'job_id'        =>  '1',
                'department_id' =>  '6',
                'created_at'    =>  new DateTime,
                'updated_at'    =>  new DateTime
            ]
        ]);


    }
}

class UserTableSeeder extends Seeder 
{

    public function run() {
        DB::table('users')->delete();
        User::insert([
            [
                'nik'           => '09110310102',
                'name'          => 'Stevan Aji',
                'born'          => '1991-06-10',
                'address'       => 'Bukit Indra Prasta Blok B2 No 20 Telaga Kahuripan, Parung, Bogor, Jawa Barat',
                'email'         => 'stevanadjie@gmail.com',
                'password'      => Hash::make('12345'),
                'type'          => 1,
                'status'        => 2,
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            [
                'nik'           => '12345678910',
                'name'          => 'Yonathan Area Persada',
                'born'          => '1995-06-27',
                'address'       => 'Bukit Indra Prasta Blok B2 No 20 Telaga Kahuripan, Parung, Bogor, Jawa Barat',
                'email'         => 'yonathanarea@gmail.com',
                'password'      => Hash::make('12345'),
                'type'          => 2,
                'status'        => 2,
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            [//3
                'nik'           => 1,
                'name'          => 'Dr. Ninok Leksono',
                'born'          => null,
                'address'       => null,
                'email'         => 'ninok@umn.ac.id',
                'password'      => Hash::make('12345'),
                'type'          => 2,
                'status'        => 2,
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            [//4
                'nik'           => 2,
                'name'          => 'Hira Meidia, Ph.D.',
                'born'          => null,
                'address'       => null,
                'email'         => 'hira@umn.ac.id',
                'password'      => Hash::make('12345'),
                'type'          => 2,
                'status'        => 2,
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            [//5
                'nik'           => 3,
                'name'          => 'Ir. Andrey Andoko, M.Sc.',
                'born'          => null,
                'address'       => null,
                'email'         => 'andrey@umn.ac.id',
                'password'      => Hash::make('12345'),
                'type'          => 2,
                'status'        => 2,
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            [//6
                'nik'           => 4,
                'name'          => 'Ika Yanuarti, S.E., MSF',
                'born'          => null,
                'address'       => null,
                'email'         => 'ika@umn.ac.id',
                'password'      => Hash::make('12345'),
                'type'          => 2,
                'status'        => 2,
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            [//7
                'nik'           => 5,
                'name'          => 'Prof. Dr. Muliawati G. Siswanto, M.Eng.Sc.',
                'born'          => null,
                'address'       => null,
                'email'         => 'muliawati@umn.ac.id',
                'password'      => Hash::make('12345'),
                'type'          => 2,
                'status'        => 2,
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            [//8
                'nik'           => 6,
                'name'          => 'Kanisius Karyono, S.T., M.T.',
                'born'          => null,
                'address'       => null,
                'email'         => 'kanisius@umn.ac.id',
                'password'      => Hash::make('12345'),
                'type'          => 2,
                'status'        => 2,
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            [//9
                'nik'           => 7,
                'name'          => 'Desi Dwi Kristanto, M.Ds.',
                'born'          => null,
                'address'       => null,
                'email'         => 'desi@umn.ac.id',
                'password'      => Hash::make('12345'),
                'type'          => 2,
                'status'        => 2,
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            [//10
                'nik'           => 8,
                'name'          => 'Wira Munggana, S.Si, M.Sc.',
                'born'          => null,
                'address'       => null,
                'email'         => 'wira@umn.ac.id',
                'password'      => Hash::make('12345'),
                'type'          => 2,
                'status'        => 2,
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            [//11
                'nik'           => 9,
                'name'          => 'Maria Irmina P., S.Kom, M.T.',
                'born'          => null,
                'address'       => null,
                'email'         => 'maria@umn.ac.id',
                'password'      => Hash::make('12345'),
                'type'          => 2,
                'status'        => 2,
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            [//12
                'nik'           => 10,
                'name'          => 'Ratnawati Kurnia Ak. Msi, CPA',
                'born'          => null,
                'address'       => null,
                'email'         => 'ratnawati@umn.ac.id',
                'password'      => Hash::make('12345'),
                'type'          => 2,
                'status'        => 2,
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            [//13
                'nik'           => 11,
                'name'          => 'Dewi Wahyu Handayani, S.E., M.M.',
                'born'          => null,
                'address'       => null,
                'email'         => 'dewi@umn.ac.id',
                'password'      => Hash::make('12345'),
                'type'          => 2,
                'status'        => 2,
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            [//14
                'nik'           => 12,
                'name'          => 'Dr. Berta Sri Eko M,M.Si.',
                'born'          => null,
                'address'       => null,
                'email'         => 'berta@umn.ac.id',
                'password'      => Hash::make('12345'),
                'type'          => 2,
                'status'        => 2,
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            [//15
                'nik'           => 13,
                'name'          => 'Dr. Ir. P. M. Winarno, M.Kom. ',
                'born'          => null,
                'address'       => null,
                'email'         => 'winarno@umn.ac.id',
                'password'      => Hash::make('12345'),
                'type'          => 2,
                'status'        => 2,
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ]

        ]);

        DB::table('user_jobs')->delete();
        UserJob::insert([
            [//Kanisuis
                'user_id'   => '1',
                'job_id'    => '6',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            [
                'user_id'   => '1',
                'job_id'    => '9',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            [//Gumelar
                'user_id'   => '2',
                'job_id'    => '7',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            [
                'user_id'   => '2',
                'job_id'    => '14',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            [//ninok
                'user_id'   => '3',
                'job_id'    => '1',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            [//hira
                'user_id'   => '4',
                'job_id'    => '2',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            [//andrey
                'user_id'   => '5',
                'job_id'    => '3',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            [//ika
                'user_id'   => '6',
                'job_id'    => '4',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            [//muliawati
                'user_id'   => '7',
                'job_id'    => '5',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            [//kanisius
                'user_id'   => '8',
                'job_id'    => '6',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            [//kanisius
                'user_id'   => '8',
                'job_id'    => '9',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            [//desi
                'user_id'   => '9',
                'job_id'    => '7',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            [//desi
                'user_id'   => '9',
                'job_id'    => '14',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            [//wira
                'user_id'   => '10',
                'job_id'    => '10',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            [//maria
                'user_id'   => '11',
                'job_id'    => '11',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            [//ratnawati
                'user_id'   => '12',
                'job_id'    => '8',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            [//ratnawati
                'user_id'   => '12',
                'job_id'    => '12',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            [//dewi
                'user_id'   => '13',
                'job_id'    => '13',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            [//berta
                'user_id'   => '14',
                'job_id'    => '15',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            [//winarno
                'user_id'   => '15',
                'job_id'    => '16',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],

        ]);

        

        DB::table('periods')->delete();
        Period::insert([
            [
                'name'          => 'Harian',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            [
                'name'          => 'Mingguan',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            [
                'name'          => 'Bulanan',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            [
                'name'          => 'Semesteran',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            [
                'name'          => 'Tahunan',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ]
        ]);

        DB::table('group_jobs')->delete();
        GroupJob::insert([
            [
                'name'          => 'Dekan',
                'description'   => 'Job Untuk Seluruh Dekan',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime

            ],
            [
                'name'          => 'Kaprodi',
                'description'   => 'Job Untuk Seluruh Kaprodi',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime

            ]
        ]);

        DB::table('group_job_details')->delete();
        GroupJobDetail::insert([
            [
                'group_job_id'  => '1',
                'job_id'        => '6',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            [
                'group_job_id'  => '1',
                'job_id'        => '7',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            [
                'group_job_id'  => '1',
                'job_id'        => '8',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            [
                'group_job_id'  => '1',
                'job_id'        => '15',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            [
                'group_job_id'  => '2',
                'job_id'        => '9',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            [
                'group_job_id'  => '2',
                'job_id'        => '10',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            [
                'group_job_id'  => '2',
                'job_id'        => '11',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            [
                'group_job_id'  => '2',
                'job_id'        => '12',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            [
                'group_job_id'  => '2',
                'job_id'        => '13',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            [
                'group_job_id'  => '2',
                'job_id'        => '14',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ],
            [
                'group_job_id'  => '2',
                'job_id'        => '15',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ]
        ]);
    }
}

