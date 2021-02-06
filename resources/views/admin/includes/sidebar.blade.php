<?php
$routeName = Route::currentRouteName();
?>
<!-- BEGIN: Left Aside -->
<button class="m-aside-left-close  m-aside-left-close--skin-dark " id="m_aside_left_close_btn">
    <i class="la la-close"></i>
</button>
<div id="m_aside_left" class="m-grid__item	m-aside-left  m-aside-left--skin-dark ">
    <!-- BEGIN: Aside Menu -->
    <div id="m_ver_menu" class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark "
        m-menu-vertical="1" m-menu-scrollable="1" m-menu-dropdown-timeout="500" style="position: relative;">
        <ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow side_bar">
            <li class="m-menu__item  @if ($routeName == 'admin_dashboard') m-menu__item--active @endif"
                aria-haspopup="true">
                <a href="{{ route('admin_dashboard') }}" class="m-menu__link ">
                    <i class="m-menu__link-icon fa 	fa-tv"></i>
                    <span class="m-menu__link-title">
                        <span class="m-menu__link-wrap">
                            <span class="m-menu__link-text">{{trans('formname.dashboard')}}</span>
                        </span>
                    </span>
                </a>

            </li>
            @if((\Auth::guard('admin')->user()->hasAnyPermission(['page view','page create','page edit','page delete','page multiple delete'])))
            <li class="m-menu__item  m-menu__item--submenu @if ($routeName == 'app.index' || $routeName == 'app.create' || $routeName == 'app.edit' || $routeName == 'cms_index' || $routeName == 'cms_create' || $routeName == 'cms_edit' || $routeName == 'faq-category.index' || $routeName == 'faq-category.create' || $routeName == 'faq-category.edit' || $routeName == 'permission.index' || $routeName == 'permission.create' || $routeName == 'permission.edit' || $routeName == 'faq-category.index' || $routeName == 'faq-category.create' || $routeName == 'faq-category.edit' ||$routeName == 'faq.index' || $routeName == 'faq.create' || $routeName == 'faq.edit' || $routeName == 'emailTemplate.index' || $routeName == 'emailTemplate.create' || $routeName == 'emailTemplate.edit' || $routeName == 'loan-category.index' || $routeName == 'loan-category.create' || $routeName == 'loan-category.edit') m-menu__item--active m-menu__item--open @endif " aria-haspopup="true" m-menu-submenu-toggle="hover">
                <a href="javascript:;" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon flaticon-layers"></i>
                    <span class="m-menu__link-text">{{trans('formname.masters')}}</span>
                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="m-menu__submenu ">
                    <span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">
                        @if((\Auth::guard('admin')->user()->hasAnyPermission(['page view','page create','page edit','page delete','page multiple delete'])))
                        <li class="m-menu__item @if ($routeName == 'cms_index' || $routeName == 'cms_create' || $routeName == 'cms_edit') m-menu__item--active @endif"
                            aria-haspopup="true">
                            <a href="{{ route('cms_index') }}" class="m-menu__link">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="m-menu__link-text">{{trans('formname.cms_mgt')}}</span>
                            </a>
                        </li>
                        @endif
                    </ul>
                </div>
                <div class="m-menu__submenu ">
                    <span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">
                        <li class="m-menu__item @if ($routeName == 'app.index' || $routeName == 'app.create' || $routeName == 'app.edit') m-menu__item--active @endif"
                            aria-haspopup="true">
                            <a href="{{ route('app.index') }}" class="m-menu__link">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="m-menu__link-text">{{trans('formname.app.label')}}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            @endif
            <li class="m-menu__item  @if ($routeName == 'user.index' || $routeName == 'user.create' || $routeName == 'user.edit' ) m-menu__item--active @endif"
                aria-haspopup="true">
                <a href="{{ route('user.index') }}" class="m-menu__link ">
                    <i class="m-menu__link-icon fas fa-user"></i>
                    <span class="m-menu__link-title">
                        <span class="m-menu__link-wrap">
                            <span class="m-menu__link-text">{{trans('formname.user.label')}}</span>
                        </span>
                    </span>
                </a>
            </li>
            <li class="m-menu__item  @if ($routeName == 'loan.index' || $routeName == 'loan.create' || $routeName == 'loan.edit' ) m-menu__item--active @endif"
            aria-haspopup="true">
                <a href="{{ route('loan.index') }}" class="m-menu__link ">
                    <i class="m-menu__link-icon fas fa-hand-holding-usd "></i>
                    <span class="m-menu__link-title">
                        <span class="m-menu__link-wrap">
                            <span class="m-menu__link-text">{{trans('formname.loan.label')}}</span>
                        </span>
                    </span>
                </a>
            </li>
            <li class="m-menu__item  @if ($routeName == 'earning.index' || $routeName == 'earning.create' || $routeName == 'earning.edit' ) m-menu__item--active @endif"
                aria-haspopup="true">
                <a href="{{ route('earning.index') }}" class="m-menu__link ">
                    <i class="m-menu__link-icon fas fa-dollar-sign"></i>
                    <span class="m-menu__link-title">
                        <span class="m-menu__link-wrap">
                            <span class="m-menu__link-text">{{trans('formname.earning.label')}}</span>
                        </span>
                    </span>
                </a>
            </li>
            <li class="m-menu__item  @if ($routeName == 'user-earning.index' || $routeName == 'user-earning.create' || $routeName == 'user-earning.edit' ) m-menu__item--active @endif"
            aria-haspopup="true">
                <a href="{{ route('user-earning.index') }}" class="m-menu__link ">
                    <i class="m-menu__link-icon fas fa-dollar-sign"></i>
                    <span class="m-menu__link-title">
                        <span class="m-menu__link-wrap">
                            <span class="m-menu__link-text">{{trans('formname.app-earning.label')}}</span>
                        </span>
                    </span>
                </a>
            </li>
            <li class="m-menu__item  @if ($routeName == 'withdraw.index' || $routeName == 'withdraw.create' || $routeName == 'withdraw.edit' ) m-menu__item--active @endif"
            aria-haspopup="true">
                <a href="{{ route('withdraw.index') }}" class="m-menu__link ">
                    <i class="m-menu__link-icon fas fa-dollar-sign"></i>
                    <span class="m-menu__link-title">
                        <span class="m-menu__link-wrap">
                            <span class="m-menu__link-text">{{trans('formname.withdraw.label')}}</span>
                        </span>
                    </span>
                </a>
            </li>
            <li class="m-menu__item  @if ($routeName == 'review.index' || $routeName == 'review.create' || $routeName == 'review.edit' ) m-menu__item--active @endif"
            aria-haspopup="true">
                <a href="{{ route('review.index') }}" class="m-menu__link ">
                    <i class="m-menu__link-icon fas fa-star"></i>
                    <span class="m-menu__link-title">
                        <span class="m-menu__link-wrap">
                            <span class="m-menu__link-text">{{trans('formname.review.label')}}</span>
                        </span>
                    </span>
                </a>
            </li>
            <li class="m-menu__item  @if ($routeName == 'contact_us_index' ) m-menu__item--active @endif"
            aria-haspopup="true">
                <a href="{{ route('contact_us_index') }}" class="m-menu__link ">
                    <i class="m-menu__link-icon fas fa-cog"></i>
                    <span class="m-menu__link-title">
                        <span class="m-menu__link-wrap">
                            <span class="m-menu__link-text">{{trans('formname.contact_us')}}</span>
                        </span>
                    </span>
                </a>
            </li>
            <li class="m-menu__item  @if ($routeName == 'web_setting_index' || $routeName == 'web_setting_create' || $routeName == 'web_setting_edit' ) m-menu__item--active @endif"
                aria-haspopup="true">
                <a href="{{ route('web_setting_index') }}" class="m-menu__link ">
                    <i class="m-menu__link-icon fas fa-cog"></i>
                    <span class="m-menu__link-title">
                        <span class="m-menu__link-wrap">
                            <span class="m-menu__link-text">{{trans('formname.web_setting.name')}}</span>
                        </span>
                    </span>
                </a>
            </li>

            <li class="m-menu__item  @if ($routeName == 'profile') m-menu__item--active @endif" aria-haspopup="true">
                <a href="{{ route('profile') }}" class="m-menu__link ">
                    <i class="m-menu__link-icon 
                        flaticon-profile "></i>
                    <span class="m-menu__link-title">
                        <span class="m-menu__link-wrap">
                            <span class="m-menu__link-text">{{trans('formname.profile')}}</span>
                        </span>
                    </span>
                </a>
            </li>
            <li class="m-menu__item " aria-haspopup="true">
                <a href="{{ route('admin.logout') }}"
                    onclick="event.preventDefault(); document.getElementById('frm-side-logout').submit();" class="m-menu__link">
                    <i class="m-menu__link-icon fa 	fa-sign-out-alt"></i>
                    <span class="m-menu__link-text">Logout</span>
                </a>
                <form id="frm-side-logout" action="{{ route('admin.logout') }}" method="post" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
    <!-- END: Aside Menu -->
</div>
<!-- END: Left Aside -->