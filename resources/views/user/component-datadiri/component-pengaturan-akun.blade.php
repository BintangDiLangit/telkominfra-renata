<li class="{{ Route::currentRouteName() == 'pengaturan.data.diri' ? 'active' : '' }}">
    <a href="{{ route('pengaturan.data.diri') }}">Data Diri</a>
</li>
<li class="{{ Route::currentRouteName() == 'pengaturan.keluarga' ? 'active' : '' }}">
    <a href="{{ route('pengaturan.keluarga') }}">Keluarga</a>
</li>
<li class="{{ Route::currentRouteName() == 'pengaturan.kontak.darurat' ? 'active' : '' }}">
    <a href="{{ route('pengaturan.kontak.darurat') }}">Kontak Darurat</a>
</li>
<li class="{{ Route::currentRouteName() == 'pengaturan.pendidikan' ? 'active' : '' }}">
    <a href="{{ route('pengaturan.pendidikan') }}">Pendidikan</a>
</li>
<li class="{{ Route::currentRouteName() == 'pengaturan.riwayat.pekerjaan' ? 'active' : '' }}">
    <a href="{{ route('pengaturan.riwayat.pekerjaan') }}">Riwayat Pekerjaan</a>
</li>
<li class="{{ Route::currentRouteName() == 'pengaturan.dokumen' ? 'active' : '' }}">
    <a href="{{ route('pengaturan.dokumen') }}">Dokumen</a>
</li>
