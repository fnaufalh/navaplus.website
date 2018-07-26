@extends('layouts.app')

@section('content')
    <section id="whats-going-on" class="section-holder" style="background-color: white">
        <div class="section-header">
            <div class="max-width display-flex">
                <div><h3 class="text-white">News</h3></div>
            </div>
        </div>

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
        <div class="text-center">
            <div class="load-more">
                <div class="display-flex text-center">
                    <a href="#load-more">
                        <span class="text-more" style="color:#676767;">More</span>
                        <span class="icon-more" style="color:#676767;"><i class="fa fa-arrow-circle-down"></i></span>
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script>

        $(document).ready(function () {
            page = 1;

            $('.load-more').click(function(){
               page++;
                getNews(page);
            });

            getNews(page);

        });

        var getNews = function(page) {

            $.ajax({
                type: 'GET',
                url: '{!! url('/api/news?all=n&paginate=9&page=') !!}'+page,
                dataType: 'json',
                success: function (data) {
                    var data = data;
                    var section = $('#section-container');

                    $.each(data.data, function (i, val) {
                        var template = $('#template').clone();
                        $(template.find('a')).attr('href', "{{url('/news')}}/" + val.id);
                        $(template.find('.image-project')).css('background-image', 'url(\'' + val.image_link + '\')');
                        $(template.find('.title h5')).html(val.name);
                        $(template.find('.sub-title')).html(val.date_formated + " | " + val.type);
                        template.removeAttr('id');
                        section.append(template);
                    });

                    if(data.current_page >= data.last_page) {
                        $('.load-more').fadeOut();
                    }
                }
            });

        }
    </script>
@endsection
