<x-base-layout>

    <!--begin::Card-->
    <div class="card">
        <!--begin::Card body-->
        <div class="card-body pt-6 position-relative" id="kt_activities_body">

            <div id="scroll" class="scroll position-relative text-center" {{-- data-kt-scroll="true" --}} {{--
                data-kt-scroll-height="auto" --}} {{-- data-kt-scroll-wrappers="#kt_activities_body" --}} {{--
                data-kt-scroll-dependencies="#kt_activities_header, #kt_activities_footer" --}} {{--
                data-kt-scroll-offset="50px" --}}>
                <div id="tree" class="tree" style="">
                    {!! $tree !!}
                </div>
            </div>


        </div>
        <!--end::Card body-->
    </div>  
    @include('team.system_tree._details')

    <!--end::Card-->
    @section('scripts')
    <script>
        $(document).ready(function(){
        var outerContent = $('.scroll');
        var innerContent = $('.scroll > div');
        outerContent.scrollLeft( (innerContent.width() - outerContent.width()) / 2);

        $(document).on("click", ".kt_modal_add_customer_cancel2", function () {
            $("#kt_modal_add_customer").modal("hide");
           })
           $(document).on("click", ".kt_modal_add_customer_cancel", function () {
            $("#modal_view_detail").modal("hide");
           })
           $(document).on("click", ".view_detail", function () {
             let id = $(this).data("id");
             let level = $(this).data("level");
             let full_name = $(this).data("full_name");
            //  $("#edit_form").find('input[name="name"]').val(item.name);
            //  $("#edit_form").find('textarea[name="desc"]').val(item.desc);
            //  $("#edit_form").attr("action", "update-client-type/" + item["id"]);
            $.ajax({
              url: "/api/user/" + id, success: function(result){
                $('#modal_view_detail #full_name').html(full_name)
                $('#modal_view_detail #level').html('F' + level)
                $('#modal_view_detail #direct_user').html(result.direct_user_name)
                $('#modal_view_detail #indirect_user').html(result.indirect_user_name)
                $('#modal_view_detail #direct_total').html(result.direct_total + '$')
                $('#modal_view_detail #indirect_total').html(result.indirect_total + '$')
                $('#modal_view_detail #tiered_total').html(result.tiered_total + '$')
                $('#modal_view_detail #gold_total').html(result.gold_total + '$')
                $('#modal_view_detail #total').html(result.total + '$')
                $('#modal_view_detail #type').html(result.type)
              }}
          )
             $("#modal_view_detail").modal("show");
           });
    })
    </script>
    @endsection
</x-base-layout>