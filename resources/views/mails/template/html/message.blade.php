@props(['currentSubdomain'])

<x-mail::layout>
{{-- Header --}}
<x-slot:header>
<x-mail::header :url="''">
  <img src="{{ url("storage/email-images/" . lcfirst($currentSubdomain) . "/email-logo.png") }}" style="left: -20px; max-width: 250px; max-height: 250px;">
</x-mail::header>
</x-slot:header>

{{-- Body --}}
{{ $slot }}

{{-- Subcopy --}}
@isset($subcopy)
<x-slot:subcopy>
<x-mail::subcopy>
{{ $subcopy }}
</x-mail::subcopy>
</x-slot:subcopy>
@endisset

{{-- Footer --}}
<x-slot:footer>
<x-mail::footer>
© {{ date('Y') }} {{ config('app.name') }}. @lang('Todos os direitos reservados.')
</x-mail::footer>
</x-slot:footer>
</x-mail::layout>
