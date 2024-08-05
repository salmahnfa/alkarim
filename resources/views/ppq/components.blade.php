                            <li class="nav-item">
                                <a href="{{ route('ppq.dashboard') }}">
                                    <i class="fas fa-home"></i>
                                    <p>Dashboard</p>
                                </a>
                            </li>  
                            <li class="nav-item {{ Request::is('ppq/kelompok-halaqah')? 'active' : '' }}">
                                <a href="{{ route('ppq.kelompok_halaqah') }}">
                                    <i class="fas fa-clipboard"></i>
                                    <p>Kelompok Halaqah</p>
                                </a>
                            </li>
                            <li class="nav-item {{ Request::is('ppq/rekap-nilai')? 'active' : '' }}">
                                <a href="{{ route('ppq.rekap_nilai') }}">
                                    <i class="fas fa-desktop"></i>
                                    <p>Rekap Nilai</p>
                                </a>
                            </li>