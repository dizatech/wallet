<li class="treeview {{ isActive(['wallet.index', 'transaction.index'], 'is-expanded') }}">
    <a class="app-menu__item" href="#" data-toggle="treeview">
        <i class="app-menu__icon fa fa-money"></i>
        <span class="app-menu__label">کیف پول</span>
        <i class="treeview-indicator fa fa-angle-left"></i>
    </a>
    <ul class="treeview-menu">
        <li class="">
            <a class="treeview-item pl-3 {{ isActive(['wallet.index']) }}" href="{{ route('wallet.index') }}">
                <i class="icon fa fa-circle-o"></i>مدیریت کیف پول
            </a>
        </li>
        <li class="">
            <a class="treeview-item pl-3 {{ isActive(['transaction.index']) }}" href="{{ route('transaction.index') }}">
                <i class="icon fa fa-circle-o"></i>تراکنش‌ها
            </a>
        </li>
    </ul>
</li>
