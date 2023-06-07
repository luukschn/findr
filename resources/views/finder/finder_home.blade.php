@extends('layouts.app')

@section('title', 'Finder')

@section('content')
<div id="finder-home-parent">
    <div class='child inline-block-child'>
        <h3>Placeholder explanatory content</h3>
    </div>
    <div class='child inline-block-child'>
        <table class="table" id="test-listings">

            <?php
                foreach ($data['scale_info'] as $scale_details){
                    echo "<tr>";
                    echo "<td>";
                    echo "<a href='/scale/" . $scale_details['scale_id'] . "'>" . $scale_details['scale_name_official'] . " - " . $scale_details['scale_progress'] . "</a>";
                    echo "</td>";
                    echo "</tr>";
                }
            ?>

        </table>
    </div>

    <?php
        if ((int)$data['is_admin'] == 1) {
            echo "<div id='admin-add-scale'>";
            echo "<h3>Admin panel</h3>";
            echo "<a class='button-primary' href='/upload/scale/'>Upload scale</a>";
            echo "</div>";
        }
    ?>
</div>
@endsection