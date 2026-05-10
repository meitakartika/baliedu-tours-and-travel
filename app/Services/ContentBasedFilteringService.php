<?php

namespace App\Services;

use App\Models\Package;
use Illuminate\Support\Collection;

class ContentBasedFilteringService
{
    public function getSimilarPackages(Package $currentPackage, int $limit = 3): Collection // mencari paket wisata yang mirip
    {
        // Ambil semua package beserta relasi yang dibutuhkan
        $packages = Package::with([
            'category',
            'type',
            'itineraries.details'
        ])->get();

        if ($packages->count() <= 1) { // Kalau package cuma ada 1 atau kosong, tidak bisa mencari kemiripan
            return collect();
        }

        // =========================
        // 1. Build Documents
        // =========================
        $documents = [];
        foreach ($packages as $package) {
            $documents[$package->id] = $this->buildDocument($package); // Setiap package diubah menjadi teks panjang
        }

        // =========================
        // 2. Tokenize
        // =========================
        $tokenizedDocs = [];
        foreach ($documents as $id => $doc) {
            $tokens = $this->tokenize($doc); // Memecah teks menjadi kata-kata
            $tokens = $this->removeStopwords($tokens); // Menghapus kata umum
            $tokenizedDocs[$id] = $tokens; // Menyimpan token per package
        }

        // =========================
        // 3. Build Vocabulary
        // =========================
        $vocabulary = [];
        foreach ($tokenizedDocs as $tokens) {
            $vocabulary = array_merge($vocabulary, $tokens); // Menggabungkan semua kata dari semua dokumen
        }
        $vocabulary = array_values(array_unique($vocabulary)); // Menghapus kata duplikat

        // =========================
        // 4. Compute TF
        // =========================
        $tfVectors = [];
        foreach ($tokenizedDocs as $id => $tokens) {
            $tfVectors[$id] = $this->computeTF($tokens, $vocabulary); // Menghitung TF
        }

        // =========================
        // 5. Compute IDF
        // =========================
        $idf = $this->computeIDF($tokenizedDocs, $vocabulary); // Menghitung IDF

        // =========================
        // 6. Compute TF-IDF
        // =========================
        $tfidfVectors = [];
        foreach ($tfVectors as $id => $tf) { // Loop semua TF
            $tfidfVectors[$id] = $this->computeTFIDF($tf, $idf); // Menghitung TFIDF
        }

        // Package yang sedang dibuka tidak punya vektor TF-IDF
        if (!isset($tfidfVectors[$currentPackage->id])) {
            return collect(); // return kosong
        }

        // Mengambil vektor TF-IDF package yang sedang dibuka
        $currentVector = $tfidfVectors[$currentPackage->id];

        // =========================
        // 7. Cosine Similarity
        // =========================
        $similarities = [];

        foreach ($tfidfVectors as $id => $vector) { // Bandingkan vektor dengan semua package
            if ($id == $currentPackage->id) { // Skip package dirinya sendiri
                continue;
            }

            $similarities[$id] = $this->cosineSimilarity($currentVector, $vector); // Menghitung kemiripan
        }

        $similarities = array_filter($similarities, function ($score) {
            return $score > 0.1; // Hanya ambil similarity > 0.1.
        });
        // Urutkan dari terbesar ke terkecil
        arsort($similarities);

        $topIds = array_slice(array_keys($similarities), 0, $limit); // Ambil ID package teratas

        // =========================
        // 8. Return sesuai ranking
        // =========================
        $similarPackages = Package::with([
            'type',
            'category'
        ])
            ->withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->whereIn('id', $topIds)
            ->get()
            ->sortBy(function ($package) use ($similarities) {
                return -$similarities[$package->id];
            })
            ->values();

        foreach ($similarPackages as $package) { // Loop hasil rekomendasi
            $package->similarity_score = $similarities[$package->id] ?? 0; // // Attach similarity score (buat debug)
        }

        return $similarPackages;
    }

    // Function helper untuk mengubah data package menjadi teks panjang
    private function buildDocument(Package $package): string
    {
        $locale = app()->getLocale();

        $name = $locale === 'id'
            ? $package->name_id
            : $package->name_en;

        $overview = $locale === 'id'
            ? $package->overview_id
            : $package->overview_en;

        $category = $locale === 'id'
            ? ($package->category->name_id ?? '')
            : ($package->category->name_en ?? '');

        $type = $locale === 'id'
            ? ($package->type->name_id ?? '')
            : ($package->type->name_en ?? '');

        $itineraryTitles = $package->itineraries
            ->pluck($locale === 'id' ? 'title_id' : 'title_en')
            ->implode(' ');

        $itineraryDetails = $package->itineraries
            ->flatMap(function ($itinerary) use ($locale) {
                return $itinerary->details->pluck(
                    $locale === 'id' ? 'description_id' : 'description_en'
                );
            })
            ->implode(' ');

        // Overview dan type diberi bobot lebih (x2)
        $fullText =
            $name . ' ' .
            $category . ' ' .
            $type . ' ' . $type . ' ' .
            $overview . ' ' . $overview . ' ' .
            $itineraryTitles . ' ' .
            $itineraryDetails;

        return $this->preprocess($fullText);
    }

    // Function helper text preprocessing
    private function preprocess(string $text): string
    {
        $text = strtolower($text); // Ubah jadi huruf kecil
        $text = preg_replace('/[^a-z0-9\s]/', ' ', $text); // Hapus simbol
        $text = preg_replace('/\s+/', ' ', $text); // Rapikan spasi

        return trim($text);
    }

    // Function helper tokenize
    private function tokenize(string $text): array
    {
        return explode(' ', $text); // Memecah teks berdasarkan spasi
    }

    // Function helper stopwords removal
    private function removeStopwords(array $tokens): array
    {
        $stopwords = [
            // English
            'the',
            'and',
            'with',
            'to',
            'of',
            'in',
            'on',
            'for',
            'a',
            'an',
            'is',
            'are',
            'this',
            'that',
            'from',
            'by',
            'at',
            'as',
            'it',
            'be',
            'or',

            // Indonesia
            'dan',
            'yang',
            'di',
            'ke',
            'dari',
            'untuk',
            'dengan',
            'atau',
            'ini',
            'itu',
            'adalah',
            'pada',
            'sebagai'
        ];

        return array_values(array_diff($tokens, $stopwords));
    }

    // Function helper compute TF untuk menghitung frekuensi kata
    private function computeTF(array $tokens, array $vocabulary): array
    {
        $tf = [];
        $totalTerms = count($tokens); // Menghitung total kata
        $wordCounts = array_count_values($tokens); // Menghitung jumlah kemunculan tiap kata

        foreach ($vocabulary as $word) { // loop semua kata
            $count = $wordCounts[$word] ?? 0; // Mengambil jumlah kemunculan kata
            $tf[$word] = $totalTerms > 0 ? $count / $totalTerms : 0; // inti perhitungan TF
        }

        return $tf;
    }

    // Function helper compute IDF seberapa penting sebuah kata di seluruh dokumen
    private function computeIDF(array $tokenizedDocs, array $vocabulary): array
    {
        $idf = [];
        $totalDocs = count($tokenizedDocs); // Menghitung jumlah dokumen/package

        $docFrequency = [];

        foreach ($tokenizedDocs as $tokens) { // Loop semua dokumen
            $uniqueTokens = array_unique($tokens); // Menghapus kata duplikat dalam satu dokumen

            foreach ($uniqueTokens as $token) { // Loop setiap kata unik dalam dokumen tersebut
                if (!isset($docFrequency[$token])) { // Kalau kata belum ada di array DF, buat dulu nilainya 0
                    $docFrequency[$token] = 0;
                }
                $docFrequency[$token]++; // Setelah itu langsung ditambah
            }
        }

        // Hitung IDF
        foreach ($vocabulary as $word) { // Loop semua kata di vocabulary/sistem
            $df = $docFrequency[$word] ?? 0; // Ambil nilai DF kata tersebut
            $idf[$word] = log(($totalDocs + 1) / ($df + 1)) + 1; // inti perhitungan IDF
        }

        return $idf;
    }

    // Function helper compute TF-IDF
    private function computeTFIDF(array $tf, array $idf): array
    {
        $tfidf = [];

        foreach ($tf as $word => $value) { // Loop semua kata dari TF
            $tfidf[$word] = $value * ($idf[$word] ?? 0); // inti perhitungan
        }

        return $tfidf;
    }

    // Function helper compute Cosine Similarity
    private function cosineSimilarity(array $vectorA, array $vectorB): float // input: 2 vector angka (TF-IDF), output: nilai kemiripan (float)
    {
        $dotProduct = 0; // untuk menghitung kemiripan
        $normA = 0; // panjang vektor A
        $normB = 0; // panjang vektor B

        foreach ($vectorA as $word => $value) { // Loop semua kata di vektor A
            $dotProduct += $value * ($vectorB[$word] ?? 0); // kalikan nilai kata di A dengan nilai kata yang sama di B
            $normA += $value ** 2; // kuadratkan lalu jumlahkan semua nilai vektor A
        }

        foreach ($vectorB as $value) {
            $normB += $value ** 2;
        }

        $normA = sqrt($normA); // Mengubah dari jumlah kuadrat menjadi panjang vektor (diakarkan)
        $normB = sqrt($normB);

        return ($normA * $normB) > 0
            ? $dotProduct / ($normA * $normB) // inti perhitungan
            : 0;
    }
}
