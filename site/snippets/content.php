<ul class="content__blocks">
  <?php foreach($contentBlocks as $content): ?>
    <li class="content__block content__block--<?=$content->type(); ?>">
      <?php 
        switch($content->type()): 
        case 'gallery':
      ?>
        <div class="gallery">
          <div class="gallery__images">
            <?php foreach($content->images()->toFiles() as $image): ?>
              <img
                loading="lazy"
                class="gallery__image"
                width="<?= $image->width(); ?>"
                height="<?= $image->height(); ?>"
                src="<?= $image->resize(2000)->url() ?>"
                srcset="<?= $image->srcset([300, 800, 1024]) ?>" />
            <?php endforeach; ?>
          </div>
          <div class="gallery__controller">
            <?php $count = $content->images()->toFiles()->count(); ?>
            <?php if($count > 1): ?>
              <div class="gallery__controller__controls">
                <span class="gallery__controller__left">&larr;</span>
                <span class="gallery__controller__right">&rarr;</span>
              </div>
              <div class="gallery__controller__counter">
                <span class="gallery__controller__current-idx">1</span> / <?= $count; ?>
              </div>
            <?php endif; ?>
          </div>
        </div>
      <?php break; ?>
      <?php case 'text': ?>
        <div class="text">
          <?= $content->text(); ?>
        </div>
      <?php break; ?>
      <?php case 'markdown': ?>
        <div class="text">
          <?= $content->text()->kt(); ?>
        </div>
      <?php break; ?>
      <?php case 'video': ?>
        <div class="video">
            <?= video($content->url()); ?>
        </div>
      <?php break; ?>
      <?php case 'image': ?>
        <?php $image = $content->image()->toFile(); ?>
        <img
          class=""
          src="<?= $image->resize(2000)->url() ?>"
          srcset="<?= $image->srcset([300, 800, 1024]) ?>" />
      <?php break; ?>
      <?php case 'localvideo': ?>
        <div class="localvideo">
          <video controls>
            <?php $video = $content->content()->vidfile()->toFile(); ?>
            <source src="<?=$video->url(); ?>" type="<?= $video->mime(); ?>">
          </video>
        </div>
      <?php endswitch; ?>
    </li>
  <?php endforeach; ?>
</ul>


<script>
  document.addEventListener('DOMContentLoaded', () => {
    [].forEach.call(document.querySelectorAll('.gallery'), (g) => {
      const images = g.querySelectorAll('.gallery__image');
      const counter = g.querySelector('.gallery__controller__current-idx');
      g.dataset.currentIdx = 0;
      images[0].classList.add('gallery__image--active');

      const prev = (e) => {
        let currentIdx = parseInt(g.dataset.currentIdx);

        images[currentIdx].classList.remove('gallery__image--active');
        currentIdx = (currentIdx + images.length - 1) % (images.length );
        counter.innerText = currentIdx + 1;
        images[currentIdx].classList.add('gallery__image--active');

        g.dataset.currentIdx = currentIdx;
      };

      const next = (e) => {
        let currentIdx = parseInt(g.dataset.currentIdx);

        images[currentIdx].classList.remove('gallery__image--active');
        currentIdx = (currentIdx + 1) % (images.length );
        counter.innerText = currentIdx + 1;
        images[currentIdx].classList.add('gallery__image--active');

        g.dataset.currentIdx = currentIdx;
      };

      g.querySelector('.gallery__images').addEventListener('click', next);
      g.querySelector('.gallery__controller__left').addEventListener('click', prev);
      g.querySelector('.gallery__controller__right').addEventListener('click', next);
    });
  });
</script>