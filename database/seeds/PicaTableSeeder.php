<?php

use Illuminate\Database\Seeder;
use App\Pica;
use App\PicaDetail;

class PicaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pica::insert([
          [
            'department_id'     =>  '7',
            'tanggal'           =>  new DateTime,
            'project_node_id'   =>  '4',
            'user_id'           =>  '8',
            'problem'           =>  'Masalah',
            'created_at'        =>  new DateTime,
            'updated_at'        =>  new DateTime,
          ],
          [
            'department_id'     =>  '9',
            'tanggal'           =>  new DateTime,
            'project_node_id'   =>  '12',
            'user_id'           =>  '12',
            'problem'           =>  'Kendala',
            'created_at'        =>  new DateTime,
            'updated_at'        =>  new DateTime,
          ],
        ]);

        PicaDetail::insert([
          [
              'pica_id'     =>  '1',
              'rencana'     =>  'Solusi',
              'user_id'     =>  '3',
              'expdate'     =>  '10-10-2016',
              'created_at'  =>  new DateTime,
              'updated_at'  =>  new DateTime,
          ],
          [
              'pica_id'     =>  '1',
              'rencana'     =>  'Rumusan',
              'user_id'     =>  '4',
              'expdate'     =>  '11-11-2017',
              'created_at'  =>  new DateTime,
              'updated_at'  =>  new DateTime,
          ],
          [
              'pica_id'     =>  '2',
              'rencana'     =>  'Kesimpulan',
              'user_id'     =>  '5',
              'expdate'     =>  '12-12-2018',
              'created_at'  =>  new DateTime,
              'updated_at'  =>  new DateTime,
          ],[
              'pica_id'     =>  '2',
              'rencana'     =>  'Jalan Keluar',
              'user_id'     =>  '6',
              'expdate'     =>  '9-9-2019',
              'created_at'  =>  new DateTime,
              'updated_at'  =>  new DateTime,
          ],[
              'pica_id'     =>  '2',
              'rencana'     =>  'Pencerahan',
              'user_id'     =>  '7',
              'expdate'     =>  '8-8-2020',
              'created_at'  =>  new DateTime,
              'updated_at'  =>  new DateTime,
          ],
        ]);
    }
}
