<!--begin::details View-->
<div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
    <!--begin::Card header-->
    <div class="card-header cursor-pointer">
        <!--begin::Card title-->
        <div class="card-title m-0">
            <h3 class="fw-bolder m-0">{{ __('Profile Details') }}</h3>
        </div>
        <!--end::Card title-->

        <!--begin::Action-->
        <a href="{{ theme()->getPageUrl('account/settings') }}" class="btn btn-primary align-self-center">{{ __('Edit Profile') }}</a>
        <!--end::Action-->
    </div>
    <!--begin::Card header-->

    <!--begin::Card body-->
    <div class="card-body p-9">
        <!--begin::Row-->
        <div class="row mb-7">
            <!--begin::Label-->
            <label class="col-lg-4 fw-bold text-muted">{{ __('Full Name') }}</label>
            <!--end::Label-->

            <!--begin::Col-->
            <div class="col-lg-8">
                <span class="fw-bolder fs-6 text-dark">{{ auth()->user()->name }}</span>
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->

<!--begin::Input group-->
<div class="row mb-7">
    <!--begin::Label-->
    <label class="col-lg-4 fw-bold text-muted">
        {{ __('Referral Code') }}
    </label>
    <!--end::Label-->

    <!--begin::Col-->
    <div class="col-lg-8 d-flex align-items-center">
        <!--begin::Input-->
        <div id="kt_clipboard_4" class="me-5 fw-bolder fs-6 text-dark">{{ auth()->user()->username }}</div>
        <!--end::Input-->

        <!--begin::Button-->
        <button class="btn btn-icon btn-sm btn-light" data-clipboard-target="#kt_clipboard_4">
            <i class="bi bi-copy"></i>
        </button>
        <!--end::Button-->
    </div>
    <!--end::Col-->
</div>
<!--end::Input group-->
        <!--begin::Input group-->
        <div class="row mb-7">
            <!--begin::Label-->
            <label class="col-lg-4 fw-bold text-muted">
                {{ __('Referral Link') }}
            </label>
            <!--end::Label-->

            <!--begin::Col-->
            <div class="col-lg-8 d-flex align-items-center">
                <!--begin::Input-->
                <div id="kt_clipboard_5" class="me-5">{{ env('APP_URL') . '/register?referer='. auth()->user()->username }}</div>
                <!--end::Input-->
    
                <!--begin::Button-->
                <button class="btn btn-icon btn-sm btn-light" data-clipboard-target="#kt_clipboard_5">
                    <i class="bi bi-copy"></i>
                </button>
                <!--end::Button-->
            </div>
            <!--end::Col-->
        </div>
        <!--end::Input group-->
        <!--begin::Row-->
        <div class="row mb-7">
            <!--begin::Label-->
            <label class="col-lg-4 fw-bold text-muted">{{ __('Email') }}</label>
            <!--end::Label-->

            <!--begin::Col-->
            <div class="col-lg-8">
                <span class="fw-bolder fs-6 text-dark">{{ auth()->user()->email }}</span>
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->

       

        {{--  <!--begin::Input group-->
        <div class="row mb-7">
            <!--begin::Label-->
            <label class="col-lg-4 fw-bold text-muted">
                {{ __('Contact Phone') }}
            </label>
            <!--end::Label-->

            <!--begin::Col-->
            <div class="col-lg-8 d-flex align-items-center">
                <span class="fw-bolder fs-6 me-2">{{ auth()->user()->phone }}</span>

                @if(auth()->user()->phone)
                    <span class="badge badge-success">{{ __('Verified') }}</span>
                @endif
            </div>
            <!--end::Col-->
        </div>
        <!--end::Input group-->  --}}
        <!--begin::Input group-->
        <div class="row mb-7">
            <!--begin::Label-->
            <label class="col-lg-4 fw-bold text-muted">
                {{ __('Direct Referer') }}
            </label>
            <!--end::Label-->

            <!--begin::Col-->
            <div class="col-lg-8 d-flex align-items-center">
                @if(auth()->user()->direct_user)
                <span class="fw-bolder fs-6 me-2">{{ auth()->user()->direct_user->name }}</span>
                @endif
            </div>
            <!--end::Col-->
        </div>
        <!--end::Input group-->

        <!--begin::Input group-->
        <div class="row mb-7">
            <!--begin::Label-->
            <label class="col-lg-4 fw-bold text-muted">
                {{ __('Indirect Referer') }}
            </label>
            <!--end::Label-->

            <!--begin::Col-->
            <div class="col-lg-8 d-flex align-items-center">
                @if(auth()->user()->indirect_user)
                <span class="fw-bolder fs-6 me-2">{{ auth()->user()->indirect_user->name }}</span>
                @endif
            </div>
            <!--end::Col-->
        </div>
        <!--end::Input group-->

        


    </div>
    <!--end::Card body-->
</div>
<!--end::details View-->
