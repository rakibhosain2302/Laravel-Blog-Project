<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 Error Page</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background: #0f0f0f;
            color: #fff;
            font-family: 'Poppins', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
        }

        h1 {
            font-size: 8rem;
            margin: 0;
            color: #ff4c4c;
            animation: glow 2s infinite alternate;
        }

        @keyframes glow {
            from {
                text-shadow: 0 0 10px #ff4c4c;
            }

            to {
                text-shadow: 0 0 30px #ff0000, 0 0 60px #ff4c4c;
            }
        }

        .typewriter {
            font-size: 1.5rem;
            border-right: 2px solid #fff;
            white-space: nowrap;
            overflow: hidden;
            width: 0;
            animation: typing 4s steps(30, end) forwards, blink 0.7s infinite;
        }

        @keyframes typing {
            from {
                width: 0;
            }

            to {
                width: 22ch;
            }
        }

        @keyframes blink {
            50% {
                border-color: transparent;
            }
        }

        button {
            margin-top: 20px;
            padding: 10px 20px;
            background: #ff4c4c;
            border: none;
            color: #fff;
            font-size: 1rem;
            cursor: pointer;
            border-radius: 5px;
            transition: 0.3s;
        }

        button:hover {
            background: #ff0000;
            transform: scale(1.1);
        }
    </style>
</head>

<body>
    <h1>404</h1>
    <div class="typewriter">Oops! Page Not Found...</div>
    <p style="margin:20px 0;color:#64748b;font-size:18px;">
        Sorry! The page you are looking for doesn't exist or you don't have permission to access it.
    </p>

    <button onclick="goHome()">Go Home</button>

    <script>
        function goHome() {
            window.location.href = "{{ route('dashbord') }}";
        }
    </script>
</body>

</html>
