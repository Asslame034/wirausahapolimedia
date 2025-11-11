/*
  Frontend Chatbot Logic - Wirausaha Polimedia
  - Membuat tombol floating dan panel chat secara dinamis
  - Mengirim pesan ke backend Node.js (/chat)
  - Auto scroll, typing indicator, dan animasi
*/
(function(){
  // Prefer new embedded WM widget if present
  function initWMWidget(){
    const root = document.getElementById('wm-chatbot');
    const toggle = document.getElementById('wm-chatbot-toggle');
    const panel = document.getElementById('wm-chatbot-panel');
    const closeBtn = document.getElementById('wm-chatbot-close');
    const messages = document.getElementById('wm-chatbot-messages');
    const suggestions = document.getElementById('wm-chatbot-suggestions');
    const form = document.getElementById('wm-chatbot-form');
    const input = document.getElementById('wm-chatbot-input');

    if (!root || !toggle || !panel || !messages || !suggestions || !form || !input) return false;

    const QA = [
      { q: 'cara daftar', a: 'Untuk mendaftar Wirausaha Mahasiswa Polimedia, buka menu Katalog lalu ikuti tombol pendaftaran yang tersedia. Siapkan data diri, proposal singkat, dan kontak aktif.' },
      { q: 'syarat', a: 'Syarat umum: mahasiswa aktif Polimedia, tim 2–5 orang (opsional), ide usaha jelas dengan rencana sederhana, dan komitmen mengikuti mentoring.' },
      { q: 'proposal', a: 'Format proposal ringkas: Latar Belakang, Produk/Jasa, Target Pasar, Model Bisnis, Rencana Pemasaran, Proyeksi Biaya & Timeline. Maks 5–7 halaman.' },
      { q: 'pendanaan', a: 'Pendanaan diberikan terbatas sesuai evaluasi. Tahap awal fokus validasi pasar. Detail skema akan diumumkan saat kick-off.' },
      { q: 'mentor', a: 'Setiap tim akan mendapat mentor. Sesi mentoring membahas strategi, pemasaran, keuangan dasar, dan validasi produk.' }
    ];

    function addBubble(text, who){
      const div = document.createElement('div');
      div.className = `wm-bubble ${who}`;
      div.textContent = text;
      messages.appendChild(div);
      messages.scrollTop = messages.scrollHeight;
    }

    function matchAnswer(text){
      const t = text.toLowerCase();
      for (const item of QA){
        if (t.includes(item.q)) return item.a;
      }
      // fallback simple heuristics
      if (/(daftar|register|pendaftaran)/.test(t)) return QA[0].a;
      if (/(syarat|requirement)/.test(t)) return QA[1].a;
      if (/(proposal|deck)/.test(t)) return QA[2].a;
      if (/(dana|pendanaan|biaya|fund)/.test(t)) return QA[3].a;
      if (/(mentor|bimbing)/.test(t)) return QA[4].a;
      return 'Untuk pertanyaan Anda, kami sedang dalam masa maintenance dan akan melakukan pembaruan secepatnya. Silakan gunakan pertanyaan cepat di bawah ini atau coba lagi beberapa saat nanti. Terima kasih atas pengertiannya!';
    }

    function renderSuggestions(){
      suggestions.innerHTML = '';
      QA.forEach((item)=>{
        const chip = document.createElement('button');
        chip.type = 'button';
        chip.className = 'wm-chip';
        chip.textContent = capitalize(item.q);
        chip.addEventListener('click', ()=>{
          addBubble(chip.textContent, 'user');
          setTimeout(()=> addBubble(item.a, 'bot'), 150);
        });
        suggestions.appendChild(chip);
      });
    }

    function capitalize(s){ return s.charAt(0).toUpperCase() + s.slice(1); }

    // welcome
    addBubble('Hai! Saya Asisten Wirausaha. Pilih pertanyaan cepat atau ketik pertanyaan Anda.', 'bot');
    renderSuggestions();

    // toggle
    function open(){ root.classList.add('open'); toggle.setAttribute('aria-expanded', 'true'); }
    function close(){ root.classList.remove('open'); toggle.setAttribute('aria-expanded', 'false'); }
    toggle.addEventListener('click', ()=>{
      if (root.classList.contains('open')) close(); else open();
    });
    closeBtn.addEventListener('click', close);

    // submit
    form.addEventListener('submit', (e)=>{
      e.preventDefault();
      const text = input.value.trim();
      if (!text) return;
      addBubble(text, 'user');
      input.value = '';
      setTimeout(()=> addBubble(matchAnswer(text), 'bot'), 150);
    });

    return true;
  }

  if (initWMWidget()) {
    return; // use new widget and stop
  }
  // Gunakan endpoint Laravel lokal
  const LARAVEL_ENDPOINT = '/chatbot/send';
  const CSRF_TOKEN = (document.querySelector('meta[name="csrf-token"]') || {}).content;

  // Create Toggle Button
  const toggleBtn = document.createElement('button');
  toggleBtn.id = 'pmw-chat-toggle';
  toggleBtn.title = 'Chat Wirausaha Polimedia';
  toggleBtn.setAttribute('aria-label', 'Buka Chat Wirausaha Polimedia');
  toggleBtn.textContent = '💬';

  // Create Chat Container
  const container = document.createElement('div');
  container.id = 'pmw-chat-container';
  container.setAttribute('role', 'dialog');
  container.setAttribute('aria-label', 'Chat Wirausaha Polimedia');

  // Header
  const header = document.createElement('div');
  header.className = 'pmw-chat-header';
  const title = document.createElement('h4');
  title.className = 'pmw-chat-title';
  title.textContent = 'Chat Wirausaha Polimedia';
  const closeBtn = document.createElement('button');
  closeBtn.className = 'pmw-chat-close';
  closeBtn.innerHTML = '&times;';
  header.appendChild(title);
  header.appendChild(closeBtn);

  // Messages area
  const messages = document.createElement('div');
  messages.className = 'pmw-chat-messages';

  // Welcome message
  addMessage('Halo! Saya asisten Wirausaha Polimedia. Tanyakan seputar pendaftaran, syarat, proposal, pendanaan, atau kegiatan wirausaha kampus ya.', 'bot');

  function addMessage(text, sender) {
    const msg = document.createElement('div');
    msg.className = `pmw-message ${sender}`;
    msg.textContent = text;
    messages.appendChild(msg);
    messages.scrollTop = messages.scrollHeight;
  }

  function addTyping() {
    const wrap = document.createElement('div');
    wrap.className = 'pmw-message bot';
    const t = document.createElement('div');
    t.className = 'pmw-typing';
    t.innerHTML = '<span class="dot"></span><span class="dot"></span><span class="dot"></span>';
    wrap.appendChild(t);
    wrap.dataset.typing = 'true';
    messages.appendChild(wrap);
    messages.scrollTop = messages.scrollHeight;
    return wrap;
  }

  function removeTyping(node){
    if (node && node.parentNode) node.parentNode.removeChild(node);
  }

  // Input bar
  const inputBar = document.createElement('div');
  inputBar.className = 'pmw-chat-inputbar';
  const input = document.createElement('input');
  input.type = 'text';
  input.placeholder = 'Tulis pertanyaan tentang Wirausaha Polimedia...';
  input.id = 'pmw-chat-input';
  const send = document.createElement('button');
  send.id = 'pmw-chat-send';
  send.textContent = 'Kirim';

  inputBar.appendChild(input);
  inputBar.appendChild(send);

  container.appendChild(header);
  container.appendChild(messages);
  container.appendChild(inputBar);

  function mount() {
    if (!document.getElementById('pmw-chat-toggle')) {
      document.body.appendChild(toggleBtn);
    }
    if (!document.getElementById('pmw-chat-container')) {
      document.body.appendChild(container);
    }
  }

  if (document.readyState === 'complete' || document.readyState === 'interactive') {
    // DOM sudah siap
    mount();
  } else {
    document.addEventListener('DOMContentLoaded', mount);
  }

  // Open/Close handlers
  function openChat(){
    container.classList.add('open');
  }
  function closeChat(){
    container.classList.remove('open');
  }

  toggleBtn.addEventListener('click', openChat);
  closeBtn.addEventListener('click', closeChat);

  // Send message
  async function sendMessage(){
    const text = input.value.trim();
    if (!text) return;
    addMessage(text, 'user');
    input.value = '';

    const typingNode = addTyping();

    try {
      const res = await fetch(LARAVEL_ENDPOINT, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-Requested-With': 'XMLHttpRequest',
          ...(CSRF_TOKEN ? { 'X-CSRF-TOKEN': CSRF_TOKEN } : {})
        },
        body: JSON.stringify({ message: text })
      });
      const data = await res.json();
      removeTyping(typingNode);
      if (data && data.reply) {
        addMessage(data.reply, 'bot');
      } else {
        addMessage('Terjadi kesalahan saat memproses jawaban.', 'bot');
      }
    } catch (e) {
      removeTyping(typingNode);
      addMessage('Gagal terhubung ke server. Coba beberapa saat lagi.', 'bot');
    }
  }

  send.addEventListener('click', sendMessage);
  input.addEventListener('keydown', (e)=>{
    if (e.key === 'Enter') {
      e.preventDefault();
      sendMessage();
    }
  });
})();
