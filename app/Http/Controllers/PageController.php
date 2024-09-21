<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    private string $type;
    private string $number;
    private array  $supportedLangs;
    private string $baseUrl;

    public function __construct(Request $request)
    {
        $this->type           = $request->type;
        $this->number         = $request->number;
        $this->supportedLangs = ['tr', 'ar'];
        $this->baseUrl        = config('app.url');
    }

    public function show()
    {
        $content[] = [
            'image' => 'https://seslikurandinle.com/assets/images/tr.png',
            'sound' => 'https://seslikurandinle.com/assets/audio/as/001_FC.mp3'
        ];
        $content[] = [
            'image' => 'https://seslikurandinle.com/assets/images/tr.png',
            'sound' => 'https://seslikurandinle.com/assets/audio/as/001_FC.mp3'
        ];
        return view('page', compact('content'));
    }

    private function content(string $type, string $number): array
    {
        $content = [];
        foreach ($this->supportedLangs as $lang) {
            $content[] = [
                'image' => $this->baseUrl . '/assets/images/flags/' . $lang . '.png',
                'sound' => $this->baseUrl . '/assets/files/' . $type . '/' . $number . '_' . $lang . '.mp3',
            ];
        }
        return $content;
    }
}
