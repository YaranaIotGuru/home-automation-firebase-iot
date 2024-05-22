<!--<div style="text-align: center;">-->
<!--    © <?php //echo date("Y"); ?> <a href="https://developer.chikuaicode.com" target="_blank"> ChikuAI </a><br> Created with <i class="fa fa-heart" style="color:red;"></i> by Saurya.-->
<!--</div>-->


</main>

<script>
    var el = document.getElementById("sidebar");
    var main = document.getElementById("main");

    var toggleButton = document.getElementById("menu-toggle");
    toggleButton.onclick = function() {
        el.classList.toggle("open");
        main.classList.toggle("small");
    };

    // Call the checkUrl function when the page loads
    checkUrl();

    function checkUrl() {
        // Get the current URL
        let url = window.location.href;
        // List of URLs for each menu item
        let urls = [
            "dashboard.php",
            "qna.php",
            "qna_category.php",
            "qna_sub.php",
            "qna_sets.php",
            "users.php",
            "user_suspended.php",
            "notification.php",
             "contact.php",
            "slider.php",
            "category.php",
            "videos.php",
            "settings.php"
        ];

        // Loop through the URLs array
        for (let i = 0; i < urls.length; i++) {
            // Check if the current URL contains the URL at index i
            if (url.includes(urls[i])) {
                // If it does, set the corresponding menu item as active
                setActive(i);
                // Exit the loop
                break;
            }
        }
    }

    function setActive(index) {
        // Remove the 'active' class from all menu items
        let menuItems = document.querySelectorAll("#sidebar a");
        menuItems.forEach(function(item) {
            item.classList.remove("active");
        });

        // Add the 'active' class to the menu item at the specified index
        menuItems[index].classList.add("active");
    }
</script>


</body>

</html>