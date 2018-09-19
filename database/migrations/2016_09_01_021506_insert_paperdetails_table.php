<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertPaperdetailsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::unprepared("
			INSERT INTO paperdetails VALUES ('0', '1', '1', '1', '354105', '367220', '734.44', 'lembar', '500', '1', now(), now());
			INSERT INTO paperdetails VALUES ('0', '2', '1', '1', '424926', '440664', '881.328', 'lembar', '500', '1', now(), now());
			INSERT INTO paperdetails VALUES ('0', '3', '1', '1', '531157.5', '550830', '1101.66', 'lembar', '500', '1', now(), now());
			INSERT INTO paperdetails VALUES ('0', '1', '1', '2', '362340', '375760', '751.52', 'lembar', '500', '1', now(), now());
			INSERT INTO paperdetails VALUES ('0', '2', '1', '2', '434808', '450912', '901.824', 'lembar', '500', '1', now(), now());
			INSERT INTO paperdetails VALUES ('0', '3', '1', '2', '543510', '563640', '1127.28', 'lembar', '500', '1', now(), now());
			INSERT INTO paperdetails VALUES ('0', '1', '1', '3', '378810', '392840', '785.68', 'lembar', '500', '1', now(), now());
			INSERT INTO paperdetails VALUES ('0', '2', '1', '3', '454572', '471408', '942.816', 'lembar', '500', '1', now(), now());
			INSERT INTO paperdetails VALUES ('0', '3', '1', '3', '568215', '589260', '1178.52', 'lembar', '500', '1', now(), now());
			INSERT INTO paperdetails VALUES ('0', '1', '1', '4', '394875', '409500', '819', 'lembar', '500', '1', now(), now());
			INSERT INTO paperdetails VALUES ('0', '2', '1', '4', '473850', '491400', '982.8', 'lembar', '500', '1', now(), now());
			INSERT INTO paperdetails VALUES ('0', '3', '1', '4', '592312.5', '614250', '1228.5', 'lembar', '500', '1', now(), now());
			INSERT INTO paperdetails VALUES ('0', '1', '1', '5', '438750', '455000', '910', 'lembar', '500', '1', now(), now());
			INSERT INTO paperdetails VALUES ('0', '2', '1', '5', '526500', '546000', '1092', 'lembar', '500', '1', now(), now());
			INSERT INTO paperdetails VALUES ('0', '3', '1', '5', '658125', '682500', '1365', 'lembar', '500', '1', now(), now());
			INSERT INTO paperdetails VALUES ('0', '2', '1', '6', '697491', '723324', '1446.648', 'lembar', '500', '1', now(), now());
			INSERT INTO paperdetails VALUES ('0', '3', '1', '6', '871863.75', '904155', '1808.31', 'lembar', '500', '1', now(), now());
			INSERT INTO paperdetails VALUES ('0', '4', '1', '3', '826367', '853024', '1706.048', 'lembar', '500', '1', now(), now());
			INSERT INTO paperdetails VALUES ('0', '5', '1', '3', '913353', '942816', '1885.632', 'lembar', '500', '1', now(), now());
			INSERT INTO paperdetails VALUES ('0', '6', '1', '3', '1000339', '1032608', '2065.216', 'lembar', '500', '1', now(), now());
			INSERT INTO paperdetails VALUES ('0', '7', '1', '3', '1130818', '1167296', '2334.592', 'lembar', '500', '1', now(), now());
			INSERT INTO paperdetails VALUES ('0', '8', '1', '3', '1348283', '1391776', '2783.552', 'lembar', '500', '1', now(), now());
			INSERT INTO paperdetails VALUES ('0', '4', '1', '4', '861412.5', '889200', '1778.4', 'lembar', '500', '1', now(), now());
			INSERT INTO paperdetails VALUES ('0', '5', '1', '4', '952087.5', '982800', '1965.6', 'lembar', '500', '1', now(), now());
			INSERT INTO paperdetails VALUES ('0', '6', '1', '4', '1042762.5', '1076400', '2152.8', 'lembar', '500', '1', now(), now());
			INSERT INTO paperdetails VALUES ('0', '7', '1', '4', '1178775', '1216800', '2433.6', 'lembar', '500', '1', now(), now());
			INSERT INTO paperdetails VALUES ('0', '8', '1', '4', '1405462.5', '1450800', '2901.6', 'lembar', '500', '1', now(), now());
			INSERT INTO paperdetails VALUES ('0', '9', '1', '4', '1586812.5', '1638000', '3276', 'lembar', '500', '1', now(), now());
			INSERT INTO paperdetails VALUES ('0', '4', '1', '5', '957125', '988000', '1976', 'lembar', '500', '1', now(), now());
			INSERT INTO paperdetails VALUES ('0', '5', '1', '5', '1057875', '1092000', '2184', 'lembar', '500', '1', now(), now());
			INSERT INTO paperdetails VALUES ('0', '6', '1', '5', '1158625', '1196000', '2392', 'lembar', '500', '1', now(), now());
			INSERT INTO paperdetails VALUES ('0', '7', '1', '5', '1309750', '1352000', '2704', 'lembar', '500', '1', now(), now());
			INSERT INTO paperdetails VALUES ('0', '8', '1', '5', '1561625', '1612000', '3224', 'lembar', '500', '1', now(), now());
			INSERT INTO paperdetails VALUES ('0', '9', '1', '5', '1763125', '1820000', '3640', 'lembar', '500', '1', now(), now());
			INSERT INTO paperdetails VALUES ('0', '4', '1', '6', '1267969.75', '1308872', '2617.744', 'lembar', '500', '1', now(), now());
			INSERT INTO paperdetails VALUES ('0', '5', '1', '6', '1401440.25', '1446648', '2893.296', 'lembar', '500', '1', now(), now());
			INSERT INTO paperdetails VALUES ('0', '6', '1', '6', '1534910.75', '1584424', '3168.848', 'lembar', '500', '1', now(), now());
			INSERT INTO paperdetails VALUES ('0', '7', '1', '6', '1735116.5', '1791088', '3582.176', 'lembar', '500', '1', now(), now());
			INSERT INTO paperdetails VALUES ('0', '8', '1', '6', '2068792.75', '2135528', '4271.056', 'lembar', '500', '1', now(), now());
			INSERT INTO paperdetails VALUES ('0', '9', '1', '6', '2335733.75', '2411080', '4822.16', 'lembar', '500', '1', now(), now());
			INSERT INTO paperdetails VALUES ('0', '10', '1', '1', '262562.3', '271742.8', '543.4856', 'lembar', '500', '1', now(), now());
			INSERT INTO paperdetails VALUES ('0', '11', '1', '1', '300071.2', '310563.2', '621.1264', 'lembar', '500', '1', now(), now());
			INSERT INTO paperdetails VALUES ('0', '12', '1', '1', '375089', '388204', '776.408', 'lembar', '500', '1', now(), now());
			INSERT INTO paperdetails VALUES ('0', '10', '1', '2', '268668.4', '278062.4', '556.1248', 'lembar', '500', '1', now(), now());
			INSERT INTO paperdetails VALUES ('0', '11', '1', '2', '307049.6', '317785.6', '635.5712', 'lembar', '500', '1', now(), now());
			INSERT INTO paperdetails VALUES ('0', '12', '1', '2', '383812', '397232', '794.464', 'lembar', '500', '1', now(), now());
			INSERT INTO paperdetails VALUES ('0', '10', '1', '3', '280880.6', '290701.6', '581.4032', 'lembar', '500', '1', now(), now());
			INSERT INTO paperdetails VALUES ('0', '11', '1', '3', '321006.4', '332230.4', '664.4608', 'lembar', '500', '1', now(), now());
			INSERT INTO paperdetails VALUES ('0', '12', '1', '3', '401258', '415288', '830.576', 'lembar', '500', '1', now(), now());
			INSERT INTO paperdetails VALUES ('0', '10', '1', '4', '292792.5', '303030', '606.06', 'lembar', '500', '1', now(), now());
			INSERT INTO paperdetails VALUES ('0', '11', '1', '4', '334620', '346320', '692.64', 'lembar', '500', '1', now(), now());
			INSERT INTO paperdetails VALUES ('0', '12', '1', '4', '418275', '432900', '865.8', 'lembar', '500', '1', now(), now());
			INSERT INTO paperdetails VALUES ('0', '10', '1', '5', '325325', '336700', '673.4', 'lembar', '500', '1', now(), now());
			INSERT INTO paperdetails VALUES ('0', '11', '1', '5', '371800', '384800', '769.6', 'lembar', '500', '1', now(), now());
			INSERT INTO paperdetails VALUES ('0', '12', '1', '5', '464750', '481000', '962', 'lembar', '500', '1', now(), now());
			INSERT INTO paperdetails VALUES ('0', '10', '1', '6', '430980.55', '446049.8', '892.0996', 'lembar', '500', '1', now(), now());
			INSERT INTO paperdetails VALUES ('0', '11', '1', '6', '492549.2', '509771.2', '1019.5424', 'lembar', '500', '1', now(), now());
			INSERT INTO paperdetails VALUES ('0', '12', '1', '6', '615686.5', '637214', '1274.428', 'lembar', '500', '1', now(), now());
			INSERT INTO paperdetails VALUES ('0', '13', '1', '6', '1750000', '2250000', '4500', 'lembar', '500', '1', now(), now());
			INSERT INTO paperdetails VALUES ('0', '14', '1', '6', '1700000', '2500000', '5000', 'lembar', '500', '1', now(), now());
			INSERT INTO paperdetails VALUES ('0', '15', '10', '8', '400000', '500000', '1000', 'lembar', '500', '1', now(), now());
			INSERT INTO paperdetails VALUES ('0', '16', '10', '8', '600000', '750000', '1500', 'lembar', '500', '1', now(), now());
			INSERT INTO paperdetails VALUES ('0', '17', '10', '8', '1400000', '1650000', '3300', 'lembar', '500', '1', now(), now());
			INSERT INTO paperdetails VALUES ('0', '18', '10', '14', '40000', '50000', '100', 'lembar', '500', '1', now(), now());
			INSERT INTO paperdetails VALUES ('0', '19', '10', '14', '40000', '50000', '100', 'lembar', '500', '1', now(), now());
			INSERT INTO paperdetails VALUES ('0', '20', '10', '14', '40000', '50000', '100', 'lembar', '500', '1', now(), now());
			INSERT INTO paperdetails VALUES ('0', '21', '10', '14', '40000', '50000', '100', 'lembar', '500', '1', now(), now());
			INSERT INTO paperdetails VALUES ('0', '22', '10', '14', '40000', '50000', '100', 'lembar', '500', '1', now(), now());
			INSERT INTO paperdetails VALUES ('0', '18', '10', '15', '78000', '95000', '190', 'lembar', '500', '1', now(), now());
			INSERT INTO paperdetails VALUES ('0', '19', '10', '15', '78000', '95000', '190', 'lembar', '500', '1', now(), now());
			INSERT INTO paperdetails VALUES ('0', '20', '10', '15', '78000', '95000', '190', 'lembar', '500', '1', now(), now());
			INSERT INTO paperdetails VALUES ('0', '21', '10', '15', '78000', '95000', '190', 'lembar', '500', '1', now(), now());
			INSERT INTO paperdetails VALUES ('0', '22', '10', '15', '78000', '95000', '190', 'lembar', '500', '1', now(), now());
			INSERT INTO paperdetails VALUES ('0', '25', '14', '23', '374000', '486200', '8840', 'meter', '55', '1', now(), now());
			INSERT INTO paperdetails VALUES ('0', '25', '14', '27', '544000', '707200', '8840', 'meter', '80', '1', now(), now());
			INSERT INTO paperdetails VALUES ('0', '25', '14', '24', '748000', '972400', '8840', 'meter', '110', '1', now(), now());
			INSERT INTO paperdetails VALUES ('0', '25', '14', '25', '884000', '1149200', '8840', 'meter', '130', '1', now(), now());
			INSERT INTO paperdetails VALUES ('0', '25', '14', '26', '1088000', '1414400', '8840', 'meter', '160', '1', now(), now());
			INSERT INTO paperdetails VALUES ('0', '26', '14', '23', '357500', '464750', '8450', 'meter', '55', '0', now(), now());
			INSERT INTO paperdetails VALUES ('0', '26', '14', '27', '520000', '676000', '8450', 'meter', '80', '0', now(), now());
			INSERT INTO paperdetails VALUES ('0', '26', '14', '24', '715000', '929500', '8450', 'meter', '110', '0', now(), now());
			INSERT INTO paperdetails VALUES ('0', '26', '14', '25', '845000', '1098500', '8450', 'meter', '130', '0', now(), now());
			INSERT INTO paperdetails VALUES ('0', '26', '14', '26', '1040000', '1352000', '8450', 'meter', '160', '0', now(), now());
			INSERT INTO paperdetails VALUES ('0', '27', '14', '23', '770000', '1001000', '18200', 'meter', '55', '1', now(), now());
			INSERT INTO paperdetails VALUES ('0', '27', '14', '27', '1120000', '1456000', '18200', 'meter', '80', '1', now(), now());
			INSERT INTO paperdetails VALUES ('0', '27', '14', '24', '1540000', '2002000', '18200', 'meter', '110', '1', now(), now());
			INSERT INTO paperdetails VALUES ('0', '27', '14', '26', '2240000', '2912000', '18200', 'meter', '160', '1', now(), now());
			INSERT INTO paperdetails VALUES ('0', '28', '14', '20', '618750', '804375', '16250', 'meter', '49.5', '1', now(), now());
			INSERT INTO paperdetails VALUES ('0', '28', '14', '19', '873125', '1135062.5', '16250', 'meter', '69.85', '1', now(), now());
			INSERT INTO paperdetails VALUES ('0', '28', '14', '21', '1045000', '1358500', '16250', 'meter', '83.6', '1', now(), now());
			INSERT INTO paperdetails VALUES ('0', '29', '14', '20', '742500', '965250', '19500', 'meter', '49.5', '1', now(), now());
			INSERT INTO paperdetails VALUES ('0', '29', '14', '19', '1047750', '1362075', '19500', 'meter', '69.85', '1', now(), now());
			INSERT INTO paperdetails VALUES ('0', '29', '14', '21', '1254000', '1630200', '19500', 'meter', '83.6', '1', now(), now());
			INSERT INTO paperdetails VALUES ('0', '30', '14', '27', '960000', '1248000', '15600', 'meter', '80', '1', now(), now());
			INSERT INTO paperdetails VALUES ('0', '30', '14', '26', '1920000', '2496000', '15600', 'meter', '160', '1', now(), now());
			INSERT INTO paperdetails VALUES ('0', '32', '2', '10', '1930500', '2027025', '4054.05', 'lembar', '500', '1', now(), now());
			INSERT INTO paperdetails VALUES ('0', '38', '2', '10', '2365000', '2483250', '4966.5', 'lembar', '500', '1', now(), now());
			INSERT INTO paperdetails VALUES ('0', '33', '14', '17', '350000', '400000', '4000', 'lembar', '100', '1', now(), now());
			INSERT INTO paperdetails VALUES ('0', '35', '14', '17', '350000', '400000', '4000', 'lembar', '100', '1', now(), now());
			INSERT INTO paperdetails VALUES ('0', '37', '1', '10', '1900000', '1995000', '3990', 'lembar', '500', '1', now(), now());
			INSERT INTO paperdetails VALUES ('0', '38', '1', '10', '2400000', '2520000', '5040', 'lembar', '500', '1', now(), now());
		");
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
