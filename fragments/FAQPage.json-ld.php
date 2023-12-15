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
				"dateCreated": "<?= htmlEncode($question->getValue('createdate')) ?>",
				"author": <?= json_encode(getAuthor($question), $jsonOptions) ?> ,
				"acceptedAnswer": {
					"@type": "Answer",
					"text": <?= json_encode($question->getQuestion(), $jsonOptions) ?> ,
					"upvoteCount": 0,
					"url": "<?= htmlEncode($question->getUrl()) ?>",
					"dateCreated": "<?= htmlEncode($question->getValue('updatedate')) ?>",
					"author": <?= json_encode(getAuthor($question), $jsonOptions) ?>
				}
			}
			<?php
}
?>
		]
	}
</script>
