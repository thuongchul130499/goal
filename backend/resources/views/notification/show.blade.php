@extends('layouts.app')
@section('content')
    <div class="page-content-wrapper mt-0">
        <h1>{{ translate($notification->data)->title }}</h1>
        <p>{{ translate($notification->data)->content }}</p>
    </div>
@endsection