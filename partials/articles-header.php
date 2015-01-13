<div class="filters-header container">
  <div class="row">
    <div class="col-sm-4">
      <ul class="filters-primary">
        <li id="filter-articles" class="filter-articles">
          <a href="/artiklar">Artiklar</a>
        </li>
        <li id="filter-themes" class="filter-themes">
          <a href="/tema">Teman</a>
        </li>
      </ul>
    </div>
    <?php  if ( !is_post_type_archive('tema') ) : ?>
    <div class="col-sm-8">
      <ul class="filters-secondary">
        <li>
          <a class="latest-articles" href="/artiklar">Senaste</a>
        </li>
        <li>
          <a class="most-read-articles" href="/mest-lasta-artiklar">Mest Lästa</a>
        </li>
        <li>
          <a class="most-discussed-articles" href="/mest-kommenterade-artiklar">Diskuterat</a>
        </li>
      </ul>
    </div>
  <?php endif; ?>
  </div>
</div>