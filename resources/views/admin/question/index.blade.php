@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
<h3 class="page-title">@lang('global.questions.title')</h3>
<a href="{{ route('admin.questions.create') }}" class="btn-floating btn-large waves-effect waves-light red right"><i class="material-icons">add</i></a>
<table class="highlight">
    <thead>
        <tr>
            <th style="text-align:center;">
                <!--input type="checkbox" id="select-all" /-->
                No.
            </th>
            <th>@lang('global.questions.fields.label')</th>
            <th>@lang('global.questions.fields.sentence')</th>
            <th>&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = ($questions->currentPage() - 1) * $questions->perPage() ?>
        @if (count($questions) > 0)
            @foreach ($questions as $question)
                <!--tr data-entry-id="{{ $question->id }}"-->
                <tr>
                    <td>{{ $i }}.</td>
                    <td>{{ $question->name }}</td>
                    <td>
                        @foreach ($question->abilities()->pluck('name') as $ability)
                            <span class="label label-info label-many">{{ $ability }}</span>
                        @endforeach
                    </td>
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
            @endforeach
        @else
            <tr>
                <td colspan="6" class="center-align">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
&nbsp;
@stop
