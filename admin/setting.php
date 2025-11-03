<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
   
    // ...existing code...
    <?php
    if (session_status() !== PHP_SESSION_ACTIVE) session_start();
    $userName = htmlspecialchars($_SESSION['user_name'] ?? 'Admin', ENT_QUOTES, 'UTF-8');
    $avatar = htmlspecialchars($_SESSION['user_avatar'] ?? '../images/admin.jpg', ENT_QUOTES, 'UTF-8');
    ?>
    <!doctype html>
    <html lang="en" data-theme="dark">
    <head>
      <meta charset="utf-8" />
      <meta name="viewport" content="width=device-width,initial-scale=1" />
      <title>Settings — Admin — Afrique Hotel</title>
    
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
          --input-bg: rgba(255,255,255,0.02);
          --border: rgba(255,255,255,0.04);
        }
    
        html[data-theme="light"]{
          --glass: rgba(2,6,23,0.03);
          --card-bg: linear-gradient(180deg, rgba(2,6,23,0.01), rgba(2,6,23,0.01));
          --page-bg: linear-gradient(180deg,#f8fafc,#eef2ff);
          --text: #0b1220;
          --muted: #475569;
          --input-bg: rgba(0,0,0,0.03);
          --border: rgba(15,23,42,0.06);
        }
    
        *{box-sizing:border-box}
        html,body{height:100%;margin:0;font-family:Inter,system-ui,Segoe UI,Roboto,Arial;background:var(--page-bg);color:var(--text);-webkit-font-smoothing:antialiased}
        a{color:inherit;text-decoration:none}
    
        .main-wrap{max-width:1100px;margin:28px auto;padding:18px;margin-left: calc(var(--sb-width) + 28px);margin-top:78px;transition: margin-left .22s ease;}
        @media (max-width:920px){ .main-wrap{ margin-left:18px; margin-right:18px; margin-top:86px; } }
    
        .page-header{display:flex;align-items:center;justify-content:space-between;gap:12px;margin-bottom:18px}
        .title{display:flex;gap:12px;align-items:center}
        .logo{width:52px;height:52px;border-radius:10px;background:linear-gradient(135deg,var(--accent),var(--accent-2));display:grid;place-items:center;font-weight:800;color:white;font-size:18px}
        .title h1{margin:0;font-size:20px}
        .small{font-size:13px;color:var(--muted)}
    
        .controls{display:flex;gap:8px;align-items:center}
        .btn{padding:8px 12px;border-radius:10px;border:0;background:transparent;color:var(--text);cursor:pointer}
        .btn-primary{background:linear-gradient(90deg,var(--accent),var(--accent-2));color:white}
        .btn-ghost{border:1px solid var(--border);background:transparent;color:var(--text)}
    
        .layout{display:grid;grid-template-columns:1fr 320px;gap:16px;align-items:start}
        @media (max-width:980px){ .layout{grid-template-columns:1fr} }
    
        .card{background:var(--card-bg);padding:18px;border-radius:12px;box-shadow:0 12px 36px rgba(2,6,23,0.25)}
        .form-row{display:flex;gap:10px;margin-bottom:12px}
        .form-row input,.form-row select,textarea{flex:1;padding:10px;border-radius:8px;border:1px solid var(--border);background:var(--input-bg);color:var(--text);outline:none}
        textarea{min-height:120px}
    
        label.small{display:block;font-size:13px;color:var(--muted);margin-bottom:6px}
    
        .section-title{display:flex;justify-content:space-between;align-items:center;margin-bottom:12px}
        .muted{color:var(--muted);font-size:13px}
    
        .appearance{display:flex;gap:8px;align-items:center}
        .switch{position:relative;width:52px;height:30px;background:var(--input-bg);border-radius:999px;border:1px solid var(--border);cursor:pointer}
        .switch .knob{position:absolute;top:3px;left:3px;width:24px;height:24px;background:linear-gradient(180deg,#fff,#f1f5f9);border-radius:50%;transition:all .18s ease;box-shadow:0 6px 18px rgba(2,6,23,0.2)}
        html[data-theme="light"] .switch{background:var(--accent-2);border-color:transparent}
        html[data-theme="light"] .switch .knob{left:25px}
    
        .help{font-size:13px;color:var(--muted);margin-top:8px}
        .preset{display:flex;gap:8px;flex-wrap:wrap}
        .preset button{padding:8px 10px;border-radius:8px;border:1px solid var(--border);background:transparent;color:var(--text);cursor:pointer}
        .save-row{display:flex;gap:8px;justify-content:flex-end;margin-top:14px}
      </style>
    </head>
    <body>
      <?php
        include('topnav.php');
        include('sidebar.php');
      ?>
    
      <main class="main-wrap" role="main" aria-label="Settings admin">
        <header class="page-header">
          <div class="title">
            <div class="logo">AH</div>
            <div>
              <h1>Settings</h1>
              <p class="small">Configure hotel, appearance, integrations and preferences</p>
            </div>
          </div>
    
          <div class="controls">
            <div class="small">Signed in as <strong><?= $userName ?></strong></div>
            <div class="appearance" title="Toggle theme">
              <div id="themeLabel" class="muted" style="margin-right:8px">Theme</div>
              <div id="themeSwitch" class="switch" role="button" aria-pressed="false" tabindex="0"><div class="knob"></div></div>
            </div>
            <button class="btn btn-ghost" id="resetBtn"><i class="fa-solid fa-rotate"></i></button>
            <button class="btn btn-primary" id="saveBtn"><i class="fa-solid fa-save"></i> Save settings</button>
          </div>
        </header>
    
        <div class="layout">
          <section>
            <div class="card" aria-label="General settings">
              <div class="section-title"><strong>General</strong><div class="muted">Basic hotel info</div></div>
    
              <div class="form-row">
                <div style="flex:1">
                  <label class="small">Hotel name</label>
                  <input id="hotelName" value="Afrique Hotel">
                </div>
                <div style="width:220px">
                  <label class="small">Timezone</label>
                  <select id="timeZone">
                    <option value="UTC">UTC</option>
                    <option value="Africa/Accra" selected>Africa/Accra</option>
                    <option value="Africa/Lagos">Africa/Lagos</option>
                    <option value="Europe/London">Europe/London</option>
                  </select>
                </div>
              </div>
    
              <div class="form-row">
                <div style="width:160px">
                  <label class="small">Currency</label>
                  <select id="currency"><option value="USD" selected>USD</option><option value="GHS">GHS</option><option value="EUR">EUR</option></select>
                </div>
                <div style="flex:1">
                  <label class="small">Default check-in time</label>
                  <input id="checkIn" type="time" value="14:00">
                </div>
              </div>
    
              <div style="margin-top:12px">
                <label class="small">Business description</label>
                <textarea id="hotelDesc">Boutique hotel in Accra — meetings, weddings and leisure stays.</textarea>
              </div>
            </div>
    
            <div class="card" style="margin-top:12px" aria-label="Payments & integrations">
              <div class="section-title"><strong>Payments & Integrations</strong><div class="muted">Gateways and notifications</div></div>
    
              <div class="form-row">
                <div style="flex:1">
                  <label class="small">Payment gateway</label>
                  <select id="payGateway"><option value="stripe">Stripe</option><option value="paypal">PayPal</option><option value="manual">Manual</option></select>
                </div>
                <div style="width:220px">
                  <label class="small">Currency support</label>
                  <select id="multiCurrency"><option value="1">Enabled</option><option value="0" selected>Disabled</option></select>
                </div>
              </div>
    
              <div class="form-row">
                <div style="flex:1">
                  <label class="small">Notification email</label>
                  <input id="notifEmail" value="reservations@afriquehotel.com">
                </div>
                <div style="width:220px">
                  <label class="small">SMS provider</label>
                  <select id="smsProvider"><option value="">None</option><option value="twilio">Twilio</option></select>
                </div>
              </div>
    
              <div class="help">Enter API keys in production files (this demo stores nothing server-side).</div>
            </div>
    
            <div class="card" style="margin-top:12px" aria-label="Advanced">
              <div class="section-title"><strong>Advanced</strong><div class="muted">Site behaviour & presets</div></div>
    
              <div style="display:flex;gap:8px;align-items:center;margin-bottom:8px">
                <label style="flex:1">
                  <div class="small">Enable maintenance mode</div>
                  <select id="maintenance"><option value="0" selected>Off</option><option value="1">On</option></select>
                </label>
    
                <div>
                  <div class="small">Preset</div>
                  <div class="preset">
                    <button class="btn" data-preset="default">Default</button>
                    <button class="btn" data-preset="conference">Conference</button>
                    <button class="btn" data-preset="wedding">Wedding</button>
                  </div>
                </div>
              </div>
    
              <div class="help">Preset will update basic fields for quick configuration (demo-only).</div>
            </div>
          </section>
    
          <aside>
            <div class="card" aria-label="Appearance">
              <div class="section-title"><strong>Appearance</strong><div class="muted">Theme & branding</div></div>
    
              <div style="margin-bottom:8px">
                <label class="small">Primary color</label>
                <input id="primaryColor" type="color" value="#7c3aed">
              </div>
    
              <div style="margin-bottom:8px">
                <label class="small">Secondary color</label>
                <input id="secondaryColor" type="color" value="#06b6d4">
              </div>
    
              <div style="margin-top:12px">
                <label class="small">Preview</label>
                <div style="display:flex;gap:8px;margin-top:8px">
                  <div id="swatch1" style="width:60px;height:36px;border-radius:8px;background:var(--accent)"></div>
                  <div id="swatch2" style="width:60px;height:36px;border-radius:8px;background:var(--accent-2)"></div>
                </div>
              </div>
            </div>
    
            <div class="card" style="margin-top:12px" aria-label="About">
              <strong>About</strong>
              <div class="muted" style="margin-top:6px">Afrique Hotel admin panel — demo settings. Changes are client-side only unless you integrate a backend.</div>
            </div>
          </aside>
        </div>
    
        <div class="save-row" style="max-width:1100px;margin:18px auto 0;">
          <button class="btn" id="cancelBtn">Cancel</button>
          <button class="btn btn-primary" id="applyBtn"><i class="fa-solid fa-check"></i> Apply & Save</button>
        </div>
      </main>
    
      <script>
        (function(){
          const themeSwitch = document.getElementById('themeSwitch');
          const saveBtn = document.getElementById('saveBtn');
          const applyBtn = document.getElementById('applyBtn');
          const resetBtn = document.getElementById('resetBtn');
          const primaryColor = document.getElementById('primaryColor');
          const secondaryColor = document.getElementById('secondaryColor');
          const swatch1 = document.getElementById('swatch1');
          const swatch2 = document.getElementById('swatch2');
    
          const hotelName = document.getElementById('hotelName');
          const timeZone = document.getElementById('timeZone');
          const currency = document.getElementById('currency');
          const checkIn = document.getElementById('checkIn');
          const hotelDesc = document.getElementById('hotelDesc');
    
          function loadSettings(){
            try{
              const s = JSON.parse(localStorage.getItem('adminSettings') || '{}');
              if(s.theme) document.documentElement.setAttribute('data-theme', s.theme);
              if(s.primary) primaryColor.value = s.primary;
              if(s.secondary) secondaryColor.value = s.secondary;
              if(s.hotelName) hotelName.value = s.hotelName;
              if(s.timeZone) timeZone.value = s.timeZone;
              if(s.currency) currency.value = s.currency;
              if(s.checkIn) checkIn.value = s.checkIn;
              if(s.desc) hotelDesc.value = s.desc;
              applyBrandColors();
              updateThemeUI();
            }catch(e){ console.error(e); }
          }
    
          function saveSettings(){
            const payload = {
              theme: document.documentElement.getAttribute('data-theme') || 'dark',
              primary: primaryColor.value,
              secondary: secondaryColor.value,
              hotelName: hotelName.value,
              timeZone: timeZone.value,
              currency: currency.value,
              checkIn: checkIn.value,
              desc: hotelDesc.value
            };
            localStorage.setItem('adminSettings', JSON.stringify(payload));
            alert('Settings saved (demo). Implement server-side persist for production.');
          }
    
          function applyBrandColors(){
            document.documentElement.style.setProperty('--accent', primaryColor.value);
            document.documentElement.style.setProperty('--accent-2', secondaryColor.value);
            swatch1.style.background = primaryColor.value;
            swatch2.style.background = secondaryColor.value;
          }
    
          function toggleTheme(){
            const cur = document.documentElement.getAttribute('data-theme') === 'light' ? 'dark' : 'light';
            document.documentElement.setAttribute('data-theme', cur);
            updateThemeUI();
          }
    
          function updateThemeUI(){
            const isLight = document.documentElement.getAttribute('data-theme') === 'light';
            themeSwitch.setAttribute('aria-pressed', isLight ? 'true' : 'false');
          }
    
          document.querySelectorAll('[data-preset]').forEach(btn=>{
            btn.addEventListener('click', ()=> {
              const p = btn.getAttribute('data-preset');
              if(p === 'wedding'){ primaryColor.value = '#f97316'; secondaryColor.value = '#ef4444'; hotelDesc.value = 'Elegant wedding venue and reception'; }
              else if(p === 'conference'){ primaryColor.value = '#0ea5a4'; secondaryColor.value = '#1e293b'; hotelDesc.value = 'Conference and corporate event specialist'; }
              else { primaryColor.value = '#7c3aed'; secondaryColor.value = '#06b6d4'; hotelDesc.value = 'Boutique hotel in Accra — meetings, weddings and leisure stays.'; }
              applyBrandColors();
            });
          });
    
          themeSwitch.addEventListener('click', ()=> { toggleTheme(); });
          themeSwitch.addEventListener('keydown', (e)=> { if(e.key === 'Enter' || e.key === ' ') { e.preventDefault(); toggleTheme(); } });
    
          primaryColor.addEventListener('input', applyBrandColors);
          secondaryColor.addEventListener('input', applyBrandColors);
    
          saveBtn.addEventListener('click', saveSettings);
          applyBtn.addEventListener('click', ()=> { saveSettings(); });
          resetBtn.addEventListener('click', ()=> {
            if(!confirm('Reset demo settings to defaults?')) return;
            localStorage.removeItem('adminSettings');
            document.documentElement.setAttribute('data-theme','dark');
            primaryColor.value = '#7c3aed';
            secondaryColor.value = '#06b6d4';
            hotelName.value = 'Afrique Hotel';
            timeZone.value = 'Africa/Accra';
            currency.value = 'USD';
            checkIn.value = '14:00';
            hotelDesc.value = 'Boutique hotel in Accra — meetings, weddings and leisure stays.';
            applyBrandColors();
            updateThemeUI();
            alert('Settings reset (demo).');
          });
    
          loadSettings();
        })();
      </script>
    </body>
    </html>
    // ...existing code... 
</body>
</html>