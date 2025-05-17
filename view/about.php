<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BeeHat - Về Chúng Tôi</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- AOS Animation -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #ffc107;
            --secondary-color: #212529;
            --light-color: #FFFFFF;
            --dark-color: #343a40;
            --accent-color: #fd7e14;
        }

        body {
                    font-family: 'Roboto', sans-serif;
                    background-color: #f9f9f9;
                    color: #444;
                    line-height: 1.7;
                }

        /* Header & Navigation */
        .breadcrumbs {
            border-bottom: 1px solid rgba(0,0,0,0.05);
        }

        .bread span {
            font-weight: 500;
        }

        /* Hero Section */
        .hero-about {
            background: linear-gradient(135deg, rgba(255,193,7,0.1) 0%, rgba(253,126,20,0.1) 100%);
            padding: 100px 0 80px;
            position: relative;
            overflow: hidden;
        }

        .hero-about::before {
            content: "";
            position: absolute;
            top: -50px;
            right: -50px;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background: rgba(255,193,7,0.2);
            z-index: 0;
        }

        .hero-title {
            position: relative;
            z-index: 1;
        }

        /* About Content */
        .about-image {
            position: relative;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 15px 30px rgba(0,0,0,0.1);
        }

        .about-image img {
            transition: all 0.5s ease;
        }

        .about-image:hover img {
            transform: scale(1.03);
        }

        .about-image::after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 30%;
            background: linear-gradient(to top, rgba(0,0,0,0.6), transparent);
        }

        .about-badge {
            position: absolute;
            top: 20px;
            right: 20px;
            background-color: var(--primary-color);
            color: var(--dark-color);
            padding: 8px 15px;
            border-radius: 30px;
            font-weight: bold;
            font-size: 0.9rem;
            z-index: 2;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .feature-icon {
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: rgba(255,193,7,0.1);
            border-radius: 12px;
            margin-right: 20px;
            color: var(--accent-color);
            font-size: 1.5rem;
            transition: all 0.3s ease;
        }

        .feature-box:hover .feature-icon {
            background-color: var(--primary-color);
            color: var(--dark-color);
            transform: translateY(-5px);
        }

        .signature-wrapper {
            border-top: 1px dashed rgba(0,0,0,0.1);
            padding-top: 25px;
            margin-top: 30px;
        }

        .signature-img {
            width: 180px;
            margin-bottom: 10px;
            filter: brightness(1.1);
        }

        /* Brand Section */
        .brand-title {
            position: relative;
            display: inline-block;
        }

        .brand-title::after {
            content: "";
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background-color: var(--primary-color);
            border-radius: 3px;
        }

        .brand-card {
            position: relative;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            transition: all 0.4s ease;
        }

        .brand-card img {
            transition: all 0.4s ease;
        }

        .brand-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.15);
        }

        .brand-card:hover img {
            transform: scale(1.05);
        }

        /* Values Section */
        .values-section {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        }

        .value-card {
            background-color: white;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.05);
            height: 100%;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .value-card::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 5px;
            height: 0;
            background-color: var(--primary-color);
            transition: all 0.3s ease;
        }

        .value-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.1);
        }

        .value-card:hover::before {
            height: 100%;
        }

        .value-icon {
            width: 70px;
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: rgba(255,193,7,0.1);
            border-radius: 50%;
            margin-bottom: 20px;
            font-size: 1.8rem;
            color: var(--accent-color);
            transition: all 0.3s ease;
        }

        .value-card:hover .value-icon {
            background-color: var(--primary-color);
            color: var(--dark-color);
        }

        /* Stats Section */
        .stats-section {
            background-color: var(--dark-color);
            color: white;
        }

        .stat-item {
            text-align: center;
            padding: 30px 15px;
        }

        .stat-number {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 0;
            color: var(--primary-color);
            display: inline-block;
        }

        .stat-label {
            font-size: 1rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            opacity: 0.8;
        }

        /* Responsive Adjustments */
        @media (max-width: 992px) {
            .hero-about {
                padding: 60px 0;
            }

            .hero-title h1 {
                font-size: 2.2rem;
            }

            .stat-number {
                font-size: 2.2rem;
            }
        }

        @media (max-width: 768px) {
            .feature-icon {
                width: 50px;
                height: 50px;
                font-size: 1.3rem;
            }

            .hero-title h1 {
                font-size: 1.8rem;
            }

            .about-image::after {
                height: 40%;
            }
        }
    </style>
</head>
<body>



<!-- Hero Section -->
<section class="hero-about">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center hero-title" data-aos="fade-up">
                <h1 class="display-4 fw-bold mb-3">Khám Phá <span class="text-warning">BeeHat</span></h1>
                <p class="lead mb-4">Thương hiệu mũ cao cấp hàng đầu Việt Nam với hơn 10 năm kinh nghiệm</p>
                <div class="d-flex justify-content-center">
                    <a href="#about-content" class="btn btn-warning px-4 py-2 me-2">Tìm hiểu thêm</a>
                    <a href="?view=contact" class="btn btn-outline-dark px-4 py-2">Liên hệ ngay</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Main Content -->
<div id="about-content" class="py-5">
    <div class="container">
        <div class="row align-items-center g-5">
            <!-- Video Section -->
            <div class="col-lg-6" data-aos="fade-right" data-aos-delay="100">
                <div class="about-image">
                    <div class="about-badge">
                        <i class="fas fa-star me-1"></i> Premium
                    </div>
                    <img src="webroot/image/beehat.png" alt="BeeHat Studio" class="img-fluid">
                </div>
            </div>

            <!-- About Text -->
            <div class="col-lg-6" data-aos="fade-left" data-aos-delay="200">
                <div class="about-content">
                    <div class="d-flex align-items-center mb-4">
                        <i class="fas fa-crown text-warning me-3" style="font-size: 2rem;"></i>
                        <h2 class="display-6 fw-bold mb-0">BeeHat - Thương Hiệu Mũ Cao Cấp</h2>
                    </div>

                    <p class="lead mb-4">
                        Với sứ mệnh mang đến những sản phẩm chất lượng và phong cách độc đáo,
                        BeeHat tự hào là thương hiệu được yêu thích và tin dùng bởi hàng nghìn
                        khách hàng trên toàn quốc.
                    </p>

                    <div class="feature-box d-flex mb-4" data-aos="fade-up" data-aos-delay="100">
                        <div class="feature-icon">
                            <i class="fas fa-hat-cowboy"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-2">Đa dạng phong cách</h5>
                            <p class="mb-0">
                                Chuyên cung cấp các loại mũ thời trang từ cổ điển đến hiện đại.
                                Chúng tôi cam kết mang đến những sản phẩm chất lượng cao với thiết kế độc đáo,
                                phù hợp với mọi dịp và cá tính.
                            </p>
                        </div>
                    </div>

                    <div class="feature-box d-flex mb-4" data-aos="fade-up" data-aos-delay="200">
                        <div class="feature-icon">
                            <i class="fas fa-award"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-2">Không gian trải nghiệm</h5>
                            <p class="mb-0">
                                Nằm tại trung tâm thành phố, BeeHat tự hào là điểm đến uy tín của giới sành điệu
                                với không gian trưng bày sang trọng và đội ngũ tư vấn chuyên nghiệp.
                            </p>
                        </div>
                    </div>

                    <div class="feature-box d-flex mb-4" data-aos="fade-up" data-aos-delay="300">
                        <div class="feature-icon">
                            <i class="fas fa-shopping-bag"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-2">Dịch vụ tận tâm</h5>
                            <p class="mb-0">
                                Đội ngũ nhân viên chuyên nghiệp, tận tình tư vấn giúp khách hàng
                                lựa chọn sản phẩm phù hợp nhất với phong cách và nhu cầu cá nhân.
                            </p>
                        </div>
                    </div>

                    <div class="signature-wrapper" data-aos="fade-up" data-aos-delay="400">
                        <img src="webroot/image/nhasanglap.jpg" alt="Signature" class="signature-img">
                        <div>
                            <h6 class="fw-bold mb-1">Đinh Đức Trường</h6>
                            <p class="text-muted mb-0">Nhà sáng lập & CEO BeeHat</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Values Section -->
<section class="values-section py-5">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="display-6 fw-bold brand-title">
                Giá Trị Cốt Lõi
            </h2>
            <p class="lead text-muted mt-3">Những nguyên tắc định hướng thương hiệu của chúng tôi</p>
        </div>

        <div class="row g-4">
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="value-card">
                    <div class="value-icon">
                        <i class="fas fa-gem"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Chất Lượng</h4>
                    <p class="mb-0">
                        Chúng tôi không ngừng nâng cao tiêu chuẩn chất lượng, lựa chọn kỹ lưỡng các nguyên liệu
                        và quy trình sản xuất để đảm bảo mỗi sản phẩm đều xứng đáng với sự tin tưởng của khách hàng.
                    </p>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="value-card">
                    <div class="value-icon">
                        <i class="fas fa-lightbulb"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Sáng Tạo</h4>
                    <p class="mb-0">
                        Không ngừng sáng tạo và đổi mới là DNA của BeeHat. Chúng tôi luôn tìm tòi các xu hướng
                        mới nhất và phát triển những thiết kế độc đáo, khác biệt trên thị trường.
                    </p>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                <div class="value-card">
                    <div class="value-icon">
                        <i class="fas fa-handshake"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Chân Thành</h4>
                    <p class="mb-0">
                        Chúng tôi tin vào việc xây dựng mối quan hệ dài lâu với khách hàng và đối tác
                        dựa trên sự minh bạch, chân thành và tôn trọng lẫn nhau trong mọi giao dịch.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="stats-section py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-6 col-md-3">
                <div class="stat-item" data-aos="fade-up" data-aos-delay="100">
                    <p class="stat-number" data-count="10">10+</p>
                    <p class="stat-label mb-0">Năm kinh nghiệm</p>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-item" data-aos="fade-up" data-aos-delay="200">
                    <p class="stat-number" data-count="50">50+</p>
                    <p class="stat-label mb-0">Mẫu mũ độc quyền</p>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-item" data-aos="fade-up" data-aos-delay="300">
                    <p class="stat-number" data-count="5">5+</p>
                    <p class="stat-label mb-0">Cửa hàng toàn quốc</p>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-item" data-aos="fade-up" data-aos-delay="400">
                    <p class="stat-number" data-count="10000">10K+</p>
                    <p class="stat-label mb-0">Khách hàng hài lòng</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Brand Showcase -->
<div class="brand-showcase py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="display-6 fw-bold brand-title">
                Đối Tác Danh Tiếng
            </h2>
            <p class="lead text-muted mt-3">Cùng hợp tác với những thương hiệu hàng đầu thế giới</p>
        </div>

        <div class="row g-4 justify-content-center">
            <div class="col-6 col-md-4 col-lg-2" data-aos="fade-up" data-aos-delay="100">
                <div class="brand-card">
                    <img src="webroot/image/brand/gucci.jpg" alt="Gucci" class="img-fluid">
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-2" data-aos="fade-up" data-aos-delay="200">
                <div class="brand-card">
                    <img src="webroot/image/brand/adidas.jpg" alt="Adidas" class="img-fluid">
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-2" data-aos="fade-up" data-aos-delay="300">
                <div class="brand-card">
                    <img src="webroot/image/brand/nike.jpg" alt="Nike" class="img-fluid">
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-2" data-aos="fade-up" data-aos-delay="400">
                <div class="brand-card">
                    <img src="webroot/image/brand/varsace.jpg" alt="Versace" class="img-fluid">
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-2" data-aos="fade-up" data-aos-delay="500">
                <div class="brand-card">
                    <img src="webroot/image/brand/louisvuitton.jpg" alt="Louis Vuitton" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
</div>

<!-- CTA Section -->
<section class="py-5" style="background: linear-gradient(135deg, #ffc107 0%, #fd7e14 100%);">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 text-lg-start text-center mb-4 mb-lg-0" data-aos="fade-right">
                <h2 class="display-6 fw-bold text-white mb-2">Sẵn sàng trải nghiệm sản phẩm của chúng tôi?</h2>
                <p class="lead text-white opacity-90 mb-0">Khám phá bộ sưu tập mũ cao cấp mới nhất ngay hôm nay</p>
            </div>
            <div class="col-lg-4 text-lg-end text-center" data-aos="fade-left">
                <a href="?view=products" class="btn btn-light btn-lg px-4 py-3 fw-semibold">
                    <i class="fas fa-shopping-cart me-2"></i> Mua sắm ngay
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script>
    // Initialize AOS
    AOS.init({
        duration: 800,
        easing: 'ease-in-out',
        once: true
    });

    // Counter animation
    const countElements = document.querySelectorAll('.stat-number');

    const startCounters = () => {
        countElements.forEach(counter => {
            const target = parseInt(counter.getAttribute('data-count'));
            const text = counter.textContent;
            const suffix = text.replace(/[0-9]+/, '');
            let count = 0;
            const increment = Math.ceil(target / 50);

            const updateCounter = () => {
                if (count < target) {
                    count += increment;
                    if (count > target) count = target;
                    counter.textContent = count + suffix;
                    setTimeout(updateCounter, 30);
                }
            };

            updateCounter();
        });
    };

    // Start counters when elements come into view
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                startCounters();
                observer.disconnect();
            }
        });
    });

    if (countElements.length > 0) {
        observer.observe(document.querySelector('.stats-section'));
    }
</script>
</body>
</html>