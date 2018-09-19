module.exports = function(app){
	$(window).on('scroll', function(event) {
	    var scrollValue = $(window).scrollTop();
	    if($(window).width()>767)
	    {
			if($(window).width()<992) $panelsummaryheight = $('.hidden-lg-up .panel-summary').height();
			else $panelsummaryheight = $('.hidden-md-down .panel-summary').height();
			$palingbawah = $(document).height()-$panelsummaryheight-$('.footer').height()-50;
			if (scrollValue > $('.pageheader').height()) {
		    	if (scrollValue < $palingbawah-20-50)
		    	{
		    		$('.panel-summary').css({top:20});
		        	$('.panel-summary').addClass('fixed');
		        }
		        else
		        {
		        	$('.panel-summary').css({top:$palingbawah-scrollValue-50})
		        }
		    } 
		    else
		    {
		    	$('.panel-summary').removeClass('fixed');
		    }
		}
		else
		{
			$batasbawah = $(document).height()-$('.footer').height()-$(window).height()-$('.panel-summary-sm-wrapper').height();
			if(scrollValue < $batasbawah)
			{
				$('.panel-summary-sm').addClass('fixed');
				$('.panel-summary-sm-wrapper .btn-relative').addClass('hide');
			}
			else
			{
				$('.panel-summary-sm').removeClass('fixed');
				$('.panel-summary-sm-wrapper .btn-relative').removeClass('hide');
			}
		}
	});
}