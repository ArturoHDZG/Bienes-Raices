<?php

// Imports
require_once 'includes/app.php';

// View Template
includeTemplate('header');

?>

    <main class="container section">

      <h2>Anuncios</h2>

      <?php

        $limit = 10;
        include_once 'includes/templates/ads.php';

      ?>

    </main>

<?php

// View Template
includeTemplate('footer');

?>
