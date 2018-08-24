<strong>{{ $barbershop->name }}</strong>

<p>
    <a href="{{ $barbershop->url }}" target="_blank" title="Opens in a new window">{{ $barbershop->url }}</a>
</p>

@if ($barbershop->phone)
    <p>{{ $barbershop->phone }}</p>
@endif

<p>{{ $barbershop->address }}</p>
