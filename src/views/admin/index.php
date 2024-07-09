<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Админская страница';
?>

<div class="admin-index">
    <table class="table">
        <thead>
        <tr>
            <th>ID изображения</th>
            <th>Решение</th>
            <th>Действия</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($images as $image): ?>
            <tr>
                <td>
                    <a href="https://picsum.photos/id/<?= $image->image_id ?>/600/500">
                        <?= $image->image_id ?>
                    </a>
                </td>
                <td><?= $image->decision ?></td>
                <td><?= Html::button('Отменить', ['class' => 'btn btn-warning', 'onclick' => "deleteImage({$image->image_id})"]) ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>
    function deleteImage(imageId) {
        fetch('<?= Url::to(['image/delete']) ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-Token': '<?= Yii::$app->request->csrfToken ?>'
            },
            body: JSON.stringify({image_id: imageId})
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }
</script>