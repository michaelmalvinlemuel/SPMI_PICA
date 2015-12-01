<?php


use Illuminate\Database\Seeder;

use App\Standard;
use App\StandardDocument;
use App\Guide;
use App\Instruction;
use App\Form;

class DocumentDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        include('spmi.php');

        DB::table('standards')->delete();
        Standard::insert($standards);

        DB::table('standard_documents')->delete();
        StandardDocument::insert($standard_documents);
        
        DB::table('guides')->delete();
        Guide::insert($guides);


        DB::table('instructions')->delete();
        Instruction::insert($instructions);


        DB::table('forms')->delete();
        Form::insert($forms);
    }
}
