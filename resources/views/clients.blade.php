@extends('layouts.app')

@section('content')
<section id="our-works" class="section-holder">
    <div class="section-header">
        <div class="max-width display-flex">
            <div><h3 class="text-white">Our Clients</h3></div>
        </div>
    </div>
    <div class="section-content max-width display-flex flex-wrap" style="margin-top: 50px">
    </div>
</section>
@endsection
@section('script')
  <script type="text/javascript" src="{{asset("js/clients.js")}}">

  </script>
@endsection
