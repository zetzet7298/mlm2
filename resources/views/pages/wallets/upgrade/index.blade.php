<x-base-layout>

    <!--begin::Card-->
    <div class="card">
        <div class="card-title m-0">
            <h3 class="fw-bolder px-10 pt-10">Wallet Detail</h3>
        </div>
        <!--begin::Card body-->
        <div class="card-body p-10">
            <!--begin::Input group-->
            <div class="mb-10">
                <!--begin::Label-->
                <label class="form-label fw-bolder fs-6 text-gray-700 me-5">Account Balance</label>
                <!--end::Label-->
                <!--begin::Select-->
                <span class="fs-6">{{ number_format(auth()->user()->coin) }}$</span>
                <!--end::Select-->
            </div>
            <div class="mb-10">
                <!--begin::Label-->
                <label class="form-label fw-bolder fs-6 text-gray-700 me-12">Account Type</label>
                <!--end::Label-->
                <!--begin::Select-->
                <div class="me-3 badge badge-success">{{ strtoupper(auth()->user()->type) }}</div>
                <!--end::Select-->
            </div>
            @if(auth()->user()->type != AccountConstant::TYPE_USER_FREE)
            <a href="#" class="btn btn-primary er fs-6 px-8 py-4" data-bs-toggle="modal"
                data-bs-target="#kt_modal_transfer">Transfer To Someone</a>
            @include('pages.wallets.upgrade._transfer')
            @elseif(auth()->user()->state == AccountConstant::USER_STATE_PROCESSING)
            <div class="fs-5 badge badge-light-success mb-4">
                Your account is waiting for confirmation to become a member
            </div>
            @else
            <form action="{{ route('wallet.upgrade') }}" method="post">
                <div class="mb-10">
                    <!--begin::Label-->
                    <label class="form-label fw-bolder fs-6 text-gray-700 me-15">Upgrade Fee</label>
                    <!--end::Label-->
                    <!--begin::Select-->
                    <span class="me-5">{{ AccountConstant::COIN_NEED_UPGRADE .'$' }}</span>
                    <!--end::Select-->
                </div>
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="fv-row mb-7">
                    <label class="form-label fw-bolder text-gray-700 fs-6">{{ __('Direct Refferer Code') }}</label>
                    @if(!empty(auth()->user()->direct_user_id))
                    <input class="form-control form-control-lg form-control-solid" required type="text" readonly
                        name="direct_user_id" autocomplete="off" value="{{ auth()->user()->direct_user_id }}" />
                    @else
                    <input class="form-control form-control-lg form-control-solid" required type="text"
                        name="direct_user_id" autocomplete="off" value="" />
                    @endif
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="fv-row mb-7">
                    <label class="form-label fw-bolder text-gray-700 fs-6">{{ __('Indirect Refferer Code') }}</label>
                    <input class="form-control form-control-lg form-control-solid" required type="text"
                        name="indirect_user_id" autocomplete="off" value="" />
                </div>
                <!--end::Input group-->
                @if(auth()->user()->coin < AccountConstant::COIN_NEED_UPGRADE) <input type="hidden" value="0"
                    name="enough"></input>
                    <div class="fs-5 badge badge-light-success mb-4">
                        You do not have enough money to upgrade, please choose a payment method
                    </div>
                    <!--begin::Input group-->
                    <div class="mb-10">
                        <!--begin::Label-->
                        <label class="form-label fw-bolder fs-6 text-gray-700">Payment Account</label>
                        <!--end::Label-->
                        <!--begin::Select-->
                        <div class="fs-6">{{ auth()->user()->name }}</div>
                        <!--end::Select-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="mb-10">
                        <!--begin::Label-->
                        <label class="form-label fw-bolder fs-6 text-gray-700">Receiver</label>
                        <!--end::Label-->
                        <!--begin::Select-->
                        <div class="fs-6">{{ $receiver ? $receiver->name : ''}}</div>
                        <!--end::Select-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="mb-10">
                        <!--begin::Label-->
                        <label class="form-label fw-bolder fs-6 text-gray-700">Currency</label>
                        <!--end::Label-->
                        <!--begin::Select-->
                        <select name="currnecy" aria-label="Select a Timezone" data-control="select2"
                            data-placeholder="Select currency" class="form-select form-select-solid">
                            <option value=""></option>
                            <option selected value="crypto">Crypto</option>
                        </select>
                        <!--end::Select-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="mb-10">
                        <!--begin::Label-->
                        <label class="form-label fw-bolder fs-6 text-gray-700">Please scan the QR code below to
                            transfer</label>
                        <!--end::Label-->
                        <!--begin::Select-->
                        <div class="fs-6">

                        </div>
                        <!--end::Select-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Separator-->
                    <div class="separator separator-dashed mb-8"></div>
                    <!--end::Separator-->
                    <!--begin::Actions-->
                    <div class="mb-0">
                        <button type="submit" href="#" class="btn btn-primary w-100" id="kt_invoice_pay_button">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen016.svg-->
                            <span class="svg-icon svg-icon-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none">
                                    <path
                                        d="M15.43 8.56949L10.744 15.1395C10.6422 15.282 10.5804 15.4492 10.5651 15.6236C10.5498 15.7981 10.5815 15.9734 10.657 16.1315L13.194 21.4425C13.2737 21.6097 13.3991 21.751 13.5557 21.8499C13.7123 21.9488 13.8938 22.0014 14.079 22.0015H14.117C14.3087 21.9941 14.4941 21.9307 14.6502 21.8191C14.8062 21.7075 14.9261 21.5526 14.995 21.3735L21.933 3.33649C22.0011 3.15918 22.0164 2.96594 21.977 2.78013C21.9376 2.59432 21.8452 2.4239 21.711 2.28949L15.43 8.56949Z"
                                        fill="black" />
                                    <path opacity="0.3"
                                        d="M20.664 2.06648L2.62602 9.00148C2.44768 9.07085 2.29348 9.19082 2.1824 9.34663C2.07131 9.50244 2.00818 9.68731 2.00074 9.87853C1.99331 10.0697 2.04189 10.259 2.14054 10.4229C2.23919 10.5869 2.38359 10.7185 2.55601 10.8015L7.86601 13.3365C8.02383 13.4126 8.19925 13.4448 8.37382 13.4297C8.54839 13.4145 8.71565 13.3526 8.85801 13.2505L15.43 8.56548L21.711 2.28448C21.5762 2.15096 21.4055 2.05932 21.2198 2.02064C21.034 1.98196 20.8409 1.99788 20.664 2.06648Z"
                                        fill="black" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->Confirm that the transfer has been made
                        </button>
                    </div>
                    <!--end::Actions-->
                    @else
                    <!--begin::Actions-->
                    <input type="hidden" value="1" name="enough"></input>
                    <div class="mb-0">
                        <button type="submit" href="#" class="btn btn-primary w-100" id="kt_invoice_upgrade_button">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen016.svg-->
                            <span class="svg-icon svg-icon-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none">
                                    <path
                                        d="M15.43 8.56949L10.744 15.1395C10.6422 15.282 10.5804 15.4492 10.5651 15.6236C10.5498 15.7981 10.5815 15.9734 10.657 16.1315L13.194 21.4425C13.2737 21.6097 13.3991 21.751 13.5557 21.8499C13.7123 21.9488 13.8938 22.0014 14.079 22.0015H14.117C14.3087 21.9941 14.4941 21.9307 14.6502 21.8191C14.8062 21.7075 14.9261 21.5526 14.995 21.3735L21.933 3.33649C22.0011 3.15918 22.0164 2.96594 21.977 2.78013C21.9376 2.59432 21.8452 2.4239 21.711 2.28949L15.43 8.56949Z"
                                        fill="black" />
                                    <path opacity="0.3"
                                        d="M20.664 2.06648L2.62602 9.00148C2.44768 9.07085 2.29348 9.19082 2.1824 9.34663C2.07131 9.50244 2.00818 9.68731 2.00074 9.87853C1.99331 10.0697 2.04189 10.259 2.14054 10.4229C2.23919 10.5869 2.38359 10.7185 2.55601 10.8015L7.86601 13.3365C8.02383 13.4126 8.19925 13.4448 8.37382 13.4297C8.54839 13.4145 8.71565 13.3526 8.85801 13.2505L15.43 8.56548L21.711 2.28448C21.5762 2.15096 21.4055 2.05932 21.2198 2.02064C21.034 1.98196 20.8409 1.99788 20.664 2.06648Z"
                                        fill="black" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->Upgrade
                        </button>
                    </div>
                    <!--end::Actions-->
                    @endif
            </form>
            @endif

        </div>

        <!--end::Card body-->
    </div>
    <!--end::Card-->

</x-base-layout>