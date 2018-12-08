/* JS for Witub site */
var $j = jQuery.noConflict();

$j(document).ready(function()
{
	"use strict";

	var menuActive = false;

	initMenu();

    /**
	 *  Init Menu
	 **/
	function initMenu()
	{
		if($j('.hamburger').length)
		{
			var hamb = $j('.hamburger');

			hamb.on('click', function(event)
			{
				event.stopPropagation();

				if(!menuActive)
				{
					openMenu();
					
					$j(document).one('click', function cls(e)
					{
						if($j(e.target).hasClass('menu_mm'))
						{
							$j(document).one('click', cls);
						}
						else
						{
							closeMenu();
						}
					});
				}
				else
				{
					$j('.menu').removeClass('active');
					menuActive = false;
				}
			});
		}
	}

	function openMenu()
	{
		var fs = $j('.menu');
		fs.addClass('active');
		menuActive = true;
	}

	function closeMenu()
	{
		var fs = $j('.menu');
		fs.removeClass('active');
		menuActive = false;
	}

});