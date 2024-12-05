document.getElementById('search').addEventListener('input', function () {
    const query = this.value.toLowerCase();
    const rows = document.querySelectorAll('tbody tr');
    
    rows.forEach(row => {
      const cells = row.querySelectorAll('td');
      const match = Array.from(cells).some(cell => cell.textContent.toLowerCase().includes(query));
      row.style.display = match ? '' : 'none';
    });
  });
  