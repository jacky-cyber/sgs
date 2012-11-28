/**=============================================================================
 *
 *	Filename:  function.ajax.js
 *	
 *	(c)Autor: Arkos Noem Arenom
 *	
 *	Description: Ajax para hacer las consultas
 *	
 *	Licence: GPL|LGPL
 *	
 *===========================================================================**/

$(document).ready(function(){
	
	var timeSlide = 500;
	$('#login').focus();
	$('#timer').hide(0);
	$('#timer').css('display','none');
	$('#Ingresar').click(function(){
	
		img1 = new Image();
		img1.src = "images/ajax-loader.gif";
		$('#span_loader').html('');
		$('#span_loader').html(img1);	
							
	
		$('#timer').fadeIn(300);
		$('.box-info, .box-success, .box-alert, .box-error').slideUp(timeSlide);
		setTimeout(function(){
			if ( $('#login').val() != "" && $('#password').val() != "" ){
				var valorCheck=0;
				if($('#remember').is(':checked')) 
					valorCheck=1;
				$.ajax({
					type: 'POST',
					url: '?accion=login&axj=1',
					data: 'login=' + $('#login').val() + '&password=' + $('#password').val()+'&remember='+valorCheck,
					success:function(msj){
					
						$('#span_loader').html('');
						
						if ( msj == 0 ){
							
							$('#alertBoxes').html('<div class="box-error alert alert-error"></div>');
							//$('.box-error').hide(0).html('Lo sentimos, pero los datos son incorrectos: ' + msj);
							$('.box-error').hide(0).html('Los datos son incorrectos');
							
							
							$('.box-error').slideDown(timeSlide);
						}else if(msj == 1) {
							$('#alertBoxes').html('<div class="box-success alert alert-success"></div>');
							$('.box-success').hide(0).html('Espera un momento&#133;');
							
							$('.box-success').slideDown(timeSlide);
							setTimeout(function(){
								window.location.href = ".";
							},(timeSlide + 500));
							
							
							
						}else if(msj != 1 & msj !=0) {
							
							$('#alertBoxes').html('<div class="box-success alert alert-success"></div>');
							$('.box-success').hide(0).html('Espera un momento&#133;');
							
							$('.box-success').slideDown(timeSlide);
							setTimeout(function(){
								window.location.href = msj;
							},(timeSlide + 500));
							
							
							
						}
						$('#timer').fadeOut(300);
					},
					error:function(){
						$('#timer').fadeOut(300);
						$('#alertBoxes').html('<div class="box-error alert alert-error"></div>');
						$('.box-error').hide(0).html('Ha ocurrido un error durante la ejecuci\u00f3n');
						
						$('.box-error').slideDown(timeSlide);
					}
				});
				
					
				
			}
			else{
				$('#span_loader').html('');
				$('#alertBoxes').html('<div class="box-error"></div>');
				$('.box-error').hide(0).html('Los campos est&aacute;n vacios');
				$('.box-error').addClass('alert alert-error');
				$('.box-error').slideDown(timeSlide);
				$('#timer').fadeOut(300);
			}
		},timeSlide);
		
		
		
		
		return false;
		
	
	});
	
	
	
	$('#sessionKiller').click(function(){  
		$('#timer').fadeIn(300);
		$('#alertBoxes').html('<div class="box-success"></div>');
		$('.box-success').hide(0).html('Espera un momento&#133;');
		$('.box-success').slideDown(timeSlide);
		setTimeout(function(){
			window.location.href = "logout.php";
		},2500);
	});
	/*$('#cierra_cortina').live('click', function(){
		$('#cortina').slideUp("slow");
		//alert('asd');
	});*/
});
