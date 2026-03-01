<?php

namespace App\Services;

use App\Models\Package;
use Illuminate\Support\Collection;

class ContentBasedFilteringService
{
    /**
     * Get similar packages using TF-IDF + Cosine Similarity
     */
    public function getSimilarPackages(Package $currentPackage, int $limit = 3): Collection
    {
        // Ambil semua package beserta relasi yang dibutuhkan
        $packages = Package::with([
            'category',
            'type',
            'itineraries.details'
        ])->get();

        if ($packages->count() <= 1) {
            return collect();
        }

        // =========================
        // 1. Build Documents
        // =========================
        $documents = [];
        foreach ($packages as $package) {
            $documents[$package->id] = $this->buildDocument($package);
        }

        // =========================
        // 2. Tokenize
        // =========================
        $tokenizedDocs = [];
        foreach ($documents as $id => $doc) {
            $tokens = $this->tokenize($doc);
            $tokens = $this->removeStopwords($tokens);
            $tokenizedDocs[$id] = $tokens;
        }

        // =========================
        // 3. Build Vocabulary
        // =========================
        $vocabulary = [];
        foreach ($tokenizedDocs as $tokens) {
            $vocabulary = array_merge($vocabulary, $tokens);
        }
        $vocabulary = array_values(array_unique($vocabulary));

        // =========================
        // 4. Compute TF
        // =========================
        $tfVectors = [];
        foreach ($tokenizedDocs as $id => $tokens) {
            $tfVectors[$id] = $this->computeTF($tokens, $vocabulary);
        }

        // =========================
        // 5. Compute IDF
        // =========================
        $idf = $this->computeIDF($tokenizedDocs, $vocabulary);

        // =========================
        // 6. Compute TF-IDF
        // =========================
        $tfidfVectors = [];
        foreach ($tfVectors as $id => $tf) {
            $tfidfVectors[$id] = $this->computeTFIDF($tf, $idf);
        }

        // Pastikan current package ada
        if (!isset($tfidfVectors[$currentPackage->id])) {
            return collect();
        }

        $currentVector = $tfidfVectors[$currentPackage->id];

        // =========================
        // 7. Cosine Similarity
        // =========================
        $similarities = [];

        foreach ($tfidfVectors as $id => $vector) {
            if ($id == $currentPackage->id) {
                continue;
            }

            $similarities[$id] = $this->cosineSimilarity($currentVector, $vector);
        }

        $similarities = array_filter($similarities, function ($score) {
            return $score > 0.1;
        });
        // Urutkan dari terbesar ke terkecil
        arsort($similarities);

        $topIds = array_slice(array_keys($similarities), 0, $limit);

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

        // attach similarity score (buat debug / skripsi)
        foreach ($similarPackages as $package) {
            $package->similarity_score = $similarities[$package->id] ?? 0;
        }

        return $similarPackages;
    }

    /**
     * Build document representation of a package
     */
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

        // Overview diberi bobot lebih (x2)
        $fullText =
            $name . ' ' .
            $category . ' ' .
            $type . ' ' . $type . ' ' .
            $overview . ' ' . $overview . ' ' .
            $itineraryTitles . ' ' .
            $itineraryDetails;

        return $this->preprocess($fullText);
    }

    /**
     * Text preprocessing
     */
    private function preprocess(string $text): string
    {
        $text = strtolower($text);
        $text = preg_replace('/[^a-z0-9\s]/', ' ', $text);
        $text = preg_replace('/\s+/', ' ', $text);

        return trim($text);
    }

    /**
     * Tokenize text
     */
    private function tokenize(string $text): array
    {
        return explode(' ', $text);
    }

    /**
     * Stopwords Removal
     */
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

            // Indonesian
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

    /**
     * Compute Term Frequency (TF)
     */
    private function computeTF(array $tokens, array $vocabulary): array
    {
        $tf = [];
        $totalTerms = count($tokens);
        $wordCounts = array_count_values($tokens);

        foreach ($vocabulary as $word) {
            $count = $wordCounts[$word] ?? 0;
            $tf[$word] = $totalTerms > 0 ? $count / $totalTerms : 0;
        }

        return $tf;
    }

    /**
     * Compute Inverse Document Frequency (IDF)
     */
    private function computeIDF(array $tokenizedDocs, array $vocabulary): array
    {
        $idf = [];
        $totalDocs = count($tokenizedDocs);

        // Hitung document frequency
        $docFrequency = [];

        foreach ($tokenizedDocs as $tokens) {
            $uniqueTokens = array_unique($tokens);

            foreach ($uniqueTokens as $token) {
                if (!isset($docFrequency[$token])) {
                    $docFrequency[$token] = 0;
                }
                $docFrequency[$token]++;
            }
        }

        // Hitung IDF
        foreach ($vocabulary as $word) {
            $df = $docFrequency[$word] ?? 0;
            $idf[$word] = log(($totalDocs + 1) / ($df + 1)) + 1;
        }

        return $idf;
    }

    /**
     * Compute TF-IDF
     */
    private function computeTFIDF(array $tf, array $idf): array
    {
        $tfidf = [];

        foreach ($tf as $word => $value) {
            $tfidf[$word] = $value * ($idf[$word] ?? 0);
        }

        return $tfidf;
    }

    /**
     * Compute Cosine Similarity
     */
    private function cosineSimilarity(array $vectorA, array $vectorB): float
    {
        $dotProduct = 0;
        $normA = 0;
        $normB = 0;

        foreach ($vectorA as $word => $value) {
            $dotProduct += $value * ($vectorB[$word] ?? 0);
            $normA += $value ** 2;
        }

        foreach ($vectorB as $value) {
            $normB += $value ** 2;
        }

        $normA = sqrt($normA);
        $normB = sqrt($normB);

        return ($normA * $normB) > 0
            ? $dotProduct / ($normA * $normB)
            : 0;
    }
}
