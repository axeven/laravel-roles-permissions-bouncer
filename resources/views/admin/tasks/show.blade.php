@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.tasks.title')</h3>
    
    <p>
        <strong>Task Title: </strong> {{ $task->title }} <br/>
        <strong>Description: </strong> {{ $task->description }} <br/>
    </p>

    <a class="btn btn-primary" href="{{ route('admin.tasks.index') }}">@lang('global.app_back_to_list')</a>
    <a class="btn btn-primary" href="{{ route('admin.tasks.edit', [$task->id]) }}">@lang('global.app_edit')</a>
@stop