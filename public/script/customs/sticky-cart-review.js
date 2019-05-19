module.exports = function(app){
	$(window).on('scroll', function(event) {
		if($('.cart-list').length > 0)
		{
			var scrollValue = $(window).scrollTop();

			var top = $('.cart-list').offset().top + $('.cart-list').height();
			var windowH = $(window).height();

			if (scrollValue <= top - windowH)
			{
				$(".cart-checkout-label").addClass('fixed');
			}
			else
			{
				$('.cart-checkout-label').removeClass('fixed');
			}
		}
	});
}