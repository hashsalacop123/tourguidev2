<?php
$star = get_template_directory_uri().'/img/star-2.png';


if ( post_password_required() ) {
    return;
}

if ( have_comments() ) :
    $average_rating = 0;
    $total_ratings = 0;
    $user_ratings = array();

    // Calculate the average rating and collect user ratings
    foreach ( $comments as $comment ) {
        $rating = get_comment_meta( $comment->comment_ID, 'rating', true );
        $user_id = $comment->user_id;
        if ( $rating ) {
            $average_rating += intval( $rating );
            $total_ratings++;

            if ( ! isset( $user_ratings[ $user_id ] ) ) {
                $user_ratings[ $user_id ] = intval( $rating );
            } else {
                $user_ratings[ $user_id ] += intval( $rating );
            }
        }
    }

    if ( $total_ratings > 0 ) {
        $average_rating = round( $average_rating / $total_ratings, 1 );
    }
    ?>
    <div id="comments" class="comments-area">
        <div class="rating">
            <span class="average-rating"><?php  echo esc_html( $average_rating ); ?></span>
            <span class="out-of"><?php esc_html_e( 'out of 5 stars', 'wonderer' ); ?></span>
             <ul class = "stars-display">
                <li><?php echo  '<img src = "'.$star.'" alt = "star"/>'; ?></li>
                  <li><?php echo  '<img src = "'.$star.'" alt = "star"/>'; ?></li>
                  <li><?php echo  '<img src = "'.$star.'" alt = "star"/>'; ?></li>
                <li><?php echo  '<img src = "'.$star.'" alt = "star"/>'; ?></li>
                  <li><?php echo  '<img src = "'.$star.'" alt = "star"/>'; ?></li>
             </ul>
        </div>
        <ul class="comment-list">
            <?php
            wp_list_comments( array(
                'style'       => 'ul',
                'short_ping'  => true,
                'avatar_size' => 42,
                'callback'    => 'custom_comment_callback',
                'reverse_top_level' => true,
            ) );
            ?>
        </ul>

        <?php
        the_comments_pagination( array(
            'prev_text' => '&larr; ' . esc_html__( 'Previous', 'wonderer' ),
            'next_text' => esc_html__( 'Next', 'wonderer' ) . ' &rarr;',
        ) );
        ?>

    </div><!-- #comments -->
    <?php
endif;

if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
    ?>
    <p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'your-theme-textdomain' ); ?></p>
    <?php
endif;



comment_form();

/**
 * Custom comment callback function.
 *
 * @param object $comment Comment object.
 * @param array  $args    Comment arguments.
 * @param int    $depth   Comment depth.
 */
function custom_comment_callback( $comment, $args, $depth ) {
    $rating = get_comment_meta( $comment->comment_ID, 'rating', true );
    $user_rating = get_comment_meta( $comment->comment_ID, 'user_rating', true );
    ?>
    <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
        <div class="comment-body">
            <div class="comment-metadata">
                <?php if ( $user_rating ) : ?>
                    <span class="comment-rating">
                        <?php for ( $i = 1; $i <= 5; $i++ ) : ?>
                            <span class="star<?php echo ( $i <= $user_rating ) ? ' filled' : ''; ?>"></span>
                        <?php endfor; ?>
                    </span>
                    <span class="comment-rating-count"><?php echo $user_rating; ?></span>
                <?php endif; ?>
                <span class="comment-author"><?php comment_author(); ?></span>
                <?php if ( $user_rating ) : ?>
                    <span class="comment-rating-separator">|</span>
                <?php endif; ?>
                <span class="comment-date"><?php comment_date(); ?></span>
            </div>
            <?php if ( $rating ) : ?>
                <div class="comment-rating">
                    <?php for ( $i = 1; $i <= 5; $i++ ) : ?>
                        <span class="star<?php echo ( $i <= $rating ) ? ' filled' : ''; ?>"></span>
                    <?php endfor; ?>
                </div>
            <?php endif; ?>
            <div class="comment-content">
                <?php comment_text(); ?>
            </div>
        </div>
    </li>
    <?php
}
