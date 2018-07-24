@extends('layouts.app')

@section('content')
<section id="site-banner" class='max-width'>
    <div class="max-width"></div>
</section>

<section id="site-about" class="max-width">
    <div class="max-width display-flex ptb-100">
        <div class="about-left">

        </div>
        <div class="about-right">
            <h1 class="text-white"></h1>
            <div class="top-border"></div>
            <p class="text-white"></p>
        </div>
    </div>
</section>

<section id="whats-going-on" class="section-holder whats-going-on-site">
    <div class="section-content max-width d-flex flex-wrap">
    </div>
    <div class="text-center">
        <div class="load-more">
            <div class="display-flex text-center">
                  <a class="more" href="#">
                    <span class="text-more">
                        More
                    </span>
                    <span class="icon-more">
                        <i class="fa fa-arrow-circle-down"></i>
                    </span>
                  </a>
            </div>
        </div>
    </div>
</section>


<section id="key-people" class="section-holder">
    <div class="section-header">
        <div class="max-width display-flex">
            <div><h3 class="text-white">Key People</h3></div>
        </div>
    </div>
    <div class="section-content max-width d-flex flex-wrap">
        <div class="section-content-item p-3">
            <div>
                <div class="info">
                    <ul class="flex-container">
                      <li class="flex-item">
                        <div class="picture">
                            <img src="assets/images/02%20Agency/Pathfinders/key%20people/irvan%20permana.png" alt="">
                        </div>
                        <h5>Ivan Permana</h5>
                        <h6>Head of Pathfinders</h6>
                        <div class="email-holder">
                          <div class="email">
                            <img src="assets/images/02%20Agency/Pathfinders/email.svg" alt="">
                            <span class="align-middle" style="padding-left:5px;">irvan.permana@brand-pathfinders.com</span>
                          </div>
                        </div>
                        <p>The Solution Provider. Irvan Permana uses his vast business analysis and branding background to
                            guide the business towards higher profitability and success. Starting his gig with Iris Jakarta
                            in 2012, Irvan rose quickly and has acquired Pathfinders as one of NAVA+ Group business units.
                            Earlier in his career, Irvan served as Branding and Business Analyst at MarkPlus & Co, Makki
                            Makki, and ibrand.</p>
                      </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>


<section id="lets-connect" class="section-holder" style="background-color: #5a2b81;">
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
    <script type="text/javascript">
    $(document).ready(function(){
      $.ajax({
        type: 'GET',
        url: 'https://www.aashari.id/form-asia/navaplus/cms/public/api/agency/'+{{$id}},
        dataType: 'json',
        success: function(data){
          var data = data;
          $('#site-banner').find('div').css('background-image', 'url:('+ data.banner +')');
          $('.about-left').html('<img src="'+ data.logo_link +'" alt="'+ data.name +'">');
          $('.about-right').find('h1').html(data.motto);
          $('.about-right').find('p').html(data.description);
          $('#site-about > .max-width').css('background-color', data.background_color);
          $('.text-more').css('color', data.background_color);
          $('.icon-more').css('color', data.background_color);
          $('#key-people > .section-header').css('background-color', data.background_color);
          $('#lets-connect').css('background-color', data.background_color);
        }
      });
    });

    </script>
@endsection
