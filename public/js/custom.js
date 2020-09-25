$(document).ready(function() {



		$(".custom-select-with-search").customselect();




	$('.owl-carousel').owlCarousel({
		margin:10,
	    nav:true,
	    responsive:{
	        0:{
	            items:1
	        },
	        600:{
	            items:2
	        },
	        1000:{
	            items:4
	        }
	    }
	})



		$('.quantity-inc').click(function(){


	        var preV = $(this).parent().siblings('.quantity-input').val();


	        if(preV < 99){
	            preV++;
	            $(this).parent().siblings('.quantity-input').val(preV);
	        }
	    })

	    $('.quantity-dec').click(function(){


	        var nextV = $(this).parent().siblings('.quantity-input').val();



	        if(nextV > 1){
	            nextV--;
	            $(this).parent().siblings('.quantity-input').val(nextV);
	        }

	    })


	    $(".quantity-input").blur(function(){
	        if($(this).val() <= 0){
	            $(this).val(1);
	            alert("Invalid Quantity.");
	        }else if($(this).val() >= 99){
	            $(this).val(99);
	            alert("Invalid Quantity.");
	        }
	    })





});



