<div class="qanda container">
	<?php
foreach (qanda::getAll() as $question) {
    ?>

	<details class="card">
		<summary class="qanda-question card-body card-title h4">
			<?= $question->getQuestion() ?>
		</summary>
		<div class="qanda-answer card-body">
			<?= $question->getAnswer() ?>
		</div>
	</details>
	<?php
    echo $question->showJsonLd($question);
}
	?>
</div>