<?php
    foreach($surveys as $s){
        if ($s->question->id == $question->id){
            $survey = $s;
            break;
        }
    }
?>
<div class="row">
    <div class="col l12 input-field survey" qid="{{ $question->id }}" {{ isset($survey) ? 'sid='.$survey->id : '' }} >
        <input id="survey-{{ $question->id }}" type="text" value="{{ isset($survey) ? $survey->valtext : '' }}" />
        <label for="survey-{{ $question->id }}">{{ $question->sentence }}</label>
    </div>
</div>