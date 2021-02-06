@php
$reviews = reviews();
@endphp
<section class="testimonial-section section-padding">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="section_title text-center mb-30">
                    <h3 class="wow fadeInUp" data-wow-duration="1s" data-wow-delay=".2s">Our Happy Customers</h3>
                    <span class="wow fadeInUp" data-wow-duration="1s" data-wow-delay=".1s" style="background: #000 !important;"></span>
                </div>
            </div>
            <div class="testimonial-slider owl-carousel">
                @forelse($reviews as $review)
                <div class="single-testimonial">
                    <div class="testimonial-img ml-2">
                        <img src="{{@$review->image_path}}" alt="" class="rounded-circle" width="50px" height="50px" />
                    </div>
                    <div class="testimonial-content">
                        <h4>{{@$review->name}}</h4>
                        {{-- <h5>Self Employee</h5> --}}
                        <p>{{@$review->review}}</p>
                    </div>
                </div>
                @empty
                @endforelse
                {{-- <div class="single-testimonial">
                    <div class="testimonial-img ml-2">
                        <img src="{{asset('frontend/img/comment/comment_1.png')}}" alt="" />
                    </div>
                    <div class="testimonial-content">
                        <h4>Dwayne Johnson</h4>
                        <p>“Loanplus provide me a best rate compare to rest of bank i visted on all localbank.”</p>
                    </div>
                </div>
                <div class="single-testimonial">
                    <div class="testimonial-img ml-2">
                        <img src="{{asset('frontend/img/comment/comment_2.png')}}" alt="" />
                    </div>
                    <div class="testimonial-content">
                        <h4>Nia Jax</h4>
                        <p>“ Loanplus dеlіvеrеd еxасtlу whаt thеу offered. Nоt only dіd thеу оffеr uѕ a better rate.”</p>
                    </div>
                </div>
                <div class="single-testimonial">
                    <div class="testimonial-img ml-2">
                        <img src="{{asset('frontend/img/comment/comment_3.png')}}" alt="" />
                    </div>
                    <div class="testimonial-content">
                        <h4>Mohammed & Aashi</h4>
                        <p>“ I was іmрrеѕѕеd with the соnvеnіеnсе and very hеlрful сuѕtоmеr service.”</p>
                    </div>
                </div>
                <div class="single-testimonial">
                    <div class="testimonial-img ml-2">
                        <img src="{{asset('frontend/img/comment/comment_1.png')}}" alt="" />
                    </div>
                    <div class="testimonial-content">
                        <h4>Vihaan</h4>
                        <p>“ Dесlіnеd bу my local bаnk for a personal lоаn, I аm vеrу grаtеful tо Loanplus!.”</p>
                    </div>
                </div>
                <div class="single-testimonial">
                    <div class="testimonial-img ml-2">
                        <img src="{{asset('frontend/img/comment/comment_2.png')}}" alt="" />
                    </div>
                    <div class="testimonial-content">
                        <h4>Nia Jax</h4>
                        <p>“ Loanplus dеlіvеrеd еxасtlу whаt thеу offered. Nоt only dіd thеу оffеr uѕ a better rate.”</p>
                    </div>
                </div>
                <div class="single-testimonial">
                    <div class="testimonial-img ml-2">
                        <img src="{{asset('frontend/img/comment/comment_3.png')}}" alt="" />
                    </div>
                    <div class="testimonial-content">
                        <h4>Reyansh</h4>
                        <p>“ I was іmрrеѕѕеd with the соnvеnіеnсе and very hеlрful сuѕtоmеr service.”</p>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
</section>