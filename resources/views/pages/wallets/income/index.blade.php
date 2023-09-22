<x-base-layout>

    <!--begin::Card-->
    <div class="card">
        <div class="card-title m-0">
            <h3 class="fw-bolder px-10 pt-10">Income History</h3>
        </div>
        <!--begin::Card body-->
        <div class="card-body pt-6">
            @include('pages.wallets.income._table')
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Card-->

</x-base-layout>
