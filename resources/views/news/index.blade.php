@extends('layouts.app')

@section('content')
<section id="whats-going-on" class="section-holder" style="background-color: white">
    <div class="section-header">
        <div class="max-width display-flex">
            <div><h3 class="text-white">News</h3></div>
        </div>
    </div>
    <div class="section-content max-width d-flex flex-wrap">
    </div>
    <div class="text-center">
      <div class="load-more">
          <div class="display-flex text-center">
                <a class="more" href="#">
                  <span class="text-more" style="color:#676767;">
                      More
                  </span>
                  <span class="icon-more" style="color:#676767;">
                      <i class="fa fa-arrow-circle-down"></i>
                  </span>
                </a>
          </div>
      </div>
    </div>
</section>
@endsection
@section('script')
    <script type="text/javascript" src="{{asset("js/news.js")}}"></script>
@endsection
