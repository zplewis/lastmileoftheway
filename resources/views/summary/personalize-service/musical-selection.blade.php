@include('summary.included', ['htmlId' => 'hasMusicalSelection' . ($index ?? '1')])

@if (!session('song' . ($index ?? '1')) && !session('songCustom' . ($index ?? '1')))
    <p class="text-danger">No song specified for this musical selection.</p>
@elseif (session('song' . ($index ?? '1')))
    @php
        $songModel = \App\Models\Song::find(session('song' . ($index ?? '1')));
    @endphp
    <p>Song: <a href="{{ $songModel->youtube_url }} target="_blank">{{ $songModel->artist . ' ' . $songModel->name }}</a></p>
@endif

@include('summary.required', ['htmlId' => 'songMinister' . ($index ?? '1'), 'desc' => 'Who is rendering the music?', 'defaultValue' => 'Undecided'])