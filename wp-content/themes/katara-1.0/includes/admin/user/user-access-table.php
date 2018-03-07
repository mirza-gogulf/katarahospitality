<?php
    $access_1 = get_the_author_meta( 'access_1', $user->ID );
    $access_2 = get_the_author_meta( 'access_2', $user->ID );
    $access_3 = get_the_author_meta( 'access_3', $user->ID );

    $data = compact( 'access_1', 'access_2', 'access_3' );
?>
<h3>User Access Areas</h3>
<table class="form-table">
    <tr>
        <th scope="row">Access Areas</th>
        <td>
            <label for="access_1">
                <input type="checkbox" value="<?php echo esc_attr( $access_1 ); ?>" <?php if ( $access_1 ) echo 'checked="checked"'; ?> id="access_1" name="access_1"> Press Office
            </label><br />
            <label for="access_2">
                <input type="checkbox" value="<?php echo esc_attr( $access_2 ); ?>" <?php if ( $access_2 ) echo 'checked="checked"'; ?> id="access_2" name="access_2"> Careers
            </label><br />
            <label for="access_3">
                <input type="checkbox" value="<?php echo esc_attr( $access_3 ); ?>" <?php if ( $access_3 ) echo 'checked="checked"'; ?> id="access_3" name="access_3"> Tenders
            </label>
        </td>
    </tr>
</table>