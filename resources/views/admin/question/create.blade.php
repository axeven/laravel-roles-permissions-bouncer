@extends('layouts.app')

@section('content')

<h3 class="page-title">@lang('global.questions.title')</h3>
<div id="question-form">
    <div class="row">
        <div class="input-field col s12">
            <input id="question_label" type="text" class="validate" value="{{ old('label') }}" name="label" required >
            <label for="question_label">{{ trans('global.questions.label') }}</label>
        </div>
    </div>
    <div class="row">
        <div class="input-field col s12">
            <input id="question_sentence" type="text" class="validate" value="{{ old('sentence') }}" name="sentence" required >
            <label for="question_sentence">{{ trans('global.questions.sentence') }}</label>
        </div>
    </div>
    <div class="row">
        <p class="col s12">
            <label>
                <input id="question_multichoice" type="checkbox"  name="multichoice" />
                <span>{{ trans('global.questions.multichoice') }}</span>
            </label>
        </p>
    </div>
    <div class="row">
        <div class="input-field col s12" id="answers"></div>
    </div>
    <div class="row">
        <div class="input-field col s12">
            <a class="btn" id="add-answer" >{{ trans('global.answers.add') }}</a>
            <a class="btn" id="add-question" >{{ trans('global.app_save') }}</a>
        </div>
    </div>
</div>
<script type="text/javascript" src="{{ url('jquery-loading/jquery.loading.min.js') }}"></script>
<script type="text/javascript">
$(document).ready(function(){
  $('#add-answer').click(function(){
      $('#answers').append(newAnswer($('#answers').children().length));
    });
    $( "#answers" ).sortable({
        handle:'.ui-sortable-handle',
        cursor: 'move'
    });
    $('#add-question').click(function(){
        saveQuestion();
    });
    $('#add-answer').click();
});

function saveQuestion(){
    let data = {
        _token: "{{ csrf_token() }}",
        question: {
            label: $('#question_label').val(),
            sentence: $('#question_sentence').val(),
            multichoice: $('#question_multichoice').is(':checked'),
        },
        answers: [],
    };
    var answers = $('.answer-row');
    for (var i=0; i < answers.length; i++ ){
        data.answers.push({
            sentence: $(answers[i]).find('.answers_sentence').val(),
            score: Number($(answers[i]).find('.answer_score').val()),
        });
    }
    console.log(data);
    $('#question-form').loading('destroy');
    $('#question-form').loading({
        overlay: $(createOverlay())
    });
    $.post("{{ url('/admin/questions') }}", data, function(response){
        window.location = response.redirect;
    }).done(function(){
        $('#question-form').loading('destroy');
    }).fail(function(response){
        $('#question-form').loading('destroy');
        var errors = response.responseJSON;
        for (var k in errors){
            if (errors.hasOwnProperty(k)){
                unvalidate(k, errors[k]);
            }
        }
    });
}

function newAnswer(answerId){
  var nextScore = $('.answer-row').length  + 1;
  var el = `
  <div class="row answer-row">
      <div class="input-field col s1">
          <a class="btn ui-sortable-handle draggable"><i class="material-icons">reorder</i></a>
      </div>
      <div class="input-field col s7">
          <input id="answer-`+answerId+`" type="text" class="validate answers_sentence" name="answer[sentence][]" required >
          <label for="answer-`+answerId+`">{{ trans('global.answers.name') }}</label>
      </div>
      <div class="input-field col s3">
          <input id="score-`+answerId+`" type="number" class="validate answer_score" name="answer[score][]" value="`+nextScore+`" required >
          <label for="score-`+answerId+`" class="active">{{ trans('global.answers.score') }}</label>
      </div>
      <div class="input-field col s1">
          <a class="btn red"><i class="material-icons">delete</i></a>
      </div>
  </div>`;
  return el;
}
</script>
@endsection