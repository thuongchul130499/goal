@foreach ($lists->take(3) as $list)
    <img 
        class="img-sm"
        src="{{ $list->ava }}"
        alt="Profile Image" data-toggle="tooltip" title="{{ $list->fullname }}">
@endforeach
@if ($lists->count() > 3)
    <span class="plus-text img-sm">+{{ $lists->count() - 3 }}</span> 
@endif