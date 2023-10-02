<!--begin::Table-->
<div class="scroll">
{{ $dataTable->table() }}
</div>
<!--end::Table-->

{{-- Inject Scripts --}}
@section('scripts')
    {{ $dataTable->scripts() }}
@endsection
