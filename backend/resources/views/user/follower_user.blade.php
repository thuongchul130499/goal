@foreach ($lists->take(3) as $list)
    <img 
        class="img-sm"
        src="{{ asset('template/images/profile/male/image_4.png') }}"
        alt="Profile Image" data-toggle="tooltip" title="{{ $list->fullname }}">
@endforeach
@if ($lists->count() > 3)
    <span class="plus-text img-sm">+{{ $lists->count() - 3 }}</span> 
@endif