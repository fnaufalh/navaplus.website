<html>

<head>
    <title>Nava+</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Encode+Sans:400,600" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset("css/bootstrap.min.css")}}">
    <link rel="stylesheet" href="{{asset("css/main.css?v=201808141825")}}">
    @yield('style')
</head>

<body>

<header>
    <div class="max-width display-flex">
        <div class="logo-holder">
            <div class="hamburger hamburger--spin js-hamburger">
                <div class="hamburger-box">
                    <div class="hamburger-inner">
                    </div>
                </div>
            </div>
            <div class="menu-holder">
                <div class="nav-menu-holder">
                    <ul>
                        <li><a href="{{url('/')}}">Home</a></li>
                        <li><a href="{{url('/about')}}">About</a></li>
                        <li><a href="#" onclick="return false" class="open-agencies">Agency</a>
                            <ul class="ml-1 nav-agency-section">
                                <li class="template" id="nav-agency-template"><a href=""></a></li>
                            </ul>
                        </li>
                        <li><a href="{{url('/work')}}">Work</a></li>
                        <li><a href="{{url('/services')}}">Integrated Services</a></li>
                        <li><a href="{{url('/news')}}">News</a></li>
                        <li><a href="{{url('/contact-us')}}">Contact</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="title-holder title-align">
            <a href="{{url('/')}}">
                <img src="{{asset("images/title.png")}}" alt="Nava+">
            </a>
        </div>
        <div class="right-holder">

          </div>
      </div>
  </header>

  <section id="sites-section">
@yield('content')

  <footer id="contact">
      <div class="max-width display-flex">
          <div class="left-holder">
              &copy;2018 NAVAPLUS GROUP INDONESIA
          </div>
          <div class="center-holder text-center">
              <a target="_blank" href="https://www.facebook.com/navaplusid/">
                <div class="social-logo text-white">
                  <i class="fa fa-facebook"></i>
                </div>
              </a>
              <a target="_blank" href="https://www.instagram.com/navaplus.id/">
                <div class="social-logo text-white">
                  <i class="fa fa-instagram"></i>
                </div>
              </a>
              <a target="_blank" href="https://id.linkedin.com/company/nava-group">
                <div class="social-logo text-white">
                  <i class="fa fa-linkedin"></i>
                </div>
              </a>
          </div>
          <div class="right-holder"></div>
      </div>
  </footer>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
          integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
          crossorigin="anonymous"></script>
  <script src="{{asset("js/main.js?v=201808062217")}}"></script>
  <script src="{{asset("js/hamburger.js")}}"></script>
@yield('script')
      <script>
          $.ajax({
              type: 'GET',
              url: '{!! url('/api/agency?order_by=id&order_type=asc') !!}',
              dataType: 'json',
              success: function (data) {
                  var data = data;
                  var agency = $('.nav-agency-section');
                  $.each(data, function(i, val){
                      var template = $('#nav-agency-template').clone();
                      var link = template.find('a');
                      $(link).attr('href', "{{url('/agency')}}/"+val.name);
                      $(link).html(val.name);

                      template.removeAttr('id');
                      agency.append(template);

                  });
              }
          });
      </script>
</body>

</html>
