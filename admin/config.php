<?php

    if (! current_user_can ('manage_options')) wp_die (__ ("You don't have permissions to access this page."));

    // Si enviamos parámetros, actualizamos tabla options de la BD
    if (isset($_POST['scbw_mobile_number']) && 
        isset($_POST['scbw_delay']) &&
        isset($_POST['scbw_text1']) &&
        isset($_POST['scbw_text2']) &&
        isset($_POST['scbw_text3']) 
        ) {
        $number = sanitize_text_field($_POST['scbw_mobile_number']);
        update_option('scbw_mobile_number', $number);
        $autoOpen = sanitize_text_field($_POST['scbw_opening']);
        update_option('scbw_opening', $autoOpen);
        $delay = sanitize_text_field($_POST['scbw_delay']);
        update_option('scbw_delay', $delay);
        $text1 = sanitize_text_field($_POST['scbw_text1']);
        update_option('scbw_text1', $text1);
        $text2 = sanitize_text_field($_POST['scbw_text2']);
        update_option('scbw_text2', $text2);
        $text3 = sanitize_text_field($_POST['scbw_text3']);
        update_option('scbw_text3', $text3);
    }

    // Si actualizamos sin seleccionar opening - marcamos como 0 en DB
    if ( !isset($_POST['scbw_opening']) && isset($_POST['scbw_mobile_number'])) {
        $autoOpen = update_option('scbw_opening', 0);
    }

    // Cogemos el valor del options y si no existe colocamos el string para operar
    $number = get_option('scbw_mobile_number', '+34666777888');
    $delay = get_option('scbw_delay', 20);
    $text1 = get_option('scbw_text1', '¿Cómo puedo ayudarte?');
    $text2 = get_option('scbw_text2', 'Estoy para ayudarte en lo que necesites. ¡Pregúnta lo que quieras!');
    $text3 = get_option('scbw_text3', 'Hola ¿Qué tal?');

    $incorrectPhone = false;

    // Disparador para mostrar mensaje si no tenemos configurado el teléfono
    if ($number == '+34666777888' || strlen($number) < 3) { ?>
        <div class="update-nag notice scbw-d-block">
            <p>Rellena tu número de teléfono para activar el funcionamiento del plugin</p>
        </div>
    <?php } 
?>

	<div class="wrap">
		<h2>Simple Chat Box WP</h2>
        Bienvenido a la página de configuración del plugin WhatsApp Chat WP
    </div>

    <div class="wrap scbw-mt-35">
        <form method="POST">
            <table class="form-table">
                <tbody>
                    <tr>
                        <th><label for="scbw_mobile_number">Número de teléfono: </label></th>
                        <td>
                            <input type="text" name="scbw_mobile_number" id="scbw_mobile_number" value="<?php echo $number; ?>">
                            <p class="description">*Prefijo + número sin espacios</p>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="scbw_opening">Abrir popup automáticamente: </label></th>
                        <td><input name="scbw_opening" type="checkbox" id="scbw_opening" value="1" <?php checked( 1,  get_option('scbw_opening') )  ?> /></td>
                    </tr>
                    <tr id="delay_field">
                        <th><label for="scbw_delay">Delay (segundos): </label></th>
                        <td><input type="number" name="scbw_delay" id="scbw_delay" value="<?php echo $delay; ?>" min="0"></td>
                    </tr>
                    <tr>
                        <th><label for="scbw_delay">Texto 1: </label></th>
                        <td><input type="text" name="scbw_text1" id="scbw_text1" value="<?php echo $text1; ?>"></td>
                    </tr>
                    <tr>
                        <th><label for="scbw_delay">Texto 2: </label></th>
                        <td><input type="text" name="scbw_text2" id="scbw_text2" value="<?php echo $text2; ?>"></td>
                    </tr>
                    <tr>
                        <th><label for="scbw_delay">Texto 3: </label></th>
                        <td><input type="text" name="scbw_text3" id="scbw_text3" value="<?php echo $text3; ?>"></td>
                    </tr>
                </tbody>
            </table>
         
            <?php submit_button();?>
        </form>
    </div>

