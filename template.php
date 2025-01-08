<html>
<head>
  <title><?=$title?></title>
  <style type="text/css">
    body {
      font-family: sans-serif;
    }
    a, a:visited {
      color: black;
    }
    .item {
      width: <?=$size?>px;
      height: <?=$size?>px;
      margin: 20px;
      display: inline-block;
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
      float: left;
      font-size: 1.5em;
    }
    .folder {
      width: <?=$size?>px;
      height: <?=$size?>px;
      border-radius: 0 10px 10px 10px;
      line-height: 2em;
      background-color: silver;
      border-top: 5px solid gray;
      position: relative;
    }
    .folder:before {
      content: '';
      width: 50%;
      height: 15px;
      border-radius: 10px 20px 0 0;
      background-color: silver;
      position: absolute;
      top: -15px;
      left: 0px;
    }
    .folder span {
      display: block;
      width: 100%;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }
    #links a {
      text-decoration: none;
    }
  </style>
  <link rel="stylesheet" href="<?=$root?>css/blueimp-gallery.min.css" />
</head>
<body>
  <div class="container">
    <div class="gallery">
<?php if($subpath): ?>
      <h2><?=$title?>/<?=htmlspecialchars($subpath)?></h2>
      <div class="item">
<?php   if($parent): ?>
        <a href="<?=$root?>index.php?p=<?=rawurlencode($parent)?>">
<?php   else: ?>
        <a href="<?=$root?>">
<?php   endif; ?>
          <div class="folder">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="-50 -50 350 350">
              <title>Up one level</title>
              <path d="M259.0 225.0a5.4 5.4 0 0 1-4.8-3.0c-.316-.609-25.2-46.8-129.2-48.4v45.9c0 2.0-1.1 3.9-3.0 4.8-1.8.908-4.0.696-5.7-.56L2.1 136.5C.789 135.5 0 133.9 0 132.2a5.4 5.4 0 0 1 2.1-4.3l114.0-87.3c1.6-1.2 3.8-1.4 5.7-.566a5.4 5.4 0 0 1 3.0 4.8v48.4c2.7-.174 6.3-.326 10.5-.326 38.7 0 129.0 12.3 129.0 126.6 0 2.5-1.7 4.7-4.2 5.3-.413.0-.832.1-1.2.141zM14.3 132.2l99.6 76.3v-40.4c0-3.0 2.4-5.4 5.4-5.4 79.1 0 116.9 24.2 133.4 40.3-8.2-89.1-83.8-99.2-117.4-99.2-9.2 0-15.2.772-15.2.783-1.5.201-3.1-.277-4.3-1.3-1.1-1.0-1.8-2.5-1.8-4.0V55.9l-99.6 76.3z" fill="#000"/>
            </svg>
          </div>
        </a>
      </div>
<?php else: ?>
      <h2><?=$title?></h2>
<?php endif; ?>

<?php if(count($subdirs)): ?>
<?php   foreach($subdirs as $subdir): ?>
      <div class="item">
        <a href="<?=$root?>index.php?p=<?=rawurlencode($subpath)?><?=rawurlencode($subdir)?>">
          <div class="folder"><span><?=htmlspecialchars($subdir)?><span></div>
        </a>
      </div>
<?php   endforeach; ?>
<?php endif; ?>

      <div id="links">
<?php if(count($files)): ?>
<?php   foreach($files as $i => $file): ?>
        <div class="item">
          <a href="<?=$root?><?=$fulls?><?=rawurlencode($subpath)?><?=rawurlencode($file)?>" title="<?=($i + 1)?>/<?=count($files)?>">
            <img src="<?=$root?>index.php?t=<?=rawurlencode($subpath)?><?=rawurlencode($file)?>" alt="<?=$file?>" />
          </a>
        </div>
<?php   endforeach; ?>
<?php endif; ?>
      </div>
    </div>
  </div>
<?php if($lightbox && count($files)): ?>
  <div
    id="blueimp-gallery"
    class="blueimp-gallery"
    aria-label="image gallery"
    aria-modal="true"
    role="dialog"
  >
    <div class="slides" aria-live="polite"></div>
    <h3 class="title"></h3>
    <a
      class="prev"
      aria-controls="blueimp-gallery"
      aria-label="previous slide"
      aria-keyshortcuts="ArrowLeft"
    ></a>
    <a
      class="next"
      aria-controls="blueimp-gallery"
      aria-label="next slide"
      aria-keyshortcuts="ArrowRight"
    ></a>
    <a
      class="close"
      aria-controls="blueimp-gallery"
      aria-label="close"
      aria-keyshortcuts="Escape"
    ></a>
    <a
      class="play-pause"
      aria-controls="blueimp-gallery"
      aria-label="play slideshow"
      aria-keyshortcuts="Space"
      aria-pressed="false"
      role="button"
    ></a>
    <ol class="indicator"></ol>
  </div>
  <script src="<?=$root?>js/blueimp-gallery.min.js"></script>
  <script>
    document.getElementById('links').onclick = function (event) {
      event = event || window.event;
      var target = event.target || event.srcElement;
      var link = target.src ? target.parentNode : target;
      var options = { index: link, event: event };
      var links = this.getElementsByTagName('a');
      blueimp.Gallery(links, options);
    }
  </script>
<?php endif; ?>
</body>
</html>
