<?php



use Illuminate\Database\Seeder;

use App\User;
use App\UserJob;
use App\Job;
use App\GroupJob;
use App\GroupJobDetail;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        include('spmi.php');
        
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
