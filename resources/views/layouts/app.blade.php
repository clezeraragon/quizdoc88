<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.head')
</head>

<body>
    <div class="wrapper">
        @include('partials.analytics')

        <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">

        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
          </li>
        </ul>
            @include('partials.header')
        </nav>

        <aside class="main-sidebar sidebar-dark-primary">
            <!-- <a href="/home" class="brand-link">
                <!/-- <img src="dist/img/AdminLTELogo.png"
                    alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3"
                    style="opacity: .8"> --/>
                <span class="brand-text font-weight-light">QuizDoc88</span>
            </a> -->
            @include('partials.sidebar')
        </aside>
        
        <div class="content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">

                        @if (Session::has('message'))
                            <div class="note note-info">
                                <p>{{ Session::get('message') }}</p>
                            </div>
                        @endif
                        @if ($errors->count() > 0)
                            <div class="note note-danger">
                                <ul class="list-unstyled">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @yield('content')

                    </div>
                </div>
            </div>
        </div>

        <!-- <div class="page-container">
            <div class="page-sidebar-wrapper">
            </div>

            <div class="page-content-wrapper">
                <div class="page-content">

                    @if(isset($siteTitle))
                        <h3 class="page-title">
                            {{ $siteTitle }}
                        </h3>
                    @endif

                    <div class="row">
                        <div class="col-md-12">

                            @if (Session::has('message'))
                                <div class="note note-info">
                                    <p>{{ Session::get('message') }}</p>
                                </div>
                            @endif
                            @if ($errors->count() > 0)
                                <div class="note note-danger">
                                    <ul class="list-unstyled">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            @yield('content')

                        </div>
                    </div>
                </div>
            </div>
        </div> -->

        <div class="scroll-to-top"
            style="display: none;">
            <i class="fa fa-arrow-up"></i>
        </div>

        {!! Form::open(['route' => 'auth.logout', 'style' => 'display:none;', 'id' => 'logout']) !!}
            <button type="submit">Logout</button>
        {!! Form::close() !!}
    </div>

    @include('partials.javascripts')
</body>
</html>