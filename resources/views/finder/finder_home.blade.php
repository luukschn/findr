@extends('layouts.app')

@section('title', 'Finder')

@section('content')
<div id="finder-home-parent">
    <div class='child inline-block-child'>
        <h3>Placeholder explanatory content</h3>
    </div>
    <div class='child inline-block-child'>
        <table id="test-listings">

            <?php
                foreach ($data['scale_info'] as $scale_details){
                    echo "<tr>";
                    echo "<td>" . $scale_details['scale_name'] . " - " . "";
                    echo "<p>" . $scale_details['scale_name'] . " - " . $scale_details['scale_progress'] . "</p>";
                    // echo "<a href=" // TODO add linking to scale when clicking on it
                    echo "</td>";
                    echo "</tr>";
                }
            ?>

            {{-- <tr>
                <td>listing 1 example</td>
            </tr>
            <tr>
                <td>listing 2 example</td>
            </tr> --}}

        </table>
    </div>

    <?php
        if ((int)$data['is_admin'] == 1) {
            echo "<div id='admin-add-scale'>";
            echo "<h3>Admin panel</h3>";
            echo "<a class='btn btn-primary' href='/upload/scale/'>Upload scale</a>";
            echo "</div>";
        }
    ?>
</div>
@endsection