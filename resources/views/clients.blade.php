@extends('layouts.app')

@section('content')
<section id="our-works" class="section-holder clients">
    <div class="section-header">
        <div class="max-width display-flex">
            <div><h3 class="text-white">Integrated Services</h3></div>
        </div>
    </div>
    <div class="section-content max-width" style="margin-top: 50px">
      <div class="container-fluid">
        <div class="row">

        </div>
      </div>
    </div>
</section>
@endsection
@section('script')
  <script>
      $(document).ready(function(){
          $('footer').css('margin-top', '100px');
          $.ajax({
              type: 'GET',
              url: '{!! url('/api/client?order_by=id&order_type=asc&all=n') !!}',
              dataType: 'json',
              success: function(data){
                  var data = data;
                  if (data.length != 0 ) {
                      for (var i = 0; i < data.length; i++) {
                          $('#our-works').find('.row').append('<div class="col-sm-5cols col-xs-6"><img class="m-2 clients-img" src="'+ data[i].image_link +'"></div>');
                      }
                  }

                  var height = $('#sites-section').height();
                  var width = $('#sites-section').width()

                  if ((width > 1024 && height <= 800) || (width <= 1024 && width > 768 && height < 1366)) {
                    $('footer').addClass('bottom-footer');
                  }else {
                    $('footer').removeClass('bottom-footer');
                  }

                  if (width <= 1024) {
                    $('.row > div').removeClass('col-sm-5cols');
                    $('.row > div > img').removeClass('m-2');
                  }
              }
          });
      });
  </script>
@endsection
