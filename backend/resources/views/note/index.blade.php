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
                                            <th colspan="2" class="pl-4">Tiêu đề</th>
                                            <th>Nội dung</th>
                                            <th>Trạng thái</th>
                                            <th>Nhắc nhở trước</th>
                                            <th>Tự động nhắc nhở</th>
                                        </tr>
                                    </thead>
                                    <tbody id="add-goal">
                                    </tbody>
                                </table>
                            </div>
{{--                            @if ($goals->total() > 5)--}}
{{--                                <a --}}
{{--                                    class="border-top px-3 py-2 d-block text-gray view-more"--}}
{{--                                    href="javascript:void(0)"--}}
{{--                                    data-next-link="{{ $goals->nextPageUrl() }}"--}}
{{--                                    data-append-to="#add-goal"--}}
{{--                                >   --}}
{{--                                    <small class="font-weight-medium"><i class="mdi mdi-chevron-down mr-2"></i>View All Order History</small>--}}
{{--                                </a>--}}
{{--                            @endif --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
