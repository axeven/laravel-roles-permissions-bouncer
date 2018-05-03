@extends('layouts.app')

@section('content')
<h3 class="page-title">@lang('global.questions.title')</h3>
<div id="question-form">
    <div class="row">
        <div class="input-field col s12">
            <input id="question_label" type="text" class="validate" value="{{ $question->label }}" name="label" required >
            <label for="question_label">{{ trans('global.questions.label') }}</label>
        </div>
    </div>
    <div class="row">
        <div class="input-field col s12">
            <input id="question_sentence" type="text" class="validate" value="{{ $question->sentence }}" name="sentence" required >
            <label for="question_sentence">{{ trans('global.questions.sentence') }}</label>
        </div>
    </div>
    <div class="row">
        <p class="col s12">
            <label>
                <input id="question_multichoice" type="checkbox"  name="multichoice"  {{ $question->choosability == 'multiple' ? 'checked': '' }} />
                <span>{{ trans('global.questions.multichoice') }}</span>
            </label>
        </p>
    </div>
    <div class="row">
        <div class="input-field col s12" id="answers">
            <?php $i = 0; ?>
            @foreach($answers as $ans)
                <div class="row answer-row">
                    <div class="input-field col s1">
                        <a class="btn draggable ui-sortable-handle"><i class="material-icons">reorder</i></a>
                        <input id="answer-id-{{ $i }}" type="hidden" class="answers_id" name="answer[id][{{ $ans->id }}]" value="{{ $ans->id }}">
                    </div>
                    <div class="input-field col s7">
                        <input id="answer-{{ $i }}" type="text" class="validate answers_sentence" name="answer[sentence][{{ $ans->id }}]" value="{{ $ans->sentence }}" required >
                        <label for="answer-{{ $i }}">{{ trans('global.answers.name') }}</label>
                    </div>
                    <div class="input-field col s3">
                        <input id="score-{{ $i }}" type="number" class="validate answer_score" name="answer[score][{{ $ans->id }}]" value="{{ $ans->score }}" required >
                        <label for="score-{{ $i }}" class="active">{{ trans('global.answers.score') }}</label>
                    </div>
                    <div class="input-field col s1">
                        <a class="btn red" onclick="return deleteAnswer('{{ $i }}')"><i class="material-icons">delete</i></a>
                    </div>
                </div>
                <?php $i++ ?>
            @endforeach
        </div>
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
        handle:'.draggable',
        cursor: 'move'
    });
    $('#add-question').click(function(){
        saveQuestion();
    });
});

function deleteAnswer(answerId){
    if(confirm('{{ trans('global.app_are_you_sure') }}')){
        var row = $('#answer-'+answerId).parents('.answer-row');
        if ($(row).find('#answer-id-' + answerId).length > 0){
            let data = {
                _token: "{{ csrf_token() }}",
                _method: "DELETE" 
            }
            $.post("{{ url('/admin/answers/') }}" + "/" + $(row).find('#answer-id-' + answerId).val(), data, function(response){
                if (response.success)
                    $(row).remove();
            }).fail(function(response){
                var errors = response.responseJSON;
                console.log(response);
            });
        }else{
            $(row).remove();
        }
    }
}

function saveQuestion(){
    let data = {
        _token: "{{ csrf_token() }}",
        _method: "PUT",
        question: {
            id: {{ $question->id }},
            label: $('#question_label').val(),
            sentence: $('#question_sentence').val(),
            multichoice: $('#question_multichoice').is(':checked'),
        },
        answers: [],
    };
    var answers = $('.answer-row');
    for (var i=0; i < answers.length; i++ ){
        var ans = {
            sentence: $(answers[i]).find('.answers_sentence').val(),
            score: Number($(answers[i]).find('.answer_score').val()),
        };
        if ($(answers[i]).find('.answers_id').length > 0){
            ans.id = $(answers[i]).find('.answers_id').val()
        }
        data.answers.push(ans);
    }
    console.log(data);
    $('#question-form').loading('destroy');
    $('#question-form').loading({
        overlay: $(createOverlay())
    });
    $.post("{{ url('/admin/questions') }}" + "/" + {{ $question->id }}, data, function(response){
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

function newAnswer(answerId, ){
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
          <a class="btn red" onclick="return deleteAnswer(`+answerId+`)" ><i class="material-icons">delete</i></a>
      </div>
  </div>`;
  return el;
}
</script>
@endsection