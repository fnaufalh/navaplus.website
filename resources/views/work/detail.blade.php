@extends('layouts.app')

@section('content')
<section id="work-detail-banner" class="max-width">
    <div style="background-image: url('assets/work n news page/03 Work/Box 1@2x.png'); object-fit:cover;background-position:center;"></div>
    <div class="display-flex flex-wrap">
        <div class="col-md-6 col-xs-12" style="background-image: url('assets/work n news page/03 Work/Box 2@2x.png'); object-fit:cover;background-position:center;"></div>
        <div class="col-md-6 col-xs-12" style="background-image: url('assets/work n news page/03 Work/Box 3@2x.png'); object-fit:cover;background-position:center;"></div>
    </div>
</section>
<section id="sites-section" class="work-detail-page" style="background-color: white">
    <div class="max-width display-flex">
        <div class="left-section">
            <div class="quotes">
                <div class="metainfo">
                    <div class="display-flex">
                        <div>Project</div>
                        <div>Sampoerna Step Up</div>
                    </div>
                    <div class="display-flex">
                        <div>Client</div>
                        <div>Sampoerna Academy</div>
                    </div>
                    <div class="display-flex">
                        <div>Agency</div>
                        <div>Pathfindrs</div>
                    </div>
                    <div class="display-flex">
                        <div>Service</div>
                        <div>Branding, Communication</div>
                    </div>
                </div>
            </div>
            <h3>Donec dictum fermentum neque, eget tempus felis semper ac. Curabitur vestibulum elit sed purus eleifend
                sollicitudin. Etiam scelerisque.</h3>
            <p>Cras et nunc erat. Proin molestie eget lorem id vulputate. Aenean posuere dolor eget ante accumsan,
                consequat fermentum velit ullamcorper. Donec ultrices tincidunt feugiat. Mauris mollis sapien at posuere
                sodales. Sed neque velit, mattis sed arcu nec, dapibus venenatis augue. Integer non tempor massa, id
                consequat purus. Vestibulum maximus tortor ipsum, a condimentum risus volutpat at. Curabitur sed velit
                lobortis, commodo sem quis, ultricies felis. Proin id metus dapibus, fermentum neque nec, commodo lorem.
                <br>
                <br>
                Etiam hendrerit ultrices enim rhoncus luctus. Fusce et convallis enim. Mauris eget pretium lacus. Lorem
                ipsum dolor sit amet, consectetur adipiscing elit. Donec neque enim, tempor in tristique faucibus,
                tempor a eros. Praesent scelerisque leo id ante auctor scelerisque. Pellentesque vel ultrices urna, in
                varius ante. Morbi mi metus, bibendum a dui ac, feugiat mollis dolor. Aliquam mattis, purus in venenatis
                rutrum, massa sapien scelerisque nunc, at consectetur leo metus id orci. Quisque luctus vel nunc ut
                egestas. Nullam maximus, libero vel tempor posuere, diam mi facilisis diam, et feugiat leo dui nec sem.
                Cras ornare, urna lacinia ullamcorper mollis, turpis velit pretium dolor, ac fringilla leo sem ac
                nibh.</p>
                <div style="padding-top: 45px;padding-bottom: 71px;text-align: right">
                    <div class="text-right" style="display: inline-block">
                        <a class="display-flex" href="work.html">
                            <div class="icon-back">
                                <i class="fa fa-chevron-left"></i>
                            </div>
                            <div class="text-back-works">
                                Back to works
                            </div>
                        </a>
                    </div>
                </div>
        </div>
    </div>
</section>
<section id="whats-going-on" class="section-holder" style="padding-bottom:70px; background-color: white">
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
  </div>
</section>
@endsection
@section('script')
    <script type="text/javascript" src="{{asset("js/work-detail.js")}}"></script>
@endsection
