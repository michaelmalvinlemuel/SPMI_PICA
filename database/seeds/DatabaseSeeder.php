<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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

        include('spmilaravel (4).php');
        
        $this->call(HierarchyDatabaseSeeder::class);
        $this->call(DocumentDatabaseSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(ProjectTableSeeder::class);
        $this->call(ProjectTemplateTableSeeder::class);
        
        Model::reguard();
    }
}

