<div class="row">
    <div class="col l12 input-field survey" qid="{{ $question->id }}">
        <input id="survey-{{ $question->id }}" type="text" value="{{ isset($survey) ? $survey->valtext : '' }}" />
        <label for="survey-{{ $question->id }}">{{ $question->sentence }}</label>
    </div>
</div>