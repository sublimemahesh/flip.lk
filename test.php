<?php
include_once(dirname(__FILE__) . '/class/include.php');

$id = 5;

$ADVERTISEMENT = new Advertisement($id);
$ADIMAGES = AdvertisementImage::getPhotosByAdId($id);
?> 

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <style>
            /* This rule is read by Galleria to define the gallery height: */
            #galleria{height:600px}

        </style>
    </head>
    <body>
        <div id="galleria">
            <?php
            foreach ($ADIMAGES as $img) {
                ?>
            <a href="upload/advertisement/<?php echo $img['image_name']; ?>">
                <img 
                    src="upload/advertisement/<?php echo $img['image_name']; ?>"
                    data-big="upload/advertisement/<?php echo $img['image_name']; ?>"
                    data-title="Biandintz eta zaldiak"
                    data-description="Horses on Bianditz mountain, in Navarre, Spain."
                    >
            </a>
            <?php
            }
            ?>
        </div>

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.js"></script>
        <script src="plugins/galleria/galleria-1.5.7.min.js" type="text/javascript"></script>
        <script>
            $(function () {
                // Load the classic theme
                Galleria.loadTheme('plugins/galleria/themes/classic/galleria.classic.min.js');

                // Initialize Galleria
                Galleria.run('#galleria');
            });
        </script>
    </body>
</html>
