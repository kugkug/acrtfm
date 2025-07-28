<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Helpers\ResponseHelper;

class VideoPlaylistController extends Controller
{
    protected $responseHelper;

    public function __construct(ResponseHelper $responseHelper)
    {
        $this->responseHelper = $responseHelper;
    }

    /**
     * Display the video playlist page
     */
    public function index()
    {
        // Sample data for demonstration
        $categories = [
            'tutorials' => 'Tutorials',
            'reviews' => 'Reviews', 
            'guides' => 'Guides',
            'news' => 'News',
            'interviews' => 'Interviews',
            'demos' => 'Demos'
        ];

        $playlists = $this->getSamplePlaylists();

        return view('pages.client.video_playlist', compact('categories', 'playlists'));
    }

    /**
     * Search playlists
     */
    public function search(Request $request): JsonResponse
    {
        $searchTerm = $request->input('search_term', '');
        $category = $request->input('category', '');
        $filter = $request->input('filter', '');
        $page = $request->input('page', 1);
        $perPage = 12;

        // In a real application, this would query the database
        $playlists = $this->getSamplePlaylists();
        
        // Filter by search term
        if (!empty($searchTerm)) {
            $playlists = array_filter($playlists, function($playlist) use ($searchTerm) {
                return stripos($playlist['title'], $searchTerm) !== false ||
                       stripos($playlist['description'], $searchTerm) !== false ||
                       stripos($playlist['author'], $searchTerm) !== false;
            });
        }

        // Filter by category
        if (!empty($category) && $category !== 'all') {
            $playlists = array_filter($playlists, function($playlist) use ($category) {
                return $playlist['category'] === $category;
            });
        }

        // Apply additional filters
        if (!empty($filter)) {
            $playlists = $this->applyFilter($playlists, $filter);
        }

        // Paginate results
        $total = count($playlists);
        $offset = ($page - 1) * $perPage;
        $paginatedPlaylists = array_slice($playlists, $offset, $perPage);

        $data = [
            'data' => $paginatedPlaylists,
            'current_page' => $page,
            'total' => $total,
            'per_page' => $perPage,
            'last_page' => ceil($total / $perPage)
        ];

        return response()->json([
            'success' => true,
            'data' => $data,
            'message' => 'Playlists retrieved successfully'
        ]);
    }

    /**
     * Get playlist details
     */
    public function show($id): JsonResponse
    {
        $playlists = $this->getSamplePlaylists();
        $playlist = collect($playlists)->firstWhere('id', $id);

        if (!$playlist) {
            return response()->json([
                'success' => false,
                'message' => 'Playlist not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $playlist,
            'message' => 'Playlist details retrieved successfully'
        ]);
    }

    /**
     * Get playlist videos
     */
    public function videos($id): JsonResponse
    {
        $playlists = $this->getSamplePlaylists();
        $playlist = collect($playlists)->firstWhere('id', $id);

        if (!$playlist) {
            return response()->json([
                'success' => false,
                'message' => 'Playlist not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $playlist['videos'],
            'message' => 'Playlist videos retrieved successfully'
        ]);
    }

    /**
     * Toggle favorite status
     */
    public function toggleFavorite(Request $request): JsonResponse
    {
        $playlistId = $request->input('playlist_id');
        // In a real application, this would get the authenticated user ID
        // $userId = auth()->id();

        // In a real application, this would update the database
        // For now, we'll just return a success response

        return response()->json([
            'success' => true,
            'message' => 'Favorite status updated successfully'
        ]);
    }

    /**
     * Share playlist
     */
    public function share(Request $request): JsonResponse
    {
        $playlistId = $request->input('playlist_id');
        $shareType = $request->input('share_type', 'link');

        // In a real application, this would generate share links
        // For now, we'll just return a success response

        return response()->json([
            'success' => true,
            'message' => 'Playlist shared successfully',
            'data' => [
                'share_url' => url("/playlists/{$playlistId}"),
                'share_type' => $shareType
            ]
        ]);
    }

    /**
     * Get playlist statistics
     */
    public function statistics(): JsonResponse
    {
        $playlists = $this->getSamplePlaylists();
        
        $stats = [
            'total_playlists' => count($playlists),
            'total_videos' => collect($playlists)->sum('video_count'),
            'total_duration' => $this->calculateTotalDuration($playlists),
            'categories' => collect($playlists)->groupBy('category')->map->count(),
            'recent_playlists' => collect($playlists)->take(5)->values(),
            'popular_playlists' => collect($playlists)->sortByDesc('views')->take(5)->values()
        ];

        return response()->json([
            'success' => true,
            'data' => $stats,
            'message' => 'Statistics retrieved successfully'
        ]);
    }

    /**
     * Apply filter to playlists
     */
    private function applyFilter(array $playlists, string $filter): array
    {
        switch ($filter) {
            case 'featured':
                return array_filter($playlists, function($playlist) {
                    return $playlist['featured'] ?? false;
                });
            
            case 'recent':
                return array_slice($playlists, 0, 10); // Latest 10
            
            case 'popular':
                usort($playlists, function($a, $b) {
                    return $b['views'] <=> $a['views'];
                });
                return array_slice($playlists, 0, 10);
            
            case 'favorites':
                // In a real app, this would filter by user favorites
                return array_slice($playlists, 0, 5);
            
            default:
                return $playlists;
        }
    }

    /**
     * Calculate total duration of all playlists
     */
    private function calculateTotalDuration(array $playlists): string
    {
        $totalMinutes = 0;
        
        foreach ($playlists as $playlist) {
            $duration = $playlist['duration'] ?? '0h 0m';
            preg_match('/(\d+)h\s*(\d+)m/', $duration, $matches);
            
            if (count($matches) >= 3) {
                $totalMinutes += ($matches[1] * 60) + $matches[2];
            }
        }
        
        $hours = floor($totalMinutes / 60);
        $minutes = $totalMinutes % 60;
        
        return "{$hours}h {$minutes}m";
    }

    /**
     * Get sample playlist data
     */
    private function getSamplePlaylists(): array
    {
        return [
            [
                'id' => 1,
                'title' => 'Complete Laravel Tutorial Series',
                'description' => 'Learn Laravel from basics to advanced concepts with practical examples. This comprehensive series covers everything you need to know about Laravel development.',
                'category' => 'tutorials',
                'author' => 'John Doe',
                'views' => '1.2K',
                'date' => '2 days ago',
                'video_count' => 12,
                'duration' => '2h 15m',
                'thumbnail' => 'https://img.youtube.com/vi/dQw4w9WgXcQ/hqdefault.jpg',
                'featured' => true,
                'videos' => [
                    [
                        'id' => 1,
                        'title' => 'Laravel Basics - Getting Started',
                        'url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                        'duration' => '15:30',
                        'thumbnail' => 'https://img.youtube.com/vi/dQw4w9WgXcQ/mqdefault.jpg'
                    ],
                    [
                        'id' => 2,
                        'title' => 'Database Migrations in Laravel',
                        'url' => 'https://www.youtube.com/embed/9bZkp7q19f0',
                        'duration' => '22:45',
                        'thumbnail' => 'https://img.youtube.com/vi/9bZkp7q19f0/mqdefault.jpg'
                    ],
                    [
                        'id' => 3,
                        'title' => 'Authentication and Authorization',
                        'url' => 'https://www.youtube.com/embed/jNQXAC9IVRw',
                        'duration' => '18:20',
                        'thumbnail' => 'https://img.youtube.com/vi/jNQXAC9IVRw/mqdefault.jpg'
                    ]
                ]
            ],
            [
                'id' => 2,
                'title' => 'Product Review Series 2024',
                'description' => 'In-depth reviews of the latest tech products and gadgets. Get honest opinions and detailed analysis of the newest technology releases.',
                'category' => 'reviews',
                'author' => 'Tech Reviewer',
                'views' => '3.5K',
                'date' => '1 week ago',
                'video_count' => 8,
                'duration' => '1h 45m',
                'thumbnail' => 'https://img.youtube.com/vi/9bZkp7q19f0/hqdefault.jpg',
                'featured' => false,
                'videos' => [
                    [
                        'id' => 4,
                        'title' => 'iPhone 15 Pro Review - Worth the Upgrade?',
                        'url' => 'https://www.youtube.com/embed/9bZkp7q19f0',
                        'duration' => '12:15',
                        'thumbnail' => 'https://img.youtube.com/vi/9bZkp7q19f0/mqdefault.jpg'
                    ],
                    [
                        'id' => 5,
                        'title' => 'MacBook Air M2 - Performance Test',
                        'url' => 'https://www.youtube.com/embed/jNQXAC9IVRw',
                        'duration' => '18:30',
                        'thumbnail' => 'https://img.youtube.com/vi/jNQXAC9IVRw/mqdefault.jpg'
                    ]
                ]
            ],
            [
                'id' => 3,
                'title' => 'Web Development Masterclass',
                'description' => 'Complete guide to modern web development with HTML, CSS, and JavaScript. Learn responsive design and modern frameworks.',
                'category' => 'guides',
                'author' => 'Web Dev Pro',
                'views' => '5.8K',
                'date' => '3 days ago',
                'video_count' => 15,
                'duration' => '3h 30m',
                'thumbnail' => 'https://img.youtube.com/vi/jNQXAC9IVRw/hqdefault.jpg',
                'featured' => true,
                'videos' => [
                    [
                        'id' => 6,
                        'title' => 'HTML Fundamentals - Structure and Semantics',
                        'url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                        'duration' => '25:10',
                        'thumbnail' => 'https://img.youtube.com/vi/dQw4w9WgXcQ/mqdefault.jpg'
                    ],
                    [
                        'id' => 7,
                        'title' => 'CSS Grid Layout - Complete Guide',
                        'url' => 'https://www.youtube.com/embed/9bZkp7q19f0',
                        'duration' => '32:45',
                        'thumbnail' => 'https://img.youtube.com/vi/9bZkp7q19f0/mqdefault.jpg'
                    ],
                    [
                        'id' => 8,
                        'title' => 'JavaScript ES6+ Features',
                        'url' => 'https://www.youtube.com/embed/jNQXAC9IVRw',
                        'duration' => '28:20',
                        'thumbnail' => 'https://img.youtube.com/vi/jNQXAC9IVRw/mqdefault.jpg'
                    ]
                ]
            ],
            [
                'id' => 4,
                'title' => 'Tech News Weekly',
                'description' => 'Latest technology news and updates from around the world. Stay informed about the newest developments in the tech industry.',
                'category' => 'news',
                'author' => 'Tech News',
                'views' => '2.1K',
                'date' => '1 day ago',
                'video_count' => 6,
                'duration' => '1h 20m',
                'thumbnail' => 'https://img.youtube.com/vi/dQw4w9WgXcQ/hqdefault.jpg',
                'featured' => false,
                'videos' => [
                    [
                        'id' => 9,
                        'title' => 'Latest AI Developments - Week 45',
                        'url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                        'duration' => '15:30',
                        'thumbnail' => 'https://img.youtube.com/vi/dQw4w9WgXcQ/mqdefault.jpg'
                    ],
                    [
                        'id' => 10,
                        'title' => 'New Smartphone Releases',
                        'url' => 'https://www.youtube.com/embed/9bZkp7q19f0',
                        'duration' => '12:45',
                        'thumbnail' => 'https://img.youtube.com/vi/9bZkp7q19f0/mqdefault.jpg'
                    ]
                ]
            ]
        ];
    }
} 