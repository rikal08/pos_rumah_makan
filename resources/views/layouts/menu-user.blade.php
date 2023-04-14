<div class="sidebar-heading">
    Interface
</div>
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-table"></i>
        <span>Data Master</span>
    </a>
    <div id="collapseTwo" class="collapse {{ request()->is('data-user') ? 'show' : ''}} {{ request()->is('kategori') ? 'show' : ''}}" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Data Master:</h6>
            <a class="collapse-item {{ request()->is('data-user') ? 'active' : ''}}" href="{{ url('data-user') }}"> User</a>
            <a class="collapse-item {{ request()->is('kategori') ? 'active' : ''}}" href="{{ url('kategori') }}"> Kategori</a>
        </div>
    </div>
</li>

<li class="nav-item {{ request()->is('member') ? 'active' : ''}}">
    <a class="nav-link" href="{{ url('member') }}">
        <i class="fas fa-fw fa-users"></i>
        <span>Member</span></a>
</li>

<li class="nav-item {{ request()->is('produk') ? 'active' : ''}}">
    <a class="nav-link" href="{{ url('produk') }}">
        <i class="fas fa-fw fa-table"></i>
        <span>Produk</span></a>
</li>