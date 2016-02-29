<?php

use Illuminate\Database\Seeder;
use App\PhysicalAddress;
class PhysicalTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('physical_addresses')->delete();
        PhysicalAddress::insert([
            
            /**
             *  Building
            **/
            
            //1
            [
               'physical_address_category_id'   =>  1,
               'code'                           =>  'A',
               'description'                    =>  'Gedung A',
               'physical_address_id'            =>  null,
               'created_at'                     =>  new DateTime,
               'updated_at'                     =>  new DateTime,
            ],
            
            //2
            [
                'physical_address_category_id'  =>  1,
                'code'                          =>  'B',
                'description'                   =>  'Gedung B',
                'physical_address_id'           =>  null,
                'created_at'                    =>  new DateTime,
                'updated_at'                    =>  new DateTime,
            ],
            
            //3
            [
                'physical_address_category_id'  =>  1,
                'code'                          =>  'C',
                'description'                   =>  'Gedung C',
                'physical_address_id'           =>  null,
                'created_at'                    =>  new DateTime,
                'updated_at'                    =>  new DateTime,
            ],
            
            /**
             *  Lantai
             */
             
             //4
             [
                'physical_address_category_id'  =>  2,
                'code'                          =>  '01',
                'description'                   =>  'Lantai 1',
                'physical_address_id'           =>  1,
                'created_at'                    =>  new DateTime,
                'updated_at'                    =>  new DateTime,
             ],
             
             //5
             [
                'physical_address_category_id'  =>  2,
                'code'                          =>  '02',
                'description'                   =>  'Lantai 2',
                'physical_address_id'           =>  1,
                'created_at'                    =>  new DateTime,
                'updated_at'                    =>  new DateTime,
             ],
             
             //6
             [
                'physical_address_category_id'  =>  2,
                'code'                          =>  '03',
                'description'                   =>  'Lantai 3',
                'physical_address_id'           =>  1,
                'created_at'                    =>  new DateTime,
                'updated_at'                    =>  new DateTime,
             ],
             
             //7
             [
                'physical_address_category_id'  =>  2,
                'code'                          =>  '05',
                'description'                   =>  'Lantai 5',
                'physical_address_id'           =>  1,
                'created_at'                    =>  new DateTime,
                'updated_at'                    =>  new DateTime,
             ],
             
             //8
             [
                'physical_address_category_id'  =>  2,
                'code'                          =>  '06',
                'description'                   =>  'Lantai 6',
                'physical_address_id'           =>  1,
                'created_at'                    =>  new DateTime,
                'updated_at'                    =>  new DateTime,
             ],
             
             //9
             [
                'physical_address_category_id'  =>  2,
                'code'                          =>  '07',
                'description'                   =>  'Lantai 7',
                'physical_address_id'           =>  1,
                'created_at'                    =>  new DateTime,
                'updated_at'                    =>  new DateTime,
             ],
             
             //10
             [
                'physical_address_category_id'  =>  2,
                'code'                          =>  '08',
                'description'                   =>  'Lantai 8',
                'physical_address_id'           =>  1,
                'created_at'                    =>  new DateTime,
                'updated_at'                    =>  new DateTime,
             ],
             
             //11
             [
                'physical_address_category_id'  =>  2,
                'code'                          =>  '09',
                'description'                   =>  'Lantai 9',
                'physical_address_id'           =>  1,
                'created_at'                    =>  new DateTime,
                'updated_at'                    =>  new DateTime,
             ],
             
             
             
             
             
             //12
             [
                'physical_address_category_id'  =>  2,
                'code'                          =>  '01',
                'description'                   =>  'Lantai 1',
                'physical_address_id'           =>  2,
                'created_at'                    =>  new DateTime,
                'updated_at'                    =>  new DateTime,
             ],

             //13
             [
                'physical_address_category_id'  =>  2,
                'code'                          =>  '02',
                'description'                   =>  'Lantai 2',
                'physical_address_id'           =>  2,
                'created_at'                    =>  new DateTime,
                'updated_at'                    =>  new DateTime,
             ],
             
             //14
             [
                'physical_address_category_id'  =>  2,
                'code'                          =>  '03',
                'description'                   =>  'Lantai 3',
                'physical_address_id'           =>  2,
                'created_at'                    =>  new DateTime,
                'updated_at'                    =>  new DateTime,
             ],
             
             //15
             [
                'physical_address_category_id'  =>  2,
                'code'                          =>  '05',
                'description'                   =>  'Lantai 5',
                'physical_address_id'           =>  2,
                'created_at'                    =>  new DateTime,
                'updated_at'                    =>  new DateTime,
             ],
             
             //16
             [
                'physical_address_category_id'  =>  2,
                'code'                          =>  '06',
                'description'                   =>  'Lantai 6',
                'physical_address_id'           =>  2,
                'created_at'                    =>  new DateTime,
                'updated_at'                    =>  new DateTime,
             ],
             
             
             
             
             
             //17
             [
                'physical_address_category_id'  =>  2,
                'code'                          =>  '01',
                'description'                   =>  'Lantai 1',
                'physical_address_id'           =>  3,
                'created_at'                    =>  new DateTime,
                'updated_at'                    =>  new DateTime,
             ],
             
             //18
             [
                'physical_address_category_id'  =>  2,
                'code'                          =>  '02',
                'description'                   =>  'Lantai 2',
                'physical_address_id'           =>  3,
                'created_at'                    =>  new DateTime,
                'updated_at'                    =>  new DateTime,
             ],
             
             //19
             [
                'physical_address_category_id'  =>  2,
                'code'                          =>  '03',
                'description'                   =>  'Lantai 3',
                'physical_address_id'           =>  3,
                'created_at'                    =>  new DateTime,
                'updated_at'                    =>  new DateTime,
             ],
             
             //20
             [
                'physical_address_category_id'  =>  2,
                'code'                          =>  '05',
                'description'                   =>  'Lantai 5',
                'physical_address_id'           =>  3,
                'created_at'                    =>  new DateTime,
                'updated_at'                    =>  new DateTime,
             ],
             
             //21
             [
                'physical_address_category_id'  =>  2,
                'code'                          =>  '06',
                'description'                   =>  'Lantai 6',
                'physical_address_id'           =>  3,
                'created_at'                    =>  new DateTime,
                'updated_at'                    =>  new DateTime,
             ],
             
             //22
             [
                'physical_address_category_id'  =>  2,
                'code'                          =>  '07',
                'description'                   =>  'Lantai 7',
                'physical_address_id'           =>  3,
                'created_at'                    =>  new DateTime,
                'updated_at'                    =>  new DateTime,
             ],
             
             //23
             [
                'physical_address_category_id'  =>  2,
                'code'                          =>  '08',
                'description'                   =>  'Lantai 8',
                'physical_address_id'           =>  3,
                'created_at'                    =>  new DateTime,
                'updated_at'                    =>  new DateTime,
             ],
             
             //24
             [
                'physical_address_category_id'  =>  2,
                'code'                          =>  '09',
                'description'                   =>  'Lantai 9',
                'physical_address_id'           =>  3,
                'created_at'                    =>  new DateTime,
                'updated_at'                    =>  new DateTime,
             ],
             
             //25
             [
                'physical_address_category_id'  =>  2,
                'code'                          =>  '10',
                'description'                   =>  'Lantai 10',
                'physical_address_id'           =>  3,
                'created_at'                    =>  new DateTime,
                'updated_at'                    =>  new DateTime,
             ],
             
             //26
             [
                'physical_address_category_id'  =>  2,
                'code'                          =>  '11',
                'description'                   =>  'Lantai 11',
                'physical_address_id'           =>  3,
                'created_at'                    =>  new DateTime,
                'updated_at'                    =>  new DateTime,
             ],
             
             //27
             [
                'physical_address_category_id'  =>  2,
                'code'                          =>  '12',
                'description'                   =>  'Lantai 12',
                'physical_address_id'           =>  3,
                'created_at'                    =>  new DateTime,
                'updated_at'                    =>  new DateTime,
             ],
             
             
             
             
             
             
             //28
             [
                 'physical_address_category_id' =>  3,
                 'code'                         =>  'B201',
                 'description'                  =>  'Ruang B201',
                 'physical_address_id'          =>  13,
                 'created_at'                   =>  new DateTime,
                 'updated_at'                   =>  new DateTime,
             ],
             
             //29
             [
                 'physical_address_category_id' =>  3,
                 'code'                         =>  'B202',
                 'description'                  =>  'Ruang B202',
                 'physical_address_id'          =>  13,
                 'created_at'                   =>  new DateTime,
                 'updated_at'                   =>  new DateTime,
             ],
             
             //30
             [
                 'physical_address_category_id' =>  3,
                 'code'                         =>  'B203',
                 'description'                  =>  'Ruang B203',
                 'physical_address_id'          =>  13,
                 'created_at'                   =>  new DateTime,
                 'updated_at'                   =>  new DateTime,
             ],
             
             //31
             [
                 'physical_address_category_id' =>  3,
                 'code'                         =>  'B204',
                 'description'                  =>  'Ruang B204',
                 'physical_address_id'          =>  13,
                 'created_at'                   =>  new DateTime,
                 'updated_at'                   =>  new DateTime,
             ],
             
             //32
             [
                 'physical_address_category_id' =>  3,
                 'code'                         =>  'B205',
                 'description'                  =>  'Ruang B205',
                 'physical_address_id'          =>  13,
                 'created_at'                   =>  new DateTime,
                 'updated_at'                   =>  new DateTime,
             ],
             
             //33
             [
                 'physical_address_category_id' =>  3,
                 'code'                         =>  'B206',
                 'description'                  =>  'Ruang B206',
                 'physical_address_id'          =>  13,
                 'created_at'                   =>  new DateTime,
                 'updated_at'                   =>  new DateTime,
             ],
             
             //34
             [
                 'physical_address_category_id' =>  3,
                 'code'                         =>  'B207',
                 'description'                  =>  'Ruang B207',
                 'physical_address_id'          =>  13,
                 'created_at'                   =>  new DateTime,
                 'updated_at'                   =>  new DateTime,
             ],
             
             //35
             [
                 'physical_address_category_id' =>  3,
                 'code'                         =>  'B208',
                 'description'                  =>  'Ruang B208',
                 'physical_address_id'          =>  13,
                 'created_at'                   =>  new DateTime,
                 'updated_at'                   =>  new DateTime,
             ],
             
                         
            
            
        ]);   
    }
}
