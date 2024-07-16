@extends('layout.template')
@section('title')
    Dashboard
@endsection

@section('content')
    <div class="m-4 p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">
        <div class="grid grid-cols-2 gap-5">
            <div class="mx-10 my-5">
                {!! $chartDonut->container() !!}
            </div>
            <div class="mx-10 my-5">
                {!! $chartBar->container() !!}
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
    {!! $chartBar->script() !!}
    {!! $chartDonut->script() !!}
@endsection
