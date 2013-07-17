<?php
/* 
 * This is the basic form of a Montag module
 */

/**
 *
 * @author SanMadJack
 */
interface module_template {
    // This function performs any before the text work necessary
    public function module_setup($settings);
    // This function RETURNS a string to be added to the page's title
    public function write_module_title($settings);
    // This function draws additional menu items related to the module
    public function draw_module_menu($settings);
    // This function displays the main body of content the module is responsible for
    public function draw_module_body($settings);
}
?>
