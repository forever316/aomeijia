<div class="quesstion-wrapper">
    <div class="header">

        <span class="text">投资问答</span>
        <a target="_blank" href="/invest/faqs">
            更多 >
        </a>
    </div>
    <div class="cont">
        @foreach($data['faqs'] as $fk=>$fv)
            <div class="question-box">
                <div class="question none-pointer">
                    <span class="tag">问</span>
                    <p>{!! $fv['questions'] !!}</p>
                </div>
                <div class="answer none-pointer text-overflow-2">
                    {!! $fv['answers'] !!}
                </div>
            </div>
        @endforeach
    </div>
</div>