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
                <div class="row">
                    <div class="col l2 .show-on-large"></div>
                    <div class="col l8 m12">
                        @foreach($question as $q)
                        @if($q->type == "text") 
                            @include('survey.formtext', ['question' => $q])
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
        </div>
    </div>
</div>

<script type="text/javascript">
function saveAndGoto(sectionId){
    let data = {
        _token: "{{ csrf_token() }}",
        surveys: [],
    };
    
}
</script>

@endsection