<div class="side-profile">
    <img src="{{ asset('assets/profile.png') }}" class="foto-profile" alt="">
    <div class="name-profile">
        <p class="name">AkhmadKhoirudin</p>
        <p class="status">Kandidat</p>
    </div>
</div>
<div class="side-line"></div>
<div class="side-navbar">
    <ul>
        <li>
            <a href="{{ route('lamaran.saya') }}"
                class="{{ Route::currentRouteName() == 'lamaran.saya' ? 'active' : '' }}">
                <p>Lamaran Saya</p>
            </a>
        </li>
        <li>
            <a href="{{ route('lamaran.favorit') }}"
                class="{{ Route::currentRouteName() == 'lamaran.favorit' ? 'active' : '' }}">
                <p>Lowongan Favorit</p>
            </a>
        </li>
        <li>
            <a href="{{ route('pengaturan.data.diri') }}" class="{{ Request::is('pengaturan*') ? 'active' : '' }}">
                <p>Pengaturan Akun</p>
            </a>
        </li>
    </ul>

</div>
