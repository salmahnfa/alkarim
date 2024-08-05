                            <li class="nav-item">
                                <a data-toggle="collapse" href="#base">
                                    <i class="fas fa-layer-group"></i>
                                    <p>Users</p>
                                    <span class="caret"></span>
                                </a>
                                <div class="collapse" id="base">
                                    <ul class="nav nav-collapse">
                                        <li>
                                            <a href= "{{ route('admin_pusat.users.admin_pusat') }}" >
                                                <span class="sub-item">Administrator Pusat</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('admin_pusat.users.ppq') }}">
                                                <span class="sub-item">PPQ</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('admin_pusat.users.admin_unit') }}">
                                                <span class="sub-item">Administrator Unit</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('admin_pusat.users.guru_quran') }}">
                                                <span class="sub-item">Guru Quran</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item {{ Request::is('admin_pusat/ujian')? 'active' : '' }}">
                                <a href="{{ route('admin_pusat.ujian') }}">
                                    <i class="fas fa-pen"></i>
                                    <p>Ujian</p>
                                </a>
                            </li>
                            <li class="nav-item {{ Request::is('admin_pusat/kelompok-halaqah')? 'active' : '' }}">
                                <a href="{{ route('admin_pusat.kelompok_halaqah') }}">
                                    <i class="fas fa-clipboard"></i>
                                    <p>Kelompok Halaqah</p>
                                </a>
                            </li>
                            <li class="nav-item {{ Request::is('admin_pusat/rekap_nilai')? 'active' : '' }}">
                                <a href="{{ route('admin_pusat.rekap_nilai') }}">
                                    <i class="fas fa-desktop"></i>
                                    <p>Rekap Nilai</p>
                                </a>
                            </li>