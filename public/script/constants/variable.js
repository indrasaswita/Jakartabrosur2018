module.exports = function(app){
	$public_path = '/jakartabrosur3/public/'; 
	// LOCALHOST PAKAI yang 'jakartabrosur/public/'
	
	//$public_path = '/'; 
	// UPLOAD PAKAI yg '/'

	app.constant("BASE_URL", $public_path);
	app.constant("API_URL", $public_path+'API/');
}