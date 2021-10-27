<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $pagetitle ?></title>
    </head>
    <body>
    <header>
        <p>Je suis le header</p>
    </header>

    <?php
        if(is_null($controller))$filepath = File::build_path(array("view","$view.php"));
        else $filepath = File::build_path(array("view",$controller,"$view.php"));

        require $filepath;

        ?>
    </body>
    <footer>
        <p>Je suis le footer</p>
    </footer>
</html>


