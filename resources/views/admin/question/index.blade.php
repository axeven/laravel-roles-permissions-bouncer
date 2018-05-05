@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
<h3 class="page-title">@lang('global.questions.title')</h3>
<a href="{{ route('admin.questions.create') }}" class="btn-floating btn-large waves-effect waves-light red right"><i class="material-icons">add</i></a>
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
    <tbody>
        <?php $i = 1 ?>
        @if (count($questions) > 0)
            @foreach ($questions as $question)
                <tr>
                    <td class="center-align">{{ $i }}.</td>
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

<script type="text/javascript">
$(document).ready(function(){
    var currId = $('#select_section').val();
    $('#select_section').change(function(){
        if (currId !== $('#select_section').val()){
            window.location = "{{ route('admin.questions.index') }}?section_id=" + $('#select_section').val();
        }
    });
});
</script>
@stop
