$(document).ready(function(){
	$("#productimage-autothumb").change(function() {
        if($(this).is(":checked"))
            $(".field-productimage-imagethumbfile").slideUp();
		else
			$(".field-productimage-imagethumbfile").slideDown();
    });
	
	$("#productimage-autocover").change(function() {
        if($(this).is(":checked"))
            $(".field-productimage-imagecoverfile").slideUp();
		else
			$(".field-productimage-imagecoverfile").slideDown();
    });
	
	$("#productimage-autothumb").change();
	$("#productimage-autocover").change();
	
	$('.colorpickers').colorpicker();
	
	$(".form-remove-pic-button").click(function(e){
		e.preventDefault();
		
		if ($(this).parent().find("input[type='hidden']").length > 0) {
			$(this).parent().find("input[type='hidden']").val("");
			$(this).parent().hide();
		}
	});
});