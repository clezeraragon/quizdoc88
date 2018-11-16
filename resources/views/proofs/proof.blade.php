@extends('layouts.app')
<style>
    @import url("http://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css");
    body {
        padding-top: 30px;
        padding-bottom: 30px;

    }
    /* COMMON PRICING STYLES */
    .panel.price,
    .panel.price>.panel-heading{
        border-radius:0px;
        -moz-transition: all .3s ease;
        -o-transition:  all .3s ease;
        -webkit-transition:  all .3s ease;
    }
    .panel.price:hover{
        box-shadow: 0px 0px 30px rgba(0,0,0, .2);
    }
    .panel.price:hover>.panel-heading{
        box-shadow: 0px 0px 30px rgba(0,0,0, .2) inset;
    }


    .panel.price>.panel-heading{
        box-shadow: 0px 5px 0px rgba(50,50,50, .2) inset;
        text-shadow:0px 3px 0px rgba(50,50,50, .6);
    }

    .price .list-group-item{
        border-bottom-:1px solid rgba(250,250,250, .5);
    }

    .panel.price .list-group-item:last-child {
        border-bottom-right-radius: 0px;
        border-bottom-left-radius: 0px;
    }
    .panel.price .list-group-item:first-child {
        border-top-right-radius: 0px;
        border-top-left-radius: 0px;
    }

    .price .panel-footer {
        color: #fff;
        border-bottom:0px;
        /*background-color:  rgba(0,0,0, .1);*/
        box-shadow: 0px 3px 0px rgba(0,0,0, .3);
    }


    .panel.price .btn{
        box-shadow: 0 -1px 0px rgba(50,50,50, .2) inset;
        border:0px;
    }

    /* green panel */


    .price.panel-green>.panel-heading {
        color: #fff;
        background-color: #57AC57;
        border-color: #71DF71;
        border-bottom: 1px solid #71DF71;
    }


    .price.panel-green>.panel-body {
        color: #fff;
        background-color: #65C965;
    }


    .price.panel-green>.panel-body .lead{
        text-shadow: 0px 3px 0px rgba(50,50,50, .3);
    }

    .price.panel-green .list-group-item {
        color: #333;
        background-color: rgba(50,50,50, .01);
        font-weight:600;
        text-shadow: 0px 1px 0px rgba(250,250,250, .75);
    }



</style>
@section('content')
    <h3 class="page-title">Meus Quizes</h3>

    <div class="panel">

        <div class="content">
            <div class="panel-group">
                <div class="col-xs-12">
                    <br>
                    {{--{{dd($proofs)}}--}}
                    @foreach($proofs as $proof)
                        <div class="content">
                            <div class="col-xs-3">
                                    <!-- BLOCK ITEM -->
                                    <div class="panel price panel-green">
                                        <div class="panel-heading arrow_box text-center">
                                            <h2>{{ucfirst($proof['title'])}}</h2>
                                        </div>
                                        <div class="panel-body text-center">
                                            <p class="lead" style="font-size:40px"><strong>{{$proof['total_topic']}}</strong></p>
                                            <h4>Tópicos Relacionados</h4>
                                        </div>
                                        @if(!Auth::user()->isAdmin())
                                        <ul class="list-group list-group-flush text-center">
                                            <i class="fas fa-address-book"></i>
                                            <li class="list-group-item"><i class="icon-ok text-success"></i> Boa Sorte </span><h2>{{ucfirst($proof['name'])}}</h2></li>
                                        </ul>
                                        @endif
                                        <div class="panel-footer">
                                                <a href="{{route('proof.topics',$proof['id'])}}" class="btn btn-lg btn-block" style="background-color:#45B6AF;color:white;" >Iniciar</a>
                                        </div>
                                    </div>
                                <hr>
                                    <!-- /BLOCK ITEM -->

                            </div>

                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
        @stop

        @section('javascript')
            @parent
            <script src="{{ url('quickadmin/js') }}/timepicker.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.4.5/jquery-ui-timepicker-addon.min.js"></script>
            <script src="https://cdn.datatables.net/select/1.2.0/js/dataTables.select.min.js"></script>
            <script>
                $('.datetime').datetimepicker({
                    autoclose: true,
                    dateFormat: "{{ config('app.date_format_js') }}",
                    timeFormat: "hh:mm:ss"
                });
            </script>

@endSection
