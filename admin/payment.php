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
      <title>Payments — Admin — Afrique Hotel</title>
    
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
      <style>
        :root{
          --sb-width: 260px;
          --accent: #7c3aed;
          --accent-2: #06b6d4;
          --muted: #9aa6bd;
          --glass: rgba(255,255,255,0.02);
          --card-bg: linear-gradient(180deg, rgba(255,255,255,0.02), rgba(255,255,255,0.01));
          --page-bg: linear-gradient(180deg,#051226,#081428);
          --text: #e8f0ff;
        }
    
        *{box-sizing:border-box}
        html,body{height:100%;margin:0;font-family:Inter,system-ui,Segoe UI,Roboto,Arial;background:var(--page-bg);color:var(--text);-webkit-font-smoothing:antialiased}
        a{color:inherit;text-decoration:none}
    
        .main-wrap{
          max-width:1200px;margin:28px auto;padding:18px;margin-left: calc(var(--sb-width) + 28px);margin-top:78px;transition: margin-left .22s ease;
        }
        @media (max-width:920px){ .main-wrap{ margin-left:18px; margin-right:18px; margin-top:86px; } }
    
        .page-header{display:flex;align-items:center;justify-content:space-between;gap:12px;margin-bottom:18px}
        .title{display:flex;gap:12px;align-items:center}
        .logo{width:52px;height:52px;border-radius:10px;background:linear-gradient(135deg,var(--accent),var(--accent-2));display:grid;place-items:center;font-weight:800;color:white;font-size:18px}
        h1{margin:0;font-size:20px}
        .small{font-size:13px;color:var(--muted)}
    
        .controls{display:flex;gap:8px;align-items:center}
        .btn{padding:8px 12px;border-radius:10px;border:0;background:transparent;color:var(--text);cursor:pointer}
        .btn-primary{background:linear-gradient(90deg,var(--accent),var(--accent-2));color:white}
        .btn-ghost{border:1px solid rgba(255,255,255,0.04)}
    
        .bar{display:flex;gap:12px;align-items:center;margin-bottom:16px;flex-wrap:wrap}
        .search{flex:1;display:flex;align-items:center;background:var(--glass);padding:8px;border-radius:10px;border:1px solid rgba(255,255,255,0.02)}
        .search input{flex:1;border:0;background:transparent;color:var(--text);outline:none;padding:6px 8px}
        .filters{display:flex;gap:8px;align-items:center}
    
        .table{width:100%;border-collapse:collapse;font-size:14px}
        .table thead th{background:rgba(255,255,255,0.02);padding:12px;text-align:left;color:var(--muted);font-weight:700;border-bottom:1px solid rgba(255,255,255,0.03)}
        .table tbody td{padding:12px;border-bottom:1px dashed rgba(255,255,255,0.02);vertical-align:middle}
    
        .status{padding:6px 10px;border-radius:999px;font-weight:700;font-size:13px}
        .status.paid{background:rgba(6,182,212,0.08);color:var(--accent-2)}
        .status.pending{background:rgba(124,58,237,0.08);color:var(--accent)}
        .status.refund{background:rgba(239,68,68,0.08);color:#ff7b7b}
    
        .actions{display:flex;gap:8px}
        .icon-small{padding:8px;border-radius:8px;background:rgba(255,255,255,0.02);cursor:pointer;border:0;color:var(--text)}
    
        /* cards for mobile */
        .cards{display:none;gap:12px}
        .card{background:var(--card-bg);padding:12px;border-radius:12px;box-shadow:0 8px 24px rgba(2,6,23,0.5)}
        .card .row{display:flex;justify-content:space-between;align-items:center;margin-top:8px}
    
        @media (max-width:820px){ .table{display:none} .cards{display:flex;flex-direction:column} }
    
        /* modal */
        .modal{position:fixed;inset:0;display:none;align-items:center;justify-content:center;background:rgba(2,6,23,0.6);z-index:1400;padding:20px}
        .modal.open{display:flex}
        .modal-dialog{width:100%;max-width:720px;background:var(--card-bg);border-radius:12px;padding:18px;box-shadow:0 20px 60px rgba(2,6,23,0.6)}
        .form-row{display:flex;gap:10px;margin-bottom:10px}
        .form-row input,.form-row select,textarea{flex:1;padding:10px;border-radius:8px;border:0;background:rgba(255,255,255,0.01);color:var(--text);outline:none}
        textarea{min-height:90px}
      </style>
    </head>
    <body>
      <?php
        include('topnav.php');
        include('sidebar.php');
      ?>
    
      <main class="main-wrap" role="main" aria-label="Payments admin">
        <header class="page-header">
          <div class="title">
            <div class="logo">AH</div>
            <div>
              <h1>Payments</h1>
              <p class="small">Track transactions, refunds and payment methods</p>
            </div>
          </div>
    
          <div class="controls">
            <div class="small">Signed in as <strong><?= $userName ?></strong></div>
            <button class="btn btn-ghost" id="refreshBtn"><i class="fa-solid fa-arrows-rotate"></i></button>
            <button class="btn btn-primary" id="newPaymentBtn"><i class="fa-solid fa-plus"></i> New Payment</button>
          </div>
        </header>
    
        <div class="bar">
          <div class="search" role="search">
            <input id="paySearch" type="search" placeholder="Search by guest, ref, room or amount..." aria-label="Search payments">
            <button class="btn" id="doSearch"><i class="fa-solid fa-magnifying-glass"></i></button>
          </div>
    
          <div class="filters">
            <select id="statusFilter" class="small" aria-label="Filter status">
              <option value="">All status</option>
              <option value="paid">Paid</option>
              <option value="pending">Pending</option>
              <option value="refund">Refunded</option>
            </select>
            <select id="methodFilter" class="small" aria-label="Filter method">
              <option value="">All methods</option>
              <option>Card</option>
              <option>Cash</option>
              <option>Transfer</option>
            </select>
          </div>
        </div>
    
        <div class="table-wrap">
          <table class="table" role="table" aria-label="Payments list">
            <thead>
              <tr><th>Guest</th><th>Ref</th><th>Room</th><th>Date</th><th>Amount</th><th>Status</th><th class="small">Actions</th></tr>
            </thead>
            <tbody id="paymentsList">
              <tr data-status="paid" data-method="Card" data-amount="360">
                <td><strong>John Doe</strong><div class="small" style="color:var(--muted)">john@example.com</div></td>
                <td>PAY-204</td>
                <td>Deluxe 101</td>
                <td class="small" style="color:var(--muted)">2025-11-10</td>
                <td><strong>$360</strong></td>
                <td><div class="status paid">Paid</div></td>
                <td>
                  <div class="actions">
                    <button class="icon-small" title="Receipt"><i class="fa-solid fa-receipt"></i></button>
                    <button class="icon-small" title="Refund"><i class="fa-solid fa-rotate-left"></i></button>
                  </div>
                </td>
              </tr>
    
              <tr data-status="pending" data-method="Transfer" data-amount="220">
                <td><strong>Jane Smith</strong><div class="small" style="color:var(--muted)">jane@example.com</div></td>
                <td>PAY-203</td>
                <td>Suite 203</td>
                <td class="small" style="color:var(--muted)">2025-11-01</td>
                <td><strong>$220</strong></td>
                <td><div class="status pending">Pending</div></td>
                <td>
                  <div class="actions">
                    <button class="icon-small" title="Confirm"><i class="fa-solid fa-check"></i></button>
                    <button class="icon-small" title="Cancel"><i class="fa-solid fa-ban"></i></button>
                  </div>
                </td>
              </tr>
    
              <tr data-status="refund" data-method="Card" data-amount="85">
                <td><strong>Samuel Lee</strong><div class="small" style="color:var(--muted)">samuel@example.com</div></td>
                <td>PAY-176</td>
                <td>Standard 5</td>
                <td class="small" style="color:var(--muted)">2025-10-28</td>
                <td><strong>$85</strong></td>
                <td><div class="status refund">Refunded</div></td>
                <td>
                  <div class="actions">
                    <button class="icon-small" title="Receipt"><i class="fa-solid fa-receipt"></i></button>
                    <button class="icon-small" title="Restore"><i class="fa-solid fa-undo"></i></button>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
    
          <div class="cards" id="cardsList">
            <!-- mobile cards will be built by JS -->
          </div>
        </div>
    
        <footer style="margin-top:18px;color:var(--muted)">Tip: Use the New Payment button to record payments. Actions are demo-only.</footer>
    
        <!-- New Payment Modal -->
        <div class="modal" id="payModal" role="dialog" aria-modal="true" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:8px">
              <strong>Record Payment</strong>
              <button class="btn" id="closeModal"><i class="fa-solid fa-xmark"></i></button>
            </div>
    
            <div class="form">
              <div class="form-row">
                <input id="pGuest" placeholder="Guest name">
                <input id="pRef" placeholder="Reference (auto if empty)">
              </div>
    
              <div class="form-row">
                <input id="pRoom" placeholder="Room">
                <select id="pMethod">
                  <option>Card</option>
                  <option>Cash</option>
                  <option>Transfer</option>
                </select>
              </div>
    
              <div class="form-row">
                <input id="pDate" type="date">
                <input id="pAmount" type="number" placeholder="Amount">
              </div>
    
              <div style="display:flex;gap:8px;justify-content:flex-end;margin-top:8px">
                <button class="btn" id="cancelModal">Cancel</button>
                <button class="btn btn-primary" id="savePay">Save payment</button>
              </div>
            </div>
          </div>
        </div>
    
      </main>
    
      <script>
        (function(){
          const list = document.getElementById('paymentsList');
          const cardsList = document.getElementById('cardsList');
          const search = document.getElementById('paySearch');
          const statusFilter = document.getElementById('statusFilter');
          const methodFilter = document.getElementById('methodFilter');
    
          function rows(){ return Array.from(list.querySelectorAll('tr')); }
    
          function refresh(){
            const q = search.value.trim().toLowerCase();
            const status = statusFilter.value;
            const method = methodFilter.value;
            let visible = 0;
            rows().forEach(r => {
              const text = (r.textContent || '').toLowerCase();
              const matches = (!q || text.includes(q)) && (!status || r.dataset.status === status) && (!method || r.dataset.method === method);
              r.style.display = matches ? '' : 'none';
              if (matches) visible++;
            });
            buildCards();
          }
    
          function buildCards(){
            const visibleRows = rows().filter(r => r.style.display !== 'none');
            cardsList.innerHTML = '';
            visibleRows.forEach(r => {
              const guest = r.children[0].querySelector('strong')?.textContent || '';
              const email = r.children[0].querySelector('.small')?.textContent || '';
              const ref = r.children[1].textContent;
              const room = r.children[2].textContent;
              const date = r.children[3].textContent;
              const amount = r.children[4].textContent;
              const status = r.dataset.status || '';
              const card = document.createElement('div');
              card.className = 'card';
              card.innerHTML = `
                <div style="display:flex;justify-content:space-between;align-items:center">
                  <div>
                    <strong>${guest}</strong>
                    <div class="small" style="color:var(--muted)">${email}</div>
                    <div class="small" style="color:var(--muted)">${room} • ${date}</div>
                  </div>
                  <div style="text-align:right">
                    <div><strong>${amount}</strong></div>
                    <div class="status ${status}" style="margin-top:6px">${status ? status.charAt(0).toUpperCase() + status.slice(1) : ''}</div>
                  </div>
                </div>
                <div class="row" style="margin-top:8px;display:flex;justify-content:space-between;align-items:center">
                  <div class="small muted">${ref}</div>
                  <div class="actions">
                    <button class="icon-small" title="Receipt"><i class="fa-solid fa-receipt"></i></button>
                    <button class="icon-small" title="Refund"><i class="fa-solid fa-rotate-left"></i></button>
                  </div>
                </div>
              `;
              cardsList.appendChild(card);
            });
          }
    
          document.getElementById('doSearch').addEventListener('click', refresh);
          search.addEventListener('keyup', (e)=> { if (e.key === 'Enter') refresh(); });
          statusFilter.addEventListener('change', refresh);
          methodFilter.addEventListener('change', refresh);
    
          // modal controls
          const modal = document.getElementById('payModal');
          const newBtn = document.getElementById('newPaymentBtn');
          const closeModal = document.getElementById('closeModal');
          const cancelModal = document.getElementById('cancelModal');
          const savePay = document.getElementById('savePay');
    
          function open(){ modal.classList.add('open'); modal.setAttribute('aria-hidden','false'); }
          function close(){ modal.classList.remove('open'); modal.setAttribute('aria-hidden','true'); }
    
          newBtn.addEventListener('click', open);
          closeModal.addEventListener('click', close);
          cancelModal.addEventListener('click', close);
          modal.addEventListener('click', (e)=> { if (e.target === modal) close(); });
    
          // demo save
          savePay.addEventListener('click', () => {
            const guest = document.getElementById('pGuest').value.trim() || 'Guest';
            const ref = document.getElementById('pRef').value.trim() || 'PAY-' + Math.floor(Math.random()*900+100);
            const room = document.getElementById('pRoom').value.trim() || 'Room';
            const date = document.getElementById('pDate').value || new Date().toISOString().slice(0,10);
            const amount = Number(document.getElementById('pAmount').value || 0);
            const method = document.getElementById('pMethod').value || 'Card';
            const status = amount > 0 ? 'paid' : 'pending';
    
            const tr = document.createElement('tr');
            tr.dataset.status = status;
            tr.dataset.method = method;
            tr.dataset.amount = amount;
            tr.innerHTML = `
              <td><strong>${guest}</strong><div class="small" style="color:var(--muted)">${'—'}</div></td>
              <td>${ref}</td>
              <td>${room}</td>
              <td class="small" style="color:var(--muted)">${date}</td>
              <td><strong>$${amount}</strong></td>
              <td><div class="status ${status}">${status.charAt(0).toUpperCase()+status.slice(1)}</div></td>
              <td>
                <div class="actions">
                  <button class="icon-small" title="Receipt"><i class="fa-solid fa-receipt"></i></button>
                  <button class="icon-small" title="Refund"><i class="fa-solid fa-rotate-left"></i></button>
                </div>
              </td>
            `;
            list.prepend(tr);
            close();
            refresh();
          });
    
          // delegated actions
          list.addEventListener('click', (e) => {
            const btn = e.target.closest('button');
            if (!btn) return;
            const tr = btn.closest('tr');
            if (!tr) return;
            if (btn.title === 'Refund') {
              tr.dataset.status = 'refund';
              const st = tr.querySelector('.status');
              st.className = 'status refund';
              st.textContent = 'Refunded';
            } else if (btn.title === 'Confirm') {
              tr.dataset.status = 'paid';
              const st = tr.querySelector('.status');
              st.className = 'status paid';
              st.textContent = 'Paid';
            } else if (btn.title === 'Cancel') {
              tr.remove();
            } else if (btn.title === 'Receipt') {
              alert('Open receipt (demo): ' + (tr.children[1]?.textContent || '—'));
            } else if (btn.title === 'Restore') {
              tr.dataset.status = 'paid';
              const st = tr.querySelector('.status');
              if (st) { st.className = 'status paid'; st.textContent = 'Paid'; }
            }
            refresh();
          });
    
          document.getElementById('refreshBtn').addEventListener('click', ()=> { alert('Payments refreshed (demo)'); });
    
          // init
          refresh();
        })();
      </script>
    </body>
    </html>
   