@extends('layouts.main')


@section('content')

    <div class="row">
        <div class="col-12">
            <div class="text-center">Link Info</div>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Browser</th>
                    <th scope="col">Platform</th>
                    <th scope="col">IP</th>
                </tr>
                </thead>
                <tbody>
                @if($stats->isEmpty())
                    <tr>
                        <td colspan="4" class="text-center">They are not stats</td>
                    </tr>
                @else
                    @foreach($stats as $stat)
                        <tr>
                            <td>{{ $stat->browser }}</td>
                            <td>{{ $stat->platform }}</td>
                            <td>{{ $stat->ip }}</td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>

    </div>

@endsection
