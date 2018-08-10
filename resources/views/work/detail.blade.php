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
<section id="work-detail-banner" class="max-width">
    <div id="main_image" style="object-fit:cover;background-position:center;"></div>
    <div class="display-flex flex-wrap">
        <div id="image_1" class="col-md-6 col-xs-12" style="object-fit:cover;background-position:center;"></div>
        <div id="image_2" class="col-md-6 col-xs-12" style="object-fit:cover;background-position:center;"></div>
    </div>
</section>
<section id="sites-section" class="work-detail-page" style="background-color: white">
    <div class="max-width display-flex">
        <div class="left-section">
            <div class="quotes">
                <div class="metainfo">
                    <div class="display-flex">
                        <div>Project</div>
                        <div id="project"></div>
                    </div>
                    <div class="display-flex">
                        <div>Client</div>
                        <div id="client"></div>
                    </div>
                    <div class="display-flex">
                        <div>Agency</div>
                        <div id="agency"></div>
                    </div>
                    <div class="display-flex">
                        <div>Service</div>
                        <div id="service"></div>
                    </div>
                </div>
            </div>
            <h3 id="headline"></h3>
            <p id="description"></p>
            <div class="work-nav">
                <div class="text-right" style="display: inline-block">
                    <a class="display-flex" href="{{url('/work')}}">
                        <div class="text-back-works">
                            <i class="fa fa-chevron-left"></i> See all case studies
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
                <div class="info">
                    <div class="title">
                        <h5></h5>
                    </div>
                    <div class="sub-title"></div>
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
                url: '{{url("/api/work/".$id)}}',
                dataType: 'json',
                success: function (data) {
                    var data = data;
                    $('#main_image').css('background-image', 'url(\'' + data.main_image_link + '\')');
                    $('#image_1').css('background-image', 'url(\'' + data.main_1_link + '\')');
                    $('#image_2').css('background-image', 'url(\'' + data.main_2_link + '\')');
                    $('#project').html(data.name);
                    $('#client').html(data.client);
                    $('#agency').html(data.agency.name);

                    var services = [];
                    $.each(data.categories, function(i, val){
                        services.push(val.name);
                    });
                    $('#service').html(services.join(', '));

                    $('#headline').html(data.quote);
                    $('#description').html(data.description);

                    $.ajax({
                        type: 'GET',
                        url: '{!! url("/api/work?all=n&paginate=3&except=$id&agency_id=") !!}'+data.agency.id,
                        dataType: 'json',
                        success: function (data) {
                            var data = data;
                            var section = $('#section-container');

                            $.each(data.data, function (i, val) {
                                var template = $('#template').clone();
                                $(template.find('a')).attr('href', "{{url('/work')}}/"+val.id);
                                $(template.find('.image-project')).css('background-image', 'url(\'' + val.preview_image_link + '\')');
                                $(template.find('.title h5')).html(val.name);
                                $(template.find('.sub-title')).html(val.client);
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
