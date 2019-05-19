module.exports = function(app) {
	app.controller('ResendemailController', ['$scope', '$http', 'API_URL', 'BASE_URL', 'AJAX_URL', '$window',
		function($scope, $http, API_URL, BASE_URL, AJAX_URL, $window) {
			$scope.resenderror = "";

			$scope.resendemail = function($email) {
				$http(
					{
						method: 'POST',
						url: API_URL + 'resendverif',
						data: {
							'email' : $email
						}
					}).then(function(response) {
						if (response.data != null) {
							if(typeof response.data == "string"){
								if(response.data == "success"){
									$scope.resenderror = "Email verifikasi telah dikirim sesuai email Anda yang terdaftar. Mohon periksa email Anda (inbox ataupun spam) untuk verifikasi akun."
								}
								else{
									$scope.resenderror = response.data;
								}
							}
						}
					}, function(error){
							if(error.statusText == "Internal Server Error"){
								$scope.resenderror = "Tidak ada koneksi ke server. Hal ini bisa disebabkan gangguan pada server atau periksa kembali koneksi jaringan Anda, pastikan tersambung."
							}
					});
			}



			$scope.verifycode = function(){
				$code = $('#code').val();

				if ($code.length == 4) {

					$http({
						method: "POST",
						url: AJAX_URL + "verifycode",
						data: {
							'code': $code
						}
					}).then(function(response) {
						if (response == null) {
							$scope.resenderror = "ERROR";
						} else {
							$scope.resenderror = response.data;
							if(response.data == "success"){
								$scope.resenderror = "Akun telah diaktifkan, akan segera ke redirect ke halaman awal setelah 5 detik..";
								setTimeout(
									function() { 
										$window.location.href=BASE_URL+"home";
									}, 5000
								);
							}

						}
					}, function(error){
							console.log(error);
					});
				} else {
					$scope.resenderror = "Harus 4 Digits!";
				}
			}
		}
	]);
}