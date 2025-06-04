<section class="gallery-section section-padding">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h2 class="text-white mb-4">Our Medical Gallery</h2>
                <p class="lead text-white">Take a look at our state-of-the-art facilities and professional team</p>
            </div>
        </div>
        
        <div class="row">
            <!-- Gallery Item 1 -->
            <div class="col-lg-6 col-md-6 col-12 mb-4">
                <div class="gallery-item">
                    <img src="images/new-pics/5.jpg" class="gallery-image" alt="Professional Medical Team">
                    <div class="gallery-overlay">
                        <div class="overlay-content">
                            <h4>Professional Medical Team</h4>
                            <p>Our experienced doctors providing exceptional healthcare services</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Gallery Item 2 -->
            <div class="col-lg-6 col-md-6 col-12 mb-4">
                <div class="gallery-item">
                    <img src="images/new-pics/6.jpg" class="gallery-image" alt="Modern Facilities">
                    <div class="gallery-overlay">
                        <div class="overlay-content">
                            <h4>Modern Medical Facilities</h4>
                            <p>State-of-the-art equipment and comfortable patient areas</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Gallery Item 3 -->
            <div class="col-lg-6 col-md-6 col-12 mb-4">
                <div class="gallery-item">
                    <img src="images/gallery/about.jpg" class="gallery-image" alt="Patient Care">
                    <div class="gallery-overlay">
                        <div class="overlay-content">
                            <h4>Comprehensive Patient Care</h4>
                            <p>Dedicated to providing personalized healthcare solutions</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Gallery Item 4 -->
            <div class="col-lg-6 col-md-6 col-12 mb-4">
                <div class="gallery-item">
                    <img src="images/gallery/about2.jpg" class="gallery-image" alt="Advanced Technology">
                    <div class="gallery-overlay">
                        <div class="overlay-content">
                            <h4>Advanced Medical Technology</h4>
                            <p>Latest diagnostic and treatment equipment for accurate results</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.gallery-section {
    background: linear-gradient(135deg, #0099ff 0%, #0077cc 100%);
    overflow: hidden;
}

.gallery-item {
    position: relative;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    transition: all 0.3s ease;
    height: 300px;
}

.gallery-item:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
}

.gallery-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: all 0.3s ease;
}

.gallery-item:hover .gallery-image {
    transform: scale(1.1);
}

.gallery-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(45deg, rgba(0, 153, 255, 0.9), rgba(0, 119, 204, 0.9));
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: all 0.3s ease;
    border-radius: 20px;
}

.gallery-item:hover .gallery-overlay {
    opacity: 1;
}

.overlay-content {
    text-align: center;
    color: white;
    padding: 2rem;
    transform: translateY(20px);
    transition: all 0.3s ease;
}

.gallery-item:hover .overlay-content {
    transform: translateY(0);
}

.overlay-content h4 {
    font-size: 1.5rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
    color: white;
}

.overlay-content p {
    font-size: 1rem;
    line-height: 1.5;
    margin-bottom: 0;
    color: white;
}

/* Alternative layout for larger screens */
@media (min-width: 1200px) {
    .gallery-item {
        height: 350px;
    }
}

@media (max-width: 768px) {
    .gallery-item {
        height: 250px;
        margin-bottom: 1.5rem;
    }
    
    .overlay-content h4 {
        font-size: 1.25rem;
    }
    
    .overlay-content p {
        font-size: 0.9rem;
    }
    
    .overlay-content {
        padding: 1.5rem;
    }
}

/* Loading animation */
.gallery-image {
    background: linear-gradient(45deg, #f0f0f0, #e0e0e0);
}

/* Hover effect enhancement */
.gallery-item::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.1), transparent);
    transform: translateX(-100%);
    transition: transform 0.6s ease;
    z-index: 1;
}

.gallery-item:hover::before {
    transform: translateX(100%);
}
</style>

<script>
// Add smooth loading effect
document.addEventListener('DOMContentLoaded', function() {
    const galleryItems = document.querySelectorAll('.gallery-item');
    
    galleryItems.forEach((item, index) => {
        item.style.opacity = '0';
        item.style.transform = 'translateY(30px)';
        
        setTimeout(() => {
            item.style.transition = 'all 0.6s ease';
            item.style.opacity = '1';
            item.style.transform = 'translateY(0)';
        }, index * 200);
    });
});

// Optional: Add click functionality to gallery items
document.querySelectorAll('.gallery-item').forEach(item => {
    item.addEventListener('click', function() {
        // You can add lightbox functionality here
        console.log('Gallery item clicked');
    });
});
</script>