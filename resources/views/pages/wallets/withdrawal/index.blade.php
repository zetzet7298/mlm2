<x-base-layout>

    <!--begin::Card-->
    <div class="card">
        <!--begin::Card body-->
        <div class="card-body pt-6">
            <h3 class="fw-bolder pt-10">Wallet</h3>

            <a href="#" class="btn btn-primary er fs-6 px-8 py-4" data-bs-toggle="modal"
            data-bs-target="#kt_modal_transfer">Cash Withdrawal</a>
            <h3 class="fw-bolder pt-10">Cash Withdrawal History</h3>
            @include('pages.wallets.withdrawal._table')
            @include('pages.wallets.withdrawal._withdrawal')
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Card-->

</x-base-layout>
