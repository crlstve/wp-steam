<?php 

requiere_once ('steam-api-key.php');

function steam_get_user_data( $api_key, $steam_id ) {
    $url = "https://api.steampowered.com/ISteamUser/GetPlayerSummaries/v2/?key=$api_key&steamids=$steam_id";
    $response = wp_remote_get( $url );
    if ( is_wp_error( $response ) ) {
        return 'Error en la conexión a la API de Steam';
    }
    $data = json_decode( wp_remote_retrieve_body( $response ), true );

    return $data['response']['players'][0] ?? null;
}

/**
 * Shortcode para mostrar información de un usuario de Steam.
 * @param array $atts Los atributos del shortcode.
 * @return string La información del usuario.  
 * @since 0.1
 * @example [steam_user steam_id="76561198028792860"]
 * @author c.esteve
 * 
 **/
add_shortcode( 'steam_user', function( $atts ) {
    $atts = shortcode_atts( [ 'steam_id' => '' ], $atts );

    if ( empty( $atts['steam_id'] ) ) {
        return 'Por favor, proporciona un Steam ID.';
    }

    $user_data = steam_get_user_data( $api_key, $atts['steam_id'] );

    if ( ! $user_data ) {
        return 'No se encontró información para el Steam ID proporcionado.';
    }

    return "Nombre: " . esc_html( $user_data['personaname'] ) . "<br>" .
           "Avatar: <img src='" . esc_url( $user_data['avatar'] ) . "' />";
});



?>
