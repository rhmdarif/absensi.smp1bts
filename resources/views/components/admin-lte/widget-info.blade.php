@props(['icon', 'teks', 'nilai', 'warna'])

<div class="info-box bg-{{ $warna ?? 'primary' }}">
    <span class="info-box-icon"><i class="{{ $icon ?? '' }}"></i></span>

    <div class="info-box-content">
        <span class="info-box-text">{{ $teks ?? 'Bookmarks' }}</span>
        <span class="info-box-number">{{ $nilai ?? '0' }}</span>
    </div>
    <!-- /.info-box-content -->
</div>
