<div class="row">
    <div class="col l12 input-field">
        <label>{{ $question->sentence }}</label>
    </div>
</div>
<div class="row">
    <div class="col l12 input-field survey" qid="{{ $question->id }}" {{ isset($survey) ? 'sid='.$survey->id : '' }} >
        @foreach($question->answers as $answer)
            <p>
                <label>
                    <input class="with-gap" name="radio_{{ $question->id }}" value="{{ $answer->id }}" type="radio" {{ isset($survey) ? ($survey->valint == $answer->id ? 'checked' : ''): '' }} />
                    <span>{{ $answer->sentence }}</span>
                </label>
            </p>
        @endforeach
    </div>
</div>