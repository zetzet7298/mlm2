<x-auth-layout>
    <!--begin::Forgot Password Form-->
    <form method="POST" action="{{route('account.forgotPassword')}}" class="form w-100" novalidate="novalidate" id="">
    @csrf
        <!--begin::Heading-->
        <div class="text-center mb-10">
            <!--begin::Title-->
            <h1 class="text-dark mb-3">
                {{ __('Forgot Password ?') }}
            </h1>
            <!--end::Title-->

            <!--begin::Link-->
            <div class="text-gray-400 fw-bold fs-4">
                {{ __('Use level 2 password to recover password.') }}
            </div>
            <!--end::Link-->
        </div>
        <!--begin::Heading-->
                <!--begin::Input group-->
        <div class="fv-row mb-5">
            <label class="form-label fw-bolder text-dark fs-6">{{ __('Username') }}</label>
            <input required class="form-control form-control-lg form-control-solid" type="text" name="username" autocomplete="off"/>
        </div>
        <!--end::Input group-->
    <!--begin::Input group-->
        <!--begin::Input group-->
        <div class="fv-row mb-5">
            <label class="form-label fw-bolder text-dark fs-6">{{ __('Level 2 Password') }}</label>
            <input required class="form-control form-control-lg form-control-solid" type="password" name="password2" autocomplete="off"/>
        </div>
        <!--end::Input group-->
    <!--begin::Input group-->
        <div class="mb-10 fv-row" data-kt-password-meter="true">
            <!--begin::Wrapper-->
            <div class="mb-1">
                <!--begin::Label-->
                <label class="form-label fw-bolder text-dark fs-6">
                    {{ __('Password') }}
                </label>
                <!--end::Label-->

                <!--begin::Input wrapper-->
                <div class="position-relative mb-3">
                    <input required class="form-control form-control-lg form-control-solid" type="password" name="password" autocomplete="off"/>

                </div>
                <!--end::Input wrapper-->

            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Input group--->

        <!--begin::Input group-->
        <div class="fv-row mb-5">
            <label class="form-label fw-bolder text-dark fs-6">{{ __('Confirm Password') }}</label>
            <input required class="form-control form-control-lg form-control-solid" type="password" name="password_confirmation" autocomplete="off"/>
        </div>
        <!--end::Input group-->

        <!--begin::Actions-->
        <div class="d-flex flex-wrap justify-content-center pb-lg-0">
            {{--  <input type="submit"/>  --}}
            <button type="submit" id="" class="btn btn-lg btn-primary fw-bolder ">
                @include('partials.general._button-indicator')
            </button>

            <a href="{{ theme()->getPageUrl('login') }}" class="btn btn-lg btn-light-primary fw-bolder">{{ __('Cancel') }}</a>
        </div>
        <!--end::Actions-->
    </form>
    <!--end::Forgot Password Form-->

</x-auth-layout>
