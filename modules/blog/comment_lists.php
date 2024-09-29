<?php
$commentLists = getRaw("SELECT comment.*, users.fullname, users.email as user_email, groups.name as group_name
                        FROM comment LEFT JOIN users on comment.user_id = users.id
                                     LEFT JOIN groups on users.group_id = groups.id
                        WHERE blog_id = $id AND comment.status = 1 
                        ORDER BY comment.create_at");
/* echo '<pre>';
print_r($commentLists);
echo '</pre>'; */
$commentData = [];
?>
<div class="blog-comments">
    <h2 class="title"><?php echo count($commentLists) ?> Bình luận</h2>
    <div class="comments-body">
        <?php
        if (!empty($commentLists)) :
            foreach ($commentLists as $key=>$item) :
                /* if (!empty($item['user_id'])) {
                    $item['name'] = $item['fullname'];
                    $item['email'] = $item['user_email'];
                    $commentLists[$key] = $item;
                } */
                $commentData[$item['id']] = $item;

                if ($item['parent_id'] == 0):  
                ?>
                    <!-- Single Comments -->
                    <div class="single-comments">
                        <div class="main">
                            <div class="head">
                                <img src="<?php echo getAvatar($item['email']) ?>" alt="#">
                            </div>
                            <div class="body">
                                <h4><?php echo $item['name']; echo !empty($item['user_id']) ? ' <span class="badge badge-info">'.$item['group_name'].'</span>' : null ?></h4>
                                <div class="comment-info">
                                    <p><span><?php echo getDateFormat($item['create_at'], 'd/m/Y') ?><i class="fa fa-clock-o"></i><?php echo getDateFormat($item['create_at'], 'H:i') ?></span><a href="<?php echo _WEB_HOST_ROOT . '/?module=blog&action=detail&id=' . $id . '&comment_id=' . $item['id'] . '#comment-form' ?>"><i class="fa fa-comment-o"></i>Trả lời</a></p>
                                </div>
                                <?php echo html_entity_decode($item['content']) ?>
                            </div>
                        </div>
                        <?php getCommentList($commentLists, $item['id'], $id); ?>   <!-- load ra các bình luận trả lời -->
                    </div>
                    <!--/ End Single Comments -->
            <?php endif;
            endforeach;
        else : ?>
            <div class="alert alert-success text-center">Không có bình luận. Hãy là người đầu tiên viết bình luận </div>
        <?php endif; ?>
    </div>
</div>