<x-base-layout>

<!-- start page content -->
<div class="container card">
    <div class="row">
        <div class="col-md-12">
            <!--begin::Alert-->
            <div class="alert-primary">
                <!--begin::Icon-->
                {{-- <span class="svg-icon svg-icon-2hx svg-icon-primary me-3">...</span> --}}
                <!--end::Icon-->

                <!--begin::Wrapper-->
                <div class="d-flex flex-column">
                    <!--begin::Title-->
                    <!--end::Title-->
                    <!--begin::Content-->
                    <div class="px-4 fs-6 fw-bold">You receive a gift of 400 OGB (equivalent to $40) and lock it until 6/6/2024.</div>
                    <!--end::Content-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Alert-->
            <div class="symbol symbol-200px">
                <img src="{{ asset('images/gift.jpg') }}">
            </div>
        </div>
    </div>
</div>
<!-- end page content -->
@section('scripts')

<script type="text/javascript">

// $(document).ready(function () {
//     $('.quantity').on('change', function() {
//         const id = this.getAttribute('data-id')
//         console.log(id)
//         const productQuantity = this.getAttribute('data-productQuantity')
//         axios.patch('/cart/' + id, {quantity: this.value, productQuantity: productQuantity})
//             .then(response => {
//                 console.log(response)
//                 window.location.href = '{{ route('cart.index') }}'
//             }).catch(error => {
//                 window.location.href = '{{ route('cart.index') }}'
//             })
//     });
// });

</script>

@endsection
</x-base-layout>
