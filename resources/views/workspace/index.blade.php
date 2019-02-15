@extends('workspace.layouts.master')

@section('pageContent')
    {{--STYLES FOR THE STAR RATING ELEMENTS--}}
    {{--<style>--}}
    {{--@font-face {--}}
    {{--font-family: 'Material Icons';--}}
    {{--font-style: normal;--}}
    {{--font-weight: 400;--}}
    {{--src: local('Material Icons'), local('MaterialIcons-Regular'), url(https://fonts.gstatic.com/s/materialicons/v7/2fcrYFNaTjcS6g4U3t-Y5UEw0lE80llgEseQY3FEmqw.woff2) format('woff2'), url(https://fonts.gstatic.com/s/materialicons/v7/2fcrYFNaTjcS6g4U3t-Y5RV6cRhDpPC5P4GCEJpqGoc.woff) format('woff');--}}
    {{--}--}}
    {{--.material-icons {--}}
    {{--font-family: 'Material Icons';--}}
    {{--font-weight: normal;--}}
    {{--font-style: normal;--}}
    {{--font-size: 20px;--}}
    {{--line-height: 1;--}}
    {{--letter-spacing: normal;--}}
    {{--text-transform: none;--}}
    {{--display: inline-block;--}}
    {{--word-wrap: normal;--}}
    {{---moz-font-feature-settings: 'liga';--}}
    {{---moz-osx-font-smoothing: grayscale;--}}
    {{--}--}}
    {{--i {--}}
    {{--cursor :  pointer;--}}
    {{--}--}}
    {{--</style>--}}

    {{--<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>--}}


    {{-- CATCHING ERRORS--}}
    @if(count($errors)>0)
        @foreach($errors->all() as $error)
            <div class="alert alert-danger">{{$error}}</div>
        @endforeach

    @endif

    <!-- Navigation -->
    <div class="box-shadow">
        <!-- Carousel -->
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
            </ol>
            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <div class="item active">
                    <img src="images/banner1.jpg" alt="First slide">
                    <!-- Static Header -->
                    <div class="header-text hidden-xs">
                        <div class="col-md-12">
                            <h1>WELCOME!</h1>
                            <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima quo. Aenean feugiat in ante et blandit. Vestibulum posuere molestie risus, ac interdum magna porta non.</span><br><br>
                            <a href="#" class="btn btn-primary">Learn More</a>
                        </div>
                    </div><!-- /header-text -->
                </div>
                <div class="item">
                    <img src="images/banner2.jpg" alt="Third slide">
                    <!-- Static Header -->
                    <div class="header-text hidden-xs">
                        <div class="col-md-12">
                            <h1>SPEND YOUR DREAM HOLIDAY!</h1>
                            <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima quo. Aenean feugiat in ante et blandit. Vestibulum posuere molestie risus, ac interdum magna porta non.</span><br><br>
                            <a href="#" class="btn btn-primary">Learn More</a>
                        </div>
                    </div><!-- /header-text -->
                </div>
            </div>
            <!-- Controls -->
            <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
            </a>
            <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
            </a>
        </div><!-- /carousel -->


        <!-- /////////////////////////////////////////Content -->
        <div id="content">


            <!-- ////////////Content Box 01 -->


            {{--LIVE SEARCH --}}

            <script type="text/javascript" src="js/jquery-2.1.1.js"></script>

            <section class="box-content box-2" id="section">
                <div class="container">
                    <div class="row heading">
                        <div class="col-lg-12">

                            <h3 align="center" style="color: #206bd5;font-style: italic">Get to your beloved
                                <i class="fa fa-heart" style="font-size: 24px;font-style: italic;color: #eb563f;"></i>
                                space now with us :) </h3><br/>

                            <div class="panel panel-info">
                                <div class="panel-heading">Search Spaces In Any Governorate</div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <input type="text" name="search" id="search" class="form-control"
                                               placeholder="Search Spaces"/>
                                    </div>
                                    <div class="table-responsive">
                                        <h3 align="center">Total Results : <span id="total_records"></span></h3>
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                            <tr>
                                                <th>Space Name</th>
                                                <th>Space Governorate</th>
                                                <th>Space Address</th>
                                                <th>Space Rooms</th>
                                            </tr>
                                            </thead>
                                            <tbody>


                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{--<input type="hidden" name="_token" value="{{ Session::token() }}">--}}
                        <script>
                            $(document).ready(function () {


                                function fetch_customer_data(query = '') {
                                    // $.ajaxSetup({
                                    //     headers: {
                                    //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    //     }
                                    // });

                                    $.ajax({
                                        // headers: {
                                        //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        // },
                                        url: "{{ route('live_search.action') }}",
                                        method: 'GET',
                                        data: {query: query},
                                        dataType: 'json',
                                        success: function (data) {
                                            $('tbody').html(data.table_data);
                                            $('#total_records').text(data.total_data);
                                        }
                                    })
                                }

                                $(document).on('keyup', '#search', function () {
                                    var query = $(this).val();
                                    fetch_customer_data(query);
                                });

                                fetch_customer_data();
                            });
                        </script>
                    </div>
                </div>

                <div class="container">
                    <div class="row heading">
                        <div class="col-lg-12">
                            <h2>Or Select By Governorate</h2>

                            <div>
                                {{--select governorate--}}
                                <form action="{{route('governorateSpaces')}}" method="get">
                                    @csrf

                                    <select name="selectedGovernorate" onchange="this.form.submit()">

                                        <option>Choose Governorate</option>

                                        @foreach($governoratesList as $governorate)
                                            <option>{{$governorate}}</option>
                                        @endforeach

                                    </select>
                                </form>
                            </div>
                            {{----}}
                            {{--<div>--}}
                            {{--<input class="form-control" type="text"--}}
                            {{--placeholder="Search by governorate or by space name" onkeyup="">--}}
                            {{--</div>--}}

                            <hr>
                            {{--<div class="intro">Lorem ipsum dolor sit amet</div>--}}
                        </div>
                    </div>


                    <div class=" categories">
                        <ul class="cat">
                            <li>
                                <ol class="type list-inline">
                                    {{--place for filter buttons--}}

                                </ol>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>


                    {{--   SHOW SPACES IN BOXES   --}}

                    <div class="row">
                        <div class="portfolio-items">

                            @if(isset($spacesInGovernorate))
                                <div class="row portfolio-items">
                                    <h2>{{$governorateSelected}}</h2>
                                </div>

                                <div class="row">
                                    @foreach($spacesInGovernorate as $spaceFromSelect)
                                        <div class="col-sm-6 col-md-3 col-lg-3 "
                                             onclick="window.location='{{route('reserveSpace',$spaceFromSelect->space_id)}}'">

                                            <div class="post">
                                                <div class="item-container wow fadeInUp"
                                                     data-wow-delay="200ms"
                                                >
                                                    <img src="images/{{$spaceFromSelect->space_image_path}}"

                                                    />
                                                </div>
                                                <span>{{$spaceFromSelect->space_name}}</span>

                                                {{--<h3 style="color: #00abff;font-style:italic;">Space Rating</h3>--}}
                                                {{--<div class="ratingClass{{$spaceFromSelect->space_id}}" style="color: #ebac34;"></div>--}}

                                                {{--<script>--}}
                                                {{--$(document).ready(function(){--}}
                                                {{--$('.ratingClass'+'{{$spaceFromSelect->space_id}}').addRating({'icon':'star','selectedRatings':'{{$spaceFromSelect->space_rating}}','max':'6'});--}}
                                                {{--})--}}
                                                {{--</script>--}}


                                            </div>
                                        </div>
                                    @endforeach
                                    @endif
                                </div>

                        </div>
                    </div>


                    {{--<div class="row">--}}
                    {{--<div class="portfolio-items">--}}

                    {{--@foreach($spaces as $space)--}}
                    {{--<div class="col-sm-6 col-md-3 col-lg-3 {{$space->space_city}}"--}}
                    {{--onclick="window.location='{{route('reserveSpace',$space->space_id)}}'">--}}

                    {{--<div class="post">--}}
                    {{--<div class="item-container wow fadeInUp" data-wow-delay="200ms"--}}
                    {{-->--}}
                    {{--<img src="images/{{$space->space_image_path}}"--}}

                    {{--/>--}}
                    {{--</div>--}}
                    {{--<span>{{$space->space_name}}</span>--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--@endforeach--}}


                    {{--</div>--}}
                    {{--</div>--}}
                </div>

            </section>

            <!-- ////////////Content Box 02 -->


            <section class="box-content box-2" id="section">

            </section>

            <section class="box-content box-1 box-style-1" id="about">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="box-item">
                                <div class="wrap-img">
                                    <img src="images/key.png"/>
                                </div>
                                <h3 class="services-heading">Text Heading A</h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima quo.
                                    Aenean feugiat
                                    in
                                    ante et blandit. Vestibulum posuere molestie risus, ac interdum magna
                                    porta
                                    non. </p>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="box-item">
                                <div class="box-item">
                                    <div class="wrap-img">
                                        <img src="images/money.png"/>
                                    </div>
                                    <h3 class="services-heading">Text Heading B</h3>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima quo.
                                        Aenean
                                        feugiat
                                        in ante et blandit. Vestibulum posuere molestie risus, ac interdum
                                        magna porta
                                        non. </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="box-item">
                                <div class="box-item">
                                    <div class="wrap-img">
                                        <img src="images/days.png"/>
                                    </div>
                                    <h3 class="services-heading">Text Heading C</h3>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima quo.
                                        Aenean
                                        feugiat
                                        in ante et blandit. Vestibulum posuere molestie risus, ac interdum
                                        magna porta
                                        non. </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- ////////////Content Box 04 -->
            <section class="box-content box-4 box-style-1" id="news">
                <div class="container">
                    <div class="row heading">
                        <div class="col-lg-12">
                            <h2>TESTIMONIALS</h2>
                            <hr class="line02">
                            <div class="intro">Lorem ipsum dolor sit amet</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="box-item">
                                <div class="wrap-img">
                                    <img src="images/people1.jpg" class="img-circle" alt="">
                                </div>
                                <p>Aenean feugiat in ante et blandit. Vestibulum posuere molestie risus, ac
                                    interdum
                                    magna
                                    porta non. Pellentesque rutrum fringilla elementum. Curabitur tincidunt
                                    porta lorem
                                    vitae accumsan. Aenean feugiat in ante et blandit. Vestibulum posuere
                                    molestie
                                    risus, ac
                                    interdum magna porta non. Pellentesque rutrum fringilla elementum.
                                    Curabitur
                                    tincidunt
                                    porta lorem vitae accumsan. </p>
                                <div class="info">
                                    WILL SMITH
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="box-item">
                                <div class="wrap-img">
                                    <img src="images/people2.jpg" class="img-circle" alt="">
                                </div>
                                <p>Aenean feugiat in ante et blandit. Vestibulum posuere molestie risus, ac
                                    interdum
                                    magna
                                    porta non. Pellentesque rutrum fringilla elementum. Curabitur tincidunt
                                    porta lorem
                                    vitae accumsan. Aenean feugiat in ante et blandit. Vestibulum posuere
                                    molestie
                                    risus, ac
                                    interdum magna porta non. Pellentesque rutrum fringilla elementum.
                                    Curabitur
                                    tincidunt
                                    porta lorem vitae accumsan. </p>
                                <div class="info">
                                    WILL SMITH
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="box-item">
                                <div class="wrap-img">
                                    <img src="images/people3.jpg" class="img-circle" alt="">
                                </div>
                                <p>Aenean feugiat in ante et blandit. Vestibulum posuere molestie risus, ac
                                    interdum
                                    magna
                                    porta non. Pellentesque rutrum fringilla elementum. Curabitur tincidunt
                                    porta lorem
                                    vitae accumsan. Aenean feugiat in ante et blandit. Vestibulum posuere
                                    molestie
                                    risus, ac
                                    interdum magna porta non. Pellentesque rutrum fringilla elementum.
                                    Curabitur
                                    tincidunt
                                    porta lorem vitae accumsan. </p>
                                <div class="info">
                                    WILL SMITH
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </div>
@endsection




{{--  category refrence button--}}
{{--<li><a href="#" data-filter=".taupo_central">Taupo Central</a></li>--}}


{{--example refrence for image div--}}


{{--<div class="col-sm-6 col-md-3 col-lg-3 ohama_beach">--}}
{{--<div class="post">--}}
{{--<div class="item-container wow fadeInUp" data-wow-delay="200ms">--}}
{{--<div class="item-caption">--}}
{{--<div class="item-caption-inner">--}}
{{--<div class="item-caption-inner1">--}}
{{--<a class="example-image-link" href="images/3.jpg"--}}
{{--data-lightbox="example-set"--}}
{{--data-title="Click the right half of the image to move forward.">--}}
{{--<i class="fa fa-search"></i>--}}
{{--</a>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--<img src="images/3-thumb.jpg"/>--}}
{{--</div>--}}
{{--<span>Aenean feugiat in ante et blandit. Vestibulum posuere molestie risus, ac interdum magna porta non.</span>--}}
{{--</div>--}}
{{--</div>--}}