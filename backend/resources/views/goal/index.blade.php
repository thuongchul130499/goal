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
                                            <th>#</th>
                                            <th colspan="2" class="pl-4">{{ __('page.goal.goal')  }}</th>
                                            <th>{{ __('page.goal.desc') }}</th>
                                            <th>{{ __('page.goal.progress') }} </th>
                                            <th>{{ __('page.goal.due_to') }}</th>
                                            <th>{{ __('page.goal.started_at') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody id="add-goal">
                                        @include('goal._goals')
                                    </tbody>
                                </table>
                            </div>
                            @if ($goals->total() > 5)
                                <a 
                                    class="border-top px-3 py-2 d-block text-gray view-more"
                                    href="javascript:void(0)"
                                    data-next-link="{{ $goals->nextPageUrl() }}"
                                    data-append-to="#add-goal"
                                >   
                                    <small class="font-weight-medium"><i class="mdi mdi-chevron-down mr-2"></i>View All Order History</small>
                                </a>
                            @endif 
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
