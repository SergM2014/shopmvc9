@if($searchResults->isNotEmpty())

  @foreach($searchResults as $result)

    <a href="/product/{{ $result->id }}">
        <div class="search-results-item">
           <span class="text-danger"> {{ $result->author }}</span>
            <p> {{ $result->title }} </p>
        </div>
    </a>
  @endforeach

@else

    Nothing is found try another query!

@endif