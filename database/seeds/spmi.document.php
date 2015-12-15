<?php
/**
 * Export to PHP Array plugin for PHPMyAdmin
 * @version 0.2b
 */

//
// Database `spmi`
//

// `spmi`.`standards`
$standards = [
  ['id' => '1','no' => '1','date' => '2015-11-17','description' => 'SPT - Standar Pendidikan Tinggi','created_at' => '2015-11-17 00:09:52','updated_at' => '2015-11-17 00:09:52','deleted_at' => NULL],
  ['id' => '2','no' => '2','date' => '2015-11-17','description' => 'SPU - Standar Penelitian','created_at' => '2015-11-17 00:09:52','updated_at' => '2015-11-26 10:47:38','deleted_at' => NULL],
  ['id' => '3','no' => '3','date' => '2015-11-17','description' => 'SPM - Standar Pengabdian kepada Masyarakat','created_at' => '2015-11-17 00:09:52','updated_at' => '2015-11-26 10:47:56','deleted_at' => NULL]
];

// `spmi`.`standard_documents`
$standard_documents = [
  ['id' => '1','standard_id' => '1','no' => 'SPT-01','date' => '2015-01-09','description' => 'Standar Kompetensi Lulusan','document' => 'STANDARKOMPETENSILULUSAN_20151211132301.PDF','created_at' => '2015-11-17 00:09:52','updated_at' => '2015-12-11 14:17:04','deleted_at' => NULL],
  ['id' => '2','standard_id' => '1','no' => 'SPT-02','date' => '2015-01-09','description' => 'Standar Isi Pembelajaran','document' => 'STANDARISIPEMBELAJARAN_20151211132407.PDF','created_at' => '2015-11-17 00:09:52','updated_at' => '2015-12-11 14:18:10','deleted_at' => NULL],
  ['id' => '3','standard_id' => '1','no' => 'SPT-03','date' => '2015-01-09','description' => 'Standar Proses Pembelajaran','document' => 'STANDARPROSESPEMBELAJARAN_20151211132441.PDF','created_at' => '2015-11-17 00:09:52','updated_at' => '2015-12-11 14:18:44','deleted_at' => NULL],
  ['id' => '4','standard_id' => '1','no' => 'SPT-04','date' => '2015-01-09','description' => 'Standar Penilaian Pembelajaran','document' => 'STANDARPENILAIANPEMBELAJARAN_20151211132512.PDF','created_at' => '2015-11-17 00:09:52','updated_at' => '2015-12-11 14:19:15','deleted_at' => NULL],
  ['id' => '5','standard_id' => '1','no' => 'SPT-05','date' => '2015-01-29','description' => 'Standar Dosen dan Tenaga Kependidikan','document' => 'STANDARDOSENDANTENAGAKEPENDIDIKAN_20151211132537.PDF','created_at' => '2015-11-17 00:09:52','updated_at' => '2015-12-11 14:19:41','deleted_at' => NULL],
  ['id' => '6','standard_id' => '1','no' => 'SPT-06','date' => '2015-01-09','description' => 'Standar Sarana dan Prasarana Pembelajaran','document' => 'STANDARSARANADANPRASARANAPEMBELAJARAN_20151211140215.PDF','created_at' => '2015-11-17 00:09:52','updated_at' => '2015-12-11 14:56:21','deleted_at' => NULL],
  ['id' => '7','standard_id' => '1','no' => 'SPT-07','date' => '2015-01-09','description' => 'Standar Pengelolaan Pembelajaran','document' => 'STANDARPENGELOLAANPEMBELAJARAN_20151211132630.PDF','created_at' => '2015-11-17 00:09:52','updated_at' => '2015-12-11 14:20:33','deleted_at' => NULL],
  ['id' => '8','standard_id' => '1','no' => 'SPT-08','date' => '2015-01-09','description' => 'Standar Pembiayaan Pembelajaran','document' => 'STANDARPEMBIAYAANPEMBELAJARAN_20151211132657.PDF','created_at' => '2015-11-17 00:09:52','updated_at' => '2015-12-11 14:21:00','deleted_at' => NULL],
  ['id' => '9','standard_id' => '1','no' => 'SPT-09','date' => '2015-11-25','description' => 'Standar Kemahasiswaan','document' => 'STANDARKEMAHASISWAAN_20151211132754.PDF','created_at' => '2015-11-26 10:06:26','updated_at' => '2015-12-11 14:21:58','deleted_at' => NULL],
  ['id' => '10','standard_id' => '1','no' => 'SPT-10','date' => '2015-10-06','description' => 'Standar Kerjasama','document' => 'STANDARKERJASAMA_20151211132817.PDF','created_at' => '2015-11-26 10:23:48','updated_at' => '2015-12-11 14:22:21','deleted_at' => NULL],
  ['id' => '11','standard_id' => '1','no' => 'SPT-11','date' => '2015-10-06','description' => 'Standar Sistem Informasi','document' => 'STANDARSISTEMINFORMASI_20151211132845.PDF','created_at' => '2015-11-26 10:25:10','updated_at' => '2015-12-11 14:22:48','deleted_at' => NULL],
  ['id' => '12','standard_id' => '1','no' => 'SPT-12','date' => '2015-10-06','description' => 'Standar Suasana Akademik','document' => 'STANDARSUASANAAKADEMIK_20151211132911.PDF','created_at' => '2015-11-26 10:26:30','updated_at' => '2015-12-11 14:23:15','deleted_at' => NULL],
  ['id' => '13','standard_id' => '2','no' => 'SPU-01','date' => '2015-01-09','description' => 'Standar Hasil Penelitian','document' => 'STANDARHASILPENELITIAN_20151211133223.PDF','created_at' => '2015-11-26 10:49:25','updated_at' => '2015-12-11 14:26:26','deleted_at' => NULL],
  ['id' => '14','standard_id' => '2','no' => 'SPU-02','date' => '2015-01-09','description' => 'Standar Isi Penelitian','document' => 'STANDARISIPENELITIAN_20151211133252.PDF','created_at' => '2015-11-26 10:51:03','updated_at' => '2015-12-11 14:26:55','deleted_at' => NULL],
  ['id' => '15','standard_id' => '2','no' => 'SPU-03','date' => '2015-01-09','description' => 'Standar Proses Penelitian','document' => 'STANDARPROSESPENELITIAN_20151211135610.PDF','created_at' => '2015-11-26 10:52:57','updated_at' => '2015-12-11 14:52:35','deleted_at' => NULL],
  ['id' => '16','standard_id' => '2','no' => 'SPU-04','date' => '2015-01-09','description' => 'Standar Penilaian Penelitian','document' => 'STANDARPENILAIANPENELITIAN_20151211140003.PDF','created_at' => '2015-11-26 10:54:21','updated_at' => '2015-12-11 14:54:07','deleted_at' => NULL],
  ['id' => '17','standard_id' => '2','no' => 'SPU-05','date' => '2015-01-09','description' => 'Standar Peneliti','document' => 'STANDARPENELITI_20151211140131.PDF','created_at' => '2015-11-26 10:55:42','updated_at' => '2015-12-11 14:55:36','deleted_at' => NULL],
  ['id' => '18','standard_id' => '2','no' => 'SPU-06','date' => '2015-01-09','description' => 'Standar Sarana dan Prasarana Penelitian','document' => 'STANDARSARANADANPRASARANAPENELITIAN_20151126100249.PDF','created_at' => '2015-11-26 10:57:08','updated_at' => '2015-11-26 10:57:25','deleted_at' => NULL],
  ['id' => '19','standard_id' => '2','no' => 'SPU-07','date' => '2015-01-09','description' => 'Standar Pengelolaan Penelitian','document' => 'STANDARPENGELOLAANPENELITIAN_20151211140257.PDF','created_at' => '2015-11-26 10:59:11','updated_at' => '2015-12-11 14:57:18','deleted_at' => NULL],
  ['id' => '20','standard_id' => '2','no' => 'SPU-08','date' => '2015-01-09','description' => 'Standar Pembiayaan Penelitian','document' => 'STANDARPEMBIAYAANPENELITIAN_20151211140356.PDF','created_at' => '2015-11-26 11:00:49','updated_at' => '2015-12-11 14:58:05','deleted_at' => NULL],
  ['id' => '21','standard_id' => '3','no' => 'SPM-01','date' => '2015-11-10','description' => 'Standar Hasil Pengabdian kepada Masyarakat','document' => 'STANDARHASILPENGABDIANKEPADAMASYARAKAT_20151211140534.PDF','created_at' => '2015-11-26 11:08:15','updated_at' => '2015-12-11 14:59:39','deleted_at' => NULL],
  ['id' => '22','standard_id' => '3','no' => 'SPM-01','date' => '2015-11-09','description' => 'Standar Hasil Pengabdian kepada Masyarakat','document' => 'STANDARHASILPENGABDIANKEPADAMASYARAKAT_20151126101357.PDF','created_at' => '2015-11-26 11:08:16','updated_at' => '2015-11-26 11:10:07','deleted_at' => '2015-11-26 11:10:07'],
  ['id' => '23','standard_id' => '3','no' => 'SPM-02','date' => '2015-11-10','description' => 'Standar Isi Pengabdian kepada Masyarakat','document' => 'STANDARISIPENGABDIANKEPADAMASYARAKAT_20151211140752.PDF','created_at' => '2015-11-26 11:11:07','updated_at' => '2015-12-11 15:01:56','deleted_at' => NULL],
  ['id' => '24','standard_id' => '3','no' => 'SPM-03','date' => '2015-11-10','description' => 'Standar Proses Pengabdian kepada Masyarakat','document' => 'STANDARPROSESPENGABDIANKEPADAMASYARAKAT_20151211140804.PDF','created_at' => '2015-11-26 11:14:54','updated_at' => '2015-12-11 15:02:07','deleted_at' => NULL],
  ['id' => '25','standard_id' => '3','no' => 'SPM-04','date' => '2015-11-10','description' => 'Standar Penilaian Pengabdian kepada Masyarakat','document' => 'STANDARPENILAIANPENGABDIANKEPADAMASYARAKAT_20151211140814.PDF','created_at' => '2015-11-26 11:16:17','updated_at' => '2015-12-11 15:02:18','deleted_at' => NULL],
  ['id' => '26','standard_id' => '3','no' => 'SPM-05','date' => '2015-11-10','description' => 'Standar Pelaksana Pengabdian kepada Masyarakat','document' => 'STANDARPELAKSANAPENGABDIANKEPADAMASYARAKAT_20151211140826.PDF','created_at' => '2015-11-26 11:17:25','updated_at' => '2015-12-11 15:02:29','deleted_at' => NULL],
  ['id' => '27','standard_id' => '3','no' => 'SPM-06','date' => '2015-11-10','description' => 'Standar Sarana dan Prasarana Pengabdian kepada Masyarakat','document' => 'STANDARSARANADANPRASARANAPENGABDIANKEPADAMASYARAKAT_20151211140844.PDF','created_at' => '2015-11-26 11:18:22','updated_at' => '2015-12-11 15:02:48','deleted_at' => NULL],
  ['id' => '28','standard_id' => '3','no' => 'SPM-07','date' => '2015-11-10','description' => 'Standar Pengelolaan Pengabdian kepada Masyarakat','document' => 'STANDARPENGELOLAANPENGABDIANKEPADAMASYARAKAT_20151211140847.PDF','created_at' => '2015-11-26 11:19:23','updated_at' => '2015-12-11 15:02:50','deleted_at' => NULL],
  ['id' => '29','standard_id' => '3','no' => 'SPM-08','date' => '2015-11-10','description' => 'Standar Pembiayaan Pengabdian kepada Masyarakat','document' => 'STANDARPEMBIAYAANPENGABDIANKEPADAMASYARAKAT_20151211140858.PDF','created_at' => '2015-11-26 11:20:37','updated_at' => '2015-12-11 15:03:01','deleted_at' => NULL]
];



// `spmi`.`guides`
$guides = [
  ['id' => '1','standard_document_id' => '1','no' => 'SPT-01/PM-01','date' => '2015-01-09','description' => 'Prosedur Mutu Kompetensi Lulusan','document' => 'PROSEDURMUTUKOMPETENSILULUSAN_20151211141520.PDF','created_at' => '2015-11-17 00:09:52','updated_at' => '2015-12-11 15:09:24','deleted_at' => NULL],
  ['id' => '2','standard_document_id' => '2','no' => 'SPT-02/PM-01','date' => '2015-01-09','description' => 'Prosedur Mutu Isi Pembelajaran','document' => 'PROSEDURMUTUISIPEMBELAJARAN_20151211141541.PDF','created_at' => '2015-11-17 00:09:52','updated_at' => '2015-12-11 15:09:44','deleted_at' => NULL],
  ['id' => '3','standard_document_id' => '3','no' => 'SPT-03/PM-01','date' => '2015-01-09','description' => 'Prosedur Mutu Proses Pembelajaran','document' => 'PROSEDURMUTUPROSESPEMBELAJARAN_20151211141601.PDF','created_at' => '2015-11-26 10:31:06','updated_at' => '2015-12-11 15:10:05','deleted_at' => NULL],
  ['id' => '4','standard_document_id' => '4','no' => 'SPT-04/PM-01','date' => '2015-01-09','description' => 'Prosedur Mutu Penilaian Pembelajaran','document' => 'PROSEDURMUTUPENILAIANPEMBELAJARAN_20151211141826.PDF','created_at' => '2015-11-26 10:32:49','updated_at' => '2015-12-11 15:12:30','deleted_at' => NULL],
  ['id' => '5','standard_document_id' => '5','no' => 'SPT-05/PM-01','date' => '2015-01-29','description' => 'Prosedur Mutu Dosen dan Tenaga Kependidikan','document' => 'PROSEDURMUTUDOSENDANTENAGAKEPENDIDIKAN_20151211141836.PDF','created_at' => '2015-11-26 10:34:29','updated_at' => '2015-12-11 15:12:38','deleted_at' => NULL],
  ['id' => '6','standard_document_id' => '6','no' => 'SPT-06/PM-01','date' => '2015-10-06','description' => 'Prosedur Mutu Gedung, Ruang Kerja Dosen, Kantor, dan Ruang Kelas','document' => 'PROSEDURMUTUGEDUNG,RUANGKERJADOSEN,KANTOR,DANRUANGKELAS_20151211141851.PDF','created_at' => '2015-11-26 10:36:25','updated_at' => '2015-12-11 15:12:54','deleted_at' => NULL],
  ['id' => '7','standard_document_id' => '6','no' => 'SPT-06/PM-02','date' => '2015-10-06','description' => 'Prosedur Mutu Perpustakaan','document' => 'PROSEDURMUTUPERPUSTAKAAN_20151211141859.PDF','created_at' => '2015-11-26 11:25:24','updated_at' => '2015-12-11 15:13:02','deleted_at' => NULL],
  ['id' => '8','standard_document_id' => '6','no' => 'SPT-06/PM-03','date' => '2015-10-06','description' => 'Prosedur Mutu Sarana dan Prasarana Pendukung Proses Pembelajaran','document' => 'PROSEDURMUTUSARANADANPRASARANAPENDUKUNGPROSESPEMBELAJARAN_20151211142423.PDF','created_at' => '2015-11-26 11:29:35','updated_at' => '2015-12-11 15:18:27','deleted_at' => NULL],
  ['id' => '9','standard_document_id' => '6','no' => 'SPT-06/PM-04','date' => '2015-10-06','description' => 'Prosedur Mutu Sarana Prasarana Lain-Lain','document' => 'PROSEDURMUTUSARANAPRASARANALAIN-LAIN_20151211142437.PDF','created_at' => '2015-11-26 11:33:43','updated_at' => '2015-12-11 15:18:40','deleted_at' => NULL],
  ['id' => '10','standard_document_id' => '7','no' => 'SPT-07/PM-01','date' => '2015-01-09','description' => 'Prosedur Mutu Pengelolaan Pembelajaran','document' => 'PROSEDURMUTUPENGELOLAANPEMBELAJARAN_20151211142445.PDF','created_at' => '2015-11-26 11:35:06','updated_at' => '2015-12-11 15:18:47','deleted_at' => NULL],
  ['id' => '11','standard_document_id' => '8','no' => 'SPT-08/PM-01','date' => '2015-01-09','description' => 'Prosedur Mutu Pembiayaan Pembelajaran','document' => 'PROSEDURMUTUPEMBIAYAANPEMBELAJARAN_20151211142455.PDF','created_at' => '2015-11-26 11:36:23','updated_at' => '2015-12-11 15:18:58','deleted_at' => NULL],
  ['id' => '12','standard_document_id' => '9','no' => 'SPT-09/PM-01','date' => '2015-10-06','description' => 'Prosedur Mutu Kemahasiswaan (Student Service)','document' => 'PROSEDURMUTUKEMAHASISWAAN(STUDENTSERVICE)_20151211142510.PDF','created_at' => '2015-11-26 11:37:28','updated_at' => '2015-12-11 15:19:14','deleted_at' => NULL],
  ['id' => '13','standard_document_id' => '9','no' => 'SPT-09/PM-02','date' => '2015-10-06','description' => 'Prosedur Mutu Kemahasiswaan (Student Development)','document' => 'PROSEDURMUTUKEMAHASISWAAN(STUDENTDEVELOPMENT)_20151211142514.PDF','created_at' => '2015-11-26 11:38:47','updated_at' => '2015-12-11 15:19:18','deleted_at' => NULL],
  ['id' => '14','standard_document_id' => '9','no' => 'SPT-09/PM-03','date' => '2015-10-06','description' => 'Prosedur Mutu Kemahasiswaan (Career and Development Center)','document' => 'PROSEDURMUTUKEMAHASISWAAN(CAREERANDDEVELOPMENTCENTER)_20151211142523.PDF','created_at' => '2015-11-26 11:40:14','updated_at' => '2015-12-11 15:19:26','deleted_at' => NULL],
  ['id' => '15','standard_document_id' => '10','no' => 'SPT-10/PM-01','date' => '2015-10-06','description' => 'Prosedur Mutu Kerjasama','document' => 'PROSEDURMUTUKERJASAMA_20151211142525.PDF','created_at' => '2015-11-26 11:41:21','updated_at' => '2015-12-11 15:19:28','deleted_at' => NULL],
  ['id' => '16','standard_document_id' => '11','no' => 'SPT-11/PM-01','date' => '2015-10-06','description' => 'Prosedur Mutu Sistem Informasi','document' => 'PROSEDURMUTUSISTEMINFORMASI_20151211142531.PDF','created_at' => '2015-11-26 11:42:19','updated_at' => '2015-12-11 15:19:33','deleted_at' => NULL],
  ['id' => '17','standard_document_id' => '12','no' => 'SPT-12/PM-01','date' => '2015-10-06','description' => 'Prosedur Mutu Suasana Akademik','document' => 'PROSEDURMUTUSUASANAAKADEMIK_20151211142540.PDF','created_at' => '2015-11-26 11:43:27','updated_at' => '2015-12-11 15:19:43','deleted_at' => NULL],
  ['id' => '18','standard_document_id' => '13','no' => 'SPU-01/PM-01','date' => '2015-01-09','description' => 'Prosedur Mutu Hasil Penelitian','document' => 'PROSEDURMUTUHASILPENELITIAN_20151211142742.PDF','created_at' => '2015-11-26 11:45:09','updated_at' => '2015-12-11 15:21:45','deleted_at' => NULL],
  ['id' => '19','standard_document_id' => '14','no' => 'SPU-02/PM-01','date' => '2015-01-09','description' => 'Prosedur Mutu Isi Penelitian','document' => 'PROSEDURMUTUISIPENELITIAN_20151211142755.PDF','created_at' => '2015-11-26 11:46:10','updated_at' => '2015-12-11 15:21:58','deleted_at' => NULL],
  ['id' => '20','standard_document_id' => '15','no' => 'SPU-03/PM-01','date' => '2015-01-09','description' => 'Prosedur Mutu Proses Penelitian','document' => 'PROSEDURMUTUPROSESPENELITIAN_20151211142807.PDF','created_at' => '2015-11-26 11:47:49','updated_at' => '2015-12-11 15:22:10','deleted_at' => NULL],
  ['id' => '21','standard_document_id' => '16','no' => 'SPU-04/PM-01','date' => '2015-01-09','description' => 'Prosedur Mutu Penilaian Penelitian','document' => 'PROSEDURMUTUPENILAIANPENELITIAN_20151211142824.PDF','created_at' => '2015-11-26 11:48:49','updated_at' => '2015-12-11 15:22:28','deleted_at' => NULL],
  ['id' => '22','standard_document_id' => '17','no' => 'SPU-05/PM-01','date' => '2015-01-09','description' => 'Prosedur Mutu Peneliti','document' => 'PROSEDURMUTUPENELITI_20151211142829.PDF','created_at' => '2015-11-26 11:49:40','updated_at' => '2015-12-11 15:22:32','deleted_at' => NULL],
  ['id' => '23','standard_document_id' => '18','no' => 'SPU-06/PM-01','date' => '2015-01-09','description' => 'Prosedur Mutu Sarana dan Prasarana Penelitian','document' => 'PROSEDURMUTUSARANADANPRASARANAPENELITIAN_20151211142840.PDF','created_at' => '2015-11-26 11:50:58','updated_at' => '2015-12-11 15:22:43','deleted_at' => NULL],
  ['id' => '24','standard_document_id' => '19','no' => 'SPU-07/PM-01','date' => '2015-01-09','description' => 'Prosedur Mutu Pengelolaan Penelitian','document' => 'PROSEDURMUTUPENGELOLAANPENELITIAN_20151211142857.PDF','created_at' => '2015-11-26 11:51:41','updated_at' => '2015-12-11 15:22:59','deleted_at' => NULL],
  ['id' => '25','standard_document_id' => '20','no' => 'SPU-08/PM-01','date' => '2015-01-09','description' => 'Prosedur Mutu Pembiayaan Penelitian','document' => 'PROSEDURMUTUPEMBIAYAANPENELITIAN_20151211142909.PDF','created_at' => '2015-11-26 11:52:23','updated_at' => '2015-12-11 15:23:12','deleted_at' => NULL],
  ['id' => '26','standard_document_id' => '21','no' => 'SPM-01/PM-01','date' => '2015-11-10','description' => 'Prosedur Mutu Hasil Pengabdian kepada Masyarakat','document' => 'PROSEDURMUTUHASILPENGABDIANKEPADAMASYARAKAT_20151211143047.PDF','created_at' => '2015-11-26 11:53:14','updated_at' => '2015-12-11 15:24:50','deleted_at' => NULL],
  ['id' => '27','standard_document_id' => '23','no' => 'SPM-02/PM-01','date' => '2015-11-10','description' => 'Prosedur Mutu Standar Isi Pengabdian kepada Masyarakat','document' => 'PROSEDURMUTUSTANDARISIPENGABDIANKEPADAMASYARAKAT_20151211143057.PDF','created_at' => '2015-11-26 11:53:57','updated_at' => '2015-12-11 15:25:00','deleted_at' => NULL],
  ['id' => '28','standard_document_id' => '24','no' => 'SPM-03/PM-01','date' => '2015-11-10','description' => 'Prosedur Mutu Proses Pengabdian kepada Masyarakat','document' => 'PROSEDURMUTUPROSESPENGABDIANKEPADAMASYARAKAT_20151126110219.PDF','created_at' => '2015-11-26 11:56:45','updated_at' => '2015-11-26 11:59:29','deleted_at' => '2015-11-26 11:59:29'],
  ['id' => '29','standard_document_id' => '24','no' => 'SPM-03/PM-01','date' => '2015-11-10','description' => 'Prosedur Mutu Proses Pengabdian kepada Masyarakat','document' => 'PROSEDURMUTUPROSESPENGABDIANKEPADAMASYARAKAT_20151211143104.PDF','created_at' => '2015-11-26 11:56:48','updated_at' => '2015-12-11 15:25:07','deleted_at' => NULL],
  ['id' => '30','standard_document_id' => '24','no' => 'SPM-03/PM-01','date' => '2015-11-10','description' => 'Prosedur Mutu Proses Pengabdian kepada Masyarakat','document' => 'PROSEDURMUTUPROSESPENGABDIANKEPADAMASYARAKAT_20151126110229.PDF','created_at' => '2015-11-26 11:56:49','updated_at' => '2015-11-26 11:59:21','deleted_at' => '2015-11-26 11:59:21'],
  ['id' => '31','standard_document_id' => '25','no' => 'SPM-04/PM-01','date' => '2015-11-10','description' => 'Prosedur Mutu Penilaian Pengabdian kepada Masyarakat','document' => 'PROSEDURMUTUPENILAIANPENGABDIANKEPADAMASYARAKAT_20151211143116.PDF','created_at' => '2015-11-26 11:58:38','updated_at' => '2015-12-11 15:25:19','deleted_at' => NULL],
  ['id' => '32','standard_document_id' => '25','no' => 'SPM-04/PM-01','date' => '2015-11-10','description' => 'Prosedur Mutu Penilaian Pengabdian kepada Masyarakat','document' => 'Invalid parameters.','created_at' => '2015-11-26 11:59:05','updated_at' => '2015-11-26 11:59:25','deleted_at' => '2015-11-26 11:59:25'],
  ['id' => '33','standard_document_id' => '26','no' => 'SPM-05/PM-01','date' => '2015-11-10','description' => 'Prosedur Mutu Pelaksana Pengabdian kepada Masyarakat','document' => 'PROSEDURMUTUPELAKSANAPENGABDIANKEPADAMASYARAKAT_20151211143126.PDF','created_at' => '2015-11-26 12:00:11','updated_at' => '2015-12-11 15:25:29','deleted_at' => NULL],
  ['id' => '34','standard_document_id' => '27','no' => 'SPM-06/PM-01','date' => '2015-11-10','description' => 'Prosedur Mutu Sarana dan Prasarana Pengabdian kepada Masyarakat','document' => 'PROSEDURMUTUSARANADANPRASARANAPENGABDIANKEPADAMASYARAKAT_20151211143138.PDF','created_at' => '2015-11-26 12:02:23','updated_at' => '2015-12-11 15:25:41','deleted_at' => NULL],
  ['id' => '35','standard_document_id' => '27','no' => 'SPM-06/PM-01','date' => '2015-11-10','description' => 'Prosedur Mutu Sarana dan Prasarana Pengabdian kepada Masyarakat','document' => 'Unknown errors.','created_at' => '2015-11-26 12:02:40','updated_at' => '2015-11-26 12:03:23','deleted_at' => '2015-11-26 12:03:23'],
  ['id' => '36','standard_document_id' => '27','no' => 'SPM-06/PM-01','date' => '2015-11-10','description' => 'Prosedur Mutu Sarana dan Prasarana Pengabdian kepada Masyarakat','document' => 'Unknown errors.','created_at' => '2015-11-26 12:02:45','updated_at' => '2015-11-26 12:03:13','deleted_at' => '2015-11-26 12:03:13'],
  ['id' => '37','standard_document_id' => '28','no' => 'SPM-07/PM-01','date' => '2015-11-10','description' => 'Prosedur Mutu Pengelolaan Pengabdian kepada Masyarakat','document' => 'PROSEDURMUTUPENGELOLAANPENGABDIANKEPADAMASYARAKAT_20151211143147.PDF','created_at' => '2015-11-26 12:05:33','updated_at' => '2015-12-11 15:25:49','deleted_at' => NULL],
  ['id' => '38','standard_document_id' => '29','no' => 'SPM-08/PM-01','date' => '2015-11-10','description' => 'Prosedur Mutu Pembiayaan Pengabdian kepada Masyarakat','document' => 'PROSEDURMUTUPEMBIAYAANPENGABDIANKEPADAMASYARAKAT_20151211143155.PDF','created_at' => '2015-11-26 12:07:54','updated_at' => '2015-12-11 15:25:58','deleted_at' => NULL]
];

// `spmi`.`instructions`
$instructions = [
  ['id' => '1','guide_id' => '1','no' => 'SPT-01/PM-01/SOP-01','date' => '2015-12-11','description' => 'SOP Penetapan Standar Kompetensi Lulusan','document' => 'SOPPENETAPANSTANDARKOMPETENSILULUSAN_20151211143550.PDF','created_at' => '2015-11-17 00:09:52','updated_at' => '2015-12-11 15:29:53','deleted_at' => NULL],
  ['id' => '2','guide_id' => '1','no' => 'SPT-01/PM-01/SOP-02','date' => '2015-12-11','description' => 'SOP Monitor dan Evaluasi Standar Kompetensi Kelulusan','document' => 'SOPMONITORDANEVALUASISTANDARKOMPETENSIKELULUSAN_20151211143555.PDF','created_at' => '2015-11-17 00:09:52','updated_at' => '2015-12-11 15:29:57','deleted_at' => NULL],
  ['id' => '3','guide_id' => '1','no' => 'SPT-01/PM-01/SOP-03','date' => '2015-12-11','description' => 'SOP Pengendalian Standar Kompetensi Lulusan','document' => 'SOPPENGENDALIANSTANDARKOMPETENSILULUSAN_20151211143602.PDF','created_at' => '2015-11-26 14:02:54','updated_at' => '2015-12-11 15:30:05','deleted_at' => NULL],
  ['id' => '4','guide_id' => '1','no' => 'SPT-01/PM-01/SOP-04','date' => '2015-12-11','description' => 'SOP Peningkatan Standar Kompetensi Lulusan','document' => 'SOPPENINGKATANSTANDARKOMPETENSILULUSAN_20151211143608.PDF','created_at' => '2015-11-26 14:05:35','updated_at' => '2015-12-11 15:30:10','deleted_at' => NULL],
  ['id' => '5','guide_id' => '1','no' => 'SPT-01/PM-01/SOP-04','date' => '2015-10-06','description' => 'SOP Peningkatan Standar Kompetensi Lulusan','document' => 'SOPPENINGKATANSTANDARKOMPETENSILULUSAN_20151126131232.PDF','created_at' => '2015-11-26 14:06:51','updated_at' => '2015-11-26 14:07:16','deleted_at' => '2015-11-26 14:07:16'],
  ['id' => '6','guide_id' => '1','no' => 'SPT-01/PM-01/SOP-04','date' => '2015-10-06','description' => 'SOP Peningkatan Standar Kompetensi Lulusan','document' => 'SOPPENINGKATANSTANDARKOMPETENSILULUSAN_20151126131339.PDF','created_at' => '2015-11-26 14:07:58','updated_at' => '2015-11-26 14:08:05','deleted_at' => '2015-11-26 14:08:05'],
  ['id' => '7','guide_id' => '1','no' => 'SPT-01/PM-01/SOP-05','date' => '2015-12-11','description' => 'SOP Penetapan Profil Lulusan','document' => 'SOPPENETAPANPROFILLULUSAN_20151211143622.PDF','created_at' => '2015-11-26 14:09:12','updated_at' => '2015-12-11 15:30:25','deleted_at' => NULL],
  ['id' => '8','guide_id' => '2','no' => 'SPT-02/PM-01/SOP-01','date' => '2015-12-11','description' => 'SOP Penetapan Standar Isi Pembelajaran','document' => 'SOPPENETAPANSTANDARISIPEMBELAJARAN_20151211143922.PDF','created_at' => '2015-11-26 14:11:46','updated_at' => '2015-12-11 15:33:25','deleted_at' => NULL],
  ['id' => '9','guide_id' => '2','no' => 'SPT-02/PM-01/SOP-01','date' => '2015-09-21','description' => 'SOP Penetapan Standar Isi Pembelajaran','document' => 'SOPPENETAPANSTANDARISIPEMBELAJARAN_20151126131727.PDF','created_at' => '2015-11-26 14:11:46','updated_at' => '2015-11-26 14:12:10','deleted_at' => '2015-11-26 14:12:10'],
  ['id' => '10','guide_id' => '2','no' => 'SPT-02/PM-01/SOP-02','date' => '2015-12-11','description' => 'SOP Monitor dan Evaluasi Pemutakhiran Kurikulum Standar Isi Pembelajaran','document' => 'SOPMONITORDANEVALUASIPEMUTAKHIRANKURIKULUMSTANDARISIPEMBELAJARAN_20151211143930.PDF','created_at' => '2015-11-26 14:13:37','updated_at' => '2015-12-11 15:33:33','deleted_at' => NULL],
  ['id' => '11','guide_id' => '2','no' => 'SPT-02/PM-01/SOP-03','date' => '2015-12-11','description' => 'SOP Pengendalian Isi Kurikulum Standar Isi Pembelajaran','document' => 'SOPPENGENDALIANISIKURIKULUMSTANDARISIPEMBELAJARAN_20151211143940.PDF','created_at' => '2015-11-26 14:17:43','updated_at' => '2015-12-11 15:33:43','deleted_at' => NULL],
  ['id' => '12','guide_id' => '2','no' => 'SPT-02/PM-01/SOP-04','date' => '2015-12-11','description' => 'SOP Peningkatan Standar Isi Pembelajaran','document' => 'SOPPENINGKATANSTANDARISIPEMBELAJARAN_20151211143951.PDF','created_at' => '2015-11-26 14:18:44','updated_at' => '2015-12-11 15:33:54','deleted_at' => NULL],
  ['id' => '13','guide_id' => '2','no' => 'SPT-02/PM-01/SOP-05','date' => '2015-12-11','description' => 'SOP Perumusan Kurikulum Pembelajaran','document' => 'SOPPERUMUSANKURIKULUMPEMBELAJARAN_20151211143955.PDF','created_at' => '2015-11-26 14:19:51','updated_at' => '2015-12-11 15:33:58','deleted_at' => NULL],
  ['id' => '14','guide_id' => '2','no' => 'SPT-02/PM-01/SOP-06','date' => '2015-12-11','description' => 'SOP Penyusunan Rencana Program Kegiatan Pembelajaran Semester (RPKPS)','document' => 'SOPPENYUSUNANRENCANAPROGRAMKEGIATANPEMBELAJARANSEMESTER(RPKPS)_20151211144007.PDF','created_at' => '2015-11-26 14:27:05','updated_at' => '2015-12-11 15:34:11','deleted_at' => NULL],
  ['id' => '15','guide_id' => '2','no' => 'SPT-02/PM-01/SOP-06','date' => '2015-10-05','description' => 'SOP Penyusunan Rencana Program Kegiatan Pembelajaran Semester (RPKPS)','document' => 'SOPPENYUSUNANRENCANAPROGRAMKEGIATANPEMBELAJARANSEMESTER(RPKPS)_20151126133319.PDF','created_at' => '2015-11-26 14:27:38','updated_at' => '2015-11-26 14:34:50','deleted_at' => '2015-11-26 14:34:50'],
  ['id' => '16','guide_id' => '3','no' => 'SPT-03/PM-01/SOP-01','date' => '2015-12-11','description' => 'SOP Penetapan Standar Proses Pembelajaran','document' => 'SOPPENETAPANSTANDARPROSESPEMBELAJARAN_20151211144256.PDF','created_at' => '2015-11-26 14:36:43','updated_at' => '2015-12-11 15:36:59','deleted_at' => NULL],
  ['id' => '17','guide_id' => '3','no' => 'SPT-03/PM-01/SOP-02','date' => '2015-12-11','description' => 'SOP Monitor dan Evaluasi Standar Proses Pembelajaran','document' => 'SOPMONITORDANEVALUASISTANDARPROSESPEMBELAJARAN_20151211144305.PDF','created_at' => '2015-11-26 14:39:29','updated_at' => '2015-12-11 15:37:09','deleted_at' => NULL],
  ['id' => '18','guide_id' => '3','no' => 'SPT-03/PM-01/SOP-03','date' => '2015-12-11','description' => 'SOP Pengendalian Standar Proses Pembelajaran','document' => 'SOPPENGENDALIANSTANDARPROSESPEMBELAJARAN_20151211144309.PDF','created_at' => '2015-11-26 14:51:38','updated_at' => '2015-12-11 15:37:12','deleted_at' => NULL],
  ['id' => '19','guide_id' => '3','no' => 'SPT-03/PM-01/SOP-04','date' => '2015-12-11','description' => 'SOP Peningkatan Standar Proses Pembelajaran','document' => 'SOPPENINGKATANSTANDARPROSESPEMBELAJARAN_20151211144317.PDF','created_at' => '2015-11-26 14:54:04','updated_at' => '2015-12-11 15:37:21','deleted_at' => NULL],
  ['id' => '20','guide_id' => '4','no' => 'SPT-04/PM-01/SOP-01','date' => '2015-12-11','description' => 'SOP Penetapan Standar Penilaian Pembelajaran','document' => 'SOPPENETAPANSTANDARPENILAIANPEMBELAJARAN_20151211144455.PDF','created_at' => '2015-11-26 14:55:17','updated_at' => '2015-12-11 15:38:58','deleted_at' => NULL],
  ['id' => '21','guide_id' => '4','no' => 'SPT-04/PM-01/SOP-02','date' => '2015-12-11','description' => 'SOP Monitor dan Evaluasi Standar Penilaian Pembelajaran','document' => 'SOPMONITORDANEVALUASISTANDARPENILAIANPEMBELAJARAN_20151211144459.PDF','created_at' => '2015-11-26 14:56:32','updated_at' => '2015-12-11 15:39:03','deleted_at' => NULL],
  ['id' => '22','guide_id' => '4','no' => 'SPT-04/PM-01/SOP-03','date' => '2015-12-11','description' => 'SOP Pengendalian Standar Penilaian Pembelajaran','document' => 'SOPPENGENDALIANSTANDARPENILAIANPEMBELAJARAN_20151211144510.PDF','created_at' => '2015-11-26 14:58:42','updated_at' => '2015-12-11 15:39:13','deleted_at' => NULL],
  ['id' => '23','guide_id' => '4','no' => 'SPT-04/PM-01/SOP-04','date' => '2015-12-11','description' => 'SOP Peningkatan Standar Penilaian Pembelajaran','document' => 'SOPPENINGKATANSTANDARPENILAIANPEMBELAJARAN_20151211144508.PDF','created_at' => '2015-11-26 14:59:57','updated_at' => '2015-12-11 15:39:11','deleted_at' => NULL],
  ['id' => '24','guide_id' => '5','no' => 'SPT-05/PM-01/SOP-01','date' => '2015-12-11','description' => 'SOP Penetapan Standar Dosen dan Tenaga Kependidikan','document' => 'SOPPENETAPANSTANDARDOSENDANTENAGAKEPENDIDIKAN_20151211144609.PDF','created_at' => '2015-11-26 15:01:58','updated_at' => '2015-12-11 15:40:12','deleted_at' => NULL],
  ['id' => '25','guide_id' => '5','no' => 'SPT-05/PM-01/SOP-02','date' => '2015-12-11','description' => 'SOP Monitor dan Evaluasi Standar Dosen dan Tenaga Kependidikan','document' => 'SOPMONITORDANEVALUASISTANDARDOSENDANTENAGAKEPENDIDIKAN_20151211144621.PDF','created_at' => '2015-11-26 15:05:06','updated_at' => '2015-12-11 15:40:24','deleted_at' => NULL],
  ['id' => '26','guide_id' => '5','no' => 'SPT-05/PM-01/SOP-03','date' => '2015-12-11','description' => 'SOP Pengendalian Standar Dosen dan Tenaga Kependidikan','document' => 'SOPPENGENDALIANSTANDARDOSENDANTENAGAKEPENDIDIKAN_20151211144618.PDF','created_at' => '2015-11-26 15:06:01','updated_at' => '2015-12-11 15:40:23','deleted_at' => NULL],
  ['id' => '27','guide_id' => '5','no' => 'SPT-05/PM-01/SOP-04','date' => '2015-12-11','description' => 'SOP Peningkatan Standar Dosen dan Tenaga Kependidikan','document' => 'SOPPENINGKATANSTANDARDOSENDANTENAGAKEPENDIDIKAN_20151211144624.PDF','created_at' => '2015-11-26 15:06:54','updated_at' => '2015-12-11 15:40:26','deleted_at' => NULL],
  ['id' => '28','guide_id' => '6','no' => 'SPT-06/PM-01/SOP-01','date' => '2015-12-11','description' => 'SOP Penetapan Standar Gedung, Ruang Kerja Dosen, Kantor, dan Ruang Kelas','document' => 'SOPPENETAPANSTANDARGEDUNG,RUANGKERJADOSEN,KANTOR,DANRUANGKELAS_20151211144756.PDF','created_at' => '2015-11-26 15:08:27','updated_at' => '2015-12-11 15:41:59','deleted_at' => NULL],
  ['id' => '29','guide_id' => '6','no' => 'SPT-06/PM-01/SOP-02','date' => '2015-12-11','description' => 'SOP Monitor dan Evaluasi Standar Gedung, Ruang Kerja Dosen, Kantor, dan Ruang Kelas','document' => 'SOPMONITORDANEVALUASISTANDARGEDUNG,RUANGKERJADOSEN,KANTOR,DANRUANGKELAS_20151211144756.PDF','created_at' => '2015-11-26 15:09:37','updated_at' => '2015-12-11 15:41:59','deleted_at' => NULL],
  ['id' => '30','guide_id' => '6','no' => 'SPT-06/PM-01/SOP-03','date' => '2015-12-11','description' => 'SOP Pengendalian Standar Gedung, Ruang Kerja Dosen, Kantor, dan Ruang Kelas','document' => 'SOPPENGENDALIANSTANDARGEDUNG,RUANGKERJADOSEN,KANTOR,DANRUANGKELAS_20151211144806.PDF','created_at' => '2015-11-26 15:10:45','updated_at' => '2015-12-11 15:42:08','deleted_at' => NULL],
  ['id' => '31','guide_id' => '6','no' => 'SPT-06/PM-01/SOP-04','date' => '2015-12-11','description' => 'SOP Peningkatan Standar Gedung, Ruang Kerja Dosen, Kantor, dan Ruang Kelas','document' => 'SOPPENINGKATANSTANDARGEDUNG,RUANGKERJADOSEN,KANTOR,DANRUANGKELAS_20151211144812.PDF','created_at' => '2015-11-26 15:11:52','updated_at' => '2015-12-11 15:42:15','deleted_at' => NULL],
  ['id' => '32','guide_id' => '7','no' => 'SPT-06/PM-02/SOP-01','date' => '2015-12-11','description' => 'SOP Penetapan Standar Perpustakaan','document' => 'SOPPENETAPANSTANDARPERPUSTAKAAN_20151211144920.PDF','created_at' => '2015-11-26 15:13:19','updated_at' => '2015-12-11 15:43:25','deleted_at' => NULL],
  ['id' => '33','guide_id' => '7','no' => 'SPT-06/PM-02/SOP-02','date' => '2015-12-11','description' => 'SOP Monitor dan Evaluasi Standar Perpustakaan','document' => 'SOPMONITORDANEVALUASISTANDARPERPUSTAKAAN_20151211144918.PDF','created_at' => '2015-11-26 15:14:13','updated_at' => '2015-12-11 15:43:22','deleted_at' => NULL],
  ['id' => '34','guide_id' => '7','no' => 'SPT-06/PM-02/SOP-03','date' => '2015-12-11','description' => 'SOP Pengendalian Standar Perpustakaan','document' => 'SOPPENGENDALIANSTANDARPERPUSTAKAAN_20151211144923.PDF','created_at' => '2015-11-26 15:15:05','updated_at' => '2015-12-11 15:43:27','deleted_at' => NULL],
  ['id' => '35','guide_id' => '7','no' => 'SPT-06/PM-02/SOP-04','date' => '2015-12-11','description' => 'SOP Peningkatan Standar Perpustakaan','document' => 'SOPPENINGKATANSTANDARPERPUSTAKAAN_20151211144934.PDF','created_at' => '2015-11-26 15:16:02','updated_at' => '2015-12-11 15:43:38','deleted_at' => NULL],
  ['id' => '36','guide_id' => '8','no' => 'SPT-06/PM-03/SOP-01','date' => '2015-12-11','description' => 'SOP Penetapan Standar Sarana dan Prasarana Pendukung Proses Pembelajaran','document' => 'SOPPENETAPANSTANDARSARANADANPRASARANAPENDUKUNGPROSESPEMBELAJARAN_20151211145020.PDF','created_at' => '2015-11-26 15:17:13','updated_at' => '2015-12-11 15:44:25','deleted_at' => NULL],
  ['id' => '37','guide_id' => '8','no' => 'SPT-06/PM-03/SOP-02','date' => '2015-12-11','description' => 'SOP Monitor dan Evaluasi Standar Sarana dan Prasarana Pendukung Proses Pembelajaran','document' => 'SOPMONITORDANEVALUASISTANDARSARANADANPRASARANAPENDUKUNGPROSESPEMBELAJARAN_20151211145025.PDF','created_at' => '2015-11-26 15:18:11','updated_at' => '2015-12-11 15:44:29','deleted_at' => NULL],
  ['id' => '38','guide_id' => '8','no' => 'SPT-06/PM-03/SOP-03','date' => '2015-12-11','description' => 'SOP Pengendalian Standar Sarana dan Prasarana Pendukung Proses Pembelajaran','document' => 'SOPPENGENDALIANSTANDARSARANADANPRASARANAPENDUKUNGPROSESPEMBELAJARAN_20151211145031.PDF','created_at' => '2015-11-26 15:19:12','updated_at' => '2015-12-11 15:44:34','deleted_at' => NULL],
  ['id' => '39','guide_id' => '8','no' => 'SPT-06/PM-03/SOP-04','date' => '2015-12-11','description' => 'SOP Peningkatan Standar Sarana dan Prasarana Pendukung Proses Pembelajaran','document' => 'SOPPENINGKATANSTANDARSARANADANPRASARANAPENDUKUNGPROSESPEMBELAJARAN_20151211145036.PDF','created_at' => '2015-11-26 15:20:14','updated_at' => '2015-12-11 15:44:39','deleted_at' => NULL],
  ['id' => '40','guide_id' => '9','no' => 'SPT-06/PM-04/SOP-01','date' => '2015-12-11','description' => 'SOP Penetapan Standar Sarana Prasarana Lain-Lain','document' => 'SOPPENETAPANSTANDARSARANAPRASARANALAIN-LAIN_20151211145153.PDF','created_at' => '2015-11-26 15:21:22','updated_at' => '2015-12-11 15:45:56','deleted_at' => NULL],
  ['id' => '41','guide_id' => '9','no' => 'SPT-06/PM-04/SOP-02','date' => '2015-12-11','description' => 'SOP Monitor dan Evaluasi Standar Sarana Prasarana Lain-Lain','document' => 'SOPMONITORDANEVALUASISTANDARSARANAPRASARANALAIN-LAIN_20151211145155.PDF','created_at' => '2015-11-26 15:22:33','updated_at' => '2015-12-11 15:45:59','deleted_at' => NULL],
  ['id' => '42','guide_id' => '9','no' => 'SPT-06/PM-04/SOP-03','date' => '2015-12-11','description' => 'SOP Pengendalian Standar Sarana Prasarana Lain-Lain','document' => 'SOPPENGENDALIANSTANDARSARANAPRASARANALAIN-LAIN_20151211145200.PDF','created_at' => '2015-11-26 15:23:31','updated_at' => '2015-12-11 15:46:03','deleted_at' => NULL],
  ['id' => '43','guide_id' => '9','no' => 'SPT-06/PM-04/SOP-04','date' => '2015-12-11','description' => 'SOP Peningkatan Standar Sarana Prasarana Lain-Lain','document' => 'SOPPENINGKATANSTANDARSARANAPRASARANALAIN-LAIN_20151211145204.PDF','created_at' => '2015-11-26 15:24:35','updated_at' => '2015-12-11 15:46:06','deleted_at' => NULL],
  ['id' => '44','guide_id' => '10','no' => 'SPT-07/PM-01/SOP-01','date' => '2015-12-11','description' => 'SOP Penetapan Standar Pengelolaan Pembelajaran','document' => 'SOPPENETAPANSTANDARPENGELOLAANPEMBELAJARAN_20151211145322.PDF','created_at' => '2015-11-26 15:25:39','updated_at' => '2015-12-11 15:47:28','deleted_at' => NULL],
  ['id' => '45','guide_id' => '10','no' => 'SPT-07/PM-01/SOP-02','date' => '2015-12-11','description' => 'SOP Monitor dan Evaluasi Standar Pengelolaan Pembelajaran','document' => 'SOPMONITORDANEVALUASISTANDARPENGELOLAANPEMBELAJARAN_20151211145323.PDF','created_at' => '2015-11-26 15:26:32','updated_at' => '2015-12-11 15:47:27','deleted_at' => NULL],
  ['id' => '46','guide_id' => '10','no' => 'SPT-07/PM-01/SOP-03','date' => '2015-12-11','description' => 'SOP Pengendalian Standar Pengelolaan Pembelajaran','document' => 'SOPPENGENDALIANSTANDARPENGELOLAANPEMBELAJARAN_20151211145333.PDF','created_at' => '2015-11-26 15:27:20','updated_at' => '2015-12-11 15:47:36','deleted_at' => NULL],
  ['id' => '47','guide_id' => '10','no' => 'SPT-07/PM-01/SOP-04','date' => '2015-12-11','description' => 'SOP Peningkatan Standar Pengelolaan Pembelajaran','document' => 'SOPPENINGKATANSTANDARPENGELOLAANPEMBELAJARAN_20151211145334.PDF','created_at' => '2015-11-26 15:28:08','updated_at' => '2015-12-11 15:47:37','deleted_at' => NULL],
  ['id' => '48','guide_id' => '11','no' => 'SPT-08/PM-01/SOP-01','date' => '2015-12-11','description' => 'SOP Penetapan Standar Pembiayaan Pembelajaran','document' => 'SOPPENETAPANSTANDARPEMBIAYAANPEMBELAJARAN_20151211145442.PDF','created_at' => '2015-11-26 15:29:22','updated_at' => '2015-12-11 15:48:45','deleted_at' => NULL],
  ['id' => '49','guide_id' => '11','no' => 'SPT-08/PM-01/SOP-02','date' => '2015-12-11','description' => 'SOP Monitor dan Evaluasi Standar Pembiayaan Pembelajaran','document' => 'SOPMONITORDANEVALUASISTANDARPEMBIAYAANPEMBELAJARAN_20151211145457.PDF','created_at' => '2015-11-26 15:30:41','updated_at' => '2015-12-11 15:49:00','deleted_at' => NULL],
  ['id' => '50','guide_id' => '11','no' => 'SPT-08/PM-01/SOP-03','date' => '2015-12-11','description' => 'SOP Pengendalian Standar Pembiayaan Pembelajaran','document' => 'SOPPENGENDALIANSTANDARPEMBIAYAANPEMBELAJARAN_20151211145454.PDF','created_at' => '2015-11-26 15:31:41','updated_at' => '2015-12-11 15:48:57','deleted_at' => NULL],
  ['id' => '51','guide_id' => '11','no' => 'SPT-08/PM-01/SOP-04','date' => '2015-12-11','description' => 'SOP Peningkatan Standar Pembiayaan Pembelajaran','document' => 'SOPPENINGKATANSTANDARPEMBIAYAANPEMBELAJARAN_20151211145510.PDF','created_at' => '2015-11-26 15:32:31','updated_at' => '2015-12-11 15:49:13','deleted_at' => NULL],
  ['id' => '52','guide_id' => '12','no' => 'SPT-09/PM-01/SOP-01','date' => '2015-12-11','description' => 'SOP Penetapan Standar Kemahasiswaan (Student Service)','document' => 'SOPPENETAPANSTANDARKEMAHASISWAAN(STUDENTSERVICE)_20151211145613.PDF','created_at' => '2015-11-26 15:33:48','updated_at' => '2015-12-11 15:50:16','deleted_at' => NULL],
  ['id' => '53','guide_id' => '12','no' => 'SPT-09/PM-01/SOP-02','date' => '2015-12-11','description' => 'SOP Monitor dan Evaluasi Standar Kemahasiswaan (Student Service)','document' => 'SOPMONITORDANEVALUASISTANDARKEMAHASISWAAN(STUDENTSERVICE)_20151211145613.PDF','created_at' => '2015-11-26 15:35:03','updated_at' => '2015-12-11 15:50:16','deleted_at' => NULL],
  ['id' => '54','guide_id' => '12','no' => 'SPT-09/PM-01/SOP-03','date' => '2015-12-11','description' => 'SOP Pengendalian Standar Kemahasiswaan (Student Service)','document' => 'SOPPENGENDALIANSTANDARKEMAHASISWAAN(STUDENTSERVICE)_20151211145626.PDF','created_at' => '2015-11-26 15:36:03','updated_at' => '2015-12-11 15:50:29','deleted_at' => NULL],
  ['id' => '55','guide_id' => '12','no' => 'SPT-09/PM-01/SOP-04','date' => '2015-12-11','description' => 'SOP Peningkatan Standar Kemahasiswaan (Student Service)','document' => 'SOPPENINGKATANSTANDARKEMAHASISWAAN(STUDENTSERVICE)_20151211145631.PDF','created_at' => '2015-11-26 15:36:54','updated_at' => '2015-12-11 15:50:34','deleted_at' => NULL],
  ['id' => '56','guide_id' => '13','no' => 'SPT-09/PM-02/SOP-01','date' => '2015-12-11','description' => 'SOP Penetapan Standar Kemahasiswaan (Student development)','document' => 'SOPPENETAPANSTANDARKEMAHASISWAAN(STUDENTDEVELOPMENT)_20151211145720.PDF','created_at' => '2015-11-26 15:37:49','updated_at' => '2015-12-11 15:51:25','deleted_at' => NULL],
  ['id' => '57','guide_id' => '13','no' => 'SPT-09/PM-02/SOP-02','date' => '2015-12-11','description' => 'SOP Monitor dan Evaluasi Standar Kemahasiswaan (Student Development)','document' => 'SOPMONITORDANEVALUASISTANDARKEMAHASISWAAN(STUDENTDEVELOPMENT)_20151211145728.PDF','created_at' => '2015-11-26 15:38:50','updated_at' => '2015-12-11 15:51:32','deleted_at' => NULL],
  ['id' => '58','guide_id' => '13','no' => 'SPT-09/PM-02/SOP-03','date' => '2015-12-11','description' => 'SOP Pengendalian Standar Kemahasiswaan (Student Development)','document' => 'SOPPENGENDALIANSTANDARKEMAHASISWAAN(STUDENTDEVELOPMENT)_20151211145735.PDF','created_at' => '2015-11-26 15:39:53','updated_at' => '2015-12-11 15:51:40','deleted_at' => NULL],
  ['id' => '59','guide_id' => '13','no' => 'SPT-09/PM-02/SOP-04','date' => '2015-12-11','description' => 'SOP Peningkatan Standar Kemahasiswaan (Student Development)','document' => 'SOPPENINGKATANSTANDARKEMAHASISWAAN(STUDENTDEVELOPMENT)_20151211145754.PDF','created_at' => '2015-11-26 15:41:00','updated_at' => '2015-12-11 15:51:57','deleted_at' => NULL],
  ['id' => '60','guide_id' => '14','no' => 'SPT-09/PM-03/SOP-01','date' => '2015-12-11','description' => 'SOP Penetapan Standar Kemahasiswaan (Career and Development Center)','document' => 'SOPPENETAPANSTANDARKEMAHASISWAAN(CAREERANDDEVELOPMENTCENTER)_20151211145848.PDF','created_at' => '2015-11-26 15:42:17','updated_at' => '2015-12-11 15:52:52','deleted_at' => NULL],
  ['id' => '61','guide_id' => '14','no' => 'SPT-09/PM-03/SOP-02','date' => '2015-12-11','description' => 'SOP Monitor dan Evaluasi Standar Kemahasiswaan (Career and Development Center)','document' => 'SOPMONITORDANEVALUASISTANDARKEMAHASISWAAN(CAREERANDDEVELOPMENTCENTER)_20151211145900.PDF','created_at' => '2015-11-26 15:43:51','updated_at' => '2015-12-11 15:53:03','deleted_at' => NULL],
  ['id' => '62','guide_id' => '14','no' => 'SPT-09/PM-03/SOP-03','date' => '2015-12-11','description' => 'SOP Pengendalian Standar Kemahasiswaan (Career and Development Center)','document' => 'SOPPENGENDALIANSTANDARKEMAHASISWAAN(CAREERANDDEVELOPMENTCENTER)_20151211145904.PDF','created_at' => '2015-11-26 15:44:54','updated_at' => '2015-12-11 15:53:07','deleted_at' => NULL],
  ['id' => '63','guide_id' => '14','no' => 'SPT-09/PM-03/SOP-04','date' => '2015-12-11','description' => 'SOP Peningkatan Standar Kemahasiswaan (Career and Development Center)','document' => 'SOPPENINGKATANSTANDARKEMAHASISWAAN(CAREERANDDEVELOPMENTCENTER)_20151211145911.PDF','created_at' => '2015-11-26 15:46:04','updated_at' => '2015-12-11 15:53:14','deleted_at' => NULL],
  ['id' => '64','guide_id' => '15','no' => 'SPT-10/PM-01/SOP-01','date' => '2015-12-11','description' => 'SOP Penetapan Standar Kerjasama','document' => 'SOPPENETAPANSTANDARKERJASAMA_20151211150022.PDF','created_at' => '2015-11-26 15:48:31','updated_at' => '2015-12-11 15:54:25','deleted_at' => NULL],
  ['id' => '65','guide_id' => '15','no' => 'SPT-10/PM-01/SOP-02','date' => '2015-12-11','description' => 'SOP Monitor dan Evaluasi Standar Kerjasama','document' => 'SOPMONITORDANEVALUASISTANDARKERJASAMA_20151211150017.PDF','created_at' => '2015-11-26 15:50:56','updated_at' => '2015-12-11 15:54:20','deleted_at' => NULL],
  ['id' => '66','guide_id' => '15','no' => 'SPT-10/PM-01/SOP-03','date' => '2015-12-11','description' => 'SOP Pengendalian Standar Kerjasama','document' => 'SOPPENGENDALIANSTANDARKERJASAMA_20151211150023.PDF','created_at' => '2015-11-26 15:51:40','updated_at' => '2015-12-11 15:54:27','deleted_at' => NULL],
  ['id' => '67','guide_id' => '15','no' => 'SPT-10/PM-01/SOP-04','date' => '2015-12-11','description' => 'SOP Peningkatan Standar Kerjasama','document' => 'SOPPENINGKATANSTANDARKERJASAMA_20151211150028.PDF','created_at' => '2015-11-26 15:52:21','updated_at' => '2015-12-11 15:54:31','deleted_at' => NULL],
  ['id' => '68','guide_id' => '16','no' => 'SPT-11/PM-01/SOP-01','date' => '2015-12-11','description' => 'SOP Penetapan Standar Sistem Informasi','document' => 'SOPPENETAPANSTANDARSISTEMINFORMASI_20151211150120.PDF','created_at' => '2015-11-26 15:53:28','updated_at' => '2015-12-11 15:55:24','deleted_at' => NULL],
  ['id' => '69','guide_id' => '16','no' => 'SPT-11/PM-01/SOP-02','date' => '2015-12-11','description' => 'SOP Monitor dan Evaluasi Standar Sistem Informasi','document' => 'SOPMONITORDANEVALUASISTANDARSISTEMINFORMASI_20151211150122.PDF','created_at' => '2015-11-26 15:54:22','updated_at' => '2015-12-11 15:55:25','deleted_at' => NULL],
  ['id' => '70','guide_id' => '16','no' => 'SPT-11/PM-01/SOP-03','date' => '2015-12-11','description' => 'SOP Pengendalian Standar Sistem Informasi','document' => 'SOPPENGENDALIANSTANDARSISTEMINFORMASI_20151211150126.PDF','created_at' => '2015-11-26 15:55:02','updated_at' => '2015-12-11 15:55:30','deleted_at' => NULL],
  ['id' => '71','guide_id' => '16','no' => 'SPT-11/PM-01/SOP-04','date' => '2015-12-11','description' => 'SOP Peningkatan Standar Sistem Informasi','document' => 'SOPPENINGKATANSTANDARSISTEMINFORMASI_20151211150134.PDF','created_at' => '2015-11-26 15:55:48','updated_at' => '2015-12-11 15:55:37','deleted_at' => NULL],
  ['id' => '72','guide_id' => '17','no' => 'SPT-12/PM-01/SOP-01','date' => '2015-12-11','description' => 'SOP Penetapan Standar Suasana Akademik','document' => 'SOPPENETAPANSTANDARSUASANAAKADEMIK_20151211150228.PDF','created_at' => '2015-11-26 15:56:33','updated_at' => '2015-12-11 15:56:32','deleted_at' => NULL],
  ['id' => '73','guide_id' => '17','no' => 'SPT-12/PM-01/SOP-02','date' => '2015-12-11','description' => 'SOP Monitor dan Evaluasi Standar Suasana Akademik','document' => 'SOPMONITORDANEVALUASISTANDARSUASANAAKADEMIK_20151211150233.PDF','created_at' => '2015-11-26 15:57:30','updated_at' => '2015-12-11 15:56:36','deleted_at' => NULL],
  ['id' => '74','guide_id' => '17','no' => 'SPT-12/PM-01/SOP-03','date' => '2015-12-11','description' => 'SOP Pengendalian Standar Suasana Akademik','document' => 'SOPPENGENDALIANSTANDARSUASANAAKADEMIK_20151211150227.PDF','created_at' => '2015-11-26 15:58:29','updated_at' => '2015-12-11 15:56:31','deleted_at' => NULL],
  ['id' => '75','guide_id' => '17','no' => 'SPT-12/PM-01/SOP-04','date' => '2015-12-11','description' => 'SOP Peningkatan Standar Suasana Akademik','document' => 'SOPPENINGKATANSTANDARSUASANAAKADEMIK_20151211150232.PDF','created_at' => '2015-11-26 15:59:29','updated_at' => '2015-12-11 15:56:35','deleted_at' => NULL],
  ['id' => '76','guide_id' => '18','no' => 'SPU-01/PM-01/SOP-01','date' => '2015-12-11','description' => 'SOP Penetapan Standar Hasil Penelitian','document' => 'SOPPENETAPANSTANDARHASILPENELITIAN_20151211150455.PDF','created_at' => '2015-11-26 16:00:36','updated_at' => '2015-12-11 15:58:58','deleted_at' => NULL],
  ['id' => '77','guide_id' => '18','no' => 'SPU-01/PM-01/SOP-02','date' => '2015-12-11','description' => 'SOP Monitor dan Evaluasi Standar Hasil Penelitian','document' => 'SOPMONITORDANEVALUASISTANDARHASILPENELITIAN_20151211150446.PDF','created_at' => '2015-11-26 16:01:20','updated_at' => '2015-12-11 15:58:51','deleted_at' => NULL],
  ['id' => '78','guide_id' => '18','no' => 'SPU-01/PM-01/SOP-03','date' => '2015-12-11','description' => 'SOP Pengendalian Standar Hasil Penelitian','document' => 'SOPPENGENDALIANSTANDARHASILPENELITIAN_20151211150458.PDF','created_at' => '2015-11-26 16:02:08','updated_at' => '2015-12-11 15:59:01','deleted_at' => NULL],
  ['id' => '79','guide_id' => '18','no' => 'SPU-01/PM-01/SOP-04','date' => '2015-12-11','description' => 'SOP Peningkatan Standar Hasil Penelitian','document' => 'SOPPENINGKATANSTANDARHASILPENELITIAN_20151211150455.PDF','created_at' => '2015-11-26 16:03:08','updated_at' => '2015-12-11 15:58:58','deleted_at' => NULL],
  ['id' => '80','guide_id' => '19','no' => 'SPU-02/PM-01/SOP-01','date' => '2015-12-11','description' => 'SOP Penetapan Standar Isi Penelitian','document' => 'SOPPENETAPANSTANDARISIPENELITIAN_20151211150540.PDF','created_at' => '2015-11-26 16:04:52','updated_at' => '2015-12-11 15:59:43','deleted_at' => NULL],
  ['id' => '81','guide_id' => '19','no' => 'SPU-02/PM-01/SOP-02','date' => '2015-11-10','description' => 'SOP Monitor dan Evaluasi Standar Isi Penelitian','document' => 'SOPMONITORDANEVALUASISTANDARISIPENELITIAN_20151126151125.PDF','created_at' => '2015-11-26 16:05:44','updated_at' => '2015-11-26 16:08:22','deleted_at' => '2015-11-26 16:08:22'],
  ['id' => '82','guide_id' => '19','no' => 'SPU-02/PM-01/SOP-02','date' => '2015-12-11','description' => 'SOP Monitor dan Evaluasi Standar Isi Penelitian','document' => 'SOPMONITORDANEVALUASISTANDARISIPENELITIAN_20151211150547.PDF','created_at' => '2015-11-26 16:08:12','updated_at' => '2015-12-11 15:59:50','deleted_at' => NULL],
  ['id' => '83','guide_id' => '19','no' => 'SPU-02/PM-01/SOP-03','date' => '2015-12-11','description' => 'SOP Pengendalian Standar Isi Penelitian','document' => 'SOPPENGENDALIANSTANDARISIPENELITIAN_20151211150550.PDF','created_at' => '2015-11-26 16:09:18','updated_at' => '2015-12-11 15:59:53','deleted_at' => NULL],
  ['id' => '84','guide_id' => '19','no' => 'SPU-02/PM-01/SOP-04','date' => '2015-12-11','description' => 'SOP Peningkatan Standar Isi Penelitian','document' => 'SOPPENINGKATANSTANDARISIPENELITIAN_20151211150555.PDF','created_at' => '2015-11-26 16:10:02','updated_at' => '2015-12-11 16:00:00','deleted_at' => NULL],
  ['id' => '85','guide_id' => '20','no' => 'SPU-03/PM-01/SOP-01','date' => '2015-12-11','description' => 'SOP Penetapan Standar Proses Penelitian','document' => 'SOPPENETAPANSTANDARPROSESPENELITIAN_20151211150636.PDF','created_at' => '2015-11-26 16:12:14','updated_at' => '2015-12-11 16:00:39','deleted_at' => NULL],
  ['id' => '86','guide_id' => '20','no' => 'SPU-03/PM-01/SOP-02','date' => '2015-12-11','description' => 'SOP Monitor dan Evaluasi Standar Proses Penelitian','document' => 'SOPMONITORDANEVALUASISTANDARPROSESPENELITIAN_20151211150648.PDF','created_at' => '2015-11-26 16:12:57','updated_at' => '2015-12-11 16:00:51','deleted_at' => NULL],
  ['id' => '87','guide_id' => '20','no' => 'SPU-03/PM-01/SOP-03','date' => '2015-12-11','description' => 'SOP Pengendalian Standar Proses Penelitian','document' => 'SOPPENGENDALIANSTANDARPROSESPENELITIAN_20151211150646.PDF','created_at' => '2015-11-26 16:13:43','updated_at' => '2015-12-11 16:00:50','deleted_at' => NULL],
  ['id' => '88','guide_id' => '20','no' => 'SPU-03/PM-01/SOP-04','date' => '2015-12-11','description' => 'SOP Peningkatan Standar Proses Penelitian','document' => 'SOPPENINGKATANSTANDARPROSESPENELITIAN_20151211150655.PDF','created_at' => '2015-11-26 16:14:32','updated_at' => '2015-12-11 16:00:58','deleted_at' => NULL],
  ['id' => '89','guide_id' => '21','no' => 'SPU-04/PM-01/SOP-01','date' => '2015-12-11','description' => 'SOP Penetapan Standar Penilaian Penelitian','document' => 'SOPPENETAPANSTANDARPENILAIANPENELITIAN_20151211150729.PDF','created_at' => '2015-11-26 16:15:28','updated_at' => '2015-12-11 16:01:33','deleted_at' => NULL],
  ['id' => '90','guide_id' => '21','no' => 'SPU-04/PM-01/SOP-02','date' => '2015-12-11','description' => 'SOP Monitor dan Evaluasi Standar Penilaian Penelitian','document' => 'SOPMONITORDANEVALUASISTANDARPENILAIANPENELITIAN_20151211150745.PDF','created_at' => '2015-11-26 16:16:11','updated_at' => '2015-12-11 16:01:48','deleted_at' => NULL],
  ['id' => '91','guide_id' => '21','no' => 'SPU-04/PM-01/SOP-03','date' => '2015-12-11','description' => 'SOP Pengendalian Standar Penilaian Penelitian','document' => 'SOPPENGENDALIANSTANDARPENILAIANPENELITIAN_20151211150741.PDF','created_at' => '2015-11-26 16:16:54','updated_at' => '2015-12-11 16:01:44','deleted_at' => NULL],
  ['id' => '92','guide_id' => '21','no' => 'SPU-04/PM-01/SOP-04','date' => '2015-12-11','description' => 'SOP Peningkatan Standar Penilaian Penelitian','document' => 'SOPPENINGKATANSTANDARPENILAIANPENELITIAN_20151211150744.PDF','created_at' => '2015-11-26 16:17:33','updated_at' => '2015-12-11 16:01:47','deleted_at' => NULL],
  ['id' => '93','guide_id' => '22','no' => 'SPU-05/PM-01/SOP-01','date' => '2015-12-11','description' => 'SOP Penetapan Standar Peneliti','document' => 'SOPPENETAPANSTANDARPENELITI_20151211150845.PDF','created_at' => '2015-11-26 16:18:17','updated_at' => '2015-12-11 16:02:48','deleted_at' => NULL],
  ['id' => '94','guide_id' => '22','no' => 'SPU-05/PM-01/SOP-02','date' => '2015-12-11','description' => 'SOP Monitor dan Evaluasi Standar Peneliti','document' => 'SOPMONITORDANEVALUASISTANDARPENELITI_20151211150835.PDF','created_at' => '2015-11-26 16:19:05','updated_at' => '2015-12-11 16:02:40','deleted_at' => NULL],
  ['id' => '95','guide_id' => '22','no' => 'SPU-05/PM-01/SOP-03','date' => '2015-12-11','description' => 'SOP Pengendalian Standar Peneliti','document' => 'SOPPENGENDALIANSTANDARPENELITI_20151211150849.PDF','created_at' => '2015-11-26 16:19:50','updated_at' => '2015-12-11 16:02:54','deleted_at' => NULL],
  ['id' => '96','guide_id' => '22','no' => 'SPU-05/PM-01/SOP-04','date' => '2015-12-11','description' => 'SOP Peningkatan Standar Peneliti','document' => 'SOPPENINGKATANSTANDARPENELITI_20151211150848.PDF','created_at' => '2015-11-26 16:20:37','updated_at' => '2015-12-11 16:02:50','deleted_at' => NULL],
  ['id' => '97','guide_id' => '23','no' => 'SPU-06/PM-01/SOP-01','date' => '2015-12-11','description' => 'SOP Penetapan Standar Sarana dan Prasarana Penelitian','document' => 'SOPPENETAPANSTANDARSARANADANPRASARANAPENELITIAN_20151211151004.PDF','created_at' => '2015-11-26 16:21:53','updated_at' => '2015-12-11 16:04:07','deleted_at' => NULL],
  ['id' => '98','guide_id' => '23','no' => 'SPU-06/PM-01/SOP-02','date' => '2015-12-11','description' => 'SOP Monitor dan Evaluasi Standar Sarana dan Prasarana Penelitian','document' => 'SOPMONITORDANEVALUASISTANDARSARANADANPRASARANAPENELITIAN_20151211151008.PDF','created_at' => '2015-11-26 16:22:40','updated_at' => '2015-12-11 16:04:11','deleted_at' => NULL],
  ['id' => '99','guide_id' => '23','no' => 'SPU-06/PM-01/SOP-03','date' => '2015-12-11','description' => 'SOP Pengendalian Standar Sarana dan Prasarana Penelitian','document' => 'SOPPENGENDALIANSTANDARSARANADANPRASARANAPENELITIAN_20151211151014.PDF','created_at' => '2015-11-26 16:23:35','updated_at' => '2015-12-11 16:04:16','deleted_at' => NULL],
  ['id' => '100','guide_id' => '23','no' => 'SPU-06/PM-01/SOP-04','date' => '2015-12-11','description' => 'SOP Peningkatan Standar Sarana dan Prasarana Penelitian','document' => 'SOPPENINGKATANSTANDARSARANADANPRASARANAPENELITIAN_20151211151019.PDF','created_at' => '2015-11-26 16:25:27','updated_at' => '2015-12-11 16:04:22','deleted_at' => NULL],
  ['id' => '101','guide_id' => '24','no' => 'SPU-07/PM-01/SOP-01','date' => '2015-12-11','description' => 'SOP Penetapan Standar Pengelolaan Penelitian','document' => 'SOPPENETAPANSTANDARPENGELOLAANPENELITIAN_20151211151203.PDF','created_at' => '2015-11-26 16:26:44','updated_at' => '2015-12-11 16:06:06','deleted_at' => NULL],
  ['id' => '102','guide_id' => '24','no' => 'SPU-07/PM-01/SOP-02','date' => '2015-12-11','description' => 'SOP Monitor dan Evaluasi Standar Pengelolaan Penelitian','document' => 'SOPMONITORDANEVALUASISTANDARPENGELOLAANPENELITIAN_20151211151206.PDF','created_at' => '2015-11-26 16:27:26','updated_at' => '2015-12-11 16:06:10','deleted_at' => NULL],
  ['id' => '103','guide_id' => '24','no' => 'SPU-07/PM-01/SOP-03','date' => '2015-12-11','description' => 'SOP Pengendalian Standar Pengelolaan Penelitian','document' => 'SOPPENGENDALIANSTANDARPENGELOLAANPENELITIAN_20151211151212.PDF','created_at' => '2015-11-26 16:28:10','updated_at' => '2015-12-11 16:06:15','deleted_at' => NULL],
  ['id' => '104','guide_id' => '24','no' => 'SPU-07/PM-01/SOP-04','date' => '2015-12-11','description' => 'SOP Peningkatan Standar Pengelolaan Penelitian','document' => 'SOPPENINGKATANSTANDARPENGELOLAANPENELITIAN_20151211151219.PDF','created_at' => '2015-11-26 16:28:56','updated_at' => '2015-12-11 16:06:22','deleted_at' => NULL],
  ['id' => '105','guide_id' => '25','no' => 'SPU-08/PM-01/SOP-01','date' => '2015-12-11','description' => 'SOP Penetapan Standar Pembiayaan Penelitian','document' => 'SOPPENETAPANSTANDARPEMBIAYAANPENELITIAN_20151211151316.PDF','created_at' => '2015-11-26 16:31:55','updated_at' => '2015-12-11 16:07:19','deleted_at' => NULL],
  ['id' => '106','guide_id' => '25','no' => 'SPU-08/PM-01/SOP-02','date' => '2015-12-11','description' => 'SOP Monitor dan Evaluasi Standar Pembiayaan Penelitian','document' => 'SOPMONITORDANEVALUASISTANDARPEMBIAYAANPENELITIAN_20151211151316.PDF','created_at' => '2015-11-26 16:32:36','updated_at' => '2015-12-11 16:07:18','deleted_at' => NULL],
  ['id' => '107','guide_id' => '25','no' => 'SPU-08/PM-01/SOP-03','date' => '2015-12-11','description' => 'SOP Pengendalian Standar Pembiayaan Penelitian','document' => 'SOPPENGENDALIANSTANDARPEMBIAYAANPENELITIAN_20151211151311.PDF','created_at' => '2015-11-26 16:33:20','updated_at' => '2015-12-11 16:07:14','deleted_at' => NULL],
  ['id' => '108','guide_id' => '24','no' => 'SPU-08/PM-01/SOP-04','date' => '2015-12-11','description' => 'SOP Peningkatan Standar Pembiayaan Penelitian','document' => 'SOPPENINGKATANSTANDARPEMBIAYAANPENELITIAN_20151211151317.PDF','created_at' => '2015-11-26 16:34:05','updated_at' => '2015-12-11 16:07:20','deleted_at' => NULL],
  ['id' => '109','guide_id' => '26','no' => 'SPM-01/PM-01/SOP-01','date' => '2015-12-11','description' => 'SOP Penetapan Standar Hasil Pengabdian kepada Masyarakat','document' => 'SOPPENETAPANSTANDARHASILPENGABDIANKEPADAMASYARAKAT_20151211151408.PDF','created_at' => '2015-11-26 16:38:03','updated_at' => '2015-12-11 16:08:12','deleted_at' => NULL],
  ['id' => '110','guide_id' => '26','no' => 'SPM-01/PM-01/SOP-02','date' => '2015-12-11','description' => 'SOP Monitor dan Evaluasi Standar Hasil Pengabdian kepada Masyarakat','document' => 'SOPMONITORDANEVALUASISTANDARHASILPENGABDIANKEPADAMASYARAKAT_20151211151421.PDF','created_at' => '2015-11-26 16:38:52','updated_at' => '2015-12-11 16:08:24','deleted_at' => NULL],
  ['id' => '111','guide_id' => '26','no' => 'SPM-01/PM-01/SOP-03','date' => '2015-12-11','description' => 'SOP Pengendalian Standar Hasil Pengabdian kepada Masyarakat','document' => 'SOPPENGENDALIANSTANDARHASILPENGABDIANKEPADAMASYARAKAT_20151211151426.PDF','created_at' => '2015-11-26 16:39:31','updated_at' => '2015-12-11 16:08:29','deleted_at' => NULL],
  ['id' => '112','guide_id' => '26','no' => 'SPM-01/PM-01/SOP-04','date' => '2015-12-11','description' => 'SOP Peningkatan Standar Hasil Pengabdian kepada Masyarakat','document' => 'SOPPENINGKATANSTANDARHASILPENGABDIANKEPADAMASYARAKAT_20151211151435.PDF','created_at' => '2015-11-26 16:40:21','updated_at' => '2015-12-11 16:08:40','deleted_at' => NULL],
  ['id' => '113','guide_id' => '27','no' => 'SPM-02/PM-01/SOP-01','date' => '2015-12-11','description' => 'SOP Penetapan Standar Isi Pengabdian kepada Masyarakat','document' => 'SOPPENETAPANSTANDARISIPENGABDIANKEPADAMASYARAKAT_20151211151517.PDF','created_at' => '2015-11-26 16:41:22','updated_at' => '2015-12-11 16:09:20','deleted_at' => NULL],
  ['id' => '114','guide_id' => '27','no' => 'SPM-02/PM-01/SOP-02','date' => '2015-12-11','description' => 'SOP Monitor dan Evaluasi Standar Isi Pengabdian kepada Masyarakat','document' => 'SOPMONITORDANEVALUASISTANDARISIPENGABDIANKEPADAMASYARAKAT_20151211151537.PDF','created_at' => '2015-11-26 16:42:10','updated_at' => '2015-12-11 16:09:40','deleted_at' => NULL],
  ['id' => '115','guide_id' => '27','no' => 'SPM-02/PM-01/SOP-03','date' => '2015-12-11','description' => 'SOP Pengendalian Standar Isi Pengabdian kepada Masyarakat','document' => 'SOPPENGENDALIANSTANDARISIPENGABDIANKEPADAMASYARAKAT_20151211151527.PDF','created_at' => '2015-11-26 16:42:47','updated_at' => '2015-12-11 16:09:30','deleted_at' => NULL],
  ['id' => '116','guide_id' => '27','no' => 'SPM-02/PM-01/SOP-04','date' => '2015-12-11','description' => 'SOP Peningkatan Standar Isi Pengabdian kepada Masyarakat','document' => 'SOPPENINGKATANSTANDARISIPENGABDIANKEPADAMASYARAKAT_20151211151534.PDF','created_at' => '2015-11-26 16:43:28','updated_at' => '2015-12-11 16:09:37','deleted_at' => NULL],
  ['id' => '117','guide_id' => '29','no' => 'SPM-03/PM-01/SOP-01','date' => '2015-12-11','description' => 'SOP Penetapan Standar Proses Pengabdian kepada Masyarakat','document' => 'SOPPENETAPANSTANDARPROSESPENGABDIANKEPADAMASYARAKAT_20151211151622.PDF','created_at' => '2015-11-26 16:44:41','updated_at' => '2015-12-11 16:10:25','deleted_at' => NULL],
  ['id' => '118','guide_id' => '29','no' => 'SPM-03/PM-01/SOP-02','date' => '2015-12-11','description' => 'SOP Monitor dan Evaluasi Standar Proses Pengabdian kepada Masyarakat','document' => 'SOPMONITORDANEVALUASISTANDARPROSESPENGABDIANKEPADAMASYARAKAT_20151211151615.PDF','created_at' => '2015-11-26 16:45:27','updated_at' => '2015-12-11 16:10:19','deleted_at' => NULL],
  ['id' => '119','guide_id' => '29','no' => 'SPM-03/PM-01/SOP-03','date' => '2015-12-11','description' => 'SOP Pengendalian Standar Proses Pengabdian kepada Masyarakat','document' => 'SOPPENGENDALIANSTANDARPROSESPENGABDIANKEPADAMASYARAKAT_20151211151633.PDF','created_at' => '2015-11-26 16:46:18','updated_at' => '2015-12-11 16:10:36','deleted_at' => NULL],
  ['id' => '120','guide_id' => '29','no' => 'SPM-03/PM-01/SOP-04','date' => '2015-12-11','description' => 'SOP Peningkatan Standar Proses Pengabdian kepada Masyarakat','document' => 'SOPPENINGKATANSTANDARPROSESPENGABDIANKEPADAMASYARAKAT_20151211151626.PDF','created_at' => '2015-11-26 16:47:00','updated_at' => '2015-12-11 16:10:29','deleted_at' => NULL],
  ['id' => '121','guide_id' => '31','no' => 'SPM-04/PM-01/SOP-01','date' => '2015-12-11','description' => 'SOP Penetapan Standar  Penilaian Pengabdian kepada Masyarakat','document' => 'SOPPENETAPANSTANDARPENILAIANPENGABDIANKEPADAMASYARAKAT_20151211151713.PDF','created_at' => '2015-11-26 16:48:19','updated_at' => '2015-12-11 16:11:16','deleted_at' => NULL],
  ['id' => '122','guide_id' => '31','no' => 'SPM-04/PM-01/SOP-02','date' => '2015-12-11','description' => 'SOP Monitor dan Evaluasi Standar  Penilaian Pengabdian kepada Masyarakat','document' => 'SOPMONITORDANEVALUASISTANDARPENILAIANPENGABDIANKEPADAMASYARAKAT_20151211151728.PDF','created_at' => '2015-11-26 16:49:23','updated_at' => '2015-12-11 16:11:30','deleted_at' => NULL],
  ['id' => '123','guide_id' => '31','no' => 'SPM-04/PM-01/SOP-03','date' => '2015-12-11','description' => 'SOP Pengendalian Standar  Penilaian Pengabdian kepada Masyarakat','document' => 'SOPPENGENDALIANSTANDARPENILAIANPENGABDIANKEPADAMASYARAKAT_20151211151722.PDF','created_at' => '2015-11-26 16:53:18','updated_at' => '2015-12-11 16:11:25','deleted_at' => NULL],
  ['id' => '124','guide_id' => '31','no' => 'SPM-04/PM-01/SOP-04','date' => '2015-12-11','description' => 'SOP Peningkatan Standar  Penilaian Pengabdian kepada Masyarakat','document' => 'SOPPENINGKATANSTANDARPENILAIANPENGABDIANKEPADAMASYARAKAT_20151211151728.PDF','created_at' => '2015-11-26 16:54:02','updated_at' => '2015-12-11 16:11:30','deleted_at' => NULL],
  ['id' => '125','guide_id' => '33','no' => 'SPM-05/PM-01/SOP-01','date' => '2015-12-11','description' => 'SOP Penetapan Standar Pelaksana Pengabdian kepada Masyarakat','document' => 'SOPPENETAPANSTANDARPELAKSANAPENGABDIANKEPADAMASYARAKAT_20151211151811.PDF','created_at' => '2015-11-26 16:55:13','updated_at' => '2015-12-11 16:12:14','deleted_at' => NULL],
  ['id' => '126','guide_id' => '33','no' => 'SPM-05/PM-01/SOP-02','date' => '2015-12-11','description' => 'SOP Monitor dan Evaluasi Standar Pelaksana Pengabdian kepada Masyarakat','document' => 'SOPMONITORDANEVALUASISTANDARPELAKSANAPENGABDIANKEPADAMASYARAKAT_20151211151828.PDF','created_at' => '2015-11-26 16:56:13','updated_at' => '2015-12-11 16:12:31','deleted_at' => NULL],
  ['id' => '127','guide_id' => '33','no' => 'SPM-05/PM-01/SOP-03','date' => '2015-12-11','description' => 'SOP Pengendalian Standar Pelaksana Pengabdian kepada Masyarakat','document' => 'SOPPENGENDALIANSTANDARPELAKSANAPENGABDIANKEPADAMASYARAKAT_20151211151825.PDF','created_at' => '2015-11-26 16:57:28','updated_at' => '2015-12-11 16:12:28','deleted_at' => NULL],
  ['id' => '128','guide_id' => '33','no' => 'SPM-05/PM-01/SOP-04','date' => '2015-12-11','description' => 'SOP Peningkatan Standar Pelaksana Pengabdian kepada Masyarakat','document' => 'SOPPENINGKATANSTANDARPELAKSANAPENGABDIANKEPADAMASYARAKAT_20151211151832.PDF','created_at' => '2015-11-26 16:58:15','updated_at' => '2015-12-11 16:12:34','deleted_at' => NULL],
  ['id' => '129','guide_id' => '34','no' => 'SPM-06/PM-01/SOP-01','date' => '2015-12-11','description' => 'SOP Penetapan Standar Sarana dan Prasarana Pengabdian kepada Masyarakat','document' => 'SOPPENETAPANSTANDARSARANADANPRASARANAPENGABDIANKEPADAMASYARAKAT_20151211151909.PDF','created_at' => '2015-11-26 16:59:22','updated_at' => '2015-12-11 16:13:12','deleted_at' => NULL],
  ['id' => '130','guide_id' => '34','no' => 'SPM-06/PM-01/SOP-02','date' => '2015-12-11','description' => 'SOP Monitor dan Evaluasi Standar Pelaksana Pengabdian kepada Masyarakat','document' => 'SOPMONITORDANEVALUASISTANDARPELAKSANAPENGABDIANKEPADAMASYARAKAT_20151211151930.PDF','created_at' => '2015-11-26 17:00:44','updated_at' => '2015-12-11 16:13:34','deleted_at' => NULL],
  ['id' => '131','guide_id' => '34','no' => 'SPM-06/PM-01/SOP-03','date' => '2015-12-11','description' => 'SOP Pengendalian Standar Pelaksana Pengabdian kepada Masyarakat','document' => 'SOPPENGENDALIANSTANDARPELAKSANAPENGABDIANKEPADAMASYARAKAT_20151211151946.PDF','created_at' => '2015-11-26 17:01:58','updated_at' => '2015-12-11 16:13:49','deleted_at' => NULL],
  ['id' => '132','guide_id' => '34','no' => 'SPM-06/PM-01/SOP-04','date' => '2015-12-11','description' => 'SOP Peningkatan Standar Pelaksana Pengabdian kepada Masyarakat','document' => 'SOPPENINGKATANSTANDARPELAKSANAPENGABDIANKEPADAMASYARAKAT_20151211151949.PDF','created_at' => '2015-11-26 17:02:45','updated_at' => '2015-12-11 16:13:52','deleted_at' => NULL],
  ['id' => '133','guide_id' => '37','no' => 'SPM-07/PM-01/SOP-01','date' => '2015-12-11','description' => 'SOP Penetapan Standar Pengelolaan Pengabdian kepada Masyarakat','document' => 'SOPPENETAPANSTANDARPENGELOLAANPENGABDIANKEPADAMASYARAKAT_20151211152058.PDF','created_at' => '2015-11-26 17:03:51','updated_at' => '2015-12-11 16:15:01','deleted_at' => NULL],
  ['id' => '134','guide_id' => '37','no' => 'SPM-07/PM-01/SOP-02','date' => '2015-12-11','description' => 'SOP Monitor dan Evaluasi Standar Pengelolaan Pengabdian kepada Masyarakat','document' => 'SOPMONITORDANEVALUASISTANDARPENGELOLAANPENGABDIANKEPADAMASYARAKAT_20151211152102.PDF','created_at' => '2015-11-26 17:05:19','updated_at' => '2015-12-11 16:15:05','deleted_at' => NULL],
  ['id' => '135','guide_id' => '37','no' => 'SPM-07/PM-01/SOP-03','date' => '2015-11-10','description' => 'SOP Pengendalian Standar Pengelolaan Pengabdian kepada Masyarakat','document' => 'SOPPENGENDALIANSTANDARPENGELOLAANPENGABDIANKEPADAMASYARAKAT_20151126161147.PDF','created_at' => '2015-11-26 17:06:05','updated_at' => '2015-11-26 17:06:05','deleted_at' => NULL],
  ['id' => '136','guide_id' => '37','no' => 'SPM-07/PM-01/SOP-04','date' => '2015-11-10','description' => 'SOP Peningkatan Standar Pengelolaan Pengabdian kepada Masyarakat','document' => 'SOPPENINGKATANSTANDARPENGELOLAANPENGABDIANKEPADAMASYARAKAT_20151126161231.PDF','created_at' => '2015-11-26 17:06:49','updated_at' => '2015-11-26 17:06:49','deleted_at' => NULL],
  ['id' => '137','guide_id' => '38','no' => 'SPM-08/PM-01/SOP-01','date' => '2015-12-11','description' => 'SOP Penetapan Standar Pembiayaan Pengabdian kepada Masyarakat','document' => 'SOPPENETAPANSTANDARPEMBIAYAANPENGABDIANKEPADAMASYARAKAT_20151211152230.PDF','created_at' => '2015-11-26 17:08:00','updated_at' => '2015-12-11 16:16:33','deleted_at' => NULL],
  ['id' => '138','guide_id' => '38','no' => 'SPM-08/PM-01/SOP-02','date' => '2015-12-11','description' => 'SOP Monitor dan Evaluasi Standar Pembiayaan Pengabdian kepada Masyarakat','document' => 'SOPMONITORDANEVALUASISTANDARPEMBIAYAANPENGABDIANKEPADAMASYARAKAT_20151211152235.PDF','created_at' => '2015-11-26 17:08:51','updated_at' => '2015-12-11 16:16:38','deleted_at' => NULL],
  ['id' => '139','guide_id' => '38','no' => 'SPM-08/PM-01/SOP-03','date' => '2015-12-11','description' => 'SOP Pengendalian Standar Pembiayaan Pengabdian kepada Masyarakat','document' => 'SOPPENGENDALIANSTANDARPEMBIAYAANPENGABDIANKEPADAMASYARAKAT_20151211152236.PDF','created_at' => '2015-11-26 17:09:38','updated_at' => '2015-12-11 16:16:38','deleted_at' => NULL],
  ['id' => '140','guide_id' => '38','no' => 'SPM-08/PM-01/SOP-04','date' => '2015-12-11','description' => 'SOP Peningkatan Standar Pembiayaan Pengabdian kepada Masyarakat','document' => 'SOPPENINGKATANSTANDARPEMBIAYAANPENGABDIANKEPADAMASYARAKAT_20151211152240.PDF','created_at' => '2015-11-26 17:10:37','updated_at' => '2015-12-11 16:16:43','deleted_at' => NULL],
  ['id' => '141','guide_id' => '3','no' => 'SPT-03/PM-01/SOP-05','date' => '2015-12-11','description' => 'SOP Pelaksanaan Standar Proses Pembelajaran','document' => 'SOPPELAKSANAANSTANDARPROSESPEMBELAJARAN_20151211144327.DOCX','created_at' => '2015-11-30 08:29:04','updated_at' => '2015-12-11 15:37:30','deleted_at' => NULL],
  ['id' => '142','guide_id' => '4','no' => 'SPT-04/PM-01/SOP-05','date' => '2015-12-11','description' => 'SOP Pelaksanaan Standar Penilaian Pembelajaran','document' => 'SOPPELAKSANAANSTANDARPENILAIANPEMBELAJARAN_20151211144532.DOCX','created_at' => '2015-11-30 09:10:13','updated_at' => '2015-12-11 15:39:35','deleted_at' => NULL],
  ['id' => '143','guide_id' => '5','no' => 'SPT-05/PM-01/SOP-05','date' => '2015-12-11','description' => 'SOP Pelaksanaan Standar Dosen dan Tenaga Kependidikan','document' => 'SOPPELAKSANAANSTANDARDOSENDANTENAGAKEPENDIDIKAN_20151211144639.DOCX','created_at' => '2015-11-30 09:11:24','updated_at' => '2015-12-11 15:40:42','deleted_at' => NULL],
  ['id' => '144','guide_id' => '6','no' => 'SPT-06/PM-01/SOP-05','date' => '2015-12-11','description' => 'SOP Pelaksanaan Standar Gedung, Ruang Kerja Dosen, Kantor dan Ruang Kelas','document' => 'SOPPELAKSANAANSTANDARGEDUNG,RUANGKERJADOSEN,KANTORDANRUANGKELAS_20151211144826.DOCX','created_at' => '2015-11-30 09:13:13','updated_at' => '2015-12-11 15:42:29','deleted_at' => NULL],
  ['id' => '145','guide_id' => '7','no' => 'SPT-06/PM-02/SOP-05','date' => '2015-12-11','description' => 'SOP Pelaksanaan Standar Perpustakaan','document' => 'SOPPELAKSANAANSTANDARPERPUSTAKAAN_20151211144938.DOCX','created_at' => '2015-11-30 09:14:13','updated_at' => '2015-12-11 15:43:41','deleted_at' => NULL],
  ['id' => '146','guide_id' => '8','no' => 'SPT-06/PM-03/SOP-05','date' => '2015-12-11','description' => 'SOP Pelaksanaan Standar Sarana dan Prasarana Pendukung Proses Pembelajaran','document' => 'SOPPELAKSANAANSTANDARSARANADANPRASARANAPENDUKUNGPROSESPEMBELAJARAN_20151211145049.DOCX','created_at' => '2015-11-30 09:15:19','updated_at' => '2015-12-11 15:44:52','deleted_at' => NULL],
  ['id' => '147','guide_id' => '9','no' => 'SPT-06/PM-04/SOP-05','date' => '2015-12-11','description' => 'SOP Pelaksanaan Standar Sarana dan Prasarana Lain-Lain','document' => 'SOPPELAKSANAANSTANDARSARANADANPRASARANALAIN-LAIN_20151211145212.DOCX','created_at' => '2015-11-30 09:16:15','updated_at' => '2015-12-11 15:46:15','deleted_at' => NULL],
  ['id' => '148','guide_id' => '10','no' => 'SPT-07/PM-01/SOP-05','date' => '2015-12-11','description' => 'SOP Pelaksanaan Standar Pengelolaan Pembelajaran','document' => 'SOPPELAKSANAANSTANDARPENGELOLAANPEMBELAJARAN_20151211145352.DOCX','created_at' => '2015-11-30 09:17:19','updated_at' => '2015-12-11 15:47:55','deleted_at' => NULL],
  ['id' => '149','guide_id' => '11','no' => 'SPT-08/PM-01/SOP-05','date' => '2015-12-11','description' => 'SOP Pelaksanaan Standar Pembiayaan Pembelajaran','document' => 'SOPPELAKSANAANSTANDARPEMBIAYAANPEMBELAJARAN_20151211145508.DOCX','created_at' => '2015-11-30 09:18:23','updated_at' => '2015-12-11 15:49:11','deleted_at' => NULL],
  ['id' => '150','guide_id' => '12','no' => 'SPT-09/PM-01/SOP-05','date' => '2015-12-11','description' => 'SOP Pelaksanaan Standar Kemahasiswaan (Student Service)','document' => 'SOPPELAKSANAANSTANDARKEMAHASISWAAN(STUDENTSERVICE)_20151211145634.DOCX','created_at' => '2015-11-30 09:19:54','updated_at' => '2015-12-11 15:50:36','deleted_at' => NULL],
  ['id' => '151','guide_id' => '13','no' => 'SPT-09/PM-02/SOP-05','date' => '2015-12-11','description' => 'SOP Pelaksanaan Standar Kemahasiswaan (Student Development)','document' => 'SOPPELAKSANAANSTANDARKEMAHASISWAAN(STUDENTDEVELOPMENT)_20151211145759.DOCX','created_at' => '2015-11-30 09:22:10','updated_at' => '2015-12-11 15:52:01','deleted_at' => NULL],
  ['id' => '152','guide_id' => '14','no' => 'SPT-09/PM-03/SOP-05','date' => '2015-12-11','description' => 'SOP Pelaksanaan Standar Kemahasiswaan (Career and Development Center)','document' => 'SOPPELAKSANAANSTANDARKEMAHASISWAAN(CAREERANDDEVELOPMENTCENTER)_20151211145906.DOCX','created_at' => '2015-11-30 09:23:11','updated_at' => '2015-12-11 15:53:08','deleted_at' => NULL],
  ['id' => '153','guide_id' => '15','no' => 'SPT-10/PM-01/SOP-05','date' => '2015-12-11','description' => 'SOP Pelaksanaan Standar Kerjasama','document' => 'SOPPELAKSANAANSTANDARKERJASAMA_20151211150033.DOCX','created_at' => '2015-11-30 09:24:07','updated_at' => '2015-12-11 15:54:36','deleted_at' => NULL],
  ['id' => '154','guide_id' => '16','no' => 'SPT-11/PM-01/SOP-05','date' => '2015-12-11','description' => 'SOP Pelaksanaan Standar Sistem Informasi','document' => 'SOPPELAKSANAANSTANDARSISTEMINFORMASI_20151211150137.DOCX','created_at' => '2015-11-30 09:24:57','updated_at' => '2015-12-11 15:55:39','deleted_at' => NULL],
  ['id' => '155','guide_id' => '17','no' => 'SPT-12/PM-01/SOP-05','date' => '2015-12-11','description' => 'SOP Pelaksanaan Standar Suasana Akademik','document' => 'SOPPELAKSANAANSTANDARSUASANAAKADEMIK_20151211150232.DOCX','created_at' => '2015-11-30 09:25:49','updated_at' => '2015-12-11 15:56:36','deleted_at' => NULL],
  ['id' => '156','guide_id' => '1','no' => 'SPT-01/PM-01/SOP-05','date' => '2015-12-11','description' => 'SOP Pelaksanaan Standar Kompetensi Lulusan','document' => 'SOPPELAKSANAANSTANDARKOMPETENSILULUSAN_20151211143723.DOCX','created_at' => '2015-11-30 15:27:01','updated_at' => '2015-12-11 15:31:27','deleted_at' => NULL],
  ['id' => '157','guide_id' => '2','no' => 'SPT-02/PM-01/SOP-05','date' => '2015-12-11','description' => 'SOP Pelaksanaan Standar Isi Pembelajaran','document' => 'SOPPELAKSANAANSTANDARISIPEMBELAJARAN_20151211144028.DOCX','created_at' => '2015-11-30 15:27:58','updated_at' => '2015-12-11 15:34:31','deleted_at' => NULL]
];

// `spmi`.`forms`
$forms = [
  ['instruction_id' => '7','no' => 'SPT-01/PM-01/SOP-05/Form-01','date' => '2015-11-27','description' => 'Formulir Analisis SWOT','document' => 'FORMULIRANALISISSWOT_20151211152544.XLSX','created_at' => '2015-11-27 08:36:24','updated_at' => '2015-12-11 16:19:48','deleted_at' => NULL],
  ['instruction_id' => '7','no' => 'SPT-01/PM-01/SOP-05/Form-02','date' => '2015-11-27','description' => 'Formulir Penetapan Profil Lulusan Program Studi','document' => 'FORMULIRPENETAPANPROFILLULUSANPROGRAMSTUDI_20151211152549.XLSX','created_at' => '2015-11-27 08:39:00','updated_at' => '2015-12-11 16:19:52','deleted_at' => NULL],
  ['instruction_id' => '7','no' => 'SPT-01/PM-01/SOP-05/Form-03','date' => '2015-11-27','description' => 'Formulir Generik KKNI Program Studi ke Dalam Capaian Pembelajaran','document' => 'FORMULIRGENERIKKKNIPROGRAMSTUDIKEDALAMCAPAIANPEMBELAJARAN_20151211152554.XLSX','created_at' => '2015-11-27 08:45:20','updated_at' => '2015-12-11 16:19:56','deleted_at' => NULL],
  ['instruction_id' => '7','no' => 'SPT-01/PM-01/SOP-05/Form-04','date' => '2015-11-27','description' => 'Formulir Klasifikasi Kompetensi','document' => 'FORMULIRKLASIFIKASIKOMPETENSI_20151211152559.XLSX','created_at' => '2015-11-27 08:46:42','updated_at' => '2015-12-11 16:20:03','deleted_at' => NULL],
  ['instruction_id' => '13','no' => 'SPT-02/PM-01/SOP-05/Form-01','date' => '2015-11-27','description' => 'Formulir Kaitan Kompetensi dan Elemen Kompetensi','document' => 'FORMULIRKAITANKOMPETENSIDANELEMENKOMPETENSI_20151211152824.XLSX','created_at' => '2015-11-27 08:55:04','updated_at' => '2015-12-11 16:22:27','deleted_at' => NULL],
  ['instruction_id' => '13','no' => 'SPT-02/PM-01/SOP-05/Form-02','date' => '2015-11-27','description' => 'Formulir Kaitan Rumusan Kompetensi dengan Bahan Kajian','document' => 'FORMULIRKAITANRUMUSANKOMPETENSIDENGANBAHANKAJIAN_20151211152829.XLSX','created_at' => '2015-11-27 08:57:20','updated_at' => '2015-12-11 16:22:32','deleted_at' => NULL],
  ['instruction_id' => '13','no' => 'SPT-02/PM-01/SOP-05/Form-03','date' => '2015-11-27','description' => 'Formulir Pembobotan Bahan Kajian dan Mata Kuliah','document' => 'FORMULIRPEMBOBOTANBAHANKAJIANDANMATAKULIAH_20151211152833.XLSX','created_at' => '2015-11-27 08:58:30','updated_at' => '2015-12-11 16:22:36','deleted_at' => NULL],
  ['instruction_id' => '13','no' => 'SPT-02/PM-01/SOP-05/Form-04','date' => '2015-11-27','description' => 'Formulir Struktur Kurikulum Dalam Semester','document' => 'FORMULIRSTRUKTURKURIKULUMDALAMSEMESTER_20151211152840.XLSX','created_at' => '2015-11-27 08:59:54','updated_at' => '2015-12-11 16:22:44','deleted_at' => NULL],
  ['instruction_id' => '13','no' => 'SPT-02/PM-01/SOP-05/Form-05','date' => '2015-11-27','description' => 'Formulir Daftar Mata Kuliah Dalam Semester','document' => 'FORMULIRDAFTARMATAKULIAHDALAMSEMESTER_20151211152842.XLSX','created_at' => '2015-11-27 09:02:21','updated_at' => '2015-12-11 16:22:46','deleted_at' => NULL],
  ['instruction_id' => '13','no' => 'SPT-02/PM-01/SOP-05/Form-06','date' => '2015-11-27','description' => 'Formulir Rumusan Tujuan Pembelajaran Mata Kuliah','document' => 'FORMULIRRUMUSANTUJUANPEMBELAJARANMATAKULIAH_20151211152846.XLSX','created_at' => '2015-11-27 09:03:21','updated_at' => '2015-12-11 16:22:49','deleted_at' => NULL],
  ['instruction_id' => '141','no' => 'SPT-03/PM-01/SOP-05/Form-01','date' => '2015-11-30','description' => 'Formulir Hasil Peninjauan Silabus RPKPS dan Bahan Ajar','document' => 'FORMULIRHASILPENINJAUANSILABUSRPKPSDANBAHANAJAR_20151211153152.XLSX','created_at' => '2015-11-30 09:44:22','updated_at' => '2015-12-11 16:25:56','deleted_at' => NULL],
  ['instruction_id' => '141','no' => 'SPT-03/PM-01/SOP-05/Form-02','date' => '2015-11-30','description' => 'Formulir Nama Dosen Pembimbing Akademik dan Jumlah Mahasiswa','document' => 'FORMULIRNAMADOSENPEMBIMBINGAKADEMIKDANJUMLAHMAHASISWA_20151130085320.XLSX','created_at' => '2015-11-30 09:47:35','updated_at' => '2015-11-30 09:47:35','deleted_at' => NULL],
    
   
    
    
    //3.1.3. 
    [
        'instruction_id'    =>  '7',
        'no'                =>  'SPT-01/PM-01/SOP-05/FORM-05',
        'date'              =>  new DateTime,
        'description'       =>  'Form Pencapaian Prestasi Mahasiswa Dalam Tiga Tahun Terakhir di Bidang Akademik dan Non-Akademik',
        'document'          =>  null,
        'created_at'        =>  new DateTime,
        'updated_at'        =>  new DateTime,
        'deleted_at'        =>  null,
    ],
    
    //3.1.4.
    [
        'instruction_id'    =>  '7',
        'no'                =>  'SPT-01/PM-01/SOP-05/FORM-06',
        'date'              =>  new DateTime,
        'description'       =>  'Form Data Jumlah Mahasiswa Reguler',
        'document'          =>  null,
        'created_at'        =>  new DateTime,
        'updated_at'        =>  new DateTime,
        'deleted_at'        =>  null,
    ],
    
    //3.3.2.
    [
        'instruction_id'    =>  '7',
        'no'                =>  'SPT-01/PM-01/SOP-05/FORM-07',
        'date'              =>  new DateTime,
        'description'       =>  'Form Profil Masa Tunggu Kerja Pertama',
        'document'          =>  null,
        'created_at'        =>  new DateTime,
        'updated_at'        =>  new DateTime,
        'deleted_at'        =>  null,
    ],
    
    //3.3.3.
    [
        'instruction_id'    =>  '7',
        'no'                =>  'SPT-01/PM-01/SOP-05/FORM-08',
        'date'              =>  new DateTime,
        'description'       =>  'Form Profil Kesesuaian Bidang Kerja dengan Bidang Studi',
        'document'          =>  null,
        'created_at'        =>  new DateTime,
        'updated_at'        =>  new DateTime,
        'deleted_at'        =>  null,
    ],
    
    
    
    
    
    
   
    //5.1.2.1. 
    [
        'instruction_id'    =>  '13',
        'no'                =>  'SPT-02/PM-01/SOP-05/FORM-07',
        'date'              =>  new DateTime,
        'description'       =>  'Form Jumlah SKS Program Studi',
        'document'          =>  null,
        'created_at'        =>  new DateTime,
        'updated_at'        =>  new DateTime,
        'deleted_at'        =>  null,
    ],
    
    //5.1.2.2. 
    [
        'instruction_id'    =>  '13',
        'no'                =>  'SPT-02/PM-01/SOP-05/FORM-08',
        'date'              =>  new DateTime,
        'description'       =>  'Form Struktur Kurikulum Mata Kuliah',
        'document'          =>  null,
        'created_at'        =>  new DateTime,
        'updated_at'        =>  new DateTime,
        'deleted_at'        =>  null,
    ],
    
    //5.1.3. 
    [
        'instruction_id'    =>  '13',
        'no'                =>  'SPT-02/PM-01/SOP-05/FORM-09',
        'date'              =>  new DateTime,
        'description'       =>  'Form Mata Kuliah Pilihan',
        'document'          =>  null,
        'created_at'        =>  new DateTime,
        'updated_at'        =>  new DateTime,
        'deleted_at'        =>  null,
    ],
    
    //5.1.4. 
    [
        'instruction_id'    =>  '13',
        'no'                =>  'SPT-02/PM-01/SOP-05/FORM-10',
        'date'              =>  new DateTime,
        'description'       =>  'Form Substansi Praktikum',
        'document'          =>  null,
        'created_at'        =>  new DateTime,
        'updated_at'        =>  new DateTime,
        'deleted_at'        =>  null,
    ],
    
    //5.2.1.
    [
        'instruction_id'    =>  '13',
        'no'                =>  'SPT-02/PM-01/SOP-05/FORM-11',
        'date'              =>  new DateTime,
        'description'       =>  'Form Mekanisme Peninjauan Kurikulum',
        'document'          =>  null,
        'created_at'        =>  new DateTime,
        'updated_at'        =>  new DateTime,
        'deleted_at'        =>  null,
    ],
    
    //5.2.2.
    [
        'instruction_id'    =>  '13',
        'no'                =>  'SPT-02/PM-01/SOP-05/FORM-12',
        'date'              =>  new DateTime,
        'description'       =>  'Form Hasil Peninjauan Silabus RPKPS dan Bahan Ajar',
        'document'          =>  null,
        'created_at'        =>  new DateTime,
        'updated_at'        =>  new DateTime,
        'deleted_at'        =>  null,
    ],
    
    //5.3.1.1. 
    [
        'instruction_id'    =>  '13',
        'no'                =>  'SPT-02/PM-01/SOP-05/FORM-13',
        'date'              =>  new DateTime,
        'description'       =>  'Form Mekanisme Monitoring, Pengkajian dan Perbaikan Materi Perkuliahan',
        'document'          =>  null,
        'created_at'        =>  new DateTime,
        'updated_at'        =>  new DateTime,
        'deleted_at'        =>  null,
    ],
    
    //5.3.1.2. 
    [
        'instruction_id'    =>  '13',
        'no'                =>  'SPT-02/PM-01/SOP-05/FORM-14',
        'date'              =>  new DateTime,
        'description'       =>  'Form Mekanisme Penyusunan Materi Perkuliahan',
        'document'          =>  null,
        'created_at'        =>  new DateTime,
        'updated_at'        =>  new DateTime,
        'deleted_at'        =>  null,
    ],
    
    
    
    
    
    
    
    
    
    
    //5.4.1
    [
        'instruction_id'    =>  '141',
        'no'                =>  'SPT-03/PM-01/SOP-05/FORM-03',
        'date'              =>  new DateTime,
        'description'       =>  'Form Nama Dosen Pembimbing Akademik dan Jumlah Mahasiswa',
        'document'          =>  null,
        'created_at'        =>  new DateTime,
        'updated_at'        =>  new DateTime,
        'deleted_at'        =>  null,
    ],
    
    //5.4.2
    [
        'instruction_id'    =>  '141',
        'no'                =>  'SPT-03/PM-01/SOP-05/FORM-04',
        'date'              =>  new DateTime,
        'description'       =>  'Form Proses Pembimbingan Akademik',
        'document'          =>  null,
        'created_at'        =>  new DateTime,
        'updated_at'        =>  new DateTime,
        'deleted_at'        =>  null,
    ],
    
    //5.5
    [
        'instruction_id'    =>  '141',
        'no'                =>  'SPT-03/PM-01/SOP-05/FORM-05',
        'date'              =>  new DateTime,
        'description'       =>  'Form Pembimbingan Tugas Akhir',
        'document'          =>  null,
        'created_at'        =>  new DateTime,
        'updated_at'        =>  new DateTime,
        'deleted_at'        =>  null,
    ],
    
    //5.5.2
    [
        'instruction_id'    =>  '141',
        'no'                =>  'SPT-03/PM-01/SOP-05/FORM-06',
        'date'              =>  new DateTime,
        'description'       =>  'Form Rata-Rata Penyelesaian Tugas Akhir',
        'document'          =>  null,
        'created_at'        =>  new DateTime,
        'updated_at'        =>  new DateTime,
        'deleted_at'        =>  null,
    ],
    
    //5.6
    [
        'instruction_id'    =>  '141',
        'no'                =>  'SPT-03/PM-01/SOP-05/FORM-07',
        'date'              =>  new DateTime,
        'description'       =>  'Form Upaya Perbaikan Pembelajaran',
        'document'          =>  null,
        'created_at'        =>  new DateTime,
        'updated_at'        =>  new DateTime,
        'deleted_at'        =>  null,
    ],
    
    
    
    
    
      
    
    //5.3.2
    [
        'instruction_id'    =>  '142',
        'no'                =>  'SPT-04/PM-01/SOP-05/FORM-01',
        'date'              =>  new DateTime,
        'description'       =>  'Form Pemeriksaan Soal Ujian',
        'document'          =>  null,
        'created_at'        =>  new DateTime,
        'updated_at'        =>  new DateTime,
        'deleted_at'        =>  null,
    ],
    
    
    
    
    
    
    
    //4.1.
    [
        'instruction_id'    =>  '143',
        'no'                =>  'SPT-05/PM-01/SOP-05/FORM-01',
        'date'              =>  new DateTime,
        'description'       =>  'Form Sistem Seleksi dan Pengembangan',
        'document'          =>  null,
        'created_at'        =>  new DateTime,
        'updated_at'        =>  new DateTime,
        'deleted_at'        =>  null,
    ],
    
    //4.2.1
    [
        'instruction_id'    =>  '143',
        'no'                =>  'SPT-05/PM-01/SOP-05/FORM-02',
        'date'              =>  new DateTime,
        'description'       =>  'Form Sistem Monitoring dan Evaluasi Serta Rekam Jejak Kinerja Dosen dan Tenaga Kependidikan',
        'document'          =>  null,
        'created_at'        =>  new DateTime,
        'updated_at'        =>  new DateTime,
        'deleted_at'        =>  null,
    ],
    
    //4.3.1
    [
        'instruction_id'    =>  '143',
        'no'                =>  'SPT-05/PM-01/SOP-05/FORM-03',
        'date'              =>  new DateTime,
        'description'       =>  'Form Data Dosen Tetap yang Bidang Keahliannya Sesuai Dengan PS',
        'document'          =>  null,
        'created_at'        =>  new DateTime,
        'updated_at'        =>  new DateTime,
        'deleted_at'        =>  null,
    ],
    
    //4.3.2
    [
        'instruction_id'    =>  '143',
        'no'                =>  'SPT-05/PM-01/SOP-05/FORM-04',
        'date'              =>  new DateTime,
        'description'       =>  'Form Data Dosen Tetap yang Bidang Keahliannya Diluar Bidang PS',
        'document'          =>  null,
        'created_at'        =>  new DateTime,
        'updated_at'        =>  new DateTime,
        'deleted_at'        =>  null,
    ],
    
    //4.3.3
    [
        'instruction_id'    =>  '143',
        'no'                =>  'SPT-05/PM-01/SOP-05/FORM-05',
        'date'              =>  new DateTime,
        'description'       =>  'Form Aktivitas Dosen Tetap',
        'document'          =>  null,
        'created_at'        =>  new DateTime,
        'updated_at'        =>  new DateTime,
        'deleted_at'        =>  null,
    ],
    
    //4.3.4
    [
        'instruction_id'    =>  '143',
        'no'                =>  'SPT-05/PM-01/SOP-05/FORM-06',
        'date'              =>  new DateTime,
        'description'       =>  'Form Aktivitas Mengajar Dosen Tetap yang Bidang Keahliannya Sesuai Dengan PS',
        'document'          =>  null,
        'created_at'        =>  new DateTime,
        'updated_at'        =>  new DateTime,
        'deleted_at'        =>  null,
    ],
    
    //4.3.5
    [
        'instruction_id'    =>  '143',
        'no'                =>  'SPT-05/PM-01/SOP-05/FORM-07',
        'date'              =>  new DateTime,
        'description'       =>  'Form Aktivitas Mengajar Dosen Tetap yang Bidang Keahliannya diluar PS',
        'document'          =>  null,
        'created_at'        =>  new DateTime,
        'updated_at'        =>  new DateTime,
        'deleted_at'        =>  null,
    ],
    
    //4.4.1
    [
        'instruction_id'    =>  '143',
        'no'                =>  'SPT-05/PM-01/SOP-05/FORM-08',
        'date'              =>  new DateTime,
        'description'       =>  'Form Data Dosen Tidak Tetap Pada PS',
        'document'          =>  null,
        'created_at'        =>  new DateTime,
        'updated_at'        =>  new DateTime,
        'deleted_at'        =>  null,
    ],
    
    //4.4.2
    [
        'instruction_id'    =>  '143',
        'no'                =>  'SPT-05/PM-01/SOP-05/FORM-09',
        'date'              =>  new DateTime,
        'description'       =>  'Form Aktifitas Mengajar Dosen Tidak Tetap Sesuai PS',
        'document'          =>  null,
        'created_at'        =>  new DateTime,
        'updated_at'        =>  new DateTime,
        'deleted_at'        =>  null,
    ],
    
    //4.5.1
    [
        'instruction_id'    =>  '143',
        'no'                =>  'SPT-05/PM-01/SOP-05/FORM-10',
        'date'              =>  new DateTime,
        'description'       =>  'Form Kegiatan Tenaga Ahli atau Pakar',
        'document'          =>  null,
        'created_at'        =>  new DateTime,
        'updated_at'        =>  new DateTime,
        'deleted_at'        =>  null,
    ],
    
    //4.5.2
    [
        'instruction_id'    =>  '143',
        'no'                =>  'SPT-05/PM-01/SOP-05/FORM-11',
        'date'              =>  new DateTime,
        'description'       =>  'Form Peningkatan Kemampuan Dosen Tetap',
        'document'          =>  null,
        'created_at'        =>  new DateTime,
        'updated_at'        =>  new DateTime,
        'deleted_at'        =>  null,
    ],
    
    //4.5.3
    [
        'instruction_id'    =>  '143',
        'no'                =>  'SPT-05/PM-01/SOP-05/FORM-12',
        'date'              =>  new DateTime,
        'description'       =>  'Form Kegiatan Dosen Tetap Bidang Keahliannya Sesuai PS',
        'document'          =>  null,
        'created_at'        =>  new DateTime,
        'updated_at'        =>  new DateTime,
        'deleted_at'        =>  null,
    ],
    
    //4.5.4
    [
        'instruction_id'    =>  '143',
        'no'                =>  'SPT-05/PM-01/SOP-05/FORM-13',
        'date'              =>  new DateTime,
        'description'       =>  'Form Pencapaian Prestasi atau Reputasi Dosen',
        'document'          =>  null,
        'created_at'        =>  new DateTime,
        'updated_at'        =>  new DateTime,
        'deleted_at'        =>  null,
    ],
    
    //4.5.5
    [
        'instruction_id'    =>  '143',
        'no'                =>  'SPT-05/PM-01/SOP-05/FORM-14',
        'date'              =>  new DateTime,
        'description'       =>  'Form Keikutsertaan Dosen Tetap Dalam Organisasi Keilmuan dan Profesi',
        'document'          =>  null,
        'created_at'        =>  new DateTime,
        'updated_at'        =>  new DateTime,
        'deleted_at'        =>  null,
    ],
    
    //4.6.1
    [
        'instruction_id'    =>  '143',
        'no'                =>  'SPT-05/PM-01/SOP-05/FORM-15',
        'date'              =>  new DateTime,
        'description'       =>  'Form Data Tenaga Kependidikan',
        'document'          =>  null,
        'created_at'        =>  new DateTime,
        'updated_at'        =>  new DateTime,
        'deleted_at'        =>  null,
    ],
    
    //4.6.2
    [
        'instruction_id'    =>  '143',
        'no'                =>  'SPT-05/PM-01/SOP-05/FORM-16',
        'date'              =>  new DateTime,
        'description'       =>  'Form Upaya Pengembangan Tenaga Kependidikan',
        'document'          =>  null,
        'created_at'        =>  new DateTime,
        'updated_at'        =>  new DateTime,
        'deleted_at'        =>  null,
    ],
    
    
    
    
    
    
    
    
    //6.3.1
    [
        'instruction_id'    =>  '144',
        'no'                =>  'SPT-06/PM-01/SOP-05/FORM-01',
        'date'              =>  new DateTime,
        'description'       =>  'Form Data Ruang Kerja Dosen Tetap',
        'document'          =>  null,
        'created_at'        =>  new DateTime,
        'updated_at'        =>  new DateTime,
        'deleted_at'        =>  null,
    ],
    
    //6.3.2
    [
        'instruction_id'    =>  '144',
        'no'                =>  'SPT-06/PM-01/SOP-05/FORM-02',
        'date'              =>  new DateTime,
        'description'       =>  'Form Data Prasarana Untuk Gedung',
        'document'          =>  null,
        'created_at'        =>  new DateTime,
        'updated_at'        =>  new DateTime,
        'deleted_at'        =>  null,
    ],
    
    //6.3.3
    [
        'instruction_id'    =>  '147',
        'no'                =>  'SPT-06/PM-04/SOP-05/FORM-01',
        'date'              =>  new DateTime,
        'description'       =>  'Form Data Prasarana Lain yang Menunjang',
        'document'          =>  null,
        'created_at'        =>  new DateTime,
        'updated_at'        =>  new DateTime,
        'deleted_at'        =>  null,
    ],
    
    //6.4.1
    [
        'instruction_id'    =>  '145',
        'no'                =>  'SPT-06/PM-02/SOP-05/FORM-01',
        'date'              =>  new DateTime,
        'description'       =>  'Form Rekapitulasi Jumlah Ketersediaan Pustaka yang Relevan Dengan Bidang PS',
        'document'          =>  null,
        'created_at'        =>  new DateTime,
        'updated_at'        =>  new DateTime,
        'deleted_at'        =>  null,
    ],
    
    //6.4.2
    [
        'instruction_id'    =>  '145',
        'no'                =>  'SPT-06/PM-02/SOP-05/FORM-02',
        'date'              =>  new DateTime,
        'description'       =>  'Form Sumber-Sumber Pustaka di Lembaga Lain',
        'document'          =>  null,
        'created_at'        =>  new DateTime,
        'updated_at'        =>  new DateTime,
        'deleted_at'        =>  null,
    ],
    
    //6.4.3
    [
        'instruction_id'    =>  '146',
        'no'                =>  'SPT-06/PM-03/SOP-05/FORM-01',
        'date'              =>  new DateTime,
        'description'       =>  'Form Data Peralatan Utama yang Digunakan di Laboratorium',
        'document'          =>  null,
        'created_at'        =>  new DateTime,
        'updated_at'        =>  new DateTime,
        'deleted_at'        =>  null,
    ],
    
    
    
    
    
    
    
    //1.1.1.
    [
        'instruction_id'    =>  '148',
        'no'                =>  'SPT-07/PM-01/SOP-05/FORM-01',
        'date'              =>  new DateTime,
        'description'       =>  'Form Mekanisme Penyusunan Visi, Misi, Tujuan, dan Sarasaran Program Studi',
        'document'          =>  null,
        'created_at'        =>  new DateTime,
        'updated_at'        =>  new DateTime,
        'deleted_at'        =>  null,
    ],
    
    //1.1.2.
    [
        'instruction_id'    =>  '148',
        'no'                =>  'SPT-07/PM-01/SOP-05/FORM-02',
        'date'              =>  new DateTime,
        'description'       =>  'Form Visi Program Studi',
        'document'          =>  null,
        'created_at'        =>  new DateTime,
        'updated_at'        =>  new DateTime,
        'deleted_at'        =>  null,
    ],
    
    //1.1.3.
    [
        'instruction_id'    =>  '148',
        'no'                =>  'SPT-07/PM-01/SOP-05/FORM-03',
        'date'              =>  new DateTime,
        'description'       =>  'Form Misi Program Studi',
        'document'          =>  null,
        'created_at'        =>  new DateTime,
        'updated_at'        =>  new DateTime,
        'deleted_at'        =>  null,
    ],
    
    //1.1.4.
    [
        'instruction_id'    =>  '148',
        'no'                =>  'SPT-07/PM-01/SOP-05/FORM-04',
        'date'              =>  new DateTime,
        'description'       =>  'Form Tujuan Program Studi',
        'document'          =>  null,
        'created_at'        =>  new DateTime,
        'updated_at'        =>  new DateTime,
        'deleted_at'        =>  null,
    ],
    
    //1.1.5.
    [
        'instruction_id'    =>  '148',
        'no'                =>  'SPT-07/PM-01/SOP-05/FORM-05',
        'date'              =>  new DateTime,
        'description'       =>  'Sasaran dan Strategi Pencapaian Program Studi',
        'document'          =>  null,
        'created_at'        =>  new DateTime,
        'updated_at'        =>  new DateTime,
        'deleted_at'        =>  null,
    ],
    
    /**
     * poin 1.2....?
     *
     */
    
    //2.1.
    [
        'instruction_id'    =>  '148',
        'no'                =>  'SPT-07/PM-01/SOP-05/FORM-06',
        'date'              =>  new DateTime,
        'description'       =>  'Form Sistem Tata Pamong',
        'document'          =>  null,
        'created_at'        =>  new DateTime,
        'updated_at'        =>  new DateTime,
        'deleted_at'        =>  null,
    ],
    
    //2.2.
    [
        'instruction_id'    =>  '148',
        'no'                =>  'SPT-07/PM-01/SOP-05/FORM-07',
        'date'              =>  new DateTime,
        'description'       =>  'Form Pola Kepemimpinan Program Studi',
        'document'          =>  null,
        'created_at'        =>  new DateTime,
        'updated_at'        =>  new DateTime,
        'deleted_at'        =>  null,
    ],
    
    //2.3.
    [
        'instruction_id'    =>  '148',
        'no'                =>  'SPT-07/PM-01/SOP-05/FORM-08',
        'date'              =>  new DateTime,
        'description'       =>  'Form Sistem Pengelolaan Program Studi',
        'document'          =>  null,
        'created_at'        =>  new DateTime,
        'updated_at'        =>  new DateTime,
        'deleted_at'        =>  null,
    ],
    
    //2.4.
    [
        'instruction_id'    =>  '148',
        'no'                =>  'SPT-07/PM-01/SOP-05/FORM-09',
        'date'              =>  new DateTime,
        'description'       =>  'Penjaminan Mutu Program Studi',
        'document'          =>  null,
        'created_at'        =>  new DateTime,
        'updated_at'        =>  new DateTime,
        'deleted_at'        =>  null,
    ],
    
    //2.5.
    [
        'instruction_id'    =>  '148',
        'no'                =>  'SPT-07/PM-01/SOP-05/FORM-10',
        'date'              =>  new DateTime,
        'description'       =>  'Form Umpan Balik Dosen (Kemahasiswaan)',
        'document'          =>  null,
        'created_at'        =>  new DateTime,
        'updated_at'        =>  new DateTime,
        'deleted_at'        =>  null,
    ],
    
    //2.5.
    [
        'instruction_id'    =>  '148',
        'no'                =>  'SPT-07/PM-01/SOP-05/FORM-11',
        'date'              =>  new DateTime,
        'description'       =>  'Form Umpan Balik Untuk Program Studi',
        'document'          =>  null,
        'created_at'        =>  new DateTime,
        'updated_at'        =>  new DateTime,
        'deleted_at'        =>  null,
    ],
    
    //2.6.
    [
        'instruction_id'    =>  '148',
        'no'                =>  'SPT-07/PM-01/SOP-05/FORM-12',
        'date'              =>  new DateTime,
        'description'       =>  'Upaya Menjamin Sustainability Program Studi',
        'document'          =>  null,
        'created_at'        =>  new DateTime,
        'updated_at'        =>  new DateTime,
        'deleted_at'        =>  null,
    ],
    
    
    
    
    
    
    
    
    
    
    
    
    //6.1
    [
        'instruction_id'    =>  '149',
        'no'                =>  'SPT-08/PM-01/SOP-05/FORM-01',
        'date'              =>  new DateTime,
        'description'       =>  'Form Pengelolaan Dana',
        'document'          =>  null,
        'created_at'        =>  new DateTime,
        'updated_at'        =>  new DateTime,
        'deleted_at'        =>  null,
    ],
    
    //6.2.1
    [
        'instruction_id'    =>  '149',
        'no'                =>  'SPT-08/PM-01/SOP-05/FORM-02',
        'date'              =>  new DateTime,
        'description'       =>  'Form Realisasi Perolehan dan Alokasi Dana',
        'document'          =>  null,
        'created_at'        =>  new DateTime,
        'updated_at'        =>  new DateTime,
        'deleted_at'        =>  null,
    ],
    
    //6.2.2
    [
        'instruction_id'    =>  '149',
        'no'                =>  'SPT-08/PM-01/SOP-05/FORM-03',
        'date'              =>  new DateTime,
        'description'       =>  'Form Dana Untuk Kegiatan Penelitian Pada Tiga Tahun Terakhir',
        'document'          =>  null,
        'created_at'        =>  new DateTime,
        'updated_at'        =>  new DateTime,
        'deleted_at'        =>  null,
    ],
    
    //6.2.3
    [
        'instruction_id'    =>  '149',
        'no'                =>  'SPT-08/PM-01/SOP-05/FORM-04',
        'date'              =>  new DateTime,
        'description'       =>  'Form Dana yang Diperoleh Dari dan Untuk Kegiatan Pengabdian Kepada Masyarakat',
        'document'          =>  null,
        'created_at'        =>  new DateTime,
        'updated_at'        =>  new DateTime,
        'deleted_at'        =>  null,
    ],
    
    

    
    

    
    //3.1.1.a. 
    [
        'instruction_id'    =>  '150',
        'no'                =>  'SPT-09/PM-01/SOP-05/FORM-01',
        'date'              =>  new DateTime,
        'description'       =>  'Form Profil Mahasiswa dan Lulusan (BAAK)',
        'document'          =>  null,
        'created_at'        =>  new DateTime,
        'updated_at'        =>  new DateTime,
        'deleted_at'        =>  null,
    ],
    
    //3.1.1.b.
    [
        'instruction_id'    =>  '150',
        'no'                =>  'SPT-09/PM-01/SOP-05/FORM-02',
        'date'              =>  new DateTime,
        'description'       =>  'Form Profil Mahasiswa dan Lulusan (Marketing)',
        'document'          =>  null,
        'created_at'        =>  new DateTime,
        'updated_at'        =>  new DateTime,
        'deleted_at'        =>  null,
    ],
    
    //3.1.2. 
    [
        'instruction_id'    =>  '150',
        'no'                =>  'SPT-09/PM-01/SOP-05/FORM-03',
        'date'              =>  new DateTime,
        'description'       =>  'Form Data Mahasiswa Non Reguler',
        'document'          =>  null,
        'created_at'        =>  new DateTime,
        'updated_at'        =>  new DateTime,
        'deleted_at'        =>  null,
    ],
    
    //3.2.
    [
        'instruction_id'    =>  '150',
        'no'                =>  'SPT-09/PM-01/SOP-05/FORM-04',
        'date'              =>  new DateTime,
        'description'       =>  'Form Layanan Kepada Mahasiswa',
        'document'          =>  null,
        'created_at'        =>  new DateTime,
        'updated_at'        =>  new DateTime,
        'deleted_at'        =>  null,
    ],
    
    //3.3.1.a.
    [
        'instruction_id'    =>  '150',
        'no'                =>  'SPT-09/PM-01/SOP-05/FORM-05',
        'date'              =>  new DateTime,
        'description'       =>  'Form Studi Pelacakan Lulusan Program Studi',
        'document'          =>  null,
        'created_at'        =>  new DateTime,
        'updated_at'        =>  new DateTime,
        'deleted_at'        =>  null,
    ],
    
    //3.3.1.b.
    [
        'instruction_id'    =>  '150',
        'no'                =>  'SPT-09/PM-01/SOP-05/FORM-06',
        'date'              =>  new DateTime,
        'description'       =>  'Form Evaluasi Lulusan',
        'document'          =>  null,
        'created_at'        =>  new DateTime,
        'updated_at'        =>  new DateTime,
        'deleted_at'        =>  null,
    ],
    
    
    //3.4.1.
    [
        'instruction_id'    =>  '150',
        'no'                =>  'SPT-09/PM-01/SOP-05/FORM-07',
        'date'              =>  new DateTime,
        'description'       =>  'Partisipasi Alumni dalam Pengembangan Akademik',
        'document'          =>  null,
        'created_at'        =>  new DateTime,
        'updated_at'        =>  new DateTime,
        'deleted_at'        =>  null,
    ],
    
    //3.4.2.
    [
        'instruction_id'    =>  '150',
        'no'                =>  'SPT-09/PM-01/SOP-05/FORM-08',
        'date'              =>  new DateTime,
        'description'       =>  'Partisipasi Alumni dalam Mendukung Pengembangan Non-Akademik',
        'document'          =>  null,
        'created_at'        =>  new DateTime,
        'updated_at'        =>  new DateTime,
        'deleted_at'        =>  null,
    ],
    

    
    
    
    
  
    
    
    
    
    
    
    
    //5.7.1
    [
        'instruction_id'    =>  '153',
        'no'                =>  'SPT-10/PM-01/SOP-05/FORM-01',
        'date'              =>  new DateTime,
        'description'       =>  'Form Kebijakan Tentang Suasana Akademik',
        'document'          =>  null,
        'created_at'        =>  new DateTime,
        'updated_at'        =>  new DateTime,
        'deleted_at'        =>  null,
    ],
    
    //5.7.2
    [
        'instruction_id'    =>  '153',
        'no'                =>  'SPT-10/PM-01/SOP-05/FORM-02',
        'date'              =>  new DateTime,
        'description'       =>  'Form Ketersediaan dan Jenis Prasarana, Sarana, dan Dana yang Memungkinkan Terciptanya Interaksi Akademik',
        'document'          =>  null,
        'created_at'        =>  new DateTime,
        'updated_at'        =>  new DateTime,
        'deleted_at'        =>  null,
    ],
    
    //5.7.3
    [
        'instruction_id'    =>  '153',
        'no'                =>  'SPT-10/PM-01/SOP-05/FORM-03',
        'date'              =>  new DateTime,
        'description'       =>  'Form Program dan Kegiatan Didalam dan Diluar Proses Pembelajaran Untuk Menciptakan Suasana Akademik yang Kondusif',
        'document'          =>  null,
        'created_at'        =>  new DateTime,
        'updated_at'        =>  new DateTime,
        'deleted_at'        =>  null,
    ],
    
    //5.7.4
    [
        'instruction_id'    =>  '153',
        'no'                =>  'SPT-10/PM-01/SOP-05/FORM-04',
        'date'              =>  new DateTime,
        'description'       =>  'Form Interaksi Akademik Antara Dosen-Mahasiswa, Antar Mahasiswa, dan Antar Dosen',
        'document'          =>  null,
        'created_at'        =>  new DateTime,
        'updated_at'        =>  new DateTime,
        'deleted_at'        =>  null,
    ],
    
    //5.7.5
    [
        'instruction_id'    =>  '153',
        'no'                =>  'SPT-10/PM-01/SOP-05/FORM-05',
        'date'              =>  new DateTime,
        'description'       =>  'Form Pengembangan Prilaku Kecendikiawanan',
        'document'          =>  null,
        'created_at'        =>  new DateTime,
        'updated_at'        =>  new DateTime,
        'deleted_at'        =>  null,
    ],
    
    
    
    
    
    
    
    
    
    //6.5.1
    [
        'instruction_id'    =>  '154',
        'no'                =>  'SPT-11/PM-01/SOP-05/FORM-01',
        'date'              =>  new DateTime,
        'description'       =>  'Form Penjelasan Sistem Informasi dan Fasilitas yang Digunakan Oleh Program Studi',
        'document'          =>  null,
        'created_at'        =>  new DateTime,
        'updated_at'        =>  new DateTime,
        'deleted_at'        =>  null,
    ],
    
    //6.5.2
    [
        'instruction_id'    =>  '154',
        'no'                =>  'SPT-11/PM-01/SOP-05/FORM-02',
        'date'              =>  new DateTime,
        'description'       =>  'Form Sistem Informasi',
        'document'          =>  null,
        'created_at'        =>  new DateTime,
        'updated_at'        =>  new DateTime,
        'deleted_at'        =>  null,
    ],
    
    
    
    
    
    
    
    
    //7.3.1
    [
        'instruction_id'    =>  '155',
        'no'                =>  'SPT-12/PM-01/SOP-05/FORM-01',
        'date'              =>  new DateTime,
        'description'       =>  'Form Instansi Dalam Negeri yang Menjalin Kerjasama (WR 4 Prodi)',
        'document'          =>  null,
        'created_at'        =>  new DateTime,
        'updated_at'        =>  new DateTime,
        'deleted_at'        =>  null,
    ],
    
    //7.3.2
    [
        'instruction_id'    =>  '155',
        'no'                =>  'SPT-12/PM-01/SOP-05/FORM-02',
        'date'              =>  new DateTime,
        'description'       =>  'Form Instansi Luar Negeri yang Menjalin Kerjasama (WR 4 Prodi)',
        'document'          =>  null,
        'created_at'        =>  new DateTime,
        'updated_at'        =>  new DateTime,
        'deleted_at'        =>  null,
    ],
    

    
];