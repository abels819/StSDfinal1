@extends("pblades/rootblade")

@section("page_title")
@lang('content.welcomepage')
@stop
@section("main_content")


<script>
    function bodyload(){
        var url="{{url('ajax_requests/article')}}";
        get_menu("main_content_section",url);
    }
</script>
@stop