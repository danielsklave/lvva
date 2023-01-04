@extends('layouts.app')

@section('body')

    <div class="page-title">
        <h1>Antidopings</h1>
    </div>

    <div class="flex flex-col style-links">
        <a class="w-fit" href="https://www.irunclean.org/" target="_blank">
            "I Run Clean" apmācības un sertifikāta iegūšana
        </a>

        <a class="w-fit" href="https://antidopings.gov.lv/" target="_blank">
            Latvijas antidopinga biroja mājas lapa
        </a>

        <a class="w-fit" href="https://antidopings.gov.lv/aizliegtas-vielas/parbaudit-medikamentu" target="_blank">
            Medikamentu pārbaude
        </a>

        <a class="w-fit" href="{{ url('files/aizliegtaas_vielas.pdf') }}" target="_blank">
            Aizliegto vielu un metožu saraksts (2020)
        </a> 
    </div>

    <h1 class="text-xl font-bold">
        Biežāk uzdotie jautājumi
    </h1>

    @php
        $arr = [
            [
                'q' => 'Vai aizliegts lietot noteiktas vielas ir tikai sacensību laikā?',
                'a' => 'Aizliegto vielu un metožu sarakstā ir gan tādas vielas un metodes, kuras uzskatāmas par dopingu un ir aizliegtas kā sacensību laikā, tā ārpus sacensībām, gan arī tādas vielas un metodes, kuras ir aizliegtas tikai sacensību laikā. Jāņem vērā, ka vielas pēc to lietošanas no organisma neizvadās/neizdalās uzreiz (dažādu vielu izvadīšanās laiki ir atšķirīgi), tāpēc jāuzmanās arī ar ārpussacensību laikā atļauto vielu lietošanu pirms sacensībām. Īpaši tas attiecināms uz, piemēram, marihuānu, kuras lietošana antidopinga noteikumu izpratnē ir sodāma tikai sacensību laikā (savukārt narkotisko vielu regulējošo noteikumu izpratnē – aizliegta jebkurā laikā un ikvienam, ne tikai sportistiem) – ir zināms, ka kanabinoīdi organismā saglabājas ilgstoši un arī lietoti krietnu laiku pirms sacensībām var būt atrodami paraugā, kas ņemts no sportista ķermeņa sacensību laikā.',
            ],
            [
                'q' => 'Kuri uztura bagātinātāji satur sportā aizliegtās vielas un kuri uztura bagātinātāji ir droši lietošanai?',
                'a' => 'Patlaban nav drošas metodes, kā noteikt, vai uztura bagātinātājs ir vai nav piesārņots. Saskaņā ar pētījumiem, apmēram 10 līdz 15 procentu uztura bagātinātāju ir piesārņoti – tajos tiek pievienotas sportā aizliegtas vielas, kuras netiek norādītas sastāvdaļu sarakstā. Līdz ar to aicinām izvērtēt, vai uztura bagātinātāju lietošana Jums vispār ir nepieciešama, kā arī iegādāties tos tikai no licencētiem piegādātājiem, nevis nezināmas izcelsmes produktus internetā, sporta zālē no nesertificētiem izplatītājiem u.tml.',
            ],
            [
                'q' => 'Vai jebkurš aptiekā nopērkams medikaments ir drošs lietošanai sportistiem?',
                'a' => 'Nē, jo virkne medikamentu – tostarp arī bezrecepšu zāles – satur sportā aizliegtās vielas. Ja esat sportists, noteikti pārbaudiet medikamentu sastāvu pirms to lietošanas. Ja rodas šaubas par to, vai medikamenta sastāvā esošās vielas ir vai nav aizliegto vielu sarakstā, aicinām Jūs sazināties ar Antidopinga nodaļu (saite uz: https://antidopings.gov.lv ).',
            ],
            [
                'q' => 'No kādu medikamentu lietošanas būtu īpaši jāuzmanās?',
                'a' => 'Sabiedrībā populāri un sportā aizliegti ir virkne medikamenti, tostarp: visu laiku aizliegti – meldonium (Mildronāts), diurētiski līdzekļi, astmas preperāti atkarībā no lietošanas veida un lietošanas devas; tikai sacensību laikā aizliegti – pretsaaukstēšanās līdzekļi ar pseidoefedrīnu atkarībā no lietošanas devas (piemēra, Theraflu). Pirms jebkura medikamenta lietošanas aicinām iepazīties ar spēkā esošo aizliegto vielu un metožu sarakstu, kā arī jautājumu gadījumā sazināties ar Antidopinga nodaļu (saite uz: https://antidopings.gov.lv ).',
            ],
            [
                'q' => 'Vai antidopinga noteikumi attiecas tikai uz profesionālajiem sportistiem?',
                'a' => 'Saskaņā ar Sporta likumā noteikto, sportists ir fiziskā persona, kas nodarbojas ar sportu un piedalās sporta sacensībās, nešķirojot, vai sportists ir profesionālis (saņem atlīdzību par gatavošanos un piedalīšanos sacensībās uz līguma pamata) vai t.s. “amatieris”. Dopinga vielu vai metožu lietošana ir pretrunā ar godīgas sacensības principu jebkurā līmenī, turklāt nepamatota dopinga vielu un metožu lietošana var būt bīstama veselībai. Tāpēc antidopinga noteikumi attiecas uz visiem sportistiem, tostarp tiem, kas sevi uzskata par amatieriem.',
            ],
            [
                'q' => 'Vai ir kāda vecuma robeža, no kuras vai līdz kurai personai var tikt veikta dopinga kontrole?',
                'a' => 'Nē, šādi vecuma ierobežojumi nepastāv. Dopinga kontrolei var tikt pakļauts jebkurš sportists jebkurā vecumā, jo antidopinga noteikumi tāpat kā visi citi noteikumi sportā ir jāievēro visiem vienādi. Nepilngadīgiem sportistiem uz dopinga kontroli līdzi jāpieaicina pilngadīgs sportista pārstāvis.',
            ],
            [
                'q' => 'Kurš man var veikt dopinga kontroli?',
                'a' => 'Dopinga kontroli var veikt virkne organizāciju, tostarp, nacionālā antidopinga organizācija (Latvijā – VSMC Antidopinga nodaļa), sporta veida starptautiskā federācija vai šo organizāciju uzdevumā kāda no privātajām dopinga kontroles organizācijām (piemēram, IDTM (International Doping Tests and Management), PWC GmbH, Clearidium, SmartTest vai cita). Tiesības ievākt paraugu no sportista apliecina oficiāla dokumentācija, kam jābūt paraugu savākšanas personāla rīcībā.',
            ],
            [
                'q' => 'Vai atbildīgs par aizliegtas vielas saturoša medikamenta izrakstīšanu sportistam ir viņa ārsts?',
                'a' => 'Ārsta pienākums ir būt informētam par to, kādas vielas un metodes ir iekļautas aizliegto vielu un metožu sarakstā, kā arī ārstam (tāpat kā jebkurai citai personai sportista palīgpersonālā) var tikt piespriestas sankcijas par līdzdalību dopinga pārkāpumā. Vienlaikus atgādinām un īpaši uzsveram, ka katra sportista personīgais pienākums ir nodrošināt, lai viņa organismā nenokļūtu aizliegta viela.',
            ],
            [
                'q' => 'Ko darīt, ja man ir nepieciešams lietot aizliegto vielu vai metodi ārstēšanās nolūkos?',
                'a' => 'Ārstēšanās nolūkos sportistam ir pieļaujams lietot medikamentus, kas satur dopinga vielas, iepriekš saņemot Terapeitiskās lietošanas atļauju. Plašāka informācija par to, kādi ir kritēriji terapeitiskās lietošanas atļaujas piešķiršanai un kā tai pieteikties, pieejama Antidopinga nodaļas mājas lapā (saite uz: https://antidopings.gov.lv ).',
            ],
        ]
    @endphp

    <div id="accordion-open" data-accordion="open">
        @foreach ($arr as $item)
            <h2 id="accordion-open-heading-{{ $loop->index }}">
                <button 
                    type="button"
                    class="flex items-center justify-between w-full p-5 font-medium text-left text-gray-500 border border-b-0 border-gray-200 focus:ring-4 focus:ring-gray-200 " 
                    data-accordion-target="#accordion-open-body-{{ $loop->index }}" 
                    aria-expanded="false" 
                    aria-controls="accordion-open-body-{{ $loop->index }}"
                >

                    <span class="flex items-center">
                        <svg class="w-5 h-5 mr-2 shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path></svg>
                        {{ $item['q'] }}
                    </span>

                    <svg data-accordion-icon class="w-6 h-6 shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </button>
            </h2>

            <div 
                id="accordion-open-body-{{ $loop->index }}" 
                class="hidden" 
                aria-labelledby="accordion-open-heading-{{ $loop->index }}"
            >
                <div class="p-5 border border-b-0 border-gray-200">
                    <p class="mb-2">
                        {{ $item['a'] }}
                    </p>
                </div>
            </div>
        @endforeach
    </div>

@endsection