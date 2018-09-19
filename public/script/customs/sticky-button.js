module.exports = function(app){
	$(window).on('scroll', function(event) {
		var scrollValue = $(window).scrollTop();
		var selisih = 120;
		//alert("scroll : " + scrollValue);
		var footer = $('.footer').height();
		//console.log($(document).height()-$(window).height()-65-footer);

		if (scrollValue < $(document).height()-$(window).height()-65-footer)
		{
			$('#btn-next').css({top:$(window).height() - 65, left:$(window).width()-65});
			$('#btn-prev').css({top:$(window).height() - 65, left:15});
			//console.log('gantung', $(window).height() - 65);
		}
		else
		{
			$('#btn-next').css({top:$(window).height()-scrollValue+($(document).height()-$(window).height()-65-65-footer), left:$(window).width()-65});
			$('#btn-prev').css({top:$(window).height()-scrollValue+($(document).height()-$(window).height()-65-65-footer), left:15});
			//console.log('dibawah '+($(window).height()-scrollValue+900));
		}

	});
}