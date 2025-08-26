<section id="counter-section">
    <div class="container">
        <div class="section-title">
            <h2 class="text-light">What We've Achieved</h2>
            <p>
                Designing with intention. Building with care. Sustaining with
                vision.
            </p>
        </div>
        <div class="row">

            @forelse ($achievements as $achievement)
            <div class="col-md-3 text-center" data-aos="fade-up" data-aos-delay="200">
                <div class="single-counter">
                    <!-- <i class="fa-solid fa-drafting-compass counter-icon"></i> -->
                    <img src="{{ asset($achievement->image) }}" class="counter-img" alt="" />
                    <h3>
                        <span class="counter" id="counter3" data-target="30">{{ $achievement->count_number }}</span>+
                    </h3>
                    <h6>{{ $achievement->title }}</h6>
                </div>
            </div>
            @empty
            <div class="col-md-3 text-center" data-aos="fade-up" data-aos-delay="200">
                <div class="single-counter">
                    <!-- <i class="fa-solid fa-drafting-compass counter-icon"></i> -->
                    <img src="assets/images/trophy.png" class="counter-img" alt="" />
                    <h3>
                        <span class="counter" id="counter3" data-target="30">0</span>+
                    </h3>
                    <h6>Demo here. You need to add achievements</h6>
                </div>
            </div>
            @endforelse


        </div>
    </div>
</section>
