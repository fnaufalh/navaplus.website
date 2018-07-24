<html>

<head>
    <title>Nava+</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Encode+Sans:400,600" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset("css/bootstrap.min.css")}}">
    <link rel="stylesheet" href="{{asset("css/main.css?v=201807161935")}}">
</head>

<body>

<header>
    <div class="max-width display-flex">
        <div class="logo-holder">
            <div class="hamburger hamburger--spin js-hamburger">
                <div class="hamburger-box">
                    <div class="hamburger-inner">
                    </div>
                </div>
            </div>
            <div class="menu-holder">
                <div class="nav-menu-holder">
                    <ul>
                        <li><a href="/">Home</a></li>
                        <li><a href="about">About</a></li>
                        <li><a href="#" onclick="return false" class="open-agencies">Agency</a>
                            <ul class="ml-1">
                                <li><a href="site-01">Pathfinders</a></li>
                                <li><a href="site-02">Iris</a></li>
                                <li><a href="site-03">Tribecloud</a></li>
                                <li><a href="site-04">Interface</a></li>
                                <li><a href="site-05">Skor</a></li>
                                <li><a href="site-06">Optima Media</a></li>
                                <li><a href="site-07">Diageo</a></li>
                                <li><a href="site-08">Advis</a></li>
                            </ul>
                        </li>
                        <li><a href="work">Work</a></li>
                        <li><a href="clients">Clients</a></li>
                        <li><a href="news">News</a></li>
                        <li><a href="#" scroll-to="/#lets-connect">Contact</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="title-holder text-center">
            <img src="{{asset("images/title.png")}}" alt="Nava+">
        </div>
        <div class="right-holder">

        </div>
    </div>
</header>

<section id="sites-section">
@yield('content')
</section>

<footer>
    <div class="max-width display-flex">
        <div class="left-holder">
            &copy;2018 NAVAPLUS GROUP INDONESIA
        </div>
        <div class="center-holder text-center">
            <div class="social-logo text-white">
                <i class="fa fa-facebook"></i>
            </div>
            <div class="social-logo text-white">
                <i class="fa fa-instagram"></i>
            </div>
            <div class="social-logo text-white">
                <i class="fa fa-linkedin"></i>
            </div>
        </div>
        <div class="right-holder"></div>
    </div>
</footer>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
<script src="{{asset("js/main.js?v=201807161935")}}"></script>
<script src="{{asset("js/hamburger.js")}}"></script>
@yield('script')
</body>

</html>
