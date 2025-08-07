@php
    $teams = [
        'CEO' => [
            'name' => 'Syafiq Buana',
            'role' => 'CEO',
            'image' => asset('images/developers/syafiq.png'),
            'links' => [
                'instagram' => [
                    'url' => 'https://instagram.com/syafiqbuana',
                    'icon' => asset('images/icons/instagram.svg'),
                ],
                'links' => [
                    'github' => [
                        'url' => 'https://github.com/syafiqbuana',
                        'icon' => asset('images/icons/github-mark.svg'),
                    ],
                ],
            ],
        ],
        'Project Lead' => [
            [
                'name' => 'Rifqi Banu Safingi',
                'role' => 'Project Lead',
                'image' => asset('images/developers/rifqi.png'),
                'links' => [
                    'instagram' => [
                        'url' => 'https://instagram.com/alcyoneuzz',
                        'icon' => asset('images/icons/instagram.svg'),
                    ],
                    'github' => [
                        'url' => 'https://github.com/rifqi011',
                        'icon' => asset('images/icons/github-mark.svg'),
                    ],
                ],
            ],
        ],
        'UI/UX Designer' => [
            [
                'name' => 'Diva Nur Anggraeni',
                'role' => 'UI/UX Designer',
                'image' => asset('images/developers/diva.png'),
                'links' => [
                    'instagram' => [
                        'url' => 'https://instagram.com/d04veu',
                        'icon' => asset('images/icons/instagram.svg'),
                    ],
                ],
            ],
            [
                'name' => 'Rizqi Raditya Paramita',
                'role' => 'UI/UX Designer',
                'image' => asset('images/developers/rizqi.png'),
                'links' => [
                    'instagram' => [
                        'url' => 'https://instagram.com/rizqi_raditya1',
                        'icon' => asset('images/icons/instagram.svg'),
                    ],
                ],
            ],
            [
                'name' => 'Firda Citra Aulia Z',
                'role' => 'UI/UX Designer',
                'image' => asset('images/developers/firda.png'),
                'links' => [
                    'instagram' => [
                        'url' => 'https://instagram.com/firdacitra.a',
                        'icon' => asset('images/icons/instagram.svg'),
                    ],
                ],
            ],
        ],
        'Programmer' => [
            [
                'name' => 'Alan Primadhani Ar-Riziq',
                'role' => 'Programmer',
                'image' => asset('images/developers/alan.png'),
                'links' => [
                    'instagram' => [
                        'url' => 'https://instagram.com/aln.prmdhni',
                        'icon' => asset('images/icons/instagram.svg'),
                    ],
                ],
            ],
            [
                'name' => 'Raditya Agung Wibowo',
                'role' => 'Programmer',
                'image' => asset('images/developers/radit.png'),
                'links' => [
                    'instagram' => [
                        'url' => 'https://instagram.com/rdtyaaw_',
                        'icon' => asset('images/icons/instagram.svg'),
                    ],
                ],
            ],
            [
                'name' => 'Rafi Putra Aryawitama',
                'role' => 'Programmer',
                'image' => asset('images/developers/putra.png'),
                'links' => [
                    'instagram' => [
                        'url' => 'https://instagram.com/rputrarya',
                        'icon' => asset('images/icons/instagram.svg'),
                    ],
                ],
            ],
        ],
        'Data Analyst' => [
            [
                'name' => 'Soofi Amalya Almayka',
                'role' => 'Data Analyst',
                'image' => asset('images/developers/soofi.png'),
                'links' => [
                    'instagram' => [
                        'url' => 'https://instagram.com/sfiamaliaa_',
                        'icon' => asset('images/icons/instagram.svg'),
                    ],
                ],
            ],
            [
                'name' => 'Fahri Alif Leksono',
                'role' => 'Data Analyst',
                'image' => asset('images/developers/fahri.png'),
                'links' => [
                    'instagram' => [
                        'url' => 'https://instagram.com/antbcj',
                        'icon' => asset('images/icons/instagram.svg'),
                    ],
                ],
            ],
        ],
        'Marketing' => [
            [
                'name' => 'M. Ken Yusuf D',
                'role' => 'Marketing',
                'image' => asset('images/developers/ken.png'),
                'links' => [
                    'instagram' => [
                        'url' => 'https://instagram.com/ken_yusufff',
                        'icon' => asset('images/icons/instagram.svg'),
                    ],
                ],
            ],
            [
                'name' => 'Fikri Azka Ariputra',
                'role' => 'Marketing',
                'image' => asset('images/developers/fikri.png'),
                'links' => [
                    'instagram' => [
                        'url' => 'https://instagram.com/tsdhjf21',
                        'icon' => asset('images/icons/instagram.svg'),
                    ],
                ],
            ],
        ],
    ];
@endphp

<x-user.layout>
    <div class="mx-auto flex max-w-md flex-col gap-6 text-center">
        <div class="mb-4">
            <img src="{{ asset('images/logo-shifu.svg') }}" loading="lazy" alt="Logo Shifu" class="mx-auto mb-4 w-20">
            <h1 class="text-4xl font-bold">Shifu Team</h1>
        </div>

        @foreach ($teams as $teamName => $members)
            <div class="flex flex-col gap-6 rounded-3xl bg-white p-4 shadow-card">
                <h2 class="text-3xl font-bold">{{ $teamName }}</h2>

                <ul class="flex flex-col items-center gap-4">
                    @foreach ($members as $index => $member)
                        <li class="flex flex-col items-center gap-2">
                            <img src="{{ $member['image'] }}" alt="{{ $member['name'] }}" class="rounded-full" width="100">

                            <h3 class="text-xl font-semibold">{{ $member['name'] }}</h3>

                            <div class="flex items-center gap-2">
                                @foreach ($member['links'] as $link)
                                    <a href="{{ $link['url'] }}" target="_blank">
                                        <img src="{{ $link['icon'] }}" loading="lazy" alt="" width="30">
                                    </a>
                                @endforeach
                            </div>
                        </li>

                        @if ($index < count($members) - 1)
                            <x-user.form.divider class="h- w-full" />
                        @endif
                    @endforeach
                </ul>
            </div>
        @endforeach
    </div>
</x-user.layout>
