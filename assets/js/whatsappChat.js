
jQuery(document).ready(function($){

	$("body").append(
		'<div class="caja-popup">' +
			'<div class="caja-popup-1" id="popup-oculto">' +
				'<div class="caja-popup-abierto">' +
					'<div class="popup-abierto-1">' + php_vars.text2 + '</div>' +
					'<div class="popup-abierto-2">' + php_vars.text3 + '</div>' +
				'</div>' +
				'<div class="caja-input">' +
					'<input type="text" class="input-chat" id="inputChat" placeholder="Escribe tu mensaje...">' +
					'<img class="enviar-chat" id="buttonChat" src="' + php_vars.baseUrl + '/wp-content/plugins/simple-chat-box-wp/assets/img/send-button.svg" >' +
				'</div>' +
			'</div>' +
			'<div class="caja-popup-2" id="abrir-popup-oculto">' +
				'<div class="popup-cerrado"><img class="whatsapp-icon" src="' + php_vars.baseUrl + '/wp-content/plugins/simple-chat-box-wp/assets/img/whatsapp.svg" >' + php_vars.text1 + '</div>' +
			'</div>' +
		'</div>'
	);
	

	$('#buttonChat').click(function(e) {  
		var texto = $("#inputChat").val();
		if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
			window.open("https://api.whatsapp.com/send?phone="+ php_vars.number + "&text=" + texto);
		}else{
			window.open("https://web.whatsapp.com/send?phone=" + php_vars.number +"&text=" + texto);
		}
	});

	$('#abrir-popup-oculto').toggle( 
		/* 
			Primer click.
			Función que descubre un panel oculto y cambia el texto del botón.
		*/
		function(e){ 
			$('#popup-oculto').slideDown();
			$(this).html('<div style="clear:both;padding-top:15px;"></div><div class="popup-cerrado-cruz"><img class="close-icon" src="' + 
			php_vars.baseUrl + '/wp-content/plugins/simple-chat-box-wp/assets/img/close.svg" > </div>');
			e.preventDefault();
		},
	 
		/* 
			Segundo click.
			Función que oculta el panel y vuelve a cambiar el texto del botón.
		*/
		function(e){ 
			$('#popup-oculto').slideUp();
			$(this).html('<div class="popup-cerrado"><img class="whatsapp-icon" src="' + php_vars.baseUrl + 
			'/wp-content/plugins/simple-chat-box-wp/assets/img/whatsapp.svg" > ' + php_vars.text1 + '</div>');
			e.preventDefault();
		}
 
	);
 
	// Timeout para lanzar automáticamente el popup cada X segundos
	if (php_vars.auto_open === "1") {
		setTimeout(
			function() {
				if($("#popup-oculto").is(":hidden")){
				document.getElementById("abrir-popup-oculto").click();
				}
		}, php_vars.delay * 1000);
	}

	
});
