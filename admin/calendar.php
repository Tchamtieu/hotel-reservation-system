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
      <title>Calendar — Admin — Afrique Hotel</title>
    
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
    
        .main-wrap{max-width:1200px;margin:28px auto;padding:18px;margin-left: calc(var(--sb-width) + 28px);margin-top:78px;transition: margin-left .22s ease;}
        @media (max-width:920px){ .main-wrap{ margin-left:18px; margin-right:18px; margin-top:86px; } }
    
        .page-header{display:flex;align-items:center;justify-content:space-between;gap:12px;margin-bottom:18px}
        .title{display:flex;gap:12px;align-items:center}
        .logo{width:52px;height:52px;border-radius:10px;background:linear-gradient(135deg,var(--accent),var(--accent-2));display:grid;place-items:center;font-weight:800;color:white;font-size:18px}
        .title h1{margin:0;font-size:20px}
        .small{font-size:13px;color:var(--muted)}
    
        .controls{display:flex;gap:8px;align-items:center}
        .btn{padding:8px 12px;border-radius:10px;border:0;background:transparent;color:var(--text);cursor:pointer}
        .btn-primary{background:linear-gradient(90deg,var(--accent),var(--accent-2));color:white}
        .btn-ghost{border:1px solid rgba(255,255,255,0.04)}
    
        .layout{display:grid;grid-template-columns:1fr 340px;gap:16px;align-items:start}
        @media (max-width:980px){ .layout{grid-template-columns:1fr} }
    
        .cal-card{background:var(--card-bg);padding:14px;border-radius:12px;box-shadow:0 12px 36px rgba(2,6,23,0.45)}
        .cal-header{display:flex;align-items:center;justify-content:space-between;margin-bottom:12px}
        .nav{display:flex;gap:8px;align-items:center}
        .month-title{font-weight:800}
    
        .weekdays{display:grid;grid-template-columns:repeat(7,1fr);gap:8px;margin-bottom:8px}
        .weekdays div{color:var(--muted);font-size:13px;text-align:center}
    
        .grid{display:grid;grid-template-columns:repeat(7,1fr);gap:8px}
        .day{
          min-height:100px;background:rgba(255,255,255,0.01);border-radius:10px;padding:8px;position:relative;overflow:hidden;
          border:1px solid rgba(255,255,255,0.02)
        }
        .day.inactive{opacity:.35}
        .day .date{position:absolute;top:8px;right:8px;font-size:12px;color:var(--muted)}
        .events{display:flex;flex-direction:column;gap:6px;margin-top:22px;max-height:70px;overflow:auto;padding-right:4px}
        .event{
          display:flex;gap:8px;align-items:center;background:rgba(255,255,255,0.02);padding:6px;border-radius:8px;font-size:13px;
          cursor:pointer;border:1px solid rgba(255,255,255,0.01)
        }
        .event img{width:40px;height:36px;object-fit:cover;border-radius:6px;flex-shrink:0}
    
        .sidebar .upcoming{display:flex;flex-direction:column;gap:10px}
        .up-card{background:var(--card-bg);padding:10px;border-radius:10px;display:flex;gap:10px;align-items:center}
        .up-card img{width:68px;height:56px;object-fit:cover;border-radius:8px}
    
        .legend{display:flex;gap:8px;flex-wrap:wrap;margin-top:8px}
        .badge{background:rgba(124,58,237,0.12);color:var(--accent);padding:6px 10px;border-radius:10px;font-weight:700;font-size:12px}
    
        /* modal */
        .modal{position:fixed;inset:0;display:none;align-items:center;justify-content:center;background:rgba(2,6,23,0.6);z-index:1400;padding:20px}
        .modal.open{display:flex}
        .modal-dialog{width:100%;max-width:720px;background:var(--card-bg);border-radius:12px;padding:18px;box-shadow:0 20px 60px rgba(2,6,23,0.6)}
        .form-row{display:flex;gap:10px;margin-bottom:10px}
        .form-row input,.form-row select,textarea{flex:1;padding:10px;border-radius:8px;border:0;background:rgba(255,255,255,0.01);color:var(--text);outline:none}
        textarea{min-height:90px}
        .muted{color:var(--muted)}
      </style>
    </head>
    <body>
      <?php
        include('topnav.php');
        include('sidebar.php');
      ?>
    
      <main class="main-wrap" role="main" aria-label="Calendar admin">
        <header class="page-header">
          <div class="title">
            <div class="logo">AH</div>
            <div>
              <h1>Calendar</h1>
              <p class="small">Manage events: trainings, weddings, conferences and more</p>
            </div>
          </div>
    
          <div class="controls">
            <div class="small">Signed in as <strong><?= $userName ?></strong></div>
            <button class="btn btn-ghost" id="refreshBtn"><i class="fa-solid fa-arrows-rotate"></i></button>
            <button class="btn btn-primary" id="newEventBtn"><i class="fa-solid fa-plus"></i> New Event</button>
          </div>
        </header>
    
        <div class="layout">
          <section class="cal-card" aria-label="Monthly calendar">
            <div class="cal-header">
              <div class="nav">
                <button class="btn" id="prev"><i class="fa-solid fa-chevron-left"></i></button>
                <div class="month-title" id="monthLabel">November 2025</div>
                <button class="btn" id="next"><i class="fa-solid fa-chevron-right"></i></button>
              </div>
              <div class="legend">
                <div class="badge"><i class="fa-solid fa-person"></i>&nbsp;Staff</div>
                <div class="badge" style="background:rgba(6,182,212,0.12);color:var(--accent-2)"><i class="fa-solid fa-heart"></i>&nbsp;Private</div>
                <div class="badge" style="background:rgba(250,204,21,0.08);color:#facc15"><i class="fa-solid fa-martini-glass"></i>&nbsp;Event</div>
              </div>
            </div>
    
            <div class="weekdays">
              <div>Sun</div><div>Mon</div><div>Tue</div><div>Wed</div><div>Thu</div><div>Fri</div><div>Sat</div>
            </div>
    
            <div class="grid" id="calendarGrid" role="grid" aria-label="Days of month"></div>
          </section>
    
          <aside class="sidebar">
            <div class="cal-card" style="margin-bottom:12px">
              <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:8px">
                <strong>Upcoming events</strong>
                <div class="small muted" id="upcomingCount">3</div>
              </div>
              <div class="upcoming" id="upcomingList"></div>
            </div>
    
            <div class="cal-card">
              <strong>Filters</strong>
              <div style="margin-top:8px" class="small muted">Show events</div>
              <div style="display:flex;gap:8px;margin-top:10px">
                <select id="typeFilter" class="small" style="width:100%">
                  <option value="">All types</option>
                  <option value="staff">Staff</option>
                  <option value="private">Private</option>
                  <option value="event">Event</option>
                </select>
              </div>
            </div>
          </aside>
        </div>
    
        <footer style="margin-top:18px;color:var(--muted)">Click a day or "New Event" to add events. Add an image URL to show a preview.</footer>
      </main>
    
      <!-- New Event Modal -->
      <div class="modal" id="eventModal" aria-hidden="true" role="dialog" aria-modal="true">
        <div class="modal-dialog" role="document">
          <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:8px">
            <strong id="modalTitle">New Event</strong>
            <button class="btn" id="closeModal"><i class="fa-solid fa-xmark"></i></button>
          </div>
    
          <div class="form">
            <div class="form-row">
              <input id="eTitle" placeholder="Event title">
              <input id="eDate" type="date">
            </div>
    
            <div class="form-row">
              <select id="eType">
                <option value="event">Event</option>
                <option value="staff">Staff</option>
                <option value="private">Private</option>
              </select>
              <input id="eTime" type="time" placeholder="Time">
            </div>
    
            <div class="form-row">
              <input id="eImage" placeholder="Image URL (optional)">
              <input id="eVenue" placeholder="Venue (e.g. Banquet Hall)">
            </div>
    
            <div style="margin-bottom:8px">
              <textarea id="eNotes" placeholder="Notes"></textarea>
            </div>
    
            <div style="display:flex;gap:8px;justify-content:flex-end">
              <button class="btn" id="cancelModal">Cancel</button>
              <button class="btn btn-primary" id="saveEvent">Save event</button>
            </div>
          </div>
        </div>
      </div>
    
      <script>
        (function(){
          // sample events
          let events = [
            { id:1, title:'Staff training: Front Desk', date:'2025-11-05', time:'09:00', type:'staff', img:'https://images.unsplash.com/photo-1522071820081-009f0129c71c?q=80&w=800&auto=format&fit=crop', venue:'Conference Room', notes:'Customer service and PMS refresher' },
            { id:2, title:'M. & A. Wedding', date:'2025-11-15', time:'16:00', type:'private', img:'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?q=80&w=800&auto=format&fit=crop', venue:'Garden Terrace', notes:'150 guests' },
            { id:3, title:'Corporate Dinner', date:'2025-11-22', time:'19:30', type:'event', img:'https://images.unsplash.com/photo-1541542684-2f3f1f6c3b02?q=80&w=800&auto=format&fit=crop', venue:'Ballroom', notes:'AV required' }
          ];
    
          const grid = document.getElementById('calendarGrid');
          const monthLabel = document.getElementById('monthLabel');
          const prev = document.getElementById('prev'), next = document.getElementById('next');
          const upList = document.getElementById('upcomingList'), upCount = document.getElementById('upcomingCount');
          const typeFilter = document.getElementById('typeFilter');
    
          let viewDate = new Date(); // current month
          viewDate.setDate(1);
    
          function startOfMonth(d){ return new Date(d.getFullYear(), d.getMonth(), 1); }
          function daysInMonth(d){ return new Date(d.getFullYear(), d.getMonth()+1, 0).getDate(); }
    
          function render(){
            const year = viewDate.getFullYear(), month = viewDate.getMonth();
            monthLabel.textContent = viewDate.toLocaleString(undefined,{month:'long', year:'numeric'});
            grid.innerHTML = '';
    
            const firstDay = new Date(year, month, 1).getDay(); // 0-6
            const total = daysInMonth(viewDate);
            const cells = firstDay + total;
            const weeks = Math.ceil(cells / 7) * 7;
    
            // filter type
            const filterType = typeFilter.value;
    
            for(let i=0; i<weeks; i++){
              const dayIndex = i - firstDay + 1;
              const cell = document.createElement('div');
              cell.className = 'day';
              if(dayIndex < 1 || dayIndex > total){
                cell.classList.add('inactive');
                cell.innerHTML = '<div class="date"></div>';
              } else {
                const dateStr = `${year}-${String(month+1).padStart(2,'0')}-${String(dayIndex).padStart(2,'0')}`;
                cell.dataset.date = dateStr;
                cell.innerHTML = `<div class="date">${dayIndex}</div><div class="events" aria-live="polite"></div>`;
                const evWrap = cell.querySelector('.events');
                const todays = events.filter(ev => ev.date === dateStr && (!filterType || ev.type === filterType));
                todays.forEach(ev => {
                  const div = document.createElement('div');
                  div.className = 'event';
                  div.dataset.id = ev.id;
                  div.innerHTML = `<img src="${ev.img||'https://images.unsplash.com/photo-1547425260-76bcadfb4f2c?q=80&w=800&auto=format&fit=crop'}" alt=""><div style="flex:1"><strong style="display:block">${ev.title}</strong><div class="muted">${ev.time || ''} • ${ev.venue || ''}</div></div>`;
                  div.addEventListener('click', ()=> showEvent(ev));
                  evWrap.appendChild(div);
                });
                // allow adding by clicking empty area
                cell.addEventListener('dblclick', ()=> openModalFor(dateStr));
              }
              grid.appendChild(cell);
            }
            renderUpcoming();
          }
    
          function renderUpcoming(){
            const today = new Date();
            const future = events.slice().filter(ev => new Date(ev.date) >= new Date(today.getFullYear(), today.getMonth(), today.getDate()));
            future.sort((a,b)=> new Date(a.date) - new Date(b.date) || (a.time || '').localeCompare(b.time||''));
            upList.innerHTML = '';
            future.slice(0,6).forEach(ev => {
              const el = document.createElement('div');
              el.className = 'up-card';
              el.innerHTML = `<img src="${ev.img||'https://images.unsplash.com/photo-1547425260-76bcadfb4f2c?q=80&w=800&auto=format&fit=crop'}" alt="${ev.title}"><div style="flex:1"><strong>${ev.title}</strong><div class="muted">${ev.date} ${ev.time || ''}</div><div class="muted">${ev.venue || ''}</div></div>`;
              upList.appendChild(el);
            });
            upCount.textContent = future.length;
          }
    
          function showEvent(ev){
            // quick detail in modal for now
            document.getElementById('modalTitle').textContent = 'Event details';
            document.getElementById('eTitle').value = ev.title;
            document.getElementById('eDate').value = ev.date;
            document.getElementById('eTime').value = ev.time || '';
            document.getElementById('eType').value = ev.type || 'event';
            document.getElementById('eImage').value = ev.img || '';
            document.getElementById('eVenue').value = ev.venue || '';
            document.getElementById('eNotes').value = ev.notes || '';
            openModal(ev.id);
          }
    
          // modal controls
          const modal = document.getElementById('eventModal');
          const newBtn = document.getElementById('newEventBtn');
          const closeModal = document.getElementById('closeModal');
          const cancelModal = document.getElementById('cancelModal');
          const saveBtn = document.getElementById('saveEvent');
          let editingId = null;
    
          function openModal(id=null){
            editingId = id || null;
            if(!id){
              document.getElementById('modalTitle').textContent = 'New Event';
              document.getElementById('eTitle').value = '';
              const todayISO = new Date().toISOString().slice(0,10);
              document.getElementById('eDate').value = todayISO;
              document.getElementById('eTime').value = '';
              document.getElementById('eType').value = 'event';
              document.getElementById('eImage').value = '';
              document.getElementById('eVenue').value = '';
              document.getElementById('eNotes').value = '';
            } else {
              document.getElementById('modalTitle').textContent = 'Edit Event';
            }
            modal.classList.add('open');
            modal.setAttribute('aria-hidden','false');
          }
          function close(){ modal.classList.remove('open'); modal.setAttribute('aria-hidden','true'); editingId = null; document.getElementById('modalTitle').textContent = 'New Event'; }
    
          newBtn.addEventListener('click', ()=> openModal());
          closeModal.addEventListener('click', close);
          cancelModal.addEventListener('click', close);
          modal.addEventListener('click', (e)=> { if (e.target === modal) close(); });
    
          saveBtn.addEventListener('click', ()=>{
            const title = document.getElementById('eTitle').value.trim() || 'Untitled';
            const date = document.getElementById('eDate').value;
            const time = document.getElementById('eTime').value;
            const type = document.getElementById('eType').value;
            const img = document.getElementById('eImage').value.trim();
            const venue = document.getElementById('eVenue').value.trim();
            const notes = document.getElementById('eNotes').value.trim();
    
            if(!date){ alert('Select a date'); return; }
    
            if(editingId){
              const ev = events.find(x=>x.id===editingId);
              if(ev){ Object.assign(ev, {title,date,time,type,img,venue,notes}); }
            } else {
              const id = Math.max(0,...events.map(e=>e.id))+1;
              events.push({ id, title, date, time, type, img, venue, notes });
            }
            close();
            render();
          });
    
          // keyboard: delete event when editing modal and press Delete key
          document.addEventListener('keydown', (e)=>{
            if(e.key === 'Delete' && editingId){
              events = events.filter(x=>x.id !== editingId);
              close();
              render();
            }
          });
    
          // navigation
          prev.addEventListener('click', ()=> { viewDate.setMonth(viewDate.getMonth() - 1); render(); });
          next.addEventListener('click', ()=> { viewDate.setMonth(viewDate.getMonth() + 1); render(); });
    
          // quick add when double-click day
          function openModalFor(dateStr){
            openModal();
            document.getElementById('eDate').value = dateStr;
          }
    
          // filters & refresh
          typeFilter.addEventListener('change', render);
          document.getElementById('refreshBtn').addEventListener('click', ()=> { alert('Calendar refreshed (demo)'); render(); });
    
          // initial render
          render();
        })();
      </script>
    </body>
    </html>
   