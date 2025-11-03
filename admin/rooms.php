
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
      <title>Rooms — Admin — Afrique Hotel</title>
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
        html,body{height:100%;margin:0;font-family:Inter,system-ui,Segoe UI,Roboto,Arial;background:var(--page-bg);;color:var(--text);-webkit-font-smoothing:antialiased}
        a{color:inherit;text-decoration:none}
    
        /* Topnav + Sidebar assumed fixed (use your topnav.php & sidebar.php when including) */
        .main-wrap{
          max-width:1200px;
          margin:24px auto;
          padding:18px;
          margin-left: calc(var(--sb-width) + 28px);
          margin-top: 78px; /* leave space for topnav */
          transition: margin-left .22s ease;
        }
        @media (max-width:920px){
          .main-wrap{ margin-left: 18px; margin-right: 18px; margin-top: 86px; }
        }
    
        .page-header{display:flex;align-items:center;gap:12px;justify-content:space-between;margin-bottom:18px}
        .page-title{display:flex;gap:12px;align-items:center}
        .page-title .logo{width:52px;height:52px;border-radius:10px;background:linear-gradient(135deg,var(--accent),var(--accent-2));display:grid;place-items:center;font-weight:800;color:white;font-size:18px}
        .page-title h1{margin:0;font-size:20px}
        .page-title p{margin:0;color:var(--muted);font-size:13px}
    
        .controls{display:flex;gap:8px;align-items:center}
        .btn{padding:8px 12px;border-radius:10px;border:0;background:transparent;color:var(--text);cursor:pointer}
        .btn-primary{background:linear-gradient(90deg,var(--accent),var(--accent-2));color:white}
        .btn-ghost{border:1px solid rgba(255,255,255,0.04)}
    
        .bar{display:flex;gap:12px;align-items:center;margin-bottom:16px}
        .search{flex:1;display:flex;align-items:center;background:var(--glass);padding:8px;border-radius:10px;border:1px solid rgba(255,255,255,0.02)}
        .search input{flex:1;border:0;background:transparent;color:var(--text);outline:none;padding:6px 8px}
        .filters{display:flex;gap:8px;align-items:center}
    
        .grid{display:grid;grid-template-columns:repeat(3,1fr);gap:14px}
        @media (max-width:980px){ .grid{grid-template-columns:repeat(2,1fr)} }
        @media (max-width:680px){ .grid{grid-template-columns:repeat(1,1fr)} }
    
        .room{
          background:var(--card-bg);padding:12px;border-radius:12px;box-shadow:0 8px 24px rgba(2,6,23,0.5);display:flex;flex-direction:column;gap:10px
        }
        .room .thumb{width:100%;height:160px;border-radius:10px;object-fit:cover;display:block}
        .room h3{margin:0;font-size:16px}
        .room .meta{color:var(--muted);font-size:13px}
        .room .row{display:flex;justify-content:space-between;align-items:center;margin-top:8px}
        .pill{background:rgba(255,255,255,0.03);padding:6px 8px;border-radius:999px;font-weight:700;color:var(--muted);font-size:13px}
    
        .room-actions{display:flex;gap:8px}
        .icon-small{padding:8px;border-radius:8px;background:rgba(255,255,255,0.02);cursor:pointer;border:0;color:var(--text)}
        .price{font-weight:800}
    
        /* empty / helper */
        .empty{padding:28px;border-radius:12px;background:linear-gradient(180deg, rgba(255,255,255,0.01), rgba(255,255,255,0.005));text-align:center;color:var(--muted)}
    
        /* modal new room */
        .modal{
          position:fixed;inset:0;display:none;align-items:center;justify-content:center;background:rgba(2,6,23,0.6);z-index:1400;padding:20px
        }
        .modal.open{display:flex}
        .modal-dialog{width:100%;max-width:720px;background:var(--card-bg);border-radius:12px;padding:18px;box-shadow:0 20px 60px rgba(2,6,23,0.6)}
        .form-row{display:flex;gap:10px;margin-bottom:10px}
        .form-row input,.form-row select,textarea{flex:1;padding:10px;border-radius:8px;border:0;background:rgba(255,255,255,0.01);color:var(--text);outline:none}
        textarea{min-height:110px}
    
        .small{font-size:13px;color:var(--muted)}
      </style>
    </head>
    <body>
      <?php
        // include your actual topnav and sidebar used in admin pages
        include('topnav.php');   // path: same folder
        include('sidebar.php');
      ?>
    
      <main class="main-wrap" role="main" aria-label="Rooms admin">
        <header class="page-header">
          <div class="page-title">
            <div class="logo">AH</div>
            <div>
              <h1>Rooms</h1>
              <p class="small">Manage rooms, rates and availability</p>
            </div>
          </div>
    
          <div class="controls">
            <div class="small">Signed in as <strong><?= $userName ?></strong></div>
            <button class="btn btn-ghost" id="refreshBtn"><i class="fa-solid fa-arrows-rotate"></i></button>
            <button class="btn btn-primary" id="newRoomBtn"><i class="fa-solid fa-plus"></i> New Room</button>
          </div>
        </header>
    
        <div class="bar">
          <div class="search" role="search">
            <input id="roomSearch" type="search" placeholder="Search by name, amenity or price..." aria-label="Search rooms">
            <button class="btn" id="doSearch"><i class="fa-solid fa-magnifying-glass"></i></button>
          </div>
    
          <div class="filters">
            <select id="typeFilter" class="small" aria-label="Filter room-type">
              <option value="">All types</option>
              <option>Standard</option>
              <option>Deluxe</option>
              <option>Suite</option>
            </select>
            <select id="sortBy" class="small" aria-label="Sort">
              <option value="new">Newest</option>
              <option value="price_asc">Price ↑</option>
              <option value="price_desc">Price ↓</option>
            </select>
          </div>
        </div>
    
        <section class="grid" id="roomsGrid" aria-live="polite">
          <!-- Example cards (in real app replace with server-rendered list) -->
          <article class="room" data-type="Deluxe" data-price="120">
            <img class="thumb" src="https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?q=80&w=1400&auto=format&fit=crop" alt="Deluxe room">
            <h3>Deluxe 101</h3>
            <div class="meta">King bed • Sea view • Sleeps 2</div>
            <div class="row">
              <div class="price">$120 / night</div>
              <div class="room-actions">
                <button class="icon-small" title="Edit"><i class="fa-solid fa-pen"></i></button>
                <button class="icon-small" title="Toggle availability"><i class="fa-solid fa-toggle-on"></i></button>
                <button class="icon-small" title="Delete"><i class="fa-solid fa-trash"></i></button>
              </div>
            </div>
          </article>
    
          <article class="room" data-type="Suite" data-price="220">
            <img class="thumb" src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?q=80&w=1400&auto=format&fit=crop" alt="Suite">
            <h3>Suite 203</h3>
            <div class="meta">Spacious • Living area • Breakfast included</div>
            <div class="row">
              <div class="price">$220 / night</div>
              <div class="room-actions">
                <button class="icon-small" title="Edit"><i class="fa-solid fa-pen"></i></button>
                <button class="icon-small" title="Toggle availability"><i class="fa-solid fa-toggle-on"></i></button>
                <button class="icon-small" title="Delete"><i class="fa-solid fa-trash"></i></button>
              </div>
            </div>
          </article>
    
          <article class="room" data-type="Standard" data-price="85">
            <img class="thumb" src="../images/room1.jpg" alt="Standard">
            <h3>Standard 5</h3>
            <div class="meta">Comfortable • City view • Great value</div>
            <div class="row">
              <div class="price">$85 / night</div>
              <div class="room-actions">
                <button class="icon-small" title="Edit"><i class="fa-solid fa-pen"></i></button>
                <button class="icon-small" title="Toggle availability"><i class="fa-solid fa-toggle-on"></i></button>
                <button class="icon-small" title="Delete"><i class="fa-solid fa-trash"></i></button>
              </div>
            </div>
          </article>
        </section>
    
        <div id="emptyState" class="empty" style="display:none">No rooms found.</div>
    
        <!-- New Room Modal -->
        <div class="modal" id="roomModal" role="dialog" aria-modal="true" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:8px">
              <strong>Create new room</strong>
              <button class="btn" id="closeModal"><i class="fa-solid fa-xmark"></i></button>
            </div>
    
            <div class="form">
              <div class="form-row">
                <input id="rName" placeholder="Room name / number">
                <select id="rType">
                  <option>Standard</option>
                  <option>Deluxe</option>
                  <option>Suite</option>
                </select>
              </div>
    
              <div class="form-row">
                <input id="rPrice" type="number" placeholder="Price per night">
                <input id="rImage" placeholder="Image URL (optional)">
              </div>
    
              <div style="margin-bottom:8px">
                <textarea id="rDesc" placeholder="Short description"></textarea>
              </div>
    
              <div style="display:flex;gap:8px;justify-content:flex-end">
                <button class="btn" id="cancelModal">Cancel</button>
                <button class="btn btn-primary" id="saveRoom">Save room</button>
              </div>
            </div>
          </div>
        </div>
    
      </main>
    
      <script>
        // small UI script: search, filters, modal and demo add room
        (function(){
          const grid = document.getElementById('roomsGrid');
          const rows = Array.from(grid.querySelectorAll('.room'));
          const searchInput = document.getElementById('roomSearch');
          const typeFilter = document.getElementById('typeFilter');
          const sortBy = document.getElementById('sortBy');
          const empty = document.getElementById('emptyState');
    
          function refreshList(){
            const q = searchInput.value.trim().toLowerCase();
            const type = typeFilter.value;
            let visible = 0;
            rows.forEach(r => {
              const name = r.querySelector('h3').textContent.toLowerCase();
              const meta = r.querySelector('.meta').textContent.toLowerCase();
              const price = r.dataset.price || '';
              const matches = (!q || name.includes(q) || meta.includes(q) || price.includes(q)) && (!type || r.dataset.type === type);
              r.style.display = matches ? '' : 'none';
              if (matches) visible++;
            });
            empty.style.display = visible ? 'none' : '';
          }
    
          document.getElementById('doSearch').addEventListener('click', refreshList);
          searchInput.addEventListener('keyup', (e)=> { if (e.key==='Enter') refreshList(); });
    
          // sorting simple by price or newest (DOM order preserved)
          sortBy.addEventListener('change', () => {
            const key = sortBy.value;
            const arr = Array.from(grid.querySelectorAll('.room')).sort((a,b) => {
              const pa = Number(a.dataset.price||0), pb = Number(b.dataset.price||0);
              if (key === 'price_asc') return pa - pb;
              if (key === 'price_desc') return pb - pa;
              return 0;
            });
            arr.forEach(n => grid.appendChild(n));
          });
    
          // modal
          const modal = document.getElementById('roomModal');
          const newBtn = document.getElementById('newRoomBtn');
          const closeModal = document.getElementById('closeModal');
          const cancelModal = document.getElementById('cancelModal');
          const saveRoom = document.getElementById('saveRoom');
    
          function openModal(){ modal.classList.add('open'); modal.setAttribute('aria-hidden','false'); }
          function close(){ modal.classList.remove('open'); modal.setAttribute('aria-hidden','true'); }
    
          newBtn.addEventListener('click', openModal);
          closeModal.addEventListener('click', close);
          cancelModal.addEventListener('click', close);
          modal.addEventListener('click', (e)=> { if (e.target === modal) close(); });
    
          saveRoom.addEventListener('click', () => {
            const name = document.getElementById('rName').value.trim() || 'New Room';
            const type = document.getElementById('rType').value;
            const price = document.getElementById('rPrice').value || '0';
            const img = document.getElementById('rImage').value || 'https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?q=80&w=1400&auto=format&fit=crop';
            const desc = document.getElementById('rDesc').value || '';
    
            const art = document.createElement('article');
            art.className = 'room';
            art.dataset.type = type;
            art.dataset.price = price;
            art.innerHTML = `
              <img class="thumb" src="${img}" alt="${name}">
              <h3>${name}</h3>
              <div class="meta">${desc}</div>
              <div class="row">
                <div class="price">$${price} / night</div>
                <div class="room-actions">
                  <button class="icon-small" title="Edit"><i class="fa-solid fa-pen"></i></button>
                  <button class="icon-small" title="Toggle availability"><i class="fa-solid fa-toggle-on"></i></button>
                  <button class="icon-small" title="Delete"><i class="fa-solid fa-trash"></i></button>
                </div>
              </div>
            `;
            grid.prepend(art);
            // wire delete for demo
            art.querySelector('.icon-small[title="Delete"]').addEventListener('click', ()=> art.remove());
            close();
            refreshList();
          });
    
          // demo: refresh button
          document.getElementById('refreshBtn').addEventListener('click', ()=> alert('Refreshed (demo)'));
    
          // init
          refreshList();
        })();
      </script>
    </body>
    </html>
   