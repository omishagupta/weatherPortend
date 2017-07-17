<?php
defined ('ABSPATH' ) or die();

if (!class_exists('weatherized')):
{
    class weatherized {
        public static function weatherShortcode( $attr ) {
            $city= esc_html(isset($attr['city'])? $attr['city'] : 'nyc,usa');
            if (!isset($attr['appid'])) {
                return '<p>You need to feed me city.</p>';
            }
            $current_transient= get_transient($city);
            if (false===$current_transient) {
                        $appid = $attr['appid'];
                        $url = "http://api.openweathermap.org/data/2.5/weather?q=$city&appid=$appid";
                        $response = wp_remote_get($url);
                        /*returns 200, if excution successful*/
                        $responseCode = wp_remote_retrieve_response_code($response);
                        $body = wp_remote_retrieve_body($response);
                        $weatherData = json_decode($body);

                        if (200 != $responseCode || 200 != $weatherData->cod) {
                            return '<p style="color:crimson">Error!</p>';
                        }
                        $header_text = '<h1>Weather data for ' . $weatherData->name . '</h1>';
                        $weather_img = $weatherData->weather[0]->icon;
                        $body_text = "<img height=\"100\" width=\"100\" src=\"http://openweathermap.org/img/w/$weather_img.png\">";
                        $weather_text = '<p>' . $weatherData->weather[0]->main . '</p>';
                        set_transient($city, $header_text.$body_text.$weather_text, 10*60);
                        return $header_text . $body_text . $weather_text;

            }
            return $current_transient;
        }
    }
}
    endif;