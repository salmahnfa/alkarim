                            <li class="nav-item">
                                <a href="{{ route('admin_unit.dashboard') }}">
                                    <i class="fas fa-home"></i>
                                    <p>Dashboard</p>
                                </a>
                            </li>  
                            <li class="nav-item {{ Request::is('admin_unit/kelompok-halaqah')? 'active' : '' }}">
                                <a href="{{ route('admin_unit.kelompok_halaqah') }}">
                                    <i class="fas fa-clipboard"></i>
                                    <p>Kelompok Halaqah</p>
                                </a>
                            </li>
                            <li class="nav-item {{ Request::is('admin_unit/rekap-nilai')? 'active' : '' }}">
                                <a href="{{ route('admin_unit.rekap_nilai') }}">
                                    <i class="fas fa-desktop"></i>
                                    <p>Rekap Nilai</p>
                                </a>
                            </li>