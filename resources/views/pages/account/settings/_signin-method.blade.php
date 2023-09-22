<!--begin::Sign-in Method-->
<div class="card {{ $class ?? '' }}" {{ util()->putHtmlAttributes(array('id' => $id ?? '')) }}>
    <!--begin::Card header-->
    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_signin_method">
        <div class="card-title m-0">
            <h3 class="fw-bolder m-0">{{ __('Password Management') }}</h3>
        </div>
    </div>
    <!--end::Card header-->

    <!--begin::Content-->
    <div id="kt_account_signin_method" class="collapse show">
        <!--begin::Card body-->
        <div class="card-body border-top p-9">
            {{--  <!--begin::Email Address-->
            <div class="d-flex flex-wrap align-items-center">
                <!--begin::Label-->
                <div id="kt_signin_email">
                    <div class="fs-6 fw-bolder mb-1">{{ __('Email Address') }}</div>
                    <div class="fw-bold text-gray-600">{{ auth()->user()->email }}</div>
                </div>
                <!--end::Label-->

                <!--begin::Edit-->
                <div id="kt_signin_email_edit" class="flex-row-fluid d-none">
                    <!--begin::Form-->
                    <form id="kt_signin_change_email" class="form" novalidate="novalidate" method="POST" action="{{ route('security.changeEmail') }}">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="current_email" value="{{ auth()->user()->email }} "/>
                        <div class="row mb-6">
                            <div class="col-lg-6 mb-4 mb-lg-0">
                                <div class="fv-row mb-0">
                                    <label for="email" class="form-label fs-6 fw-bolder mb-3">{{ __('Enter New Email Address') }}</label>
                                    <input type="email" class="form-control form-control-lg form-control-solid" placeholder="{{ __('Email Address') }}" name="email" value="{{ old('email') }}" id="email"/>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="fv-row mb-0">
                                    <label for="current_password" class="form-label fs-6 fw-bolder mb-3">{{ __('Confirm Password') }}</label>
                                    <input type="password" class="form-control form-control-lg form-control-solid" name="current_password" id="current_password"/>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex">
                            <button id="kt_signin_submit" type="button" class="btn btn-primary  me-2 px-6">
                                @include('partials.general._button-indicator', ['label' => __('Update Email')])
                            </button>
                            <button id="kt_signin_cancel" type="button" class="btn btn-color-gray-400 btn-active-light-primary px-6">{{ __('Cancel') }}</button>
                        </div>
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Edit-->

                <!--begin::Action-->
                <div id="kt_signin_email_button" class="ms-auto">
                    <button class="btn btn-light btn-active-light-primary">{{ __('Change Email') }}</button>
                </div>
                <!--end::Action-->
            </div>
            <!--end::Email Address-->  --}}

            {{--  <!--begin::Separator-->
            <div class="separator separator-dashed my-6"></div>
            <!--end::Separator-->  --}}
            <!--begin::Password-->
            <div class="d-flex flex-wrap align-items-center mb-10">
                <!--begin::Label-->
                <div id="kt_signin_password">
                    <div class="fs-6 fw-bolder mb-1">{{ __('Level 1 Password') }}</div>
                    <div class="fw-bold text-gray-600">************</div>
                </div>
                <!--end::Label-->

                <!--begin::Edit-->
                <div id="kt_signin_password_edit" class="flex-row-fluid d-none">
                    <!--begin::Form-->
                    <form id="kt_signin_change_password" class="form" novalidate="novalidate" method="POST" action="{{ route('security.changePassword') }}">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="current_email" value="{{ auth()->user()->email }} "/>
                        <div class="row mb-1">
                            <div class="col-lg-4">
                                <div class="fv-row mb-0">
                                    <label for="current_password" class="form-label fs-6 fw-bolder mb-3">{{ __('Current Level 1 Password') }}</label>
                                    <input type="password" class="form-control form-control-lg form-control-solid" name="current_password" id="current_password"/>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="fv-row mb-0">
                                    <label for="password" class="form-label fs-6 fw-bolder mb-3">{{ __('New Level 1 Password') }}</label>
                                    <input type="password" class="form-control form-control-lg form-control-solid" name="password" id="password"/>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="fv-row mb-0">
                                    <label for="password_confirmation" class="form-label fs-6 fw-bolder mb-3">{{ __('Confirm New Level 1 Password') }}</label>
                                    <input type="password" class="form-control form-control-lg form-control-solid" name="password_confirmation" id="password_confirmation"/>
                                </div>
                            </div>
                        </div>

                        <div class="form-text mb-5">{{ __('Password must be at least 8 character and contain symbols') }}</div>

                        <div class="d-flex">
                            <button id="kt_password_submit" type="button" class="btn btn-primary me-2 px-6">
                                @include('partials.general._button-indicator', ['label' => __('Update Password')])
                            </button>
                            <button id="kt_password_cancel" type="button" class="btn btn-color-gray-400 btn-active-light-primary px-6">{{ __('Cancel') }}</button>
                        </div>
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Edit-->

                <!--begin::Action-->
                <div id="kt_signin_password_button" class="ms-auto">
                    <button class="btn btn-light btn-active-light-primary">{{ __('Change Level 1 Password') }}</button>
                </div>
                <!--end::Action-->
            </div>
            <!--end::Password-->

            <!--begin::Password-->
            <div class="d-flex flex-wrap align-items-center mb-10 
            @if(empty(auth()->user()->password2))
            d-none
            @endif
            ">
                <!--begin::Label-->
                <div id="kt_signin_password_2">
                    <div class="fs-6 fw-bolder mb-1">{{ __('Level 2 Password') }}</div>
                    <div class="fw-bold text-gray-600">************</div>
                </div>
                <!--end::Label-->

                <!--begin::Edit-->
                <div id="kt_signin_password_2_edit" class="flex-row-fluid d-none">
                    <!--begin::Form-->
                    <form id="kt_signin_change_password_2" class="form" novalidate="novalidate" method="POST" action="{{ route('security.changePassword2') }}">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="current_email" value="{{ auth()->user()->email }} "/>
                        <div class="row mb-1">
                            <div class="col-lg-4">
                                <div class="fv-row mb-0">
                                    <label for="current_password2" class="form-label fs-6 fw-bolder mb-3">{{ __('Current Level 2 Password') }}</label>
                                    <input type="password" class="form-control form-control-lg form-control-solid" name="current_password2" id="current_password2"/>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="fv-row mb-0">
                                    <label for="password2" class="form-label fs-6 fw-bolder mb-3">{{ __('New Level 2 Password') }}</label>
                                    <input type="password" class="form-control form-control-lg form-control-solid" name="password2" id="password2"/>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="fv-row mb-0">
                                    <label for="password2_confirmation" class="form-label fs-6 fw-bolder mb-3">{{ __('Confirm New Level 2 Password') }}</label>
                                    <input type="password" class="form-control form-control-lg form-control-solid" name="password2_confirmation" id="password2_confirmation"/>
                                </div>
                            </div>
                        </div>

                        <div class="form-text mb-5">{{ __('Password must be at least 8 character and contain symbols') }}</div>

                        <div class="d-flex">
                            <button id="kt_password_2_submit" type="button" class="btn btn-primary me-2 px-6">
                                @include('partials.general._button-indicator', ['label' => __('Update Password')])
                            </button>
                            <button id="kt_password_2_cancel" type="button" class="btn btn-color-gray-400 btn-active-light-primary px-6">{{ __('Cancel') }}</button>
                        </div>
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Edit-->

                <!--begin::Action-->
                <div id="kt_signin_password_2_button" class="ms-auto">
                    <button class="btn btn-light btn-active-light-primary">{{ __('Change Level 2 Password') }}</button>
                </div>
                <!--end::Action-->
            </div>
            <!--end::Password-->

            @if(empty(auth()->user()->password2))
            <div class="separator separator-dashed my-6"></div>
        <h5>Create Level 2 Password</h5>
        <form id="kt_signin_change_password_2" class="form" novalidate="novalidate" method="POST" action="{{ route('security.changePassword2') }}">
            @csrf

        <!--begin::Input group-->
        <div class="mb-10 fv-row" data-kt-password-meter="true">
            <!--begin::Wrapper-->
            <div class="mb-1">
                <!--begin::Label-->
                {{-- <label class="form-label fw-bolder text-dark fs-6">
                    {{ __('Level 2 Password') }}
                </label> --}}
                <!--end::Label-->

                <!--begin::Input wrapper-->
                <div class="position-relative mb-3">
                    <input class="form-control form-control-lg form-control-solid" type="password" name="password2" autocomplete="new-password"/>

                    <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
                        <i class="bi bi-eye-slash fs-2"></i>
                        <i class="bi bi-eye fs-2 d-none"></i>
                    </span>
                </div>
                <!--end::Input wrapper-->

                <!--begin::Meter-->
                <div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
                </div>
                <!--end::Meter-->
            </div>
            <!--end::Wrapper-->

            <!--begin::Hint-->
            <div class="text-muted">
                {{ __('Use 8 or more characters with a mix of letters, numbers & symbols.') }}
            </div>
            <!--end::Hint-->
        </div>
        <!--end::Input group--->

        <!--begin::Input group-->
        <div class="fv-row mb-5">
            <label class="form-label fw-bolder text-dark fs-6">{{ __('Confirm Level 2 Password') }}</label>
            <input class="form-control form-control-lg form-control-solid" type="password" name="password2_confirmation" autocomplete="off"/>
        </div>
        <!--end::Input group-->
                <!--begin::Actions-->
                <div class="text-center">
                    <button type="submit" id="kt_sign_up_submit" class="btn btn-lg btn-primary">
                        Submit Level 2 Password
                    </button>
                </div>
                <!--end::Actions-->
     </form>
        @endif

        </div>
        <!--end::Card body-->
    </div>
    <!--end::Content-->
</div>
<!--end::Sign-in Method-->
