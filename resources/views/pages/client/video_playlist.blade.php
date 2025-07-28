@include('partials.auth.header')

<section class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">
                        <i class="fa fa-play-circle"></i>
                        Video Playlist Manager
                    </h3>
                    
                    <!-- Playlist Controls -->
                    <div class="row mb-4">
                        <div class="col-lg-8">
                            <div class="input-group">
                                <input type="text" class="form-control" id="playlist-search" placeholder="Search playlists...">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" id="btn-search-playlist">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <select class="form-control" id="playlist-filter">
                                <option value="">All Playlists</option>
                                <option value="featured">Featured</option>
                                <option value="recent">Recent</option>
                                <option value="popular">Popular</option>
                                <option value="favorites">Favorites</option>
                            </select>
                        </div>
                    </div>

                    <!-- Playlist Categories -->
                    <div class="row mb-3">
                        <div class="col-12">
                            <div class="playlist-categories">
                                <button class="btn btn-outline-primary btn-sm category-btn active" data-category="all">
                                    <i class="fa fa-th"></i> All
                                </button>
                                <button class="btn btn-outline-success btn-sm category-btn" data-category="tutorials">
                                    <i class="fa fa-graduation-cap"></i> Tutorials
                                </button>
                                <button class="btn btn-outline-info btn-sm category-btn" data-category="reviews">
                                    <i class="fa fa-star"></i> Reviews
                                </button>
                                <button class="btn btn-outline-warning btn-sm category-btn" data-category="guides">
                                    <i class="fa fa-book"></i> Guides
                                </button>
                                <button class="btn btn-outline-danger btn-sm category-btn" data-category="news">
                                    <i class="fa fa-newspaper"></i> News
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Playlist Grid -->
    <div class="row" id="playlist-container">
        <!-- Sample Playlist Items -->
        <div class="col-lg-4 col-md-6 col-sm-12 mb-4 playlist-item" data-category="tutorials">
            <div class="playlist-card">
                <div class="playlist-thumbnail">
                    <img src="https://img.youtube.com/vi/dQw4w9WgXcQ/hqdefault.jpg" alt="Playlist Thumbnail" class="img-fluid">
                    <div class="playlist-overlay">
                        <div class="playlist-info">
                            <span class="video-count"><i class="fa fa-play"></i> 12 Videos</span>
                            <span class="duration"><i class="fa fa-clock"></i> 2h 15m</span>
                        </div>
                        <button class="btn btn-primary btn-sm play-playlist-btn" data-playlist-id="1">
                            <i class="fa fa-play"></i> Play All
                        </button>
                    </div>
                </div>
                <div class="playlist-content">
                    <h5 class="playlist-title">Complete Laravel Tutorial Series</h5>
                    <p class="playlist-description">Learn Laravel from basics to advanced concepts with practical examples.</p>
                    <div class="playlist-meta">
                        <span class="author"><i class="fa fa-user"></i> John Doe</span>
                        <span class="views"><i class="fa fa-eye"></i> 1.2K views</span>
                        <span class="date"><i class="fa fa-calendar"></i> 2 days ago</span>
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

        <div class="col-lg-4 col-md-6 col-sm-12 mb-4 playlist-item" data-category="reviews">
            <div class="playlist-card">
                <div class="playlist-thumbnail">
                    <img src="https://img.youtube.com/vi/9bZkp7q19f0/hqdefault.jpg" alt="Playlist Thumbnail" class="img-fluid">
                    <div class="playlist-overlay">
                        <div class="playlist-info">
                            <span class="video-count"><i class="fa fa-play"></i> 8 Videos</span>
                            <span class="duration"><i class="fa fa-clock"></i> 1h 45m</span>
                        </div>
                        <button class="btn btn-primary btn-sm play-playlist-btn" data-playlist-id="2">
                            <i class="fa fa-play"></i> Play All
                        </button>
                    </div>
                </div>
                <div class="playlist-content">
                    <h5 class="playlist-title">Product Review Series 2024</h5>
                    <p class="playlist-description">In-depth reviews of the latest tech products and gadgets.</p>
                    <div class="playlist-meta">
                        <span class="author"><i class="fa fa-user"></i> Tech Reviewer</span>
                        <span class="views"><i class="fa fa-eye"></i> 3.5K views</span>
                        <span class="date"><i class="fa fa-calendar"></i> 1 week ago</span>
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

        <div class="col-lg-4 col-md-6 col-sm-12 mb-4 playlist-item" data-category="guides">
            <div class="playlist-card">
                <div class="playlist-thumbnail">
                    <img src="https://img.youtube.com/vi/jNQXAC9IVRw/hqdefault.jpg" alt="Playlist Thumbnail" class="img-fluid">
                    <div class="playlist-overlay">
                        <div class="playlist-info">
                            <span class="video-count"><i class="fa fa-play"></i> 15 Videos</span>
                            <span class="duration"><i class="fa fa-clock"></i> 3h 30m</span>
                        </div>
                        <button class="btn btn-primary btn-sm play-playlist-btn" data-playlist-id="3">
                            <i class="fa fa-play"></i> Play All
                        </button>
                    </div>
                </div>
                <div class="playlist-content">
                    <h5 class="playlist-title">Web Development Masterclass</h5>
                    <p class="playlist-description">Complete guide to modern web development with HTML, CSS, and JavaScript.</p>
                    <div class="playlist-meta">
                        <span class="author"><i class="fa fa-user"></i> Web Dev Pro</span>
                        <span class="views"><i class="fa fa-eye"></i> 5.8K views</span>
                        <span class="date"><i class="fa fa-calendar"></i> 3 days ago</span>
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
    </div>

    <!-- Load More Button -->
    <div class="row">
        <div class="col-12 text-center">
            <button class="btn btn-outline-primary" id="load-more-playlists">
                <i class="fa fa-plus"></i> Load More Playlists
            </button>
        </div>
    </div>
</section>

<!-- Playlist Modal -->
<div class="modal fade" id="playlistModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="playlistModalTitle">Playlist Title</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-8">
                        <!-- Video Player -->
                        <div class="video-player-container">
                            <iframe 
                                id="playlistVideoPlayer" 
                                style="width: 100%; height: 400px;"
                                src="" 
                                frameborder="0" 
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                                allowfullscreen>
                            </iframe>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <!-- Playlist Videos -->
                        <div class="playlist-videos">
                            <h6>Videos in this Playlist</h6>
                            <div class="video-list" id="playlistVideoList">
                                <!-- Video items will be loaded here -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success">
                    <i class="fa fa-share"></i> Share Playlist
                </button>
                <button type="button" class="btn btn-primary">
                    <i class="fa fa-heart"></i> Add to Favorites
                </button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fa fa-times"></i> Close
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Video Details Modal -->
<div class="modal fade" id="videoDetailsModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Video Details</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="video-details">
                    <h4 id="videoTitle">Video Title</h4>
                    <div class="video-meta">
                        <span><i class="fa fa-eye"></i> <span id="videoViews">0</span> views</span>
                        <span><i class="fa fa-calendar"></i> <span id="videoDate">Date</span></span>
                        <span><i class="fa fa-user"></i> <span id="videoAuthor">Author</span></span>
                    </div>
                    <div class="video-description" id="videoDescription">
                        Video description will be loaded here...
                    </div>
                    <div class="video-tags">
                        <span class="badge badge-primary">Tag 1</span>
                        <span class="badge badge-secondary">Tag 2</span>
                        <span class="badge badge-info">Tag 3</span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">
                    <i class="fa fa-play"></i> Play Video
                </button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fa fa-times"></i> Close
                </button>
            </div>
        </div>
    </div>
</div>

@include('partials.auth.footer')

<script src="{{ asset('assets/acrtfm/js/modules/video-playlist.js') }}"></script> 