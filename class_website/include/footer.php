<!--For time/date stamp when page is loaded-->
<!--Taken from Professor Doug Rose's github: https://github.com/NEIT-DRR/se266-example-code/blob/1bb6ca4c8f3fe32bde0797b5080e6633c27e44c4/class_web_site/include/footer.php -->
        <footer class="footer">

            <p>&copy; 2024 TJ Web Solutions. All rights reserved.</p>
            <p>Connect with us:</p>
            <a href="your_facebook_link" class="social-icon"><i class="fab fa-facebook-f"></i></a>
            <a href="your_twitter_link" class="social-icon"><i class="fab fa-twitter"></i></a>
            <a href="your_instagram_link" class="social-icon"><i class="fab fa-instagram"></i></a>
            <a href="your_github_profile_link" class="social-icon"><i class="fab fa-github"></i></a>
            
            <p>
            <?php       
                $file = basename($_SERVER['PHP_SELF']);
                $mod_date=date("F d Y h:i:s A", filemtime($file));
                echo "File last updated $mod_date ";
                //date.timezone = "Europe/Athens"
            ?></p>
        </footer>
    </body>
</html>