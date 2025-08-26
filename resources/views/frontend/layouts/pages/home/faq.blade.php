<section id="faq-section">
    <div class="container">
        <div class="section-title">
            <h2>
                Frequently<span class="section-span-text">Asked Questions</span>
            </h2>
            <p>Get answers to our company’s most commontly asked</p>
        </div>
        <div class="row d-flex align-items-center">
            <div class="col-md-6" data-aos="fade-up">
                <div>
                    <img src="{{ asset('frontend') }}/assets/images/faq-img.png" class="img-fluid" alt="" />
                </div>
            </div>
            <div class="col-md-6" data-aos="fade-up" data-aos-delay="100">

                @forelse ($faqs as $faq)
                <div class="faq-item" onclick="toggleFAQ(this)">
                    <div class="faq-question">
                        <div class="faq-icon-bg">
                            <i class="faq-icon fa fa-plus"></i>
                        </div>
                        <div class="ms-2 faq-title">
                            {!! $faq->question !!}
                        </div>
                    </div>
                    <div class="faq-answer-wrapper">
                        <div class="faq-answer">
                            <p>
                                {!! $faq->answer !!}
                            </p>
                        </div>
                    </div>
                </div>
                @empty
                <div class="faq-item" onclick="toggleFAQ(this)">
                    <div class="faq-question">
                        <div class="faq-icon-bg">
                            <i class="faq-icon fa fa-plus"></i>
                        </div>
                        <div class="ms-2 faq-title">
                            Data not found
                        </div>
                    </div>
                    <div class="faq-answer-wrapper">
                        <div class="faq-answer">
                            <p>
                                You need to add FAQ from your admin dashboard.Thank you
                            </p>
                        </div>
                    </div>
                </div>
                @endforelse

            </div>
        </div>
    </div>
</section>
