
                <ul class="listview image-listview flush transparent pt-1">
                    @if (count($riwayat))
                        @foreach ($riwayat as $item)
                            <li>
                                <a href="#" class="item">
                                    <img src="/assets/img/sample/avatar/avatar3.jpg" alt="image" class="image">
                                    <div>
                                        <div>
                                            {{ $item->masterTeacherAttend->name ?? "" }}
                                            <div class="text-muted">Diambil pada. {{ $item->created_at ?? "" }}</div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    @else
                        <li>
                            <span class="item">Belum Ada Absensi yang diambil</span>
                        </li>
                    @endif
                </ul>

                            {{ $riwayat->links() }}
