<x-base-layout>

    <!--begin::Card-->
    <div class="card">
        <!--begin::Card body-->
        <div class="card-body pt-6 position-relative" id="kt_activities_body">

            <div id="scroll" class="scroll">
                {{-- <div id="tree" class="tree" style=""> --}}
                    {{-- @foreach ( $root as $k => $v )
                        
                    @endforeach --}}
                    {{-- {!! $tree !!} --}}
                    {{-- <ul>
                        <li>
                            <a>Administrator</a>
                            <ul>
                                <li>
                                    <a>3</a>
                                    <ul>
                                        <li>
                                            <a>6</a>
                                            <ul>
                                                <li><a>8</a></li>
                                                <li><a>9</a></li>
                                            </ul>
                                        </li>
                                        <li><a>10</a></li>
                                    </ul>
                                </li>
                                <li><a>5</a></li>
                            </ul>
                        </li>
                    </ul> --}}
                    {{-- <ul> --}}
                        {{-- {!! $tree !!} --}}
                    {{-- </ul> --}}
                {{-- </div> --}}
                <div id="kt_docs_jstree_basic">
                    <ul> 
                        {!! $tree !!}
                     </ul> 
                    {{-- <ul>
                        <li>
                            Root node 1
                            <ul>
                                <li data-jstree='{ "selected" : true }'>
                                    <a href="javascript:;">
                                        Initially selected </a>
                                </li>
                                <li data-jstree='{ "icon" : "flaticon2-gear text-success " }'>
                                    custom icon URL
                                </li>
                                <li data-jstree='{ "opened" : true }'>
                                    initially open
                                    <ul>
                                        <li data-jstree='{ "disabled" : true }'>
                                            Disabled Node
                                        </li>
                                        <li data-jstree='{ "type" : "file" }'>
                                            Another node
                                        </li>
                                    </ul>
                                </li>
                                <li data-jstree='{ "icon" : "flaticon2-rectangular text-danger" }'>
                                    Custom icon class (bootstrap)
                                </li>
                            </ul>
                        </li>
                        <li data-jstree='{ "type" : "file" }'>
                            <a href="http://www.keenthemes.com">
                                Clickable link node </a>
                        </li>
                    </ul> --}}
                </div>
            </div>


        </div>
        <!--end::Card body-->
    </div>  
    @include('team.system_tree._details')

    <!--end::Card-->
    @section('scripts')
    <script src="assets/plugins/custom/jstree/jstree.bundle.js"></script>
    
    <script>
        $('#kt_docs_jstree_basic').jstree({
    "core" : {
        "themes" : {
            "responsive": false
        }
    },
    "types" : {
        "default" : {
            "icon" : "fa fa-folder"
        },
        "file" : {
            "icon" : "fa fa-file"
        }
    },
    "plugins": ["types"]
});
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
                $('#modal_view_detail #username').html(result.username)
                // $('#modal_view_detail #level').html('F' + result.level)
                $('#modal_view_detail #level').html('F' + level)
                // $('#modal_view_detail #direct_user').html(result.direct_user_name)
                // $('#modal_view_detail #indirect_user').html(result.indirect_user_name)
                // $('#modal_view_detail #direct_total').html(result.direct_total + '$')
                // $('#modal_view_detail #indirect_total').html(result.indirect_total + '$')
                // $('#modal_view_detail #tiered_total').html(result.tiered_total + '$')
                // $('#modal_view_detail #gold_total').html(result.gold_total + '$')
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