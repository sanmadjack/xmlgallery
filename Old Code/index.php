<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <?php
        // Imports the config class
        include("config/config.php");
        // Creates the config object
        $settings = new config();

        // Lets JavaScript know if we're debugging
        if($settings->debug_state()) {
            print "<script>debugging = true;</script>";
        } else {
            print "<script>debugging = false;</script>";
        }
        
        // Imports the interface for modules
        include("include/module_template.php");

        // Import the selected module
        include("modules/browse.php");
        // Instantiates the module
        $module = new Module();
        // Let the module do it's setup
        $module->module_setup($settings);

        // Prints the page title
        print "<title>".$settings->get_title()." - ".$module->write_module_title($settings)."</title>\n";

        // Loads the stylesheets
        print "<link rel=\"stylesheet\" type=\"text/css\" href=\"themes/".$settings->get_theme()."/main.css\" />";

    ?>

    </head>
    <body>
    <?php
        // This draws the debug console if debug is on
        if($settings->debug_state()) {
            print "<div class=\"debug_console\" id=\"debug_console\" onmouseover=\"console_opened();\"><script src=\"include/debug_console.js\"></script></div>";
        }
    ?>
    <div class="menu">
        Home<br />
        Browse<br />
        Admin<br />
        <?php $module->draw_module_menu($settings); ?>
    </div>
    <div class="body">
        <?php $module->draw_module_body($settings); ?>
    </div>
    </body>
</html>
