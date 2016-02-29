<?php

use Illuminate\Database\Seeder;
use App\PhysicalAddressCategory;

class PhysicalCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('physical_address_categories')->delete();
        PhysicalAddressCategory::insert([
            [
                'physical'                          =>  'Gedung',
                'physical_address_category_id'      =>  null,
                'created_at'                        => new DateTime,
                'updated_at'                        => new DateTime,
            ],
            [
                'physical'                          =>  'Lantai',
                'physical_address_category_id'      =>  '1',
                'created_at'                        => new DateTime,
                'updated_at'                        => new DateTime,
            ],     
            [
                'physical'                          =>  'Ruangan',
                'physical_address_category_id'      =>  '2',
                'created_at'                        => new DateTime,
                'updated_at'                        => new DateTime,
            ],
            [
                'physical'                          =>  'Lemari',
                'physical_address_category_id'      =>  '3',
                'created_at'                        => new DateTime,
                'updated_at'                        => new DateTime,
            ],
        ]);
    }
}
