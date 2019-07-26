module.exports = function(app){

	$(function () {
		//BOOTSTRAP TOOOOLTIP!!!
		try{
			$('[data-toggle="tooltip"]').tooltip();
		}catch(e){
			console.log("tooltip disabled - runtime error");
		}
		//LOGIN - SET FOCUS ON FIRST SHOWN
		$('#loginModal').on('shown.bs.modal', function () {
		    $('#login-username').focus();
		    $('#login-username').val("");
		    $('#login-password').val("");
		    $('#signup-modal').modal('hide');
		});
	})

}