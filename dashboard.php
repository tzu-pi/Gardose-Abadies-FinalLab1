<?php
session_start();

// Redirect to login if no session
if (!isset($_SESSION['name'])) {
    header("Location: index.php");
    exit();
}

$name = $_SESSION['name'];

// Current date and time
$today = date("F j, Y - g:i A");

// Read last visit from cookie (before setting new one)
$lastVisit = isset($_COOKIE['last_visit']) ? $_COOKIE['last_visit'] : null;

// Set / update the last_visit cookie (1-day expiration)
setcookie('last_visit', date("F j, Y - g:i A"), time() + 86400, '/');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard – Daily Check-In Tracker</title>
    <link href="https://fonts.googleapis.com/css2?family=Space+Mono:wght@400;700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg:      #1a1d23;
            --surface: #22262f;
            --border:  #2e3340;
            --accent:  #4f8ef7;
            --accent2: #a78bfa;
            --text:    #e4e8f0;
            --muted:   #7a8299;
            --green:   #34d399;
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            background: var(--bg);
            color: var(--text);
            font-family: 'DM Sans', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-image:
                radial-gradient(ellipse 80% 50% at 20% 10%, rgba(79,142,247,.08) 0%, transparent 60%),
                radial-gradient(ellipse 60% 40% at 80% 90%, rgba(167,139,250,.07) 0%, transparent 60%);
        }

        .card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 2.5rem 2.8rem;
            width: 100%;
            max-width: 460px;
            box-shadow: 0 24px 60px rgba(0,0,0,.4);
            animation: fadeUp .5s ease both;
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: .4rem;
            font-family: 'Space Mono', monospace;
            font-size: .65rem;
            letter-spacing: .15em;
            text-transform: uppercase;
            color: var(--green);
            background: rgba(52,211,153,.1);
            border: 1px solid rgba(52,211,153,.25);
            border-radius: 999px;
            padding: .28rem .75rem;
            margin-bottom: 1.5rem;
        }

        .badge::before {
            content: '';
            display: inline-block;
            width: 6px; height: 6px;
            background: var(--green);
            border-radius: 50%;
        }

        h1 {
            font-size: 1.9rem;
            font-weight: 500;
            margin-bottom: 1.8rem;
        }

        h1 span {
            color: var(--accent);
        }

        .info-block {
            background: var(--bg);
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 1rem 1.2rem;
            margin-bottom: .9rem;
        }

        .info-label {
            font-size: .72rem;
            font-weight: 500;
            letter-spacing: .1em;
            text-transform: uppercase;
            color: var(--muted);
            margin-bottom: .3rem;
        }

        .info-value {
            font-family: 'Space Mono', monospace;
            font-size: .95rem;
            color: var(--text);
        }

        .no-visit {
            font-style: italic;
            color: var(--muted);
            font-family: 'DM Sans', sans-serif;
            font-size: .9rem;
        }

        .logout-btn {
            display: inline-block;
            margin-top: 1.8rem;
            background: transparent;
            color: var(--muted);
            font-family: 'DM Sans', sans-serif;
            font-size: .9rem;
            font-weight: 500;
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: .65rem 1.4rem;
            text-decoration: none;
            transition: color .2s, border-color .2s;
            cursor: pointer;
        }

        .logout-btn:hover {
            color: var(--text);
            border-color: var(--muted);
        }
    </style>
</head>
<body>
<div class="card">
    <div class="badge">Session Active</div>

    <h1>Welcome, <span><?= $name ?></span>!</h1>

    <div class="info-block">
        <div class="info-label">Today is</div>
        <div class="info-value"><?= $today ?></div>
    </div>

    <div class="info-block">
        <div class="info-label">Your last visit was</div>
        <div class="info-value">
            <?php if ($lastVisit): ?>
                <?= htmlspecialchars($lastVisit) ?>
            <?php else: ?>
                <span class="no-visit">No previous visit recorded.</span>
            <?php endif; ?>
        </div>
    </div>

    <a href="logout.php" class="logout-btn">Logout →</a>
</div>
</body>
</html>
