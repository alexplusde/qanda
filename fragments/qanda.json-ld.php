<script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "Question",
    "name": <?= json_encode($this->question->getQuestion(),  JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK); ?>,
    "text": <?= json_encode($this->question->getQuestion(),  JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK); ?>,
    "answerCount": 1,
    "dateCreated": "<?= $this->question->getValue('createdate') ?>",
    "author": {
      "@type": "Person",
      "name": <?= json_encode($this->question->getAuthor(),  JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK); ?>
    },
    "acceptedAnswer": {
      "@type": "Answer",
      "text": <?= json_encode($this->getValue('answer'),  JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK); ?>,
      "upvoteCount": 0,
      "url": "<?= $this->question->getUrl() ?>",
      "dateCreated": "<?= $this->question->getValue('updatedate') ?>",
      "author": {
        "@type": "Person",
        "name": <?= json_encode($this->question->getAuthor(),  JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK); ?>
      }
    }
  }
</script>
