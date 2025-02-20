
<div class="container-fluid py-3">
    <div class="row px-xl-5">
        <div class="col">
            <div class="owl-carousel vendor-carousel">
                @foreach($brands as $item)
                    <a href="{{ route('brand', $item->slug) }}">
                        <div class="bg-light p-4">
                            <img src="{{ $item->picture ?? '' }}" alt="{{ $item->title ?? '' }}">
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</div>