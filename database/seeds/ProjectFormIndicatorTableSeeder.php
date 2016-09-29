<?php

use Illuminate\Database\Seeder;
use App\Project;
use App\ProjectNode;
use App\ProjectForm;
use App\ProjectFormIndicator;

class ProjectFormIndicatorTableSeeder extends Seeder
{
	private $projectPica = [];
								   /* PROJECT NODES OR CHILDREN */
	public function selectNodeAll($nodes, $parent, &$root, $id) {

    	 foreach($nodes as $key => $value) {

            $projectNode = ProjectNode::where('project_id', '=', $value->id)->where('project_type', '<>', 'App\Project')->get();

            if (count($projectNode) > 0) {

              $nodes[$key]['children'] = $projectNode;
              $this->selectNodeAll($projectNode, $nodes[$key], $root, $id);

            } else {

               	$projectForm = ProjectForm::where('project_node_id', '=', $value->id)->with('score')->first();
               	
               	
               	$nodes[$key]['end_node'] = $projectForm;
                array_push($this->projectPica, $nodes[$key]);
            }

        }
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       	$project = Project::with('projects')->where('status', '<>', 0)->where('id', '<', 13)->get();
        foreach ($project as $key => $value) {
            $this->selectNodeAll($value->projects, $value, $project[$key], 1);
            $value->nodes = $this->projectPica;
            $this->projectPica = [];

            ProjectFormIndicator::insert([
            	[
            		'project_form_id'	=>	$value->nodes[0]->end_node->id,
					'value' 			=> '4',
            		'order'				=>	0,
            		'size'				=>	1,
            		'description'		=>	'Memiliki visi, misi, tujuan, dan sasaran yang sangat jelas dan sangat realistik.',
            	],
            	[
            		'project_form_id'	=>	$value->nodes[0]->end_node->id,
					'value' 			=> '3',
            		'order'				=>	1,
            		'size'				=>	1,
            		'description'		=>	'Memiliki visi, misi, tujuan, dan sasaran jelas dan  realistik.'
            	],
            	[
            		'project_form_id'	=>	$value->nodes[0]->end_node->id,
					'value' 			=> '2',					
            		'order'				=>	2,
            		'size'				=>	1,
            		'description'		=>	'Memiliki visi, misi, tujuan, dan sasaran yang cukup jelas namun kurang realistik.'
            	],
            	[
            		'project_form_id'	=>	$value->nodes[0]->end_node->id,
					'value' 			=> '1',	
            		'order'				=>	3,
            		'size'				=>	1,
            		'description'		=>	'Memiliki visi, misi, tujuan, dan sasaran yang kurang jelas dan tidak realistik.'
            	],
            	[
            		'project_form_id'	=>	$value->nodes[0]->end_node->id,
					'value' 			=> '0',
            		'order'				=>	4,
            		'size'				=>	1,
            		'description'		=>	'(Tidak ada skor nol)'
            	],
				[
					'project_form_id'	=>	$value->nodes[1]->end_node->id,
					'value'				=> '4',
					'order'				=>	0,
            		'size'				=>	1,
            		'description'		=> 'Strategi pencapaian sasaran: (1)  dengan tahapan waktu yang jelas dan sangat realistik (2) didukung dokumen yang sangat lengkap' 
				],
				[
					'project_form_id'	=>	$value->nodes[1]->end_node->id,
					'value'				=> '3',
            		'order'				=>	1,
            		'size'				=>	1,
            		'description'		=>	'Strategi pencapaian sasaran: (1) dengan tahapan waktu yang jelas, dan realistik (2) didukung dokumen yang  lengkap.' 	
				],
				[
					'project_form_id'	=>	$value->nodes[1]->end_node->id,
					'value'				=> '2',
            		'order'				=>	2,
            		'size'				=>	1,
            		'description'		=>	'Strategi pencapaian sasaran: (1) dengan tahapan waktu yang jelas, dan cukup realistik (2) didukung dokumen yang cukup lengkap.' 	
				],
				[
					'project_form_id'	=>	$value->nodes[1]->end_node->id,
					'value'				=> '1',
            		'order'				=>	3 ,
            		'size'				=>	1,
            		'description'		=>	'Strategi pencapaian sasaran: (1) tanpa adanya tahapan waktu yang jelas, (2) didukung dokumen yang kurang lengkap.'	
				],
				[
					'project_form_id'	=>	$value->nodes[1]->end_node->id,
					'value'				=> '0',
            		'order'				=>	3 ,
            		'size'				=>	1,
            		'description'		=>	'(Tidak ada skor nol)'	
				],
				[
					'project_form_id'	=>	$value->nodes[2]->end_node->id,
					'value'				=> '4',
					'order'				=>	0,
            		'size'				=>	1,
            		'description'		=> 'Dipahami dengan baik oleh seluruh sivitas akademika  dan tenaga kependidikan. ' 
				],
				[
					'project_form_id'	=>	$value->nodes[2]->end_node->id,
					'value'				=> '3',
            		'order'				=>	1,
            		'size'				=>	1,
            		'description'		=>	'Dipahami dengan baik oleh sebagian  sivitas akademika dan tenaga kependidikan.' 	
				],
				[
					'project_form_id'	=>	$value->nodes[2]->end_node->id,
					'value'				=> '2',
            		'order'				=>	2,
            		'size'				=>	1,
            		'description'		=>	'Kurang dipahami oleh  sivitas akademika  dan tenaga kependidikan.' 	
				],
				[
					'project_form_id'	=>	$value->nodes[2]->end_node->id,
					'value'				=> '1',
            		'order'				=>	3 ,
            		'size'				=>	1,
            		'description'		=>	'Tidak dipahami oleh seluruh sivitas akademika dan tenaga kependidikan.'	
				],
				[
					'project_form_id'	=>	$value->nodes[2]->end_node->id,
					'value'				=> '0',
            		'order'				=>	3 ,
            		'size'				=>	1,
            		'description'		=>	'(Tidak ada skor nol)'	
				],
				[
					'project_form_id'	=>	$value->nodes[3]->end_node->id,
					'value'				=> '4',
					'order'				=>	0,
            		'size'				=>	1,
            		'description'		=> 'Program studi memiliki  tatapamong yang memungkinkan terlaksananya secara konsisten prinsip tatapamong, dan menjamin penyelenggaraan program studi yang memenuhi 5 aspek berikut :(1) kredibel (2)	transparan (3)	akuntabel (4)	bertanggung jawab (5)	adil' 
				],
				[
					'project_form_id'	=>	$value->nodes[3]->end_node->id,
					'value'				=> '3',
            		'order'				=>	1,
            		'size'				=>	1,
            		'description'		=>	'Program studi memiliki  tatapamong yang memungkinkan terlaksananya secara konsisten prinsip tatapamong, dan menjamin penyelenggaraan program studi yang memenuhi 4 dari 5 aspek berikut : (1)	kredibel (2) transparan (3)	akuntabel (4)	bertanggung jawab (5)	adil' 	
				],
				[
					'project_form_id'	=>	$value->nodes[3]->end_node->id,
					'value'				=> '2',
            		'order'				=>	2,
            		'size'				=>	1,
            		'description'		=>	'Program studi memiliki  tatapamong yang memungkinkan terlaksananya secara cukup konsisten prinsip tatapamong, dan menjamin penyelenggaraan program studi yang memenuhi  3 dari 5 aspek berikut : (1)	kredibel (2)	transparan (3)	akuntabel (4)	bertanggung jawab (5) adil' 	
				],
				[
					'project_form_id'	=>	$value->nodes[3]->end_node->id,
					'value'				=> '1',
            		'order'				=>	3 ,
            		'size'				=>	1,
            		'description'		=>	'Program studi memiliki  tatapamong, namun hanya memenuhi 1 s.d. 2 dari 5 aspek berikut :(1) kredibel (2) transparan (3) akuntabel (4)	bertang-gung jawab (5)	adil '	
				],
				[
					'project_form_id'	=>	$value->nodes[3]->end_node->id,
					'value'				=> '0',
            		'order'				=>	3 ,
            		'size'				=>	1,
            		'description'		=>	'(Tidak ada skor nol)'	
				],
				[
					'project_form_id'	=>	$value->nodes[4]->end_node->id,
					'value'				=> '4',
					'order'				=>	0,
            		'size'				=>	1,
            		'description'		=> 'Kepemimpinan program studi memiliki karakteristik yang kuat dalam: (1) kepemimpinan operasional, (2) kepemimpinan organisasi, (3) kepemimpinan publik ' 
				],
				[
					'project_form_id'	=>	$value->nodes[4]->end_node->id,
					'value'				=> '3',
            		'order'				=>	1,
            		'size'				=>	1,
            		'description'		=>	'Kepemimpinan program studi memiliki karakter kepemimpinan yang kuat dalam dua dari karakteristik berikut: (1) kepemimpinan operasional, (2) kepemimpinan organisasi, (3) kepemimpinan publik' 	
				],
				[
					'project_form_id'	=>	$value->nodes[4]->end_node->id,
					'value'				=> '2',
            		'order'				=>	2,
            		'size'				=>	1,
            		'description'		=>	'Kepemimpinan program studi memiliki karakter kepemimpinan yang kuat dalam salah satu dari karakteristik berikut: (1) kepemimpinan operasional, (2) kepemimpinan organisasi, (3) kepemimpinan publik ' 	
				],
				[
					'project_form_id'	=>	$value->nodes[4]->end_node->id,
					'value'				=> '1',
            		'order'				=>	3 ,
            		'size'				=>	1,
            		'description'		=>	'Kepemimpinan program studi lemah dalam karakteristik berikut: (1) kepemim-pinan operasional, (2) kepemim-pinan organisasi, (3) kepemim-pinan publik '	
				],
				[
					'project_form_id'	=>	$value->nodes[4]->end_node->id,
					'value'				=> '0',
            		'order'				=>	3 ,
            		'size'				=>	1,
            		'description'		=>	'(Tidak ada skor nol)'	
				],
				[
					'project_form_id'	=>	$value->nodes[5]->end_node->id,
					'value'				=> '4',
					'order'				=>	0,
            		'size'				=>	1,
            		'description'		=> 'Sistem pengelolaan fungsional dan operasional program studi berjalan sesuai dengan SOP, yang didukung dokumen yang lengkap.' 
				],
				[
					'project_form_id'	=>	$value->nodes[5]->end_node->id,
					'value'				=> '3',
            		'order'				=>	1,
            		'size'				=>	1,
            		'description'		=>	'Sistem pengelolaan fungsional dan operasional program studi dilakukan dengan cukup baik, sesuai dengan SOP, namun dokumen kurang lengkap.' 	
				],
				[
					'project_form_id'	=>	$value->nodes[5]->end_node->id,
					'value'				=> '2',
            		'order'				=>	2,
            		'size'				=>	1,
            		'description'		=>	'Sistem pengelolaan fungsional dan operasional program studi dilakukan hanya sebagian sesuai dengan SOP dan dokumen kurang lengkap.' 	
				],
				[
					'project_form_id'	=>	$value->nodes[5]->end_node->id,
					'value'				=> '1',
            		'order'				=>	3 ,
            		'size'				=>	1,
            		'description'		=>	'Sistem pengelolaan fungsional dan operasional program studi dilakukan tidak sesuai dengan SOP.'	
				],
				[
					'project_form_id'	=>	$value->nodes[5]->end_node->id,
					'value'				=> '0',
            		'order'				=>	3 ,
            		'size'				=>	1,
            		'description'		=>	'(Tidak ada skor nol)'	
				],
				[
					'project_form_id'	=>	$value->nodes[6]->end_node->id,
					'value'				=> '4',
					'order'				=>	0,
					'size'				=>	1,
					'description'		=> 'Sistem penjaminan mutu berjalan sesuai dengan standar penjaminan mutu, ada  umpan balik dan tindak lanjutnya, yang didukung dokumen yang lengkap.'
				],
				[
					'project_form_id'	=>	$value->nodes[6]->end_node->id,
					'value'				=> '3',
            		'order'				=>	1,
            		'size'				=>	1,
            		'description'		=>	'Sistem penjaminan mutu berjalan sesuai dengan standar penjaminan mutu, umpan balik tersedia tetapi tidak ada tindak lanjut.'
				],
				[
					'project_form_id'	=>	$value->nodes[6]->end_node->id,
					'value'				=> '2',
            		'order'				=>	2,
            		'size'				=>	1,
            		'description'		=>	'Sistem penjaminan mutu berfungsi sebagian namun  tidak ada umpan balik dan dokumen kurang lengkap.' 	
				],
				[
					'project_form_id'	=>	$value->nodes[6]->end_node->id,
					'value'				=> '1',
            		'order'				=>	3 ,
            		'size'				=>	1,
            		'description'		=>	'Ada sistem penjaminan mutu, tetapi tidak berfungsi.'
				],
				[
					'project_form_id'	=>	$value->nodes[6]->end_node->id,
					'value'				=> '0',
            		'order'				=>	3 ,
            		'size'				=>	1,
            		'description'		=>	'(Tidak ada skor nol)'	
				],
				[
					'project_form_id'	=>	$value->nodes[7]->end_node->id,
					'value'				=> '4',
					'order'				=>	0,
					'size'				=>	1,
					'description'		=> 'Umpan balik diperoleh dari dosen, mahasiswa, alumni dan pengguna serta ditindaklanjuti secara berkelanjutan.'
				],
				[
					'project_form_id'	=>	$value->nodes[7]->end_node->id,
					'value'				=> '3',
            		'order'				=>	1,
            		'size'				=>	1,
            		'description'		=>	'Umpan balik diperoleh dari dosen, mahasiswa, alumni dan pengguna serta ditindaklanjuti secara insidental.'
				],	
				[
					'project_form_id'	=>	$value->nodes[7]->end_node->id,
					'value'				=> '2',
            		'order'				=>	2,
            		'size'				=>	1,
            		'description'		=>	'Umpan balik hanya diperoleh dari sebagian dan ada tindak lanjut secara insidental.' 	
				],
				[
					'project_form_id'	=>	$value->nodes[7]->end_node->id,
					'value'				=> '1',
            		'order'				=>	3 ,
            		'size'				=>	1,
            		'description'		=>	'Umpan balik hanya diperoleh dari sebagian dan tidak ada tindak lanjut.'
				],
				[
					'project_form_id'	=>	$value->nodes[7]->end_node->id,
					'value'				=> '0',
            		'order'				=>	3 ,
            		'size'				=>	1,
            		'description'		=>	'(Tidak ada skor nol)'	
				],
				[
					'project_form_id'	=>	$value->nodes[8]->end_node->id,
					'value'				=> '4',
					'order'				=>	0,
					'size'				=>	1,
					'description'		=> 'Ada bukti semua usaha dilakukan berikut hasilnya. '
				],
				[
					'project_form_id'	=>	$value->nodes[8]->end_node->id,
					'value'				=> '3',
            		'order'				=>	1,
            		'size'				=>	1,
            		'description'		=>	'Ada bukti sebagian usaha ( > 3) dilakukan .'
				],	
				[
					'project_form_id'	=>	$value->nodes[8]->end_node->id,
					'value'				=> '2',
            		'order'				=>	2,
            		'size'				=>	1,
            		'description'		=>	'Ada bukti hanya sebagian kecil usaha (2-3) yang dilakukan.'
				],
				[
					'project_form_id'	=>	$value->nodes[8]->end_node->id,
					'value'				=> '1',
            		'order'				=>	3 ,
            		'size'				=>	1,
            		'description'		=>	'Ada bukti hanya 1 usaha yang dilakukan.'
				],
				[
					'project_form_id'	=>	$value->nodes[8]->end_node->id,
					'value'				=> '0',
            		'order'				=>	3 ,
            		'size'				=>	1,
            		'description'		=>	'(Tidak ada skor nol)'	
				],
				[
					'project_form_id'	=>	$value->nodes[9]->end_node->id,
					'value'				=> '4',
					'order'				=>	0,
					'size'				=>	1,
					'description'		=> 'Jika rasio ≥ 5, maka skor = 4'
				],
				[
					'project_form_id'	=>	$value->nodes[9]->end_node->id,
					'value'				=> '3-2',
            		'order'				=>	1,
            		'size'				=>	1,
            		'description'		=>	'Jika 1 < rasio < 5, maka skor  = (3 + Rasio)/2'
				],	
				[
					'project_form_id'	=>	$value->nodes[9]->end_node->id,
					'value'				=> '1-0',
            		'order'				=>	2,
            		'size'				=>	1,
            		'description'		=>	'Jika rasio ≤ 1, maka skor  = 2*Rasio'
				],
				[
					'project_form_id'	=>	$value->nodes[10]->end_node->id,
					'value'				=> '4',
					'order'				=>	0,
					'size'				=>	1,
					'description'		=> 'Jika rasio ≥ 95%, maka skor = 4.'
				],
				[
					'project_form_id'	=>	$value->nodes[10]->end_node->id,
					'value'				=> '3-1',
            		'order'				=>	1,
            		'size'				=>	1,
            		'description'		=>	'Jika 25% < rasio < 95%, maka skor = [(40 x rasio)-10]/7'
				],	
				[
					'project_form_id'	=>	$value->nodes[10]->end_node->id,
					'value'				=> '0',
            		'order'				=>	2,
            		'size'				=>	1,
            		'description'		=>	'Jika rasio ≤ 25%, maka skor = 0.'
				],
				[
					'project_form_id'	=>	$value->nodes[11]->end_node->id,
					'value'				=> '4',
					'order'				=>	0,
					'size'				=>	1,
					'description'		=> 'Jika RM ≤ 0.25, maka skor = 4.'
				],
				[
					'project_form_id'	=>	$value->nodes[11]->end_node->id,
					'value'				=> '3-1',
            		'order'				=>	1,
            		'size'				=>	1,
            		'description'		=>	'Jika 0.25 < RM < 1.25, maka skor = 5 – (4 x RM)'
				],	
				[
					'project_form_id'	=>	$value->nodes[11]->end_node->id,
					'value'				=> '0',
            		'order'				=>	2,
            		'size'				=>	1,
            		'description'		=>	'Jika RM ≥ 1.25, maka skor = 0'
				],
				[
					'project_form_id'	=>	$value->nodes[12]->end_node->id,
					'value'				=> '4',
					'order'				=>	0,
					'size'				=>	1,
					'description'		=> 'Jika IPK ≥ 3, maka skor = 4.'
				],
				[
					'project_form_id'	=>	$value->nodes[12]->end_node->id,
					'value'				=> '3',
            		'order'				=>	1,
            		'size'				=>	1,
            		'description'		=>	'Jika 2.75 < IPK < 3, maka skor = 4 x IPK - 8 '
				],	
				[
					'project_form_id'	=>	$value->nodes[12]->end_node->id,
					'value'				=> '2-0',
            		'order'				=>	2,
            		'size'				=>	1,
            		'description'		=>	'Jika 2 ≤ IPK  ≤ 2.75, maka skor = (4 x IPK-2)/3'
				],
				[
					'project_form_id'	=>	$value->nodes[13]->end_node->id,
					'value'				=> '4',
					'order'				=>	0,
					'size'				=>	1,
					'description'		=> 'Jumlah mahasiswa yang diterima masih memungkinkan dosen mengajar seluruh mahasiswa dengan total beban mendekati ideal, yaitu kurang atau sama dengan 13 sks.'
				],
				[
					'project_form_id'	=>	$value->nodes[13]->end_node->id,
					'value'				=> '3',
            		'order'				=>	1,
            		'size'				=>	1,
            		'description'		=>	'Jumlah mahasiswa yang diterima masih memungkinkan dosen mengajar seluruh mahasiswa dengan total beban lebih dari 13  s.d. 15 sks.'
				],	
				[
					'project_form_id'	=>	$value->nodes[13]->end_node->id,
					'value'				=> '2',
            		'order'				=>	2,
            		'size'				=>	1,
            		'description'		=>	'Jumlah mahasiswa yang diterima masih memungkinkan dosen mengajar seluruh mahasiswa dengan total beban lebih dari 15  s.d. 17 sks.'
				],
				[
					'project_form_id'	=>	$value->nodes[13]->end_node->id,
					'value'				=> '1',
            		'order'				=>	2,
            		'size'				=>	1,
            		'description'		=>	'Jumlah mahasiswa yang diterima mengakibatkan beban dosen relatif berat, yaitu lebih dari 17 s.d. 19 sks.'
				],
				[
					'project_form_id'	=>	$value->nodes[13]->end_node->id,
					'value'				=> '0',
            		'order'				=>	2,
            		'size'				=>	1,
            		'description'		=>	'Jumlah mahasiswa yang diterima mengakibatkan beban dosen sangat berat, melebihi 19 sks.'
				],
				[
					'project_form_id'	=>	$value->nodes[14]->end_node->id,
					'value'				=> '4',
					'order'				=>	0,
					'size'				=>	1,
					'description'		=> 'Ada bukti penghargaan juara lomba ilmiah, olah raga, maupun seni tingkat nasional atau internasional.'
				],
				[
					'project_form_id'	=>	$value->nodes[14]->end_node->id,
					'value'				=> '3',
            		'order'				=>	1,
            		'size'				=>	1,
            		'description'		=>	'Ada bukti penghargaan juara lomba ilmiah, olah raga, maupun seni tingkat wilayah.'
				],	
				[
					'project_form_id'	=>	$value->nodes[14]->end_node->id,
					'value'				=> '2',
            		'order'				=>	2,
            		'size'				=>	1,
            		'description'		=>	'Ada bukti penghargaan juara lomba ilmiah, olah raga, maupun seni tingkat lokal PT.'
				],
				[
					'project_form_id'	=>	$value->nodes[14]->end_node->id,
					'value'				=> '1',
            		'order'				=>	2,
            		'size'				=>	1,
            		'description'		=>	'Tidak ada bukti penghargaan. '
				],
				[
					'project_form_id'	=>	$value->nodes[14]->end_node->id,
					'value'				=> '0',
            		'order'				=>	2,
            		'size'				=>	1,
            		'description'		=>	'(Tidak ada skor nol)'
				],
				[
					'project_form_id'	=>	$value->nodes[15]->end_node->id,
					'value'				=> '4',
					'order'				=>	0,
					'size'				=>	1,
					'description'		=> 'Jika KTW ≥ 50%, maka skor = 4.'
				],
				[
					'project_form_id'	=>	$value->nodes[15]->end_node->id,
					'value'				=> '3-1',
            		'order'				=>	1,
            		'size'				=>	1,
            		'description'		=>	'Jika  0% < KTW < 50%, maka skor = 1 + (6 x KTW).'
				],	
				[
					'project_form_id'	=>	$value->nodes[15]->end_node->id,
					'value'				=> '0',
            		'order'				=>	2,
            		'size'				=>	1,
            		'description'		=>	'Jika KTW = 0, maka skor = 0.'
				],
				[
					'project_form_id'	=>	$value->nodes[16]->end_node->id,
					'value'				=> '4',
            		'order'				=>	2,
            		'size'				=>	1,
            		'description'		=>	'Jika MDO ≤  6%, maka skor = 4.'
				],
				[
					'project_form_id'	=>	$value->nodes[16]->end_node->id,
					'value'				=> '3-1',
            		'order'				=>	2,
            		'size'				=>	1,
            		'description'		=>	'Jika 6% < MDO < 45%, maka skor = [180 – (400 x MDO)] / 39.'
				],
				[
					'project_form_id'	=>	$value->nodes[16]->end_node->id,
					'value'				=> '0',
            		'order'				=>	2,
            		'size'				=>	1,
            		'description'		=>	'Jika MDO ≥ 45%, maka skor = 0.'
				],
				[
					'project_form_id'	=>	$value->nodes[17]->end_node->id,
					'value'				=> '4',
					'order'				=>	0,
					'size'				=>	1,
					'description'		=> 'Ada semua (5 jenis) pelayanan mahasiswa yang dapat diakses.'
				],
				[
					'project_form_id'	=>	$value->nodes[17]->end_node->id,
					'value'				=> '3',
            		'order'				=>	1,
            		'size'				=>	1,
            		'description'		=>	'Ada jenis layanan nomor 1 sampai dengan nomor 3.'
				],	
				[
					'project_form_id'	=>	$value->nodes[17]->end_node->id,
					'value'				=> '2',
            		'order'				=>	2,
            		'size'				=>	1,
            		'description'		=>	'Ada jenis layanan nomor 1 sampai dengan nomor 2.'
				],
				[
					'project_form_id'	=>	$value->nodes[17]->end_node->id,
					'value'				=> '1',
            		'order'				=>	2,
            		'size'				=>	1,
            		'description'		=>	'Ada 2 jenis unit pelayanan.'
				],
				[
					'project_form_id'	=>	$value->nodes[17]->end_node->id,
					'value'				=> '0',
            		'order'				=>	2,
            		'size'				=>	1,
            		'description'		=>	'Kurang dari 2 unit pelayanan.'
				],
				[
					'project_form_id'	=>	$value->nodes[18]->end_node->id,
					'value'				=> '4-0',
            		'order'				=>	2,
            		'size'				=>	1,
            		'description'		=>	'Skor = SL'
				],
				[
					'project_form_id'	=>	$value->nodes[19]->end_node->id,
					'value'				=> '4',
					'order'				=>	0,
					'size'				=>	1,
					'description'		=> 'Ada upaya yang intensif untuk melacak  lulusan dan datanya terekam secara komprehensif'
				],
				[
					'project_form_id'	=>	$value->nodes[19]->end_node->id,
					'value'				=> '3',
            		'order'				=>	1,
            		'size'				=>	1,
            		'description'		=>	'Ada upaya yang intensif untuk melacak  lulusan, tetapi hasilnya belum  terekam secara komprehensif'
				],	
				[
					'project_form_id'	=>	$value->nodes[19]->end_node->id,
					'value'				=> '2',
            		'order'				=>	2,
            		'size'				=>	1,
            		'description'		=>	'Upaya pelacakan dilakukan sekedarnya dan hasilnya terekam '
				],
				[
					'project_form_id'	=>	$value->nodes[19]->end_node->id,
					'value'				=> '1',
            		'order'				=>	2,
            		'size'				=>	1,
            		'description'		=>	'Upaya pela-cakan lulusan dilakukan sekedarnya dan hasilnya tidak terekam '
				],
				[
					'project_form_id'	=>	$value->nodes[19]->end_node->id,
					'value'				=> '0',
            		'order'				=>	2,
            		'size'				=>	1,
            		'description'		=>	'Tidak ada upaya pelacakan lulusan'
				],

				



			

        	]);
        }
    }
}
