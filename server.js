// server.js - Backend Node.js (ESM) untuk Chat Wirausaha Polimedia
// - Menggunakan Express + CORS
// - Endpoint POST /chat meneruskan pesan ke OpenAI Chat Completions
// - Membatasi topik hanya seputar Wirausaha Polimedia

import 'dotenv/config';
import express from 'express';
import cors from 'cors';
import fetch from 'node-fetch';

const app = express();
const PORT = process.env.PORT || 3000;

// ✅ Baca API Key dari environment (JANGAN taruh di frontend!)
const OPENAI_API_KEY = process.env.OPENAI_API_KEY;
const OPENAI_MODEL = process.env.OPENAI_MODEL || 'gpt-4o-mini';

app.use(cors());
app.use(express.json());

// 🧠 Fungsi sederhana untuk cek apakah pertanyaan relevan
function isRelevant(message) {
  if (!message) return false;
  const text = String(message).toLowerCase();
  const keywords = [
    'wirausaha', 'polimedia', 'pmw', 'proposal', 'pendanaan',
    'ide usaha', 'kegiatan', 'daftar', 'pendaftaran', 'syarat', 'ketentuan', 'program wirausaha'
  ];
  return keywords.some(k => text.includes(k));
}

// 📨 Endpoint utama untuk chatbot
app.post('/chat', async (req, res) => {
  try {
    const userMessage = (req.body && req.body.message) ? String(req.body.message) : '';

    // ❌ Jika pertanyaan tidak relevan → balas langsung
    if (!isRelevant(userMessage)) {
      return res.json({
        reply: 'Maaf, saya hanya dapat membantu pertanyaan seputar Wirausaha Polimedia 🙏'
      });
    }

    // 📜 Sistem prompt agar jawaban fokus ke topik Wirausaha Polimedia
    const systemPrompt = `
    Anda adalah asisten AI untuk Wirausaha Politeknik Negeri Media Kreatif (Polimedia).
    Jawablah hanya hal-hal terkait Wirausaha di Polimedia:
    - pengertian program
    - cara mendaftar
    - syarat & ketentuan
    - proposal usaha
    - pendanaan mahasiswa
    - ide usaha mahasiswa Polimedia
    - kegiatan pendukung wirausaha kampus.
    Jika pertanyaan di luar topik tersebut, balas:
    "Maaf, saya hanya dapat membantu pertanyaan seputar Wirausaha Polimedia 🙏".
    Berikan jawaban yang ringkas, jelas, dan ramah dalam bahasa Indonesia.
    `;

    // 🚀 Panggil OpenAI API
    const response = await fetch('https://api.openai.com/v1/chat/completions', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Authorization': `Bearer ${OPENAI_API_KEY}`
      },
      body: JSON.stringify({
        model: OPENAI_MODEL,
        messages: [
          { role: 'system', content: systemPrompt },
          { role: 'user', content: userMessage }
        ],
        temperature: 0.4,
        max_tokens: 400
      })
    });

    // ❌ Kalau gagal memanggil API
    if (!response.ok) {
      const errText = await response.text();
      console.error('❌ OpenAI API error:', errText);
      return res.status(500).json({ reply: 'Gagal memanggil OpenAI API.' });
    }

    // ✅ Ambil jawaban dari API
    const data = await response.json();
    const reply = data.choices?.[0]?.message?.content?.trim() || 'Maaf, saya tidak dapat menjawab saat ini.';
    return res.json({ reply });

  } catch (err) {
    console.error('❌ Server error:', err);
    return res.status(500).json({ reply: 'Terjadi kesalahan pada server.' });
  }
});

// ▶️ Jalankan server
app.listen(PORT, () => {
  console.log(`✅ Wirausaha Chat server berjalan di http://localhost:${PORT}`);
});

