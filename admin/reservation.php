<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
  
<?php
if (session_status() !== PHP_SESSION_ACTIVE) session_start();
$userName = htmlspecialchars($_SESSION['user_name'] ?? 'Admin', ENT_QUOTES, 'UTF-8');
$avatar = htmlspecialchars($_SESSION['user_avatar'] ?? '../images/admin.jpg', ENT_QUOTES, 'UTF-8');
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Reservations — Admin — Afrique Hotel</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <style>
    :root{
      --sb-width: 260px;
      --sb-collapsed: 72px;
      --sb-bg: linear-gradient(180deg,#071025,#081232);
      --accent: #7c3aed;
      --muted: #9aa6bd;
      --glass: rgba(255,255,255,0.02);
      --text: #e8f0ff;

      --page-bg: linear-gradient(180deg,#051226,#081428);
      --card-bg: linear-gradient(180deg, rgba(255,255,255,0.02), rgba(255,255,255,0.01));
      --accent-2: #06b6d4;
    }

    *{box-sizing:border-box}
    html,body{height:100%;margin:0;font-family:Inter,system-ui,Segoe UI,Roboto,Arial;background:var(--page-bg);color:var(--text);-webkit-font-smoothing:antialiased}
    a{color:inherit;text-decoration:none}

    /* main content area: leaves room for fixed sidebar/topnav */
    .main-wrap{
      max-width:1200px;
      margin:28px auto;
      padding:18px;
      margin-left: calc(var(--sb-width) + 28px);
      margin-top:78px;
      transition: margin-left .22s ease;
    }
    @media (max-width:920px){
      .main-wrap{ margin-left:18px; margin-right:18px; margin-top:86px; }
    }

    .page-header{display:flex;align-items:center;justify-content:space-between;gap:12px;margin-bottom:18px}
    .title{display:flex;gap:12px;align-items:center}
    .title .logo{width:52px;height:52px;border-radius:10px;background:linear-gradient(135deg,var(--accent),var(--accent-2));display:grid;place-items:center;font-weight:800;color:white;font-size:18px}
    .title h1{margin:0;font-size:20px}
    .title p{margin:0;color:var(--muted);font-size:13px}

    .controls{display:flex;gap:8px;align-items:center}
    .btn{padding:8px 12px;border-radius:10px;border:0;background:transparent;color:var(--text);cursor:pointer}
    .btn-primary{background:linear-gradient(90deg,var(--accent),var(--accent-2));color:white}
    .btn-ghost{border:1px solid rgba(255,255,255,0.04)}

    .bar{display:flex;gap:12px;align-items:center;margin-bottom:16px;flex-wrap:wrap}
    .search{flex:1;display:flex;align-items:center;background:var(--glass);padding:8px;border-radius:10px;border:1px solid rgba(255,255,255,0.02)}
    .search input{flex:1;border:0;background:transparent;color:var(--text);outline:none;padding:6px 8px}
    .filters{display:flex;gap:8px;align-items:center}

    /* reservations table */
    .table{width:100%;border-collapse:collapse;font-size:14px}
    .table thead th{background:rgba(255,255,255,0.02);padding:12px;text-align:left;color:var(--muted);font-weight:700;border-bottom:1px solid rgba(255,255,255,0.03)}
    .table tbody td{padding:12px;border-bottom:1px dashed rgba(255,255,255,0.02);vertical-align:middle}
    .guest{display:flex;align-items:center;gap:12px}
    .avatar{width:44px;height:44;border-radius:8px;object-fit:cover;border:2px solid rgba(255,255,255,0.03)}
    .status{padding:6px 10px;border-radius:999px;font-weight:700;font-size:13px}
    .status.booked{background:rgba(124,58,237,0.12);color:var(--accent)}
    .status.checked{background:rgba(6,182,212,0.08);color:var(--accent-2)}
    .status.cancel{background:rgba(239,68,68,0.08);color:#ff7b7b}

    .actions{display:flex;gap:8px}
    .icon-small{padding:8px;border-radius:8px;background:rgba(255,255,255,0.02);cursor:pointer;border:0;color:var(--text)}
    .muted{color:var(--muted);font-size:13px}

    /* compact cards for mobile */
    .cards{display:none;gap:12px}
    .card{background:var(--card-bg);padding:12px;border-radius:12px;box-shadow:0 8px 24px rgba(2,6,23,0.5)}
    .card .row{display:flex;justify-content:space-between;align-items:center;margin-top:8px}

    @media (max-width:820px){
      .table{display:none}
      .cards{display:flex;flex-direction:column}
    }

    /* modal */
    .modal{position:fixed;inset:0;display:none;align-items:center;justify-content:center;background:rgba(2,6,23,0.6);z-index:1400;padding:20px}
    .modal.open{display:flex}
    .modal-dialog{width:100%;max-width:720px;background:var(--card-bg);border-radius:12px;padding:18px;box-shadow:0 20px 60px rgba(2,6,23,0.6)}
    .form-row{display:flex;gap:10px;margin-bottom:10px}
    .form-row input,.form-row select,textarea{flex:1;padding:10px;border-radius:8px;border:0;background:rgba(255,255,255,0.01);color:var(--text);outline:none}
    textarea{min-height:90px}

    .small{font-size:13px;color:var(--muted)}
  </style>
</head>
<body>
  <?php
    include('topnav.php');
    include('sidebar.php');
  ?>

  <main class="main-wrap" role="main" aria-label="Reservations admin">
    <header class="page-header">
      <div class="title">
        <div class="logo">AH</div>
        <div>
          <h1>Reservations</h1>
          <p class="small">Manage bookings, check-ins and payments</p>
        </div>
      </div>

      <div class="controls">
        <div class="small">Signed in as <strong><?= $userName ?></strong></div>
        <button class="btn btn-ghost" id="refreshBtn"><i class="fa-solid fa-arrows-rotate"></i></button>
        <button class="btn btn-primary" id="newResBtn"><i class="fa-solid fa-plus"></i> New Reservation</button>
      </div>
    </header>

    <div class="bar">
      <div class="search" role="search">
        <input id="resSearch" type="search" placeholder="Search by guest, room, ref or date..." aria-label="Search reservations">
        <button class="btn" id="doSearch"><i class="fa-solid fa-magnifying-glass"></i></button>
      </div>

      <div class="filters">
        <select id="statusFilter" class="small" aria-label="Filter status">
          <option value="">All status</option>
          <option value="booked">Booked</option>
          <option value="checked">Checked-in</option>
          <option value="cancel">Cancelled</option>
        </select>

        <select id="sortBy" class="small" aria-label="Sort">
          <option value="new">Newest</option>
          <option value="date_asc">Date ↑</option>
          <option value="date_desc">Date ↓</option>
        </select>
      </div>
    </div>

    <!-- Table for desktop -->
    <div class="table-wrap">
      <table class="table" role="table" aria-label="Reservations list">
        <thead>
          <tr>
            <th>Guest</th>
            <th>Room</th>
            <th>Dates</th>
            <th>Amount</th>
            <th>Status</th>
            <th class="small">Actions</th>
          </tr>
        </thead>
        <tbody id="resList">
          <tr data-status="booked" data-date="2025-11-10" data-ref="R-204">
            <td>
              <div class="guest"><img class="avatar" src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?q=80&w=800&auto=format&fit=crop" alt="Guest">
                <div><strong>John Doe</strong><div class="muted">john@example.com</div></div>
              </div>
            </td>
            <td>Deluxe 101</td>
            <td><div class="muted">Nov 10 — Nov 13</div></td>
            <td><strong>$360</strong></td>
            <td><div class="status booked">Booked</div></td>
            <td>
              <div class="actions">
                <button class="icon-small" title="View"><i class="fa-solid fa-eye"></i></button>
                <button class="icon-small" title="Check-in"><i class="fa-solid fa-sign-in-alt"></i></button>
                <button class="icon-small" title="Cancel"><i class="fa-solid fa-ban"></i></button>
              </div>
            </td>
          </tr>

          <tr data-status="checked" data-date="2025-11-01" data-ref="R-190">
            <td>
              <div class="guest"><img class="avatar" src="../images/WIN_20250520_16_09_33_Pro.jpg" alt="Guest">
                <div><strong>Jane Smith</strong><div class="muted">jane@example.com</div></div>
              </div>
            </td>
            <td>Suite 203</td>
            <td><div class="muted">Nov 1 — Nov 5</div></td>
            <td><strong>$880</strong></td>
            <td><div class="status checked">Checked-in</div></td>
            <td>
              <div class="actions">
                <button class="icon-small" title="View"><i class="fa-solid fa-eye"></i></button>
                <button class="icon-small" title="Checkout"><i class="fa-solid fa-sign-out-alt"></i></button>
                <button class="icon-small" title="Receipt"><i class="fa-solid fa-receipt"></i></button>
              </div>
            </td>
          </tr>

          <tr data-status="cancel" data-date="2025-10-28" data-ref="R-176">
            <td>
              <div class="guest"><img class="avatar" src="https://images.unsplash.com/photo-1547425260-76bcadfb4f2c?q=80&w=800&auto=format&fit=crop" alt="Guest">
                <div><strong>Samuel Lee</strong><div class="muted">samuel@example.com</div></div>
              </div>
            </td>
            <td>Standard 5</td>
            <td><div class="muted">Oct 28 — Oct 30</div></td>
            <td><strong>$170</strong></td>
            <td><div class="status cancel">Cancelled</div></td>
            <td>
              <div class="actions">
                <button class="icon-small" title="View"><i class="fa-solid fa-eye"></i></button>
                <button class="icon-small" title="Restore"><i class="fa-solid fa-undo"></i></button>
              </div>
            </td>
          </tr>
        </tbody>
      </table>

      <!-- Cards for mobile -->
      <div class="cards" id="cardsList">
        <div class="card" data-status="booked" data-date="2025-11-10">
          <div style="display:flex;gap:12px;align-items:center">
            <img class="avatar" src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?q=80&w=800&auto=format&fit=crop" alt="Guest">
            <div>
              <strong>John Doe</strong>
              <div class="muted">Deluxe 101 • Nov 10 — Nov 13</div>
            </div>
          </div>
          <div class="row">
            <div class="small muted">R-204</div>
            <div><div class="status booked">Booked</div></div>
          </div>
        </div>
        <!-- more mobile cards replicated as needed -->
      </div>
    </div>

    <footer style="margin-top:18px;color:var(--muted)">Tip: Click "New Reservation" to quickly add bookings. Use filters to narrow results.</footer>

    <!-- New reservation modal -->
    <div class="modal" id="resModal" aria-hidden="true" role="dialog" aria-modal="true">
      <div class="modal-dialog" role="document">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:8px">
          <strong>New Reservation</strong>
          <button class="btn" id="closeModal"><i class="fa-solid fa-xmark"></i></button>
        </div>

        <div class="form">
          <div class="form-row">
            <input id="gName" placeholder="Guest full name">
            <input id="gEmail" placeholder="Email">
          </div>

          <div class="form-row">
            <select id="rRoom">
              <option value="Deluxe 101">Deluxe 101</option>
              <option value="Suite 203">Suite 203</option>
              <option value="Standard 5">Standard 5</option>
            </select>
            <input id="rGuests" type="number" min="1" placeholder="Guests">
          </div>

          <div class="form-row">
            <input id="rFrom" type="date">
            <input id="rTo" type="date">
          </div>

          <div style="margin-bottom:8px">
            <input id="rAmount" type="number" placeholder="Amount" style="width:100%;padding:10px;border-radius:8px;border:0;background:rgba(255,255,255,0.01);color:var(--text)">
          </div>

          <div style="display:flex;gap:8px;justify-content:flex-end">
            <button class="btn" id="cancelModal">Cancel</button>
            <button class="btn btn-primary" id="saveRes">Save reservation</button>
          </div>
        </div>
      </div>
    </div>

  </main>

  <script>
    (function(){
      // elements
      const resList = document.getElementById('resList');
      const cardsList = document.getElementById('cardsList');
      const searchInput = document.getElementById('resSearch');
      const statusFilter = document.getElementById('statusFilter');
      const sortBy = document.getElementById('sortBy');
      const newBtn = document.getElementById('newResBtn');
      const modal = document.getElementById('resModal');
      const closeModal = document.getElementById('closeModal');
      const cancelModal = document.getElementById('cancelModal');
      const saveRes = document.getElementById('saveRes');

      function rowsArray(){ return Array.from(resList.querySelectorAll('tr')); }

      function refresh(){
        const q = searchInput.value.trim().toLowerCase();
        const status = statusFilter.value;
        const rows = rowsArray();
        let visible = 0;
        rows.forEach(r => {
          const text = (r.textContent || '').toLowerCase();
          const matches = (!q || text.includes(q)) && (!status || r.dataset.status === status);
          r.style.display = matches ? '' : 'none';
          if (matches) visible++;
        });
        // mobile cards: simple sync (rebuild)
        buildCards();
      }

      function buildCards(){
        const rows = rowsArray().filter(r => r.style.display !== 'none');
        cardsList.innerHTML = '';
        rows.forEach(r => {
          const guest = r.querySelector('td:first-child strong')?.textContent || 'Guest';
          const avatar = r.querySelector('td:first-child img')?.src || '';
          const room = r.children[1]?.textContent || '';
          const dates = r.children[2]?.textContent || '';
          const status = r.dataset.status || '';
          const ref = r.dataset.ref || '';
          const card = document.createElement('div');
          card.className = 'card';
          card.dataset.status = status;
          card.innerHTML = `
            <div style="display:flex;gap:12px;align-items:center">
              <img class="avatar" src="${avatar}" alt="">
              <div>
                <strong>${guest}</strong>
                <div class="muted">${room} • ${dates}</div>
              </div>
            </div>
            <div class="row">
              <div class="small muted">${ref}</div>
              <div><div class="status ${status}">${status ? status.replace(/^\w/, c=>c.toUpperCase()) : ''}</div></div>
            </div>
          `;
          cardsList.appendChild(card);
        });
      }

      document.getElementById('doSearch').addEventListener('click', refresh);
      searchInput.addEventListener('keyup', (e)=> { if (e.key === 'Enter') refresh(); });
      statusFilter.addEventListener('change', refresh);
      sortBy.addEventListener('change', () => {
        const key = sortBy.value;
        const rows = rowsArray();
        if (key === 'date_asc' || key === 'date_desc') {
          rows.sort((a,b) => {
            const da = new Date(a.dataset.date || 0), db = new Date(b.dataset.date || 0);
            return key === 'date_asc' ? da - db : db - da;
          });
          rows.forEach(r => resList.appendChild(r));
        }
      });

      // modal controls
      function openModal(){ modal.classList.add('open'); modal.setAttribute('aria-hidden','false'); }
      function close(){ modal.classList.remove('open'); modal.setAttribute('aria-hidden','true'); }
      newBtn.addEventListener('click', openModal);
      closeModal.addEventListener('click', close);
      cancelModal.addEventListener('click', close);
      modal.addEventListener('click', (e)=> { if (e.target === modal) close(); });

      // demo save reservation: append row
      saveRes.addEventListener('click', () => {
        const name = document.getElementById('gName').value.trim() || 'Guest';
        const email = document.getElementById('gEmail').value.trim() || 'guest@example.com';
        const room = document.getElementById('rRoom').value;
        const from = document.getElementById('rFrom').value || '2025-11-01';
        const to = document.getElementById('rTo').value || '2025-11-02';
        const amount = Number(document.getElementById('rAmount').value||0);
        const ref = 'R-' + Math.floor(Math.random()*900+100);
        const tr = document.createElement('tr');
        tr.dataset.status = 'booked';
        tr.dataset.date = from;
        tr.dataset.ref = ref;
        tr.innerHTML = `
          <td>
            <div class="guest"><img class="avatar" src="${avatar}" alt="">
              <div><strong>${name}</strong><div class="muted">${email}</div></div>
            </div>
          </td>
          <td>${room}</td>
          <td><div class="muted">${from} — ${to}</div></td>
          <td><strong>$${amount}</strong></td>
          <td><div class="status booked">Booked</div></td>
          <td>
            <div class="actions">
              <button class="icon-small" title="View"><i class="fa-solid fa-eye"></i></button>
              <button class="icon-small" title="Check-in"><i class="fa-solid fa-sign-in-alt"></i></button>
              <button class="icon-small" title="Cancel"><i class="fa-solid fa-ban"></i></button>
            </div>
          </td>
        `;
        resList.prepend(tr);
        close();
        refresh();
      });

      // demo action handlers (delegated)
      resList.addEventListener('click', (e) => {
        const btn = e.target.closest('button');
        if (!btn) return;
        const tr = btn.closest('tr');
        if (!tr) return;
        if (btn.title === 'Check-in') {
          tr.dataset.status = 'checked';
          tr.querySelector('.status').className = 'status checked';
          tr.querySelector('.status').textContent = 'Checked-in';
        } else if (btn.title === 'Checkout') {
          tr.remove();
        } else if (btn.title === 'Cancel') {
          tr.dataset.status = 'cancel';
          tr.querySelector('.status').className = 'status cancel';
          tr.querySelector('.status').textContent = 'Cancelled';
        } else if (btn.title === 'Restore') {
          tr.dataset.status = 'booked';
          tr.querySelector('.status').className = 'status booked';
          tr.querySelector('.status').textContent = 'Booked';
        } else if (btn.title === 'View') {
          alert('Reservation details (demo): ' + (tr.dataset.ref || '—'));
        } else if (btn.title === 'Receipt') {
          alert('Open receipt (demo)');
        }
        buildCards();
      });

      // init
      refresh();

      // demo refresh button
      document.getElementById('refreshBtn').addEventListener('click', ()=> { alert('Refreshed (demo)'); });
    })();
  </script>
</body>
</html>
</body>
</html>