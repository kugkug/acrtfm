# Education Zoom Animation & Video Popup

This implementation adds a beautiful zoom animation effect to education images with a video popup that includes autoplay and share functionality.

## Features

### 🎯 Zoom Animation

-   Smooth hover zoom effect on education images
-   Click animation feedback
-   Play button overlay that appears on hover
-   Responsive design for all screen sizes

### 🎥 Video Popup

-   Full-screen video popup with overlay
-   Autoplay functionality (muted for browser compatibility)
-   Video controls and error handling
-   Smooth open/close animations

### 📤 Share Functionality

-   Native Web Share API support
-   Fallback share options for unsupported browsers
-   Social media sharing (Facebook, Twitter, LinkedIn)
-   Customizable share content

## Files Created/Modified

### CSS Files

-   `public/assets/acrtfm/css/education.css` - Main styles for zoom animation and video popup

### JavaScript Files

-   `public/assets/acrtfm/js/modules/education.js` - Enhanced with zoom and video popup functionality

### Blade Templates

-   `resources/views/pages/client/education.blade.php` - Updated with video popup overlay
-   `resources/views/pages/client/education_demo.blade.php` - Demo page showcasing the functionality

## How to Use

### 1. Basic Implementation

Add the CSS link to your education page:

```html
<link href="{{ asset('assets/acrtfm/css/education.css') }}" rel="stylesheet" />
```

### 2. HTML Structure for Education Images

Use this structure for education images:

```html
<div
    class="education-image"
    data-video-src="path/to/video.mp4"
    data-video-title="Video Title"
    data-video-description="Video description"
>
    <img src="path/to/thumbnail.jpg" alt="Title" class="img-fluid" />
    <div class="image-overlay">
        <i class="fa fa-play-circle"></i>
    </div>
</div>
```

### 3. Video Popup Overlay

Include this HTML structure in your page:

```html
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
```

### 4. Data Attributes

The following data attributes are supported:

-   `data-video-src` - URL of the video file
-   `data-video-title` - Title displayed in the popup
-   `data-video-description` - Description displayed in the popup

## JavaScript Functions

### Core Functions

-   `_init_image_zoom_handlers()` - Initializes click handlers for images
-   `_init_video_popup()` - Sets up video popup functionality
-   `_open_video_popup(videoData)` - Opens video popup with data
-   `_close_video_popup()` - Closes video popup
-   `_share_video()` - Handles video sharing
-   `_format_education_results(data)` - Formats education results with proper HTML

### Video Data Object

```javascript
let videoData = {
    src: "video-url.mp4",
    title: "Video Title",
    description: "Video description",
    thumbnail: "thumbnail-url.jpg",
};
```

## CSS Classes

### Animation Classes

-   `.education-image` - Main container for education images
-   `.image-overlay` - Overlay with play button
-   `.image-click-animation` - Click animation class
-   `.video-popup-overlay` - Video popup overlay
-   `.video-popup-container` - Video popup container

### Interactive Elements

-   `.video-close-btn` - Close button
-   `.share-button` - Share button styling
-   `.video-loading` - Loading animation

## Browser Compatibility

-   ✅ Modern browsers (Chrome, Firefox, Safari, Edge)
-   ✅ Mobile browsers
-   ✅ Web Share API support (with fallback)
-   ✅ Autoplay with muted attribute for compatibility

## Customization

### Colors

Modify the CSS variables in `education.css`:

```css
.share-button {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}
```

### Animation Speed

Adjust transition durations:

```css
.education-image {
    transition: transform 0.3s ease-in-out;
}
```

### Video Player

Customize video player settings in JavaScript:

```javascript
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
```

## Demo

Visit the demo page to see the functionality in action:

-   Navigate to the education demo page
-   Click on any education image
-   Experience the zoom animation and video popup
-   Test the share functionality

## Integration with Existing System

The implementation is designed to work with the existing education search system:

1. The `_format_education_results()` function can be used to format search results
2. Video URLs should be stored in your education database
3. The system automatically initializes when the page loads
4. All functionality is backward compatible

## Troubleshooting

### Video Not Playing

-   Ensure video URLs are accessible
-   Check browser autoplay policies
-   Verify video format compatibility (MP4 recommended)

### Share Not Working

-   Web Share API requires HTTPS
-   Fallback options available for unsupported browsers
-   Check browser console for errors

### Animation Not Smooth

-   Ensure CSS transitions are enabled
-   Check for conflicting CSS rules
-   Verify JavaScript is loading properly

## Performance Considerations

-   Images are optimized with proper sizing
-   Video preloading is set to "metadata" for faster loading
-   CSS animations use hardware acceleration
-   Event handlers are properly cleaned up to prevent memory leaks

## Future Enhancements

-   Video quality selection
-   Playlist functionality
-   Analytics tracking
-   Custom video player controls
-   Picture-in-picture support
