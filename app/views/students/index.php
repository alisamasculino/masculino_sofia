<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>STUDENT'S LIST</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body::before {
      content: "";
      position: fixed;
      inset: 0;
      background: rgba(0, 0, 50, 0.5);
      z-index: 0;
    }
    #app {
      position: relative;
      z-index: 1;
    }
    .overflow-x-auto::-webkit-scrollbar {
      height: 8px;
    }
    .overflow-x-auto::-webkit-scrollbar-track {
      background: transparent;
    }
    .overflow-x-auto::-webkit-scrollbar-thumb {
      background-color: #4f46e5;
      border-radius: 4px;
    }
  </style>
</head>
<body
  class="min-h-screen flex items-center justify-center p-6 bg-cover bg-center relative"
  style="background-image: url('https://i.pinimg.com/originals/5e/aa/8e/5eaa8e51ed6d41bc1516bd610d191ee1.gif');"
>
  <div id="app" class="relative w-full max-w-6xl rounded-2xl shadow-2xl p-8 flex flex-col gap-10">
    <h1 class="text-4xl font-extrabold text-white text-center tracking-wide drop-shadow-md">
      STUDENT'S RECORDS
    </h1>

    <!-- TABLE LIST -->
    <section class="bg-indigo-50 rounded-xl p-6 shadow-md overflow-x-auto">
      <div class="flex flex-col sm:flex-row justify-between items-center mb-6 border-b border-indigo-300 pb-2 gap-4 w-full">
        <h2 class="text-2xl font-semibold text-indigo-800 text-center sm:text-left">Students List</h2>
        
        <!-- Right side: Search + Create button -->
        <div class="flex flex-col sm:flex-row items-center gap-3 w-full sm:w-auto justify-end">
          <input id="searchInput" type="text" placeholder="Search students..." 
            class="w-full sm:w-64 px-4 py-2 border border-indigo-300 rounded-lg focus:ring focus:ring-indigo-400 focus:outline-none"/>
          <a href="<?=site_url('students/create');?>" 
            class="inline-block bg-indigo-900 text-white font-semibold px-5 py-2 rounded-lg shadow hover:bg-indigo-800 transition duration-200">
            + Create New Account
          </a>
        </div>
      </div>

      <table id="studentTable" class="w-full border-collapse text-indigo-900 min-w-[600px]">
        <thead class="bg-indigo-500 text-white select-none">
          <tr>
            <th class="px-6 py-3 text-left text-sm font-semibold uppercase tracking-wide">ID</th>
            <th class="px-6 py-3 text-left text-sm font-semibold uppercase tracking-wide">First Name</th>
            <th class="px-6 py-3 text-left text-sm font-semibold uppercase tracking-wide">Last Name</th>
            <th class="px-6 py-3 text-left text-sm font-semibold uppercase tracking-wide">Email</th>
            <th class="px-6 py-3 text-left text-sm font-semibold uppercase tracking-wide">Actions</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-indigo-300 bg-indigo-50">
          <?php foreach (html_escape($users) as $user): ?>
          <tr class="hover:bg-indigo-100 transition duration-200 cursor-default">
            <td class="px-6 py-4 text-sm font-medium"><?= ($user['id']);?></td>
            <td class="px-6 py-4 text-sm"><?= ($user['first_name']);?></td>
            <td class="px-6 py-4 text-sm"><?= ($user['last_name']);?></td>
            <td class="px-6 py-4 text-sm break-all"><?= ($user['email']);?></td>
            <td class="px-6 py-4 text-sm space-x-3 flex flex-wrap gap-2">
              <a href="<?=site_url('students/update/'.$user['id']);?>" 
                class="text-indigo-700 hover:text-indigo-900 font-semibold transition duration-150 px-3 py-1 border border-indigo-700 rounded-lg hover:bg-indigo-100">
                Update
              </a>
              <a href="<?=site_url('students/delete/'.$user['id']);?>" 
                onclick="return confirm('Are you sure you want to delete this record?');"
                class="text-red-600 hover:text-red-800 font-semibold transition duration-150 px-3 py-1 border border-red-600 rounded-lg hover:bg-red-100">
                Delete
              </a>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>

      <!-- Pagination Controls -->
      <div id="pagination" class="flex justify-center mt-6 space-x-2"></div>
    </section>
  </div>

  <script>
    const rowsPerPage = 5;
    const rows = document.querySelectorAll("#studentTable tbody tr");
    const pagination = document.getElementById("pagination");
    const searchInput = document.getElementById("searchInput");
    let currentPage = 1;

    function getFilteredRows() {
      let filter = searchInput.value.toLowerCase();
      return Array.from(rows).filter(row => row.innerText.toLowerCase().includes(filter));
    }

    function displayRows(page) {
      let filteredRows = getFilteredRows();
      let start = (page - 1) * rowsPerPage;
      let end = start + rowsPerPage;

      rows.forEach(row => row.style.display = "none");
      filteredRows.forEach((row, index) => {
        if (index >= start && index < end) row.style.display = "";
      });
    }

    function setupPagination() {
      pagination.innerHTML = "";
      let filteredRows = getFilteredRows();
      let pageCount = Math.ceil(filteredRows.length / rowsPerPage);

      if (pageCount === 0) return;

      // Prev button
      let prevBtn = document.createElement("button");
      prevBtn.innerHTML = "&#8592; Prev";
      prevBtn.className = "px-3 py-1 border rounded-lg text-indigo-700 bg-white hover:bg-indigo-100 disabled:opacity-50";
      prevBtn.disabled = currentPage === 1;
      prevBtn.addEventListener("click", () => {
        if (currentPage > 1) {
          currentPage--;
          displayRows(currentPage);
          setupPagination();
        }
      });
      pagination.appendChild(prevBtn);

      // Page numbers
      for (let i = 1; i <= pageCount; i++) {
        let btn = document.createElement("button");
        btn.innerText = i;
        btn.className = "px-3 py-1 border rounded-lg text-indigo-700 bg-white hover:bg-indigo-100 " +
                        (i === currentPage ? "bg-indigo-200 font-bold" : "");
        btn.addEventListener("click", () => {
          currentPage = i;
          displayRows(currentPage);
          setupPagination();
        });
        pagination.appendChild(btn);
      }

      // Next button
      let nextBtn = document.createElement("button");
      nextBtn.innerHTML = "Next &#8594;";
      nextBtn.className = "px-3 py-1 border rounded-lg text-indigo-700 bg-white hover:bg-indigo-100 disabled:opacity-50";
      nextBtn.disabled = currentPage === pageCount;
      nextBtn.addEventListener("click", () => {
        if (currentPage < pageCount) {
          currentPage++;
          displayRows(currentPage);
          setupPagination();
        }
      });
      pagination.appendChild(nextBtn);
    }

    function refreshTable() {
      currentPage = 1;
      displayRows(currentPage);
      setupPagination();
    }

    // Event: Search input
    searchInput.addEventListener("keyup", refreshTable);

    // Initialize
    refreshTable();
  </script>
</body>
</html>
