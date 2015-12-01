<?php

use Illuminate\Database\Seeder;

use App\Foundation;
use App\University;
use App\Department;
use App\Job;
use App\GroupJob;
use App\GroupJobDetail;

class HierarchyDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        include('spmi.php');

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
