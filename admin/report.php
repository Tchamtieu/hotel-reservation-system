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
      <title>Reports — Admin — Afrique Hotel</title>
    
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
      <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    
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
    
        .kpi-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:14px;margin-bottom:18px}
        @media (max-width:980px){ .kpi-grid{grid-template-columns:repeat(2,1fr)} }
        @media (max-width:640px){ .kpi-grid{grid-template-columns:repeat(1,1fr)} }
    
        .kpi{
          background:var(--card-bg);padding:16px;border-radius:12px;box-shadow:0 10px 30px rgba(2,6,23,0.5);display:flex;flex-direction:column;gap:8px;
        }
        .kpi .num{font-size:22px;font-weight:800}
        .kpi .muted{color:var(--muted);font-size:13px}
    
        .charts{display:flex;gap:14px;margin-bottom:18px}
        @media (max-width:900px){ .charts{flex-direction:column} }
        .chart-card{flex:1;background:var(--card-bg);padding:12px;border-radius:12px;box-shadow:0 12px 36px rgba(2,6,23,0.45)}
    
        .report-table{background:var(--card-bg);padding:12px;border-radius:12px;box-shadow:0 12px 36px rgba(2,6,23,0.45);margin-top:12px}
        table{width:100%;border-collapse:collapse;font-size:14px}
        th,td{padding:10px;text-align:left;border-bottom:1px dashed rgba(255,255,255,0.03)}
        thead th{color:var(--muted);font-weight:700}
    
        .export-actions{display:flex;gap:8px;align-items:center}
    
        .small{font-size:13px;color:var(--muted)}
      </style>
    </head>
    <body>
      <?php
        include('topnav.php');
        include('sidebar.php');
      ?>
    
      <main class="main-wrap" role="main" aria-label="Reports admin">
        <header class="page-header">
          <div class="title">
            <div class="logo">AH</div>
            <div>
              <h1>Reports</h1>
              <p class="small">Revenue, occupancy, and performance over time</p>
            </div>
          </div>
    
          <div class="controls">
            <div class="small">Signed in as <strong><?= $userName ?></strong></div>
            <div class="export-actions">
              <button class="btn btn-ghost" id="refreshBtn"><i class="fa-solid fa-arrows-rotate"></i></button>
              <button class="btn" id="exportCsv"><i class="fa-regular fa-file-csv"></i> CSV</button>
              <button class="btn btn-primary" id="exportPng"><i class="fa-solid fa-download"></i> Export PNG</button>
            </div>
          </div>
        </header>
    
        <section class="kpi-grid" aria-label="Key performance indicators">
          <div class="kpi">
            <div class="small">Total revenue (YTD)</div>
            <div class="num" id="revNum">$128,450</div>
            <div class="small muted">Compared to last year: +12%</div>
          </div>
    
          <div class="kpi">
            <div class="small">Average occupancy</div>
            <div class="num" id="occNum">78%</div>
            <div class="small muted">Peak: 95% (Aug)</div>
          </div>
    
          <div class="kpi">
            <div class="small">Avg. rate per night</div>
            <div class="num" id="adrNum">$142</div>
            <div class="small muted">ADR improved by 6%</div>
          </div>
        </section>
    
        <section class="charts" aria-label="Charts">
          <div class="chart-card">
            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:8px">
              <strong>Monthly Revenue</strong>
              <div class="small muted">Last 12 months</div>
            </div>
            <canvas id="revChart" height="140" aria-label="Revenue chart"></canvas>
          </div>
    
          <div class="chart-card">
            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:8px">
              <strong>Occupancy %</strong>
              <div class="small muted">Last 12 months</div>
            </div>
            <canvas id="occChart" height="140" aria-label="Occupancy chart"></canvas>
          </div>
        </section>
    
        <section class="report-table" aria-label="Monthly summary">
          <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:8px">
            <strong>Monthly summary</strong>
            <div class="small muted">Revenue, occupancy and ADR by month</div>
          </div>
    
          <table id="summaryTable" role="table" aria-label="Summary table">
            <thead>
              <tr><th>Month</th><th>Revenue</th><th>Occupancy</th><th>ADR</th></tr>
            </thead>
            <tbody>
              <!-- sample rows -->
              <tr><td>Nov 2024</td><td>9,500</td><td>72%</td><td>135</td></tr>
              <tr><td>Dec 2024</td><td>12,100</td><td>81%</td><td>148</td></tr>
              <tr><td>Jan 2025</td><td>8,700</td><td>68%</td><td>128</td></tr>
              <tr><td>Feb 2025</td><td>10,300</td><td>75%</td><td>136</td></tr>
              <tr><td>Mar 2025</td><td>11,200</td><td>79%</td><td>142</td></tr>
              <tr><td>Apr 2025</td><td>9,900</td><td>74%</td><td>137</td></tr>
              <tr><td>May 2025</td><td>10,800</td><td>77%</td><td>140</td></tr>
              <tr><td>Jun 2025</td><td>11,600</td><td>80%</td><td>145</td></tr>
              <tr><td>Jul 2025</td><td>13,900</td><td>88%</td><td>152</td></tr>
              <tr><td>Aug 2025</td><td>14,800</td><td>95%</td><td>158</td></tr>
              <tr><td>Sep 2025</td><td>12,400</td><td>83%</td><td>146</td></tr>
              <tr><td>Oct 2025</td><td>13,550</td><td>86%</td><td>150</td></tr>
            </tbody>
          </table>
        </section>
      </main>
    
      <script>
        // sample data
        const months = ['Nov','Dec','Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct'];
        const revenue = [9500,12100,8700,10300,11200,9900,10800,11600,13900,14800,12400,13550];
        const occupancy = [72,81,68,75,79,74,77,80,88,95,83,86];
        const adr = [135,148,128,136,142,137,140,145,152,158,146,150];
    
        // revenue chart
        const revCtx = document.getElementById('revChart').getContext('2d');
        const revChart = new Chart(revCtx, {
          type: 'line',
          data: {
            labels: months,
            datasets: [{
              label: 'Revenue',
              data: revenue,
              borderColor: 'rgba(124,58,237,0.95)',
              backgroundColor: 'rgba(124,58,237,0.12)',
              tension: 0.32,
              fill: true,
              pointRadius: 4
            }]
          },
          options: {
            plugins:{legend:{display:false}},
            scales:{
              y:{ beginAtZero:true, ticks:{color:'#cbd5e1'} },
              x:{ ticks:{color:'#cbd5e1'} }
            }
          }
        });
    
        // occupancy chart
        const occCtx = document.getElementById('occChart').getContext('2d');
        const occChart = new Chart(occCtx, {
          type: 'bar',
          data: {
            labels: months,
            datasets: [{
              label: 'Occupancy %',
              data: occupancy,
              backgroundColor: occupancy.map(v => v > 85 ? 'rgba(6,182,212,0.9)' : 'rgba(124,58,237,0.85)'),
              borderRadius: 6
            }]
          },
          options:{
            plugins:{legend:{display:false}},
            scales:{
              y:{ beginAtZero:true, max:100, ticks:{color:'#cbd5e1'} },
              x:{ ticks:{color:'#cbd5e1'} }
            }
          }
        });
    
        // exports
        function tableToCSV(table) {
          const rows = Array.from(table.querySelectorAll('tr'));
          return rows.map(r => Array.from(r.querySelectorAll('th,td')).map(cell => `"${(cell.textContent||'').trim().replace(/"/g,'""')}"`).join(',')).join('\n');
        }
    
        document.getElementById('exportCsv').addEventListener('click', () => {
          const csv = tableToCSV(document.getElementById('summaryTable'));
          const blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
          const url = URL.createObjectURL(blob);
          const a = document.createElement('a');
          a.href = url;
          a.download = 'monthly-summary.csv';
          a.click();
          URL.revokeObjectURL(url);
        });
    
        document.getElementById('exportPng').addEventListener('click', async () => {
          // combine both charts into one image: draw canvases onto a single canvas
          const c1 = document.getElementById('revChart');
          const c2 = document.getElementById('occChart');
          const w = Math.max(c1.width, c2.width);
          const h = c1.height + c2.height + 24;
          const out = document.createElement('canvas');
          out.width = w;
          out.height = h;
          const ctx = out.getContext('2d');
          ctx.fillStyle = '#051226';
          ctx.fillRect(0,0,w,h);
          ctx.drawImage(c1, 0, 0);
          ctx.drawImage(c2, 0, c1.height + 24);
          out.toBlob((blob) => {
            const url = URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = 'reports.png';
            a.click();
            URL.revokeObjectURL(url);
          });
        });
    
        document.getElementById('refreshBtn').addEventListener('click', ()=> { alert('Reports refreshed (demo)'); });
      </script>
    </body>
    </html>
</body>
</html>