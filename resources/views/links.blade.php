@extends('layouts.main')


@section('content')

    <div class="row">
        <div class="col-12">
            <div class="text-center">All created links</div>

            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Link</th>
                    <th scope="col">Short Link</th>
                    <th scope="col">Max followings</th>
                    <th scope="col">Tools</th>
                </tr>
                </thead>
                <tbody>
                    @if($links->isEmpty())
                        <tr>
                            <td colspan="4" class="text-center">They are not links</td>
                        </tr>
                    @else
                        @foreach($links as $link)
                            <tr>
                                <td>{{ $link->link }}</td>
                                <td>{{ $link->short_link }}</td>
                                <td>{{ $link->followings }}</td>
                                <td><a href="links/{{ $link->id }}">Link Info</a> </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>

    </div>

@endsection
