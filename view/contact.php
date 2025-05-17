<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beehat - Liên Hệ</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <!-- Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&family=Poppins:wght@400;500;600;700&display=swap">
    <style>
        :root {
            --primary-color: #ffc107;
            --secondary: #1e3799;
            --light: #FFFFFF;
            --dark: #343a40;
            --success: #28a745;
            --hover: #e74819;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f9f9f9;
            color: #444;
            line-height: 1.7;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            color: #333;
        }

        .breadcrumbs {
            background-color: var(--light);
            padding: 15px 0;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }

        .breadcrumbs .bread {
            margin: 0;
            font-size: 14px;
        }

        .breadcrumbs a {
            color: var(--primary);
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .breadcrumbs a:hover {
            color: var(--hover);
        }

        #colorlib-contact {
            padding: 60px 0;
        }

        .section-title {
            position: relative;
            margin-bottom: 40px;
            padding-bottom: 15px;
        }

        .section-title:after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            height: 3px;
            width: 60px;
            background-color: var(--primary);
        }

        .contact-info-wrap {
            margin-bottom: 40px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            padding: 20px;
        }

        .info-item {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            transition: all 0.3s ease;
        }

        .info-item:hover {
            transform: translateY(-3px);
        }

        .info-icon {
            width: 50px;
            height: 50px;
            background-color: var(--primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            color: white;
            font-size: 18px;
            transition: all 0.3s ease;
        }

        .info-item:hover .info-icon {
            background-color: var(--secondary);
        }

        .info-content h5 {
            margin-bottom: 5px;
            font-size: 16px;
            font-weight: 600;
        }

        .info-content p, .info-content a {
            margin: 0;
            color: #666;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .info-content a:hover {
            color: var(--primary);
        }

        .contact-wrap {
            background-color: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            height: 100%;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-control {
            height: auto;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.2rem rgba(241, 89, 43, 0.25);
        }

        label {
            font-weight: 500;
            margin-bottom: 8px;
            display: block;
            color: #555;
        }

        .btn-primary {
            background-color: var(--primary);
            border-color: var(--primary);
            padding: 12px 30px;
            font-weight: 500;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: var(--hover);
            border-color: var(--hover);
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(241, 89, 43, 0.3);
        }

        .map-container {
            height: 100%;
            min-height: 450px;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        #map {
            height: 100%;
            width: 100%;
        }

        .alert {
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .alert-success {
            background-color: #d4edda;
            border-color: #c3e6cb;
            color: #155724;
        }

        .alert-danger {
            background-color: #f8d7da;
            border-color: #f5c6cb;
            color: #721c24;
        }

        @media (max-width: 767px) {
            .contact-wrap {
                margin-bottom: 30px;
                padding: 25px;
            }

            .map-container {
                min-height: 300px;
            }
        }
    </style>
</head>
<body>


<!-- Breadcrumbs -->


<!-- Contact Section -->
<div id="colorlib-contact">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mx-auto text-center mb-5">
                <h2 class="section-title text-center" style="padding-bottom: 15px; display: inline-block;">Liên Hệ Với Chúng Tôi</h2>
                <p>Hãy liên hệ với chúng tôi nếu bạn có bất kỳ câu hỏi nào. Đội ngũ hỗ trợ của chúng tôi sẽ phản hồi bạn sớm nhất có thể.</p>
            </div>
        </div>

        <!-- Contact Info -->
        <div class="row">
            <div class="col-12">
                <div class="contact-info-wrap">
                    <div class="row g-4">
                        <div class="col-md-3 col-sm-6">
                            <div class="info-item">
                                <div class="info-icon">
                                    <i class="fas fa-location-dot"></i>
                                </div>
                                <div class="info-content">
                                    <h5>Địa Chỉ</h5>
                                    <p>Cầu Diễn, Từ Liêm, Hà Nội</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="info-item">
                                <div class="info-icon">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <div class="info-content">
                                    <h5>Điện Thoại</h5>
                                    <p><a href="tel://0832091111">(+84) 832 091 111</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="info-item">
                                <div class="info-icon">
                                    <i class="fas fa-paper-plane"></i>
                                </div>
                                <div class="info-content">
                                    <h5>Email</h5>
                                    <p><a href="mailto:2409boonie@gmail.com">2409boonie@gmail.com</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="info-item">
                                <div class="info-icon">
                                    <i class="fas fa-globe"></i>
                                </div>
                                <div class="info-content">
                                    <h5>Website</h5>
                                    <p><a href="https://beehat.com" target="_blank">beehat.com</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Form and Map -->
        <div class="row g-4 mt-2">
            <div class="col-lg-6">
                <div class="contact-wrap">
                    <h3 class="mb-4">Gửi Tin Nhắn</h3>

                    <?php if (isset($message)) { ?>
                        <div class="alert <?php echo $alertClass; ?>" role="alert">
                            <?php echo $message; ?>
                        </div>
                    <?php } ?>

                    <form action="" method="post" class="contact-form">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="fname">Họ</label>
                                    <input type="text" id="fname" name="fname" class="form-control" placeholder="Nhập họ của bạn" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lname">Tên</label>
                                    <input type="text" id="lname" name="lname" class="form-control" placeholder="Nhập tên của bạn" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" id="email" name="email" class="form-control" placeholder="example@domain.com" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="subject">Tiêu đề</label>
                                    <input type="text" id="subject" name="subject" class="form-control" placeholder="Tiêu đề tin nhắn" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="message">Nội dung</label>
                                    <textarea name="message" id="message" cols="30" rows="7" class="form-control"
                                        placeholder="Nội dung tin nhắn" required></textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-paper-plane me-2"></i>Gửi tin nhắn
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="map-container">
                    <iframe id="map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d29793.660581681276!2d105.75356037431638!3d21.037326299999997!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ab16cf2039a3%3A0xb1c4bccd151c5c3c!2zQ-G6p3UgRGnhu4VuLCBU4burIExpw6ptLCBIw6AgTuG7mWksIFZp4buHdCBOYW0!5e0!3m2!1svi!2s!4v1715769551944!5m2!1svi!2s" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer CTA Section -->
<div class="container-fluid py-5 bg-light mt-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto text-center">
                <h3 class="mb-4">Bạn muốn nhận thông báo từ chúng tôi?</h3>
                <p class="mb-4">Đăng ký để nhận thông báo về các sản phẩm mới và ưu đãi đặc biệt.</p>
                <div class="input-group mb-3 w-75 mx-auto">
                    <input type="email" class="form-control" placeholder="Email của bạn" aria-label="Email của bạn">
                    <button class="btn btn-primary" type="button">Đăng ký</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap and other scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script>
    // Form validation
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('.contact-form');

        if (form) {
            const inputs = form.querySelectorAll('input, textarea');

            inputs.forEach(input => {
                // Add animation effect on focus
                input.addEventListener('focus', function() {
                    this.parentElement.classList.add('focused');
                });

                input.addEventListener('blur', function() {
                    this.parentElement.classList.remove('focused');

                    // Simple validation on blur
                    if (this.value.trim() === '') {
                        this.classList.add('is-invalid');
                    } else {
                        this.classList.remove('is-invalid');
                        this.classList.add('is-valid');
                    }
                });
            });

            // Alert auto-close
            const alerts = document.querySelectorAll('.alert');
            if (alerts.length > 0) {
                setTimeout(() => {
                    alerts.forEach(alert => {
                        alert.classList.add('fade');
                        setTimeout(() => {
                            alert.style.display = 'none';
                        }, 500);
                    });
                }, 5000);
            }
        }
    });
</script>
</body>
</html>