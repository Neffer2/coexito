@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Coéxitocontigo')
<img src="{{ asset('assets/coexito-logo.png') }}" class="logo" alt="Coéxito">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
