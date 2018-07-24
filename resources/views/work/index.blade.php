@extends('layouts.app')

@section('content')
<section id="our-works" class="section-holder">
    <div class="section-header">
        <div class="max-width display-flex">
            <div><h3 class="text-white">Our Works</h3></div>
            <div class="btn-dropdow">
                <select class="category select form-control">
                  <option>Category</option>
                  <option>Community Marketing, Digital</option>
                  <option>Brand Activation</option>
                  <option>Community Marketing</option>
                  <option>Trade Marketing</option>
                </select>
                <select class="agency select form-control">
                  <option>Interface</option>
                  <option>IRIS</option>
                  <option>ADVIS</option>
                  <option>Pathfinders</option>
                </select>
            </div>
        </div>
    </div>
</section>

<section id="whats-going-on" class="section-holder whats-going-on-site">
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
    <div class="text-center">
        <div class="load-more">
            <div class="display-flex text-center">
                  <a class="more" href="#">
                    <span class="text-more" style="color:#333;">
                        More
                    </span>
                    <span class="icon-more" style="color:#333;">
                        <i class="fa fa-arrow-circle-down"></i>
                    </span>
                  </a>
            </div>
        </div>
    </div>
</section>
@endsection
@section('script')
    <script type="text/javascript" src="{{asset("js/work.js")}}"></script>
@endsection
