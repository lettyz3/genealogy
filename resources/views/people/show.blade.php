@extends('layouts.app')

@section('content')
    <h1>{{ $person->first_name }} {{ $person->last_name }}</h1>
    <p>Date de naissance : {{ $person->date_of_birth ?? 'Non spécifiée' }}</p>
    <p>Créée par : {{ $person->createdBy->name }}</p>

    <h2>Enfants</h2>
    <ul>
        @foreach($person->children as $child)
            <li>{{ $child->first_name }} {{ $child->last_name }}</li>
        @endforeach
    </ul>

    <h2>Parents</h2>
    <ul>
        @foreach($person->parents as $parent)
            <li>{{ $parent->first_name }} {{ $parent->last_name }}</li>
        @endforeach
    </ul>
@endsection
