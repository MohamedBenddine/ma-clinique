<?php
// Set default background color
$backgroundColor = isset($param1) ? $param1 : 'white';
?>

<section class="section-padding" id="about" style="background-color: <?php echo $backgroundColor; ?>;">
    <div class="container">
        <div class="row align-items-center">
            <!-- Text Content -->
            <div class="col-lg-6 col-md-6 col-12 mb-5 mb-md-0">
                <div class="about-content">
                    <?php
                    $sql = "SELECT * from tblpage where PageType='aboutus'";
                    $query = $dbh->prepare($sql);
                    $query->execute();
                    $results = $query->fetchAll(PDO::FETCH_OBJ);

                    $cnt = 1;
                    if ($query->rowCount() > 0) {
                        foreach ($results as $row) {
                            ?>
                            
                            
                            <h2 class="about-title mb-4" style="color: <?php echo $backgroundColor == '#0099ff' ? 'white' : '#333'; ?>;">
                                <?php echo htmlentities($row->PageTitle); ?>
                            </h2>
                            
                            <div class="about-description" style="color: <?php echo $backgroundColor == '#0099ff' ? 'rgba(255,255,255,0.9)' : '#666'; ?>;">
                                <?php echo nl2br($row->PageDescription); ?>
                            </div>
                            
                            <div class="about-features mt-4">
                                <div class="feature-item" style="color: <?php echo $backgroundColor == '#0099ff' ? 'white' : '#333'; ?>;">
                                    <i class="bi bi-check-circle-fill" style="color: <?php echo $backgroundColor == '#0099ff' ? '#ffd700' : '#28a745'; ?>;"></i>
                                    <span>Professional Medical Care</span>
                                </div>
                                <div class="feature-item" style="color: <?php echo $backgroundColor == '#0099ff' ? 'white' : '#333'; ?>;">
                                    <i class="bi bi-check-circle-fill" style="color: <?php echo $backgroundColor == '#0099ff' ? '#ffd700' : '#28a745'; ?>;"></i>
                                    <span>24/7 Emergency Services</span>
                                </div>
                                <div class="feature-item" style="color: <?php echo $backgroundColor == '#0099ff' ? 'white' : '#333'; ?>;">
                                    <i class="bi bi-check-circle-fill" style="color: <?php echo $backgroundColor == '#0099ff' ? '#ffd700' : '#28a745'; ?>;"></i>
                                    <span>Modern Medical Equipment</span>
                                </div>
                                <div class="feature-item" style="color: <?php echo $backgroundColor == '#0099ff' ? 'white' : '#333'; ?>;">
                                    <i class="bi bi-check-circle-fill" style="color: <?php echo $backgroundColor == '#0099ff' ? '#ffd700' : '#28a745'; ?>;"></i>
                                    <span>Experienced Medical Team</span>
                                </div>
                            </div>
                            
                            <div class="about-cta mt-4">
                                <a href="#contact-us" class="btn btn-cta me-3" style="<?php echo $backgroundColor == '#0099ff' ? 'background: white; color: #0099ff; border: 2px solid white;' : 'background: #0099ff; color: white; border: 2px solid #0099ff;'; ?>">
                                    <i class="bi bi-calendar-check"></i> Book Appointment
                                </a>
                                <a href="tel:+213555123456" class="btn btn-outline-cta" style="<?php echo $backgroundColor == '#0099ff' ? 'border: 2px solid white; color: white;' : 'border: 2px solid #0099ff; color: #0099ff;'; ?>">
                                    <i class="bi bi-telephone"></i> Call Now
                                </a>
                            </div>
                            <?php
                            $cnt = $cnt + 1;
                        }
                    }
                    ?>
                </div>
            </div>

            <!-- Visual Content -->
            <div class="col-lg-6 col-md-6 col-12">
                <div class="about-visual">
                    <div class="visual-container">
                        <!-- Main Featured Circle -->
                        <div class="featured-circle-main bg-white shadow-lg d-flex justify-content-center align-items-center">
                            <div class="featured-content text-center">
                                <div class="featured-icon mb-3">
                                    <i class="bi bi-hospital" style="color: #0099ff; font-size: 3rem;"></i>
                                </div>
                                <div class="featured-number" style="color: #0099ff;">
                                    3 Licence
                                </div>
                                <div class="featured-text">
                                    Ouarnoughi-Benddine
                                </div>
                                <div class="featured-subtitle">
                                    Medical Center
                                </div>
                            </div>
                        </div>
                        
                        <!-- Stats Cards -->
                        <div class="stat-card stat-card-1">
                            <div class="stat-icon">
                                <i class="bi bi-people-fill"></i>
                            </div>
                            <div class="stat-number">500+</div>
                            <div class="stat-text">Happy Patients</div>
                        </div>
                        
                        <div class="stat-card stat-card-2">
                            <div class="stat-icon">
                                <i class="bi bi-award-fill"></i>
                            </div>
                            <div class="stat-number">15+</div>
                            <div class="stat-text">Years Experience</div>
                        </div>
                        
                        <div class="stat-card stat-card-3">
                            <div class="stat-icon">
                                <i class="bi bi-heart-pulse-fill"></i>
                            </div>
                            <div class="stat-number">24/7</div>
                            <div class="stat-text">Emergency Care</div>
                        </div>

                        <div class="stat-card stat-card-4">
                            <div class="stat-icon">
                                <i class="bi bi-briefcase-fill
                                "></i>
                            </div>
                            <div class="stat-number">10+</div>
                            <div class="stat-text">Specializations</div>
                        </div>

                        <div class="stat-card stat-card-5">
                            <div class="stat-icon">
                                <i class="bi bi-telephone-fill"></i>
                            </div>
                            <div class="stat-number">24/7</div>
                            <div class="stat-text">Supporting Clients</div>
                        </div>

                        <div class="stat-card stat-card-6">
                            <div class="stat-icon">
                                <i class="bi bi-geo-alt-fill"></i>
                            </div>
                            <div class="stat-number">3</div>
                            <div class="stat-text">Locations and More coming</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.about-content {
    padding-right: 2rem;
}

.about-title {
    font-size: 2.5rem;
    font-weight: 700;
    line-height: 1.2;
    margin-bottom: 1.5rem;
}

.about-description {
    font-size: 1.1rem;
    line-height: 1.8;
    margin-bottom: 2rem;
}

.about-features {
    margin: 2rem 0;
}

.feature-item {
    display: flex;
    align-items: center;
    margin-bottom: 1rem;
    font-weight: 500;
}

.feature-item i {
    font-size: 1.2rem;
    margin-right: 1rem;
    flex-shrink: 0;
}

.about-cta {
    margin-top: 2rem;
}

.btn-cta, .btn-outline-cta {
    padding: 12px 30px;
    font-weight: 600;
    border-radius: 50px;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.3s ease;
    font-size: 16px;
}

.btn-cta:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0, 153, 255, 0.3);
}

.btn-outline-cta:hover {
    background: #0099ff;
    color: white !important;
    transform: translateY(-2px);
}

.about-visual {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 500px;
}

.visual-container {
    position: relative;
    width: 400px;
    height: 400px;
    display: flex;
    justify-content: center;
    align-items: center;
}

.featured-circle-main {
    width: 280px;
    height: 280px;
    border-radius: 50%;
    border: 5px solid #0099ff;
    position: relative;
    z-index: 3;
}

.featured-circle-main:hover ~ .stat-card-1 {
    transform: translate(0, 30px);
}

.featured-circle-main:hover ~ .stat-card-2 {
    transform: translate(-30px, 30px);
}

.featured-circle-main:hover ~ .stat-card-3 {
    transform: translate(30px, 30px);
}

.featured-circle-main:hover ~ .stat-card-4 {
    transform: translate(0, -30px);
}

.featured-circle-main:hover ~ .stat-card-5 {
    transform: translate(-30px, -30px);
}

.featured-circle-main:hover ~ .stat-card-6 {
    transform: translate(30px, -30px);
}

.featured-content {
    padding: 1.5rem;
}

.featured-number {
    font-size: 1.8rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
}

.featured-text {
    font-size: 1rem;
    font-weight: 600;
    color: #333;
    margin-bottom: 0.25rem;
}

.featured-subtitle {
    font-size: 0.85rem;
    color: #666;
}

.stat-card {
    position: absolute;
    background: white;
    border-radius: 15px;
    padding: 1.2rem;
    text-align: center;
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
    border: 3px solid #f8f9fa;
    transition: all 0.3s ease;
    min-width: 150px;
    z-index: 2;
    max-width: 150px;
}

.stat-card:hover {
    transform: translateY(-8px) scale(1.05);
    box-shadow: 0 15px 40px rgba(0, 153, 255, 0.25);
    border-color: #0099ff;
}

/* Positioning cards around the circle */
.stat-card-1 {
    bottom: -90px;
    right: 133px;
}

.stat-card-2 {
    bottom: 30px;
    left: -60px;
}

.stat-card-3 {
    bottom: 30px;
    right: -60px;
    
}
.stat-card-4 {
    top: -90px;
    right: 133px;
}

.stat-card-5 {
    top: 30px;
    left: -60px;
}

.stat-card-6 {
    top: 30px;
    right: -60px;
    
}



.stat-icon {
    font-size: 1.8rem;
    color: #0099ff;
    margin-bottom: 0.5rem;
}

.stat-number {
    font-size: 1.4rem;
    font-weight: 700;
    color: #333;
    margin-bottom: 0.25rem;
}

.stat-text {
    font-size: 0.8rem;
    color: #666;
    font-weight: 500;
    line-height: 1.2;
}

@media (max-width: 1200px) {
    .visual-container {
        width: 350px;
        height: 350px;
    }
    
    .featured-circle-main {
        width: 250px;
        height: 250px;
    }
    
    .stat-card-1 {
        top: 10px;
        right: -10px;
    }
    
    .stat-card-2 {
        bottom: 20px;
        left: -10px;
    }
    
    .stat-card-3 {
        right: -30px;
    }
}

@media (max-width: 992px) {
    .about-content {
        padding-right: 0;
        text-align: center;
        margin-bottom: 3rem;
    }
    
    .about-title {
        font-size: 2rem;
    }
    
    .visual-container {
        width: 300px;
        height: 300px;
    }
    
    .featured-circle-main {
        width: 220px;
        height: 220px;
    }
    
    .stat-card {
        display: none;
    }
    
    .about-visual {
        min-height: 300px;
    }
}

@media (max-width: 768px) {
    .about-title {
        font-size: 1.75rem;
    }
    
    .visual-container {
        width: 250px;
        height: 250px;
    }
    
    .featured-circle-main {
        width: 200px;
        height: 200px;
    }
    
    .btn-cta, .btn-outline-cta {
        display: block;
        margin-bottom: 1rem;
        text-align: center;
        width: 100%;
    }
    
    .featured-content {
        padding: 1rem;
    }
    
    .featured-number {
        font-size: 1.5rem;
    }
}
</style>