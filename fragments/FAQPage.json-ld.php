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
      "name": <?= json_encode($question->getQuestion(), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK) ?> ,
      "text": <?= json_encode($question->getValue('answer'), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK) ?> ,
      "answerCount": 1,
      "dateCreated": "<?= htmlentities($question->getValue('createdate'), ENT_QUOTES, 'UTF-8') ?>",
      "author": {
        "@type": "Person",
        "name": <?= json_encode($question->getAuthor(), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK) ?>
      },
      "acceptedAnswer": {
        "@type": "Answer",
        "text": <?= json_encode($question->getQuestion(), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK) ?> ,
        "upvoteCount": 0,
        "url": "<?= htmlentities($question->getUrl(), ENT_QUOTES, 'UTF-8') ?>",
        "dateCreated": "<?= htmlentities($question->getValue('updatedate'), ENT_QUOTES, 'UTF-8') ?>",
        "author": {
          "@type": "Person",
          "name": <?= json_encode($question->getAuthor(), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK) ?>
        }
      }
    }
      <?php
      }
      ?>
    ]
  }
</script>
