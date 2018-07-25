@extends('layouts.app')

@section('content')
    <section id="our-works" class="section-holder">
        <div class="section-header">
            <div class="max-width display-flex">
                <div><h3 class="text-white">Our Works</h3></div>
                <div class="btn-dropdow">
                <div class="select">
                    <div class="selected dropdown-selected">
                        <div class="arrow-down"><img src="{{asset('images/arrow.svg')}}" alt="">
                        </div>
                        Category
                    </div>
                    <div class="category selectList">
                    </div>
                </div>
                <div class="select">
                    <div class="selected dropdown-selected">
                        <div class="arrow-down"><img src="{{asset('images/arrow.svg')}}" alt="">
                        </div>
                        Agency
                    </div>
                    <div class="agency selectList">
                    </div>
                </div>
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

    </section>
@endsection
@section('script')

    <script>
        $(document).ready(function () {

            $.ajax({
                type: 'GET',
                url: '{{url('/api/category?order_type=asc&all=n')}}',
                dataType: 'json',
                success: function (data) {
                    var data = data;
                    var section = $('.category');

                    $.each(data, function (i, val) {
                        section.append('<div class="select" data-id=' + val.id + '><div>' + val.name + '</div></div>');
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
                        section.append('<div class="select" data-id=' + val.id + '><div>' + val.name + '</div></div>');
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

        });

        var workByAgency = function () {

            $('.category').val(0);
            var agencyId = $('.agency > .select').data('id');
            $('#section-container').html('');
            $.ajax({
                type: 'GET',
                url: '{!! url('/api/work?order_type=desc&all=n&agency_id=') !!}' + agencyId,
                dataType: 'json',
                success: function (data) {
                    var data = data;
                    var section = $('#section-container');

                    $.each(data, function (i, val) {
                        var template = $('#template').clone();
                        $(template.find('a')).attr('href', "{{url('/work')}}/"+val.id);
                        $(template.find('.image-project')).css('background-image', 'url(\'' + val.main_image_link + '\')');
                        $(template.find('.title h5')).html(val.name);
                        $(template.find('.sub-title')).html(val.client);
                        template.removeAttr('id');
                        section.append(template);

                    });
                }
            });
        }

        var workByCategory = function () {

            $('.agency').val(0);
            var categoryId = $('.category > .select').data('id');
            alert(categoryId);
            if (categoryId == 0)
                workByAgency();

            $('#section-container').html('');
            $.ajax({
                type: 'GET',
                url: '{{url('/api/category')}}' + '/' + categoryId,
                dataType: 'json',
                success: function (data) {
                    var data = data;
                    var section = $('#section-container');

                    $.each(data.works, function (i, val) {
                        var template = $('#template').clone();
                        $(template.find('a')).attr('href', "{{url('/work')}}/"+val.id);
                        $(template.find('.title h5')).html(val.name);
                        $(template.find('.sub-title')).html(val.client);
                        template.removeAttr('id');
                        section.append(template);

                    });
                }
            });
        }
    </script>

@endsection
