<ul class="nav nav-tabs nav-bold nav-tabs-line nav-tabs-line-3x justify-content-center">
    <li class="nav-item mr-3">
        <a class="nav-link {{ Route::currentRouteName() === 'store' ? 'active' : '' }}" href="{{ url('itemshop/featured') }}">
            <div class="d-block text-center">
                <div>
                    <img src="{{ asset('assets/media/im-category-featured.png') }}"
                         style="{{ Route::currentRouteName() !== 'store' ? 'filter: grayscale(100%)' : '' }}"
                         height="42px" alt="featured">
                </div>
                <div class="nav-text font-size-lg mt-3" style="margin-bottom: -20px;">Featured</div>
            </div>
        </a>
    </li>
    @foreach($categories as $category)
        <li class="nav-item mr-3">
            <a class="nav-link {{ Request::segment(2) === $category->url ? 'active' : '' }}
                @isset($product)
                {{ $product->product_category_id === $category->id ? 'active' : '' }}
                @endisset"
               href="{{ route('store.category', $category) }}">
                <div class="d-block text-center">
                    <div>
                        <img src="{{ $category->takeIcon }}"
                             style="@isset($product)
                                     {{ $product->product_category_id === $category->id ?? '' }}
                                     @endisset
                                    {{ Request::segment(2) === $category->url ? '' : 'filter: grayscale(100%)' }}"
                             height="42px" alt="{{ $category->slug }}">
                    </div>
                    <div class="nav-text font-size-lg mt-3" style="margin-bottom: -20px;">{{ $category->name }}</div>
                </div>
            </a>
        </li>
    @endforeach
</ul>
