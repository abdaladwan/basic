<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
?>
<h1>Posts</h1>
<ul>
    <?php foreach ($posts as $post): ?>
        <li>
            <?= Html::encode("{$post->Content} ({$post->Title})") ?>:
            <?= $post->PostID ?>
        </li>
    <?php endforeach; ?>

</ul>

<?= LinkPager::widget(['pagination' => $pagination]) ?>



