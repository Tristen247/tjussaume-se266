<!--For time/date stamp when page is loaded-->
<!--Taken from Professor Doug Rose's github: https://github.com/NEIT-DRR/se266-example-code/blob/1bb6ca4c8f3fe32bde0797b5080e6633c27e44c4/class_web_site/include/footer.php -->
<hr />          
    <?php       
        $file = basename($_SERVER['PHP_SELF']);
        $mod_date=date("F d Y h:i:s A", filemtime($file));
        echo "File last updated $mod_date ";
        //date.timezone = "Europe/Athens"
    ?>
 
</body>

</html>