                            <li class="nav-item">
                                <a href="{{ route('guru_quran.dashboard') }}">
                                    <i class="fas fa-home"></i>
                                    <p>Dashboard</p>
                                </a>
                            </li>
                            <li class="nav-item {{ Request::is('guru_quran/kelompok_halaqah')? 'active' : '' }}">
                                <a href="{{ route('guru_quran.kelompok_halaqah') }}">
                                    <i class="fas fa-user"></i>
                                    <p>Kelompok Halaqah</p>
                                </a>
                            </li>
                            <li class="nav-item {{ Request::is('guru_quran/mutabaah')? 'active' : '' }}">
                                <a href="{{ route('guru_quran.mutabaah') }}">
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
                                            <a href="{{ route('') }}">
                                                <span class="sub-item">Tambah Baru</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('guru_quran.nilai') }}">
                                                <span class="sub-item">Lihat Nilai</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
