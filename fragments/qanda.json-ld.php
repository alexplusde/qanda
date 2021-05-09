<script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "Question",
    "name": "<?= $this->question->getQuestion(); ?>",
    "text": "<?= $this->question->getQuestion(); ?>",
    "answerCount": 1,
    "dateCreated": "<?= $this->question->getValue('createdate') ?>",
    "author": {
      "@type": "Person",
      "name": "<?= $this->question->getAuthor(); ?>"
    },
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "<?= $this->question->getAnswerAsPlaintext(); ?>",
      "upvoteCount": 0,
      "url": "<?= $this->question->getUrl() ?>",
      "dateCreated": "<?= $this->question->getValue('updatedate') ?>",
      "author": {
        "@type": "Person",
        "name": "<?= $this->question->getAuthor(); ?>"
      }
    }
  }
</script>