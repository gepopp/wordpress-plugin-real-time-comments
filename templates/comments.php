<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
<script>
    var comments = <?php echo json_encode(get_comments(['post_id' => get_the_ID()])) ?>;
</script>
<div id="real-time-comments-container" class="w-full" x-data="realTimeComment(comments)">
    <div class="flex flex-col">
        <div class="w-full h-64 flex justify-center items-center bg-white">
            <template x-for="comment in comments" x-key="comment.id">
                <li></li>
            </template>
        </div>
        <hr class="py-3 my-3">
        <div>
            <form class="w-full" @submit.prevent="saveComment">
                <div class="flex space-x-3">
                    <?php #TODO add conditional styling option - use theme styles : dequeues plugin css ?>
                    <input
                            type="text"
                            class="block bg-white p-3 flex-1"
                            placeholder="<?php _e('Write your comment', RTC_TEXTDOMAIN) ?>"
                            x-model="newComment"

                    >
                    <button type="submit"
                            class="bg-gray-800 text-white text-center px-5"
                            :disabled="newComment == ''"
                            :class="{ 'cursor-not-allowed' : newComment == '' }"
                    ><?php _e('submit', RTC_TEXTDOMAIN) ?></button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.socket.io/4.3.2/socket.io.min.js" integrity="sha384-KAZ4DtjNhLChOB/hxXuKqhMLYvx3b5MlT55xPEiNmREKRzeEm+RVPlTnAn0ajQNs" crossorigin="anonymous"></script>
<script>
    var socket = io("https://dev.immobilien-redaktion.com:3000");
</script>


<?php
$host = 'ir.test';
$ports = array(21, 25, 80, 81, 110, 443, 3000);

foreach ($ports as $port)
{
	$connection = @fsockopen($host, $port);

	if (is_resource($connection))
	{
		echo '<h2>' . $host . ':' . $port . ' ' . '(' . getservbyport($port, 'tcp') . ') is open.</h2>' . "\n";

		fclose($connection);
	}

	else
	{
		echo '<h2>' . $host . ':' . $port . ' is not responding.</h2>' . "\n";
	}
}