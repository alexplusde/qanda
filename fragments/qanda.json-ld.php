<script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "Question",
    "name": "<?= htmlentities($this->question->getQuestion(), ENT_QUOTES, 'UTF-8'); ?>",
    "text": "<?= htmlentities($this->question->getQuestion(), ENT_QUOTES, 'UTF-8'); ?>",
    "answerCount": 1,
    "dateCreated": "<?= htmlentities($this->question->getValue('createdate'), ENT_QUOTES, 'UTF-8'); ?>",
    "author": {
      "@type": "Person",
      "name": "<?= htmlentities($this->question->getAuthor(), ENT_QUOTES, 'UTF-8'); ?>"
    },
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "<?= htmlentities($this->question->getAnswerAsPlaintext(), ENT_QUOTES, 'UTF-8'); ?>",
      "upvoteCount": 0,
      "url": "<?= htmlentities($this->question->getUrl(), ENT_QUOTES, 'UTF-8'); ?>",
      "dateCreated": "<?= htmlentities($this->question->getValue('updatedate'), ENT_QUOTES, 'UTF-8'); ?>",
      "author": {
        "@type": "Person",
        "name": "<?= htmlentities($this->question->getAuthor(), ENT_QUOTES, 'UTF-8'); ?>"
      }
    }
  }
</script>
