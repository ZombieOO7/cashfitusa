@php
$routeName = Route::currentRouteName();
$loanNotificationlist = loanNotificationlist();
$earningNotificationlist = earningNotificationlist();
$totalNotification = count($loanNotificationlist)+count($earningNotificationlist);
@endphp
<style>
    div.scroll { 
        overflow-x: hidden !important; 
        overflow-y: auto !important; 
        text-align:justify; 
    } 
    .badge-notify{
        position:relative;
        top: -14px;
        left: -8px;
    }
</style>
<header>
    <!-- Header Start -->
    <div class="header-area header-transparent">
        <div class="alert alert-success alert-dismissible fade show bg-green text-center text-white m-0" role="alert">
            <i class="fa fa-money"></i><span class="ml-3"> Approved and Funded Loan within 24 hours isn’t a dream anymore!</span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
            <div class="main-header  header-sticky">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <!-- Logo -->
                        <div class="col-xl-3 col-lg-3">
                            <div class="logo">
                            <a href="{{route('loan')}}"><img src="{{asset('images/logo.png')}}" alt="{{env('app_name')}}"></a>
                            </div>
                        </div>
                        
                        <div class="col-xl-9 col-lg-9">
                            <div class="menu-main d-flex align-items-center justify-content-end" style='font-family: "Rubik", sans-serif;font-weight: normal;font-style: normal;'>
                                <!-- Main-menu -->
                                @if(Auth::guard('web')->user())
                                @php $user = Auth::guard('web')->user(); @endphp
                                <div class="main-menu f-right d-none d-lg-block" style="font-size:1rem !important;">
                                    <nav>
                                        <ul id="navigation" class="mb-0">
                                            <li class="menu-name {{($routeName=='loan' || $routeName=='loan.detail' || $routeName=='calculate' || $routeName=='application')?'active':''}}"><a style="text-decoration:none;" href="{{route('loan')}}"><i class="fa fa-money ml-3"></i> Loan</a></li>
                                            <li class="menu-name {{($routeName=='work-from-home' || $routeName=='earning' || $routeName=='apply.work-from-home')?'active':''}}"><a style="text-decoration:none;" href="{{route('work-from-home')}}"><i class="fa fa-laptop mr-1"></i>Remote Working</a></li>
                                            <li>
                                                <a style="text-decoration:none;" href="#" id='notification-bell'>
                                                    <span class="fa fa-bell"></span>
                                                    @if($totalNotification)
                                                    <span class="badge badge-notify bg-danger text-white rounded-circle">{{@$totalNotification}}</span>
                                                    @endif
                                                </a>
                                                <ul class="submenu p-0" style="width: 350px;">
                                                    <div class="">
                                                        <ul role="tablist" class="nav border-bottom">
                                                            <li class=" text-center ">
                                                                <a data-toggle="tab" href="#m_portlet_tab_1_1" class="p-3 active show text-black ">Loan</a>
                                                            </li>
                                                            <li class="col-md-6 text-center">
                                                                <a data-toggle="tab" href="#m_portlet_tab_1_2" class="p-3">Earning</a>
                                                            </li>
                                                        </ul>
                                                        <div class="tab-content">
                                                            <div class="pt-2 pb-2 tab-pane active show" id="m_portlet_tab_1_1">
                                                                <div class="scroll" style="height: 200px; overflow: hidden;">
                                                                @forelse($loanNotificationlist as $notification)
                                                                    <div class="">
                                                                        <div class="pr-2 pl-2 border-bottom">
                                                                            <label class="form-label">{{@$notification->content}}</label>
                                                                            <br>
                                                                            <label class="form-label">{{$notification->created_at_text_time}}</label>
                                                                        </div>
                                                                    </div>
                                                                    @empty
                                                                        <div class="pr-2 pl-2">
                                                                            <label class="form-label">{{__('formname.notification_not_found')}}</label>
                                                                        </div>
                                                                    @endforelse
                                                                </div>
                                                                <div class="text-left border-top">
                                                                    <div class="text-left border-top">
                                                                        <a href="{{route('clearNotification',['type'=>1])}}" class="pb-2 pt-2 text-danger">Clear All</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="pt-2 pb-2 tab-pane" id="m_portlet_tab_1_2">
                                                                <div class="scroll" style="height: 200px; overflow: hidden;">
                                                                @forelse($earningNotificationlist as $notification)
                                                                <div class="">
                                                                    <div class="pr-2 pl-2 border-bottom">
                                                                        <label class="form-label">{{@$notification->content}}</label>
                                                                        <br>
                                                                        <label class="form-label">{{$notification->created_at_text_time}}</label>
                                                                    </div>
                                                                </div>
                                                                @empty
                                                                    <div class="pr-2 pl-2">
                                                                        <label class="form-label">{{__('formname.notification_not_found')}}</label>
                                                                    </div>
                                                                @endforelse
                                                                </div>
                                                                <div class="text-left border-top">
                                                                    <a href="{{route('clearNotification',['type'=>2])}}" class="pb-2 pt-2 text-danger">Clear All</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </ul>
                                            </li>
                                            <li><a href="javascript:;" class="text-bold h6">Hi, {{@$user->first_name}}</a>
                                                <ul class="submenu">
                                                    <li><a href="{{route('dashboard')}}"><span class="fas fa-pie-chart mr-2"></span>Dashboard</a></li>
                                                    {{-- <li><a href="{{route('application')}}">Loan Applications</a></li> --}}
                                                    {{-- <li><a href="{{route('earning')}}">Earning</a></li> --}}
                                                    {{-- <li><a href="{{route('upload.document')}}">Upload Document</a></li> --}}
                                                    <li><a href="{{route('user-logout')}}"><span class="fas fa-sign-out-alt mr-2"></span>Logout</a></li>
                                                </ul>
                                            </li>
                                            {{-- <li><a href="contact.html">Contact</a></li> --}}
                                        </ul>
                                    </nav>
                                </div>
                                @else
                                    <div class="main-menu f-right d-none d-lg-block" style="font-size:1rem !important;">
                                        <nav>
                                            <ul id="navigation" class="mb-0">
                                                <li class="menu-name {{($routeName=='loan' || $routeName=='loan.detail' || $routeName=='calculate' || $routeName=='application')?'active':''}}"><a style="text-decoration:none;" href="{{route('loan')}}"><i class="fa fa-money mr-1"></i> Loan</a></li>
                                                <li class="menu-name {{($routeName=='work-from-home')?'active':''}}"><a style="text-decoration:none;" href="{{route('work-from-home')}}"><i class="fa fa-laptop mr-1"></i> Remote Working</a></li>
                                                <li><a href="{{route('login')}}" class="btn header-btn cst-btn text-white">Log in </a></li>
                                            </ul>
                                        </nav>
                                    </div>
                                    <div class="header-right-btn d-none f-right d-lg-block ml-3">
                                        <a href="{{route('login')}}" class="btn header-btn text-white">Log In </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <!-- Mobile Menu -->
                        <div class="col-12">
                            <div class="mobile_menu d-block d-lg-none"></div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    <!-- Header End -->
</header>
