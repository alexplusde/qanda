<?php
?>
<script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "QAPage",
    "mainEntity": {
      "@type": "Question",
      "name": "<?= $this->getQuestion(); ?>",
      "answerCount": 1,
      "author": {
        "@type": "Person",
        "name": "REDAXO"
      },
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "<?= $this->getAnswerAsPlaintext(); ?>",
        "author": {
          "@type": "Person",
          "name": "REDAXO"
        }
      }
    }
  }
</script>