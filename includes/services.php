<section class="section-padding srvces-section">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h2>Our Medical Services</h2>
                <p class="lead">Comprehensive healthcare solutions for you and your family</p>
            </div>
        </div>
        
        <!-- Services Carousel -->
        <div id="services-carousel" class="splide services-splide" aria-label="Medical Services">
            <div class="splide__track">
                <ul class="splide__list">
                    <li class="splide__slide">
                        <div class="service-card">
                            <div class="service-icon">
                                <i class="bi bi-bandaid-fill"></i>
                            </div>
                            <h4>Orthopedics</h4>
                            <p>Specialized care for bones, joints, muscles, and skeletal system disorders</p>
                        </div>
                    </li>
                    <li class="splide__slide">
                        <div class="service-card">
                            <div class="service-icon">
                                <i class="bi bi-heart-pulse-fill"></i>
                            </div>
                            <h4>Internal Medicine</h4>
                            <p>Comprehensive adult healthcare and management of chronic conditions</p>
                        </div>
                    </li>
                    <li class="splide__slide">
                        <div class="service-card">
                            <div class="service-icon">
                                <i class="bi bi-gender-female"></i>
                            </div>
                            <h4>Obstetrics and Gynecology</h4>
                            <p>Complete women's health care including pregnancy and reproductive health</p>
                        </div>
                    </li>
                    <li class="splide__slide">
                        <div class="service-card">
                            <div class="service-icon">
                                <i class="bi bi-droplet-fill"></i>
                            </div>
                            <h4>Dermatology</h4>
                            <p>Expert skin care and treatment of dermatological conditions</p>
                        </div>
                    </li>
                    <li class="splide__slide">
                        <div class="service-card">
                            <div class="service-icon">
                                <i class="bi bi-emoji-smile-fill"></i>
                            </div>
                            <h4>Pediatrics</h4>
                            <p>Specialized medical care for infants, children, and adolescents</p>
                        </div>
                    </li>
                    <li class="splide__slide">
                        <div class="service-card">
                            <div class="service-icon">
                            <i class="bi bi-radioactive" ></i>                                                    
                        </div>
                            <h4>Radiology</h4>
                            <p>Advanced imaging services including X-ray, CT, MRI, and ultrasound</p>
                        </div>
                    </li>
                    <li class="splide__slide">
                        <div class="service-card">
                            <div class="service-icon">
                                <i class="bi bi-hospital-fill"></i>
                            </div>
                            <h4>General Surgery</h4>
                            <p>Comprehensive surgical procedures and minimally invasive techniques</p>
                        </div>
                    </li>
                    <li class="splide__slide">
                        <div class="service-card">
                            <div class="service-icon">
                                <i class="bi bi-eye-fill"></i>
                            </div>
                            <h4>Ophthalmology</h4>
                            <p>Complete eye care including vision correction and eye surgery</p>
                        </div>
                    </li>
                    <li class="splide__slide">
                        <div class="service-card">
                            <div class="service-icon">
                                <i class="bi bi-house-heart-fill"></i>
                            </div>
                            <h4>Family Medicine</h4>
                            <p>Primary healthcare for patients of all ages and their families</p>
                        </div>
                    </li>
                    <li class="splide__slide">
                        <div class="service-card">
                            <div class="service-icon">
                                <i class="bi bi-wind"></i>
                            </div>
                            <h4>Chest Medicine</h4>
                            <p>Respiratory care and treatment of lung and chest conditions</p>
                        </div>
                    </li>
                    <li class="splide__slide">
                        <div class="service-card">
                            <div class="service-icon">
                                <i class="bi bi-capsule-pill"></i>
                            </div>
                            <h4>Anesthesia</h4>
                            <p>Safe and effective anesthesia services for surgical procedures</p>
                        </div>
                    </li>
                    <li class="splide__slide">
                        <div class="service-card">
                            <div class="service-icon">
                                <i class="bi bi-graph-up"></i>
                            </div>
                            <h4>Pathology</h4>
                            <p>Accurate diagnostic testing and laboratory services</p>
                        </div>
                    </li>
                    <li class="splide__slide">
                        <div class="service-card">
                            <div class="service-icon">
                                <i class="bi bi-headphones"></i>
                            </div>
                            <h4>ENT</h4>
                            <p>Ear, nose, and throat specialist care and treatment</p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<style>
    body{
        overflow-x: hidden; /* Prevent horizontal overflow */
    }

    .srvces-section {
        z-index: 1;
    }
    
    /* Services Carousel Styles */
    .services-splide {
        overflow: visible; 
        height: 300px; 
    }
    
    .splide__track {
        overflow: visible;
    }
    
    .splide__list {
        overflow: visible;
    }
    
    .service-card {
        background: white;
        border-radius: 15px;
        padding: 2rem;
        text-align: center;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        height: 280px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        margin: 0 5px;
    }

    .service-icon {
        background: linear-gradient(45deg, #0099ff, #0077cc);
        width: 70px;
        height: 70px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
    }

    .service-icon i {
        font-size: 2rem;
        color: white;
        font-weight: bold;
    }

    .service-card h4 {
        color: #333;
        font-weight: 600;
        margin-bottom: 1rem;
        font-size: 1.25rem;
    }

    .service-card p {
        color: #666;
        font-size: 0.95rem;
        line-height: 1.5;
        margin: 0;
    }

    /* Stats Card Styles */
    .stats-card {
        background: white;
        border-radius: 15px;
        padding: 2rem;
        text-align: center;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        height: 200px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        position: relative;
        z-index: 1;
    }

    .stats-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 30px rgba(0, 153, 255, 0.2);
        z-index: 10;
    }

    .stats-icon {
        font-size: 3rem;
        color: #0099ff;
        margin-bottom: 1rem;
    }

    .stats-number {
        font-size: 2.5rem;
        font-weight: 700;
        color: #333;
        margin-bottom: 0.5rem;
    }

    .stats-text {
        color: #666;
        font-weight: 500;
        margin: 0;
    }

    
</style>

