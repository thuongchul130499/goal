@if(Auth::check())
<div class="sidebar">
  <div class="user-profile">
    <div class="display-avatar animated-avatar">
      <img 
        class="profile-img img-lg rounded-circle cursor"
        src="{{ \Storage::url(Auth::user()->avatar) }}"
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
        <span class="link-title">Dashboard</span>
        <i class="mdi mdi-gauge link-icon"></i>
      </a>
    </li>
    <li>
      <a href="#sample-pages" data-toggle="collapse" aria-expanded="false">
        <span class="link-title">Sample Pages</span>
        <i class="mdi mdi-flask link-icon"></i>
      </a>
      <ul class="collapse navigation-submenu" id="sample-pages">
        <li>
          <a href="pages/sample-pages/login_1.html" target="_blank">Login</a>
        </li>
        <li>
          <a href="pages/sample-pages/error_2.html" target="_blank">Error</a>
        </li>
      </ul>
    </li>
    <li>
      <a href="#ui-elements" data-toggle="collapse" aria-expanded="false">
        <span class="link-title">UI Elements</span>
        <i class="mdi mdi-bullseye link-icon"></i>
      </a>
      <ul class="collapse navigation-submenu" id="ui-elements">
        <li>
          <a href="pages/ui-components/buttons.html">Buttons</a>
        </li>
        <li>
          <a href="pages/ui-components/tables.html">Tables</a>
        </li>
        <li>
          <a href="pages/ui-components/typography.html">Typography</a>
        </li>
      </ul>
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