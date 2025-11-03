<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Admin Dashboard — Afrique Hotel</title>

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

  <!-- Chart.js -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

  <style>
    :root{
      --glass-bg: rgba(255,255,255,0.92);
      --accent: #4f46e5;
      --muted: #6b7280;
      --card-shadow: 0 8px 30px rgba(2,6,23,0.12);
    }
    html,body{height:100%;margin:0;font-family:Inter,system-ui,Segoe UI,Roboto,"Helvetica Neue",Arial;}
    body{
      background-image:
        linear-gradient(180deg, rgba(7,10,20,0.55), rgba(7,10,20,0.55)),
       /* url('https://images.unsplash.com/photo-1501117716987-c8e3cf9f6d30?q=80&w=1920&auto=format&fit=crop&ixlib=rb-4.0.3&s=0a2b2d2f8ee6b7ff7c5a2a2ed0e1868a'); */
      background-size:cover;
      background-position:center;
      padding:26px;
      box-sizing:border-box; color:#07101a;
    }

    .wrap{
      max-width:1200px;
      margin:0 auto;
      backdrop-filter: blur(6px);
       margin-left: 260px;
      transition: margin-left .22s ease;
    }
    

    header{display:flex;align-items:center;justify-content:space-between;margin-bottom:18px}
    .brand{display:flex;align-items:center;gap:12px;color:#fff}
    .logo{width:56px;height:56px;border-radius:12px;background:linear-gradient(135deg,var(--accent),#06b6d4);display:grid;place-items:center;color:#fff;font-weight:700;font-size:18px;box-shadow:0 8px 30px rgba(2,6,23,0.18)}
    .brand h1{margin:0;font-size:18px;color:white}
    .small-muted{color:rgba(255,255,255,0.9);font-size:13px}

    .controls{display:flex;gap:8px;align-items:center}
    .btn{background:var(--glass-bg);border:1px solid rgba(0,0,0,0.06);padding:8px 12px;border-radius:10px;color:#07101a;cursor:pointer;display:inline-flex;gap:8px;align-items:center;font-size:13px}
    .btn.primary{background:linear-gradient(90deg,var(--accent),#06b6d4);color:white;border:none}

    .grid{display:grid;grid-template-columns:repeat(12,1fr);gap:14px}
    .col-3{grid-column:span 3}
    .col-4{grid-column:span 4}
    .col-6{grid-column:span 6}
    .col-8{grid-column:span 8}
    .col-12{grid-column:span 12}

    .card{background:var(--glass-bg);border-radius:12px;padding:14px;box-shadow:var(--card-shadow)}
    .stat{display:flex;align-items:center;gap:12px}
    .icon{width:48px;height:48px;border-radius:10px;display:grid;place-items:center;color:white;font-size:18px}
    .stat .text small{display:block;color:var(--muted);font-size:12px}
    .stat .text .value{font-size:18px;font-weight:700}

    .chart-wrap{height:260px;padding:6px}
    .chart-small{height:150px} /* for smaller pies */

    ul.list-compact{list-style:none;padding:0;margin:0}
    .list-item{display:flex;justify-content:space-between;align-items:center;padding:10px 6px;border-bottom:1px solid rgba(11,17,32,0.04);font-size:14px}
    .badge{padding:6px 8px;border-radius:8px;font-size:12px;color:white}

    @media (max-width:900px){
      .col-3,.col-4,.col-6,.col-8{grid-column:span 12}
      header{flex-direction:column;align-items:flex-start;gap:12px}
      .wrap{margin-left:50px;}

    }
  </style>
</head>
<body>
  <?php
    // include top navigation and fixed sidebar immediately after <body>
    // ensure path is correct
    include('sidebar.php');  // ensure path is correct
  ?>
  <div class="wrap">
    <header>
      <div class="brand">
        <div class="logo">AH</div>
        <div>
          <h1>Afrique Hotel — Dashboard</h1>
          <div class="small-muted">Overview • Revenue • Rooms • Staff</div>
        </div>
      </div>

      <div class="controls">
        <div class="btn"><i class="fa-solid fa-calendar-days"></i> Oct 2025</div>
        <button class="btn" id="refreshBtn"><i class="fa-solid fa-arrows-rotate"></i></button>
        <button class="btn primary" id="updateBtn"><i class="fa-solid fa-sync-alt"></i> Update</button>
      </div>
    </header>
   

    <main>
      <section class="grid" style="margin-bottom:14px">
        <div class="card col-3">
          <div class="stat">
            <div class="icon" style="background:#06b6d4"><i class="fa-solid fa-bed"></i></div>
            <div class="text">
              <small>Total Rooms</small>
              <div class="value" id="totalRooms">—</div>
            </div>
          </div>
        </div>

        <div class="card col-3">
          <div class="stat">
            <div class="icon" style="background:#f97316"><i class="fa-solid fa-users"></i></div>
            <div class="text">
              <small>Total Guests</small>
              <div class="value" id="totalGuests">—</div>
            </div>
          </div>
        </div>

        <div class="card col-3">
          <div class="stat">
            <div class="icon" style="background:#f43f5e"><i class="fa-solid fa-id-badge"></i></div>
            <div class="text">
              <small>Staff Members</small>
              <div class="value" id="totalStaff">—</div>
            </div>
          </div>
        </div>

        <div class="card col-3">
          <div class="stat">
            <div class="icon" style="background:#6366f1"><i class="fa-solid fa-dollar-sign"></i></div>
            <div class="text">
              <small>Total Revenue</small>
              <div class="value" id="totalRevenue">—</div>
            </div>
          </div>
        </div>
      </section>

      <section class="grid" style="margin-bottom:14px">
        <div class="card col-6">
          <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:6px">
            <strong style="font-size:15px">Revenue (last 6 months)</strong>
            <small style="font-size:12px;color:var(--muted)">Monthly totals</small>
          </div>
          <div class="chart-wrap">
            <canvas id="revenueChart"></canvas>
          </div>
        </div>

        <div class="card col-6">
          <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:6px">
            <strong style="font-size:15px">Pies: Rooms • Staff • Customers</strong>
            <small style="font-size:12px;color:var(--muted)">Distribution</small>
          </div>

          <div style="display:grid;grid-template-columns:1fr 1fr;gap:8px">
            <div style="padding:6px">
              <canvas id="roomsPie" class="chart-small"></canvas>
              <div style="text-align:center;font-size:12px;color:var(--muted);margin-top:6px">Rooms status</div>
            </div>

            <div style="padding:6px">
              <canvas id="staffPie" class="chart-small"></canvas>
              <div style="text-align:center;font-size:12px;color:var(--muted);margin-top:6px">Staff performance</div>
            </div>

            <!-- <div style="padding:6px">
              <canvas id="customerPie" class="chart-small"></canvas>
              <div style="text-align:center;font-size:12px;color:var(--muted);margin-top:6px">Customers by country</div>
            </div> -->

            <div style="padding:6px;display:grid;place-items:center">
              <div style="font-size:12px;color:var(--muted)">Total occupied</div>
              <div id="occupiedPercent" style="font-weight:700;margin-top:6px">—</div>
            </div>
          </div>
        </div>
      </section>

      <section class="grid">
        <div class="card col-6">
          <strong style="font-size:15px">Recent Bookings</strong>
          <p class="small-muted" style="margin:6px 0 10px 0">Latest reservations</p>
          <ul class="list-compact" id="recentList"></ul>
        </div>

        <div class="card col-6">
          <strong style="font-size:15px">Quick Insights</strong>
          <p class="small-muted" style="margin:6px 0 10px 0">Auto metrics</p>
          <div style="display:flex;flex-direction:column;gap:8px;font-size:14px">
            <div class="list-item"><div><i class="fa-solid fa-clock"></i> Avg. Occupancy</div><div id="occupancy">—</div></div>
            <div class="list-item"><div><i class="fa-solid fa-star"></i> Avg. Rating</div><div id="rating">—</div></div>
            <div class="list-item"><div><i class="fa-solid fa-comment"></i> New Messages</div><div id="messages">—</div></div>
          </div>
        </div>
      </section>
    </main>
  </div>

  <script>
    // sample data (replace with backend data)
    const state = {
      totals: { rooms: 60, guests: 142, staff: 18, revenue: 9820 },
      revenueMonths: ['May','Jun','Jul','Aug','Sep','Oct'],
      revenueData: [2200, 2800, 2600, 3100, 2950, 3320],
      roomsLabels: ['Occupied','Available','Maintenance'],
      roomsData: [38, 18, 4],
      staffLabels: ['A. Mwangi','M. Smith','L. Chen','R. Patel'],
      staffData: [18, 14, 10, 8],
      customerLabels: ['Kenya','Nigeria','Cameroon','Uganda'],
      customerData: [50, 40, 30, 22],
      recent: [
        {id:1, guest:'Jane Doe', room:'Deluxe 101', checkin:'2025-10-15', checkout:'2025-10-18', status:'Checked-in'},
        {id:2, guest:'John Smith', room:'Suite 203', checkin:'2025-10-16', checkout:'2025-10-20', status:'Reserved'},
        {id:3, guest:'Ali Ahmed', room:'Standard 5', checkin:'2025-10-18', checkout:'2025-10-19', status:'Cancelled'}
      ],
      occupancy: '78%', rating: '4.6', messages: 3
    };

    // render totals
    document.getElementById('totalRooms').textContent = state.totals.rooms;
    document.getElementById('totalGuests').textContent = state.totals.guests;
    document.getElementById('totalStaff').textContent = state.totals.staff;
    document.getElementById('totalRevenue').textContent = '$' + state.totals.revenue.toLocaleString();
    document.getElementById('occupancy').textContent = state.occupancy;
    document.getElementById('rating').textContent = state.rating;
    document.getElementById('messages').textContent = state.messages;

    // recent bookings
    const recentList = document.getElementById('recentList');
    function renderRecent(){
      recentList.innerHTML = '';
      state.recent.forEach(r => {
        const li = document.createElement('li');
        li.className = 'list-item';
        li.innerHTML = `
          <div>
            <div style="font-weight:600">${r.guest} <span style="color:var(--muted);font-weight:400">• ${r.room}</span></div>
            <div style="font-size:12px;color:var(--muted)">${r.checkin} → ${r.checkout}</div>
          </div>
          <div style="text-align:right">
            <div class="badge" style="background:${statusColor(r.status)}">${r.status}</div>
            <div style="font-size:11px;color:var(--muted);margin-top:6px">#${r.id}</div>
          </div>`;
        recentList.appendChild(li);
      });
      // occupied percent
      const occupied = state.roomsData[0];
      const totalRooms = state.roomsData.reduce((a,b)=>a+b,0);
      const percent = totalRooms ? Math.round(occupied/totalRooms*100) : 0;
      document.getElementById('occupiedPercent').textContent = percent + '%';
    }
    function statusColor(s){
      s = (s||'').toLowerCase();
      if (s.includes('check')) return '#10b981';
      if (s.includes('reserved')||s.includes('pending')) return '#f59e0b';
      if (s.includes('cancel')) return '#ef4444';
      return '#6b7280';
    }
    renderRecent();

    // Chart defaults with reduced font sizes for compact display
    const commonOptions = {
      responsive:true,
      plugins:{
        legend:{ position:'bottom', labels:{font:{size:11}} },
        tooltip: { bodyFont: { size:12}, titleFont: { size:12 } }
      },
      scales: {
        x:{ ticks:{ font:{size:11} } },
        y:{ ticks:{ font:{size:11} }, beginAtZero:true }
      }
    };

    // revenue chart (bar + line)
    const revenueCtx = document.getElementById('revenueChart');
    const revenueChart = new Chart(revenueCtx, {
      type: 'bar',
      data: {
        labels: state.revenueMonths,
        datasets: [
          { label: 'Revenue', data: state.revenueData, backgroundColor: state.revenueData.map((_,i)=>`hsl(${(i*45)%360} 75% 50% / 0.9)`), borderRadius:6 },
          { type:'line', label:'Trend', data: state.revenueData, borderColor:'#0b69ff', tension:0.3, pointRadius:3, borderWidth:2, fill:false }
        ]
      },
      options: Object.assign({}, commonOptions, { plugins:{ legend:{ position:'top', labels:{font:{size:12}} } } })
    });

    // rooms pie (new)
    const roomsCtx = document.getElementById('roomsPie');
    const roomsChart = new Chart(roomsCtx, {
      type: 'doughnut',
      data: { labels: state.roomsLabels, datasets:[{ data: state.roomsData, backgroundColor: ['#10b981','#94a3b8','#f97316'] }] },
      options: { responsive:true, plugins:{ legend:{ position:'bottom', labels:{font:{size:10}} }, tooltip:{ bodyFont:{size:11} } } }
    });

    // staff donut
    const staffCtx = document.getElementById('staffPie');
    const staffChart = new Chart(staffCtx, {
      type: 'doughnut',
      data: { labels: state.staffLabels, datasets:[{ data: state.staffData, backgroundColor: ['#06b6d4','#6366f1','#f97316','#f43f5e'] }] },
      options: { responsive:true, plugins:{ legend:{ position:'bottom', labels:{font:{size:10}} } } }
    });

    // customer pie
    const custCtx = document.getElementById('customerPie');
    const customerChart = new Chart(custCtx, {
      type: 'pie',
      data: { labels: state.customerLabels, datasets:[{ data: state.customerData, backgroundColor: ['#06b6d4','#0ea5a4','#f97316','#ef4444'] }] },
      options: { responsive:true, plugins:{ legend:{ position:'bottom', labels:{font:{size:10}} } } }
    });

    // interactions
    document.getElementById('updateBtn').addEventListener('click', () => {
      // simulate small changes and re-render charts
      state.revenueData = state.revenueData.map(v => Math.round(v * (0.9 + Math.random()*0.2)));
      state.roomsData = state.roomsData.map(v => Math.max(1, Math.round(v * (0.9 + Math.random()*0.2))));
      state.totals.revenue = state.revenueData.reduce((a,b)=>a+b,0);
      document.getElementById('totalRevenue').textContent = '$' + Math.round(state.totals.revenue).toLocaleString();
      revenueChart.data.datasets[0].data = state.revenueData;
      revenueChart.data.datasets[1].data = state.revenueData;
      roomsChart.data.datasets[0].data = state.roomsData;
      roomsChart.update();
      revenueChart.update();
      renderRecent();
    });

    document.getElementById('refreshBtn').addEventListener('click', () => {
      revenueChart.update(); roomsChart.update(); staffChart.update(); customerChart.update();
      alert('Refreshed (demo). Replace with fetch() to load real data.');
    });
  </script>
</body>
</html>