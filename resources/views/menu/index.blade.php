
<div class="foodix-tabs style-one mb-40 wow fadeInUp">
    <ul class="nav nav-tabs">
        @foreach ($categories as $category)
            <li>
                <button class="nav-link @if ($loop->first) active @endif" data-bs-toggle="tab" data-bs-target="#cat{{ $category->id }}">{{ $category->name }}</button>
            </li>
        @endforeach
    </ul>

    <div class="tab-content">
        @foreach ($categories as $category)
            <div class="tab-pane fade @if ($loop->first) show active @endif" id="cat{{ $category->id }}">
                <div class="row">
                    @foreach ($category->menuItems as $item)
                        <div class="col-xl-6">
                            <div class="menu-item style-one mb-40">
                                <div class="menu-thumbnail">
                                    <img src="{{ asset($item->image) }}" alt="{{ $item->name }} Thumbnail">
                                </div>
                                <div class="menu-info">
                                    <h4><a href="menu-details.html">{{ $item->name }}</a></h4>
                                    <p>{{ $item->description }}</p>
                                    <p class="price">${{ number_format($item->price, 2) }}</p>
                                    <form action="{{ route('cart.add') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="item_id" value="{{ $item->id }}">
                                        <button type="submit" class="theme-btn style-two">Add To Cart</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</div>
