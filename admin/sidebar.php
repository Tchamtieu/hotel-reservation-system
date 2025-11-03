<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
        <?php
   
    // Simple attractive sidebar (include this file in admin pages).
    // Ensure Font Awesome is loaded on pages that include this, or uncomment the CDN below.
    ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <aside class="admin-sidebar" id="adminSidebar" aria-label="Main sidebar">
      <!-- top spacer: leaves room for fixed topnav -->
      <div class="sidebar-top-space" role="presentation"></div>
    
      <div class="sidebar-inner">
        <div class="brand">
          <div class="brand-logo">AH</div>
          <div class="brand-text">
            <div class="brand-name">Afrique Hotel</div>
            <div class="brand-sub">Administrator</div>
          </div>
        </div>
    
        <nav class="menu" role="navigation" aria-label="Sidebar menu">
          <a class="menu-link active" href="dashboard.php"><i class="fa-solid fa-chart-pie"></i><span>Dashboard</span></a>
          <a class="menu-link" href="rooms.php"><i class="fa-solid fa-bed"></i><span>Rooms</span></a>
          <a class="menu-link" href="payment.php"><i class="fa-solid fa-dollar"></i><span>payment</span></a>
          <a class="menu-link" href="reservation.php"><i class="fa-solid fa-calendar-check"></i><span>Bookings</span></a>
          <a class="menu-link" href="guest.php"><i class="fa-solid fa-user-group"></i><span>Guests</span></a>
          <a class="menu-link" href="staff.php"><i class="fa-solid fa-id-badge"></i><span>Staff</span></a>
          <a class="menu-link" href="report.php"><i class="fa-solid fa-file-invoice-dollar"></i><span>Reports</span></a>
          <a class="menu-link" href="calendar.php"><i class="fa-solid fa-calendar"></i><span>Calendar</span></a>
          
        </nav>
    
        <div class="sidebar-footer">
          <button id="sidebarCollapseBtn" class="collapse-btn" aria-pressed="false" title="Collapse sidebar">
            <i class="fa-solid fa-chevron-left"></i>
          </button>
          <a class="logout-link" href="../logout.php"><i class="fa-solid fa-right-from-bracket"></i><span>Logout</span></a>
        </div>
      </div>
    </aside>
    
    <style>
      :root{
        --sb-width: 260px;
        --sb-collapsed: 72px;
        --sb-bg: linear-gradient(180deg,#071025,#081232);
        --accent: #7c3aed;
        --muted: #9aa6bd;
        --glass: rgba(255,255,255,0.02);
        --text: #e8f0ff;
      }
    
      /* Sidebar container */
      .admin-sidebar{
        position:fixed;
        top:0;
        left:0;
        bottom:0;
        width:var(--sb-width);
        background:var(--sb-bg);
        color:var(--text);
        box-shadow: 4px 0 24px rgba(2,6,23,0.6);
        z-index:1100;
        display:flex;
        flex-direction:column;
        transition:width .22s ease;
        overflow:visible;
        font-family:Inter,system-ui,Segoe UI,Roboto,Arial;
      }
    
      /* keep room for topnav: change this value if topnav height differs */
      .admin-sidebar .sidebar-top-space{height:68px;flex:0 0 auto}
    
      .sidebar-inner{
        display:flex;
        flex-direction:column;
        height:100%;
        padding:14px;
        gap:12px;
        box-sizing:border-box;
      }
    
      .brand{display:flex;align-items:center;gap:12px;padding:6px 4px}
      .brand-logo{
        width:48px;height:48px;border-radius:10px;background:linear-gradient(135deg,var(--accent),#06b6d4);display:grid;place-items:center;font-weight:800;color:white;font-size:18px;box-shadow:0 8px 20px rgba(124,58,237,0.12)
      }
      .brand-text{line-height:1}
      .brand-name{font-weight:700}
      .brand-sub{font-size:12px;color:var(--muted);margin-top:2px}
    
      .menu{display:flex;flex-direction:column;gap:6px;margin-top:8px;flex:1;overflow:auto;padding-right:6px}
      .menu-link{
        display:flex;align-items:center;gap:12px;padding:10px;border-radius:10px;color:var(--text);text-decoration:none;font-weight:600;
        transition:background .15s, transform .08s;
      }
      .menu-link i{width:20px;text-align:center;font-size:16px;color:var(--accent)}
      .menu-link span{white-space:nowrap}
      .menu-link:hover{background:rgba(255,255,255,0.02);transform:translateY(-1px)}
      .menu-link.active{background:linear-gradient(90deg, rgba(124,58,237,0.16), rgba(6,182,212,0.06));box-shadow:inset 0 0 0 1px rgba(255,255,255,0.02)}
    
      /* footer controls */
      .sidebar-footer{display:flex;align-items:center;gap:8px;justify-content:space-between;padding-top:6px;border-top:1px solid rgba(255,255,255,0.02)}
      .collapse-btn{
        background:transparent;border:0;color:var(--muted);padding:8px;border-radius:8px;cursor:pointer;display:inline-grid;place-items:center;
      }
      .collapse-btn:hover{background:rgba(255,255,255,0.02);color:var(--text)}
      .logout-link{display:flex;align-items:center;gap:8px;text-decoration:none;color:var(--muted);padding:8px;border-radius:8px}
      .logout-link i{color:#ff7b7b}
      .logout-link:hover{color:var(--text);background:rgba(255,255,255,0.02)}
    
      /* collapsed state */
      .admin-sidebar.collapsed{width:var(--sb-collapsed)}
      .admin-sidebar.collapsed .brand-text,
      .admin-sidebar.collapsed .menu-link span,
      .admin-sidebar.collapsed .logout-link span{display:none}
      .admin-sidebar.collapsed .menu-link{justify-content:center}
      .admin-sidebar.collapsed .sidebar-inner{padding-left:8px;padding-right:8px}
      .admin-sidebar.collapsed .collapse-btn{transform:rotate(180deg)}
    
      /* tooltips for collapsed icons */
      .admin-sidebar.collapsed .menu-link { position:relative }
      .admin-sidebar.collapsed .menu-link::after{
        content: attr(aria-label);
        position:absolute;
        left:100%;
        top:50%;
        transform:translateY(-50%);
        background:rgba(2,6,23,0.95);
        color:var(--text);
        padding:6px 10px;border-radius:8px;margin-left:10px;white-space:nowrap;opacity:0;pointer-events:none;transition:opacity .12s;
        font-size:13px;box-shadow:0 8px 24px rgba(2,6,23,0.6)
      }
      .admin-sidebar.collapsed .menu-link:hover::after{opacity:1}
    
      /* scrollbar (subtle) */
      .menu::-webkit-scrollbar{width:8px}
      .menu::-webkit-scrollbar-thumb{background:rgba(255,255,255,0.04);border-radius:8px}
    
      /* responsive: hide sidebar on small screens (toggle via event in JS) */
      @media (max-width:900px){
        .admin-sidebar{transform:translateX(0);transition:transform .18s ease}
        .admin-sidebar.hidden{transform:translateX(-110%)}
      }
    </style>
    
    <script>
      (function(){
        const sidebar = document.getElementById('adminSidebar');
        const collapseBtn = document.getElementById('sidebarCollapseBtn');
    
        // restore collapsed state from localStorage
        const key = 'admin_sidebar_collapsed';
        if (localStorage.getItem(key) === '1') sidebar.classList.add('collapsed');
    
        collapseBtn?.addEventListener('click', () => {
          const isCollapsed = sidebar.classList.toggle('collapsed');
          localStorage.setItem(key, isCollapsed ? '1' : '0');
          collapseBtn.setAttribute('aria-pressed', String(isCollapsed));
        });
    
        // optional: allow pages to toggle sidebar for small screens by dispatching 'toggleSidebar' event
        window.addEventListener('toggleSidebar', () => {
          // on small screens toggle visibility
          if (window.innerWidth <= 900) sidebar.classList.toggle('hidden');
          else sidebar.classList.toggle('collapsed');
        });
    
        // highlight current link (basic)
        (function markActive(){
          const links = sidebar.querySelectorAll('.menu-link');
          const path = location.pathname.split('/').pop();
          links.forEach(a => {
            const href = a.getAttribute('href') || '';
            if (href === path || href === './' + path) {
              links.forEach(l=>l.classList.remove('active'));
              a.classList.add('active');
            }
            // add accessible label for collapsed tooltip use
            a.setAttribute('aria-label', a.innerText.trim());
          });
        })();
      })();
    </script>
</body>
</html>