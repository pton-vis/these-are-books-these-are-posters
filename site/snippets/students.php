<ul class="student__list">
  <?php foreach($studentList as $student): ?>
    <?php $image = $student->hero_image()->toFile(); ?>
    <li class="student__list__item">
      <a href="<?= $student->url(); ?>" data-dominant-color="<?= getAverage($image->resize(10)->url())?>">
        <img
          class="student__list__item__image"
          src="<?= $image->resize(2000)->url() ?>"
          srcset="<?= $image->srcset([300, 800, 1024]) ?>" />
      </a>
    </li>
  <?php endforeach; ?>
</ul>