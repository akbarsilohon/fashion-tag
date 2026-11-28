<?php
if (post_password_required()) {
    return;
}
?>

<div id="comments" class="fash_comments">
    <?php if (have_comments()) : ?>
        <h3 class="fash_comments-title">
            <?php
            $count = get_comments_number();
            echo $count . ' ' . ($count > 1 ? 'Comments' : 'Comment');
            ?>
        </h3>

        <ol class="fash_comment-list">
            <?php
            wp_list_comments(array(
                'style'      => 'ol',
                'short_ping' => true,
                'avatar_size'=> 48,
                'callback'   => function($comment, $args, $depth){
                    ?>
                    <li <?php comment_class('fash_comment-item'); ?> id="comment-<?php comment_ID(); ?>">
                        
                        <div class="fash_comment-body">
                            
                            <div class="fash_comment-avatar">
                                <?php echo get_avatar($comment, 48); ?>
                            </div>

                            <div class="fash_comment-content">

                                <div class="fash_comment-meta">
                                    <span class="fash_comment-author">
                                        <?php echo get_comment_author_link(); ?>
                                    </span>

                                    <span class="fash_comment-date">
                                        <?php echo get_comment_date(); ?>
                                    </span>
                                </div>

                                <div class="fash_comment-text">
                                    <?php comment_text(); ?>
                                </div>

                                <div class="fash_comment-reply">
                                    <?php
                                    comment_reply_link(array_merge($args, array(
                                        'depth'     => $depth,
                                        'max_depth' => $args['max_depth'],
                                        'reply_text'=> 'Reply'
                                    )));
                                    ?>
                                </div>

                            </div>

                        </div>

                    <?php
                }
            ));
            ?>
        </ol>
        <?php the_comments_pagination(); ?>
    <?php endif; ?>

    <?php
    comment_form(array(
        'class_form'         => 'fash_comment-form',
        'class_submit'       => 'fash_comment-submit',
        'title_reply'        => 'Leave a Comment',
        'label_submit'       => 'Post Comment',

        'comment_field'      => '
            <p class="fash_comment-field">
                <textarea name="comment" placeholder="Write your comment..." required></textarea>
            </p>
        ',

        'fields' => array(
            'author' => '
                <p class="fash_comment-field">
                    <input type="text" name="author" placeholder="Name" required>
                </p>
            ',
            'email' => '
                <p class="fash_comment-field">
                    <input type="email" name="email" placeholder="Email" required>
                </p>
            ',
        ),
    ));
    ?>
</div>