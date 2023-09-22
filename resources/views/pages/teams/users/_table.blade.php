<!--begin::Table-->
{{ $dataTable->table() }}
<!--end::Table-->

{{-- Inject Scripts --}}
@section('scripts')
    {{ $dataTable->scripts() }}
    {{--  <script>
        $(document).ready(function(){
            console.log($('#btn-add-member'))
            $('#btn-add-member').click(function(){
                if(confirm('Are you sure confirm this user become member?'));
            })
        })

    </script>  --}}
@endsection
