<div class="dropdown-menu navbar-dropdown dropdown-menu-right" aria-labelledby="notificationDropdown">
    <div class="dropdown-header">
      <h6 class="dropdown-title">Thông báo</h6>
      <p class="dropdown-title-text">Bạn có {{ count(Auth::user()->unreadNotifications) }} thông báo chưa đọc</p>
    </div>
    <div class="dropdown-body">
        @foreach (getNotifications() as $noti)
            @include('layouts.notification.item')
        @endforeach
    </div>
    <div class="dropdown-footer">
      <a href="#">View All</a>
    </div>
  </div>