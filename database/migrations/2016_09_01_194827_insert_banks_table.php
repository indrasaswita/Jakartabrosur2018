<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

class InsertBanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('banks')->insert(['bankname'=>'BANK INDONESIA', 'code'=>'0010016', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'BANK RAKYAT INDONESIA', 'code'=>'0020307', 'alias'=>'BRI', 'logo'=> 'BRI', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'BANK EKSPOR INDONESIA', 'code'=>'0030012', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'BANK MANDIRI', 'code'=>'0080606', 'alias'=>'Mandiri', 'logo'=> 'MANDIRI', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'BANK NEGARA INDONESIA 1946', 'code'=>'0090010', 'alias'=>'BNI 46', 'logo'=> 'BNI', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'BNI SYARIAH', 'code'=>'0090010', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'BANK DANAMON INDONESIA', 'code'=>'0111274', 'alias'=>'Danamon', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'BANK PERMATA', 'code'=>'0130307', 'alias'=>'Permata', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'BANK CENTRAL ASIA', 'code'=>'0140012', 'alias'=>'BCA', 'logo'=> 'BCA', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'BANK INTERNATIONAL INDONESIA', 'code'=>'0160131', 'alias'=>'BII', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'BANK PAN INDONESIA', 'code'=>'0190017', 'alias'=>'PANIN', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'BANK NIAGA', 'code'=>'0220026', 'alias'=>'Niaga', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'BANK UOB BUANA', 'code'=>'0230016', 'alias'=>'UOB', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'LIPPO BANK', 'code'=>'0261399', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'BANK NILAI INTI SARI PENJIMPAN', 'code'=>'0280024', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'AMERICAN EXPRESS BANK', 'code'=>'0300302', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'CITIBANK NA', 'code'=>'0310305', 'alias'=>'Citibank', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'JPMORGAN CHASE BANK', 'code'=>'0320308', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'BANK OF AMERICA', 'code'=>'0330301', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'BANK WINDU KENTJANA INTERNASIONAL', 'code'=>'0360300', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'PT. BANK ARTHA GRAHA INTERNASIONAL', 'code'=>'0370028', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'THE BANGKOK BANK PCL', 'code'=>'0400309', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'THE HONGKONG and SHANGHAI BANKING CORP', 'code'=>'0410302', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'THE BANK OF TOKYO MITSUBISHI UFJ', 'code'=>'0420305', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'BANK SUMITOMO MITSUI INDONESIA', 'code'=>'0450304', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'BANK DBS INDONESIA', 'code'=>'0460307', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'BANK RESONA PERDANIA', 'code'=>'0470300', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'BANK MIZUHO INDONESIA', 'code'=>'0480303', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'STANDARD CHARTERED BANK', 'code'=>'0500306', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'ALGEMENE BANK NEDERLAND AMRO BANK N.V.', 'code'=>'0520302', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'BANK CAPITAL INDONESIA', 'code'=>'0540308', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'BANK BNP PARIBAS INDONESIA', 'code'=>'0570307', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'BANK UOB INDONESIA', 'code'=>'0580300', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'KOREA EXCHANGE BANK DANAMON INDONESIA', 'code'=>'0590303', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'BANK RABOBANK INTERNATIONAL INDONESIA', 'code'=>'0600303', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'ANZ PANIN BANK', 'code'=>'0610306', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'DEUTSCHE BANK AG', 'code'=>'0670304', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'BANK WOORI INDONESIA', 'code'=>'0680307', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'BANK OF CHINA LIMITED', 'code'=>'0690300', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'BANK BUMI ARTA', 'code'=>'0760010', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'BANK EKONOMI RAHARJA', 'code'=>'0870010', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'BANK ANTAR DAERAH', 'code'=>'0880055', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'HAGABANK INDONESIA', 'code'=>'0890016', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'BANK IFI', 'code'=>'0930015', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'BANK CENTURY', 'code'=>'0950011', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'BANK MAYAPADA INTERNATIONAL', 'code'=>'0970017', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'BANK PEMBANGUNAN DAERAH JAWA BARAT / JABAR DAN BANTEN', 'code'=>'1100093', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'BANK PEMBANGUNAN DAERAH DKI JAKARTA / BANK DKI', 'code'=>'1110164', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'BANK PEMBANGUNAN DAERAH DIY / YOGYAKARTA', 'code'=>'1120015', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'BANK PEMBANGUNAN DAERAH JAWA TENGAH', 'code'=>'1130348', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'BANK PEMBANGUNAN DAERAH JATIM', 'code'=>'1140383', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'BANK PEMBANGUNAN DAERAH JAMBI', 'code'=>'1150014', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'BPD ISTIMEWA ACEH', 'code'=>'1160033', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'BANK PEMBANGUNAN DAERAH SUMUT', 'code'=>'1170201', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'BANK PEMBANGUNAN DAERAH SUMATERA BARAT / BANK NAGARI', 'code'=>'1180259', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'BANK PEMBANGUNAN DAERAH RIAU', 'code'=>'1190016', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'BANK PEMBANGUNAN DAERAH SUMATERA SELATAN', 'code'=>'1200142', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'BANK PEMBANGUNAN DAERAH LAMPUNG', 'code'=>'1210051', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'BANK PEMBANGUNAN DAERAH KALIMANTAN SELATAN', 'code'=>'1220012', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'BANK PEMBANGUNAN DAERAH KALIMANTAN BARAT', 'code'=>'1230015', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'BANK PEMBANGUNAN DAERAH KALIMANTAN TIMUR', 'code'=>'1240018', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'BANK PEMBANGUNAN DAERAH KALTENG', 'code'=>'1250011', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'BANK PEMBANGUNAN DAERAH SULAWESI SELATAN', 'code'=>'1260027', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'BANK PEMBANGUNAN DAERAH SULAWESI UTARA', 'code'=>'1270091', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'BANK PEMBANGUNAN DAERAH NTB / NUSA TENGGARA BARAT', 'code'=>'1280010', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'BANK PEMBANGUNAN DAERAH BALI', 'code'=>'1290013', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'BANK PEMBANGUNAN DAERAH NUSA TENGGARA TIMUR', 'code'=>'1300013', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'BANK PEMBANGUNAN DAERAH MALUKU', 'code'=>'1310016', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'BANK PEMBANGUNAN DAERAH PAPUA', 'code'=>'1320019', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'BPD BENGKULU', 'code'=>'1330012', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'BANK PEMBANGUNAN DAERAH SULAWESI TENGAH', 'code'=>'1340015', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'BANK PEMBANGUNAN DAERAH SULAWESI TENGGARA', 'code'=>'1350018', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'BANK NUSANTARA PARAHYANGAN', 'code'=>'1450028', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'BANK SWADESI', 'code'=>'1460021', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'BANK MUAMALAT INDONESIA', 'code'=>'1470011', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'BANK MESTIKA DHARMA', 'code'=>'1510049', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'BANK METRO EKSPRESS', 'code'=>'1520013', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'BANK SINARMAS', 'code'=>'1530016', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'BANK MASPION INDONESIA', 'code'=>'1570021', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'BANK HAGAKITA', 'code'=>'1590014', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'BANK GANESHA', 'code'=>'1610017', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'HALIM INDONESIA BANK', 'code'=>'1640058', 'alias'=>'ICBC', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'BANK HARMONI INTERNASIONAL', 'code'=>'1660012', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'BANK KESAWAN', 'code'=>'1670099', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'BANK TABUNGAN NEGARA', 'code'=>'2000024', 'alias'=>'BTN', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'BANK HIMPUNAN SAUDARA 1906', 'code'=>'2120027', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'BANK TABUNGAN PENSIUNAN NASIONAL', 'code'=>'2130101', 'alias'=>'BTPN', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'BANK SWAGUNA', 'code'=>'4050072', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'BANK JASA ARTA', 'code'=>'4220051', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'BANK MEGA', 'code'=>'4260176', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'BANK UMUM KOPERASI INDONESIA', 'code'=>'4410010', 'alias'=>'Bukopin', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'BANK SYARIAH MANDIRI', 'code'=>'4510017', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'BANK BISNIS INTERNATIONAL', 'code'=>'4590037', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'BANK SRI PARTHA', 'code'=>'4660019', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'BANK JASA JAKARTA', 'code'=>'4720014', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'BANK BINTANG MANUNGGAL', 'code'=>'4840017', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'BANK BUMI PUTERA', 'code'=>'4850010', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'BANK YUDHA BHAKTI', 'code'=>'4900012', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'BANK MITRANIAGA', 'code'=>'4910015', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'AGRONIAGA BANK', 'code'=>'4940014', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'BANK INDOMONEX', 'code'=>'4980016', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'BANK ROYAL INDONESIA', 'code'=>'5010011', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'ALFINDO SEJAHTERA BANK / BANK ALFINDO', 'code'=>'5030017', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'BANK SYARIAH MEGA INDONESIA', 'code'=>'5060016', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'BANK INA PERDANA', 'code'=>'5130014', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'BANK HARFA', 'code'=>'5170016', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'PRIMA MASTER BANK', 'code'=>'5200025', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'BANK PERSYARIKATAN INDONESIA', 'code'=>'5210031', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'BANK DIPO INTERNATIONAL', 'code'=>'5230011', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'BANK AKITA', 'code'=>'5250046', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'BANK LIMAN INTERNATIONAL', 'code'=>'5260010', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'ANGLOMAS INTERNATIONAL BANK', 'code'=>'5310012', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'BANK KESEJAHTERAAN EKONOMI', 'code'=>'5350014', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'BANK UIB', 'code'=>'5360017', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'BANK ARTOS INDONESIA', 'code'=>'5420025', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'BANK PURBA DANARTA', 'code'=>'5470017', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'BANK MULTIARTA SENTOSA', 'code'=>'5480010', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'BANK MAYORA INDONESIA', 'code'=>'5530012', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'BANK INDEX SELINDO', 'code'=>'5550018', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'BANK EKSEKUTIF INTERNASIONAL', 'code'=>'5580017', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'CENTRATAMA NASIONAL BANK', 'code'=>'5590036', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'BANK FAMA INTERNATIONAL', 'code'=>'5620029', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'BANK SINAR HARAPAN BALI', 'code'=>'5640012', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'BANK VICTORIA INTERNATIONAL', 'code'=>'5660018', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'BANK HARDA INTERNASIONAL', 'code'=>'5670011', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'BANK FINCONESIA', 'code'=>'9450305', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'BANK MAYBANK INDOCORP', 'code'=>'9470301', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'BANK OCBC INDONESIA', 'code'=>'9480304', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'BANK CHINATRUST INDONESIA', 'code'=>'9490307', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        DB::table('banks')->insert(['bankname'=>'BANK COMMONWEALTH', 'code'=>'9500307', 'alias'=>'', 'logo'=> '', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
