<div id="real-time-comments-container" class="w-full">
    <div class="flex flex-col">
        <div class="w-full h-64 flex justify-center items-center bg-white">
           <comments></comments>
        </div>
        <hr class="py-3 my-3">
        <div>
            <comments-form :post_id="<?php echo get_the_ID() ?>" :user_id="<?php echo (int) get_current_user_id() ?>"></comments-form>
        </div>
    </div>
</div>