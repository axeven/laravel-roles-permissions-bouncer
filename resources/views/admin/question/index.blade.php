@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('login-content')
<h3 class="page-title">@lang('global.questions.title')</h3>
<div class="right" id="reorder-btn-set">
    <a id="sort-cancel" class="btn-floating btn-large waves-effect waves-light red lighten-1"><i class="material-icons">close</i></a>
    <a id="sort-save" class="btn-floating btn-large waves-effect waves-light green lighten-1"><i class="material-icons">save</i></a>
</div>
<div class="right" id="btn-set">
    <a class="btn-floating btn-large waves-effect waves-light indigo lighten-1" id="reorder"><i class="material-icons">format_list_numbered</i></a>
    <a href="{{ route('admin.questions.create') }}" class="btn-floating btn-large waves-effect waves-light red lighten-1"><i class="material-icons">add</i></a>
</div>
<div class="input-field left">
    {!! Form::select('section', $sections, $sectionId, ['id' => 'select_section']) !!}
    {!! Form::label('section', trans('global.section.title')) !!}
</div>
<table class="highlight">
    <thead>
        <tr>
            <th style="text-align:center;">
                <!--input type="checkbox" id="select-all" /-->
                No.
            </th>
            <th>@lang('global.questions.label')</th>
            <th>@lang('global.questions.sentence')</th>
            <th>@lang('global.app_action')</th>
        </tr>
    </thead>
    <tbody id="question-list">
        <?php $i = 1 ?>
        @if (count($questions) > 0)
            @foreach ($questions as $question)
                <tr data-id="{{ $question->id }}">
                    <td class="td-num center-align">{{ $i }}.</td>
                    <td>{{ $question->label }}</td>
                    <td>{{ $question->sentence }}</td>
                    <td>
                        <a href="{{ route('admin.questions.edit',[$question->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                        {!! Form::open(array(
                            'style' => 'display: inline-block;',
                            'method' => 'DELETE',
                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                            'route' => ['admin.questions.destroy', $question->id])) !!}
                        {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
                <?php $i++; ?>
            @endforeach
        @else
            <tr>
                <td colspan="6" class="center-align">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
<div>&nbsp;</div>
<script type="text/javascript" src="{{ url('jquery-loading/jquery.loading.min.js') }}"></script>
<script type="text/javascript">
$(document).ready(function(){
    var currId = $('#select_section').val();
    $('#select_section').change(function(){
        if (currId !== $('#select_section').val()){
            window.location = "{{ route('admin.questions.index') }}?section_id=" + $('#select_section').val();
        }
    });
    $('#reorder-btn-set').hide();
    $('#reorder').click(function(){
        showReorder();
    });
    $('#sort-cancel').click(function(){
        $( '#question-list' ).sortable('cancel');
        hideReorder();
    });
    $('#sort-save').click(function(){
        saveReorder();
    });
});
function showReorder(){
    $('#btn-set').hide();
    $('#reorder-btn-set').show();
    $('.td-num').text('');
    $('.td-num').append('<a class="btn draggable"><i class="material-icons">reorder</i></a>');
    $( '#question-list' ).sortable({
        handle:'.draggable',
        cursor: 'move',
    });
}

function hideReorder(){
    $('#reorder-btn-set').hide();
    $('#btn-set').show();
    $('.td-num').empty();
    var tr = $('#question-list tr');
    for (var i = 1; i <= tr.length; i++){
        $(tr[i-1]).children('td').first().text(i + ".")
    }
}

function saveReorder(){
    $('#question-list').loading({
        overlay: $(createOverlay())
    });
    var tr = $('#question-list tr');
    data = {
        question : [],
        _token: "{{ csrf_token() }}",
        section_id: {{ $sectionId }},
    };
    for (var i = 0; i < tr.length; i++){
        data.question.push({
            id: $(tr[i]).attr('data-id'),
            order: i
        });
    }
    console.log(data);
    $.post("{{ url('/admin/questions/reorder') }}", data, function(response){
        console.log(response);
        window.location = response.redirect;
    }).done(function(){
        $('#question-list').loading('destroy');
    }).fail(function(response){
        $('#question-list').loading('destroy');
        var errors = response.responseJSON;
        for (var k in errors){
            if (errors.hasOwnProperty(k)){
                unvalidate(k, errors[k]);
            }
        }
    });
}

</script>
@stop
