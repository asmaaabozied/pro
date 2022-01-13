<br>
<li class="{{ Request::is('home') ? 'active' : '' }}">
    <a href="{{ route('home') }}"><i class="fa fa-lg fa-home"></i><span style="font-size: medium;">&nbsp;&nbsp;{{trans('home.menu')}}</span></a>
</li>
<li class="treeview {{ (Request::is('roles*')||Request::is('permissions*')) ? 'active' : '' }}">
    <a href="#">
        <i class="fa fa-lg fa-cogs"></i> <span style="font-size: medium;">{{trans('common.menu.management')}}</span>
        <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li class="treeview {{ (Request::is('roles*')||Request::is('permissions*')) ? 'active' : '' }}">
            <a href="#">
                <i class="fa fa-lg fa-check-square-o"></i> <span style="font-size: medium;">{{trans('role.menu.name')}}</span>
                <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
        </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="{{ route('roles.index') }}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-lg fa-check-square-o"></i><span style="font-size: medium;">&nbsp;{{trans('role.menu.role')}}</span></a></li>
                <li><a href="{{ route('permissions.index') }}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-lg fa-check-square-o"></i><span style="font-size: medium;">&nbsp;{{trans('role.menu.permission')}}</span></a></li>
            </ul>
        </li>
        <li> <a href="{{ route('users.index', ['account_type' => 'admin']) }}"><i class="fa fa-lg fa-users"></i><span style="font-size: medium;">&nbsp;{{trans('user.menu.admin')}}</span></a></li>
    </ul>
</li>
<li class="treeview {{ (Request::is('aboutuses*')||Request::is('sliders*')||Request::is('socialMediaLinks*')) ? 'active' : '' }}">
    <a href="#">
        <i class="fa fa-lg fa-folder"></i> <span style="font-size: medium;">{{trans('common.menu.informative')}}</span>
        <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li><a href="{{ route('aboutuses.show', 1) }}"><i class="fa fa-lg fa-question-circle"></i><span style="font-size: medium;">&nbsp;{{trans('aboutus.about-us')}}</span></a></li>
        <li><a href="{{ route('aboutuses.show', 2) }}"><i class="fa fa-lg fa-file"></i><span style="font-size: medium;">&nbsp;{{trans('aboutus.terms-and-conditions')}}</span></a></li>
        <li><a href="{{ route('aboutuses.show', 3) }}"><i class="fa fa-lg fa-file-text-o"></i><span style="font-size: medium;">&nbsp;{{trans('aboutus.privacy-and-policy')}}</span></a></li>
        <li><a href="{{ route('sliders.index') }}"><i class="fa fa-lg fa-image"></i><span style="font-size: medium;">&nbsp;&nbsp;{{trans('slider.menu')}}</span></a></li>
        <li><a href="{{ route('socialMediaLinks.index') }}"><i class="fa fa-lg fa-link"></i><span style="font-size: medium;">&nbsp;&nbsp;{{trans('socialMediaLink.menu')}}</span></a></li>
        <li><a href="{{ route('supportTickets.index') }}"><i class="fa fa-lg fa-link"></i><span style="font-size: medium;">&nbsp;&nbsp;{{trans('supportTicket.menu')}}</span></a></li>
    </ul>
</li>
<li class="treeview {{ (Request::is('categories*')) ? 'active' : '' }}">
    <a href="#">
        <i class="fa fa-lg fa-database"></i> <span style="font-size: medium;">{{trans('category.menu')}}</span>
        <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li><a href="{{ route('categories.index') }}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-lg fa-database"></i><span style="font-size: medium;">&nbsp;{{trans('category.menu')}}</span></a></li>
        <li><a href="{{ route('categoryAttributes.index') }}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-lg fa-list"></i><span style="font-size: medium;">&nbsp;{{trans('categoryAttribute.menu')}}</span></a></li>
        
        <li class="{{ Request::is('brands*') ? 'active' : '' }}">
            <a href="{{ route('brands.index') }}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-lg fa-braille"></i><span style="font-size: medium;">&nbsp;&nbsp;{{trans('brand.menu')}}</span></a>
        </li>
    </ul>
</li>

<li class="treeview {{ (Request::is('countries*')||Request::is('cities*')) ? 'active' : '' }}">
    <a href="#">
        <i class="fa fa-lg fa-globe"></i> <span style="font-size: medium;">{{trans('country.main_menu')}}</span>
        <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
            <li><a href="{{ route('countries.index') }}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-lg fa-globe"></i><span style="font-size: medium;">&nbsp;{{trans('country.menu')}}</span></a></li>
        <li><a href="{{ route('cities.index') }}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-lg fa-globe"></i><span style="font-size: medium;">&nbsp;{{trans('city.menu')}}</span></a></li>
    </ul>
</li>
<li class="treeview {{ (Request::is('users*')||Request::is('addresses*')) ? 'active' : '' }}">
    <a href="#">
        <i class="fa fa-lg fa-users"></i> <span style="font-size: medium;">{{trans('user.menu.main')}}</span>
        <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li><a href="{{ route('users.index') }}">&nbsp;&nbsp;<i class="fa fa-lg fa-users"></i><span style="font-size: medium;">&nbsp;{{trans('user.menu.users')}}</span></a></li>
        <li><a href="{{ route('users.index', ['account_type' => 'store_owner']) }}">&nbsp;&nbsp;<i class="fa fa-lg fa-users"></i><span style="font-size: medium;">&nbsp;Store Owners</span></a></li>
        <li><a href="{{ route('usersReferral') }}">&nbsp;&nbsp;<i class="fa fa-lg fa-user-plus"></i><span style="font-size: medium;">&nbsp;User Referral</span></a></li>
        <li><a href="{{ route('addresses.index') }}">&nbsp;&nbsp;<i class="fa fa-lg fa-map-pin"></i><span style="font-size: medium;">{{trans('address.menu')}}</span></a></li>
    </ul>
</li>

<li class="treeview {{ (Request::is('subscriptions*')) ? 'active' : '' }}">
    <a href="#">
        <i class="fa fa-lg fa-database"></i> <span style="font-size: medium;">{{trans('subscription.menu')}}</span>
        <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">

        <li class="{{ Request::is('subscriptions*') ? 'active' : '' }}">
            <a href="{{ route('subscriptions.index') }}"><i class="fa fa-lg fa-ticket"></i><span style="font-size: medium;">&nbsp;&nbsp;{{trans('subscription.manage')}}</span></a>
        </li>

        <li class="{{ Request::is('subscriptions*') ? 'active' : '' }}">
            <a href="{{ route('subscriptions.view') }}"><i class="fa fa-lg fa-ticket"></i><span style="font-size: medium;">&nbsp;&nbsp;{{trans('subscription.menuView')}}</span></a>
        </li>

    </ul>
</li>

<li class="treeview {{ (Request::is('storeTypes*')||Request::is('stores*')||Request::is('storeRatings*')||Request::is('storeSubscriptions*')) ? 'active' : '' }}">
    <a href="#">
        <i class="fa fa-lg fa-building"></i> <span style="font-size: medium;">{{trans('store.menu')}}</span>
        <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li><a href="{{ route('storeTypes.index') }}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-lg fa-bars"></i><span style="font-size: medium;">&nbsp;{{trans('storeType.menu')}}</span></a></li>
        <li><a href="{{ route('stores.index') }}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-lg fa-building"></i><span style="font-size: medium;">&nbsp;{{trans('store.menu')}}</span></a></li>
        <li><a href="{{ route('storeRatings.index') }}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-lg fa-star-half-full"></i><span style="font-size: medium;">&nbsp;{{trans('storeRating.side-menu')}}</span></a></li>
        <li><a href="{{ route('storeSubscriptions.index') }}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-lg fa-ticket"></i><span style="font-size: medium;">&nbsp;{{trans('storeSubscription.menu')}}</span></a></li>
        <li><a href="{{ route('users.index', ['account_type' => 'client']) }}">&nbsp;&nbsp;<i class="fa fa-lg fa-users"></i><span style="font-size: medium;">&nbsp;{{trans('user.menu.client')}}</span></a></li>
    </ul>
</li>
<li class="treeview {{ (Request::is('products*')||Request::is('productRatings*')||Request::is('productsFavourites*')) ? 'active' : '' }}">
    <a href="#">
        <i class="fa fa-lg fa-archive"></i> <span style="font-size: medium;">{{trans('product.menu')}}</span>
        <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li><a href="{{ route('products.index') }}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-lg fa-archive"></i><span style="font-size: medium;">&nbsp;{{trans('product.menu')}}</span></a></li>
        <li><a href="{{ route('productRatings.index') }}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-lg fa-star-half-full"></i><span style="font-size: medium;">&nbsp;{{trans('productRating.side-menu')}}</span></a></li>
        <li><a href="{{ route('productsFavourites.index') }}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-lg fa-list"></i><span style="font-size: medium;">&nbsp;{{trans('productsFavourite.menu')}}</span></a></li>
    </ul>
</li>

<li class="treeview {{ (Request::is('orders*')||Request::is('carts*')||Request::is('orderActionsReasons*')) ? 'active' : '' }}">
    <a href="#">
        <i class="fa fa-lg fa-shopping-basket"></i> <span style="font-size: medium;">&nbsp;&nbsp;{{trans('order.menu')}}</span>
        <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li><a href="{{ route('carts.index') }}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-lg fa-shopping-cart"></i><span style="font-size: medium;">&nbsp;{{trans('cart.menu')}}</span></a></li>
        <li><a href="{{ route('orders.index') }}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-lg fa-shopping-basket"></i><span style="font-size: medium;">&nbsp;{{trans('order.menu')}}</span></a></li>
        <li><a href="{{ route('orderActions.index') }}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-lg fa-shopping-basket"></i><span style="font-size: medium;">&nbsp;{{trans('orderAction.menu')}}</span></a></li>
        <li><a href="{{ route('orderActionsReasons.index') }}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-lg fa-list"></i><span style="font-size: medium;">&nbsp;{{trans('orderActionsReason.menu')}}</span></a></li>
    </ul>
</li>

<li class="{{ Request::is('vouchers*') ? 'active' : '' }}">
    <a href="{{ route('vouchers.index') }}"><i class="fa fa-lg fa-ticket"></i><span style="font-size: medium;">&nbsp;&nbsp;{{trans('voucher.menu')}}</span></a>
</li>

<li >
    <a href="{{ route('coupons.index') }}"><i class="fa fa-tag fa-lg"></i><span style="font-size: medium;">&nbsp;&nbsp;{{trans('coupons.menu')}}</span></a>
</li>

<li class="{{ Request::is('notifications*') ? 'active' : '' }}">
    <a href="{{ route('notifications.index') }}"><i class="fa fa-lg fa-bell"></i><span style="font-size: medium;">&nbsp;&nbsp;{{trans('notification.menu')}}</span></a>
</li>


{{--<li class="{{ Request::is('orderActions*') ? 'active' : '' }}">
    <a href="{{ route('orderActions.index') }}"><i class="fa fa-edit"></i><span>Order Actions</span></a>
</li>--}}

