<!DOCTYPE html>
<html lang="en">
    <?php include 'headfoot/header.php'; ?>
    
        <!-- HTML -->
        <div class="sub-icons" id="subIcons">
        <!-- Close Button -->
        <div class="sub-icon-close" onclick="toggleSubIcons()">✖</div>

        <a class="sub-icon-wrapper" href="https://kyc.trishakti.com.np/kyc/" target="_blank">
            <div class="sub-icon">👤</div>
            <span class="icon-label">Open Account</span>
        </a>
        <a class="sub-icon-wrapper" href="https://kyc.trishakti.com.np/kyc/" target="_blank">
            <div class="sub-icon">🔑</div>
            <span class="icon-label">Broker Login</span>
        </a>
        <a class="sub-icon-wrapper" href="https://tms48.nepsetms.com.np/login" target="_blank">
            <div class="sub-icon">📈</div>
            <span class="icon-label">TMS Login</span>
        </a>
        <a class="sub-icon-wrapper" href="https://meroshare.cdsc.com.np/" target="_blank">
            <div class="sub-icon">💼</div>
            <span class="icon-label">MeroShare</span>
        </a>
        </div>

        <!-- Floating Learn Icon (Left) -->
        <div class="floating-icon learn" onclick="window.location.href='learn.php';">
        📚
        <span class="icon-label">Learn</span>
        </div>

        <!-- Floating Login Icon (Left) -->
        <div class="floating-icon login" onclick="toggleSubIcons()">
        🔐
        <span class="icon-label">Login</span>
        </div>




    <!-- Carousel Start -->
    <div class="container-fluid p-0 wow fadeIn" data-wow-delay="0.1s" id="home">
        <div id="header-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="3000">
        <!-- Carousel Indicators -->
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#header-carousel" data-bs-slide-to="0" class="active bg-dark" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#header-carousel" data-bs-slide-to="1" class="bg-dark" aria-label="Slide 2"></button>
        </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="img-fluid w-100" src="img/carousel-1.jpg" alt="Image">
                    <div class="carousel-caption">
                        <div class="container">
                            <div class="row justify-content-start w-100">
                                <div class="col-lg-8">
                                    <p class="d-inline-block border border-white rounded primary fw-semi-bold py-1 px-3 animated slideInDown">Broker 48</p>
                                    <h1 class="display-3 mb-1 hero animated slideInDown">Invest Smarter, <br>Grow Together</h1>
                                    <!-- <a href="" class="btn btn-primary py-3 px-5 animated slideInDown">Explore More</a> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="img-fluid w-100" src="img/carousel-2.jpg" alt="Image">
                    <div class="carousel-caption">
                        <div class="container">
                            <div class="row justify-content-start">
                                <div class="col-lg-8">
                                    <p class="d-inline-block border border-white rounded primary fw-semi-bold py-1 px-3 animated slideInDown">Broker 48</p>
                                    <h1 class="display-3 mb-1 hero animated slideInDown">True Trading Support <br>For You</h1>
                                    <!-- <a href="" class="btn btn-primary py-3 px-5 animated slideInDown">Explore More</a> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- Carousel End -->



    <!-- Facts Start -->
    <div class="container-fluid facts mb-5 py-5">
        <div class="container py-4">
            <div class="row g-5">
                <div class="col-12 col-sm-6 col-md-3 text-center wow fadeIn exp" data-wow-delay="0.1s">
                    <img class="ex" src="img/exp.png" alt="Image">
                    <!-- <i class="fa fa-award fa-3x text-white mb-3"></i> -->
                    <h1 class="display-4 text-white exp1" data-toggle="counter-up">18</h1>
                    <span class="fs-5 text-white">Years Experience</span>
                    <hr class="bg-white w-25 mx-auto mb-0">
                </div>
                <div class="col-12 col-sm-6 col-md-3 text-center wow fadeIn exp" data-wow-delay="0.3s">
                    <i class="fa fa-users fa-3x text-white mb-3"></i>
                    <h1 class="display-4 text-white exp" data-toggle="counter-up">30</h1>
                    <span class="fs-5 text-white">Dedicated Staff</span>
                    <hr class="bg-white w-25 mx-auto mb-0">
                </div>
                <div class="col-12 col-sm-6 col-md-3 text-center wow fadeIn exp" data-wow-delay="0.5s">
                    <i class="fa fa-user-plus fa-3x text-white mb-3"></i>
                    <h1 class="display-4 text-white" data-toggle="counter-up">100000</h1>
                    <span class="fs-5 text-white">Satisfied Clients</span>
                    <hr class="bg-white w-25 mx-auto mb-0">
                </div>
                <div class="col-12 col-sm-6 col-md-3 text-center wow fadeIn exp" data-wow-delay="0.7s">
                    <i class="fas fa-map-marked-alt fa-3x text-white mb-3"></i>
                    <h1 class="display-4 text-white" data-toggle="counter-up">5</h1>
                    <span class="fs-5 text-white">Branches</span>
                    <hr class="bg-white w-25 mx-auto mb-0">
                </div>
            </div>
        </div>
    </div>
    
    <!-- Facts End -->



    <!-- Features Start -->
    <div class="container-xxl feature py-5">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <p class="d-inline-block border rounded primary fw-semi-bold py-1 px-3">Why Choosing Us!</p>
                    <h1 class="display-5 mb-4">Few Reasons Why People Choosing Us!</h1>
                    <p class="mb-4 good-alignment">At Trishakti Securities, we prioritize trust, transparency, and customer satisfaction. Our expert team provides tailored trading strategies to help clients make informed decisions. With cutting-edge technology and 24/7 support, we ensure a seamless trading experience for all our clients. Choose us for reliable and efficient trading solutions.</p>
                    <!-- <a class="btn btn-primary py-3 px-5" href="">Explore More</a> -->
                </div>
                <div class="col-lg-6">
                    <div class="row g-4 align-items-center">
                        <div class="col-md-6">
                            <div class="row g-4">
                                <div class="col-12 wow fadeIn" data-wow-delay="0.3s">
                                    <div class="feature-box border rounded p-4">
                                        <i class="fa fa-check fa-3x primary mb-3"></i>
                                        <h4 class="mb-3">On-Time Payment</h4>
                                        <p class="mb-3 ">We ensure timely payments, building trust and reliability with every transaction. You can count on us for punctuality.</p>
                                        <!-- <a class="fw-semi-bold" href="">Read More <i class="fa fa-arrow-right ms-1"></i></a> -->
                                    </div>
                                </div>
                                <div class="col-12 wow fadeIn" data-wow-delay="0.5s">
                                    <div class="feature-box border rounded p-4">
                                        <i class="fa fa-check fa-3x primary mb-3"></i>
                                        <h4 class="mb-3">Guide & Support</h4>
                                        <p class="mb-3">We offer expert guidance and continuous support, ensuring you're always informed. Our team is here to assist you at every step.</p>
                                        <!-- <a class="fw-semi-bold" href="">Read More <i class="fa fa-arrow-right ms-1"></i></a> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 wow fadeIn" data-wow-delay="0.7s">
                            <div class="feature-box border rounded p-4">
                                <i class="fa fa-check fa-3x primary mb-3"></i>
                                <h4 class="mb-3">Financial Secure</h4>
                                <p class="mb-3">Your financial security is our priority, with robust protection measures in place. Trade with confidence knowing your assets are safe.</p>
                                <!-- <a class="fw-semi-bold" href="">Read More <i class="fa fa-arrow-right ms-1"></i></a> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Features End -->




    <!-- Testimonial Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <p class="d-inline-block border rounded primary fw-semi-bold py-1 px-3">Testimonial</p>
                <h1 class="display-5 mb-5">What Our Clients Say!</h1>
            </div>
            <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.3s">
                <div class="testimonial-item">
                    <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                        <div class="btn-square bg-white border rounded-circle">
                            <i class="fa fa-quote-right fa-2x primary"></i>
                        </div>
                        <b>"Investing through Trishakti Securities has been smooth and reliable. Their expert guidance, timely updates, and transparent service made stock trading easy for me. As a first-time investor, I felt confident and well-supported every step of the way."
                        </b>
                        
                        </div>
                    <img class="rounded-circle mb-3" src="img/user.png" alt="">
                    <h4>Client Name</h4>
                    <span>Profession</span>
                </div>
                <div class="testimonial-item">
                    <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                        <div class="btn-square bg-white border rounded-circle">
                            <i class="fa fa-quote-right fa-2x primary"></i>
                        </div>
                        <b>"Investing through Trishakti Securities has been smooth and reliable. Their expert guidance, timely updates, and transparent service made stock trading easy for me. As a first-time investor, I felt confident and well-supported every step of the way."
                        </b>
                    </div>
                    <img class="rounded-circle mb-3" src="img/user.png" alt="">
                    <h4>Client Name</h4>
                    <span>Profession</span>
                </div>
                <div class="testimonial-item">
                    <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                        <div class="btn-square bg-white border rounded-circle">
                            <i class="fa fa-quote-right fa-2x primary"></i>
                        </div>
                        <b>"Investing through Trishakti Securities has been smooth and reliable. Their expert guidance, timely updates, and transparent service made stock trading easy for me. As a first-time investor, I felt confident and well-supported every step of the way."
                        </b>
                    </div>
                    <img class="rounded-circle mb-3" src="img/user.png" alt="">
                    <h4>Client Name</h4>
                    <span>Profession</span>
                </div>
                <div class="testimonial-item">
                    <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                        <div class="btn-square bg-white border rounded-circle">
                            <i class="fa fa-quote-right fa-2x primary"></i>
                        </div>
                        <b>"Investing through Trishakti Securities has been smooth and reliable. Their expert guidance, timely updates, and transparent service made stock trading easy for me. As a first-time investor, I felt confident and well-supported every step of the way."
                        </b>
                    </div>
                    <img class="rounded-circle mb-3" src="img/user.png" alt="">
                    <h4>Client Name</h4>
                    <span>Profession</span>
                </div>
            </div>
        </div>
    </div>
    <!-- Testimonial End -->


    <div class="container-fluid facts py-5 my-5>
        <div class="container py-5 d-flex align-items-center justify-content-center">
            <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 100%;">
                <h1 class="display-5 text-white m-0">Ready to Start Your Investment Journey?</h1><br>
                <h3 class="lead text-white">Join us today and access powerful tools, resources, and support.</h3><br>
                <a href="https://kyc.trishakti.com.np/login" target="_blank" class="btn btn-light btn-lg text-black">Get Started Now</a>

            </div>
        </div>
    </div>
</div>

<?php include 'headfoot/footer.php'; ?>

</body>

</html>