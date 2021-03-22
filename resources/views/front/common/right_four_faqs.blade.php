<div class="quesstion-wrapper">
    <div class="header">
        <span class="text">投资问答</span>
        <span class="more">更多 ></span>
    </div>
    <div class="cont">
        @foreach($data['faqs'] as $fk=>$fv)
            <div class="question-box">
                <div class="question">
                    <span class="tag">问</span>
                    <p>{!! $fv['questions'] !!}</p>
                </div>
                <div class="answer text-overflow-2">
                    {!! $fv['answers'] !!}
                </div>
            </div>
        @endforeach
    </div>
</div>