<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');

    * {
        margin: 0;
        padding: 0;
        font-family: 'Poppins', sans-serif;
        -webkit-tap-highlight-color: transparent;
        word-wrap: break-word;
    }

    a {
        text-decoration: none;
    }

    :root {
        --color-primary: #0a8f8d;
        --color-primary-dark: #077371;
        --color-dark-text: rgb(72, 79, 83);
        --blue: #0056f5;
        --red: #ff5454;
        --green: #07b57e;
    }

    /* ================SCROLLBAR============= */

    /* width */
    ::-webkit-scrollbar {
        width: 10px;
    }

    /* Track */
    ::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    /* Handle */
    ::-webkit-scrollbar-thumb {
        background: #cfcfcf;
    }

    /* Handle on hover */
    ::-webkit-scrollbar-thumb:hover {
        background: #dfdfdf;
    }


    /* ==============Header============== */
    header {
        background-color: #FFF;
        padding: 10px 20px;
        position: sticky;
        top: 0px;
        display: flex;
        justify-content: space-between;
        box-shadow: 0px 3px 3px rgba(0, 0, 0, 0.1);
        z-index: 10;
    }

    header #pageName {
        /* background-color: var(--color-primary-dark); */
        color: var(--color-primary-dark);
        border-radius: 10px;
        padding: 5px 20px;
        font-weight: bolder;
    }

    header .menu {
        color: #01702f;
        cursor: pointer;
        font-size: 25px;
        font-weight: bolder;
    }

    header .menu span {
        margin-left: 20px;
        display: inline-block;
        text-transform: capitalize;
    }

    /* ===================Siderbar============== */


    aside {
        padding-top: 20px;
        height: 80vh;
        position: fixed;
        width: 230px;
        background-color: #FFF;
        box-shadow: 3px 0px 3px rgba(0, 0, 0, 0.1);
        transition: all 0.5s;
        z-index: 10;
        overflow-y: auto;
    }

    aside a {
        display: block;
        padding: 10px 0;
        margin-top: 5px;
        margin-right: 5px;
        color: var(--color-dark-text);
        border-radius: 0 20px 20px 0;
        transition: all 0.5s;
    }

    aside a.active {
        color: #FFFFFF !important;
        background-color: var(--color-primary-dark) !important;
    }

    aside a:hover {
        color: var(--color-primary-dark);
        background-color: #e3e3e3;
    }

    aside a i {
        margin: 0px 20px;
    }

    /* ==============Main============= */

    #main {
        margin: 10px;
        transition: all 0.5s;
    }

    /* ==============Media Query========== */

    @media screen and (min-width: 700px) {

        #main {
            margin: 20px 20px 20px 250px;
        }

        #main.small {
            margin: 20px;
        }

        aside {
            left: 0px;
        }

        aside.open {
            left: -230px;
        }
    }

    @media screen and (max-width: 700px) {

        aside {
            left: -230px;
        }

        aside.open {
            left: 0px;
        }
    }
</style>

<!-- ====================Header============== -->

<header>

    <div class="menu" id="menu-toggle">
        <i class="fas fa-align-left"> </i>
        <span>
            <?php
            if (isset($_SESSION['user'])) {
                echo $_SESSION['user'];
            } else {
                echo "Username";
            }
            ?>
        </span>
    </div>

    <div id="pageName">
        <script>
            document.write(document.title)
        </script>
    </div>

</header>

<!-- ====================Siderbar=============== -->


<aside id="sidebar">

    <a href="dashboard.php">
        <i class="fas fa-home"></i>Home
    </a>

    <!--<a href="quiz.php">-->
    <!--    <i class="fas fa-list"></i>Create Quiz-->
    <!--</a>-->
    
 
    <!--<a href="quiz_category.php">-->
    <!--    <i class="fa fa-list"></i>Quiz Category-->
    <!--</a>-->

    <!--<a href="quiz_sub.php">-->
    <!--    <i class="fa fa-list"></i>Quiz Sub-->
    <!--</a>-->
    
    <!--<a href="quiz_sets.php">-->
    <!--    <i class="fa fa-list"></i>Quiz Sets-->
    <!--</a>-->
    
    
    <!--<a href="quiz_sub_sets.php">-->
    <!--    <i class="fa fa-list"></i>Quiz Sub Sets-->
    <!--</a>-->
    
    <!--<a href="quiz_cat_private.php">-->
    <!--    <i class="fas fa-lock"></i>Private Category-->
    <!--</a>-->
    
    <!--<a href="quiz_private.php">-->
    <!--    <i class="fas fa-lock"></i>Private Quiz-->
    <!--</a>-->


    <a href="qna.php">
        <i class="fas fa-question"></i>QNA
    </a>
    

    <a href="qna_category.php">
        <i class="fa-solid fa-question"></i>Qna Category
    </a>

    <a href="qna_sub.php">
        <i class="fa-solid fa-question"></i>Qna Sub
    </a>
    
    <a href="qna_sets.php">
        <i class="fa-solid fa-question"></i>Qna Sets
    </a>


    <a href="users.php">
        <i class="fas fa-users"></i>Users
    </a>

    <a href="user_suspended.php">
        <i class="fas fa-users"></i>Block Users
    </a>

    <a href="notification.php?to=chikuai">
        <i class="fas fa-bell"></i>Notifications
    </a>
    <a href="contact.php">
    <i class="fas fa-address-book"></i> Contact Us
</a>



    <a href="slider.php">
        <i class="fas fa-images"></i>Sliders
    </a>

 <a href="category.php">
        <i class="fa fa-list"></i> Category
    </a>

    <a href="videos.php">
        <i class="fa fa-video"></i>Videos
    </a>

    <a href="settings.php">
        <i class="fas fa-gear"></i>Settings
    </a>


    <a href="?logout=user">
        <i class="fas fa-power-off"></i>Logout
    </a>

</aside>

<main id="main">