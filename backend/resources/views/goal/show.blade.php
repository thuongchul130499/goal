@extends('layouts.app')
@section('content')
    <div class="row mt-0">
        <div class="col-md-12 col-sm-12 col-12 equel-grid">
            <div class="grid">
                <div class="grid-body text-gray row">
                    <div class="row col-3">
                        <img src="{{ Auth::user()->ava }}" alt="profile image" id="image-ava" class="profile-img img-sm rounded-circle cursor mr-3">
                        <h4 class="d-none d-lg-block d-xl-block">{{ Auth::user()->fullname }}</h4>
                    </div>
                    <div class="col-9">
                        <marquee direction="right">
                            <h4>
                                Mục tiêu cá nhân : {{ $goal->title }}
                            </h4>
                        </marquee>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-sm-12 col-12 equel-grid">
            <div class="grid border border-bottom p-3">
                <div class="row pb-2" style="border-bottom: 1px gray solid">
                    <h3 class="text-info">{{ __('page.goal.goal') }}</h3>
                    <div class="mt-auto ml-3">
                        <span class="badge badge-primary mt-auto">{{ $goal->due_to->format('Y-m-d') }}
                            ( {{ $goal->dayLeft }} )
                        </span>
                        {!! $goal->pgrStatus() !!}
                    </div> 
                </div>
                <div class="row m-3">
                    <div class="col-3 text-lg m-auto" style="font-size: 15px">
                        <a href="javascript:void(0)">
                            <i class="mdi mdi-dumbbell"></i>{{ $goal->title }}
                            <img src="{{ asset('images/done.png') }}" class="tooltipimg-done" alt="" width="40px" title="Tooltip on top">
                        </a>
                    </div>
                    <div class="col-6 m-auto text-center">
                        <h4>
                            <b id="actual-top" class="total-main">{{ $goal->progress }}%</b> / <small>100%</small></h4>
                        <div 
                            class="noUi-target noUi-ltr noUi-horizontal noUi-txt-dir-ltr task-noUi"
                            id="main-progress"
                            disabled
                            data-progress="{{ $goal->progress }}"
                        >
                        </div>
                    </div>
                    <div class="col-3 m-auto">
                        <div class="w-65 pull-left mr-4 pl-0">
                            <div class="input-group m-input-group m-input-group--pill">
                                <input
                                    title="Actual Progress" type="number"
                                    id="input-main"
                                    class="form-control m-input keyResultSliderInput krinput m-w-100 text-center actualKr20125"
                                    placeholder="Progress"
                                    value="{{ $goal->progress }}"
                                    min="0" max="100" disabled
                                >
                                <div class="input-group-append w-50">
                                    <span class="input-group-text targetunit" title="100 %">
                                        &nbsp;/100&nbsp;<span class="unit-show">%</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row m-3">
                    <p>
                        <a class="link" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                           <i class="mdi mdi-swap-vertical"></i> Show description
                        </a>
                      </p>
                      <div class="collapse col-md-12" id="collapseExample">
                        <div class="card card-body parent">
                            <div class="row">
                                <div class="col-md-11">
                                    <a href="#" class="text-dark edit-desc">
                                        <p>{{ $goal->description }}</p>
                                    </a>
                                </div>
                                <div class="col-md-1">
                                    <a href="#" class="edit-desc">
                                        <i class="mdi mdi mdi-tooltip-edit" style="font-size: 15px"></i>
                                    </a>
                                </div>
                            </div>
                            <textarea class="form-control to-none w-100 d-none" value="{{ $goal->description }}" id="main-desc">{{ $goal->description }}</textarea>
                            <button class="btn btn-sm to-none d-none">Lưu</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-sm-12 col-12 equel-grid">
            <div class="grid border border-bottom p-3">
                <div class="row">
                    <div class="col-6">
                        <h4 class="text-warning"> Điểm then chốt</h4>
                    </div>
                    <div class="col-6">
                        <a href="javascript:void(0)" class="pull-right mt-auto">
                            <span class="badge badge-warning" data-toggle="modal" data-target="#modal-task">
                                Tạo điểm then chốt
                            </span>
                        </a>
                    </div>
                </div>
                @foreach ($goal->tasks as $task)
                    <div class="row" id="row-task-{{ $task->id }}">
                        <div class="col-md-12">
                            <div class="row m-3">
                                <div class="col-3 text-lg m-auto" style="font-size: 15px">
                                    <a href="javascript:void(0)">
                                        <i class="mdi mdi-dumbbell"></i>{{ $task->title }}
                                        <img src="{{ asset('images/done.png') }}" class="tooltipimg-done" alt="" width="40px" title="Tooltip on top">
                                    </a>
                                </div>
                                <div class="col-6 m-auto text-center">
                                    <h4>
                                        <b id="actual-top" class="progress-task-{{ $task->id }}">{{ $task->progress }}%</b> / <small>100%</small>
                                    </h4>
                                    <div 
                                        id="slider-task-{{ $task->id }}"
                                        class="noUi-target noUi-ltr noUi-horizontal noUi-txt-dir-ltr task-noUi"
                                        data-progress="{{ $task->progress }}"
                                        data-task-id="{{ $task->id }}"
                                    >
                                    </div>
                                </div>
                                <div class="col-3 m-auto">
                                    <div class="w-65 pull-left pl-0">
                                        <div class="input-group m-input-group m-input-group--pill">
                                            <input 
                                                title="Actual Progress"
                                                type="number"
                                                class="form-control m-input krinput m-w-100 text-center progress-task"
                                                placeholder="Progress"
                                                min="0"
                                                max="100"
                                                step="0.5"
                                                data-id="{{ $task->id }}"
                                                id="input-task-{{ $task->id }}"
                                                value={{ $task->progress }}
                                            >
                                            <div class="input-group-append w-50">
                                                <span class="input-group-text targetunit" title="100 %">
                                                    &nbsp;/100&nbsp;<span class="unit-show">%</span>
                                                </span>
                                                <a 
                                                    href="javascript:void(0)"
                                                    class="m-auto edit-task" 
                                                    style="font-size: 20px" 
                                                    data-id="{{ $task->id }}" 
                                                    data-toggle="modal" 
                                                    data-target="#modal-task-{{ $task->id }}"
                                                >
                                                    <span class="mdi mdi-tooltip-edit"></span>
                                                </a>
                                                <div class="modal fade" id="modal-task-{{ $task->id }}"
                                                    tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                                   <div class="modal-dialog modal-lg" role="document">
                                                       <div class="modal-content">
                                                           <div class="modal-header">
                                                                   <h5 class="modal-title">Tạo điểm then chốt</h5>
                                                                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                       <span aria-hidden="true">&times;</span>
                                                                   </button>
                                                           </div>
                                                           <Task :lang="{{ json_encode(__('page')) }}" :id="{{ $goal->id}}" :task="{{ $task }}"/>                
                                                           <div class="modal-footer">
                                                               <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                               <button type="button" class="btn btn-primary">Save</button>
                                                           </div>
                                                       </div>
                                                   </div>
                                               </div>
                                                <a 
                                                    href="javascript:void(0)"
                                                    class="m-auto edit-task text-danger delete-task" 
                                                    style="font-size: 20px" 
                                                    data-id="{{ $task->id }}" 
                                                >
                                                    <span class="mdi mdi-close-octagon"></span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row m-3">
                                <p>
                                    <a class="link" data-toggle="collapse" href="#col" role="button" aria-expanded="false" aria-controls="collapseExample">
                                    <i class="mdi mdi-swap-vertical"></i> Show description
                                    </a>
                                </p>
                                <div class="collapse col-md-12" id="col">
                                    <div class="card card-body parent">
                                        <div class="row">
                                            <div class="col-md-11">
                                                <a href="#" class="text-dark edit-desc">
                                                    <p>{{ $task->note }}</p>
                                                </a>
                                            </div>
                                            <div class="col-md-1">
                                                <a href="#" class="edit-desc">
                                                    <i class="mdi mdi mdi-tooltip-edit" style="font-size: 15px"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <textarea class="form-control to-none w-100 d-none" value="{{ $goal->note }}" id="main-desc">{{ $goal->note }}</textarea>
                                        <button class="btn btn-sm to-none d-none">Lưu</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-task" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                        <h5 class="modal-title">Tạo điểm then chốt</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <Task :lang="{{ json_encode(__('page')) }}" :id="{{ $goal->id}}" />                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
@endsection
