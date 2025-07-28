$(document).ready(function () {
    // Initialize playlist functionality
    initPlaylistFeatures();

    // Sample playlist data (in real app, this would come from API)
    const samplePlaylists = [
        {
            id: 1,
            title: "Complete Laravel Tutorial Series",
            description:
                "Learn Laravel from basics to advanced concepts with practical examples.",
            category: "tutorials",
            author: "John Doe",
            views: "1.2K",
            date: "2 days ago",
            videoCount: 12,
            duration: "2h 15m",
            thumbnail: "https://img.youtube.com/vi/dQw4w9WgXcQ/hqdefault.jpg",
            videos: [
                {
                    id: 1,
                    title: "Laravel Basics",
                    url: "https://www.youtube.com/embed/dQw4w9WgXcQ",
                    duration: "15:30",
                },
                {
                    id: 2,
                    title: "Database Migrations",
                    url: "https://www.youtube.com/embed/9bZkp7q19f0",
                    duration: "22:45",
                },
                {
                    id: 3,
                    title: "Authentication",
                    url: "https://www.youtube.com/embed/jNQXAC9IVRw",
                    duration: "18:20",
                },
            ],
        },
        {
            id: 2,
            title: "Product Review Series 2024",
            description:
                "In-depth reviews of the latest tech products and gadgets.",
            category: "reviews",
            author: "Tech Reviewer",
            views: "3.5K",
            date: "1 week ago",
            videoCount: 8,
            duration: "1h 45m",
            thumbnail: "https://img.youtube.com/vi/9bZkp7q19f0/hqdefault.jpg",
            videos: [
                {
                    id: 4,
                    title: "iPhone 15 Pro Review",
                    url: "https://www.youtube.com/embed/9bZkp7q19f0",
                    duration: "12:15",
                },
                {
                    id: 5,
                    title: "MacBook Air M2",
                    url: "https://www.youtube.com/embed/jNQXAC9IVRw",
                    duration: "18:30",
                },
            ],
        },
        {
            id: 3,
            title: "Web Development Masterclass",
            description:
                "Complete guide to modern web development with HTML, CSS, and JavaScript.",
            category: "guides",
            author: "Web Dev Pro",
            views: "5.8K",
            date: "3 days ago",
            videoCount: 15,
            duration: "3h 30m",
            thumbnail: "https://img.youtube.com/vi/jNQXAC9IVRw/hqdefault.jpg",
            videos: [
                {
                    id: 6,
                    title: "HTML Fundamentals",
                    url: "https://www.youtube.com/embed/dQw4w9WgXcQ",
                    duration: "25:10",
                },
                {
                    id: 7,
                    title: "CSS Grid Layout",
                    url: "https://www.youtube.com/embed/9bZkp7q19f0",
                    duration: "32:45",
                },
                {
                    id: 8,
                    title: "JavaScript ES6+",
                    url: "https://www.youtube.com/embed/jNQXAC9IVRw",
                    duration: "28:20",
                },
            ],
        },
    ];

    // Store current playlist data
    window.currentPlaylists = samplePlaylists;
    window.currentPlaylist = null;
    window.currentVideoIndex = 0;

    function initPlaylistFeatures() {
        // Search functionality
        $("#playlist-search").on("keyup", function () {
            const searchTerm = $(this).val().toLowerCase();
            filterPlaylists(searchTerm);
        });

        // Filter dropdown
        $("#playlist-filter").on("change", function () {
            const filterValue = $(this).val();
            filterPlaylistsByType(filterValue);
        });

        // Category buttons
        $(".category-btn").on("click", function () {
            $(".category-btn").removeClass("active");
            $(this).addClass("active");

            const category = $(this).data("category");
            filterPlaylistsByCategory(category);
        });

        // Play playlist button
        $(document).on("click", ".play-playlist-btn", function () {
            const playlistId = $(this).data("playlist-id");
            openPlaylistModal(playlistId);
        });

        // Load more button
        $("#load-more-playlists").on("click", function () {
            loadMorePlaylists();
        });

        // Playlist actions
        $(document).on("click", ".playlist-actions .btn", function () {
            const action = $(this).find("i").attr("class");
            const playlistCard = $(this).closest(".playlist-card");

            if (action.includes("fa-heart")) {
                toggleFavorite(playlistCard);
            } else if (action.includes("fa-share")) {
                sharePlaylist(playlistCard);
            } else if (action.includes("fa-info-circle")) {
                showVideoDetails(playlistCard);
            }
        });

        // Modal close events
        $("#playlistModal").on("hidden.bs.modal", function () {
            $("#playlistVideoPlayer").attr("src", "");
            window.currentPlaylist = null;
            window.currentVideoIndex = 0;
        });
    }

    function filterPlaylists(searchTerm) {
        $(".playlist-item").each(function () {
            const title = $(this).find(".playlist-title").text().toLowerCase();
            const description = $(this)
                .find(".playlist-description")
                .text()
                .toLowerCase();
            const author = $(this).find(".author").text().toLowerCase();

            if (
                title.includes(searchTerm) ||
                description.includes(searchTerm) ||
                author.includes(searchTerm)
            ) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    }

    function filterPlaylistsByType(filterType) {
        if (!filterType) {
            $(".playlist-item").show();
            return;
        }

        // In a real app, this would filter based on the selected type
        // For now, we'll just show a toast message
        showToast(`Filtering by: ${filterType}`, "info");
    }

    function filterPlaylistsByCategory(category) {
        if (category === "all") {
            $(".playlist-item").show();
            return;
        }

        $(".playlist-item").each(function () {
            const itemCategory = $(this).data("category");
            if (itemCategory === category) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    }

    function openPlaylistModal(playlistId) {
        const playlist = window.currentPlaylists.find(
            (p) => p.id == playlistId
        );
        if (!playlist) {
            showToast("Playlist not found", "error");
            return;
        }

        window.currentPlaylist = playlist;
        window.currentVideoIndex = 0;

        // Update modal title
        $("#playlistModalTitle").text(playlist.title);

        // Load first video
        if (playlist.videos.length > 0) {
            loadVideo(playlist.videos[0]);
        }

        // Load video list
        loadVideoList(playlist.videos);

        // Show modal
        $("#playlistModal").modal("show");
    }

    function loadVideo(video) {
        $("#playlistVideoPlayer").attr("src", video.url);

        // Update active video in list
        $(".video-item").removeClass("active");
        $(`.video-item[data-video-id="${video.id}"]`).addClass("active");
    }

    function loadVideoList(videos) {
        const videoList = $("#playlistVideoList");
        videoList.empty();

        videos.forEach((video, index) => {
            const videoItem = `
                <div class="video-item ${
                    index === 0 ? "active" : ""
                }" data-video-id="${video.id}">
                    <div class="video-thumbnail">
                        <img src="https://img.youtube.com/vi/${getYouTubeId(
                            video.url
                        )}/mqdefault.jpg" alt="${video.title}">
                        <div class="video-duration">${video.duration}</div>
                    </div>
                    <div class="video-info">
                        <h6 class="video-title">${video.title}</h6>
                        <small class="video-duration-text">${
                            video.duration
                        }</small>
                    </div>
                </div>
            `;
            videoList.append(videoItem);
        });

        // Add click handlers for video items
        $(".video-item").on("click", function () {
            const videoId = $(this).data("video-id");
            const video = window.currentPlaylist.videos.find(
                (v) => v.id == videoId
            );
            if (video) {
                loadVideo(video);
                window.currentVideoIndex =
                    window.currentPlaylist.videos.findIndex(
                        (v) => v.id == videoId
                    );
            }
        });
    }

    function getYouTubeId(url) {
        const match = url.match(
            /(?:youtube\.com\/embed\/|youtu\.be\/|youtube\.com\/watch\?v=)([^&\n?#]+)/
        );
        return match ? match[1] : "";
    }

    function toggleFavorite(playlistCard) {
        const heartBtn = playlistCard.find(".fa-heart");
        if (heartBtn.hasClass("text-danger")) {
            heartBtn.removeClass("text-danger");
            showToast("Removed from favorites", "info");
        } else {
            heartBtn.addClass("text-danger");
            showToast("Added to favorites", "success");
        }
    }

    function sharePlaylist(playlistCard) {
        const title = playlistCard.find(".playlist-title").text();
        const url = window.location.href;

        if (navigator.share) {
            navigator.share({
                title: title,
                url: url,
            });
        } else {
            // Fallback for browsers that don't support Web Share API
            navigator.clipboard.writeText(url).then(() => {
                showToast("Link copied to clipboard", "success");
            });
        }
    }

    function showVideoDetails(playlistCard) {
        const title = playlistCard.find(".playlist-title").text();
        const description = playlistCard.find(".playlist-description").text();
        const author = playlistCard.find(".author").text();
        const views = playlistCard.find(".views").text();

        $("#videoTitle").text(title);
        $("#videoDescription").text(description);
        $("#videoAuthor").text(author);
        $("#videoViews").text(views);
        $("#videoDate").text("Today");

        $("#videoDetailsModal").modal("show");
    }

    function loadMorePlaylists() {
        // Simulate loading more playlists
        const loadingBtn = $("#load-more-playlists");
        const originalText = loadingBtn.html();

        loadingBtn.html('<i class="fa fa-spinner fa-spin"></i> Loading...');
        loadingBtn.prop("disabled", true);

        setTimeout(() => {
            // Add more sample playlists
            const newPlaylist = `
                <div class="col-lg-4 col-md-6 col-sm-12 mb-4 playlist-item" data-category="news">
                    <div class="playlist-card">
                        <div class="playlist-thumbnail">
                            <img src="https://img.youtube.com/vi/dQw4w9WgXcQ/hqdefault.jpg" alt="Playlist Thumbnail" class="img-fluid">
                            <div class="playlist-overlay">
                                <div class="playlist-info">
                                    <span class="video-count"><i class="fa fa-play"></i> 6 Videos</span>
                                    <span class="duration"><i class="fa fa-clock"></i> 1h 20m</span>
                                </div>
                                <button class="btn btn-primary btn-sm play-playlist-btn" data-playlist-id="4">
                                    <i class="fa fa-play"></i> Play All
                                </button>
                            </div>
                        </div>
                        <div class="playlist-content">
                            <h5 class="playlist-title">Tech News Weekly</h5>
                            <p class="playlist-description">Latest technology news and updates from around the world.</p>
                            <div class="playlist-meta">
                                <span class="author"><i class="fa fa-user"></i> Tech News</span>
                                <span class="views"><i class="fa fa-eye"></i> 2.1K views</span>
                                <span class="date"><i class="fa fa-calendar"></i> 1 day ago</span>
                            </div>
                            <div class="playlist-actions">
                                <button class="btn btn-outline-primary btn-sm" title="Add to Favorites">
                                    <i class="fa fa-heart"></i>
                                </button>
                                <button class="btn btn-outline-secondary btn-sm" title="Share">
                                    <i class="fa fa-share"></i>
                                </button>
                                <button class="btn btn-outline-info btn-sm" title="View Details">
                                    <i class="fa fa-info-circle"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            `;

            $("#playlist-container").append(newPlaylist);

            loadingBtn.html(originalText);
            loadingBtn.prop("disabled", false);

            showToast("More playlists loaded", "success");
        }, 2000);
    }

    function showToast(message, type = "info") {
        // Use existing toastr if available, otherwise create a simple alert
        if (typeof _show_toastr !== "undefined") {
            _show_toastr(type, message, "Playlist Manager");
        } else {
            alert(message);
        }
    }

    // Keyboard navigation for playlist modal
    $(document).on("keydown", function (e) {
        if ($("#playlistModal").hasClass("show")) {
            if (e.key === "ArrowUp" || e.key === "ArrowLeft") {
                e.preventDefault();
                playPreviousVideo();
            } else if (e.key === "ArrowDown" || e.key === "ArrowRight") {
                e.preventDefault();
                playNextVideo();
            } else if (e.key === " ") {
                e.preventDefault();
                togglePlayPause();
            }
        }
    });

    function playNextVideo() {
        if (
            window.currentPlaylist &&
            window.currentVideoIndex < window.currentPlaylist.videos.length - 1
        ) {
            window.currentVideoIndex++;
            const video =
                window.currentPlaylist.videos[window.currentVideoIndex];
            loadVideo(video);
        }
    }

    function playPreviousVideo() {
        if (window.currentPlaylist && window.currentVideoIndex > 0) {
            window.currentVideoIndex--;
            const video =
                window.currentPlaylist.videos[window.currentVideoIndex];
            loadVideo(video);
        }
    }

    function togglePlayPause() {
        // This would control the video player play/pause
        // For iframe videos, this is limited by browser security
        showToast("Use video player controls", "info");
    }
});
