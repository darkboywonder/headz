<h2>{{ $barbershop->name }}</h2>

<p>
    <a href="{{ $barbershop->url }}" target="_blank" title="Opens in a new window">{{ $barbershop->url }}</a>
</p>

@if ($barbershop->phone)
    <p>{{ $barbershop->phone }}</p>
@endif

<p>
    {{ $barbershop->address }} <br>
    {{ $barbershop->city }}, {{$barbershop->state}}
</p>

<p>
    <strong>Hours</strong> <br>
    {{ $barbershop->hours }}
</p>
