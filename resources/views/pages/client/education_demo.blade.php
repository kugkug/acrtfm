@include('partials.auth.header')

<!-- Link the education CSS file -->
<link href="{{ asset('assets/acrtfm/css/education.css') }}" rel="stylesheet">

<section class="container-fluid px-5">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">
                        <i class="fa fa-graduation-cap"></i>
                        Education Demo - Zoom Animation & Video Popup
                    </h3>
                    <p class="text-muted">Click on any image below to see the zoom animation and video popup with autoplay and share functionality.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
            <div class="education-image" 
                 data-video-src="https://sample-videos.com/zip/10/mp4/SampleVideo_1280x720_1mb.mp4"
                 data-video-title="Introduction to Web Development"
                 data-video-description="Learn the basics of HTML, CSS, and JavaScript for web development. This comprehensive course covers everything you need to know to start building websites.">
                <img src="https://via.placeholder.com/400x250/667eea/ffffff?text=Web+Development" alt="Web Development" class="img-fluid">
                <div class="image-overlay">
                    <i class="fa fa-play-circle"></i>
                </div>
            </div>
            <div class="mt-2">
                <h6 class="mb-1">Introduction to Web Development</h6>
                <p class="text-muted small mb-0">Learn HTML, CSS, and JavaScript basics</p>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
            <div class="education-image" 
                 data-video-src="https://sample-videos.com/zip/10/mp4/SampleVideo_1280x720_2mb.mp4"
                 data-video-title="Advanced JavaScript Concepts"
                 data-video-description="Master advanced JavaScript concepts including closures, promises, async/await, and modern ES6+ features. Perfect for experienced developers.">
                <img src="https://via.placeholder.com/400x250/764ba2/ffffff?text=JavaScript" alt="JavaScript" class="img-fluid">
                <div class="image-overlay">
                    <i class="fa fa-play-circle"></i>
                </div>
            </div>
            <div class="mt-2">
                <h6 class="mb-1">Advanced JavaScript Concepts</h6>
                <p class="text-muted small mb-0">Master closures, promises, and ES6+ features</p>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
            <div class="education-image" 
                 data-video-src="https://sample-videos.com/zip/10/mp4/SampleVideo_1280x720_5mb.mp4"
                 data-video-title="React.js Fundamentals"
                 data-video-description="Get started with React.js! Learn about components, state management, props, and building interactive user interfaces with this powerful library.">
                <img src="https://via.placeholder.com/400x250/667eea/ffffff?text=React.js" alt="React.js" class="img-fluid">
                <div class="image-overlay">
                    <i class="fa fa-play-circle"></i>
                </div>
            </div>
            <div class="mt-2">
                <h6 class="mb-1">React.js Fundamentals</h6>
                <p class="text-muted small mb-0">Learn components, state, and props</p>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
            <div class="education-image" 
                 data-video-src="https://sample-videos.com/zip/10/mp4/SampleVideo_1280x720_1mb.mp4"
                 data-video-title="Node.js Backend Development"
                 data-video-description="Build robust backend applications with Node.js. Learn about Express.js, REST APIs, database integration, and server-side development.">
                <img src="https://via.placeholder.com/400x250/764ba2/ffffff?text=Node.js" alt="Node.js" class="img-fluid">
                <div class="image-overlay">
                    <i class="fa fa-play-circle"></i>
                </div>
            </div>
            <div class="mt-2">
                <h6 class="mb-1">Node.js Backend Development</h6>
                <p class="text-muted small mb-0">Build REST APIs and server applications</p>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
            <div class="education-image" 
                 data-video-src="https://sample-videos.com/zip/10/mp4/SampleVideo_1280x720_2mb.mp4"
                 data-video-title="Database Design Principles"
                 data-video-description="Learn the fundamentals of database design, normalization, SQL queries, and best practices for creating efficient and scalable databases.">
                <img src="https://via.placeholder.com/400x250/667eea/ffffff?text=Database" alt="Database" class="img-fluid">
                <div class="image-overlay">
                    <i class="fa fa-play-circle"></i>
                </div>
            </div>
            <div class="mt-2">
                <h6 class="mb-1">Database Design Principles</h6>
                <p class="text-muted small mb-0">Learn normalization and SQL best practices</p>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
            <div class="education-image" 
                 data-video-src="https://sample-videos.com/zip/10/mp4/SampleVideo_1280x720_5mb.mp4"
                 data-video-title="DevOps and CI/CD"
                 data-video-description="Master DevOps practices including continuous integration, continuous deployment, Docker containers, and cloud deployment strategies.">
                <img src="https://via.placeholder.com/400x250/764ba2/ffffff?text=DevOps" alt="DevOps" class="img-fluid">
                <div class="image-overlay">
                    <i class="fa fa-play-circle"></i>
                </div>
            </div>
            <div class="mt-2">
                <h6 class="mb-1">DevOps and CI/CD</h6>
                <p class="text-muted small mb-0">Learn Docker, CI/CD, and cloud deployment</p>
            </div>
        </div>
    </div>
</section>

<!-- Video Popup Overlay -->
<div class="video-popup-overlay" id="videoPopupOverlay">
    <div class="video-popup-container">
        <button class="video-close-btn" id="videoCloseBtn">
            <i class="fa fa-times"></i>
        </button>
        
        <div class="video-player" id="videoPlayer">
            <div class="video-loading">
                <i class="fa fa-spinner"></i>
                <span>Loading video...</span>
            </div>
        </div>
        
        <div class="video-controls">
            <div class="video-title" id="videoTitle"></div>
            <div class="video-description" id="videoDescription"></div>
            <button class="share-button" id="shareButton">
                <i class="fa fa-share"></i>
                Share Video
            </button>
        </div>
    </div>
</div>

@include('partials.auth.footer')

<script src="{{ asset('assets/acrtfm/js/modules/education.js') }}"></script> 