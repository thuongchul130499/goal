@if(Auth::check() && \Route::current()->getName() != 'show-user')
    <div class="sidebar">
        <div class="user-profile">
            <div class="display-avatar animated-avatar">
                <img
                    class="profile-img img-lg rounded-circle cursor"
                    src="{{ Auth::user()->ava }}"
                    alt="profile image" id="image-ava">
                <form action="" id="form-upload">
                    <input type="file" name="avatar" id="avatar" class="hide" accept="image/*">
                </form>
            </div>
            <div class="info-wrapper">
                <p class="user-name">{{ Auth::user()->getFullNameAttribute() }}</p>
                <h6 class="display-income">IP :{{ Auth::user()->ip_address }}</h6>
            </div>
        </div>
        <ul class="navigation-menu">
            <li class="nav-category-divider">MAIN</li>
            <li>
                <a href="{{ url('/') }}">
                    <span class="link-title">{{ __('page.dashboard') }}</span>
                    <i class="mdi mdi-gauge link-icon"></i>
                </a>
            </li>
            <li>
                <a href="#sample-pages" data-toggle="collapse" aria-expanded="false">
                    <span class="link-title">{{ __('page.job') }}</span>
                    <i class="mdi mdi-flask link-icon"></i>
                </a>
                <ul class="collapse navigation-submenu" id="sample-pages">
                    <li>
                        <a href="{{ route('goals.index') }}">{{ __('page.goal.list') }}</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="{{ route('notes.index') }}">
                    <span class="link-title">Ghi chú</span>
                    <i class="mdi mdi-note link-icon"></i>
                </a>
            </li>
            <li>
                <a href="pages/forms/form-elements.html">
                    <span class="link-title">Forms</span>
                    <i class="mdi mdi-clipboard-outline link-icon"></i>
                </a>
            </li>
            <li>
                <a href="pages/charts/chartjs.html">
                    <span class="link-title">Charts</span>
                    <i class="mdi mdi-chart-donut link-icon"></i>
                </a>
            </li>
            <li>
                <a href="pages/icons/material-icons.html">
                    <span class="link-title">Icons</span>
                    <i class="mdi mdi-flower-tulip-outline link-icon"></i>
                </a>
            </li>
        </ul>
    </div>
@endif
