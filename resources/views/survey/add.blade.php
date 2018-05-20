@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col l12 m12 s12">
        <div class="card">
            <div class="card-content">
                <ul class="tabs">
                    @foreach($sections as $s)
                        <li class="tab"><a target="_self" {{ $sectionId == $s->id ? 'class=active' : '' }} href="{{ route('survey.add', ['section_id' => $s->id]) }}">{{ $s->name }}</a></li>
                    @endforeach
                </ul>
                <div class="row" id="survey-list">
                    <div class="col l2 .show-on-large"></div>
                    <div class="col l8 m12">
                        @foreach($question as $q)
                        @if($q->type == "text") 
                            @include('survey.formtext', ['question' => $q])
                        @endif
                        @if($q->type == "textarea") 
                            @include('survey.formtextarea', ['question' => $q])
                        @endif
                        @if($q->type == "select-single") 
                            @include('survey.formradio', ['question' => $q])
                        @endif
                        @if($q->type == "select-multiple") 
                            @include('survey.formcheckbox', ['question' => $q])
                        @endif
                        @endforeach
                    </div>
                    <div class="col l2 .show-on-large"></div>
                </div>                
            </div>
            <div class="card-action center-align">
                @if ($prevSectionId > 0)
                    <a id="prev" class="btn green lighten-2">{{ trans('global.prev') }}</a>
                @endif
                @if ($nextSectionId > 0)
                    <a id="next" class="btn green lighten-2">{{ trans('global.next') }}</a>
                @endif
                @if ($canViewReport)
                    <a class="btn right" href="{{ route('survey.report') }}" >{{ trans('global.view_report') }}</a>
                @endif
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="{{ url('jquery-loading/jquery.loading.min.js') }}"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('#next').click(function(){
        saveAndGoto({{ $nextSectionId }});
    });
    $('#prev').click(function(){
        saveAndGoto({{ $prevSectionId }});
    });
});

function populateFormData(sectionId){
    let data = {
        _token: "{{ csrf_token() }}",
        section_id: sectionId,
        surveys: [],
    };
    var input = $(".survey");
    for(var i = 0; i < input.length; i++){
        var survey = {
            question_id : $(input[i]).attr('qid'),
            answers : []
        };
        if($(input[i]).find('input[type=text]').length > 0){
            answer  = {};
            if ($(input[i]).attr('sid')){
                answer.id = $(input[i]).attr('sid');
            }
            if($(input[i]).find('input[type=text]').val() != ""){
                answer.valtext = $(input[i]).find('input[type=text]').val();
                survey.answers.push(answer);
            }
        }
        if($(input[i]).find('input[type=radio]').length > 0){
            answer  = {};
            if ($(input[i]).attr('sid')){
                answer.id = $(input[i]).attr('sid');
            }
            if($(input[i]).find('input[type=radio]:checked').length > 0){
                answer.val = $(input[i]).find('input[type=radio]:checked').val();
                survey.answers.push(answer);
            }
        }
        if($(input[i]).find('input[type=checkbox]').length > 0){
            var checked = $(input[i]).find('input[type=checkbox]:checked');
            for(var j = 0; j < checked.length; j++){
                var answer = {};
                if($(checked[j]).attr('sid')){
                    answer.id = $(checked[j]).attr('sid');
                }
                answer.val = $(checked[j]).val();
                survey.answers.push(answer)
            }
        }
        if($(input[i]).find('textarea').length > 0){
            answer = {};
            if ($(input[i]).attr('sid')){
                answer.id = $(input[i]).attr('sid');
            }
            if($(input[i]).find('textarea').val() != ""){
                answer.valtext = $(input[i]).find('textarea').val();
                survey.answers.push(answer);
            }
        }
        data.surveys.push(survey);
    }
    return data;
}

function saveAndGoto(sectionId){
    let data = populateFormData(sectionId);
    $('#survey-list').loading('destroy');
    $('#survey-list').loading({
        overlay: $(createOverlay())
    });
    console.log(data);
    $.post("{{ route('survey.record') }}", data, function(response){
        console.log(response);
        window.location = response.redirect;
    }).done(function(){
        $('#survey-list').loading('destroy');
    }).fail(function(response){
        $('#survey-list').loading('destroy');
        var errors = response.responseJSON;
    });
}
</script>

@endsection