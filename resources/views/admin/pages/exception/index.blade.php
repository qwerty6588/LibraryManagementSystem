@extends('layouts.admin')
@section('content')
<div>
    <div>Code:{{ $code }}</div>
    <div>Message: {{ $message }}</div>
    <div>File: {{ $file }}</div>
    <div>Line: {{ $line}}</div>
</div>
@endsection

