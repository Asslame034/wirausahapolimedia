<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Throwable;

class ChatbotController extends Controller
{
    /**
     * Handle chatbot message and respond using OpenAI API.
     * Route: POST /chatbot/send
     */
    public function send(Request $request)
    {
        $message = trim((string) $request->input('message', ''));

        // ✅ Filter topik — hanya melayani pertanyaan terkait Wirausaha Polimedia
        if (!$this->isRelevant($message)) {
            return response()->json([
                'reply' => 'Maaf, saya hanya dapat membantu pertanyaan seputar Wirausaha Polimedia 🙏',
            ]);
        }

        // ✅ Ambil konfigurasi dari config/services.php
        $config = config('services.openai');
        $apiKey = $config['key'] ?? null;
        $endpoint = $config['endpoint'] ?? 'https://api.openai.com/v1/chat/completions';
        $model = $config['model'] ?? 'gpt-4o-mini';

        // ✅ Jika API key kosong
        if (!$apiKey) {
            Log::error('[Chatbot] OPENAI_API_KEY is missing.');
            return response()->json([
                'reply' => $this->debugMode()
                    ? 'Konfigurasi OpenAI belum tersedia (OPENAI_API_KEY tidak ditemukan).'
                    : 'Terjadi kesalahan saat memproses jawaban.',
            ], 500);
        }

        // ✅ Prompt sistem
        $systemPrompt = "Anda adalah asisten AI untuk Wirausaha Politeknik Negeri Media Kreatif (Polimedia).\n" .
            "Jawablah hanya pertanyaan yang berkaitan dengan program wirausaha kampus, cara pendaftaran, proposal usaha, pendanaan, syarat & ketentuan, dan kegiatan kewirausahaan mahasiswa.\n" .
            "Jika pertanyaan di luar topik, balas: 'Maaf, saya hanya dapat membantu pertanyaan seputar Wirausaha Polimedia 🙏'.\n" .
            "Jawablah dalam bahasa Indonesia yang ringkas dan jelas.";

        // ✅ Payload request ke OpenAI
        $payload = [
            'model' => $model,
            'messages' => [
                ['role' => 'system', 'content' => $systemPrompt],
                ['role' => 'user', 'content' => $message],
            ],
            'temperature' => 0.4,
            'max_tokens' => 400,
        ];

        try {
            // ✅ Request ke OpenAI API
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(30)->post($endpoint, $payload);

            // ✅ Jika gagal (4xx / 5xx)
            if ($response->failed()) {
                $status = $response->status();
                $body = $response->body();

                Log::error('[Chatbot] OpenAI API failed', [
                    'status' => $status,
                    'body' => $this->safeTruncate($body),
                ]);

                // Saat APP_DEBUG=true → tampilkan error aslinya
                return response()->json([
                    'reply' => $this->debugMode()
                        ? "❌ OpenAI API error ($status): " . $this->safeTruncate($body)
                        : 'Terjadi kesalahan saat memproses jawaban.',
                ], 500);
            }

            // ✅ Parsing hasil
            $data = $response->json();
            $reply = $data['choices'][0]['message']['content'] ?? null;

            return response()->json([
                'reply' => $reply ? trim($reply) : 'Maaf, saya tidak dapat menjawab saat ini.',
            ]);

        } catch (Throwable $e) {
            // ✅ Tangani error koneksi / timeout / parsing
            Log::error('[Chatbot] Exception when calling OpenAI', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json([
                'reply' => $this->debugMode()
                    ? '🚨 Exception: ' . $e->getMessage()
                    : 'Terjadi kesalahan pada server.',
            ], 500);
        }
    }

    /**
     * Health check endpoint (cek konfigurasi OpenAI tanpa bocorkan key).
     * Route: GET /chatbot/health
     */
    public function health(Request $request)
    {
        $config = config('services.openai');

        return response()->json([
            'ok' => true,
            'openai' => [
                'has_key' => !empty($config['key']),
                'model' => $config['model'] ?? null,
                'endpoint_present' => !empty($config['endpoint']),
            ],
            'app_debug' => $this->debugMode(),
        ]);
    }

    /**
     * Topik yang diperbolehkan untuk chatbot.
     */
    private function isRelevant(string $message): bool
    {
        $text = mb_strtolower($message);
        $keywords = [
            'wirausaha', 'polimedia', 'pmw', 'proposal', 'pendanaan',
            'ide usaha', 'kegiatan', 'daftar', 'pendaftaran',
            'syarat', 'ketentuan', 'program wirausaha'
        ];
        foreach ($keywords as $k) {
            if (mb_strpos($text, $k) !== false) {
                return true;
            }
        }
        return false;
    }

    /**
     * Cek apakah APP_DEBUG aktif.
     */
    private function debugMode(): bool
    {
        return (bool) config('app.debug');
    }

    /**
     * Hindari log terlalu panjang.
     */
    private function safeTruncate(?string $text, int $max = 2000): string
    {
        if ($text === null) return '';
        return mb_strlen($text) > $max ? (mb_substr($text, 0, $max) . '…') : $text;
    }
}
