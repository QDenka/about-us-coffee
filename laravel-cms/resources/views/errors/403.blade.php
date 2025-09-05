<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ app()->getLocale() == 'vi' ? 'Truy Cập Bị Từ Chối' : 'Access Forbidden' }} - ABOUT US Coffee & Eatery</title>
    <meta name="description" content="{{ app()->getLocale() == 'vi' ? 'Bạn không có quyền truy cập vào trang này. Hãy quay về trang chủ để thưởng thức cà phê đặc biệt tại ABOUT US Coffee.' : 'You do not have permission to access this page. Return to the homepage to enjoy specialty coffee at ABOUT US Coffee.' }}">
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
            border: var(--border-width) solid var(--dark-coffee);
            padding: 4rem 3rem;
            box-shadow: 12px 12px 0 var(--coffee-brown);
            position: relative;
            z-index: 2;
        }

        .error-number {
            font-size: 8rem;
            font-weight: 900;
            color: var(--dark-coffee);
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
            background: var(--dark-coffee);
            color: var(--cream);
            border-color: var(--dark-coffee);
        }

        .error-btn-primary:hover {
            background: var(--coffee-brown);
            border-color: var(--coffee-brown);
            transform: translateY(-2px);
            box-shadow: 4px 4px 0 var(--dark-coffee);
            color: var(--black);
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
            box-shadow: 4px 4px 0 var(--dark-coffee);
        }

        /* Floating Coffee Elements with Lock theme */
        .coffee-bean-bg {
            position: absolute;
            opacity: 0.08;
            pointer-events: none;
        }

        .coffee-bean-bg:nth-child(1) {
            top: 15%;
            left: 15%;
            width: 70px;
            height: 45px;
            animation: float 8s ease-in-out infinite;
        }

        .coffee-bean-bg:nth-child(2) {
            top: 60%;
            right: 20%;
            width: 55px;
            height: 35px;
            animation: float 10s ease-in-out infinite reverse;
        }

        .coffee-bean-bg:nth-child(3) {
            bottom: 25%;
            left: 25%;
            width: 85px;
            height: 50px;
            animation: float 9s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-15px) rotate(8deg); }
        }

        /* Lock Icon */
        .lock-icon {
            position: absolute;
            top: -25px;
            right: -25px;
            width: 70px;
            height: 70px;
            background: var(--dark-coffee);
            border: 4px solid var(--coffee-brown);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            color: var(--cream);
        }

        /* Warning stripes pattern */
        .error-content::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 8px;
            background: repeating-linear-gradient(
                45deg,
                var(--dark-coffee),
                var(--dark-coffee) 10px,
                var(--coffee-brown) 10px,
                var(--coffee-brown) 20px
            );
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
        <!-- Floating Coffee Beans with darker theme -->
        <svg class="coffee-bean-bg" viewBox="0 0 60 40">
            <ellipse cx="30" cy="20" rx="28" ry="18" fill="#3D2817" stroke="#1A1A1A" stroke-width="2"/>
            <path d="M30 5 Q30 20 30 35" stroke="#2A1A0F" stroke-width="2" fill="none" opacity="0.8"/>
        </svg>
        
        <svg class="coffee-bean-bg" viewBox="0 0 60 40">
            <ellipse cx="30" cy="20" rx="28" ry="18" fill="#2A1A0F" stroke="#1A1A1A" stroke-width="2"/>
            <path d="M30 5 Q30 20 30 35" stroke="#1A1A1A" stroke-width="2" fill="none" opacity="0.8"/>
        </svg>
        
        <svg class="coffee-bean-bg" viewBox="0 0 60 40">
            <ellipse cx="30" cy="20" rx="28" ry="18" fill="#4A2F1D" stroke="#1A1A1A" stroke-width="2"/>
            <path d="M30 5 Q30 20 30 35" stroke="#2A1A0F" stroke-width="2" fill="none" opacity="0.8"/>
        </svg>

        <div class="error-content">
            <div class="lock-icon">🔒</div>
            
            <div class="error-number">403</div>
            
            <h1 class="error-title">
                {{ app()->getLocale() == 'vi' ? 'Truy Cập Bị Từ Chối' : 'Access Forbidden' }}
            </h1>
            
            <p class="error-description">
                {{ app()->getLocale() == 'vi' 
                    ? 'Bạn không có quyền truy cập vào khu vực này. Giống như khu vực pha chế chuyên nghiệp của chúng tôi, một số nơi chỉ dành cho nhân viên có thẩm quyền.'
                    : 'You don\'t have permission to access this area. Like our professional brewing station, some areas are reserved for authorized staff only.' 
                }}
            </p>
            
            <div class="error-actions">
                <a href="{{ route('home') }}" class="error-btn error-btn-primary">
                    {{ app()->getLocale() == 'vi' ? '🏠 Về Trang Chủ' : '🏠 Go Home' }}
                </a>
                
                <a href="{{ route('home') }}#contact" class="error-btn error-btn-outline">
                    {{ app()->getLocale() == 'vi' ? '📧 Liên Hệ Hỗ Trợ' : '📧 Contact Support' }}
                </a>
            </div>
        </div>
    </div>
</body>
</html>