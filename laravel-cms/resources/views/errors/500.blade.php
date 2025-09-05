<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ app()->getLocale() == 'vi' ? 'Lỗi Máy Chủ Nội Bộ' : 'Internal Server Error' }} - ABOUT US Coffee & Eatery</title>
    <meta name="description" content="{{ app()->getLocale() == 'vi' ? 'Đã xảy ra lỗi máy chủ. Chúng tôi đang khắc phục sự cố. Hãy quay lại sau để thưởng thức cà phê tại ABOUT US Coffee.' : 'A server error has occurred. We are working to fix the issue. Please come back later to enjoy coffee at ABOUT US Coffee.' }}">
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
            max-width: 650px;
            background: var(--black);
            border: var(--border-width) solid #DC2626;
            padding: 4rem 3rem;
            box-shadow: 12px 12px 0 var(--dark-coffee);
            position: relative;
            z-index: 2;
        }

        .error-number {
            font-size: 8rem;
            font-weight: 900;
            color: #DC2626;
            margin-bottom: 1rem;
            font-family: 'Space Grotesk', sans-serif;
            line-height: 1;
            text-shadow: 4px 4px 0 var(--dark-coffee);
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
            background: #DC2626;
            color: var(--cream);
            border-color: #DC2626;
        }

        .error-btn-primary:hover {
            background: #EF4444;
            border-color: #EF4444;
            transform: translateY(-2px);
            box-shadow: 4px 4px 0 var(--dark-coffee);
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

        /* Broken coffee machine theme */
        .coffee-bean-bg {
            position: absolute;
            opacity: 0.06;
            pointer-events: none;
            filter: grayscale(0.3);
        }

        .coffee-bean-bg:nth-child(1) {
            top: 20%;
            left: 10%;
            width: 90px;
            height: 55px;
            animation: glitch 4s ease-in-out infinite;
        }

        .coffee-bean-bg:nth-child(2) {
            top: 50%;
            right: 10%;
            width: 70px;
            height: 45px;
            animation: glitch 6s ease-in-out infinite reverse;
        }

        .coffee-bean-bg:nth-child(3) {
            bottom: 30%;
            left: 20%;
            width: 110px;
            height: 65px;
            animation: glitch 5s ease-in-out infinite;
        }

        @keyframes glitch {
            0%, 100% { transform: translateY(0) rotate(0deg) skew(0deg); }
            20% { transform: translateY(-10px) rotate(2deg) skew(1deg); }
            40% { transform: translateY(5px) rotate(-1deg) skew(-0.5deg); }
            60% { transform: translateY(-5px) rotate(1deg) skew(0.5deg); }
            80% { transform: translateY(8px) rotate(-2deg) skew(-1deg); }
        }

        /* Broken Machine Icon */
        .machine-icon {
            position: absolute;
            top: -30px;
            right: -30px;
            width: 80px;
            height: 80px;
            background: #DC2626;
            border: 4px solid var(--dark-coffee);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: var(--cream);
            animation: pulse 2s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }

        /* Error stripes pattern */
        .error-content::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 8px;
            background: repeating-linear-gradient(
                45deg,
                #DC2626,
                #DC2626 10px,
                #B91C1C 10px,
                #B91C1C 20px
            );
        }

        /* Loading indicator for "fixing" */
        .fixing-indicator {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            margin-top: 1rem;
            color: var(--concrete);
            font-size: 0.9rem;
        }

        .fixing-dots {
            display: flex;
            gap: 3px;
        }

        .fixing-dots span {
            width: 6px;
            height: 6px;
            background: var(--primary);
            border-radius: 50%;
            animation: fixing 1.5s ease-in-out infinite;
        }

        .fixing-dots span:nth-child(2) {
            animation-delay: 0.3s;
        }

        .fixing-dots span:nth-child(3) {
            animation-delay: 0.6s;
        }

        @keyframes fixing {
            0%, 60%, 100% { opacity: 0.3; }
            30% { opacity: 1; }
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
        <!-- Glitchy Coffee Beans -->
        <svg class="coffee-bean-bg" viewBox="0 0 60 40">
            <ellipse cx="30" cy="20" rx="28" ry="18" fill="#DC2626" stroke="#1A1A1A" stroke-width="2" opacity="0.7"/>
            <path d="M30 5 Q30 20 30 35" stroke="#B91C1C" stroke-width="2" fill="none" opacity="0.5"/>
        </svg>
        
        <svg class="coffee-bean-bg" viewBox="0 0 60 40">
            <ellipse cx="30" cy="20" rx="28" ry="18" fill="#7F1D1D" stroke="#1A1A1A" stroke-width="2" opacity="0.7"/>
            <path d="M30 5 Q30 20 30 35" stroke="#991B1B" stroke-width="2" fill="none" opacity="0.5"/>
        </svg>
        
        <svg class="coffee-bean-bg" viewBox="0 0 60 40">
            <ellipse cx="30" cy="20" rx="28" ry="18" fill="#A51E1E" stroke="#1A1A1A" stroke-width="2" opacity="0.7"/>
            <path d="M30 5 Q30 20 30 35" stroke="#7F1D1D" stroke-width="2" fill="none" opacity="0.5"/>
        </svg>

        <div class="error-content">
            <div class="machine-icon">⚡</div>
            
            <div class="error-number">500</div>
            
            <h1 class="error-title">
                {{ app()->getLocale() == 'vi' ? 'Máy Pha Gặp Sự Cố' : 'Brewing Machine Error' }}
            </h1>
            
            <p class="error-description">
                {{ app()->getLocale() == 'vi' 
                    ? 'Máy chủ của chúng tôi đang gặp sự cố, giống như khi máy pha cà phê bị trục trặc. Đội ngũ kỹ thuật đang khẩn cấp khắc phục để đảm bảo bạn sớm có thể thưởng thức cà phê tuyệt vời nhất.'
                    : 'Our server is experiencing issues, just like when our coffee machine breaks down. Our technical team is urgently working to fix it so you can enjoy the best coffee soon.' 
                }}
            </p>
            
            <div class="fixing-indicator">
                <span>{{ app()->getLocale() == 'vi' ? 'Đang sửa chữa' : 'Fixing in progress' }}</span>
                <div class="fixing-dots">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
            
            <div class="error-actions">
                <a href="{{ route('home') }}" class="error-btn error-btn-primary">
                    {{ app()->getLocale() == 'vi' ? '🏠 Về Trang Chủ' : '🏠 Go Home' }}
                </a>
                
                <a href="javascript:window.location.reload()" class="error-btn error-btn-outline">
                    {{ app()->getLocale() == 'vi' ? '🔄 Thử Lại' : '🔄 Try Again' }}
                </a>
            </div>
        </div>
    </div>

    <script>
        // Auto-refresh after 30 seconds
        setTimeout(function() {
            window.location.reload();
        }, 30000);
    </script>
</body>
</html>