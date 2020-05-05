@extends('layouts.app')
@section('content')
    <div class="page-content-wrapper mt-0">
        <div class="page-content-wrapper-inner">
            <div class="content-viewport">
                <div class="row">
                    <div class="col-md-12 equel-grid">
                        <div class="grid">
                            <div class="grid-body py-3">
                                <p class="card-title ml-n1">
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#newGoal">{{ __('page.goal.create') }}</button>
                                </p>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover table-sm">
                                    <thead>
                                        <tr class="solid-header">
                                            <th colspan="2" class="pl-4">{{ __('page.goal.goal')  }}</th>
                                            <th>{{ __('page.goal.desc') }}</th>
                                            <th>{{ __('page.goal.progress') }} </th>
                                            <th>{{ __('page.goal.due_to') }}</th>
                                            <th>{{ __('page.goal.started_at') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($goals as $goal)
                                            <tr>
                                                <td class="pr-0 pl-4">
                                                    <img class="profile-img img-sm" src="{{ asset('template/images/profile/male/image_4.png') }}" alt="profile image">
                                                </td>
                                                <td class="pl-md-0">
                                                    <small class="text-black font-weight-medium d-block">{{ $goal->title }}</small>
                                                    <span class="text-gray">
                                                        <span class="status-indicator rounded-indicator small bg-primary"></span> Chi tiết
                                                    </span>
                                                </td>
                                                <td>
                                                    <small style="word-wrap: break-word; max-width: 150px; overflow: hidden">{{ $goal->description }}</small>
                                                </td>
                                                <td> {{ $goal->progress ?? 0 }} </td>
                                                <td>{{ $goal->due_to }}</td>
                                                <td>{{ $goal->started_at }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <a class="border-top px-3 py-2 d-block text-gray" href="#">
                                <small class="font-weight-medium"><i class="mdi mdi-chevron-down mr-2"></i>View All Order History</small>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="newGoal" tabindex="-1" role="dialog" aria-labelledby="newGoalId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelTitleId"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <Goal :lang="{{ json_encode(__('page')) }}"></Goal>
            </div>
        </div>
    </div>
@endsection