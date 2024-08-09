@switch(auth()->user()->role_id)
    @case(1)
        @php $role = "admin_pusat" @endphp
    @break

    @case(2)
        @php $role = "ppq" @endphp
    @break

    @case(3)
        @php $role = "admin_unit" @endphp
    @break

    @case(4)
        @php $role = "guru_quran" @endphp
    @break

    @default
        @php $role = "admin_pusat" @endphp
@endswitch


<li class="nav-item">
    <a href="{{ route($role . '.dashboard') }}">
        <i class="fas fa-home"></i>
        <p>Dashboard</p>
    </a>
</li>
@if (auth()->user()->role_id == 1)
    <li class="nav-item">
        <a data-toggle="collapse" href="#base">
            <i class="fas fa-layer-group"></i>
            <p>Users</p>
            <span class="caret"></span>
        </a>
        <div class="collapse" id="base">
            <ul class="nav nav-collapse">
                <li>
                    <a href= "{{ route($role . '.users.admin_pusat') }}">
                        <span class="sub-item">Administrator Pusat</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route($role . '.users.ppq') }}">
                        <span class="sub-item">PPQ</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route($role . '.users.admin_unit') }}">
                        <span class="sub-item">Administrator Unit</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route($role . '.users.guru_quran') }}">
                        <span class="sub-item">Guru Quran</span>
                    </a>
                </li>
            </ul>
        </div>
    </li>
    <li class="nav-item {{ Request::is($role . '/ujian') ? 'active' : '' }}">
        <a href="{{ route($role . '.ujian') }}">
            <i class="fas fa-pen"></i>
            <p>Ujian</p>
        </a>
    </li>
@endif
<li class="nav-item {{ Request::is($role .'/kelompok-halaqah') ? 'active' : '' }}">
    <a href="{{ route($role . '.kelompok_halaqah') }}">
        <i class="fas fa-clipboard"></i>
        <p>Kelompok Halaqah</p>
    </a>
</li>
@if (auth()->user()->role_id != 4)
    <li class="nav-item {{ Request::is($role . '/rekap_nilai') ? 'active' : '' }}">
        <a href="{{ route($role . '.rekap_nilai') }}">
            <i class="fas fa-desktop"></i>
            <p>Rekap Nilai</p>
        </a>
    </li>
@else
    <li class="nav-item {{ Request::is($role . '/mutabaah') ? 'active' : '' }}">
        <a href="{{ route($role . '.mutabaah') }}">
            <i class="fas fa-book"></i>
            <p>Mutabaah</p>
        </a>
    </li>
    <li class="nav-item">
        <a data-toggle="collapse" href="#base">
            <i class="fas fa-desktop"></i>
            <p>Nilai</p>
            <span class="caret"></span>
        </a>
        <div class="collapse" id="base">
            <ul class="nav nav-collapse">
                <li>
                    <a href="">
                        <span class="sub-item">Tambah Baru</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route($role . '.nilai') }}">
                        <span class="sub-item">Lihat Nilai</span>
                    </a>
                </li>
            </ul>
        </div>
    </li>
@endif
