@php
    $toolbarButtonMarginClass = "ms-1 ms-lg-3";
    $toolbarButtonHeightClass = "w-30px h-30px w-md-40px h-md-40px";
    $toolbarUserAvatarHeightClass = "symbol-30px symbol-md-40px";
    $toolbarButtonIconSizeClass = "svg-icon-1";
@endphp

<!--begin::Toolbar wrapper-->
<div class="topbar d-flex align-items-stretch flex-shrink-0">
    @if(!empty(auth()->user()))
    <!--begin::User-->
    <div class="d-flex align-items-center me-n3 {{ $toolbarButtonMarginClass }}" id="kt_header_user_menu_toggle">
        <!--begin::Menu wrapper-->
        <div class="btn btn-icon btn-active-light-primary {{ $toolbarButtonHeightClass }}" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
            <img class="h-25px w-25px rounded" src="{{ auth()->user()->avatar_url }}" alt="avatar"/>
        </div>
    {{ theme()->getView('partials/topbar/_user-menu') }}
    <!--end::Menu wrapper-->
    </div>
    <!--end::User -->
    @else
    <div>
        <a href="/register" class="btn btn-light-primary fs-6 fw-bold me-5">Register</a>
        <a href="/login" class="btn btn-light-info fs-6 fw-bold">Login</a>
    </div>
    @endif

    <!--begin::Aside mobile toggle-->
    @if (theme()->getOption('layout', 'aside/display') === true)
        <div class="d-flex align-items-center d-lg-none ms-4" title="Show header menu">
            <div class="btn btn-icon btn-active-light-primary {{ $toolbarButtonHeightClass }}" id="kt_aside_mobile_toggle">
                {!! theme()->getSvgIcon("icons/duotune/text/txt001.svg", "svg-icon-1") !!}
            </div>
        </div>
@endif
<!--end::Aside mobile toggle-->
</div>
<!--end::Toolbar wrapper-->
