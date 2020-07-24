<script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "QAPage",
    "mainEntity": {
      "@type": "Question",
      "name": "<?= $this->question->getQuestion(); ?>",
      "answerCount": 1,
      "author": {
        "@type": "Person",
        "name": "<?= $this->question->getAuthor(); ?>"
      },
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "<?= $this->question->getAnswerAsPlaintext(); ?>",
        "author": {
          "@type": "Person",
          "name": "<?= $this->question->getAuthor(); ?>"
        }
      }
    }
  }
</script>
