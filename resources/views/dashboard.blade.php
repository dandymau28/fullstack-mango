@extends('templates.app')

@push('styles')

<style>
    .log-information {
        background-color: white;
        border: solid 1pt black;
        color: black;
        margin-left: -7em;
        height: 80vh;
    }

    .api-list {
        margin-right: -7em !important;
        margin: 1em 0px;
    }

    .api-table-capsule {
        height: 72vh;
        border: solid 1pt black;
    }
</style>

@endpush

@section('content')
    <div class="container">
        <div class="row">
            <div class="col log-information">
                <div class="text-center" style="margin-top: 35vh;">
                    <ul style="list-style-type: none;">
                        <li>IP ADD : {{ $_SERVER['REMOTE_ADDR'] }}</li>
                        <li>UNAME : USERNAME</li>
                        <li>ROLE: ROLE</li>
                    </ul>
                </div>
            </div>

            <div class="col api-list">
                <div class="container api-table-capsule">
                    <div class="header">
                        <strong>API LIST DOCUMENTATION</strong>
                    </div>
                    <div class=""></div>
                </div>
            </div>
        </div>
    </div>
@endsection