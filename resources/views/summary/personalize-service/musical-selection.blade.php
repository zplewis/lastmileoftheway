@include('summary.included', ['htmlId' => $question->optional_html_id])

@if(session()->has($question->optional_html_id) && strcasecmp(session($question->optional_html_id), 'yes') === 0)

    @if (!session('song' . ($index ?? '1')) && !session('songCustom' . ($index ?? '1')))
        <p class="text-danger">No song specified for this musical selection.</p>
    @elseif (session('song' . ($index ?? '1')))
        @php
            $songModel = \App\Models\Song::find(session('song' . ($index ?? '1')));
        @endphp
        <p>Song:
            <a href="{{ $songModel->youtube_url }}" target="_blank">
            @if($songModel->artist) {{ $songModel->artist . ' - ' }}@endif
            {{ $songModel->name }}
            </a>
        </p>
    @else
        <p>Song: {{ session('songCustom' . ($index ?? '1')) }}</p>
    @endif

    @include('summary.required', ['htmlId' => 'songMinister' . ($index ?? '1'), 'desc' => 'Who is rendering the music?', 'defaultValue' => 'Undecided'])

@endif
