<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
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
      <title>Staff — Admin — Afrique Hotel</title>
    
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
    
        .page-header{
         display:flex;
         align-items:center;
         justify-content:space-between;
         gap:12px;
         margin-bottom:18px
        }
        
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
    
        .grid{display:grid;grid-template-columns:repeat(4,1fr);gap:14px}
        @media (max-width:1100px){ .grid{grid-template-columns:repeat(3,1fr)} }
        @media (max-width:800px){ .grid{grid-template-columns:repeat(2,1fr)} }
        @media (max-width:520px){ .grid{grid-template-columns:repeat(1,1fr)} }
    
        .staff-card{
          background:var(--card-bg);padding:14px;border-radius:12px;box-shadow:0 8px 30px rgba(2,6,23,0.55);display:flex;flex-direction:column;gap:12px;min-height:220px;
          transition:transform .12s ease, box-shadow .12s ease;
        }
        .staff-card:hover{transform:translateY(-6px);box-shadow:0 18px 48px rgba(2,6,23,0.65)}
        .staff-top{display:flex;align-items:center;gap:12px}
        .avatar{width:72px;height:72px;border-radius:12px;object-fit:cover;border:2px solid rgba(255,255,255,0.04)}
        .staff-name{font-weight:800}
        .role{color:var(--muted);font-size:13px}
        .meta-row{display:flex;gap:8px;flex-wrap:wrap;color:var(--muted);font-size:13px}
        .badge{background:rgba(124,58,237,0.12);color:var(--accent);padding:6px 10px;border-radius:10px;font-weight:700;font-size:13px}
    
        .staff-actions{display:flex;gap:8px;margin-top:auto}
        .icon-small{padding:8px;border-radius:8px;background:rgba(255,255,255,0.02);cursor:pointer;border:0;color:var(--text)}
    
        /* add staff button row */
        .top-controls{display:flex;gap:12px;align-items:center}
    
        /* modal */
        .modal{position:fixed;inset:0;display:none;align-items:center;justify-content:center;background:rgba(2,6,23,0.6);z-index:1400;padding:20px}
        .modal.open{display:flex}
        .modal-dialog{width:100%;max-width:700px;background:var(--card-bg);border-radius:12px;padding:18px;box-shadow:0 20px 60px rgba(2,6,23,0.6)}
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
    
      <main class="main-wrap" role="main" aria-label="Staff admin">
        <header class="page-header">
          <div class="title">
            <div class="logo">AH</div>
            <div>
              <h1>Staff</h1>
              <p class="small">View and manage hotel staff profiles</p>
            </div>
          </div>
    
          <div class="controls">
            <div class="small">Signed in as <strong><?= $userName ?></strong></div>
            <button class="btn btn-ghost" id="refreshBtn"><i class="fa-solid fa-arrows-rotate"></i></button>
            <button class="btn btn-primary" id="newStaffBtn"><i class="fa-solid fa-user-plus"></i> Add Staff</button>
          </div>
        </header>
    
        <div class="bar">
          <div class="search" role="search">
            <input id="staffSearch" type="search" placeholder="Search by name, role, or phone..." aria-label="Search staff">
            <button class="btn" id="doSearch"><i class="fa-solid fa-magnifying-glass"></i></button>
          </div>
    
          <div class="filters">
            <select id="deptFilter" class="small" aria-label="Filter department">
              <option value="">All departments</option>
              <option>Reception</option>
              <option>Housekeeping</option>
              <option>Kitchen</option>
              <option>Management</option>
            </select>
    
            <select id="sortBy" class="small" aria-label="Sort">
              <option value="new">Newest</option>
              <option value="name_asc">Name A–Z</option>
            </select>
          </div>
        </div>
    
        <section class="grid" id="staffGrid" aria-live="polite">
          <article class="staff-card" data-name="Amina Diallo" data-dept="Reception">
            <div class="staff-top">
              <img class="avatar" src="https://images.unsplash.com/photo-1547425260-76bcadfb4f2c?q=80&w=800&auto=format&fit=crop" alt="Amina">
              <div>
                <div class="staff-name">Amina Diallo</div>
                <div class="role">Front Desk Manager</div>
                <div class="meta-row"><div class="small">aminad@hotel.com</div><div class="small">+233 20 123 4567</div></div>
              </div>
            </div>
            <div class="meta-row">
              <div class="badge">10y service</div>
              <div class="small">Shift: Morning</div>
            </div>
            <div class="staff-actions">
              <button class="icon-small" title="View"><i class="fa-solid fa-eye"></i></button>
              <button class="icon-small" title="Edit"><i class="fa-solid fa-pen"></i></button>
              <button class="icon-small" title="Remove"><i class="fa-solid fa-user-slash"></i></button>
            </div>
          </article>
    
          <article class="staff-card" data-name="Michael Brown" data-dept="Kitchen">
            <div class="staff-top">
              <img class="avatar" src="../images/WIN_20250520_16_09_33_Pro.jpg" alt="Michael">
              <div>
                <div class="staff-name">Michael Brown</div>
                <div class="role">Head Chef</div>
                <div class="meta-row"><div class="small">michaelb@hotel.com</div><div class="small">+1 555 9876</div></div>
              </div>
            </div>
            <div class="meta-row">
              <div class="badge">6y service</div>
              <div class="small">Shift: Evening</div>
            </div>
            <div class="staff-actions">
              <button class="icon-small" title="View"><i class="fa-solid fa-eye"></i></button>
              <button class="icon-small" title="Edit"><i class="fa-solid fa-pen"></i></button>
              <button class="icon-small" title="Remove"><i class="fa-solid fa-user-slash"></i></button>
            </div>
          </article>
    
          <article class="staff-card" data-name="Sofia Mendes" data-dept="Housekeeping">
            <div class="staff-top">
              <img class="avatar" src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?q=80&w=800&auto=format&fit=crop" alt="Sofia">
              <div>
                <div class="staff-name">Sofia Mendes</div>
                <div class="role">Housekeeping Lead</div>
                <div class="meta-row"><div class="small">sofia@hotel.com</div><div class="small">+44 7700 900123</div></div>
              </div>
            </div>
            <div class="meta-row">
              <div class="badge">4y service</div>
              <div class="small">Shift: Afternoon</div>
            </div>
            <div class="staff-actions">
              <button class="icon-small" title="View"><i class="fa-solid fa-eye"></i></button>
              <button class="icon-small" title="Edit"><i class="fa-solid fa-pen"></i></button>
              <button class="icon-small" title="Remove"><i class="fa-solid fa-user-slash"></i></button>
            </div>
          </article>
        </section>
    
        <footer style="margin-top:18px;color:var(--muted)">Click "Add Staff" to create staff profiles. Use filters to narrow by department.</footer>
    
        <!-- Add Staff Modal -->
        <div class="modal" id="staffModal" aria-hidden="true" role="dialog" aria-modal="true">
          <div class="modal-dialog" role="document">
            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:8px">
              <strong>New Staff Member</strong>
              <button class="btn" id="closeModal"><i class="fa-solid fa-xmark"></i></button>
            </div>
    
            <div class="form">
              <div class="form-row">
                <input id="sName" placeholder="Full name">
                <input id="sEmail" placeholder="Email">
              </div>
    
              <div class="form-row">
                <input id="sPhone" placeholder="Phone">
                <select id="sDept">
                  <option>Reception</option>
                  <option>Housekeeping</option>
                  <option>Kitchen</option>
                  <option>Management</option>
                </select>
              </div>
    
              <div class="form-row">
                <input id="sRole" placeholder="Role / title">
                <input id="sAvatar" placeholder="Avatar URL (optional)">
              </div>
    
              <div style="display:flex;gap:8px;justify-content:flex-end;margin-top:8px">
                <button class="btn" id="cancelModal">Cancel</button>
                <button class="btn btn-primary" id="saveStaff">Save staff</button>
              </div>
            </div>
          </div>
        </div>
    
      </main>
    
      <script>
        (function(){
          const grid = document.getElementById('staffGrid');
          const search = document.getElementById('staffSearch');
          const deptFilter = document.getElementById('deptFilter');
          const sortBy = document.getElementById('sortBy');
    
          function items(){ return Array.from(grid.querySelectorAll('.staff-card')); }
    
          function refresh(){
            const q = search.value.trim().toLowerCase();
            const dept = deptFilter.value;
            items().forEach(card => {
              const name = card.dataset.name.toLowerCase();
              const department = card.dataset.dept;
              const matches = (!q || name.includes(q)) && (!dept || department === dept);
              card.style.display = matches ? '' : 'none';
            });
          }
    
          document.getElementById('doSearch').addEventListener('click', refresh);
          search.addEventListener('keyup', e => { if (e.key==='Enter') refresh(); });
          deptFilter.addEventListener('change', refresh);
    
          sortBy.addEventListener('change', () => {
            const key = sortBy.value;
            const arr = items().slice();
            if (key === 'name_asc') arr.sort((a,b) => a.dataset.name.localeCompare(b.dataset.name));
            arr.forEach(c => grid.appendChild(c));
          });
    
          // modal controls & add staff demo
          const modal = document.getElementById('staffModal');
          const newBtn = document.getElementById('newStaffBtn');
          const closeModal = document.getElementById('closeModal');
          const cancelModal = document.getElementById('cancelModal');
          const saveStaff = document.getElementById('saveStaff');
    
          function open(){ modal.classList.add('open'); modal.setAttribute('aria-hidden','false'); }
          function close(){ modal.classList.remove('open'); modal.setAttribute('aria-hidden','true'); }
    
          newBtn.addEventListener('click', open);
          closeModal.addEventListener('click', close);
          cancelModal.addEventListener('click', close);
          modal.addEventListener('click', (e)=> { if (e.target === modal) close(); });
    
          saveStaff.addEventListener('click', () => {
            const name = document.getElementById('sName').value.trim() || 'New Staff';
            const email = document.getElementById('sEmail').value.trim() || '';
            const phone = document.getElementById('sPhone').value.trim() || '';
            const dept = document.getElementById('sDept').value;
            const role = document.getElementById('sRole').value.trim() || '';
            const avatar = document.getElementById('sAvatar').value || 'https://images.unsplash.com/photo-1547425260-76bcadfb4f2c?q=80&w=800&auto=format&fit=crop';
    
            const art = document.createElement('article');
            art.className = 'staff-card';
            art.dataset.name = name;
            art.dataset.dept = dept;
            art.innerHTML = `
              <div class="staff-top">
                <img class="avatar" src="${avatar}" alt="${name}">
                <div>
                  <div class="staff-name">${name}</div>
                  <div class="role">${role}</div>
                  <div class="meta-row"><div class="small">${email}</div><div class="small">${phone}</div></div>
                </div>
              </div>
              <div class="meta-row"><div class="badge">New</div><div class="small">Shift: TBD</div></div>
              <div class="staff-actions">
                <button class="icon-small" title="View"><i class="fa-solid fa-eye"></i></button>
                <button class="icon-small" title="Edit"><i class="fa-solid fa-pen"></i></button>
                <button class="icon-small" title="Remove"><i class="fa-solid fa-user-slash"></i></button>
              </div>
            `;
            grid.prepend(art);
            close();
            refresh();
          });
    
          // delegated actions
          grid.addEventListener('click', (e)=>{
            const btn = e.target.closest('button');
            if (!btn) return;
            const card = btn.closest('.staff-card');
            if (!card) return;
            if (btn.title === 'Remove') card.remove();
            else if (btn.title === 'View') alert('Staff profile (demo): ' + card.dataset.name);
            else if (btn.title === 'Edit') alert('Edit staff (demo)');
          });
    
          document.getElementById('refreshBtn').addEventListener('click', ()=> { alert('Refreshed (demo)'); });
    
          refresh();
        })();
      </script>
    </body>
    </html>
    