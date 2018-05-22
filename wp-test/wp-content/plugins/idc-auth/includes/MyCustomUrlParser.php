<?php
class MyCustomUrlParser {

    private $matched = array();

    /**
     * Run a filter to obtain some custom url settings, compare them to the current url
     * and if a match is found the custom callback is fired, the custom view is loaded
     * and request is stopped.
     * Must run on 'do_parse_request' filter hook.
     */
    public function parse( $result ) {
        if ( current_filter() !== 'do_parse_request' ) {
            return $result;
        }
        $custom_urls = (array) apply_filters( 'my_custom_urls', array() );
        if ( $this->match( $custom_urls ) && $this->run() ) {
            exit(); // stop WordPress workflow
        }
        return $result;
    }

    private function match( Array $urls = array() ) {
        if ( empty( $urls ) ) {
            return FALSE;
        }
        $current = $this->getCurrentUrl();
        $this->matched = array_key_exists( $current, $urls ) ? $urls[$current] : FALSE;
        return ! empty( $this->matched );
    }

    private function run() {
        if (
            is_array( $this->matched )
            && isset( $this->matched['callback'] )
            && is_callable( $this->matched['callback'] )
        ) {
            $GLOBALS['wp']->send_headers();
            $data = call_user_func( $this->matched['callback'] );
            return TRUE;
        }
    }

    private function getCurrentUrl() {
        $home_path = rtrim( parse_url( home_url(), PHP_URL_PATH ), '/' );
        $path = rtrim( substr( add_query_arg( array() ), strlen( $home_path ) ), '/' );
        return ( $path === '' ) ? '/' : $path;
    }

}