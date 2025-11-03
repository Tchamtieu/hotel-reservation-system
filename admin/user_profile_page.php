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
      <title>User Profile — Admin — Afrique Hotel</title>
    
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
            max-width:1100px;
            margin:28px auto;
            padding:18px;
            margin-left: calc(var(--sb-width) + 28px);
            margin-top:78px;transition: margin-left .22s ease;
        }

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
    
        .layout{display:grid;grid-template-columns:320px 1fr;gap:16px;align-items:start}
        @media (max-width:980px){ .layout{grid-template-columns:1fr} }
    
        .profile-card{background:var(--card-bg);padding:18px;border-radius:12px;box-shadow:0 12px 36px rgba(2,6,23,0.45);display:flex;flex-direction:column;gap:12px}
        .avatar-wrap{display:flex;gap:12px;align-items:center}
        .avatar{width:96px;height:96px;border-radius:14px;object-fit:cover;border:3px solid rgba(255,255,255,0.04)}
        .user-meta{display:flex;flex-direction:column;gap:6px}
        .user-meta .name{font-weight:800;font-size:18px}
        .user-meta .role{color:var(--muted);font-size:13px}
        .stat-row{display:flex;gap:8px;margin-top:8px}
        .stat{background:rgba(255,255,255,0.02);padding:8px;border-radius:10px;text-align:center;flex:1}
        .stat .num{font-weight:800;font-size:16px}
    
        .edit-panel{background:var(--card-bg);padding:18px;border-radius:12px;box-shadow:0 12px 36px rgba(2,6,23,0.45)}
        .form-row{display:flex;gap:10px;margin-bottom:10px}
        .form-row input,.form-row select,textarea{flex:1;padding:10px;border-radius:8px;border:0;background:rgba(255,255,255,0.01);color:var(--text);outline:none}
        textarea{min-height:120px}
    
        .activity{background:var(--card-bg);padding:12px;border-radius:12px;box-shadow:0 12px 36px rgba(2,6,23,0.45);margin-top:12px}
        .activity-item{display:flex;gap:10px;padding:8px;border-radius:8px;border:1px solid rgba(255,255,255,0.01);margin-bottom:8px}
        .activity-item .when{color:var(--muted);font-size:13px}
    
        .small-muted{font-size:13px;color:var(--muted)}
    
        .upload {display:flex;gap:8px;align-items:center}
        .file-input{display:none}
        .img-preview{width:64px;height:64px;border-radius:10px;object-fit:cover;border:2px solid rgba(255,255,255,0.03)}
      </style>
    </head>
    <body>
      <?php
        include('topnav.php');
         include('sidebar.php');
      ?>
    
      <main class="main-wrap" role="main" aria-label="User profile admin">
        <header class="page-header">
          <div class="title">
            <div class="logo">AH</div>
            <div>
              <h1>Profile</h1>
              <p class="small">Manage your account details and preferences</p>
            </div>
          </div>
    
          <div class="controls">
            <div class="small-muted">Signed in as <strong><?= $userName ?></strong></div>
            <button class="btn btn-ghost" id="refreshBtn"><i class="fa-solid fa-arrows-rotate"></i></button>
            <button class="btn btn-primary" id="saveProfileBtn"><i class="fa-solid fa-save"></i> Save</button>
          </div>
        </header>
    
        <div class="layout">
          <aside>
            <div class="profile-card" id="profileCard">
              <div class="avatar-wrap">
                <img id="profileAvatar" class="avatar" src="<?= $avatar ?>" alt="avatar">
                <div class="user-meta">
                  <div class="name" id="displayName"><?= $userName ?></div>
                  <div class="role" id="displayRole">Administrator</div>
                  <div class="small-muted" id="displayEmail">admin@example.com</div>
                </div>
              </div>
    
              <div class="stat-row">
                <div class="stat">
                  <div class="num" id="statBookings">128</div>
                  <div class="small-muted">Bookings managed</div>
                </div>
                <div class="stat">
                  <div class="num" id="statEvents">24</div>
                  <div class="small-muted">Events organised</div>
                </div>
              </div>
    
              <div style="margin-top:10px">
                <div class="small-muted">Profile picture</div>
                <div class="upload" style="margin-top:8px">
                  <label class="btn btn-ghost" for="avatarFile"><i class="fa-solid fa-upload"></i> Upload</label>
                  <input id="avatarFile" class="file-input" type="file" accept="image/*">
                  <button class="btn" id="removeAvatarBtn" title="Remove avatar"><i class="fa-solid fa-trash"></i></button>
                </div>
                <div style="margin-top:8px" class="small-muted">Tip: double-click the avatar to preview</div>
              </div>
    
              <div style="margin-top:12px" class="small-muted">Recent activity</div>
              <div class="activity" id="recentActivity">
                <div class="activity-item"><div style="width:56px"><img class="img-preview" src="https://images.unsplash.com/photo-1547425260-76bcadfb4f2c?q=80&w=800&auto=format&fit=crop" alt=""></div><div style="flex:1"><strong>Updated room rates</strong><div class="when">2 hours ago</div></div></div>
                <div class="activity-item"><div style="width:56px"><img class="img-preview" src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?q=80&w=800&auto=format&fit=crop" alt=""></div><div style="flex:1"><strong>Created event: Corporate Dinner</strong><div class="when">3 days ago</div></div></div>
              </div>
            </div>
          </aside>
    
          <section>
            <div class="edit-panel" aria-label="Edit profile">
              <strong>Account details</strong>
              <div style="height:12px"></div>
              <div class="form-row">
                <input id="fName" placeholder="Full name" value="<?= $userName ?>">
                <input id="fEmail" placeholder="Email" value="admin@example.com">
              </div>
    
              <div class="form-row">
                <input id="fRole" placeholder="Role" value="Administrator">
                <input id="fPhone" placeholder="Phone" value="+233 20 123 4567">
              </div>
    
              <div style="margin-bottom:8px">
                <textarea id="fBio" placeholder="Short bio">Hotel administrator. Manages bookings, staff and events.</textarea>
              </div>
    
              <div style="display:flex;gap:8px;justify-content:flex-end">
                <button class="btn" id="cancelBtn">Cancel</button>
                <button class="btn btn-primary" id="applyBtn">Apply changes</button>
              </div>
            </div>
    
            <div class="activity" style="margin-top:12px">
              <strong>Security</strong>
              <div style="height:12px"></div>
              <div class="form-row">
                <input id="oldPass" type="password" placeholder="Current password">
                <input id="newPass" type="password" placeholder="New password">
              </div>
              <div style="display:flex;gap:8px;justify-content:flex-end">
                <button class="btn" id="cancelPass">Cancel</button>
                <button class="btn btn-primary" id="changePass">Change password</button>
              </div>
            </div>
    
            <div class="activity" style="margin-top:12px">
              <strong>Activity log</strong>
              <div style="height:12px"></div>
              <div id="activityLog">
                <div class="activity-item"><div style="width:56px"><i class="fa-solid fa-user small-muted" style="font-size:28px"></i></div><div style="flex:1"><strong>Signed in</strong><div class="when">Today · 09:12</div></div></div>
                <div class="activity-item"><div style="width:56px"><i class="fa-solid fa-pen small-muted" style="font-size:28px"></i></div><div style="flex:1"><strong>Edited profile</strong><div class="when">Oct 28, 2025 · 14:03</div></div></div>
              </div>
            </div>
          </section>
        </div>
    
        <footer style="margin-top:18px;color:var(--muted)">Changes here are demo-only. Hook to your backend to persist updates.</footer>
      </main>
    
      <script>
        (function(){
          const avatarImg = document.getElementById('profileAvatar');
          const avatarFile = document.getElementById('avatarFile');
          const removeBtn = document.getElementById('removeAvatarBtn');
          const displayName = document.getElementById('displayName');
          const fName = document.getElementById('fName');
          const fEmail = document.getElementById('fEmail');
          const applyBtn = document.getElementById('applyBtn');
          const saveProfileBtn = document.getElementById('saveProfileBtn');
          const refreshBtn = document.getElementById('refreshBtn');
    
          avatarImg.addEventListener('dblclick', ()=> {
            const w = window.open('', '_blank');
            w.document.write('<title>Avatar preview</title><img src="'+avatarImg.src+'" style="max-width:100%;">');
          });
    
          avatarFile.addEventListener('change', (e)=> {
            const f = e.target.files[0];
            if (!f) return;
            const reader = new FileReader();
            reader.onload = function(ev){ avatarImg.src = ev.target.result; };
            reader.readAsDataURL(f);
          });
    
          removeBtn.addEventListener('click', ()=> {
            avatarImg.src = '../images/admin.jpg';
          });
    
          applyBtn.addEventListener('click', ()=> {
            displayName.textContent = fName.value || 'Admin';
            document.getElementById('displayEmail').textContent = fEmail.value || 'admin@example.com';
            alert('Profile changes applied (demo). Integrate with server to persist.');
          });
    
          saveProfileBtn.addEventListener('click', ()=> applyBtn.click());
          refreshBtn.addEventListener('click', ()=> { alert('Profile refreshed (demo)'); });
    
          document.getElementById('changePass').addEventListener('click', ()=> {
            const oldP = document.getElementById('oldPass').value;
            const newP = document.getElementById('newPass').value;
            if(!oldP || !newP){ alert('Fill both password fields (demo)'); return; }
            alert('Password changed (demo). Implement server-side change for production.');
            document.getElementById('oldPass').value=''; document.getElementById('newPass').value='';
          });
    
          // small demo: add activity when changes applied
          applyBtn.addEventListener('click', ()=>{
            const log = document.getElementById('activityLog');
            const el = document.createElement('div');
            el.className = 'activity-item';
            el.innerHTML = '<div style="width:56px"><i class="fa-solid fa-pen small-muted" style="font-size:28px"></i></div><div style="flex:1"><strong>Profile updated</strong><div class="when">Just now</div></div>';
            log.prepend(el);
          });
        })();
      </script>
    </body>
    </html>
    