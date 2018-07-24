@extends('layouts.app')

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
            <div class="left-section">
                <h2 id="date"></h2>
                <h3 id="headline"></h3>
                <p id="description"></p>
                <div style="padding-top: 45px;padding-bottom: 71px;text-align: right">
                    <div class="text-right" style="display: inline-block">
                        <a class="display-flex" href="{{url('/news')}}">
                            <div class="icon-back">
                                <i class="fa fa-chevron-left"></i>
                            </div>
                            <div class="text-back">
                                Back to news
                            </div>
                        </a>
                    </div>
                    <div class="pull-left">
                        <a class="display-flex" href="#">
                            <div class="icon-share">
                                <i class="fa fa-share"></i>
                            </div>
                            <div class="text-share">
                                Share this news
                            </div>
                        </a>
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
@endsection
@section('script')
    <script>

        $(document).ready(function () {

            $.ajax({
                type: 'GET',
                url: "https://www.aashari.id/form-asia/navaplus/cms/public/api/news/{{$id}}",
                dataType: 'json',
                success: function (data) {
                    var data = data;
                    $('#image-banner').css('background-image', 'url(\'' + data.image_link + '\')');
                    $('#date').html(data.date_formated + " | " + data.type);
                    $('#headline').html(data.headline);
                    $('#description').html(data.description);

                    $.ajax({
                        type: 'GET',
                        url: 'https://www.aashari.id/form-asia/navaplus/cms/public/api/news?take=3',
                        dataType: 'json',
                        success: function (data) {
                            var data = data;
                            var section = $('#section-container');

                            $.each(data, function (i, val) {
                                var template = $('#template').clone();
                                $(template.find('a')).attr('href', "{{url('/news')}}/" + val.id);
                                $(template.find('.image-project')).css('background-image', 'url(\'' + val.image_link + '\')');
                                $(template.find('.title h5')).html(val.name);
                                $(template.find('.sub-title')).html(val.date_formated + " | " + val.type);
                                template.removeAttr('id');
                                section.append(template);

                            });
                        }
                    });

                }
            });

        });

    </script>
@endsection