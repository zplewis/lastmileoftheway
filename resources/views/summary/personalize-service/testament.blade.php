@php
    $htmlId = (strtolower($testament) ?? 'old') . 'TestamentReading';
@endphp

@if (!session($htmlId) && !session( $htmlId . 'Custom'))
    <p class="text-danger">No scripture reading has been chosen.</p>
@elseif ($scripture = \App\Models\Scriptures::find(session($htmlId)))
    @if (request()->is('*/pdf*') || $isPdf)
        <p>{{ $scripture->verses ?? '' }}</p>
        <figcaption class="blockquote-footer">
            <span class="scripture-location">{{ $scripture->location ?? '' }}</span>
            <cite class="scripture-version" title="Bible Version">({{ $scripture->bible_versions->name ?? '' }})</cite>
        </figcaption>
    @else
    <figure>
        <blockquote class="blockquote">{{ $scripture->verses ?? '' }}</blockquote>
        <figcaption class="blockquote-footer">
            <span class="scripture-location">{{ $scripture->location ?? '' }}</span>
            <cite class="scripture-version" title="Bible Version">({{ $scripture->bible_versions->name ?? '' }})</cite>
        </figcaption>
    </figure>
    @endif

@elseif(session($htmlId . 'Custom'))
    <p>Scripture: {{ session($htmlId . 'Custom') }}</p>
@endif

@include('summary.required', ['htmlId' => $htmlId . 'Reader', 'desc' => 'Who will read this scripture?', 'defaultValue' => 'Undecided'])
