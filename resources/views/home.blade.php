@extends('layouts.main')


@section('content')

    <div class="row">
        <div class="col-12">
            <div class="text-center">Create your first shortlink!</div>
        </div>
        <div class="col-12">
            <form>
                @csrf
                <div class="col-12">
                    <input class="form-control" name="link" type="text" placeholder="Link...">
                    <input class="form-control" name="lifetime" min="1" max="24" type="number" placeholder="Lifetime (hours)">
                    <input class="form-control" name="followings" min="0" type="number" placeholder="Following limit (0 is unlimit)">
                    <div class="btn btn-dark send-form">Get Short link</div>
                </div>
            </form>
        </div>
    </div>

@endsection
