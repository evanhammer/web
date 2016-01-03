
$(document).ready(function($){

	//generic mailing list form setup
	var pulldownHeight = "18em"; //160px
	//200px 18em for ie [OLD]
	$('#innerMain').css({display: 'none'});
	//$('#functContainer').css({display: 'block'});
	$('#functMain').css({height: '2em'});
	
	if($.browser.msie && $.browser.version < 7){
		$("#innerFunctImg").click(function(){
			$('#functImg').css({'cursor' : 'default'});
			$('#innerFunctImg').fadeOut('slow');
			$('#innerMain').fadeIn('slow');
		});
	} else {
		$("#innerFunctImg").click(function(){
			//$('#functImg').css({'cursor' : 'default'});
			$('#innerFunctImg').fadeOut('slow');
			$("#functMain").animate({ 
				"height": pulldownHeight
			}, 500, function() {
				$('#innerMain').fadeIn('slow');
			});
	  });
	}
	
	if($.browser.msie && $.browser.version < 7){
		$("#listHiderText").click(function(){
			$('#innerMain').fadeOut('slow');
			$('#innerFunctImg').fadeIn('slow');
			//$('#functImg').css({'cursor' : 'pointer'});
		});
	} else {
		$("#listHiderText").click(function(){
			$('#innerMain').fadeOut('slow');
			$("#functMain").animate({ 
				"height": '2em'
			}, 500, function() {
				$('#innerFunctImg').fadeIn('slow');
			});
			//$('#functImg').css({'cursor' : 'pointer'});
		});
	}
	
	//header mailing list form setup
	$("#functContainer #formSubmit").click(function() {
		return checkform(this.form);
	});
	
	$("#functContainer form").attr("target","_blank").submit(function() {
		//window.open('', this.target,'dialog,modal,scrollbars=no,resizable=no,width=550,height=300,left=0,top=0');
		$("#functContainer").fadeOut("slow");
	});
	
	//connect page mailing list form setup
	$("#connectMailContainer #formSubmit").click(function() {
		return checkform(this.form);
	});
	
	$("#connectMailContainer form").attr("target","_blank");//.submit(function() {
	//	window.open('', this.target,'dialog,modal,scrollbars=no,resizable=no,width=550,height=300,left=0,top=0');
	//});
	
	//Inserted into Mailing List Helper JS
	//addFieldToCheck("email","Email");
	//addFieldToCheck("attribute19","Zipcode");
});