<div class="slidersection">
    <div class="custom-slider" id="customSlider">
        @foreach ($slider as $sliderData)
            <div class="slide{{ $loop->first ? ' active' : '' }}">
                <img src="{{ asset('storage/' . $sliderData->image) }}" alt="{{ $sliderData->title }}" />
                <div class="slide-caption">
                    <h2>{{ $sliderData->title }}</h2>
                </div>
            </div>
        @endforeach

        <button class="slider-control prev" type="button" aria-label="Previous slide">&#10094;</button>
        <button class="slider-control next" type="button" aria-label="Next slide">&#10095;</button>

        <div class="slider-indicators" aria-label="Slide navigation">
            @foreach ($slider as $sliderData)
                <button class="indicator{{ $loop->first ? ' active' : '' }}" type="button" data-slide="{{ $loop->index }}" aria-label="Go to slide {{ $loop->index + 1 }}"></button>
            @endforeach
        </div>
    </div>
</div>
