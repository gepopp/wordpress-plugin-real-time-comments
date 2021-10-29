<div id="real-time-comments-container" class="w-full">
    <div class="flex flex-col">
        <h1 class="text-2xl font-semibold mb-3"><?php _e('Write a comment', 'real-time-comments') ?></h1>
        <div>
            <comments-form :post_id="<?php echo get_the_ID() ?>" :user_id="<?php echo (int) get_current_user_id() ?>"></comments-form>
        </div>
        <hr class="py-3 my-3">
        <div class="w-full bg-white overflow-y-scroll overflow-x-hidden scrollbar scrollbar-thumb-gray-900 scrollbar-track-gray-100">
           <comments :post_id="<?php echo get_the_ID() ?>" :count="<?php echo get_comments_number( ) ?>" :user_id="<?php echo (int) get_current_user_id() ?>"></comments>
        </div>
    </div>
</div>
