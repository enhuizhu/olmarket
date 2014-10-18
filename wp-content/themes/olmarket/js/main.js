var myCarousel = null;

jQuery(document).ready(function(){
    myCarousel = jQuery(".cases-container").slideCarousel({
    	auto:true,
    	speed:500,
    	left:jQuery("#carLeft"),
    	right:jQuery("#carRight")
    });
});