@inject('request', 'Illuminate\Http\Request')
<!-- Left side column. contains the logo and sidebar -->

  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">

    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img
          src="https://avataaars.io/?avatarStyle=Transparent&topType=LongHairStraight&accessoriesType=Blank&hairColor=BrownDark&facialHairType=Blank&clotheType=BlazerShirt&eyeType=Default&eyebrowType=Default&mouthType=Default&skinColor=Ligh"
          class="img-circle elevation-2"
          alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">{{ Auth::user()->name }}</a>
      </div>
    </div>
    
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

            @if(!Auth::user()->isAdmin())
            <li class="nav-link {{ $request->segment(1) == 'tests' ? 'active' : '' }}">
              <a href="{{ route('proof.user') }}">
                <i class="fa fa-gears"></i>
                <span class="title">@lang('quickadmin.test.new')</span>
              </a>
            </li>

            <li class="nav-link {{ $request->segment(1) == 'results' ? 'active' : '' }}">
              <a href="{{ route('results.index') }}">
                <i class="fa fa-gears"></i>
                <span class="title">@lang('quickadmin.results.title')</span>
              </a>
            </li>
            @endif
            @if(Auth::user()->isAdmin())
                <li class="nav-link {{ $request->segment(1) == 'tests' ? 'active' : '' }}">
                    <a href="{{ route('proof.dashboard') }}">
                        <i class="fa fa-gears"></i>
                        <span class="title">@lang('quickadmin.test.new')</span>
                    </a>
                </li>
                <li class="nav-link {{ $request->segment(1) == 'proof' ? 'active' : '' }}">
                    <a href="{{ route('proof.index') }}">
                        <i class="fa fa-gears"></i>
                        <span class="title">@lang('quickadmin.proofs.title')</span>
                    </a>
                </li>
            <li class="nav-link {{ $request->segment(1) == 'topics' ? 'active' : '' }}">
                    <a href="{{ route('topics.index') }}">
                        <i class="fa fa-gears"></i>
                        <span class="title">@lang('quickadmin.topics.title')</span>
                    </a>
                </li>
            <li class="nav-link {{ $request->segment(1) == 'questions' ? 'active' : '' }}">
                <a href="{{ route('questions.index') }}">
                    <i class="fa fa-gears"></i>
                    <span class="title">@lang('quickadmin.questions.title')</span>
                </a>
            </li>
            <li class="nav-link {{ $request->segment(1) == 'questions_options' ? 'active' : '' }}">
                <a href="{{ route('questions_options.index') }}">
                    <i class="fa fa-gears"></i>
                    <span class="title">@lang('quickadmin.questions-options.title')</span>
                </a>
            </li>
            <li class="nav-item has-treeview menu-open">
                <a href="#" class="nav-link">
                    <i class="nav-icon fa fa-users"></i>
                    <p>
                        @lang('quickadmin.user-management.title')
                        <i class="right fa fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-link {{ $request->segment(1) == 'roles' ? 'active active-sub' : '' }}">
                        <a href="{{ route('roles.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span class="title">
                                @lang('quickadmin.roles.title')
                            </span>
                        </a>
                    </li>
                    <li class="nav-link {{ $request->segment(1) == 'users' ? 'active active-sub' : '' }}">
                        <a href="{{ route('users.index') }}">
                            <i class="fa fa-user"></i>
                            <span class="title">
                                @lang('quickadmin.users.title')
                            </span>
                        </a>
                    </li>
                    <li class="nav-link {{ $request->segment(1) == 'user_actions' ? 'active active-sub' : '' }}">
                        <a href="{{ route('user_actions.index') }}">
                            <i class="fa fa-th-list"></i>
                            <span class="title">
                                @lang('quickadmin.user-actions.title')
                            </span>
                        </a>
                    </li>
                </ul>
            </li>
            @endif
            <li class="nav-link">
                <a href="#logout" onclick="$('#logout').submit();">
                    <i class="fa fa-arrow-left"></i>
                    <span class="title">@lang('quickadmin.logout')</span>
                </a>
            </li>
        </ul>

        <div class="center-block">
        <img src="{{asset('quickadmin/images/martin_doc88.jpeg')}}" style="width: 100%; margin-left: 0%">
        </div>
    </nav>

    {!! Form::open(['route' => 'auth.logout', 'style' => 'display:none;', 'id' => 'logout']) !!}
    <button type="submit">@lang('quickadmin.logout')</button>
    {!! Form::close() !!}

    <!-- /.sidebar-menu -->
    </section>