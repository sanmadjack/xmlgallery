<?php

class Module implements module_template {

    public function module_setup($settings) {
        // Import the class for holding the item information
        print "<script src=\"include/gallery_items.js\"></script>\n";
        print "<script>var items = new gallery_items();</script>\n";

        // Load the appropriate stylesheets
        print "<link rel=\"stylesheet\" type=\"text/css\" href=\"themes/".$settings->get_theme()."/browse.css\" />\n";
    }

    public function write_module_title($settings) {
        return "Browsing";
    }

    public function draw_module_menu($settings) {
        print "words!";
    }

    public function draw_module_body($settings) {
        if ($handle = opendir('./thumbs/')) {
            while (false !== ($file = readdir($handle))) {
                if ($file != "." && $file != "..") {
                     print "<div class=\"gallery_item\"><img src=\"thumbs/$file\" /></div>\n";
                     print "<script>items.add_item(\"$file\");</script>\n";
                }
            }
        }
    }

}
?>
