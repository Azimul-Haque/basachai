<!-- slider -->
<section id="slider" class="no-padding content-top-margin">
    <div id="owl-demo" class="owl-carousel owl-theme owl-half-slider dark-pagination">
        @foreach($sliders as $slider)
            <div class="item owl-bg-img" style="background-image:url('{{ asset('images/sliders/' . $slider->image) }}');">
                <div class="container position-relative">
                    <div class="slider-typography text-left">
                        <div class="slider-text-middle-main">
                            <div class="slider-text-middle padding-left-right-px animated fadeInUp">
                                <span class="owl-title white-text" style="background: rgba(0,0,0,0.3); padding: 10px;">{{ $slider->title }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>
<!-- end slider -->