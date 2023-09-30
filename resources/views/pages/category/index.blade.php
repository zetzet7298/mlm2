<x-base-layout>

    <!--begin::Card-->
    <div class="card">
        {{-- <div class="card-header border-0">
            <!--begin::Card title-->
            <div class="card-title">
                <a href="{{ route('category.create') }}" class="btn btn-primary">Add category</a>
            </div>
        </div> --}}
        <!--begin::Card body-->
        <div class="card-body">
            @include('pages.teams.users._table')
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Card-->
</x-base-layout>
