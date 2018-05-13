<div class="row">
    <div class="col l12 input-field">
        <label>{{ $question->sentence }}</label>
    </div>
</div>
<div class="row">
    <div class="col l12 input-field survey" qid="{{ $question->id }}">
        @foreach($question->answers as $answer)
            <?php 
                $checked = ""; 
                $sid = ""; 
                foreach($surveys as $s){
                    if($s->question->id == $question->id && $s->answer->id == $answer->id){
                            $checked = "checked";
                            $sid = $s->id;
                    }
                }
            ?>
            <p>
                <label>
                    <input type="checkbox" class="filled-in" name="checkbox_{{ $question->id }}" {{ $sid != '' ? 'sid='.$sid : '' }}  value="{{ $answer->id }}" {{ $checked }} />
                    <span>{{ $answer->sentence }}</span>
                </label>
            </p>
        @endforeach
    </div>
</div>