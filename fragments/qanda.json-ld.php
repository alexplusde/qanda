<?php
$jsonOptions = JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK;

?>

<script type="application/ld+json">
	{
		"@context": "https://schema.org",
		"@type": "Question",
		"name": <?= json_encode($this->question->getQuestion(), $jsonOptions) ?> ,
		"text": <?= json_encode($this->question->getQuestion(), $jsonOptions) ?> ,
		"answerCount": 1,
		"dateCreated": "<?= qanda::htmlEncode($this->question->getValue('createdate')) ?>",
		"author": <?= json_encode(qanda::getJsonAuthor($this->question), $jsonOptions) ?> ,
		"acceptedAnswer": {
			"@type": "Answer",
			"text": <?= json_encode($this->question->getValue('answer'), $jsonOptions) ?> ,
			"upvoteCount": 0,
			"url": "<?= qanda::htmlEncode($this->question->getUrl()) ?>",
			"dateCreated": "<?= qanda::htmlEncode($this->question->getValue('updatedate')) ?>",
			"author": <?= json_encode(qanda::getJsonAuthor($this->question), $jsonOptions) ?>
		}
	}
</script>
