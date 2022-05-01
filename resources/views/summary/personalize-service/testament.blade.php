@php
    $htmlId = (strtolower($testament) ?? 'old') . 'TestamentReading';
@endphp

@if (!session($htmlId) && !session( $htmlId . 'Custom'))
    <p class="text-danger">No scripture reading has been chosen.</p>
@elseif ($scripture = \App\Models\Scriptures::find(session($htmlId)))
    <figure>
        <blockquote class="blockquote">{{ $scripture->verses ?? '' }}</blockquote>
        <figcaption class="blockquote-footer">
            <span class="scripture-location">{{ $scripture->location ?? '' }}</span>
            <cite class="scripture-version" title="Bible Version">({{ $scripture->bible_versions->name ?? '' }})</cite>
        </figcaption>
    </figure>
@elseif(session($htmlId . 'Custom'))
    <p>Scripture: {{ session($htmlId . 'Custom') }}</p>
@endif

@include('summary.required', ['htmlId' => $htmlId . 'Reader', 'desc' => 'Scripture reader:', 'defaultValue' => 'Undecided'])
