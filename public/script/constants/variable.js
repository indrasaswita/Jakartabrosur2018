module.exports = function(app){
	$public_path = '/jakartabrosur/public/'; 
	// LOCALHOST PAKAI yang 'jakartabrosur/public/'
	
	// $public_path = '/'; 
	// UPLOAD PAKAI yg '/'

	app.constant("BASE_URL", $public_path);
	app.constant("API_URL", $public_path+'API/');
	app.constant("AJAX_URL", $public_path+'AJAX/');
}