<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ app()->getLocale() == 'vi' ? 'Không Tìm Thấy Trang' : 'Page Not Found' }} - ABOUT US Coffee & Eatery</title>
    <meta name="description" content="{{ app()->getLocale() == 'vi' ? 'Trang bạn tìm kiếm không tồn tại. Hãy quay về trang chủ để khám phá cà phê đặc biệt tại ABOUT US Coffee.' : 'The page you are looking for does not exist. Return to the homepage to explore specialty coffee at ABOUT US Coffee.' }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}" sizes="any">
    <link rel="icon" href="{{ asset('favicon-16x16.png') }}" type="image/png" sizes="16x16">
    <link rel="icon" href="{{ asset('favicon-32x32.png') }}" type="image/png" sizes="32x32">
    
    @vite(['resources/css/style.css'])

    <style>
        .error-page {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, var(--cream) 0%, var(--concrete) 100%);
            padding: 2rem;
            position: relative;
            overflow: hidden;
        }

        .error-content {
            text-align: center;
            max-width: 600px;
            background: var(--black);
            border: var(--border-width) solid var(--primary);
            padding: 4rem 3rem;
            box-shadow: 12px 12px 0 var(--coffee-brown);
            position: relative;
            z-index: 2;
        }

        .error-number {
            font-size: 8rem;
            font-weight: 900;
            color: var(--primary);
            margin-bottom: 1rem;
            font-family: 'Space Grotesk', sans-serif;
            line-height: 1;
            text-shadow: 4px 4px 0 var(--coffee-brown);
        }

        .error-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--cream);
            margin-bottom: 1rem;
            font-family: 'Space Grotesk', sans-serif;
        }

        .error-description {
            font-size: 1.1rem;
            color: var(--concrete);
            margin-bottom: 2rem;
            line-height: 1.6;
        }

        .error-actions {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .error-btn {
            padding: 1rem 2rem;
            text-decoration: none;
            font-weight: 700;
            border: 3px solid;
            transition: all 0.3s ease;
            font-family: 'Space Mono', monospace;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .error-btn-primary {
            background: var(--primary);
            color: var(--black);
            border-color: var(--primary);
        }

        .error-btn-primary:hover {
            background: var(--light-teal);
            border-color: var(--light-teal);
            transform: translateY(-2px);
            box-shadow: 4px 4px 0 var(--coffee-brown);
        }

        .error-btn-outline {
            background: transparent;
            color: var(--cream);
            border-color: var(--cream);
        }

        .error-btn-outline:hover {
            background: var(--cream);
            color: var(--black);
            transform: translateY(-2px);
            box-shadow: 4px 4px 0 var(--coffee-brown);
        }

        /* Floating Coffee Elements */
        .coffee-bean-bg {
            position: absolute;
            opacity: 0.1;
            pointer-events: none;
        }

        .coffee-bean-bg:nth-child(1) {
            top: 10%;
            left: 10%;
            width: 80px;
            height: 50px;
            animation: float 6s ease-in-out infinite;
        }

        .coffee-bean-bg:nth-child(2) {
            top: 70%;
            right: 15%;
            width: 60px;
            height: 40px;
            animation: float 8s ease-in-out infinite reverse;
        }

        .coffee-bean-bg:nth-child(3) {
            bottom: 20%;
            left: 20%;
            width: 100px;
            height: 60px;
            animation: float 7s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(10deg); }
        }

        /* Coffee Cup Icon */
        .coffee-cup-icon {
            position: absolute;
            top: -20px;
            right: -20px;
            width: 60px;
            height: 60px;
            background: var(--coffee-brown);
            border: 4px solid var(--primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }

        @media (max-width: 768px) {
            .error-content {
                padding: 3rem 2rem;
            }
            
            .error-number {
                font-size: 6rem;
            }
            
            .error-title {
                font-size: 2rem;
            }
            
            .error-actions {
                flex-direction: column;
                align-items: center;
            }
            
            .error-btn {
                width: 100%;
                max-width: 300px;
            }
        }
    </style>
</head>
<body>
    <div class="error-page">
        <!-- Floating Coffee Beans -->
        <svg class="coffee-bean-bg" viewBox="0 0 60 40">
            <ellipse cx="30" cy="20" rx="28" ry="18" fill="#D4A574" stroke="#1A1A1A" stroke-width="2"/>
            <path d="M30 5 Q30 20 30 35" stroke="#3D2817" stroke-width="2" fill="none" opacity="0.7"/>
        </svg>
        
        <svg class="coffee-bean-bg" viewBox="0 0 60 40">
            <ellipse cx="30" cy="20" rx="28" ry="18" fill="#8B6F47" stroke="#1A1A1A" stroke-width="2"/>
            <path d="M30 5 Q30 20 30 35" stroke="#3D2817" stroke-width="2" fill="none" opacity="0.7"/>
        </svg>
        
        <svg class="coffee-bean-bg" viewBox="0 0 60 40">
            <ellipse cx="30" cy="20" rx="28" ry="18" fill="#A67C52" stroke="#1A1A1A" stroke-width="2"/>
            <path d="M30 5 Q30 20 30 35" stroke="#3D2817" stroke-width="2" fill="none" opacity="0.7"/>
        </svg>

        <div class="error-content">
            <div class="coffee-cup-icon">☕</div>
            
            <div class="error-number">404</div>
            
            <h1 class="error-title">
                {{ app()->getLocale() == 'vi' ? 'Không Tìm Thấy Trang' : 'Page Not Found' }}
            </h1>
            
            <p class="error-description">
                {{ app()->getLocale() == 'vi' 
                    ? 'Trang bạn đang tìm kiếm không tồn tại hoặc đã được di chuyển. Giống như ly cà phê hoàn hảo, đôi khi chúng ta cần thời gian để tìm đúng thứ mình muốn.'
                    : 'The page you are looking for does not exist or has been moved. Like the perfect cup of coffee, sometimes we need time to find exactly what we\'re looking for.' 
                }}
            </p>
            
            <div class="error-actions">
                <a href="{{ route('home') }}" class="error-btn error-btn-primary">
                    {{ app()->getLocale() == 'vi' ? '🏠 Về Trang Chủ' : '🏠 Go Home' }}
                </a>
                
                <a href="{{ route('home') }}#menu" class="error-btn error-btn-outline">
                    {{ app()->getLocale() == 'vi' ? '☕ Xem Thực Đơn' : '☕ View Menu' }}
                </a>
            </div>
        </div>
    </div>
</body>
</html>