module.exports = function(app){
	$(window).on('scroll', function(event) {
		if($('.order-panel-summary').length > 0)
		{
			var scrollValue = $(window).scrollTop();

			var top = $('.order-panel-summary').offset().top + $('.order-panel-summary').height()+100;
			var windowH = $(window).height();
			var toleransi = $('.order-panel-summary').height() + 20;

			if (scrollValue <= top - windowH - toleransi)
			{
				$(".summary-panel").addClass('fixed');
			}
			else if(scrollValue > top - windowH + toleransi)
			{
				$('.summary-panel').removeClass('fixed');
			}
		}
	});
}