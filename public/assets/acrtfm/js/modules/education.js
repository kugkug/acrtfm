$(document).ready(function () {
    _fetch({
        search_type: "",
        search_text: "",
    });

    $("select[data-key='search_type']").change(function () {
        var search_type = $(this).val();
        if (search_type == "") {
            $("[class*='search-container-']")
                .removeClass("d-none")
                .addClass("d-none");
            return;
        }

        $("[class*='search-container-']")
            .removeClass("d-none")
            .addClass("d-none");
        $(".search-container-" + search_type).removeClass("d-none");
    });

    $(".search-select").on("change", function () {
        let search_type = $("select[data-key='search_type']").val();
        _fetch({
            search_type: search_type,
            search_text: $(".search-container-" + search_type).val(),
        });
    });

    $(".search-text").on("keyup", function () {
        let search_type = $("select[data-key='search_type']").val();
        _fetch({
            search_type: search_type,
            search_text: $(
                ".search-container-" + search_type + " .search-text"
            ).val(),
        });
    });

    // Initialize video popup functionality
    _init_video_popup();
});

function _fetch(formData) {
    ajaxRequest("executor/education/search", formData, "sub-loader");
}

function _init_actions() {
    $(".btn-paylist").off();
    $(".btn-paylist").on("click", function () {
        let watch_link = $(this).data("src");
        console.log(watch_link);
    });

    // Initialize image click handlers for zoom animation
    _init_image_zoom_handlers();
}

function _init_image_zoom_handlers() {
    // Remove existing handlers to prevent duplicates
    $(document).off("click", ".education-image");

    // Add click handlers for education images
    $(document).on("click", ".education-image", function (e) {
        e.preventDefault();

        // Add click animation
        $(this).addClass("image-click-animation");
        setTimeout(() => {
            $(this).removeClass("image-click-animation");
        }, 300);

        // Get video data from the clicked element
        let videoData = {
            src: $(this).data("video-src") || $(this).find("img").attr("src"),
            title: $(this).data("video-title") || "Education Video",
            description:
                $(this).data("video-description") || "Educational content",
            thumbnail: $(this).find("img").attr("src"),
        };

        // Open video popup
        _open_video_popup(videoData);
    });
}

function _init_video_popup() {
    // Close button functionality
    $("#videoCloseBtn").on("click", function () {
        _close_video_popup();
    });

    // Close on overlay click
    $("#videoPopupOverlay").on("click", function (e) {
        if (e.target === this) {
            _close_video_popup();
        }
    });

    // Close on escape key
    $(document).on("keydown", function (e) {
        if (e.key === "Escape") {
            _close_video_popup();
        }
    });

    // Share button functionality
    $("#shareButton").on("click", function () {
        _share_video();
    });
}

function _open_video_popup(videoData) {
    // Set video title and description
    $("#videoTitle").text(videoData.title);
    $("#videoDescription").text(videoData.description);

    // Show loading state
    $("#videoPlayer").html(`
        <div class="video-loading">
            <i class="fa fa-spinner"></i>
            <span>Loading video...</span>
        </div>
    `);

    // Show popup overlay
    $("#videoPopupOverlay").addClass("active");

    // Create video element with autoplay
    setTimeout(() => {
        let videoElement = `
            <video 
                controls 
                autoplay 
                muted
                preload="metadata"
                style="width: 100%; height: 100%; object-fit: contain;"
            >
                <source src="${videoData.src}" type="video/mp4">
                <source src="${videoData.src}" type="video/webm">
                <source src="${videoData.src}" type="video/ogg">
                Your browser does not support the video tag.
            </video>
        `;

        $("#videoPlayer").html(videoElement);

        // Handle video events
        let video = $("#videoPlayer video")[0];
        if (video) {
            video.addEventListener("loadeddata", function () {
                // Video loaded successfully
                console.log("Video loaded and ready to play");
            });

            video.addEventListener("error", function () {
                // Handle video loading error
                $("#videoPlayer").html(`
                    <div class="video-loading">
                        <i class="fa fa-exclamation-triangle"></i>
                        <span>Error loading video. Please try again.</span>
                    </div>
                `);
            });
        }
    }, 500);
}

function _close_video_popup() {
    // Pause video if playing
    let video = $("#videoPlayer video")[0];
    if (video) {
        video.pause();
    }

    // Hide popup overlay
    $("#videoPopupOverlay").removeClass("active");

    // Clear video player after animation
    setTimeout(() => {
        $("#videoPlayer").html(`
            <div class="video-loading">
                <i class="fa fa-spinner"></i>
                <span>Loading video...</span>
            </div>
        `);
    }, 300);
}

function _share_video() {
    let videoTitle = $("#videoTitle").text();
    let videoUrl = window.location.href;

    // Check if Web Share API is available
    if (navigator.share) {
        navigator
            .share({
                title: videoTitle,
                text: "Check out this educational video!",
                url: videoUrl,
            })
            .then(() => {
                console.log("Shared successfully");
            })
            .catch((error) => {
                console.log("Error sharing:", error);
                _fallback_share(videoTitle, videoUrl);
            });
    } else {
        // Fallback for browsers that don't support Web Share API
        _fallback_share(videoTitle, videoUrl);
    }
}

function _fallback_share(title, url) {
    // Create share URL for different platforms
    let shareText = encodeURIComponent(
        `Check out this educational video: ${title}`
    );
    let shareUrl = encodeURIComponent(url);

    // Create share options
    let shareOptions = `
        <div class="share-options" style="
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            z-index: 10000;
        ">
            <h5>Share Video</h5>
            <div style="margin: 15px 0;">
                <a href="https://www.facebook.com/sharer/sharer.php?u=${shareUrl}" 
                   target="_blank" class="btn btn-primary btn-sm" style="margin: 5px;">
                    <i class="fa fa-facebook"></i> Facebook
                </a>
                <a href="https://twitter.com/intent/tweet?text=${shareText}&url=${shareUrl}" 
                   target="_blank" class="btn btn-info btn-sm" style="margin: 5px;">
                    <i class="fa fa-twitter"></i> Twitter
                </a>
                <a href="https://www.linkedin.com/sharing/share-offsite/?url=${shareUrl}" 
                   target="_blank" class="btn btn-secondary btn-sm" style="margin: 5px;">
                    <i class="fa fa-linkedin"></i> LinkedIn
                </a>
            </div>
            <button class="btn btn-outline-secondary btn-sm" onclick="this.parentElement.remove()">
                Close
            </button>
        </div>
    `;

    // Remove any existing share options
    $(".share-options").remove();

    // Add share options to page
    $("body").append(shareOptions);
}

// Function to format education results with zoom animation support
function _format_education_results(data) {
    let html = "";

    if (data && data.length > 0) {
        html = '<div class="row">';

        data.forEach(function (item) {
            // Generate a sample video URL (you'll need to replace this with actual video URLs from your database)
            let videoUrl =
                item.video_url ||
                "https://sample-videos.com/zip/10/mp4/SampleVideo_1280x720_1mb.mp4";
            let thumbnailUrl =
                item.thumbnail ||
                item.image ||
                "https://via.placeholder.com/300x200/667eea/ffffff?text=Education+Video";
            let title = item.title || item.name || "Educational Content";
            let description =
                item.description ||
                item.category ||
                "Educational video content";

            html += `
                <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                    <div class="education-image" 
                         data-video-src="${videoUrl}"
                         data-video-title="${title}"
                         data-video-description="${description}">
                        <img src="${thumbnailUrl}" alt="${title}" class="img-fluid">
                        <div class="image-overlay" style="
                            position: absolute;
                            top: 0;
                            left: 0;
                            right: 0;
                            bottom: 0;
                            background: rgba(0,0,0,0.5);
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            opacity: 0;
                            transition: opacity 0.3s ease;
                        ">
                            <i class="fa fa-play-circle" style="
                                font-size: 48px;
                                color: white;
                                text-shadow: 0 2px 4px rgba(0,0,0,0.5);
                            "></i>
                        </div>
                    </div>
                    <div class="mt-2">
                        <h6 class="mb-1">${title}</h6>
                        <p class="text-muted small mb-0">${description}</p>
                    </div>
                </div>
            `;
        });

        html += "</div>";
    } else {
        html = `
            <div class="col-12">
                <div class="text-center py-5">
                    <i class="fa fa-search fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">No educational content found</h5>
                    <p class="text-muted">Try adjusting your search criteria</p>
                </div>
            </div>
        `;
    }

    return html;
}

// Override the existing _init_actions function to include our new functionality
function _init_actions() {
    $(".btn-paylist").off();
    $(".btn-paylist").on("click", function () {
        let watch_link = $(this).data("src");
        console.log(watch_link);
    });

    // Initialize image zoom handlers
    _init_image_zoom_handlers();
}
