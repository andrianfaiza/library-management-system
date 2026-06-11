<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login - E-Library</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: radial-gradient(circle at 30% 20%, #4f46e5 0%, #1e1b4b 100%);
            font-family: 'Plus Jakarta Sans', sans-serif;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            position: relative;
        }

        /* Ambient background blobs */
        body::before {
            content: '';
            position: absolute;
            width: 400px;
            height: 400px;
            background: linear-gradient(135deg, #a5b4fc, #6366f1);
            border-radius: 50%;
            top: -100px;
            right: -100px;
            filter: blur(100px);
            opacity: 0.3;
            z-index: 1;
        }

        body::after {
            content: '';
            position: absolute;
            width: 350px;
            height: 350px;
            background: linear-gradient(135deg, #ec4899, #f43f5e);
            border-radius: 50%;
            bottom: -80px;
            left: -80px;
            filter: blur(80px);
            opacity: 0.2;
            z-index: 1;
        }

        .login-container {
            width: 440px;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            padding: 50px 45px;
            border-radius: 24px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.2);
            z-index: 10;
            animation: slideUp 0.6s cubic-bezier(0.16, 1, 0.3, 1);
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(40px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login {
            text-align: center;
        }

        .login-logo {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, #e0e7ff 0%, #c7d2fe 100%);
            border-radius: 20px;
            margin-bottom: 24px;
            box-shadow: 0 8px 16px rgba(99, 102, 241, 0.15);
        }

        .login-logo i {
            font-size: 32px;
            background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        h2 {
            margin-bottom: 8px;
            color: #0f172a;
            font-size: 28px;
            font-weight: 800;
            letter-spacing: -0.03em;
        }

        .subtitle {
            color: #64748b;
            margin-bottom: 35px;
            font-size: 14px;
            font-weight: 500;
        }

        .login-group {
            margin-bottom: 24px;
            text-align: left;
        }

        label {
            display: block;
            font-weight: 700;
            margin-bottom: 8px;
            color: #1e293b;
            font-size: 13px;
            letter-spacing: -0.01em;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 14px 16px;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-size: 14px;
            font-family: inherit;
            color: #0f172a;
            transition: all 0.3s ease;
            background-color: #f8fafc;
        }

        input[type="text"]:focus,
        input[type="password"]:focus {
            outline: none;
            border-color: #6366f1;
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.15);
            background-color: white;
        }

        input[type="text"]::placeholder,
        input[type="password"]::placeholder {
            color: #94a3b8;
        }

        .btn-submit {
            background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
            color: white;
            padding: 14px 20px;
            border: none;
            width: 100%;
            border-radius: 12px;
            cursor: pointer;
            font-weight: 700;
            font-size: 15px;
            font-family: inherit;
            transition: all 0.3s ease;
            margin-top: 10px;
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.2);
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(99, 102, 241, 0.35);
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        @media (max-width: 480px) {
            .login-container {
                width: 90%;
                padding: 40px 24px;
            }

            h2 {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login">
            <div class="login-logo">
                <i class="fas fa-book-open"></i>
            </div>
            <h2>E-Library System</h2>
            <p class="subtitle">Welcome back! Please login to continue.</p>
            <form action="{{route('login')}}" method="POST">
                @csrf
                <div class="login-group">
                    <label for="email">Email Address</label>
                    <input type="text" class="email" id="email" name="email" placeholder="name@example.com" required>
                </div>
                <div class="login-group">
                    <label for="password">Password</label>
                    <input type="password" class="password" id="password" name="password" placeholder="Enter your password" required>
                </div>
                <button type="submit" class="btn-submit">Sign In</button>
            </form>
        </div>
    </div>
</body>
</html>