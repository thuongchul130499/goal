@foreach ($users as $user)
    @include('user._user_single', ['user' => $user])
@endforeach