<div class="row">
    <div class="col l12 input-field survey" qid="{{ $question->id }}">
        <textarea id="survey-{{ $question->id }}" class="materialize-textarea">{{ isset($survey) ? $survey->valtext : '' }}</textarea>
        <label for="survey-{{ $question->id }}">{{ $question->sentence }}</label>
    </div>
</div>