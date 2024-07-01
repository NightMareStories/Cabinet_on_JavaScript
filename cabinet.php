<?php
    //var_dump($_COOKIE);
    if ( !isset($_COOKIE['email']) OR trim($_COOKIE['email']) ==''){
        header("Location: index.html");
        exit; 
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="favicon.png" type="image/png">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="css/materialize.css"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="css/style.css">
    <link type="text/css" rel="stylesheet" href="css/components/header.css">
    <link type="text/css" rel="stylesheet" href="css/components/footer.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>User cabinet</title>
</head>

<body>
    <header class="general-header">
        <div class="general-header__top g-top-header">
            <div class="g-top-header__content _container">
                <div class="g-top-header__column g-header-info">
                    <div class="g-header-info__logo">
                        <picture>
                            <source srcSet="img/logo-img.webp" type="image/webp" class="g-header-info__logo_img" />
                            <img src="img/logo-img.png" alt="logo-img" class="g-header-info__logo_img" />
                        </picture>
                    </div>
                    <div class="g-header-info__text">
                        <div class="g-header-info__text_username">
                            Poteryaev<br /> Aleksandr
                        </div>
                        <div class="g-header-info__text_userprof">
                            Front-End Developer
                        </div>
                    </div>
                </div>
                <div class="g-top-header__column g-header-nav">
                    <div class="g-header-nav__content">
                        <nav class="g-header-nav__column">
                            <ul class="g-header-nav__actions g-actions-header">
                            <li><a href='https://github.com/NightMareStories/Cabinet_on_JavaScript.git' class="g-actions-header__link" target="_blank" rel="noopener noreferrer"><span>GitHub</span></a></li>
                                <li><a href='http://about-my-portfolio.site' class="g-actions-header__link" target="_blank" rel="noopener noreferrer"><span>My Portfolio</span></a></li>
                            </ul >
                        </nav >
                    </div >
                </div>
            </div>
        </div>
    </header>

    <div class="cabinet-page">
        <div class="row">
            <div class="col s12 center-align">
                <div class="cabinet-header">
                    <h1 class="user-cabinet-header">User cabinet</h1>
                </div>
            </div>
            <div class="col s12 center-align">
                <button id="logout" class="waves-effect waves-light btn"><i class="material-icons right">keyboard_tab</i>Logout</button>
            </div>
        </div>
        <div class="row page-form">
            <div class="page-form__content">
                <form>
                    <div class="row">
                        <div class="input-field col s6">
                            <input id="signup-name" type="text" class="validate white-text">
                            <label class="active" for="signup-name">Name</label>
                        </div>
                        <div class="input-field col s6">
                            <input id="signup-pass" type="text" class="validate white-text">
                            <label class="active" for="signup-pass">Password</label>
                        </div>
                        <div class="input-field col s12">
                            <input id="signup-birthday" type="text" class="datepicker white-text">
                            <label class="active" for="signup-birthday">Birthday</label>
                        </div>
                        <div class="col s12">
                            <p>
                                <label>
                                    <input name="sex" type="radio" class="sex" value="male">
                                    <span class="white-text">Male</span>
                                </label>
                            </p>
                            <p>
                                <label>
                                    <input name="sex" type="radio" class="sex" value="female">
                                    <span class="white-text">Female</span>
                                </label>
                            </p>
                            <p>
                                <label>
                                    <input name="sex" type="radio" class="sex" value="other">
                                    <span class="white-text">Other</span>
                                </label>
                            </p>
                        </div>
                        <div class="col s12 right-align">
                            <button id="signup-submit" class="waves-effect waves-light btn"><i class="material-icons right">cloud</i>update
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <footer class="general-footer">
        <div class="general-footer__content g-content-footer _container">
            <div class="g-content-footer__block g-block-footer">
                <div class="g-block-footer__credits">
                    <div class="g-block-footer__copyrights">
                        &copy; 2024 Poteryaev Aleksandr
                    </div>
                    <div class="g-block-footer__project">
                        <h3 class="g-block-footer__project_title">Project: <span>Cabinet on JavaScript</span></h3>
                    </div>
                </div>
                <nav class="g-block-footer__nav">
                    <ul class="g-block-footer__actions g-actions-footer">
                    <li><a href='https://github.com/NightMareStories/Cabinet_on_JavaScript.git' class="g-actions-footer__link" target="_blank" rel="noopener noreferrer"><span>GitHub</span></a></li>
                        <li><a href='http://about-my-portfolio.site' class="g-actions-footer__link" target="_blank" rel="noopener noreferrer"><span>My Portfolio</span></a></li>  
                    </ul >
                </nav >
            </div>    
        </div>
    </footer>

    <script src="js/materialize.js"></script>
    <script src="script/ajax.js"></script>
    <script src="script/get_user_data.js"></script>
    <script src="script/logout.js"></script>
</body>

</html>