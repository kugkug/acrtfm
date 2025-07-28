# Video Playlist Template

A comprehensive video playlist management system built with Laravel and modern web technologies. This template provides a complete solution for organizing, displaying, and managing video playlists with an intuitive user interface.

## Features

### 🎯 Core Functionality

-   **Playlist Management**: Create, organize, and manage video playlists
-   **Video Player**: Embedded YouTube video player with playlist navigation
-   **Search & Filter**: Advanced search and filtering capabilities
-   **Category System**: Organize playlists by categories (Tutorials, Reviews, Guides, News)
-   **Responsive Design**: Mobile-friendly interface that works on all devices

### 🎨 User Interface

-   **Modern Design**: Clean, modern UI with smooth animations
-   **Card Layout**: Beautiful playlist cards with hover effects
-   **Modal Player**: Full-featured video player in modal windows
-   **Category Buttons**: Easy category filtering with visual feedback
-   **Loading States**: Smooth loading animations and feedback

### 🔧 Technical Features

-   **Laravel Backend**: Robust PHP backend with RESTful API
-   **AJAX Integration**: Dynamic content loading without page refreshes
-   **YouTube Integration**: Seamless YouTube video embedding
-   **Keyboard Navigation**: Full keyboard support for accessibility
-   **Share Functionality**: Social media sharing capabilities

## File Structure

```
├── resources/views/pages/client/
│   └── video_playlist.blade.php          # Main template file
├── public/assets/acrtfm/js/modules/
│   └── video-playlist.js                 # JavaScript functionality
├── public/assets/acrtfm/css/
│   └── video-playlist.css                # Custom styles
├── app/Http/Controllers/
│   └── VideoPlaylistController.php       # Backend controller
└── routes/web.php                        # Route definitions
```

## Installation & Setup

### 1. Template Files

The template files are already created and ready to use:

-   `video_playlist.blade.php` - Main view template
-   `video-playlist.js` - Frontend JavaScript
-   `video-playlist.css` - Custom styling
-   `VideoPlaylistController.php` - Backend controller

### 2. Routes

Routes are automatically added to `routes/web.php`:

```php
Route::get('/video-playlist', [ModulesController::class, 'videoPlaylist'])->name("video-playlist");

Route::prefix('executor/video-playlist')->group(function () {
    Route::post('/search', [VideoPlaylistController::class, 'search']);
    Route::get('/{id}', [VideoPlaylistController::class, 'show']);
    Route::get('/{id}/videos', [VideoPlaylistController::class, 'videos']);
    Route::post('/toggle-favorite', [VideoPlaylistController::class, 'toggleFavorite']);
    Route::post('/share', [VideoPlaylistController::class, 'share']);
    Route::get('/statistics', [VideoPlaylistController::class, 'statistics']);
});
```

### 3. CSS Integration

Add the CSS file to your main layout or include it in the template:

```html
<link
    rel="stylesheet"
    href="{{ asset('assets/acrtfm/css/video-playlist.css') }}"
/>
```

## Usage

### Accessing the Template

Navigate to `/video-playlist` in your application to view the template.

### Sample Data

The template includes sample playlist data with:

-   4 sample playlists across different categories
-   YouTube video integration
-   Realistic metadata (views, duration, author)

### Features in Action

#### 1. Search & Filter

-   **Search Bar**: Type to search playlist titles, descriptions, and authors
-   **Category Filter**: Click category buttons to filter playlists
-   **Dropdown Filter**: Use the filter dropdown for additional options

#### 2. Playlist Interaction

-   **Play All**: Click "Play All" to open the playlist modal
-   **Video Navigation**: Click individual videos in the sidebar
-   **Keyboard Controls**: Use arrow keys to navigate videos

#### 3. Playlist Actions

-   **Favorites**: Click heart icon to add/remove from favorites
-   **Share**: Click share icon to share playlist
-   **Details**: Click info icon to view playlist details

## Customization

### Adding New Playlists

Edit the `getSamplePlaylists()` method in `VideoPlaylistController.php`:

```php
private function getSamplePlaylists(): array
{
    return [
        [
            'id' => 5,
            'title' => 'Your New Playlist',
            'description' => 'Description here',
            'category' => 'tutorials',
            'author' => 'Your Name',
            'views' => '1.5K',
            'date' => '1 day ago',
            'video_count' => 10,
            'duration' => '2h 30m',
            'thumbnail' => 'https://img.youtube.com/vi/VIDEO_ID/hqdefault.jpg',
            'featured' => false,
            'videos' => [
                [
                    'id' => 11,
                    'title' => 'Video Title',
                    'url' => 'https://www.youtube.com/embed/VIDEO_ID',
                    'duration' => '15:30',
                    'thumbnail' => 'https://img.youtube.com/vi/VIDEO_ID/mqdefault.jpg'
                ]
            ]
        ]
    ];
}
```

### Styling Customization

Modify `video-playlist.css` to customize:

-   Colors and themes
-   Card layouts
-   Animations
-   Responsive breakpoints

### JavaScript Customization

Edit `video-playlist.js` to add:

-   Custom search logic
-   Additional filters
-   New interaction features
-   API integrations

## API Endpoints

### Search Playlists

```
POST /executor/video-playlist/search
```

Parameters:

-   `search_term` (optional): Search query
-   `category` (optional): Category filter
-   `filter` (optional): Additional filter
-   `page` (optional): Page number

### Get Playlist Details

```
GET /executor/video-playlist/{id}
```

### Get Playlist Videos

```
GET /executor/video-playlist/{id}/videos
```

### Toggle Favorite

```
POST /executor/video-playlist/toggle-favorite
```

Parameters:

-   `playlist_id`: Playlist ID

### Share Playlist

```
POST /executor/video-playlist/share
```

Parameters:

-   `playlist_id`: Playlist ID
-   `share_type`: Share type (link, social, etc.)

### Get Statistics

```
GET /executor/video-playlist/statistics
```

## Browser Compatibility

-   ✅ Chrome 80+
-   ✅ Firefox 75+
-   ✅ Safari 13+
-   ✅ Edge 80+
-   ✅ Mobile browsers

## Performance Features

-   **Lazy Loading**: Images and content load on demand
-   **Efficient DOM**: Minimal DOM manipulation
-   **Optimized CSS**: Efficient selectors and animations
-   **Caching**: Browser caching for static assets

## Accessibility

-   **Keyboard Navigation**: Full keyboard support
-   **Screen Reader**: ARIA labels and semantic HTML
-   **Focus Management**: Proper focus indicators
-   **Color Contrast**: WCAG compliant color schemes

## Security Considerations

-   **CSRF Protection**: Laravel CSRF tokens
-   **Input Validation**: Server-side validation
-   **XSS Prevention**: Proper output escaping
-   **Content Security**: YouTube embed restrictions

## Future Enhancements

### Planned Features

-   [ ] User authentication integration
-   [ ] Database storage for playlists
-   [ ] User favorites system
-   [ ] Playlist creation interface
-   [ ] Video upload functionality
-   [ ] Analytics dashboard
-   [ ] Multi-language support
-   [ ] Advanced search filters

### Technical Improvements

-   [ ] Vue.js/React integration
-   [ ] Real-time updates
-   [ ] Progressive Web App features
-   [ ] Offline functionality
-   [ ] Video quality selection
-   [ ] Subtitle support

## Troubleshooting

### Common Issues

1. **Videos not loading**: Check YouTube video IDs and embed URLs
2. **CSS not applying**: Ensure CSS file is properly linked
3. **JavaScript errors**: Check browser console for errors
4. **Modal not opening**: Verify Bootstrap is loaded

### Debug Mode

Enable debug mode in Laravel to see detailed error messages:

```php
// In .env file
APP_DEBUG=true
```

## Support

For issues or questions:

1. Check the browser console for JavaScript errors
2. Verify all files are properly included
3. Ensure Laravel routes are correctly configured
4. Check YouTube video IDs are valid

## License

This template is provided as-is for educational and development purposes. Feel free to modify and adapt for your specific needs.

---

**Created with ❤️ using Laravel, Bootstrap, and modern web technologies**
