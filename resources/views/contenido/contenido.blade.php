@extends('principal')
@section('contenido')
    <template v-if="menu==1">
        <autor></autor>
    </template>
    <template v-if="menu==2">
        <categoria></categoria>
    </template>

    <template v-if="menu==3">
        <editorial></editorial>
    </template>
    <template v-if="menu==4">
        <idioma></idioma>
    </template>
    <template v-if="menu==5">
        <pais></pais>
    </template>
    <template v-if="menu==6">
        <libros></libros>
    </template>
@endsection
