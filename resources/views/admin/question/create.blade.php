@extends('layouts.app')

@section('content')

<h3 class="page-title">@lang('global.questions.title')</h3>
<form action="{{ route('admin.questions.store') }}" method="POST">
    <div class="row">
        <div class="input-field col s12">
            <input id="label" type="text" class="validate" value="{{ old('label') }}" name="label" >
            <label for="label">{{ trans('global.questions.label') }}</label>
        </div>
    </div>
    <div class="row">
        <div class="input-field col s12">
            <input id="sentence" type="text" class="validate" value="{{ old('sentence') }}" name="sentence" >
            <label for="sentence">{{ trans('global.questions.sentence') }}</label>
        </div>
    </div>
    <div class="row">
        <p class="col s12">
            <label>
                <input id="multichoice" type="checkbox"  name="multichoice" />
                <span>{{ trans('global.questions.multichoice') }}</span>
            </label>
        </p>
    </div>
    <div class="row">
        <div class="input-field col s12" id="answers">
        </div>
    </div>
    <div class="row">
        <div class="input-field col s12">
            <a class="btn" id="add-answer" >{{ trans('global.answers.add') }}</a>
        </div>
    </div>
</form>

<script type="text/javascript">
$(document).ready(function(){
  $('#add-answer').click(function(){
      $('#answers').append(newAnswer($('#answers').children().length));

    });
    $( "#answers" ).sortable({
        handle:'.ui-sortable-handle',
        cursor: 'move'
    });
    $('#add-answer').click();
});

function newAnswer(answerId){
  var el = `
  <div class="row ui-sortable">
      <div class="input-field col s1">
          <a class="btn ui-sortable-handle draggable"><i class="material-icons">reorder</i></a>
      </div>
      <div class="input-field col s7">
          <input id="answer-`+answerId+`" type="text" class="validate" name="answer[sentence][]" >
          <label for="answer-`+answerId+`">{{ trans('global.answers.name') }}</label>
      </div>
      <div class="input-field col s3">
          <input id="score-`+answerId+`" type="number" class="validate" name="answer[score][]" >
          <label for="score-`+answerId+`">{{ trans('global.answers.score') }}</label>
      </div>
      <div class="input-field col s1">
          <a class="btn red"><i class="material-icons">delete</i></a>
      </div>
  </div>`;
  return el;
}
</script>
@endsection