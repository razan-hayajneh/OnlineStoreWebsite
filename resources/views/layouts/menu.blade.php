<!-- need to remove -->
<li class="nav-item">
    <a href="{{ route('home') }}" class="nav-link active">
        <i class="nav-icon fas fa-home"></i>
        <p>Home</p>
    </a>
</li>
<li class="nav-item">
    <a href="{!! route('clients.index') !!}" class="nav-link {{ Request::is('clients*') ? 'active' : '' }}"><i
            class="nav-icon fa fa-user"></i><span>{{ __('models/clients.plural') }}</span></a>
</li>

<li class="nav-item">
    <a href="{{ route('categories.index') }}" class="nav-link {{ Request::is('categories*') ? 'active' : '' }}">
        <i class="nav-icon fa fa-sitemap"></i>
        <p>@lang('models/categories.plural')</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('options.index') }}" class="nav-link {{ Request::is('options*') ? 'active' : '' }}">
        <i class="nav-icon fa fa-list"></i>
        <p>@lang('models/options.plural')</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('orders.index') }}" class="nav-link {{ Request::is('orders*') ? 'active' : '' }}">
        <i class="nav-icon fa fa-box-open"></i>
        <p>@lang('models/orders.plural')</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('coupons.index') }}" class="nav-link {{ Request::is('coupons*') ? 'active' : '' }}">
        <i class="nav-icon fa fa-percent"></i>
        <p>@lang('models/coupons.plural')</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('socialMedia.index') }}"
       class="nav-link {{ Request::is('socialMedia*') ? 'active' : '' }}">
         <i class="nav-icon fa fa-globe"></i> <p>@lang('models/socialMedia.plural')</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('ratings.index') }}"
       class="nav-link {{ Request::is('ratings*') ? 'active' : '' }}">
       <i class="nav-icon fa fa-star"></i> <p>@lang('models/ratings.singular')</p>
    </a>
</li>
