@extends('layouts.app')
@section('style')
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endsection
@section('content')
<div class="profile-page tx-13 container">
    <Profile :current="{{ auth()->id() }}"/>
</div>
@endsection
@section('script')
    @parent
    <script src="{{ asset('js/dashboard.js') }}"></script>
@endsection