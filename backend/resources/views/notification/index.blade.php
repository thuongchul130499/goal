@extends('layouts.app')
@section('content')
    <div class="page-content-wrapper mt-0">
        <div class="col-lg-12 col-md-12">
            <div class="grid">
              <p class="grid-header">Thông báo</p>
              <div class="item-wrapper">
                <div class="table-responsive">
                  <table class="table">
                    <tbody>
                        @foreach (getNotifications() as $item)
                            <tr>
                                <td class="mx-70">
                                    <div class="icon-wrapper rounded-circle bg-inverse-warning text-warning mdi__item"><i class="mdi mdi-security"></i></div>
                                </td>
                                <td class="item__noti">
                                    <p>{{ $item['content'] }} <b>{{ $item['time'] }}</b></p>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
    </div>
@endsection
@section('style')
    @parent
    <style>
        .mdi__item {
            font-size: 20px;
            height: 35px;
            width: 40px;
            text-align: center;
        }
        .mw-70 {
            max-width: 70px;
        }
        .item__noti {
            cursor: pointer;
        }

        .item__noti:hover{
            background: #f3f2f2;
        }
    </style>
@endsection