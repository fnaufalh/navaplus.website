@extends('layouts.app')

@section('content')
<section id="our-works" class="section-holder clients">
    <div class="section-header">
        <div class="max-width display-flex">
            <div><h3 class="text-white">Integrated Services</h3></div>
        </div>
    </div>
    <div class="section-content max-width display-flex flex-wrap" style="margin-top: 50px">
    </div>
</section>
@endsection
@section('script')
  <script>
      $(document).ready(function(){
          $.ajax({
              type: 'GET',
              url: '{!! url('/api/client?order_by=id&order_type=asc&all=n') !!}',
              dataType: 'json',
              success: function(data){
                  var data = data;
                  if (data.length != 0 ) {
                      for (var i = 0; i < data.length; i++) {
                          $('#our-works').find('.section-content').append('<div class="client-holder"><div class="item"><img src="'+ data[i].image_link +'"></div></div>');
                      }
                  }
                  console.log(data);
              }
          });
      });
  </script>
@endsection
