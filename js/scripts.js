$(document).ready(function() {
    $('.lazy').slick({
        lazyLoad: 'ondemand',
        slidesToShow: 3,
        slidesToScroll: 3,
        autoplay: true,
        autoplaySpeed: 3000,
		responsive: [{
            breakpoint: 1199,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 3,
                infinite: true,
            }
        },
		 {
            breakpoint: 1199,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 3
            }
        },
		{
            breakpoint: 992,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 2
            }
        },
		{
            breakpoint: 768,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        }
		
		
		]
    });
	$('.lazy-clients').slick({
        lazyLoad: 'ondemand',
        slidesToShow: 5,
        slidesToScroll: 5,
        autoplay: true,
        autoplaySpeed: 3000,
		responsive: [{
            breakpoint: 1199,
            settings: {
                slidesToShow: 5,
                slidesToScroll: 5,
                infinite: true,
            }
        },
		 {
            breakpoint: 1199,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 3
            }
        },
		{
            breakpoint: 992,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 3
            }
        },
		{
            breakpoint: 768,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 3
            }
        },
		
		{
            breakpoint: 650,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 2
            }
        },
		 {
			
            breakpoint: 400,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
			
        }]
    });
	
});

	
