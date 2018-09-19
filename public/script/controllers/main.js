module.exports = function(app){

	$(function () {
		//BOOTSTRAP TOOOOLTIP!!!
		$('[data-toggle="tooltip"]').tooltip();
		//LOGIN - SET FOCUS ON FIRST SHOWN
		$('#loginModal').on('shown.bs.modal', function () {
		    $('#login-username').focus();
		    $('#login-username').val("");
		    $('#login-password').val("");
		    $('#signup-modal').modal('hide');
		});
	})

}