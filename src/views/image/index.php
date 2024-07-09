<?php

/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Главная страница';
?>

<div class="site-index">
    <div class="jumbotron">
        <?php if ($imageId !== null): ?>
            <img src="https://picsum.photos/id/<?= $imageId ?>/600/500" alt="Random Image">
            <div>
                <?= Html::button('Одобрить', ['class' => 'btn btn-success', 'onclick' => 'sendDecision(' . $imageId . ', "approve")']) ?>
                <?= Html::button('Отклонить', ['class' => 'btn btn-danger', 'onclick' => 'sendDecision(' . $imageId . ', "reject")']) ?>
            </div>
        <?php else: ?>
            <p>Все изображения были обработаны.</p>
        <?php endif; ?>
    </div>
</div>

<script>
    function sendDecision(imageId, decision) {
        fetch('<?= Url::to(['image/decision']) ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-Token': '<?= Yii::$app->request->csrfToken ?>'
            },
            body: JSON.stringify({image_id: imageId, decision: decision})
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    if (data.nextImageId !== null) {
                        location.href = '?imageId=' + data.nextImageId;
                    } else {
                        alert('Все изображения были обработаны.');
                        location.reload();
                    }
                } else {
                    alert('Ошибка при сохранении решения.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }
</script>
