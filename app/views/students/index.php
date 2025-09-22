<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Records</title>
    <style>
        /* Body */
        body {
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #f5f1e9, #e2d6c8);
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            color: #3b2f2f;
        }

        /* Header/Navbar */
        header {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            padding: 15px 40px;
            background: rgba(59, 47, 47, 0.1);
            backdrop-filter: blur(8px);
            box-shadow: 0 4px 12px rgba(59, 47, 47, 0.2);
            position: sticky;
            top: 0;
            z-index: 10;
        }

        header h1 {
            font-size: 2rem;
            font-weight: 700;
            letter-spacing: 1px;
            margin: 0;
            color: #3b2f2f;
        }

        .nav {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 12px;
        }

        .nav a {
            color: #fff;
            text-decoration: none;
            font-weight: 600;
            padding: 8px 16px;
            border-radius: 12px;
            background: #8b5e3c;
            transition: all 0.3s ease;
        }

        .nav a:hover {
            background: #a17459;
            transform: translateY(-2px);
        }

        .nav input[type="text"] {
            padding: 8px 12px;
            border-radius: 12px;
            border: 1px solid #8b5e3c;
            outline: none;
            font-size: 1rem;
            width: 180px;
            background: #f5f1e9;
            color: #3b2f2f;
        }

        /* Main app container */
        .app {
            padding: 60px 20px 40px;
            max-width: 1200px;
            margin: 0 auto;
            text-align: center;
        }

        h2 {
            font-size: 2rem;
            margin-bottom: 40px;
            font-weight: 700;
            letter-spacing: 1px;
            color: #3b2f2f;
        }

        /* Students list */
        .students-list {
            display: flex;
            flex-wrap: wrap;
            gap: 28px;
            justify-content: center;
        }

        .student-container {
            border-radius: 18px;
            background: rgba(255, 255, 255, 0.6);
            backdrop-filter: blur(6px);
            width: 280px;
            padding: 28px;
            box-shadow: 0 8px 20px rgba(59, 47, 47, 0.25);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .student-container:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 26px rgba(59, 47, 47, 0.35);
        }

        .student-name {
            font-size: 1.4rem;
            font-weight: 600;
            color: #3b2f2f;
            margin-bottom: 6px;
        }

        .student-email {
            font-size: 1.1rem;
            color: #8b5e3c;
            margin-bottom: 12px;
            word-break: break-word;
        }

        .actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            justify-content: center;
        }

        .action-button {
            background: #8b5e3c;
            border: none;
            border-radius: 10px;
            padding: 10px 18px;
            color: #fff;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }

        .action-button:hover {
            background: #a17459;
            transform: translateY(-2px);
        }

        .delete-button {
            background: #d9774f;
            box-shadow: 0 4px 12px rgba(217, 119, 79, 0.3);
        }

        .delete-button:hover {
            background: #f0a472;
        }

        @media (max-width: 600px) {
            .student-container {
                width: 100%;
            }

            .nav {
                width: 100%;
                justify-content: center;
                gap: 10px;
            }

            .nav input[type="text"] {
                width: 100%;
                max-width: 250px;
            }
        }

        /* Footer */
        footer {
            margin-top: 60px;
            padding: 20px;
            text-align: center;
            color: #3b2f2f;
            font-size: 0.9rem;
            background: rgba(235, 225, 210, 0.5);
            backdrop-filter: blur(6px);
            border-top-left-radius: 20px;
            border-top-right-radius: 20px;
        }

        footer p {
            margin: 6px 0;
        }
    </style>
</head>
<body>
    <!-- Header/Navbar -->
    <header>
        <h1>Student Management</h1>
        <div class="nav">
            <a href="<?= site_url('students/create'); ?>">Add Record</a>
            <input type="text" id="searchInput" placeholder="Search students...">
        </div>
    </header>

    <!-- Students List -->
    <div style="height: 50px;"></div>
    <div class="students-list">
        <?php foreach (html_escape($users) as $user): ?>
            <div class="student-container">
                <div>
                    <div class="student-name"><?= $user['first_name'] ?> <?= $user['last_name'] ?></div>
                    <div class="student-email"><?= $user['email'] ?></div>
                </div>
                <div class="actions">
                    <a href="<?= site_url('students/update/'.$user['id']); ?>" class="action-button">Update</a>
                    <a href="<?= site_url('students/delete/'.$user['id']); ?>" onclick="return confirm('Are you sure?');" class="action-button delete-button">Delete</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; <?= date('Y'); ?> Student Management System</p>
        <p>BSIT 3F2 Students | Mindoro State University</p>
    </footer>

    <!-- Search JS -->
    <script>
        const searchInput = document.getElementById('searchInput');
        const students = document.querySelectorAll('.student-container');

        searchInput.addEventListener('keyup', function() {
            const filter = this.value.toLowerCase();
            students.forEach(student => {
                student.style.display = student.innerText.toLowerCase().includes(filter) ? '' : 'none';
            });
        });
    </script>
</body>
</html>
