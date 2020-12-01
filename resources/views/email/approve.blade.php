@component('mail::message')
# Bzz... iš mobiliųjų tinklų avilio!

Jūsų užsakymas yra sėkmingai patvirtintas!

{{--@component('mail::button', ['url' => ''])--}}
{{--Button Text--}}
{{--@endcomponent--}}

Skleidžiame ryšį,<br>
{{ config('app.name') }}
@endcomponent
