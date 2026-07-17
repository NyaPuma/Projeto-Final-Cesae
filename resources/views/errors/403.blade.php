@extends('errors.minimal')

@section('code', '403')
@section('title', __('Acesso Proibido'))
@section('message', __('O seu utilizador não tem privilégios administrativos ou permissões suficientes na infraestrutura para aceder a esta área.'))
