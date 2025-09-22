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

    /* Students list */
    .students-list {
      display: flex;
      flex-wrap: wrap;
      gap: 28px;
      justify-content: center;
      margin: 40px auto;
      max-width: 1200px;
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

    /* Pagination */
    .pagination {
      display: flex;
      justify-content: center;
      margin: 20px 0 50px;
      gap: 6px;
      flex-wrap: wrap;
    }

    .pagination button {
      border: 1px solid #8b5e3c;
      background: #fff;
      color: #3b2f2f;
      padding: 6px 12px;
      border-radius: 8px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .pagination button:hover {
      background: #f5f1e9;
    }

    .pagination .active {
      background: #8b5e3c;
      color: #fff;
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
  <div class="students-list" id="studentsList">
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

  <!-- Pagination -->
  <div id="pagination" class="pagination"></div>

  <!-- Footer -->
  <footer>
    <p>&copy; <?= date('Y'); ?> Student Management System</p>
    <p>BSIT 3F2 Students | Mindoro State University</p>
  </footer>

  <!-- JS -->
  <script>
    const students = Array.from(document.querySelectorAll('.student-container'));
    const searchInput = document.getElementById('searchInput');
    const pagination = document.getElementById('pagination');
    const studentsList = document.getElementById('studentsList');
    const rowsPerPage = 6;
    let currentPage = 1;

    function getFilteredStudents() {
      let filter = searchInput.value.toLowerCase();
      return students.filter(student => student.innerText.toLowerCase().includes(filter));
    }

    function displayStudents(page) {
      let filtered = getFilteredStudents();
      let start = (page - 1) * rowsPerPage;
      let end = start + rowsPerPage;

      students.forEach(st => st.style.display = 'none');
      filtered.forEach((st, i) => {
        if (i >= start && i < end) st.style.display = 'flex';
      });
    }

    function setupPagination() {
      pagination.innerHTML = '';
      let filtered = getFilteredStudents();
      let pageCount = Math.ceil(filtered.length / rowsPerPage);

      if (pageCount <= 1) return;

      // Prev button
      let prev = document.createElement('button');
      prev.innerHTML = '⟨';
      prev.disabled = currentPage === 1;
      prev.addEventListener('click', () => {
        if (currentPage > 1) {
          currentPage--;
          refresh();
        }
      });
      pagination.appendChild(prev);

      // Numbered buttons
      for (let i = 1; i <= pageCount; i++) {
        let btn = document.createElement('button');
        btn.innerText = i;
        btn.className = (i === currentPage ? 'active' : '');
        btn.addEventListener('click', () => {
          currentPage = i;
          refresh();
        });
        pagination.appendChild(btn);
      }

      // Next button
      let next = document.createElement('button');
      next.innerHTML = '⟩';
      next.disabled = currentPage === pageCount;
      next.addEventListener('click', () => {
        if (currentPage < pageCount) {
          currentPage++;
          refresh();
        }
      });
      pagination.appendChild(next);
    }

    function refresh() {
      displayStudents(currentPage);
      setupPagination();
    }

    searchInput.addEventListener('keyup', () => {
      currentPage = 1;
      refresh();
    });

    refresh();
  </script>
</body>
</html>
