<?php
/**
 * An object holding the settings for everything
 *
 * @author SanMadJack
 */


class config {
    private $site_title = "Montag";
    private $base_address = "http://sage.sytes.net/~montag/";
    private $debug_state = true;
    private $current_theme = "tango";

    private $sql_server = "localhost";
    private $sql_database = "montag";
    private $sql_name = "montag";
    private $sql_password = "test";


    public function get_title() {
        return $this->site_title;
    }
    public function set_title($new_title) {
        $this->site_title = $new_title;
    }
    public function get_address() {
        return $this->base_address;
    }

    public function get_theme() {
        return $this->current_theme;
    }
    public function debug_state() {
        return $this->debug_state;
    }
}
?>
