@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Cóexitocontigo')
<img src="{{ asset('assets/coexito-logo.png') }}" class="logo" alt="Cóexito">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
