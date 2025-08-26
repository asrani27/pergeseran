<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Maintenance</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        html,
        body {
            height: 100%;
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #ffffff;
            text-align: center;
            overflow: hidden;
        }

        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(270deg, #1a2a6c, #b21f1f, #fdbb2d);
            background-size: 600% 600%;
            animation: gradientBG 15s ease infinite;
            z-index: -1;
        }

        @keyframes gradientBG {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        .container {
            z-index: 10;
            padding: 2rem;
        }

        h1 {
            font-size: 4rem;
            margin-bottom: 1rem;
        }

        p {
            font-size: 1.25rem;
            margin-bottom: 2rem;
        }

        .timer {
            font-size: 2.5rem;
            font-weight: bold;
            letter-spacing: 2px;
        }

        .label {
            margin-top: 0.5rem;
            font-size: 1rem;
            letter-spacing: 1px;
        }

        .timer-wrapper {
            display: inline-block;
            f
        }

        .timer {
            font-size: 2.5rem;
            font-weight: bold;
            letter-spacing: 5px;
        }

        .label {
            display: flex;
            justify-content: space-between;
            font-size: 1rem;
            margin-top: 0.3rem;
            letter-spacing: 2px;
        }

        .label span {
            flex: 1;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>🚧 Maintenance</h1>
        <p>Situs sedang dalam Pengembangan.<br>Akan selesai beberapa saat lagi.</p>
        {{-- <div class="timer-wrapper">
            <div class="timer" id="countdown">06 : 00 : 00</div>
            <div class="label">
                <span>jam</span>
                <span>menit</span>
                <span>detik</span>
            </div>
        </div> --}}
    </div>

    <script>
        // Set waktu target (6 jam dari sekarang)
        const target = new Date('2025-07-23T13:00:00');


        function updateCountdown() {
            const now = new Date();
            const distance = target - now;

            const hours = String(Math.floor((distance / (1000 * 60 * 60)))).padStart(2, '0');
            const minutes = String(Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60))).padStart(2, '0');
            const seconds = String(Math.floor((distance % (1000 * 60)) / 1000)).padStart(2, '0');

            document.getElementById('countdown').textContent = `${hours} : ${minutes} : ${seconds}`;

            if (distance < 0) {
                document.getElementById('countdown').textContent = '00 : 00 : 00';
                clearInterval(interval);
            }
        }

        const interval = setInterval(updateCountdown, 1000);
        updateCountdown(); // inisialisasi awal
    </script>
</body>

</html>