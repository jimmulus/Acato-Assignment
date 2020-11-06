@component('mail.message')
Hierbij dan eindelijk je langverwachte rapport!

@component('mail::panel')
<strong>Trend van broedvogels: trendbeoordeling van de {{$data['vogel']->Title}}</strong>

{{ $data['vogel']->Description }}

<strong>Trendklasse 1990 tot heden</strong>: {{$data['item']['Trendklasse1990TotHeden_1']}}

<strong>Trendklasse laatste 10 jaar</strong>: {{$data['item']['TrendklasseLaatste12Jaar_2']}}
@endcomponent

Zelf rapporten sturen? Klik op onderstaande knop om naar de site te gaan!
@component('mail::button', ['url' => config("app.url")])
Naar de site
@endcomponent
Groeten,
{{ $data['user'] }}
@endcomponent
