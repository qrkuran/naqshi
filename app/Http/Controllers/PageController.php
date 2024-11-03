<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    private string $type;
    private string $number;
    private array $supportedLangs;
    private string $baseUrl;

    public function __construct(Request $request)
    {
        $this->type = $request->type;
        $this->number = str_pad($request->number, 3, '0', STR_PAD_LEFT);
        $this->supportedLangs = ['ra', 'uz', 'ru']; // ra - Arabic, uz - Uzbek, ru - Russian
        $this->baseUrl = "https://seslikurandinle.com/";
    }

    public function show()
    {
        $content = [];
        $content = $this->getContent($this->type, $this->number);

        return view('page', compact('content'));
    }

    private function getContent(string $type, string $number): array
    {
        $content = [];
        $titleNum = $number;

        foreach ($this->supportedLangs as $lang) {
            $audioPath = match ($type) {
                '1' => match (strtolower($lang)) {
                    'ra' => 'audio/as',
                    'ru', 'uz' => 'audio/ms',
                },
                '2' => match (strtolower($lang)) {
                    'ra' => 'audio/asu',
                    'ru', 'uz' => 'audio/msu',
                },
                default => throw new \InvalidArgumentException('Invalid type specified'),
            };

            $formattedLang = $lang === 'ra' ? 'RA' : strtolower($lang);

            if($type === "1" && $formattedLang !== 'RA' && $formattedLang !== 'ru')
            {
                $newNumber = (int)$number - 1;
                $number = str_pad($newNumber, 3, '0', STR_PAD_LEFT);
            }

            $content[] = [
                'title' => $this->findByTitle($lang, $type, $titleNum),
                'sound' => sprintf(
                    '%sassets/%s/%s_%s.mp3',
                    $this->baseUrl,
                    $audioPath,
                    $number,
                    $formattedLang
                ),
            ];
        }
        return $content;
    }

    private function findByTitle(string $lang, string $type, string $number): string
    {
        $translations = [
            'ra' => [
                'language' => 'عربي',
                'page' => 'الصفحة',
                'surah' => 'سورة'
            ],
            'uz' => [
                'language' => 'uzbek',
                'page' => 'Sahifa',
                'surah' => 'Surah'
            ],
            'ru' => [
                'language' => 'русский',
                'page' => 'Страница',
                'surah' => 'Сура'
            ]
        ];

        $defaultLang = [
            'language' => 'Unknown',
            'page' => 'Page',
            'surah' => 'Surah'
        ];

        $langData = $translations[$lang] ?? $defaultLang;

        return match ($type) {
            '1' => sprintf('%s - %s %s', $langData['language'], $langData['page'], $number),
            '2' => sprintf('%s - %s %s', $langData['language'], $langData['surah'], $number),
            default => $langData['language'],
        };
    }
}
