<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SemuaNotifBroooh extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::unprepared("
			CREATE TABLE notifications (
				id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
				owner VARCHAR(8) NULL COMMENT 'EM:employee, CU:customer',
				ownerID INT UNSIGNED NULL COMMENT 'kalo null, brarti buat global notif',
				icon VARCHAR(64) NULL,
				title VARCHAR(32) NOT NULL,
				content VARCHAR(512) NOT NULL,
				viewed TINYINT,
				created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
				updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
				deleted_at TIMESTAMP NULL
			);

			INSERT INTO notifications (owner, ownerID, icon, title, content, viewed, created_at, updated_at, deleted_at) VALUES ('EM', '1', 'fas fa-directions tx-success', 'notification', 'This is the notification you can read about the detail of your printing progress. Everythings new will update very soon and up to date. For extra service, you can install our applications (free) from Google Play apps. Save your time with us now.', '0', now(), now(), null);
			INSERT INTO notifications (owner, ownerID, icon, title, content, viewed, created_at, updated_at, deleted_at) VALUES ('EM', '1', 'fas fa-directions tx-danger', 'Gebyar BCA', 'Ini adalah notifikasi yang dapat anda baca tentang proses pencetakan dan detail cetakan. Segala perubahan mengenai pencetakan akan di <i>update</i> sesegera mungkin. Untuk pelayanan lebih lanjut, silahkan men-<i>download</i> aplikasi kami di aplikasi Google Play. Hemat waktu bersama kami.', '1', now(), now(), null);
			INSERT INTO notifications (owner, ownerID, icon, title, content, viewed, created_at, updated_at, deleted_at) VALUES ('EM', '2', 'fas fa-question-circle tx-lightgray', 'gebyar gebyra gebyra', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', '0', now(), now(), null);
			INSERT INTO notifications (owner, ownerID, icon, title, content, viewed, created_at, updated_at, deleted_at) VALUES ('EM', '2', 'far fa-question-circle tx-lightmagenta', 'Hello owlrd!', 'It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '1', now(), now(), null);
			INSERT INTO notifications (owner, ownerID, icon, title, content, viewed, created_at, updated_at, deleted_at) VALUES ('CU', '1', 'fas fa-directions tx-success', 'Ini Judul', 'The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested.', '1', now(), now(), null);
			INSERT INTO notifications (owner, ownerID, icon, title, content, viewed, created_at, updated_at, deleted_at) VALUES ('CU', '2', 'fas fa-directions tx-danger', 'Makan Dulu', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.', '0', now(), now(), null);
			INSERT INTO notifications (owner, ownerID, icon, title, content, viewed, created_at, updated_at, deleted_at) VALUES ('CU', '1', 'fas fa-question-circle tx-lightgray', 'Kenyang Bego', 'The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English.', '0', now(), now(), null);
			INSERT INTO notifications (owner, ownerID, icon, title, content, viewed, created_at, updated_at, deleted_at) VALUES ('CU', '2', 'far fa-question-circle tx-lightmagenta', 'Laper Galak', 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', '0', now(), now(), null);
			INSERT INTO notifications (owner, ownerID, icon, title, content, viewed, created_at, updated_at, deleted_at) VALUES ('CU', '3', 'fas fa-directions tx-success', 'Septi Dudul', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', '0', now(), now(), null);
			INSERT INTO notifications (owner, ownerID, icon, title, content, viewed, created_at, updated_at, deleted_at) VALUES ('CU', '4', 'fas fa-directions tx-danger', 'Septi Kentut', 'It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '0', now(), now(), null);
			INSERT INTO notifications (owner, ownerID, icon, title, content, viewed, created_at, updated_at, deleted_at) VALUES ('CU', '1', 'fas fa-question-circle tx-lightgray', 'Septi Monyong', 'The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested.', '0', now(), now(), null);
			INSERT INTO notifications (owner, ownerID, icon, title, content, viewed, created_at, updated_at, deleted_at) VALUES ('EM', '2', 'far fa-question-circle tx-lightmagenta', 'Septi Jelek', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.', '0', now(), now(), null);
			INSERT INTO notifications (owner, ownerID, icon, title, content, viewed, created_at, updated_at, deleted_at) VALUES ('EM', '1', 'fas fa-directions tx-success', 'Septi Kentut', 'The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English.', '0', now(), now(), null);
			INSERT INTO notifications (owner, ownerID, icon, title, content, viewed, created_at, updated_at, deleted_at) VALUES ('EM', null, 'fas fa-directions tx-danger', 'Monyet Daur Ulang', 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', '0', now(), now(), null);
			INSERT INTO notifications (owner, ownerID, icon, title, content, viewed, created_at, updated_at, deleted_at) VALUES ('EM', null, 'fas fa-question-circle tx-lightgray', 'Teh kotak', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', '0', now(), now(), null);
			INSERT INTO notifications (owner, ownerID, icon, title, content, viewed, created_at, updated_at, deleted_at) VALUES ('CU', null, 'far fa-question-circle tx-lightmagenta', 'burger king', 'It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '0', now(), now(), null);
			INSERT INTO notifications (owner, ownerID, icon, title, content, viewed, created_at, updated_at, deleted_at) VALUES ('CU', null, 'fas fa-directions tx-success', 'burger blenger', 'The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested.', '0', now(), now(), null);
			INSERT INTO notifications (owner, ownerID, icon, title, content, viewed, created_at, updated_at, deleted_at) VALUES ('CU', null, 'fas fa-directions tx-danger', 'burger flip flip', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.', '0', now(), now(), null);
			INSERT INTO notifications (owner, ownerID, icon, title, content, viewed, created_at, updated_at, deleted_at) VALUES ('CU', null, 'fas fa-question-circle tx-lightgray', 'burger mcd', 'The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English.', '0', now(), now(), null);
		");
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('notifications');
	}
}
