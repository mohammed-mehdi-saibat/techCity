<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechCity Library System</title>
    <style>
        :root {
            --primary: #2c3e50;
            --secondary: #3498db;
            --success: #27ae60;
            --danger: #e74c3c;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            line-height: 1.6;
            margin: 0;
            background: #f4f7f6;
        }

        nav {
            background: var(--primary);
            color: white;
            padding: 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .container {
            width: 80%;
            margin: 2rem auto;
            background: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .btn {
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            color: white;
        }

        .btn-primary {
            background: var(--secondary);
        }

        .status-badge {
            padding: 0.2rem 0.5rem;
            border-radius: 4px;
            font-size: 0.8rem;
        }

        .available {
            background: #d4edda;
            color: #155724;
        }

        .checked-out {
            background: #f8d7da;
            color: #721c24;
        }

        input[type="text"] {
            padding: 0.5rem;
            width: 300px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
    </style>
</head>

<body>
    <nav>
        <div class="logo"><strong>TechCity</strong> Library</div>
        <div class="menu">
            <a href="index.php" style="color:white; margin-left:15px; text-decoration:none;">Dashboard</a>
        </div>
    </nav>
    <div class="container">