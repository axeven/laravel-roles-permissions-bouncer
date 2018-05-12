<div class="row">
    <div class="col l12 input-field">
        <label>{{ $question->sentence }}</label>
    </div>
</div>
<div class="row">
    <div class="col l12 input-field survey" qid="{{ $question->id }}">
        @foreach($question->answers as $answer)
            <?php $checked = "" ?>
            @if (isset($survey))
                @foreach($survey as $s)
                    @if($s->question->id == $question->id && $s->valint == $answer->id)
                        <?php $checked = "checked" ?> 
                    @endif
                @endforeach
            @endif
            <p>
                <label>
                    <input type="checkbox" class="filled-in" name="checkbox_{{ $question->id }}" {{ $checked }} />
                    <span>{{ $answer->sentence }}</span>
                </label>
            </p>
        @endforeach
    </div>
</div>