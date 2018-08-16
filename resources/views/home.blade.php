@extends('layouts.app')

@section('content')
      <div class="max-width display-flex agency-logo">
          <div class="left-section">
              <div class="quotes-home">
                  <div id="carousel-nava-landscape" class="carousel slide mobile" data-ride="carousel">
                      <ol class="carousel-indicators">
                        {{-- TEMPLATE - BEGIN --}}
                          <li data-target="#carousel-nava-landscape" data-slide-to="0" class="indicators active" id="landscape_indicators_template"></li>
                          {{-- TEMPLATE - END --}}
                      </ol>
                      <div class="carousel-inner">
                        {{-- TEMPLATE - BEGIN --}}
                          <div class="carousel-item item active" id="landscape_template">
                              <img class="d-block w-100 img-slider" src="https://placeimg.com/350/510/any/grayscale">
                              <div class="carousel-caption d-md-block">
                                  <h5></h5>
                              </div>
                          </div>
                          {{-- TEMPLATE - END --}}
                      </div>
                  </div>
                  <div id="carousel-nava-potrait" class="carousel slide no-mobile" data-ride="carousel">
                      <ol class="carousel-indicators">
                        {{-- TEMPLATE - BEGIN --}}
                          <li data-target="#carousel-nava-potrait" data-slide-to="0" class="indicators active" id="potrait_indicators_template"></li>
                          {{-- TEMPLATE - END --}}
                      </ol>
                      <div class="carousel-inner">
                          {{-- TEMPLATE - BEGIN --}}
                          <div class="carousel-item item active" id="potrait_template">
                              <img class="d-block w-100 img-slider" src="https://placeimg.com/350/510/any/animal">
                              <div class="carousel-caption d-none d-md-block">
                                  <h5></h5>
                              </div>
                          </div>
                          {{-- TEMPLATE - END --}}
                      </div>
                  </div>
              </div>
          </div>
          <div class="right-section site-holder">
              <div class="display-flex agency-section">
                  {{-- TEMPLATE - BEGIN --}}
                  <a id="agency-template" href="{{url('/agency/1')}}" class="site-item" style="background-color: #5a2b81;">
                      <div class="hover-holder display-flex">
                          <div class="tagline">Every brand has it's own path</div>
                      </div>
                      <div class="site-name">Pathfinders</div>
                      <!-- logo and description agency -->
                      <!-- acc plus-->
                  </a>
                  {{-- TEMPLATE - END --}}
              </div>
          </div>
      </div>
    </section>

    <section id="whats-going-on" class="section-holder">
        <div class="section-header">
            <div class="max-width display-flex">
                <div><h3 class="text-white">What's going on</h3></div>
            </div>
        </div>

        {{-- TEMPLATE - BEGIN --}}
        <div class="section-content-item" id="template">
            <div class="image-project">
                <a href="">
                    <div class="info" style="text-align:left;">
                        <div class="sub-title" style="text-transform:uppercase;"></div>
                        <div class="title"><h5></h5></div>
                    </div>
                </a>
            </div>
        </div>
        {{-- TEMPLATE - END --}}


        <div class="section-content max-width d-flex flex-wrap" id="section-container">

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
                                <a href="mailto:recruitment@navaplus.com" class="text-white" id="general_email"><span class="align-middle">hello@navaplus.com</span></a>
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
                                <a href="mailto:recruitment@navaplus.com" class="text-white" id="career_email"><span class="align-middle">recruitment@navaplus.com</span></a>
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
                                src="https://www.google.com/maps/embed/v1/place?key={{env('API_MAP_KEY')}}&q=Generali+Tower+Gran+Rubina+Business+Park"
                                allowfullscreen>
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script>
        $(document).ready(function () {
          $('.carousel').carousel({
            interval: 3000
          });

          $.ajax({
              type: 'GET',
              url: '{!! url('/api/agency?order_by=id&order_type=asc') !!}',
              dataType: 'json',
              success: function (data) {
                  var data = data;
                  var agency_template = $('.agency-section');
                  $.each(data, function(i, val){
                    var template = $('#agency-template').clone();
                    template.attr('href', "{{url('/agency')}}/"+val.id).attr('style', 'background-color:'+ val.background_color);
                    template.find('.tagline').html(val.motto);
                    template.find('.site-name').html(val.name);

                    if (i % 2 !== 0) {
                        template.append('<div class="site-description">'+ (val.title == null ? '' : val.title) +'</div><div class="site-logo" '+ (val.id == 1 ? 'style="right:0"' : 'style="text-align:center"') +'><img src="'+ val.icon_link +'" alt="'+ val.name+ '"></div>').after('.site-name');
                    } else {
                      template.append('<div class="site-logo"'+ (val.id == 1 ? 'style="right:0"' : 'style="text-align:center"') +'><img src="'+ val.icon_link +'"'+ (val.id == 1 ? 'style="left:auto; top: 5px;"' : '') +' alt="'+ val.name+ '"></div><div class="site-description">'+
                      (val.title == null ? '' : val.title) +'</div>').after('.site-name');
                    }

                    if (i == 0) {
                      template.append('<div class="bar-white-vertical"></div><div class="bar-white-horizontal"></div>');
                    }
                    else if(i == 1) {
                      template.append('<div class="bar-white-vertical left"></div><div class="bar-white-horizontal left"></div><div class="bar-white-vertical"></div><div class="bar-white-horizontal"></div>');
                    }
                    else if(i == 2) {
                      template.append('<div class="bar-white-vertical left"></div><div class="bar-white-horizontal left"></div><div class="bar-white-vertical"></div><div class="bar-white-horizontal"></div>');
                    }else if(i == 3) {
                      template.append('<div class="bar-white-vertical left"></div><div class="bar-white-horizontal left"></div>');
                    }
                    else if(i == 4) {
                      template.append('<div class="bar-white-vertical top"></div><div class="bar-white-horizontal top"></div>');
                    }else if(i == 5) {
                      template.append('<div class="bar-white-vertical left top"></div><div class="bar-white-horizontal left top"></div><div class="bar-white-vertical top"></div><div class="bar-white-horizontal top"></div>');
                    }else if(i == 6) {
                      template.append('<div class="bar-white-vertical left top"></div><div class="bar-white-horizontal left top"></div><div class="bar-white-vertical top"></div><div class="bar-white-horizontal top"></div>');
                    }else if(i == 7) {
                      template.append('<div class="bar-white-vertical left top"></div><div class="bar-white-horizontal left top"></div>');
                    }
                    template.removeAttr('id');
                    agency_template.append(template);

                  });
                  agency_template.find('a').first().remove();
              }
          });

            $.ajax({
                type: 'GET',
                url: '{{ url('/api/setting') }}',
                dataType: 'json',
                success: function (data) {
                    var data = data;

                    $('#general_email').html(data.general_email);
                    $('#career_email').html(data.career_email);

                    $('#general_email').attr('href', 'mailto:'+data.general_email);
                    $('#career_email').attr('href', 'mailto:'+data.career_email);
                }
            });

            $.ajax({
                type: 'GET',
                url: '{!! url('/api/news?all=n&paginate=3') !!}',
                dataType: 'json',
                success: function (data) {
                    var data = data;
                    var section = $('#section-container');

                    $.each(data.data, function (i, val) {
                        var template = $('#template').clone();
                        $(template.find('a')).attr('href', "{{url('/news')}}/" + val.id);
                        $(template.find('.image-project')).css('background-image', 'url(\'' + val.preview_image_link + '\')');
                        $(template.find('.title h5')).html(val.name);
                        $(template.find('.sub-title')).html(val.date_formated + " | " + val.type);
                        template.removeAttr('id');
                        section.append(template);

                    });
                }
            });

            $.ajax({
              type: 'GET',
              url: '{!! url('/api/slider') !!}',
              dataType: 'json',
              success: function (data) {
                // var x = 0;
                var data = data;
                var landscape_indicators = $('#carousel-nava-landscape > ol.carousel-indicators');
                var landscape_item = $('#carousel-nava-landscape > .carousel-inner');
                var potrait_item = $('#carousel-nava-potrait > .carousel-inner');
                var potrait_indicators = $('#carousel-nava-potrait > ol.carousel-indicators');
                for (var i = 0; i < data.length; i++) {
                  var landscape_indicators_template = landscape_indicators.find('#landscape_indicators_template').clone();
                  landscape_indicators_template.attr('data-slide-to', i).slice(1).removeClass('active');
                  landscape_indicators_template.removeAttr('id');
                  landscape_indicators.append(landscape_indicators_template);

                  var potrait_indicators_template = potrait_indicators.find('#potrait_indicators_template').clone();
                  potrait_indicators_template.attr('data-slide-to', i).slice(1).removeClass('active');
                  potrait_indicators_template.removeAttr('id');
                  potrait_indicators.append(potrait_indicators_template);

                  var landscape_template = landscape_item.find('#landscape_template').clone();
                  landscape_template.removeClass('active')
                  $(landscape_template.find('img')).attr('src', data[i].image_horizontal_link).attr('alt', data[i].quote);
                  $(landscape_template.find('h5')).html(data[i].quote);
                  landscape_template.removeAttr('id');
                  landscape_item.append(landscape_template);

                  var potrait_template = potrait_item.find('#potrait_template').clone();
                  potrait_template.removeClass('active')
                  $(potrait_template.find('img')).attr('src', data[i].image_potrait_link).attr('alt', data[i].quote);
                  $(potrait_template.find('h5')).html(data[i].quote);
                  potrait_template.removeAttr('id');
                  potrait_item.append(potrait_template);
                }
                landscape_item.find('.carousel-item').first().remove();
                landscape_indicators.find('.indicators').first().remove();
                landscape_item.find('.carousel-item').first().addClass('active');
                landscape_item.find('.indicators').first().addClass('active');

                potrait_item.find('.carousel-item').first().remove();
                potrait_indicators.find('.indicators').first().remove();
                potrait_item.find('.carousel-item').first().addClass('active');
                potrait_item.find('.indicators').first().addClass('active');
              }
            });

        });
    </script>
@endsection
