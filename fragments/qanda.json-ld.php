<?php
$jsonOptions = JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK;

function htmlEncode($value)
{
    return htmlentities($value, ENT_QUOTES, 'UTF-8');
}

function getAuthor($question)
{
    return [
        '@type' => 'Person',
        'name' => json_encode($question->getAuthor(), $GLOBALS['jsonOptions']),
    ];
}

?>

<script type="application/ld+json">
	{
		"@context": "https://schema.org",
		"@type": "Question",
		"name": <?= json_encode($this->question->getQuestion(), $jsonOptions) ?> ,
		"text": <?= json_encode($this->question->getQuestion(), $jsonOptions) ?> ,
		"answerCount": 1,
		"dateCreated": "<?= htmlEncode($this->question->getValue('createdate')) ?>",
		"author": <?= json_encode(getAuthor($this->question), $jsonOptions) ?> ,
		"acceptedAnswer": {
			"@type": "Answer",
			"text": <?= json_encode($this->question->getValue('answer'), $jsonOptions) ?> ,
			"upvoteCount": 0,
			"url": "<?= htmlEncode($this->question->getUrl()) ?>",
			"dateCreated": "<?= htmlEncode($this->question->getValue('updatedate')) ?>",
			"author": <?= json_encode(getAuthor($this->question), $jsonOptions) ?>
		}
	}
</script>
