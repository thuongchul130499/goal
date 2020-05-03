@extends('layouts.app')
@section('content')
    <div class="page-content-wrapper mt-0">
        <div class="col-lg-12">
            <div class="grid">
              <p class="grid-header">Profile</p>
              <div class="grid-body">
                <div class="item-wrapper">
                  <div class="row mb-3">
                    <div class="col-md-8 mx-auto">
                        <form action="{{ route('update-profile') }}" method="post">
                            @csrf
                            <div class="form-group row showcase_row_area">
                                <div class="col-md-3 showcase_text_area">
                                <label for="inputType1">{{ __('page.user.first') }}</label>
                                </div>
                                <div class="col-md-9 showcase_content_area">
                                    <input 
                                        type="text" 
                                        class="form-control @error('first_name') is-invalid @enderror" 
                                        name="first_name" 
                                        value={{ old('first_name') ? old('first_name') : $user->first_name }}
                                     >
                                    @error('first_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row showcase_row_area">
                                <div class="col-md-3 showcase_text_area">
                                <label for="inputType1">{{ __('page.user.last') }}</label>
                                </div>
                                <div class="col-md-9 showcase_content_area">
                                    <input type="text" 
                                        class="form-control @error('last_name') is-invalid @enderror"
                                        name="last_name" 
                                        value={{ old('last_name') ? old('last_name') : $user->last_name}}>
                                    @error('last_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row showcase_row_area">
                                <div class="col-md-3 showcase_text_area">
                                <label for="inputType12">{{ __('page.user.email') }}</label>
                                </div>
                                <div class="col-md-9 showcase_content_area">
                                    <input 
                                        type="email" 
                                        class="form-control" 
                                        name="email" 
                                        value="{{ $user->email}}"
                                        disabled>
                                </div>
                            </div>
                            <div class="form-group row showcase_row_area">
                                <div class="col-md-3 showcase_text_area">
                                <label for="inputType13">{{ __('page.user.password') }}</label>
                                </div>
                                <div class="col-md-9 showcase_content_area">
                                    <input 
                                        type="password" 
                                        class="form-control @error('password') is-invalid @enderror"
                                        name="password" 
                                        value={{ old('password') ? old('password') : '090582722'}}
                                        >
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row showcase_row_area">
                                <div class="col-md-3 showcase_text_area">
                                    <label for="inputType1">{{ __('page.user.phone') }}</label>
                                </div>
                                <div class="col-md-9 showcase_content_area">
                                    <input 
                                        type="text" 
                                        class="form-control @error('phone') is-invalid @enderror"
                                        name="phone" 
                                        placeholder="+84***"
                                        value={{ old('phone') ? old('phone') : $user->phone}}
                                    >
                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row showcase_row_area">
                                <div class="col-md-3 showcase_text_area">
                                  <label> {{ __('page.user.gender') }}</label>
                                </div>
                                <div class="col-md-9 showcase_content_area">
                                  <div class="form-inline">
                                    <div class="radio mb-3">
                                      <label class="radio-label mr-4">
                                        <input name="gender" type="radio" value="0" {{ $user->gender == 0 ? 'checked' : ''}}>Nam<i class="input-frame"></i>
                                      </label>
                                    </div>
                                    <div class="radio mb-3">
                                      <label class="radio-label">
                                        <input name="gender" type="radio" value="1" {{ $user->gender == 1 ? 'checked' : ''}}>Nữ<i class="input-frame"></i>
                                      </label>
                                    </div>
                                    <div class="radio mb-3">
                                        <label class="radio-label">
                                          <input name="gender" type="radio" value="2" {{ $user->gender == 2 ? 'checked' : ''}}>khác<i class="input-frame"></i>
                                        </label>
                                      </div>
                                  </div>
                                </div>
                              </div>
                            <div class="row showcase_row_area">
                                <div class="col-md-3 showcase_text_area">
                                <label>{{ __('page.user.notification_ref') }}</label>
                                </div>
                                <div class="col-md-9 showcase_content_area">
                                <div class="form-inline">
                                    <div class="checkbox mb-3">
                                    <label>
                                        <input 
                                            type="checkbox" 
                                            name="notification_preference[]" 
                                            class="form-check-input"
                                            {{ existRef($user, 'database') ? 'checked' : ''}}
                                            value="database"
                                        > {{ __('page.user.std') }}<i class="input-frame"></i>
                                    </label>
                                    </div>
                                    <div class="checkbox mb-3">
                                    <label>
                                        <input 
                                            type="checkbox" 
                                            name="notification_preference[]" 
                                            value="mail"
                                            {{ existRef($user, 'mail') ? 'checked' : ''}}
                                            class="form-check-input"> {{ __('page.user.emailS') }} <i class="input-frame"></i>
                                    </label>
                                    </div>
                                </div>
                                </div>
                            </div> 
                            <div class="form-group row showcase_row_area">
                                <div class="col-md-3 showcase_text_area">
                                    <label for="inputType9">{{ __('page.user.bio') }}</label>
                                </div>
                                <div class="col-md-9 showcase_content_area">
                                    <textarea 
                                        class="form-control
                                        @error('bio') is-invalid @enderror"
                                        name="bio"
                                        cols="12"
                                        rows="5"
                                    >{{ old('bio') ? old('bio') : $user->bio}}</textarea>
                                    @error('bio')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row showcase_row_area">
                                <button class="btn btn-primary has-icon btn-rounded m-auto" type="submit">
                                    <i class="mdi mdi mdi-autorenew"></i>{{ __('page.update') }}
                                </button>
                            </div>
                        </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </div>
@endsection