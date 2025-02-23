<?php echo \Fuel\Core\Asset::css('editor.css'); ?>

<script>
    // FuelPHPから渡されたデータを埋め込む
    window.__INITIAL_DATA__ = <?= json_encode($memo); ?>;
</script>

<div>
    <div id="editor">エディターを読み込み中...</div>
</div>

<?php if (\Fuel\Core\Fuel::$env === \Fuel\Core\Fuel::DEVELOPMENT): ?>
    <script src="http://localhost:9000/assets/js/react/editor.js"></script>
<?php else: ?>
    <script src="/assets/js/react/editor.js"></script>
<?php endif; ?>