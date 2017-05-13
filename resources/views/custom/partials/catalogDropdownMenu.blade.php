<div class="dropdown">
    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
        Order By
        <span class="caret"></span>
    </button>
    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">

        <li><a href="{{ route($currentRoute, $linkParametr?? '').'/AZ'  }}">A-Z</a></li>
        <li><a href="{{ route($currentRoute, $linkParametr?? '').'/ZA'  }}">Z-A</a></li>
        <li><a href="{{ route($currentRoute, $linkParametr?? '').'/cheap_first'  }}">Cheap first</a></li>
        <li><a href="{{ route($currentRoute, $linkParametr?? '').'/expensive_first'  }}">Expansive first</a></li>
        <li><a href="{{ route($currentRoute, $linkParametr?? '').'/new_first'  }}">New first</a></li>
        <li><a href="{{ route($currentRoute, $linkParametr?? '').'/old_first'  }}">Old first</a></li>

    </ul>
</div>