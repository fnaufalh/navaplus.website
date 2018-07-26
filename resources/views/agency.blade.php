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
    
    {{-- TEMPLATE - BEGIN --}}
    <div class="section-content-item" id="template">
        <div class="image-project">
            <a href="">
                <div class="info">
                    <div class="title">
                        <h5></h5>
                    </div>
                    <div class="sub-title"></div>
                </div>
            </a>
        </div>
    </div>
    {{-- TEMPLATE - END --}}

    <div class="section-content max-width d-flex flex-wrap" id="section-container">

    </div>
</section>
    
    <div class="section-content max-width d-flex flex-wrap">
      
    </div>
    <div class="text-center">
        <div class="load-more">
            <div class="display-flex text-center">
                  <a href="#load-more">
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
        var color;
        var page;

        $(document).ready(function(){
          page = 1;
          loadAgency();
          loadPeople();
          loadWork(page);

          $(".load-more").click(function () {
             page++;
             loadWork(page);
          });
        });

        var loadAgency = function () {
            $.ajax({
                type: 'GET',
                url: '{{url('/api/agency/'.$id)}}',
                dataType: 'json',
                success: function(data){
                    var data = data;
                    $('#site-banner .max-width').css('background-image', 'url(\'' + data.banner_link + '\')');
                    $('.about-left').html('<img src="'+ data.logo_link +'" alt="'+ data.name +'">');
                    $('.about-right').find('h1').html(data.motto);
                    $('.about-right').find('p').html(data.description);
                    $('#site-about > .max-width').css('background-color', data.background_color);
                    $('.text-more').css('color', data.background_color);
                    $('.icon-more').css('color', data.background_color);
                    $('#key-people > .section-header').css('background-color', data.background_color);
                    $('#lets-connect').css('background-color', data.background_color);
                    color = data.background_color;
                }
            });
        }

        var loadPeople = function () {
            $.ajax({
                type: 'GET',
                url: '{!! url('/api/people?order_type=asc&agency_id='.$id) !!}',
                dataType: 'json',
                success: function(data){
                    var data = data;
                    if (data.length != 0 ) {
                        for (var i = 0; i < data.length; i++) {
                            $('#key-people').find('.section-content').append('<div class="section-content-item p-3"><div><div class="info"><ul class="flex-container"><li class="flex-item"><div class="picture"><img src="'+ data[i].image_link +'" alt="'+ data[i].name +'"></div><h5>'+ data[i].name +'</h5><h6>'+ data[i].department +'</h6><div class="email-holder"><div class="email"><span class="email-icon align-middle" style="color:'+ color +'"><i class="fa fa-envelope-square fa-1x"></i></span><span class="align-middle" style="padding-left:5px;">'+ data[i].email +'</span></div></div><p>'+ data[i].description +'</p></li></ul></div></div></div>');
                        }
                    }
                }
            });
        }

        var loadWork = function (page) {

            $.ajax({
                type: 'GET',
                url: '{!! url('/api/work') !!}' + '?order_type=desc&all=n&paginate=3&agency_id={{$id}}&page=' + page,
                dataType: 'json',
                success: function (data) {
                    var data = data;
                    var section = $('#section-container');

                    $.each(data.data, function (i, val) {
                        var template = $('#template').clone();
                        $(template.find('a')).attr('href', "{{url('/work')}}/" + val.id);
                        $(template.find('.image-project')).css('background-image', 'url(\'' + val.main_image_link + '\')');
                        $(template.find('.title h5')).html(val.name);
                        $(template.find('.sub-title')).html(val.client);
                        template.removeAttr('id');
                        section.append(template);
                    });

                    if (data.current_page >= data.last_page) {
                        $('.load-more').fadeOut();
                    } else {
                        $('.load-more').fadeIn();
                    }
                }
            });
        }

    </script>
@endsection
