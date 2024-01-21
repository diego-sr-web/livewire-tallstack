<!--sidebar-->
<aside class="side-bar">
    @can('painel-maquinas')
        <a href="{{ route('machines') }}">
            <div class="side-bar-icon">
                <img src="{{ asset('imgs/maquina.svg') }}" alt="" class="icon-maquinas" />
                <span class="icon-description">Maquinas</span>
            </div>
        </a>
    @endcan
    @can('admin')
        <a href="{{ route('dashboards.index') }}">
            <div class="side-bar-icon">
                <img src="{{ asset('imgs/user.svg') }}" alt="" class="icon-maquinas" />
                <span class="icon-description">Admin</span>
            </div>
        </a>        
    @endcan
    <a href="{{ route('mail-marketing.index') }}">
        <div class="side-bar-icon">
            <img src="{{ asset('imgs/user.svg') }}" alt="" class="icon-maquinas" />
            <span class="icon-description">Mail-Marketing</span>
        </div>
    </a>
    <a href="{{ route('mail-transactional.index') }}">
        <div class="side-bar-icon">
            <img src="{{ asset('imgs/user.svg') }}" alt="" class="icon-maquinas" />
            <span class="icon-description">Transacional</span>
        </div>
    </a>
    <a href="{{ route('uploads.index') }}">
        <div class="side-bar-icon">
            <img src="{{ asset('imgs/user.svg') }}" alt="" class="icon-maquinas" />
            <span class="icon-description">Uploads</span>
        </div>
    </a>
    <a href="{{ route('list-meis.index') }}">
        <div class="side-bar-icon">
            <img src="{{ asset('imgs/user.svg') }}" alt="" class="icon-maquinas" />
            <span class="icon-description">Tabela-Meis</span>
        </div>
    </a>
</aside>
<!--Sidebar-->