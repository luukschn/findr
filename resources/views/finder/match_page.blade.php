@extends('layouts.app')

@section('title', 'Matches')

@section('content')
    <h3>Matches:</h3>

    <div id="matches">
        <table class='table'>
            <?php 
                foreach ($matched_users as $user) {
                    echo "<tr>";
                    echo "<p>Matched " . $user['person_name'] . " on " . $user['scale_name'] . "</p>";
                    echo "</tr>";
                }
            ?>
        </table>
    </div>

@endsection