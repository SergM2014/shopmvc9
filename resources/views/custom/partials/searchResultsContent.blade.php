@if($searchResults->isNotEmpty())

  @foreach($searchResults as $result)

    <div class="search-results-item" data-previewProduct-id="{{ $result->id }}">
       <span class="text-danger"> {{ $result->author }}</span>
        <p> {{ $result->title }} </p>
    </div>

  @endforeach

@else

    @lang('messages.nothingFound')

@endif