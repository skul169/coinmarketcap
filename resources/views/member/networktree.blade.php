@extends('app')

@section('htmlheader_title')
Home
@endsection

@section('main-content')
<link rel="stylesheet" href="{{ asset('css/style.min.css') }}" />
<div class="box">
    <div class="box-header">
        <h3 class="box-title">List</h3>
    </div><!-- /.box-header -->
    <div class="box-body">

        <div id="tree_ajax" class="tree_ajax">
            <div id="tree"></div>
        </div>
    </div><!-- /.box-body -->
</div>
@endsection


@section('inpage-script')
<script src="{{ asset('js/jstree.min.js') }}"></script>

<script type="text/javascript">
    $('#tree').jstree({
        'core': {
            'data': {
                'url': function (node) {
                    return node.id === '#' ?'?ajax=true' : '?ajax=true&parentid='+node.id;
                },
                'data': function (node) {
                    return {'id': node.id};
                }
            }
        }
    });
</script> 

@endsection
