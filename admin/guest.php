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
      <title>Guests — Admin — Afrique Hotel</title>
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
    
        /* table */
        .table{width:100%;border-collapse:collapse;font-size:14px}
        .table thead th{background:rgba(255,255,255,0.02);padding:12px;text-align:left;color:var(--muted);font-weight:700;border-bottom:1px solid rgba(255,255,255,0.03)}
        .table tbody td{padding:12px;border-bottom:1px dashed rgba(255,255,255,0.02);vertical-align:middle}
        .guest{display:flex;align-items:center;gap:12px}
        .avatar{width:48px;height:48;border-radius:8px;object-fit:cover;border:2px solid rgba(255,255,255,0.03)}
        .meta{color:var(--muted);font-size:13px}
    
        .actions{display:flex;gap:8px}
        .icon-small{padding:8px;border-radius:8px;background:rgba(255,255,255,0.02);cursor:pointer;border:0;color:var(--text)}
    
        /* cards for mobile */
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
    
      <main class="main-wrap" role="main" aria-label="Guests admin">
        <header class="page-header">
          <div class="title">
            <div class="logo">AH</div>
            <div>
              <h1>Guests</h1>
              <p class="small">Manage guest profiles & history</p>
            </div>
          </div>
    
          <div class="controls">
            <div class="small">Signed in as <strong><?= $userName ?></strong></div>
            <button class="btn btn-ghost" id="refreshBtn"><i class="fa-solid fa-arrows-rotate"></i></button>
            <button class="btn btn-primary" id="newGuestBtn"><i class="fa-solid fa-user-plus"></i> New Guest</button>
          </div>
        </header>
    
        <div class="bar">
          <div class="search" role="search">
            <input id="guestSearch" type="search" placeholder="Search guests by name, email or phone..." aria-label="Search guests">
            <button class="btn" id="doSearch"><i class="fa-solid fa-magnifying-glass"></i></button>
          </div>
    
          <div class="filters">
            <select id="guestFilter" class="small" aria-label="Filter">
              <option value="">All</option>
              <option value="vip">VIP</option>
              <option value="regular">Regular</option>
            </select>
            <select id="sortBy" class="small" aria-label="Sort">
              <option value="new">Newest</option>
              <option value="name_asc">Name A–Z</option>
              <option value="name_desc">Name Z–A</option>
            </select>
          </div>
        </div>
    
        <!-- desktop table -->
        <div class="table-wrap">
          <table class="table" role="table" aria-label="Guests list">
            <thead>
              <tr>
                <th>Guest</th>
                <th>Phone / Email</th>
                <th>Bookings</th>
                <th>Member</th>
                <th class="small">Actions</th>
              </tr>
            </thead>
            <tbody id="guestList">
              <tr data-type="vip">
                <td>
                  <div class="guest"><img class="avatar" src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?q=80&w=800&auto=format&fit=crop" alt="Guest">
                    <div><strong>John Doe</strong><div class="meta">New York, USA</div></div>
                  </div>
                </td>
                <td><div class="meta">+1 555 1234<br>john@example.com</div></td>
                <td><strong>5</strong></td>
                <td><div class="pill">VIP</div></td>
                <td>
                  <div class="actions">
                    <button class="icon-small" title="View"><i class="fa-solid fa-eye"></i></button>
                    <button class="icon-small" title="Edit"><i class="fa-solid fa-pen"></i></button>
                    <button class="icon-small" title="Delete"><i class="fa-solid fa-trash"></i></button>
                  </div>
                </td>
              </tr>
    
              <tr data-type="regular">
                <td>
                  <div class="guest"><img class="avatar" src="https://images.unsplash.com/photo-1545996124-0e0b9b9a9c0f?q=80&w=800&auto=format&fit=crop" alt="Guest">
                    <div><strong>Jane Smith</strong><div class="meta">London, UK</div></div>
                  </div>
                </td>
                <td><div class="meta">+44 7700 900123<br>jane@example.com</div></td>
                <td><strong>2</strong></td>
                <td><div class="pill">Regular</div></td>
                <td>
                  <div class="actions">
                    <button class="icon-small" title="View"><i class="fa-solid fa-eye"></i></button>
                    <button class="icon-small" title="Edit"><i class="fa-solid fa-pen"></i></button>
                    <button class="icon-small" title="Delete"><i class="fa-solid fa-trash"></i></button>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
    
          <!-- mobile cards -->
          <div class="cards" id="cardsList">
            <div class="card" data-type="vip">
              <div style="display:flex;gap:12px;align-items:center">
                <img class="avatar" src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?q=80&w=800&auto=format&fit=crop" alt="Guest">
                <div>
                  <strong>John Doe</strong>
                  <div class="meta">john@example.com</div>
                </div>
              </div>
              <div class="row">
                <div class="small muted">5 bookings</div>
                <div><div class="pill">VIP</div></div>
              </div>
            </div>
          </div>
        </div>
    
        <footer style="margin-top:18px;color:var(--muted)">Use the + button to add guests quickly. Click a guest to view history.</footer>
    
        <!-- New Guest Modal -->
        <div class="modal" id="guestModal" aria-hidden="true" role="dialog" aria-modal="true">
          <div class="modal-dialog" role="document">
            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:8px">
              <strong>New Guest</strong>
              <button class="btn" id="closeModal"><i class="fa-solid fa-xmark"></i></button>
            </div>
    
            <div class="form">
              <div class="form-row">
                <input id="gName" placeholder="Full name">
                <input id="gPhone" placeholder="Phone">
              </div>
    
              <div class="form-row">
                <input id="gEmail" placeholder="Email">
                <select id="gType">
                  <option value="regular">Regular</option>
                  <option value="vip">VIP</option>
                </select>
              </div>
    
              <div style="margin-bottom:8px">
                <textarea id="gNotes" placeholder="Notes (optional)"></textarea>
              </div>
    
              <div style="display:flex;gap:8px;justify-content:flex-end">
                <button class="btn" id="cancelModal">Cancel</button>
                <button class="btn btn-primary" id="saveGuest">Save guest</button>
              </div>
            </div>
          </div>
        </div>
    
      </main>
    
      <script>
        (function(){
          const guestList = document.getElementById('guestList');
          const cardsList = document.getElementById('cardsList');
          const searchInput = document.getElementById('guestSearch');
          const guestFilter = document.getElementById('guestFilter');
          const sortBy = document.getElementById('sortBy');
    
          const modal = document.getElementById('guestModal');
          const newBtn = document.getElementById('newGuestBtn');
          const closeModal = document.getElementById('closeModal');
          const cancelModal = document.getElementById('cancelModal');
          const saveGuest = document.getElementById('saveGuest');
    
          function rowsArray(){ return Array.from(guestList.querySelectorAll('tr')); }
    
          function refresh(){
            const q = searchInput.value.trim().toLowerCase();
            const type = guestFilter.value;
            const rows = rowsArray();
            let visible = 0;
            rows.forEach(r => {
              const text = (r.textContent || '').toLowerCase();
              const matches = (!q || text.includes(q)) && (!type || r.dataset.type === type);
              r.style.display = matches ? '' : 'none';
              if (matches) visible++;
            });
            buildCards();
          }
    
          function buildCards(){
            const rows = rowsArray().filter(r => r.style.display !== 'none');
            cardsList.innerHTML = '';
            rows.forEach(r => {
              const img = r.querySelector('img')?.src || '';
              const name = r.querySelector('strong')?.textContent || '';
              const info = r.querySelector('.meta')?.textContent || '';
              const bookings = r.children[2]?.textContent || '';
              const type = r.dataset.type || '';
              const card = document.createElement('div');
              card.className = 'card';
              card.dataset.type = type;
              card.innerHTML = `
                <div style="display:flex;gap:12px;align-items:center">
                  <img class="avatar" src="${img}" alt="">
                  <div>
                    <strong>${name}</strong>
                    <div class="meta">${info}</div>
                  </div>
                </div>
                <div class="row">
                  <div class="small muted">${bookings} bookings</div>
                  <div><div class="pill">${type ? type.toUpperCase() : ''}</div></div>
                </div>
              `;
              cardsList.appendChild(card);
            });
          }
    
          document.getElementById('doSearch').addEventListener('click', refresh);
          searchInput.addEventListener('keyup', (e)=> { if (e.key==='Enter') refresh(); });
          guestFilter.addEventListener('change', refresh);
          sortBy.addEventListener('change', () => {
            const key = sortBy.value;
            const rows = rowsArray();
            if (key === 'name_asc' || key === 'name_desc') {
              rows.sort((a,b) => {
                const na = a.querySelector('strong')?.textContent || '';
                const nb = b.querySelector('strong')?.textContent || '';
                return key === 'name_asc' ? na.localeCompare(nb) : nb.localeCompare(na);
              });
              rows.forEach(r => guestList.appendChild(r));
            }
          });
    
          function openModal(){ modal.classList.add('open'); modal.setAttribute('aria-hidden','false'); }
          function close(){ modal.classList.remove('open'); modal.setAttribute('aria-hidden','true'); }
          newBtn.addEventListener('click', openModal);
          closeModal.addEventListener('click', close);
          cancelModal.addEventListener('click', close);
          modal.addEventListener('click', (e)=> { if (e.target === modal) close(); });
    
          saveGuest.addEventListener('click', () => {
            const name = document.getElementById('gName').value.trim() || 'Guest';
            const phone = document.getElementById('gPhone').value.trim() || '';
            const email = document.getElementById('gEmail').value.trim() || '';
            const type = document.getElementById('gType').value || 'regular';
            const notes = document.getElementById('gNotes').value || '';
    
            const tr = document.createElement('tr');
            tr.dataset.type = type;
            tr.innerHTML = `
              <td>
                <div class="guest"><img class="avatar" src="${'../images/admin.jpg'}" alt="">
                  <div><strong>${name}</strong><div class="meta">${notes || '—'}</div></div>
                </div>
              </td>
              <td><div class="meta">${phone}<br>${email}</div></td>
              <td><strong>0</strong></td>
              <td><div class="pill">${type === 'vip' ? 'VIP' : 'Regular'}</div></td>
              <td>
                <div class="actions">
                  <button class="icon-small" title="View"><i class="fa-solid fa-eye"></i></button>
                  <button class="icon-small" title="Edit"><i class="fa-solid fa-pen"></i></button>
                  <button class="icon-small" title="Delete"><i class="fa-solid fa-trash"></i></button>
                </div>
              </td>
            `;
            guestList.prepend(tr);
            close();
            refresh();
          });
    
          // delegated actions
          guestList.addEventListener('click', (e) => {
            const btn = e.target.closest('button');
            if (!btn) return;
            const tr = btn.closest('tr');
            if (!tr) return;
            if (btn.title === 'Delete') tr.remove();
            else if (btn.title === 'View') alert('Guest profile (demo)');
            else if (btn.title === 'Edit') alert('Edit guest (demo)');
            refresh();
          });
    
          document.getElementById('refreshBtn').addEventListener('click', ()=> { alert('Refreshed (demo)'); });
    
          // init
          refresh();
        })();
      </script>
    </body>
    </html>
</body>
</html>