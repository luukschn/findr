@extends('layouts.app')

@section('title', 'Upload a scale')

@section('content')
    {{-- 
    Make this an admin only section (@admin) 
    - add admin input to db
    - save all qs to db (?)
    -- ensure this is all properly parsed when I send it via API as well. So i can run a DB seeder easily
    --}}

    <?php
        $user = User::where('id', Auth::id());
        if ($user['is_admin'] == 1) {

        } else {
            //redirect to main page
        }
    ?>


@endsection()