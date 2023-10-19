<div class="modal fade" id="kt_modal_transfer" aria-modal="true" role="dialog">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header">
                <!--begin::Modal title-->
                <h2>Cash Withdrawal</h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                    <span class="svg-icon svg-icon-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black"></rect>
                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black"></rect>
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                </div>
                <!--end::Close-->
            </div>
            <!--end::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                <!--begin::Form-->
                <form method="post" id="kt_modal_new_card_form" class="form fv-plugins-bootstrap5 fv-plugins-framework" action="{{ route('wallet.withdrawal') }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    
            <!--begin::Input group-->
            <div class="mb-3">
                <!--begin::Label-->
                <label class="form-label fw-bolder fs-6 text-gray-700 me-5">Number of coins you have</label>
                <!--end::Label-->
                <!--begin::Select-->
                <span class="fs-6">{{ number_format(auth()->user()->coin, 1) }}$</span>
                <!--end::Select-->
            </div>
<!--begin::Alert-->
<div class="alert-danger">
    <!--begin::Icon-->
    {{-- <span class="svg-icon svg-icon-2hx svg-icon-primary me-3">...</span> --}}
    <!--end::Icon-->

    <!--begin::Wrapper-->
    <div class="d-flex flex-column">
        <!--begin::Title-->
        <!--end::Title-->
        <!--begin::Content-->
        <div class="px-4 fs-6 fw-bold">
            A minimum account balance of $100 is allowed to withdraw
        </div>
        <div class="px-4 fs-6 fw-bold">
            Withdraw USDT (TRC20 network) .Withdraw USDT to crypto address
        </div>
        <!--end::Content-->
    </div>
    <!--end::Wrapper-->
</div>
<!--end::Alert-->
            <div class="mb-10">
                <!--begin::Label-->
                <label class="form-label fw-bolder fs-6 text-gray-700 me-12">Account Type</label>
                <!--end::Label-->
                <!--begin::Select-->
                <div class="me-3 badge badge-success">{{ strtoupper(auth()->user()->type) }}</div>
                <!--end::Select-->
            </div>
                    <!--begin::Input group-->
                    <div class="d-flex flex-column mb-7 fv-row fv-plugins-icon-container">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                            <span class="required">Address</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Address" aria-label="Username is obtained from personal information"></i>
                        </label>
                        <!--end::Label-->
                        <input type="text" required class="form-control form-control-solid" placeholder="" name="address" value="">
                    <div class="fv-plugins-message-container invalid-feedback"></div></div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="d-flex flex-column mb-7 fv-row fv-plugins-icon-container">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                            <span class="required">Coin</span>
                        </label>
                        <!--end::Label-->
                        <input type="number" required class="form-control form-control-solid" placeholder="" name="coin" value="">
                    <div class="fv-plugins-message-container invalid-feedback"></div></div>
                    <!--end::Input group-->
                    
                    <!--begin::Input group-->
                    <div class="d-flex flex-column mb-7 fv-row fv-plugins-icon-container">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                            <span class="required">Level 2 Password</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Enter level 2 password to confirm withdrawal" aria-label="Enter level 2 password to confirm transfer"></i>
                        </label>
                        <!--end::Label-->
                        <input required type="password" class="form-control form-control-solid" placeholder="" name="password2" value="">
                    <div class="fv-plugins-message-container invalid-feedback"></div></div>
                    <!--end::Input group-->
                    
                    <!--end::Input group-->
                    <!--begin::Actions-->
                    <div class="text-center pt-15">
                        <button type="submit" id="kt_modal_new_card_submit" class="btn btn-primary">
                            <span class="indicator-label">Submit</span>
                            <span class="indicator-progress">Please wait...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                    </div>
                    <!--end::Actions-->
                <div></div></form>
                <!--end::Form-->
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>