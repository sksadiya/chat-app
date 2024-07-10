<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'My Application') ?></title>
    <link href="<?= base_url('bootstrap/dist/css/bootstrap.min.css') ?>" rel="stylesheet">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="<?= base_url('fortawesome/font-awesome/css/all.min.css') ?>" rel="stylesheet">

    <link rel="stylesheet" href="<?= base_url( 'build/css/style.css' ) ?>">

</head>
<body>
   
        <?= $this->renderSection('content') ?>

        <script src="<?= base_url('jquery/dist/jquery.min.js') ?>"></script>
        <script src="<?= base_url('bootstrap/dist/js/bootstrap.bundle.min.js') ?>"></script>
         <!-- fgEmojiPicker js -->
    <script src="<?= base_url('build/libs/fg-emoji-picker/fgEmojiPicker.js') ?>"></script>
    <script>
      $(document).ready(function () {
        var emojiPicker = new FgEmojiPicker({
        trigger: [".emoji-btn"],
        removeOnSelection: false,
        closeButton: true,
        position: ["top", "right"],
        preFetch: true,
        dir: "<?= base_url('build/js/pages/plugins/json') ?>",
        insertInto: document.querySelector(".chat-input"),
    });

    // emojiPicker position
    var emojiBtn = document.getElementById("emoji-btn");
    emojiBtn.addEventListener("click", function () {
        setTimeout(function () {
            var fgEmojiPicker = document.getElementsByClassName("fg-emoji-picker")[0];
            if (fgEmojiPicker) {
                var leftEmoji = window.getComputedStyle(fgEmojiPicker) ? window.getComputedStyle(fgEmojiPicker).getPropertyValue("left") : "";
                if (leftEmoji) {
                    leftEmoji = leftEmoji.replace("px", "");
                    leftEmoji = leftEmoji - 40 + "px";
                    fgEmojiPicker.style.left = leftEmoji;
                }
            }
        }, 0);
    });

      });
    </script> 
    <?= $this->renderSection('script') ?>

</body>
</html>
