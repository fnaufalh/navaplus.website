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
  <script type="text/javascript" src="{{asset("js/about.js")}}">

  </script>
@endsection
