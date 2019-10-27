module.exports = function(app){

	$(function () {
		//BOOTSTRAP TOOOOLTIP!!!
		try{
			$('[data-toggle="tooltip"]').tooltip();
		}catch(e){
			console.log("tooltip disabled - runtime error");
		}
	})

	/*$(window).ready(function(){
		$('[data-toggle="tooltip"]').tooltip();
	});*/

}