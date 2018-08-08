@extends("pblades/rootblade")

@section("page_title")
@lang('content.checkin')
@stop

@section("main_content")
<table class="table table-bordered table-hover table-responsive" id="listview">
    
</table>
<script>
    function construct_url(id){
        return '{{url("ajax_requests/listview")}}'+"/"+id;
    }
    function bodyload(){
        var id={{session()->pull("id")}};
        var url=construct_url(id);
        get_menu("listview",url);
    }
</script>
@stop