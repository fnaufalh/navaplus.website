@extends('layouts.app')

@section('content')

<section id="sites-section" class="about-page">
    <div class="max-width">
        <div class="row about">
          <div class="col-md-8 pull-md-6 col-xs-12">
            <div class="quotes">
                <div class="top-border"></div>
                <p><!-- Description --></p>
            </div>
            <div class="vision-mission">
                <div>
                    <h3 class="font-weight-bold">Vision</h3>
                    <p><!-- Vision --></p>
                    <h3 class="font-weight-bold">Mission</h3>
                    <p><!-- Mission --></p>
                </div>
            </div>
          </div>
        </div>
    </div>
</section>
<section id="whats-going-on" class="section-holder">
    <div class="section-image">
    </div>
    <div class="section-content bod">
        <div class="max-width">
            <div class="row">
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
              url: '{{url('/api/about')}}',
              dataType: 'json',
              success: function(data){
                  var data = data['data'];
                  $('.quotes > p').html(data.description);
                  $('.vision-mission > div > p').html(data.vision);
                  $('.vision-mission > div > p:last-child').html(data.mission);
                  $('.section-image').css('background-image', 'url('+ data.image_link +')');
              }
          });

          $.ajax({
              type: 'GET',
              url: '{!!url('/api/people?agency_id=9&order_type=asc')!!}',
              dataType: 'json',
              success: function(data){
                  var data = data;
                  if (data.length != 0 ) {
                      for (var i = 0; i < data.length; i++) {
                          $('.bod').find('.row').append('<div class="col-sm-12 col-md-9 about-item d-flex"><img class="img-responsive" src="'+ data[i].image_link +'" alt="Profile"><div class="description"><h5>'+ data[i].name +'</h5><h6>'+ data[i].department +'</h6><div class="email-holder"><div class="email"><span class="email-icon align-middle"><i class="fa fa-envelope-square fa-1x"></i></span><a href="mailto:'+ data[i].email +'"><span class="align-middle" style="padding-left:5px;">'+ data[i].email +'</span></a></div></div><p>'+ data[i].description +'</p></div></div>');
                      }
                  }
              }
          });
      });
  </script>
@endsection
