<div id="real-time-comments-container" class="w-full">
    <div class="flex flex-col">
        <div class="w-full h-64 flex justify-center items-center bg-white">
            <p>Template to display exisitng comments here</p>
        </div>
        <hr class="py-3 my-3">
        <div>
            <form class="w-full">
                <div class="flex space-x-3">
                    <?php #TODO add conditional styling option - use theme styles : dequeues plugin css ?>
                    <input type="text" class="block bg-white p-3 flex-1" placeholder="<?php _e('Write your comment', RTC_TEXTDOMAIN) ?>">
                    <button type="submit"
                            class="bg-gray-800 text-white text-center px-5"
                    ><?php _e('submit', RTC_TEXTDOMAIN) ?></button>
                </div>
            </form>
        </div>
    </div>
</div>
