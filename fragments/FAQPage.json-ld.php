<?php
$jsonOptions = JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK;
?>

<script type="application/ld+json">
	{
		"@context": "https://schema.org",
		"@type": "FAQPage",
		"mainEntity": [
			<?php
            $delimiter = '';
foreach ($this->getVar('questions') as $question) {
    echo $delimiter;
    $delimiter = ',';
    ?>
			{
				"@type": "Question",
				"name": <?= json_encode($question->getQuestion(), $jsonOptions) ?> ,
				"text": <?= json_encode($question->getValue('answer'), $jsonOptions) ?> ,
				"answerCount": 1,
				"dateCreated": "<?= qanda::htmlEncode($question->getValue('createdate')) ?>",
				"author": <?= json_encode(qanda::getJsonAuthor($question), $jsonOptions) ?> ,
				"acceptedAnswer": {
					"@type": "Answer",
					"text": <?= json_encode($question->getQuestion(), $jsonOptions) ?> ,
					"upvoteCount": 0,
					"url": "<?= qanda::htmlEncode($question->getUrl()) ?>",
					"dateCreated": "<?= qanda::htmlEncode($question->getValue('updatedate')) ?>",
					"author": <?= json_encode(qanda::getJsonAuthor($question), $jsonOptions) ?>
				}
			}
			<?php
}
?>
		]
	}
</script>
