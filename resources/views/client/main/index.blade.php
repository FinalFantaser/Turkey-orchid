@extends('client.layout.app')

@section('title', 'АГЕНТСТВО НЕДВИЖИМОСТИ FENIX YATIRIM')

@section('content')

    @include('client.main.section_main')
    @include('client.main.section_advantages')
    @include('client.main.section_we')
    @include('client.main.catalog.index')
    @include('client.main.section_send')
    @include('client.main.section_faq')

@endsection