@extends('layouts.app')

@section('content')
    <section id="our-works" class="section-holder">
        <div class="section-header">
            <div class="max-width display-flex">
                <div><h3 class="text-white">Our Works</h3></div>
                <div class="btn-dropdow no-mobile-work">
                    <select class="category select form-control">
                        <option value="0">Category</option>
                    </select>
                    <select class="agency select form-control">
                        <option value="0">Agency</option>
                    </select>
                </div>
            </div>
        </div>
    </section>
    <section id="whats-going-on" class="section-holder whats-going-on-site">

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
        var page = 1;
        var apiLink = '';
        $(document).ready(function () {
            $.ajax({
                type: 'GET',
                url: '{{url('/api/category?order_type=asc&all=n')}}',
                dataType: 'json',
                success: function (data) {
                    var data = data;
                    var section = $('.category');
                    $.each(data, function (i, val) {
                        section.append("<option value='" + val.id + "'>" + val.name + "</option>");
                    });
                }
            });
            $.ajax({
                type: 'GET',
                url: '{{url('/api/agency?order_type=asc&all=n')}}',
                dataType: 'json',
                success: function (data) {
                    var data = data;
                    var section = $('.agency');
                    $.each(data, function (i, val) {
                        section.append("<option value='" + val.id + "'>" + val.name + "</option>");
                    });
                }
            });
            workByAgency();
            $('.agency').change(function () {
                workByAgency();
            });
            $('.category').change(function () {
                workByCategory();
            });
            $('.load-more').click(function (){
                var agencyId = $('.agency').val();
                var categoryId = $('.category').val();
                page++;
                if(categoryId != 0) {
                    apiLink = '{!! url('/api/work/category') !!}' + '/' + categoryId + '?paginate=9&page=' + page;
                    callAjaxCategory(apiLink);
                }
                else {
                    apiLink = '{!! url('/api/work') !!}' + '?order_type=desc&all=n&paginate=9&agency_id=' + agencyId + '&page=' + page;
                    callAjaxAgency(apiLink);
                }
            });
        });
        var workByAgency = function () {
            var agencyId = $('.agency').val();
            page = 1;
            apiLink = '{!! url('/api/work') !!}' + '?order_type=desc&all=n&paginate=9&agency_id=' + agencyId + '&page=' + page;
            $('.category').val(0);
            $('#section-container').html('');
            callAjaxAgency(apiLink);
        }
        var callAjaxAgency = function (apiLink) {
            $.ajax({
                type: 'GET',
                url: apiLink,
                dataType: 'json',
                success: function (data) {
                    var data = data;
                    var section = $('#section-container');
                    $.each(data.data, function (i, val) {
                        var template = $('#template').clone();
                        $(template.find('a')).attr('href', "{{url('/work')}}/" + val.id);
                        $(template.find('.image-project')).css('background-image', 'url(\'' + val.preview_image_link + '\')');
                        $(template.find('.title h5')).html(val.name);
                        $(template.find('.sub-title')).html(val.client);
                        template.removeAttr('id');
                        section.append(template);
                    });
                    if (data.current_page >= data.last_page) {
                        $('.load-more').fadeOut();
                    } else {
                        $('.load-more').fadeIn();
                    }
                }
            });
        }
        var workByCategory = function () {
            var categoryId = $('.category').val();
            if (categoryId == 0) {
                page = 1;
                workByAgency();
            }
            page = 1;
            apiLink = '{!! url('/api/work/category') !!}' + '/' + categoryId + '?paginate=9&page=' + page;
            $('.agency').val(0);
            $('#section-container').html('');
            callAjaxCategory(apiLink);
        }
        var callAjaxCategory = function (apiLink) {
            $.ajax({
                type: 'GET',
                url: apiLink,
                dataType: 'json',
                success: function (data) {
                    var data = data;
                    var section = $('#section-container');
                    $.each(data.data, function (i, val) {
                        var template = $('#template').clone();
                        $(template.find('a')).attr('href', "{{url('/work')}}/" + val.id);
                        $(template.find('.image-project')).css('background-image', 'url(\'' + val.preview_image_link + '\')');
                        $(template.find('.title h5')).html(val.name);
                        $(template.find('.sub-title')).html(val.client);
                        template.removeAttr('id');
                        section.append(template);
                    });
                    if(data.current_page >= data.last_page) {
                        $('.load-more').fadeOut();
                    }else {
                        $('.load-more').fadeIn();
                    }
                }
            });
        }
    </script>
@endsection
