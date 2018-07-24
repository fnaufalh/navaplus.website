@extends('layouts.app')

@section('content')
    <div class="max-width display-flex">
        <div class="left-section">
            <div class="quotes-home">
                <div id="carousel-nava-landscape" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carousel-nava-landscape" data-slide-to="0" class="active"></li>
                        <li data-target="#carousel-nava-landscape" data-slide-to="1"></li>
                        <li data-target="#carousel-nava-landscape" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item item active">
                            <img class="d-block w-100" src="https://placeimg.com/350/150/animals" alt="First slide">
                            <div class="carousel-caption d-md-block">
                                <h5>We Are House of Brands</h5>
                            </div>
                        </div>
                        <div class="carousel-item item">
                            <img class="d-block w-100" src="https://placeimg.com/350/150/tech" alt="Second slide">
                            <div class="carousel-caption d-md-block">
                                <h5>We Are House of Brands 2</h5>
                            </div>
                        </div>
                        <div class="carousel-item item">
                            <img class="d-block w-100" src="https://placeimg.com/350/150/arch" alt="Third slide">
                            <div class="carousel-caption d-md-block">
                                <h5>We Are House of Brands 3</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="carousel-nava-portrait" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carousel-nava-portrait" data-slide-to="0" class="active"></li>
                        <li data-target="#carousel-nava-portrait" data-slide-to="1"></li>
                        <li data-target="#carousel-nava-portrait" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item item active">
                            <img class="d-block w-100" src="https://placeimg.com/350/510/animals" alt="First slide">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>We Are House of Brands</h5>
                            </div>
                        </div>
                        <div class="carousel-item item">
                            <img class="d-block w-100" src="https://placeimg.com/350/510/nature" alt="Second slide">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>We Are House of Brands 2</h5>
                            </div>
                        </div>
                        <div class="carousel-item item">
                            <img class="d-block w-100" src="https://placeimg.com/350/510/people" alt="Third slide">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>We Are House of Brands 3</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="right-section site-holder">
            <div class="display-flex">
                <a href="site-01.html" class="site-item" style="background-color: #5a2b81;">
                    <div class="hover-holder display-flex">
                        <div>Every brand has it's own path</div>
                        <div><img src="{{asset("images/right-arrow.png")}}" alt=""></div>
                    </div>
                    <div class="site-name">Pathfinders</div>
                    <div class="site-logo" style="right: 0">
                        <img src="{{asset("images/00%20Homepage/icon_pathfindrs@2x.png")}}" style="left: auto;" alt="">
                    </div>
                    <div class="site-description">Every brand has it's own path</div>
                    <div class="bar-white-vertical"></div>
                    <div class="bar-white-horizontal"></div>
                </a>
                <a href="site-02.html" class="site-item" style="background-color: #f93958">
                    <div class="hover-holder display-flex">
                        <div>For the Forward</div>
                        <div><img src="{{asset("images/right-arrow.png")}}" alt=""></div>
                    </div>
                    <div class="site-name">Iris</div>
                    <div class="site-description">For the Forward</div>
                    <div class="site-logo" style="text-align: center;">
                        <img src="{{asset("images/00%20Homepage/icon_iris@2x.png")}}" alt="">
                    </div>
                    <div class="bar-white-vertical left"></div>
                    <div class="bar-white-horizontal left"></div>
                    <div class="bar-white-vertical"></div>
                    <div class="bar-white-horizontal"></div>
                </a>
                <a href="site-03.html" class="site-item" style="background-color: #00a4bd">
                    <div class="hover-holder display-flex">
                        <div>Engagement Strategies for Your Digital Business</div>
                        <div><img src="{{asset("images/right-arrow.png")}}" alt=""></div>
                    </div>
                    <div class="site-name">Tribecloud</div>
                    <div class="site-logo" style="text-align: right;">
                        <img src="{{asset("images/00%20Homepage/icon_tribecloud@2x.png")}}" alt="">
                    </div>
                    <div class="site-description">Engagement Strategies for Your Digital Business</div>
                    <div class="bar-white-vertical left"></div>
                    <div class="bar-white-horizontal left"></div>
                    <div class="bar-white-vertical"></div>
                    <div class="bar-white-horizontal"></div>
                </a>
                <a href="site-04.html" class="site-item" style="background-color: #676767">
                    <div class="hover-holder display-flex">
                        <div>Unleashing the power of collaboration</div>
                        <div><img src="{{asset("images/right-arrow.png")}}" alt=""></div>
                    </div>
                    <div class="site-name">Interface</div>
                    <div class="site-description">Unleashing the power of collaboration</div>
                    <div class="site-logo" style="text-align: center;">
                        <img src="{{asset("images/00%20Homepage/icon_interface@2x.png")}}" alt="">
                    </div>
                    <div class="bar-white-vertical left"></div>
                    <div class="bar-white-horizontal left"></div>
                </a>
                <a href="site-05.html" class="site-item" style="background-color: #ef4d24">
                    <div class="hover-holder display-flex">
                        <div>Work is more rewarding</div>
                        <div><img src="{{asset("images/right-arrow.png")}}" alt=""></div>
                    </div>
                    <div class="site-name">Skor</div>
                    <div class="site-logo">
                        <img src="{{asset("images/00%20Homepage/icon_skor@2x.png")}}" alt="">
                    </div>
                    <div class="site-description">Work is more rewarding</div>
                    <div class="bar-white-vertical top"></div>
                    <div class="bar-white-horizontal top"></div>
                </a>
                <a href="site-06.html" class="site-item" style="background-color: #00adee">
                    <div class="hover-holder display-flex">
                        <div>Creativity & innovation in media science</div>
                        <div><img src="{{asset("images/right-arrow.png")}}" alt=""></div>
                    </div>
                    <div class="site-name">Optima Media</div>
                    <div class="site-description">Creativity & innovation in media science</div>
                    <div class="site-logo" style="text-align: center;">
                        <img src="{{asset("images/00%20Homepage/icon_optima@2x.png")}}" alt="">
                    </div>
                    <div class="bar-white-vertical left top"></div>
                    <div class="bar-white-horizontal left top"></div>
                    <div class="bar-white-vertical top"></div>
                    <div class="bar-white-horizontal top"></div>
                </a>
                <a href="site-07.html" class="site-item" style="background-color: #c70651">
                    <div class="hover-holder display-flex">
                        <div></div>
                        <div><img src="{{asset("images/right-arrow.png")}}" alt=""></div>
                    </div>
                    <div class="site-name">Diageo</div>
                    <div class="site-logo">
                        <img src="{{asset("images/icon%20diageo@2x.png")}}" alt="">
                    </div>
                    <div class="site-description"></div>
                    <div class="bar-white-vertical left top"></div>
                    <div class="bar-white-horizontal left top"></div>
                    <div class="bar-white-vertical top"></div>
                    <div class="bar-white-horizontal top"></div>
                </a>
                <a href="site-08.html" class="site-item" style="background-color: #d62027">
                    <div class="hover-holder display-flex">
                        <div>Delivering Products and Brands Into
                            the Indonesian Market
                        </div>
                        <div><img src="{{asset("images/right-arrow.png")}}" alt=""></div>
                    </div>
                    <div class="site-name">Advis</div>
                    <div class="site-description">Delivering Products and Brands</div>
                    <div class="site-logo" style="text-align: center;">
                        <img src="{{asset("images/00%20Homepage/icon_advis@2x.png")}}" alt="">
                    </div>
                    <div class="bar-white-vertical left top"></div>
                    <div class="bar-white-horizontal left top"></div>
                </a>
            </div>
        </div>
    </div>

    <section id="whats-going-on" class="section-holder">
        <div class="section-header">
            <div class="max-width display-flex">
                <div><h3 class="text-white">What's going on</h3></div>
            </div>
        </div>
        <div class="section-content max-width d-flex flex-wrap">
            <div class="section-content-item">
                <div class="image-project">
                    <div class="info">
                        <div class="title">
                            <h5>IKEA: Integrated Campaign: Offline to Online to Onair</h5>
                        </div>
                        <div class="sub-title">
                            IKEA
                        </div>
                    </div>
                </div>
            </div>
            <div class="section-content-item">
                <div class="image-project">
                    <div class="info">
                        <div class="title">
                            <h5>IKEA: Integrated Campaign: Offline to Online to Onair</h5>
                        </div>
                        <div class="sub-title">
                            IKEA
                        </div>
                    </div>
                </div>
            </div>
            <div class="section-content-item">
                <div class="image-project">
                    <div class="info">
                        <div class="title">
                            <h5>IKEA: Integrated Campaign: Offline to Online to Onair</h5>
                        </div>
                        <div class="sub-title">
                            IKEA
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <section id="lets-connect" class="section-holder">
        <div class="section-header">
            <div class="max-width display-flex">
                <div><h3 class="text-white">Let's connect and collaborate</h3></div>
            </div>
        </div>
        <div class="section-content max-width display-flex">
            <div class="section-left p-2">
                <div class="display-flex">
                    <div class="col-md-6 col-xs-12 pl-0">
                        <div class="general-inquiries-holder">
                            <div class="display-flex">
                                <div style="position:relative;">
                                    <h6 class="font-weight-bold">General Inquiries</h6>
                                </div>
                            </div>
                            <div class="email">
                      <span class="align-middle">
                        <i class="fa fa-envelope fa-1x"></i>
                      </span>
                                <span class="align-middle">hello@navaplus.com</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xs-12 pl-0">
                        <div class="career-holder">
                            <div class="display-flex">
                                <div style="position: relative;">
                                    <h6 class="font-weight-bold">Career</h6>
                                </div>
                            </div>
                            <div class="email">
                      <span class="align-middle">
                        <i class="fa fa-envelope fa-1x"></i>
                      </span>
                                <span class="align-middle">recruitment@navaplus.com</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="contact">
                    Nava+ Headquarters <br>
                    Generali Tower 8th Floor <br>
                    Gran Rubina Business Park at Rasuna Epicentrum <br>
                    Jl. HR Rasuna Said – Jakarta 12940 <br>
                    Indonesia <br>
                    Phone +62 21 2598 3768 <br>
                    Fax +62 21 2598 3983 <br>
                </div>
            </div>
            <div class="section-right p-2">
                <div class="display-flex">
                    <div class="map-holder">
                        <iframe frameborder="0"
                                src="https://www.google.com/maps/embed/v1/place?key=AIzaSyBUS6tYju6z62T7fW2xBdTMomZxrMSBny4&q=Generali+Tower+Gran+Rubina+Business+Park"
                                allowfullscreen>
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
<script type="text/javascript" src="{{asset("js/index.js")}}">

</script>
@endsection
