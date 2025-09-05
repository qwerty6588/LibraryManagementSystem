<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Library Auth')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            overflow: hidden;
        }

        canvas#hyperspeed {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1; /* фон под карточкой */
        }

        .auth-card {
            background: rgba(110, 110, 110, 0.9);
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 420px;
            z-index: 1;
            position: relative;
        }

        .auth-title {
            font-weight: bold;
            text-align: center;
            margin-bottom: 1.5rem;
            color: #343a40;
        }

        .auth-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>
<body>

<!-- Hyperspeed background -->
<canvas id="hyperspeed"></canvas>

<div class="auth-wrapper">
    <div class="auth-card">
        <h2 class="auth-title">@yield('title', 'Authentication')</h2>
        @yield('content')
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    const canvas = document.getElementById("hyperspeed");
    const ctx = canvas.getContext("2d");

    let w, h, stars;
    const numStars = 200;

    function init() {
        w = canvas.width = window.innerWidth;
        h = canvas.height = window.innerHeight;
        stars = [];
        for (let i = 0; i < numStars; i++) {
            stars.push({
                x: Math.random() * w - w / 2,
                y: Math.random() * h - h / 2,
                z: Math.random() * w,
                color: `hsl(${Math.random() * 360}, 100%, 70%)`
            });
        }
    }

    function draw() {
        ctx.fillStyle = "black";
        ctx.fillRect(0, 0, w, h);

        for (let i = 0; i < numStars; i++) {
            let star = stars[i];
            star.z -= 2; // скорость движения
            if (star.z <= 0) {
                star.z = w;
                star.color = `hsl(${Math.random() * 360}, 100%, 70%)`; // новая радужная
            }

            let k = 128.0 / star.z;
            let sx = star.x * k + w / 2;
            let sy = star.y * k + h / 2;

            if (sx < 0 || sx >= w || sy < 0 || sy >= h) continue;

            let size = (1 - star.z / w) * 5;
            ctx.beginPath();
            ctx.fillStyle = star.color;
            ctx.shadowBlur = 10;
            ctx.shadowColor = star.color;
            ctx.arc(sx, sy, size, 0, 2 * Math.PI);
            ctx.fill();
        }
        requestAnimationFrame(draw);
    }

    window.addEventListener("resize", init);
    init();
    draw();
</script>
</body>
</html>

