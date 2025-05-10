<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.html");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Announcement - Member Management System</title>
    <link rel="stylesheet" href="about-style.css" />
    <style>
        /* Center main content area */
        .main-content {
            max-width: 1200px;    /* Increased from 1000px to allow a bigger slider */
            margin: 0 auto;
            padding: 20px;
            box-sizing: border-box;
        }

        .announcement-section {
            margin-top: 40px;
            text-align: center;
        }
        .announcement-section h2 {
            color: #800000;
            font-weight: 700;
            margin-bottom: 24px;
            letter-spacing: 1px;
        }

        /* Slider container fills main-content width, centered */
        .slider-container {
            position: relative;
            width: 100%;           /* Fill main-content width */
            max-width: 1150px;     /* Increased from 950px */
            height: 400px;
            margin: 0 auto;
            overflow: hidden;
            background: #fff;
            border-radius: 22px;
            box-shadow: 0 4px 32px rgba(0,0,0,0.13);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .slider {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .slider img.slide {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: none;
            border-radius: 18px;
            background: #fff;
        }
        .slider img.slide.active {
            display: block;
        }

        /* Navigation arrows */
        .slider-container button.prev,
        .slider-container button.next {
            cursor: pointer;
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 48px;
            height: 48px;
            color: #800000;
            background-color: rgba(255,255,255,0.95);
            border: none;
            border-radius: 50%;
            font-size: 28px;
            user-select: none;
            transition: background-color 0.3s;
            z-index: 10;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .slider-container button.prev:hover,
        .slider-container button.next:hover {
            background-color: #800000;
            color: #fff;
        }
        .slider-container button.prev {
            left: 18px;
        }
        .slider-container button.next {
            right: 18px;
        }

        /* Dots */
        .dots {
            position: absolute;
            bottom: 18px;
            left: 0;
            width: 100%;
            text-align: center;
            z-index: 11;
        }
        .dots .dot {
            cursor: pointer;
            height: 14px;
            width: 14px;
            margin: 0 6px;
            background-color: #bbb;
            border-radius: 50%;
            display: inline-block;
            transition: background-color 0.3s;
        }
        .dots .dot.active,
        .dots .dot:hover {
            background-color: #800000;
        }

        /* Responsive */
        @media (max-width: 1200px) {
            .main-content {
                max-width: 100vw;
            }
            .slider-container {
                max-width: 98vw;
                height: 260px;
                border-radius: 14px;
            }
            .slider img.slide {
                border-radius: 14px;
            }
        }
        @media (max-width: 700px) {
            .main-content {
                padding: 10px;
            }
            .slider-container {
                width: 100%;
                max-width: 100vw;
                height: 160px;
                border-radius: 8px;
            }
            .slider img.slide {
                border-radius: 8px;
            }
            .slider-container button.prev,
            .slider-container button.next {
                width: 32px;
                height: 32px;
                font-size: 18px;
            }
            .dots .dot {
                height: 10px;
                width: 10px;
                margin: 0 3px;
            }
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <ul>
            <li><a href="homepage.php">Registered Members</a></li>
            <li><a href="add_member.php">Add Member</a></li>
            <li class="active"><a href="announcement.php">Announcement</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>

    <div class="topbar">
        ANNOUNCEMENTS
    </div>

    <div class="page-wrapper">
        <div class="main-content">
            <div class="announcement-section">
                <h2>Latest Announcements</h2>
                <div class="slider-container">
                    <div class="slider">
                        <img src="SLIDER1.jpg" alt="Announcement 1" class="slide active" />
                        <img src="SLIDER2.jpg" alt="Announcement 2" class="slide" />
                        <img src="SLIDER3.jpg" alt="Announcement 3" class="slide" />
                        <img src="SLIDER4.jpg" alt="Announcement 4" class="slide" />
                        <img src="SLIDER5.jpg" alt="Announcement 5" class="slide" />
                    </div>
                    <button class="prev">&#10094;</button>
                    <button class="next">&#10095;</button>
                    <div class="dots">
                        <span class="dot active" data-slide="0"></span>
                        <span class="dot" data-slide="1"></span>
                        <span class="dot" data-slide="2"></span>
                        <span class="dot" data-slide="3"></span>
                        <span class="dot" data-slide="4"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        (function() {
            const slides = document.querySelectorAll('.slider img.slide');
            const prevBtn = document.querySelector('.slider-container .prev');
            const nextBtn = document.querySelector('.slider-container .next');
            const dots = document.querySelectorAll('.dots .dot');
            let currentIndex = 0;
            let slideInterval = null;
            const slideDuration = 5000; // 5 seconds

            function showSlide(index) {
                if (index < 0) index = slides.length - 1;
                if (index >= slides.length) index = 0;
                slides.forEach((slide, i) => slide.classList.toggle('active', i === index));
                dots.forEach((dot, i) => dot.classList.toggle('active', i === index));
                currentIndex = index;
            }

            function nextSlide() {
                showSlide(currentIndex + 1);
            }

            function prevSlide() {
                showSlide(currentIndex - 1);
            }

            function startSlideShow() {
                slideInterval = setInterval(nextSlide, slideDuration);
            }

            function stopSlideShow() {
                clearInterval(slideInterval);
            }

            nextBtn.addEventListener('click', () => {
                nextSlide();
                stopSlideShow();
                startSlideShow();
            });

            prevBtn.addEventListener('click', () => {
                prevSlide();
                stopSlideShow();
                startSlideShow();
            });

            dots.forEach(dot => {
                dot.addEventListener('click', () => {
                    const index = parseInt(dot.getAttribute('data-slide'));
                    showSlide(index);
                    stopSlideShow();
                    startSlideShow();
                });
            });

            showSlide(currentIndex);
            startSlideShow();
        })();
    </script>
</body>
</html>
