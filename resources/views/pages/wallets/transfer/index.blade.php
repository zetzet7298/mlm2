<x-base-layout>

    <!--begin::Card-->
    <div class="card">
        {{-- <div class="card-title m-0">
        </div>
         --}}
        <!--begin::Card body-->
        <div class="card-body pt-6">
            <h3 class="fw-bolder pt-10">Wallet</h3>

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
            <a href="#" class="btn btn-primary er fs-6 px-8 py-4" data-bs-toggle="modal"
            data-bs-target="#kt_modal_transfer">Transfer To Someone</a>
            <h3 class="fw-bolder pt-10">Transfer History</h3>
            @include('pages.wallets.transfer._transfer')
            @include('pages.wallets.transfer._table')
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Card-->

</x-base-layout>
