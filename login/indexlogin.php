<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Masuk / Daftar — FeelsCoffee</title>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;0,900;1,400&family=Bebas+Neue&family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500&display=swap" rel="stylesheet" />
  <style>
    :root {
      --espresso: #110900;
      --dark-roast: #1c0f00;
      --medium-roast: #362000;
      --gold: #c2843a;
      --gold-light: #dfa456;
      --cream: #f0ddc8;
      --text-soft: #8a6640;
      --text-light: #ecdac5;
    }

    *,
    *::before,
    *::after {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    html,
    body {
      height: 100%;
    }

    body {
      background: var(--espresso);
      color: var(--text-light);
      font-family: 'Cormorant Garamond', serif;
      display: grid;
      grid-template-columns: 1fr 1fr;
      min-height: 100vh;
    }

    /* ── LEFT ── */
    .left {
      position: relative;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      padding: 3rem;
      background: linear-gradient(160deg, var(--medium-roast), var(--dark-roast) 55%, var(--espresso));
      overflow: hidden;
    }

    .left::before {
      content: '';
      position: absolute;
      inset: 0;
      background:
        radial-gradient(ellipse 65% 55% at 30% 40%, rgba(194, 132, 58, 0.13), transparent 65%),
        radial-gradient(ellipse 45% 45% at 75% 80%, rgba(194, 132, 58, 0.06), transparent 60%);
      pointer-events: none;
    }

    .left::after {
      content: '';
      position: absolute;
      inset: 0;
      background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.85' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.04'/%3E%3C/svg%3E");
      pointer-events: none;
      opacity: 0.28;
    }

    .bg-letter {
      position: absolute;
      bottom: -3rem;
      right: -1.5rem;
      font-family: 'Playfair Display', serif;
      font-size: 22rem;
      font-weight: 900;
      font-style: italic;
      color: rgba(194, 132, 58, 0.038);
      line-height: 1;
      user-select: none;
      pointer-events: none;
      transition: opacity 0.6s;
    }

    .logo {
      font-family: 'Playfair Display', serif;
      font-size: 1.6rem;
      font-weight: 900;
      color: var(--cream);
      text-decoration: none;
      position: relative;
      z-index: 1;
      opacity: 0;
      animation: fadeUp 0.7s 0.1s forwards;
    }

    .logo em {
      color: var(--gold);
      font-style: italic;
    }

    .left-bottom {
      position: relative;
      z-index: 1;
    }

    .left-tag {
      font-family: 'Bebas Neue', sans-serif;
      letter-spacing: 0.45em;
      font-size: 0.68rem;
      color: var(--gold);
      display: flex;
      align-items: center;
      gap: 0.7rem;
      margin-bottom: 1rem;
      opacity: 0;
      animation: fadeUp 0.7s 0.3s forwards;
    }

    .left-tag::before {
      content: '';
      width: 28px;
      height: 1px;
      background: var(--gold);
    }

    .left-headline {
      font-family: 'Playfair Display', serif;
      font-size: clamp(2rem, 3.5vw, 3rem);
      font-weight: 900;
      line-height: 1.05;
      color: var(--cream);
      margin-bottom: 1.2rem;
      opacity: 0;
      animation: fadeUp 0.8s 0.45s forwards;
      transition: opacity 0.4s;
    }

    .left-headline em {
      display: block;
      font-style: italic;
      color: var(--gold-light);
    }

    .left-desc {
      font-size: 0.98rem;
      font-weight: 300;
      color: var(--text-soft);
      line-height: 1.85;
      max-width: 340px;
      opacity: 0;
      animation: fadeUp 0.8s 0.6s forwards;
    }

    .cups-row {
      display: flex;
      gap: 0.8rem;
      margin-top: 2.5rem;
      opacity: 0;
      animation: fadeUp 0.8s 0.75s forwards;
    }

    .cup-dot {
      width: 42px;
      height: 42px;
      background: rgba(194, 132, 58, 0.1);
      border: 1px solid rgba(194, 132, 58, 0.2);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.2rem;
      animation: floatCup 4s ease-in-out infinite;
    }

    .cup-dot:nth-child(2) {
      animation-delay: 0.6s;
    }

    .cup-dot:nth-child(3) {
      animation-delay: 1.2s;
    }

    @keyframes floatCup {

      0%,
      100% {
        transform: translateY(0)
      }

      50% {
        transform: translateY(-6px)
      }
    }

    /* ── RIGHT ── */
    .right {
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 3rem 2rem;
      background: var(--espresso);
      border-left: 1px solid rgba(194, 132, 58, 0.08);
      overflow-y: auto;
    }

    .form-box {
      width: 100%;
      max-width: 380px;
    }

    /* TABS */
    .tabs {
      display: flex;
      margin-bottom: 2.2rem;
      border-bottom: 1px solid rgba(194, 132, 58, 0.12);
      opacity: 0;
      animation: fadeUp 0.6s 0.15s forwards;
    }

    .tab-btn {
      flex: 1;
      background: none;
      border: none;
      font-family: 'Bebas Neue', sans-serif;
      letter-spacing: 0.35em;
      font-size: 0.8rem;
      color: var(--text-soft);
      padding: 0.8rem 0;
      cursor: pointer;
      position: relative;
      transition: color 0.3s;
    }

    .tab-btn::after {
      content: '';
      position: absolute;
      bottom: -1px;
      left: 0;
      right: 0;
      height: 2px;
      background: var(--gold);
      transform: scaleX(0);
      transition: transform 0.35s cubic-bezier(0.25, 0.8, 0.25, 1);
    }

    .tab-btn.active {
      color: var(--gold-light);
    }

    .tab-btn.active::after {
      transform: scaleX(1);
    }

    /* PANELS */
    .panel {
      display: none;
    }

    .panel.active {
      display: block;
      animation: slideIn 0.4s ease;
    }

    @keyframes slideIn {
      from {
        opacity: 0;
        transform: translateY(12px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    /* FIELDS */
    .field {
      margin-bottom: 1.15rem;
    }

    .field-label {
      font-family: 'Bebas Neue', sans-serif;
      letter-spacing: 0.32em;
      font-size: 0.6rem;
      color: var(--gold);
      display: block;
      margin-bottom: 0.48rem;
    }

    .field-wrap {
      position: relative;
    }

    .field-input {
      width: 100%;
      background: rgba(28, 15, 0, 0.8);
      border: 1px solid rgba(194, 132, 58, 0.15);
      border-bottom: 1px solid rgba(194, 132, 58, 0.32);
      color: var(--text-light);
      font-family: 'Cormorant Garamond', serif;
      font-size: 1.05rem;
      font-weight: 300;
      padding: 0.82rem 2.8rem 0.82rem 0.95rem;
      outline: none;
      transition: border-color 0.3s, background 0.3s;
    }

    .field-input::placeholder {
      color: rgba(138, 102, 64, 0.4);
    }

    .field-input:focus {
      border-color: rgba(194, 132, 58, 0.52);
      background: rgba(36, 18, 0, 0.85);
    }

    /* password strength */
    .strength-bar {
      height: 2px;
      background: rgba(255, 255, 255, 0.06);
      margin-top: 0.4rem;
      overflow: hidden;
    }

    .strength-fill {
      height: 100%;
      width: 0;
      transition: width 0.4s, background 0.4s;
    }

    .eye-btn {
      position: absolute;
      right: 0.85rem;
      top: 50%;
      transform: translateY(-50%);
      background: none;
      border: none;
      color: var(--text-soft);
      cursor: pointer;
      font-size: 1rem;
      padding: 0;
      line-height: 1;
      transition: color 0.2s;
    }

    .eye-btn:hover {
      color: var(--gold);
    }

    .error-msg {
      font-size: 0.8rem;
      color: #e87a5a;
      margin-top: 0.35rem;
      display: none;
    }

    .error-msg.show {
      display: block;
    }

    /* ROW */
    .field-row {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 1.8rem;
    }

    .check-wrap {
      display: flex;
      align-items: center;
      gap: 0.5rem;
      cursor: pointer;
    }

    .check-wrap input {
      display: none;
    }

    .custom-check {
      width: 16px;
      height: 16px;
      border: 1px solid rgba(194, 132, 58, 0.25);
      background: rgba(28, 15, 0, 0.8);
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
      transition: border-color 0.25s, background 0.25s;
    }

    .check-wrap input:checked+.custom-check {
      border-color: var(--gold);
      background: rgba(194, 132, 58, 0.14);
    }

    .check-wrap input:checked+.custom-check::after {
      content: '✓';
      color: var(--gold);
      font-size: 0.65rem;
    }

    .check-label {
      font-size: 0.85rem;
      font-weight: 300;
      color: var(--text-soft);
    }

    .forgot-link {
      font-family: 'Bebas Neue', sans-serif;
      letter-spacing: 0.2em;
      font-size: 0.62rem;
      color: var(--text-soft);
      text-decoration: none;
      transition: color 0.3s;
    }

    .forgot-link:hover {
      color: var(--gold);
    }

    /* TERMS */
    .terms-wrap {
      display: flex;
      align-items: flex-start;
      gap: 0.55rem;
      margin-bottom: 1.8rem;
      cursor: pointer;
    }

    .terms-text {
      font-size: 0.84rem;
      font-weight: 300;
      color: var(--text-soft);
      line-height: 1.5;
    }

    .terms-text a {
      color: var(--gold);
      text-decoration: none;
    }

    .terms-text a:hover {
      color: var(--gold-light);
    }

    /* SUBMIT BTN */
    .submit-btn {
      width: 100%;
      background: var(--gold);
      color: var(--espresso);
      border: none;
      font-family: 'Bebas Neue', sans-serif;
      letter-spacing: 0.45em;
      font-size: 0.88rem;
      padding: 1rem;
      cursor: pointer;
      position: relative;
      overflow: hidden;
      transition: background 0.3s;
      margin-bottom: 1.5rem;
    }

    .submit-btn::after {
      content: '';
      position: absolute;
      inset: 0;
      background: rgba(255, 255, 255, 0.08);
      transform: translateX(-101%);
      transition: transform 0.4s;
    }

    .submit-btn:hover {
      background: var(--gold-light);
    }

    .submit-btn:hover::after {
      transform: translateX(0);
    }

    .submit-btn.loading {
      pointer-events: none;
      opacity: 0.7;
    }

    /* OR */
    .or-divider {
      display: flex;
      align-items: center;
      gap: 1rem;
      margin-bottom: 1.3rem;
    }

    .or-divider::before,
    .or-divider::after {
      content: '';
      flex: 1;
      height: 1px;
      background: rgba(194, 132, 58, 0.11);
    }

    .or-divider span {
      font-family: 'Bebas Neue', sans-serif;
      letter-spacing: 0.25em;
      font-size: 0.6rem;
      color: var(--text-soft);
    }

    /* SOCIAL */
    .social-btns {
      display: flex;
      gap: 0.7rem;
      margin-bottom: 1.8rem;
    }

    .social-btn {
      flex: 1;
      background: rgba(28, 15, 0, 0.7);
      border: 1px solid rgba(194, 132, 58, 0.13);
      color: var(--text-soft);
      font-family: 'Bebas Neue', sans-serif;
      letter-spacing: 0.15em;
      font-size: 0.68rem;
      padding: 0.72rem 0.5rem;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 0.45rem;
      transition: all 0.3s;
    }

    .social-btn:hover {
      border-color: rgba(194, 132, 58, 0.35);
      color: var(--gold-light);
    }

    /* SWITCH HINT */
    .switch-hint {
      text-align: center;
      font-size: 0.88rem;
      font-weight: 300;
      color: var(--text-soft);
    }

    .switch-hint a {
      color: var(--gold);
      text-decoration: none;
      cursor: pointer;
    }

    .switch-hint a:hover {
      color: var(--gold-light);
    }

    /* TOAST */
    .toast {
      position: fixed;
      bottom: 2rem;
      left: 50%;
      transform: translateX(-50%) translateY(70px);
      background: var(--medium-roast);
      border: 1px solid rgba(194, 132, 58, 0.28);
      color: var(--text-light);
      font-family: 'Bebas Neue', sans-serif;
      letter-spacing: 0.25em;
      font-size: 0.72rem;
      padding: 0.85rem 1.8rem;
      z-index: 9000;
      opacity: 0;
      transition: transform 0.4s cubic-bezier(0.34, 1.56, 0.64, 1), opacity 0.4s;
      white-space: nowrap;
    }

    .toast.show {
      transform: translateX(-50%) translateY(0);
      opacity: 1;
    }

    @keyframes fadeUp {
      from {
        opacity: 0;
        transform: translateY(18px)
      }

      to {
        opacity: 1;
        transform: translateY(0)
      }
    }

    @media (max-width: 768px) {
      body {
        grid-template-columns: 1fr;
      }

      .left {
        display: none;
      }

      .right {
        padding: 3rem 1.5rem;
        align-items: flex-start;
      }
    }
  </style>
</head>

<body>

  <div class="toast" id="toast"></div>

  <!-- LEFT -->
  <div class="left">
    <a href="#" class="logo">Feels<em>Coffee</em></a>
    <div class="bg-letter" id="bgLetter">F</div>
    <div class="left-bottom">
      <div class="left-tag">Specialty Coffee · Ternate</div>
      <h1 class="left-headline" id="leftHeadline">
        Selamat<br><em>Datang Kembali.</em>
      </h1>
      <p class="left-desc" id="leftDesc">Masuk dan nikmati website ini, menu FeelsCoffee.</p>
      <div class="cups-row">
        <div class="cup-dot">☕</div>
        <div class="cup-dot">🫘</div>
        <div class="cup-dot">🌿</div>
      </div>
    </div>
  </div>

  <!-- RIGHT -->
  <div class="right">
    <div class="form-box">

      <!-- TABS -->
      <div class="tabs">
        <button class="tab-btn active" id="tabLogin" onclick="switchTab('login')">Masuk</button>
        <button class="tab-btn" id="tabRegister" onclick="switchTab('register')">Daftar</button>
      </div>

      <!-- ── LOGIN PANEL ── -->
      <div class="panel active" id="panelLogin">

        <div class="field">
          <label class="field-label">Email</label>
          <div class="field-wrap">
            <input class="field-input" id="loginEmail" type="email" placeholder="kamu@email.com" />
          </div>
          <div class="error-msg" id="loginEmailErr">Masukkan email yang valid</div>
        </div>

        <div class="field">
          <label class="field-label">Password</label>
          <div class="field-wrap">
            <input class="field-input" id="loginPass" type="password" placeholder="••••••••" />
            <button class="eye-btn" onclick="toggleEye('loginPass',this)">👁</button>
          </div>
          <div class="error-msg" id="loginPassErr">Password minimal 6 karakter</div>
        </div>

        <div class="field-row">
          <label class="check-wrap">
            <input type="checkbox" /><span class="custom-check"></span>
            <span class="check-label">Ingat saya</span>
          </label>
          <a href="#" class="forgot-link" onclick="showToast('📧 Link reset dikirim ke email')">Lupa Password?</a>
        </div>

        <button class="submit-btn" id="loginBtn" onclick="handleLogin()">Masuk Sekarang</button>

        <div class="or-divider"><span>atau masuk dengan</span></div>
        <div class="social-btns">
          <button class="social-btn" onclick="showToast('🔵 Login dengan Google')"><span>G</span> Google</button>
          <button class="social-btn" onclick="showToast('📘 Login dengan Facebook')"><span>f</span> Facebook</button>
        </div>

        <p class="switch-hint">Belum punya akun? <a onclick="switchTab('register')">Daftar sekarang →</a></p>
      </div>

      <!-- ── REGISTER PANEL ── -->
      <div class="panel" id="panelRegister">

        <div class="field">
          <label class="field-label">Nama Lengkap</label>
          <div class="field-wrap">
            <input class="field-input" id="regName" type="text" placeholder="Nama lengkapmu" />
          </div>
          <div class="error-msg" id="regNameErr">Nama tidak boleh kosong</div>
        </div>

        <div class="field">
          <label class="field-label">Email</label>
          <div class="field-wrap">
            <input class="field-input" id="regEmail" type="email" placeholder="kamu@email.com" />
          </div>
          <div class="error-msg" id="regEmailErr">Masukkan email yang valid</div>
        </div>

        <div class="field">
          <label class="field-label">Password</label>
          <div class="field-wrap">
            <input class="field-input" id="regPass" type="password" placeholder="Min. 6 karakter" oninput="checkStrength(this.value)" />
            <button class="eye-btn" onclick="toggleEye('regPass',this)">👁</button>
          </div>
          <div class="strength-bar">
            <div class="strength-fill" id="strengthFill"></div>
          </div>
          <div class="error-msg" id="regPassErr">Password minimal 6 karakter</div>
        </div>

        <div class="field">
          <label class="field-label">Konfirmasi Password</label>
          <div class="field-wrap">
            <input class="field-input" id="regConfirm" type="password" placeholder="Ulangi password" />
            <button class="eye-btn" onclick="toggleEye('regConfirm',this)">👁</button>
          </div>
          <div class="error-msg" id="regConfirmErr">Password tidak cocok</div>
        </div>

        <label class="terms-wrap">
          <input type="checkbox" id="terms" />
          <span class="custom-check"></span>
          <span class="terms-text">Saya setuju dengan <a href="#">Syarat & Ketentuan</a> dan <a href="#">Kebijakan Privasi</a> FeelsCoffee</span>
        </label>

        <button class="submit-btn" id="regBtn" onclick="handleRegister()">Buat Akun</button>

        <div class="or-divider"><span>atau daftar dengan</span></div>
        <div class="social-btns">
          <button class="social-btn" onclick="showToast('🔵 Daftar dengan Google')"><span>G</span> Google</button>
          <button class="social-btn" onclick="showToast('📘 Daftar dengan Facebook')"><span>f</span> Facebook</button>
        </div>

        <p class="switch-hint">Sudah punya akun? <a onclick="switchTab('login')">Masuk di sini →</a></p>
      </div>

    </div>
  </div>

  <script>
    /* ── TAB SWITCH ── */
    const leftHeadlines = {
      login: {
        h: 'Selamat<br><em>Datang Kembali.</em>',
        d: 'Masuk dan nikmati website ini, menu FeelsCoffee.'
      },
      register: {
        h: 'Mulai<br><em>Perjalananmu.</em>',
        d: 'Bergabung dengan ribuan pecinta kopi di FeelsCoffee.'
      }
    };

    function switchTab(tab) {
      document.getElementById('tabLogin').classList.toggle('active', tab === 'login');
      document.getElementById('tabRegister').classList.toggle('active', tab === 'register');
      document.getElementById('panelLogin').classList.toggle('active', tab === 'login');
      document.getElementById('panelRegister').classList.toggle('active', tab === 'register');

      // update left panel text
      const d = leftHeadlines[tab];
      document.getElementById('leftHeadline').innerHTML = d.h;
      document.getElementById('leftDesc').textContent = d.d;
    }

    /* ── PASSWORD EYE ── */
    function toggleEye(id, btn) {
      const inp = document.getElementById(id);
      inp.type = inp.type === 'password' ? 'text' : 'password';
      btn.textContent = inp.type === 'password' ? '👁' : '🙈';
    }

    /* ── PASSWORD STRENGTH ── */
    function checkStrength(val) {
      const fill = document.getElementById('strengthFill');
      let score = 0;
      if (val.length >= 6) score++;
      if (val.length >= 10) score++;
      if (/[A-Z]/.test(val)) score++;
      if (/[0-9]/.test(val)) score++;
      if (/[^A-Za-z0-9]/.test(val)) score++;

      const pct = [0, 20, 40, 65, 82, 100][score];
      const color = ['', '#e87a5a', '#e8a85a', '#e8d45a', '#90c97a', '#4a9c6a'][score];
      fill.style.width = pct + '%';
      fill.style.background = color;
    }

    /* ── LOGIN ── */
    function handleLogin() {
      const email = document.getElementById('loginEmail').value.trim();
      const pass = document.getElementById('loginPass').value;
      const eErr = document.getElementById('loginEmailErr');
      const pErr = document.getElementById('loginPassErr');
      const btn = document.getElementById('loginBtn');
      eErr.classList.remove('show');
      pErr.classList.remove('show');

      let ok = true;
      if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
        eErr.classList.add('show');
        ok = false;
      }
      if (pass.length < 6) {
        pErr.classList.add('show');
        ok = false;
      }
      if (!ok) return;

      fetch('login.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
          },
          body: `email=${email}&password=${pass}`
        })
        .then(res => res.json())
        .then(res => {
          btn.classList.remove('loading');
          btn.textContent = 'MASUK SEKARANG';

          if (res.status === 'success') {
            showToast('✅ Login berhasil');

            setTimeout(() => {
              window.location.href = '../index.php';
            }, 1000);

          } else {
            showToast('⚠️ ' + res.message);
          }
        });
    }

    /* ── REGISTER ── */
    function handleRegister() {
      const name = document.getElementById('regName').value.trim();
      const email = document.getElementById('regEmail').value.trim();
      const pass = document.getElementById('regPass').value;
      const confirm = document.getElementById('regConfirm').value;
      const terms = document.getElementById('terms').checked;
      const btn = document.getElementById('regBtn');

      ['regNameErr', 'regEmailErr', 'regPassErr', 'regConfirmErr'].forEach(id => document.getElementById(id).classList.remove('show'));

      let ok = true;
      if (!name) {
        document.getElementById('regNameErr').classList.add('show');
        ok = false;
      }
      if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
        document.getElementById('regEmailErr').classList.add('show');
        ok = false;
      }
      if (pass.length < 6) {
        document.getElementById('regPassErr').classList.add('show');
        ok = false;
      }
      if (pass !== confirm) {
        document.getElementById('regConfirmErr').classList.add('show');
        ok = false;
      }
      if (!terms) {
        showToast('⚠️ Centang syarat & ketentuan terlebih dahulu');
        ok = false;
      }
      if (!ok) return;

      btn.classList.add('loading');
      btn.textContent = 'MEMPROSES...';
      fetch('register.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
          },
          body: `nama=${name}&email=${email}&password=${pass}&confirm=${confirm}`
        })
        .then(res => res.text())
        .then(res => {
          btn.classList.remove('loading');
          btn.textContent = 'BUAT AKUN';
          showToast(res);
        })
        .catch(() => {
          showToast('❌ Terjadi error' + res);

        });
    }

    /* ENTER KEY */
    document.addEventListener('keydown', e => {
      if (e.key !== 'Enter') return;
      if (document.getElementById('panelLogin').classList.contains('active')) handleLogin();
      else handleRegister();
    });

    /* TOAST */
    let tt;

    function showToast(msg) {
      const t = document.getElementById('toast');
      t.textContent = msg;
      t.classList.add('show');
      clearTimeout(tt);
      tt = setTimeout(() => t.classList.remove('show'), 2800);
    }
  </script>
</body>

</html>