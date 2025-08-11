<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>ACRTFM Mobile App UI Design</title>
        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            body {
                font-family: -apple-system, BlinkMacSystemFont, "Segoe UI",
                    Roboto, sans-serif;
                background: #f5f7fa;
                color: #333;
                line-height: 1.6;
            }

            .container {
                max-width: 1200px;
                margin: 0 auto;
                padding: 20px;
            }

            .header {
                text-align: center;
                margin-bottom: 40px;
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                color: white;
                padding: 30px;
                border-radius: 15px;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            }

            .header h1 {
                font-size: 2.5rem;
                margin-bottom: 10px;
                font-weight: 700;
            }

            .header p {
                font-size: 1.1rem;
                opacity: 0.9;
            }

            .screens-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
                gap: 30px;
                margin-bottom: 40px;
            }

            .screen {
                background: white;
                border-radius: 20px;
                padding: 20px;
                box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
                transition: transform 0.3s ease, box-shadow 0.3s ease;
            }

            .screen:hover {
                transform: translateY(-5px);
                box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
            }

            .screen-title {
                font-size: 1.3rem;
                font-weight: 600;
                color: #2d3748;
                margin-bottom: 15px;
                text-align: center;
                padding-bottom: 10px;
                border-bottom: 2px solid #e2e8f0;
            }

            .phone-frame {
                width: 100%;
                max-width: 320px;
                height: 600px;
                background: #1a202c;
                border-radius: 25px;
                padding: 8px;
                margin: 0 auto;
                position: relative;
                box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
            }

            .phone-screen {
                width: 100%;
                height: 100%;
                background: #f8fafc;
                border-radius: 18px;
                overflow: hidden;
                position: relative;
            }

            .status-bar {
                height: 25px;
                background: #1a202c;
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 0 15px;
                color: white;
                font-size: 12px;
                font-weight: 600;
            }

            .app-header {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                color: white;
                padding: 15px 20px;
                display: flex;
                align-items: center;
                justify-content: space-between;
            }

            .app-title {
                font-size: 18px;
                font-weight: 600;
            }

            .header-icon {
                width: 24px;
                height: 24px;
                background: rgba(255, 255, 255, 0.2);
                border-radius: 6px;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .content {
                padding: 20px;
                height: calc(100% - 80px);
                overflow-y: auto;
            }

            .search-bar {
                background: white;
                border-radius: 12px;
                padding: 12px 16px;
                margin-bottom: 20px;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
                display: flex;
                align-items: center;
                gap: 10px;
            }

            .search-icon {
                width: 20px;
                height: 20px;
                background: #e2e8f0;
                border-radius: 50%;
            }

            .search-input {
                flex: 1;
                border: none;
                outline: none;
                font-size: 16px;
                color: #4a5568;
            }

            .search-input::placeholder {
                color: #a0aec0;
            }

            .card {
                background: white;
                border-radius: 12px;
                padding: 16px;
                margin-bottom: 12px;
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
                border-left: 4px solid #667eea;
            }

            .card-title {
                font-weight: 600;
                color: #2d3748;
                margin-bottom: 8px;
                font-size: 16px;
            }

            .card-subtitle {
                color: #718096;
                font-size: 14px;
                margin-bottom: 8px;
            }

            .card-description {
                color: #4a5568;
                font-size: 14px;
                line-height: 1.4;
            }

            .badge {
                background: #e6fffa;
                color: #319795;
                padding: 4px 8px;
                border-radius: 6px;
                font-size: 12px;
                font-weight: 500;
                display: inline-block;
                margin-top: 8px;
            }

            .bottom-nav {
                position: absolute;
                bottom: 0;
                left: 0;
                right: 0;
                background: white;
                border-top: 1px solid #e2e8f0;
                display: flex;
                padding: 8px 0;
            }

            .nav-item {
                flex: 1;
                display: flex;
                flex-direction: column;
                align-items: center;
                padding: 8px;
                color: #a0aec0;
                font-size: 12px;
                transition: color 0.3s ease;
            }

            .nav-item.active {
                color: #667eea;
            }

            .nav-icon {
                width: 24px;
                height: 24px;
                background: currentColor;
                border-radius: 6px;
                margin-bottom: 4px;
            }

            .fab {
                position: absolute;
                bottom: 80px;
                right: 20px;
                width: 56px;
                height: 56px;
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                color: white;
                font-size: 24px;
                box-shadow: 0 4px 20px rgba(102, 126, 234, 0.4);
            }

            .list-item {
                display: flex;
                align-items: center;
                padding: 16px;
                background: white;
                border-radius: 12px;
                margin-bottom: 8px;
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            }

            .list-icon {
                width: 40px;
                height: 40px;
                background: #e2e8f0;
                border-radius: 8px;
                margin-right: 12px;
                display: flex;
                align-items: center;
                justify-content: center;
                color: #667eea;
                font-weight: bold;
            }

            .list-content {
                flex: 1;
            }

            .list-title {
                font-weight: 600;
                color: #2d3748;
                margin-bottom: 4px;
            }

            .list-subtitle {
                color: #718096;
                font-size: 14px;
            }

            .button {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                color: white;
                border: none;
                border-radius: 12px;
                padding: 14px 24px;
                font-size: 16px;
                font-weight: 600;
                cursor: pointer;
                transition: transform 0.2s ease;
                width: 100%;
                margin-bottom: 12px;
            }

            .button:active {
                transform: scale(0.98);
            }

            .button.secondary {
                background: #e2e8f0;
                color: #4a5568;
            }

            .form-group {
                margin-bottom: 16px;
            }

            .form-label {
                display: block;
                margin-bottom: 6px;
                font-weight: 500;
                color: #2d3748;
            }

            .form-input {
                width: 100%;
                padding: 12px 16px;
                border: 2px solid #e2e8f0;
                border-radius: 8px;
                font-size: 16px;
                transition: border-color 0.3s ease;
            }

            .form-input:focus {
                outline: none;
                border-color: #667eea;
            }

            .stats-grid {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 12px;
                margin-bottom: 20px;
            }

            .stat-card {
                background: white;
                padding: 16px;
                border-radius: 12px;
                text-align: center;
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            }

            .stat-number {
                font-size: 24px;
                font-weight: 700;
                color: #667eea;
                margin-bottom: 4px;
            }

            .stat-label {
                color: #718096;
                font-size: 14px;
            }

            .video-card {
                background: white;
                border-radius: 12px;
                overflow: hidden;
                margin-bottom: 16px;
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            }

            .video-thumbnail {
                width: 100%;
                height: 120px;
                background: linear-gradient(45deg, #667eea, #764ba2);
                display: flex;
                align-items: center;
                justify-content: center;
                color: white;
                font-size: 24px;
            }

            .video-info {
                padding: 16px;
            }

            .video-title {
                font-weight: 600;
                color: #2d3748;
                margin-bottom: 8px;
            }

            .video-meta {
                color: #718096;
                font-size: 14px;
                display: flex;
                justify-content: space-between;
            }

            .ac-model-card {
                background: white;
                border-radius: 12px;
                padding: 16px;
                margin-bottom: 12px;
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
                border-left: 4px solid #48bb78;
            }

            .ac-model-sku {
                font-weight: 700;
                color: #2d3748;
                font-size: 16px;
                margin-bottom: 8px;
            }

            .ac-model-brand {
                color: #718096;
                font-size: 14px;
                margin-bottom: 8px;
            }

            .ac-model-manuals {
                color: #667eea;
                font-size: 14px;
                font-weight: 500;
            }

            .accomplishment-card {
                background: white;
                border-radius: 12px;
                padding: 16px;
                margin-bottom: 12px;
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
                border-left: 4px solid #ed8936;
            }

            .accomplishment-title {
                font-weight: 600;
                color: #2d3748;
                margin-bottom: 8px;
            }

            .accomplishment-date {
                color: #718096;
                font-size: 14px;
                margin-bottom: 8px;
            }

            .accomplishment-status {
                background: #fef5e7;
                color: #ed8936;
                padding: 4px 8px;
                border-radius: 6px;
                font-size: 12px;
                font-weight: 500;
                display: inline-block;
            }

            .profile-header {
                text-align: center;
                padding: 20px;
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                color: white;
                border-radius: 12px;
                margin-bottom: 20px;
            }

            .profile-avatar {
                width: 80px;
                height: 80px;
                background: rgba(255, 255, 255, 0.2);
                border-radius: 50%;
                margin: 0 auto 12px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 32px;
            }

            .profile-name {
                font-size: 20px;
                font-weight: 600;
                margin-bottom: 4px;
            }

            .profile-role {
                opacity: 0.9;
                font-size: 14px;
            }

            .menu-item {
                display: flex;
                align-items: center;
                padding: 16px;
                background: white;
                border-radius: 12px;
                margin-bottom: 8px;
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            }

            .menu-icon {
                width: 40px;
                height: 40px;
                background: #e2e8f0;
                border-radius: 8px;
                margin-right: 12px;
                display: flex;
                align-items: center;
                justify-content: center;
                color: #667eea;
            }

            .menu-content {
                flex: 1;
            }

            .menu-title {
                font-weight: 600;
                color: #2d3748;
            }

            .menu-subtitle {
                color: #718096;
                font-size: 14px;
            }

            .menu-arrow {
                color: #cbd5e0;
            }

            .features-section {
                margin-top: 40px;
                background: white;
                border-radius: 15px;
                padding: 30px;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            }

            .features-title {
                font-size: 1.8rem;
                font-weight: 700;
                color: #2d3748;
                margin-bottom: 20px;
                text-align: center;
            }

            .features-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
                gap: 20px;
            }

            .feature-card {
                background: #f8fafc;
                border-radius: 12px;
                padding: 20px;
                text-align: center;
                border: 2px solid #e2e8f0;
                transition: all 0.3s ease;
            }

            .feature-card:hover {
                border-color: #667eea;
                transform: translateY(-2px);
            }

            .feature-icon {
                width: 60px;
                height: 60px;
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                border-radius: 50%;
                margin: 0 auto 15px;
                display: flex;
                align-items: center;
                justify-content: center;
                color: white;
                font-size: 24px;
            }

            .feature-title {
                font-weight: 600;
                color: #2d3748;
                margin-bottom: 8px;
            }

            .feature-description {
                color: #718096;
                font-size: 14px;
                line-height: 1.5;
            }

            @media (max-width: 768px) {
                .screens-grid {
                    grid-template-columns: 1fr;
                }

                .features-grid {
                    grid-template-columns: 1fr;
                }
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="header">
                <h1>ACRTFM Mobile App</h1>
                <p>HVAC Technician Field Manual & Training Platform</p>
            </div>

            <div class="screens-grid">
                <!-- Login Screen -->
                <div class="screen">
                    <div class="screen-title">Login Screen</div>
                    <div class="phone-frame">
                        <div class="phone-screen">
                            <div class="status-bar">
                                <span>9:41</span>
                                <span>📶 📶 📶</span>
                            </div>
                            <div class="app-header">
                                <div class="app-title">ACRTFM</div>
                                <div class="header-icon">🔧</div>
                            </div>
                            <div class="content">
                                <div style="text-align: center; margin: 40px 0">
                                    <div
                                        style="
                                            width: 80px;
                                            height: 80px;
                                            background: linear-gradient(
                                                135deg,
                                                #667eea 0%,
                                                #764ba2 100%
                                            );
                                            border-radius: 50%;
                                            margin: 0 auto 20px;
                                            display: flex;
                                            align-items: center;
                                            justify-content: center;
                                            color: white;
                                            font-size: 32px;
                                        "
                                    >
                                        🔧
                                    </div>
                                    <h2
                                        style="
                                            color: #2d3748;
                                            margin-bottom: 8px;
                                        "
                                    >
                                        Welcome Back
                                    </h2>
                                    <p style="color: #718096">
                                        Sign in to your account
                                    </p>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Email</label>
                                    <input
                                        type="email"
                                        class="form-input"
                                        placeholder="Enter your email"
                                    />
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Password</label>
                                    <input
                                        type="password"
                                        class="form-input"
                                        placeholder="Enter your password"
                                    />
                                </div>

                                <button class="button">Sign In</button>
                                <button class="button secondary">
                                    Create Account
                                </button>

                                <div
                                    style="text-align: center; margin-top: 20px"
                                >
                                    <a
                                        href="#"
                                        style="
                                            color: #667eea;
                                            text-decoration: none;
                                        "
                                        >Forgot Password?</a
                                    >
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Dashboard Screen -->
                <div class="screen">
                    <div class="screen-title">Dashboard</div>
                    <div class="phone-frame">
                        <div class="phone-screen">
                            <div class="status-bar">
                                <span>9:41</span>
                                <span>📶 📶 📶</span>
                            </div>
                            <div class="app-header">
                                <div class="app-title">Dashboard</div>
                                <div class="header-icon">👤</div>
                            </div>
                            <div class="content">
                                <div class="search-bar">
                                    <div class="search-icon"></div>
                                    <input
                                        type="text"
                                        class="search-input"
                                        placeholder="Search AC models, manuals..."
                                    />
                                </div>

                                <div class="stats-grid">
                                    <div class="stat-card">
                                        <div class="stat-number">24</div>
                                        <div class="stat-label">Jobs Today</div>
                                    </div>
                                    <div class="stat-card">
                                        <div class="stat-number">156</div>
                                        <div class="stat-label">Total Jobs</div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-title">
                                        Recent Activity
                                    </div>
                                    <div class="card-subtitle">
                                        Last 24 hours
                                    </div>
                                    <div class="card-description">
                                        3 new jobs assigned, 2 manuals
                                        downloaded
                                    </div>
                                    <div class="badge">Active</div>
                                </div>

                                <div class="card">
                                    <div class="card-title">Quick Actions</div>
                                    <div
                                        style="
                                            display: grid;
                                            grid-template-columns: 1fr 1fr;
                                            gap: 8px;
                                            margin-top: 12px;
                                        "
                                    >
                                        <button
                                            class="button"
                                            style="
                                                margin: 0;
                                                padding: 8px;
                                                font-size: 14px;
                                            "
                                        >
                                            🔍 Search AC
                                        </button>
                                        <button
                                            class="button secondary"
                                            style="
                                                margin: 0;
                                                padding: 8px;
                                                font-size: 14px;
                                            "
                                        >
                                            📚 Manuals
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="bottom-nav">
                                <div class="nav-item active">
                                    <div class="nav-icon"></div>
                                    <span>Home</span>
                                </div>
                                <div class="nav-item">
                                    <div class="nav-icon"></div>
                                    <span>Search</span>
                                </div>
                                <div class="nav-item">
                                    <div class="nav-icon"></div>
                                    <span>Training</span>
                                </div>
                                <div class="nav-item">
                                    <div class="nav-icon"></div>
                                    <span>Jobs</span>
                                </div>
                                <div class="nav-item">
                                    <div class="nav-icon"></div>
                                    <span>Profile</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- AC Model Search Screen -->
                <div class="screen">
                    <div class="screen-title">AC Model Search</div>
                    <div class="phone-frame">
                        <div class="phone-screen">
                            <div class="status-bar">
                                <span>9:41</span>
                                <span>📶 📶 📶</span>
                            </div>
                            <div class="app-header">
                                <div class="app-title">Model Search</div>
                                <div class="header-icon">🔍</div>
                            </div>
                            <div class="content">
                                <div class="search-bar">
                                    <div class="search-icon"></div>
                                    <input
                                        type="text"
                                        class="search-input"
                                        placeholder="Enter AC model or SKU..."
                                    />
                                </div>

                                <div class="ac-model-card">
                                    <div class="ac-model-sku">AC-2024-001</div>
                                    <div class="ac-model-brand">
                                        Carrier • Infinity Series
                                    </div>
                                    <div class="ac-model-manuals">
                                        📄 3 Manuals Available
                                    </div>
                                </div>

                                <div class="ac-model-card">
                                    <div class="ac-model-sku">AC-2024-002</div>
                                    <div class="ac-model-brand">
                                        Trane • XR Series
                                    </div>
                                    <div class="ac-model-manuals">
                                        📄 2 Manuals Available
                                    </div>
                                </div>

                                <div class="ac-model-card">
                                    <div class="ac-model-sku">AC-2024-003</div>
                                    <div class="ac-model-brand">
                                        Lennox • Elite Series
                                    </div>
                                    <div class="ac-model-manuals">
                                        📄 4 Manuals Available
                                    </div>
                                </div>

                                <div class="ac-model-card">
                                    <div class="ac-model-sku">AC-2024-004</div>
                                    <div class="ac-model-brand">
                                        Rheem • Prestige Series
                                    </div>
                                    <div class="ac-model-manuals">
                                        📄 1 Manual Available
                                    </div>
                                </div>
                            </div>

                            <div class="bottom-nav">
                                <div class="nav-item">
                                    <div class="nav-icon"></div>
                                    <span>Home</span>
                                </div>
                                <div class="nav-item active">
                                    <div class="nav-icon"></div>
                                    <span>Search</span>
                                </div>
                                <div class="nav-item">
                                    <div class="nav-icon"></div>
                                    <span>Training</span>
                                </div>
                                <div class="nav-item">
                                    <div class="nav-icon"></div>
                                    <span>Jobs</span>
                                </div>
                                <div class="nav-item">
                                    <div class="nav-icon"></div>
                                    <span>Profile</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Training Videos Screen -->
                <div class="screen">
                    <div class="screen-title">Training Videos</div>
                    <div class="phone-frame">
                        <div class="phone-screen">
                            <div class="status-bar">
                                <span>9:41</span>
                                <span>📶 📶 📶</span>
                            </div>
                            <div class="app-header">
                                <div class="app-title">Training</div>
                                <div class="header-icon">🎓</div>
                            </div>
                            <div class="content">
                                <div class="search-bar">
                                    <div class="search-icon"></div>
                                    <input
                                        type="text"
                                        class="search-input"
                                        placeholder="Search training videos..."
                                    />
                                </div>

                                <div class="video-card">
                                    <div class="video-thumbnail">▶️</div>
                                    <div class="video-info">
                                        <div class="video-title">
                                            AC Installation Best Practices
                                        </div>
                                        <div class="video-meta">
                                            <span>By: John Smith</span>
                                            <span>45 min</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="video-card">
                                    <div class="video-thumbnail">▶️</div>
                                    <div class="video-info">
                                        <div class="video-title">
                                            Troubleshooting Common Issues
                                        </div>
                                        <div class="video-meta">
                                            <span>By: Sarah Johnson</span>
                                            <span>32 min</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="video-card">
                                    <div class="video-thumbnail">▶️</div>
                                    <div class="video-info">
                                        <div class="video-title">
                                            Refrigerant Handling Safety
                                        </div>
                                        <div class="video-meta">
                                            <span>By: Mike Davis</span>
                                            <span>28 min</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="video-card">
                                    <div class="video-thumbnail">▶️</div>
                                    <div class="video-info">
                                        <div class="video-title">
                                            New Technology Updates
                                        </div>
                                        <div class="video-meta">
                                            <span>By: Lisa Wilson</span>
                                            <span>38 min</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="bottom-nav">
                                <div class="nav-item">
                                    <div class="nav-icon"></div>
                                    <span>Home</span>
                                </div>
                                <div class="nav-item">
                                    <div class="nav-icon"></div>
                                    <span>Search</span>
                                </div>
                                <div class="nav-item active">
                                    <div class="nav-icon"></div>
                                    <span>Training</span>
                                </div>
                                <div class="nav-item">
                                    <div class="nav-icon"></div>
                                    <span>Jobs</span>
                                </div>
                                <div class="nav-item">
                                    <div class="nav-icon"></div>
                                    <span>Profile</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Job Accomplishments Screen -->
                <div class="screen">
                    <div class="screen-title">Job Accomplishments</div>
                    <div class="phone-frame">
                        <div class="phone-screen">
                            <div class="status-bar">
                                <span>9:41</span>
                                <span>📶 📶 📶</span>
                            </div>
                            <div class="app-header">
                                <div class="app-title">My Jobs</div>
                                <div class="header-icon">📋</div>
                            </div>
                            <div class="content">
                                <div class="accomplishment-card">
                                    <div class="accomplishment-title">
                                        AC Installation - Downtown Office
                                    </div>
                                    <div class="accomplishment-date">
                                        Today • 2:30 PM
                                    </div>
                                    <div class="accomplishment-status">
                                        Completed
                                    </div>
                                </div>

                                <div class="accomplishment-card">
                                    <div class="accomplishment-title">
                                        Maintenance - Residential Complex
                                    </div>
                                    <div class="accomplishment-date">
                                        Yesterday • 4:15 PM
                                    </div>
                                    <div class="accomplishment-status">
                                        In Progress
                                    </div>
                                </div>

                                <div class="accomplishment-card">
                                    <div class="accomplishment-title">
                                        Repair - Shopping Mall
                                    </div>
                                    <div class="accomplishment-date">
                                        Dec 15 • 11:20 AM
                                    </div>
                                    <div class="accomplishment-status">
                                        Completed
                                    </div>
                                </div>

                                <div class="accomplishment-card">
                                    <div class="accomplishment-title">
                                        System Upgrade - Hotel
                                    </div>
                                    <div class="accomplishment-date">
                                        Dec 14 • 3:45 PM
                                    </div>
                                    <div class="accomplishment-status">
                                        Completed
                                    </div>
                                </div>

                                <div class="accomplishment-card">
                                    <div class="accomplishment-title">
                                        Emergency Repair - Hospital
                                    </div>
                                    <div class="accomplishment-date">
                                        Dec 13 • 9:30 AM
                                    </div>
                                    <div class="accomplishment-status">
                                        Completed
                                    </div>
                                </div>
                            </div>

                            <div class="fab">+</div>

                            <div class="bottom-nav">
                                <div class="nav-item">
                                    <div class="nav-icon"></div>
                                    <span>Home</span>
                                </div>
                                <div class="nav-item">
                                    <div class="nav-icon"></div>
                                    <span>Search</span>
                                </div>
                                <div class="nav-item">
                                    <div class="nav-icon"></div>
                                    <span>Training</span>
                                </div>
                                <div class="nav-item active">
                                    <div class="nav-icon"></div>
                                    <span>Jobs</span>
                                </div>
                                <div class="nav-item">
                                    <div class="nav-icon"></div>
                                    <span>Profile</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Profile Screen -->
                <div class="screen">
                    <div class="screen-title">Profile & Settings</div>
                    <div class="phone-frame">
                        <div class="phone-screen">
                            <div class="status-bar">
                                <span>9:41</span>
                                <span>📶 📶 📶</span>
                            </div>
                            <div class="app-header">
                                <div class="app-title">Profile</div>
                                <div class="header-icon">⚙️</div>
                            </div>
                            <div class="content">
                                <div class="profile-header">
                                    <div class="profile-avatar">👨‍🔧</div>
                                    <div class="profile-name">
                                        John Technician
                                    </div>
                                    <div class="profile-role">
                                        Senior HVAC Technician
                                    </div>
                                </div>

                                <div class="menu-item">
                                    <div class="menu-icon">👤</div>
                                    <div class="menu-content">
                                        <div class="menu-title">
                                            Edit Profile
                                        </div>
                                        <div class="menu-subtitle">
                                            Update your information
                                        </div>
                                    </div>
                                    <div class="menu-arrow">›</div>
                                </div>

                                <div class="menu-item">
                                    <div class="menu-icon">📊</div>
                                    <div class="menu-content">
                                        <div class="menu-title">
                                            Performance Stats
                                        </div>
                                        <div class="menu-subtitle">
                                            View your job statistics
                                        </div>
                                    </div>
                                    <div class="menu-arrow">›</div>
                                </div>

                                <div class="menu-item">
                                    <div class="menu-icon">📚</div>
                                    <div class="menu-content">
                                        <div class="menu-title">
                                            Training Progress
                                        </div>
                                        <div class="menu-subtitle">
                                            Track your learning
                                        </div>
                                    </div>
                                    <div class="menu-arrow">›</div>
                                </div>

                                <div class="menu-item">
                                    <div class="menu-icon">🔔</div>
                                    <div class="menu-content">
                                        <div class="menu-title">
                                            Notifications
                                        </div>
                                        <div class="menu-subtitle">
                                            Manage alerts
                                        </div>
                                    </div>
                                    <div class="menu-arrow">›</div>
                                </div>

                                <div class="menu-item">
                                    <div class="menu-icon">🔒</div>
                                    <div class="menu-content">
                                        <div class="menu-title">
                                            Privacy & Security
                                        </div>
                                        <div class="menu-subtitle">
                                            Account settings
                                        </div>
                                    </div>
                                    <div class="menu-arrow">›</div>
                                </div>

                                <div class="menu-item">
                                    <div class="menu-icon">❓</div>
                                    <div class="menu-content">
                                        <div class="menu-title">
                                            Help & Support
                                        </div>
                                        <div class="menu-subtitle">
                                            Get assistance
                                        </div>
                                    </div>
                                    <div class="menu-arrow">›</div>
                                </div>

                                <button
                                    class="button secondary"
                                    style="margin-top: 20px"
                                >
                                    Sign Out
                                </button>
                            </div>

                            <div class="bottom-nav">
                                <div class="nav-item">
                                    <div class="nav-icon"></div>
                                    <span>Home</span>
                                </div>
                                <div class="nav-item">
                                    <div class="nav-icon"></div>
                                    <span>Search</span>
                                </div>
                                <div class="nav-item">
                                    <div class="nav-icon"></div>
                                    <span>Training</span>
                                </div>
                                <div class="nav-item">
                                    <div class="nav-icon"></div>
                                    <span>Jobs</span>
                                </div>
                                <div class="nav-item active">
                                    <div class="nav-icon"></div>
                                    <span>Profile</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="features-section">
                <h2 class="features-title">Key Features</h2>
                <div class="features-grid">
                    <div class="feature-card">
                        <div class="feature-icon">🔍</div>
                        <div class="feature-title">AC Model Search</div>
                        <div class="feature-description">
                            Quickly find air conditioner models and access their
                            technical manuals with advanced search
                            functionality.
                        </div>
                    </div>

                    <div class="feature-card">
                        <div class="feature-icon">📚</div>
                        <div class="feature-title">Technical Manuals</div>
                        <div class="feature-description">
                            Access comprehensive repair manuals, installation
                            guides, and troubleshooting documentation.
                        </div>
                    </div>

                    <div class="feature-card">
                        <div class="feature-icon">🎓</div>
                        <div class="feature-title">Training Videos</div>
                        <div class="feature-description">
                            Watch educational content from industry experts
                            covering installation, repair, and maintenance.
                        </div>
                    </div>

                    <div class="feature-card">
                        <div class="feature-icon">📋</div>
                        <div class="feature-title">Job Tracking</div>
                        <div class="feature-description">
                            Document and track your work accomplishments with
                            photos, notes, and completion status.
                        </div>
                    </div>

                    <div class="feature-card">
                        <div class="feature-icon">📊</div>
                        <div class="feature-title">Performance Analytics</div>
                        <div class="feature-description">
                            Monitor your job statistics, training progress, and
                            professional development metrics.
                        </div>
                    </div>

                    <div class="feature-card">
                        <div class="feature-icon">🔔</div>
                        <div class="feature-title">Smart Notifications</div>
                        <div class="feature-description">
                            Receive alerts for new assignments, training
                            updates, and important system notifications.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
