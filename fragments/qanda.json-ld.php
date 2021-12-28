<script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "Question",

    "name": <?= json_encode($this->question->getQuestion(),  JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK); ?>,
    "text": <?= json_encode($this->question->getQuestion(),  JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK); ?>,

    "answerCount": 1,
    "dateCreated": "<?= htmlentities($this->question->getValue('createdate'), ENT_QUOTES, 'UTF-8'); ?>",
    "author": {
      "@type": "Person",

      "name": <?= json_encode($this->question->getAuthor(),  JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK); ?>
    },
    "acceptedAnswer": {
      "@type": "Answer",
      "text": <?= json_encode($this->getValue('answer'),  JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK); ?>,

      "upvoteCount": 0,
      "url": "<?= htmlentities($this->question->getUrl(), ENT_QUOTES, 'UTF-8'); ?>",
      "dateCreated": "<?= htmlentities($this->question->getValue('updatedate'), ENT_QUOTES, 'UTF-8'); ?>",
      "author": {
        "@type": "Person",
        "name": <?= json_encode($this->question->getAuthor(),  JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK); ?>

      }
    }
  }
</script>
