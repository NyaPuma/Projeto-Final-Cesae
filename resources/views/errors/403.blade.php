@extends('errors.minimal')

@section('code', '403')
@section('title', __('common.Acesso Proibido'))
@section('message', __('equipment.O seu utilizador não tem privilégios administrativos ou permissões suficientes na infraestrutura para aceder a esta área.'))
