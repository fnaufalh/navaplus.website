@extends('layouts.app')

@section('style')
    <style type="text/css">
        @media only screen and (max-width: 600px) {
            #sites-section > .display-flex {
                flex-direction: initial !important;
            }
        }

        @media only screen and (max-width: 1024px) {
            #sites-section > .display-flex {
                flex-direction: initial !important;
            }
        }
    </style>
@endsection

@section('content')
    <section class="section-holder" style="background-color: white">
        <div class="section-header">
            <div class="max-width display-flex">
                <div><h3 class="text-white">News</h3></div>
            </div>
        </div>
    </section>

    <section id="site-banner" class='max-width'>
        <div class="max-width" id="image-banner"></div>
    </section>

    <section id="sites-section" class="work-detail-page" style="background-color: white">
        <div class="max-width display-flex">
            <div class="container padding-detail-news">
              <div class="row">
                <div class="col-md-8 col-xs-12 col-md-push-4">
                  <h2 id="date"></h2>
                  <h3 id="headline"></h3>
                  <p id="description"></p>
                  <div style="padding-top: 45px;padding-bottom: 71px; display:flex;justify-content:space-between;line-height:20px;" class="icons">
                      <div class="text-right">
                          <a class="display-flex" href="{{url('/news')}}">
                              <i class="fa fa-chevron-left text-color"></i>
                              <div class="text-back">
                                  Back to news
                              </div>
                          </a>
                      </div>
                      <div class="">
                          <a class="display-flex" id="news" href="" data-toggle="modal" data-target="#share-modal">
                            <i class="icon-share fa fa-share-square-o"></i>
                            <div class="text-share">
                                Share this news
                            </div>
                          </a>
                      </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </section>

    <section id="whats-going-on" class="section-holder" style="padding-bottom:70px; background-color: white">

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

    <div class="modal" tabindex="-1" role="dialog" id="share-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Share this news!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="input-group">
                      <input type="text" readonly class="form-control url-news">
                      <div class="input-group-append">
                        <button class="btn btn-info copy">Copy</button>
                      </div>
                    </div>
                    <p style="text-align: right" class="note"><small>Copy this link to share.</small></p>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>

        $(document).ready(function () {
            $('.url-news').val(window.location.href);
            $('.copy').on('click', function(){
              var copy_text = $('.url-news');
              copy_text.select();
              document.execCommand('copy');
              $('.note > small').html('Copied').css('color', 'red');
            });

            $.ajax({
                type: 'GET',
                url: '{{url('/api/news/'.$id)}}',
                dataType: 'json',
                success: function (data) {
                    var data = data;
                    $('#image-banner').css('background-image', 'url(\'' + data.image_link + '\')');
                    $('#date').html(data.date_formated + " | " + data.type);
                    $('#headline').html(data.headline);
                    $('#description').html(data.description);
                }
            });

            $.ajax({
                type: 'GET',
                url: '{!! url("/api/news?all=n&except=$id&paginate=3")  !!}',
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

        });
    </script>
@endsection
